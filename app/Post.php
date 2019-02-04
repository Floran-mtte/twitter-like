<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id','message','tweet_date','user_id'];
    public $timestamps = false;


    public function users() {
        return $this->belongsTo(User::class);
    }
}
