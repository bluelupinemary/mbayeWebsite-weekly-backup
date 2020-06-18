<meta name="url" content="{{ url('') }}">
@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
    <div class="most-naffed">
        <span class="title_text">Most Naffed</span>





    <div class="container">
        <div class="row ">
            <div class="col-md-12">
            {{-- <div class=""> --}}
              <div class="carousel slide multi-item-carousel col-md-12" id="theCarousel">
                {{-- <div class="carousel slide multi-item-carousel " id="theCarousel">  --}}
                <div class="carousel-inner col-md-12">
                    {{-- <div class="carousel-inner "> --}}
                    <div class="col-xs-4 img_left main-naff">
                        {{-- <div class=" img_left"> --}}
                            <a href="#1">
                                <h2 class="blog_name" id="blog_name_h1">Most Naffed!</h2>
                                <h2 class="blog_name" id="blog_name_first"></h2>
                                <img src=""  id="1" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-xs-4 img_center main-naff">
                            {{-- <div class=" img_center"> --}}
                            <a href="#1">
                                <h2 class="blog_name" id="blog_name_h2">2nd Most Naffed!</h2>
                                <h2 class="blog_name" id="blog_name_second"></h2>
                                <img src=""  id="2" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-xs-4 img_right main-naff">
                            {{-- <div class=" img_right"> --}}
                            <a href="#1">
                                <h2 class="blog_name" id="blog_name_h3">3rd Most Naffed!</h2>
                                <h2 class="blog_name" id="blog_name_third"></h2>
                                <img src=""  id="3" class="img-responsive">
                            </a>
                        </div>
                        <input type="hidden" id="prev_no" value="0">
                        <input type="hidden" id="middle_no" value="1">
                        <input type="hidden" id="next_no" value="2">
                     
                  
             
                </div>
                <a class="left-arrow carousel-control" href="#theCarousel" data-slide="prev" onclick="go_to_previous()"><i class="glyphicon glyphicon-chevron-left arrow"></i></a>
                <a class="right-arrow carousel-control" href="#theCarousel" data-slide="next" onclick="go_to_next()"><i class="glyphicon glyphicon-chevron-right arrow"></i></a>
              </div>
            </div>
          </div>
        <!--<div class="cell_left img_cell">

        </div>
        <div class="cell_center img_cell">
            
        </div>
        <div class="cell_right img_cell">
            
        </div>-->
    </div>
    </div>
<div class="page view ">

    <div class="origin view">
        <div id="camera" class="view">
            <div id="dolly" class="view">
                <div id="stack" class="view">
                </div>
                <div id="mirror" class="view">
                    <div id="rstack" class="view">
                    </div>
                    <div id="rstack2" class="view">
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
 
</div>
<div class="astro-div navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
    @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
    <img src="{{ asset('front/images/astronut/Thomasina_blog.png') }}"  class="img_astro"  alt="">
    <div class="tos-div thomasina">
        <button class="tos-btn tooltips right">
            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
            <span class="tooltiptext">Terms of Services</span></button>
    </div>
    @else
    <img src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""class="img_astro" alt="">
    <div class="tos-div">
        <button class="tos-btn tooltips right">
            <img  class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
            <span class="tooltiptext">Terms of Services</span></button>
    </div>
    @endif
    <div class="user-photo {{access()->user()->getGender()}}">
        <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
    </div>
    <div class="navigator-buttons">
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
 <button class="zoom-btn zoom-in "><i class="fas fa-search-plus"></i></button>
     <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
    <div class="instructions-div btn_pointer tooltips right">
        <button class="instructions-btn tooltips right">
            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
            <span class="tooltiptext">Instructions</span></button>
    </div>
    <button class="communicator-div tooltips top btn_pointer @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom   @else  tomasina @endif" >
      
    </button>
    <div class="comm-btn  top btn_pointer">
    <span class="communicator-span    tooltips_span tooltiptext" >Communicator</span>
    </div>
    <button class="music-volume-div tooltips top btn_pointer">
        <span>Music Volume Up/Down</span>
    </button>
   <button class="navigator-zoomout-btn">
        <i class="fas fa-undo-alt"></i>
    </button>
</div>
    <!-- For  notes --->
   <!--cdefgab-->
  
