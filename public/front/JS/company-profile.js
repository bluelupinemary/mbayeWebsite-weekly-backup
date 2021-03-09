$(window).load(function() {
    $('.astro-div').css('display', 'flex').hide().fadeIn();
    window_scroll();
    testOrientation();

});

$(document).ready(function(e){
    set_tooltip();
    if(isMobile()){ 
        var origContentDisplay = contentDisplay;
          contentDisplay = function() { 
            $('#fullscreenIcon').hide();
          return origContentDisplay();
        }
    }
}); 


function check_status(){
    
           Swal.fire({
                title: 'Company profile saved successfully!',
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.88)',
                showCloseButton: true,
                focusConfirm: true,
                confirmButtonText:'Ok',
                allowOutsideClick: false,
                customClass: {
                    title : 'company-popup-title',
                }
            }).then((result) => {
                    if (result.value) {
                        window.location.href = '/company/view-company-profile/'+ user_id;                          
                    }
                });
        
}


function set_tooltip(){

    if(isMobile() || isSmallDevice()){
        $('.fa-image span').css('display','block');
        $('.zoom-btn span').css('display','block');
        
    }
}

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
            console.log('jjj');
        $.ajax({
            type: "POST",
            url: url+'/validateemail',
            data:{company_email:email},
            headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val() 
            },
            success: function(responce) {
                if (responce.status == 'exist') 
                {
                    event.preventDefault();
                    
                    alert_status = true;
                    message = 'Email already taken.';
                    Swal.fire({
                        title: 'Error!',
                        text: message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.88)',
                        showCloseButton: true,
                        focusConfirm: true,
                        confirmButtonText:
                            'Ok',
                        confirmButtonColor: '#3085d6',
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
            }
        });
        }
    } 

var url = $('meta[name="url"]').attr('content');
var ClickCount=0;



// Show title on hover


$('.communicator-div').click( function() {
    window.location.href = url+'/communicator';
});

$('.home-btn').click( function() {

    window.location.href = url;
});

$('.participate-btn').click( function() {

    window.location.href = url+'/participateMbaye';
});

$('.profile-btn').click( function() {
    window.location.href = url+'/dashboard';
});

$('.instructions-btn').click( function() {
    window.location.href = url+'/instructions';
});
$('.editphoto-btn').click( function() {
    window.location.href = url+'/profile/edit-photo';
});
$('.music-btn').click( function() {
var audio =  document.getElementById('1');
audio.play();
});


function removeAstronautAnimation()
{
    clearInterval(animation_interval);
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


var astronaut_zoom = 0;
var navigator_zoom = 0;
$('button.zoom-btn').click( function() { 
if(!navigator_zoom) {
    $('.zoom-btn').hide();
    $('.page-title').hide();
    $('.navigator-div').addClass('animate-navigator-zoomin');
    $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $('.navigator-div').removeClass('animate-navigator-zoomin');
        $('.navigator-div').addClass('zoomin');
        $('.page-title').hide();
        $('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'auto');
    });
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
$('.page-title').show();
$('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'none');
});
navigator_zoom = !navigator_zoom;
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


function validate_company_fields(){
    var featureImage = $("#featured-image-previewimg").attr('src');
    var company_name = $("#company_name").val();
    var company_email = $("#company_email").val();
    var company_addr = $("#company_address").val();
    var country = $("#countryId").val();
    var state = $("#stateId").val();
    var city = $("#cityId").val();
    var company_mob = $("#mob_no").val();
    var industry = $("#industry").val();
    var err_message = {};  
    var alert_status = false; 
    if(featureImage==''){
    event.preventDefault();
        alert_status = true;
        message = 'Featured image is required';
        err_message[message] = null;
        $("#file").css('border-color', 'red');
    }else{
        $("#file").css('border-color', 'green');
    }

    if(company_name==''){
    event.preventDefault();
        alert_status = true;
        message = 'Company name is required';
        err_message[message] = null;
        $("#company_name").css('border', '1px solid red');
    }else{
        $("#company_name").css('border-color', 'green');
    }

    if(company_email==''){
    event.preventDefault();
        alert_status = true;
        message = 'Company email is required';
        err_message[message] = null;
        $("#company_email").css('border', '1px solid red');
    }else{
        $("#company_email").css('border-color', 'green');
    }

    if(company_addr==''){
    event.preventDefault();
        alert_status = true;
        message = 'Company address is required';
        err_message[message] = null;
        $("#company_address").css('border', '1px solid red');
    }else{
        $("#company_address").css('border-color', 'green');
    }

    if(country=='' || country==null){
    event.preventDefault();
        alert_status = true;
        message = 'Country is required';
        err_message[message] = null;
        $("#countryId").css('border', '1px solid red');
    }else{
        $("#countryId").css('border-color', 'green');
    }

    if(state=='' || state==null){
    event.preventDefault();
        alert_status = true;
        message = 'State is required';
        err_message[message] = null;
        $("#stateId").css('border', '1px solid red');
    }else{
        $("#stateId").css('border-color', 'green');
    }

    if(company_mob==''){
    event.preventDefault();
        alert_status = true;
        message = 'Mobile No. is required';
        err_message[message] = null;
        $("#mob_no").css('border', '1px solid red');
    }else{
        $("#mob_no").css('border-color', 'green');
    }

    if(industry=='' || industry==null){
    event.preventDefault();
        alert_status = true;
        message = 'Industry is required.';
        err_message[message] = null;
        $("#industry").css('border', '1px solid red');
    }else{
        $("#industry").css('border-color', 'green');
    }
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
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.88)',
            showCloseButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Ok',
            confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#submit').text("Submit");
                $('#submit').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit').prop("disabled",false);
                return false;
            }else{
                $('#submit').text("Submit");
                $('#submit').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit').prop("disabled",false);
            }
        });
    }else{
        //no errors found
        return true;
    }

}

$('#company_name,#company_email,#company_address,#countryId,#stateId,#cityId,#mob_no,#industry').on('change',function(){
$(this).css('border','');
});

window.addEventListener("resize", function () {
    testFullscreen();
    testOrientation();
});

function window_scroll(){
    if(isMobile() && (testBrowser() === 'Chrome' || testBrowser() === 'Safari')){
        var element = document.getElementById("row");
        element.classList.remove("row");
        element.classList.add("image-form-row");
    }
}



// ------------------------------------AJax for company form submit----------------------------------------------

$('#submit').click(function(e) {
    e.preventDefault();
    var form_url = route;
    var $form = $('form#xyz');
    var post_data = new FormData($form[0]);
    var isValid = validate_company_fields();
    

   if(isValid){
            $('#submit').text("saving..");
            $('#submit').css({'background-color':'grey','cursor':'disabled'});
            $('#submit').prop("disabled",true);
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#submit').text("Submit");
                    $('#submit').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                    $('#submit').prop("disabled",false);
                    check_status();
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
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });//end of ajax
                    
    }//end of if
}); //end of submit button
