<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'stripe' => [
      'key' => env('STRIPE_API_KEY')
    ],

   'intellipay' => [
     'url' => env('INTELLIPAY_URL'),
     'merchant' => env('INTELLIPAY_MERCHANT_KEY'),
     'api' => env('INTELLIPAY_API_KEY')
   ],

   'airtable' => [
        'key' => env('AIRTABLE_API_KEY'),
        'base' => env('AIRTABLE_BASE')
   ],

   'smartmoving' => [
        'key' => env('SMARTMOVING_KEY')
   ]
];
