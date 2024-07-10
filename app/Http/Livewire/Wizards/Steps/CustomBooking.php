<?php

namespace App\Http\Livewire\Wizards\Steps;

use Carbon\Carbon;
use App\Enums\TruckSize;
use Illuminate\Support\Str;
use App\Http\Traits\HasRate;
use Carbon\Exceptions\InvalidFormatException;
use Spatie\LivewireWizard\Components\StepComponent;

class CustomBooking extends StepComponent
{
    use HasRate;

    public int $movers = 1;
    public int $hours = 2;
    public $time;
    public $date;
    public $notes;
    // public $truck;
    // public $mileage;

    protected $rules = [
        // 'mileage' => 'required|min:0|max:40|numeric',
        'time' => 'required',
        'date' => 'required'
    ];

    protected $listeners = [
        'setDate' => 'setDate'
    ];

    protected function rules()
    {
        if($this->truck != TruckSize::NoTruck->value){
            return [
                // 'mileage' => 'required|min:1|max:40|numeric',
                'time' => 'required',
                'date' => 'required'
            ];
        }

        return [
            'mileage' => 'required|min:0|max:40|numeric',
            'time' => 'required',
            'date' => 'required'
        ];
    }

    public function mount()
    {
        $this->date = \Carbon\Carbon::today("America/Chicago")->format("m-d-Y");
        $this->time = null;
        $this->truck = TruckSize::NoTruck->value;
        $this->mileage = 0;
    }

    public function render()
    {
        return view('livewire.wizard-steps.custom-booking');
    }


//    public function updatedMileage()
//  {
//    $this->validate();
//  }

    public function subtractMover()
    {
        if($this->movers > 1)
        {
            $this->movers--;
        }
    }

    public function subtractHour()
    {
        if($this->hours > 1)
        {
            $this->hours--;
        }

        if($this->hours == 1)
        {
            $this->truck = TruckSize::NoTruck->value;
        }
    }

    public function addMover()
    {  
        if($this->movers < 6)
        {
            $this->movers++;
        }
    }

    public function addHour()
    {
        if($this->hours < 10)
        {
            $this->hours++;
        }
    }

    public function updatedTruck()
    {
        $this->time = null;

        if($this->truck != TruckSize::NoTruck->value){
            $this->mileage = 1;  
            return;  
       }

        $this->mileage = 0;
    }

    public function setTime(string $time)
    {
        $this->time = $time;
    }

    public function setDate($date)
    {
        $this->date = Carbon::parse($date, "America/Chicago")->format('m-d-Y');
    }

    public function next()
    {
        $this->validate();
        $this->nextStep();
    }

    public function checkLeadTime($time)
    {
        if(is_null($this->date) || !(substr_count($this->date, '-') == 2))
        {
            return false;
        }

        try{
            $leadTime = Carbon::createFromFormat('m-d-Y', $this->date)->setTimeFromTimeString($time)->setTimezone("America/Chicago");

            if($leadTime->isYesterday())
            {
                return false;
            }
            
            if($this->truck != TruckSize::NoTruck->value)
            {
                if(!$leadTime->isToday())
                {
                    if($time == "8:00 am" || $time == "6:00 pm")
                    {
                        return false;
                    }


                    return true;
                }


                return false;
            }


            if($leadTime->isToday())
            {
                if($leadTime->diffInHours(Carbon::now("America/Chicago"), true) < 4)
                {
                    return true;
                }

                return false;
            }

            if($leadTime->isTomorrow() && $time == "8:00 am")
            {
                return false;
            }
        }
        catch(InvalidFormatException $e)
        {
            //do nothing
        }

        return true;
    }

    public function getSurchargeValue()
    {
        return $this->getSurcharge($this->date, $this->truck);
    }

    public function getFormattedDateProperty()
    {
        try{
            if($this->date && $formatted = Carbon::createFromFormat('m-d-Y' ,$this->date)){
                return $formatted->format('m/d/y');
            }
        }
        catch(InvalidFormatException $e)
        {
            //do nothing
        }

        return Carbon::today("America/Chicago")->format('m/d/y');
    }
}
