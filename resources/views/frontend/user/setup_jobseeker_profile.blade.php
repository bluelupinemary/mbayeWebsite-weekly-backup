@extends('frontend.layouts.career_setup-profile_layout')

@section('before-styles')

    <style>
        .bg-div {
            position: absolute;
            transform: translate(23%, 25%);
            top: 0;
            left: 0;
            width: 70vw;
            height: 67vh;
            /* margin: 0 auto; */
            /* overflow: hidden; */
            /* display: flex; */
            border: 0;
            background-color: #17a2b854;
            box-shadow: 2px 0px 9px #17a2b8;
        }
        .mbaye_body{
            justify-content: normal !important;
        }
        /* $('.mbaye_body').css('justify-content','normal'); */
    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('front/CSS/cropper.css') }}">	
    <script src="{{asset('front/JS/popper.min.js')}}"></script>	
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>	
    <script src="{{asset('front/JS/cropper.js')}}"></script>

@endsection



@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
   

@endsection


@section('content')
<div class="slider">
    <h2 class="sidenav-heading"  onclick="openNav()">SETUP&nbsp;PROFILE</h2>
</div>
{{-- <h1>Testing</h1>     --}}
    <div id="page-content">
        {{-- <div class="app">  --}}
            <form action="" id="aboutme-form" enctype="multipart/form-data" method="POST">
                @csrf
            <div class="bg-div">
               
                <div class="featured-img" ></div>
                    <label for="file" id="featured-image-label">
                    
                    <!--changed id of img from outputImage to featured-image-previewimg-->
                    
                        <img src=""  id="featured-image-previewimg"  alt="input image" style=" max-width:100%; max-height:100%; display:none;">
                    
                        <div class="middle" id="middle" style="background-color: black;">
                            <div id="middleText">Upload Featured Image</div>
                        </div>
                    
                    
                    </label>
                    {{-- <button type="button" class="" id="edit_uploaded_image" style="">Edit Image</button>  --}}

                    
                        <i id="edit_uploaded_image" class="far fa-image btn_pointer" style="color:#16aedc;"> <span style="display:none;font-size: 1.2rem;width: 6.5vw;padding: 10%;
                            transform: translate(10%, -280%);
                            background-color: rgb(23, 162, 184);
                            color: white;" >Edit photo</span></i>
                    

                   {{-- <button class="btn" id="edit_uploaded_image"> --}}

                   
                        <input id="file"  onchange="loadFile(event)"  type="file"  name="featured_image" value=""  style=" min-width:100%;min-height: 100%;">
                    

            </div>
            {{-- --------------------------------------------------------------------- --}}
            <div class="modal" id="AboutMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">About Me</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body">
                        <div class="aboutme-body">
                            <fieldset>
                                
                               
                                <div class="form-row">
                                    
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="fName"> First Name</label>
                                            <input type="text"  class="form-control disabled_field" id="fName" disabled value="{{ $user->first_name }}">
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="lName">Last Name</label>
                                        <input type="text" class="form-control disabled_field" id="lName" disabled value="{{ $user->last_name }}">
                                      </div>
                                      
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control disabled_field" id="dob" disabled value="{{ $user->dob }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control disabled_field" id="age" disabled value="{{ $user->age }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control disabled_field" id="gender" disabled value="{{ $user->gender }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="Address"> Registered Address</label>
                                        <input type="text" class="form-control disabled_field" id="my_Address" disabled value="{{ $user->address }}">
                                      </div>
                                       <div class="form-group col-md-12 input-group-sm">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control disabled_field" id="Country" disabled value="{{ $user->country }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="objective">Objective</label>
                                        <textarea type="text" class="form-control" name="objective" id="objective" maxlength="250"></textarea>
                                      </div>
                                      {{-- <div class="form-group col-md-12 input-group-sm">
                                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                     Add Current Address
                                      </button>
                                      </div> --}}
                                    <br>  <br>
                                      {{-- <div class="collapse col-md-12" id="collapseExample"> --}}
                                            <div class="form-group col-md-12 input-group-sm ">
                                                <label for="country">Present Country</label>
                                                <select class="countries form-control" name="present_country" id="countryId" required>&#x25BC;
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="state">Present State</label>
                                                <select id="stateId" class="states form-control" name="state" required>
                                                    <option value="">Select State</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="city">Present City</label>
                                                <select id="cityId" class="cities form-control" name="present_city" required>
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="pAddress">Present Address</label>
                                                <input type="text" class="form-control" name="present_address" id="pAddress" >
                                            </div>
                                            {{-- <div class="form-group col-md-12 input-group-sm">
                                                <label for="objective">Objective</label>
                                                <textarea type="text" class="form-control" name="objective" id="objective" maxlength="250"></textarea>
                                            </div> --}}
                                      {{-- </div> --}}
                                     
                                      {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                                      
                                    </div>    

                                    <input type="hidden" name="edited_featured_image" id="edited_featured_image">
                                
                            </fieldset>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                      <button type="button" class="btn btn-primary aboutme-done">Done</button>
                    </div>
                  </div>
                </div>
                
              </div>
            </form>
            {{-- ---------------------------------------------------------------------------- --}}
             
        
    
            {{-- <button class="cancel-btn" type="button">Cancel</button>
            <button class="save-btn " type="button">Save</button> --}}
            <div class="jobseeker-title">
                <h1>CREATE JOBSEEKER PROFILE</h1>
            </div>

            <div id="mySidenav" class="sidenav">
                {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a> --}}
                <h3 class="heading_setup">Setup Profile</h3>
                <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
                <a href="" class="profession" data-toggle="modal" data-target="#ProfessionSkillModal">Profession And Skills</a>
                <a href="" class="education" data-toggle="modal" data-target="#EducationModal">Education</a>
                <div class="slider-close-button">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a>
                </div>
                <a href="" class="work-experience" data-toggle="modal" data-target="#WorkExperienceModal">Work Experience</a>
                <a href="" class="contacts" data-toggle="modal" data-target="#ContactModal">Contact</a>
                <a href="" class="reference" data-toggle="modal" data-target="#CharacterReferencesModal">Character References</a>
            
                
            </div>

            {{-- <div class="slider">
                <h2 class="sidenav-heading"  onclick="openNav()">SETUP&nbsp;PROFILE</h2>
            </div> --}}
            {{-- <div class="sidenav-left">
            <!-- left controls -->
         
                {{-- <div id="main"> --}}
                    {{-- <span  class="arrows" style="font-size:17px;font-family:Nasalization;cursor:pointer" onclick="openNav()">S<br>E<br>T</span> --}}
                    {{-- <h2 class="sidenav-heading"  onclick="openNav()">SETUP&nbsp;PROFILE</h2> --}}
                {{-- </div> --}}
            </div> --}}

            <div class="sidenav-right">
            <!-- right controls -->
            </div>

            
        <form method="POST" action="{{url('save_work_experience')}}" id="work-experience-form"  enctype="multipart/form-data">
            @csrf
             <div class="modal" id="WorkExperienceModal"  class="WorkExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                {{-- <div class="form-block">  --}}
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Work Experiences</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                    </div> --}}
                    <div class="modal-body work-modal-body">
                        <div class="work-experience-body main_work_experience_div workDiv_1">
                            <fieldset>
                                <div style="position: relative;">
                                  <button type="button"  class="close remove-btn-workexperience"   title="Remove Work Experience "aria-label="Clone" onclick="remove_work_experience(this)">
                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                  </button>
                                </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="StartDate">Start Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" id="start_date" value="" name="start_date[]" >
                                        </div>
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="EndDate">End Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" value="" id="end_date" name="end_date[]" >
                                        </div>
                                      </div>
                                        <div class="form-group input-group-sm">
                                            <label for="CompName">Company Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="company_name" name="company_name[]" placeholder="">
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label for="Address">Company Address<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="Address" name="address[]" placeholder="">
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="CompDesig">Designation<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="CompDesig" name="designation[]" placeholder="">
                                      </div>
                                      <div class="form-group  input-group-sm">
                                        <label for="CompRole">Role<span style="color:red">*</span></label>
                                        {{-- <input type="text" class="form-control" id="CompRole" name="role[]" placeholder=""> --}}
                                        <textarea class="form-control" id="CompRole" name="role[]" placeholder="" maxlength="250"></textarea>
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Contact">Contact Person<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="Contact" name="contact_no[]" placeholder="">
                                      </div>
                                      
                                      <div style="position: relative;">
                                        <button type="button"  class="close clone-btn-workexperience"  title="Add More Work Experience " aria-label="Clone">
                                            <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                        </button>
                                      </div>
                            </fieldset><br>
                        </div>
                    </div>
                    <div class="work_experience-clone"></div>
                    <div class="modal-footer">
                        <input type="submit"  class="btn btn-primary work-experience-done" value="Done" id="submit"/>
                    </div>
                </div>
            </div>
           {{-- </div> --}}
         </div>
        </form>


        <form method="POST" action="{{url('save_education')}}" id="education-form" enctype="multipart/form-data">
            @csrf
            <div class="modal" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
              {{-- <div class="education_form-block">  --}}
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Education</h5>

                     
                     
                      <button type="button" class="close" data-dismiss="modal"   aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}

                    <div class="modal-body education-modal-body">
                       
                        <div class="education-body main_education_div div_1">
                           
                            <fieldset>
                                {{-- <button type="button"  class="close clone-btn-education  "  title="Add More Education" aria-label="Clone">
                                    <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                  </button> --}}
                                  <div style="position: relative;">
                                    <button type="button"  class="close remove-btn-education"  title="Remove Education " aria-label="Clone" onclick="remove(this)">
                                        <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                      </button>
                                  </div>
                                  
                                    <div class="form-row">
                                        <div class="form-group col-md-12 input-group-sm" id="education_dropdown">
                                            <label for="education_level">Level Of  Education<span style="color:red">*</span></label>
                                                <select class="form-control" name="education_level[]" id="xyz"  required>
                                                    <option value="Doctorate" > Doctorate</option>
                                                    <option value="Master" >Master's Degree</option>
                                                    <option value="Bachelor" >Bachelor's Degree</option>
                                                    <option value="Associate" >Associate Degree</option>
                                                    <option value="SomeCollege" >Some College</option>
                                                    <option value="Vocational" >Vocational</option>
                                                    <option value="HighSchool" >High School Graduate</option>
                                                </select>
                                        </div> 
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="SchoolName">School Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="SchoolName" name="school_name[]"  required>
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="FieldOfStudy">Field Of Study<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="FieldOfStudy"  name="field_of_study[]"  required>
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="Description">Description<span style="color:red">*</span></label><br>
                                        <textarea id="Description" class="form-control" name="description[]" maxlength="250" required></textarea>
                                      </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                          <label for="StartDate" style="">Start Date<span style="color:red">*</span><span></span></label>
                                          <input type="date" class="form-control" id="StartDate" placeholder="Date"  name="start_date[]" required >
                                        </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                         
                                        </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                            <label for="EndDate">End Date<span style="color:red">*</span></label>
                                            <input type="date" class="form-control" id="EndDate" name="end_date[]" required >
                                          </div>
                                      </div>
                                      

                                      <div style="position: relative;">
                                        <button type="button"  class="close clone-btn-education"  title="Add More Education" aria-label="Clone">
                                            <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                        </button>
                                      </div>
                            </fieldset><br>
                        </div>  
                        
                    </div>
              
                    <div class="education-clone"></div>
                    <div class="modal-footer">
                     <input type="submit"  class="btn btn-primary education-done" value="Done" id="submit_education"/>
                    </div>
                </div>
            {{-- </div> --}}
       
              </div>
            </div>
         </form>


         <form method="POST" action="" id="reference-form"  enctype="multipart/form-data">
            @csrf
              <div class="modal" id="CharacterReferencesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                {{-- <div class="reference_form-block "> --}}
                 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Character References</h5>

                    

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body reference-modal-body">
                       <div class="reference-body  main_reference_div referenceDiv_1">
                         <fieldset> 
                                        <div style="position: relative;">
                                            <button type="button"  class="close remove-btn-reference"  aria-label="Clone" title="Remove Character Reference" onclick="remove_reference(this)">
                                                <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                            </button>
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <label for="Name"> Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="Name" name="name[]" placeholder="">
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Email">Email<span style="color:red">*</span></label>
                                        <input type="email" class="form-control" id="Email"  name="email[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="CompName">Company Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="CompName"  name="company_name[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Designation">Designation<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="Designation"  name="designation[]" placeholder="">
                                      </div>
                                      <div style="position: relative;">
                                        <button type="button"  class="close clone-btn-reference"  title="Add More Character Reference "aria-label="Clone">
                                            <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                        </button>
                                      </div>
                            </fieldset><br>
                        </div>
                    </div>
           
                    <div class="reference-clone"></div>
                    <div class="modal-footer">
                        <input type="submit"  class="btn btn-primary characterRederences-done" value="Submit" id="submit_reference"/>
                    </div>
                </div>
            </div>
        {{-- </div>   --}}
        </div>
       </form>  

        <!--PART TO ADD THE FORM FOR SUBMITTING THE PROFILE'S FEATURED IMAGE-->
        {{-- <input type="text" name=jobseeker_featured_image" id="jobseeker_featured_image" style="position:absolute;left:0;top:0;width:10vw;height:2vw;z-index:500;"> --}}

        <!--END OF PART TO ADD THE FORM FOR SUBMITTING THE PROFILE'S FEATURED IMAGE-->
       
              
            

              <form action="" id="contact-form">
                @csrf
              <div class="modal" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Contact Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body">
                        <div class="contact-body">
                            <fieldset>
                                
                                <div class="form-row">
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="pEmail"> Primary Email</label>
                                            <input type="text"  class="form-control disabled_field" id="pEmail" name="email" disabled value="{{ $user->email }}" >
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="pMobNumber">Primary Mobile Number</label>
                                        <input type="text" class="form-control disabled_field" id="pMobNumber" name="mobile_number" disabled value="{{ $user->mobile_number }}" >
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="sEmail">Secondary Email (Optional)</label>
                                        <input type="email" class="form-control" id="sEmail" name="secondary_email" >
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="sMobNumber">Secondary  Mobile Number (Optional)</label>
                                        <input type="text" class="form-control" id="sMobNumber" name="secondary_mobile_number" >
                                      </div>
                                </div>
                            </fieldset>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary contact-done">Done</button>
                    </div>
                  </div>
                </div>
              </div>
            
        </form>

    
              
                <div class="modal" id="ProfessionSkillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                  {{-- <div class="profession_form-block">  --}}
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Profession And Skills</h5>
    
                         
                         
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          
                        </div>
                        {{-- <div class="app" style="display: none;">
                        </div> --}}
                        <div class="modal-body ">
                            <div class="profession-body" id="Profession-body">
                                <form method="POST" action="" id="profession-form" enctype="multipart/form-data">
                                    @csrf
                                <fieldset>
                                   
                                        <div class="form-row">
                                            <div class="form-group col-md-12 input-group-sm">
                                              <label for="Profession">Profession<span style="color:red">*</span></label>
                                              <select id="Profession" class="form-control" name="profession_id" required>&#x25BC;
                                                    <option value="public" selected disabled>Select</option>
                                                    @foreach($profession as $profession)
                                                    <option value="{{$profession->id}}" id="hhh">{{$profession->profession_name}}</option>
                                                    @endforeach
                                               </select>
                                              {{-- <input type="text" class="form-control" id="Profession"  name="Profession" >
                                              <button type="button"  class="dropdown-btn" >
                                                <span aria-hidden="true" class="btn-down"><i class="fas fa-angle-down"></i></span>
                                              </button> --}}
                                              
                                            </div>
                                            <div id="profession_list"></div>      
                                        </div>

                                        <div class="form-row"> 
                                          <div class="form-group col-md-12 col-lg-12 input-group-sm">
                                            <label for="skills">Skills<span style="color:red">*</span></label>
                                            <textarea class="form-control" id="skills" name="skills"></textarea>
                                          </div>  
                                        </div>
                                  
                                </fieldset>
                            </div>  
                 
                        </div>
                  
         
                        <div class="modal-footer">
                         <input type="submit"  class="btn btn-primary profession-done" value="Done" id="submit_profession"/>
                        </div>
                    </div>
                {{-- </div> --}}
           
                  </div>
                </div>
             </form>
        {{-- </div> <!--end of app--> --}}   
</div>

<div class="app">
    <!------------------------DIV FOR THE IMAGE EDITOR 1----------------------->
    <div class="image-editor-modal" id="imageEditorModal">
        <imageeditor-component :in_page="'setupCompanyProfile'"></imageeditor-component>
     </div>
     <!--------------------END OF DIV FOR THE IMAGE EDITOR 1---------------------->
     <!-------------------------DIV FOR THE TUI IMAGE EDITOR 2------------------------>
     <div class="tui-editor-modal" id="tuiEditorModal">
         <tuieditor-component></tuieditor-component>
     </div>
      <!-------------END OF DIV FOR THE TUI IMAGE EDITOR 2----------------->
</div> <!--end of app-->

@endsection
@section('after-scripts')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
{{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/jquery-ui.js')}}"></script>
{{-- <script src="{{asset('front/JS/popper.min.js')}}"></script> --}}

<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
{{-- <script src="{{asset('front/system-google-font-picker/jquery.fontselect.js')}}"></script> --}}
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
{{-- <script src="//geodata.solutions/includes/countrystatecity.js"></script> --}}
<script src="{{ asset('front/JS/countrystatecity.js') }}">

<script>
    $(function() {
  // choose target dropdown
  var select = $('#Profession');
  select.html(select.find('option').sort(function(x, y) {
    // to change to descending order switch "<" for ">"
    return $(x).text() > $(y).text() ? 1 : -1;
  }));

  // select default item after sorting (first item)
//   $('#Profession').get(0).selectedIndex = 0;
document.getElementById("Profession").selectedIndex = "52";
});
</script>

<script>
    
    $(document).ready(function() {
        
        // $('.image-editor-modal').show();
        var url = $('meta[name="url"]').attr('content');
//    
        // var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        // var height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
        // // var canvas = document.getElementById("c");

        // let imagesMap = new Map();              //data structure for the images added
        // let shapesMap = new Map();              //data structure for the shapes added
        // let textMap = new Map();                //data structure for the texts added
 
        
        

        /**
         * save job seeker profile image
         * 
         * */
        $(".save-btn").click(function(){
            var object_count = canvas.getObjects().length;
            if(object_count < 1) { 
             
                Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: 'Error!',
                            html: 'Please Upload Image(s)',
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                        });
      
            }
            else{
                $(".save").click();
            }
        });

        //TOOLTIP POSITION FOR THE ICONS
        $( document ).tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                $( this ).css( position );
                $( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
                }
            }
        }); 

        // //REDIRECT TO DASHBOARD IF CANCEL BUTTON IS CLICKED
        // $('button.cancel-btn').click(function() {
        //     window.location.href = url+'/dashboard';
        // });

        // $(".remove-btn-education").hide();
        // $(".remove-btn-workexperience").hide();
        // $(".remove-btn-reference").hide();


        //function to check if save icon should be enabled
        function countObjects(){
            var object_count = canvas.getObjects().length;

            if(object_count < 1) {
                $('.save').prop('disabled', true);
            }
        }
  
        // //function to download the image
        // function downloadImage() {
        //     var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will 

        //     var link = window.document.createElement('a');
        //     link.href = image;
        //     link.download = "screenshot.jpg";
        //     var click = document.createEvent("MouseEvents");
        //     click.initEvent("click", true, false);
        //     link.dispatchEvent(click); 

        // }


    

        /*FUNCTIONS RELATED TO THE INSTRUCTIONS OVERLAY*/
        // show instruction overlay
        // $('.help a').click(function () {
        //     $('.instructions').fadeIn();
        // });

        // // hide instruction overlay
        // $('.instruction-close-btn').click(function() {
        //     $('.instructions').fadeOut();
        //     $('#main').show();
        //     $('.start-message').show();
            
        // });

        // show instruction text on hover of each box
        // $('.instruction').hover(
        //     function() {
        //         var text_div = $(this).data('text-div');
        //         $('.'+text_div).fadeIn();
        //     },
        //     function() {
        //         var text_div = $(this).data('text-div');
        //         $('.'+text_div).hide();
        //     }
        // );
        $(".remove-btn-education").hide();
        $(".remove-btn-workexperience").hide();
        $(".remove-btn-reference").hide();
                
        // clone-btn-workexperience
        $('.clone-btn-workexperience').click(function(e) {
            e.preventDefault();
            
            var $form = $('form#work-experience-form');
            var newel = $('.main_work_experience_div').clone();
            $(newel).insertAfter(".work-experience-body:last");
            var new_ele = $('.work-experience-body:last');
            new_ele.find('input').val("");
            var count = $(".work-experience-body");
                    new_ele.removeClass('workDiv_'+(count.length-1))
                    new_ele.addClass('workDiv_'+count.length)
                  
                 if(count.length>1){
                    $(".work-experience-body:last .clone-btn-workexperience").hide();
                    $(".work-experience-body:last .remove-btn-workexperience").show();

                 }
           $(".work-experience-body:last #start_date").focus().select();
        });
        //work experience save
        $('.work-experience-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_work_experience';
            var $form = $('form#work-experience-form');
            var form_data = $('#work-experience-form').serialize();
            var post_data = new FormData($form[0]);
            var count = $(".work-experience-body");
            totalDiv=count.length;
            var alert_status;
        
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var start_date = $("form#work-experience-form .workDiv_"+i+" #start_date").val();
                var end_date = $("form#work-experience-form .workDiv_"+i+' #end_date').val();
                var company_name = $("form#work-experience-form .workDiv_"+i+' #company_name').val();
                var CompRole = $("form#work-experience-form .workDiv_"+i+' #CompRole').val();
                var CompDesig = $("form#work-experience-form .workDiv_"+i+' #CompDesig').val();
                var Contact = $("form#work-experience-form .workDiv_"+i+' #Contact').val();
                var Address = $("form#work-experience-form .workDiv_"+i+' #Address').val();

               

                if(start_date==''){
                    alert_status = true;
                     message = 'Start Date is required';
                     $("form#work-experience-form .workDiv_"+i+" #StartDate").focus();
                }
                else if(end_date==''){
                     alert_status = true;
                     message = 'End Date is required';
                     $("form#work-experience-form .workDiv_"+i+" #EndDate").focus();
                }
                else if(company_name==''){
                     alert_status = true;
                     message = 'Company Name is required';
                     $("form#work-experience-form .workDiv_"+i+" #company_name").focus();
                }
                else if(CompRole==''){
                     alert_status = true;
                     message = 'Role is required';
                     $("form#work-experience-form .div_"+i+" #CompRole").focus();
                }
                else if(CompDesig==''){
                     alert_status = true;
                     message = 'Designation is required';
                     $("form#work-experience-form .div_"+i+" #CompDesig").focus();
                }
                else if(Contact==''){
                     alert_status = true;
                     message = 'Contact is required';
                     $("form#work-experience-form .div_"+i+" #Contact").focus();
                }
                else if(Address==''){
                     alert_status = true;
                     message = 'Address is required';
                     $("form#work-experience-form .div_"+i+" #Address").focus();
                }
            }
          
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        $('#WorkExperienceModal').modal('hide');
                        $('#ContactModal').modal('show');
                        $('.modal-backdrop').remove();
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
    }
                    
     });
     
        // clone-btn-education
        $('.clone-btn-education').click(function(e){
            e.preventDefault();
            // alert('jjkkk');
                //    $(".remove-btn-education").hide();

                    var $form = $('form#education-form');
                    var newel = $('.education-body:last').clone();
                    $(newel).insertAfter(".education-body:last");
                    var new_ele = $('.education-body:last');
                    new_ele.find('input').val("");
                    var count = $(".education-body");
                    new_ele.removeClass('div_'+(count.length-1))
                    new_ele.addClass('div_'+count.length)
                    // document.getElementById("remove-btn-education").style.cssFloat = "right";
                 if(count.length>1){
                    $(".education-body:last .clone-btn-education").hide();
                    $(".education-body:last .remove-btn-education").show();
                 }
                 $(".education-body:last #StartDate").focus().select();  

                 console.log();
                 
        });
        
        // var $dropdown1 = $("select[name='education_level']");
        // var $dropdown2 = $("select[name='dropdown2']");

        // $dropdown1.change(function() {
        // $dropdown1.children().show();
        // var selectedItem = $($dropdown1).val();
        // if (selectedItem != "")
        //     $('select[name="dropdown"] option[value="' + selectedItem + '"]').hide();
        // });
        // $dropdown1.change(function() {
        // $dropdown1.children().show();
        // var selectedItem = $($dropdown1).val();
        // if (selectedItem != "")
        //     $('select[name="dropdown1"] option[value="' + selectedItem + '"]').hide();
        // });
 
    //education save
    $('.education-done').click(function(e) {
        
            e.preventDefault();
            var form_url = url+'/save_education';
            var $form = $('form#education-form');
            var form_data = $('#education-form').serialize();
            var post_data = new FormData($form[0]);
            var count = $(".education-body");
            totalDiv=count.length;
            var alert_status=false;
          
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var start_date = $("form#education-form .div_"+i+" #StartDate").val();
                var end_date = $("form#education-form .div_"+i+' #EndDate').val();
                var school_name = $("form#education-form .div_"+i+' #SchoolName').val();
                var field_of_study = $("form#education-form .div_"+i+' #FieldOfStudy').val();
                var desccription = $("form#education-form .div_"+i+' #Description').val();
               

                if(start_date==''){
                    alert_status = true;
                     message = 'Start Date is required';
                     $("form#education-form .div_"+i+" #StartDate").focus();
                }
                else if(end_date==''){
                     alert_status = true;
                     message = 'End Date is required';
                     $("form#education-form .div_"+i+" #EndDate").focus();
                }
                else if(school_name==''){
                     alert_status = true;
                     message = 'School Name is required';
                     $("form#education-form .div_"+i+" #SchoolName").focus();
                }
                else if(field_of_study==''){
                     alert_status = true;
                     message = 'Filed Of study is required';
                     $("form#education-form .div_"+i+" #FieldOfStudy").focus();
                }
                else if(desccription==''){
                     alert_status = true;
                     message = 'Description is required';
                     $("form#education-form .div_"+i+" #Description").focus();
                }
            }
            
            
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
        

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        $('#EducationModal').modal('hide');
                        $('#WorkExperienceModal').modal('show');
                        $('.modal-backdrop').remove();
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
        }      
                });   


        // clone-btn-character reference
        $('.clone-btn-reference').click(function(e) {
                            e.preventDefault();
                            var $form = $('form#reference-form');
                            var newel = $('.main_reference_div').clone();
                            $(newel).insertAfter(".reference-body:last");
                            var new_ele = $('.reference-body:last');
                            new_ele.find('input').val("");
                            var count = $(".reference-body");
                            new_ele.removeClass('referenceDiv_'+(count.length-1))
                            new_ele.addClass('referenceDiv_'+count.length)
                           
                            if(count.length>1){
                                $(".reference-body:last .clone-btn-reference").hide();
                                $(".reference-body:last .remove-btn-reference").show();
                            }
                            $(".reference-body:last #Name").focus().select();    
                        
                });

        //Character reference save
        $('.characterRederences-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_character_references';
            var $form = $('form#reference-form');
            var post_data = new FormData($form[0]);
            var count = $(".reference-body");
            totalDiv=count.length;
            var alert_status;
           var id = {{ Auth::user()->id }};
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var Name = $("form#reference-form .referenceDiv_"+i+" #Name").val();
                var Email = $("form#reference-form .referenceDiv_"+i+' #Email').val();
                var CompName = $("form#reference-form .referenceDiv_"+i+' #CompName').val();
                var Designation = $("form#reference-form .referenceDiv_"+i+' #Designation').val();
               

                if(Name==''){
                    alert_status = true;
                     message = 'Name is required';
                     $("form#reference-form .referenceDiv_"+i+" #Name").focus();
                }
                else if(Email==''){
                     alert_status = true;
                     message = 'Email is required';
                     $("form#reference-form .referenceDiv_"+i+' #Email').focus();
                }
                else if(CompName==''){
                     alert_status = true;
                     message = 'Company Name is required';
                     $("form#reference-form .referenceDiv_"+i+' #CompName').focus();
                }
                else if(Designation==''){
                     alert_status = true;
                     message = 'Designation is required';
                     $("form#reference-form .referenceDiv_"+i+' #Designation').focus();
                }
               
            }
            
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Your Jobseeker Profile Is Created!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        // window.open(url+'/single_blog/'+data.data.id);
                        window.location.href = url+'/my_career_profile/'+ id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                    
    } 
                });   

        //conatct details save
        $('.contact-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_contact_details';
            var $form = $('form#contact-form');
            var post_data = new FormData($form[0]);
            var alert_status;
                    var secondary_email = $("form#contact-form #sEmail").val();
                    var secondary_mobNumber = $("form#contact-form #sMobNumber").val();
                
                    if(secondary_email==''){
                        alert_status = true;
                        message = 'Secondary Email is required';
                        $("form#contact-form  #sEmail").focus();
                    }
                    if(secondary_mobNumber==''){
                        alert_status = true;
                        message = 'Secondary Mobile Number is required';
                        $("form#contact-form  #sEmail").focus();
                    }
                    if(alert_status) {
                    Swal.fire({
                        title: 'Discard Changes',
                        text: message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: true,
                        confirmButtonText:
                            'Discard Changes',
                        cancelButtonText:
                            'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((res) => {
                        if (res.value) {
                            if(action) {
                                window.location.href = action;
                            }
                        }
                    });
                } else {
           
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        $('#ContactModal').modal('hide');
                        $('#CharacterReferencesModal').modal('show');
                        $('.modal-backdrop').remove();
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                }    
                }); 

                //About me save
                $('.aboutme-done').click(function(e) {
                    
                    e.preventDefault();
                    var form_url = url+'/save_aboutme_details';
                    // alert(form_url);
                    // var feature_image = $("#file").val();
                    // alert(feature_image);
                    // return false;
                    var $form = $('form#aboutme-form');
                    var post_data = new FormData($form[0]);
                    // post_data.append('featured_image', feature_image);
                    var alert_status;
                    var present_address = $("form#aboutme-form #pAddress").val();
                    var objective = $("form#aboutme-form #objective").val();
                    
                    // alert(feature_image);
                    // return false;
                    if(present_address==''){
                        alert_status = true;
                        message = 'Present address is required';
                        $("form#aboutme-form  #pAddress").focus();
                    }
                    if(objective==''){
                        alert_status = true;
                        message = 'objective is required';
                        $("form#aboutme-form  #objective").focus();
                    }
                    if(alert_status) {
                    Swal.fire({
                        title: 'Discard Changes',
                        text: message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: true,
                        confirmButtonText:
                            'Discard Changes',
                        cancelButtonText:
                            'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((res) => {
                        if (res.value) {
                            if(action) {
                                window.location.href = action;
                            }
                        }
                    });
                } else {
                   
                
                    $.ajax({
                        url: form_url,
                        method: 'post',
                        data:post_data,
                        // dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            Swal.fire({
                                title: '<span class="success">Success!</span>',
                                text: data.message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)',
                                allowOutsideClick: false
                            }).then((res) => {
                                if (res.value) {
                                    // document.getElementByClassName("profession").click;
                                    $('#AboutMeModal').modal('hide');
                                    $('.modal-backdrop').remove();
                                    // $('#ProfessionSkillModal').show();
                                    $("#ProfessionSkillModal").modal('show');
                        }
                                
                                // $('#Profession-body').parent().parent().show();
                                // document.getElementById("aboutme-body").innerHTML = "hide";
                                // document.getElementById("Profession-body").innerHTML = "show";
                                 
                               
                                 
                                
                                
                                // window.open(url+'/single_blog/'+data.data.id);
                                // window.location.href = url+'/single_general_blog/'+data.data.id;
                                // resetGeneralBlogForm();
                                

                            });
                        },
                        error: function (request, status, error) {
                            var response = JSON.parse(request.responseText);
                            var errorString = '';
                            var title = 'Error!';

                            if(response.errors) {
                                title = 'Error in processing request...';
                                $.each( response.errors, function( key, value) {
                                    errorString += '<p>' + value + '</p>';
                                });
                            }
                            
                            Swal.fire({
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: title,
                                html: errorString,
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                        }
                    });
                }
                            
                        }); 
                
    
                //About me end

               //Character reference save
        $('.profession-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_professional_details';
            var $form = $('form#profession-form');
            var post_data = new FormData($form[0]);
            var alert_status;
          
          
                var professsion = $("form#profession-form #Profession").val();
                var skills = $("form#profession-form  #skills").val();
              
                if(professsion==''){
                    alert_status = true;
                     message = 'Profession is required';
                     $("form#profession-form  #Profession").focus();
                }
                else if(skills==''){
                     alert_status = true;
                     message = 'Skills is required';
                     $("form#profession-form #skills").focus();
                }
               
               
                   
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        $('#ProfessionSkillModal').modal('hide');
                        $('#EducationModal').modal('show');
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                    
    } 
                });   

                 $('#Profession').on('keyup',function() {
                    var query = $(this).val(); 
                    var form_url = url+'/search';
                    $.ajax({
                        url:form_url,
                        type:"GET",
                        data:{'profession':query},
                        success:function (data) {
                            $('#profession_list').html(data);
                        }
                    })
                    // end of ajax call
                });    

                $(document).on('click', 'li', function(){
                  
                  var value = $(this).text();
                  $('#Profession').val(value);
                  $('#profession_list').html("");
              });

              $(".dropdown-btn").click(function() {
                $('#Profession').val(" ");
                $( "#Profession" ).keyup();
              });
       
    });
                function openNav(){
                    if(isImageAvailable){
                        document.getElementById("mySidenav").style.width = "10vw";
                        // document.getElementById("main").style.marginLeft = "250px";
                        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
                    }else{
                            Swal.fire({
                            title: 'Upload Image First',
                            // text: message,
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)',
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: true,
                            cancelButtonText:'Cancel',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        })
                    }
                
                }

                function closeNav()
                 {
                document.getElementById("mySidenav").style.width = "0";
                // document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
                }
                function remove(e){
                    $(e).closest('.education-body').remove();
                }
                function remove_work_experience(e){
                    $(e).closest('.work-experience-body').remove();
                }
                function remove_reference(e){
                    $(e).closest('.reference-body').remove();
                }
                // $('.close').on('click',function(){
                //     alert('hhh');
                // })
                // -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

    //function called with edit image button is clicked
    $('#edit_uploaded_image').on('click', function(){
        // $("#imageEditorModal").css("display","block");
        $('.image-editor-modal').show();
        $('#page-content').hide();
    }); 


    //font selection for the font picker in the editor's toolbar
    $('#font-picker').fontselect({
    fonts: [
        "Aclonica",
        "Allan",
        "Annie+Use+Your+Telescope",
        "Anonymous+Pro",
        "Allerta+Stencil",
        "Allerta",
        "Amaranth",
        "Anton",
        "Architects+Daughter",
        "Arimo",
        "Artifika",
        "Arvo",
        "Asset",
        "Astloch",
        "Bangers",
        "Bentham",
        "Bevan",
        "Bigshot+One",
        "Bowlby+One",
        "Bowlby+One+SC",
        "Brawler",
        "Buda:300",
        "Cabin",
        "Calligraffitti",
        "Candal",
        "Cantarell",
        "Cardo",
        "Carter One",
        "Caudex",
        "Cedarville+Cursive",
        "Cherry+Cream+Soda",
        "Chewy",
        "Coda",
        "Coming+Soon",
        "Copse",
        "Corben:700",
        "Cousine",
        "Covered+By+Your+Grace",
        "Crafty+Girls",
        "Crimson+Text",
        "Crushed",
        "Cuprum",
        "Damion",
        "Dancing+Script",
        "Dawning+of+a+New+Day",
        "Didact+Gothic",
        "Droid+Sans",
        "Droid+Sans+Mono",
        "Droid+Serif",
        "EB+Garamond",
        "Expletus+Sans",
        "Fontdiner+Swanky",
        "Forum",
        "Francois+One",
        "Geo",
        "Give+You+Glory",
        "Goblin+One",
        "Goudy+Bookletter+1911",
        "Gravitas+One",
        "Gruppo",
        "Hammersmith+One",
        "Holtwood+One+SC",
        "Homemade+Apple",
        "Inconsolata",
        "Indie+Flower",
        "IM+Fell+DW+Pica",
        "IM+Fell+DW+Pica+SC",
        "IM+Fell+Double+Pica",
        "IM+Fell+Double+Pica+SC",
        "IM+Fell+English",
        "IM+Fell+English+SC",
        "IM+Fell+French+Canon",
        "IM+Fell+French+Canon+SC",
        "IM+Fell+Great+Primer",
        "IM+Fell+Great+Primer+SC",
        "Irish+Grover",
        "Irish+Growler",
        "Istok+Web",
        "Josefin+Sans",
        "Josefin+Slab",
        "Judson",
        "Jura",
        "Jura:500",
        "Jura:600",
        "Just+Another+Hand",
        "Just+Me+Again+Down+Here",
        "Kameron",
        "Kenia",
        "Kranky",
        "Kreon",
        "Kristi",
        "La+Belle+Aurore",
        "Lato:100",
        "Lato:100italic",
        "Lato:300", 
        "Lato",
        "Lato:bold",  
        "Lato:900",
        "League+Script",
        "Lekton",  
        "Limelight",  
        "Lobster",
        "Lobster Two",
        "Lora",
        "Love+Ya+Like+A+Sister",
        "Loved+by+the+King",
        "Luckiest+Guy",
        "Maiden+Orange",
        "Mako",
        "Maven+Pro",
        "Maven+Pro:500",
        "Maven+Pro:700",
        "Maven+Pro:900",
        "Meddon",
        "MedievalSharp",
        "Megrim",
        "Merriweather",
        "Metrophobic",
        "Michroma",
        "Miltonian Tattoo",
        "Miltonian",
        "Modern Antiqua",
        "Monofett",
        "Molengo",
        "Mountains of Christmas",
        "Muli:300", 
        "Muli", 
        "Neucha",
        "Neuton",
        "News+Cycle",
        "Nixie+One",
        "Nobile",
        "Nova+Cut",
        "Nova+Flat",
        "Nova+Mono",
        "Nova+Oval",
        "Nova+Round",
        "Nova+Script",
        "Nova+Slim",
        "Nova+Square",
        "Nunito:light",
        "Nunito",
        "OFL+Sorts+Mill+Goudy+TT",
        "Old+Standard+TT",
        "Open+Sans:300",
        "Open+Sans",
        "Open+Sans:600",
        "Open+Sans:800",
        "Open+Sans+Condensed:300",
        "Orbitron",
        "Orbitron:500",
        "Orbitron:700",
        "Orbitron:900",
        "Oswald",
        "Over+the+Rainbow",
        "Reenie+Beanie",
        "Pacifico",
        "Patrick+Hand",
        "Paytone+One", 
        "Permanent+Marker",
        "Philosopher",
        "Play",
        "Playfair+Display",
        "Podkova",
        "PT+Sans",
        "PT+Sans+Narrow",
        "PT+Sans+Narrow:regular,bold",
        "PT+Serif",
        "PT+Serif Caption",
        "Puritan",
        "Quattrocento",
        "Quattrocento+Sans",
        "Radley",
        "Raleway:100",
        "Redressed",
        "Rock+Salt",
        "Rokkitt",
        "Ruslan+Display",
        "Schoolbell",
        "Shadows+Into+Light",
        "Shanti",
        "Sigmar+One",
        "Six+Caps",
        "Slackey",
        "Smythe",
        "Sniglet:800",
        "Special+Elite",
        "Stardos+Stencil",
        "Sue+Ellen+Francisco",
        "Sunshiney",
        "Swanky+and+Moo+Moo",
        "Syncopate",
        "Tangerine",
        "Tenor+Sans",
        "Terminal+Dosis+Light",
        "The+Girl+Next+Door",
        "Tinos",
        "Ubuntu",
        "Ultra",
        "Unkempt",
        "UnifrakturCook:bold",
        "UnifrakturMaguntia",
        "Varela",
        "Varela Round",
        "Vibur",
        "Vollkorn",
        "VT323",
        "Waiting+for+the+Sunrise",
        "Wallpoet",
        "Walter+Turncoat",
        "Wire+One",
        "Yanone+Kaffeesatz",
        "Yanone+Kaffeesatz:300",
        "Yanone+Kaffeesatz:400",
        "Yanone+Kaffeesatz:700",
        "Yeseva+One",
        "Zeyada"
    ]
    });


// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//
// $("#education_dropdown").change(function() {
//     $("select option").prop("disabled", false);
// )};
    let oldFeaturedImg;
    let isNewImg = true;
    let isImageAvailable = false;
    var loadFile = function(event) {
        //changed output to featured-image-previewimg
        var image = document.getElementById('featured-image-previewimg');
        image.src = URL.createObjectURL(event.target.files[0]);
      
        if (typeof image != 'undefined'){
            $('#middle').css('opacity','0');
            $('#middle').css('opacity','0');
            $('#middleText').text("Upload Featured Image");
            $('#edit_uploaded_image').css('display','block');
            $('#featured-image-previewimg').css('display','block');
            isImageAvailable = true;
        }
      

        if(oldFeaturedImg != image.src){
            oldFeaturedImg = image.src;
            isNewImg = true;
        }
        
    };


    $(".fa-image").on({
         mouseenter: function () {
            $('.fa-image span').css('display', 'block');
        },
        mouseleave: function () {
            $('.fa-image span').css('display', 'none');
            }

    });


   
</script>


@endsection