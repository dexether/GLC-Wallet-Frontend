<?php

namespace App\Listeners;

use App\Events\DepositReceived;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendDepositNotifications
{
   
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DepositReceived  $event
     * @return void
     */
    public function handle(DepositReceived $event)
    {
        $deposit = $event->deposit;
        $body = Setting::where('setting_key',
            'payment_email_template')->first()->setting_value;
        $body = str_replace('{name}', $deposit->user->first_name . " " . $deposit->user->last_name, $body);
        $body = str_replace('{transactionId}', $deposit->id, $body);
        $body = str_replace('{amount}', $deposit->amount, $body);
        $body = str_replace('{paymentType}', $deposit->deposit_method->name, $body);
        Mail::raw($body, function ($message) use ($deposit) {
            $message->from(Setting::where('setting_key', 'non_reply_email')->first()->setting_value,
                Setting::where('setting_key', 'company_name')->first()->setting_value);
            $message->to($deposit->user->email);
            $headers = $message->getHeaders();
            $message->setContentType('text/html');
            $message->setSubject(Setting::where('setting_key',
                'payment_email_subject')->first()->setting_value);
        });
    }
}
