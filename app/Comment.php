<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $primaryKey = 'id'; // or null

    public $incrementing = true;

    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_username', 'commentary', 'date', 'flagsno' , 'deleted', 'product_idproduct'
    ];

    public function flag(){
      $this->increment('flagsno');
      $query = DB::table('flagged');
      if($query->whereRaw('flagged.comment_idcomment = '.$this->id)->exists()){
        $query->update(['hidden'=>FALSE]);
      }else{
        $query->insert(['comment_idcomment' => $this->id, 'hidden' => FALSE]);
      }
    }

    public function deleteContent(){
      if (Auth::user()->isCustomer()) {
        $this->authorize();
      }
      $this->deleted = 'true';
      $this->save();
    }

    public function addOffense(){
      DB::table('flagged')
        ->where('');
    }

    public static function getModView(){
      return DB::table('comment')
                ->join('flagged','comment.id','=','flagged.comment_idcomment')
                ->whereRaw('flagged.hidden = FALSE')
                ->join('user','user.username','=','comment.user_username')
                ->select('user.picture','user.username','comment.commentary','comment.flagsno')
                ->get();
    }

    public function user(){
      return $this->belongsTo('App\User','user_username','username');
    }

    public function answers(){
      return $this->hasManyThrough('App\Comment','App\Answer','comment_idparent','id','id','comment_idchild');
    }
}
