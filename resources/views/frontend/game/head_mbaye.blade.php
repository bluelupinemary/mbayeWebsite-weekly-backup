@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front/CSS/game/GeneralSceneStyle.css')}}" rel="stylesheet"/>
<link href="{{asset('front/CSS/game/HeadMbayeSceneStyle.css')}}" rel="stylesheet"/>
<link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
<link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
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

    <div id="fullscreenIcon">
      <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <i class="fas fa-info-circle" id="MbayeHeadinfoIcon"><span class="InfoIconLabel">Instructions</span></i>

    <div id="flowerInstruction" class="flower-instruction-left-div">
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

  <div id="infoIconTextflowers" class="instr-text-flower">This page contains all of the different wild flowers that you can find<br>on Mbaye's Head. Each flower has an assigned song similar to what<br>you hear on the wolrd of flowers.</div>

  <div id="infoIconTextdownflower" class="instr-text-flower-down">You can click on any flower to play a song and a music video will<br>appear. You can pause or play the song while viewing the page. You<br>can also maximize or minimize the window of the music video.</div>

  <h2 id="textCurve"> Click on flower<h2>
  <h2 id="textCurve2"> to play a song</h2>
  <h2 id="textCurveanticlock"> Hover on flower</h2>
  <h2 id="textCurveanticlock2"> to see the name</h2>

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
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
<script src="{{asset('front/babylonjs/model-viewer.js')}}"></script>
<script src="{{asset('front/babylonjs/model-viewer-legacy.js')}}"></script>
<script src="{{asset('front/babylonjs/Oimo.js')}}"></script>
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMap.js')}}"></script>
<script src="{{asset('front/babylonjs/scenes/headMbaye/headScene.js')}}"></script>
 
@endsection
