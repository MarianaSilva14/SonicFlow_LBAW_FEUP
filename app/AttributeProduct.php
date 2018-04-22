<?php
/**
 * Created by PhpStorm.
 * User: xfontes
 * Date: 22-04-2018
 * Time: 15:33
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{

    protected $primaryKey = null; // or null

    //public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_idattribute' , 'product_idproduct', 'value'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attribute_product';


}