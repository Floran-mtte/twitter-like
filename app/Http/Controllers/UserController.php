<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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

    public function uploadAvatar(Request $request)
    {
        /*$request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);*/

        $user = Auth::user();


        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;

        $user->save();

        return true;
    }
}
