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

    @if (session('status'))
    <script>
         var message= '{{ session('status')}}';

    </script>

   <!-- <div class="alert alert-success">
     //  {{--session('status') --}}
    </div>-->
    @endif
    @if($errors->any())


    <script>
         var err_message=  ' {!! implode('', $errors->all())!!}';
        /*<!--  {!! implode('', $errors->all('<div class="errror">:message</div>')) !!}--*/
        </script>
    @endif
    <div class="communicator">
        <div class="main-screen">
            <div class="astronautarm-img">
                <div class="main-form form_content">
                    <div class="home-div">
                        <img src="{{asset('front/images/communicator-buttons/buttons/homeBtn.png')}}" class="communicator-button home-button" alt="">
                    </div>
                    <div class="start-div">
                        <p>Account Recovery</p>
                    </div>
                    <!--<div class="terms-div">
                        <p class="p_terms">TERMS</p>
                    </div>-->
                    <div class="back-div">
                        <input type="hidden" id="myurl" url="{{url('/login')}}" />
                        <img src="{{asset('front/images/communicator-buttons/buttons/backBtn.png')}}" class="communicator-button back-button" alt="">
                    </div>
                    <div class="communicator-buttons">
                      <img src="{{asset('front/images/communicator-buttons/buttons/termsBtn.png')}}" class="communicator-button terms-button p_terms" alt="">
                    </div>

                        {{ Form::open(['route' => 'frontend.auth.password.email', 'class' => 'form-horizontal']) }}

                                <div class="form-group" >

                                    <div class="row border1">
                                        <div class="email-div">
                                            <p>Email</p>
                                        </div>
                                        <div class="txt_email_div">
                                            {{ Form::input('email', 'email', null, ['class' => 'form-control txt_email', 'placeholder' => trans('validation.attributes.frontend.register-user.email')]) }}
                                        </div>
                                    </div>

                                    <div class="row border1">
                                        <div class="button-div">
                                            {{ Form::submit('Send Verification Link', ['class' => 'btn btn-info btn_send_verification']) }}
                                        </div>
                                    </div>
                                </div>
                        {{ Form::close() }}
                </div>

@endsection

@section('before-scripts')
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
@endsection
@section('after-scripts')
    <script>
        var message;
        var err_message;
        var url = $('meta[name="url"]').attr('content');
        console.log(url)
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
            $('.home-div,.back-div').css('pointer-events', 'auto');

        });

        $('.home-button').click(function() {

            window.location.href = "{{URL::to('')}}"
        });
        $('.back-button').click(function() {
            window.location.href = "{{ URL::previous() }}"
        });
              if(message)
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
                }
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


                $(".btn_send_verification").click(function(){

                    var emessage='The email field is required';
                    var title = 'Error!';
                   if($(".txt_email").val()==''){
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
