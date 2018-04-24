<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    if ($this->deleted) {
      return;
    }
    $this->increment('flagsno');
    $query = DB::table('flagged');
    if($query->whereRaw('flagged.comment_idcomment = '.$this->id)->exists()){
      $query->update(['hidden'=>FALSE]);
    }else{
      $query->insert(['comment_idcomment' => $this->id, 'hidden' => FALSE]);
    }
  }

  public function deleteContentMod(){
    DB::table('flagged')
      ->where('hidden',FALSE)
      ->where('comment_idcomment',$this->id)
      ->update(['hidden'=>TRUE]);
    $this->deleted = 'true';
    $this->save();
  }

  public function deleteContentCust(){
    DB::table('flagged')
      ->where('comment_idcomment',$this->id)
      ->delete();
    $this->deleted = 'true';
    $this->save();
  }

  public function approve(){
    DB::table('flagged')
      ->where('comment_idcomment',$this->id)
      ->update(['hidden'=>TRUE]);
  }

  public static function getModView(){
    return DB::table('comment')
              ->join('flagged','comment.id','=','flagged.comment_idcomment')
              ->whereRaw('flagged.hidden = FALSE')
              ->join('user','user.username','=','comment.user_username')
              ->select('user.picture','user.username','comment.commentary','comment.flagsno','comment.id')
              ->get();
  }

  public function user(){
    return $this->belongsTo('App\User','user_username','username');
  }

  public function answers(){
    return $this->hasManyThrough('App\Comment','App\Answer','comment_idparent','id','id','comment_idchild');
  }
}
