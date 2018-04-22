<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    protected $primaryKey = 'sku'; // or null

    public $incrementing = false;

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

}
