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
     * @return String where it will be redirected
     */
    protected function redirectTo(){
        $user = Auth::user();

        if( $user->role == 'ADMIN'){
            return url('administration');
        }

        if( $user->role == 'MOD'){
            return url('moderation');
        }

        return url('homepage');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function resetPassword(Request $request){
        $email = $request->input("email");
        $username = $request->input("username");

        // check if user exists


        // send email

        return view("auth.recoveredPassword");
    }

}
