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
    <div id="left-arrow" onclick="view_my_career_posts({{$profile->id}},{{$profile->user_id}})">
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" >&#8811;</span>
    </div>
      <div id="right-arrow" onclick="hide_details()">
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" >&#8810;</span>
      </div>
    <div class="app">
        <div class="bg-div">
            <div class="featured-img"     
                style='background-image: url("{{ asset('storage/career/employee/'.$profile->featured_image) }}")'>
                </div>
            </div>
     @if(Auth::user()->id != $profile->user_id)
        <div class="planet-buttons">
            {{-- <span class="pop-up view-pop-up">View </span>
            <span class="pop-up back-pop-up">Save</span>
            <span class="pop-up collage-pop-up">Call</span> --}}
            <button class="view" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
            <button class="save" data-tag="careers"><img src="{{asset('front/icons/save.png')}}" alt=""></button>
            <button class="call" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/call.png')}}" alt=""></button>
            
        </div>
    @endif
    @if(Auth::user()->id == $profile->user_id)
    <div class="edit-buttons">
        <button class="edit" onclick="edit_profile({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/edit.png')}}" alt=""></button>
        
    </div>
    @endif   
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
<div class="navigator-div-zoomed-in">
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    <div class="navigator-components">
        <img src="{{url('front/images/astronut/tom_blog.png')}}" alt="" class="astronaut">
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
         
</div>
<div class="about">
    <label class="titile">About Me</label><br>
    <label class="lbl_titile">Name : </label> <span class="uname spn_value"></span><br>
    <label class="lbl_titile">DOB : </label> <span class="dob spn_value"></span><br>
    <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span><br>
</div>
<div class="education">
     <label class="titile">Education</label><br>
    {{--<label class="lbl_titile">Primary : </label><span class="primary_ed spn_value"></span><br>
    <label class="lbl_titile">Secondary : </label> <span class="secondary_ed spn_value"></span><br>
    <label class="lbl_titile">Undergraduate: </label> <span class="undergraduate_ed spn_value"></span><br>
    <label class="lbl_titile">Graduate: </label> <span class=" graduate_ed spn_value"></span><br>
    <label class="lbl_titile">Post-Graduate: </label> <span class=" postgraduate_ed spn_value"></span><br> --}}
</div>
<div class="contacts">
    <label class="titile">Contact</label><br>
    <label class="lbl_titile">Primary : </label>&nbsp;<span class="primary  spn_value"></span><br>
    <label class="lbl_titile">Secondary : </label>&nbsp;<span class="secondary spn_value"></span><br>
    {{-- <span class="primary 3 spn_value"></span><br>
    <span class="secondary spn_value"></span><br> --}}
    
