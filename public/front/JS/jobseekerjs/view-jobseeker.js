$('document').ready(function(){
    set_tooltip(false);
});

var url = $('meta[name="url"]').attr('content');

function goto_dashboard(id){
         window.location.href = url+'/user_dashboard/'+id;
}


function hide_details(){
   
    $(".planet-buttons").removeClass("planet-buttons-rollout");
    $(".planet-buttons").removeClass("planet-rollout_profile_back");
    $(".objective").hide();
    $(".objective").css('visibility','hidden');
    $(".about").hide();
    $(".education").hide();
    $(".contacts").hide();
    $(".character_refernces").hide();
    $(".job_description").hide();
    $('#details-text').text('View Detail');
    
    let browser = testBrowser();
    //if ipad
    if(browser === "Safari" && isMediumDevice()){
        $(".bg-div").removeClass("ani-rollout_profile");
        $(".bg-div").css('transform','scale(1)');
    }else{
        $(".bg-div").removeClass("ani-rollout_profile");
        $(".bg-div").addClass("ani-rollout_profile_back");
    }
    $(".bg-div").css({'transform':'scale(1)'});
    $(".bg-div").css({'top':'15vh'});
    $(".featured-img").css({'height':'100%'});
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
$('#details-text').show();
$('#details-text').text('Hide Details');
$(".featured-img").css({'height':'70%'});
$(".objective").show();
$(".objective").css('visibility','visible');
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
set_tooltip(isUserDataVisible);
}

function connect_mail(email){
var primaary_contact='mailto:'+ email;
window.open(primaary_contact);

};


var navigator_zoom = 0;
var img_has_loaded = 0;
$('button.navigator-zoomin').click( function() {
if(!navigator_zoom) {
    if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
        $('.navigator-div').hide();
        $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
        
        $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
        
    } else {
        $(this).fadeOut();
        $('.navigator-div').addClass('animate-navigator-zoomin');

        $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $('.navigator-div').removeClass('animate-navigator-zoomin');
            $('.navigator-div').addClass('zoomin');
        });
    }
    if(isMobile() || isSmallDevice()){
        $('.planet-buttons .tooltips span').css('display','none');
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
if(isMobile() || isSmallDevice()){
        $('.planet-buttons .tooltips span').css('display','block');
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

$('.tos-btn').click( function() {
window.location.href = url+'/terms';
});

$('.instructions-btn').click( function() {
window.location.href = url+'/instructions';
});

$('.participate-btn').click( function() {
window.location.href = url+'/participateMbaye';
});

$('.editphoto-btn').click( function() {
window.location.href = url+'/profile/edit-photo';
});


function edit_profile()
    {
         window.location.href = url+'/jobseekers/edit-setup-profile/';
     }



function show_jobseeker_details(val){
$('.about').css('opacity',val);
$('.education').css('opacity',val);
$('.contacts').css('opacity',val);
$('.character_refernces').css('opacity',val);
$('.job_description').css('opacity',val);
}

function fetch_user_details(profile_id, user_id){
    var post_data={'profile_id':profile_id,'user_id':user_id };
}

function set_tooltip(active){

    if(isMobile() || isSmallDevice()){
        if(!active){  
        $('.planet-buttons .tooltips span').css('display','block');
        $('.edit-buttons .tooltips span').css('display','block');
        }else  $('.planet-buttons .tooltips span').hide();

    }
}
