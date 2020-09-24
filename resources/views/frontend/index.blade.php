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




.lds-spinner {
  color: official;
  display: inline-block;
  position: absolute;
    /* width: 20vw; */
    /* height: 20vw; */
    left: 50vw;
    bottom: 50vh;
}
.lds-spinner div {
  transform-origin: 40px 40px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 37px;
  width: 6px;
  height: 18px;
  border-radius: 20%;
  background: #fff;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}




  </style>
@endsection

@section('content')
    <input type='hidden' id='storyChapter' value='1'>
    <div>
        <canvas id="canvas"></canvas>
    </div>
    
    
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
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

