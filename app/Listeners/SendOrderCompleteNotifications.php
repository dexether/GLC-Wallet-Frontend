<?php

namespace App\Listeners;

use App\Events\OrderComplete;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderCompleteNotifications
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
     * @param  OrderComplete  $event
     * @return void
     */
    public function handle(OrderComplete $event)
    {
        $order = $event->order;
        $body = Setting::where('setting_key',
            'sell_email_template')->first()->setting_value;
        $body = str_replace('{name}', $order->user->first_name . " " . $order->user->last_name, $body);
        $body = str_replace('{orderId}', $order->id, $body);
        $body = str_replace('{amount}', $order->amount, $body);
        Mail::raw($body, function ($message) use ($order) {
            $message->from(Setting::where('setting_key', 'non_reply_email')->first()->setting_value,
                Setting::where('setting_key', 'company_name')->first()->setting_value);
            $message->to($order->user->email);
            $headers = $message->getHeaders();
            $message->setContentType('text/html');
            $message->setSubject(Setting::where('setting_key',
                'sell_email_subject')->first()->setting_value);
        });
    }
}
