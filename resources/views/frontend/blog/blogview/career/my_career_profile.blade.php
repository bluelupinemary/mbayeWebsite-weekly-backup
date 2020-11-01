@extends('frontend.layouts.profile_layout')

@section('before-styles')


<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">

{{-- <link rel="stylesheet" href="{{ asset('front/CSS/single_blog.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('front/CSS/my_career_profile.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog-responsive.css') }}">
@endsection


@section('after-styles')
{{-- @trixassets --}}
@endsection

@section('content')
<div id="page-content">
    
      <input type="hidden" id="profile_id_input" name="profile_id_input" value="{{$profile->id}}">
      <input type="hidden" id="profile_user_id_input" name="profile_user_id_input" value="{{$profile->user_id}}">
    
    <div class="app">
        <div class="jobseeker-title">
            <h1>JOBSEEKER PROFILE</h1>
        </div>
            
            <div class="bg-div">
                
                    <div class="objective" style="text-align: center;color:white; position: relative; display:none; height:30%;">
                        
                        <p style="font-size: calc(1vw + 7px);">{{ $profile->objective }}</p>
                    </div>
                    
                    
                    <div class="featured-img" >
                        <img src="{{ asset('storage/career/employee/'.$profile->featured_image) }}"  id="featured-image-previewimg"  alt="input image" style=" max-width:100%; max-height:100%;">
                           
                        {{-- </label> --}}
                    </div>
                    
                    @if(Auth::id() != $profile->user_id)
                        
                            <div class="view-profile-button">
                               
                                <button class="more-icon tooltips-buttons top" onclick="view_my_career_posts2({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt="">
                                    <span id="details-text">View Details</span>
                                </button>
                                
                            </div>
                            <div class="planet-buttons">
                                
                                <button class="view tooltips top" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt="">
                                    <span class="">View Dashboard</span>
                                </button>
                                <button class="save tooltips top"><img src="{{asset('front/icons/save.png')}}" alt="">
                                    <span class="">Save Profile</span>
                                </button>
                                <button class="call tooltips top" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/call.png')}}" alt="">
                                    <span class="">Contact</span>
                                </button>
                                <button class="messenger tooltips top" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/messengerIcon.png')}}" alt="message-icon">
                                    <span class="">Chat</span>
                                </button>
                            </div>
                    @else
                        <div class="edit-buttons">
                            <button class="edit tooltips top" onclick="edit_profile();"><i class="fas fa-edit"  style="font-size:2em; color:#c5a739;"></i><span class="">Edit My Profile</span></button>
                            
                        </div>
                        <div class="view-profile-button" >
                        
                            <button class="more-icon tooltips-buttons top" onclick="view_my_career_posts2({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt="">
                                <span id="details-text">View Detail</span>
                            </button>
                            
                        </div>
                    @endif
                    
            </div>
        
        {{-- <button class="test" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button> --}}
        
{{--</div>--}}
     {{-- @if(Auth::user()->id != $profile->user_id)
     <div class="view-profile-button">
        
        <button class="more-icon" onclick="view_my_career_posts2({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt=""></button>
        
    </div>
        <div class="planet-buttons">
            
            <button class="view" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
            <button class="save" data-tag="careers"><img src="{{asset('front/icons/save.png')}}" alt=""></button>
            <button class="call" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/call.png')}}" alt=""></button>
            <button class="messenger" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/messengerIcon.png')}}" alt="message-icon"></button>
            
        </div>
        @endif --}}
    </div>
    
    {{-- @if(Auth::user()->id == $profile->user_id)
    <div class="edit-buttons" style="left:53%;top:21%;">
        <button class="edit" onclick="edit_profile();"><i class="fas fa-edit"  style="font-size:1rem;font-size: calc(2vw + 1px ); color:#c5a739;"></i></button>
        
    </div>
    <div class="view-profile-button" >
        
        <button class="more-icon" onclick="view_my_career_posts2({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt=""></button>
        
    </div>
    @endif    --}}
   
    
    
    <div class="navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif" >
        @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
            <img src="{{ asset('front/images/astronut/thomasina-navigator.png') }}" alt="" class="astronaut-body">
            <div class="tos-div thomasina">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @else
            <img src="{{ asset('front/images/astronut/tom-navigator.png') }}" alt=""
            class="astronaut-body">
            <div class="tos-div">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @endif
        <div class="user-photo {{access()->user()->getGender()}}">
            <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
        </div>
        <button class="navigator-zoom navigator-zoomin tooltips zoom-in-out">
            <span>Zoom In</span>
            <i class="fas fa-search-plus"></i>
        </button>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
                <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
            </div>
        </div>
        <div class="instructions-div">
            <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
        </div>
        <div class="communicator-div tooltips top">
            <button class="communicator-button"></button>
            <span>Communicator</span>
        </div>
        <button class="navigator-zoomout-btn tooltips zoom-in-out">
            <span>Zoom Out</span>
            <i class="fas fa-undo-alt"></i>
        </button>
       
    </div>
    <div class="navigator-div-zoomed-in @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
       
        <div class="navigator-components">
            @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
                <img src="{{ asset('front/images/astronut/Thomasina_blog.png') }}" alt=""
                class="astronaut-body">
            @else
                <img src="{{url('front/images/astronut/tom_blog.png')}}" alt="" class="astronaut-body">
            @endif
            <div class="tos-div">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
            <div class="user-photo {{access()->user()->getGender()}}">
                <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
            </div>
            {{-- <button class="navigator-zoom navigator-zoomin"><i class="fas fa-search-plus"></i></button> --}}
            <div class="navigator-buttons">
                <div class="column column-1">
                    <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                    <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
                </div>
                <div class="column column-2">
                    <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
                </div>
                <div class="column column-3">
                    <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
                    <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
                </div>
            </div>
            <div class="instructions-div">
                <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
            </div>
            <div class="communicator-div tooltips top">
                <button class="communicator-button"></button>
                <span>Communicator</span>
            </div>
            <button class="navigator-zoomout-btn tooltips zoom-in-out">
                <span>Zoom Out</span>
                <i class="fas fa-undo-alt"></i>
            </button>
            
        </div>
    </div>
         
</div>
{{-- <div class="abc"> --}}
    <div class="about abc" id="aboutMeDetails">
        <div class="titile" style="position:relative;width:100%;text-align:center;">About me</div>
        {{-- <label class="titile">About Me</label><br> --}}
        <div class="sub-section">
        
                <label class="lbl_titile">Name : </label><span class="spn_value"> {{ $profile->user->first_name ?? '' }} &nbsp; {{ $profile->user->last_name ?? '' }} </span><br>
                <label class="lbl_titile">DOB : </label><span class="spn_value"> {{ $profile->user->dob ?? '' }} </span><br>
                <label class="lbl_titile">Address : </label> <span class="spn_value" > {{ $profile->user->address ?? '' }}</span>
        </div>
        <div data-toggle="modal" data-target="#AboutMeModal" style="position: relative;width: 100%;">
            <i class="fas fa-ellipsis-h" style="position:relative; float:right; right:5%;"></i>
        </div>
        
    </div>
{{-- </div> --}}
{{-- <div class="abc"> --}}
        <div class="education abc" id="educationDetails" style="">
            <div class="titile" style="position:relative;width:100%;text-align:center;">Education</div>
            @foreach($profile->education as $education)
                <div class="sub-section">
        
                    <label class="lbl_titile">{{ $education->education_level ?? '' }} :</label><br><span class="spn_value">{{ $education->school_name ?? '' }}</span>
                    {{-- <label class="lbl_titile">DOB : </label><span class="dob spn_value"></span>
                    <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span> --}}
                </div>
            
            @endforeach
            
        <div data-toggle="modal" data-target="#EducationModal" style="position: relative;width: 100%;">
            <i class="fas fa-ellipsis-h" style="position:relative; float:right; right:5%;"></i>
        </div>
        
            {{-- <div class="sub-section"></div> --}}
            {{-- <div style="position:relative;width:100%;padding-top:1%;">

            </div> --}}
            {{-- <label class="titile">Education</label><br> --}}
            {{--<label class="lbl_titile">Primary : </label><span class="primary_ed spn_value"></span><br>
            <label class="lbl_titile">Secondary : </label> <span class="secondary_ed spn_value"></span><br>
            <label class="lbl_titile">Undergraduate: </label> <span class="undergraduate_ed spn_value"></span><br>
            <label class="lbl_titile">Graduate: </label> <span class=" graduate_ed spn_value"></span><br>
            <label class="lbl_titile">Post-Graduate: </label> <span class=" postgraduate_ed spn_value"></span><br> --}}
        </div>
{{-- </div> --}}

{{-- <div class="abc"> --}}
    <div class="contacts abc" id="contactDetails" style="">
        <div class="titile" style="position:relative;width:100%;text-align:center;">Contact</div>
            <div class="sub-section">
                <span class="spn_value" style="padding-left: 2%;"> {{ $user->email ?? '' }} </span><br>
                <span class="spn_value" style="padding-left: 2%;"> {{ $profile->secondary_email ?? '' }} </span><br><br>
                <span class="spn_value" style="padding-left: 2%;"> {{ $user->mobile_number ?? '' }} </span><br>
                <span class="spn_value" style="padding-left: 2%;"> {{ $profile->secondary_mobile_number ?? '' }} </span>
                <div data-toggle="modal" data-target="#ContactModal" style="float: right;position: relative;width: 15%;top: 11%;left: 0;">
                    <i class="fas fa-ellipsis-h" ></i>
                </div>
            </div>    
        {{-- <span class="primary 3 spn_value"></span><br>
        <span class="secondary spn_value"></span><br> --}}
        
    </div>
{{-- </div><br/> --}}
{{-- <div class="abc"> --}}
    <div class="character_refernces abc" id="refrenceDetails" style="">
        <div class="titile" style="position:relative;width:100%;text-align:center;">Character Reference</div>
            @foreach($profile->charref as $refrence){
                <div class="sub-section">
        
                    <span class="spn_value">{{ $refrence->name ?? '' }}</span>
                    {{-- <label class="lbl_titile">DOB : </label><span class="dob spn_value"></span>
                    <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span> --}}
                </div>
            }
            @endforeach
            
        <div data-toggle="modal" data-target="#RefrenceModal" style="position: relative;width: 100%;">
            <i class="fas fa-ellipsis-h" style="position:relative; float:right; right:5%;"></i>
        </div>
        {{-- <div class="titile" style="position:relative;width:100%;text-align:center;">Character Reference</div> --}}
    </div>
{{-- </div> --}}

<div class="job_description" id="jobDetails" style="display:flex;flex-direction:column;padding:0 !important;">
    <div class="titile" style="position:relative;width:100%;text-align:center;">Work Experience</div>
        @foreach($profile->workexp as $workExperience)
            <div class="sub-section">
            <label class="lbl_titile">{{ \Carbon\Carbon::parse($workExperience->start_date)->format('F Y') }} - {{ \Carbon\Carbon::parse($workExperience->end_date)->format('F Y') }}</label><br>
                <span class="spn_valuee">{{ $workExperience->company_name ?? '' }}</span><br>
                <span class="spn_valuee">{{ $workExperience->designation ?? '' }}</span><br><br>
                <span class="spn_valuee">{{ $workExperience->role ?? '' }}</span>
                {{-- <label class="lbl_titile">DOB : </label><span class="dob spn_value"></span>
                <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span> --}}
            </div>
        <hr>
        @endforeach
    
    <div data-toggle="modal" data-target="#WorkModal" style="position: relative;width: 100%;">
        <i class="fas fa-ellipsis-h" style="position:relative; float:right; right:5%;"></i>
    </div>

</div>
 
{{-- -----------------------------------Modals------------------------------------------------------------------ --}}
<div class="modal" id="AboutMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#0f093c;border:none;">
          <h5 class="modal-title" id="exampleModalLongTitle" style="color: #efad0c;width:66vw;">About Me</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <div class="app" style="display: none;">;
          
        </div> --}}
        <div class="modal-body" style="background-color: rgb(5 26 57); height:50vh;overflow-y:scroll;">
            <div class="aboutme-body">
                <label class="lbl_title">Name : </label><span class="modal_spn_value"> {{ $profile->user->first_name ?? '' }} &nbsp;{{ $profile->user->last_name ?? '' }}</span><br/>
                <label class="lbl_title">Profession : </label><span class="modal_spn_value">{{$profile->profession->profession_name ?? ''}}</span><br/>
                <label class="lbl_title">DOB : </label><span class="modal_spn_value">{{$profile->user->dob ?? '' }}</span><br/>
                {{-- <label class="lbl_title">Address : </label> <span class="address spn_value" ></span><br/> --}}
                <label class="lbl_title">Age : </label> <span class="modal_spn_value" >{{ $profile->user->age ?? '' }}</span><br/>
                <label class="lbl_title">Gender : </label> <span class="modal_spn_value" >{{ $profile->user->gender ?? '' }}</span><br/>
                <label class="lbl_title">Present Address : </label> <span class="modal_spn_value" >{{ $profile->present_address ?? '' }}</span><br/>
                <div style="display: flex">
                    <div style="padding: 1%;width: 15vw;"><label class="lbl_title">Objective : </label></div>
                    <div>
                        <span class="modal_spn_value" style="text-align: justify-all" >{{ $profile->objective ?? '' }}</span><br/>
                    </div>

                </div>
                
                <label class="lbl_title">Skills : </label> <span class="modal_spn_value" >{{ $profile->skills ?? '' }}</span><br/>
                
                
            </div>
        </div>
        
      </div>
    </div>
    
  </div>

  <div class="modal" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header" style="background:#0f093c;border:none;">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #efad0c;width:66vw;">Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    {{-- <div class="app" style="display: none;">;
                    
                    </div> --}}
                    <div class="modal-body" style="background-color: rgb(5 26 57);height:50vh;overflow-y:scroll;">
                        
                        <div class="education-body">
                            @if(empty($profile->education))
                                <label class="lbl_title">Level of Education : </label><span class="modal_spn_value"></span><br/>
                                <label class="lbl_title">Field of Study : </label><span class="modal_spn_value"></span><br/>
                                <label class="lbl_title">School Name : </label><span class="modal_spn_value"></span><br/>
                                <label class="lbl_title">Year Attended : </label> <span class="modal_spn_value" ></span><br/>
                            @else
                                @foreach($profile->education as $education)
                                {{-- <h1>testing loop</h1> --}}
                                <label class="lbl_title">Level of Education : </label><span class="modal_spn_value">{{ $education->education_level ?? '' }}</span><br/>
                                <label class="lbl_title">Field of Study : </label><span class="modal_spn_value">{{ $education->field_of_study ?? '' }}</span><br/>
                                <label class="lbl_title">School Name : </label><span class="modal_spn_value">{{ $education->school_name ?? ''}}</span><br/>
                                <label class="lbl_title">Year Attended : </label> <span class="modal_spn_value" >{{ \Carbon\Carbon::parse($education->start_date)->format('F Y') }} - {{ \Carbon\Carbon::parse($education->end_date)->format('F Y') }}</span><br/>
                                <label class="lbl_title">Description : </label> <span class="modal_spn_value" >{{ $education->description ?? ''}}</span><br/>
                                <hr style="background-color: white;">
                                @endforeach
                            @endif
                        </div>
                        
                        
                    </div>
            </div>
            
        </div>
    </div>
    
  

  <div class="modal" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#0f093c;border:none;">
          <h5 class="modal-title" id="exampleModalLongTitle" style="color: #efad0c;width:66vw;">Contact Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <div class="app" style="display: none;">;
          
        </div> --}}
        <div class="modal-body" style="background-color: rgb(5 26 57);height:50vh;overflow-y:scroll;">
            <div class="contact-body">
                <span class="modal_spn_value">{{ $user->email ?? '' }}</span><br/>
                <span class="modal_spn_value">{{ $profile->secondary_email ?? '' }}</span><br/><br><br>
                <span class="modal_spn_value">{{ $user->mobile_number ?? '' }}</span><br/>
                {{-- <label class="lbl_title">Address : </label> <span class="address spn_value" ></span><br/> --}}
                <span class="modal_spn_value" >{{ $profile->secondary_mobile_number ?? '' }}</span><br/>
                
                
            </div>
        </div>
        
      </div>
    </div>
    
  </div>

  <div class="modal" id="WorkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#0f093c;border:none;">
          <h5 class="modal-title" id="exampleModalLongTitle" style="color: #efad0c;width:66vw;">Work Experience</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <div class="app" style="display: none;">;
          
        </div> --}}
        <div class="modal-body" style="background-color: rgb(5 26 57);height:50vh;overflow-y:scroll;">
            <div class="work-body">
                @if(empty($profile->workexp))
                    <label class="lbl_title"></label><br>
                        <label class="lbl_title">Company Name : </label><span class="spn_valuee"> </span><br>
                        <label class="lbl_title">Designation : </label><span class="spn_valuee"></span><br>
                        <label class="lbl_title">Contact Number : </label><span class="spn_valuee"></span><br>
                        <label class="lbl_title">Company Address : </label><span class="spn_valuee"></span><br>
                        <div style="display: flex">
                            <div style="padding: 1%;width: 15vw;"><label class="lbl_title">Role : </label></div>
                            <div>
                                <span class="spn_valuee" style="text-align: justify-all" ></span><br/>
                            </div>
                        </div>
                @else
                    @foreach($profile->workexp as $workExperience)
            
                        <label class="lbl_title">{{ \Carbon\Carbon::parse($workExperience->start_date)->format('F Y') }} - {{ \Carbon\Carbon::parse($workExperience->end_date)->format('F Y') }}</label><br>
                        <label class="lbl_title">Company Name : </label><span class="spn_valuee"> {{ $workExperience->company_name ?? '' }}</span><br>
                        <label class="lbl_title">Designation : </label><span class="spn_valuee"> {{ $workExperience->designation ?? '' }} </span><br>
                        <label class="lbl_title">Contact Number : </label><span class="spn_valuee"> {{ $workExperience->contact_no ?? '' }}</span><br>
                        <label class="lbl_title">Company Address : </label><span class="spn_valuee"> {{ $workExperience->address ?? '' }}  </span><br>
                        <div style="display: flex">
                            <div style="padding: 1%;width: 15vw;"><label class="lbl_title">Role : </label></div>
                            <div>
                                <span class="spn_valuee" style="text-align: justify-all" >{{ $workExperience->role ?? '' }}</span><br/>
                            </div>
                        </div>
                        <hr style="background-color: #8e9898">
                    @endforeach
                @endif
            </div>
        </div>
        
      </div>
    </div>
    
  </div>

  <div class="modal" id="RefrenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#0f093c;border:none;">
          <h5 class="modal-title" id="exampleModalLongTitle" style="color: #efad0c;width:66vw;">character Reference</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <div class="app" style="display: none;">;
          
        </div> --}}
        <div class="modal-body" style="background-color: rgb(5 26 57);height:50vh;overflow-y:scroll;">
            <div class="work-body">
                @foreach($profile->charref as $refrence)
                    <label class="lbl_title">Name : </label><span class="spn_valuee"> {{ $refrence->name ?? '' }}</span><br>
                    <label class="lbl_title">Email Address : </label><span class="spn_valuee"> {{ $refrence->email ?? '' }} </span><br>
                    <label class="lbl_title">Company Name : </label><span class="spn_valuee"> {{ $refrence->company_name ?? '' }}</span><br>
                    <label class="lbl_title">Designation : </label><span class="spn_valuee"> {{ $refrence->designation ?? '' }}  </span><br>
                   
                    
                    {{-- <label class="lbl_title">Role : </label><span class="spn_value"> {{ $workExperience->role ?? '' }}</span><br> --}}
                    {{-- <span class="spn_valuee">{{ $workExperience->company_name ?? '' }}</span><br>
                        <span class="spn_valuee">{{ $workExperience->designation ?? '' }}</span><br><br>
                        <span class="spn_valuee">{{ $workExperience->role ?? '' }}</span> --}}
                        {{-- <label class="lbl_titile">DOB : </label><span class="dob spn_value"></span>
                        <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span> --}}
                    
                <hr style="background-color: #8e9898">
                @endforeach
                
            </div>
        </div>
        
      </div>
    </div>
    
  </div>

