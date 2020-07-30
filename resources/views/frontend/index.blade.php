@extends('frontend.layouts.game_layout')
@section('before-styles')
  <link href="{{asset('front')}}/CSS/game/HomeSceneStyle.css" rel="stylesheet"/>    
  

  <style>
     
  </style>
@endsection

@section('content')
    <input type='hidden' id='storyChapter' value='1'>
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    
    <div id="loadingScreenDiv" style="">
      
    </div>
    <div id="firstVideoOverlay" >
       <p id ="skipVideo">Skip >> </p>
       <br>
       <p id ="hideOverlay">Use Camera >> </p>

        <div id="textOverlayDiv">
            <div class="firstVideoOverlayText">
                <div class="overlayTxt" id="txt1">Dedicated to care, we named this monument after a UN peacekeeping soldier who gave his life caring for others</div>
                <div class="overlayTxt" id="txt2">different to himself. Mbaye the lioness standing 13 meters tall is being built in Dubai for location</div>
                <div class="overlayTxt" id="txt3">at any chosen place in the world. She will be transported to the most appropriate location.</div>
                <div class="overlayTxt" id="txt4">That location has not yet been decided.</div>
                <div class="overlayTxt" id="txt5">We ask you, the people of planet earth to help us choose her final location.</div>
                <div class="overlayTxt" id="txt6">We also ask you to help us in her final detailed designs.</div>
                <div id="emptyDivFillerRow"></div>
                <div class="overlayTxt" id="txt7">We are asking for someone from every country in the world to help and design one of the 594 panels of her body.</div>
                <div class="overlayTxt" id="txt8">From this opening page you can venture into any planet you wish on your own tour.</div>
                <div class="overlayTxt" id="txt9">You can find out all about Captain Mbaye Diagne.</div>
                <div class="overlayTxt" id="txt10">Learn about her building or visiting her or go straight to participate.</div>
                <div class="overlayTxt" id="txt11">There are so many exciting pages and games to participate in.</div>
                <div class="overlayTxt" id="txt12">Kindly take a tour into mbaye.com and join us in this adventure at absolutely no cost.</div>
            </div>
        </div>
        {{-- <div id="imageOverlayDiv">    
            <div id="tomHome" class="homeOverlayImage"></div>
            <div id="emptyDivFiller"></div>
            <div id="nuvolaHome" class="homeOverlayImage"></div>
        </div> --}}
    </div>
    <div id="placeholderDiv" ></div>

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
    <script>
        
    </script>
   
@endsection

@section('after-scripts')

    <script>
        var token = '{{ Session::token() }}';
        var urlStory = '{{ route('frontend.storyMbaye') }}';
        var captMbayeLink = '{{ route('frontend.captainMbaye') }}';
    </script>

    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/home/homeScene.js"></script>
   

@endsection