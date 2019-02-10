@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="feed card">
                <div class="card-body">
                    <div class="tweet-area">
                        <form id="formSendTweet" method="post" action="{{route('sendTweet')}}">

                            <div class="form-group row mb-0" id="tweet-layout">
                                <div class="col-md-1">
                                    <img  class="profile-picture-small left-position" src="{{asset('storage/avatars/'.$avatar)}}">
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control" id="tweet-text-area" rows="3" id="message" name="message" placeholder="Quoi de neuf ?"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 align-right">
                                    <button type="submit" class="btn-submit" id="sendTweet">
                                        {{ __("Tweeter") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="timeline"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="{{asset("js/main.js")}}"></script>
@endsection
<style>
    body {
        background: #e6ecf0;
    }

    .card-body {
        padding: 0 !important;
    }
    
    .feed {
        background: #e8f5fd!important;
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

    .left-position {
        margin-left: 20px;
        margin-top: 10px;
    }

    #tweet-layout {
        margin-top: 15px;
        margin-right: 10px;
    }

    #tweet-text-area {
        border: solid 1px #e3e7ed;
        border-radius: 15px;
        resize: none;
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

    #sendTweet {
        margin-left: 15px;
        margin-right: 35px;
        margin-top: 5px;

    }

    .align-right {
        text-align: right;
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

</style>
