@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/login_style.css') }}">
<link href="//db.onlinewebfonts.com/c/ee837e8aeaf5d681604ab401337b9046?family=Space+Age" rel="stylesheet" type="text/css" />
<style>   
    .header
    {
        width: 100%;
        /*background-color: rgba(0, 0, 0, .2);*/
    }
    .header ul
    {
        text-align: center;
        background: linear-gradient(90deg, rgba(0, 174, 399, 0) 0%, rgba(0, 174, 399, 0.2) 25%, rgba(0, 174, 399, 0.2) 75%, rgba(0, 174, 399, 0) 100%);
        box-shadow: 0 0 25px rgba(0, 174, 399, .2), inset 0 0 1px rgba(0, 174, 399, 0.6);
    }
    .header ul li
    {
        /*list-style: none;*/
        display: inline-block;

    }
    .header ul li a
    {
        display: block;
        text-decoration: none;
        text-transform: uppercase;
        color:white;
        font-size: 30px;
        font-family: 'raleway', sans-serif;
        letter-spacing: 5px;
        font-weight: 600;
        padding: 18px;
        /*transition: all ease 0.5s;*/
    }
    .header ul li a:hover 
    {
        box-shadow: 0 0 10px rgb(233, 12, 12), inset 0 0 20px rgba(240, 10, 10, 0.6);
        background: rgb(216, 10, 10);
        color: rgba(231, 27, 27, 0.7);
    }
    .danger-alter
    {
        border: 1px solid #b82c2c !important;
        box-shadow: 1px 1px 10px 3px #b81c1c;
    }
</style>
@endsection

