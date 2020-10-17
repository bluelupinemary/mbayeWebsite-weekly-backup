var message;
var err_message;
var terms_labels = [ "TERMS OF SERVICES", "COPYRIGHT CLAIMS" ,"PRIVACY POLICY", "SRA"];
var url = $('meta[name="url"]').attr('content');
var index=0;
// for showing message to turn to landscape 
//   testOrientation();
// window.addEventListener("orientationchange", function(event) {
//     testOrientation();
// }, false);

// window.addEventListener("resize", function(event) {
//     testOrientation();
// }, false);
$(document).ready(function() {
    $('.home-div').css('pointer-events', 'auto');
    $('.back-div').css('pointer-events', 'auto');
    $(".terms_and_conditions").css({"display":'block'});
    $(".head-div .title").html('TERMS OF SERVICES')
   

      
    // var elem = document.documentElement;
    // function openFullscreen() {
    //     if (elem.mozRequestFullScreen) {  /* Firefox */
    //     elem.mozRequestFullScreen(); 
    //     contentDisplay();
    //   } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    //     elem.webkitRequestFullscreen();
    //     contentDisplay();
    //   } else if (elem.msRequestFullscreen) { /* IE/Edge */
    //     elem.msRequestFullscreen();
    //     contentDisplay();
    //   }
    //   else if (elem.requestFullscreen) {
    //     elem.requestFullscreen();
    //     contentDisplay();
    //   } 
    //   else{
    //   //alert("iphone")
    //     contentDisplay();
    //   }
    
    // }
    // if(window.innerWidth < 991 ){
    // $(document).ready(()=>{
    //     Swal.fire({
    //             imageUrl: '../../front/icons/alert-icon.png',
    //             imageWidth: 100,
    //             imageHeight: 100,
    //             html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
    //             padding: '15px',
    //             background: 'rgba(8, 64, 147, 0.62)',
    //             allowOutsideClick: false
    //         }).then((result) => {
    //             if (result.value) {
    //                 openFullscreen()
    //             }
    //         });
    //     });
    // }
    // else  contentDisplay();
    
    // function contentDisplay() { 
    //         setTimeout(function(){
    //           $(".page").css({'visibility':'visible'});
    //           $(".page").addClass('animate-zoomIn-arm');
    //           $('.page').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){ 
    //           $(".page").removeClass('animate-zoomIn-arm');
    //           $(".page").addClass('zoomIn-arm');
    //           });
    //           }, 1000
    //           );
    //     }
    // Write all the labels 
 
    var label_Prev=terms_labels[terms_labels.length-1];
    var label_Next=terms_labels[1];
    $('.prev_label').html(label_Prev);
    $('.next_label').html(label_Next);
  });

$(".prev" ).click(function(){ 
    prev_terms();
});
$(".next" ).click(function(){
    next_terms();
});

function next_terms() {
  var len=terms_labels.length;
   index=index+1;
   if(index==terms_labels.length)
     index=0;
  var previous = terms_labels[(index+len-1)%len];
var next = terms_labels[(index+1)%len];
var current = terms_labels[index];
  $('.next_label').html(next);
  $('.prev_label').html(previous);
  change_page(current);
 
}

