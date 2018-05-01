<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
  protected $primaryKey = 'user_username'; // or null

  public $incrementing = false;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'customer';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_username', 'name', 'address', 'loyaltypoints', 'newsletter', 'inactive'
  ];

  // Don't add create and update timestamps in database.
  public $timestamps = false;

  public function firstName(){
    return explode(' ',$this->name,2)[0];
  }

  public function lastName(){
    return explode(' ',$this->name,2)[1];
  }

  public function ban(){
    DB::table('banned')->insert(['customer_username_customer' => $this->user_username, 'moderator_username_moderator' => Auth::user()->username]);
  }

  public static function getUsersBanned(){
    return DB::table('banned')
              ->join('user','banned.customer_username_customer','=','user.username')
              ->join('moderator','banned.moderator_username_moderator','=','moderator.user_username')
              ->get();
  }


  public function toggleFavorite($sku){
    $exists = DB::table('favorite')->where([['customer_username', '=', Auth::user()->username],['product_idproduct', '=', $sku]])->exists();
    if(!$exists){
      DB::table('favorite')->insert(['customer_username' => Auth::user()->username, 'product_idproduct' => $sku]);
      return true;
    }else{
      DB::table('favorite')->where([['customer_username', '=', Auth::user()->username],['product_idproduct', '=', $sku]])->delete();
      return false;
    }
  }

  /**
   * The user this customer belongs to.
   */
  public function user() {
      return $this->belongsTo('App\User');
  }

  public function favoritesList(){
    return $this->belongsToMany('App\Product','favorite','customer_username', 'product_idproduct');
  }
}
