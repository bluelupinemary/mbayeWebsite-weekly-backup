@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/register_style.css') }}">
    <style>
       
    </style> 
@endsection

@section('content')
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
        </div>
    </div>
    <section class="container-fluid" style="height:100vh">
        <div class="sub_container" style="border:0px solid white">
          <div id="overlay"></div>
                  @if(session('success'))
                      <script>
                       
                        document.getElementById("overlay").style.display = "block";
                    </script>
                       <div class="sucess_msg " >
                        <img  id='logo_mbaye' class="logo_mbaye  img-fluid" 
                        src="{{ asset('front') }}/images/MBAYE LOGO/mbaye_chosen_logo_blue.png" />
                        
                        <span class="alert alert-success" role="alert">
                            <p>{{ session('success') }}</p>
                        </span>
                      
                      <input type="button"  value="OK" class="btn btn_info btn_redirect" onclick="redirectToHome()"/>
                      
                      </div>
                  @endif
          {{ Form::open(['route' => 'frontend.auth.register','files'=>true , 'class' => 'form-horizontal form_details', 'id'=>'MyForm','onsubmit' => 'event.preventDefault(); validateMyForm();']) }}
          <div class="page-header">
              <h1 class=" head_1 col_white" style="">CREATE YOUR PROFILE</h1>
              <p class="col_white label_info">Please fill in this form to create an account.</p>
          </div>
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
                          <label for="first_name" class="col_white lbl_text">First Name:  &nbsp;<span style="color:red">*</span></label>
                      </div>
                        
                      <div class="col-lg-8  cls_zr col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control cls_zr lbl_text @error('first_name') is-invalid @enderror" type="text" id="fname" name="first_name"  value="{{ old('first_name') }}" required/>
                          @error('first_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                  </div>
              </div>
            
              <div class="cls_zr col-lg-4 col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="cls_zr col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="last_name " class="col_white lbl_text">Last Name:  &nbsp;<span style="color:red">*</span></label>
                      </div>
                      <div class="cls_zr col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                      <input type="text" class="cls_zr form-control lbl_text" id="lname" name="last_name"  value="{{ old('last_name') }}" required/>
                    </div>
                  </div>
              </div>

               <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3  col-0  border1"></div>
          </div>

          <br class="d-lg-none d-xl-block  d-sm-none  d-xs-none d-md-none" >
          <div class="row border1">
              <div class="col-lg-1 col-xl-2  col-sm-1 col-md-1 col-0  border1"></div>

              <div class="col-lg-4 col-xl-3 col-sm-4  col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label class="control-label col_white lbl_text " for="dob" >Date Of Birth<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input class="form-control lbl_text" id="date" name="dob" placeholder="MM/DD/YYYY" type="date" value="{{ old('dob') }}" required onchange="calculate_age()"/>
                      </div>

                  </div>
              </div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 border1 " >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3" >
                          <label for="age" class="col_white lbl_text">Age:</label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input type="number" class="form-control lbl_text" id="age" value="{{ old('age') }}" name="age"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0  border1 "></div>
          </div>

          <br class="d-lg-none d-xl-none  d-sm-none  d-xs-none d-md-none" >
          <div class="row  sponser_name border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1 "></div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 sponser_name border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="sname" class="col_white lbl_text">Sponser Name:</label>
                      </div>

                      <div class="col-lg-8 col-lg-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="sname"  value="{{ old('sponser_name') }}" name="sponser_name"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 sponser_id border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label  for="sid" class="col_white lbl_text">Sponser Id:</label>
                      </div>

                        <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="sid"  value="{{ old('sponser_id') }}" name="sponser_id"/>
                       </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 sponser_name border1"></div>
          </div>

          <!--4-->
          <br class="d-lg-none d-xl-none  d-sm-none  d-xs-none d-md-none " >
          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1 ">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                      <label for="gender" class="col_white lbl_text">Gender: &nbsp;<span style="color:red">*</span> </label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <select name="gender" class=" mb-3 form-control lbl_text" id="genders"   required>
                              <option value="" id="var_gender" name="gender"  >Select Gender</option>
                              <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif var_gender="Male">Male</option>
                              <option value="Female" @if (old('gender') == "Female") {{ 'selected' }} @endif var_gender="Female">Female</option>
                              <option value="Other" @if (old('gender') == "Other") {{ 'selected' }} @endif var_gender="Other">Other</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1" >
                  <div class="row">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label for="sname" class="col_white lbl_text">Address:</label>
                      </div>
                  
                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="address" value="{{ old('address') }}" name="address"/>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 border1"></div>         
          </div>

          <!--5-->
          <br class="d-lg-block d-xl-none  d-sm-block d-xs-none d-md-block " >
          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label for="country" class="col_white lbl_text">country:</label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                        	
                        <input id="countries" name="country" value="{{ old('country') }}" class="countries form-control lbl_text mb-3 "/>
                      </div>

                  </div>
              </div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                          <label for="id" class="col_white lbl_text">Id Number:<span style="color:red">*</span></label>
                      </div>
                          
                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6  border1" >
                          <input type="text" class="form-control lbl_text" type="text" id="id_number" value="{{ old('id_number') }}" required name="id_number"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2  col-xl-4 col-sm-3 col-md-3 col-0  border1"></div>         
          </div>

          <!--6-->
          <br class="d-lg-none d-xl-none  d-sm-block d-xs-none d-md-block " >
          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1  col-md-1 col-0  border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                        <label for="email" class="col_white lbl_text">Email:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8  col-sm-7 col-md-7 col-6  border1" >
                        <input type="email" class="form-control lbl_text mb-3 " id="Email" value="{{ old('email') }}" requird name="email" required/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12  border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                          <label for="mob" class="col_white lbl_text">Mobile Number:</label>
                      </div>
                          
                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6  border1" >
                          <input type="number" class="form-control lbl_text" type="number" id="mob_no" value="{{ old('mobile_number') }}" name="mobile_number"/>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 border1 "></div>         
          </div>

          <!--7-->
          <br class="d-lg-none d-xl-none  d-sm-none d-xs-none d-md-none" >
          <div class="row  border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>
              <div class="col-lg-4 col-xl-3  col-sm-4  col-md-4 col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3  border1" >
                        <label for="org_type" class="col_white lbl_text">Organization Type:</label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6  border1" >
                          <select name="org_type" value="{{ old('org_type') }}" class=" form-control lbl_text" id="org_types" >
                              <option value="" id="org_type"  >Select Organization Type</option>
                              <option value="School" org_type="School" @if (old('org_type') == "School") {{ 'selected' }} @endif>School</option>
                              <option value="Club" org_type="Club" @if (old('org_type') == "Club") {{ 'selected' }} @endif>Club</option>
                              <option value="Other" org_type="Other"  @if (old('org_type') == "Other") {{ 'selected' }} @endif >Other</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5  col-3 border1" >
                        <label for="org_name" class="col_white lbl_text">Organization Name:</label>
                      </div>
                      
                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="org_name" value="{{ old('org_name') }}" name="org_name"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4  col-sm-3  col-md-3 col-0 border1"></div>        
          </div>

          <!--8-->
          <br class="d-lg-none d-xl-none  d-sm-none d-xs-none d-md-none" >
          <div class="row  border1 ">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4  col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="username" class="col_white lbl_text">Username:<span style="color:red">*</span></label>
                      </div>
           
                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="username" value="{{ old('username') }}" required name="username"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5  col-3 border1" >
                          <label for="passwd" class="col_white lbl_text">Password:<span style="color:red">*</span></label>
                      </div>
                          
                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input type="password" class="form-control lbl_text"  id="password" value="{{ old('password') }}" required name="password"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4  col-sm-3  col-md-3 col-0 border1"></div>       
          </div>

          <br class="d-lg-block d-xl-block d-sm-block  d-xs-none d-md-block" >

          <div class="row">
              <div class="col-lg-1 col-xl-2  col-sm-1  col-md-1 col-0 border1"></div>

              <div class="col-lg-4 col-xl-4 col-sm-6  col-md-6 col-7 border1">
                  <label for="u_name" class="col_white lbl_text">
                    By creating an account you agree to our<a  class="" href="{{url('/terms_and_agreement')}}"> Terms & Agreement.</a> 
                    <input type="checkbox"   id="is_term_accept" name="is_term_accept" onchange="setCheckbox();">
               
               <a href="#"></a><br>
                    Already have an account?<a  class="" href="{{url('/login')}}">  Sign in</a>
                  </label>
              </div>

              <div class="col-lg-3 col-xl-2 col-sm-2 col-md-2 col-2 border1">
                  <input type='submit'   id="" class="btn btn-info lbl_text" style="" value='Submit'>
              </div>

              <div class="col-lg-4 col-xl-4 col-sm-3  col-md-3 col-5 border1"></div>
          </div>

          <br class="d-lg-none d-xl-none  d-sm-none d-xs-none d-md-none " >
          <!--form rows ends-->

          <!---camera section---->  
         <!-- <div class="camborder1">   </div>  -->
          <div id="my_camera" class="my_cam  camera_alignment" ></div>
          <input type=button  class="btn btn-info btn_snap_shot border1"   value="Take Snapshot" onClick="take_snapshot()">
          <input type=button  class="btn btn-info btn_cam_reset border1"   value="Reset" onClick="reset_snapshot()">
              
         
          <!---camera section ends---->  

          <!------Occupation --------->

          <label for="occupation" class="lbl_occupation col_white lbl_text">Occupation:<span style="color:red">*</span></label>

          <img  id='cloud' class="occupation" src="{{ asset('front') }}/images/cloud_occupation_1.png"   />

          <img  id='cloud_text' class="txt_occupation" src="{{ asset('front') }}/images/txt_speechCloud - Copy2.png"   />

          <img  class="cloud_bg mt-xl-4"  src="{{ asset('front') }}/images/speechCloud.png" >

          <textarea readonly rows="3" class='scrollbar force-overflow txtarea_occup' id='list_occupation'   name="list_occupation" style="background:transparent" onClick="load_animation_astronut();"> </textarea>

          <input type="hidden" class="form-control scrollbar scrollbar-info txt_occup"  disabled='disabled' id="occupation_text_area" required name="occupation">
          <!------Occupation ends---->

          <!--hidden fields-->
          <div class="row ">
             <div class="col-lg-12 col-xl-12" >
                <input type="hidden" class="form-control"  id="img_photo_register" name="photo"  value="{{ old('photo') }}" />
                <input type="hidden" class="form-control"  id="id" name="img_id"/>
                <input type="hidden" class="form-control"  name="occupation" id="occupation_txt"  value="{{ old('occupation') }}" />
                <input type="hidden" class="form-control"  id="pk_user_id" name="pk_user_id"/>
              </div>
          </div>
          <!------hidden fields-->
      {{ Form::close() }}

  <!-------Form Details End---------->

  <!---------------------------------Constellation images ----------------------------------------->

  <div id='constellations'>
     
     <span class="text_Aquaris" style=""><i>Aquarius</i></span>       
      <img class='aquarius aq_normal img_1' title="Aquarius" src="{{ asset('front') }}/images/constellations/aquarius_1.png">
      <img style='display:none;' title="Aquarius" class='aquarius aq_brighter img_2' src="{{ asset('front') }}/images/constellations/aquarius_brighter_1.png"> 
  </div>

  <div class="cls_zc"> 
      <span class="text_Aries" style=""><i>Aries</i></span>   
      <img  class='aries ar_normal img_1 cls_zc'  title="Aries" src="{{ asset('front') }}/images/constellations/aries_1.png">
      <img style='display:none;' title="Aries" class='aries ar_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/aries_brighter_1.png">
  </div>

  <div class="cls_zc">
      <span class="text_Cancer" style="" ><i>Cancer</i></span>    
      <img  class='cancer c_normal img_1 cls_zc' title="Cancer" src="{{ asset('front') }}/images/constellations/cancer_1.png">
      <img style='display:none;' title="Cancer" class='cancer c_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/cancer_brighter_1.png">
  </div>

  <div class="cls_zc"> 
    <span class="text_Capricorn"  style=""><i>Capricorn</i></span>    
    <img  class='capricorn cp_normal img_1 cls_zc' title="Capricorn" src="{{ asset('front') }}/images/constellations/capricorn_1.png">
    <img style='display:none;' title="Capricorn" class='capricorn cp_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/capricorn_brighter_1.png">
  </div>
   
  <div  class="cls_zc"> 
    <span class="text_Libra" style=""><i>Libra</i></span> 
    <img  class='libra  li_normal img_1 cls_zc' title="Libra" src="{{ asset('front') }}/images/constellations/libra_1.png">
    <img style='display:none;' title="Libra" class='libra li_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/libra_brighter_1.png">
  </div>
    
  <div  class="cls_zc">
    <span class="text_Gemini" style=""><i>Gemini</i></span>   
    <img  class='gemini gm_normal img_1 cls_zc' title="Gemini" src="{{ asset('front') }}/images/constellations/gemini_1.png">
    <img style='display:none;' title="Gemini" class='gemini gm_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/gemini_brighter_1.png">
  </div>

  <div  class="cls_zc">
    <span class="text_Leo" style=""><i>Leo</i></span> 
    <img  class='leo  le_normal img_1 cls_zc' title="Leo" src="{{ asset('front') }}/images/constellations/leo_1.png">
    <img style='display:none;' title="Leo" class='leo le_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/leo_brighter_1.png">
  </div>
   
  <div class="cls_zc">
    <span class="text_Pisces" style=""><i>Pisces</i></span>
    <img  class='pisces  p_normal img_1 cls_zc' title="Pisces" src="{{ asset('front') }}/images/constellations/pisces_1.png">
    <img style='display:none;' title="Pisces" class='pisces p_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/pisces_brighter_1.png">
  </div>

  <div class="cls_zc">
    <span class="text_Sagittarius" style=""><i>Sagittarius</i></span> 
    <img  class='sagittarius sg_normal img_1 cls_zc'  title="Sagittarius" src="{{ asset('front') }}/images/constellations/sagittarius_1.png">
    <img style='display:none;'  title="Sagittarius" class='sagittarius sg_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/sagittarius_brighter_1.png">
   
  </div>

  <div class="cls_zc">
    <span class="text_Scorpio" style=""><i>Scorpio</i></span> 
    <img  class='scorpio sc_normal img_1 cls_zc'  title="Scorpio" src="{{ asset('front') }}/images/constellations/scorpio_1.png">
    <img style='display:none;'  title="Scorpio" class='scorpio sc_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/scorpio_brighter_1.png">
  </div>

  <div class="cls_zc" >
    <span class="text_Taurus" style=""><i>Taurus</i></span>   
    <img  class='taurus t_normal img_1 cls_zc' title="Taurus" src="{{ asset('front') }}/images/constellations/taurus_1.png">
    <img style='display:none;' title="Taurus" class='taurus t_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/taurus_brighter_1.png">
  </div>

  <div class="cls_zc">
    <span class="text_Virgo" style=""><i>Virgo</i></span> 
    <img  class='virgo v_normal img_1 cls_zc'  title="Virgo" src="{{ asset('front') }}/images/constellations/virgo_1.png">
    <img style='display:none;'  title="Virgo" class='virgo v_brighter img_2 cls_zc' src="{{ asset('front') }}/images/constellations/virgo_brighter_1.png">
  </div>
    
      <!-------------------------------------------------------------->
      <!------------------For astronut div---------------------------->
  <div class="div_for_astro" style="display:none" >     </div>
      <img class='astro_occupation'  style="display:none;"  src="{{ asset('front') }}/images/astronut/backpack 2.png">      
  <div class="occ_description" style="display:none" >
      <p>
          Hello,<br>I am <span onClick="openwikipedia()" style="color: chocolate;">General Michael.</span>
          <br>Your occupation in life will most probably change,  as these changes of life go on, you should be able to note  here on your site.<br><br>The record of your occupations will stay here forever.<br><br>So if your occupation is, example; shoveling poo from a <span style="color:#c6552b" onClick="show_cuckoo()" title="Click here to know about  cuckoo clock">cuckoo clock</span>.<br><br>And then you become an astronaut. <br><br>It will be always on your profile.<br><br>So have fun, but remember everything you say in life can have a consequence.
      </p>
      <br> 
      <input type="text" class="form-control text_occup"  id="text_occupation_astro" placeholder="Your occupation"/>
      <br class="">
      <br class=""> 
      <button type="button" class="btn btn-info btn_occ_submit">Submit</button>
  </div> 
  <div class="div_clock overlay" style="display:none" >
      <img  class='cuckoo_image'  title="Cuckoo clock" src="{{ asset('front') }}/images/astronut/cuckoo clock.png">
      <p class="cuckoo_text">A Cuckoo clock as in the picture is a German black forest clock
                             with a little bird that comes out  and goes cuckoo. Actually 
                             somebody  really useless in life like villa the crab. 
                              We say they are so useless they couldn’t shovel poo out of a cuckoo clock.
      </p>
     
  </div>   
      <!--- div for helmet--->
    
  <div class="div_helmet"  style="display:none" onClick="goto_wiki2()"></div>
    
      <!--------------------->

      <!-------------------------------------------------------------->
      <!--audio for cuckoo clock -->
  <audio id="audio_cuckoo" src="{{ asset('front') }}/images/astronut/Cuckoo.wav"></audio>
      <!-------------------------------------------------------------->
      <!----wikipedia div -->
  <div id="Div_for_wiki"> 
      <img class="close_btn" src="{{ asset('front') }}/images/btn_close.png" style="width:5%;max-width:100%;height:auto; z-index: 1; " align="right" onclick="hidePage()"/>
      <object id="wikiPage" type="text/html" data="" style="overflow:auto;width:100%;height: 100%;">
      </object>
  </div>
  <div id="Div_for_wiki2"> 
      <img class="close_btn" src="{{ asset('front') }}/images/btn_close.png" style="width:5%;max-width:100%;height:auto; z-index: 1; " align="right" onclick="hidePage2()"/>
      <object id="wikiPage2" type="text/html" data="" style="overflow:auto;width:100%;height: 100%;">
      </object>
  </div>
  <!----------------->


  
<!-- Modal -->

<!-- The Modal -->

  <!-- The Modal -->
  <div class="modal" id="myModal" style="z-index:50000 !important">
    <div class="modal-dialog" >
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">TERMS OF SERVICE AGREEMENT</h1>
          <br>
          
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h5 class="">LAST REVISION: [16-03-2020]</h5><br>
          <p class="">
            PLEASE READ THIS TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
          </p>
          
          <p class="">
            This Terms of Service Agreement (the "Agreement") governs your use of this website, www.Mbaye.com (the "Website. This Agreement includes, 
            and incorporates by this reference, the policies and guidelines referenced below. Inox Arabia FZC and associated companies reserve the
             right to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on
              this Website. Inox Arabia FZC and associated companies will alert you that changes or revisions have been made by indicating on the 
              top of this Agreement the date it was last revised. The changed or revised Agreement will be effective immediately after it is
               posted on this Website. Your use of the Website following the posting any such changes or of a revised Agreement will constitute
                your acceptance of any such changes or revisions. Inox Arabia FZC and associated companies encourage you to review this Agreement
                 whenever you visit the Website to make sure that you understand the terms and conditions governing use of the Website. This 
                 Agreement does not alter in any way the terms or conditions of any other written agreement you may have with Inox Arabian
                  Technical Services LLC for other products or services. If you do not agree to this Agreement (including any referenced 
                  policies or guidelines), please immediately terminate your use of the Website. If you would like to print this Agreement,
                   please click the print button on your browser toolbar.
          </p>
          
        
        <h3 class="">I. WEBSITE</h3>
        
        <p class="">
        <b>Content; Intellectual Property; Third Party Links.</b>
         In addition to making Products available, this Website also offers information and allows you to play game. This Website also offers
          information, both directly and through indirect links to third-party websites. Mbaye.com does not always create the information offered
           on this Website; instead the information is often gathered from other sources. To the extent that Inox Arabia FZC and associated companies 
           do create the content on this Website, such content is protected by intellectual property laws of the foreign nations, and international 
           bodies. Unauthorized use of the material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content 
           on this Website is for personal, noncommercial use. Any links to third-party websites are provided solely as a convenience to you.
            Inox Arabia FZC and associated companies do not endorse the contents on any such third-party websites.
             Inox Arabia FZC and associated companies are not responsible for the content of or any damage that may result from your access to or reliance
              on these third-party websites. If you link to third-party websites, you do so at your own risk. 
        </p>
        
      
        <p class="">
          <b>Use of Website;</b>
           Inox Arabia FZC and associated companies are not responsible for any damages resulting from use of this website by anyone. You will not use
            the Website for illegal purposes. You will
           <ul>
             <li>
                Abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws 
                regarding intellectual property)
             </li>
             <li>    Not interfere with or disrupt the use and enjoyment of the Website by other users
             </li>
             <li>
               Not resell material on the Website
             </li>
             <li>
               Not engage, directly or indirectly, in transmission of "spam", chain letters, junk mail or any other type of unsolicited communication, and 
             </li>
             <li>Not defame, harass, abuse, or disrupt other users of the Website.
             </li>
            </ul>
        </p>
        <br>
        
        <p class="">
          <b>License.</b> By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on
           the Website in connection with your normal, noncommercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create
            derivative works of such content or information without express written authorization from Inox Arabia FZC and associated companies or the applicable
             third party (if third party content is at issue).
        </p>
        <br>
        
        <p class="">
          <b>Posting.</b> By posting, storing, or transmitting any content on the Website, you hereby grant Inox Arabia FZC and associated companies a perpetual,
           worldwide, non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute,
            have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world. 
            Inox Arabia FZC and associated companies do not have the ability to control the nature of the user-generated content offered through the Website. 
            You are solely responsible for your interactions with other users of the Website and any content you post. Inox Arabia FZC and associated companies 
            is not liable for any damage or harm resulting from any posts by or interactions between users. Inox Arabia FZC and associated companies reserve 
            the right, but has no obligation, to monitor interactions between and among users of the Website and to remove any content Inox Arabian 
            Technical Services LLC deems objectionable. 
          </p>
          <br>
        
          <h3 class="">II. DISCLAIMER OF WARRANTIES</h3>
          <p class="">
                  YOUR USE OF THIS WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE IS OFFERED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WITHOUT LIMITING
                   THE GENERALITY OF THE FOREGOING, INOX ARABIA FZC AND ASSOCIATED COMPANIES  MAKE NO WARRANTY:
              THAT THE INFORMATION PROVIDED ON THIS WEBSITE IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
              THAT THE LINKS TO THIRD-PARTY WEBSITES ARE TO INFORMATION THAT IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
              NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THIS WEBSITE WILL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN. 
          </p>
          
          <br>
          <h3 class="">III. INDEMNIFICATION</h3>
          <p class="">
            You will release, indemnify, defend and hold harmless Inox Arabia FZC and associated companies, and any of its contractors, agents, employees,
             officers, directors, shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable
              attorneys' fees and expenses, of third parties relating to or arising out of
          </p>
           <ul>
              <li> this Agreement or the breach of your warranties, representations and obligations under this Agreement;
              </li>
              <li>the Website content or your use of the Website content
              </li>
              <li>
                 any intellectual property or other proprietary right of any person or entity; 
              </li><li>
               your violation of any provision of this Agreement; or 
              </li>
              <li>
                any information or data you supplied to Inox Arabia FZC and associated companies. When Inox Arabia FZC and associated companies is threatened with 
                suit or sued by a third party, Inox Arabia FZC and associated companies may seek written assurances from you concerning your promise to indemnify 
                Inox Arabia FZC and associated companies;
              </li>
            </ul>
              <p class="">
                  your failure to provide such assurances may be considered by Inox Arabia FZC and associated companies to be a material breach of this Agreement.
                   Inox Arabia FZC and associated companies will have the right to participate in any defense by you of a third-party claim related to your use of
                    any of the Website content, with counsel of Inox Arabia FZC and associated companies choice at its expense. Inox Arabia FZC and associated companies 
                    will reasonably cooperate in any defense by you of a third-party claim at your request and expense. You will have sole responsibility to 
                    defend Inox Arabia FZC and associated companies against any claim, but you must receive Inox Arabia FZC and associated companies prior written 
                    consent regarding any related settlement. The terms of this provision will survive any termination or cancellation of this Agreement
                     or your use of the Website or Products.
          </p>
          <br>
        
          <h3 class="">IV. PRIVACY</h3>
          <p class="">
            Inox Arabia FZC and associated companies believe strongly in protecting user privacy and providing you with notice of Mbaye.com’s use of data.
             Please refer to Inox Arabia FZC and associated companies privacy policy, incorporated by reference herein that is posted on the Website.
          </p>
          <br>
        
          <h3 class="">V. AGREEMENT TO BE BOUND</h3>
          <p class="">
            By using this Website, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.  
          </p>
          <br>
        
          <h3 class="">VI. GENERAL</h3>
          <p class="">
            <b>Force Majeure.</b> Inox Arabia FZC and associated companies will not be deemed in default hereunder or held responsible for any cessation,
             interruption or delay in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God,
              war, terrorism, armed conflict, labor strike, lockout , boycott or any national or international pandemic.
          </p>
          <br>
        
          <p class="">
            <b>Cessation of Operation. </b> Inox Arabia FZC and associated companies may at any time, in its sole discretion and without advance notice to you,
             cease operation of the Website and distribution of the Products.
          </p>
          <br>
        
          <p class="">
            <b>Entire Agreement.</b> This Agreement comprises the entire agreement between you and Inox Arabia FZC and associated companies and supersedes any 
            prior agreements pertaining to the subject matter contained herein.
         </p>
          <br>
        
          <p class="">
            <b>Effect of Waiver.</b> The failure of Inox Arabia FZC and associated companies to exercise or enforce any right or provision of this Agreement 
            will not constitute a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to
             be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the 
             provision, and the other provisions of this Agreement remain in full force and effect.
          </p>
          <br>
        
          <p class="">
            <b>Governing Law; Jurisdiction. </b> This Website originates from the Dubai, United Arab Emirates, This Agreement will be governed by the 
            laws of the State of European Union  without regard to its conflict of law principles to the contrary. Neither you nor
             Inox Arabia FZC and associated companies will commence or prosecute any suit, proceeding or claim to enforce the provisions of this
              Agreement, to recover damages for breach of or default of this Agreement, or otherwise arising under or by reason of this Agreement,
               other than in courts located in State of European Union . By using this Website or ordering Products, you consent to the jurisdiction
                and venue of such courts in connection with any action, suit, proceeding or claim arising under or by reason of this Agreement. 
                You hereby waive any right to trial by jury arising out of this Agreement and any related documents.
          </p>
          <br>
        
          <p class="">
            <b>Statute of Limitation. </b> You agree that regardless of any statute or law to the contrary, any claim or cause of action arising 
            out of or related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of 
            action arose or be forever barred.
          </p>
          <br>
        
          <p class="">
            <b>Waiver of Class Action Rights.  </b> BY ENTERING INTO THIS AGREEMENT, YOU HEREBY IRREVOCABLY WAIVE ANY RIGHT YOU MAY HAVE TO JOIN 
            CLAIMS WITH THOSE OF OTHER IN THE FORM OF A CLASS ACTION OR SIMILAR PROCEDURAL DEVICE. ANY CLAIMS ARISING OUT OF, RELATING TO, OR 
            CONNECTION WITH THIS AGREEMENT MUST BE ASSERTED INDIVIDUALLY.
         </p>
          <br>
        
          <p class="">
            <b>Termination. </b> Inox Arabia FZC and associated companies reserve the right to terminate your access to the Website if it reasonably 
            believes, in its sole discretion, that you have breached any of the terms and conditions of this Agreement. Following termination, 
            you will not be permitted to use the Website and Inox Arabia FZC and associated companies may, in its sole discretion and without advance
             notice to you, cancel any outstanding orders for Products. If your access to the Website is terminated, Inox Arabia FZC and associated companies
              reserves the right to exercise whatever means it deems necessary to prevent unauthorized access of the Website. This Agreement will
               survive indefinitely unless and until Inox Arabia FZC and associated companies choose, in its sole discretion and without advance to you, to terminate it.
          </p>
         
        
          <p class="">
            <b>Domestic Use. </b> Inox Arabia FZC and associated companies make no representation that the Website is appropriate or available for use in 
            locations outside UAE. Users who access the Website from outside UAE do so at their own risk and initiative and must bear all responsibility 
            for compliance with any applicable local laws.
          </p>
          <br>
        
          <p class="">
            <b>Assignment. </b> You may not assign your rights and obligations under this Agreement to anyone. Inox Arabia FZC and associated companies may 
            assign its rights and obligations under this Agreement in its sole discretion and without advance notice to you.
         </p>
          <br>

          <p class="">
            BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
          </p>
        

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="btn_agree" class="btn btn-success" data-dismiss="modal">I Agree</button>
          <button type="button" id="btn_dagree" class="btn btn-danger" data-dismiss="modal">I Disagree</button>
        </div>
        
      </div>
    </div>
  </div>




<!---model ends -->
        </div>
    </section>
@endsection

@section('after-scripts')
    <!-----------------------------------   script section ------------------------------------------>
        <script src="{{ asset('front') }}/JS/webcam.min.js"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
  
        <script src="{{ asset('front') }}/JS/bootstrap-datepicker.min.js"></script>
        <!-- Webcam.min.js -->
    <!--------------------------------------- For camera--------------------------------------------->
    <script language="JavaScript">
    
          Webcam.set({
     //  force_flash: true,
         // width: 207,
          //height: 270,
         // dest_width: 207, 
         // dest_height: 270,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
    </script>
    <!--------------------------------------- Manual script ------------------------------------------>
    <script>
      let countries =[ 
  {"name": "Afghanistan", "code": "AF"}, 
  {"name": "Albania", "code": "AL"}, 
  {"name": "Algeria", "code": "DZ"}, 
  {"name": "American Samoa", "code": "AS"}, 
  {"name": "AndorrA", "code": "AD"}, 
  {"name": "Angola", "code": "AO"}, 
  {"name": "Anguilla", "code": "AI"}, 
  {"name": "Antigua and Barbuda", "code": "AG"}, 
  {"name": "Argentina", "code": "AR"}, 
  {"name": "Armenia", "code": "AM"}, 
  {"name": "Aruba", "code": "AW"}, 
  {"name": "Australia", "code": "AU"}, 
  {"name": "Austria", "code": "AT"}, 
  {"name": "Azerbaijan", "code": "AZ"}, 
  {"name": "Bahamas", "code": "BS"}, 
  {"name": "Bahrain", "code": "BH"}, 
  {"name": "Bangladesh", "code": "BD"}, 
  {"name": "Barbados", "code": "BB"}, 
  {"name": "Belarus", "code": "BY"}, 
  {"name": "Belgium", "code": "BE"}, 
  {"name": "Belize", "code": "BZ"}, 
  {"name": "Benin", "code": "BJ"}, 
  {"name": "Bermuda", "code": "BM"}, 
  {"name": "Bhutan", "code": "BT"}, 
  {"name": "Bolivia", "code": "BO"}, 
  {"name": "Bosnia and Herzegovina", "code": "BA"}, 
  {"name": "Botswana", "code": "BW"}, 
  {"name": "Bouvet Island", "code": "BV"}, 
  {"name": "Brazil", "code": "BR"}, 
  {"name": "British Indian Ocean Territory", "code": "IO"}, 
  {"name": "Brunei Darussalam", "code": "BN"}, 
  {"name": "Bulgaria", "code": "BG"}, 
  {"name": "Burkina Faso", "code": "BF"}, 
  {"name": "Burundi", "code": "BI"}, 
  {"name": "Cambodia", "code": "KH"}, 
  {"name": "Cameroon", "code": "CM"}, 
  {"name": "Canada", "code": "CA"}, 
  {"name": "Cape Verde", "code": "CV"}, 
  {"name": "Cayman Islands", "code": "KY"}, 
  {"name": "Central African Republic", "code": "CF"}, 
  {"name": "Chad", "code": "TD"}, 
  {"name": "Chile", "code": "CL"}, 
  {"name": "China", "code": "CN"}, 
  {"name": "Christmas Island", "code": "CX"}, 
  {"name": "Cocos (Keeling) Islands", "code": "CC"}, 
  {"name": "Colombia", "code": "CO"}, 
  {"name": "Comoros", "code": "KM"}, 
  {"name": "Congo", "code": "CG"}, 
  {"name": "Congo, The Democratic Republic of the", "code": "CD"}, 
  {"name": "Cook Islands", "code": "CK"}, 
  {"name": "Costa Rica", "code": "CR"}, 
  {"name": "Cote D\"Ivoire", "code": "CI"}, 
  {"name": "Croatia", "code": "HR"}, 
  {"name": "Cuba", "code": "CU"}, 
  {"name": "Cyprus", "code": "CY"}, 
  {"name": "Czech Republic", "code": "CZ"}, 
  {"name": "Denmark", "code": "DK"}, 
  {"name": "Djibouti", "code": "DJ"}, 
  {"name": "Dominica", "code": "DM"}, 
  {"name": "Dominican Republic", "code": "DO"}, 
  {"name": "Ecuador", "code": "EC"}, 
  {"name": "Egypt", "code": "EG"}, 
  {"name": "El Salvador", "code": "SV"}, 
  {"name": "Equatorial Guinea", "code": "GQ"}, 
  {"name": "Eritrea", "code": "ER"}, 
  {"name": "Estonia", "code": "EE"}, 
  {"name": "Ethiopia", "code": "ET"}, 
  {"name": "Falkland Islands (Malvinas)", "code": "FK"}, 
  {"name": "Faroe Islands", "code": "FO"}, 
  {"name": "Fiji", "code": "FJ"}, 
  {"name": "Finland", "code": "FI"}, 
  {"name": "France", "code": "FR"}, 
  {"name": "French Guiana", "code": "GF"}, 
  {"name": "French Polynesia", "code": "PF"}, 
  {"name": "French Southern Territories", "code": "TF"}, 
  {"name": "Gabon", "code": "GA"}, 
  {"name": "Gambia", "code": "GM"}, 
  {"name": "Georgia", "code": "GE"}, 
  {"name": "Germany", "code": "DE"}, 
  {"name": "Ghana", "code": "GH"}, 
  {"name": "Gibraltar", "code": "GI"}, 
  {"name": "Greece", "code": "GR"}, 
  {"name": "Greenland", "code": "GL"}, 
  {"name": "Grenada", "code": "GD"}, 
  {"name": "Guadeloupe", "code": "GP"}, 
  {"name": "Guam", "code": "GU"}, 
  {"name": "Guatemala", "code": "GT"}, 
  {"name": "Guernsey", "code": "GG"}, 
  {"name": "Guinea", "code": "GN"}, 
  {"name": "Guinea-Bissau", "code": "GW"}, 
  {"name": "Guyana", "code": "GY"}, 
  {"name": "Haiti", "code": "HT"}, 
  {"name": "Heard Island and Mcdonald Islands", "code": "HM"}, 
  {"name": "Holy See (Vatican City State)", "code": "VA"}, 
  {"name": "Honduras", "code": "HN"}, 
  {"name": "Hong Kong", "code": "HK"}, 
  {"name": "Hungary", "code": "HU"}, 
  {"name": "Iceland", "code": "IS"}, 
  {"name": "India", "code": "IN"}, 
  {"name": "Indonesia", "code": "ID"}, 
  {"name": "Iran, Islamic Republic Of", "code": "IR"}, 
  {"name": "Iraq", "code": "IQ"}, 
  {"name": "Ireland", "code": "IE"}, 
  {"name": "Isle of Man", "code": "IM"}, 
  {"name": "Israel", "code": "IL"}, 
  {"name": "Italy", "code": "IT"}, 
  {"name": "Jamaica", "code": "JM"}, 
  {"name": "Japan", "code": "JP"}, 
  {"name": "Jersey", "code": "JE"}, 
  {"name": "Jordan", "code": "JO"}, 
  {"name": "Kazakhstan", "code": "KZ"}, 
  {"name": "Kenya", "code": "KE"}, 
  {"name": "Kiribati", "code": "KI"}, 
  {"name": "Korea, Democratic People\"S Republic of", "code": "KP"}, 
  {"name": "Korea, Republic of", "code": "KR"}, 
  {"name": "Kuwait", "code": "KW"}, 
  {"name": "Kyrgyzstan", "code": "KG"}, 
  {"name": "Lao People\"S Democratic Republic", "code": "LA"}, 
  {"name": "Latvia", "code": "LV"}, 
  {"name": "Lebanon", "code": "LB"}, 
  {"name": "Lesotho", "code": "LS"}, 
  {"name": "Liberia", "code": "LR"}, 
  {"name": "Libyan Arab Jamahiriya", "code": "LY"}, 
  {"name": "Liechtenstein", "code": "LI"}, 
  {"name": "Lithuania", "code": "LT"}, 
  {"name": "Luxembourg", "code": "LU"}, 
  {"name": "Macao", "code": "MO"}, 
  {"name": "Macedonia, The Former Yugoslav Republic of", "code": "MK"}, 
  {"name": "Madagascar", "code": "MG"}, 
  {"name": "Malawi", "code": "MW"}, 
  {"name": "Malaysia", "code": "MY"}, 
  {"name": "Maldives", "code": "MV"}, 
  {"name": "Mali", "code": "ML"}, 
  {"name": "Malta", "code": "MT"}, 
  {"name": "Marshall Islands", "code": "MH"}, 
  {"name": "Martinique", "code": "MQ"}, 
  {"name": "Mauritania", "code": "MR"}, 
  {"name": "Mauritius", "code": "MU"}, 
  {"name": "Mayotte", "code": "YT"}, 
  {"name": "Mexico", "code": "MX"}, 
  {"name": "Micronesia, Federated States of", "code": "FM"}, 
  {"name": "Moldova, Republic of", "code": "MD"}, 
  {"name": "Monaco", "code": "MC"}, 
  {"name": "Mongolia", "code": "MN"}, 
  {"name": "Montserrat", "code": "MS"}, 
  {"name": "Morocco", "code": "MA"}, 
  {"name": "Mozambique", "code": "MZ"}, 
  {"name": "Myanmar", "code": "MM"}, 
  {"name": "Namibia", "code": "NA"}, 
  {"name": "Nauru", "code": "NR"}, 
  {"name": "Nepal", "code": "NP"}, 
  {"name": "Netherlands", "code": "NL"}, 
  {"name": "Netherlands Antilles", "code": "AN"}, 
  {"name": "New Caledonia", "code": "NC"}, 
  {"name": "New Zealand", "code": "NZ"}, 
  {"name": "Nicaragua", "code": "NI"}, 
  {"name": "Niger", "code": "NE"}, 
  {"name": "Nigeria", "code": "NG"}, 
  {"name": "Niue", "code": "NU"}, 
  {"name": "Norfolk Island", "code": "NF"}, 
  {"name": "Northern Mariana Islands", "code": "MP"}, 
  {"name": "Norway", "code": "NO"}, 
  {"name": "Oman", "code": "OM"}, 
  {"name": "Pakistan", "code": "PK"}, 
  {"name": "Palau", "code": "PW"}, 
  {"name": "Palestinian Territory, Occupied", "code": "PS"}, 
  {"name": "Panama", "code": "PA"}, 
  {"name": "Papua New Guinea", "code": "PG"}, 
  {"name": "Paraguay", "code": "PY"}, 
  {"name": "Peru", "code": "PE"}, 
  {"name": "Philippines", "code": "PH"}, 
  {"name": "Pitcairn", "code": "PN"}, 
  {"name": "Poland", "code": "PL"}, 
  {"name": "Portugal", "code": "PT"}, 
  {"name": "Puerto Rico", "code": "PR"}, 
  {"name": "Qatar", "code": "QA"}, 
  {"name": "Reunion", "code": "RE"}, 
  {"name": "Romania", "code": "RO"}, 
  {"name": "Russian Federation", "code": "RU"}, 
  {"name": "RWANDA", "code": "RW"}, 
  {"name": "Saint Helena", "code": "SH"}, 
  {"name": "Saint Kitts and Nevis", "code": "KN"}, 
  {"name": "Saint Lucia", "code": "LC"}, 
  {"name": "Saint Pierre and Miquelon", "code": "PM"}, 
  {"name": "Saint Vincent and the Grenadines", "code": "VC"}, 
  {"name": "Samoa", "code": "WS"}, 
  {"name": "San Marino", "code": "SM"}, 
  {"name": "Sao Tome and Principe", "code": "ST"}, 
  {"name": "Saudi Arabia", "code": "SA"}, 
  {"name": "Senegal", "code": "SN"}, 
  {"name": "Serbia and Montenegro", "code": "CS"}, 
  {"name": "Seychelles", "code": "SC"}, 
  {"name": "Sierra Leone", "code": "SL"}, 
  {"name": "Singapore", "code": "SG"}, 
  {"name": "Slovakia", "code": "SK"}, 
  {"name": "Slovenia", "code": "SI"}, 
  {"name": "Solomon Islands", "code": "SB"}, 
  {"name": "Somalia", "code": "SO"}, 
  {"name": "South Africa", "code": "ZA"}, 
  {"name": "South Georgia and the South Sandwich Islands", "code": "GS"}, 
  {"name": "Spain", "code": "ES"}, 
  {"name": "Sri Lanka", "code": "LK"}, 
  {"name": "Sudan", "code": "SD"}, 
  {"name": "Suri", "code": "SR"}, 
  {"name": "Svalbard and Jan Mayen", "code": "SJ"}, 
  {"name": "Swaziland", "code": "SZ"}, 
  {"name": "Sweden", "code": "SE"}, 
  {"name": "Switzerland", "code": "CH"}, 
  {"name": "Syrian Arab Republic", "code": "SY"}, 
  {"name": "Taiwan, Province of China", "code": "TW"}, 
  {"name": "Tajikistan", "code": "TJ"}, 
  {"name": "Tanzania, United Republic of", "code": "TZ"}, 
  {"name": "Thailand", "code": "TH"}, 
  {"name": "Timor-Leste", "code": "TL"}, 
  {"name": "Togo", "code": "TG"}, 
  {"name": "Tokelau", "code": "TK"}, 
  {"name": "Tonga", "code": "TO"}, 
  {"name": "Trinidad and Tobago", "code": "TT"}, 
  {"name": "Tunisia", "code": "TN"}, 
  {"name": "Turkey", "code": "TR"}, 
  {"name": "Turkmenistan", "code": "TM"}, 
  {"name": "Turks and Caicos Islands", "code": "TC"}, 
  {"name": "Tuvalu", "code": "TV"}, 
  {"name": "Uganda", "code": "UG"}, 
  {"name": "Ukraine", "code": "UA"}, 
  {"name": "United Arab Emirates", "code": "AE"}, 
  {"name": "United Kingdom", "code": "GB"}, 
  {"name": "United States", "code": "US"}, 
  {"name": "United States Minor Outlying Islands", "code": "UM"}, 
  {"name": "Uruguay", "code": "UY"}, 
  {"name": "Uzbekistan", "code": "UZ"}, 
  {"name": "Vanuatu", "code": "VU"}, 
  {"name": "Venezuela", "code": "VE"}, 
  {"name": "Viet Nam", "code": "VN"}, 
  {"name": "Virgin Islands, British", "code": "VG"}, 
  {"name": "Virgin Islands, U.S.", "code": "VI"}, 
  {"name": "Wallis and Futuna", "code": "WF"}, 
  {"name": "Western Sahara", "code": "EH"}, 
  {"name": "Yemen", "code": "YE"}, 
  {"name": "Zambia", "code": "ZM"}, 
  {"name": "Zimbabwe", "code": "ZW"} 
]

        var global_occupation='';
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
    function show_cuckoo(){
        $('.div_clock').css({'display':'block'});
        var audio = document.getElementById("audio_cuckoo");
        audio.playbackRate =1;
        audio.play();    
        }
        $(document).ready(function () {
          var options = {
                          data: countries,
                          getValue: "name",
                          list: {
                              match: {
                                  enabled: true
                              }
                          }
                    };
$("#countries").easyAutocomplete(options);

    //for identifying zordiac sign in the edit mode
    $("#list_occupation ").hide();
    $(".close_btn ").hide();
    
    var org='';
    var country='';
    var occupation='';
    var gender='';
    var count='';
    var width='';
    var height='';
  


 org='DUMMY';
 country='dummy';

 /* For occupation cloud */ 

 occupation='dummy';

 gender='dummy';
 count='dummy';
 width = document.getElementById('cloud').offsetWidth;
 height = document.getElementById('cloud').offsetHeight;
 if(count>=4){ 
    width=width+1;
    height=height+15;
 
 }


document.getElementById('countryIds').value = country;


$("#list_occupation").show();
$("#list_occupation ").html(occupation);
if(occupation!='')
  $("#list_occupation ").val(occupation.split(",").join("\n"));
global_occupation=occupation;
var encodedString='dummy';
var img_src='';
var img_src=decodeURIComponent(encodedString);
document.getElementById('my_camera').innerHTML = 
       '<img  name="photo" id="img_photo"  class="cam_photo camera" style="" src="'+img_src+'"/>';
 
  
  
    //For the name  of zordiac signs
    $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
    $(".text_Pisces").removeClass("ani-rollouttext_Pisces");
    $(".text_Aries ").removeClass("ani-rollouttext_Aries");
    $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
    $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
    $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
    $(".text_Leo").removeClass("ani-rollouttext_Leo");
    $(".text_Virgo").removeClass("ani-rollouttext_Virgo");
    $(".text_Libra ").removeClass("ani-rollouttext_Libra");
    $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
    $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
    $(".text_Capricorn").removeClass("ani-rollouttext_Capricorn");
  
    $('.img_2').css({'display':'none'});
    $('.img_1').css({'display':'block'});

    $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
    $('.text_Aquaris').css({'display':'none'});
    $(".text_Pisces ").removeClass("ani-rollouttext_Pisces");
    $('.text_Pisces').css({'display':'none'});
    $(".text_Aries ").removeClass("ani-rollouttext_Aries");
    $('.text_Aries').css({'display':'none'});
    $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
    $('.text_Taurus').css({'display':'none'});
    $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
    $('.text_Gemini').css({'display':'none'});
    $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
    $('.text_Cancer').css({'display':'none'});
    $(".text_Leo ").removeClass("ani-rollouttext_Leo");
    $('.text_Leo').css({'display':'none'});
    $(".text_Virgo ").removeClass("ani-rollouttext_Virgo");
    $('.text_Virgo').css({'display':'none'});
    $(".text_Libra ").removeClass("ani-rollouttext_Libra");
    $('.text_Libra').css({'display':'none'});
    $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
    $('.text_Scorpio').css({'display':'none'});
    $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
    $('.text_Sagittarius').css({'display':'none'});
    $(".text_Capricorn ").removeClass("ani-rollouttext_Capricorn");
    $('.text_Capricorn').css({'display':'none'});
    $(".sponser_name").hide(); //for hiding sponser name and sponser id   
     
    calculate_age();
    // Date time picker change value
    $('#date').change(function(){
    $(this).attr('value', $('#date').val());
});
//combo box  value setting 
//loadSelect_for_country(country);
if(org!='')
 loadSelect_for_org_type(org);
 if(gender!='') 
 loadSelect_for_gender(gender);
});
            
            /*
            Button click function for registration 
            */
            $('#btn_Register').click(function(){
             
             var str_occupation= $("#text_occupation_astro").val();
             $("#occupation_txt").val(str_occupation);
             var str = $("form").serializeArray();

                     $.ajax({  
                        type: "POST",  
                        url: "http://localhost/Mbaye/index.php/home/Save_registration_details",
                        data: str,
                        dataType: "json",  
                        success: function (result) { 
                          var msg =  result;               
                          alert(msg);
                       
                        },  
                        error: function () {  
                         alert("Error while Registering!!");  
                        }  
                    }); 


                  });

            /*
            * Click function  for cloud to view the astronut with description
            */
            $('.astro_occupation').css({'display':'none'});
            $('.div_for_astro').css({'display':'none'});
            $(".astro_occupation ").removeClass("img_astro");

            $('#cloud').click(function(){ 
                load_animation_astronut();
            });

            $(".btn_occ_submit").click(function(e){

              $(".astro_occupation ").removeClass("img_astro_down"); 
              var occ_astro=$("#text_occupation_astro").val();
              if(occ_astro=='' || occ_astro==null){
                alert("Please Enter Your Occupation !!");
              }
              else{
                var str_occupation= $("#text_occupation_astro").val();
                $("#occupation_txt").val(str_occupation);
                var occ_astro=$("#text_occupation_astro").val();
                global_occupation=occ_astro+","+global_occupation;
                $("#list_occupation ").html('');
                $("#list_occupation ").html(global_occupation);
                $("#list_occupation ").val(global_occupation.split(",").join("\n"));
                hidePage();
                hidePage2();
               // $("#text_occupation_astro").val()
                $('.occ_description').css({'display':'none'});
                $('.text_occup').css({'display':'none'}); 
                $('.btn_occ_submit').css({'display':'none'}); 
                $('.div_clock').css({'display':'none'}); 
                $('.div_helmet').css({'display':'none'});   
                $('.txtarea_occup').css({'display':'block'});
                  //for playing audio
                  var audio = document.getElementById("audio_cuckoo");
                  audio.playbackRate =1;
                  audio.play();
               
                
                $('.div_for_astro').css({'display':'none'});
                $(".astro_occupation ").addClass("img_astro_down"); 
               
                setTimeout(function(){
                    $('.astro_occupation').css({'display':'none'}); 
                    $(".astro_occupation ").removeClass("img_astro_down"); 
                 }, 2000); 

              }
             // location.reload();
            });
            $('#list_occupation').click(function(){ 
              
            // load_animation_astronut();
              });
            function load_animation_astronut(){
             // $('.astro_occupation').css({'display':'block'});
              $('.div_for_astro').css({'display':'block'});
              $('.astro_occupation').css({'display':'block'});
              $(".astro_occupation ").addClass("img_astro");
              $('.text_occup').css({'display':'block'}); 
              $('.btn_occ_submit').css({'display':'block'}); 
              setTimeout(function(){
                $('.occ_description').css({'display':'block'}); 
                $('.div_helmet').css({'display':'block'}); 
                
                 }, 3000); 
            }
            /*
            Function to take snapshot
            */
            function take_snapshot() {
            
               $('#my_camera').css({'border':'0px'});
                 // take snapshot and get image data
                   Webcam.snap( function(data_uri) {
                  // display results in page
                   document.getElementById('my_camera').innerHTML = 
                   '<img  name="photo" id="img_photo"  class="camera" style="object-fit: cover;" src="'+data_uri+'"/>';
                  $("#img_photo_register").val(data_uri);
                  } );
               
                }
             
            //Function for age calculation 
            function calculate_age()
            {   
              $("#sname").removeAttr('required');
              $("#sid").removeAttr('required');
              //DATE validation 
            var dob=$("#date").val();
            var zordiac=check_zordiac(dob); // Checking zordiac signs

                $('.img_2').css({'display':'none'});
                $('.img_1').css({'display':'block'});

                $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
                $('.text_Aquaris').css({'display':'none'});
                $(".text_Pisces ").removeClass("ani-rollouttext_Pisces");
                $('.text_Pisces').css({'display':'none'});
                $(".text_Aries ").removeClass("ani-rollouttext_Aries");
                $('.text_Aries').css({'display':'none'});
                $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
                $('.text_Taurus').css({'display':'none'});
                $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
                $('.text_Gemini').css({'display':'none'});
                $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
                $('.text_Cancer').css({'display':'none'});
                $(".text_Leo ").removeClass("ani-rollouttext_Leo");
                $('.text_Leo').css({'display':'none'});
                $(".text_Virgo ").removeClass("ani-rollouttext_Virgo");
                $('.text_Virgo').css({'display':'none'});
                $(".text_Libra ").removeClass("ani-rollouttext_Libra");
                $('.text_Libra').css({'display':'none'});
                $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
                $('.text_Scorpio').css({'display':'none'});
                $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
                $('.text_Sagittarius').css({'display':'none'});
                $(".text_Capricorn ").removeClass("ani-rollouttext_Capricorn");
                $('.text_Capricorn').css({'display':'none'});
              
            if(dob!=''){
                if(zordiac=='Aquarius')
                {
                  $('.text_Aquaris').css({'display':'block'});
                  $(".text_Aquaris ").addClass("ani-rollouttext_Aquaris");
                  $('.aq_brighter').css({'display':'block'});
                  $('.aq_normal').css({'display':'none'});
                }
                else if(zordiac=='Pisces')
                {
                  $('.text_Pisces').css({'display':'block'});
                  $(".text_Pisces ").addClass("ani-rollouttext_Pisces");
                  $('.p_brighter').css({'display':'block'});
                  $('.p_normal').css({'display':'none'});
                }
                else if(zordiac=='Cancer')
                {
                  $(".text_Cancer ").addClass("ani-rollouttext_Cancer");
                  $('.text_Cancer').css({'display':'block'});
                  $('.c_brighter').css({'display':'block'});
                  $('.c_normal').css({'display':'none'});
                }
                else if(zordiac=='Taurus')
                {
                  $(".text_Taurus ").addClass("ani-rollouttext_Taurus");
                  $('.text_Taurus').css({'display':'block'});
                  $('.t_brighter').css({'display':'block'});
                  $('.t_normal').css({'display':'none'}); 
                }
                else if(zordiac=='Gemini')
                {
                  $(".text_Gemini ").addClass("ani-rollouttext_Gemini");
                  $('.text_Gemini').css({'display':'block'});
                  $('.gm_brighter').css({'display':'block'});
                  $('.gm_normal').css({'display':'none'}); 
                }
                else if(zordiac=='Aries')
                { 
                   $(".text_Aries ").addClass("ani-rollouttext_Aries");
                   $('.text_Aries').css({'display':'block'});
                   $('.ar_brighter').css({'display':'block'});
                   $('.ar_normal').css({'display':'none'});
                }
                else if(zordiac=='Leo')
                {
                  $(".text_Leo ").addClass("ani-rollouttext_Leo");
                  $('.text_Leo').css({'display':'block'});
                  $('.le_brighter').css({'display':'block'});
                  $('.le_normal').css({'display':'none'});
                }
                else if(zordiac=='Virgo')
                {
                  $(".text_Virgo ").addClass("ani-rollouttext_Virgo");
                  $('.text_Virgo').css({'display':'block'});
                  $('.v_brighter').css({'display':'block'});
                  $('.v_normal').css({'display':'none'});
                }
                else if(zordiac=='Libra')
                {
                  $(".text_Libra ").addClass("ani-rollouttext_Libra");
                  $('.text_Libra').css({'display':'block'});
                  $('.li_brighter').css({'display':'block'});
                  $('.li_normal').css({'display':'none'});
                }
                else if(zordiac=='Scorpio')
                {
                  $(".text_Scorpio ").addClass("ani-rollouttext_Scorpio");
                  $('.text_Scorpio').css({'display':'block'});
                  $('.sc_brighter').css({'display':'block'});
                  $('.sc_normal').css({'display':'none'});
                }
                else if(zordiac=='Sagittarius')
                {
                  $(".text_Sagittarius ").addClass("ani-rollouttext_Sagittarius");
                  $('.text_Sagittarius').css({'display':'block'});
                  $('.sg_brighter').css({'display':'block'});
                  $('.sg_normal').css({'display':'none'});
                }
                else // Capricorn 
                { 
                  $(".text_Capricorn ").addClass("ani-rollouttext_Capricorn");
                  $('.text_Capricorn').css({'display':'block'});
                  $('.cp_brighter').css({'display':'block'});
                  $('.cp_normal').css({'display':'none'});
                }
              }

            //  var dat_Validation=isValidDate(dob); //commented for now
            var dat_Validation=true;
                if(dat_Validation==true)
                 {
                     var dob=$("#date").val();
                     d1=new Date(dob);
                     d2 = new Date();
                      var diff = d2.getTime() - d1.getTime();
                      age= Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));
                      if(age<0)
                        age=0;
                      $("#age").val(age);
                 
                      if(age<18)
                      {
                       $(".sponser_name").show();
                       $(".sponser_hide").show();
                       document.getElementById("sname").required = true;
                       document.getElementById("sid").required = true;
                  
                       }
                      else{
                        $(".sponser_name").hide();
                        $(".sponser_hide").hide();
                        $("#sname").removeAttr('required');
                        $("#sid").removeAttr('required');
                      }
                      
                }
                else{
                  alert("Invalid DOB!");
                  $("#date").val('');
                }


            }
            /*
            Function to check zordiac signs with DOb
            */

            function check_zordiac(dob){

               // Parse the date parts to integers
                var parts   = dob.split("-");
                var day     = parseInt(parts[2], 10); //day 
                var month   = parseInt(parts[1], 10); //month
                var year    = parseInt(parts[0], 10); //year
                var zordiac='';
               
               
                if(dob!='')
                {
                  if(month==1){
                            if(day>=20 && day<=31)
                            {
                              zordiac='Aquarius';
                            }
                            else if(day>=1 && day<=19)
                            {
                              zordiac='Capricorn';
                            }
                  }
                  else if(month==2){
                          if(day>=19 && day<=31)
                            {
                              zordiac='Pisces';
                            }
                            else if(day>=1 && day<=18)
                            {
                              zordiac='Aquarius';
                            }
                  }
                  else if(month==3){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Aries';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Pisces';
                            }
                  }
                  else if(month==4){
                          if(day>=20 && day<=31)
                            {
                              zordiac='Taurus';
                            }
                            else if(day>=1 && day<=19)
                            {
                              zordiac='Aries';
                            }
                  }
                  else if(month==5){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Gemini';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Taurus';
                            }
                  }
                  else if(month==6){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Cancer';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Gemini';
                            }
                  }
                  else if(month==7){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Leo';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Cancer';
                            }
                  }
                  else if(month==8){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Virgo';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Leo';
                            }
                  }
                  else if(month==9){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Libra';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Virgo';
                            }
                  }
                  else if(month==10){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Scorpio';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Libra';
                            }
                  }
               
                  else if(month==11){
                          if(day>=22 && day<=31)
                            {
                              zordiac='Sagittarius';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Scorpio';
                            }
                  }
                else{     //if(month==12)
                          if(day>=22 && day<=31)
                            {
                              zordiac='Capricorn';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Sagittarius';
                            }
                                        
                  }
                
                return zordiac;
            }
                }
            /*
            Function for validatng date 
            */
            function isValidDate(dateString)
            {
                // First check for the pattern
                var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

                if(!regex_date.test(dateString))
                {
                    return false;
                }

                // Parse the date parts to integers
                var parts   = dateString.split("-");
                var day     = parseInt(parts[2], 10);
                var month   = parseInt(parts[1], 10);
                var year    = parseInt(parts[0], 10);

                // Check the ranges of month and year
                if(year < 1000 || year > 3000 || month == 0 || month > 12)
                {
                    return false;
                }

                var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

                // Adjust for leap years
                if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
                {
                    monthLength[1] = 29;
                }

                // Check the range of the day
                return day > 0 && day <= monthLength[month - 1];
            }

            /*
            Function for validating date 
            */

            function validateDate(testDate){
              var result=true;
              var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
            if(!(date_regex.test(testDate)))
            {
              result= false;
            }
            return result;
            }


            /* Reset camera option */

            function reset_snapshot(){
              Webcam.reset();

                Webcam.set({
                    width: 207,
                    height: 270,
                    dest_width: 207, 
                    dest_height: 270,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach( '#my_camera' );
            }
            /*function reset(){
              Webcam.reset();
              Webcam.off();
            }*/
            //
            //-----------

            function logout_account(){
             
             $.ajax({  
                   type: "POST",  
                   url: "http://127.0.0.1/Mbaye/index.php/home/logout",
                   data: "",
                   dataType: "json",  
                   success: function (result) { 
              
                   window.location.href = "http://127.0.0.1/Mbaye/index.php/home/login";
                   },  
                   error: function () {  
                    alert("Error while logouting!");  
                   }  
               }); 



            }
           

            function loadSelect_for_org_type(org){  //alert(org);
                $('#org_types').find('option[value='+org+']').attr('selected', 'selected');
                $('#org_type').val(org);
            }
            function loadSelect_for_gender(gender){  
                $('#var_genders').find('option[value='+gender+']').attr('selected', 'selected');
                $('#var_gender').val(gender);
            }

            function openwikipedia(){
             
                setTimeout(function(){
                
                    var div = document.getElementById("Div_for_wiki");
                    var page = document.getElementById("wikiPage");
                    page.data  ="https://en.wikipedia.org/wiki/Michael_Collins_(astronaut)";
                    if(div.style.visibility != "visible"){
                      div.style.visibility = "visible";  
                      $(".close_btn ").show();
                    }else return;
                  },1000);
                
            }

            function hidePage(){
                    var div = document.getElementById("Div_for_wiki");
                    var page = document.getElementById("wikiPage");
                    page.data = "";

                    div.style.visibility = "hidden";
                    $(".close_btn ").hide();
                }

            function goto_wiki2(){

                setTimeout(function(){

              var div = document.getElementById("Div_for_wiki2");
                  var page = document.getElementById("wikiPage2");
                  page.data  ="https://en.wikipedia.org/wiki/Michael_Schumacher";
                  if(div.style.visibility != "visible"){
                    div.style.visibility = "visible";  
                    $(".close_btn ").show();
                  }else return;
              },1000);

            }
            function hidePage2(){
                    var div = document.getElementById("Div_for_wiki2");
                    var page = document.getElementById("wikiPage2");
                    page.data = "";
                    $(".close_btn ").hide();
                    div.style.visibility = "hidden";
                    
                }
                /*
                Function to redirect to home page after registration  save sucess 
                */
            function redirectToHome(){
               
                  window.location = "{{route('frontend.index')}}";
                }
                /**
                Function to validate form
                */
            function validateMyForm(){
              //checking terms and condition Check box checked or not
              if($("#is_term_accept").prop("checked") == true)
                  {
                   document.getElementById("MyForm").submit();
                  }
                  else
                  {
                    $('#myModal').modal({ show: true });
                  }

            }

            /**
            Click function for agree button
            */
            $('#btn_agree').click(function(){ 
              $('#is_term_accept').prop("checked",true);

            });

            /**
            Click function for disagree button 
            */
            $('#btn_dagree').click(function(){ 
              $('#is_term_accept').prop("checked",false);

            });

            /*
            Function for set annd reset check box
            */
            function setCheckbox(){

               if($(this). prop("checked") == true){
                $('#is_term_accept').prop("checked",false);
                }
                else if($(this). prop("checked") == false){
                  $('#is_term_accept').prop("checked",true);
                }
            }
              
</script>

@endsection
