<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Customer;
use App\User;

class CustomerController extends Controller
{

  /**
   * Shows the profile of a given user.
   *
   * @param  String  $username
   * @return Response
   */
  public function show($username)
  {
    $customer = Customer::find($username);
    $this->authorize('profile', $customer);
    return view('pages.profile', ['editable'=> FALSE, 'alert' => '', 'infoCustomer' => $customer,'infoUser' => Auth::user()]);
  }

  /**
   * Shows the profile of a given user with editable fields.
   *
   * @param  String  $username
   * @return Response
   */
  public function update(Request $request,$username)
  {
    $customer = Customer::find($username);
    $user = User::find($username);
    $this->authorize('profile', $customer);

    $validatedData = $request->validate([
       'password' => 'nullable',
       'oldPassword' => 'nullable',
       'password_confirmation' => 'nullable',
       'picture' => 'nullable',
       'email' => 'required',
       'firstName' => 'required',
       'lastName' => 'required'
     ]);

    if($request->input('oldPassword')!=""){
      if(!Hash::check($request->input('oldPassword'),$user->password) || $request->input('password') == "") {
        return view('pages.profile', ['editable'=> TRUE, 'alert' => 'Old Password is <strong>invalid</strong> or new password wasn\'t <strong>set</strong>', 'infoCustomer' => $customer,'infoUser' => Auth::user()]);
      }
      $user->password = bcrypt($request->input('password'));
    }

    if($request->hasFile('picture')){
      $picPath = $request->file('picture')->store('public/avatars', ['public']);
      $user->picture = $picPath;
    }

    $user->email = $request->input('email');
    $customer->name = $request->input('firstName').' '.$request->input('lastName');
    $customer->address = $request->input('address');

    $user->save();
    $customer->save();

    Auth::setUser($user);

    return view('pages.profile', ['editable'=> FALSE, 'alert' => 'Profile was <strong>succesfully</strong> edited', 'infoCustomer' => $customer,'infoUser' => $user]);
  }

  /**
   * Shows the profile of a given user with editable fields.
   *
   * @param  String  $username
   * @return Response
   */
  public function edit($username)
  {
    $customer = Customer::find($username);
    $this->authorize('profile', $customer);
    return view('pages.profile', ['editable'=> TRUE, 'alert' => 'Profile is now being <strong>edited</strong>', 'infoCustomer' => $customer,'infoUser' => Auth::user()]);
  }

  /**
   * Creates a new customer.
   *
   * @return Customer The customer created.
   */
  public function create(Request $request)
  {
      $customer = new Customer();

      $validatedData = $request->validate([
         'user_username' => 'required',
         'name' => 'required',
         'address' => 'nullable'
       ]);

      $customer->user_username = $request->input('user_username');
      $customer->name = $request->input('name');
      $customer->address = $request->input('address');
      $customer->loyaltyPoints = $request->input('loyaltyPoints');
      $customer->newsletter = $request->input('newsletter');
      $customer->inactive = $request->input('inactive');
      $customer->save();

      return $customer;
  }

  public function toggleFavoritesList($sku){

    try {
      $this->authorize('favorite',Customer::class);
    } catch (\Exception $e) {
      return $e->getMessage();
    }

    Customer::find(Auth::user()->username)->toggleFavorite($sku);

    return;
  }

  public function getFavorites($username){
    $customer = Customer::findOrFail($username);
    $this->authorize('profile',$customer);
    $favorites = $customer->favoritesList;
    $returnHTML = [];
    foreach ($favorites as $favorite){
        $view = View::make('partials.product_mini', ['product' => $favorite]);
        array_push($returnHTML, (string) $view);
    }
    return $returnHTML;
  }

}
