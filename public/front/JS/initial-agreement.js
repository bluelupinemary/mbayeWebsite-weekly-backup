  // for showing message to turn to landscape 
     
  window.addEventListener("orientationchange", function(event) {    
    testOrientation();
    }, false);

  window.addEventListener("resize", function(event) {
      testOrientation();
  }, false);

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
  $(".img_sun").removeClass("ani-rollout_earth");
  $(".text_part1").removeClass("ani-rollout_text");
  

/**
Function for changing page next next page of the agreement  */
    function changepage(){
         $('.img_sun').css({'display':'none'});
        $('.page_1').css({'display':'none'});
        $('.text_part1').css({'display':'none'});
        $('.img_sun2').css({'display':'block'});
        $('.page_2').css({'display':'block'});
        $('#btn_agree').css({'display':'block'});
        $('.prev_button_ag').css({'display':'block'});
        $(".sun-wraper").removeClass("ani-rollout_earth");
    }
/**
Function for changing to previous page of agreement */
    function changeprev(){
      $('.sun-wraper').css({'display':'block'});
      $('.img_sun').css({'display':'block'});
      $('.page_1').css({'display':'block'});
      $('.text_part1').css({'display':'block'});
      $('.img_sun2').css({'display':'none'});
      $('.page_2').css({'display':'none'});
    }



function to_intereset()
{
    $('.page_2').css({'display':'none'});
    $('#interest_section').css({'display':'block'});
}

