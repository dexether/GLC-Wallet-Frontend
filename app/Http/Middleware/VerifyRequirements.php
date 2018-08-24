<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class VerifyRequirements
{
    protected $except = [
        'login/*',
        'register/*',
        'reset/*',
        'user/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        if (Setting::where('setting_key',
                'email_verify')->first()->setting_value == 1 && Sentinel::getUser()->email_verified == 0
        ) {
            //email is not verified
            return redirect()->to('user/verify_email');
        }
        if (Setting::where('setting_key',
                'phone_verify')->first()->setting_value == 1 && Sentinel::getUser()->phone_verified == 0
        ) {
            //email is not verified
            return redirect()->to('user/verify_phone');
        }
        if (Setting::where('setting_key',
                'documents_verify')->first()->setting_value == 1 && Sentinel::getUser()->documents_verified == 0
        ) {
            //email is not verified
            return redirect()->to('user/verify_documents');
        }

        return $next($request);
    }
}
