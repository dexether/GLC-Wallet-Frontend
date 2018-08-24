<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\DepositReceived' => [
            'App\Listeners\SendDepositNotifications',
        ],
        'App\Events\CommissionReceived' => [
            'App\Listeners\SendCommissionNotifications',
        ],
        'App\Events\WithdrawalComplete' => [
            'App\Listeners\SendWithdrawalCompleteNotifications',
        ],
        'App\Events\WithdrawalRequest' => [
            'App\Listeners\SendWithdrawalRequestNotifications',
        ],
        'App\Events\UserRegistration' => [
            'App\Listeners\SendActivationEmail',
        ],
        'App\Events\OrderComplete' => [
            'App\Listeners\SendOrderCompleteNotifications',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}