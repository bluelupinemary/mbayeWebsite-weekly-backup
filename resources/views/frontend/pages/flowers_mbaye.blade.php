@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<style>
    #flowerModelDiv{
        border:1px solid gray;
        position:absolute;
        width:20vw;
        height:20vh;
        bottom:0vw;
        left:26vw;
        visibility: hidden;
    }
    #flowerModelDiv #close-btn{
        position: absolute;
        right:0;
    }
    #flowerModelDiv #fullscreen-btn{
        position: absolute;
        right:1.5vw;
    }
    #flowerModelDiv #minimize-btn{
        position: absolute;
        right:1.5vw;
    }

    #flowerViewer{
        position: absolute;
        width:100%;
        height:100%;
    }

    .music-player-parent-div{
        position: absolute;
        left: 26vw;
        top: 0.7vw;
        width: 20vw;
        height: 20vh;
        
    }

    .music-close-btn{
        height: 2vw;
        width: 2vw;
        position: relative;
        float:right;
        padding:1%;
    }


</style>   
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div id="loadingScreenDiv" style="">
    </div>
    
    <div id="flowersWikipediaDiv">
            <div class="iframe-loading" id="iframe-loading">
                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
            <img id="close-btn" src="{{asset('front')}}/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage(1)"/>
            <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right"/> 
            <span class="spanLbl">Wikipedia:</span> <span id="page-url" ></span><br>
            <span class="spanLbl">Song Playing:</span> <a id="song-url" href="" target="_blank"><span id="song-url-span"></span></a> 
            
            <iframe id="wikiPage" src="" frameBorder="0"></iframe>
    </div>

    <div id="carpetsWikipediaDiv">
        <div class="iframe-loading" id="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <img id="close-btn" src="{{asset('front')}}/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage(2)"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right"/> 
        <span class="spanLbl">Wikipedia:</span> <span id="carpet-page-url" ></span><br>
        
        <iframe id="carpetsWikiPage" src="" frameBorder="0"></iframe>
    </div>
   
    <div class="music-player-parent-div" style="display:none;">
        <div class="musicPlayer" id="player" data-player="youtube-player-1" style="">
        </div>
        <img class="music-close-btn" src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close"/>
    </div>

    <div id="flowerModelDiv">
        <img id="close-btn"  src="{{asset('front')}}/images3D/close-btn.png" data-toggle="tooltip" title="Close" align="right"/>
        <img id="fullscreen-btn" src="{{asset('front')}}/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" /> 
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



    <div class="searchDiv" style="position: absolute;top:0;left:3vw;">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchFlowerField" class="searchClass" aria-label="Search" style="width: 10vw;
            height: 2vw;">
            <button class="btn aqua-gradient btn-rounded btn-sm my-0" id="searchFlowerBtn" type="submit" style="width:5vw;height:2vw;">Search</button>
    </div>

    
  
    

    
   
@endsection

@section('after-scripts')
            
    <script src="{{asset('front')}}/babylonjs/model-viewer.js"></script>
    <script src="{{asset('front')}}/babylonjs/model-viewer-legacy.js"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/selectedFlowerScene.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMap.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/flowersMbaye/flowersMbayeScene.js"></script>
    

@endsection
