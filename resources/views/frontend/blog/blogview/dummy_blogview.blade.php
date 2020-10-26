<meta name="url" content="{{ url('') }}">
@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">

@section('before-styles')
@endsection
<style>
    .blog-button-1{ 
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-55%,-1%);
    width: 100%;
    }
    .button-div{
        border:0px solid green;
    }
    </style>

@section('content')
<div class="app">
<div id="block_land">
    <div class="content">
        <h1 class="text-glow">Turn your device in landscape mode.</h1>
        <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
    </div>
</div>
<!-- For nouvela animation -->
<section class="container-fluid">
    <div class="div_container " style=""> 
        <div id="overlay"></div>
    <img  class="img-nouvela"  style="display:none" src="{{ asset('front') }}/images/naff555Votes.png" >
    <div>
</section>
<blogview-component></blogview-component>

<div class="astro-div navigator-div">
    <img src="{{ asset('front/images/astronut/trevor_astronaut.png') }}"  class="img_astro"  alt="" style="width:36vw;">
    <div class="tos-div thomasina" style="display:none;">
        <button class="tos-btn tooltips right">
            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
            <span class="tooltiptext">Terms of Services</span></button>
    </div>
   
    <div style="display:none;" class="user-photo">
    </div>

    <div class="navigator-buttons" style="display:none;">
        <div class="column column-1">
            <button class="music-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt="">
                <span class="tooltiptext">Music on/off</span></button>
            <button class="home-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt="">
                <span class="tooltiptext">Home</span></button>
        </div>
        <div class="column column-2">
            <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
        </div>
        <div class="column column-3">
            <button class="tooltips right ">
             <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
            <button class="profile-btn tooltips right">
                <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                <span class="tooltiptext">User Profile</span></button>
        </div>
    </div>
 <button class="zoom-btn zoom-in " style="display:none;"><i class="fas fa-search-plus"></i></button>
     <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
    <div class="instructions-div btn_pointer tooltips right" style="display:none;">
        <button class="instructions-btn tooltips right">
            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
            <span class="tooltiptext">Instructions</span></button>
    </div>
    <button style="display:none;" class="communicator-div tooltips top btn_pointer" >
      
    </button>
    <div class="comm-btn  top btn_pointer" style="display:none;">
    <span class="communicator-span    tooltips_span tooltiptext" >Communicator</span>
    </div>
    <button class="music-volume-div tooltips top btn_pointer" style="display:none;">
        <span>Music Volume Up/Down</span>
    </button>
   <button class="navigator-zoomout-btn" style="display:none;">
        <i class="fas fa-undo-alt"></i>
    </button>
</div>
    <!-- For  notes --->
   <!--cdefgab-->
  
<div class="audio-div">
    <audio id="1" src="{{ asset('front') }}/audio/c3.mp3" ></audio>
    <audio id="2" src="{{ asset('front') }}/audio/d3.mp3" ></audio>
    <audio id="3" src="{{ asset('front') }}/audio/e3.mp3" ></audio>
    <audio id="4" src="{{ asset('front') }}/audio/f3.mp3" ></audio>
    <audio id="5" src="{{ asset('front') }}/audio/g3.mp3" ></audio>
    <audio id="6" src="{{ asset('front') }}/audio/a3.mp3" ></audio>
    <audio id="7" src="{{ asset('front') }}/audio/b3.mp3" ></audio>

    <audio id="8" src="{{ asset('front') }}/audio/c4.mp3" ></audio>
    <audio id="9" src="{{ asset('front') }}/audio/d4.mp3" ></audio>
    <audio id="10" src="{{ asset('front') }}/audio/e4.mp3" ></audio>
    <audio id="11" src="{{ asset('front') }}/audio/f4.mp3" ></audio>
    <audio id="12" src="{{ asset('front') }}/audio/g4.mp3" ></audio>
    <audio id="13" src="{{ asset('front') }}/audio/a4.mp3" ></audio>
    <audio id="14" src="{{ asset('front') }}/audio/b4.mp3" ></audio>
    
    <audio id="15" src="{{ asset('front') }}/audio/c5.mp3" ></audio>
    <audio id="16" src="{{ asset('front') }}/audio/d5.mp3" ></audio>
    <audio id="17" src="{{ asset('front') }}/audio/e5.mp3" ></audio>
    <audio id="18" src="{{ asset('front') }}/audio/f5.mp3" ></audio>
    <audio id="19" src="{{ asset('front') }}/audio/g5.mp3" ></audio>
    <audio id="20" src="{{ asset('front') }}/audio/a5.mp3" ></audio>
    <audio id="21" src="{{ asset('front') }}/audio/b5.mp3" ></audio>

    <audio id="22" src="{{ asset('front') }}/audio/c6.mp3" ></audio>
    <audio id="23" src="{{ asset('front') }}/audio/d6.mp3" ></audio>
    <audio id="24" src="{{ asset('front') }}/audio/e6.mp3" ></audio>
    <audio id="25" src="{{ asset('front') }}/audio/f6.mp3" ></audio>
    <audio id="26" src="{{ asset('front') }}/audio/g6.mp3" ></audio>
    <audio id="27" src="{{ asset('front') }}/audio/a6.mp3" ></audio>
    <audio id="28" src="{{ asset('front') }}/audio/b6.mp3" ></audio>

    <!--fart -->
    <audio id="fart" src="{{ asset('front') }}/audio/fart/fart.mp3" ></audio>
