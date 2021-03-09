@extends('frontend.layouts.game_layout')
@section('before-styles')
  <link href="{{asset('front')}}/CSS/game/HomeSceneStyle.css" rel="stylesheet"/>    
  <style>
  </style>
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
        </div>
    </div>
   
    <audio src="{{asset('front')}}/audio/visitingScene/VRSceneInitial.mp3" id="vrSceneAudio" loop="loop" autoplay="autoplay">

   
   
@endsection

@section('after-scripts')

<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/mbayeMaps.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/visit/visitScene.js"></script>
   

@endsection
