<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        }
//        $urls =[url('user/verify_email'),url('user/verify_email/check_otp'),url('user/verify_email')];
//        if(Sentinel::getuser()->email_verified == 0 && !in_array(url()->current(),$urls))
////            return redirect()->to('user/verify_email');
        return $next($request);
    }
}
