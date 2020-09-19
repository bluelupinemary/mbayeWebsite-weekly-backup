@extends('frontend.layouts.game_layout')
@section('before-styles')
  <link href="{{asset('front')}}/CSS/game/HomeSceneStyle.css" rel="stylesheet"/>   
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  

  <style>
    #overlayText{
        font-family: 'Courgette-Regular' !important;
        font-weight: normal;
        font-style: normal;
        text-align: center;
        text-shadow: -2px 1px 20px black;
        font-size: 2em;
        color: #e9ba29;
    }
    #fullscreenIcon{
       position:absolute;  
       top:0;
       right:0;
    }
    #fullscreenImg{
        width:5vh;
        height:auto;
    }
    #fullscreenImg:hover{
        filter: drop-shadow(0px 0px 4px white);
    }
    
    #fs-desc{
        top: 0;
        color: #e9ba29;
        position: absolute;
        right: 0;
        font-family: 'Courgette-Regular' !important;
        font-size: 1.5em;
        padding-right: 7vh;
        padding-top:1vh;
    }



  </style>
@endsection

@section('content')
    <input type='hidden' id='storyChapter' value='1'>
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    
    <div id="loadingScreenDiv" style="">
      
    </div>
    

    <div id="loadingScreenOverlay" >
        <div id="overlayText">Sorry, these planets are not yet accessible as we continue with the development for your eventual participation.
            <br/>For any inquiries, please email <a id="infoLink" href="mailto:issa.arch@einoxarabia.com">issa.arch@inoxarabia.com</a>
            <br/><br/><br/>
            Please click anywhere to start.
        </div>
        <span id="fs-desc">Enable Fullscreen</span>
    </div>
   
    <div id="loadingScreenPercent" style="padding-top: 2%;">
        Loading: 0 %
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="rotate-img">
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

