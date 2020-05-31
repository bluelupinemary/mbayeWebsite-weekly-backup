@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/terms_and_conditions_style.css') }}">
@endsection

@section('content')
<div id="block_land">
  <div class="content">
      <h1 class="text-glow">Turn your device in landscape mode.</h1>
      <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
  </div>
</div>

  <section class="container">
    <div class=" div_container">
      <br>
      <h2 class="col_white"> SPECIAL RIGHT HOLDERS ACCOUNT</h2>  <br>
  <p class="col_white">
    In our discretion, we may give you a “Special Rights holders Account” with which you will be permitted to provide a list of URLs in one easy format to have content or search results removed from our website.
    <br>  <br>
To register for an account, please fill out the form below. You will need to fill out all the fields to submit the form, including by providing documentation proving your affiliation with a rights holder (please provide a URL linking to a pdf file with the documentation).
<br>  <br>
You may only be granted a Special Rights holders Account if you agree to abide by the  <a href="{{url('/sra_terms_and_conditions')}}">special terms and conditions</a> of the account.

  </p>
  <br>


  {{ Form::open(['route' => 'frontend.auth.register','files'=>true , 'class' => 'form-horizontal form_details']) }}
         
          <div class="div_error">
          @if($errors->any())
              {!! implode('<br>',$errors->all(':message')) !!}
          @endif
          </div>
          <br class="d-lg-block d-xl-block   d-sm-none d-xs-none d-md-block d-xl-block">
          <br class="d-xl-block d-lg-none d-sm-none d-xs-none d-md-none">
          
          <div class="row border1 cls_zr">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0  border1"></div>

              <div class="col-lg-4  col-xl-3  col-sm-4  col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="organization" class="col_white lbl_text">Organization:  </label>
                      </div>
                        
                      <div class="col-lg-8  cls_zr col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control cls_zr lbl_text @error('organization') is-invalid @enderror" type="text" id="fname" name="organization"  value="{{ old('organization') }}" required/>
                         
                      </div>
                  </div>
              </div>
            
              <div class="cls_zr col-lg-4 col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="cls_zr col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="name " class="col_white lbl_text"> Name:  </label>
                      </div>
                      <div class="cls_zr col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                      <input type="text" class="cls_zr form-control lbl_text" id="lname" name="name"  value="{{ old('name') }}" required/>
                    </div>
                  </div>
              </div>

               <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3  col-0  border1"></div>
          </div>

        
          

          <br class="d-lg-block d-xl-block  d-sm-none  d-xs-none d-md-block" >
          <div class="row  sponser_name border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1 "></div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 sponser_name border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="address" class="col_white lbl_text">Address:</label>
                      </div>

                      <div class="col-lg-8 col-lg-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="address"  value="{{ old('sponser_name') }}" name="sponser_name"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 sponser_id border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label  for="state" class="col_white lbl_text">State:</label>
                      </div>

                        <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="state"  value="{{ old('sponser_id') }}" name="sponser_id"/>
                       </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 sponser_name border1"></div>
          </div>



          <br class="d-lg-block d-xl-block  d-sm-none  d-xs-none d-md-block" >
          <div class="row  sponser_name border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1 "></div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 sponser_name border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="country" class="col_white lbl_text">Country:</label>
                      </div>

                      <div class="col-lg-8 col-lg-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="country"  value="{{ old('country') }}" name="country"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 sponser_id border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label  for="state" class="col_white lbl_text">Email:</label>
                      </div>

                        <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="email" class="form-control lbl_text" id="email"  value="{{ old('email') }}" name="email"/>
                       </div>
                  </div>
              </div>
            </div>   


            
          <br class="d-lg-block d-xl-block  d-sm-none  d-xs-none d-md-block" >
          <div class="row  sponser_name border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1 "></div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 sponser_name border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="phone" class="col_white lbl_text">Phone:</label>
                      </div>

                      <div class="col-lg-8 col-lg-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="number" id="phone"  value="{{ old('phone') }}" name="phone"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 sponser_id border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label  for="state" class="col_white lbl_text">Document Proof:</label>
                      </div>

                        <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="dproof" class="form-control lbl_text" id="dproof"  value="{{ old('dproof') }}" name="dproof"/>
                       </div>
                  </div>
              </div>
            </div>  
            <br class="d-lg-block d-xl-block  d-sm-none  d-xs-none d-md-block" >
            <div class="row border1">

              <div class="col-lg-1 col-xl-2  col-sm-1  col-md-1 col-0 border1"></div>
              <div class="col-lg-3 col-xl-3 col-sm-6  col-md-6 col-7 border1"></div>
              <div class="col-lg-3 col-xl-2 col-sm-2 col-md-2 col-2 border1">
              <input type='submit'   id="" class="btn btn-info lbl_text" value='Send'>
            </div>
            <div class="col-lg-3 col-xl-3 col-sm-3  col-md-3 col-5 border1"></div>
          </div>
          {{ Form::close() }}


          <br class="d-lg-block d-xl-block  d-sm-none  d-xs-none d-md-block" >


<div id="footer">
 <a href="{{url('/copyright_claims')}}">Copyright Claims</a><a href="{{url('/privacy_policy')}}">Privacy Policy</a><a href="{{url('/special_rightholders_accounts')}}">SRA</a><a href="{{url('/terms_and_agreement')}}">ToS</a>
 </div>
 </div>
  </section>
@endsection

@section('after-scripts')
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
     
});
	

  </script>
@endsection
