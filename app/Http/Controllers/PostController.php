<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
Carbon::setLocale('fr');

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $followed = User::find($user->id)->follows;

        $request = new Request();
        $request->post('id',$user->id);
        $result = $this->getPersonalTweet($request);
        $data = ['tweet' => [], "users" => []];

        foreach ($result['tweet'] as $tweets)
        {
            foreach ($tweets as $tweet)
            {
                array_push($data['tweet'],$tweet);
            }

        }

        foreach ($result['users'] as $users)
        {
            foreach ($users as $user)
            {
                array_push($data['users'],$user);
            }
        }

        foreach ($followed as $follow)
        {
            $follow->user_followed;
            $posts = User::find($follow->user_followed)->posts;

            $users = [];
            foreach ($posts as $key => $post)
            {
                $id =  $post->user_id;
                $user = User::find($id);
                $personalTweet = false;
                if($user->id == $id)
                {
                    $personalTweet = true;
                }
                array_push($users,$user);
                $date = new Carbon($posts[$key]['tweet_date']);
                $posts[$key]['tweet_date'] = $date->diffForHumans();
                $posts[$key]['personal'] = $personalTweet;

                $posts = json_decode(json_encode($posts), true);

                array_push($data['tweet'],$post);
                array_push($data['users'],$user);

            }
        }

        return json_encode(['status' => 'success', 'data' => $data]);
    }

    public function getPersonalTweet(Request $request)
    {
        if($request->id != null)
        {
            $id = $request->id;
        }
        else
        {
            $user = Auth::user();
            $id = $user->id;
        }

        $posts = User::find($id)->posts;
        $users = [];
        $data = ['tweet' => [], "users" => []];
        foreach ($posts as $key => $post)
        {
            $id =  $post->user_id;
            $user = User::find($id);
            $personalTweet = false;
            if($user->id == $id)
            {
                $personalTweet = true;
            }
            array_push($users,$user);
            $date = new Carbon($posts[$key]['tweet_date']);
            $posts[$key]['tweet_date'] = $date->diffForHumans();
            $posts[$key]['personal'] = $personalTweet;


        }

        $posts = json_decode(json_encode($posts), true);

        array_push($data['tweet'],$posts);
        array_push($data['users'],$users);

        return $data;

    }

    public function sendTweet(Request $request)
    {
        $userId = Auth::user()->id;
        $message = $request->message;
        $message = filter_var($message, FILTER_SANITIZE_STRING);

        $post = new Post;

        $post->message = $message;
        $post->tweet_date = Carbon::now();
        $post->user_id = $userId;

        $post->save();

        $date_tweet = new Carbon($post->tweet_date);
        $user = Auth::user();

        $tweet = ['id' => $post->id,'message' => $post->message, 'tweet_date' => $date_tweet->diffForHumans(),'user_id' => $post->user_id];
        $user = ['id' => $user->id, 'name' => $user->name, 'username' => $user->username, 'avatar' => $user->avatar];

        $data = ['tweet' => $tweet,'user' => $user];

        return ["status" => "success", "data" => $data];

    }
}
