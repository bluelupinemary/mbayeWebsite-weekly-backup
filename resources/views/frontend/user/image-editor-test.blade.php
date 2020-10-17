@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>



    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/CSS/cropper.min.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    {{-- <script src="{{asset('front/JS/jquery.fontselect.js')}}"></script> --}}
    <script src="{{asset('front/JS/cropper.js')}}"></script>
   
   
@endsection

@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/CSS/image-editor-test.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
@endsection

@section('content')
<div class="app">
    <div id="page-content">
        <div class="container">
                <div class="screen"><br/><br/>

                        <div class="row">
                                <div class="column1">
                                    <div class="user-upload-img">
                                            <label for="file">

                                            <!--changed img id from output to featured-image-previewimg-->
                                            <img src="{{asset('front/images/image-add.jpg')}}" id="featured-image-previewimg" alt="input image" class="inox" width=100%>
                                            <p class="img-description">Edit Featured Image.</p>
                                            </label>
                                            
                                            <input id="file"  onchange="loadFile(event)" type="file" />
                                            <input type="hidden" name="edited_featured_image" id="edited_featured_image">
                                    </div>
                                
                                </div>
                                <button class="edit_image" id="edit_uploaded_image" style="    left: 3vw;
                                          display: block;
                                          width: 8vw;
                                          height: 7vh;
                                          position: absolute;
                                          top: 40vh; color:white;background-color:black;font-size:1em;">
                                        Edit Image
                                </button>
                                 
                                <!-- ---------------------Form code start-------------------------------------------- -->

                                <div class="column2">
                                    <div class="heading"><h2 style="color:white; background-color:#082545; text-align:center;">Set Up Company Profile</h2></div>
                                    <div class="form">
                                        <form action="/action_page.php">
                                                <div>
                                                    <label for="Cname">Company Name :<span style="color:red">*</span></label>
                                                    <input type="text" id="Cname" name="Cname" required>
                                                </div><br/>
                                                <div>
                                                    <label for="Cadd">Company Email :<span style="color:red">*</span></label>
                                                    <input type="text" id="Cadd" name="Cadd" required>
                                                </div><br/>
                                                <div>
                                                    <label for="country">Company Address :<span style="color:red">*</span></label>
                                                    <input type="text" id="Cemail" name="Cemail" required>
                                                </div><br/>
                                            
                                                <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="country">Country :<span style="color:red">*</span></label>
                                                            <select class="countries" name="country" id="countryId" required>&#x25BC;
                                                                <option value="">Select</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="state">State :<span style="color:red">*</span></label>
                                                            <select id="stateId" class="states" name="state" required>
                                                                <option value="">Select State</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="city">City :<span style="color:red">*</span></label>
                                                            <select id="cityId" class="cities" name="city" required>
                                                                <option value="">Select City</option>
                                                            </select>
                                                        </div>
                                                </div><br/>
                                                        <div class="mobile-no">
                                                                <label for="mobile">Mobile :<span style="color:red">*</span></label>
                                                                <input type="text" id="Cemail" name="Cemail" required>
                                                        </div><br/>
                                                            <div class="industry">
                                                                <label for="industry">Industry :<span style="color:red">*</span></label>
                                                                <select id="industry" name="industry" required>&#x25BC;
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                <div class="form-btn">
                                                    <button type="submit" class="button-done">Done</button>
                                                </div>
                                            
                                            </form>
                                    </div>
                                </div>
                                <!-- ---------------------Form code End-------------------------------------------- -->

                        </div>
                        <div class="row">
                            <div class="column3">
                                <!-- ---------------------astronaut code start-------------------------------------------- -->
                                <div class="astro-div navigator-div  tom " style="display:flex; visibility:visible;">
                                    <img src="{{asset('front/images/astronut/Tom_blog.png')}}" alt="" class="astro">
                                    <div class="toss-div">
                                        <button class="toss-btn tooltips right" style="pointer-events:auto;">
                                            <img  class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                                            <span class="tooltiptext">Terms of Services</span>
                                        </button>
                                    </div>
                                    <div class="user-photo male">
                                        <img src="http://127.0.0.1:8000/storage/profilepicture/default.png"/>
                                    </div>
                                    <div class="tag-title male">
                                                        <img src="{{asset('front/images/planets/Pluto.png')}}"/>  
                                        
                                    </div>
                                    <div class="navigator-buttons" style="pointer-events:auto;">
                                        <div class="column column-1">
                                            <button class="music-btn tooltips left"><img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/musicBtn.png')}}" alt="" style="pointer-events:auto;">
                                                <span class="tooltiptext">Music on/off</span></button>
                                            <button class="home-btn tooltips left"><img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/homeBtn.png')}}" alt="">
                                                <span class="tooltiptext">Home</span></button>
                                        </div>
                                        <div class="column column-2">
                                            <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/greenButtons.png')}}" alt=""><span class="">Edit Profile Photo</span></button>
                                        </div>
                                        <div class="column column-3">
                                            <button class="tooltips right ">
                                            <img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/freeBtn.png')}}" alt=""></button>
                                            <button class="profile-btn tooltips right">
                                                <img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/profileBtn.png')}}" alt="">
                                                <span class="tooltiptext">User Profile</span>
                                            </button>
                                        </div>
                                    </div>
                                    <button class="zoom-btn zoom-in"><i class="fas fa-search-plus"></i></button>
                                    <div class="instructions-div btn_pointer tooltips right" style="pointer-events:auto">
                                        <button class="instructions-btn tooltips right">
                                            <img class="btn_pointer" src="{{asset('front/images/astronut/navigator-buttons/instructionsBtn.png')}}" alt="">
                                            <span class="tooltiptext">Instructions</span>
                                        </button>
                                    </div>
                                    <button class="communicator-div tooltips top btn_pointer tom" style="pointer-events: auto;"></button>
                                    <div class="comm-btn  top btn_pointer">
                                        <span class="communicator-span    tooltips_span tooltiptext" style="display:none;" >Communicator</span>
                                    </div>
                                    <button class="music-volume-div tooltips top btn_pointer" style="pointer-events:auto;">
                                        <span>Music Volume Up/Down</span>
                                    </button>
                                    <button class="navigator-zoomout-btn">
                                        <i class="fas fa-undo-alt"></i>
                                    </button>
                                </div>
                                <!-- ---------------------astronaut code End-------------------------------------------- -->



                            </div>
                        </div>
                </div>
        </div>
    </div>

    
    <!----------------------------------------DIV FOR THE IMAGE EDITOR 1------------------------------------------>
    <div class="image-editor-modal" id="imageEditorModal">
       <testingeditor-component :in_page="'setupJobseekerProfile'"></testingeditor-component>
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
<script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>

