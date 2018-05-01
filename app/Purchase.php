<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{

  protected $primaryKey = 'id'; // or null

  public $incrementing = true;

  public $timestamps = false;

  //protected $fillable = ['rating']; // or null

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'purchase';

  public function getProducts(){
    return DB::table('purchase_product')
              ->join('product','purchase_product.product_idproduct','=','product.sku')
              ->where('purchase_idpurchase',$this->id)
              ->get();
  }

  public static function getPurchases($username){
    return Purchase::where('customer_username',$username)->get();
  }

    public static function getPurchaseInfoFromJSON($json_object){
        $product = null;
        $values = [];
        $products = [];
        foreach ($json_object as $key => $value){
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
        return [$products, $values];
    }
}
