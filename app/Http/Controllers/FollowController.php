<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function getFollowing(Request $request)
    {
        if(Auth::check())
        {
            $id = $request->id;
            //var_dump($id);
            $user = User::findOrFail($id);

            $following = User::find($user->id)->follows;
            $data = ['users' => []];

            foreach ($following as $follow)
            {
                $user_id = $follow->user_followed;

                $user = User::find($user_id);
                array_push($data['users'], $user);
            }

            $response = ['status' => 'success','data' => $data];
            return json_encode($response);
        }


    }

    public function getFollowers(Request $request)
    {
        if(Auth::user())
        {
            $id = $request->id;
            $user = User::findOrFail($id);

            $following = User::find($user->id)->followed;
            $data = ['users' => []];

            foreach ($following as $follow)
            {
                $user_id = $follow->user_following;

                $user = User::find($user_id);
                array_push($data['users'], $user);
            }

            $response = ['status' => 'success','data' => $data];
            return json_encode($response);
        }

    }

    public function unfollow(Request $request)
    {
        if(Auth::user())
        {
            $id_user = Auth::id();
            $id_following = $request->id_following;

            $follow = Follow::where('user_following',$id_user)->where('user_followed',$id_following);

            $follow->delete();

            return ['status' => 'success'];
        }

    }

    public function follow(Request $request)
    {
        if(Auth::user())
        {
            $id_user = Auth::id();
            $id_following = $request->id_following;

            $follow = new Follow();

            $follow->user_following = $id_user;
            $follow->user_followed = $id_following;

            $follow->save();

            return ['status' => 'success'];
        }

    }

}
