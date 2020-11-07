@extends('frontend.layouts.registeration_layout')

  @section('before-styles')
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('front/CSS/register_style.css') }}">
  @endsection
  @section('after-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
  @endsection

@section('content')
    <div  id="block_land" >
      <div class="app"></div>
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <div><img src="{{ asset('front') }}/images/rotate-screen.gif" alt=""></div>
      </div>
    </div>
    {{-- <div id="overlay"></div> --}}
    <div class="flex" >
      <div class="container-fluid">
        <section class="reg-section">
          <div class="sub_container">
            <div class="page">        
              

              {{ Form::open(['route' => 'frontend.auth.register','files'=>true , 'class' => 'form-horizontal form_details', 'id'=>'MyForm']) }}
                
                  {{-- LOGIN DETAILS START --}}
                  <fieldset attr-tab-id='1'>
                    <div class="page-header">
                      <h1 class=" head_1 reg_form_clr">Create Your Profile</h1>
                    </div>
                    <h2 class="fs-title">Login Details</h2>
                    <input type="hidden" name="">
                    <div class="form-group">
                      <input type="email"  data-toggle="tooltip" title="Email is Required!" data-placement="right"  class="form-control @error('email') danger-alter @enderror" id="Email" value="{{ old('email') }}" required name="email" placeholder="Email">
                    </div>

                    <div class="input-group" id="show_hide_password">
                      <input type="password" data-toggle="tooltip" title="Password is Required!" data-placement="left" class="form-control @error('password') danger-alter @enderror" placeholder="Password" id="password" name="password" onchange="validatePassword('password')" autocomplete="off">
                      <div class="input-group-append">
                        <span class="input-group-text" onclick="showpassword('show_hide_password')"><i class="fa fa-eye"></i></span>
                      </div>
                    </div>

                    <div class="input-group " id="show_hide_cpassword">
                      <input type="password" data-toggle="tooltip" title="Confirm password is Required!" data-placement="left" class="form-control @error('c_password') danger-alter @enderror" placeholder="Confirm Password" id="c_password" name="c_password" onchange="validateConfirmpass()">
                      <div class="input-group-append">
                        <span class="input-group-text" onclick="showpassword('show_hide_cpassword')"><i class="fa fa-eye"></i></span>
                      </div>
                    </div>
                    <input type="button" name="next" style="margin: 3% auto;" class="btn btn-primary next action-button" value="Next" />
                    <div class="cleaarfix"></div>
                    <div class="alreadyHave">
                      <p style="color:#ffffff"><small>Already have an account?</small><br><a href="{{ url('login') }}">Sign in</a> </p>
                    </div>
                  </fieldset>
                  {{-- lOGIN DETAILS ENDS --}}
                  {{-- PERSONAL DETAILS START --}}
                  <fieldset attr-tab-id='2'>
                    <div class="page-header">
                      <h1 class=" head_1 reg_form_clr">Create Your Profile</h1>
                    </div>
                    <h2 class="fs-title">Personal Details</h2>
                    <div class="form-group">
                      <input type="text" id="fname" data-toggle="tooltip" title="First is Required!" data-placement="right" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') danger-alter @enderror" placeholder="First Name">
                    </div>
                    <div class="form-group">
                      <input type="text" data-toggle="tooltip" title="Last Name is Required!" data-placement="right" class="form-control @error('last_name') danger-alter @enderror" id="lname" name="last_name"  value="{{ old('last_name') }}" required placeholder="Last Name">
                    </div>
                    <div class="form-group">
                      <input type="text" data-toggle="tooltip" title="ID Number is optional!" data-placement="right" class="form-control @error('id_number') danger-alter @enderror" id="id_number" value="{{ old('id_number') }}" name="id_number" placeholder="ID Number (Optional)">
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <select name="gender" data-toggle="tooltip" title="Gender is Required!" data-placement="left" class="form-control @error('gender') danger-alter @enderror" id="genders" value="{{ old('gender') }}" required  class="form-control ">
                              <option value="">Select Gender</option>
                              <option value="male">Male</option>
                              <option value="famale">Female</option>
                              <option value="other">Other</option>
                            </select>
                          </div>    
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group"> 
                          <div class="input-group">
                            <input type="text" class="form-control @error('dob') danger-alter @enderror" id="date" readonly name="dob" placeholder="YYYY-MM-DD" type="text" value="{{ old('dob') }}" onchange="calculate_age()" data-toggle="tooltip" data-placement="right" data-original-title="DOB is Required!">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                          <input  class="form-control lbl_text" type="hidden" id="age" value="{{ old('age') }}" name="age" readonly>
                        </div>    
                      </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                    <div class="cleaarfix"></div>
                    <div class="alreadyHave">
                      <p style="color:#ffffff"><small>Already have an account?</small><br><a href="{{ url('login') }}">Sign in</a> </p>
                    </div>
                  </fieldset>
                  {{-- PERSONAL DETAILS ENDS --}}
                  {{-- LOCATION DETAILS START --}}
                  <fieldset attr-tab-id='3'>
                    <div class="page-header">
                      <h1 class=" head_1 reg_form_clr">Create Your Profile</h1>
                    </div>
                    <h2 class="fs-title">Location Details</h2>
                    <div class="form-group">
                      <input type="text" id="address" data-toggle="tooltip" title="Address is Required!" data-placement="right" value="{{ old('address') }}" required name="address" class="form-control @error('address') danger-alter @enderror" placeholder="Current Address">
                    </div>
                    <div class="form-group">
                      <select id="countryId" required data-toggle="tooltip" title="Country is Required!" data-placement="right" name="country" value="{{ old('country') }}" class="form-control @error('country') danger-alter @enderror countries order-alpha">
                        <option value="">Select Country</option>
                      </select>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <select name="state" class="form-control @error('state') danger-alter @enderror states order-alpha" data-toggle="tooltip" title="state is Required!" data-placement="left" id="stateId">
                            <option value="">Select State</option>
                          </select>
                        </div>    
                      </div>
                      <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                            <select name="city" class="cities order-alpha form-control @error('city') danger-alter @enderror" id="cityId" data-toggle="tooltip" title="City is Required!" data-placement="right">
                              <option value="">Select City</option>
                            </select>
                          </div>    
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <input type="number" data-toggle="tooltip" title="Phone is Required!" data-placement="right" class="form-control @error('mobile_number') danger-alter @enderror" id="mob_no" value="{{ old('mobile_number') }}" required name="mobile_number" placeholder="Mobile Number">
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                    <div class="cleaarfix"></div>
                    <div class="alreadyHave">
                      <p style="color:#ffffff"><small>Already have an account?</small><br><a href="{{ url('login') }}">Sign in</a> </p>
                    </div>
                  </fieldset>
                  {{-- LOCATION DETAILS END --}}
                  {{-- ORGANIZATIONAL DETAILS START --}}
                  <fieldset attr-tab-id='4'>
                    <div class="page-header">
                      <h1 class=" head_1 reg_form_clr">Create Your Profile</h1>
                    </div>
                    <h2 class="fs-title">Organization Details</h2>
                    
                    <div class="form-group">
                       <select name="org_type" value="{{ old('org_type') }}" class=" form-control @error('org_type') danger-alter @enderror" id="org_types" >
                              <option value="" disable selected>Select Organization Type</option>
                              <option value="School">School</option>
                              <option value="Club">Club</option>
                              <option value="Company">Company</option>
                              <option value="Non-profit Organization"> Non-profit Organization</option>
                              <option value="International Organization">International Organization</option>
                              <option value="Group">Group</option>
                              <option value="Individual">Individual</option>
                          </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control @error('org_name') danger-alter @enderror" id="org_name" value="{{ old('org_name') }}" name="org_name" placeholder="Organization Name">
                    </div>
                    
                    <div class="form-group">
                      <input class="form-control @error('sponsor_name') danger-alter @enderror" type="text" id="sname"  value="{{ old('sponsor_name') }}" name="sponsor_name" placeholder="Sponsor Name">
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control @error('sponsor_email') danger-alter @enderror" id="sponsor_email"  value="{{ old('sponsor_email') }}" name="sponsor_email" placeholder="Sponsor Email">
                    </div>

                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                    <div class="cleaarfix"></div>
                    <div class="alreadyHave">
                      <p style="color:#ffffff"><small>Already have an account?</small><br><a href="{{ url('login') }}">Sign in</a> </p>
                    </div>
                  </fieldset>
                  {{-- ORGANIZATIONAL DETAILS END --}}
                  {{-- SNAPSHOT START --}}
                  <fieldset attr-tab-id='5'>
                    <div class="page-header">
                      <h1 class=" head_1 reg_form_clr">Create Your Profile</h1>
                    </div>
                    <h2 class="fs-title">Snapshot</h2>  
                    <div class="row text-center  align-items-center">
                      
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input id='list_occupation' data-toggle="tooltip" class="form-control @error('occupation') danger-alter @enderror" title="Occupation is Required!" data-placement="right" name="list_occupation" onclick="load_animation_astronut();" class="form-control" placeholder="Occupation" autocomplete="off" type="text" readonly value="{{ old('occupation') }}">

                        </div>
                        <div class="checkbox" style="text-align: left;">
                          <label id="terms_label"  style="color: #ffffff">
                          <a href="javascript:void(0);" id="term">Terms & Conditions</a> <input type="checkbox" id="is_term_accept" name="is_term_accept" onchange="setCheckbox();"> </label>
                        </div>
                        <p style="text-align: left;"><small class="warning-text">If your snapshot is inappropiate or irrelevent we will block</small></p>
                      </div>

                      <div class="col-md-6 col-sm-6 text-center">
                          <div id="my_camera" class="camera_alignment" style="display: block;" ></div>
                          <div class="row">
                            <div class="col-md-12 overlap-image">

                              <button type="button"  class="btn_reg_snap_shot border1"  accept="image/*" capture ="camera" value="" onClick="take_snapshot()"><i class="fas fa-camera"></i></button>
                            
                              <button type="button"  class="btn_reg_cam_reset border1"  accept="image/*" capture ="camera" value="Reset" onClick="reset_snapshot()"><i class="fas fa-retweet"></i></button>
                            </div>  
                          </div>
                          
                          <input type="hidden" class="form-control"  id="img_photo_register" name="photo"  value="{{ old('photo') }}" />
                          <input type="hidden" class="form-control"  id="id" name="img_id"/>
                          <input type="hidden" name="occupation" id="occupation" value="{{ old('occupation') }}">
                          <input type="hidden" class="form-control"  id="pk_user_id" name="pk_user_id"/>

                          <div id="results" ></div>
                          
                      </div>                      
                    </div>
                    
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                    <div class="cleaarfix"></div>
                    <div class="alreadyHave">
                      <p style="color:#ffffff"><small>Already have an account?</small><br><a href="{{ url('login') }}">Sign in</a> </p>
                    </div>
                  </fieldset>
                  {{-- SNAPSHOT END --}}
              {{ Form::close() }}  
            </div>
          </div>
          <ul id="progressbar">
            <li class="active">Login Details</li>
            <li>Personal Details</li>
            <li>Location Details</li>
            <li>Organization Details</li>
            <li>Snapshot</li>
          </ul>
        </section>
      </div>
  </div>
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
      <center><div class="txtocp"><input type="text" pattern=".{3,}" class="text_occup"  id="text_occupation_astro" placeholder="Your occupation" value="{{ old('occupation') }}"/></div></center>
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

{{-- TERMS AND CONDITIONS MODAL --}}
<!-- Modal -->

<!-- The Modal -->

  <!-- The Modal -->
  <div class="modal" id="myModal" style="z-index:50000;height: 35vw;top: 6vw;width: 82vw !important">

      <div class="modal-content" style="width: 67vw;left: 15vw">

        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">TERMS OF SERVICE AGREEMENT</h3>
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
    <!---------------------------------Constellation images ----------------------------------------->
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

@endsection

@section('after-scripts')
    <!-----------------------------------   script section ------------------------------------------>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="{{ asset('front') }}/JS/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('front/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('front') }}/JS/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="{{ asset('front/JS/registration.js') }}">
    </script>
        <!-- Webcam.min.js -->
    <!--------------------------------------- For camera--------------------------------------------->

    @if(session('success'))
    <script>
        $(document).ready(function(){       
                    
          Swal.fire({
              imageUrl: '../front/icons/alert-icon.png',
              imageWidth: 80,
              imageHeight: 80,
              imageAlt: 'Mbaye Logo',
              title: "<span id='success' style='color:green;'>Congratulations!</span>",
              html: "Registration completed. We have sent an activation link to your email address . Please verify your account.",
              // width: '30%',
              padding: '1rem',
              background: 'rgba(8, 64, 147, 0.62)'
        });                                        
      });
    </script>
    @endif
 <script>
 
   $(document).ready(function(){
    
    $('#date').datepicker({
        format: 'yyyy-mm-dd'
    }); 
    if({{count($errors) }} > 0)
    {
      var errorMessage = {!! html_entity_decode($errors, ENT_QUOTES, 'UTF-8') !!};
      var sweetMessage = '';
      console.log(errorMessage);
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
      Swal.fire({
          imageUrl: '../front/icons/alert-icon.png',
          imageWidth: 80,
          imageHeight: 80,
          imageAlt: 'Mbaye Logo',
          title: "<span id='error'>Registration Failed!</span>",
          html: sweetMessage,
          // width: '30%',
          padding: '1rem',
          background: 'rgba(8, 64, 147, 0.62)'
                });
      }
    }
    );
      const genderOldValue = "{{ old('gender') }}";
      const countryOldValue = "{{ old('country') }}";
      const orgtypeOldValue = "{{ old('org_type') }}";
 </script>

@endsection
