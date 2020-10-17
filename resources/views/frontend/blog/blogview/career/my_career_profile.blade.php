@extends('frontend.layouts.profile_layout')

@section('before-styles')


<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/my_career_profile.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/my_career_profile_responsive.css') }}">
@endsection


@section('after-styles')
{{-- @trixassets --}}
@endsection

@section('content')
<div id="page-content">
    
    {{-- <div id="left-arrow" onclick="view_my_career_posts({{$profile->id}},{{$profile->user_id}})">
    
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" >&#8811;</span><br/><br/><br/>
     
        
        
    </div>
    
      <div id="right-arrow" onclick="hide_details()">
        <span  class="arrow" style="font-size:17px;font-family:Nasalization;cursor:pointer" >&#8810;</span>
      </div> --}}

      <input type="hidden" id="profile_id_input" name="profile_id_input" value="{{$profile->id}}">
      <input type="hidden" id="profile_user_id_input" name="profile_user_id_input" value="{{$profile->user_id}}">
    
    <div class="app">
        
            
            <div class="bg-div">
                
                    <div class="objective" style="text-align: center;color:white; position: relative; display:none;">
                        <p style="font-size: calc(1vw + 7px);">{{ $profile->objective }}</p>
                    </div>
                    {{-- <div class="featured-img"     
                        style='background-image: url("{{ asset('storage/career/employee/'.$profile->featured_image) }}")'>
                    </div> --}}
                    <div class="featured-img" ></div>
                            {{-- <label for="file" id="featured-image-label"> --}}
                            
                            <!--changed id of img from outputImage to featured-image-previewimg-->
                            
                                <img src="{{ asset('storage/career/employee/'.$profile->featured_image) }}"  id="featured-image-previewimg"  alt="input image" style=" max-width:100%; max-height:100%;">
                            {{-- </label> --}}
                    
                            
                
            </div>
        
        {{-- <button class="test" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button> --}}
        
{{--</div>--}}
     @if(Auth::user()->id != $profile->user_id)
     <div class="view-profile-button">
        
        <button class="more-icon" onclick="view_my_career_posts2({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt=""></button>
        {{-- <button class="more-icon"   onclick="view_my_career_posts({{$profile->id}},{{$profile->user_id}});hide_details();"><img src="{{asset('front/icons/viewMoreIcon.png')}}" alt=""></button> --}}
    </div>
        <div class="planet-buttons">
            {{-- <span class="pop-up view-pop-up">View </span>
            <span class="pop-up back-pop-up">Save</span>
            <span class="pop-up collage-pop-up">Call</span> --}}
            <button class="view" onclick="goto_dashboard({{$profile->user_id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
            <button class="save" data-tag="careers"><img src="{{asset('front/icons/save.png')}}" alt=""></button>
            <button class="call" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/call.png')}}" alt=""></button>
            <button class="messenger" onclick="connect_mail({{$profile->id}},{{$profile->user_id}})"><img src="{{asset('front/icons/messengerIcon.png')}}" alt="message-icon"></button>
            
        </div>
    </div>
    @endif
    @if(Auth::user()->id == $profile->user_id)
    <div class="edit-buttons">
        <button class="edit" onclick="edit_profile()"><img src="{{asset('front/icons/edit.png')}}" alt=""></button>
        
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
    <button class="navigator-zoom navigator-zoomin tooltips zoom-in-out"><span>Zoom In</span><i class="fas fa-search-plus"></i></button>
    <div class="navigator-buttons">
        <div class="column column-1">
            <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
            <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
        </div>
        <div class="column column-2">
            <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
        </div>
        <div class="column column-3">
            {{-- <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button> --}}
            <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
            <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
        </div>
    </div>
    <div class="instructions-div">
        <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
    </div>
    <div class="communicator-div tooltips left">
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
                {{-- <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button> --}}
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
        <button class="navigator-zoomout-btn">
            {{-- <span style="display:block; font-size:0.7rem">Zoom Out</span> --}}
            <i class="fas fa-undo-alt"></i>
        </button>
    </div>
</div>
         
</div>
<div class="about" style="display:flex;flex-direction:column;padding:0 !important;">
    <div class="titile" style="position:relative;width:100%;text-align:center;">About me</div>
    {{-- <label class="titile">About Me</label><br> --}}
    <div class="sub-section">
       
            <label class="lbl_titile">Name : </label><span class="uname spn_value"></span><br/>
            <label class="lbl_titile">DOB : </label><span class="dob spn_value"></span><br/>
            <label class="lbl_titile">Address : </label> <span class="address spn_value" ></span><br/>
            <div style="float: right;position: relative;width: 15%;top: 0;left: 0;transform: translate(10%, 4%);">
                <i class="fas fa-ellipsis-h"></i>
            </div>

    </div>
    
