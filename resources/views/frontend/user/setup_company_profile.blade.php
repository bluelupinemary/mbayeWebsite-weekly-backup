@extends('frontend.layouts.career_setup-profile_layout')

@section('before-styles')

<style></style>
<style>
    .swal2-popup {
    display: none;
    position: relative;
    box-sizing: border-box;
    flex-direction: column;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    box-shadow: 0px 0px 20px #17a2b8 !important;
    border: none;
    border-radius: .3125em;
    background: #fff;
    font-family: inherit;
    font-size: 1rem;
}
.swal2-content {
    color: #17a2b8 !important;
    font-size: 1.1vw !important;
    font-family: 'Arial';
}
.swal2-title {
    position: relative;
    max-width: 100%;
    margin: 0 0 .4em;
    padding: 0;
    color: red !important;
    font-size: 1.875em;
    font-weight: 600;
    text-align: center;
    text-transform: none;
    word-wrap: break-word;
}

</style>
    
<link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/cropper.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
{{-- <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/> --}}
<link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile-responsive.css')}}"/>
{{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}"> --}}

<link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('front/JS/jquery.fontselect.js')}}"></script> --}}
<script src="{{asset('front/JS/cropper.js')}}"></script>


@endsection

@section('after-styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
<!-- <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}"> -->
<!-- <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}"> -->
<!-- <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}"> -->
<link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
<!-- <link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}"> -->
<link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}">  --}}
 {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}">  --}}
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> -->
{{-- <link rel="stylesheet" href="{{asset('front/CSS/bootstrap.min.css')}}"> --}}
<link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
@endsection