function prev_terms() {
  var len=terms_labels.length;
   index=index-1;
   console.log("index"+index)
   if(index==terms_labels.length)
     index=0;
  else if(index<0)
     index=terms_labels.length-1;

  var previous = terms_labels[(index+len-1)%len];
var next = terms_labels[(index+1)%len];
var current = terms_labels[index];
  $('.next_label').html(next);
  $('.prev_label').html(previous);
  change_page(current);
}
function prev(){
        var prev_val = document.getElementById( "prev_no" ).value; 
        var prev = document.getElementById( "no" ).value;
          var prev = Number(prev) - 1;
          if(prev<= -1)
          {
              prev = terms_labels.length - 1;
          }

         var prev_val = Number(prev_val) - 1;
            if(prev_val<= -1)
            {
              prev_val = terms_labels.length - 1;
            }
         
        document.getElementById( "prev_no" ).value = prev_val;
        var label=terms_labels[prev_val-1];
        console.log(terms_labels);
        console.log("prev_val"+prev_val)
        $('.prev_label').html(label);
        document.getElementById( "no" ).value = prev;
        var type= terms_labels[prev]; 
         change_page(type);
}
function next(){
        var next_val = document.getElementById( "next_no" ).value;
        var next = document.getElementById( "no" ).value;
        var next = Number(next)+1;
        if(next >= terms_labels.length)
        {
          next = 0;
        }
        var next_val = Number(next_val)+1;
        if(next_val >= terms_labels.length)
        {
          next_val = 0;
        }
        console.log(terms_labels);
        console.log("next_val"+next_val)
        document.getElementById( "next_no" ).value = next_val;
        var label=terms_labels[next_val];
        var prev_val=next-1;
        console.log("next"+next)
        console.log("prev_val"+prev_val)
        if(prev_val<= -1)
          prev_val=terms_labels.length-1;
        // else if(prev_val==0)
        //   prev_val=terms_labels.length
        console.log("prev_val"+prev_val)
        var label_previous=terms_labels[prev_val]; 

        console.log(label_previous)
        $('.next_label').html(label);
        $('.prev_label').html(label_previous);
        document.getElementById( "no" ).value = next;
        var type= terms_labels[next]; 
        change_page(type);
}

$('.home-div').click(function() {
  window.location.href = url;
});

$('.back-button').click(function() {
  var myurl = $('#myurl').attr('url');
  window.location.href = myurl;
});

          
function change_page(type){
    $(".terms_and_conditions").css({"display":'none'});
    $(".privacy_policy").css({"display":'none'});
    $(".copy_right_claims").css({"display":'none'});
    $(".sra").css({"display":'none'});

      if(type=='PRIVACY POLICY'){
        $(".privacy_policy").css({"display":'block'});
        $(".head-div .title").html('PRIVACY POLICY')
      }
      else if(type=='TERMS OF SERVICES'){
        $(".terms_and_conditions").css({"display":'block'});
        $(".head-div .title").html('TERMS OF SERVICES')
      }
      else if(type=='COPYRIGHT CLAIMS'){
        $(".copy_right_claims").css({"display":'block'});
        $(".head-div .title").html('COPYRIGHT CLAIMS')
      }
      else if(type=='SRA'){
        $(".sra").css({"display":'block'});
        $(".head-div .title").html('SRA')
      }
      else{
        $(".privacy_policy").css({"display":'block'});
      }

}

// get URl parameter value
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
}

$(window).load(function() {
    $('.start-div').click();
        $(".astronautarm-img").show();
        $('.main-form').hide();
        $(".astronautarm-img").addClass('animate-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-arm');
          
          //  $(".start-div").animate({opacity:2},500);
        });
    
});

function testOrientation() {
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

// Zoom in arm
$('.start-div').click( function() {
    $(this).hide();
    
    // $(".astronautarm-img").addClass('animate-zoomIn-arm');

    $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $(".astronautarm-img").removeClass('animate-zoomIn-arm');
        // $(".astronautarm-img").addClass('zoomIn-arm');
        // $(".blog-btn").delay(1000).animate({opacity:1},100);
        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a').css('pointer-events', 'auto');
        $('.blog-btn').addClass('active');
        showTermsSection();
    });
});

function showTermsSection(){
    $('.main-form').show();
}
// show fullscreen trix editor
$('.fullscreen ').click(function() { 
    $('.form-fullview' ).html($('.full_form_full').html());
    $('.head-div_full' ).html($('.head-div').html());
    var type=$('.head-div_full .title' ).html();
    change_page_for_full(type);
    $('.next_label_full' ).html($('.next_label').html());
    $('.prev_label_full' ).html($('.prev_label').html());
   
    $('.form-fullview').fadeIn();
});


