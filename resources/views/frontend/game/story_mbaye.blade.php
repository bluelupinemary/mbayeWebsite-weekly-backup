@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/animate.min.css" rel="stylesheet"/>
<link href="{{asset('front')}}/CSS/game/StoryMbayeSceneStyle.css" rel="stylesheet"/>
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<script src="https://www.youtube.com/iframe_api"></script> 
  <style>
   

  </style>
@endsection

@section('content')
   
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
   
    <div id="firstVideoOverlay" >
         <div id="textOverlayDiv">
             <div class="firstVideoOverlayText" id="firstVideoOverlayText">
                 <div class="" id="txt1"><span style="font-size:5vw;">O</span>nce upon a time, </div>
                 <div class=" " id="txt2">a carpenter from Small Heath in Birmingham,</div>
                 <div class=" " id="txt3">who more than 40 years after leaving those</div>
                 <div class=" " id="txt4">industrial-declined streets,</div>
                 <div class=" " id="txt5">found himself the owner of a Stainless Steel factory</div>
                 <div class=" " id="txt6">amongst the high-rise metropolis of</div>
                 <div class=" " id="txt7">Dubai.</div>
             </div>
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

    {{-- <div id="continueBtnDiv" style="position:absolute; right: 3vw; bottom: 3vw;visibility:hidden;"> --}}
    <div id="continueBtnDiv" style="position:absolute; right: 3vw; bottom: 3vw;">
        <button id="continueBtn" class="btn arrow-down" style="position:relative;"> >
        </button>
    </div>




    
@endsection

@section('after-scripts')

<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>

<script src="{{asset('front')}}/babylonjs/scenes/storyMbaye/storyMbayeMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/storyMbaye/storyMbayeScene.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/storyMbaye/storyMbayeChapter1.js"></script>
  <script>
   
  </script>
@endsection
