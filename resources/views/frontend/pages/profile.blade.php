@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/profile_style.css') }}">
@endsection

@section('content')
<div id="block_land">
  <div class="content">
      <h1 class="text-glow">Turn your device in landscape mode.</h1>
      <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
  </div>
</div>

  <section class="container-fluid">
  <div class=" div_container">
  <img  class="img_sun img_sun1 img-fluid" src="{{ asset('front') }}/Images/agreement/s1.png" >

  <div class="page_1" >
              <img class="next_button_ag img-fluid" src="{{ asset('front') }}/Images/next_sun.png" onclick="changepage();">
  </div>

  <div class="page_2" >
              <img class="text_part22 img_sun2 img-fluid" src="{{ asset('front') }}/Images/agreement/s2.png" >
              <img class="btn_agree img-fluid"  id="btn_agree" src="{{ asset('front') }}/Images/ag.png" style="" onclick="fun_agree();">
              <img class="prev_button_ag img-fluid" src="{{ asset('front') }}/Images/prev_sun.png" style="" onclick="changeprev();">
  </div>
  <div>
  </section>
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
    $(".img_sun").removeClass("ani-rollout_earth");
    $(".text_part1").removeClass("ani-rollout_text");

  $(document).ready(function () {
        $('.img_sun').css({'display':'block'});
        $('.img_sun2').css({'display':'none'});
        $(".img_sun").addClass("ani-rollout_earth");
            setTimeout(function () {
              $('.next_button_ag').css({'display':'block'}); 
            //  $('.text_part1').css({'display':'block'});
        }, 5000);
});
	/**
  Function for changing page next next page of the agreement  */
      function changepage(){
           $('.img_sun').css({'display':'none'});
          $('.page_1').css({'display':'none'});
          $('.text_part1').css({'display':'none'});
          $('.img_sun2').css({'display':'block'});
          $('.page_2').css({'display':'block'});
          $('#btn_agree').css({'display':'block'});
          $('.prev_button_ag').css({'display':'block'});
          $(".img_sun").removeClass("ani-rollout_earth");
      
      }
/**
Function for changing to previous page of agreement */
      function changeprev(){
        $('.img_sun').css({'display':'block'});
        $('.page_1').css({'display':'block'});
        $('.text_part1').css({'display':'block'});
        $('.img_sun2').css({'display':'none'});
        $('.page_2').css({'display':'none'});
      }

function fun_agree(){
window.location.href = "{{URL::to('register')}}"
}


  </script>
@endsection