$(document).ready(function () {
   
$('input').each(function()
{
    var isDisabled = $(this).prop('disabled');
    
    if (isDisabled)
    {
      $(this).siblings().css({"cursor": "not-allowed"});
      $(this).siblings().removeClass('checkClass');
      $(this).siblings().addClass('disabledClass');
    }
});
// CARE FOR THE ENVIRONMENT SECTION START
$('#caring-environment').click(function(){

  if($('#caring-environment').is(':checked'))
  {
    $("#caring-sea + label").addClass('checkClass');
    $("#caring-sea + label").removeClass('disabledClass');
    $("#caring-sea + label").css({"cursor": "pointer"});
    $("#caring-sea").removeAttr('disabled'); 
    
    $("#caring-mountains + label").addClass('checkClass');
    $("#caring-mountains + label").removeClass('disabledClass');
    $("#caring-mountains").removeAttr('disabled');
    $("#caring-mountains + label").css({"cursor": "pointer"});

    $("#caring-rivers + label").addClass('checkClass');
    $("#caring-rivers + label").removeClass('disabledClass');
    $("#caring-rivers").removeAttr('disabled');
    $("#caring-rivers + label").css({"cursor": "pointer"});

    $("#caring-glaciers + label").addClass('checkClass');
    $("#caring-glaciers + label").removeClass('disabledClass');
    $("#caring-glaciers").removeAttr('disabled');
    $("#caring-glaciers + label").css({"cursor": "pointer"});

    $("#caring-forests + label").addClass('checkClass');
    $("#caring-forests + label").removeClass('disabledClass');
    $("#caring-forests").removeAttr('disabled');
    $("#caring-forests + label").css({"cursor": "pointer"});

    $("#caring-fields-pastures + label").addClass('checkClass');
    $("#caring-fields-pastures + label").removeClass('disabledClass');
    $("#caring-fields-pastures").removeAttr('disabled');
    $("#caring-fields-pastures + label").css({"cursor": "pointer"});

    $("#caring-fields-pastures + label").addClass('checkClass');
    $("#caring-fields-pastures + label").removeClass('disabledClass');
    $("#caring-fields-pastures").removeAttr('disabled');
    $("#caring-fields-pastures + label").css({"cursor": "pointer"});
    
    $("#caring-local-parks + label").addClass('checkClass');
    $("#caring-local-parks + label").removeClass('disabledClass');
    $("#caring-local-parks").removeAttr('disabled');
    $("#caring-local-parks + label").css({"cursor": "pointer"});

    $("#caring-natural-parks + label").addClass('checkClass');
    $("#caring-natural-parks + label").removeClass('disabledClass');
    $("#caring-natural-parks").removeAttr('disabled');
    $("#caring-natural-parks + label").css({"cursor": "pointer"});

    $("#caring-international-parks + label").addClass('checkClass');
    $("#caring-international-parks + label").removeClass('disabledClass');
    $("#caring-international-parks").removeAttr('disabled');
    $("#caring-international-parks + label").css({"cursor": "pointer"});

  }
  else
  {
    $("#caring-sea + label").css({"cursor": "not-allowed"});
    $("#caring-sea").attr('disabled', true); 
    $("#caring-sea").attr('checked', false); 
    $("#caring-sea + label").removeClass('checkClass'); 
    $("#caring-sea + label").addClass('disabledClass'); 
    
    $("#caring-mountains").attr('disabled', true);
    $("#caring-mountains").attr('checked', false);
    $("#caring-mountains + label").css({"cursor": "not-allowed"});
    $("#caring-mountains + label").removeClass('checkClass');
    $("#caring-mountains + label").addClass('disabledClass');

    $("#caring-rivers").attr('disabled', true);
    $("#caring-rivers").attr('checked', false);
    $("#caring-rivers + label").css({"cursor": "not-allowed"});
    $("#caring-rivers + label").removeClass('checkClass');
    $("#caring-rivers + label").addClass('disabledClass');

    $("#caring-glaciers").attr('disabled', true);
    $("#caring-glaciers").attr('checked', false);
    $("#caring-glaciers + label").css({"cursor": "not-allowed"});
    $("#caring-glaciers + label").removeClass('checkClass');
    $("#caring-glaciers + label").addClass('disabledClass');

    $("#caring-forests").attr('disabled', true);
    $("#caring-forests").attr('checked', false);
    $("#caring-forests + label").css({"cursor": "not-allowed"});
    $("#caring-forests + label").removeClass('checkClass');
    $("#caring-forests + label").addClass('disabledClass');

    $("#caring-fields-pastures").attr('disabled', true);
    $("#caring-fields-pastures").attr('checked', false);
    $("#caring-sea + label").css({"cursor": "not-allowed"});
    $("#caring-fields-pastures + label").removeClass('checkClass');
    $("#caring-fields-pastures + label").addClass('disabledClass');

    $("#caring-fields-pastures").attr('disabled', true);
    $("#caring-fields-pastures").attr('checked', false);
    $("#caring-fields-pastures + label").css({"cursor": "not-allowed"});
    $("#caring-fields-pastures + label").removeClass('checkClass');
    $("#caring-fields-pastures + label").addClass('disabledClass');

    $("#caring-local-parks").attr('disabled', true);
    $("#caring-local-parks").attr('checked', false);
    $("#caring-local-parks + label").css({"cursor": "not-allowed"});
    $("#caring-local-parks + label").removeClass('checkClass');
    $("#caring-local-parks + label").addClass('disabledClass');

    $("#caring-natural-parks").attr('disabled', true);
    $("#caring-natural-parks").attr('checked', false);
    $("#caring-natural-parks + label").css({"cursor": "not-allowed"});
    $("#caring-natural-parks + label").removeClass('checkClass');
    $("#caring-natural-parks + label").addClass('disabledClass');

    $("#caring-international-parks").attr('disabled', true);
    $("#caring-international-parks").attr('checked', false);
    $("#caring-international-parks + label").css({"cursor": "not-allowed"});
    $("#caring-international-parks + label").removeClass('checkClass');
    $("#caring-international-parks + label").addClass('disabledClass');
  }
});
// CARE FOR THE ENVIRONMENT SECTION ENDS

// CARING FOE CHILDREN SECTION START
$('#caring-for-children').click(function(){
  if($('#caring-for-children').is(':checked'))
  {
    $("#caring-for-orphaned-children + label").css({"cursor": "pointer"});
    $("#caring-for-orphaned-children").removeAttr('disabled');
    $("#caring-for-orphaned-children + label").addClass('checkClass');
    $("#caring-for-orphaned-children + label").removeClass('disabledClass');

    $("#caring-for-sick-children + label").css({"cursor": "pointer"});
    $("#caring-for-sick-children").removeAttr('disabled'); 
    $("#caring-for-sick-children + label").addClass('checkClass'); 
    $("#caring-for-sick-children + label").removeClass('disabledClass'); 

    $("#caring-for-educating-children + label").css({"cursor": "pointer"});
    $("#caring-for-educating-children").removeAttr('disabled');
    $("#caring-for-educating-children + label").addClass('checkClass');
    $("#caring-for-educating-children + label").removeClass('disabledClass');

    $("#caring-for-special-children + label").css({"cursor": "pointer"});
    $("#caring-for-special-children").removeAttr('disabled'); 
    $("#caring-for-special-children + label").addClass('checkClass'); 
    $("#caring-for-special-children + label").removeClass('disabledClass'); 
  }
  else
  {
    $("#caring-for-orphaned-children + label").css({"cursor": "not-allowed"});
    $("#caring-for-orphaned-children").attr('disabled', true); 
    $("#caring-for-orphaned-children").attr('checked', false);
    $("#caring-for-orphaned-children + label").addClass('disabledClass');
    $("#caring-for-orphaned-children + label").removeClass('checkClass');

    $("#caring-for-sick-children + label").css({"cursor": "not-allowed"});
    $("#caring-for-sick-children").attr('disabled', true); 
    $("#caring-for-sick-children").attr('checked', false);
    $("#caring-for-sick-children + label").addClass('disabledClass');
    $("#caring-for-sick-children + label").removeClass('checkClass');

    $("#caring-for-educating-children + label").css({"cursor": "not-allowed"});
    $("#caring-for-educating-children").attr('disabled', true); 
    $("#caring-for-educating-children").attr('checked', false);
    $("#caring-for-educating-children + label").addClass('disabledClass');
    $("#caring-for-educating-children + label").removeClass('checkClass');

    $("#caring-for-special-children + label").css({"cursor": "not-allowed"});
    $("#caring-for-special-children").attr('disabled', true); 
    $("#caring-for-special-children").attr('checked', false);
    $("#caring-for-special-children + label").addClass('disabledClass');
    $("#caring-for-special-children + label").removeClass('checkClass');

  }
});
// CARING FOR CHILDREN SECTION ENDS
// SUBMIT THE FORM 
$('#intsubmit').click(function(e){
  e.preventDefault();
  var form_url = route;
  var $form = $('form#interestForm');
  var post_data = new FormData($form[0]);
  var isValid = validateInterest();

  if(isValid){
        $.ajax({
              url: form_url,
              method: 'post',
              data: post_data ,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  Swal.fire({
                          imageUrl: '../front/icons/alert-icon.png',
                          imageWidth: 80,
                          imageHeight: 80,
                          imageAlt: 'Mbaye Logo',
                          title: "<span id='success' style='color:green;'>Success</span>",
                          html: "Data has been saved!",
                          padding: '1rem',
                          background: 'rgba(8, 64, 147, 0.62)'
                  }).then((res)=>{
                    window.location.href = url;
                  });
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
  
});

function validateInterest(){
  // PRIMARY FIELDS CHECK
  if($('#yourself').is(':checked') || $('#your-work').is(':checked') || $('#your-partner').is(':checked') || $('#your-finances').is(':checked') || $('#your-children').is(':checked') || $('#your-sports').is(':checked') || $('#your-family').is(':checked') || $('#your-arts').is(':checked'))
  {
    if($('#caring-environment').is(':checked') || $('#caring-for-children').is(':checked'))
    {
      // CARING FOR THE ENVIRONMENT SECTION START
      if($('#caring-environment').is(':checked'))
      {
          if($('#caring-sea').is(':checked') || $('#caring-mountains').is(':checked') || $('#caring-rivers').is(':checked') || $('#caring-glaciers').is(':checked') || $('#caring-forests').is(':checked') || $('#caring-fields-pastures').is(':checked') || $('#caring-local-parks').is(':checked') || $('#caring-natural-parks').is(':checked') || $('#caring-international-parks').is(':checked'))
          {
            if($('#caring-for-children').is(':checked'))
            {
              // SELECT ATLEAST ONE FIELD FROM CHILD CATE
              if($('#caring-for-orphaned-children').is(':checked') || $('#caring-for-sick-children').is(':checked') || $('#caring-for-educating-children').is(':checked') || $('#caring-for-special-children').is(':checked'))
              {
                return true;
              }
              else
              {
                custom_alert('You have not Selected any field !','Select atleast one Field from caring for children section!','yourself');
                return false;
              }
            }else
            {
              // SELECT ATLEAST ONE FIELD FROM CHILD CATE ENDS
              return true;
            }
          }
          else
          {
            custom_alert('You have not Selected any field !','Select atleast one Field from caring for Environment section!','yourself');
            return false; 
          }
      }
      // CARING FOR CHILDREN IS A REQUIRED FIELD
      if($('#caring-for-children').is(':checked'))
      {
        // SELECT ATLEAST ONE FIELD FROM CHILD CATE
        if($('#caring-for-orphaned-children').is(':checked') || $('#caring-for-sick-children').is(':checked') || $('#caring-for-educating-children').is(':checked') || $('#caring-for-special-children').is(':checked'))
        {
          return true;
        }
        else
        {
          custom_alert('You have not Selected any field !','Select atleast one Field from caring for children section!','yourself');
          return false;
        }
        // SELECT ATLEAST ONE FIELD FROM CHILD CATE ENDS
      }
      // CARING FOR CHILDREN IS A REQUIRED FIELD ENDS
    }
    else
    {
      custom_alert('Secondary Interest is a required field !','Select secondary interest fields!','yourself');
      return false;
    }
  }
  else
  {
    custom_alert('Primary Interest is required !','Select atleast one Primary Interest Field!','yourself');
    return false;
  }
}

var width = window.innerWidth;
  if(width < 991){ 
        var origContentDisplay = contentDisplay;
          contentDisplay = function() {
              $('.div_container').css({'display':'block'});
              $('.sun-wraper').css({'display':'block'});
                $('.img_sun2').css({'display':'none'});
                $(".sun-wraper").addClass("ani-rollout_earth");
                    setTimeout(function () {
                      $('.next_button_ag').css({'display':'block'}); 
                }, 5000);
          return origContentDisplay();
        }
  }else{
    $('.div_container').css({'display':'block'});
      $('.sun-wraper').css({'display':'block'});
        $('.img_sun2').css({'display':'none'});
        $(".sun-wraper").addClass("ani-rollout_earth");
            setTimeout(function () {
              $('.next_button_ag').css({'display':'block'}); 
        }, 5000);
    }


});


function custom_alert(title,message,fieldID)
{
  Swal.fire({
            imageUrl: '../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: "<span id='error'>"+ title +"</span>",
            html: message,
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
        });
}