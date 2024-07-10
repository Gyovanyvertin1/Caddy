<?php

namespace App\Http\Livewire\Wizards;

use App\Http\Livewire\Wizards\Steps\ThankYou;
use App\Http\Livewire\Wizards\Steps\SelectPlaces;
use App\Http\Livewire\Wizards\Steps\CustomBooking;
use Spatie\LivewireWizard\Components\WizardComponent;
use App\Http\Livewire\Wizards\Steps\ReservationSummary;

class NewOrderWizard extends WizardComponent
{
    public function steps() : array
    {
        return [
            SelectPlaces::class,
            CustomBooking::class,
            ReservationSummary::class,
            ThankYou::class
        ];       
    }
}
