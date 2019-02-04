<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id','message','tweet_date','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
