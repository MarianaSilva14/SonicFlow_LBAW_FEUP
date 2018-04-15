<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'username'; // or null

    public function getName(){
        $customer = DB::table('customer')->select('name')->where('user_username', $this->username)->first();
      return json_decode(json_encode($customer), true)['name'];
    }

    public function getPicture(){
        return $this->picture;
    }

    public function isCustomer(){
        return DB::table('customer')->where('user_username', $this->username).$this->exists();
    }

    public function isAdmin(){
        return DB::table('administrator')->where('user_username', $this->username).$this->exists();
    }

    public function isModerator(){
        return DB::table('moderator')->where('user_username', $this->username).$this->exists();
    }

    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';


    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The customer this user is.
     */
     public function getCustomer() {
      return $this->hasOne('App\Customer');
    }
}
