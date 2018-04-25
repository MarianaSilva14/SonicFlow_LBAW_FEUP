<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\User;
use App\Purchase;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PurchaseController extends Controller
{
  /**
   * Shows the shoppingCart of a given user.
   *
   * @param  String  $username
   * @return Response
   */
  public function show($username)
  {

  }

  public function getPurchases($username){
    $customer = Customer::findOrFail($username);
    //$this->authorize('profile',$customer);
    $purchases = Purchase::getPurchases($username);
    $returnHTML = [];
    foreach ($purchases as $purchase){
        $view = View::make('partials.purchase', ['products' => $purchase->getProducts(),'date'=>$purchase->date,'price'=>$purchase->price]);
        array_push($returnHTML, (string) $view);
    }
    return $returnHTML;
  }
}
