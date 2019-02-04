@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="feed card">
                <div class="card-body">
                    <div class="tweet-area">
                        <form method="post" action="#">
                            <div class="form-group row mb-0">
                                <div class="col-md-1">
                                    <img  class="profile-picture-small" src="{{asset('storage/avatars/'.$avatar)}}">
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control" id="tweet" rows="3" placeholder="Quoi de neuf ?"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

</style>
