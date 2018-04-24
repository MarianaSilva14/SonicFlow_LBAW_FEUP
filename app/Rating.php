<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['customer_username','product_idproduct']; // or null

    protected $fillable = ['customer_username','product_idproduct', 'value']; // or null

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rating';

}