<div class="audio-div">
    <audio id="1" src="{{ asset('front') }}/audio/3/c3.mp3" ></audio>
    <audio id="2" src="{{ asset('front') }}/audio/3/d3.mp3" ></audio>
    <audio id="3" src="{{ asset('front') }}/audio/3/e3.mp3" ></audio>
    <audio id="4" src="{{ asset('front') }}/audio/3/f3.mp3" ></audio>
    <audio id="5" src="{{ asset('front') }}/audio/3/g3.mp3" ></audio>
    <audio id="6" src="{{ asset('front') }}/audio/3/a3.mp3" ></audio>
    <audio id="7" src="{{ asset('front') }}/audio/3/b3.mp3" ></audio>

    <audio id="8" src="{{ asset('front') }}/audio/4/c4.mp3" ></audio>
    <audio id="9" src="{{ asset('front') }}/audio/4/d4.mp3" ></audio>
    <audio id="10" src="{{ asset('front') }}/audio/4/e4.mp3" ></audio>
    <audio id="11" src="{{ asset('front') }}/audio/4/f4.mp3" ></audio>
    <audio id="12" src="{{ asset('front') }}/audio/4/g4.mp3" ></audio>
    <audio id="13" src="{{ asset('front') }}/audio/4/a4.mp3" ></audio>
    <audio id="14" src="{{ asset('front') }}/audio/4/b4.mp3" ></audio>
    
    <audio id="15" src="{{ asset('front') }}/audio/5/c5.mp3" ></audio>
    <audio id="16" src="{{ asset('front') }}/audio/5/d5.mp3" ></audio>
    <audio id="17" src="{{ asset('front') }}/audio/5/e5.mp3" ></audio>
    <audio id="18" src="{{ asset('front') }}/audio/5/f5.mp3" ></audio>
    <audio id="19" src="{{ asset('front') }}/audio/5/g5.mp3" ></audio>
    <audio id="20" src="{{ asset('front') }}/audio/5/a5.mp3" ></audio>
    <audio id="21" src="{{ asset('front') }}/audio/5/b5.mp3" ></audio>

    <audio id="22" src="{{ asset('front') }}/audio/6/c6.mp3" ></audio>
    <audio id="23" src="{{ asset('front') }}/audio/6/d6.mp3" ></audio>
    <audio id="24" src="{{ asset('front') }}/audio/6/e6.mp3" ></audio>
    <audio id="25" src="{{ asset('front') }}/audio/6/f6.mp3" ></audio>
    <audio id="26" src="{{ asset('front') }}/audio/6/g6.mp3" ></audio>
    <audio id="27" src="{{ asset('front') }}/audio/6/a6.mp3" ></audio>
    <audio id="28" src="{{ asset('front') }}/audio/6/b6.mp3" ></audio>

    <!--fart -->
    <audio id="fart" src="{{ asset('front') }}/audio/fart/fart.mp3" ></audio>
</div>      
         <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
  


    
    
@endsection