@section('content')
    <div class="app"></div>
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
        </div>
    </div>
    {{-- @if(Session::has('message'))
            {
                <script> 
                    var err_message=  " {{ Session::get('message') }}"; 
                        Swal.fire({
                                title: '<span class="Error">Error!</span>',
                                text:err_message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                        return;
                </script>
    {{-- <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p> --}}
    {{-- @endif --}} 
    <div class="header" style="display:none;">
    	<ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">My profile</a>
            </li>
            <li>
                <a href="#">participate</a>
            </li>
            <li>
                <a href="#">blogs</a>
            </li>
            <li>
                <a href="#">guide</a>
            </li>
            <li>
                <a href="#">about us</a>
            </li>
            <li>
                <a href="#">terms</a>
            </li>
            <li>
                <a href="#">Logout</a>
            </li>
          </ul>           
    </div>

    <div class="communicator">
        <div class="main-screen">
            {{-- <button type="button" class="start-btn">Click here to start</button> --}}
            <div class="astronautarm-img">
                <div class="home-div">
                    <a href="/"><img src="{{asset('front')}}/images/login/homeBtn2.png" class="btn-hover" alt="homeBtn"></a>
                </div>

                <div class="main-form flex-left text-left d-flex align-center float-sm-left">
                    {{ Form::open(['route' => 'frontend.auth.login', 'method' => 'post', 'id' => 'main-form']) }}
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
                            <span for="email"
                                class="labels text-center font_fam label_email label_uname align-content-sm-center">Email:
                                <span style="color:red">*</span></span>
                        </div>

                        <div class="col-5">
                            <input class="input-box @error('email') danger-alter @enderror"  value="{{ old('email') }}" type="email" id="email" name="email" />
                        </div>
                    </div>

                    <div class="row password-row">
                        <div class="col-4 offset-1">
                            <span for="password"
                                class="labels text-center justify-contents-sm-left justify-contents-md-left font_fam label_passwrd  ">Password:
                                <span style="color:red">*</span></span>
                        </div>

                        <div class="col-5">
                            <input class="input-box @error('password') danger-alter @enderror"  type="password" id="password" name="password" value="{{ old('password') }}" />
                            <span  class="btn-showpassword" onclick="showpassword()" >
                                <i class="eye fas fa-eye"></i>
                                <i class="eye_slash fas fa-eye-slash"></i>
                              </span>
                        </div>
                    </div>

                    <div class="row justify-content-center login-btn">
                        <button type="submit" class=" btn_log btn-info login-btn" id="login-btn">Login</button>
                    </div>

                    <div class="row signup-row">

                        <div class="col-4 offset-1">
                            <span for="u_name" class="labels font_fam">
                                <a href="{{ route('frontend.auth.register') }}" class="labels"> Sign Up</a>
                            </span>
                        </div>

                        <div class="col-6">
                            <span for="u_name" class="font_fam">
                                <a href="{{ route('frontend.auth.password.reset') }}" class="labels p-0">Forgot
                                    Password?</a>
                            </span>
                        </div>
                        <!-- labels font_fam justify-contents-sm-right justify-contents-md-right  ml-sm-0  -->
                    </div>
                    {{ Form::close() }}
                    
                </div>
                <div class="terms-div">
                    <img src="{{asset('front')}}/images/login/terms-img.png" class="btn-hover" alt="homeBtn" />
                </div>
            </div>
        </div>
    </vdiv>

@endsection

@section('after-scripts')
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script>

    

    $(document).ready(function() {

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });

        var elem = document.documentElement;
        if(window.innerWidth < 991 )
        {
            Swal.fire({
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
                padding: '15px',
                background: 'rgba(8, 64, 147, 0.62)',
                allowOutsideClick: false
            }).then((result) => {
                openFullscreen();
            });
                    
        }
            else  contentDisplay();

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
            document.getElementById('block_land').style.display = (screen.width > screen.height) ? 'none' : 'block';

            //above condition is not working sometimes then this condition will work
            if (window.innerHeight < window.innerWidth) 
            {
                document.getElementById('block_land').style.display = 'none';
            } 
            else 
            {
                document.getElementById('block_land').style.display = 'block';
            }
        }

        // MRESSAGE TO SWITCH TO LANDSCAP MODE

        // CHECK FULLSCREEN MODE OR NOT START
        
        //Full Screen size start.
        
        function openFullscreen() 
        {
            if (elem.mozRequestFullScreen) 
            { /* Firefox */
                elem.mozRequestFullScreen();
                contentDisplay();
            } 
            else if (elem.webkitRequestFullscreen) 
            { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
                contentDisplay();
            } 
            else if (elem.msRequestFullscreen) 
            { /* IE/Edge */
                elem.msRequestFullscreen();
                contentDisplay();
            }
            else if (elem.requestFullscreen) 
            { 
                elem.requestFullscreen();
                contentDisplay();
            } 
            else
            {
                contentDisplay();
            }
        }
        
        function contentDisplay() 
        {
            setTimeout(function(){
                $(".astronautarm-img").show();
                $(".astronautarm-img").addClass('animate-arm');
                $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $(".astronautarm-img").removeClass('animate-arm');
                });
                    }, 1000
            );
        }
        // .................................... //

        $('.main-form').on('click', ()=> {
            $(".astronautarm-img").addClass('animate-zoomIn-arm');
            $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-zoomIn-arm');
            $(".astronautarm-img").addClass('zoomIn-arm');
            });
        })

        // ....................................

        $('#main-form').submit(function(e) 
        {
            e.preventDefault();
            if ($.trim($("#email").val()) === "" || $.trim($("#password").val()) === "")
            {
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
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#email').val()))
            {
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
            $.ajax({
                    type: "POST",
                    url: base_url+'/login',
                    data: $("#main-form").serialize(),
                    success: function(responce) {
                        if (responce.status=='success') 
                        {
                            Swal.fire({
                                imageUrl: '../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: "<span id='error'>Succes</span>",
                                html: responce.message,
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                                });
                                window.location.href = responce.redirectPath;   
                        }
                        if ( responce.status=='failed' || responce.status=='notConfirmed' || responce.status=='deActive') 
                        {
                            Swal.fire({
                                imageUrl: '../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: "<span id='error'>"+responce.title+"</span>",
                                html: responce.message,
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                                }).then((result) => {
                                        window.location.href = responce.redirectPath;
                                    }); 
                            if (responce.status=='failed') 
                            {
                                $('#email').addClass('danger-alter');
                            }
                        }
                        if ( responce.status=='moreAttempts') 
                        {
                            Swal.fire({
                                imageUrl: '../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: "<span id='error'>"+responce.title+"</span>",
                                html: responce.message,
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                                }).then((result) => {
                                        window.location.href = responce.redirectPath;
                                    }); 
                            
                        }   
                    },
                    error: function(error){
                            //   alert(error);
                            console.log(error);
                    }
            });
        });
           
        if({{count($errors) }} > 0)
        {
            var errorMessage = {!! html_entity_decode($errors, ENT_QUOTES, 'UTF-8') !!};
            var sweetMessage = '';
            if(typeof(errorMessage==="object"))
            {
                var errType = Object.keys(errorMessage)[0];
                sweetMessage = errorMessage[errType][0];
            }
            else
            {
                sweetMessage = errorMessage[0][0];
            }
        }        
        if(sweetMessage)
        {
            var msg=sweetMessage.split(".");
            if(msg[0]=="Too many login attempts")
            {
                Swal.fire({
                        imageUrl: '../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: "<span id='error'>Authentication Failed!</span>",
                        html: 'Did you forget your password? Please click forgot password to recover your account.',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((result) => {
                        openFullscreen();
                        });

                setTimeout(
                    Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
                            padding: '15px',
                            background: 'rgba(8, 64, 147, 0.62)',
                            allowOutsideClick: false
                        }).then((result) => {
                            openFullscreen();
                            })
                        , 3000);
            }
            else
            {
                Swal.fire({
                    imageUrl: '../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: "<span id='error'>Authentication Failed!</span>",
                    html: sweetMessage,
                    background: 'rgba(8, 64, 147, 0.62)',
                    showCancelButton: true,
                    padding: '15px',
                    confirmButtonText: `Enable Fullscreen`,
                    
                }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        openFullscreen();
                      }
                    })
                
            }

        }
    });
    /*
    * Function to redirect to terms and confitions page
    */
    $(".terms-div").click(function(){
          window.location.href = "{{URL::to('/terms')}}"
        });
    /**
    Function to show password
    */
    
    function showpassword()
    {
        var password = document.getElementById("password");
        if (password.type === "password") 
        {
            password.type = "text";
            $(".eye").hide();
            $(".eye_slash").show(); 
        } 
        else 
        {
            password.type = "password";
            $(".eye_slash").hide();
            $(".eye").show(); 
        }
    }
</script>
@endsection