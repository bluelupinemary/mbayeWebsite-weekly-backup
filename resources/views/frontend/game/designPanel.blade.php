@extends('frontend.layouts.game_layout')
@section('before-styles')
    <link href="{{asset('front')}}/CSS/game/DesignPanelStyle.css" rel="stylesheet"/>
    
  <style>
        .trevor-popup-class{
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: auto 100% !important;
            height:25vh !important;
        }
        .screenshot-swal{
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: auto 100% !important;
            height:25vh !important;
            width:50vw !important;
        }
        #showScreenshotModal .modal-content {
            background: rgba(8, 64, 147, 0.6);
            box-shadow: 0px 0px 20px #17a2b8;
            font-family: 'Nasalization Rg';
            font-size:1rem;
        }
        #showScreenshotModal .modal-body {
           width:auto;
           height:40vw;
        }
        #showScreenshotModal .modal-header {
            background: rgba(2, 40, 96, 0.62);
            color:white;
        }

        #modalScreenshot{
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: contain !important;
            
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
                <button id="saveScreenshotBtn" type="button" class="btn btn-primary" style="border-color:white;">Save Screenshot</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:red;border-color:white;">Close</button>
            </div>
            
          </div>
        </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/mbayeMaps.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/earthFlowersScene.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/designScene.js"></script>
    <script>
       
    </script>
    

@endsection
