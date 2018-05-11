<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $primaryKey = null; // or null

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['purchase_idpurchase', 'product_idproduct', 'price', 'quantity']; // or null

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_product';
}