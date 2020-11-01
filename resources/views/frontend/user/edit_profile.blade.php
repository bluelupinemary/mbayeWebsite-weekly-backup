@extends('frontend.layouts.app')
@section('before-styles')
  <style>
    
    .danger-alter 
    {
      border: 1px solid #b82c2c !important;
      box-shadow: 1px 1px 10px 3px #b81c1c;
    }
    input::-ms-reveal,
      input::-ms-clear {
        display: none;
      }
  </style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ asset('front/CSS/profile_edit_style.css') }}">
@endsection
@section('content')
    <div  id="block_land"  >
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <div><img src="{{ asset('front') }}/images/rotate-screen.gif" alt=""></div>
        </div>
    </div>
    <div class="flex" >
    <section style="height:100vh">
      <div class="container-fluid">
        <div class="sub_container">
          @php
              $login=[];
              $profile=[];
              $location=[];
              $organization=[];
              $snapshot=[];
              $payment=[];
              $settings=[];
              
            if($errors->any())
            { 
              foreach ($errors->getMessages() as $key => $error ) 
              {
                // LOGIN TAB ERRORS START
                if($key == 'email' || $key == 'old_password' || $key == 'new_password'  )
                {
                  $login[]=$error;
                }
                // LOGIN TAB ERRORS END
                // PROFILE TAB ERRORS START
                if($key == 'first_name' || $key == 'last_name' || $key == 'gender' || $key == 'dob')
                {
                  $profile[]=$error;
                } 
                // PROFILE TAB ERRORS ENDS
                // LOCATION TAB ERRORS STARTS
                if($key == 'address' || $key == 'country' || $key == 'state' || $key == 'city' || $key == 'mobile_number')
                {
                  $location[]=$error;
                }
                // LOCATION TAB ERRORS ENDS
                // ORGANIZATIONAL TAB ERRORS STARTS
                if($key == 'org_type' || $key == 'org_name' || $key == 'sponsor_name' || $key == 'sponsor_email' )
                {
                  $organization[]=$error;
                }
                // ORGANIZATIONAL TAB ERRORS ENDS
                if($key == 'occupation')
                {
                  $snapshot[]=$error;
                }
              }
              // print_r($login);
              
              
              
             
            }    
            // print_r($profile);
          @endphp
            
          <div id="overlay"></div>
          <div class="row content-row">
            <div class="col-md-2 col-sm-2 tabs-two-cols">
              <div class="tabs-link-css">
                <div class="nav flex-column nav-pills nav-justified" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Login Details @if(count( $login ) > 0)<span class="badge badge-danger">{{ count($login) }}</span> @endif </a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Personal Details @if(count( $profile ) > 0)<span class="badge badge-danger">{{ count($profile) }}</span> @endif</a>
                  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Location Details @if(count( $location ) > 0)<span class="badge badge-danger">{{ count($location) }}</span> @endif</a>
                  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Organization Details @if(count( $organization ) > 0)<span class="badge badge-danger">{{ count($organization) }}</span> @endif</a>
                  <a class="nav-link" id="v-pills-snapshot-tab" data-toggle="pill" href="#v-pills-snapshot" role="tab" aria-controls="v-pills-snapshot" aria-selected="false">Snapshot @if(count( $snapshot ) > 0)<span class="badge badge-danger">{{ count($snapshot) }}</span> @endif</a>
                  <a class="nav-link" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment Details </a>
                  <a class="nav-link" id="v-pills-other-settings-tab" data-toggle="pill" href="#v-pills-other-settings" role="tab" aria-controls="v-pills-other-settings" aria-selected="false">Other Settings </a>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-sm-8">
              <div class="page-header">
                <h1 class=" head_1" style="">Manage Your Profile</h1>
              </div>
              {{  Form::open(['files'=>true , 'class' => '', 'method' => 'PATCH', 'id'=>'MyForm','onsubmit' => 'event.preventDefault(); validateMyForm();']) }}
              <div class="tab-content" id="v-pills-tabContent">
                {{-- LOGIN DETAILS SECTION --}}
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <h2 class="col_white">Login Details</h2>
                  <div class="form-feilds">
                    <div class="row text-center">
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="email" class="form-control" id="Email" value="{{ $user->email }}" placeholder="Enter Email"  name="email" readonly/>
                          <input type="hidden" name="login_details" value="">
                        </div>
                      </div>
                      {{-- password update div --}}
                      <div class="col-md-12" id="passsword_div" style="display:none">
                        <div class="input-group" id="show_old_password">
                          <input type="password" placeholder="Old Password" data-toggle="tooltip" title="Password is Required!" data-placement="left" class="form-control @error('old_password') danger-alter @enderror" placeholder="Password" id="password" name="old_password" autocomplete="off" value="{{ old('old_password') }}">
                          <div class="input-group-append">
                            <span class="input-group-text" onclick="showpassword('show_old_password')"><i class="fa fa-eye"></i></span>
                          </div>
                        </div>
    
                        <div class="input-group" id="show_new_password">
                          <input type="password" data-toggle="tooltip" value="{{ old('new_password') }}" placeholder="New Password" title="Confirm password is Required!" data-placement="left" class="form-control @error('c_password') danger-alter @enderror" placeholder="Confirm Password" id="new_password" name="new_password" >
                          <div class="input-group-append">
                            <span class="input-group-text" onclick="showpassword('show_new_password')"><i class="fa fa-eye"></i></span>
                          </div>
                        </div>
    
                        <div class="input-group" id="show_new_cpassword">
                          <input type="password" data-toggle="tooltip" title="Confirm password is Required!" data-placement="left" class="form-control @error('c_password') danger-alter @enderror" placeholder="Confirm Password" id="c_password" name="c_password" >
                          <div class="input-group-append">
                            <span class="input-group-text" onclick="showpassword('show_new_cpassword')"><i class="fa fa-eye"></i></span>
                          </div>
                        </div>
                      </div> 
                      {{-- password update div --}}
                      <div class="col-md-12">
                        <a href="javascript:void(0)" class="btn btn-primary submit-btn" id="change_pass">Change Password</a>
                      </div>
                    </div>
                  </div>                  
                </div>
                {{-- PERSONAL DETAILS SECTION --}}
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <h2 class="col_white">Profile Details</h2>
                  <div class="form-feilds">
                    
                        <div class="form-group">
                          <input  class="form-control @error('first_name') is-invalid @enderror" type="text" id="fname" placeholder="First Name" name="first_name"  value="{{ $user->first_name }}"/>
                          <input type="hidden" name="profile_details" value="">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Last Name" id="lname" name="last_name"  value="{{ $user->last_name }}"/>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="ID Number" type="text" id="id_number" value="{{ $user->id_number }}" name="id_number"/>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <select name="gender" value="{{ $user->gender }}" class="form-control lbl_text" style="text-transform: capitalize;" id="genders">
                                <option value="">Select Gender</option>
                                <option value="male" {{($user->gender == "male") ? 'selected' : ''}}>Male</option>
                                <option value="female" {{($user->gender == "female") ? 'selected' : ''}}>Female</option>
                                <option value="other" {{($user->gender == "other") ? 'selected' : ''}}>Other</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6" >
                            <div class="form-group">
                              <input class="form-control lbl_text datepicker" id="date" name="dob" placeholder="YYYY-MM-DD" type="text" value="{{ $user->dob }}" onchange="calculate_age()"/>
                              <input  class="form-control lbl_text" type="hidden" id="age" value="{{ old('age') }}" name="age" readonly>
                            </div>
                          </div>
                        </div>
                      
                  </div>{{-- form feild close --}} 
                </div> {{-- tab close --}}
                {{-- LOCATION DETAILS SECTION --}}
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                  <h2 class="col_white">Location Details</h2>
                  <div class="form-feilds">
                    <div class="form-group">
                      <input  class="form-control lbl_text" type="text" id="address" value="{{ $user->address }}" placeholder="Address" name="address"/>
                      <input type="hidden" name="location_details" value="">
                    </div>
                    <div class="form-group">
                      <select id="countryId" data-toggle="tooltip" title="Country is Required!" data-placement="right"  name="country" value="{{ old('country') }}" class="form-control @error('country') danger-alter @enderror countries order-alpha">
                        
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <select name="state" class="form-control @error('state') danger-alter @enderror states order-alpha" data-toggle="tooltip" title="state is Required!" data-placement="left" id="stateId">
                            
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <select name="city" class="cities order-alpha form-control @error('city') danger-alter @enderror" id="cityId" data-toggle="tooltip" title="City is Required!" data-placement="right">
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control lbl_text" type="number" id="mob_no" value="{{ $user->mobile_number }}" placeholder="Phone Number" name="mobile_number"/>
                    </div>
                  </div> 
                </div>
                {{-- ORGANIZATIONAL DETAILS SECTION  --}}
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                  <h2 class="col_white">Organizational Details</h2>
                  <div class="form-feilds">
                    <div class="form-group">
                      <select name="org_type" value="{{ $user->org_type }}" class=" form-control lbl_text" id="org_types" >
                        <option value="School" {{($user->org_type == "School") ? 'selected' : ''}}>School</option>
                        <option value="Club" {{($user->org_type == "Club") ? 'selected' : ''}}>Club</option>
                        <option value="Company" {{($user->org_type == "Company") ? 'selected' : ''}}>Company</option>
                        <option value="Non-profit Organization" {{($user->org_type == "Non-profit Organization") ? 'selected' : ''}}> Non-profit Organization</option>
                        <option value="International Organization" {{($user->org_type == "International Organization") ? 'selected' : ''}}>International Organization</option>
                        <option value="Group" {{($user->org_type == "Group") ? 'selected' : ''}}>Group</option>
                        <option value="Individual" {{($user->org_type == "Individual") ? 'selected' : ''}}>Individual</option>
                    </select>
                    <input type="hidden" name="organizational_details" value="">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control lbl_text" id="org_name" value="{{ $user->org_name }}" placeholder="Organization Name" name="org_name"/>
                    </div>
                    <div class="form-group">
                      <input  class="form-control" type="text" id="sname"  value="{{ $user->sponser_name }}" placeholder="Sponsor Name" name="sponsor_name"/>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="sponsor_email"  value="{{ $user->sponser_email }}" placeholder="Sponsor Email" name="sponsor_email"/>
                    </div>
                  </div> 
                </div>
                {{-- SNAPSHOT DETAILS AND OCCUPATIONAL DETAILS --}}
                <div class="tab-pane fade" id="v-pills-snapshot" role="tabpanel" aria-labelledby="v-pills-snapshot-tab">
                  <h2 class="col_white">Snapshot</h2>
                  <div class="form-feilds">
                    <div class="row" style="align-items: center;">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                        {{-- <input type="text" name="occupation" id="list_occupation" readonly data-toggle="tooltip" class="form-control @error('occupation') danger-alter @enderror" title="Occupation is Required!" data-placement="right" onclick="load_animation_astronut()" value="{{ $user->occupation }}" class="form-control" placeholder="Occupation"> --}}
                        <textarea name="occupation" id="list_occupation" style="resize: none;" readonly data-toggle="tooltip" class="form-control @error('occupation') danger-alter @enderror" title="{{ $user->occupation }}" data-placement="right" onclick="load_animation_astronut()" class="form-control" placeholder="Occupation">{{ $user->occupation }}</textarea>
                        <input type="hidden" name="snap_details" value="">
                        </div>
                        <p class="warning-text"><small>If your snapshot is inappropiate or irrelevent we will block</small></p>
                        <div class="checkbox" style="text-align: left;">
                          <label id="terms_label"  style="color: #ffffff">
                          <a href="javascript:void(0);" id="term">Terms & Conditions</a> </label>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 text-center">
                        <div id="my_camera" class="camera_alignment">
                          <img id="img_photo" class="camera_style" style="object-fit: cover;" src="{{url('storage/profilepicture/'.($user->getProfilePicture()!=''?$user->getProfilePicture():'dummy-person.jpg'))}}">
                        </div>
                        <div class="row">
                          <div class="col-md-12 overlap-image">
                            <button type="button"  class="btn_reg_snap_shot border1"  accept="image/*" capture ="camera" value="" style="display: none" onClick="take_snapshot()"><i class="fas fa-camera"></i></button>
                            <button type="button"  class="btn_reg_cam_reset border1"  accept="image/*" capture ="camera" value="Reset" onClick="reset_snapshot()"><i class="fas fa-retweet"></i></button>
                          </div>  
                        </div>  
                        <input type="hidden" class="form-control"  id="img_photo_register" name="photo"  value="" />
                        <input type="hidden" class="form-control"  id="id" name="img_id"/>
                        <input type="hidden" name="occupation" id="occupation" value="{{ $user->occupation }}">
                        <input type="hidden" class="form-control"  id="pk_user_id" name="pk_user_id"/>
                        <div id="results" ></div>
                      </div>  
                    </div>
                    
                  </div> 
                </div>
                {{-- PAYMENT DETAILS SECTION --}}
              <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                <h2 class="col_white">Payments Details Coming Soon!</h2>
                <div class="form-feilds">
                  <input type="hidden" name="payment_details" value="">
                </div> 
              </div>
              {{-- OTHER SETTINGS DETAILS SECTION --}}
              <div class="tab-pane fade" id="v-pills-other-settings" role="tabpanel" aria-labelledby="v-pills-other-settings-tab">
                <h2 class="col_white">Other Settings Coming Soon!</h2>
                <div class="form-feilds">
                  <input type="hidden" name="other_settings_details" value="">
                </div> 
              </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-2">
              <div class="btn-div padding-0">
                <button class="btn btn-primary custom-button submit-btn">Submit</button>
                {{-- <button class="btn btn-danger custom-button reset-btn">Reset</button> --}}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    {{-- DIV FOR THE STARS HOROSCOPRE START --}}
    <div class="box_for_stars" style="position:fixed; top:0; left:0; width:100vw;height:100vh;z-index: -10;">
      <div id='constellations'>
    
         <span class="text_Aquaris" style=""><i>Aquarius</i></span>
          <img class='aquarius aq_normal img_1' title="Aquarius" src="{{ asset('front') }}/images/constellations/aquarius_1.png">
    
      </div>
    
      <div class="cls_zc">
          <span class="text_Aries" style=""><i>Aries</i></span>
          <img  class='aries ar_normal img_1 cls_zc'  title="Aries" src="{{ asset('front') }}/images/constellations/aries_1.png">
    
      </div>
    
      <div class="cls_zc">
          <span class="text_Cancer" style="" ><i>Cancer</i></span>
          <img  class='cancer c_normal img_1 cls_zc' title="Cancer" src="{{ asset('front') }}/images/constellations/cancer_1.png">
    
      </div>
    
      <div class="cls_zc">
        <span class="text_Capricorn"  style=""><i>Capricorn</i></span>
        <img  class='capricorn cp_normal img_1 cls_zc' title="Capricorn" src="{{ asset('front') }}/images/constellations/capricorn_1.png">
    
      </div>
    
      <div  class="cls_zc">
        <span class="text_Libra" style=""><i>Libra</i></span>
        <img  class='libra  li_normal img_1 cls_zc' title="Libra" src="{{ asset('front') }}/images/constellations/libra_1.png">
    
      </div>
    
      <div  class="cls_zc">
        <span class="text_Gemini" style=""><i>Gemini</i></span>
        <img  class='gemini gm_normal img_1 cls_zc' title="Gemini" src="{{ asset('front') }}/images/constellations/gemini_1.png">
    
      </div>
    
      <div  class="cls_zc">
        <span class="text_Leo" style=""><i>Leo</i></span>
        <img  class='leo  le_normal img_1 cls_zc' title="Leo" src="{{ asset('front') }}/images/constellations/leo_1.png">
    
      </div>
    
      <div class="cls_zc">
        <span class="text_Pisces" style=""><i>Pisces</i></span>
        <img  class='pisces  p_normal img_1 cls_zc' title="Pisces" src="{{ asset('front') }}/images/constellations/pisces_1.png">
    
      </div>
    
      <div class="cls_zc">
        <span class="text_Sagittarius" style=""><i>Sagittarius</i></span>
        <img  class='sagittarius sg_normal img_1 cls_zc'  title="Sagittarius" src="{{ asset('front') }}/images/constellations/sagittarius_1.png">
    
    
      </div>
    
      <div class="cls_zc">
        <span class="text_Scorpio" style=""><i>Scorpio</i></span>
        <img  class='scorpio sc_normal img_1 cls_zc'  title="Scorpio" src="{{ asset('front') }}/images/constellations/scorpio_1.png">
    
      </div>
    
      <div class="cls_zc" >
        <span class="text_Taurus" style=""><i>Taurus</i></span>
        <img  class='taurus t_normal img_1 cls_zc' title="Taurus" src="{{ asset('front') }}/images/constellations/taurus_1.png">
    
      </div>
    
      <div class="cls_zc">
        <span class="text_Virgo" style=""><i>Virgo</i></span>
        <img  class='virgo v_normal img_1 cls_zc'  title="Virgo" src="{{ asset('front') }}/images/constellations/virgo_1.png">
    
      </div>
    </div>
  {{-- DIV FOR THE STARS HOROSCOPRE END`` --}}
  {{-- div for astronaut to add the accupation  --}}
  <audio id="audio_cuckoo" src="{{ asset('front') }}/images/astronut/Cuckoo.wav"></audio>
  <div class="div_for_astro" style="display:none" >
    <img id="div" class="" style="display:none" src="{{ asset('front') }}/images/close-btn.png" align="right">
    <img class="astro_occupation"  style="display:none"  src="{{ asset('front') }}/images/astronut/backpack 2.png">
    <div id = 'viki' class="div_helmet"  style="display:none" onClick="goto_wiki2()"></div>
    <div class="occ_description" style="display:none">
      <p>
        Hello,<br>I am <span id = 'divv' onClick="openwikipedia()" style="color: chocolate;">General Michael.</span>
        <br>Your occupation in life will <br> most probably change, <br> as these changes of life go on,
        <br>you should be able to note <br> here on your site.
        <br><br>The record of your occupations <br> will stay here forever.
        <br><br>So if your occupation is, example; <br> shoveling poo from a
        <span style="color:#c6552b" onClick="show_cuckoo()" title="Click here to know about  cuckoo clock">cuckoo clock</span>.
        <br><br>And then you become an astronaut.
        <br><br>It will be always on your profile.
        <br><br>So have fun, but remember everything <br> you say in life can have a consequence.
      </p>
      <br>
      <center><div class="txtocp"><input type="text" class="text_occup"  id="text_occupation_astro" placeholder="Your occupation" value="{{ old('occupation') }}"/></div></center>
      <br class="">
      <button type="button" class="btn btn-info btn_occ_submit">Submit</button>
      </div>
      <div class="div_clock overlay" style="display:none" >
      <img  class='cuckoo_image'  title="Cuckoo clock" src="{{ asset('front') }}/images/astronut/cuckoo clock.png">
      <p class="cuckoo_text">A Cuckoo clock as in the picture is a German black forest clock
        with a little bird that comes out  and goes cuckoo. Actually somebody  really useless in life like villa the crab. We say they are so useless they couldn’t shovel poo out of a cuckoo clock.
          </p>
      </div>
  </div>
  {{-- div for astronaut to add the accupation --}}
  <!-- The Modal for terms and condition -->
  <div class="modal" id="myModal" style="z-index:50000;height: 35vw;top: 6vw;width: 82vw !important">
    <div class="modal-content" style="width: 67vw;left: 15vw">
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
          In addition to making Products available, this Website also offers information and allows you to play game. This Website also offersinformation, both directly and through indirect links to third-party websites. Mbaye.com does not always create the information offered on this Website; instead the information is often gathered from other sources. To the extent that Inox Arabia FZC and associated companies do create the content on this Website, such content is protected by intellectual property laws of the foreign nations, and international bodies. Unauthorized use of the material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, noncommercial use. Any links to third-party websites are provided solely as a convenience to you.
          Inox Arabia FZC and associated companies do not endorse the contents on any such third-party  websites. Inox Arabia FZC and associated companies are not responsible for the content of or any damage that may result from your access to or reliance on these third-party websites. If you link to third-party websites, you do so at your own risk.
        </p>
        <p class="">
          <b>Use of Website;</b>
          Inox Arabia FZC and associated companies are not responsible for any damages resulting from use of this website by anyone. You will not use the Website for illegal purposes. You will
          <ul>
            <li>
                Abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws
                regarding intellectual property)
            </li>
            <li>
              Not interfere with or disrupt the use and enjoyment of the Website by other users
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
          <b>License.</b> By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on the Website in connection with your normal, noncommercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create derivative works of such content or information without express written authorization from Inox Arabia FZC and associated companies or the applicable third party (if third party content is at issue).
        </p>
        <br>
        <p class="">
          <b>Posting.</b>
          By posting, storing, or transmitting any content on the Website, you hereby grant Inox Arabia FZC and associated companies a perpetual, worldwide, non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute, have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world. Inox Arabia FZC and associated companies do not have the ability to control the nature of the user-generated content offered through the Website. You are solely responsible for your interactions with other users of the Website and any content you post. Inox Arabia FZC and associated companies is not liable for any damage or harm resulting from any posts by or interactions between users. Inox Arabia FZC and associated companies reserve the right, but has no obligation, to monitor interactions between and among users of the Website and to remove any content Inox Arabian Technical Services LLC deems objectionable.
        </p>
        <br>
        <h3 class="">II. DISCLAIMER OF WARRANTIES</h3>
        <p class="">
          YOUR USE OF THIS WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE IS OFFERED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WITHOUT LIMITING THE GENERALITY OF THE FOREGOING, INOX ARABIA FZC AND ASSOCIATED COMPANIES  MAKE NO WARRANTY: THAT THE INFORMATION PROVIDED ON THIS WEBSITE IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY. THAT THE LINKS TO THIRD-PARTY WEBSITES ARE TO INFORMATION THAT IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THIS WEBSITE WILL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN.
        </p>
        <br>
        <h3 class="">III. INDEMNIFICATION</h3>
        <p class="">
          You will release, indemnify, defend and hold harmless Inox Arabia FZC and associated companies, and any of its contractors, agents, employees, officers, directors, shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable attorneys' fees and expenses, of third parties relating to or arising out of
        </p>
        <ul>
          <li> this Agreement or the breach of your warranties, representations and obligations under this Agreement;
          </li>
          <li>the Website content or your use of the Website content
          </li>
          <li>
            any intellectual property or other proprietary right of any person or entity;
          </li>
          <li>
            your violation of any provision of this Agreement; or
          </li>
          <li>
            any information or data you supplied to Inox Arabia FZC and associated companies. When Inox Arabia FZC and associated companies is threatened with suit or sued by a third party, Inox Arabia FZC and associated companies may seek written assurances from you concerning your promise to indemnify Inox Arabia FZC and associated companies;
            </li>
        </ul>
        <p class="">
          your failure to provide such assurances may be considered by Inox Arabia FZC and associated companies to be a material breach of this Agreement. Inox Arabia FZC and associated companies will have the right to participate in any defense by you of a third-party claim related to your use of any of the Website content, with counsel of Inox Arabia FZC and associated companies choice at its expense. Inox Arabia FZC and associated companies will reasonably cooperate in any defense by you of a third-party claim at your request and expense. You will have sole responsibility to defend Inox Arabia FZC and associated companies against any claim, but you must receive Inox Arabia FZC and associated companies prior written consent regarding any related settlement. The terms of this provision will survive any termination or cancellation of this Agreement or your use of the Website or Products.
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
      <!-- Modal body -->
      <!-- Modal footer -->
    </div>

  </div>
