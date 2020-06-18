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
  </style>
@endsection

@section('content')
    <input type="hidden" id="userId" value="{{$userId}}"></input>

    <canvas id="canvas"></canvas>
    
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
    <script>
        var token = '{{ Session::token() }}';
        var urlDesignPanel = '{{ route('frontend.user.storeDesignPanel') }}';
        var has_load_game = '{{ $has_load_game ?? '' }}';
        var load_filename = '{{$filename ?? ''}}';
        var user_panels = '{{$user_panels ?? ''}}'

 
    </script>
    
@endsection

@section('after-scripts')

   

    
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/mbayeMaps.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/earthFlowersScene.js"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/designPanel/designScene.js"></script>
    <script>
       
    </script>
    

@endsection
