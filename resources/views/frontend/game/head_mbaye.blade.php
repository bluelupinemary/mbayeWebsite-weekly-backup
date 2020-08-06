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
    #loadingScreenOverlay{
        font-family: 'Courgette-Regular';
        font-weight: normal;
        font-style: normal;
        text-align: center;
        text-shadow: -2px 1px 20px black;
        font-size: 1.5vw;
        color: #e9ba29;
    }
    #heartBDiv{
        bottom: 0%;
        position: absolute;
        right: 0;
       
        transform: translate(-25%,-30%);
        -ms-transform: translate(-25%,-30%);
    }
    #heartTDiv{
        top: 5vw;
        left: 5vw;
        position: absolute;
    }
    .heartImg{
        width:20vw;
        height:auto;
        filter: drop-shadow(0 0 5px gold);
        -webkit-filter: drop-shadow(0 0 5px gold);
        -moz-filter: drop-shadow(0 0 5px gold);
    }
    #heartTTxt{
        position:absolute;
        left: 1vw;
        padding: 2vw;
        top: 3.5vw;
    }
    #heartBTxt{
        position: absolute;
        left: 2.5vw;
        top: 6.5vw;
    }
  </style>
@endsection

@section('content')
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <div id="loadingScreenOverlay">
      <div id="heartBDiv">
          <img class="heartImg" src="{{asset('front')}}/images3D/headScene/heart.png"/>
          <span id="heartBTxt">Click anywhere to start.</span>
      </div>
      <div id="heartTDiv">
        <img class="heartImg" src="{{asset('front')}}/images3D/headScene/heart.png"/>
        <span id="heartTTxt">Please select any flower
          and see them light-up on
          Mbaye’s face.</span>
      </div>
    </div>
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
      <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
    </div>
 
    
@endsection

@section('after-scripts')

<script src="{{asset('front')}}/babylonjs/model-viewer.js"></script>
<script src="{{asset('front')}}/babylonjs/model-viewer-legacy.js"></script>
<script src="{{asset('front')}}/babylonjs/Oimo.js"></script>
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/headMbaye/headScene.js"></script>
  <script>
   
  </script>
@endsection