<script>
let oldFeaturedImg;
let isNewImg = true;
var loadFile = function(event) {
    //changed output to featured-image-previewimg
    var image = document.getElementById('featured-image-previewimg');
    image.src = URL.createObjectURL(event.target.files[0]);
    
    if(oldFeaturedImg != image.src){
        oldFeaturedImg = image.src;
        isNewImg = true;
    }
};



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









</script>
<script type="text/javascript">

    
    var url = $('meta[name="url"]').attr('content');
    var ClickCount=0;


    (function () {
    
        $(".img-nouvela").removeClass("ani-rollout_naff");
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
            document.getElementById('block_land').style.display = (screen.width>screen.height) ? 'none' : 'block';
            //above condition is not working sometimes then this condition will work
            if(window.innerHeight< window.innerWidth)
                {
                    document.getElementById('block_land').style.display = 'none' ;
                }
                else{
                    document.getElementById('block_land').style.display =  'block';
                }
        }

        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .overlay").css({'display':'none'});   
            $("#clicked_img .div_title").css({'display':'none'});   
            $("#clicked_img .div_btn").css({'display':'none'});
            $(".div_overlay").removeClass("div_overlay_p");
            $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'unset','left':'0'});
            $(".blog-buttons_overlay .button-div").css({'flex-direction':'unset'});
            $('div.cell').removeAttr('id');
            $(this).attr('id','clicked_img');
            var clicked_img_id = $(this).attr('id');
            var img = $("#clicked_img> a>img");
            var pos = $("#clicked_img> a>img").position();
            var  top=$("#clicked_img> a>img").css("top");
            var  left=$("#clicked_img> a>img").css("left");
            var  width=$("#clicked_img> a>img").css("width");
            var  height=$("#clicked_img> a>img" ).css("height");
         
            $("#clicked_img .overlay").css({'display':'flex'});
            $("#clicked_img .div_title").css({'display':'block'});
            $("#clicked_img .div_btn").css({'display':'block'});

           /* for checking orientation of an image*/

            if (img.width() > img.height()){
                var differernce=img.width() -img.height();
            }

         if (img.width() > img.height()){
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
              $(".blog-buttons_overlay").css({'top':'50%','left':'50%','width':'82%','transform':'translate(-49%, -67%)'});
           
            } 
            else {
              $(".div_overlay").addClass("div_overlay_p");
              $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'column','top':'50%','left':'50%','width':'82%','transform':'translate(-29%, -67%)'});
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
            } 
   
});

    })();
