@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="feed card">
                <div class="card-body">
                    <div class="tweet-area">
                        <form method="post" action="{{route('sendTweet')}}">

                            <div class="form-group row mb-0">
                                <div class="col-md-1">
                                    <img  class="profile-picture-small" src="{{asset('storage/avatars/'.$avatar)}}">
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control" id="tweet" rows="3" id="message" name="message" placeholder="Quoi de neuf ?"></textarea>
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
    
    .feed {
        background: #e8f5fd!important;
    }

    .profile-picture-small {
        width: 32px;
        height: 32px;
        border: 1px solid grey;
        border-radius: 100px;
    }

    textarea {
        border: solid 1px black;
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

    #sendTweet {
        margin-top: 5px;

    }

    .align-right {
        text-align: right;
    }

</style>
