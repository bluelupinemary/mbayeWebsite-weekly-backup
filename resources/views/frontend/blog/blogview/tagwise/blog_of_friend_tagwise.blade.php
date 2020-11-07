<meta name="url" content="{{ url('') }}">
@extends('frontend.layouts.app')
    <link rel="preload" as="font" href="{{asset('fonts/nasalization-rg.ttf')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
@section('after-styles')
@endsection

@section('content')
<div id="page-content">
    <div class="app">
        <!-- For nouvela animation -->
        <div class="naff-fart-reaction">
            <img src="{{asset('front/images/naff555Votes.png')}}" alt="">
        </div>

        <newblog-component :user="{{Auth::user()}}" :user_id="{{$id}}" :tag="'{{$tag}}'" :type="'{{$type}}'"></newblog-component>

        {{-- @if(Auth::user()) --}}
            {{-- <div class="astro-div navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
                @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
                    <img src="{{ asset('front/images/astronut/Thomasina_blog.png') }}"  class="img_astro"  alt="">
                    <div class="tos-div thomasina">
                        <button class="tos-btn tooltips right">
                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                            <span class="tooltiptext">Terms of Services</span>
                        </button>
                    </div>
                @else
                    <img src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""class="img_astro" alt="">
                    <div class="tos-div">
                        <button class="tos-btn tooltips right">
                            <img  class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                            <span class="tooltiptext">Terms of Services</span>
                        </button>
                    </div>
                @endif
                <div class="user-photo {{access()->user()->getGender()}}">
                    <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
                </div>
                <div class="tag-title {{access()->user()->getGender()}}">
                    @if($tag =='films')
                    <img src="{{asset('front/images/planets/Venus.png')}}"/>
                    @elseif($tag=='sports')
                        <img src="{{asset('front/images/planets/Moon.png')}}"/>
                    @elseif($tag=='mountains_and_seas')
                        <img src="{{asset('front/images/planets/Mars.png')}}"/>
                    @elseif($tag=='music')
                        <img src="{{asset('front/images/planets/saturn.png')}}"/>    
                    @elseif($tag=='politics')
                        <img src="{{asset('front/images/planets/Uranus.png')}}"/>  
                    @elseif($tag=='family_and_friends')
                        <img src="{{asset('front/images/planets/sun.png')}}"/>  
                    @elseif($tag=='travel')
                        <img src="{{asset('front/images/planets/Pluto.png')}}"/>  
                    @endif  
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
                            <span class="tooltiptext">User Profile</span>
                        </button>
                    </div>
                </div>
                <button class="zoom-btn zoom-in "><i class="fas fa-search-plus"></i></button>
                <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
                <div class="instructions-div btn_pointer tooltips right">
                    <button class="instructions-btn tooltips right">
                        <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
                        <span class="tooltiptext">Instructions</span>
                    </button>
                </div>
                <div class="communicator-div tooltips right">
                    <span class="tooltiptext">Communicator</span>
                    <button class="communicator-button"></button>
                </div>
                <button class="music-volume-div tooltips top btn_pointer">
                    <span>Music Volume Up/Down</span>
                </button>
                <button class="navigator-zoomout-btn">
                    <i class="fas fa-undo-alt"></i>
                </button>
            </div> --}}
        {{-- @endif --}}
        <!-- For  notes --->
        <!--cdefgab-->
    
        <div class="audio-div">
            <audio id="fart" src="{{ asset('front') }}/audio/fart/fart.mp3" ></audio>
        </div>      
            <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
    </div>   
</div>
@endsection

@section('after-scripts') 
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/hammer.min.js')}}"></script>
    <script type="text/javascript">
        var url = $('meta[name="url"]').attr('content');
    
        $(document).ready(function() {
            // alert();
            // console.log(navigator.userAgent);
            // console.log(navigator.userAgent.includes('Chrome'))
            if(navigator.userAgent.includes('Chrome') && !navigator.userAgent.includes('Chromium')) {
                // alert();
                $('.view').css('transform-style', 'preserve-3d');
            }
            
        });

        $(window).load(function() {
            $('.astro-div').css('display', 'flex').hide().fadeIn();
        });

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

            if (img.width() > img.height()) {
                $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
                $(".blog-buttons_overlay").css({'width':'82%'});
            
            } 
            else {
                $(".div_overlay").addClass("div_overlay_p");
                $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'column'});
                $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
            } 
        
        });

        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });

        $('.home-btn').click( function() {
            window.location.href = url;
        });

        $('.profile-btn').click( function() {
            window.location.href = url+'/dashboard';
        });

        $('.participate-btn').click( function() {
            window.location.href = url+'/participateMbaye';
        });

        $('.instructions-btn').click( function() {
            window.location.href = url+'/instructions';
        });

        $('.tos-btn').click( function() {
            window.location.href = url+'/terms';
        });

        $('.editphoto-btn').click( function() {
            window.location.href = url+'/profile/edit-photo';
        });
    
        var astronaut_zoom = 0;
        var navigator_zoom = 0;
        $('button.zoom-btn').click( function() { 
        
            if(!navigator_zoom) {
                // alert('zoomin');
                $('.zoom-btn').hide();
                $('.navigator-div').addClass('animate-navigator-zoomin');
                
                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomin');
                    $('.navigator-div').addClass('zoomin');

                    // $('.zoom-btn').hide();
                    $('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'auto');
                    // $('.btn_pointer').css('pointer-events', 'auto');
                    
                });
            }
            
            // }

            navigator_zoom = !navigator_zoom;
        });
        //Zoom out animation
        $('.navigator-zoomout-btn').click(function() {
            // alert('zoomout');
            $('.navigator-div').addClass('animate-navigator-zoomout');

            $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.navigator-div').removeClass('animate-navigator-zoomout');
                $('.navigator-div').removeClass('zoomin');
                $('.zoom-btn').show();
                
                $('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'none');
            });

            navigator_zoom = !navigator_zoom;
        });
    </script>
@endsection
