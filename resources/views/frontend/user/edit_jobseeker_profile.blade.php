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
        .fa-edit-span{
            display:none;
            font-size: 1rem;
            width: 7.5vw;
            padding: 10%;
            text-align: center;
            border-radius: 7%;
            font-family: Nasalization;
            transform: translate(-17%, -333%);
            background-color: rgb(23, 162, 184);
            color: white;
        }
        .vertical-alignment-helper {
            display:table;
            height: 100%;
            width: 100%;
            pointer-events:none;}

            .vertical-align-center {
            /* To center vertically */
            display: table-cell !important;
            vertical-align: middle;
            pointer-events:none;}

            .modal-content {
            /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
            width:inherit;
            max-width:inherit; /* For Bootstrap 4 - to avoid the modal window stretching 
            full width */
            height:inherit;
            /* To center horizontally */
            margin: 0 auto;
            pointer-events:all;}

    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('front/CSS/cropper.min.css') }}">

@endsection



@section('after-styles')

    {{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
    {{--<script src="{{asset('front/JS/fabric.min.js')}}"></script> --}}
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
   
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
   
    <script src="{{asset('front/JS/cropper.min.js')}}"></script>

@endsection


@section('content')
{{-- <h1>Testing</h1>     --}}
<div class="slider" id="slider">
    <h2 class="sidenav-heading"  onclick="openNav()">SETUP&nbsp;PROFILE</h2>
</div>
    <div id="page-content">
       
            <form action="" id="aboutme-form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="bg-div">
                    
                        <div class="featured-img" ></div>
                            <label for="file" id="featured-image-label">
                            
                            <!--changed id of img from outputImage to featured-image-previewimg-->
                            
                                <img src="{{ asset('storage/career/employee/'.$profile->featured_image) }}"  id="featured-image-previewimg"  alt="input image" style=" max-width:100%; max-height:100%;">
                            
                                <div class="middle" id="middle" style="background-color: black;">
                                    <div id="middleText">Update Featured Image</div>
                                </div>
                            
                            
                            </label>
                            {{-- <button type="button" class="" id="edit_uploaded_image" style="">Edit Image</button>  --}}

                            
                                <i id="edit_uploaded_image" class="far fa-image btn_pointer" style="color:#16aedc; display:block"> <span class="fa-edit-span">Edit photo</span></i>
                            
                            {{-- display: none;
                            right: 0;
                            top: -1vh;
                            position: absolute;
                            font-size: 2em;
                            border: none;
                            color: white;
                            padding: 12px 16px;
                            width: 5vw;
                            cursor: pointer; --}}
                        {{-- <button class="btn" id="edit_uploaded_image"> --}}

                        
                                <input id="file"  onchange="loadFile(event)"  type="file"  name="featured_image" value="{{ $profile->featured_image ?? '' }}"  style=" min-width:100%;min-height: 100%;">
                            
                                
                    </div>
                {{-- --------------------------------------------------------------------- --}}
                <div class="modal" id="AboutMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered  modal-lg vertical-align-center" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">About Me</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        
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
                                                    <textarea type="text" class="form-control" name="objective" id="objective" maxlength="250">{{ $profile->objective }}</textarea>
                                                </div>
                                                <br/><br/>
                                                {{-- <div class="form-group col-md-12 input-group-sm">
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Add Current Address
                                                </button>
                                                </div>
                                                <br>  <br> --}}
                                                {{-- <div class="collapse" id="collapseExample"> --}}
                                                        <div class="form-group col-md-12 input-group-sm ">
                                                            <label for="country">Present Country</label>
                                                            <select class="countries form-control" name="present_country" id="countryId" required>&#x25BC;
                                                                {{-- <option value="">Select</option> --}}
                                                                <option value="{{ $profile->present_country ?? '' }}">{{ $profile->present_country }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="state">Present State</label>
                                                            <select id="stateId" class="states form-control" name="state" required>
                                                                {{-- <option value="">Select State</option> --}}
                                                                <option value="{{ $profile->state ?? '' }}" >{{ $profile->state }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="city">Present City</label>
                                                            <select id="cityId" class="cities form-control" name="present_city" required>
                                                                {{-- <option value="">Select City</option> --}}
                                                                <option value="{{ $profile->present_city ?? '' }}" >{{ $profile->present_city }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="pAddress">Present Address</label>
                                                            <input type="text" class="form-control" value="{{ $profile->present_address ?? '' }}" name="present_address" id="pAddress" >
                                                        </div>
                                                {{-- </div> --}}
                                                
                                                {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                                                
                                                </div>    

                                                <input type="hidden" name="edited_featured_image" id="edited_featured_image">
                                            
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit"  class="btn btn-primary aboutme-done" value="Update"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <div id="mySidenav" class="sidenav">
                <div class="navbar-tabs">
                   {{-- <h3 class="heading_setup">Edit Profile</h3>
                     <a href="" class="AboutMeTab" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
                    <a href="" class="tab" id="professionTab"  data-toggle="modal" data-target="#ProfessionSkillModal">Profession And Skills</a>
                    <a href="" class="tab" id="educationTab" data-toggle="modal" data-target="#EducationModal">Education</a>
                    <div class="slider-close-button">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a>
                    </div>
                    <a href="" class="tab" id="workExperienceTab" data-toggle="modal" data-target="#WorkExperienceModal">Work Experience</a>
                    <a href="" class="tab" id="contactTab" data-toggle="modal" data-target="#ContactModal">Contact</a>
                    <a href="" class="tab" id="characterRefTab" data-toggle="modal" data-target="#CharacterReferencesModal" style="border-bottom: 1px solid gray">Character References</a>
                    <hr style="background-color:white; ">
                    <a href="{{ url('jobseekers/view-profile/'.Auth::user()->id)}}" class="view-car-profile" style="color: rgb(22, 174, 220);text-align:center;">Go To My<br> Jobseeker Profile</a> --}}
                     <h3 class="heading_setup">Edit Profile</h3>
                    <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
                    <a href="" class="profession" data-toggle="modal" data-target="#ProfessionSkillModal">Profession And Skills</a>
                    <a href="" class="education" data-toggle="modal" data-target="#EducationModal">Education</a>
                    <div class="slider-close-button">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav();">&#8810;</a>
                    </div>
                    <a href="" class="work-experience" data-toggle="modal" data-target="#WorkExperienceModal">Work Experience</a>
                    <a href="" class="contacts" data-toggle="modal" data-target="#ContactModal">Contact</a>
                    <a href="" class="reference" data-toggle="modal" data-target="#CharacterReferencesModal" style="border-bottom: 1px solid gray">Character References</a>
                    
                    <a href="{{ url('jobseekers/view-profile/'.Auth::user()->id)}}" class="view-car-profile" style="color: rgb(22, 174, 220);text-align:center;">Go To My<br> Jobseeker Profile</a>
                </div>
                {{-- <h3 class="heading_setup">Edit Profile</h3>
                <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
                <a href="" class="profession" data-toggle="modal" data-target="#ProfessionSkillModal">Profession And Skills</a>
                <a href="" class="education" data-toggle="modal" data-target="#EducationModal">Education</a>
                <div class="slider-close-button">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a>
                </div>
                <a href="" class="work-experience" data-toggle="modal" data-target="#WorkExperienceModal">Work Experience</a>
                <a href="" class="contacts" data-toggle="modal" data-target="#ContactModal">Contact</a>
                <a href="" class="reference" data-toggle="modal" data-target="#CharacterReferencesModal">Character References</a> --}}
            
                
            </div>
            
            <form method="POST" action="" id="profession-form" enctype="multipart/form-data">
                @csrf
              
                <div class="modal" id="ProfessionSkillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                  {{-- <div class="profession_form-block">  --}}

                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered  modal-lg vertical-align-center" role="document">
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
                                        {{-- <form method="POST" action="" id="profession-form" enctype="multipart/form-data">
                                            @csrf --}}
                                        <fieldset>
                                        
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 input-group-sm">
                                                    <label for="Profession">Profession<span style="color:red">*</span></label>
                                                    <select id="Profession" class="form-control" name="profession_id" required>&#x25BC;
                                                            <option value="public" selected disabled>Select</option>
                                                            @foreach($profession as $profession)
                                                            <option value="{{$profession->id}}"{{$profile->profession_id == $profession->id  ? 'selected' : ''}}>{{$profession->profession_name}}</option>
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
                                                    <textarea  id="skills"  name="skills">{{ $profile->skills ?? '' }}</textarea>
                                                </div>  
                                                </div>
                                        
                                        </fieldset>
                                    </div>  
                        
                                </div><!--end of div-->  
                        
                
                                <div class="modal-footer">
                                <input type="submit"  class="btn btn-primary profession-done" value="Update" id="submit_profession"/>
                                </div>
                            </div><!-- end of modal content-->
                    </div> <!--end of modal dialog-->
           
                  </div>
                </div><!--end of profession modal-->
            </form>


            <form method="POST" action="" id="education-form" enctype="multipart/form-data">
                @csrf
                <div class="modal" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered modal-lg vertical-align-center" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Education</h5>
                                    <button type="button" class="close" data-dismiss="modal"   aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{-- <div class="app" style="display: none;">
                                
                                </div> --}}
                                @php 
                                    $educ_div_cnt=$educations->count(); 
                                @endphp
                                <div class="modal-body education-modal-body">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                    {{-- ---------------------------------------------------------------------------------- --}}
                                    @if ($educ_div_cnt < 1)
                                        <div class="education-body main_education_div div_0"> 
                                            <fieldset>
                                            
                                                <div style="position: relative;">
                                                    {{-- <button type="button"  class="close remove-btn-education" id="remove_educ_btn_{{$cnt}}" title="Remove Education " aria-label="Clone" onclick="remove(this)">
                                                        <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                    </button> --}}
                                                <button type="button" class="close remove-btn-education" title="Remove Education" id="remove_educ_btn_0" aria-label="Clone" onclick="remove_education(this);"> <span class="btn-remove" ><i class="fas fa-minus-circle"></i></span> </button>
                                                </div>
                                            
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 input-group-sm" id="education_dropdown_0">
                                                            <label for="education_level">Level Of  Education<span style="color:red">*</span></label>
                                                                <select class="form-control" name="education_level[]" id="educationLevel_0" required>
                                                                    <option value="Doctorate" > Doctorate</option>
                                                                    <option value="Master" >Master's Degree</option>
                                                                    <option value="Bachelor" >Bachelor's Degree</option>
                                                                    <option value="Associate" >Associate Degree</option>
                                                                    <option value="SomeCollege" >Some College</option>
                                                                    <option value="Vocational" >Vocational</option>
                                                                    <option value="HighSchool" >High School Graduate</option>    
                                                                </select>
                                                        </div> 
    
    
                                                        <input type="hidden" name="id[]" class="job_id" id="id_0" value="">
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="SchoolName">School Name<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="SchoolName_0" name="school_name[]" value=""  required>
                                                        </div>
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="FieldOfStudy">Field Of Study<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="FieldOfStudy_0"  name="field_of_study[]" value="" required>
                                                        </div>
                                                        <div class="form-group col-md-12 input-group-sm">
                                                            <label for="Description">Description<span style="color:red">*</span></label><br>
                                                            <textarea id="Description_0" name="description[]" required style="width:100%;resize:none;"> </textarea>
                                                        </div>
                                                        <div class="form-group col-md-4 input-group-sm">
                                                            <label for="StartDate" style="">Start Date<span style="color:red">*</span><span></span></label>
                                                            <input type="date" max="9999-12-31" min="1940-01-02" maxlength="" class="form-control" id="StartDate_0" placeholder="Date" value=""  name="start_date[]" required >
                                                        </div>
                                                        <div class="form-group col-md-4 input-group-sm">
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4 input-group-sm">
                                                            <label for="EndDate">End Date<span style="color:red">*</span></label>
                                                            <input type="date" max="9999-12-31" min="1940-01-02" maxlength="" class="form-control" id="EndDate_0" value="" name="end_date[]" required >
                                                            </div>
                                                        </div>
                                                    
                                                        <div style="position: relative;">
                                                            <button type="button"  class="close clone-btn-education"  title="Add More Education" aria-label="Clone">
                                                                <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                                            </button>
                                                        </div>
                                            </fieldset>
                                            
                                        
                                        </div>
                                    @else
                                    {{-- --------------------------------------------------------------------------------------- --}}
                                        @foreach($educations as $cnt=>$education){   
                                            <div class="education-body main_education_div div_{{$cnt}}"> 
                                                <fieldset>
                                                
                                                    <div style="position: relative;">
                                                        {{-- <button type="button"  class="close remove-btn-education" id="remove_educ_btn_{{$cnt}}" title="Remove Education " aria-label="Clone" onclick="remove(this)">
                                                            <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                        </button> --}}
                                                    <button type="button" class="close remove-btn-education" title="Remove Education" id="remove_educ_btn_{{ $cnt }}" aria-label="Clone" onclick="remove_education(this);"> <span class="btn-remove" ><i class="fas fa-minus-circle"></i></span> </button>
                                                    </div>
                                                
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 input-group-sm" id="education_dropdown_{{$cnt}}">
                                                                <label for="education_level">Level Of  Education<span style="color:red">*</span></label>
                                                                    <select class="form-control" name="education_level[]" id="educationLevel_{{$cnt}}" required>
                                                                        <option value="Doctorate" {{ ( $education->education_level == "Doctorate") ? 'selected' : '' }} > Doctorate</option>
                                                                        <option value="Master" {{ ( $education->education_level == "Master") ? 'selected' : '' }}>Master's Degree</option>
                                                                        <option value="Bachelor" {{ ( $education->education_level == "Bachelor") ? 'selected' : '' }}>Bachelor's Degree</option>
                                                                        <option value="Associate" {{ ( $education->education_level == "Associate") ? 'selected' : '' }}>Associate Degree</option>
                                                                        <option value="SomeCollege" {{ ( $education->education_level == "SomeCollege") ? 'selected' : '' }}>Some College</option>
                                                                        <option value="Vocational" {{ ( $education->education_level == "Vocational") ? 'selected' : '' }}>Vocational</option>
                                                                        <option value="HighSchool" {{ ( $education->education_level == "HighSchool") ? 'selected' : '' }}>High School Graduate</option>    
                                                                    </select>
                                                            </div> 
    
    
                                                            <input type="hidden" name="id[]" class="job_id" id="id_{{$cnt}}" value="{{ $education->id ?? '' }}">
                                                            <div class="form-group col-md-12 input-group-sm">
                                                                <label for="SchoolName">School Name<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" id="SchoolName_{{$cnt}}" name="school_name[]" value="{{ $education->school_name ?? '' }}"  required>
                                                            </div>
                                                            <div class="form-group col-md-12 input-group-sm">
                                                                <label for="FieldOfStudy">Field Of Study<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" id="FieldOfStudy_{{$cnt}}"  name="field_of_study[]" value="{{ $education->field_of_study ?? '' }}" required>
                                                            </div>
                                                            <div class="form-group col-md-12 input-group-sm">
                                                                <label for="Description">Description<span style="color:red">*</span></label><br>
                                                                <textarea id="Description_{{$cnt}}" name="description[]" required style="width:100%;resize:none;"> {{ $education->description ?? '' }}</textarea>
                                                            </div>
                                                            <div class="form-group col-md-4 input-group-sm">
                                                                <label for="StartDate" style="">Start Date<span style="color:red">*</span><span></span></label>
                                                                <input type="date" max="9999-12-31" min="1940-01-02" maxlength="" class="form-control" id="StartDate_{{$cnt}}" placeholder="Date" value="{{ strftime('%Y-%m-%d',strtotime($education['start_date'])) }}"  name="start_date[]" required >
                                                            </div>
                                                            <div class="form-group col-md-4 input-group-sm">
                                                                
                                                            </div>
                                                            <div class="form-group col-md-4 input-group-sm">
                                                                <label for="EndDate">End Date<span style="color:red">*</span></label>
                                                                <input type="date" max="9999-12-31" min="1940-01-02" maxlength="" class="form-control" id="EndDate_{{$cnt}}" value="{{ strftime('%Y-%m-%d',strtotime($education['end_date'])) }}" name="end_date[]" required >
                                                                </div>
                                                            </div>
                                                        
                                                            <div style="position: relative;">
                                                                <button type="button"  class="close clone-btn-education"  title="Add More Education" aria-label="Clone">
                                                                    <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                                                </button>
                                                            </div>
                                                </fieldset>
                                            </div>
                                        
                                        }
                                        @endforeach
                                    @endif
                                </div>
                            
                        
                                <div class="education-clone"></div>
                                <div class="modal-footer">
                                    <input type="submit"  class="btn btn-primary education-done" value="Update" id="submit_education"/>
                                </div>
                            </div><!--end of content modal-->
                    </div><!--end of dialog-->
               
           
                    </div><!--end of vertical align helper-->
                </div>
            </form>


            <form method="POST" action="" id="work-experience-form"  enctype="multipart/form-data">
                @csrf
                 <div class="modal" id="WorkExperienceModal"  class="WorkExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered  modal-lg vertical-align-center" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Work Experiences</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @php 
                                    $work_div_cnt=$workExperience->count(); 
                                @endphp
                                {{-- <div class="app" style="display: none;">
                                </div> --}}
                                <div class="modal-body work-modal-body">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                    {{-- --------------------------------------------------------------------------------------------- ---------}}
                                    @if ($work_div_cnt < 1)
                                        <div class="work-experience-body main_work_experience_div div_0">
                                            <fieldset>
                                            
                                                <div style="position: relative;">
                                                    <button type="button"  class="close remove-btn-workexperience" id="remove_work_btn_0"  title="Remove Work Experience "aria-label="Clone" onclick="remove_work_experience(this)">
                                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id[]" class="work_id" id="id_0" value="">
                                                    <div class="form-row">
                                                        
                                                        <div class="form-group col-md-6 input-group-sm">
                                                        <label for="StartDate">Start Date<span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" id="StartDate_0"  value="" name="start_date[]" >
                                                        </div>
                                                        <div class="form-group col-md-6 input-group-sm">
                                                        <label for="EndDate">End Date<span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" value="" id="EndDate_0" name="end_date[]" >
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="CompName">Company Name<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="company_name_0" name="company_name[]" value="" placeholder="">
                                                        </div>
                                                        <div class="form-group input-group-sm">
                                                            <label for="Address">Company Address<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="Address_0" name="address[]" value="" placeholder="">
                                                        </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="CompRole">Role<span style="color:red">*</span></label>
                                                        <textarea type="text" class="form-control" id="CompRole_0" name="role[]"  placeholder=""></textarea>
                                                    </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="CompDesig">Designation<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="CompDesig_0" name="designation[]" value="" placeholder="">
                                                    </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="Contact">Contact<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="Contact_0" name="contact_no[]" value="" placeholder="">
                                                    </div>
                                                    
                                                    <div style="position: relative;">
                                                        <button type="button"  class="close clone-btn-workexperience"  title="Add More Work Experience " aria-label="Clone">
                                                            <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                                        </button>
                                                    </div>
                                            </fieldset><br>
                                        </div>
                                    @else
                                    {{-- ---------------------------------------------------------------------------------------------------- --}}
                                    @foreach($workExperience as $cnt=>$workExperience){ 
                                        <div class="work-experience-body main_work_experience_div div_{{$cnt}}">
                                            <fieldset>
                                            
                                                <div style="position: relative;">
                                                    <button type="button"  class="close remove-btn-workexperience" id="remove_work_btn_{{ $cnt }}"  title="Remove Work Experience "aria-label="Clone" onclick="remove_work_experience(this)">
                                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="id[]" class="work_id" id="id_{{$cnt}}" value="{{ $workExperience->id ?? '' }}">
                                                    <div class="form-row">
                                                        
                                                        <div class="form-group col-md-6 input-group-sm">
                                                        <label for="StartDate">Start Date<span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" id="StartDate_{{$cnt}}"  value="{{ strftime('%Y-%m-%d',strtotime($workExperience['start_date'])) }}" name="start_date[]" >
                                                        </div>
                                                        <div class="form-group col-md-6 input-group-sm">
                                                        <label for="EndDate">End Date<span style="color:red">*</span></label>
                                                        <input type="date" class="form-control" value="{{ strftime('%Y-%m-%d',strtotime($workExperience['end_date'])) }}" id="EndDate_{{$cnt}}" name="end_date[]" >
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="CompName">Company Name<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="company_name_{{$cnt}}" name="company_name[]" value="{{ $workExperience->company_name ?? '' }}" placeholder="">
                                                        </div>
                                                        <div class="form-group input-group-sm">
                                                            <label for="Address">Company Address<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="Address_{{$cnt}}" name="address[]" value="{{ $workExperience->address ?? '' }}" placeholder="">
                                                        </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="CompRole">Role<span style="color:red">*</span></label>
                                                        <textarea type="text" class="form-control" id="CompRole_{{$cnt}}" name="role[]"  placeholder="">{{ $workExperience->role ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="CompDesig">Designation<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="CompDesig_{{$cnt}}" name="designation[]" value="{{ $workExperience->designation ?? '' }}" placeholder="">
                                                    </div>
                                                    <div class="form-group input-group-sm">
                                                        <label for="Contact">Contact<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" id="Contact_{{$cnt}}" name="contact_no[]" value="{{ $workExperience->contact_no ?? '' }}" placeholder="">
                                                    </div>
                                                    
                                                    <div style="position: relative;">
                                                        <button type="button"  class="close clone-btn-workexperience"  title="Add More Work Experience " aria-label="Clone">
                                                            <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                                        </button>
                                                    </div>
                                            </fieldset><br>
                                        </div>
                                    }
                                    @endforeach
                                @endif
                                </div> <!--end of body-->
                                <div class="work_experience-clone"></div>
                                <div class="modal-footer">
                                    <input type="submit"  class="btn btn-primary work-experience-done" value="Update"/>
                                </div>
                            </div> 
                        </div>
                    </div><!--end of vertical align helper-->
               </div>
            </form>

            <form method="POST" action="" id="contact-form" enctype="multipart/form-data">
                @csrf
              <div class="modal" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered  modal-lg vertical-align-center" role="document">
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
                                                    <label for="sEmail">Secondary Email</label>
                                                    <input type="email" class="form-control" id="sEmail" value="{{ $profile->secondary_email ?? '' }}" name="secondary_email" >
                                                </div>
                                                <div class="form-group col-md-12 input-group-sm">
                                                    <label for="sMobNumber">Secondary  Mobile Number</label>
                                                    <input type="text" class="form-control" id="sMobNumber" value="{{ $profile->secondary_mobile_number ?? '' }}" name="secondary_mobile_number" >
                                                </div>
                                            </div>
                                        </fieldset>
                                        
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary contact-done">Update</button>
                                </div>
                            </div>
                        </div>
                </div>
              </div>
            </form> 

            <form method="POST" action="" id="reference-form"  enctype="multipart/form-data">
                @csrf
                  <div class="modal" id="CharacterReferencesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="vertical-alignment-helper">
                        <div class="modal-dialog modal-dialog-centered  modal-lg vertical-align-center" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Character References</h5>
                
                        
                
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        {{-- <div class="app" style="display: none;">
                          
                        </div> --}}
                        @php 
                        $refr_div_cnt=$characterRefrence->count(); 
                        @endphp
                
                        <div class="modal-body reference-modal-body">
                           <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                            @if($refr_div_cnt < 1)
                                <div class="reference-body  main_reference_div div_0">
                                    <fieldset> 
                                                <div style="position: relative;">
                                                    <button type="button"  class="close remove-btn-reference" id="remove_refr_btn_0" aria-label="Clone" title="Remove Character Reference" onclick="remove_reference(this)">
                                                        <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                    </button>
                                                </div>
                        
                                                <div class="form-group input-group-sm">
                                                    <label for="Name"> Name<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" value="" id="Name_0" name="name[]" placeholder="">
                                                </div>
                        
                                                <div class="form-group input-group-sm">
                                                    <label for="Email">Email<span style="color:red">*</span></label>
                                                    <input type="email" class="form-control" id="Email_0" value=""  name="email[]" placeholder="">
                                                </div>
                        
                                                <div class="form-group input-group-sm">
                                                    <label for="CompName">Company Name<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="CompName_0"  name="company_name[]" value="" placeholder="">
                                                </div>
                        
                                                <div class="form-group input-group-sm">
                                                    <label for="Designation">Designation<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="Designation_0"  name="designation[]" value="" placeholder="">
                                                </div>
                        
                                                <div style="position: relative;">
                                                    <button type="button"  class="close clone-btn-reference"  title="Add More Character Reference "aria-label="Clone">
                                                        <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                                    </button>
                                                </div>
                                    </fieldset><br>
                                </div>
                            @else
                                @foreach($characterRefrence as $cnt=>$characterRefrence){ 
                                        <div class="reference-body  main_reference_div div_{{$cnt}}">
                                                <fieldset> 
                                                        <div style="position: relative;">
                                                            <button type="button"  class="close remove-btn-reference" id="remove_refr_btn_{{ $cnt }}" aria-label="Clone" title="Remove Character Reference" onclick="remove_reference(this)">
                                                                <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                                            </button>
                                                        </div>
                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="Name"> Name<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" value="{{ $characterRefrence->name ?? '' }}" id="Name_{{$cnt}}" name="name[]" placeholder="">
                                                        </div>
                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="Email">Email<span style="color:red">*</span></label>
                                                            <input type="email" class="form-control" id="Email_{{$cnt}}" value="{{ $characterRefrence->email ?? '' }}"  name="email[]" placeholder="">
                                                        </div>
                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="CompName">Company Name<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="CompName_{{$cnt}}"  name="company_name[]" value="{{ $characterRefrence->company_name ?? '' }}" placeholder="">
                                                        </div>
                    
                                                        <div class="form-group input-group-sm">
                                                            <label for="Designation">Designation<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" id="Designation_{{$cnt}}"  name="designation[]" value="{{ $characterRefrence->designation ?? '' }}" placeholder="">
                                                        </div>
                    
                                                        <div style="position: relative;">
                                                            <button type="button"  class="close clone-btn-reference"  title="Add More Character Reference "aria-label="Clone">
                                                                <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                                            </button>
                                                        </div>
                                            </fieldset><br>
                                    </div>
                                }
                                @endforeach
                            @endif
                        </div> <!-- end of modal body -->
                        
                        <div class="reference-clone"></div>
                        <div class="modal-footer">
                            <input type="submit"  class="btn btn-primary characterRederences-done" value="Update" id="submit_reference"/>
                        </div>
                     </div><!--end of modal content-->
                    </div><!--end of modal dialog-->
                  </div>
                </div><!--end of modal-->
                {{-- </div>   --}}
                
                </form> 

           
              

            {{-- ---------------------------------------------------------------------------- --}}
             
        
    
            {{-- <button class="cancel-btn" type="button">Cancel</button>
            <button class="save-btn " type="button">Save</button> --}}
            <div class="jobseeker-title">
                <h1>EDIT JOBSEEKER PROFILE</h1>
            </div>

            

            {{-- <div class="slider" id="slider">
            </div> --}}
            {{-- <div class="sidenav-left">
            <!-- left controls -->
         
                {{-- <div id="main"> --}}
                    {{-- <span  class="arrows" style="font-size:17px;font-family:Nasalization;cursor:pointer" onclick="openNav()">S<br>E<br>T</span> --}}
                    {{-- <h2 class="sidenav-heading"  onclick="openNav()">EDIT&nbsp;PROFILE</h2> --}}
                {{-- </div> --}}
                {{-- </div>  --}}

            {{-- <div class="sidenav-right">
            <!-- right controls -->
            </div> --}}

        

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
<script src="{{ asset('front/JS/countrystatecity.js') }}"></script>
{{-- <script src="//geodata.solutions/includes/countrystatecity.js"></script> --}}



{{-- <script>
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
</script> --}}

<script>
    
    $(document).ready(function() {
        //hide the education section first div's remove button
        $(".education-body.main_education_div.div_0 #remove_educ_btn_0").hide();
        $(".work-experience-body.main_work_experience_div.div_0 #remove_work_btn_0").hide();
        $(".reference-body.main_reference_div.div_0 #remove_refr_btn_0").hide();
    });

    var url = $('meta[name="url"]').attr('content');
    var educ_div_count = "{{$educ_div_cnt}}";

    // ############################################## FUNCTIONS RELATED TO EDUCATION MODAL  ############################################## //

    //for the education clone button
    $('.clone-btn-education').click(function(e){
        e.preventDefault();

    
        var $form = $('form#education-form');
        var newel = $('.education-body:first').clone();  
        $(newel).insertAfter(".education-body:last");
        var new_ele = $('.education-body:last');
        new_ele.find('input').val("");
        new_ele.find('textarea').val("");
        var count = $(".education-body");
        
        //the first element copied has always div_0 class, remove this class and change class with current div count
        new_ele.removeClass('div_0')
        new_ele.addClass('div_'+(educ_div_count))


        //set new id of the newly added education fields
        $(".education-body.main_education_div.div_"+educ_div_count+" #SchoolName_0").attr('id','SchoolName_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #FieldOfStudy_0").attr('id','FieldOfStudy_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #Description_0").attr('id','Description_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #StartDate_0").attr('id','StartDate_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #EndDate_0").attr('id','EndDate_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #id_0").attr('id','id_'+(educ_div_count));
        $(".education-body.main_education_div.div_"+educ_div_count+" #educationLevel_0").attr('id','educationLevel_'+(educ_div_count));
        

        if(count.length>1){
            $(".education-body:last .clone-btn-education").hide();
            $(".education-body:last .remove-btn-education").show();
        }
        //focus the cursor on the newly added div
        $(".education-body:last #SchoolName_"+educ_div_count).focus().select();  

        //increase the count of education div count
        educ_div_count++;        
    }); //end of clone education form



    var err_message = {};                   //for holding the error messages
    function validate_education_fields(num){
        //flag for alerting error message
        var alert_status=false;
        
        //for each div in the  education modal
        for(var i=0;i<num;i++){

            //get the value of each input field from each div in the form
            var start_date = $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).val();
            var end_date = $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).val();
            var school_name = $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).val();
            var field_of_study = $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).val();
            var description = $(".education-body.main_education_div.div_"+i+" #Description_"+i).val();
        
            //check if the field is empty, if empty, show the input field in red and add the error message to the err_message var
            //used key-value pair so the values can easily be checked thru the key
            if(start_date == ""){
                alert_status = true;
                message = 'Start Date';
                err_message[message] = null;
                $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).css('border-color', 'red');
            }else{
                $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).css('border-color', 'white');
            }

            if(end_date==''){
                alert_status = true;
                message = 'End Date';
                err_message[message] = null;
                $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
            }else{
                $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'white');
            }

            if(school_name==''){
                alert_status = true;
                message = 'School Name';
                err_message[message] = null;
                $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).css('border-color', 'red');
            }else{
                $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).css('border-color', 'white');
            }

            if(field_of_study==''){
                alert_status = true;
                message = 'Field of Study';
                err_message[message] = null;
                $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).css('border-color', 'red');
            }else{
                $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).css('border-color', 'white');
            }

            if(description==''){
                alert_status = true;
                message = 'Description';
                err_message[message] = null;
                $(".education-body.main_education_div.div_"+i+" #Description_"+i).css('border-color', 'red');
            }else{
                $(".education-body.main_education_div.div_"+i+" #Description_"+i).css('border-color', 'white');
            }
            if ((Date.parse(end_date) <= Date.parse(start_date))) {
                    alert_status = true;
                     message = 'End Date should not be less than Start Date';
                     err_message[message] = null;
                     $("education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
            }
        }//end of for loop
        
        //if there's an error
        if(alert_status) {
            //convert the messages to string
            let errors = "The following fields are required: ";
            for (var k in err_message) {
               errors = errors + "<br/>" +k;
            }
          
            //fire errors in sweetalert
            Swal.fire({
                title: 'Error!',
                html: errors,
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
                    'Ok',
                cancelButtonText:
                    'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((res) => {
                if (res.value) {
                        // return false and empty the err_message var
                        err_message = {}; 
                        return false;
                }
            });
        }else{
            //no errors found
            return true;
        }

    }//end of validating in the frontend if the fields are with values
    

