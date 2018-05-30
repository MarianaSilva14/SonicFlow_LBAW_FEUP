<?php
/**
 * Created by PhpStorm.
 * User: xfontes
 * Date: 01-05-2018
 * Time: 17:41
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    protected $primaryKey = 'user_username'; // or null

    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moderator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_username'
    ];

    // Don't add create and update timestamps in database.
    public $timestamps = false;
}