@section('after-scripts') 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('front/JS/hammer.min.js')}}"></script>
  <script src="{{asset('front/JS/circletype.min.js')}}"></script>
  {{-- <script src="{{asset('front/JS/jquery.mousewheel.min.js')}}"></script>
  <script src="{{asset('front/JS/TweenMax.min.js')}}"></script>
  <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
  <script src="{{asset('front/JS/jquery.ui.touch-punch.min.js')}}"></script>
  {{-- <script src="{{asset('front/JS/draggabilly.min.js')}}"></script> --}}
  {{-- <script src="{{asset('front/JS/cropper.min.js')}}"></script>
  <script src="{{asset('front/JS/circletype.min.js')}}"></script>
  <script src="{{asset('front/JS/jquery-migrate-1.2.1.min.js')}}"></script>
  
  <script src="{{asset('front/JS/jquery.mobile-1.4.5.min.js')}}"></script>  --}}
  <script type="text/javascript">

    var CWIDTH;
    var CHEIGHT;
    var CGAP = 5;
    var CXSPACING;
    var CYSPACING;
    var scrtype = '';
    var scrollcount = 1;
    var images=[];
    var images_new=[];
    var Total_pages;
    var load_count=0;
    var url = $('meta[name="url"]').attr('content');
    var last_page='';
    var Total_count=0;
    var scroll_type='';
    var count=0;

    var ClickCount=0;
    var arrCount = [
     {
        'id': '1', 'name': '1', 'thumb': '/storage/img/general_blogs/1591438745workshop.jpg', 'naffcount': '250' 
		
    },
    {
        'id': '16', 'name': '2', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '200' 
		
    },
    {
        'id': '2', 'name': '3', 'thumb': '/storage/img/general_blogs/1591438556a2.jpg', 'naffcount': '190' 
		
    },

    {
        'id': '4', 'name': '4', 'thumb': '/storage/img/general_blogs/1587381503a8.jpg', 'naffcount': '186' 
		
    },
  {
        'id': '5', 'name': '5', 'thumb': '/storage/img/general_blogs/1590997811a12.JPG', 'naffcount': '175' 
		
    },
    {
        'id': '6', 'name': '6', 'thumb': '/storage/img/general_blogs/1591438590a1.jpg', 'naffcount': '165' 
		
    },
     {
        'id': '7', 'name': '7', 'thumb': '/storage/img/general_blogs/1591438711a12.jpg', 'naffcount': '150' 
		
    },
    {
        'id': '8', 'name': '8', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '140' 
		
    },
    {
        'id': '9', 'name': '9', 'thumb': '/storage/img/general_blogs/1591017337a27.jpg', 'naffcount': '115' 
		
    },
    {
        'id': '10', 'name': '10', 'thumb': '/storage/img/general_blogs/1591017196a24.jpg', 'naffcount': '112' 
		
    },
    {
        'id': '11', 'name': '11', 'thumb': '/storage/img/general_blogs/1591001910a9.jpg', 'naffcount': '111' 
		
    },
    {
        'id': '12', 'name': '12', 'thumb': '/storage/img/general_blogs/1590996475a15.jpg', 'naffcount': '107' 
		
    },
    {
        'id': '13', 'name': '13', 'thumb': '/storage/img/general_blogs/1590992683a20.jpg', 'naffcount': '105' 
		
    },
    {
        'id': '14', 'name': '14', 'thumb': '/storage/img/general_blogs/1590993113a27.jpg', 'naffcount': '100' 
		
    },
    {
        'id': '15', 'name': '8', 'thumb': '/storage/img/general_blogs/1590837335hotwire.jpg', 'naffcount': '90' 
		
    },
    {
        'id': '16', 'name': '16', 'thumb': '/storage/img/general_blogs/1589437214a2.jpg', 'naffcount': '89' 
		
    },
    {
        'id': '17', 'name': '17', 'thumb': '/storage/img/general_blogs/1589280324a30.jpg', 'naffcount': '88' 
		
    },
    {
        'id': '18', 'name': '18', 'thumb': '/storage/img/general_blogs/15892020981585466954a21.jpg', 'naffcount': '87' 
		
    },
    {
        'id': '19', 'name': '19', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '86' 
		
    },
    {
        'id': '20', 'name': '20', 'thumb': '/storage/img/general_blogs/15891789751585467010a28.png', 'naffcount': '85' 
		
    },
    {
        'id': '21', 'name': '21', 'thumb': '/storage/img/general_blogs/15874496301584960852a27.jpg', 'naffcount': '84' 
		
    },
    {
        'id': '22', 'name': '22', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '83' 
		
    },
    {
        'id': '23', 'name': '23', 'thumb': '/storage/img/general_blogs/1587448536a5.jpg', 'naffcount': '82' 
		
    },
    {
        'id': '24', 'name': '24', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '81' 
		
    },
    {
        'id': '25', 'name': '25', 'thumb': '/storage/img/general_blogs/1587448329a26.jpg', 'naffcount': '80' 
		
    },
    {
        'id': '26', 'name': '26', 'thumb': '/storage/img/general_blogs/1587447873a8.jpg', 'naffcount': '79' 
		
    },
    {
        'id': '27', 'name': '27', 'thumb': '/storage/img/general_blogs/1587447896a9.jpg', 'naffcount': '78' 
		
    },
    {
        'id': '28', 'name': '28', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '77' 
		
    },
    {
        'id': '29', 'name': '29', 'thumb': '/storage/img/general_blogs/1587447820a47.jpg', 'naffcount': '76' 
		
    },
    {
        'id': '30', 'name': '30', 'thumb': '/storage/img/general_blogs/15873817156.jpg', 'naffcount': '75' 
		
    },
    {
        'id': '31', 'name': '31', 'thumb': '/storage/img/general_blogs/1587381592a25.jpg', 'naffcount': '74' 
		
    },
    {
        'id': '32', 'name': '32', 'thumb': '/storage/img/general_blogs/1587381749WGKM8334.jpg', 'naffcount': '73' 
		
    },
    {
        'id': '33', 'name': '33', 'thumb': '/storage/img/general_blogs/15873818711.jpg', 'naffcount': '72' 
		
    },
    {
        'id': '34', 'name': '34', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '70' 
		
    },
    {
        'id': '35', 'name': '35', 'thumb': '/storage/img/general_blogs/1587381672NMYK0151.jpg', 'naffcount': '68' 
		
    },
    {
        'id': '36', 'name': '36', 'thumb': '/storage/img/general_blogs/15873817372.jpg', 'naffcount': '66' 
		
    },
    {
        'id': '37', 'name': '37', 'thumb': '/storage/img/general_blogs/1587382112a33.jpg', 'naffcount': '65' 
		
    },
    {
        'id': '38', 'name': '38', 'thumb': '/storage/img/general_blogs/1587382648a5.jpg', 'naffcount': '55' 
		
    },
    {
        'id': '39', 'name': '39', 'thumb': '/storage/img/general_blogs/1587381556a9.jpg', 'naffcount': '45' 
		
    },
    {
        'id': '40', 'name': '40', 'thumb': '/storage/img/general_blogs/default.png', 'naffcount': '40' 
		
    },
    {
        'id': '41', 'name': '41', 'thumb': '/storage/img/general_blogs/1587381503a8.jpg', 'naffcount': '37' 
		
    },
    {
        'id': '42', 'name': '42', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '36' 
		
    },
    {
        'id': '43', 'name': '43', 'thumb': '/storage/img/general_blogs/1591438728a11.jpg', 'naffcount': '35' 
		
    },
    {
        'id': '44', 'name': '44', 'thumb': '/storage/img/general_blogs/1591017337a27.jpg', 'naffcount': '25' 
		
    },
    {
        'id': '45', 'name': '45', 'thumb': '/storage/img/general_blogs/1587387430a33.jpg', 'naffcount': '15' 
		
    },
    {
        'id': '46', 'name': '46', 'thumb': '/storage/img/general_blogs/15873829561.jpg', 'naffcount': '13' 
		
    },
    {
        'id': '47', 'name': '47', 'thumb': '/storage/img/general_blogs/1587386094Museum (4).jpg', 'naffcount': '9' 
		
    },
    {
        'id': '48', 'name': '48', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '8' 
		
    },
    {
        'id': '49', 'name': '49', 'thumb': '/storage/img/general_blogs/1587381592a25.jpg', 'naffcount': '7' 
		
    },
    {
        'id': '50', 'name': '50', 'thumb': '/storage/img/general_blogs/1591438590a1.jpg', 'naffcount': '5' 
		
    },
    ];
    
 
$(document).ready(function() {
    $('.main-naff').css('opacity', '1');


$("#1").attr("src",arrCount[ClickCount].thumb);
$("#2").attr("src",arrCount[ClickCount+1].thumb);
$("#3").attr("src",arrCount[ClickCount+2].thumb);

$("#1").attr("blog_id",arrCount[ClickCount].id);
$("#2").attr("blog_id",arrCount[ClickCount+1].id);
$("#3").attr("blog_id",arrCount[ClickCount+2].id);



$('#1').attr('onClick','viewBlog('+arrCount[ClickCount].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[ClickCount+1].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[ClickCount+2].id+')');

// $("#blog_name_first").html("Naff Count:"+arrCount[ClickCount].naffcount);
// $("#blog_name_second").html("Naff Count:"+arrCount[ClickCount+1].naffcount);
// $("#blog_name_third").html("Naff Count:"+arrCount[ClickCount+2].naffcount);
$("#blog_name_first").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount].naffcount+'</span>');
$("#blog_name_second").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount+1].naffcount+'</span>');
$("#blog_name_third").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount+2].naffcount+'</span>');

