$(window).load(function() {
    $('.astro-div').css('display', 'flex').hide().fadeIn();
    window_scroll();
    $('#fullscreenIcon').hide();
});

$(document).ready(function(e){
    testOrientation();
    set_tooltip();
}); 
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

        $('.participate-btn').click( function() {
            window.location.href = url+'/participateMbaye';
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
        $('#userDashboard').click( function() {
            window.location.href = url+'/dashboard';
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

function edit_profile()
            {
                 window.location.href = url+'/company/setup-profile/'+ id;
             }

$('[data-toggle="tooltip"]').tooltip();   


// -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//



function zoomImage(){
    $(".column2").css("display","none");
    $(".user-upload-img").css("display","none");
    $(".heading").css("display","none");
    $(".zoomed_div").css("display","block");
}

function zoomImageBack(){
    $(".zoomed_div").css("display","none");
    $(".column2").css("display","block");
    $(".user-upload-img").css("display","block");
    $(".heading").css("display","block");
   
}

function set_tooltip(){
    if(isMobile() || isSmallDevice()){
        $('.edit span').css('display','block');
        $('.zoom-btn span').css('display','block');
        $('.view-profile-button.tooltipps span').css('display','block');
    }
}

function window_scroll(){
    if(isMobile() && (testBrowser() === 'Chrome' || testBrowser() === 'Safari')){
        var element = document.getElementById("row");
        element.classList.remove("row");
        element.classList.add("image-form-row");
    }
}

window.addEventListener("resize", function () {
    testOrientation();
});