</div>      
         <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
</div>  
@endsection

@section('after-scripts') 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('front/JS/hammer.min.js')}}"></script>
  <script type="text/javascript">

    var url = $('meta[name="url"]').attr('content');
    var last_page='';
    var Total_count=0;
    var scroll_type='';
    var count=0;
 
$(document).ready(function() {

    var elem = document.documentElement;
        function openFullscreen()
         {
            if (elem.mozRequestFullScreen) {  /* Firefox */
            elem.mozRequestFullScreen(); 
            contentDisplay();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
                contentDisplay();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
                contentDisplay();
            }
            else if (elem.requestFullscreen) {
                elem.requestFullscreen();
                contentDisplay();
            } 
            else{ 
                contentDisplay();
            }

        }
if(window.innerWidth < 991 ){
$(document).ready(()=>{
    Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
            padding: '15px',
            background: 'rgba(8, 64, 147, 0.62)',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen()
            }
        });
    });
}
else  contentDisplay();

function contentDisplay() { 
      setTimeout(function(){
        $(".astro-div").css({'display':'flex'}); 
        $(".page").css({'visibility':'visible'});
        $(".astro-div").css({'visibility':'visible'});
            
            
        $(".page").addClass('animate-zoomIn-arm');
  
        $('.page').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){ 
   $(".page").removeClass('animate-zoomIn-arm');
    $(".page").addClass('zoomIn-arm');
   });

        }, 1000
);
    }
});
    (function () {
    
        $(".img-nouvela").removeClass("ani-rollout_naff");
          // for showing message to turn to landscape 
          testOrientation();
          window.addEventListener("orientationchange", function(event) {
          testOrientation();
        }, false);

        window.addEventListener("resize", function(event) {
        testOrientation();
        }, false);

        function testOrientation() 
        {
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

       
        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .div_overlay").css({'display':'none'});   
            $("#clicked_img .div_title").css({'display':'none'});   
            $("#clicked_img .div_btn").css({'display':'none'});
            $(".div_overlay").removeClass("div_overlay_p");
            $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'unset','left':'0'});
            $(".blog-buttons_overlay .button-div").css({'flex-direction':'unset'});
            $('div.cell').removeAttr('id');
            $(this).attr('id','clicked_img');
            var clicked_img_id = $(this).attr('id');
            var img = $("#clicked_img> a>img");
            var pos = $("#clicked_img> a>img").position();
            var  top=$("#clicked_img> a>img").css("top");
            var  left=$("#clicked_img> a>img").css("left");
            var  width=$("#clicked_img> a>img").css("width");
            var  height=$("#clicked_img> a>img" ).css("height");
         
            $("#clicked_img .div_overlay").css({'display':'flex','top':'0px'});
            $("#clicked_img .div_title").css({'display':'block'});
            $("#clicked_img .div_btn").css({'display':'block'});

           /* for checking orientation of an image*/

            if (img.width() > img.height()){
                var differernce=img.width() -img.height();
            }

         if (img.width() > img.height()){
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
              $(".blog-buttons_overlay").css({'top':'50%','left':'50%','width':'82%','transform':'translate(-49%, -67%)'});
           
            } 
            else {
              $(".div_overlay").addClass("div_overlay_p");
              $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'column','top':'50%','left':'50%','width':'82%','transform':'translate(-29%, -67%)'});
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
            } 
   
});

    })();

    $('.img-button').hover(
            function () {
                $(this).parent().find('span').show();
            },
            function () {
                $(this).parent().find('span').hide();
            }
        );
        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });

        $('.home-btn').click( function() {
           
            window.location.href = url;
        });

        $('.profile-btn').click( function() {
            window.location.href = url+'/dashboard';
        });

        $('.instructions-btn').click( function() {
            window.location.href = url+'/page_under_development';
        });

        $('.editphoto-btn').click( function() {
            window.location.href = url+'/profile/edit-photo';
        });
        $('.music-btn').click( function() {
         //   window.location.href = url+'/profile/edit-photo';
         var audio =  document.getElementById('1');
          audio.play();
        });
   
  
    
    var zoomTimer = null;
    
    function refreshImage(elem, cell)
    {
        if (cell.iszoomed)
        {
            return;
        }
    
        if (zoomTimer)
        {
            clearTimeout(zoomTimer);
        }
        
        var zoomImage = jQuery('<img class="zoom"></img>');
    
        zoomTimer = setTimeout(function ()
        {
            zoomImage.load(function ()
            {
                layoutImageInCell(zoomImage[0], cell.div[0]);
                jQuery(elem).replaceWith(zoomImage);
                cell.iszoomed = true;
            });
    
            zoomImage.attr("src", cell.info.zoom);
    
            zoomTimer = null;
        }, 2000);
    }
    //this is for sizing images through cell height, cell weidth, image height, image weidth
    function layoutImageInCell(image, cell)
    {

        var iwidth = image.width;
        var iheight = image.height;
        var cwidth = jQuery(cell).width();
        var cheight = jQuery(cell).height();
        var ratio = Math.min(cheight / iheight, cwidth / iwidth);
        
        iwidth *= ratio;
        iheight *= ratio;
        //for putting image in center
    
        image.style.width = Math.round(iwidth) + "px";
        image.style.height = Math.round(iheight) + "px";
    
        image.style.left = Math.round((cwidth - iwidth) / 2) + "px";
        image.style.top = Math.round((cheight - iheight) / 2) + "px";

        var width_for_count=Math.round(iwidth) + "px";
        var height_for_count= Math.round((iheight) /5)+ "px";
        var top_for_count= Math.round((cwidth - iwidth) / 2) + "px";
        var left_for_count= Math.round((cheight - iheight) / 2) + "px";
  
       $(".div_count").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                            left:left_for_count+"px",top:"80%",'opacity':'35%'});


     
       $(".div_img .div_count_text").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                                 left:left_for_count+"px",top:"80%"});

                                                
    }
    

