<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\JobTeamInvite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Models\Company;
use Validator;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\ActivationService;
use Illuminate\Support\Facades\Hash;
use Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';
    protected $redirectTo = '/dashboard';

    protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function __construct(ActivationService $activationService)
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;

    }

    /**
     * [verifyUser description]
     * @param  Request $request [request object]
     * @return [array]          [array of response]
     */
    public function verifyUser(Request $request)
    {

        $user = User::whereEmail($request->email)->orWhere('username', $request->email)->first();

        if($user){
        // TODO
            $is_internal = $user->is_internal;


            if(!$is_internal){

                // Show password field
                return ['status' => 200, 'is_external' => true];

            }else{
                // Redirect to StaffStrength with Login
                $user_email = base64_encode($request->email);

                $redirect_url = getEnvData('HIRS_REDIRECT_LOGIN').'?referrer='.url('dashboard').'&host=seamlesshiring&user='.$user_email;

                return ['status' => 200, 'is_external' => false, 'redirect_url' => $redirect_url];

            }
        }else{
                return ['status' => 500, 'message' => 'These credentials do not match our records' ];
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],[
            'password.confirmed' => 'Passwords do not match',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function AjaxLogin(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        
            echo 'True';

        }else{
            echo 'Failed';
        }
    }

    public function autoLogin(Request $request)
    {
        $email = "demo@demo.com";
        $password = "password";
        $generated_code = $email."%&&%".$password;

        if( Hash::check($generated_code,$request->code) ) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect('/dashboard');
            }else{
                echo 'Not Authenticated';
            }
        }
        else
        {
            echo 'Not Authenticated';
        }

    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function activateUser($token)
    {

        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    public function Registration (Request $request){
        return redirect('/');
        if ($request->isMethod('post')) {

             $validator = Validator::make($request->all(), [
                'name' => 'unique:companies',
                'slug' => 'unique:companies',
                'email' => 'unique:users',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if( $request->hasFile('logo') )
            {
                $file_name  = ($request->logo->getClientOriginalName());
                $fi =  $request->file('logo')->getClientOriginalExtension();
                $logo = $request->company_name.'-'.$file_name;
            }
            else
            {
                $logo = '';
            }





            $com['name'] = $request->company_name;
            $com['slug'] = $request->slug;
            $com['phone'] = $request->phone;
            $com['website'] = $request->website;
            $com['address'] = $request->address;
            $com['about'] = $request->about_company;

            $user = User::FirstorCreate([
                                'name' => $request->first_name.' '.$request->last_name,
                                'email' => $request->email,
                                'password' => bcrypt($request->password),
            ]);

            $comp = Company::FirstorCreate([
                'name' => $request->company_name,
                'email' => $request->company_email,
                'slug' => $request->slug,
                'phone' => $request->phone,
                'website' => $request->website,
                'address' => $request->address,
                'about' => $request->about_company,
                'logo' => $logo,
                'date_added' => date('Y-m-d H:i:s'),
            ]);

            $assoc  = DB::table('company_users')->insert([
                      ['user_id' => $user->id, 'company_id'=> $comp->id, 'role' => 1]
            ]);

            $tests  = DB::table('company_tests')->insert([
                      ['ats_product_id' => 23, 'company_id'=> $comp->id],
                      ['ats_product_id' => 24, 'company_id'=> $comp->id],
                      ['ats_product_id' => 25, 'company_id'=> $comp->id],
                      ['ats_product_id' => 27, 'company_id'=> $comp->id]
            ]);



            if( $request->hasFile('logo') )
            {
                $upload = $request->file('logo')->move(
                    getEnvData('fileupload'), $logo
                );
            }

            //Send New user notification email
            /*$to = 'support@seamlesshiring.com';
            $mail = Mail::send('emails.new.sign-up', ['user' => $user ,'company' => $comp], function ($m) use($comp,$user,$to) {
                $m->from($to, @$comp->name);

                $m->to($to)->subject('New Sign Up');
            });*/


            // if($upload){
                $this->activationService->sendActivationMail($user);

                return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');

                // $login  = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

                // if($login)
                //     return redirect('dashboard');
            // }



        }
        return view('auth.register');
    }

    /**
     * [singleSignOn login and redirect to url]
     * @param  [string] $encoded_email [encoded email]
     * @param  [string] $encoded_key   [encoded key]
     * @param  [string] $encoded_url   [encoded url]
     * @return [route]                 [redirect to url]
     */
    public function singleSignOnVerify($encoded_email, $encoded_key)
    {

      $decoded_email = base64_decode($encoded_email);
      $decoded_key = base64_decode($encoded_key);

      $user = User::where('email', $decoded_email)->first();
      if(!$user){
        return ['status' => false, 'message' => 'User email does not exist'];
      }
      $company = $user->companies()->where('api_key', $decoded_key)->first();
      if($company == null){
          return ['status' => false, 'message' => 'API key not valid'];
      }else{
        $token =  Crypt::encrypt($user->email.time());
        $user->user_token = $token;
        $user->save();
        return [
            'status' => true,
            'message' => 'API key valid',
            'user_id' => $user->id,
            'token' => $token,
            'company_id' => $company->id
        ];
      }

    }


    public function switchUser()
    {
        if(Auth::check()){
            //audit trail
            admin_audit_log();
          return redirect()->route('dashboard');
        }
        elseif(Auth::guard('candidate')->check()) {
            //audit trail
            audit_log();
          return redirect()->route('candidate-dashboard');
        }
        else
          return redirect('/');
    }

    /**
     * [After Api confirmation, Log user in]
     * @param  [string] $url [url]
     * @param  [string] $user_   [encoded key]
     * @param  [string] $user_auth   [user_auth]
     * @return [route]                 [redirect to url]
     */
    public function loginUser($url, $user_id, $token)
    {


        $user_id = base64_decode($user_id);
        $url = base64_decode($url);

        $user = User::find($user_id);
        if($token == $user->user_token){
          Auth::login($user);
          $user->user_token = '';
          $user->save();
          $company = Company::find(base64_decode(\request()->company_id));

          if ($company) {
              session()->put('current_company_index', $company->id);
          }

          return redirect($url);
        }else{
          return ['status' => false, 'message' => 'Token not valid'];
        }
    }

    /**
     * Check if user has a role in RMS either as a user with admin roles or as an interviewer
     * @param $encoded_email
     * @param $encoded_key
     * @return array [route]
     */
    public function verifyUserHasRole($encoded_email, $encoded_key)
    {

        $decoded_email = base64_decode($encoded_email);
        $decoded_key = base64_decode($encoded_key);

        $user = User::where('email', $decoded_email)->first();
        $team_invite = JobTeamInvite::where('email', $decoded_email)->first();
        if(!$user && !$team_invite){
            return ['status' => false, 'message' => 'User/Job Team member email does not exist'];
        }

        $api_key = $user ? $user->companies()->where('api_key', $decoded_key)->first() :
            ($team_invite ? Company::where('api_key', $decoded_key)->first() : null);

        if($api_key == null){
            return ['status' => false, 'message' => 'API key not valid'];
        }else{
            $user_result =  $user && $user->roles->count() ? $user :
                ($team_invite && is_array(json_decode(($team_invite->role_ids))) && count(json_decode(($team_invite->role_ids)))  ? $team_invite : null);
            if($user_result) {
                return ['status' => true, 'message' => 'API key is valid and user has a role on RMS'];
            }
            return ['status' => false, 'message' => 'No User Found'];
        }

    }

    public function logout(){
        cache()->flush();
        auth()->logout();
        if(getEnvData('RMS_STAND_ALONE',true,request()->clientId) == false){ //redirect to hrms if rms is not stand alone
            return redirect(getEnvData('STAFFSTRENGTH_URL',null,request()->clientId));
        }
        return redirect('/login');
    }
}
