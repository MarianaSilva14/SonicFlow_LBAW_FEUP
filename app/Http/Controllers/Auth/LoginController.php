<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $user = DB::table('user')->where([
            ['username', '=', $username],
            ['email', '=', $email]
            ])->get();

        if($user == null)
            return view("auth.recoveredPassword", ['error' => true ]);


        // send email
        $data = ['message_text' => "To recover your password for the SonicFlow platform please click the link below or past it in your browser.",
                    'link' => "google.com"];

        try {
            Mail::to($email)->send(new ResetPasswordEmail($data));

        } catch(\Exception $e){
            return view("auth.recoveredPassword", ['error' => true ]);
        }
        return view("auth.recoveredPassword", ['error' => false ]);
    }

}
