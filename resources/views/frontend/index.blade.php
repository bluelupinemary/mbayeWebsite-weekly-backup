@extends('frontend.layouts.game_layout')
@section('before-styles')
  <link href="{{asset('front')}}/CSS/game/HomeSceneStyle.css" rel="stylesheet"/>   
  <link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">

@endsection

@section('content')
    <input type='hidden' id='storyChapter' value='1'>
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    

    <div id="loadingScreenOverlay" >
        <div id="overlayText">
            <div id="initmsg" style="font-size:1.2em;">
                This is not any social media site.<br/> This is a socially-conscious media site promoting social conscience.<br/>
                It is about your social conscience.<br/>
                If you are a socially-conscious person, enjoy this site. 
                <br/>
                <br/>
                <span style="font-size:3vw;">Participate and help others be like you.</span>
            </div>
            <br/>
            <div id="planetmsg" style='font-size:0.7em;'>
                Sorry, these planets are not yet accessible as we continue with the development for your eventual participation.
                <br/>For any inquiries, please email <a id="infoLink" href="mailto:issa.arch@einoxarabia.com">issa.arch@inoxarabia.com</a>
                <br/><div id="planetmsg2">Please click anywhere to start.</div>
            </div>
            
        </div>
        <span id="fs-desc">Enable Fullscreen</span>
    </div>

    <div id="loadingScreenPercent" style="padding-top: 2%;">
        Loading: 0 %
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>


    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="rotate-img">
        </div>
    </div>
    <script>
        
    </script>
   
@endsection

@section('after-scripts')

    <script>
        var token = '{{ Session::token() }}';
        var urlStory = '{{ route('frontend.storyMbaye') }}';
        var captMbayeLink = '{{ route('frontend.captainMbaye') }}';
       
    </script>
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/home/homeScene.js"></script>
   

@endsection