@section('content')



    <div id="page-content">
        <div id="container">
            <div class="screen"><br/><br/>
                
                    <div class="row">
                            <div class="feature-image-column">
                                
                                <form action="@if(!empty($company_profile)){{ route('frontend.company_profile.update',$company_profile->id)}}@else{{ route('frontend.company_profile.store') }}@endif " method="POST" id="xyz" enctype="multipart/form-data">
                                    
                                    @csrf
                                    @if($company_profile ?? '')
                                    {{ method_field('PUT') }}
                                    @endif
                                    <div class="user-upload-img" id="userImageUpload" >

                                            <label for="file" id="featured-image-label">
                                            @if(!empty($company_profile))
                                            <!--changed id of img from outputImage to featured-image-previewimg-->
                                            {{-- <img src="{{asset('front/images/image-add.jpg')}}"  id="featured-image-previewimg"  alt="input image" class="inox img-resize"> --}}
                                                <img src="{{ asset('storage/career/company/'.$company_profile->featured_image) }}" class="featuredImageEdit" id="featured-image-previewimg"   alt="Feature Image">
                                                
                                                <div class="middle" id="middle">
                                                    <div id="middleText" class="middle-text"></div>
                                                </div>
                                            @else
                                                <img src=""  id="featured-image-previewimg" class="featuredImageCreate"  alt="Feature Image">
                                            
                                                <div class="middle" id="middle">
                                                    <div id="middleText">Upload Featured Image</div>
                                                </div>
                                            
                                            @endif
                                            </label>
                                            {{-- <button type="button" class="" id="edit_uploaded_image" style="">Edit Image</button>  --}}

                                            @if(!empty($company_profile))
                                                <i id="edit_uploaded_image" class="far fa-image btn_pointer tooltips top edit-updated-image"> <span class="edit-photo-span">Edit photo</span></i>
                                            @else
                                                <i id="edit_uploaded_image" class="far fa-image btn_pointer tooltips top edit-image"> <span class="edit-photo-span">Edit photo</span></i>
                                            @endif

                                           {{-- <button class="btn" id="edit_uploaded_image"> --}}

                                            @if(!empty($company_profile))
                                                <input id="file"  onchange="loadFile(event)"  type="file" name="featured_image" value="{{ $company_profile->featured_image ?? '' }}" >
                                            @else
                                                <input id="file"  onchange="loadFile(event)"  type="file"  name="featured_image" value="">
                                            @endif

                                            <!--for the image editor-->
                                            <input type="hidden" name="edited_featured_image" id="edited_featured_image">
                                            
                                            {{-- <div class="image-edit">
                                                <div class="" id="image-edit-div"> --}}
                                                    {{-- <button type="submit"  id="img-edit" class="img-edit-button">Edit Photo</button> --}}
                                                    
                                                {{-- </div>
                                            </div> --}}
                                            

                                    </div>
                                    {{-- @if(empty($company_profile))
                                    <small class="error">{{ $errors->first('featured_image') }}</small>
                                    @endif --}}
                                    {{-- ----------------------------------Image Edit Code------------------------------------- --}}
                                    {{-- <div class="user-upload-img"></div> --}}
                                    <!--changed button class name from img-edit-button to edit_image-->
                                    {{-- <button type="button" class="" id="">Edit Image</button> --}}
                                    
                                    
                                {{-- ----------------------------------END---------------------------------------------------- --}}
                            </div>
                            <!-- ---------------------Form code start-------------------------------------------- -->

                            <div class="column2">
                                @if(!empty($company_profile))
                                    <div class="heading"><h2>EDIT COMPANY PROFILE</h2></div>
                                @else
                                    <div class="heading"><h2>CREATE COMPANY PROFILE</h2></div>
                                @endif        
                                 <div class="form">
                                    
                                            <div class="input-fields">
                                                
                                                    <label for="Cname">Company Name :<span class="input-span">*</span></label>
                                                    @if(!empty($company_profile))
                                                    <input type="text" id="company_name" name="company_name" value="{{ $company_profile->company_name ?? '' }}" required>
                                                
                                                    @else
                                                        {{-- <label for="Cname">Company Name :<span style="color:red">*</span></label> --}}
                                                        <input type="text" id="company_name" name="company_name" value="{{old('company_name')}}" required>
                                                    
                                                    @endif
                                            </div>
                                            <div>
                                                <label for="CEmail">Company Email :<span class="input-span">*</span></label>
                                                @if(!empty($company_profile))
                                                    <input type="email"  value="{{ $company_profile->company_email ?? '' }}" id="company_email" name="company_email" required>
                                                @else
                                                <input type="email"  value="{{old('company_email')}}" class="form-control @error('company_email') danger-alter @enderror" id="company_email" onchange="validateEmail()" name="company_email" required>
                                                @endif

                                                @if ($errors->has('company_email'))
                                                <div class="error">
                                                    {{ 'Email is already taken' }}
                                                </div>
                                                @endif
                                                {{-- <small class="error">{{ $errors->first('company_email') }}</small> --}}
                    
                                               
                                            </div>
                                            
                                            
                                            <div>
                                                <label for="company">Company Address :<span class="input-span">*</span></label>
                                                @if(!empty($company_profile))
                                                    <input type="text" id="company_address" name="address" value="{{ $company_profile->address ?? '' }}" required>
                                                @else
                                                    <input type="text" id="company_address" name="address" value="{{old('address')}}" required>
                                                @endif
                                            </div>
                                        
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="country">Country :<span  class="input-span">*</span></label>
                                                        <select class="countries" name="country" id="countryId" required>&#x25BC;
                                                            @if(!empty($company_profile))
                                                            <option value="{{ $company_profile->country ?? '' }}" >{{ $company_profile->country }}</option>
                                                            @else
                                                            <option value="select country" selected disabled>Select Country</option>
                                                            {{-- <option id="initCountry" value="@if(!empty(old('country'))){{ old('country')}} @else Select Year @endif">Select Year</option> --}}
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="state">State :<span class="input-span">*</span></label>
                                                        <select id="stateId" class="states" name="state" required>
                                                            @if(!empty($company_profile))
                                                            
                                                            <option value="{{ $company_profile->state ?? '' }}" >{{ $company_profile->state }}</option>
                                                            @else
                                                            <option value="select state" selected disabled>Select State</option>
                                                            {{-- <option value="{{ old('state')}}">{{ old('state') }}</option> --}}
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="city">City :<span class="input-span">*</span></label>
                                                        <select id="cityId" class="cities" name="city" required>
                                                            @if(!empty($company_profile))
                                                            <option value="{{ $company_profile->city ?? '' }}" >{{ $company_profile->city }}</option>
                                                            @else
                                                            <option value="select city" selected disabled>Select City</option>
                                                            {{-- <option value="{{old('city')}}">{{ old('city') }}</option> --}}
                                                            @endif
                                                        </select>
                                                    </div>
                                            </div>
                                                    <div class="mobile-no">
                                                            <label for="mobile">Mobile :<span class="input-span">*</span></label>
                                                            @if(!empty($company_profile))
                                                            <input type="number" class="form-control {{ $errors->has('company_phone_number') ? 'error' : '' }}" value="{{ $company_profile->company_phone_number ?? '' }}" id="mob_no" name="company_phone_number" required>
                                                            <small class="error">{{ $errors->first('company_phone_number') }}</small>
                                                            
                                                            @else
                                                                <input type="number" class="form-control {{ $errors->has('company_phone_number') ? 'error' : '' }}" value="{{ old('company_phone_number') }}" id="mob_no" name="company_phone_number" required>
                                                                 <small class="error">{{ $errors->first('company_phone_number') }}</small>
                                                            
                                                            @endif
                                                    </div>
                                                    {{-- @if ($errors->has('company_phone_number'))
                                                    <div class="error">
                                                        {{ 'Enter valid mobile number' }}
                                                    </div>
                                                    @endif --}}
                                                    
                                                        <div class="industry">
                                                            <label for="industry">Industry :<span class="input-span">*</span></label>
                                                            <select id="industry" class="" name="industry_id" required>&#x25BC;
                                                                <option value="select" selected disabled>Select industry</option>
                                                                @if(!empty($company_profile)){
                                                                @foreach($industry as $industry)
                                                                <option value="{{$industry->id}}"{{$company_profile->industry_id == $industry->id  ? 'selected' : ''}}>{{$industry->industry_name}}</option>
                                                                @endforeach
                                                                }@else{
                                                                    @foreach($industry as $industry)
                                                                    <option value="{{$industry->id}} {{ (collect(old('industry'))->contains($industry->id)) ? 'selected':'' }}">{{$industry->industry_name}}</option>
                                                                    @endforeach
                                                                }
                                                                @endif
                                                                {{-- <option value="{{ $game->id }}" @if(old('game_type_id') == $game->id) {{ 'selected' }} @endif>{{ $game->name }}</option> --}}
                                                                {{-- <option value="{{ $option->id }}" {{ (collect(old('options'))->contains($option->id)) ? 'selected':'' }}>{{ $option->name }}</option> --}}
                                                            </select>
                                                        </div><br>
                                                        <input type="hidden" name="owner_id" value="{{Auth::user()->id}}">
                                            <div class="form-btn">
                                                <button type="submit" id="submit" class="button-done">Submit</button>
                                            </div>
                                        </form>
                                        
                                </div>
                            </div>
                       
                            <!-- ---------------------Form code End-------------------------------------------- -->

                    </div>
                    {{-- <div class="row">--}}
                        {{-- <div class="column3">  --}}
                            <!-- ---------------------astronaut code start-------------------------------------------- -->
                            <div class="astro-div navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
                                @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
                                <img src="{{ asset('front/images/astronut/Thomasina_blog.png') }}"  class="img_astro"  alt="">
                                <div class="tos-div thomasina">
                                    <button class="tos-btn tooltips right">
                                        <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                                        <span class="tooltiptext">Terms of Services</span></button>
                                </div>
                                @else
                                <img src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""class="img_astro" alt="">
                                <div class="tos-div">
                                    <button class="tos-btn tooltips right">
                                        <img  class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                                        <span class="tooltiptext">Terms of Services</span></button>
                                </div>
                                @endif
                                
                                <div class="user-photo {{access()->user()->getGender()}}">
                                    <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
                                </div>
                               
                                <div class="navigator-buttons">
                                    <div class="column column-1">
                                        <button class="music-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt="">
                                            <span class="tooltiptext">Music on/off</span></button>
                                        <button class="home-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt="">
                                            <span class="tooltiptext">Home</span></button>
                                    </div>
                                    <div class="column column-2">
                                        <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
                                    </div>
                                    <div class="column column-3">
                                        <button class="participate-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""><span class="">Participate</span></button>
                                        <button class="profile-btn tooltips right">
                                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                                            <span class="tooltiptext">User Profile</span></button>
                                    </div>
                                </div>
                             <button class="zoom-btn zoom-in" ><i class="fas fa-search-plus"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                
                            </button>
                                 <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
                                <div class="instructions-div">
                                    <button class="instructions-btn tooltips right">
                                        <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
                                        <span class="tooltiptext">Instructions</span></button>
                                </div>
                                <button class="communicator-div tooltips top btn_pointer @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom   @else  tomasina @endif" >
                                  
                                </button>
                                <div class="communicator-div tooltips right" style="pointer-events: auto;">
                                    <span >Communicator</span>
                                    <button class="communicator-button"></button>
                                </div>
                                <button class="music-volume-div tooltips top btn_pointer">
                                    <span>Music Volume Up/Down</span>
                                </button>
                               <button class="navigator-zoomout-btn tooltips top">
                                    <i class="fas fa-undo-alt"></i>
                                    <span>Zoom Out</span>
                                </button>
                                {{-- <button class="navigator-zoomout-btn tooltips zoom-in-out">
                                    <span>Zoom Out</span>
                                    <i class="fas fa-undo-alt"></i>
                                </button> --}}
                            </div>
                            
                         {{-- </div> --}}
                    {{--</div> --}}
            </div>
        </div>
        <!-----------astronaut code End-------------->
        <div class="navigator-div-zoomed-in @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
            {{-- <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> --}}
            {{-- <h2 class="planet_name edit-photo" id="zoomedin-edit-photo">Edit Photo</h2> --}}
    
            <div class="navigator-components">
                @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
                    <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/Thomasina_blog.png') }}" alt=""
                    class="astronaut-body">
                    <div class="tos-div thomasina">
                        <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
                    </div>
                @else
                    <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""
                    class="astronaut-body">
                    <div class="tos-div">
                        <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
                    </div>
                @endif
    
                <a href="{{url('profile/edit-photo')}}" class="profilepicture">
                    <img  id="user-photo" class="{{access()->user()->getGender()}}" src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
                </a> 
                {{-- <div class="profile-picture-overlay"></div> --}}
    
                {{-- <button class="navigator-zoom navigator-zoomin tooltips zoom-in-out">
                    <span>Zoom In</span>
                    <i class="fas fa-search-plus"></i>
                </button> --}}
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
                        <button class="profile-btn tooltips right">
                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                            <span class="tooltiptext">User Profile</span></button>
                        {{-- <button class="zoomout-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">Zoom Out</span></button> --}}
                    </div>
                </div>
                <div class="instructions-div">
                    <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
                </div>
                <div class="communicator-div tooltips right">
                    <span>Communicator</span>
                    <button class="communicator-button"></button>
                </div>
                <button class="navigator-zoomout-btn tooltips right">
                    <i class="fas fa-undo-alt"></i>
                    <span class="">Zoom Out</span>
                </button>
                {{-- <button class="navigator-zoomout-btn tooltips zoom-in-out">
                    <span>Zoom Out</span>
                    <i class="fas fa-undo-alt"></i>
                </button> --}}
            </div>
        </div>
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
{{-- <script src="{{asset('front/JS/popper.min.js')}}"></script>--}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
{{-- <script src="//geodata.solutions/includes/countrystatecity.js"></script> --}}
<script src="{{asset('front/JS/countrystatecity.js')}}"></script>

 
 <script>
        // var featureImage = $("form#xyz #file").val();
        
            $(document).ready(function(){
                $('button#submit').on('click', function(event ){
                    var featureImage = $("#featured-image-previewimg").attr('src');
                    
                    // console.log('kkk',featureImage);
                    if(featureImage==''){
                        event.preventDefault();
                            alert_status = true;
                            message = 'Please upload a featured image';
                            // err_message[message] = null;
                            // $("form#aboutme-form  #objective").focus();
                            $("#file").css('border-color', 'red');
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
                            });
                    }
                   
                });
            }); 


            function validateEmail() 
                {
                    var email=$("#company_email").val(); 
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    
                    if(!emailReg.test(email) && email == '') {
                        custom_swal("Error!","Please Enter Valid Email Id","Email");
                        $('#company_email').tooltip();
                        $('#company_email').focus();
                        return false;
                    }
                    else if ( emailReg.test(email) && email !='')
                    {
                    $.ajax({
                        type: "POST",
                        url: url+'/validateemail',
                        data:{company_email:email},
                        headers: {
                                'X-CSRF-Token': $('input[name="_token"]').val() 
                        },
                        success: function(responce) {
                        // console.log(responce);
                        if (responce.status == 'exist') 
                        {
                            // custom_swal("Already Exist!","login into to your account","Email");
                            event.preventDefault();
                            
                            alert_status = true;
                            message = 'Email Already Present';
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
                            });
                            $('#company_email').removeClass('success-alter');
                            $('#company_email').addClass('danger-alter');
                            $('#company_email').tooltip();
                            $('#company_email').css('border','2px solid red');
                            valideemail=false;
                            return false;
                        }
                        if (responce.status == 'not-exist') 
                        {
                            $('#company_email').removeClass('danger-alter');
                            $('#company_email').addClass('success-alter');
                            $('#company_email').css('border','1px solid white');
                        }
                        // console.log('success :'+ responce);
                        }
                    });
                    }
                } 
 </script>   

