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
        <div id="infoIconTextdown" class="instr-text-down">This is the page for Designing a Panel.<br>Please click anywhere to start.</div>
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

    <i class="fas fa-info-circle" id="infoIcon"><span class="InfoIconLabel">Instructions</span></i>
    <div id="instruction-left-div" class="instruction-left-div">
        <div class="instr-text-row">
            <div class="instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/left.png" alt=""></div>
            <div class="instr-text">3D ROTATE</div>
        </div>
        <div class="instr-text-row">
            <div class="instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/scroll.png" alt=""></div>
            <div class="instr-text">ZOOM IN/OUT</div>
        </div>
        <div class="instr-text-row">
            <div class="instr-img"><img class="instr-icon" src="{{asset('front')}}/images3D/icons/right.png" alt=""></div>
            <div class="instr-text">PANNING</div>
            {{-- <div id="closeInfoBtn" class="col-md-3 info-icon"><i class="fas fa-info-circle"></i></div> --}}
        </div>
    </div>
    
    <div id="infoIconTextastro" class="instr-text-astro">Instructions from Ruru and<br>Nuvola will appear. Please<br>use the mouse controls to<br>rotate around Mbaye and<br>choose the panel which you<br>want to start designing.</div>
    
    <div id="overlayTxtDown" class="instr-text-overlay-down">Click any panel that you like to design<br>and drag it away from the body.<br>It will take the panel into the editing view.</div>
    
    <div id="overlayTxtdragTop" class="instr-text-overlay-drag">This is your editing view in Designing a Panel.</div>
    
    <div id="instructionDivDragLeft" class="instruction-drag-div-left">
        <div id="overlayTxtscene2" class="instr-text-overlay-drag-scene">Click on the panel to control it.<br>Use the mouse control to see your best<br>view of the panel.<br>You can rotate and zoom in/out.</div>
        <div class="row">
            <div class="instr-text-rotate">
                <div class="instr-img"><img class="instr-icon-design" src="{{asset('front')}}/images3D/icons/left.png" alt=""></div>
                <div class="instr-text-design">3D ROTATE</div>
                
            </div>
            <div class="instr-text-zoom">
                <div class="instr-img"><img class="instr-icon-design" src="{{asset('front')}}/images3D/icons/scroll.png" alt=""></div>
                <div class="instr-text-design">ZOOM IN/OUT</div>
            </div>
        </div>
    </div>

    <div id="instructionDivDragRight" class="instruction-drag-div-right">
        <div id="overlayTxtscene2" class="instr-text-overlay-drag-scene">Click on the 3d world of flowers to control it.<br>Use the mouse controls to navigate around it.<br>Click flower to view designs.</div>
        <div class="row">
            <div class="instr-text-rotate-right">
                <div class="instr-img"><img class="instr-icon-design" src="{{asset('front')}}/images3D/icons/left.png" alt=""></div>
                <div class="instr-text-design">3D ROTATE</div>
                
            </div>
            <div class="instr-text-zoom-right">
                <div class="instr-img"><img class="instr-icon-design" src="{{asset('front')}}/images3D/icons/scroll.png" alt=""></div>
                <div class="instr-text-design">ZOOM IN/OUT</div>
            </div>
            <div class="instr-text-panning-right">
                <div class="instr-img"><img class="instr-icon-design" src="{{asset('front')}}/images3D/icons/right.png" alt=""></div>
                <div class="instr-text-design">PANNING</div>
                {{-- <div id="closeInfoBtn" class="col-md-3 info-icon"><i class="fas fa-info-circle"></i></div> --}}
            </div>
        </div>
    </div>

    <h2 id="textCurve"> This is your chosen panel<h2>
    
    <div id="overlayTxtBook" class="instr-text-overlay-book">You will have<br>multiple options<br>for the 2D designs.<br>Click a flower to place it on the panel.</div>
    
    <div id="overlayTxtBookRight" class="instr-text-overlay-book-right">Once you clicked a flower on the 3d world,<br>the book of flowers will appear to show you our<br>2d interpretations of the flower you chose.<br>for the 2D designs.<br>Click a flower to place it on the panel.</div>
    
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

<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{asset('front/babylonjs/scenes/commonScenes.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/mbayeMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/designSceneMaps.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/earthFlowersScene.js')}}"></script>
    <script src="{{asset('front/babylonjs/scenes/designPanel/designScene.js')}}"></script>


@endsection

