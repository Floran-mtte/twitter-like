@extends('layouts.app')

@section('content')
    <div class="banner">
        <div class="profile-picture-nav"><img class="profile-picture-large" src="{{asset('storage/avatars/'.$avatar)}}"></div>
    </div>

    <div class="sub-nav">
        <div class="nav-content">
            <ul class="nav-menu">
                <li class="active nav-item" id="tweet">Tweets<div class="value-menu">{{ $count }}</div></li>
                <li class="nav-item" id="following">Abonnements<div class="value-menu">{{ $followingCount }}</div></li>
                <li class="nav-item" id="followed">Abonnés<div class="value-menu">{{ $followedCount }}</div></li>
            </ul>
            @if($id == $connectUser)
                <a class="editProfile" href="/account">Editez votre profil</a>
            @else
                @if($followed)
                    <button class="follow-btn" data-type="unfollow">Abonné</button>
                @else
                    <button class="follow-btn" data-type="follow">Suivre</button>
                @endif
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="infos">
                    <input id="id_user" type="text" value="{{$id}}" hidden>
                    <div class="user-name">{{ $name }}</div>
                    <div class="user-username"><a href="#">{{ '@'.$username }}</a></div>
                    <div class="signup-date"><img class="calendar-icon" src="{{asset('/images/icons/calendar.png')}}"> Inscrit en {{ $signup_date }}</div>
                </div>
            </div>

            <div class="col-md-8 content-layout">

                <div class="feed card">
                    <div class="card-body">
                        <div class="timeline">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="{{asset("js/profile.js")}}"></script>

<style>
    body {
        background: #e6ecf0;
    }
    .justify-content-center {

    }
    .banner {
        margin: 0;
        background: #1da1f2;
        width: 100%;
        height: 175px;
    }

    .sub-nav {
        display: inline-flex;
        width: 100%;
        height: 60px;
        background: #FFFFFF;
    }

    .nav-content {
        width: 39%;
        margin:auto;
    }

    .nav-menu {
        margin-top: 10px;
        list-style-type: none;
        display: inline-flex;
    }

    .nav-item {
        cursor: pointer;
        margin-right: 15px;
        color: #657786;
        font-weight: bold;
        font-size: 12px;
        letter-spacing: .02em;
        transition: color .15s ease-in-out;
    }

    .nav-item:hover {
        border-bottom: 2px solid #1da1f2;
    }

    .nav-item:hover .value-menu {
        color: #1da1f2;
    }

    .value-menu {
        text-align: center;
        font-size: 18px;
    }

    .active .value-menu{
        color: #1da1f2;
    }

    .active {
        border-bottom: 2px solid #1da1f2;
    }

    .card-body {
        padding: 0 !important;
    }

    .profile-picture-nav {
        width: 10%;
        position: relative;
        top: 70px;
        left: 330px;
    }

    .content-layout {
        margin-top: 20px;
        margin-left: 40px;
    }

    .profile-picture-large {
        width: 200px;
        height: 200px;
        border: 5px solid #fff;
        border-radius: 50%;
    }

    .editProfile {
        float: right;
        margin-top: 10px;
        color: rgb(255, 255, 255);
        border-width: 1px;
        border-style: solid;
        border-color: grey;
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
        background: #b8bec6;
    }

    .editProfile:focus {
        outline: none;
    }

    .editProfile:hover {
        color: white;
        text-decoration: none;
    }

    .follow-btn {
        float: right;
        margin-top: 10px;
        color: #0084B4;
        background-color: #fff;
        border: 1px solid #1da1f2;
        font-size: 14px;
        line-height: 20px;
        padding: 6px 30px;
        white-space: nowrap;
        text-align: center;
        border-radius: 100px;
        box-shadow: none;
        cursor: pointer;
        font-weight: bold;
        outline-style: none;
    }

    .follow-btn:hover {
        background: #E5F2F7;
    }

    .follow-btn:focus {
        outline: none;
    }

    .infos {
        margin-top: 60px;
    }

    .user-name {
        font-weight: bold;
        font-size: 20px;
    }

    .user-username a{
        color: #657786;
        font-size: 15px;
    }

    .signup-date {
        margin-top: 10px;
        color: #657786;
        display: flex;
        align-items: center;
    }
    .calendar-icon {
        margin-right: 4px;
    }

    .feed {
        background: #e6ecf0!important;
        border: none !important;
    }

    .profile-picture-small {
        width: 32px;
        height: 32px;
        border: 1px solid grey;
        border-radius: 100px;
    }

    .profile-picture-medium {
        width: 48px;
        height: 48px;
        border: 1px solid grey;
        border-radius: 100px;
    }

    .avatar-small {
        margin-top: 10px;
    }

    .follow-row {
        display: inline-flex;
        margin-right: 10px;
        text-align: center;
    }

    .left-position {
        margin-left: 20px;
        margin-top: 10px;
    }

    #tweet-layout {
        margin-top: 15px;
        margin-right: 10px;
    }

    .tweet {
        background: white;
        border-bottom: 1px solid #e3e7ed;
        padding: 15px;
    }

    .tweet:hover {
        background: #f5f8fa;
    }

    .tweet-head {
        margin-left: 5px;
    }

    .tweet-content {
        margin-top: -17px;
        margin-left: 55px;
    }

    .icon {
        cursor: pointer;
    }

    .caret-down {
        float: right;
    }

    .profile-picture {
        position: relative;
        top: 10px;
        right: 4px;
    }

    .full-name {
        font-weight: bold;
    }

    .username {
        margin-left: 2px;
        letter-spacing: -0.02em;
    }

    .custom-dropdown {
        display: none;
        float: right;
        position: relative;
        top: 20px;
        left: 75px;
        width: 15%;
        border: 1px solid #e3e7ed;
        background: white;
    }

    .custom-dropdown-menu {
        padding: 5px;
        text-align: center;
        cursor: pointer;
    }

    .custom-dropdown-menu:hover {
        background: #1da1f2;
        color: #fff;
    }

    .

</style>
