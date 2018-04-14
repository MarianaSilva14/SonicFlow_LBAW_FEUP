<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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


    // Don't add create and update timestamps in database.
    public $timestamps = false;

    /**
     * The user this customer belongs to.
     */
    public function card() {
        return $this->belongsTo('App\User');
    }

}