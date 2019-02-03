@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mon compte') }}</div>
                <div class="card-body">

                    <form method="post" action="{{route('updateProfile')}}" enctype="multipart/form-data">

                        <div class="avatar col-centered">
                            @if( $avatar != 'user_default.png' )
                                <img class="profile-picture" src="{{asset('storage/avatars/'.$avatar)}}" height="200" width="200">
                            @else
                                <img class="profile-picture" src="{{asset('images/user_default.png')}}" height="200" width="200">
                            @endif

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 col-centered">
                                <label for="name">Nom</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{$name}}" required autofocus placeholder="Nom et prénom">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 col-centered">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{$username}}" required autofocus placeholder="Pseudo">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 col-centered">
                                <label for="email">E-mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required autofocus placeholder="Adresse E-mail">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('e
                                        mail') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-centered">
                                <label for="password">Mot de passe</label>
                                <input id="password" type="password" class="form-control" name="password" autofocus placeholder="New password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-centered">
                                <label for="avatar">Avatar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 col-centered-left">
                                <button type="submit" class="btn-submit">
                                    {{ __("Sauvegarder") }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background: grey;
    }

    .card-header  {
        font-size: 20px;
        font-weight: bold;
    }

    .col-centered {
        margin: 0 auto;
        float: none;
    }

    .col-centered-left {
        position: relative;
        left: -30px;
    }

    .avatar {
        text-align: center;
    }

    .profile-picture {
        width: 100px;
        height: 100px;
        border: 1px solid grey;
        border-radius: 100px;
    }

    .btn-submit {
        background-color: rgb(29, 161, 242);
        color: rgb(255, 255, 255);
        border-width: 1px;
        border-style: solid;
        border-color: rgb(29, 161, 242);
        border-image: initial;
        border-radius: 100px;
        box-shadow: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        line-height: 20px;
        padding: 6px 16px;
        position: relative;
        text-align: center;
        white-space: nowrap;
    }

</style>
