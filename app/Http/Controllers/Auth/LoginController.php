<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // protected function redirectTo()
    // {
    //     if (Auth::user()->user_role == '1') {
    //         return redirect()->route('superadmins.index');
    //     }  
    //     else {
    //         return 'home';
    //     }  
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function verifyCredentials(Request $request){
        //Check if both the email and password field are not empty with laravel validate function
        $this->validate($request, [
            'email'     =>  'required|email',
            'password'  =>  'required'
        ]);

        //Push values from email and password input fields into an array 
        $user_data = array(
            'email'     =>  $request->get('email'),
            'password'  =>  $request->get('password')
        );

        //Attempt to authenticate user provided credentials
        if(Auth::attempt($user_data)){
            return redirect()->route('home');
        }else{
            return back()->with('error','Invalid credentials.');
        }
    }

    public function userID(){
        if (Auth::check()) {
            return Auth::id();
        } else{
            return view('login');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/')
        ->with('successs', 'You are logged out!');
    }
}