<script type="text/javascript">
    var url = $('meta[name="url"]').attr('content');
        var ClickCount=0;
    
        
    // Show title on hover

    
            $('.communicator-div').click( function() {
                window.location.href = url+'/communicator';
            });

            $('.home-btn').click( function() {
            
                window.location.href = url;
            });

            $('.profile-btn').click( function() {
                window.location.href = url+'/dashboard';
            });

            $('.instructions-btn').click( function() {
                window.location.href = url+'/page_under_development';
            });
            $('.editphoto-btn').click( function() {
                window.location.href = url+'/profile/edit-photo';
            });
            $('.music-btn').click( function() {
            //   window.location.href = url+'/profile/edit-photo';
            var audio =  document.getElementById('1');
            audio.play();
            });
        
        
        // var astronaut_zoom = 0;


        //     var navigator_zoom = 0;
        //     $('button.zoom-btn').click( function() { 
            
        //         if(!navigator_zoom) {
        //             $('.zoom-btn').hide();
        //             $('.navigator-buttons').css('pointer-events', 'auto');
        //             $('.communicator-div').css('pointer-events', 'auto');
        //             $('.instruction-div').css('pointer-events', 'auto');
        //             $('.toss-div').css('pointer-events', 'auto');
        //             $('.btn_pointer').css('pointer-events', 'auto');
        //             $('.navigator-div').addClass('animate-navigator-zoomin');
                    

        //         $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        //                 $('.navigator-div').removeClass('animate-navigator-zoomin');
        //                 $('.navigator-div').addClass('zoomin');
        //                 $('.zoom-btn').hide();
        //             });
        //         } else {
                
        //         }

        //         navigator_zoom = !navigator_zoom;
        //     });
        //     //Zoom out animation
        //     $('.navigator-zoomout-btn').click(function() {
        //         $('.navigator-div').addClass('animate-navigator-zoomout');

        //         $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        //             $('.navigator-div').removeClass('animate-navigator-zoomout');
        //             $('.navigator-div').removeClass('zoomin');
        //             $('.zoom-btn').show();
                    
        //         });

        //         navigator_zoom = !navigator_zoom;
        //     });


            function removeAstronautAnimation()
            {
                clearInterval(animation_interval);
                // $('.reaction-div').css('transition', 'none');
            }
            $(".tos-div").click(function(){
                    window.location.href = "{{URL::to('/terms')}}"
                        
                    });


            $(".communicator-div").on({
                mouseenter: function () {
                    $('.communicator-span').css('display', 'block');
                },
                mouseleave: function () {
                    $('.communicator-span').css('display', 'none');
                }
            });
            $(".zoom-in").on({
         mouseenter: function () {
            $('.zoom-in span').css('display', 'block');
        },
        mouseleave: function () {
            $('.zoom-in span').css('display', 'none');
            }
    });

    var astronaut_zoom = 0;
        var img_has_loaded = 0;
        $('button.zoom-btn').click( function() {
            if(!astronaut_zoom) {
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
                        $('.navigator-buttons, .tos-div, .instructions-div, .navigator-zoomout-btn, .communicator-div').css('pointer-events', 'auto');
                    });
                }
            }

            astronaut_zoom = !astronaut_zoom;
        });

        $('.navigator-zoomout-btn').click(function() {
            $('button.zoom-btn').fadeIn();

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

            astronaut_zoom = !astronaut_zoom;
        });    
    /*-----------------------PART OF THE IMAGE EDITOR-------------------------*/
    let oldFeaturedImg;
    let isNewImg = true;
    var loadFile = function(event) {
        //changed output to featured-image-previewimg
        var image = document.getElementById('featured-image-previewimg');
        image.src = URL.createObjectURL(event.target.files[0]);
        
        if (typeof image != 'undefined'){
            $('#middle').css('opacity','0');
            $('#middleText').text("Upload Featured Image");
            $('#edit_uploaded_image').css('display','block');
            $('#featured-image-previewimg').css('display','block');
           
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


// -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

    //function called with edit image button is clicked
    $('#edit_uploaded_image').on('click', function(){
        $("#imageEditorModal").css("display","block");
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


    var elem = document.documentElement;
    function openFullscreen() {
        if (elem.mozRequestFullScreen) {  /* Firefox */
        elem.mozRequestFullScreen(); 
        contentDisplay();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
            contentDisplay();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
            contentDisplay();
        }
        else if (elem.requestFullscreen) {
            elem.requestFullscreen();
            contentDisplay();
        } 
        else{
            contentDisplay();
        }
    }

    if(window.innerWidth < 991 ){
        $(document).ready(()=>{
            Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
                    padding: '15px',
                    background: 'rgba(8, 64, 147, 0.62)',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        openFullscreen()
                    }
                });
            });
    }else  contentDisplay();

    function contentDisplay() { 
        setTimeout(function(){
            $(".astro-div").css({'display':'flex'}); 
            $(".page").css({'visibility':'visible'});
            $(".astro-div").css({'visibility':'visible'});
                
                
            $(".page").addClass('animate-zoomIn-arm');
    
            $('.page').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){ 
                $(".page").removeClass('animate-zoomIn-arm');
                $(".page").addClass('zoomIn-arm');
            });

        }, 1000);
    }

    
    
</script>



@endsection