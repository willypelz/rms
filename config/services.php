<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => getEnvData('MAILGUN_DOMAIN'),
        'secret' => getEnvData('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => getEnvData('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => getEnvData('SES_KEY'),
        'secret' => getEnvData('SES_SECRET'),
        'region' => getEnvData('SES_REGION'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => getEnvData('STRIPE_KEY'),
        'secret' => getEnvData('STRIPE_SECRET'),
    ],

];
