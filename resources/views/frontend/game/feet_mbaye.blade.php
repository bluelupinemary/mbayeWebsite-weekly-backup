@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<script src="https://www.youtube.com/iframe_api"></script>   
  <style>
    #musicVideoDiv{
        position: absolute;
        width:20vw;
        height:13vw;
        right:0;
        top:0.5vw;
        background: rgba(255,255,255,0.3);
    }

    #flowerModelDiv{
        border:1px solid gray;
        position:absolute;
        width:20vw;
        height:12vw;
        bottom:0vw;
        left:0vw;
        visibility: hidden;
    }
    #flowerModelDiv #close-btn{
        position: absolute;
        right:0;
    }
    #flowerModelDiv #fullscreen-btn{
        position: absolute;
        right:1.5vw;
    }
    #flowerModelDiv #minimize-btn{
        position: absolute;
        right:1.5vw;
    }

    #flowerViewer{
        position: absolute;
        width:100%;
        height:100%;
    }
    .modelArrow{    
      display:none; 
      position: absolute;
      font-size: 3em;
      border: none;
      color: #16aedc;
      cursor: pointer;
      z-index:1;
      padding:1vw;
    }

    #leftArrow{
      bottom:0;
      left:0;
    }

    #rightArrow{     
      bottom:0;
      right:0;
    }
  
  </style>
@endsection

@section('content')
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <div id="block_land">
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
      </div>
    </div>

    <div id="musicVideoDiv" style="visibility:hidden;">
      <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right" style="padding-top:0.1vw;width:1.3vw;"/>
      <div class="player" id="player" data-player="youtube-player-1" style="width:20vw;height: 12vw;right: 0;top:0;position: relative;"></div>
    </div>

    <div id="flowerModelDiv">
        <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" /> 
        <i id="leftArrow" class="modelArrow fas fa-chevron-circle-left"></i>
        <i id="rightArrow" class="modelArrow fas fa-chevron-circle-right"></i>
        <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
    </div>
 
    
@endsection

@section('after-scripts')

<script src="{{asset('front')}}/babylonjs/model-viewer.js"></script>
<script src="{{asset('front')}}/babylonjs/model-viewer-legacy.js"></script>
<script src="{{asset('front')}}/babylonjs/Oimo.js"></script>
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/feetMbaye/feetScene.js"></script>
  <script>
   
  </script>
@endsection
