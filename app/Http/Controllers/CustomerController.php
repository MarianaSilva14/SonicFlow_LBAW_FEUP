<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

  /**
   * Shows the profile of a given user.
   *
   * @param  String  $id
   * @return Response
   */
  public function show($username)
  {
    $customer = DB::table('customer')->where('user_username','xavi123')->first();

    // try {
      $this->authorize('profile', $customer);
    // } catch (\Exception $e) {
    //   $e
    // }
    return view('pages.profile', ['infoCustomer' => $customer,'infoUser' => Auth::user()]);
  }


  /**
   * Retreives the user information
   *
   * @return Array Array of strings representing the user information
   */
  public function getInfo($id)
  {

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
