<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\User;
use App\Purchase;
use App\Product;

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
  public function show(Request $request)
  {
    $product = null;
    $values = [];
    $products = [];
    if(json_decode($request->input('shoppingCart'))==null){
      return view('pages.shoppingCart',['products'=>$products,'values'=>$values]);
    }
    foreach (json_decode($request->input('shoppingCart')) as $key => $value) {
      try {
        $product = Product::findOrFail($key);
        array_push($products, $product);
        if($product->stock > $value){
          array_push($values, $value);
        }else{
          array_push($values,$product->stock);
        }
      } catch (\Exception $e) {
        continue;
      }
    }
    return view('pages.shoppingCart',['products'=>$products,'values'=>$values]);
  }

  public function getPurchases($username){
    $customer = Customer::findOrFail($username);
    $this->authorize('profile',$customer);
    $purchases = Purchase::getPurchases($username);
    $returnHTML = [];
    foreach ($purchases as $purchase){
        $view = View::make('partials.purchase', ['products' => $purchase->getProducts(),'date'=>$purchase->date,'price'=>$purchase->value]);
        array_push($returnHTML, (string) $view);
    }
    return $returnHTML;
  }
}
