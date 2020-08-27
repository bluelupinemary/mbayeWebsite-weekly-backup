@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>
        .sample-btn {
            position: absolute;
            left: 35.5%;
            top: 38%;
            /* transform: translate(-198%, -94%); */
            /* -webkit-filter: drop-shadow(5px 5px 5px #222); */
            /* filter: drop-shadow(1px 1px 7px #17a2b8); */
            color: #17a2b8;
            /* -webkit-transition: all 0.06s ease-out;
            transition: all 0.06s ease-out; */
            transition: all 0.06s ease-out;
            /* transform: translate3d(0px, 2px, 10px); */
        }

        .sample-btn:active {
            /* transform: translate3d(0px, 2px, 10px);
            -webkit-filter: drop-shadow(5px 5px 5px #222); 
            filter: drop-shadow(1px 1px 7px #17a2b8); */
            /* &:before {
            top:0;
            box-shadow: 0 3px 3px rgba(0,0,0,.7),0 3px 9px rgba(0,0,0,.2);
        
            } */
        }

        .shadow {
            transform: translate3d(0px, 5px, 10px);
            -webkit-filter: drop-shadow(1px 0px 5px #17a2b8);
            filter: drop-shadow(1px 0px 5px #17a2b8);
        }
        
        .sample-btn:before {
            display: inline-block;
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            z-index: -1;
            top: 6px;
            border-radius: 5px;
            height: 49px;
            background: linear-gradient(to top, #183b0d 0%, #183b0d 6px);
            -webkit-transition: all 0.078s ease-out;
            transition: all 0.078s ease-out;
            box-shadow: 0 1px 0 2px rgba(0, 0, 0, 0.3), 0 5px 2.4px rgba(0, 0, 0, 0.5), 0 10.8px 9px rgba(0, 0, 0, 0.2);
        }

        video {
            border: 1px solid red;
        }

        iframe {
            volume: silent;
        }

        .main-body {
            height: 100vh;
            width: 100%;
            /* background: -webkit-gradient(linear, left top, left bottom, from(#b4b2b2), color-stop(70%, #b4b2b2), to(#f5f5f5)); */
            /* background: linear-gradient(to bottom, #b4b2b2 0%, #b4b2b2 70%, #f5f5f5 100%); */
            overflow: hidden;
            background: #00000040;
        }

        .rocket {
            position: relative;
            top: 50%;
            /* bottom: 0; */
            width: 80px;
            left: 50%;
            transform: translate(0, -15%);
            transition: 1s;
        }
        .rocket.launch {
            transform: translate(0, -350%);
        }
        .rocket.launch .rocket-body {
            animation: none;
        }
        .rocket .rocket-body {
        width: 80px;
        left: calc(50% - 50px);
        -webkit-animation: bounce 0.5s infinite;
                animation: bounce 0.5s infinite;
        }
        .rocket .rocket-body .body {
            background-color: #d11c40;
            height: 180px;
            left: calc(50% - 50px);
            border-top-right-radius: 100%;
            border-top-left-radius: 100%;
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
            border-top: 5px solid #5b595d;
        }
        .rocket .rocket-body:before {
            content: '';
            position: absolute;
            left: calc(50% - 24px);
            width: 48px;
            height: 13px;
            background-color: #5b595d;
            bottom: -13px;
            border-bottom-right-radius: 60%;
            border-bottom-left-radius: 60%;
        }
        .rocket .window {
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 100%;
            background-color: #7f0e27;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -131%);
            border: 5px solid #f8f9fa;
        }
        .rocket .fin {
            position: absolute;
            z-index: -100;
            height: 55px;
            width: 50px;
            background-color: #7f0e27;
        }
        .rocket .fin-left {
        left: -30px;
        top: calc(100% - 55px);
        border-top-left-radius: 80%;
        border-bottom-left-radius: 20%;
        }
        .rocket .fin-right {
        right: -30px;
        top: calc(100% - 55px);
        border-top-right-radius: 80%;
        border-bottom-right-radius: 20%;
        }
        .rocket .exhaust-flame {
        position: absolute;
        top: 90%;
        width: 28px;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(10%, transparent), to(#f5f5f5));
        background: linear-gradient(to bottom, transparent 10%, #f5f5f5 100%);
        height: 150px;
        left: calc(50% - 14px);
        -webkit-animation: exhaust 0.2s infinite;
                animation: exhaust 0.2s infinite;
        }
        .rocket .exhaust-flame2 {
        position: absolute;
        top: 50%;
        width: 28px;
        height: 130px;
        left: 50%;
        transition: height 1s linear;
        transform: translateX(-50%);
        animation: flyExhaust .2s infinite;
        z-index: -1;
        background: transparent;
        }
        .rocket .exhaust-fumes li {
        width: 60px;
        height: 60px;
        background-color: #f5f5f5;
        list-style: none;
        position: absolute;
        border-radius: 100%;
        }
        .rocket .exhaust-fumes li:first-child {
        width: 200px;
        height: 200px;
        bottom: -300px;
        -webkit-animation: fumes 5s infinite;
                animation: fumes 5s infinite;
        }
        .rocket .exhaust-fumes li:nth-child(2) {
        width: 150px;
        height: 150px;
        left: -120px;
        top: 260px;
        -webkit-animation: fumes 3.2s infinite;
                animation: fumes 3.2s infinite;
        }
        .rocket .exhaust-fumes li:nth-child(3) {
        width: 120px;
        height: 120px;
        left: -40px;
        top: 330px;
        -webkit-animation: fumes 3s 1s infinite;
                animation: fumes 3s 1s infinite;
        }
        .rocket .exhaust-fumes li:nth-child(4) {
        width: 100px;
        height: 100px;
        left: -170px;
        -webkit-animation: fumes 4s 2s infinite;
                animation: fumes 4s 2s infinite;
        top: 380px;
        }
        .rocket .exhaust-fumes li:nth-child(5) {
        width: 130px;
        height: 130px;
        left: -120px;
        top: 350px;
        -webkit-animation: fumes 5s infinite;
                animation: fumes 5s infinite;
        }
        .rocket .exhaust-fumes li:nth-child(6) {
        width: 200px;
        height: 200px;
        left: -60px;
        top: 280px;
        -webkit-animation: fumes2 10s infinite;
                animation: fumes2 10s infinite;
        }
        .rocket .exhaust-fumes li:nth-child(7) {
        width: 100px;
        height: 100px;
        left: -100px;
        top: 320px;
        }
        .rocket .exhaust-fumes li:nth-child(8) {
        width: 110px;
        height: 110px;
        left: 70px;
        top: 340px;
        }
        .rocket .exhaust-fumes li:nth-child(9) {
        width: 90px;
        height: 90px;
        left: 200px;
        top: 380px;
        -webkit-animation: fumes 20s infinite;
                animation: fumes 20s infinite;
        }

        .star li {
        list-style: none;
        position: absolute;
        }
        .star li:before, .star li:after {
        content: '';
        position: absolute;
        background-color: #f5f5f5;
        }
        .star li:before {
        width: 10px;
        height: 2px;
        border-radius: 50%;
        }
        .star li:after {
        height: 8px;
        width: 2px;
        left: 4px;
        top: -3px;
        }
        .star li:first-child {
        top: -30px;
        left: -210px;
        -webkit-animation: twinkle 0.4s infinite;
                animation: twinkle 0.4s infinite;
        }
        .star li:nth-child(2) {
        top: 0;
        left: 60px;
        -webkit-animation: twinkle 0.5s infinite;
                animation: twinkle 0.5s infinite;
        }
        .star li:nth-child(2):before {
        height: 1px;
        width: 5px;
        }
        .star li:nth-child(2):after {
        width: 1px;
        height: 5px;
        top: -2px;
        left: 2px;
        }
        .star li:nth-child(3) {
        left: 120px;
        top: 220px;
        -webkit-animation: twinkle 1s infinite;
                animation: twinkle 1s infinite;
        }
        .star li:nth-child(4) {
        left: -100px;
        top: 200px;
        -webkit-animation: twinkle 0.5s ease infinite;
                animation: twinkle 0.5s ease infinite;
        }
        .star li:nth-child(5) {
        left: 170px;
        top: 100px;
        -webkit-animation: twinkle 0.4s ease infinite;
                animation: twinkle 0.4s ease infinite;
        }
        .star li:nth-child(6) {
        top: 87px;
        left: -79px;
        -webkit-animation: twinkle 0.2s infinite;
                animation: twinkle 0.2s infinite;
        }
        .star li:nth-child(6):before {
        height: 1px;
        width: 5px;
        }
        .star li:nth-child(6):after {
        width: 1px;
        height: 5px;
        top: -2px;
        left: 2px;
        }
        .star{
            display: none;
        }

        @-webkit-keyframes fumes {
        50% {
            -webkit-transform: scale(1.5);
                    transform: scale(1.5);
            background-color: transparent;
        }
        51% {
            -webkit-transform: scale(0.8);
                    transform: scale(0.8);
        }
        100% {
            background-color: #f5f5f5;
            -webkit-transform: scale(1);
                    transform: scale(1);
        }
        }

        @keyframes fumes {
        50% {
            -webkit-transform: scale(1.5);
                    transform: scale(1.5);
            background-color: transparent;
        }
        51% {
            -webkit-transform: scale(0.8);
                    transform: scale(0.8);
        }
        100% {
            background-color: #f5f5f5;
            -webkit-transform: scale(1);
                    transform: scale(1);
        }
        }
        @-webkit-keyframes bounce {
        0% {
            -webkit-transform: translate3d(0px, 0px, 0);
                    transform: translate3d(0px, 0px, 0);
        }
        50% {
            -webkit-transform: translate3d(0px, -4px, 0);
                    transform: translate3d(0px, -4px, 0);
        }
        100% {
            -webkit-transform: translate3d(0px, 0px, 0);
                    transform: translate3d(0px, 0px, 0);
        }
        }
        @keyframes bounce {
        0% {
            -webkit-transform: translate3d(0px, 0px, 0);
                    transform: translate3d(0px, 0px, 0);
        }
        50% {
            -webkit-transform: translate3d(0px, -4px, 0);
                    transform: translate3d(0px, -4px, 0);
        }
        100% {
            -webkit-transform: translate3d(0px, 0px, 0);
                    transform: translate3d(0px, 0px, 0);
        }
        }
        @-webkit-keyframes exhaust {
        0% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(10%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 10%, #f5f5f5 100%);
        }
        50% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(8%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 8%, #f5f5f5 100%);
        }
        75% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(12%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 12%, #f5f5f5 100%);
        }
        }
        @keyframes exhaust {
        0% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(10%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 10%, #f5f5f5 100%);
        }
        50% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(8%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 8%, #f5f5f5 100%);
        }
        75% {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(12%, transparent), to(#f5f5f5));
            background: linear-gradient(to bottom, transparent 12%, #f5f5f5 100%);
        }
        }
        @keyframes flyExhaust {
        0% {
            background: linear-gradient(to top, transparent 10%, #f5f5f5 100%);
        }
        50% {
            background: linear-gradient(to top, transparent 0%, #f5f5f5 100%);
        }
        75% {
            background: linear-gradient(to top, transparent 10%, #f5f5f5 100%);
        }
        }
        @-webkit-keyframes fumes2 {
        50% {
            -webkit-transform: scale(1.1);
                    transform: scale(1.1);
        }
        }
        @keyframes fumes2 {
        50% {
            -webkit-transform: scale(1.1);
                    transform: scale(1.1);
        }
        }
        @-webkit-keyframes twinkle {
        80% {
            -webkit-transform: scale(1.1);
                    transform: scale(1.1);
            opacity: 0.7;
        }
        }
        @keyframes twinkle {
        80% {
            -webkit-transform: scale(1.1);
                    transform: scale(1.1);
            opacity: 0.7;
        }
        
        }

        @keyframes launchRocket {
            100% {
                transform: translate(0, -350%);
            }
        }

    </style>
@endsection

@section('after-styles')
@endsection

@section('content')
    {{-- <img src="{{asset('front/images/sample button/filmsBtn.png')}}" alt="" class="sample-btn">
    <img src="{{asset('front/images/sample button/sampleBG.png')}}" alt=""> --}}
    {{-- <video width="640" height="264" muted playsinline controls src="{{asset('front/images/trial 1.mp4')}}"></video> --}}
    {{-- <video style="width: 100%; height: 100%;" class="" loop="" preload="auto" controls muted autoplay>
        <source src="{{asset('front/images/trial 1.mp4')}}" >
    </video> --}}
    {{-- <iframe src="{{asset('front/images/trial 1.mp4')}}" width="560" height="315" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay"></iframe> --}}
    {{-- <iframe src="https://player.vimeo.com/video/379549607?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;controls=0&amp;transparent=0" width="560" height="315" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay"></iframe> --}}
    {{-- <iframe src="https://player.vimeo.com/video/347119375?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;controls=0&amp;transparent=0&muted=0" width="560" height="315" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay"></iframe> --}}
    {{-- <body> --}}
    <div class="main-body">
        <div class="rocket">
          <div class="rocket-body">
            <div class="body"></div>
            <div class="fin fin-left"></div>
            <div class="fin fin-right"></div>
            <div class="window"></div>
          </div>
          <div class="exhaust-flame"></div>
          <ul class="exhaust-fumes">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
          <ul class="star">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
        </div>
    </div>
      {{-- </body> --}}

@section('after-scripts')
    <script>
        $('.sample-btn').click(function() {
            $(this).toggleClass('shadow');
        });

        $('body').click(function() {
            $('.exhaust-flame').addClass('exhaust-flame2');
            $('.exhaust-fumes').fadeOut(function() {
                $('.rocket').addClass('launch');
            });
        });
    </script>
@endsection