//when done is clicked from education modal, save ecucation form
    $('.education-done').click(function(e) {
        e.preventDefault();
        var form_url = url+'/update_education';
        var $form = $('form#education-form');
        var form_data = $('#education-form').serialize();
        var post_data = new FormData($form[0]);
        var count = $(".education-body");
        totalDiv=count.length;

        //validate the form
        var isValid = validate_education_fields(totalDiv);
    
        //if there are no errors in the form
        if(isValid){
            $.ajax({
                url: form_url,
                method: 'post', 
                data:post_data,
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
                        //clear the fields set with changed values
                        if(res){
                            // $('#EducationModal').modal('hide');
                            // $('#WorkExperienceModal').modal('show');
                            $('.modal-backdrop').remove();
                        }
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
            });//end of ajax
            
        } //end of if valid
        
    });   //end of education done button

      
   
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
        // $(".remove-btn-education").hide();
        // $(".remove-btn-workexperience").hide();
        // $(".remove-btn-reference").hide();
                
        // clone-btn-workexperience
        $('.clone-btn-workexperience').click(function(e) {
            e.preventDefault();
            
            var $form = $('form#work-experience-form');
            var newel = $('.work-experience-body:first').clone();
            $(newel).insertAfter(".work-experience-body:last");
            var new_ele = $('.work-experience-body:last');
            new_ele.find('input').val("");
            new_ele.find('textarea').val("");
            var count = $(".work-experience-body");
            new_ele.removeClass('div_0')
            new_ele.addClass('div_'+(work_div_count))
            // var count = $(".work-experience-body");
            //         new_ele.removeClass('workDiv_'+(count.length-1))
            //         new_ele.addClass('workDiv_'+count.length)
            //set new id of the newly added education fields
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #company_name_0").attr('id','company_name'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #Address_0").attr('id','Address'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #CompRole_0").attr('id','CompRole_'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #CompDesig_0").attr('id','CompDesig_'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #StartDate_0").attr('id','StartDate_'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #EndDate_0").attr('id','EndDate_'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #id_0").attr('id','id_'+(work_div_count));
            $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #educationLevel_0").attr('id','educationLevel_'+(work_div_count));
                  
                 if(count.length>1){
                    $(".work-experience-body:last .clone-btn-workexperience").hide();
                    $(".work-experience-body:last .remove-btn-workexperience").show();

                 }
        //    $(".work-experience-body:last #start_date").focus().select();
           $(".work-experience-body:last #company_name_"+work_div_count).focus().select();
           //increase the count of work div count
           work_div_count++;        
            }); //end of clone work form
            var err_message = {};                   //for holding the error messages
            function validate_workExperience_fields(num){
                //flag for alerting error message
                var alert_status=false;     
        //work experience save

        // $('.work-experience-done').click(function(e) {
        //     e.preventDefault();
        //     var form_url = url+'/save_work_experience';
        //     var $form = $('form#work-experience-form');
        //     var form_data = $('#work-experience-form').serialize();
        //     var post_data = new FormData($form[0]);
        //     var count = $(".work-experience-body");
        //     totalDiv=count.length;
        //     var alert_status;
        
            for(var i=0;i<num;i++){

                // console.log("here");
                // $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).val();
                var start_date = $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).val();
                var end_date = $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).val();
                var company_name = $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).val();
                var CompRole = $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).val();
                var CompDesig = $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).val();
                var Contact = $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).val();
                var Address = $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).val();

               

                // if(start_date==''){
                //     alert_status = true;
                //      message = 'Start Date is required';
                //      $("form#work-experience-form .workDiv_"+i+" #StartDate").focus();
                // }
                if(start_date == ""){
                    alert_status = true;
                    message = 'Start Date';
                    err_message[message] = null;
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).css('border-color', 'white');
                }
                 if(end_date==''){
                     alert_status = true;
                     message = 'End Date is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'white');
                }
                 if(company_name==''){
                     alert_status = true;
                     message = 'Company Name is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).css('border-color', 'white');
                }
                 if(CompRole==''){
                     alert_status = true;
                     message = 'Role is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).css('border-color', 'white');
                }
                 if(CompDesig==''){
                     alert_status = true;
                     message = 'Designation is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).css('border-color', 'white');
                }
                 if(Contact==''){
                     alert_status = true;
                     message = 'Contact is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).css('border-color', 'white');
                }
                 if(Address==''){
                     alert_status = true;
                     message = 'Address is required';
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).css('border-color', 'red');
                }else{
                    $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).css('border-color', 'white');
                }
                if ((Date.parse(end_date) <= Date.parse(start_date))) {
                    alert_status = true;
                     message = 'End Date should not be less than Start Date';
                     err_message[message] = null;
                     $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
                }
            }   //end for loop
          
   //if there's an error
   if(alert_status) {
            //convert the messages to string
            let errors = "The following fields are required: ";
            for (var k in err_message) {
               errors = errors + "<br/>" +k;
            }
          
            //fire errors in sweetalert
            Swal.fire({
                title: 'Error!',
                html: errors,
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
                    'Ok',
                cancelButtonText:
                    'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((res) => {
                if (res.value) {
                        // return false and empty the err_message var
                        err_message = {}; 
                        return false;
                }
            });
        }else{
            //no errors found
            return true;
        }

    }//end of validating in the frontend if the fields are with values
    
   
   
   
    $('.work-experience-done').click(function(e) {
        e.preventDefault();
        var form_url = url+'/update_work-experience';
        var $form = $('form#work-experience-form');
        var form_data = $('#work-experience-form').serialize();                           
        var post_data = new FormData($form[0]);
        var count = $(".work-experience-body");
        totalDiv=count.length;

        //validate the form
        var isValid = validate_workExperience_fields(totalDiv);
    
        //if there are no errors in the form
        if(isValid){
            $.ajax({
                url: form_url,
                method: 'post', 
                data:post_data,
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
                        //clear the fields set with changed values
                        if(res){
                            // $('#WorkExperienceModal').modal('hide');
                            // $('#ContactModal').modal('show');
                            $('.modal-backdrop').remove();
                        }
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
            });//end of ajax
            
        } //end of if valid
        
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
 
       


        // clone-btn-character reference
        $('.clone-btn-reference').click(function(e) {
            e.preventDefault();
            var $form = $('form#reference-form');
            var newel = $('.reference-body:first').clone();
            $(newel).insertAfter(".reference-body:last");
            var new_ele = $('.reference-body:last');
            new_ele.find('input').val("");
            var count = $(".reference-body");
            new_ele.removeClass('div_0')
            new_ele.addClass('div_'+(refr_div_count))

            $(".reference-body.main_reference_div.div_"+refr_div_count+" #Name_0").attr('id','Name'+(refr_div_count));
            $(".reference-body.main_reference_div.div_"+refr_div_count+" #Email_0").attr('id','Email'+(refr_div_count));
            $(".reference-body.main_reference_div.div_"+refr_div_count+" #CompName_0").attr('id','CompName'+(refr_div_count));
            $(".reference-body.main_reference_div.div_"+refr_div_count+" #Designation_0").attr('id','Designation'+(refr_div_count));
                           
                           
            if(count.length>1){
            $(".reference-body:last .clone-btn-reference").hide();
            $(".reference-body:last .remove-btn-reference").show();
            }
            $(".reference-body:last #Name"+refr_div_count).focus().select();
            refr_div_count++;    
                        
        });
        var err_message = {};                   //for holding the error messages
        function validate_Reference_fields(num){
        //flag for alerting error message
        var alert_status=false;
        for(var i=0;i<num;i++){

            // console.log("here");
            // $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).val()
            var Name = $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).val();
            var Email = $("reference-body.main_reference_div.div_"+i+" #Email"+i).val();
            var CompName = $("reference-body.main_reference_div.div_"+i+" #CompName"+i).val();
            var Designation = $("reference-body.main_reference_div.div_"+i+" #Designation"+i).val();


            // if(Name==''){
            //     alert_status = true;
            //     message = 'Name is required';
            //     $("form#reference-form .referenceDiv_"+i+" #Name").focus();
            // }
            if(Name == ""){
                    alert_status = true;
                    message = 'Name is required';
                    $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).css('border-color', 'red');
            }else{
                    $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).css('border-color', 'white');
            }
            if(Email==''){
                alert_status = true;
                message = 'Email is required';
                $(".reference-body.main_reference_div.div_"+i+" #Email"+i).css('border-color', 'red');
            }else{
                    $(".reference-body.main_reference_div.div_"+i+" #Email"+i).css('border-color', 'white');
            }
            if(CompName==''){
                alert_status = true;
                message = 'Company Name is required';
                $(".reference-body.main_reference_div.div_"+i+" #CompName"+i).css('border-color', 'red');
            }else{
                    $(".reference-body.main_reference_div.div_"+i+" #CompName"+i).css('border-color', 'white');
            }
            if(Designation==''){
                alert_status = true;
                message = 'Designation is required';
                $(".reference-body.main_reference_div.div_"+i+" #Designation"+i).css('border-color', 'red');
            }else{
                    $(".reference-body.main_reference_div.div_"+i+" #Designation"+i).css('border-color', 'white');
            }

        } //end for loop

        //if there's an error
   if(alert_status) {
            //convert the messages to string
            let errors = "The following fields are required: ";
            for (var k in err_message) {
               errors = errors + "<br/>" +k;
            }
          
            //fire errors in sweetalert
            Swal.fire({
                title: 'Error!',
                html: errors,
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
                    'Ok',
                cancelButtonText:
                    'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((res) => {
                if (res.value) {
                        // return false and empty the err_message var
                        err_message = {}; 
                        return false;
                }
            });
        }else{
            //no errors found
            return true;
        }

    }//end of validating in the frontend if the fields are with values

               

        //Character reference save
        $('.characterRederences-done').click(function(e) {
            e.preventDefault();
        var form_url = url+'/update_character_reference';
        var $form = $('form#reference-form');
        var form_data = $('#reference-form').serialize();                           
        var post_data = new FormData($form[0]);
        var count = $(".reference-body");
        var id = {{ Auth::user()->id }};
        totalDiv=count.length;

        //validate the form
        var isValid = validate_Reference_fields(totalDiv);
    
        //if there are no errors in the form
        if(isValid){
            $.ajax({
                url: form_url,
                method: 'post', 
                data:post_data,
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
                        //clear the fields set with changed values
                        if(res){
                            window.location.href = url+'/jobseekers/view-profile/'+ id;
                        }
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
            });//end of ajax
            
        } //end of if valid
        
    });   

        //conatct details save
        $('.contact-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_contact_details';
            var $form = $('form#contact-form');
            var post_data = new FormData($form[0]);
            var alert_status;
                    // var secondary_email = $("form#contact-form #sEmail").val();
                    // var secondary_mobNumber = $("form#contact-form #sMobNumber").val();
                
                    // if(secondary_email==''){
                    //     alert_status = true;
                    //     message = 'Secondary Email is required';
                    //     $("form#contact-form  #sEmail").focus();
                    // }
                    // if(secondary_mobNumber==''){
                    //     alert_status = true;
                    //     message = 'Secondary Mobile Number is required';
                    //     $("form#contact-form  #sEmail").focus();
                    // }
                    if(alert_status) {
                    Swal.fire({
                        title: 'Discard Changes',
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
                        // $('#ContactModal').modal('hide');
                        // $('#CharacterReferencesModal').modal('show');
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
                    var form_url = url+'/update_aboutme_details';
                    // alert(form_url);
                    // var feature_image = $("#file").val();
                    // alert(feature_image);
                    // return false;
                    var $form = $('form#aboutme-form');
                    var post_data = new FormData($form[0]);
                    // post_data.append('featured_image', feature_image);
                    var alert_status;
                    var present_address = $("form#aboutme-form #pAddress").val();
                    
                    // alert(feature_image);
                    // return false;
                    if(present_address==''){
                        alert_status = true;
                        message = 'Present address is required';
                        $("form#aboutme-form  #pAddress").focus();
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
                                    // $('#AboutMeModal').modal('hide');
                                    $('.modal-backdrop').remove();
                                    // $('#ProfessionSkillModal').show();
                                    // $("#ProfessionSkillModal").modal('show');
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
                                        // $('#ProfessionSkillModal').modal('hide');
                                        // $('#EducationModal').modal('show');
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
       
    
             

    // });//end of document ready function


            function openNav(){  
                document.getElementById("mySidenav").style.width = "14vw";
                document.getElementById("slider").style.display = "none";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav(){
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
            }
            
            function remove_education(e){

                $(e).closest('.education-body').remove();
                //get the id from the id field of this div being removed
                let educId = $(e).parent().find('.job_id').val();
                
                //decrease the div count
                // educ_div_count--;
                // remove_fetched_fields('education',educId);
                
            }

            function remove_work_experience(){
                $().closest('.work-experience-body').remove();
            }

            function remove_reference(){
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
    // let isImageAvailable = false;
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
            // isImageAvailable = true;
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