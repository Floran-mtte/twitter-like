<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\PostController;
Carbon::setLocale('fr');

class UserController extends Controller
{

    public function profile()
    {
        if(Auth::check()) {
            $id = Auth::id();
            $user = User::find($id);
            $data = ['id' => $user->id, 'username' => $user->username, 'name' => $user->name, 'email' => $user->email, 'avatar' => $user->avatar];

            return view('account.profile',$data);
        }
    }

    public function editProfile(Request $request)
    {
        if(Auth::check())
        {
            $result = true;

            if($request->avatar != "")
            {
                $result = $this->uploadAvatar($request);
            }

            if($result)
            {
                $user = Auth::user();

                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;

                if($request->password != "")
                {
                    $user->password = bcrypt($request->password);
                }

                $user->save();

                return back()->with('success','Modifications effectuées avec succès.');

            }
            else
            {
                return back()->with('failed','Problème lors de l\`upload de votre photo de profil veuillez réessayer.');
            }
        }

    }

    public function displayProfile(Request $request)
    {
        if(Auth::check())
        {
            $username = $request->username;
            $user_profile = User::where('username', '=' ,$username)->firstOrFail();

            $following = User::find($user_profile->id)->follows;
            $following_count = count($following);

            $followed = User::find($user_profile->id)->followed;
            $id_connected_user = Auth::id();
            $isFollow = false;

            foreach ($followed as $f)
            {
                if($id_connected_user == $f->user_following)
                {
                    $isFollow = true;
                }
            }
            $followed_count = count($followed);

            $posts = User::find($user_profile->id)->posts;
            $count = count($posts);

            $convert_date = ['1' => 'Janvier', '2' => 'Février', '3' => 'Mars', '4' => 'Avril', '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Aout',
                '9' => 'Septembre',
                '10' => 'Octobre',
                '11' => 'Novembre',
                '12' => 'Décembre'
            ];

            $signup_date =  Carbon::createFromFormat('Y-m-d H:i:s',$user_profile->created_at);
            $signup_date = $convert_date[$signup_date->month].' '.$signup_date->year;

            $data = [
                'id' => $user_profile->id,
                'name' => $user_profile->name,
                'username' => $user_profile->username,
                'avatar' => $user_profile->avatar,
                'signup_date' => $signup_date,
                'count' => $count,
                'followingCount' => $following_count,
                'followedCount' => $followed_count,
                'connectUser' => $id_connected_user,
                'followed' => $isFollow
            ];

            return view('userProfile',$data);
        }

    }

    public function uploadAvatar(Request $request)
    {
        /*$request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);*/

        if(Auth::check())
        {
            $user = Auth::user();


            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            $request->avatar->storeAs('avatars',$avatarName);

            $user->avatar = $avatarName;

            $user->save();

            return true;
        }

    }
}
