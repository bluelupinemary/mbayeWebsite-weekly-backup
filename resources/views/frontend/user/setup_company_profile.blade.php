@extends('frontend.layouts.career_setup-profile_layout')

@section('before-styles')

<style>
      
</style>

    <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/CSS/cropper.min.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
    <script src="{{asset('front/JS/cropper.js')}}"></script>

   
@endsection

@section('after-styles')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/CSS/company-profile-astranaut.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}">  --}}
     {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}">  --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
@endsection

@section('content')



    <div id="page-content">
        <div id="container">
            <div class="screen"><br/><br/>

                    <div class="row">
                            <div class="" style="padding-left:5vw;">
                                
                                <form action="{{ route('frontend.saveCompanyProfile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="user-upload-img" id="userImageUpload" >

                                            <label for="file" id="featured-image-label">
                                            <!--changed id of img from outputImage to featured-image-previewimg-->
                                            {{-- <img src="{{asset('front/images/image-add.jpg')}}"  id="featured-image-previewimg"  alt="input image" class="inox img-resize"> --}}
                                            <img src=""  id="featured-image-previewimg"  alt="input image" style=" width: 100%; display:none;">
                                           
                                            <div class="middle" id="middle">
                                                <div id="middleText" style="font-size: 1rem">Upload Featured Image</div>
                                            </div>
                                            </label>
                                            {{-- <button type="button" class="" id="edit_uploaded_image" style="">Edit Image</button>  --}}
                                            <i id="edit_uploaded_image" class="far fa-image btn_pointer  tooltips right" style="color:#16aedc;"> <span style="display:none;font-size:0.8rem; width:6vw;padding:10%; transform: translate(-49%, -209%);" >Edit photo</span></i>
                                           
                                            {{-- <button class="btn" id="edit_uploaded_image"> --}}
                                            <input id="file"  onchange="loadFile(event)"  type="file" name="featured_image" style=" min-width: 100%;
                                            min-height: 100%;">
                                            <!--for the tui editor-->
                                            <input type="hidden" name="edited_featured_image" id="edited_featured_image">
                                            
                                            {{-- <div class="image-edit">
                                                <div class="" id="image-edit-div"> --}}
                                                    {{-- <button type="submit"  id="img-edit" class="img-edit-button">Edit Photo</button> --}}
                                                    
                                                {{-- </div>
                                            </div> --}}
                                            

                                    </div>
                                    <small class="error">{{ $errors->first('featured_image') }}</small>
                                    {{-- ----------------------------------Image Edit Code------------------------------------- --}}
                                    {{-- <div class="user-upload-img"></div> --}}
                                    <!--changed button class name from img-edit-button to edit_image-->
                                    {{-- <button type="button" class="" id="">Edit Image</button> --}}
                                    
                                    
                                {{-- ----------------------------------END---------------------------------------------------- --}}
                            </div>
                            <!-- ---------------------Form code start-------------------------------------------- -->

                            <div class="column2">
                                 <div class="heading"><h2 style="color:white; background-color:#082545; text-align:center;">Set Up Company Profile</h2></div>
                                 <div class="form">
                                    
                                            <div class="input-fields">
                                                <label for="Cname">Company Name :<span style="color:red">*</span></label>
                                                <input type="text" id="company_name" name="company_name" required>
                                            </div><br/>
                                            <div>
                                                <label for="Cadd">Company Email :<span style="color:red">*</span></label>
                                                <input type="email" class="form-control {{ $errors->has('company_email') ? 'error' : '' }}" id="company_email" name="company_email" required>
                                                {{-- @if ($errors->has('company_email'))
                                                <div class="error">
                                                    {{ 'Email is already taken' }}
                                                </div>
                                                @endif --}}
                                                <small class="error">{{ $errors->first('company_email') }}</small>
                    
                                               
                                            </div>
                                            
                                            <br/>
                                            <div>
                                                <label for="country">Company Address :<span style="color:red">*</span></label>
                                                <input type="text" id="company_address" name="address" required>
                                            </div><br/>
                                        
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="country">Country :<span style="color:red">*</span></label>
                                                        <select class="countries" name="country" id="countryId"  required>&#x25BC;
                                                            <option value="" selected disabled>Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="state">State :<span style="color:red">*</span></label>
                                                        <select id="stateId" class="states" name="state" required>
                                                            <option value="" selected disabled>Select State</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="city">City :<span style="color:red">*</span></label>
                                                        <select id="cityId" class="cities" name="city" required>
                                                            <option value="" selected disabled>Select City</option>
                                                        </select>
                                                    </div>
                                            </div><br/>
                                                    <div class="mobile-no">
                                                            <label for="mobile">Mobile :<span style="color:red">*</span></label>
                                                            <input type="number" class="form-control {{ $errors->has('company_phone_number') ? 'error' : '' }}" id="mob_no" name="company_phone_number" required>
                                                            <small class="error">{{ $errors->first('company_phone_number') }}</small>

                                                    </div>
                                                    {{-- @if ($errors->has('company_phone_number'))
                                                    <div class="error">
                                                        {{ 'Enter valid mobile number' }}
                                                    </div>
                                                    @endif --}}
                                                    <br/>
                                                        <div class="industry">
                                                            <label for="industry">Industry :<span style="color:red">*</span></label>
                                                            <select id="industry" class="" name="industry_id" required>&#x25BC;
                                                                <option value="select" selected disabled>Select industry</option>
                                                                @foreach($industry as $industry)
                                                                <option value="{{$industry->id}}">{{$industry->industry_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="owner_id" value="{{Auth::user()->id}}">
                                            <div class="form-btn">
                                                <button type="submit"  class="button-done">Submit</button>
                                            </div>
                                        </form>
                                        
                                </div>
                            </div>
                       
                            <!-- ---------------------Form code End-------------------------------------------- -->

                    </div>
                    {{-- <div class="row">--}}
                        <div class="column3"> 
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
                                        <button class="tooltips right ">
                                         <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
                                        <button class="profile-btn tooltips right">
                                            <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                                            <span class="tooltiptext">User Profile</span></button>
                                    </div>
                                </div>
                             <button class="zoom-btn zoom-in" ><i class="fas fa-search-plus"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                
                            </button>
                                 <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
                                <div class="instructions-div btn_pointer tooltips right">
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
                               <button class="navigator-zoomout-btn">
                                    <i class="fas fa-undo-alt"></i>
                                    {{-- <span>Zoom Out</span> --}}
                                </button>
                                {{-- <button class="navigator-zoomout-btn tooltips zoom-in-out">
                                    <span>Zoom Out</span>
                                    <i class="fas fa-undo-alt"></i>
                                </button> --}}
                            </div>
                            <!-- ---------------------astronaut code End-------------------------------------------- -->

                         </div>
                    {{--</div> --}}
            </div>
        </div>
    </div>
    

<div class="app">
    <!----------------------------------------DIV FOR THE IMAGE EDITOR 1------------------------------------------>
    <div class="image-editor-modal" id="imageEditorModal">
        <imageeditor-component :edit_blog="1"></imageeditor-component>
     </div>
     <!----------------------------------------END OF DIV FOR THE IMAGE EDITOR 1------------------------------------------>
 
     <!----------------------------------------DIV FOR THE TUI IMAGE EDITOR 2------------------------------------------>
     <div class="tui-editor-modal" id="tuiEditorModal">
         <tuieditor-component></tuieditor-component>
     </div>
      <!---------------------------------------END OF DIV FOR THE TUI IMAGE EDITOR 2------------------------------------------>

</div> <!--end of app-->






@endsection
@section('after-scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
{{-- <script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script> --}}
<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>

 
    

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
        
        
        var astronaut_zoom = 0;


            var navigator_zoom = 0;
            $('button.zoom-btn').click( function() { 
            
                if(!navigator_zoom) {
                    $('.zoom-btn').hide();
                    $('.navigator-buttons').css('pointer-events', 'auto');
                    $('.communicator-div').css('pointer-events', 'auto');
                    $('.instruction-div').css('pointer-events', 'auto');
                    $('.toss-div').css('pointer-events', 'auto');
                    $('.btn_pointer').css('pointer-events', 'auto');
                    $('.navigator-div').addClass('animate-navigator-zoomin');
                    

                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.navigator-div').removeClass('animate-navigator-zoomin');
                        $('.navigator-div').addClass('zoomin');
                        $('.zoom-btn').hide();
                    });
                } else {
                
                }

                navigator_zoom = !navigator_zoom;
            });
            //Zoom out animation
            $('.navigator-zoomout-btn').click(function() {
                $('.navigator-div').addClass('animate-navigator-zoomout');

                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomout');
                    $('.navigator-div').removeClass('zoomin');
                    $('.zoom-btn').show();
                    
                });

                navigator_zoom = !navigator_zoom;
            });


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
