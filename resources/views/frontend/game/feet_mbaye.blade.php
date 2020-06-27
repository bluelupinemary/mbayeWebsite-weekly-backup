@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
  <style>
     
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

<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/feetMbaye/feetScene.js"></script>
  <script>
   
  </script>
@endsection
