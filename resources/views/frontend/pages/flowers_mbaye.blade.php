@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
 
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div id="loadingScreenDiv" style="">
    </div>
    {{-- <div id="selectedFlowerDiv" style="border:red; width:100vw;height:100vh;position:absolute;bacground:rgba(1,0,0,0.5);"> --}}
        <div id="flowersWikipediaDiv">
            <div class="iframe-loading" id="iframe-loading">
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
            <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage()"/>
            <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" onclick="fullscreenDescDiv()"/> 
            Wikipedia: <span id="page-url" ></span><br>
            Song Playing: <a id="song-url" href="" target="_blank"><span id="song-url-span"></span></a> 
            
            <iframe id="wikiPage" src="" frameBorder="0"></iframe>
        </div>
        <div class="player" id="player" data-player="youtube-player-1" style="visibility:hidden;width:20vw;height: 20vh;left: 26vw;top:0.5vw;position: absolute;"></div>
    {{-- </div> --}}

   
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

    {{-- <div class="player" id="player" data-player="youtube-player-1" ></div> --}}
    
    
    <script src="https://www.youtube.com/iframe_api"></script>   

    
   
@endsection

@section('after-scripts')
        
    
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/selectedFlowerScene.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMbayeScene.js"></script>
   

@endsection
