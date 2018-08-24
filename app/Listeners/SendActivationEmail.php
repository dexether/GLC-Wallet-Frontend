<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistration $event
     * @return void
     */
    public function handle(UserRegistration $event)
    {
        $user = $event->user;
        $activation = Activation::create($user);
        $body = Setting::where('setting_key',
            'new_account_template')->first()->setting_value;
        $body = str_replace('{name}', $user->first_name . " " . $user->last_name, $body);
        $body = str_replace('{activationLink}', url('register/activate/' . $activation->code.'/'.$user->id), $body);
        Mail::raw($body, function ($message) use ($user) {
            $message->from(Setting::where('setting_key', 'non_reply_email')->first()->setting_value,
                Setting::where('setting_key', 'company_name')->first()->setting_value);
            $message->to($user->email);
            $headers = $message->getHeaders();
            $message->setContentType('text/html');
            $message->setSubject(Setting::where('setting_key',
                'new_account_subject')->first()->setting_value);
        });
    }
}