// hide/show blog submenu
$('.blog-btn').click(function() {
    $('.blog-submenu').fadeToggle();
});

// hide/show fullscreen button
$('button.fullscreen').toggle(
    function() {
        $(this).find('span').css('max-width', '7rem');
    },
    function() {
        $(this).find('span').css('max-width', '0');
    }
);

function next_terms_full() {
  var len=terms_labels.length;
   index=index+1;
   if(index==terms_labels.length)
     index=0;
  var previous = terms_labels[(index+len-1)%len];
var next = terms_labels[(index+1)%len];
var current = terms_labels[index];
  $('.next_label_full ').html(next);
  $('.prev_label_full ').html(previous);
  $('.next_label').html(next);
  $('.prev_label').html(previous);
  change_page_for_full(current);
  change_page(current);
 
}

function prev_terms_full() {
  var len=terms_labels.length;
   index=index-1;
   if(index==terms_labels.length)
     index=0;
  else if(index<0)
     index=terms_labels.length-1;

  var previous = terms_labels[(index+len-1)%len];
var next = terms_labels[(index+1)%len];
var current = terms_labels[index];
  $('.next_label_full ').html(next);
  $('.prev_label_full ').html(previous);
  $('.next_label').html(next);
  $('.prev_label').html(previous);
  change_page_for_full(current);
  change_page(current);
}
function change_page_for_full(type){
  $(".terms_and_conditions_full").css({"display":'none'});
  $(".privacy_policy_full").css({"display":'none'});
  $(".copy_right_claims_full").css({"display":'none'});
  $(".sra_full").css({"display":'none'});
  $(".head-div_full .title").html(type)
    if(type=='PRIVACY POLICY'){
      $(".privacy_policy_full").css({"display":'block'});
    }
    else if(type=='TERMS OF SERVICES'){
      $(".terms_and_conditions_full").css({"display":'block'});
    }
    else if(type=='COPYRIGHT CLAIMS'){
      $(".copy_right_claims_full").css({"display":'block'});
    }
    else if(type=='SRA'){
      $(".sra_full").css({"display":'block'});
    }
    else{
      $(".privacy_policy_full").css({"display":'block'});
    }

}


function exit(){
  $('.form-fullview').fadeOut();
}

function prev_full(){
      var prev_val = document.getElementById( "prev_no" ).value; 
      var prev = document.getElementById( "no" ).value;
        var prev = Number(prev) - 1;
        if(prev<= -1)
        {
            prev = terms_labels.length - 1;
        }

       var prev_val = Number(prev_val) - 1;
          if(prev_val<= -1)
          {
            prev_val = terms_labels.length - 1;
          }
       
      document.getElementById( "prev_no" ).value = prev_val;
      var label=terms_labels[prev_val-1];
      $('.prev_label_full').html(label);
      document.getElementById( "no" ).value = prev;
      var type= terms_labels[prev]; 
      change_page_for_full(type);
}
function next_full(){
    var next_val = document.getElementById( "next_no" ).value;
    var next = document.getElementById( "no" ).value;
    var next = Number(next)+1;
    if(next >= terms_labels.length)
    {
        next = 0;
    }
    var next_val = Number(next_val)+1;
    if(next_val >= terms_labels.length)
    {
      next_val = 0;
    }
    document.getElementById( "next_no" ).value = next_val;
    var label=terms_labels[next_val]; 
    var prev_val=next-1;
    if(prev_val<= -1)
      prev_val=terms_labels.length-1;

    var label_previous=terms_labels[prev_val]; 
    $('.next_label_full').html(label);
    $('.prev_label_full').html(label_previous);
    document.getElementById( "no" ).value = next;
    var type= terms_labels[next]; 
    change_page_for_full(type);
}

