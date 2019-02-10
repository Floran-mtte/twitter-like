<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function getFollowing(Request $request)
    {
        $id = $request->id;
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

    public function getFollowers(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);

        $following = User::find($user->id)->followed;
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
