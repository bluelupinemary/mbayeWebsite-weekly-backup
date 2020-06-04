@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/reset_style.css') }}">
    <style>
      .border1{
          border1:1px solid white;
      }
      .communicator{
        height: 100vh;
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
    @if($errors->any())
    <script>
    var err_message= ' {!! implode('', $errors->all())!!}';
     /* {!! implode('', $errors->all('<div class="errror">:message</div>')) !!}*/
    </script>
    @endif
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    
    <div class="communicator">
        <div class="main-screen">
            <div class="astronautarm-img">
                <div class="main-form form_content">
                    <div class="home-div">
                        <img src="{{asset('front/images/communicator-buttons/buttons/homeBtn.png')}}" class="communicator-button home-button" alt="">
                    </div>
                    <div class="start-div">
                        <p>Reset Password</p>
                    </div>
                    <div class="communicator-buttons">
                        <img src="{{asset('front/images/communicator-buttons/buttons/termsBtn.png')}}" class="communicator-button terms-button p_terms" alt="">
                      </div>
                    {{ Form::open(['route' => 'frontend.auth.password.reset', 'class' => 'form-horizontal']) }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        {{ Form::input('hidden', 'email', $email, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.email')]) }} 
                            <div class="form-group" >

                            <div class="row border1">

                                <div class="password-div">
                                    <p>{{ Form::label('password', trans('validation.attributes.frontend.register-user.password'), ['class' => 'col-md-4 control-label ']) }}     </p>
                                </div>

                                <div class="txt_password_div">
                                    {{ Form::input('password', 'password', null, ['class' => 'form-control txt_pass', 'placeholder' => '']) }}
                                </div>

                            </div>

                            <div class="row border1">

                                <div class="conf_password-div">
                                    <p> {{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-4 control-label ']) }}
                                    </p>
                                </div>

                                <div class="txt_conf_password_div">
                                    {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control txt_conf_pass', 'placeholder' => '','data-toggle' => 'tooltip', 'tittle'=>'Confirm Password']) }}
                            
                                </div>
                                
                            </div>
                                    
                                    <div class="row border1">
                                        <div class="reset-button-div">
                                            {{ Form::submit('Reset', ['class' => 'btn btn-info btn_reset']) }} </div>
            
                                        </div>
                                    </div>
                                </div>    
                        {{ Form::close() }}
                </div>
                  
           </div>
        </div>
    </div>
@endsection
@section('before-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-migrate-1.2.1.min.js')}}"></script>
@endsection
@section('after-scripts')
    <script>
         var message;
         var err_message;
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
            $('.home-div').css('pointer-events', 'auto');

        });
        $('.home-button').click(function() {
            window.location.href = "{{URL::to('/dashboard')}}"
        });
      /*  if(message)
                {
                    Swal.fire({
                                title: '<span class="success">Success!</span>',
                                text:message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                }*/

                if(err_message)
                {
                    var title = 'Error!';
                    Swal.fire({
                                title: title,
                                html: err_message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                }

                $(".btn_reset").click(function(){
                 
                var title = 'Error!';
                if($(".txt_pass").val()==''){
                    var emessage='The Password field is required';
                         Swal.fire({
                             title: title,
                             html: emessage,
                             imageUrl: '../../front/icons/alert-icon.png',
                             imageWidth: 80,
                             imageHeight: 80,
                             imageAlt: 'Mbaye Logo',
                             width: '30%',
                             padding: '1rem',
                             background: 'rgba(8, 64, 147, 0.62)'
                         });
                         return false;
                }
                else  if($(".txt_conf_pass").val()==''){
                        var emessage='The Confirm Password field is required';
                        Swal.fire({
                             title: title,
                             html: emessage,
                             imageUrl: '../../front/icons/alert-icon.png',
                             imageWidth: 80,
                             imageHeight: 80,
                             imageAlt: 'Mbaye Logo',
                             width: '30%',
                             padding: '1rem',
                             background: 'rgba(8, 64, 147, 0.62)'
                         });
                         return false;
                }
               
             });


             $(".p_terms").click(function(){
                  window.location.href = "{{URL::to('/terms')}}"
                    
                });
    </script>
@endsection
