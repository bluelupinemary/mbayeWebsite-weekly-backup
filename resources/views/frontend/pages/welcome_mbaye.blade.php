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
        <div id="wikiHeader" style="">
            <div id="page-url" style=""></div> 
            <div id="wikiButtons" style="">
                <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" onclick="fullscreenDescDiv()" style=""/> 
                <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage()" style=""/>
            </div> 
        </div>
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

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <i class="fas fa-info-circle" id="infoIcon"><span class="InfoIconLabel">Instructions</span></i>
    <div id="instruction-left-div" class="instruction-left-div">
        <div class="row instr-text-row">
            <div class="col-md-6 instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/left.png" alt=""></div>
            <div class="col-md-6 instr-text">3D ROTATE</div>
        </div>
        <div class="row instr-text-row">
            <div class="col-md-6 instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/scroll.png" alt=""></div>
            <div class="col-md-6 instr-text">ZOOM IN/OUT</div>
        </div>
        <div class="row instr-text-row">
            <div class="col-md-6 instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/right.png" alt=""></div>
            <div class="col-md-3 instr-text">PANNING</div>
            {{-- <div id="closeInfoBtn" class="col-md-3 info-icon"><i class="fas fa-info-circle"></i></div> --}}
        </div>
    </div>

    <div id="infoIconTextup" class="col-md-9 instr-text-up-nonParticipate">This is your view of the participate page when you are<br>not a member or if you are not logged in.</div>
   
@endsection

@section('after-scripts')
    
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/welcome/welcomeScene.js')}}"></script>
   

@endsection