<!---model ends -->
@endsection

@section('after-scripts')
  <!-------------   script section -------------------->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="webcamjs/webcam.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  <script src="{{ asset('front') }}/JS/webcam.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
  {{-- <script src="{{ asset('front') }}/JS/bootstrap-datepicker.min.js"></script> --}}
  <script src="{{ asset('front/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('js/notify.min.js') }}"></script>
  
  
  
      <!-- Webcam.min.js -->
  <!--------------- For camera------------------------->

<script language="JavaScript">
   var occ_details;
   
// When list occupation modified
  $('#change_pass').click(function(){
    if($('#passsword_div').is(":visible"))
    {
      $('#passsword_div').hide();
      $('#change_pass').html('Change Password');
    }
    else
    {
      $('#passsword_div').show();
      $('#change_pass').html('Cancel');
    }
    
  });

  
  $('#list_occupation').on('change', function(e){
    var newlist = $('#list_occupation').val();
    $("#MyForm input#occupation").val(newlist);
  });

  function disable_readonly()
  {
    IsReadOnly="False";
    load_animation_astronut().stop;
  }
   // COUNTRIES AND STATE AND SITIES
   var countires;
   var states = [];
   var allcities = [];
   var alldata=[];
   // FETCHING THE OBJECT OF COUNTRIES AND CITIES AND STATE
     $.getJSON( "/front/json/reg-countries-states-cities.json", function( data ) {
        alldata = data;
        $.each( alldata, function( countryKey, countryVal ) { //iterate the countires-state-cityobj
        if(countryVal.name == "{{ $user->country }}") //check if users country match woth any country
        {
          $('#countryId').append("<option Selected value='" + countryVal.name + "'>" + countryVal.name + "</option>");

          if(countryVal.states.length) //check if country has any states
          {
            $.each( countryVal.states , function( stateKey, stateVal ) //iterate through states 
            {
              if(stateVal.name === "{{ $user->state }}") //if state match with users state
              {
                // add selected attribute to the select
                $('#stateId').append("<option selected value='" + stateVal.name + "'>" + stateVal.name + "</option>");
              }
              else
              {
                $('#stateId').append("<option value='" + stateVal.name + "'>" + stateVal.name + "</option>");
              }
               
              //  iterate through the cities added in the JSON Object
              if(stateVal.cities.length)
              {
                $.each( stateVal.cities , function( cityKey, cityVal ) //iterate through cities 
                {
                  if(cityVal.name === "{{ $user->city }}") //if state match with users state
                  {
                    // add selected attribute to the select
                    $('#cityId').append("<option selected value='" + cityVal.name + "'>" + cityVal.name + "</option>");
                  }
                  else
                  {
                    $('#cityId').append("<option value='" + cityVal.name + "'>" + cityVal.name + "</option>");
                  }
                });   
              }
            }); //iteration through the states ends here
          }
        }
        else
        {
          $('#countryId').append("<option value='" + countryVal.name + "'>" + countryVal.name + "</option>");
        }     
      });
     });
     // SELECTING THE COUNTRY AND FETCHING THE STATES
     $('#countryId').change(function(){

        var c_check = $('#countryId').val(); 
        $('#stateId').html('<option value="">Select State</option>');
        $('#cityId').html('<option value="">Select City</option>');

        $.each( alldata, function( countryKey, countryVal ) { //variable that contain all the values
          if(countryVal.name === c_check) //if its selected country
          {
            console.log(countryVal.states.length);
            if(countryVal.states.length > 0) //if a country has states
            {
              $.each( countryVal.states , function( stateKey, stateVal ) { //iterate through states
                $('#stateId').append("<option value='" + stateVal.name + "'>" + stateVal.name + "</option>");
              })
            }
            else
            {
              $('#stateId').append("<option value='" + c_check + "'>" + c_check + "</option>");
              $('#cityId').append("<option value='" + c_check + "'>" + c_check + "</option>");
            }
          }
        });
      });
     // SECLTING THE STATE TO GET THE CITIES
     $('#stateId').change(function(){
       var c_check = $('#stateId').val();
       $('#cityId').html('');
       
       $.each( alldata, function( key, val ) {
         $.each( val.states , function( key_c, val_c ) {
           if(val_c.name === c_check)
           { 
             // console.log(c_check);
            //  console.log(val_c.cities.length);
            if(val_c.cities.length)
            {
              $.each( val_c.cities , function( key_c1, val_c1 ) {
                $('#cityId').append("<option value='" + val_c1.name + "'>" + val_c1.name + "</option>");
             })
            }
            else{
              $('#cityId').append("<option value='" + c_check + "'>" + c_check + "</option>");
            }
             
           }

         })
         
       });

     });

