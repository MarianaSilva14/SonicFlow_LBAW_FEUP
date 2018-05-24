<?php


namespace App\Http\Controllers;

use App\PurchaseProduct;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

use App\Customer;
use App\User;
use App\Purchase;
use App\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $view = View::make('partials.purchase', ['id_purchase' => $purchase->id, 'products' => $purchase->getProducts(),'date'=>$purchase->date,'price'=>$purchase->value]);
        array_push($returnHTML, (string) $view);
    }
    return $returnHTML;
  }

  public function showCheckout(Request $request)
  {
    try{
      $this->authorize('purchase',Customer::class);
    } catch (AuthorizationException $e) {
        return view('auth.login');
    }
    $customer = Customer::findOrFail(Auth::user()->username);

    $json_object = json_decode($request->input('shoppingCart'));
    if($json_object==null){
        return view('pages.shoppingCart',['products'=>[],'values'=>[]]);
    }

    $json_object_result = Purchase::getPurchaseInfoFromJSON($json_object);
            // view da purchase
    return view('pages.purchase',['products'=>$json_object_result[0],'values'=>$json_object_result[1], 'customer'=>$customer]);
  }

    public function payCheckout(Request $request)
    {
//        throw new Exception("method error");

        // get customer
        $username = Auth::user()->username;
        $customer = Customer::find($username);

        // validate products
        $values = [];
        $products = [];
        $json_cart = json_decode($_COOKIE['shoppingCart']);

//                throw new Exception("method error");

        foreach ($json_cart as $key => $value){
            $product = null;
                try {
                    $product = Product::findOrFail($key);
                    array_push($products, $product);
                    if($product->stock > $value){
                        array_push($values, $value);
                    }else{
                        // return some error
                        array_push($values,$product->stock);
                    }
                } catch (\Exception $e) {
                    // return some error
                    continue;
                }

        }
        // validate price paid
        $price_paid = 0;
        for ($i = 0; $i < count($products); $i++){
            if($products[$i]->discountprice != "")
                $price_paid += $products[$i]->discountprice*$values[$i];
            else
                $price_paid += $products[$i]->price*$values[$i];
        }



        $loyaltyPointsUsed = $request->input("loyaltyPoints");

        if ($loyaltyPointsUsed == null || $loyaltyPointsUsed > min([$customer->loyaltypoints, intval($price_paid)*100])){
            throw new Exception("loyalty points conflict");
        }

        // validate points used
        $points_earned = intval($price_paid);
        $customer->loyaltypoints -= ($loyaltyPointsUsed - $points_earned);
        $customer->save();

        $method = $request->input("paymentMethod");
        if ($method == null){
            throw new Exception("method error");
        }
        $method = "Credit"; // fix this, always getting "on"


        // update price paid
        $price_paid -= intval($loyaltyPointsUsed/100);
        if ($price_paid == 0)
            $price_paid = 0.01;


        $purchase = Purchase::create([
            'customer_username' => $username,
            'value' => $price_paid,
            'method' => $method
        ]);

        for ($i = 0; $i < count($products); $i++){
            $price_product = $products[$i]->price;
            if($products[$i]->discountprice != "")
                $price_product = $products[$i]->discountprice;

            PurchaseProduct::create([
                "purchase_idpurchase" => $purchase->id,
                "product_idproduct" => $products[$i]->sku,
                "price" => $price_product,
                "quantity" => $values[$i]
            ]);

            $products[$i]->stock -= $values[$i];
            $products[$i]->save();
        }


        // DELETE CART COOKIE
//        unset($_COOKIE['shoppingCart']);     // this did not work




        return view('pages.profile', ['editable'=> FALSE, 'alert' => '', 'infoCustomer' => $customer,'infoUser' => Auth::user()]);

    }
}
