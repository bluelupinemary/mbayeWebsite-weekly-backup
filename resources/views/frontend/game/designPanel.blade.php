@extends('frontend.layouts.game_layout')
@section('before-styles')
    <link href="{{asset('front')}}/CSS/game/DesignPanelStyle.css" rel="stylesheet"/>
    <link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    <style>
        #saveScreenshotBtn{
            border-color:white;
        }
        #cancelScreenshotBtn{
            background-color:red;
            border-color:white;
        }
        .takeScreenshotMain-submenu i{
            padding-right:3%;
        }
        #gizmoToolsDiv{
            position: absolute;
            bottom: 0;
            right: 0;
            width: auto;
            display: flex;
            flex-direction: row;
            display: none;
        }
        .gizmoToolsIcons img{
            height: 4rem;
            width: auto;
            /* border: 1px solid gray; */
        }

        .gizmoToolsIcons img:hover{
           filter:drop-shadow(2px 2px 5px white);
        }

        .gizmoLabel{
            display:none;
            position: absolute;
            color: white;
            transform: translate(-90%, -90%);
            font-size: 1.2rem;
            text-shadow: 0px 0px 3px #000000;
            background: #0b91c3a3;
            font-family: 'Nasalization Rg';
            width: 10vw;
            height: 3.5vh;
            text-align: center;
            border-radius: 12px
        }

        .gizmoToolsIcons:hover span{
            display:inline-block;
        }

        #offGizmo img, #deleteGizmo img{
            height:3.2rem;
            padding-top:22%;
        }
    </style>
  
@endsection

@section('content')
    <input type="hidden" id="userId" value="{{$userId}}"></input>

    <canvas id="canvas" style=""></canvas>
    
    <div id="loadingScreenDiv" style="">
        We all need patience.
        <br/>Please use it. 
        <br/>This may take a little while to download.
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
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

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front/images3D/fullscreen-btn.png')}}" alt="fullscreen-img" >
    </div>

   

    <div id="takeScreenshotMain">
        <div class="tooltips">
            <span>Take Screenshot</span>
        </div>
        <i class="fas fa-camera mainScreenshotIcon"></i>
        <div class="submenu takeScreenshotMain-submenu">
            <ul>
                <li><i class="fas fa-camera-retro" style=""></i><a href="" id="take-screenshot-submenu"> Capture Now</a></li>
                <li><i class="fas fa-redo" style=""></i><a href="" id="resetScene-submenu"> Reset Scene </a></li>
            </ul>
        </div>
    </div>
    
    <div class="modal fade" id="showScreenshotModal" aria-hidden="true" style="display:none;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Your Screenshot:</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" id="modalScreenshot">
             {{-- <img id="modalScreenshot" src="" alt="this is the img"/> --}}
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="saveScreenshotBtn" type="button" class="btn btn-primary" style="">Save Screenshot</button>
                <button id="cancelScreenshotBtn" type="button" class="btn btn-secondary" data-dismiss="modal" style="">Close</button>
            </div>
            
          </div>
        </div>
    </div>

    <!--start of gizmo buttons-->
    <div id="gizmoToolsDiv">
        <div class="gizmoToolsIcons" id="positionGizmo">
            <img src="{{asset('front/images3D/designScene/posGizmo.png')}}">
            <span class="gizmoLabel">Position: ON</span>
        </div>
        <div class="gizmoToolsIcons" id="rotationGizmo">
            <img src="{{asset('front/images3D/designScene/rotateGizmo.png')}}">
            <span class="gizmoLabel">Rotation: ON</span>
        </div>
        <div class="gizmoToolsIcons" id="scaleGizmo">
            <img src="{{asset('front/images3D/designScene/scaleGizmo.png')}}">
            <span class="gizmoLabel">Scaling: ON</span>
        </div>
        <div class="gizmoToolsIcons" id="deleteGizmo">
            <img src="{{asset('front/images3D/designScene/deleteGizmo.png')}}">
            <span class="gizmoLabel">Delete Flower</span>
        </div>
        <div class="gizmoToolsIcons" id="offGizmo">
            <img src="{{asset('front/images3D/designScene/offGizmo.png')}}">
            <span class="gizmoLabel">Off Tool</span>
        </div>
        {{-- <div class="tooltips">
            <span>Take Screenshot</span>
        </div> --}}
        {{-- <i class="fas fa-camera mainScreenshotIcon"></i> --}}
        {{-- <div class="submenu takeScreenshotMain-submenu">
            <ul>
                <li><i class="fas fa-camera-retro" style=""></i><a href="" id="take-screenshot-submenu"> Capture Now</a></li>
                <li><i class="fas fa-redo" style=""></i><a href="" id="resetScene-submenu"> Reset Scene </a></li>
            </ul>
        </div> --}}
    
    </div>
   


    <script>
        var token = '{{ Session::token() }}';
        var urlDesignPanel = '{{ route('frontend.user.storeDesignPanel') }}';
        var urlDesignScreenshot = '{{ route('frontend.user.storeDesignPanelScreenshot') }}';
        var has_load_game = '{{ $has_load_game ?? '' }}';
        var load_filename = '{{$filename ?? ''}}';
        var user_panels = '{{$user_panels ?? ''}}'

    
    </script>
    
@endsection

@section('after-scripts')

   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/mbayeMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/designSceneMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/earthFlowersScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/designScene.js')}}"></script>


@endsection
