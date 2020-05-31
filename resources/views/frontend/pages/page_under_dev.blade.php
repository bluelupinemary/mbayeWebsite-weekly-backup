@extends('frontend.layouts.app')

@section('before-styles')
<style type="text/css">
body{
  background-image: url(../front/images/skybox_bg1.png);
}
  #blocks{
  position: absolute;
  top: 0;
  left: 0;
  text-align: center;
  background-size: cover;
  background-position: center;
  width: 100%;
  height: 100vh;
  display: block;
  color: #fff;
  z-index: 200000;
  font-size: 20px;
}
#blocks h1 {
  
}
#blocks .contents {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
}
</style>
@endsection

@section('content')
<div id="block_land">
  <div class="content">
      <h1 class="text-glow">Turn your device in landscape mode.</h1>
      <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
  </div>
</div>

  <section class="container">
  <div class=" div_container">
    <div id="blocks">
      <div class="contents">
        <h1 style="color:white;font-family:Courgette !important"> This page is still under development.</h1>
      </div>
    </div>
  <div>
  </section>
</div>
@endsection

@section('after-scripts')
  <script>
      // for showing message to turn to landscape 
      testOrientation();
      window.addEventListener("orientationchange", function(event) {    
      testOrientation();
      }, false);

    window.addEventListener("resize", function(event) {
        testOrientation();
    }, false);

    function testOrientation() {
      document.getElementById('block_land').style.display = (screen.width>screen.height) ? 'none' : 'block';

      //above condition is not working sometimes then this condition will work
      if(window.innerHeight< window.innerWidth)
            {
              document.getElementById('block_land').style.display = 'none' ;
            }
            else{
              document.getElementById('block_land').style.display =  'block';
            }
    }
   

  $(document).ready(function () {
     
});
	

  </script>
@endsection