</div>
<div class="character_refernces">
    
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
    <script>
        var url = $('meta[name="url"]').attr('content');
       
        $(document).ready(function() {
            $('.planet-buttons .view').mouseenter(function() {
         
 
        });
        $('.planet-buttons span.view-pop-up').show();
            }).mouseleave(function() {
                $('.planet-buttons span.view-pop-up').hide();
            });
            function goto_dashboard(id)
                {
                     window.location.href = url+'/user_dashboard/'+id;
                 }

            
            function hide_details(){
                $(".bg-div").removeClass("ani-rollout_profile");
                $(".bg-div").removeClass("ani-rollout_profile_back");
                    $(".about").hide();
                    $(".education").hide();
                    $(".contacts").hide();
                    $(".character_refernces").hide();
                    $(".job_description").hide();
                    $("#left-arrow").show();
                    $("#right-arrow").hide();
                    $(".bg-div").addClass("ani-rollout_profile_back");
                    $(".bg-div").css({'transform':'scale(1)'});
                    $(".planet-buttons").css({'transform':'translate(-1%, -4%)'});
            }

    function view_my_career_posts(profile_id,user_id){
             $(".bg-div").removeClass("ani-rollout_profile");
             $(".bg-div").removeClass("ani-rollout_profile_back");
             $(".bg-div").addClass("ani-rollout_profile");
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

                    var date = new Date(dob);
                    dob=moment(date).format('MMMM-D-Y');
                    var address=data['User_details'].address;
                    var primary_contact=data['User_details'].mobile_number;
                    var secondary_contact=data['JobSeekerProfile_details'].secondary_mobile_number;
                    var arrrReferenceDetails=data['Reference_details'];
                    var arrrWork_experience=data['work_experience'];
                    var arrrEducation_details=data['Education_details'];
                    $(".character_refernces").html('');
                    var str=" <label class='titile'>Character References</label><br>";
                    $(".character_refernces").append(str);
                    for(var i=0;i<arrrReferenceDetails.length;i++){
                        var str1= " <label class='lbl_titile'>Name :</label>"+"&nbsp;" + "<span class='spn_value'>"+arrrReferenceDetails[i]['name']+"</span><br><label class='lbl_titile'>Email :</label>"+"&nbsp;" + "<span class='spn_value'>"+arrrReferenceDetails[i]['email']+"</span><br>" + "<hr class='line-break'>";
                        // var str1=" <label class='lbl_titile'>Name : "+arrrReferenceDetails[i]['name'] +"</label><br/>";
                        // var str2=" <label class='lbl_titile'>Email : "+arrrReferenceDetails[i]['email'] +"</label><br/>";
                            $(".character_refernces").append(str1);
                            // $(".character_refernces").append(str2);
                    }
                    $(".job_description").html('');

                    var str=" <label class='titile'>Job Description</label><br>";
                    $(".job_description").append(str);
                    for(var i=0;i<arrrWork_experience.length;i++){
                        var StartDate = arrrWork_experience[i]['start_date'];
                        var SDate = new Date(StartDate);
                        var Syear =moment(StartDate).format('MMM-Y');

                        var EndDate = arrrWork_experience[i]['end_date'];
                        var EDate = new Date(EndDate);
                        var Eyear = moment(EndDate).format('MMM-Y');
                        //  var str1= " <label class='lbl_titile'>Year :</label>" +"&nbsp;" + "<span class='spn_value'>"  +Syear +" - " +Eyear +"</span><br> <label class='lbl_titile'>Company :</label>"+"&nbsp;" + "<span class='spn_value'>"+arrrWork_experience[i]['company_name']+"</span><br><label class='lbl_titile'>Designation :</label>" +"&nbsp;"+ "<span class='spn_value'>" +arrrWork_experience[i]['designation']+"</span><br><label class='lbl_titile'>Role :</label>" +"&nbsp;"+ "<span class='spn_value'>" +arrrWork_experience[i]['role']+"</span><br>" + "<hr class='line-break'>";
                        //     $(".job_description").append(str1);
                        var str1= " <label class='lbl_sub_title'>" +arrrWork_experience[i]['designation'] +"</label><br><label class='spn_value' style='text-transform:uppercase;'>" +arrrWork_experience[i]['company_name'] +"</label><br><label class='job-dates'>" +Syear +" to " +Eyear + "</label><br><label class='role-responsibilty'>" +arrrWork_experience[i]['role'] +"</label><br>"  + "<hr class='line-break'>";
                        $(".job_description").append(str1);
                    }
                  

                    for(var i=0;i<arrrEducation_details.length;i++){
                        var education_level = arrrEducation_details[i]['education_level'];
                       
                            if(education_level=='Primary'){
                                
                          
                                $(".primary_ed").html(arrrEducation_details[i].school_name);  }
                           else if(education_level=='Secondary')
                                $(".secondary_ed").html(arrrEducation_details[i].school_name);
                            else if(education_level=='Undergraduate')
                                $(".undergraduate_ed").html(arrrEducation_details[i].school_name);
                            else if(education_level=='Graduate')
                                $(".graduate_ed").html(arrrEducation_details[i].school_name);
                            else if(education_level=='Post-Graduate')
                                $(".postgraduate_ed").html(arrrEducation_details[i].school_name);
                        
                            var str= " <label class='lbl_titile'>Year :</label>" +"&nbsp;" + "<span class='spn_value'>"  +Syear +" - " +Eyear +"</span><br> <label class='lbl_titile'>Level of Education :</label>"+"&nbsp;" + "<span class='spn_value'>"+arrrEducation_details[i]['education_level']+"</span><br><label class='lbl_titile'>School :</label>" +"&nbsp;"+ "<span class='spn_value'>" +arrrEducation_details[i]['school_name']+"</span><br><label class='lbl_titile'>Field of study :</label>" +"&nbsp;"+ "<span class='spn_value'>" +arrrEducation_details[i]['field_of_study']+"</span><br>" + "<hr class='line-break'>";
                                $(".education").append(str);
                        // var str=" <label class='lbl_titile'>"+Syear +" - " +Eyear +"</label><br> <label class='lbl_titile'>"+arrrEducation_details[i]['school_name']+"</label><br><label class='lbl_titile'>"+arrrEducation_details[i]['field_of_study']+"</label><br><label class='lbl_titile'>"+arrrEducation_details[i]['description']+"</label><br>";
                        //     $(".education").append(str);
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


    function connect_mail(profile_id,user_id){
        var form_url = url+'/get_career_details';
        $.ajax({
                url: form_url,
                method: 'post',
                data: { 
                    profile_id: profile_id,
                    user_id: user_id,
                    },
               dataType: 'json',
                success: function(data) {
                  

                    var primary_email_id=data['User_details'].email;
                   
                    window.open('mailto:'+primary_email_id+'?subject=test subject');
                },
                error: function (request, status, error) {
                   
                }
                });
        
    }
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


        function edit_profile(profile_id,user_id)
                {
                     window.location.href = url+'/jobseekers/edit-setup-profile/'+profile_id;
                 }

        $('#left-arrow').on('click', function() {
    if ($('.about').css('opacity') == 0) $('.about').css('opacity', 1);
    else $('.about').css('opacity', 0);

    if ($('.education').css('opacity') == 0) $('.education').css('opacity', 1);
    else $('.education').css('opacity', 0);

    if ($('.contacts').css('opacity') == 0) $('.contacts').css('opacity', 1);
    else $('.contacts').css('opacity', 0);

    if ($('.character_refernces').css('opacity') == 0) $('.character_refernces').css('opacity', 1);
    else $('.character_refernces').css('opacity', 0);

    if ($('.job_description').css('opacity') == 0) $('.job_description').css('opacity', 1);
    else $('.job_description').css('opacity', 0);


   
});
    </script>
    @endsection