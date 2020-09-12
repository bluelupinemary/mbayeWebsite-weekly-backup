@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>
    </style>
<style>
    
</style>
<style>
.error {
    color: red;
    font-weight: 400;
    display: block;
    padding: 6px 0;
    font-size: 14px;
}

.form-control.error{
    border:1px solid red !important;
    padding: .375rem .75rem;
}
</style>

   
@endsection

@section('after-styles')
    @trixassets
    <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
     {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}">  --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
       
@endsection

@section('content')
<div id="page-content">
    <div id="container">
            <div class="screen"><br/><br/>

                    <div class="row">
                            <div class="column1">
                                <form action="{{ route('frontend.save') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="user-upload-img" id="userImageUpload" >
                                        
                                            <label for="file">
                                            <img src="{{asset('front/images/image-add.png')}}"  id="outputImage"  alt="input image" class="inox img-resize">
                                            <div class="middle" id="middle">
                                                <div class="text">Edit Featured Image</div>
                                              </div>
                                            </label>
                                            
                                            
                                            <input id="file"  onchange="loadFile(event)"   type="file" name="featured_image" style=" min-width: 100%;
                                            min-height: 100%;">
                                            

                                    </div>
                                    <small class="error">{{ $errors->first('featured_image') }}</small>
                                    {{-- ----------------------------------Image Edit Code------------------------------------- --}}
                                    {{-- <div class="user-upload-img"></div> --}}
                                        <div class="image-edit">
                                            <div class="form-btn" id="image-edit-div">
                                                <button type="submit"  id="img-edit" class="img-edit-button">Edit Photo</button>
                                            </div>
                                        </div>
                                
                                    
                                {{-- ----------------------------------END---------------------------------------------------- --}}
                            </div>
                            <!-- ---------------------Form code start-------------------------------------------- -->

                            <div class="column2">
                                 <div class="heading"><h2 style="color:white; background-color:#082545; text-align:center;">Set Up Company Profile</h2></div>
                                 <div class="form">
                                    
                                            <div class="input-fields">
                                                <label for="Cname">Company Name :<span style="color:red">*</span></label>
                                                <input type="text" id="company_name" name="company_name" required>
                                            </div><br/>
                                            <div>
                                                <label for="Cadd">Company Email :<span style="color:red">*</span></label>
                                                <input type="email" class="form-control {{ $errors->has('company_email') ? 'error' : '' }}" id="company_email" name="company_email" required>
                                                {{-- @if ($errors->has('company_email'))
                                                <div class="error">
                                                    {{ 'Email is already taken' }}
                                                </div>
                                                @endif --}}
                                                <small class="error">{{ $errors->first('company_email') }}</small>
                    
                                               
                                            </div>
                                            
                                            <br/>
                                            <div>
                                                <label for="country">Company Address :<span style="color:red">*</span></label>
                                                <input type="text" id="company_address" name="address" required>
                                            </div><br/>
                                        
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="country">Country :<span style="color:red">*</span></label>
                                                        <select class="countries" name="country" id="countryId"  required>&#x25BC;
                                                            <option value="" selected disabled>Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="state">State :<span style="color:red">*</span></label>
                                                        <select id="stateId" class="states" name="state" required>
                                                            <option value="" selected disabled>Select State</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="city">City :<span style="color:red">*</span></label>
                                                        <select id="cityId" class="cities" name="city" required>
                                                            <option value="" selected disabled>Select City</option>
                                                        </select>
                                                    </div>
                                            </div><br/>
                                                    <div class="mobile-no">
                                                            <label for="mobile">Mobile :<span style="color:red">*</span></label>
                                                            <input type="number" class="form-control {{ $errors->has('company_phone_number') ? 'error' : '' }}" id="mob_no" name="company_phone_number" required>
                                                            <small class="error">{{ $errors->first('company_phone_number') }}</small>

                                                    </div>
                                                    {{-- @if ($errors->has('company_phone_number'))
                                                    <div class="error">
                                                        {{ 'Enter valid mobile number' }}
                                                    </div>
                                                    @endif --}}
                                                    <br/>
                                                        <div class="industry">
                                                            <label for="industry">Industry :<span style="color:red">*</span></label>
                                                            <select id="industry" class="" name="industry_id" required>&#x25BC;
                                                                <option value="public" selected disabled>Select industry</option>
                                                                @foreach($industry as $industry)
                                                                <option value="{{$industry->id}}">{{$industry->industry_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="owner_id" value="{{Auth::user()->id}}">
                                            <div class="form-btn">
                                                <button type="submit"  class="button-done">Submit</button>
                                            </div>
                                        
                                        </form>
                                </div>
                            </div>
                            <!-- ---------------------Form code End-------------------------------------------- -->

                    </div>
                    {{-- <div class="row">--}}
                        <div class="column3"> 
                            <!-- ---------------------astronaut code start-------------------------------------------- -->
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
                             <button class="zoom-btn zoom-in "><i class="fas fa-search-plus"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                
                            </button>
                                 <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
                                <div class="instructions-div btn_pointer tooltips right">
                                    <button class="instructions-btn tooltips right">
                                        <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
                                        <span class="tooltiptext">Instructions</span></button>
                                </div>
                                <button class="communicator-div tooltips top btn_pointer @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom   @else  tomasina @endif" >
                                  
                                </button>
                                <div class="communicator-div tooltips right" style="pointer-events: auto;">
                                    <span >Communicator</span>
                                    <button class="communicator-button"></button>
                                </div>
                                <button class="music-volume-div tooltips top btn_pointer">
                                    <span>Music Volume Up/Down</span>
                                </button>
                               <button class="navigator-zoomout-btn">
                                    <i class="fas fa-undo-alt"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                </button>
                                {{-- <button class="navigator-zoomout-btn tooltips zoom-in-out">
                                    <span>Zoom Out</span>
                                    <i class="fas fa-undo-alt"></i>
                                </button> --}}
                            </div>
                            <!-- ---------------------astronaut code End-------------------------------------------- -->

                         </div>
                    {{--</div> --}}
            </div>
    </div>
</div>
@endsection
@section('after-scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
{{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/jquery-ui.js')}}"></script>
<script src="{{asset('front/JS/popper.min.js')}}"></script>

<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="{{asset('front/system-google-font-picker/jquery.fontselect.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>


<script type="text/javascript">

    
    var url = $('meta[name="url"]').attr('content');
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
$("#blog_name_first").text("Naff Count:"+arrCount[first].naffcount);
$("#blog_name_second").text("Naff Count:"+arrCount[second].naffcount);
$("#blog_name_third").text("Naff Count:"+arrCount[third].naffcount);

$("#blog_name_h1").text((parseInt(first)+parseInt(1))+"th Most naffed!");
$("#blog_name_h2").text((parseInt(second)+parseInt(1))+"th Most naffed!");
$("#blog_name_h3").text((parseInt(third)+parseInt(1))+"th Most naffed!");

// Planet name circle style
}
function go_to_previous(){
    var next = document.getElementById( "next_no" ).value;
    var prev = document.getElementById( "prev_no" ).value;
    var middle = document.getElementById( "middle_no" ).value;


   var first=parseInt(prev)-parseInt(3);
   var second=parseInt(middle)-parseInt(3);
   var third=parseInt(next)-parseInt(3);

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

        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .overlay").css({'display':'none'});   
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
         
            $("#clicked_img .overlay").css({'display':'flex'});
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
                $('.toss-div').css('pointer-events', 'auto');
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
        $(".toss-div").click(function(){
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


<script>
    
    var loadFile = function(event) {
        var image = document.getElementById('outputImage');
        image.src = URL.createObjectURL(event.target.files[0]);
       
        if (typeof image != 'undefined'){
            var a = document.getElementById('middle');
            a.style.display = "block";
        }
        // else{
        //     a.style.display = "none";
        // }
        
        if (typeof image != 'undefined') 
        {
        var x = document.getElementById("img-edit");
        x.style.display = "block";

        }
          
    };
</script>
{{-- <script type="text/javascript">
    
    $('.column1 img').each(function(){
        if ($(this).width()/$(this).height() >= 1) {
            $(this).addClass('landscape');
        } else {
            $(this).addClass('portrait');
        }
    });

     
    </script> --}}

@endsection
