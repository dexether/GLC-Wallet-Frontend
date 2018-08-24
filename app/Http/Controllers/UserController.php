<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\Payroll;
use App\Models\Permission;
use App\Models\Repair;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cookie;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel', 'verify_requirements'], ['except' => ['profile', 'profileUpdate', 'verify_email', 'verify_phone', 'verify_documents', 'send_otp', 'email_send_otp', 'check_otp', 'emailcheckotp', 'check_documents']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\eResponse
     */
    public function index()
    {
        if (!Sentinel::hasAccess('users')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = User::with('roles')->get();
        return view('user.data', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('users.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $roles = DB::table('roles')->get();
        $role = array();
        foreach ($roles as $key) {
            $role[$key->name] = $key->name;
        }
        return view('user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('users.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $rules = array(
            'email' => 'required|unique:users',
            'password' => 'required',
            'rpassword' => 'required|same:password',
            'first_name' => 'required',
            'last_name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Flash::warning(trans('general.validation_error'));
            return redirect()->back()->withInput()->withErrors($validator);

        } else {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'notes' => $request->notes,
                'gender' => $request->gender,
                'phone' => $request->phone,
            ];
            $user = Sentinel::registerAndActivate($credentials);
            $role = Sentinel::findRoleByName($request->role);
            $role->users()->attach($user->id);
            GeneralHelper::audit_trail("Added user with id:" . $user->id);
            Flash::success("Successfully Saved");
            return redirect('user/data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        if (!Sentinel::hasAccess('users.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
       // return $user;
        return view('user.show', compact('user', 'payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        if (!Sentinel::hasAccess('users.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $roles = DB::table('roles')->get();
        $role = array();
        foreach ($roles as $key) {
            $role[$key->name] = $key->name;
        }

        foreach ($user->roles as $sel) {
            $selected = $sel->name;
        }
        $countries = [];
        foreach (Country::where('active', '1')->get() as $key) {
            $countries[$key->id] = $key->name;
        }
        return view('user.edit', compact('user', 'role', 'selected','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        return $request->all();
        if (!Sentinel::hasAccess('users.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $user = Sentinel::findById($id);

        $address=$request->address."|".$request->street_2."|".$request->city."|".$request->state."|".$request->postcode;

        $credentials = [
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'country_id' => $request->country_id,
            'email_verified' => $request->email_verified,
            'phone_verified' => $request->phone_verified,
            'documents_verified' => $request->documents_verified,
        ];
        if (!empty($request->password)) {
            $credentials['password'] = $request->password;
        }
        if ($request->role != $request->previous_role) {

            $role = Sentinel::findRoleByName($request->previous_role);
            $role->users()->detach($user->id);
            $role = Sentinel::findRoleByName($request->role);
            $role->users()->attach($user->id);
        }
        $user = Sentinel::update($user, $credentials);
        GeneralHelper::audit_trail("Updated user with id:" . $user->id);
        Flash::success("Successfully Saved");
        return redirect('user/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('users.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $user = Sentinel::findById($id);
        $user->delete();
        GeneralHelper::audit_trail("Deleted user with id:" . $id);
        Flash::success("Successfully Deleted");
        return redirect('user/data');
    }

    public function profile()
    {

        $user = Sentinel::findById(Sentinel::getUser()->id);
        $countries = [];
        foreach (Country::where('active', '1')->get() as $key) {
            $countries[$key->id] = $key->name;
        }
        return view('user.profile', compact('user', 'countries'));
    }


    public function profileUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        //check email



        if (User::where('email', $request->email)->where('id', '!=', $user->id)->count() > 0) {
            Flash::warning(trans('general.email_exists'));
            return redirect()->back()->withInput();
        }
        $rules = array(
            'email' => 'required',
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'code' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Flash::warning(trans('general.validation_error'));
            return redirect()->back()->withInput()->withErrors($validator);
        }
         $address=$request->street."|".$request->street_2."|".$request->city."|".$request->state."|".$request->postcode;
        $credentials = [
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $address,
            'country_id' => $request->country_id,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'city' => $request->city,
            'phone' => $request->code.$request->phone,
        ];
        if (!empty($request->password)) {
            $credentials['password'] = $request->password;
        }
        $user = Sentinel::update($user, $credentials);
        Flash::success(trans('general.successfully_saved'));
        return redirect('dashboard');
    }

//manage permissions
    public function indexPermission()
    {
        $data = array();
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subs = Permission::where('parent_id', $permission->id)->get();
            foreach ($subs as $sub) {
                array_push($data, $sub);
            }
        }
        return view('user.permission.data', compact('data'));
    }

    public function createPermission()
    {
        $parents = Permission::where('parent_id', 0)->get();
        $parent = array();
        $parent['0'] = "None";
        foreach ($parents as $key) {
            $parent[$key->id] = $key->name;
        }

        return view('user.permission.create', compact('parent'));
    }

    public function storePermission(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->description = $request->description;
        if (!empty($request->slug)) {
            $permission->slug = $request->slug;
        } else {
            $permission->slug = str_slug($request->name, '_');
        }

        $permission->save();
        Flash::success("Successfully Saved");
        return redirect('user/permission/data');
    }

    public function editPermission($permission)
    {
        $parents = Permission::where('parent_id', 0)->get();
        $parent = array();
        $parent['0'] = "None";
        foreach ($parents as $key) {
            $parent[$key->id] = $key->name;
        }
        if ($permission->parent_id == 0) {
            $selected = 0;
        } else {
            $selected = 1;
        }

        return view('user.permission.edit', compact('parent', 'permission', 'selected'));
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->description = $request->description;
        if (!empty($request->slug)) {
            $permission->slug = $request->slug;
        } else {
            $permission->slug = str_slug($request->name, '_');
        }
        $permission->save();
        Flash::success("Successfully Saved");
        return redirect('user/permission/data');
    }

//manage roles
    public function indexRole()
    {
        if (!Sentinel::hasAccess('users.roles')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = EloquentRole::all();
        return view('user.role.data', compact('data'));
    }

    public function createRole()
    {
        $data = array();
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subs = Permission::where('parent_id', $permission->id)->get();
            foreach ($subs as $sub) {
                array_push($data, $sub);
            }
        }
        return view('user.role.create', compact('data'));
    }

    public function storeRole(Request $request)
    {
        $role = new EloquentRole();
        $role->name = $request->name;
        $role->slug = str_slug($request->name, '_');
        $role->save();
        if (!empty($request->permission)) {
            foreach ($request->permission as $key) {
                $role->updatePermission($key, true, true)->save();
            }
        }
        GeneralHelper::audit_trail("Added role with id:" . $role->id);
        Flash::success("Successfully Saved");
        return redirect('user/role/data');
    }

    public function editRole($id)
    {
        $data = array();
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subs = Permission::where('parent_id', $permission->id)->get();
            foreach ($subs as $sub) {
                array_push($data, $sub);
            }
        }
        $role = EloquentRole::find($id);
        return view('user.role.edit', compact('data', 'role'));
    }

    public function updateRole(Request $request, $id)
    {
        //return print_r($request->permission);
        $role = Sentinel::findRoleById($id);
        $role->name = $request->name;
        $role->slug = str_slug($request->name, '_');
        $role->permissions = array();
        $role->save();
        //remove permissions which have not been ticked
        //create and/or update permissions
        if (!empty($request->permission)) {
            foreach ($request->permission as $key) {
                $role->updatePermission($key, true, true)->save();
            }
        }

        GeneralHelper::audit_trail("Updated role with id:" . $id);
        Flash::success("Successfully Saved");
        return redirect('user/role/data');
    }

    public function deletePermission($id)
    {
        Permission::destroy($id);
        Flash::success("Successfully Saved");
        return redirect('user/permission/data');
    }

    public function deleteRole($id)
    {
        EloquentRole::destroy($id);
        GeneralHelper::audit_trail("Deleted role with id:" . $id);
        Flash::success("Successfully Saved");
        return redirect('user/role/data');
    }

    public function verify_email()
    {
         $user = Sentinel::getuser();

        if(!isset($_COOKIE['otpresend1'])) {
        setcookie('otpresend1', 1, time() + (60*60), "/");
//        return view('emails.email_verification',compact('user'));
            Mail::send('emails.email_verification', [
                'user' => $user,
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject("Email verification code ");
            });
        }
        return view('user.verify_email', compact(''));
    }

    public function verify_phone()
    {
        $user = Sentinel::getuser();
        if($user->email_verified == 0)
            return redirect('user/verify_email');

        if(!isset($_COOKIE['otpresend_phone1'])) {
        setcookie('otpresend_phone1', 1, time() + (60 * 60), "/");
        $this->send_otp($user->id);
    }
      return view('user.verify_phone', compact(''));
    }

    public function verify_documents()
    {
        $user = Sentinel::getUser();
        $countries = [];
        foreach (Country::where('active', '1')->get() as $key) {
            $countries[$key->id] = $key->name;
        }
        return view('user.verify_documents', compact('user', 'countries'));
    }

    public function send_otp($id)
    {
        $json = [];
        $sender_id =  Setting::where('setting_key', 'sender_id')->first()->setting_value;
        $SendSMS_api_id =  Setting::where('setting_key', 'SendSMS_api_id')->first()->setting_value;
        $SendSMS_api_password =  Setting::where('setting_key', 'SendSMS_api_password')->first()->setting_value;
        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
            $user = Sentinel::findById($id);
             $body = Setting::where('setting_key',
                'otp_sms_template')->first()->setting_value;
            $body = str_replace('{otp}', $user->otp, $body);
            $body = trim(strip_tags($body));
            if (!empty($user->phone)) {
                setcookie('otpresend_phone', 1, time() + (1.5*60), "/");
       $url ="https://api.smsala.com/api/SendSMS?api_id=".$SendSMS_api_id."&api_password=".$SendSMS_api_password."&sms_type=T&encoding=T&sender_id=".$sender_id."&phonenumber=".$user->phone."&textmessage=".$body;
            //send sms here
        $url = str_replace(" ", '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $ret = curl_exec($ch);


//                GeneralHelper::send_sms($user->phone, $body);
                $json["success"] = 1;
            }
        } else {
            $json["success"] = 0;
        }
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }
    public function email_send_otp(Request $request)
    {
        $json = [];
          $user =  Sentinel::getuser();


        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
            Mail::send('emails.email_verification',[
                'user' => $user,
            ],function($message) use ($user) {
                $message->to($user->email);
                $message->subject("Email verification code ");
            });
            $json["success"] = 1;
        } else {
            $json["success"] = 0;
        }
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }

    public function check_otp(Request $request)
    {
        if ($request->otp == Sentinel::getUser()->otp) {
            $user = User::find(Sentinel::getUser()->id);
            $user->phone_verified = 1;
            $user->save();
            Flash::success(trans_choice('general.phone_verified', 1));
            return redirect('dashboard');
        } else {
            Flash::warning(trans_choice('general.invalid_otp', 1));
            return redirect()->back();
        }


    }
    public function emailcheckotp(Request $request)
    {
       
        if ($request->otp == Sentinel::getUser()->otp) {
            $user = User::find(Sentinel::getUser()->id);
            $user->email_verified = 1;
            $user->save();
            $this->newotp();
            Flash::success(trans_choice('general.email  _verified', 1));
            return redirect('dashboard');
        } else {
            Flash::warning(trans_choice('general.invalid_otp', 1));
            return redirect()->back();
        }


    }


    public function check_documents(Request $request)
    {

        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'country_id' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            //'id_picture' => 'required',
            'proof_of_residence_type' => 'required',
            //'proof_of_residence_picture' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Flash::warning(trans('general.validation_error'));
            return redirect()->back()->withInput()->withErrors($validator);

        } else {
            $user = Sentinel::getUser();
            $address=$request->address."|".$request->street_2."|".$request->city."|".Sentinel::getUser()->state."|".$request->zip;


            $credentials = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $address,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'country_id' => $request->country_id,
                'id_type' => $request->id_type,
                'id_number' => $request->id_number,
                'proof_of_residence_type' => $request->proof_of_residence_type,
            ];
            //validate files
            if ($request->hasFile('id_picture')) {
                $file = array('id_picture' => Input::file('id_picture'));
                $rules = array('id_picture' => 'required|mimes:jpeg,jpg,bmp,png,pdf');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    Flash::warning(trans('general.validation_error'));
                    return redirect()->back()->withInput()->withErrors($validator);
                } else {
                    $fname = "client_" . uniqid() . '.' . $request->file('id_picture')->guessExtension();
                    $credentials["id_picture"] = $fname;
                    $request->file('id_picture')->move(public_path() . '/uploads',
                        $fname);
                }

            }
            if ($request->hasFile('proof_of_residence_picture')) {
                $file = array('proof_of_residence_picture' => Input::file('proof_of_residence_picture'));
                $rules = array('proof_of_residence_picture' => 'required|mimes:jpeg,jpg,bmp,png,pdf');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    Flash::warning(trans('general.validation_error'));
                    return redirect()->back()->withInput()->withErrors($validator);
                } else {
                    $fname = "client_" . uniqid() . '.' . $request->file('proof_of_residence_picture')->guessExtension();
                    $credentials["proof_of_residence_picture"] = $fname;
                    $request->file('proof_of_residence_picture')->move(public_path() . '/uploads',
                        $fname);
                }

            }
            $user = Sentinel::update($user, $credentials);

            Flash::success(trans('general.successfully_updated_documents'));
            return redirect()->back();
        }

    }

    public  function newotp(){
        $user = Sentinel::getuser();
        $user = Sentinel::findById($user->id);
        $credentials = [
            'otp' => mt_rand(100000,999999),
        ];
         Sentinel::update($user, $credentials);
    }

    public function verified($user_id,$id)
    {
        $user = User::find($user_id->id);
        $user->documents_verified = $id;
        $user->save();
        Flash::success(trans('general.successfully_updated_documents'));
        return redirect()->back();
    }
}
