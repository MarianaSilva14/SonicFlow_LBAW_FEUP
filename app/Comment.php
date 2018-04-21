<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'id'; // or null

    //public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment';

    public function user(){
      return $this->belongsTo('App\User','user_username','username');
    }

    public function answers(){
      return $this->hasManyThrough('App\Comment','App\Answer','comment_idparent','id','id','comment_idchild');
    }
}
