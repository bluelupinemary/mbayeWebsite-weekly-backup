@extends('frontend.layouts.game_layout')
@section('before-styles')
    <link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
    <link href="{{asset('front')}}/CSS/game/ParticipateSceneStyle.css" rel="stylesheet"/>
    <link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
@endsection

@section('content')
   
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>


    <div id="planetWikipediaDiv" style="">
        <div class="iframe-loading" id="iframe-loading">
        </div>
        <div id="planetWikiHeader">
            {{-- <div id="page-url" style=""></div>  --}}
              {{-- <div class="wikiCloseIcon"> --}}
                          <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"/>
                          <span class="wikiCloseLabel">Close</span>
                  
                          {{-- <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/> --}}
                          <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png"/>
                          <span class="wikiFullscreenLabel">Fullscreen</span> 
                          <img id="minimize-btn" src="front/images3D/minimize-btn.png" style="display:none;"/> 
                          <span class="wikiFullscreenLabel">Minimize</span> 
                          <span class="spanLbl">Wikipedia:</span> <a id="page-url" href="" target="_blank"><span id="page-url-span" ></span></a><br>
                  {{-- </div> --}}
        </div>
        <iframe id="wikiPage" src="" frameBorder="0"></iframe>   
      </div>
    
    <!--left and right arrows for rotating astronaut-->
    <div class="astronaut-rotate-controls">
        <button class="astro-rotate-left" ><i class="fas fa-angle-left"></i></button>
        <button class="astro-rotate-right" ><i class="fas fa-angle-right"></i></button>
    </div>

    <!--left and right arrows for scaling astronaut-->
    <div class="astronaut-scale-controls">
        <button class="astro-reset" ><i class="fas fa-sync-alt"></i></button>
        <button class="astro-scale-up" ><i class="fas fa-plus"></i></button>
        <button class="astro-scale-down" ><i class="fas fa-minus"></i></button>
    </div>
    

    <div id="loadingScreenOverlay" >
        <div id="overlayText">Please click anywhere to play the game</div>
    </div>
   
    <div id="loadingScreenPercent" style="padding-top: 2%;">
        Loading: 0 %
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <div id="astronautToolIcon">
        <img id="astronautToolImg" src="{{asset('front')}}/images3D/participateScene/astronautTool.png" alt="astronautTool-img" >
    </div>

    <i class="fas fa-info-circle" id="infoIcon"><span class="InfoIconLabel">Instructions</span></i>
    <div id="instruction-left-div" class="instruction-left-div">
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

    <div id="infoIconTextdown" class="col-md-9 instr-text-down">Make sure to click on the Astronaut when you want to control it<br>or click anywhere on the galaxy when you want to control your view of the galaxy.</div>
    <div id="infoIconTextup" class="col-md-9 instr-text-up">This is your view once you have logged in,<br>and entered the participate page.<br>This is where you see the blogs of every<br>member of Mbaye.com who posted publicly or<br>your freinds or contacts.</div>
    <div id="infoIconTextastro" class="col-md-9 instr-text-astro">The photo you have taken on the,<br>registration page will be on the<br>Astronaut.</div>
    
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
        </div>
    </div>
    <img src="{{asset('storage/profilepicture').'/'.$photo}}" id="userPhoto" alt="Img goes here" style="visibility:hidden;"/>
    <input type="hidden" id="userGender" value="{{$gender}}"/>
    
    <script>
        var token = '{{ Session::token() }}';
        var urlStoreGender = '{{ route('frontend.participateStoreGender') }}';
    </script>
   
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/astronautScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateCommonJS.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/participate/participateScene.js')}}"></script>
@endsection
