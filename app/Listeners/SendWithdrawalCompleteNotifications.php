<?php

namespace App\Listeners;

use App\Events\WithdrawalComplete;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWithdrawalCompleteNotifications
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WithdrawalComplete  $event
     * @return void
     */
    public function handle(WithdrawalComplete $event)
    {
        $withdrawal = $event->withdrawal;
        $body = Setting::where('setting_key',
            'withdrawal_paid_email_template')->first()->setting_value;
        $body = str_replace('{name}', $withdrawal->user->first_name . " " . $withdrawal->user->last_name, $body);
        $body = str_replace('{transactionId}', $withdrawal->id, $body);
        $body = str_replace('{amount}', $withdrawal->amount, $body);
        $body = str_replace('{paymentType}', $withdrawal->withdrawal_method->name, $body);
        Mail::raw($body, function ($message) use ($withdrawal) {
            $message->from(Setting::where('setting_key', 'non_reply_email')->first()->setting_value,
                Setting::where('setting_key', 'company_name')->first()->setting_value);
            $message->to($withdrawal->user->email);
            $headers = $message->getHeaders();
            $message->setContentType('text/html');
            $message->setSubject(Setting::where('setting_key',
                'withdrawal_paid_email_subject')->first()->setting_value);
        });
    }
}