</div>
<div class="education" style="display:flex;flex-direction:column;padding:0 !important;">
    <div class="titile" style="position:relative;width:100%;text-align:center;">Education</div>
   
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

<div class="contacts" style="display:flex;flex-direction:column;padding:0 !important;">
    <div class="titile" style="position:relative;width:100%;text-align:center;">Contact</div>
    <div class="sub-section">
        <span class="primary  spn_value" style="padding-left: 2%;"></span><br>
        <span class="secondary spn_value" style="padding-left: 2%;"></span><br><br>
        <span class="primary_mob  spn_value" style="padding-left: 2%;"></span><br>
        <span class="secondary_mob spn_value" style="padding-left: 2%;"></span>
        <div style="float: right;position: relative;width: 15%;top: 11%;left: 0;transform: scale(1.3);">
            <i class="fas fa-ellipsis-h"></i>
        </div>
    </div>    
    {{-- <span class="primary 3 spn_value"></span><br>
    <span class="secondary spn_value"></span><br> --}}
    
</div><br/>
<div class="character_refernces" style="display:flex;flex-direction:column;padding:0 !important;">
    {{-- <div class="titile" style="position:relative;width:100%;text-align:center;">Character Reference</div> --}}
</div>


<div class="job_description" style="display:flex;flex-direction:column;padding:0 !important;">
    

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
       
            function goto_dashboard(id)
                {
                     window.location.href = url+'/user_dashboard/'+id;
                 }

            
            function hide_details(){
                $(".bg-div").removeClass("ani-rollout_profile");
                $(".bg-div").removeClass("ani-rollout_profile_back");
                $(".planet-buttons").removeClass("planet-buttons-rollout");
                $(".planet-buttons").removeClass("planet-rollout_profile_back");
                $(".view-profile-button").removeClass("view-profile-button-rollout");
                $(".view-profile-button").removeClass("view-profile-button-rollout_back");
                    $(".about").hide();
                    $(".education").hide();
                    $(".contacts").hide();
                    $(".character_refernces").hide();
                    $(".job_description").hide();
                 
                    $(".bg-div").addClass("ani-rollout_profile_back");
                    $(".bg-div").css({'transform':'scale(1)'});
                    $(".bg-div").css({'height':'67vh'});
                    $(".bg-div").css({'top':'19vh'});
                    $(".planet-buttons").addClass("planet-rollout_profile_back");
                    $(".planet-buttons").css({'top':'90%'});
                    $(".planet-buttons").css({'transform':'scale(1)'});
                    $(".objective").css({'display':'none'});
                   
                    $(".view-profile-button").addClass("view-profile-button-rollout_back");
                    $(".view-profile-button").css({'top':'75%'});
                    $(".view-profile-button").css({'transform':'scale(1)'});
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
             $(".planet-buttons").removeClass("planet-buttons-rollout");
            $(".planet-buttons").addClass("planet-buttons-rollout");
            $(".view-profile-button").removeClass("view-profile-button-rollout");
            $(".view-profile-button").addClass("view-profile-button-rollout");
            var form_url = url+'/get_career_details';
            $(".navigator-div").hide();
            $(".bg-div").css({'transform':'scale(0.7)'});
            $(".bg-div").css({'top':'-2%'});
            $(".bg-div").css({'height':'95vh'});
            $("#featured-image-previewimg").css({'height':'80vh'});
            $(".planet-buttons").css({'transform':'scale(0.6)'});
            $(".planet-buttons").css({'top':'80%'});
            $(".view-profile-button").css({'transform':'scale(0.6)'});
            $(".view-profile-button").css({'top':'70%'});
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
            if(profile_id!=''){

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
                        var user_name=data['User_details'].first_name+' '+data['User_details'].last_name;
                        var dob=data['User_details'].dob;

                        var date = new Date(dob);
                        dob=moment(date).format('MMMM-D-Y');
                        var address=data['User_details'].address;
                        var primary_contact=data['User_details'].email;
                        var primary_mobile=data['User_details'].mobile_number;
                        var secondary_contact=data['JobSeekerProfile_details'].secondary_email;
                        var secondary_mobile=data['JobSeekerProfile_details'].secondary_mobile_number;
                        var arrrReferenceDetails=data['Reference_details'];
                        var arrrWork_experience=data['work_experience'];
                        var arrrEducation_details=data['Education_details'];
                        $(".character_refernces").html('');
                        var str=" <div class='titile' style='position:relative;width:100%;text-align:center;'>Character Reference</div><br>";
                        $(".character_refernces").append(str);
                        var str2 = "<div style='float: right;position: relative;width: 15%;top: 26%;left: 87%;transform: scale(1.3);'>" + "<i class='fas fa-ellipsis-h'></i>" +"</div>";
                        for(var i=0;i<arrrReferenceDetails.length;i++){
                            var str1= "<span class='spn_value'>"+arrrReferenceDetails[i]['name']+"</span><br>";
                            // var str1=" <label class='lbl_titile'>Name : "+arrrReferenceDetails[i]['name'] +"</label><br/>";
                            // var str2=" <label class='lbl_titile'>Email : "+arrrReferenceDetails[i]['email'] +"</label><br/>";
                                $(".character_refernces").append(str1);
                                // $(".character_refernces").append(str2);
                        }
                        $(".character_refernces").append(str2);
                        $(".job_description").html('');

                        var str="<div class='titile' style='position:relative;width:100%;text-align:center;'>Work Experience</div><br/>";
                        $(".job_description").append(str);
                        var str2 = "<div style='float: right;position: relative;width: 15%;top: 62%;left: 87%;transform: scale(1.3);'>" + "<i class='fas fa-ellipsis-h'></i>" +"</div>";

                        for(var i=0;i<arrrWork_experience.length;i++){
                            var StartDate = arrrWork_experience[i]['start_date'];
                            var SDate = new Date(StartDate);
                            var Syear =moment(StartDate).format('MMM-Y');

                            var EndDate = arrrWork_experience[i]['end_date'];
                            var EDate = new Date(EndDate);
                            var Eyear = moment(EndDate).format('MMM-Y');
                            // var str1= " <label class='lbl_sub_title'>" +arrrWork_experience[i]['designation'] +"</label><br><label class='spn_value' style='text-transform:uppercase;'>" +arrrWork_experience[i]['company_name'] +"</label><br><label class='job-dates'>" +Syear +" to " +Eyear + "</label><br><label class='role-responsibilty'>" +arrrWork_experience[i]['role'] +"</label><br>"  + "<hr class='line-break'>";
                            // $(".job_description").append(str1);
                            var str1= "<label class='job-dates'>" +Syear +" - " +Eyear + "</label><label class='spn_value' style='text-transform:uppercase;'>" +arrrWork_experience[i]['company_name']+"</label><label class='spn_value'>" +arrrWork_experience[i]['designation'] +"</label><br><label class='role-responsibilty'>" +arrrWork_experience[i]['role'] +"</label><br>"  + "<hr class='line-break'>";
                            $(".job_description").append(str1);
                        }
                        $(".job_description").append(str2);
                    
                        var str2 = "<div style='float: right;position: relative;width: 15%;top: 34%;left: 87%;transform: scale(1.3);'>" + "<i class='fas fa-ellipsis-h'></i>" +"</div>";
                        for(var i=0;i<arrrEducation_details.length;i++){
                            var education_level = arrrEducation_details[i]['education_level'];
                            var StartDate = arrrEducation_details[i]['start_date'];
                            var SDate = new Date(StartDate);
                            var Syear =moment(StartDate).format('MMM-Y');

                            var EndDate = arrrEducation_details[i]['end_date'];
                            var EDate = new Date(EndDate);
                            var Eyear = moment(EndDate).format('MMM-Y');
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
                            
                                var str= "<div class='sub-section'>" + "<span class='lbl_titile'>"+arrrEducation_details[i]['education_level']+"&nbsp;:"+"</span><br>"+ "<span class='spn_value'>" +arrrEducation_details[i]['school_name']+"</span>" +"</div>";
                                
                                    $(".education").append(str);
                                    
                                // var str= " <label class='lbl_titile'>Year :</label>" +"&nbsp;<br/>" + "<span class='spn_value'>"  +Syear +" - " +Eyear +"</span><br> <label class='lbl_titile'>Level of Education :</label>"+"&nbsp;<br/>" + "<span class='spn_value'>"+arrrEducation_details[i]['education_level']+"</span><br><label class='lbl_titile'>School :</label>" +"&nbsp;<br/>"+ "<span class='spn_value'>" +arrrEducation_details[i]['school_name']+"</span><br><label class='lbl_titile'>Field of study :</label>" +"&nbsp;"+ "<span class='spn_value'>" +arrrEducation_details[i]['field_of_study']+"</span><br>" + "<hr class='line-break'>";
                                //     $(".education").append(str);
                //                 + " <div style='float: right;position: relative;width: 15%;top: 0;left: 0;transform: scale(1.3)'>"
                //   +"<i class='fas fa-ellipsis-h'></i>"+"</div> "
                        }
                        $(".education").append(str2);
                        $(".uname").html(user_name);
                        $(".dob").html(dob);
                        $(".address").html(address);
                        $(".primary ").html(primary_contact);
                        $(".secondary").html(secondary_contact);
                        $(".primary_mob ").html(primary_mobile);
                        $(".secondary_mob").html(secondary_mobile);
                    },
                    error: function (request, status, error) {
                    
                    }
                });//end of ajax
            }
            
        }
        
    </script>
    @endsection