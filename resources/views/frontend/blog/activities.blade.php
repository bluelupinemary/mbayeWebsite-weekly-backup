@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/CSS/search-friends.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/friends.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/blackhole.css')}}">
    <style>
        #search-friends {
            height: 6.2vw;
            width: 50%;
        }

        .main-friends.with-background {
            z-index: -1;
        }

        img#blog-img {
            width: 100%;
            transform: scale(1.8);
        }

        .friends {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .friends.zoom-in {
            animation: none;
        }

        .friends.zoom-in:hover {
            animation: sunpulse 1s alternate infinite;
        }

        .blog-title {
            position: absolute;
            top: 36%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.5vw;
            font-family: 'Courgette';
            font-weight: 550;
            letter-spacing: 5px;
            width: 90%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            margin: 0 auto;
            filter: drop-shadow(2px 4px 6px black);
            text-shadow: 2px 4px 6px #000;
            /* border: 1px solid red; */
            text-align: center;
        }

        .friend-name {
            font-size: 2.5vw;
            top: 77%;
        }

        .friend-address {
            top: 87%;
            font-size: 1vw;
        }

        .friend-details {
            height: 100%;
            width: 100%;
            position: absolute;
        }

        .friend-details-2 {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #0f2c55b0;
            font-family: Courgette;
            color: #fff;
            filter: drop-shadow(2px 4px 6px black);
            text-shadow: 2px 4px 6px #000;
            text-align: center;
            display: none;
        }

        .blog-summary {
            position: absolute;
            top: 34%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            text-align: center;
        }

        .blog-date {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #979595;
        }

        .blog-tags {
            position: absolute;
            top: 68%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #979595;
            font-family: Arial;
            font-size: 0.9vw;
        }

        .friend-details-2 a {
            position: absolute;
            top: 86%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #0bbbb5;
        }
    </style>
@endsection

@section('content')
<div id="page-content">
<div class="container">
    <div class="app">
        <earthlings-activities :auth="{{ Auth::user() }}"></earthlings-activities>
    </div>
</div>
</div>
@endsection

@section('before-scripts')
	<script src="{{asset('front/JS/blackhole.js')}}"></script>
@endsection

