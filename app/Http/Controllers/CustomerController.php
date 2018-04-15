<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Customer;

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
  public function update(Request $resquest,$username)
  {
    $customer = Customer::find($username);
    $user = User::find($username);
    $this->authorize('profile', $customer);

    //todo save picture -> get url -> update picture field in table
    if($request->hasFile('picture')){
      
    }

    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->picture = $picUrl;
    $customer->name = $request->input('firstName').$request->input('lastName');
    $customer->address = $request->input('address');

    $user->save();
    $customer->save();

    return view('pages.profile', ['editable'=> FALSE, 'alert' => 'Profile was <strong>succesfully</strong> edited', 'infoCustomer' => $customer,'infoUser' => Auth::user()]);
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

      $customer->user_username = $request->input('user_username');
      $customer->name = $request->input('name');
      $customer->address = $request->input('address');
      $customer->loyaltyPoints = $request->input('loyaltyPoints');
      $customer->newsletter = $request->input('newsletter');
      $customer->inactive = $request->input('inactive');
      $customer->save();

      return $customer;
  }


  public function delete(Request $request, $id)
  {
      /*$card = Card::find($id);

      $this->authorize('delete', $card);
      $card->delete();

      return $card;*/
  }
}
