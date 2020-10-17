@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front/CSS/game/GeneralSceneStyle.css')}}" rel="stylesheet"/>
<link href="{{asset('front/CSS/game/HeadMbayeSceneStyle.css')}}" rel="stylesheet"/>
<script src="https://www.youtube.com/iframe_api"></script>   
  <style>
    
  </style>
@endsection

@section('content')
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <div id="loadingScreenOverlay">
      <div id="heartBDiv">
          <img class="heartImg" src="{{asset('')}}front/images3D/headScene/heart.png"/>
          <span id="heartBTxt">Click anywhere to start.</span>
      </div>
      <div id="heartTDiv">
        <img class="heartImg" src="{{asset('')}}front/images3D/headScene/heart.png"/>
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

    <div id="musicVideoDiv" style="">
      <div id="musicVideoDivHeader">
        <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/>
        <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
        <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style="display:none;"/> 
      </div>
        <div class="player" id="player" data-player="youtube-player-1" style=""></div>
        
        
    </div>
    
@endsection

@section('after-scripts')

<script src="{{asset('front/babylonjs/model-viewer.js')}}"></script>
<script src="{{asset('front/babylonjs/model-viewer-legacy.js')}}"></script>
<script src="{{asset('front/babylonjs/Oimo.js')}}"></script>
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMap.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/headMbaye/headScene.js')}}"></script>
  <script>
   
  </script>
@endsection