/* Function to redirect to view Blog */

function viewBlog(id){  
    var url="/single_blog/"+id;
    window.open(
        url,
  '_blank' // <- This is what makes it open in a new window.
);
var audio = document.getElementById("one");
audio.pause();
  
}
/**
 * Function to play music
 * */

function play_note(id){
    $(".img-nouvela").removeClass("ani-rollout_naff");
    var clsOverlay=id +" .blog-buttons_overlay  .button-div .button-details .naff-number";
    var naffCount=$("."+clsOverlay).html();
   
    if(naffCount==555){
        var audio = document.getElementById("fart");
            audio.play();
            $("#overlay").css({'display':'none'});
            $(".img-nouvela").removeClass("ani-rollout_naff");
            $(".img-nouvela").css({'display':'block','z-index':'1000'});
            $(".img-nouvela").addClass("ani-rollout_naff");
            setTimeout(function(){
                  $(".img-nouvela").removeClass("ani-rollout_naff");
                  $(".img-nouvela").css({'display':'none'});
                  $("#overlay").css({'display':'none'});
                }, 3000);
    }
else{

    var playist=id%28;
    if(playist==0)
    {
        var audio = document.getElementById("1");
        audio.play();
    }
   else
    {
        myVar = id+1;
        var audio =  document.getElementById(myVar);
        audio.play();
    }
}
}
function largest(hot_count,cool_count,naff_count,i)
	{
        hot_count=parseInt(hot_count);
        cool_count=parseInt(cool_count);
        naff_count=parseInt(naff_count);
		
     
		if(hot_count>cool_count && hot_count>naff_count)
		{
        
           $(".div_count_bg"+i).css({'background-color':'rgba(216, 7, 7, 0.5)'});
        }
		else if(cool_count>hot_count && cool_count>naff_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(0, 118, 163, 0.5)'});
		}
		else if(naff_count>hot_count && naff_count>hot_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(199, 189, 0, 0.5)'});
        }
        else if(hot_count==0 && naff_count==0 && cool_count==0)
		{
            $(".div_count_bg"+i).css({'background-color':'#00800052'});
		}

	}

    var astronaut_zoom = 0;


        var navigator_zoom = 0;
        $('button.zoom-btn').click( function() { 
        
            if(!navigator_zoom) {
                $('.zoom-btn').hide();
                $('.navigator-buttons').css('pointer-events', 'auto');
                $('.communicator-div').css('pointer-events', 'auto');
                $('.instruction-div').css('pointer-events', 'auto');
                $('.tos-div').css('pointer-events', 'auto');
                $('.btn_pointer').css('pointer-events', 'auto');
                $('.navigator-div').addClass('animate-navigator-zoomin');
                

               $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomin');
                    $('.navigator-div').addClass('zoomin');
                    $('.zoom-btn').hide();
                });
            } else {
            
            }

            navigator_zoom = !navigator_zoom;
        });
        //Zoom out animation
        $('.navigator-zoomout-btn').click(function() {
            $('.navigator-div').addClass('animate-navigator-zoomout');

            $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.navigator-div').removeClass('animate-navigator-zoomout');
                $('.navigator-div').removeClass('zoomin');
                $('.zoom-btn').show();
                
            });

            navigator_zoom = !navigator_zoom;
        });


        function removeAstronautAnimation()
        {
            clearInterval(animation_interval);
            // $('.reaction-div').css('transition', 'none');
        }
        $(".tos-div").click(function(){
                  window.location.href = "{{URL::to('/terms')}}"
                    
                });


                $(".communicator-div").on({
    mouseenter: function () {
        $('.communicator-span').css('display', 'block');
    },
    mouseleave: function () {
        $('.communicator-span').css('display', 'none');
    }
});
                
    </script>
    
@endsection