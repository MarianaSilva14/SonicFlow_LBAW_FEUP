<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = null; // or null

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_idparent' , 'comment_idchild'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answer';
}
