@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<link href="{{asset('front')}}/CSS/game/FlowersSceneStyle.css" rel="stylesheet"/>
<link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
<link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
<style>
   

</style>   
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
<script src="{{asset('front/JS/circletype.min.js')}}"></script> 
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    
    <div id="flowersWikipediaDiv">
            <div class="iframe-loading" id="iframe-loading">
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
            <div id="flowersWikiDivHeader">
                {{-- <div class="wikiCloseIcon"> --}}
                    <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"/>
                    <span class="wikiCloseLabel">Close</span>
                {{-- </div> --}}
                <span class="spanLbl">Wikipedia:</span> <a id="page-url" href="" target="_blank"><span id="page-url-span" ></span></a><br>
                <span class="spanLbl">Song Playing:</span> <a id="song-url" href="" target="_blank"><span id="song-url-span"></span></a> 
            </div>
            <iframe id="wikiPage" src="" frameBorder="0"></iframe>
    </div>

    <div id="carpetsWikipediaDiv">
        <div class="iframe-loading" id="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <div id="carpetsWikiDivHeader">
            {{-- <div class="wikiCloseIcon"> --}}
                    <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"/>
                    <span class="wikiCloseLabel">Close</span>
            {{-- </div> --}}
            <span class="wikiCloseLabel">Close</span>
            <span class="spanLbl">Wikipedia:</span><a id="carpet-page-url" href="" target="_blank"><span id="carpet-page-url-span" ></span></a><br>
        </div>
        <iframe id="carpetsWikiPage" src="" frameBorder="0"></iframe>
    </div>
   
    {{-- <div class="music-player-parent-div" style="display:none;">
        <div class="musicPlayer" id="player" data-player="youtube-player-1" style="">
        </div>
        <img class="music-close-btn" src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close"/>
    </div> --}}

    <div id="musicVideoDiv" style="">
      <div id="musicVideoDivHeader">
            {{-- <div class="wikiCloseIcon"> --}}
                        <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"/>
                        <span class="wikiCloseLabel">Close</span>
                
                        {{-- <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/> --}}
                        <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png"/>
                        <span class="wikiFullscreenLabel">Fullscreen</span> 
                        <img id="minimize-btn" src="front/images3D/minimize-btn.png" style="display:none;"/> 
                        <span class="wikiFullscreenLabel">Minimize</span> 
                {{-- </div> --}}
      </div>
      <div class="player" id="player" data-player="youtube-player-1" style=""></div>    
    </div>

    {{-- <div id="flowerModelDiv">
        <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" /> 
        <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
    </div> --}}

    <div id="flowerModelDiv">
        <div id="flowerModelDivHeader">
            {{-- <div class="wikiCloseIcon"> --}}
                    <img id="close-btn" src="{{asset('front/images3D/close-btn.png')}}"/>
                    <span class="wikiCloseLabel">Close</span>
            
                    {{-- <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" style=""/> --}}
                    <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png"/> 
                    <span class="modelFullscreenLabel">Fullscreen</span>
                    <img id="minimize-btn" src="front/images3D/minimize-btn.png" style="display:none;"/> 
                    <span class="modelFullscreenLabel">Minimize</span> 
            {{-- </div> --}}
            {{-- <img id="close-btn" src="front/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right" style=""/>
            <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" style=""/> 
            <img id="minimize-btn" src="front/images3D/minimize-btn.png" data-toggle="tooltip" title="Minimize" align="right" style="display:none;"/>  --}}
        </div>
        <i id="leftArrow" class="modelArrow fas fa-chevron-circle-left"></i>
        <i id="rightArrow" class="modelArrow fas fa-chevron-circle-right"></i>
        <model-viewer id="flowerViewer"  preload poster="{{asset('front')}}/images3D/Flower3DBG.png"  camera-target="0m 0m 0m" max-field-of-view="300%" src="" alt="A 3D model here" skybox-image="{{asset('front')}}/images3D/Flower3DBG.png" environment-image="{{asset('front')}}/images3D/lightroom.hdr" min-field-of-view ="1deg" exposure="0.8" camera-controls interaction-prompt="none"></model-viewer>
    </div>
   
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



    <div id="searchDiv" class="searchDiv" style="position: absolute;top:0;left:3vw;">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchFlowerField" class="searchClass" aria-label="Search" style="width: 10vw;
            height: 2vw;">
            <button class="btn aqua-gradient btn-rounded btn-sm my-0" id="searchFlowerBtn" type="submit" style="width:5vw;height:2vw;">Search</button>
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <i class="fas fa-info-circle" id="infoIcon"><span class="InfoIconLabel">Instructions</span></i>

    <div id="infoIconTextflowers" class="instr-text-flower">This page contains all of the different flowers that we have<br>picked from all the countries of the world. Each flower has an<br>assigned song that represents the culture of their country.<br>You will see these flowers interpreted in 2d and 3d design which are<br>to found in different parts of Mbaye.</div>
    <div id="infoIconTextdownflower" class="instr-text-flower-down">You can click on the Earth to play randomized from our playlist or<br>you can click any flower to play the assigned song on that flower, it will<br>then take you to another page that will tell you about flower that<br>you picked.</div>

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
    
    <div id="infoIconTextUpRight" class="instr-text-flower-up">In this page you will find all the information abot the flower that you<br>clicked from the Flowers of Mbaye page. You can read the flower<br>while listening the song assigned to that flower.</div>
    <div id="instrFlowerLeftUp" class="instr-flower-text-left-up">You can view the wikipedia page here.</div>
    <h2 id="textCurve1"> Click on Solar</h2>
    <h2 id="textCurve2"> to go back</h2>
    <h2 id="textCurveanticlock"> Hover on Nuvola</h2>
    <h2 id="textCurveanticlock2"> to read her message</h2>
        {{-- <span class="char1">C</span>
        <span class="char2">l</span>
        <span class="char3">i</span>
        <span class="char4">c</span>
        <span class="char5">k</span>
        <span class="char6">o</span>
        <span class="char7">n</span>
        <span class="char8">S</span>
        <span class="char9">o</span>
        <span class="char10">l</span>
        <span class="char11">a</span>
        <span class="char12">r</span> --}}
    {{-- </p> --}}
    <div id="wikipediaIcon" class="wikiIcon">
        <img id="wikipediaIconImg" src="{{asset('front/images3D/flowersScene/wiki-icon.png')}}" alt="wikipediaIcon-img" >
        <span class="wikiIconLabel">View Wikipedia</span>
    </div>
    
  
    

    
   
@endsection

@section('after-scripts')
          
    <script src="{{asset('front/babylonjs/model-viewer.js')}}"></script>
    <script src="{{asset('front/babylonjs/model-viewer-legacy.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/selectedFlowerScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMap.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/flowersMbaye/flowersMbayeScene.js')}}"></script>
    

@endsection
