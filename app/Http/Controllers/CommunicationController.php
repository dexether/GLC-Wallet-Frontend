<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Helpers\RouteSms;
use App\Helpers\Infobip;
use App\Models\Borrower;
use App\Models\Email;
use App\Models\Setting;
use App\Models\Sms;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Clickatell\Rest;
use Illuminate\Http\Request;
use Aloha\Twilio\Twilio;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class CommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEmail()
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = Email::get();
        return view('communication.email', compact('data'));
    }

    public function indexSms()
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = Sms::get();
        return view('communication.sms', compact('data'));
    }


    public function createEmail(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $users = array();
        $users["0"] = "All Users";
        foreach (User::all() as $key) {
            $users[$key->id] = $key->first_name . ' ' . $key->last_name ;
        }
        if (isset($request->user_id)) {
            $selected = $request->user_id;
        } else {
            $selected = '';
        }
        return view('communication.create_email', compact('users', 'selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $body = "";
        $recipients = 1;
        if ($request->send_to == 0) {
            foreach (User::all() as $user) {
                $body = $request->message;
//lets build and replace available tags
                $body = str_replace('{firstName}', $user->first_name, $body);
                $body = str_replace('{lastName}', $user->last_name, $body);
                $body = str_replace('{address}', $user->address, $body);
                $body = str_replace('{email}', $user->email, $body);
                $email = $user->email;
                if (!empty($email)) {
                    Mail::raw($body, function ($message) use ($request, $user, $email) {
                        $message->from(Setting::where('setting_key', 'company_email')->first()->setting_value,
                            Setting::where('setting_key', 'company_name')->first()->setting_value);
                        $message->to($email);
                        $headers = $message->getHeaders();
                        $message->setContentType('text/html');
                        $message->setSubject($request->subject);

                    });

                }
                $recipients = $recipients + 1;
            }
            $mail = new Email();
            $mail->user_id = Sentinel::getUser()->id;
            $mail->message = $body;
            $mail->subject = $request->subject;
            $mail->recipients = $recipients;
            $mail->send_to = 'All Users';
            $mail->save();
            GeneralHelper::audit_trail("Send  email to all users");
            Flash::success("Email successfully sent");
            return redirect('communication/email');
        } else {
            $body = $request->message;
            $user = User::find($request->send_to);
            //lets build and replace available tags
            $body = str_replace('{firstName}', $user->first_name, $body);
            $body = str_replace('{lastName}', $user->last_name, $body);
            $body = str_replace('{address}', $user->address, $body);
            $body = str_replace('{email}', $user->email, $body);
            $email = $user->email;
            if (!empty($email)) {
                Mail::raw($body, function ($message) use ($request, $user, $email) {
                    $message->from(Setting::where('setting_key', 'company_email')->first()->setting_value,
                        Setting::where('setting_key', 'company_name')->first()->setting_value);
                    $message->to($email);
                    $headers = $message->getHeaders();
                    $message->setContentType('text/html');
                    $message->setSubject($request->subject);

                });
                $mail = new Email();
                $mail->user_id = Sentinel::getUser()->id;
                $mail->message = $body;
                $mail->subject = $request->subject;
                $mail->recipients = $recipients;
                $mail->send_to = $user->first_name . ' ' . $user->last_name ;
                $mail->save();
                GeneralHelper::audit_trail("Sent email to user ");
                Flash::success("Email successfully sent");
                return redirect('communication/email');
            }

        }
        Flash::success("Email successfully sent");
        return redirect('communication/email');
    }


    public function deleteEmail($id)
    {
        if (!Sentinel::hasAccess('communication.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        Email::destroy($id);
        GeneralHelper::audit_trail("Deleted email record with id:" . $id);
        Flash::success("Email successfully deleted");
        return redirect('communication/email');
    }

    public function createSms(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $users = array();
        $users["0"] = "All Users";
        foreach (User::all() as $key) {
            $users[$key->id] = $key->first_name . ' ' . $key->last_name ;
        }
        if (isset($request->user_id)) {
            $selected = $request->user_id;
        } else {
            $selected = '';
        }
        return view('communication.create_sms', compact('users', 'selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeSms(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $body = "";
        $recipients = 1;
        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
            if ($request->send_to == 0) {

                $active_sms = Setting::where('setting_key', 'active_sms')->first()->setting_value;
                foreach (User::all() as $user) {
                    $body = $request->message;
//lets build and replace available tags
                    $body = str_replace('{firstName}', $user->first_name, $body);
                    $body = str_replace('{lastName}', $user->last_name, $body);
                    $body = str_replace('{address}', $user->address, $body);
                    $body = str_replace('{email}', $user->email, $body);
                    $email = $user->email;
                    $body = trim(strip_tags($body));
                    if (!empty($user->mobile)) {
                        GeneralHelper::send_sms($user->mobile, $body);
                    }
                    $recipients = $recipients + 1;
                }
                $sms = new Sms();
                $sms->user_id = Sentinel::getUser()->id;
                $sms->message = $body;
                $sms->gateway = $active_sms;
                $sms->recipients = $recipients;
                $sms->send_to = 'All Users';
                $sms->save();
                GeneralHelper::audit_trail("Sent SMS   to all users");
                Flash::success("SMS successfully sent");
                return redirect('communication/sms');
            } else {
                $body = $request->message;
                $user = User::find($request->send_to);
                //lets build and replace available tags
                $body = str_replace('{firstName}', $user->first_name, $body);
                $body = str_replace('{lastName}', $user->last_name, $body);
                $body = str_replace('{address}', $user->address, $body);
                $body = str_replace('{email}', $user->email, $body);
                $body = trim(strip_tags($body));
                if (!empty($user->mobile)) {
                    $active_sms = Setting::where('setting_key', 'active_sms')->first()->setting_value;
                    GeneralHelper::send_sms($user->mobile, $body);
                    $sms = new Sms();
                    $sms->user_id = Sentinel::getUser()->id;
                    $sms->message = $body;
                    $sms->gateway = $active_sms;
                    $sms->recipients = $recipients;
                    $sms->send_to = $user->first_name . ' ' . $user->last_name ;
                    $sms->save();
                    Flash::success("SMS successfully sent");
                    return redirect('communication/sms');
                }

            }
            GeneralHelper::audit_trail("Sent SMS   to user");
            Flash::success("Sms successfully sent");
            return redirect('communication/sms');
        } else {
            Flash::warning('SMS service is disabled, please go to settings and enable it');
            return redirect('setting/data')->with(array('error' => 'SMS is disabled, please enable it.'));
        }
    }


    public function deleteSms($id)
    {
        if (!Sentinel::hasAccess('communication.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        Sms::destroy($id);
        GeneralHelper::audit_trail("Deleted sms record with id:" . $id);
        Flash::success("SMS successfully deleted");
        return redirect('communication/sms');
    }

}