// Show title on hover
$('.main-naff').mouseover(function() { 

//alert("mouseover")
	$(this).find('.blog_name').addClass('animated zoomIn');
	$(this).find('.blog_name').css('opacity', '1');
}).mouseout(function() { 
    //alert("mouseout")
	$(this).find('.blog_name').removeClass('animated zoomIn');
	$(this).find(' .blog_name').css('opacity', '0');
});
    $('.img-button').hover(
            function () {
                $(this).parent().find('span').show();
            },
            function () {
                $(this).parent().find('span').hide();
            }
        );
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
    
    
    
   
    var zoomTimer = null;
    
    function refreshImage(elem, cell)
    {
        if (cell.iszoomed)
        {
            return;
        }
    
        if (zoomTimer)
        {
            clearTimeout(zoomTimer);
        }
        
        var zoomImage = jQuery('<img class="zoom"></img>');
    
        zoomTimer = setTimeout(function ()
        {
            zoomImage.load(function ()
            {
                layoutImageInCell(zoomImage[0], cell.div[0]);
                jQuery(elem).replaceWith(zoomImage);
                cell.iszoomed = true;
            });
    
            zoomImage.attr("src", cell.info.zoom);
    
            zoomTimer = null;
        }, 2000);
    }
    //this is for sizing images through cell height, cell weidth, image height, image weidth
    function layoutImageInCell(image, cell)
    {

        var iwidth = image.width;
        var iheight = image.height;
        var cwidth = jQuery(cell).width();
        var cheight = jQuery(cell).height();
        var ratio = Math.min(cheight / iheight, cwidth / iwidth);
        
        iwidth *= ratio;
        iheight *= ratio;
        //for putting image in center
    
        image.style.width = Math.round(iwidth) + "px";
        image.style.height = Math.round(iheight) + "px";
    
        image.style.left = Math.round((cwidth - iwidth) / 2) + "px";
        image.style.top = Math.round((cheight - iheight) / 2) + "px";

        var width_for_count=Math.round(iwidth) + "px";
        var height_for_count= Math.round((iheight) /5)+ "px";
        var top_for_count= Math.round((cwidth - iwidth) / 2) + "px";
        var left_for_count= Math.round((cheight - iheight) / 2) + "px";
  
       $(".div_count").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                            left:left_for_count+"px",top:"80%",'opacity':'35%'});


     
       $(".div_img .div_count_text").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                                 left:left_for_count+"px",top:"80%"});

                                                
    }

   

/* Function to redirect to view Blog */

function viewBlog(id){  
    var url="/single_general_blog/"+id;
    window.open(
        url,
  '_blank' // <- This is what makes it open in a new window.
);
var audio = document.getElementById("one");
audio.pause();
  
}
/**
 * Function to play music
 * */

function play_note(id){
    $(".img-nouvela").removeClass("ani-rollout_naff");
    var clsOverlay=id +" .blog-buttons_overlay  .button-div .button-details .naff-number";
    var naffCount=$("."+clsOverlay).html();
   
    if(naffCount==555){
        var audio = document.getElementById("fart");
            audio.play();
            $("#overlay").css({'display':'none'});
            $(".img-nouvela").removeClass("ani-rollout_naff");
            $(".img-nouvela").css({'display':'block','z-index':'1000'});
            $(".img-nouvela").addClass("ani-rollout_naff");
            setTimeout(function(){
                  $(".img-nouvela").removeClass("ani-rollout_naff");
                  $(".img-nouvela").css({'display':'none'});
                  $("#overlay").css({'display':'none'});
                }, 3000);
    }
else{

    var playist=id%28;
    if(playist==0)
    {
        var audio = document.getElementById("1");
        audio.play();
    }
   else
    {
        myVar = id+1;
        var audio =  document.getElementById(myVar);
        audio.play();
    }
}
}
function largest(hot_count,cool_count,naff_count,i)
	{
        hot_count=parseInt(hot_count);
        cool_count=parseInt(cool_count);
        naff_count=parseInt(naff_count);
		
     
		if(hot_count>cool_count && hot_count>naff_count)
		{
        
           $(".div_count_bg"+i).css({'background-color':'rgba(216, 7, 7, 0.5)'});
        }
		else if(cool_count>hot_count && cool_count>naff_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(0, 118, 163, 0.5)'});
		}
		else if(naff_count>hot_count && naff_count>hot_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(199, 189, 0, 0.5)'});
        }
        else if(hot_count==0 && naff_count==0 && cool_count==0)
		{
            $(".div_count_bg"+i).css({'background-color':'#00800052'});
		}

	}

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
        $(".toss-div").click(function(){
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


           
    </script>

<!-- <script>
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
     $('.img-button').hover(
            function () {
                $(this).parent().find('span').show();
            },
            function () {
                $(this).parent().find('span').hide();
            }
        );
        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });
     $(".communicator-div").on({
    mouseenter: function () {
        $('.communicator-span').css('display', 'block');
    },
    mouseleave: function () {
        $('.communicator-span').css('display', 'none');
    }
});
</script> -->
@endsection
