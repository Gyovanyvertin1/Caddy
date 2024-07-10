<?php

namespace App\Providers;

use Livewire\Livewire;
use Stripe\StripeClient;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\Wizards\NewOrderWizard;
use App\Http\Livewire\Wizards\Steps\ThankYou;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Livewire\Wizards\Steps\SelectPlaces;
use App\Http\Livewire\Wizards\Steps\CustomBooking;
use App\Http\Livewire\Wizards\Steps\ReservationSummary;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(StripeClient::class, function (Application $app) {
            return new StripeClient(config('services.stripe.key'));
        });
        
        Livewire::component('new-order-wizard', NewOrderWizard::class);
        Livewire::component('select-places', SelectPlaces::class);
        Livewire::component('custom-booking', CustomBooking::class);
        Livewire::component('reservation-summary', ReservationSummary::class);
        Livewire::component('thank-you', ThankYou::class);
    }
}
