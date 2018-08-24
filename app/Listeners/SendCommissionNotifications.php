<?php

namespace App\Listeners;

use App\Events\CommissionReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommissionNotifications
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommissionReceived  $event
     * @return void
     */
    public function handle(CommissionReceived $event)
    {
        //
    }
}
