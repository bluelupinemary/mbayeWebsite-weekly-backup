@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
  <style>
     
  </style>
@endsection

@section('content')
    <input type="hidden" id="userGender" value="{{$gender}}"/>
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <img src="{{asset('storage/profilepicture').'/'.$photo}}" id="userPhoto" alt="Img goes here" style="visibility:hidden;"/>
    <div id="block_land">
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
      </div>
  </div>
    
@endsection

@section('after-scripts')
<script src="{{asset('front')}}/babylonjs/scenes/ContactsPage/contactsMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/instructions/instructions.js"></script>
  <script>
   
  </script>
@endsection
