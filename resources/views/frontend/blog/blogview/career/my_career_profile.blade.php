@extends('frontend.layouts.profile_layout')

@section('before-styles')


<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog-responsive.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/my_career_profile.css') }}">
@endsection

@section('after-styles')
{{-- @trixassets --}}
@endsection

@section('content')
<div id="page-content">
    <div id="left-arrow">
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" onclick="view_my_career_posts({{$profile->id}},{{$profile->user_id}})">&#8811;</span>
      </div>
      <div id="right-arrow">
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" onclick="hide_details()">&#8810;</span>
      </div>
    <div class="app">
        <div class="bg-div">
            <div class="featured-img"     
                style='background-image: url("{{ asset('storage/career/employee/'.$profile->featured_image) }}")'>
                </div>
            </div>

        <div class="planet-buttons">
            {{-- <span class="pop-up view-pop-up">View </span>
            <span class="pop-up back-pop-up">Save</span>
            <span class="pop-up collage-pop-up">Call</span> --}}
            <button class="view" ><img src="{{asset('front/icons/view.png')}}" alt=""></button>
            <button class="save" data-tag="careers"><img src="{{asset('front/icons/save.png')}}" alt=""></button>
            <button class="call"><img src="{{asset('front/icons/call.png')}}" alt=""></button>
            
        </div>
    </div>
</div>
    
    <div class="navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
        @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
            <img src="{{ asset('front/images/astronut/thomasina-navigator.png') }}" alt=""
            class="astronaut-body">
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
        <button class="navigator-zoom navigator-zoomin"><i class="fas fa-search-plus"></i></button>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
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
        <button class="navigator-zoomout-btn">
            <i class="fas fa-undo-alt"></i>
        </button>
       
</div>
         
</div>
<div class="about">
    <label class="lbl_titile">Name : </label> <span class="uname spn_value"></span><br>
    <label class="lbl_titile">DOB : </label> <span class="dob spn_value"></span><br>
    <label class="lbl_titile">Address: </label> <span class="address spn_value"></span><br>
</div>
<div class="education">
    {{-- <label class="lbl_titile">Graduate : </label> <span class=" spn_value"></span><br>
    <label class="lbl_titile">Tertiary : </label> <span class=" spn_value"></span><br>
    <label class="lbl_titile">Secondary: </label> <span class=" spn_value"></span><br>
    <label class="lbl_titile">Primary: </label> <span class=" spn_value"></span><br> --}}
</div>
<div class="contacts">
    <span class="primary 3 spn_value"></span><br>
    <span class="secondary spn_value"></span><br>
    
</div>
<div class="character_refernces">
    <label class="lbl_titile">Character References</label>
</div>


<div class="job_description">
   
</div>
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
    
    <script>
        var url = $('meta[name="url"]').attr('content');
       
        $(document).ready(function() {
            $('.planet-buttons .view').mouseenter(function() {
         
 
        });
        $('.planet-buttons span.view-pop-up').show();
            }).mouseleave(function() {
                $('.planet-buttons span.view-pop-up').hide();
            });

            $('.view').click( function() {
                     window.location.href = url+'/dashboard';
        });

            
            function hide_details(){
                    $(".about").hide();
                    $(".education").hide();
                    $(".contacts").hide();
                    $(".character_refernces").hide();
                    $(".job_description").hide();
                    $("#left-arrow").show();
                    $("#right-arrow").hide();
                    $(".bg-div").css({'transform':'scale(1)'});
                    $(".planet-buttons").css({'transform':'translate(-1%, -4%)'});
            }

    function view_my_career_posts(profile_id,user_id){

            var form_url = url+'/get_career_details';
            $(".navigator-div").hide();
            $(".bg-div").css({'transform':'scale(0.6)'});
            $(".planet-buttons").css({'transform':'translate(-1%, -132%)'});
            $(".about").show();
            $(".education").show();
            $(".contacts").show();
            $(".character_refernces").show();
            $(".job_description").show();
            $("#left-arrow").hide();
            $("#right-arrow").show();
            
            


           var post_data={'profile_id':profile_id,
                           'user_id':user_id };
            if(profile_id!=''){

          
            $.ajax({
                url: form_url,
                method: 'post',
                data: { 
                    profile_id: profile_id,
                    user_id: user_id,
                    },
               dataType: 'json',
                success: function(data) {
                  

                    var user_name=data['User_details'].first_name+' '+data['User_details'].last_name;
                    var dob=data['User_details'].dob;
                    var address=data['User_details'].address;
                    var primary_contact=data['User_details'].mobile_number;
                    var secondary_contact=data['JobSeekerProfile_details'].secondary_mobile_number;
                    var arrrReferenceDetails=data['Reference_details'];
                    var arrrWork_experience=data['work_experience'];
                    var arrrEducation_details=data['Education_details'];
                    
                    for(var i=0;i<arrrReferenceDetails.length;i++){
                        var str=" <label class='lbl_titile'>"+arrrReferenceDetails[i]['name'] +"   " +arrrReferenceDetails[i]['email'] +"</label><br>";
                            $(".character_refernces").append(str);
                    }

                    for(var i=0;i<arrrWork_experience.length;i++){
                        var StartDate = arrrWork_experience[i]['start_date'];
                        var SDate = new Date(StartDate);
                        var Syear = SDate.getFullYear();

                        var EndDate = arrrWork_experience[i]['end_date'];
                        var EDate = new Date(EndDate);
                        var Eyear = EDate.getFullYear();
                        var str=" <label class='lbl_titile'>"+Syear +" - " +Eyear +"</label><br> <label class='lbl_titile'>"+arrrWork_experience[i]['designation']+"</label><br>";
                            $(".job_description").append(str);
                    }
                  

                    for(var i=0;i<arrrEducation_details.length;i++){
                        var StartDate = arrrEducation_details[i]['start_date'];
                        var SDate = new Date(StartDate);
                        var Syear = SDate.getFullYear();

                        var EndDate = arrrEducation_details[i]['end_date'];
                        var EDate = new Date(EndDate);
                        var Eyear = EDate.getFullYear();
                        var str=" <label class='lbl_titile'>"+Syear +" - " +Eyear +"</label><br> <label class='lbl_titile'>"+arrrEducation_details[i]['school_name']+"</label><br><label class='lbl_titile'>"+arrrEducation_details[i]['field_of_study']+"</label><br><label class='lbl_titile'>"+arrrEducation_details[i]['description']+"</label><br>";
                            $(".education").append(str);
                    }
                    $(".uname").html(user_name);
                    $(".dob").html(dob);
                    $(".address").html(address);
                    $(".primary ").html(primary_contact);
                    $(".secondary").html(secondary_contact);
                },
                error: function (request, status, error) {
                   
                }
            });
        }

    }
    </script>
    @endsection