@extends('frontend.layouts.career_setup-profile_layout')

@section('before-styles')

<style></style>
<style>
    .zoomed_div{
        /* border: 1px solid red; */
        position: absolute;
        width: 66vw;
        height: 58vh;
        top: 0;
        /* left: 0; */
        /* right: 0; */
        bottom: 0;
        background-color: #08254536;
        transform: translate(15%, 43%);
    }
    .swal2-popup {
    display: none;
    position: relative;
    box-sizing: border-box;
    flex-direction: column;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    box-shadow: 0px 0px 20px #17a2b8 !important;
    border: none;
    border-radius: .3125em;
    background: #fff;
    font-family: inherit;
    font-size: 1rem;
}
.swal2-content {
    color: #17a2b8 !important;
    font-size: 1.1vw !important;
    font-family: 'Nasalization';
}
.company-detail{
    padding: 1%;
}
.company-title{
    color:#efad0c !important;
    text-shadow: 0px 0px 3px #000000;
    font-family: 'arial';
    font-size: 1.8vw;
    padding-left: 8%;
    top: 0;
    left: 0;
    right: 0;
}
.spn_value {
    color: #f8f9fabf;
    text-shadow: 0px 0px 3px #000000;
    font-family: 'arial';
    font-size: 1.5vw;
    padding-left: 10vw;
    display: inherit;
    /* width: 5vw; */
    /* text-align: center; */
    /* border: 1px solid blue; */
    /* text-align: center; */
}


</style>
    
<link rel="stylesheet" type="text/css" href="{{asset('front/CSS/view-company-profile.css')}}"/>
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/cropper.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
{{-- <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/> --}}
<link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile-responsive.css')}}"/>
{{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}"> --}}

<link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('front/JS/jquery.fontselect.js')}}"></script> --}}
<script src="{{asset('front/JS/cropper.js')}}"></script>


@endsection

@section('after-styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
<!-- <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}"> -->
<!-- <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}"> -->
<!-- <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}"> -->
<link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
<!-- <link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}"> -->
<link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}">  --}}
 {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}">  --}}
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> -->
{{-- <link rel="stylesheet" href="{{asset('front/CSS/bootstrap.min.css')}}"> --}}
<link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
@endsection


