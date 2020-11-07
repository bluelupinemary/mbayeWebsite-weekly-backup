@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<link href="{{asset('front')}}/CSS/game/FlowersSceneStyle.css" rel="stylesheet"/>
<link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
<link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
<style>
   

</style>   
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    
    <div id="flowersWikipediaDiv">
            <div class="iframe-loading" id="iframe-loading">
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
            <div id="flowersWikiDivHeader">
                <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"  data-toggle="tooltip" title="Close" align="right"/>
                <span class="spanLbl">Wikipedia:</span> <span id="page-url" ></span><br>
                <span class="spanLbl">Song Playing:</span> <a id="song-url" href="" target="_blank"><span id="song-url-span"></span></a> 
            </div>
            <iframe id="wikiPage" src="" frameBorder="0"></iframe>
    </div>

    <div id="carpetsWikipediaDiv">
        <div class="iframe-loading" id="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <img id="close-btn" src="{{asset('front')}}/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage(2)"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right"/> 
        <span class="spanLbl">Wikipedia:</span> <span id="carpet-page-url" ></span><br>
        
        <iframe id="carpetsWikiPage" src="" frameBorder="0"></iframe>
    </div>
   
    {{-- <div class="music-player-parent-div" style="display:none;">
        <div class="musicPlayer" id="player" data-player="youtube-player-1" style="">
        </div>
        <img class="music-close-btn" src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close"/>
    </div> --}}

    <div id="musicVideoDiv" style="">
      <div id="musicVideoDivHeader">
        <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/>
        <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
        <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style="display:none;"/> 
      </div>
      <div class="player" id="player" data-player="youtube-player-1" style=""></div>    
    </div>

    {{-- <div id="flowerModelDiv">
        <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" /> 
        <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
    </div> --}}

    <div id="flowerModelDiv">
      <div id="flowerModelDivHeader">
          <img id="close-btn" src="front/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right" style=""/>
          <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
          <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Minimize" align="right" style="display:none;"/> 
      </div>
        <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
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



    <div class="searchDiv" style="position: absolute;top:0;left:3vw;">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchFlowerField" class="searchClass" aria-label="Search" style="width: 10vw;
            height: 2vw;">
            <button class="btn aqua-gradient btn-rounded btn-sm my-0" id="searchFlowerBtn" type="submit" style="width:5vw;height:2vw;">Search</button>
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <div id="wikipediaIcon" class="wikiIcon">
        <img id="wikipediaIconImg" src="{{asset('front/images3D/flowersScene/wiki-icon.png')}}" alt="wikipediaIcon-img" >
        <span class="wikiLabel">View Wikipedia</span>
    </div>
    
  
    

    
   
@endsection

@section('after-scripts')
            
    <script src="{{asset('front/babylonjs/model-viewer.js')}}"></script>
    <script src="{{asset('front/babylonjs/model-viewer-legacy.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/selectedFlowerScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMap.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMbayeScene.js')}}"></script>
    

@endsection
