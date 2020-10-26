@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<link href="{{asset('front/CSS/game/FeetMbayeSceneStyle.css')}}" rel="stylesheet"/>
<script src="https://www.youtube.com/iframe_api"></script>   
  <style>

  </style>
@endsection

@section('content')
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv" style="">
      <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <div id="block_land">
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
      </div>
    </div>

    <div id="musicVideoDiv">
      <div id="musicVideoDivHeader">
        <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/>
        <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
        <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style="display:none;"/> 
      </div>
      <div class="player" id="player" data-player="youtube-player-1" style=""></div>    
    </div>



    <div id="flowerModelDiv">
      <div id="flowerModelDivHeader">
          <img id="close-btn" src="front/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right" style=""/>
          <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
          <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style="display:none;"/> 
      </div>
        {{-- <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" />  --}}
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
  <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
  <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
  <script src="{{asset('front')}}/babylonjs/scenes/feetMbaye/feetScene.js"></script>

@endsection
