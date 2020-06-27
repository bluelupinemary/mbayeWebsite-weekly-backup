@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/login_style.css') }}">
<link href="//db.onlinewebfonts.com/c/ee837e8aeaf5d681604ab401337b9046?family=Space+Age" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="block_land">
    <div class="content">
        <h1 class="text-glow">Turn your device in landscape mode.</h1>
        <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
    </div>
</div>
<div class="communicator">
    <div class="main-screen">
        {{-- <button type="button" class="start-btn">Click here to start</button> --}}
        <div class="astronautarm-img">
        <div class="home-div">
            <a href="/"><img src="{{asset('front')}}/images/login/homeBtn2.png" class="btn-hover" alt="homeBtn"></a>
        </div>
       
        <div class="main-form flex-left text-left d-flex align-center float-sm-left">
            {{ Form::open(['route' => 'frontend.auth.login', 'id' => 'main-form']) }}
            @php
            if (isset($msg) && $msg!=' ' )
            $msg=$msg;
            else
            $msg=' ';
            @endphp

            <div class="row justify-content-center head-log-row">
                <h1 class="head_log">Member Login</h1>
            </div>

            <div class="row ">

                <div class="col-4 offset-1">
                    <span for="email" class="labels text-center font_fam label_email label_uname align-content-sm-center">Email: <span style="color:red">*</span></span>
                </div>

                <div class="col-5">
                    <input class="input-box" type="email" id="email" name="email"/>
                </div>
            </div>

            <div class="row password-row">
                <div class="col-4 offset-1">
                    <span for="password" class="labels text-center justify-contents-sm-left justify-contents-md-left font_fam label_passwrd ">Password: <span style="color:red">*</span></span>
                </div>

                <div class="col-5">
                    <input class="input-box" type="password" id="password" name="password"/>
                </div>
            </div>

            <div class="row justify-content-center login-btn">
                <button type="submit" class=" btn_log btn-info login-btn">Login</button>
            </div>

            <div class="row signup-row">

                <div class="col-4 offset-1">
                    <span for="u_name" class="labels font_fam">
                        <a href="{{ route('frontend.auth.register') }}" class="labels"> Sign Up</a>
                    </span>
                </div>

                <div class="col-6">
                    <span for="u_name" class="font_fam">
                        <a href="{{ route('frontend.auth.password.reset') }}" class="labels p-0">Forgot Password?</a>
                    </span>
                </div>
                <!-- labels font_fam justify-contents-sm-right justify-contents-md-right  ml-sm-0  -->
            </div>
            {{ Form::close() }}
        </div>
        <div class="terms-div">
            <img src="{{asset('front')}}/images/login/terms-img.png" class="btn-hover" alt="homeBtn"/>
        </div>
        </div>
    </div></div>
    
</section>
@endsection

@section('after-scripts')
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
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
        document.getElementById('block_land').style.display = (screen.width > screen.height) ? 'none' : 'block';

        //above condition is not working sometimes then this condition will work
        if (window.innerHeight < window.innerWidth) {
            document.getElementById('block_land').style.display = 'none';
        } else {
            document.getElementById('block_land').style.display = 'block';
        }
    }

    $(document).ready(function() {
        //function to lock the screen. in this case the screen will be locked in portrait-primary mode.
        function lockScreenOrientation() {
            screen.lockOrientationUniversal = screen.lockOrientation || screen.mozLockOrientation || screen.msLockOrientation;
            if (screen.lockOrientationUniversal("landscape-primary")) {
                // Orientation was locked
            } else {
                // Orientation lock failed

            }
        }        


        // ....................................

        setTimeout(function(){
    $(".astronautarm-img").show();
    $(".astronautarm-img").addClass('animate-arm');
    $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
    $(".astronautarm-img").removeClass('animate-arm');
});
        }, 1000
);


$('.main-form').on('click', ()=> {
    $(".astronautarm-img").addClass('animate-zoomIn-arm');
    $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
    $(".astronautarm-img").removeClass('animate-zoomIn-arm');
    $(".astronautarm-img").addClass('zoomIn-arm');
    });
   })

        // ....................................


        $('.main-form').submit(function() 
{
    if ($.trim($("#email").val()) === "" || $.trim($("#password").val()) === ""){
        Swal.fire({
                                    imageUrl: '../front/icons/alert-icon.png',
                                    imageWidth: 80,
                                    imageHeight: 80,
                                    imageAlt: 'Mbaye Logo',
                                    title: "<span id='error'>Error!</span>",
                                    html: "Email or Password Field is Empty",
                                    width: '30%',
                                    padding: '1rem',
                                    background: 'rgba(8, 64, 147, 0.62)'
                                        });
    return false;
    }
    else{
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#email').val())){
            Swal.fire({
                            imageUrl: '../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: "<span id='error'>Error!</span>",
                            html: "You have Entered Invalid Email",
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                                  });    
            
            return false;
            }
        }
});


    if({{count($errors) }} > 0)
    {
        var errorMessage = {!! html_entity_decode($errors, ENT_QUOTES, 'UTF-8') !!};
        var sweetMessage = '';
        if(typeof(errorMessage==="object")){
        var errType = Object.keys(errorMessage)[0];
        sweetMessage = errorMessage[errType][0];
        }
        else{
            sweetMessage = errorMessage[0][0];
        }
        }
                  if(sweetMessage){
                        Swal.fire({
                            imageUrl: '../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: "<span id='error'>Authentication Failed!</span>",
                            html: sweetMessage,
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                                  });
                                }
    }
    );
</script>
@endsection