// Planet name circle style
new CircleType(document.getElementById('blog_name_first'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_second'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_third'))
.dir(-1)
.radius(60);


new CircleType(document.getElementById('blog_name_h1'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h2'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h3'))
.dir(1)
.radius(60);

    var elem = document.documentElement;
function openFullscreen() {
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
  //alert("iphone")
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
      // $(".most-naffed").css({'visibility':'visible'});
            
            
        $(".page").addClass('animate-zoomIn-arm');
  
        $('.page').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){ 
   $(".page").removeClass('animate-zoomIn-arm');
    $(".page").addClass('zoomIn-arm');
   });

        }, 1000
);
    }
});
function go_to_next(){
    var next = document.getElementById( "next_no" ).value;
    var prev = document.getElementById( "prev_no" ).value;
    var middle = document.getElementById( "middle_no" ).value;
    // console.log("1"+next+"--"+prev+"--"+middle)
    
   
    //alert(index)
//   if(ClickCount==arrCount.length)
//       ClickCount=0;
   // $(".carousel-inner > .item > .img_left> img > #1").attr("src",arrCount[0].thumb);

   var first=parseInt(prev)+parseInt(3);
   var second=parseInt(middle)+parseInt(3);
   var third=parseInt(next)+parseInt(3);
   if(first >= arrCount.length)
        {
            first = 0;
            second = first+1;
            third =second+1;
        }
        if(second >= arrCount.length)
        {
            second = 0;
            third =second+1;
        }
        if(third >= arrCount.length)
        {
            third = 0;
        }
// console.log("2"+first+"--"+second+"--"+third)
$("#1").attr("src",arrCount[first].thumb);
$("#2").attr("src",arrCount[second].thumb);
$("#3").attr("src",arrCount[third].thumb);

$("#1").attr("blog_id",arrCount[first].id);
$("#2").attr("blog_id",arrCount[second].id);
$("#3").attr("blog_id",arrCount[third].id);

$('#1').attr('onClick','viewBlog('+arrCount[first].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[second].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[third].id+')');

//console.log(third)

document.getElementById("next_no").value = third;
document.getElementById("prev_no").value = first;
document.getElementById("middle_no").value = second;
$("#blog_name_first").text("Naff Count:"+arrCount[first].naffcount);
$("#blog_name_second").text("Naff Count:"+arrCount[second].naffcount);
$("#blog_name_third").text("Naff Count:"+arrCount[third].naffcount);

$("#blog_name_h1").text((parseInt(first)+parseInt(1))+"th Most naffed!");
$("#blog_name_h2").text((parseInt(second)+parseInt(1))+"th Most naffed!");
$("#blog_name_h3").text((parseInt(third)+parseInt(1))+"th Most naffed!");

// Planet name circle style
new CircleType(document.getElementById('blog_name_first'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_second'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_third'))
.dir(-1)
.radius(60);


new CircleType(document.getElementById('blog_name_h1'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h2'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h3'))
.dir(1)
.radius(60);
}
function go_to_previous(){
    var next = document.getElementById( "next_no" ).value;
    var prev = document.getElementById( "prev_no" ).value;
    var middle = document.getElementById( "middle_no" ).value;
    // console.log("1"+prev+"^"+middle+"^"+next)

   var first=parseInt(prev)-parseInt(3);
   var second=parseInt(middle)-parseInt(3);
   var third=parseInt(next)-parseInt(3);
//    console.log("2"+first+"^"+second+"^"+third)
   if(first <= -1)
        {
            first = parseInt(arrCount.length)-parseInt(3);
            second =parseInt(arrCount.length)-parseInt(2);
            third =parseInt(arrCount.length)-parseInt(1);
        }
        if(second <= -1)
        {
            second = parseInt(arrCount.length)-parseInt(3);
            third =parseInt(arrCount.length)-parseInt(2);
        }
        if(third <= -1)
        {
            third =parseInt(arrCount.length)-parseInt(3);
        }
        // console.log("2"+first+"^"+second+"^"+third)
$("#1").attr("src",arrCount[first].thumb);
$("#2").attr("src",arrCount[second].thumb);
$("#3").attr("src",arrCount[third].thumb);


$("#1").attr("blog_id",arrCount[first].id);
$("#2").attr("blog_id",arrCount[second].id);
$("#3").attr("blog_id",arrCount[third].id);

$('#1').attr('onClick','viewBlog('+arrCount[first].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[second].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[third].id+')');

document.getElementById("next_no").value = third;
document.getElementById("prev_no").value = first;
document.getElementById("middle_no").value = second;

$("#blog_name_first").html("Naff Count:"+arrCount[first].naffcount);
$("#blog_name_second").html("Naff Count:"+arrCount[second].naffcount);
$("#blog_name_third").html("Naff Count:"+arrCount[third].naffcount);
// Planet name circle style
new CircleType(document.getElementById('blog_name_first'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_second'))
.dir(-1)
.radius(60);

new CircleType(document.getElementById('blog_name_third'))
.dir(-1)
.radius(60);


new CircleType(document.getElementById('blog_name_h1'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h2'))
.dir(1)
.radius(60);

new CircleType(document.getElementById('blog_name_h3'))
.dir(1)
.radius(60);
}

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

        /* Calling API for fetching images */
       page=1;
    //    var url="http://127.0.0.1:8000/api/v1/blogs";
        var url_api=url+"/api/v1/bloggeneral?page="+page
        $.getJSON(url_api, function(data) 
        {
            
           
           images=data['data'];
           page=data['meta']['current_page'];
           last_page=data['meta']['last_page'];
           Total_pages=(data['meta']['total']/25);
           Total_pages=parseInt(Total_pages);
           Total_count=data['meta']['total'];
        
   
        });

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
// Show title on hover
$('.main-naff').mouseover(function() { 

//alert("mouseover")
	$(this).find('.blog_name').addClass('animated zoomIn');
	$(this).find('.blog_name').css('opacity', '1');
}).mouseout(function() { 
    //alert("mouseout")
	$(this).find('.blog_name').removeClass('animated zoomIn');
	$(this).find(' .blog_name').css('opacity', '0');
});
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
    
    function translate3d(x, y, z)
    {
        return "translate3d(" + x + "px, " + y + "px, " + z + "px)";
    }
    
    function cameraTransformForCell(n)
    {
  //adjusting translation animation
       if(n==1)
            count=0.5;
        else
            count+=0.5;

        var x = Math.floor(n / 3);
        var y = n - x * 3;
      
       if(n==1)
       {
                    var cx = (x +0.5) * CXSPACING;
       }
       else{
                    if(scroll_type=='up') //adjusting translation animation
                    {  
                            if(n==Total_count)
                                count=0.5;
                            else
                                count-=1;

                        var cx = (x +count) * CXSPACING; 
                        }
                    else{
                        var cx = (x +count) * CXSPACING; 
                        }
            }
      

        var cy = (y + 0.5) * CYSPACING;
      
       //scroll_type
     
        if (magnifyMode)
        {
            return translate3d(-cx, -cy, 180);
        }
        else
        {
            return translate3d(-cx, -cy, 0);
        }	
    }
    
    var currentCell = -1;
    
    var cells = [];
    
    var currentTimer = null;
    
    var dolly = jQuery("#dolly")[0];
    var camera = jQuery("#camera")[0];
    
    var magnifyMode = false;
    
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
    
    function updateStack(newIndex, newmagnifymode)
    {  
        $(".div_overlay").css({'display':'none'});//for hiding overlay
        $(".div_title").css({'display':'none'});
        $(".div_count_text").css({'display':'block'});
        $(".div_btn").css({'display':'none'});
        $(".div_count_bg").css({'display':'flex'});
  
        if (currentCell == newIndex && magnifyMode == newmagnifymode)
        {
            return;
        }
    
        var oldIndex = currentCell;
        newIndex = Math.min(Math.max(newIndex, 0), cells.length - 1);
        currentCell = newIndex;
      
        if (oldIndex != -1)
        {
            var oldCell = cells[oldIndex];
            oldCell.div.attr("class", "cell fader view original div_img");	
            if (oldCell.reflection)
            {
                oldCell.reflection.attr("class", "cell fader view reflection");
            }
        }
   
        var cell = cells[newIndex];
        cell.div.addClass("selected");
        if (cell.reflection)
        {
          //  cell.reflection.addClass("selected");
        }
    
        magnifyMode = newmagnifymode;
        
        if (magnifyMode)
        {
            cell.div.addClass("magnify");
            refreshImage(cell.div.find("img")[0], cell);
        }
    
        if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
            {//alert("here1");
                dolly.style.OTransform = cameraTransformForCell(newIndex);
                var currentMatrix = new OCSSMatrix(document.defaultView.getComputedStyle(dolly, null).OTransform);
                var targetMatrix = new OCSSMatrix(dolly.style.OTransform);
                var dx = currentMatrix.e - targetMatrix.e;
                var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
                camera.style.OTransform = "rotateY(" + angle + "deg)";
                camera.style.OTransitionDuration = "330ms";

            }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
        { //alert("here2");
            dolly.style.webkitTransform = cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
    
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    { 
        
        dolly.style.MozTransform = cameraTransformForCell(newIndex);
        var currentMatrix = new DOMMatrix(document.defaultView.getComputedStyle(dolly, null).MozTransform);
        var targetMatrix = new DOMMatrix(dolly.style.MozTransform);
        var dx = currentMatrix.e - targetMatrix.e;
        var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
        camera.style.MozTransform = "rotateY(" + angle + "deg)";
        camera.style.MozTransitionDuration = "330ms";


    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
        dolly.style.msTransform = cameraTransformForCell(newIndex);
        var currentMatrix = new MSCSSMatrix(document.defaultView.getComputedStyle(dolly, null).msTransform);
        var targetMatrix = new MSCSSMatrix(dolly.style.msTransform);
        var dx = currentMatrix.e - targetMatrix.e;
        var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
        camera.style.msTransform = "rotateY(" + angle + "deg)";
        camera.style.msTransitionDuration = "330ms";


    }  
    else if(navigator.userAgent.indexOf("iPhone") != -1 )
      {
            dolly.style.webkitTransform = cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
        else if(navigator.userAgent.toLowerCase().indexOf('safari/') > -1)
      {
            dolly.style.webkitTransform = cameraTransformForCell(newIndex);
            var currentMatrix = new WebKitCSSMatrix(document.defaultView.getComputedStyle(dolly, null).webkitTransform);
            var targetMatrix = new WebKitCSSMatrix(dolly.style.webkitTransform);
            var dx = currentMatrix.e - targetMatrix.e;
            var angle = Math.min(Math.max(dx / (CXSPACING * 3.0), -1), 1) * 45;
            angle=angle-7.5;
            camera.style.webkitTransform = "rotateY(" + angle + "deg)";
            camera.style.webkitTransitionDuration = "330ms";

        }
        
    else{
       
    }      
    
        if (currentTimer)
        {
            clearTimeout(currentTimer);
        }
        
        currentTimer = setTimeout(function ()
        {
            if(navigator.userAgent.indexOf("Chrome") != -1 )
             {
                camera.style.webkitTransform = "rotateY(0)";
                camera.style.webkitTransitionDuration = "2s";
             }
             else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
             {
                camera.style.MozTransform = "rotateY(0)";
                camera.style.MozTransitionDuration = "2s";
             }

             else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
            {

            camera.style.msTransform = "rotateY(0)";
            camera.style.msTransitionDuration = "2s";
             }
            
             else if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
            {
            camera.style.OTransform = "rotateY(0)";
            camera.style.OTransitionDuration = "2s";
            }
            else if(navigator.userAgent.indexOf("iPhone") != -1 ){
                camera.style.webkitTransform = "rotateY(0)";
                camera.style.webkitTransitionDuration = "2s";
            }
        }, 330);
    }
    var i=0;
    var n=1;
    function snowstack_addimage(reln, info)
    {
;
        load_count++;
    
            var nHot_Count;
            var nCool_Count;
            var nNaff_Count;
            var nComment_Count;

            if(images[reln]['hotcount']!==null){
                nHot_Count=images[reln]['hotcount'];
            }
            else
            nHot_Count=0;


            if(images[reln]['coolcount']!==null){
                nCool_Count=images[reln]['coolcount'];
            }
            else
            nCool_Count=0;


            if(images[reln]['naffcount']!==null){
                nNaff_Count=images[reln]['naffcount'];
            }
            else
            nNaff_Count=0;

            if(images[reln]['commentcount']!==null){
                nComment_Count=images[reln]['commentcount'];
            }
            else
            nComment_Count=0;

//change background color based on largeset count


       Hot_Count=nHot_Count;
       Cool_Count=nCool_Count;
       Naff_Count=nNaff_Count;
       Comment_Count=nComment_Count;



        if((nHot_Count/1000)>=1)
        nHot_Count=nHot_Count/1000+"K";

        if((nCool_Count/1000)>=1)
        nCool_Count=nCool_Count/1000+"K";

        if((nNaff_Count/1000)>=1)
        nNaff_Count=nNaff_Count/1000+"K";

        if((nComment_Count/1000)>=1)
        nComment_Count=nComment_Count/1000+"K";

        var cell = {};
        var realn = cells.length;
        cells.push(cell);
    
        var x = Math.floor(realn / 2);
        var y = realn - x * 2;
        cell.info = info;
        
        cell.div = jQuery('<div class="cell fader view original div_img" style="opacity: 0" block_no="'+reln+'" ></div>').width(CWIDTH).height(CHEIGHT);
        cell.div[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        cell.div[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
    
        var img = document.createElement("img");
        var title=info.name  ;
        var id=info.id  ;
        var content=info.content  ;
        var url="/single_general_blog/"+id;
      
        jQuery(img).load(function ()
        {
         
            var width;
            var height;
            var height_for_count;
            var top;
            var left;
            img.className  = "cell_img_"+i;
           
            layoutImageInCell(img, cell.div[0]);

            var cls_overlay="div_overlay_"+i;
            var cls_title="div_title_"+i;
            var cls_counts="div_counts_"+i;
           
       
           cell.div.append(jQuery('<a class="mover viewflat blog_img" href="#""  onclick="play_note('+reln+')"></a>').append(img));
           cell.div.append(jQuery('<div class="'+cls_title+' div_title" style="display:none;z-index:10000000;border:0px solid white"><p class="p_title">'+title+'</p></div>'));
           cell.div.append(jQuery('<div class="'+cls_overlay+' div_overlay '+reln+'" style="z-index:1000000;display:none;opacity: 100%; background-color:rgba(23, 80, 213, 0.57)"> <div class="blog-buttons_overlay "> <div class="button-div"><button><img class="i_hot" src="{{asset('front/icons/hot.png')}}"  /></button><div class="button-details"><p class="button-number hot-number">'+nHot_Count+'</p></div></div><div class="button-div"><button><img class="i_cool" src="{{asset('front/icons/cool.png')}}" /></button><div class="button-details"> <p class="button-number cool-number">'+nCool_Count+'</p></div></div> <div class="button-div"> <button><img class="i_naff" src="{{asset('front/icons/naff.png')}}" /></button><div class="button-details"><p class="button-number naff-number">'+nNaff_Count+'</p></div></div><div class="button-div"><button><img  class="i_comment" src="{{asset('front/icons/comment.png')}}" alt=""></button> <div class="button-details"><p class="button-number comment-number">'+nComment_Count+'</p></div> </div> </div><button class="button btn_view_blog" onclick="viewBlog('+id+')"><p class="p_button">View Blog</p></button></div>'));
          
            var div_height=$(".div_img").css("height");
            var div_width=$(".div_img").css("width");
            var div_img=$(".cell_img_"+i).css("height");

            
             var pos = $(".cell_img_"+i).position();
             width=Math.round(img.width)+1;
             height=Math.round(img.height)+2;
             var height_title=Math.round(img.height)/5
             top=$(".cell_img_"+i).css("top");
             bottom=$(".cell_img_"+i).css("bottom");
             left=$(".cell_img_"+i).css("left");

             var className="div_count_icon"+i;
             var className_bg="div_count_bg"+i;
           
             
        
    $(".div_overlay_"+i).css({width:width, height:height,
                                                "position":"absolute",
                                                 left:left,top:top});
     $(".div_title_"+i).css({'display':'none',width:width, height:height_title,
                                                "position":"absolute",
                                                 left:left,top:top}); 
    $(".div_counts_"+i).css({'display':'none',width:width, height:height,
                                                "position":"absolute",
                                                left:left,top:top});

        if (width > height){
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-l "><button><img src="{{asset('front/icons/hot.png')}}" class="hotIcon" /></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="{{asset('front/icons/cool.png')}}" class="coolIcon" /></button><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div></div><div class="button-div button-div-l "><button><img  src="{{asset('front/icons/naff.png')}}" class="naffIcon" /></button><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div></div><div class="button-div button-div-l "><button><img src="{{asset('front/icons/comment.png')}}"  class="commentIcon" alt="" ></button><div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div></div>'));
             }
             else{
            
            cell.div.append(jQuery('<div class="'+className_bg+' div_count_bg" ><div class="button-div button-div-p "><button><img src="{{asset('front/icons/comment.png')}}"  class="commentIcon" alt="" ></button> <div class="button-details"><p class="button-number">'+nComment_Count+'</p></div></div><div class="button-div button-div-p "><div class="button-details"><p class="button-number">'+nNaff_Count+'</p></div>  <button><img class="naffIcon" src="{{asset('front/icons/naff.png')}}"/></button> </div><div class="button-div button-div-p"><div class="button-details"><p class="button-number">'+nCool_Count+'</p> </div><button><img src="{{asset('front/icons/cool.png')}}" class="coolIcon"/></button> </div><div class="button-div button-div-p"><button><img src="{{asset('front/icons/hot.png')}}" class="hotIcon"/></button><div class="button-details"><p class="button-number">'+nHot_Count+'</p></div></div></div>'));
         }

     
        
        largest(nHot_Count,nCool_Count,nNaff_Count,i);
           cell.div.addClass('div_img_' + i);
    

           if (width > height){ 
       
                //it's a landscape
                $(".div_title_"+i).css({"text-align":"left"});
                $(".div_img").attr('type','L');
                top='85%';
                var img_height=height+'px';
        
                        if(div_height===img_height){
                            top='85%';
                        } 
                       else if(div_height=='206px'&& img_height=='193px'){
                            top='79%';
                        }   
                        height="15%";
             
            } 
            else {
                height="30%";
                //it's a portrait
                $(".div_title_"+i).css({"text-align":"center"});
                top='70%';
                }
                $(".div_count_bg"+i).css({"position":"absolute","width":width,
                                                    "float":"right","border":"0px solid white",
                                                    "height":height,"top":top,"left":left,'opacity':'35%','border':'0px solid white'});

         
           cell.div.css("opacity", 1);
           i++;
           n++;
           });
        
            img.src = info.thumb;
    
             jQuery("#stack").append(cell.div);
             //first row for reflection
        if (y == 1)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection" style="opacity: 0"></div>').width(CWIDTH).height(CHEIGHT);
            cell.reflection[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            var rimg = document.createElement("img");
            
            jQuery(rimg).load(function ()
            {
                layoutImageInCell(rimg, cell.reflection[0]);
                cell.reflection.append(jQuery('<div class="mover viewflat"></div>').append(rimg));
                cell.reflection.css("opacity", 1);
            });
        
            rimg.src = info.thumb;
    
            jQuery("#rstack").append(cell.reflection);
        }
        //second row for reflection
        if (y == 0)
        {
            cell.reflection = jQuery('<div class="cell fader view reflection2" style="opacity: 0"></div>').width(CWIDTH).height(CHEIGHT);
            cell.reflection[0].style.webkitTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.MozTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.msTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
            cell.reflection[0].style.OTransform = translate3d(x * CXSPACING, y * CYSPACING, 0);
        
            var rimg = document.createElement("img");
            
            jQuery(rimg).load(function ()
            {
                layoutImageInCell(rimg, cell.reflection[0]);
                cell.reflection.append(jQuery('<div class="mover viewflat"></div>').append(rimg));
                cell.reflection.css("opacity", 1);
            });
        
            rimg.src = info.thumb;
    
            jQuery("#rstack2").append(cell.reflection);
        }
    }
    

    function snowstack_init()
    {
        CHEIGHT = Math.round(window.innerHeight / 3.5);
        CWIDTH  = Math.round(CHEIGHT * 300 / 180);
        CXSPACING = CWIDTH + CGAP;
        CYSPACING = CHEIGHT + CGAP;

        jQuery("#mirror")[0].style.webkitTransform = "scaleY(-1.0) " + translate3d(0, - CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.MozTransform = "scaleY(-1.0) " + translate3d(0, - CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.msTransform = "scaleY(-1.0) " + translate3d(0, - CYSPACING * 4 - 1, 0);
        jQuery("#mirror")[0].style.OTransform = "scaleY(-1.0) " + translate3d(0, - CYSPACING * 4 - 1, 0);
    }
    

    jQuery(window).load(function ()
    {  
       
        var page = 1;
        var loading = true;
    /* Calling API for fetching images */
      
    var url_api=url+"/api/v1/bloggeneral?page="+page
        
      
        $.getJSON(url_api, function(data) 
        {
           images=data['data'];
           
          snowstack_init();
          jQuery.each(images, snowstack_addimage);
          updateStack(1);
         loading = false;
       
        });
    
        
        var keys = { left: false, right: false, up: false, down: false };
    
        var keymap = { 37: "left", 38: "up", 39: "right", 40: "down" };
        
        var keytimer = null;
        var scrolltimer = null;
        
        function updatekeys()
        { 
            
            var newcell = currentCell;
            if (keys.left)
            {
                /* Left Arrow */
                if (newcell >= 1)
                {
                    newcell -= 1;
                }
            }
    
    
            if (keys.right)
            {
                /* Right Arrow */
                if ((newcell + 1) < cells.length)
                {
                    newcell += 1;
                }
                else if (!loading)
                {
                    /* We hit the right wall, add some more */
                    page = page + 1;
                    loading = true;
                    flickr(function (images)
                    {
                        jQuery.each(images, snowstack_addimage);
                        loading = false;
                    }, page);
                }
            }
            if (keys.up)
            {
                /* Up Arrow */
                newcell -= 1;
            }
            if (keys.down)
            {
                /* Down Arrow */
                newcell += 1;
            }
    
            updateStack(newcell, magnifyMode);
        }

        /* update scroll */


        function updatescroll(scroll)
        { 
            
            var newcell = currentCell;
            if (scroll=='up')
            {
            
                /* scroll up */
                if (newcell >= 3)
                {
                    newcell -= 3;
                    $(".most-naffed").css({'visibility':'visible'});
                }
            }
    
  


   if (scroll=='down')
            { 
                if(  cells.length>(newcell+3))
                    {
                        loading = false;
     
                        }   
                        $(".most-naffed").css({'visibility':'hidden'});
               
                /* scroll down */
            
           if(page==last_page) {
               if(newcell+4==cells.length)
            {     
                updateStack(newcell+4, magnifyMode);
            }
            loading = false;
              // return false;
           }
          if ((newcell+3) < (cells.length))
       
                {
                    newcell += 3;
                }
                else if (!loading)
                { 
                    /* We hit the right wall, add some more */
                 
                    page = page+1 ;
                    loading = true;
                   
            
                    var url_api=url+"/api/v1/bloggeneral?page="+page
                    $.getJSON(url_api, function(data) 
                    {
 
                    images=data['data'];
                  
               
                  if((newcell + 3) != images.length)
                          jQuery.each(images, snowstack_addimage);
                 
              
                    });
                
     
               
            }
            }
           
            //if((newcell + 3)!=images.length)
              updateStack(newcell, magnifyMode);
        }
        
        var delay = 330;
    
       
/*
 	------SCROLLL EVENT FUNCTIONS ON MOUSE WHEEL ------
*/
        window.addEventListener('wheel', function(event)
        {

            if (event.deltaY < 0)
            {
                scroll_type='up';

            }
            else if (event.deltaY > 0)
            {
                scroll_type='down'; 
                
            } 
            scrollcheck(scroll_type);
        });
        
    /* scroll check */
   
        function scrollcheck(scroll)
        {  //alert(scroll)
            if (scroll=='up' || scroll=='down')
            {
                if (scrolltimer === null)
                 {
                    delay = 330;
                    var doTimer = function ()
                    {
                        updatescroll(scroll);
                    //scrolltimer = setTimeout(doTimer, delay);
                        delay = 60;
                    };
                    doTimer();
                }
            }
            else
            {
                clearTimeout(scrolltimer);
                scrolltimer = null;
            }
        }
       /*   Hammer.js  */

                
            var myBlock = document.getElementById('stack');
            var mc = new Hammer(myBlock);
            mc.get('pan').set({direction: Hammer.DIRECTION_HORIZONTAL});
            mc.on("panleft panright", handleDrag);
            mc.on('panend', finished);

            var lastPosX = 0;
            var isDragging = false;

            function handleDrag(ev) {
                
            var elem = ev.target;
            if (!isDragging) {
                isDragging = true;
                lastPosX = elem.offsetLeft;
            }
            setBlockText(ev.type + " event");
            var posX = ev.deltaX + lastPosX;
           // elem.style.left = posX + "px";
            }

            function finished() {
            isDragging = false;
            setBlockText("panned");
            }

            function setBlockText(msg) { 
                if(msg=='panleft event')
                    var scroll_type='up';
                else if(msg=='panright event')
                    var scroll_type='down';
                //else
                // scroll_type=msg;
                scrollcheck(scroll_type);
            //  alert(scroll_type);
            //myBlock.textContent = msg;
            }
                });
            
function flickr(callback, page)
    { 
  
        var url_api=url+"/api/v1/bloggeneral?page="+page
                    $.getJSON(url_api, function(data) 
                    {
 
                    images=data['data'];
                  // page=data['meta']['current_page'];
                  /* if(page>1)
                    images_new=data['data'];*/
                    });
                   callback(images);
                       
       // });
             
    }

   

/* Function to redirect to view Blog */

function viewBlog(id){  
    var url="/single_general_blog/"+id;
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