@section('content')



    <div id="page-content">
        <div id="container">
            <div class="screen"><br/><br/>
                
                    <div class="row">
                            <div class="" style="padding-left:5vw;">
                                
                                <h1 class="heading" style="color:#efad0c;font-size:2.5vw;text-align:center;">Company Profile</h1>
                                    <div class="user-upload-img" id="userImageUpload" >

                                            
                                           
                                                <img src="{{ asset('storage/career/company/'.$company->featured_image) }}"  id="featured-image-previewimg"  alt="input image" style=" width: 100%;">
                                            
                                               
                                            <div class="view-profile-button" style="" >
                                
                                                <i class="fas fa-ellipsis-h" onclick="zoomImage();" style="position:relative; font-size:3vw; color:white; float:right; right:5%;"></i>
                                                
                                            </div>

                                    </div>
                                    
                                    {{-- ----------------------------------Image Edit Code------------------------------------- --}}
                                    {{-- <div class="user-upload-img"></div> --}}
                                    <!--changed button class name from img-edit-button to edit_image-->
                                    {{-- <button type="button" class="" id="">Edit Image</button> --}}
                                    
                                    
                                {{-- ----------------------------------END---------------------------------------------------- --}}
                            </div>
                            <!-- ---------------------Form code start-------------------------------------------- -->

                            <div class="column2">
                                <div class="edit-buttons">
                                    <button class="edit" data-toggle="tooltip" title="Edit Profile" data-placement="top" onclick="edit_profile();" style="border:0;background: transparent;"><i class="fas fa-edit"  style="font-size:2em; color:#c5a739; "></i></button>
                                    
                                </div>
                               <div class="company-detail">
                                   <div class="company-title">Company Name :</div>
                                   <div class="spn_value">{{ $company->company_name ?? '' }}</div>
                               </div>
                               <div class="company-detail">
                                    <div class="company-title">Company Email :</div>
                                    <div class="spn_value">{{ $company->company_email ?? '' }}</div>
                                </div>
                                <div class="company-detail">
                                    <div class="company-title">Company Address :</div>
                                    <div class="spn_value">{{ $company->address ?? '' }}</div>
                                </div>
                                <div class="company-detail">
                                    <div class="company-title">Mobile No :</div>
                                    <div class="spn_value">{{ $company->company_phone_number ?? '' }}</div>
                                </div>
                                <div class="company-detail">
                                    <div class="company-title">Industry :</div>
                                    <div class="spn_value">{{ Auth::user()->company->industry->industry_name ?? '' }}</div>
                                </div>
                                <div class="company-detail">
                                    <div class="company-title">Created By :</div>
                                    <div class="spn_value">{{ Auth::user()->first_name .' '.Auth::user()->last_name ?? '' }}</div>
                                </div>
                               
                            </div>
                    </div>   
                                
                               

                            
                       
                            <!-- ---------------------Form code End-------------------------------------------- -->

                    
                    {{-- <div class="row">--}}
                        {{-- <div class="column3">  --}}
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
                                        <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
                                        <button class="profile-btn tooltips right">
                                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                                            <span class="tooltiptext">User Profile</span></button>
                                    </div>
                                </div>
                             <button class="zoom-btn zoom-in" ><i class="fas fa-search-plus"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                
                            </button>
                                 <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
                                <div class="instructions-div">
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
                            
                         {{-- </div> --}}
                    {{--</div> --}}
            </div>
        </div>
        <!-----------astronaut code End-------------->
        <div class="navigator-div-zoomed-in @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
            {{-- <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> --}}
            {{-- <h2 class="planet_name edit-photo" id="zoomedin-edit-photo">Edit Photo</h2> --}}
    
            <div class="navigator-components">
                @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
                    <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/Thomasina_blog.png') }}" alt=""
                    class="astronaut-body">
                    <div class="tos-div thomasina">
                        <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
                    </div>
                @else
                    <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""
                    class="astronaut-body">
                    <div class="tos-div">
                        <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
                    </div>
                @endif
    
                <a href="{{url('profile/edit-photo')}}" class="profilepicture">
                    <img  id="user-photo" class="{{access()->user()->getGender()}}" src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
                </a> 
                {{-- <div class="profile-picture-overlay"></div> --}}
    
                {{-- <button class="navigator-zoom navigator-zoomin tooltips zoom-in-out">
                    <span>Zoom In</span>
                    <i class="fas fa-search-plus"></i>
                </button> --}}
                <div class="navigator-buttons">
                    <div class="column column-1">
                        <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                        <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
                    </div>
                    <div class="column column-2">
                        <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
                    </div>
                    <div class="column column-3">
                        <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
                        <button class="profile-btn tooltips right">
                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                            <span class="tooltiptext">User Profile</span></button>
                        {{-- <button class="zoomout-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">Zoom Out</span></button> --}}
                    </div>
                </div>
                <div class="instructions-div">
                    <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
                </div>
                <div class="communicator-div tooltips right">
                    <span>Communicator</span>
                    <button class="communicator-button"></button>
                </div>
                <button class="navigator-zoomout-btn tooltips right">
                    <i class="fas fa-undo-alt"></i>
                    <span class="">Zoom Out</span>
                </button>
                {{-- <button class="navigator-zoomout-btn tooltips zoom-in-out">
                    <span>Zoom Out</span>
                    <i class="fas fa-undo-alt"></i>
                </button> --}}
            </div>
        </div>
    </div>
 {{-- --------------------------------------------zoom Image Div-----------------------}}
    <div class="zoomed_div" style="display: none">
        <div class="zoomed_image_div" id="userImageUpload" >
            <img src="{{ asset('storage/career/company/'.$company->featured_image) }}"  id="featured-zoomed-image"  alt="input image">
            <div class="view-profile-button" style="" >
                <i class="fas fa-ellipsis-h" onclick="zoomImageBack();" style="position:relative; font-size:3vw; color:white; float:right; right:5%;"></i>
            </div>
        </div>
    </div>



 {{-- -------------------------------------------End zoom Image Div-----------------------}}




