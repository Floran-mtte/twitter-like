<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = User::find($user->id)->posts;
        var_dump($posts);
    }

    public function sendTweet(Request $request)
    {
        $userId = Auth::user()->id;
        $message = $request->message;

        $post = new Post;

        $post->message = $message;
        $post->tweet_date = Carbon::now();
        $post->user_id = $userId;

        $post->save();

        return back()->with('success','Tweet posté avec succès.');


    }
}
