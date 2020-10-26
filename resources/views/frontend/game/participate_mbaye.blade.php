@extends('frontend.layouts.game_layout')
@section('before-styles')
    <link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
    <link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
@endsection

@section('content')
   
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>

    <div id="wikipediaDiv">
        <div class="iframe-loading" id="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <span id="page-url" ></span>  
        <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage()"/>
        <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" onclick="fullscreenDescDiv()"/> 
        <iframe id="wikiPage" src="" frameBorder="0"></iframe>
    </div>
    

    <div id="loadingScreenOverlay" >
        <div id="overlayText">Please click anywhere to play the game</div>
    </div>
   
    <div id="loadingScreenPercent" style="padding-top: 2%;">
        Loading: 0 %
    </div>
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
        </div>
    </div>
    <img src="{{asset('storage/profilepicture').'/'.$photo}}" id="userPhoto" alt="Img goes here" style="visibility:hidden;"/>
    <input type="hidden" id="userGender" value="{{$gender}}"/>

    <script>
        var token = '{{ Session::token() }}';
        var urlStoreGender = '{{ route('frontend.participateStoreGender') }}';
      
       
    </script>
   
@endsection

@section('after-scripts')
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/astronautScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateCommonJS.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateScene.js')}}"></script>
@endsection
