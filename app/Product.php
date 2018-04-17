<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

}
