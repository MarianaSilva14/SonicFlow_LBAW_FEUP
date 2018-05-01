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
//    $product = null;
//    $values = [];
//    $products = [];

    $json_object = json_decode($request->input('shoppingCart'));
    if($json_object==null){
      return view('pages.shoppingCart',['products'=>[],'values'=>[]]);
    }

    $json_object_result = Purchase::getPurchaseInfoFromJSON($json_object);

    return view('pages.shoppingCart',['products'=>$json_object_result[0],'values'=>$json_object_result[1]]);
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

    public function showCheckout(Request $request)
    {

        $customer = Customer::findOrFail($username);

        // authorize pa autenticado

        // loyalty points

        $json_object = json_decode($request->input('shoppingCart'));
        if($json_object==null){
            return view('pages.shoppingCart',['products'=>[],'values'=>[]]);
        }

        $json_object_result = Purchase::getPurchaseInfoFromJSON($json_object);
                // view da purchase
        return view('pages.purchase',['products'=>$json_object_result[0],'values'=>$json_object_result[1], 'customer'=>$customer]);
    }
}
