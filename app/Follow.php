<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    protected $fillable = [
        'user_following', 'user_followed',
    ];

    public function userFollowing() {
        return $this->belongsTo(User::class,'user_following');
    }

    public function userFollowed() {
        return $this->belongsTo(User::class,'user_followed');
    }
}
