<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

  protected $primaryKey = 'sku'; // or null

  public $incrementing = false;

  public $timestamps = false;
  protected $fillable = ['sku','title','category_idcat','price','discountprice','rating','stock','description','search','picture']; // or null

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product';

  public function favoritesList(){
    return $this->belongsToMany('App\Customer','favorite','product_idproduct','customer_username');
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

  public function isFavorite(){
    if(Auth::check()){
      return DB::table('favorite')
        ->where([['customer_username',Auth::user()->username],['product_idproduct',$this->sku]])
        ->exists();
    }else{
      return FALSE;
    }
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

    $limit = intval($request->input('limit'));
    if ($limit != null){
      $query = $query->limit($limit);
    }

    $offset = intval($request->input('offset'));
    if($offset != null){
      $query = $query->offset($offset);
    }

    $products = $query->get();
    return $products;
  }

  public static function getProductByName(String $title){
    $products = DB::table('product')
       ->whereRaw('search @@ plainto_tsquery(\'english\',?)', [$title])->get();
    return $products;
  }

  public static function getDiscountedProducts(Request $request){
    $query = DB::table('product');

    $query->selectRaw('* , (price - discountprice)/price AS rank');
    $query->whereNotNull('discountprice');
    $query->orderBy('rank', 'desc');

    /*      -- Get discounted products
    SELECT * , (P.price - P.discountprice)/P.price AS rank
    FROM product P
    WHERE 	P.discountprice IS NOT NULL
    ORDER BY rank DESC
    LIMIT $limit;*/

    $limit = intval($request->input('limit'));
    if ($limit != null){
        $query = $query->limit($limit);
    }
    $products = $query->get();
    return $products;

  }

  public static function getRecommendationsProducts(Request $request){
      $query = DB::table('product');

      $query->orderBy('rating', 'desc');

      /*      -- Get products with higher rating
      SELECT *
      FROM product P
      ORDER BY rating DESC
      LIMIT $limit;*/

      $limit = intval($request->input('limit'));
      if ($limit != null) {
          $query = $query->limit($limit);
      }
      $products = $query->get();
      return $products;

  }

  public static function getBestSellersProducts(Request $request){
    $query = DB::table('product');

    $query->selectRaw('product.* , SUM(purchase_product.quantity) AS sumQ');
    $query->join('purchase_product', 'product.sku', '=', 'purchase_product.product_idproduct');
    $query->groupBy('product.sku');
    $query->orderByRaw('sumQ DESC');
    /*      -- Get best selling products
    SELECT P.*, SUM(PP.quantity) as sum
    FROM product P, purchase_product PP
    WHERE P.sku = PP.product_idproduct
    GROUP BY P.sku
    ORDER BY sum DESC
    */


    $limit = intval($request->input('limit'));
    if ($limit != null){
        $query = $query->limit($limit);
    }
    $products = $query->get();
    return $products;
  }
}
