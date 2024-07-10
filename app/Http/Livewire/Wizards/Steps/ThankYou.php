<?php

namespace App\Http\Livewire\Wizards\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class ThankYou extends StepComponent
{
    public function render()
    {
        return view('livewire.wizard-steps.thank-you');
    }
}
