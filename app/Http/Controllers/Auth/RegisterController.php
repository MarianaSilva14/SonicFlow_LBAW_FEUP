<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/homepage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = null;

        try{
            DB::beginTransaction();

            $user = User::create([
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'role' => 'CUST'

            ]);

            $customer = Customer::create([
                'user_username' => $user['username'],
                'name' => $data['firstname'] . " " . $data['lastname'],
                'address' => $data['address'],
                'loyaltypoints' => 0,
                'newsletter' => true,
                'inactive' => false
            ]);
            $customer->save();

            DB::commit();

        } catch(\Exception $e){
            DB::rollBack();
        }


        Auth::setUser($user);
        return $user;
    }
}