{{-- ---------------------------------------Modal End------------------------------------------------------------------- --}}
@endsection

    @section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{ asset('front/JS/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/owl-carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/JS/mo.min.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script> --}}
    <script>
        var url = $('meta[name="url"]').attr('content');
       
            function goto_dashboard(id)
                {
                     window.location.href = url+'/user_dashboard/'+id;
                 }

            
            function hide_details(){
                $(".bg-div").removeClass("ani-rollout_profile");
                $(".bg-div").removeClass("ani-rollout_profile_back");
                // $(".planet-buttons").removeClass("planet-buttons-rollout");
                // $(".planet-buttons").removeClass("planet-rollout_profile_back");
                // $(".view-profile-button").removeClass("view-profile-button-rollout");
                // $(".view-profile-button").removeClass("view-profile-button-rollout_back");
                // $(".edit-buttons").removeClass("ani-rollout_edit");
                // $(".edit-buttons").removeClass("ani-rollout_edit_back");
                    $(".about").hide();
                    $(".education").hide();
                    $(".contacts").hide();
                    $(".character_refernces").hide();
                    $(".job_description").hide();
                    $('#details-text').text('View Details');
                    $(".bg-div").addClass("ani-rollout_profile_back");
                    $(".bg-div").css({'transform':'scale(1)'});
                    // $(".bg-div").css({'height':'67vh'});
                    $(".bg-div").css({'top':'15vh'});
                    // $(".planet-buttons").addClass("planet-rollout_profile_back");
                    // $(".planet-buttons").css({'top':'90%'});
                    // $(".planet-buttons").css({'transform':'scale(1)'});
                    $(".objective").css({'display':'none'});
                    $(".featured-img").css({'height':'100%'});
                    // $("#featured-image-previewimg").css({'height':'67vh'});
                    // $(".view-profile-button").addClass("view-profile-button-rollout_back");
                    // $(".view-profile-button").css({'top':'78%'});
                    // $(".view-profile-button").css({'transform':'scale(1)'});
                    // $(".edit-buttons").addClass("ani-rollout_edit_back");
                    // $(".edit-buttons").css({'transform':'scale(1)'});
                    // $(".edit-buttons").css({'left':'53%','top':'21%'});
                    $(".navigator-div").show();
                    show_jobseeker_details(0);
            }
    
    let userDataFetched = false;
    let isUserDataVisible = false;
    function view_my_career_posts2(profile_id,user_id){
        if(!isUserDataVisible){
            $(".bg-div").removeClass("ani-rollout_profile");
             $(".bg-div").removeClass("ani-rollout_profile_back");
             $(".bg-div").addClass("ani-rollout_profile");
             var form_url = url+'/get_career_details';
             $(".navigator-div").hide();
             $(".bg-div").css({'transform':'scale(0.7)'});
             $(".bg-div").css({'top':'17vh'});
            // $(".bg-div").css({'height':'97vh'});
            $('#details-text').text('Hide Details');
            // $(".edit-buttons").css({'left':'45%'});
            // // $(".edit-buttons").css({'top':'25%'});
            // $(".edit-buttons").css({'transform':'scale(0.7)'});
            $(".featured-img").css({'height':'70%'});
            // $(".planet-buttons").css({'transform':'scale(0.1)'});
            // $(".planet-buttons").css({'top':'80%'});
            // $(".view-profile-button").css({'transform':'scale(0.6)'});
            // $(".view-profile-button").css({'top':'70%'});
            $(".objective").css({'display':'block'});
            $(".about").show();
            $(".education").show();
            $(".contacts").show();
            $(".character_refernces").show();
            $(".job_description").show();
            show_jobseeker_details(1);

            if(!userDataFetched){
                fetch_user_details(profile_id,user_id);
                userDataFetched = !userDataFetched;
            }
        }else{
            hide_details();
        }

        isUserDataVisible = !isUserDataVisible;
    }

    


    function connect_mail(profile_id,user_id){
       
                  

                    // var primary_email_id=data['User_details'].email;
                   
                    window.open('mailto:user_id["email"]');
                
                };
        
    
    var navigator_zoom = 0;
        var img_has_loaded = 0;
        $('button.navigator-zoomin').click( function() {
            if(!navigator_zoom) {
                if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                    $('.navigator-div').hide();
                    $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
                    // if(!img_has_loaded) {
                    //     $('.navigator-div-zoomed-in .lds-ellipsis').show();
                    //     $('.navigator-div-zoomed-in .astronaut').on('load', function() {
                    //         $('.navigator-div-zoomed-in .lds-ellipsis').hide();
                    //         $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    //         img_has_loaded = !img_has_loaded;
                    //     });
                    // } else {
                        $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    // }
                } else {
                    $(this).fadeOut();
                    $('.navigator-div').addClass('animate-navigator-zoomin');

                    $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.navigator-div').removeClass('animate-navigator-zoomin');
                        $('.navigator-div').addClass('zoomin');
                    });
                }
            }

            navigator_zoom = !navigator_zoom;
        });

        $('.navigator-zoomout-btn').click(function() {
            $('button.navigator-zoomin').fadeIn();

            if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                $('.navigator-div').fadeIn();
                $('.navigator-div-zoomed-in').hide();
            } else {
                $('.navigator-div').addClass('animate-navigator-zoomout');

                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomout');
                    $('.navigator-div').removeClass('zoomin');
                });
            }

            navigator_zoom = !navigator_zoom;
        });

        // navigator buttons
        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });

        $('.home-btn').click( function() {
            window.location.href = url;
        });

        $('.profile-btn').click( function() {
            window.location.href = url+'/dashboard';
        });

        $('.instructions-btn, .tos-btn').click( function() {
            window.location.href = url+'/page_under_development';
        });

        $('.editphoto-btn').click( function() {
            window.location.href = url+'/profile/edit-photo';
        });


        function edit_profile()
                {
                     window.location.href = url+'/jobseekers/edit-setup-profile/';
                 }

        // $('#left-arrow').on('click', function() {
        //         if ($('.about').css('opacity') == 0) $('.about').css('opacity', 1);
        //         else $('.about').css('opacity', 0);

        //         if ($('.education').css('opacity') == 0) $('.education').css('opacity', 1);
        //         else $('.education').css('opacity', 0);

        //         if ($('.contacts').css('opacity') == 0) $('.contacts').css('opacity', 1);
        //         else $('.contacts').css('opacity', 0);

        //         if ($('.character_refernces').css('opacity') == 0) $('.character_refernces').css('opacity', 1);
        //         else $('.character_refernces').css('opacity', 0);

        //         if ($('.job_description').css('opacity') == 0) $('.job_description').css('opacity', 1);
        //         else $('.job_description').css('opacity', 0);


   
        // });

        function show_jobseeker_details(val){
            $('.about').css('opacity',val);
            $('.education').css('opacity',val);
            $('.contacts').css('opacity',val);
            $('.character_refernces').css('opacity',val);
            $('.job_description').css('opacity',val);
            
            // if ($('.about').css('opacity') == 0) $('.about').css('opacity', 1);
            //     else $('.about').css('opacity', 0);

            //     if ($('.education').css('opacity') == 0) $('.education').css('opacity', 1);
            //     else $('.education').css('opacity', 0);

            //     if ($('.contacts').css('opacity') == 0) $('.contacts').css('opacity', 1);
            //     else $('.contacts').css('opacity', 0);

            //     if ($('.character_refernces').css('opacity') == 0) $('.character_refernces').css('opacity', 1);
            //     else $('.character_refernces').css('opacity', 0);

            //     if ($('.job_description').css('opacity') == 0) $('.job_description').css('opacity', 1);
            //     else $('.job_description').css('opacity', 0);

        }

        function fetch_user_details(profile_id, user_id){
            var post_data={'profile_id':profile_id,
                            'user_id':user_id };
        }
        
    </script>
    @endsection