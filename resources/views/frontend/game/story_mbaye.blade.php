@extends('frontend.layouts.game_layout')
@section('before-styles')

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
             <div class="firstVideoOverlayText">
                 <div class="overlayTxt" id="txt1"><span style="font-size:5vw;">O</span>nce upon a time, </div>
                 <div class="overlayTxt" id="txt2">a carpenter from Small Heath in Birmingham,</div>
                 <div class="overlayTxt" id="txt3">who more than 40 years after leaving those</div>
                 <div class="overlayTxt" id="txt4">industrial-declined streets,</div>
                 <div class="overlayTxt" id="txt5">found himself the owner of a Stainless Steel factory</div>
                 <div class="overlayTxt" id="txt6">amongst the high-rise metropolis of</div>
                 {{-- <div id="emptyDivFillerRow"></div> --}}
                 <div class="overlayTxt" id="txt7">Dubai.</div>
             </div>
         </div>
        
     </div>


    <div id="block_land">
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
      </div>
    </div>

    <div id="streetViewDiv" style="visibility:hidden;">
        <iframe src="https://www.google.com/maps/embed?pb=!4v1593863443782!6m8!1m7!1sOEZsFqEHHAdEq-tM-QDDzg!2m2!1d52.47325120371!2d-1.854880706295096!3f124.42167930544927!4f0!5f0.7820865974627469" 
        width="100%" height="100%" frameborder="0" style="border:0;" allowFullscreen aria-hidden="false" tabindex="0">
        </iframe>
       
    </div>

    <div id="musicVideoDiv" style="visibility:hidden;">
        <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right" style="padding-top:0.1vw;width:1.3vw;"/>
        <div class="player" id="player" data-player="youtube-player-1" style="width:20vw;height: 12vw;right: 0;top:0;position: relative;"></div>
    </div>

    <div id="continueBtnDiv" style="position:absolute; right: 10vw; top: 20vh;visibility:hidden;">
        <button id="continueBtn" class="btn arrow-down" style="position:relative;"> >
        </button>
    </div>




    
@endsection

@section('after-scripts')

<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>

<script src="{{asset('front')}}/babylonjs/scenes/storyMbaye/storyMbayeMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/storyMbaye/storyMbayeScene.js"></script>
  <script>
   
  </script>
@endsection
