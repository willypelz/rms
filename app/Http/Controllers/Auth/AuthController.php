<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Company;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\ActivationService;


class AuthController extends Controller
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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
    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => 'logout']);

    // }

    public function __construct(ActivationService $activationService)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;
    }

    // public function redirectPath()
    // {
    //     // // Logic that determines where to send the user
    //     // if (\Auth::user()->type == 'admin') {
    //     //     return '/admin';
    //     // }
        
    //     return '/poop';
    // }

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
            // return redirect()->route('ajax_checkout');
            echo 'True';
        }else{
            echo 'Failed';
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

        if ($request->isMethod('post')) {
            // dd($request->request); 

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
                $file_name  = (@$request->logo->getClientOriginalName());
                $fi =  @$request->file('logo')->getClientOriginalExtension(); 
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


            
            if( $request->hasFile('logo') )
            {
                $upload = $request->file('logo')->move(
                    env('fileupload'), $logo
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

    
}
