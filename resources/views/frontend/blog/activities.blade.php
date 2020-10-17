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
            /* position: absolute;
            top: 36%;
            left: 50%;
            transform: translate(-50%, -50%); */
            font-size: 2.5vw;
            font-family: 'Courgette';
            font-weight: 550;
            letter-spacing: 3px;
            width: 90%;
            /* white-space: nowrap; */
            /* text-overflow: ellipsis; */
            /* overflow: hidden; */
            /* margin: 0 auto; */
            filter: drop-shadow(2px 4px 6px black);
            text-shadow: 2px 4px 6px #000;
            /* border: 1px solid red; */
            text-align: center;
            flex: 50%;
            vertical-align: middle;
            align-self: center;
            justify-self: flex-end;
            display: flex;
            justify-content: center;
            align-items: center;
            line-height: 1;
        }

        .friend-name {
            font-size: 2.5vw;
            flex: 1;
            width: 95%;
        }

        .friend-address {
            font-size: 1vw;
            margin: 0 16%;
            margin-top: 2%;
        }

        .friend-details {
            display: flex;
            width: 100%;
            height: 100%;
            position: absolute;
            flex-flow: column;
            align-items: center;
            justify-content: space-around;
            text-align: center;
            word-break: break-word;
            display: none;
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
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            display: none;
        }

        .blog-summary {
            /* position: absolute;
            top: 34%;
            left: 50%;
            transform: translate(-50%, -50%); */
            width: 60%;
            /* text-align: center; */
        }

        .blog-date {
            /* position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%); */
            color: #979595;
        }

        .blog-tags {
            /* position: absolute;
            top: 68%;
            left: 50%;
            transform: translate(-50%, -50%); */
            color: #979595;
            font-family: Arial;
            font-size: 0.7vw;
            width: 19vw;
        }

        .friend-details-2 a {
            /* position: absolute;
            top: 86%;
            left: 50%;
            transform: translate(-50%, -50%); */
            color: #0bbbb5;
        }

        .tags {
            list-style: none;
            margin: 0;
            /* overflow: hidden; */
            padding: 0;
            display: -webkit-box;   /* OLD - iOS 6-, Safari 3.1-6, BB7 */
            display: -ms-flexbox;  /* TWEENER - IE 10 */
            display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
                -ms-flex-flow: row wrap;
                    flex-flow: row wrap;
            justify-content: center;            
            /* flex-wrap: wrap;   */
        }

        .tags li {
            /* float: left;  */
        }

        .tag {
            background: #2d3339;
            border-radius: 3em;
            color: #999;
            /* display: inline-block; */
            /* height: 26px; */
            line-height: 2.5em;
            padding: 0% 5%;
            /* position: relative; */
            margin: 0 2% 2% 0;
            text-decoration: none;
            white-space: nowrap;
            text-shadow: none;
        }
    </style>
@endsection

@section('content')
<div id="page-content">
<div class="container">
    <div class="app">
        <earthlings-activities :user="{{ Auth::user() }}"></earthlings-activities>
    </div>
</div>
</div>
@endsection

@section('before-scripts')
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
	<script src="{{asset('front/JS/blackhole.js')}}"></script>
@endsection

