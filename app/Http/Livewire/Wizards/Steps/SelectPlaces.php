<?php

namespace App\Http\Livewire\Wizards\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SelectPlaces extends StepComponent
{
    public $startingPlace;
    public $endingPlace;

    protected $listeners = [
        'setStartingPlace' => 'setStartingPlace',
        'setEndingPlace' => 'setEndingPlace'
    ];

    protected $rules = [
        'startingPlace' => 'required',
    ];

    public function render()
    {
        return view('livewire.wizard-steps.select-places');
    }

    public function next()
    {
        $this->validate();
        $this->nextStep();
    }

    public function setStartingPlace($place)
    {
        $this->startingPlace = $place;
    }

    public function setEndingPlace($place)
    {
        $this->endingPlace = $place;
    }
}
