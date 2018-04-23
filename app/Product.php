<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

  protected $primaryKey = 'sku'; // or null

  public $incrementing = false;

  public $timestamps = false;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product';

  public function favoritesList(){
    return $this->belongsToMany('App\Customer','favorite','user_username', 'product_idproduct');
  }

  public function attributes(){
    $attributes =
    DB::table('category')
      ->join('category_attribute',function($join){
        $join->on('category.id','=','category_idcategory')
              ->where('category.id','=',$this->category_idcat);
      })
      ->join('attribute_product',function($join){
        $join->on('attribute_product.attribute_idattribute','=','category_attribute.attribute_idattribute')
              ->where('attribute_product.product_idproduct','=',$this->sku);
      })
      ->join('attribute','attribute.id','=','attribute_product.attribute_idattribute')
      ->select('attribute.name','attribute_product.value','attribute.id')
      ->get();
    return $attributes;
  }

  public function setProductAttribute($attribute_id,$attribute_value){
    DB::table('attribute_product')
        ->where('product_idproduct', $this->sku)
        ->where('attribute_idattribute', $attribute_id)
        ->update(['value' => $attribute_value]);
  }

  public function comments(){
    return $this->hasMany('App\Comment','product_idproduct');
  }

  public function getTopComments(){
    // $comments =
    // DB::table('comment')
    //   ->where('comment.product_idproduct','=',$this->sku)
    //   ->whereRaw('comment.id NOT IN (SELECT comment_idchild FROM answer)')
    //   ->get();

    $comments =
    Comment::where('comment.product_idproduct','=',$this->sku)
            ->whereRaw('comment.id NOT IN (SELECT comment_idchild FROM answer)')
            ->get();
    return $comments;
  }

  public function getImages(){
    return explode(';',$this->picture);
  }

  public static function getProductsReference(Request $request){
    $query = DB::table('product');

    $catgoryID = intval($request->input('categoryID'));
    if ($catgoryID != null){
        $query = $query->where('category_idCat', $catgoryID);
    }

    $minPrice = floatval($request->input('minPrice'));
    $maxPrice = floatval($request->input('maxPrice'));
    if ( $minPrice != null && $maxPrice != null && ($minPrice < $maxPrice)){
        $query = $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    $available = filter_var($request->input('productAvailability'), FILTER_VALIDATE_BOOLEAN);
    if ( $available != null){
        if ($available){
            $query = $query->where('stock', '>', 0);
        }
        else{
            $query = $query->where('stock', '=', 0);
        }
    }

    $title = $request->input('title');
    if ($title != null){
        $query = $query
            ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])
            ->orderByRaw('ts_rank(search,  plainto_tsquery(\'english\',?) DESC',[$title]);
    }

    $products = $query->get();
    return $products;
  }

  public static function getDiscountedProducts(){
    return DB::table('product')->whereNotNull('discountprice')->get();
  }

  public static function getProductByName(String $title){
    $products = DB::table('product')
       ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])->get();
    return $products;
  }

}