// Webcam on

  function cam_on()
  {
    Webcam.set({
    width: 240,
    height:240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
    Webcam.attach( '#my_camera' );
  }

 // A button for taking snaps

  function take_snapshot() 
  {
    // take snapshot and get image data
    Webcam.snap( function(data_uri) {
    // display results in page
    document.getElementById('results').innerHTML =
    '<img id="imageprev" src="'+data_uri+'"/>';
    });
    Webcam.reset();
  }

  //Adds New Occupation
  function add_occ()
  {
    var new_occ = document.getElementById("text_occupation_astro").value;
    var curr_occlist = $('#occupation').val();
    var new_occlist = new_occ + "," + curr_occlist;
    $("#MyForm input#occupation").val(new_occlist);
  };

</script>
    <!--------------------------------------- Manual script ------------------------------------------>
 <script>

  // Calculating age every reload
  window.onload = function() {
        calculate_age();
  }

//Get selected gender, country, organization type;
        //var global_occupation='';
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
                $('section').show();
            }
            else{
                 document.getElementById('block_land').style.display =  'block';
                  $('section').hide();
            }
    }
    function show_cuckoo()
    {
      $('.div_clock').css({'display':'block'});
      var audio = document.getElementById("audio_cuckoo");
      audio.playbackRate =1;
      audio.play();
    }
    /**
      Function to show password
      */
      function showpassword(fieldid)
      {
        if($('#'+fieldid+' input').attr("type") == "text")
        {
          $('#'+fieldid+' input').attr('type', 'password');
          $('#'+fieldid+' svg').attr('data-icon', 'eye');
        }
        else if($('#'+fieldid+'  input').attr("type") == "password")
        {
          $('#'+fieldid+'  input').attr('type', 'text');
          $('#'+fieldid+'  svg').attr('data-icon', 'eye-slash');
        }
      }
  $(document).ready(function () {

    $('.datepicker').datepicker({
      dateFormat: "yy-mm-dd"
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
    
    //for identifying zordiac sign in the edit mode
    //$("#list_occupation ").hide();
    $(".close_btn ").hide();

  /*$("#list_occupation").show();
  $("#list_occupation ").html(occupation);
  if(occupation!='')
  $("#list_occupation ").val(occupation.split(",").join("\n"));
  global_occupation=occupation;*/
  /*var encodedString='dummy';
  var img_src='';
  var img_src=decodeURIComponent(encodedString);
  document.getElementById('my_camera').innerHTML =
       '<div id="captured_img" class="camera_alignment"><img  name="photo" id="img_photo" style="display: block; height:240; width:240;" src="'+img_src+'"/></div>'; */
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
    $("#sname").hide(); //for hiding sponser name and sponser id
    calculate_age();
    // Date time picker change value
    $('#date').change(function(){
    $(this).attr('value', $('#date').val());
  });
});

            /*
            Button click function for registration
            */
            $('#btn_Register').click(function(){

             /* var str_occupation= $("#text_occupation_astro").val();   */
             /* $("#occupation_txt").val(str_occupation); */
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
                   $('#div').click(function(){
                   $('.div_for_astro').css('display','none');})
                   $('#div').click(function(){
                   $('.div_for_astro').css('display','none');
                   $('#Div_for_wiki').css('display','none');
                   $('#Div_for_wiki2').css('display','none');
                   $('.div_clock').css('display','none');
                   $('.occ_description').css('display','none');
                 })
            /*
            * Click function  for cloud to view the astronut with description
            */
            $('.astro_occupation').css({'display':'block'});
            $('.div_for_astro').css({'display':'none'});
            //$(".astro_occupation ").removeClass("img_astro");

            $('#cloud').click(function(){
                load_animation_astronut();
            });

            $(".btn_occ_submit").click(function(e){
              $(".astro_occupation ").removeClass("img_astro_down");
              var occ_astro=$("#occupation").val();
              if(occ_astro=='' || occ_astro==null)
              {
                var new_occ = document.getElementById("text_occupation_astro").value;
                $("#MyForm input#occupation").val(new_occ);
                $("#list_occupation").html('');
                $("#list_occupation").html(new_occ);
              }
              else
              {
                var str_occupation= $("#text_occupation_astro").val();
                var occ_astro=$("#text_occupation_astro").val();
                var new_occ = document.getElementById("text_occupation_astro").value;
                var curr_occlist = $('#occupation').val();
                var new_occlist = new_occ + "," + curr_occlist;
                $("#list_occupation").html('');
                $("#list_occupation").html(new_occlist);
                $("#list_occupation").val(new_occ);
                add_occ(); 
              }

                $("#text_occupation_astro").val();
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
                 });

            //load_animation_astronut();
            });

            /*$('#list_occupation').click(function(){

            load_animation_astronut();
            $('.div_for_astro').css({'display':'none'});
                $(".astro_occupation ").addClass("img_astro_down");

              }); */

            function load_animation_astronut(){

              $('.astro_occupation').css({'display':'block'});
              $('.div_for_astro').css({'display':'block'});
              $('.astro_occupation').css({'display':'block'});
              $(".astro_occupation ").addClass("img_astro");
              $('#div').css({'display':'block'});
              $("#div").addClass("close-as-img");
              $('.text_occup').css({'display':'block'});
              $('.btn_occ_submit').css({'display':'block'});

              setTimeout(function(){
                $('.occ_description').css({'display':'block'});
                $('.div_helmet').css({'display':'block'});
                 }, 3000);
            }

           //function to return current image if didn't update photo

           /* function user_photo() {
            var newimg = document.getElementById('img_photo_register').value;
            var oldimg = document.getElementById('curr_img').value;
            if (newimg == ""||newimg ==null)
            {
            $("#img_photo_register").val(oldimg);
            }
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
            '<img  name="photo" id="img_photo"class="camera" style="object-fit: cover;" src="'+data_uri+'"/>';
            $("#img_photo_register").val(data_uri);
            } );
            }

            // Update photo and enables webcam

            function update_photo() {
            if (document.getElementById('currentimg')) {

                if (document.getElementById('currentimg').style.display == 'none') {
                    document.getElementById('currentimg').style.display = 'block';
                    document.getElementById('my_camera').style.display = 'none';
                    document.getElementById('capture').style.display = 'none';
                    document.getElementById('reset').style.display = 'none';
                    document.getElementById('cancel_capture').style.display = 'none';
                }
                else {
                    document.getElementById('currentimg').style.display = 'none';
                    document.getElementById('my_camera').style.display = 'block';
                    document.getElementById('capture').style.display = 'block';
                    document.getElementById('reset').style.display = 'block';
                    document.getElementById('cancel_capture').style.display = 'block';
                }
            }
                                }

            // cancels updating photo

            function cancel_capture() {
            if (document.getElementById('my_camera')) {

                if (document.getElementById('currentimg').style.display == 'none') {
                    document.getElementById('currentimg').style.display = 'block';
                    document.getElementById('my_camera').style.display = 'none';
                    document.getElementById('capture').style.display = 'none';
                    document.getElementById('reset').style.display = 'none';
                    document.getElementById('cancel_capture').style.display = 'none';
                }
                else {
                    document.getElementById('currentimg').style.display = 'none';
                    document.getElementById('my_camera').style.display = 'block';
                    document.getElementById('capture').style.display = 'block';
                    document.getElementById('reset').style.display = 'block';
                    document.getElementById('cancel_capture').style.display = 'block';
                }
            }
                                }

            //Function for age calculation
            function calculate_age()
            {
              //DATE validation
              var dob=$("#date").val();
              $("#age").val(' ');
              var zordiac=check_zordiac(dob); // Checking zordiac signs

                //$('.img_2').css({'display':'none'});
                $('.img_1').css({'display':'block'});

                $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
                $('.text_Aquaris').css({'display':'none'});
                $('.aq_normal').css({'filter': 'none'});
                $(".text_Pisces ").removeClass("ani-rollouttext_Pisces");
                $('.text_Pisces').css({'display':'none'});
                $('.p_normal').css({'filter': 'none'});
                $(".text_Aries ").removeClass("ani-rollouttext_Aries");
                $('.text_Aries').css({'display':'none'});
                $('.ar_normal').css({'filter': 'none'});
                $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
                $('.text_Taurus').css({'display':'none'});
                $('.t_normal').css({'filter': 'none'});
                $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
                $('.text_Gemini').css({'display':'none'});
                $('.gm_normal').css({'filter': 'none'});
                $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
                $('.text_Cancer').css({'display':'none'});
                $('.c_normal').css({'filter': 'none'});
                $(".text_Leo ").removeClass("ani-rollouttext_Leo");
                $('.text_Leo').css({'display':'none'});
                $('.le_normal').css({'filter': 'none'});
                $(".text_Virgo ").removeClass("ani-rollouttext_Virgo");
                $('.text_Virgo').css({'display':'none'});
                $('.v_normal').css({'filter': 'none'});
                $(".text_Libra ").removeClass("ani-rollouttext_Libra");
                $('.text_Libra').css({'display':'none'});
                $('.li_normal').css({'filter': 'none'});
                $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
                $('.text_Scorpio').css({'display':'none'});
                $('.sc_normal').css({'filter': 'none'});
                $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
                $('.text_Sagittarius').css({'display':'none'});
                $('.sg_normal').css({'filter': 'none'});
                $(".text_Capricorn ").removeClass("ani-rollouttext_Capricorn");
                $('.text_Capricorn').css({'display':'none'});
                $('.cp_normal').css({'filter': 'none'});

            if(dob!=''){
                if(zordiac=='Aquarius')
                {
                  $('.text_Aquaris').css({'display':'block'});
                  $(".text_Aquaris ").addClass("ani-rollouttext_Aquaris");
                  $('.aq_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
                }
                else if(zordiac=='Pisces')
                {
                  $('.text_Pisces').css({'display':'block'});
                  $(".text_Pisces ").addClass("ani-rollouttext_Pisces");
                  $('.p_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
                }
                else if(zordiac=='Cancer')
                {
                  $(".text_Cancer ").addClass("ani-rollouttext_Cancer");
                  $('.text_Cancer').css({'display':'block'});
                  $('.c_normal').css({'filter': 'drop-shadow(0px 2px 3px #2b4fff)'});
                }
                else if(zordiac=='Taurus')
                {
                  $(".text_Taurus ").addClass("ani-rollouttext_Taurus");
                  $('.text_Taurus').css({'display':'block'});
                  $('.t_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
                }
                else if(zordiac=='Gemini')
                {
                  $(".text_Gemini ").addClass("ani-rollouttext_Gemini");
                  $('.text_Gemini').css({'display':'block'});
                  $('.gm_normal').css({'filter': 'drop-shadow(0px 2px 3px #b905f5)'});
                }
                else if(zordiac=='Aries')
                {
                   $(".text_Aries ").addClass("ani-rollouttext_Aries");
                   $('.text_Aries').css({'display':'block'});
                   $('.ar_normal').css({'filter': 'drop-shadow(0px 2px 3px #e00202)'});
                }
                else if(zordiac=='Leo')
                {
                  $(".text_Leo ").addClass("ani-rollouttext_Leo");
                  $('.text_Leo').css({'display':'block'});
                  $('.le_normal').css({'filter': 'drop-shadow(0px 2px 3px #f5dc00)'});
                }
                else if(zordiac=='Virgo')
                {
                  $(".text_Virgo ").addClass("ani-rollouttext_Virgo");
                  $('.text_Virgo').css({'display':'block'});
                  $('.v_normal').css({'filter': 'drop-shadow(0px 2px 3px #00f234)'});
                }
                else if(zordiac=='Libra')
                {
                  $(".text_Libra ").addClass("ani-rollouttext_Libra");
                  $('.text_Libra').css({'display':'block'});
                  $('.li_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});



                }
                else if(zordiac=='Scorpio')
                {
                  $(".text_Scorpio ").addClass("ani-rollouttext_Scorpio");
                  $('.text_Scorpio').css({'display':'block'});
                  $('.sc_normal').css({'filter': 'drop-shadow(0px 2px 3px #bd0202)'});
                }
                else if(zordiac=='Sagittarius')
                {
                  $(".text_Sagittarius ").addClass("ani-rollouttext_Sagittarius");
                  $('.text_Sagittarius').css({'display':'block'});
                  $('.sg_normal').css({'filter': 'drop-shadow(0px 2px 3px #8502bd)'});
                }
                else // Capricorn
                {
                  $(".text_Capricorn ").addClass("ani-rollouttext_Capricorn");
                  $('.text_Capricorn').css({'display':'block'});
                  $('.cp_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
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

                      if(age < 18)
                      {
                       $("#sname").show();
                       $("#sponsor_email").show();

                       }
                      else{
                        $("sname").hide();
                        $("#sponsor_email").hide();
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
    function reset_snapshot()
    {
      Webcam.reset();
      var screen_width = window.innerWidth;
      var screen_height = window.innerHeight;
      // alert('Width of th device : '+screen_width+" , height of the view Port: "+screen_height);
      if (screen_height == 500 || screen_height < 500) 
      {
        Webcam.set({
          width: 120,
          height: 120,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
      }
      else if((screen_height == 360 || screen_height < 360) && screen_height > 360 )
      {
        Webcam.set({
          width: 120,
          height: 130,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
      }
      else if((screen_height == 320 || screen_height < 320) && screen_height > 360 )
      {
        Webcam.set({
          width: 90,
          height: 90,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
      }
      else if((screen_height == 768 || screen_height < 768) && screen_height > 500 )
      {
        Webcam.set({
          width: 200,
          height: 200,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
      }
      else
      {
        Webcam.set({
          width: 305,
          height: 230,
          image_format: 'jpeg',
          jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' ); 
      }
    $('.btn_reg_snap_shot').show();
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


            /* function loadSelect_for_org_type(org){  //alert(org);
                $('#org_types').find('option[value='+org+']').attr('selected', 'selected');
                $('#org_type').val(org);
            }
               function loadSelect_for_gender(gender){
                $('#var_genders').find('option[value='+gender+']').attr('selected', 'selected');
                $('#var_gender').val(gender);
            } */

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


                    $(".close_btn ").hide();


                    div.style.visibility = "hidden";


                }

            function goto_wiki2(){

                setTimeout(function(){

              var div = document.getElementById("Div_for_wiki2");
                  var page = document.getElementById("wikiPage2");
                  page.data  ="https://en.wikipedia.org/wiki/Michael_Schumacher";
                  if(div.style.visibility != "visible"){
                    div.style.visibility = "visible";
                    $(".close_btn2 ").show();



                  }else return;
              },1000);

            }
            function hidePage2(){
                    var div = document.getElementById("Div_for_wiki2");
                    var page = document.getElementById("wikiPage2");
                    page.data = "";

                    if($(".close_btn2 ").hide());

                    div.style.visibility = "hidden";



                }

                 $("#Div_for_wiki2").on('click',function(){
                      $("#Div_for_wiki").hide();
                  });
                 $("#divv").on('click',function(){
                      $("#Div_for_wiki").show();
                  });
                 $("#viki").on('click',function(){
                    $("#Div_for_wiki2").show();
                  });
            


                
            

                /*
                Function to redirect to home page after registration  save sucess
                */
             function redirectToPassReset(){
                  window.location = "{{ url('/password/reset') }}";
                }
                /*
                Function to redirect to update passwrod page
                */
                function redirectToUpdatePassword(){
                  window.location = "{{ url('/account') }}";
                }

            function redirectToSamePage(){
                  window.location = "{{ url('/profile/edit-profile') }}";
                }

                /**
                Function to validate form
                */
                function validateMyForm(){

                    document.getElementById("MyForm").submit();
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


  $(document).ready(function(){
    @if (session('success'))
        Swal.fire({
            imageUrl: '../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: "<span id='success' style='color:green;'>Data Updated!</span>",
            html:"{{ session('success') }}" ,
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
          });
    @endif
    @if (session('flash_danger'))
        Swal.fire({
            imageUrl: '../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: "<span id='success'>Went Wrong!</span>",
            html:"{{ session('flash_danger') }}" ,
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
          });
    @endif

    if({{count($errors) }} > 0)
    {
        var errorMessage = {!! html_entity_decode($errors, ENT_QUOTES, 'UTF-8') !!};
        
        $.each( errorMessage , function( Key, Val ) //iterate through cities 
        {
          // console.log('Key : '+Key+ ", Value : "+Val);
          $.notify(Val, "warn");
        }); 
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
            title: "<span id='error'>Failed!</span>",
            html: sweetMessage,
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
          });
        }
    });

    $("#term").click(function(){
        $("#myModal").modal('toggle');
    });

    // var occlistdb = $('').val();
    // $occ_details = explode(',', $occ_results['occlistdb']);
    // $occ_details[0] = "<b>{$occ_details[0]}</b>";
    // $occ_details = implode('\n', $occ_details);

</script>
@endsection
