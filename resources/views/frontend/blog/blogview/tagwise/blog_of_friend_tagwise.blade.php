@extends('frontend.layouts.app')
    <meta name="url" content="{{ url('') }}">
    
@section('after-styles')
    <link rel="preload" as="font" href="{{asset('fonts/nasalization-rg.ttf')}}" type="font/woff2" crossorigin="anonymous">  
    <link rel="preload" as="font" href="{{asset('fonts/Courgette.ttf')}}" type="font/woff2" crossorigin="anonymous">  
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
@endsection

@section('content')
<div id="page-content">
    <div class="app">
        <!-- For nouvela animation -->
        <div class="naff-fart-reaction">
            <img src="{{asset('front/images/naff555Votes.png')}}" alt="">
        </div>

        <newblog-component :user="{{Auth::user()}}" :user_id="{{$id}}" :tag="'{{$tag}}'" :type="'{{$type}}'" @if($friend) :friend="{{$friend}}" @endif></newblog-component>
    
        <div class="audio-div">
            <audio id="fart-audio" src="{{ asset('front/audio/fart/fart.mp3') }}" ></audio>
        </div>      
            <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
    </div>   
</div>
@endsection

@section('after-scripts') 
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
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
            $(".tag.front").show();
            $(this).find(".tag.front").hide();
            $(".overlay").removeClass("overlay_portrait");
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
                $(".overlay").addClass("overlay_portrait");
                $(".div_overlay").addClass("div_overlay_p");
                $(".blog-buttons_overlay").css({'display':'flex','flex-flow':'row wrap', 'width':'100%'});
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
