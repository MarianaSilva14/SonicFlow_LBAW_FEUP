<?php

namespace App;


class Favorite
{
    protected $primaryKey = null; // or null

    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'favorite';


    public function customers(){
        return $this->hasMany('App\Customer','user_username');
    }

    public function products(){
        return $this->hasMany('App\Product','product_idproduct');
    }
}