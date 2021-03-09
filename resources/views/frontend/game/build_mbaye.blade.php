@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
  <style>
    #musicVideoDiv{
        position: absolute;
        width:20vw;
        height:13vw;
        right:0;
        top:0.5vw;
        background: rgba(255,255,255,0.3);
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

    
@endsection

@section('after-scripts')
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front')}}/babylonjs/scenes/buildMbaye/buildScene.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/buildMbaye/buildMap.js"></script>
  <script>
   
  </script>
@endsection
