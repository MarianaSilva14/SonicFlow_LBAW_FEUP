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

    public function firstName(){
      return explode(' ',$this->name,2)[0];
    }

    public function lastName(){
      return explode(' ',$this->name,2)[1];
    }

    /**
     * The user this customer belongs to.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}