@endsection
@section('after-scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
{{-- <script src="{{asset('front/JS/popper.min.js')}}"></script>--}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>

 

<script type="text/javascript">
    var url = $('meta[name="url"]').attr('content');
        var ClickCount=0;
    
        
    // Show title on hover

    
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
        
        
        // var astronaut_zoom = 0;


        //     var navigator_zoom = 0;
        //     $('button.zoom-btn').click( function() { 
            
        //         if(!navigator_zoom) {
        //             $('.zoom-btn').hide();
        //             $('.navigator-buttons').css('pointer-events', 'auto');
        //             $('.communicator-div').css('pointer-events', 'auto');
        //             $('.instruction-div').css('pointer-events', 'auto');
        //             $('.toss-div').css('pointer-events', 'auto');
        //             $('.btn_pointer').css('pointer-events', 'auto');
        //             $('.navigator-div').addClass('animate-navigator-zoomin');
                    

        //         $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        //                 $('.navigator-div').removeClass('animate-navigator-zoomin');
        //                 $('.navigator-div').addClass('zoomin');
        //                 $('.zoom-btn').hide();
        //             });
        //         } else {
                
        //         }

        //         navigator_zoom = !navigator_zoom;
        //     });
        //     //Zoom out animation
        //     $('.navigator-zoomout-btn').click(function() {
        //         $('.navigator-div').addClass('animate-navigator-zoomout');

        //         $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        //             $('.navigator-div').removeClass('animate-navigator-zoomout');
        //             $('.navigator-div').removeClass('zoomin');
        //             $('.zoom-btn').show();
                    
        //         });

        //         navigator_zoom = !navigator_zoom;
        //     });


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
            $(".zoom-in").on({
         mouseenter: function () {
            $('.zoom-in span').css('display', 'block');
        },
        mouseleave: function () {
            $('.zoom-in span').css('display', 'none');
            }
    });

    var astronaut_zoom = 0;
        var img_has_loaded = 0;
        $('button.zoom-btn').click( function() {
            if(!astronaut_zoom) {
                if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                    $('.navigator-div').hide();
                    $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
                    // if(!img_has_loaded) {
                    //     $('.navigator-div-zoomed-in .lds-ellipsis').show();
                    //     $('.navigator-div-zoomed-in .astronaut').on('load', function() {
                    //         $('.navigator-div-zoomed-in .lds-ellipsis').hide();
                    //         $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    //         img_has_loaded = !img_has_loaded;
                    //     });
                    // } else {
                        $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    // }
                } else {
                    $(this).fadeOut();
                    $('.navigator-div').addClass('animate-navigator-zoomin');

                    $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.navigator-div').removeClass('animate-navigator-zoomin');
                        $('.navigator-div').addClass('zoomin');
                        $('.navigator-buttons, .tos-div, .instructions-div, .navigator-zoomout-btn, .communicator-div').css('pointer-events', 'auto');
                    });
                }
            }

            astronaut_zoom = !astronaut_zoom;
        });

        $('.navigator-zoomout-btn').click(function() {
            $('button.zoom-btn').fadeIn();

            if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                $('.navigator-div').fadeIn();
                $('.navigator-div-zoomed-in').hide();
            } else {
                $('.navigator-div').addClass('animate-navigator-zoomout');

                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomout');
                    $('.navigator-div').removeClass('zoomin');
                });
            }

            astronaut_zoom = !astronaut_zoom;
        });
    
    /*-----------------------PART OF THE IMAGE EDITOR-------------------------*/

    var id = {{ Auth::user()->id }};
    //     alert(id);
    //     return false;
    function edit_profile()
                {
                     window.location.href = url+'/company/setup-profile/'+ id;
                 }
  
  $('[data-toggle="tooltip"]').tooltip();   


// -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//


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
    }else  contentDisplay();

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

        }, 1000);
    }
    
    
    function zoomImage(){
        // alert('hh');
       
        $(".column2").css("display","none");
        $(".user-upload-img").css("display","none");
        $(".heading").css("display","none");
        $(".zoomed_div").css("display","block");
    }

    function zoomImageBack(){
        // alert('hh');
        $(".zoomed_div").css("display","none");
        $(".column2").css("display","block");
        $(".user-upload-img").css("display","block");
        $(".heading").css("display","block");
       
    }
    
</script>


@endsection