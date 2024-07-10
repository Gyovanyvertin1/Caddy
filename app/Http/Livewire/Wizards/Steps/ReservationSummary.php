<?php

namespace App\Http\Livewire\Wizards\Steps;

use App\Enums\TruckSize;
use Illuminate\Support\Str;
use App\Http\Traits\HasRate;
use TANIOS\Airtable\Airtable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Spatie\LivewireWizard\Components\StepComponent;

class ReservationSummary extends StepComponent
{
    use HasRate;

    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $rate;
    public $charge;

    public $truck;
    public $mileage;
    public $movers;
    public $hours;

    protected $listeners = ['validate' => 'validateForm'];

    public function mount()
    {
        $this->hours = $this->state()->all()["custom-booking"]["hours"];
        $this->mileage = $this->state()->all()["custom-booking"]["mileage"];
        $this->truck = $this->state()->all()["custom-booking"]["truck"];
        
        $this->movers = $this->state()->all()["custom-booking"]["movers"];

        $date = Carbon::createFromFormat("m-d-Y", $this->state()->all()["custom-booking"]["date"]);

        $surcharge = 0;
        $value = 5;

        if($this->truck != TruckSize::NoTruck->value)
        {
            $value = 15;
        }

        if($date->isToday() || $date->isTomorrow())
        {
            $surcharge = $value;
        }

        $this->rate = ($this->checkRate($this->movers, $this->hours, $this->truck, $this->mileage) / $this->hours) + $surcharge;

        $this->charge = $this->getCharge($this->rate, $this->hours);
    }

    public function render()
    {
        return view('livewire.wizard-steps.reservation-summary');
    }

    public function submit()
    {
        $this->validateForm();
        $this->insertToSmartMoving();
        $this->insertToAirTable();
        
       
        return $this->nextStep();
    }

    public function validateForm()
    {
        $base = [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];

       $this->validate($base);
    }

    public function insertToAirTable()
    {
        $state = $this->state()->all();
        
        $airtable = new Airtable(array(
            'api_key' => config('services.airtable.key'),
            'base'    => config('services.airtable.base')
        ));

        $deposit = $this->rate;

        $data = [
            // "Payment ID" => $this->paymentConfirmation["paymentIntent"]["id"],
            "Moving Date" => $state["custom-booking"]["date"],
            "Selected Time" => $state["custom-booking"]["time"],
            "Name" => $this->firstName . ' ' . $this->lastName,
            "Phone Number" => $this->phone,
            "Starting Address" => $state["select-places"]["startingPlace"],
            "Ending Address" => $state["select-places"]["endingPlace"],
            "Movers" => $state["custom-booking"]["movers"],
            "Hours" => $state["custom-booking"]["hours"],
            "Reservation Details" => $state["custom-booking"]["notes"],
            "Estimated Total" => $this->charge,
            "Deposit" => $deposit,
            // "Customer ID" => (string)$this->customer,
            "Email" => $this->email,
            'Customer CVV' => '',
           // 'Truck' => $this->truck,
           // 'Mileage' => (string)$this->mileage,
            // 'Discount Code' => $this->discount ?? ''
        ];

        $order = $airtable->saveContent("Master Orders", $data);

        Log::debug('New Order', $data);

        if(isset($order->parsedContent->error))
        {
            Log::error($order->parsedContent->error);
        }
    }

    public function insertToSmartMoving()
    {
        $key = config('services.smartmoving.key');
        $state = $this->state()->all();

        $data = [
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "phoneNumber" => $this->phone,
            "email" => $this->email,
            "moveDate" => Carbon::createFromFormat("m-d-Y", $state["custom-booking"]["date"])->format("Ymd"),
            "originAddressFull" => $state["select-places"]["startingPlace"],
            "destinationAddressFull" => $state["select-places"]["endingPlace"],
            "notes" => "
                Date & Time: {{$state["custom-booking"]["date"]}}\n
                Movers: {{$state["custom-booking"]["movers"]}}\n
                Hours: {{$state["custom-booking"]["hours"]}}\n
                Estimated Total: {{$this->charge}}\n
                Reservation Details: {{$state["custom-booking"]["notes"]}}
            "
        ];

        $response = Http::post('https://api.smartmoving.com/api/leads/from-provider/v2?providerKey=' . $key, $data);

        if(!$response->ok())
        {
            Log::debug('Error inserting to SmartMoving', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }
    }
}
