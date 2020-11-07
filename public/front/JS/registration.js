  var valideemail = false ;
  // A button for taking snaps
  window.onload = function() 
  {
    calculate_age();
  };

  // Get old selected gender, country, organization type;
  $(document).ready(function() {

    $('#Email').change(function(){
      // $('#Email').removeClass('success-alter');
      // $('#Email').removeClass('danger-alter');
    });

    $("#MyForm input#text_occupation_astro").keyup(function(){
      var value = $(this).val();
      $("#MyForm input#occupation").val(value);
    });
    var screen_width = window.innerWidth;
    var screen_height = window.innerHeight;
    // alert('Width of th device : '+screen_width+" , height of the view Port: "+screen_height);
    if (screen_height == 500 || screen_height < 500) 
    {
      Webcam.set({
        width: 160,
        height: 120,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      Webcam.attach( '#my_camera' );
    }
    else if((screen_height == 768 || screen_height < 768) && screen_height > 500 )
      {
        Webcam.set({
        width: 250,
        height: 230,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      Webcam.attach( '#my_camera' );
      }
    else
    {
      Webcam.set({
        width: 305,
        height: 230,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      Webcam.attach( '#my_camera' ); 
    }
    if (screen_height == 320 || screen_height < 320) 
    {
      $('.col-md-6').css({"width":"50%"});
      $('#MyForm .action-button').css({"margin":"1% 3% 1% 3%;","font-size": "2vw"});
      $('#my_camera-ios_div').css({"width":"100px","display":"block"});
      $("#MyForm input").css({"font-size" :"1.5vw","padding": "2% 3%"});
      $(".form-groupt").css({"margin-bottom" :".5rem"});
    }
    $("input").change(function(){
      $(this).removeClass('danger-alter');
    });
    $("select").change(function(){
      $(this).removeClass('danger-alter');
    });
    $(".datepicker").css({'display':'none'});
    //   $('#date').on('change', function() {
    //     if(this.value){
    //       $(this).attr('data-date', moment(this.value, 'MM/DD/YYYY').format($(this).attr('data-dateformat')));
    //     } else{
    //       $(this).attr('data-date', '');
    //     }
    // });
    var elem = document.documentElement;
    function openFullscreen()
    {
      if (elem.mozRequestFullScreen) 
      {  /* Firefox */
        elem.mozRequestFullScreen(); 
        contentDisplay();
      } 
      else if (elem.webkitRequestFullscreen) 
      { /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
        contentDisplay();
      } 
      else if (elem.msRequestFullscreen) 
      { /* IE/Edge */
        elem.msRequestFullscreen();
        contentDisplay();
      }
      else if (elem.requestFullscreen) 
      {
        elem.requestFullscreen();
        contentDisplay();
      } 
      else
      { 
        contentDisplay();
      }
    }

    if(window.innerWidth < 991 )
    {
      $(document).ready(()=>{
          Swal.fire({
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 160,
                imageHeight: 120,
                html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
                padding: '15px',
                background: 'rgba(8, 64, 147, 0.62)',
                allowOutsideClick: false
              }).then((result) => {
                  if (result.value) 
                  {
                    openFullscreen()
                  }
                });
            });
    }
    else  contentDisplay();

    function contentDisplay() 
    {   
      $(".sub_container").show();
    } 
  });

  // COUNTRIES AND STATE AND SITIES
  var countires;
  var states = [];
  var allcities = [];
  var alldata=[];
   // FETCHING THE OBJECT OF COUNTRIES AND CITIES AND STATE
  $.getJSON( "/front/json/reg-countries-states-cities.json", function( data ) {
      alldata = data;
        $.each( data, function( key, val ) {
          $('#countryId').append("<option value='" + val.name + "'>" + val.name + "</option>");
        });
    });
    // SELECTING THE COUNTRY AND FETCHING THE STATES
    $('#countryId').change(function(){
      var country_check = $('#countryId').val();
      $('#stateId').html(''); //RESET STATE FEILD
      $('#cityId').html(''); //RESET CITY FEILD
      //ALL DATA COUNTRY STATE CITY
      $.each( alldata, function( country_key, country_val ) {   
        // IF THE COUNTRY HAS USERS SELECTED VALUE
        if(country_val.name === country_check)
        {
          // CHECK ID COUNTRY HAS STATES
          if(country_val.states.length)
          {
            // ITERATE THROUGHT THE STATES
            $.each( country_val.states , function( state_key, state_val ) {
              $('#stateId').append("<option value='" + state_val.name + "'>" + state_val.name + "</option>");
              if(state_val.cities.length)
              {
                $.each( state_val.cities , function( city_key, city_val )
                {
                  if($('#stateId').val() == state_val.name)
                  {
                    $('#cityId').append("<option value='" + city_val.name + "'>" + city_val.name + "</option>");
                  }
                });
              }
              else
              {
                $('#cityId').append("<option value='" + state_val.name + "'>" + state_val.name + "</option>");
              }
            });
            
          }
          else
          {
            $('#stateId').append("<option value='" + country_val + "'>" + country_val + "</option>");
            $('#cityId').append("<option value='" + country_val + "'>" + country_val + "</option>");
          }
        }
      }); //COUNTRIES ITERATION VARIABLE IS FINISHED
    });
     // SECLTING THE STATE TO GET THE CITIES
    $('#stateId').change(function(){
      var c_check = $('#stateId').val();
      $('#cityId').html('');
      
      $.each( alldata, function( key, val ) {
        $.each( val.states , function( key_c, val_c ) {
          if(val_c.name === c_check)
          { 
            // console.log(c_check);
          //  console.log(val_c.cities.length);
          if(val_c.cities.length)
          {
            $.each( val_c.cities , function( key_c1, val_c1 ) {
              $('#cityId').append("<option value='" + val_c1.name + "'>" + val_c1.name + "</option>");
            })
          }
          else{
            $('#cityId').append("<option value='" + c_check + "'>" + c_check + "</option>");
          } 
          }
        })
      });
    });
     
  //var global_occupation='';
  // for showing message to turn to landscape
  testOrientation();
  
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
        $('section').show();
      }
      else
      {
        document.getElementById('block_land').style.display =  'block';
        $('section').hide();
      }
    }

  function show_cuckoo()
  {
    $('.div_clock').css({'display':'block'});
    var audio = document.getElementById("audio_cuckoo");
      audio.playbackRate =1;
      audio.play();
  }
  
  
    /*
    Button click function for registration
    */
  /*  $('#btn_Register').click(function(){

     /* var str_occupation= $("#text_occupation_astro").val();   */
     /* $("#occupation_txt").val(str_occupation);
     var str = $("form").serializeArray();

             $.ajax({
                type: "POST",
                url: "http://localhost/Mbaye/index.php/home/Save_registration_details",
                data: str,
                dataType: "json",
                success: function (result) {
                  var msg =  result;
                  alert(msg);

                },
                error: function () {
                 alert("Error while Registering!!");
                }
            });


                  }); */
    
    $('#div').click(function(){
        $('.div_for_astro').css('display','none');
        $('#Div_for_wiki').css('display','none');
        $('#Div_for_wiki2').css('display','none');
        $('.div_clock').css('display','none');
        $('.occ_description').css('display','none');
      });
      /*
      * Click function  for cloud to view the astronut with description
      */
      
    $('.astro_occupation').css({'display':'block'});
    $('.div_for_astro').css({'display':'none'});
      //$(".astro_occupation ").removeClass("img_astro");

    $('#cloud').click(function(){
        // alert('here clicked');
        load_animation_astronut();
    });
    
    $(".btn_occ_submit").click(function(e){   
      var occ_astro= $("#text_occupation_astro").val();
      occ_astro = occ_astro.trim();
      // alert(occ_astro.length);return false;
      if(occ_astro=='' || occ_astro==null)
      {
        alert("Please Enter Your Occupation !!");
      }
      else if(occ_astro.length <= 2)
      {
        alert("Occupation must be greater than 3 charcters!!");
      }
      else
      {
        /* var str_occupation= $("#text_occupation_astro").val();
        var occ_astro=$("#text_occupation_astro").val(); */
        $("#list_occupation ").html('');
        $("#list_occupation ").html(occ_astro);
        $("#list_occupation").val(occ_astro);
        $("#occupation").val(occ_astro);
        // hidePage();
        // hidePage2();
        // $("#text_occupation_astro").val()
        $('.occ_description').css({'display':'none'});
        $('.text_occup').css({'display':'none'});
        $('.btn_occ_submit').css({'display':'none'});
        $('.div_clock').css({'display':'none'});
        $('.div_helmet').css({'display':'none'});
        $('.txtarea_occup').css({'display':'block'});
        //for playing audio
        var audio = document.getElementById("audio_cuckoo");
        audio.playbackRate =1;
        audio.play();
        $('.div_for_astro').css({'display':'none'});
        $(".astro_occupation ").addClass("img_astro_down");
        setTimeout(function(){
            $('.astro_occupation').css({'display':'none'});
            $(".astro_occupation ").removeClass("img_astro_down");
          });
      }
      //load_animation_astronut();
    });
      
      /*$('#list_occupation').click(function(){
          load_animation_astronut();
          $('.div_for_astro').css({'display':'none'});
          $(".astro_occupation ").addClass("img_astro_down");
        });*/
      
      $('#list_occupation').click(function(){          
          load_animation_astronut();
        });
      
      function load_animation_astronut()
      {  
        $('.astro_occupation').css({'display':'block'});
        $('.div_for_astro').css({'display':'block'});
        $('.astro_occupation').css({'display':'block'});
        $(".astro_occupation ").addClass("img_astro");
        $('#div').css({'display':'block'});
        $("#div").addClass("close-as-img");
        $('.text_occup').css({'display':'block'});
        $('.btn_occ_submit').css({'display':'block'});
        
        setTimeout(function(){
            $('.occ_description').css({'display':'block'});
            $('.div_helmet').css({'display':'block'});
           }, 3000);
      }
      /*
      Function to take snapshot
      */
      function take_snapshot() 
      {
        $('#my_camera').css({'border':'0px'});
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
         
          // display results in page
          document.getElementById('my_camera').innerHTML =
            '<img  name="photo" id="img_photo" class="camera" style="object-fit: cover"; src="'+data_uri+'"/>';
            $("#img_photo_register").val(data_uri);
        });
      }
    //Function for age calculation
    function calculate_age()
    {
      $("#age").val(' ');

      $('.text_Aquaris').css({'display':'none'});
      $('.text_Pisces').css({'display':'none'});
      $('.text_Cancer').css({'display':'none'});
      $('.text_Taurus').css({'display':'none'});
      $('.text_Gemini').css({'display':'none'});
      $('.text_Aries').css({'display':'none'});
      $('.text_Aries').css({'display':'none'});
      $('.text_Leo').css({'display':'none'});
      $('.text_Libra').css({'display':'none'});
      $('.text_Scorpio').css({'display':'none'});
      $('.text_Sagittarius').css({'display':'none'});
      $('.text_Capricorn').css({'display':'none'});

      //DATE validation
      var dob=$("#date").val();
      
                    
      var zordiac=check_zordiac(dob); // Checking zordiac signs
      if(dob!='')
      {
        if(zordiac=='Aquarius')
          {

            $('.text_Aquaris').css({'display':'block'});
            $(".text_Aquaris ").addClass("ani-rollouttext_Aquaris");
            $('.aq_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
          }
          else if(zordiac=='Pisces')
          {
            $('.text_Pisces').css({'display':'block'});
            $(".text_Pisces ").addClass("ani-rollouttext_Pisces");
            $('.p_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
          }
          else if(zordiac=='Cancer')
          {
            $(".text_Cancer ").addClass("ani-rollouttext_Cancer");
            $('.text_Cancer').css({'display':'block'});
            $('.c_normal').css({'filter': 'drop-shadow(0px 2px 3px #2b4fff)'});
          }
          else if(zordiac=='Taurus')
          {
            $(".text_Taurus ").addClass("ani-rollouttext_Taurus");
            $('.text_Taurus').css({'display':'block'});
            $('.t_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
          }
          else if(zordiac=='Gemini')
          {
            $(".text_Gemini ").addClass("ani-rollouttext_Gemini");
            $('.text_Gemini').css({'display':'block'});
            $('.gm_normal').css({'filter': 'drop-shadow(0px 2px 3px #b905f5)'});
          }
          else if(zordiac=='Aries')
          {
             $(".text_Aries ").addClass("ani-rollouttext_Aries");
             $('.text_Aries').css({'display':'block'});
             $('.ar_normal').css({'filter': 'drop-shadow(0px 2px 3px #e00202)'});
          }
          else if(zordiac=='Leo')
          {
            $(".text_Leo ").addClass("ani-rollouttext_Leo");
            $('.text_Leo').css({'display':'block'});
            $('.le_normal').css({'filter': 'drop-shadow(0px 2px 3px #f5dc00)'});
          }
          else if(zordiac=='Virgo')
          {
            $(".text_Virgo ").addClass("ani-rollouttext_Virgo");
            $('.text_Virgo').css({'display':'block'});
            $('.v_normal').css({'filter': 'drop-shadow(0px 2px 3px #00f234)'});
          }
          else if(zordiac=='Libra')
          {
            $(".text_Libra ").addClass("ani-rollouttext_Libra");
            $('.text_Libra').css({'display':'block'});
            $('.li_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
          }
          else if(zordiac=='Scorpio')
          {
            $(".text_Scorpio ").addClass("ani-rollouttext_Scorpio");
            $('.text_Scorpio').css({'display':'block'});
            $('.sc_normal').css({'filter': 'drop-shadow(0px 2px 3px #bd0202)'});
          }
          else if(zordiac=='Sagittarius')
          {
            $(".text_Sagittarius ").addClass("ani-rollouttext_Sagittarius");
            $('.text_Sagittarius').css({'display':'block'});
            $('.sg_normal').css({'filter': 'drop-shadow(0px 2px 3px #8502bd)'});
          }
          else // Capricorn
          {
            $(".text_Capricorn ").addClass("ani-rollouttext_Capricorn");
            $('.text_Capricorn').css({'display':'block'});
            $('.cp_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
          }
        }
        //  var dat_Validation=isValidDate(dob); //commented for now
        var dat_Validation=true;
        if(dat_Validation==true)
        {
          var dob=$("#date").val();
          $("#age").val(' ');
          if(dob!='')
          {
            d1=new Date(dob);
            d2 = new Date();
            var diff = d2.getTime() - d1.getTime();
            age= Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));

            if( Number.isNaN(age)==true)
            {
              age='';
            }    
            if(age<0)
              age=0;
            $("#age").val(age);
            
            if(age < 18)
            {
              $("#sname").show();
              $("#sponsor_email").show();
            }
            else
            {
              $("#sname").hide();
              $("#sponsor_email").hide();
            }
          }
        }
        else
        {
          alert("Invalid DOB!");
          $("#date").val('');
        }
      }
      /*
      Function to check zordiac signs with DOb
      */
      function check_zordiac(dob){
        // Parse the date parts to integers
        var parts   = dob.split("-");
        var day     = parseInt(parts[2], 10); //day
        var month   = parseInt(parts[1], 10); //month
        var year    = parseInt(parts[0], 10); //year
        var zordiac='';
        // alert(month)
        if(dob != '')
        {
          if(month == 1)
          {
            if(day >= 21 && day <= 31)
            {
              zordiac='Aquarius';
            }
            else if(day >= 1 && day <= 20)
            {
              zordiac='Capricorn';
            }               
          }
          else if(month == 2)
          {
            if(day >= 19 && day <= 31)
            {
              zordiac='Pisces';
            }
            else if(day>=1 && day<=18)
            {
              zordiac='Aquarius';
            }
          }
          else if(month==3)
          {
            if(day>=21 && day<=31)
            {
              zordiac='Aries';
            }
            else if(day>=1 && day<=20)
            {
              zordiac='Pisces';
            }
          }
          else if(month==4)
          {
            if(day>=21 && day<=31)
            {
              zordiac='Taurus';
            }
            else if(day>=1 && day<=20)
            {
              zordiac='Aries';
            }
          }
          else if(month==5)
          {
            if(day>=22 && day<=31)
            {
              zordiac='Gemini';
            }
            else if(day>=1 && day<=21)
            {
              zordiac='Taurus';
            }
          }
          else if(month==6)
          {
            if(day>=22 && day<=31)
            {
              zordiac='Cancer';
            }
            else if(day>=1 && day<=21)
            {
              zordiac='Gemini';
            }
          }
          else if(month==7)
          {
            if(day>=24 && day<=31)
            {
              zordiac='Leo';
            }
            else if(day>=1 && day<=22)
            {
              zordiac='Cancer';
            }
          }
          else if(month==8)
          {
            if(day>=24 && day<=31)
            {
              zordiac='Virgo';
            }
            else if(day>=1 && day<=23)
            {
              zordiac='Leo';
            }
          }
          else if(month==9)
          {
            if(day>=23 && day<=31)
            {
              zordiac='Libra';
            }
            else if(day>=1 && day<=22)
            {
              zordiac='Virgo';
            }
          }
          else if(month==10)
          {
            if(day>=23 && day<=31)
            {
              zordiac='Scorpio';
            }
            else if(day>=1 && day<=23)
            {
              zordiac='Libra';
            }
          }
          else if(month==11)
          {
            if(day>=22 && day<=31)
            {
              zordiac='Sagittarius';
            }
            else if(day>=1 && day<=21)
            {
              zordiac='Scorpio';
            }
          }
          else
          {     //if(month==12)
            if(day>=22 && day<=31)
            {
              zordiac='Capricorn';
            }
            else if(day>=1 && day<=21)
            {
              zordiac='Sagittarius';
            }
          }
          return zordiac;
        }
      }
      /*
      Function for validatng date
      */
      function isValidDate(dateString)
      {
        // First check for the pattern
        var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;
        if(!regex_date.test(dateString))
        {
          return false;
        }
        // Parse the date parts to integers
        var parts   = dateString.split("-");
        var day     = parseInt(parts[2], 10);
        var month   = parseInt(parts[1], 10);
        var year    = parseInt(parts[0], 10);
        // Check the ranges of month and year
        if(year < 1000 || year > 3000 || month == 0 || month > 12)
        {
          return false;
        }
        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
        // Adjust for leap years
        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        {
            monthLength[1] = 29;
        }
        // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
      }
      /*
      Function for validating date
      */
      function validateDate(testDate)
      {
        var result=true;
        var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
        if(!(date_regex.test(testDate)))
        {
          result= false;
        }
        return result;
      }
      /**
      Function to validate email address
      */
      // function validateEmail() 
      // {
      //   var email=$("#Email").val(); 
      //   const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      //   var blnValidate=re.test(String(email).toLowerCase());          
      //   if(blnValidate==false)
      //   {
      //     return false;
      //   }
      //   else
      //   {
      //     $('#Email').removeClass('danger-alter');
      //     return true; 
      //   }
      // }
      $('#Email').change(function(){

        var email=$("#Email").val(); 
        
        const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        console.log(emailReg.test(String(email).toLowerCase()));
        
        if(!emailReg.test(String(email).toLowerCase())) 
        {
          // custom_swal("Error!","Please Enter Valid Email Id","Email");
          $('#Email').removeClass('success-alter');
          $('#Email').addClass('danger-alter');

          $('#Email').tooltip();
          $('#Email').focus();
          return false;
        }
        else
        {
          console.log  ('matched');
          $.ajax({
            type: "POST",
            url: base_url+'/validateemail_reg',
            data:{
              _token:$('meta[name="csrf-token"]').attr('content'),
              email:email},
            success: function(responce) {
              // console.log(responce);
              if (responce.status == 'exist') 
              {
                custom_swal("Already Exist!","login into to your account","Email");
                $('#Email').removeClass('success-alter');
                $('#Email').addClass('danger-alter');
                $('#Email').tooltip();
                $('#Email').focus();
                valideemail=false;
                return false;
              }
              if (responce.status == 'not-exist') 
              {
                $('#Email').removeClass('danger-alter');
                $('#Email').addClass('success-alter');
                valideemail=true;
              }
              // console.log('success :'+ responce);
            }
          });
        }
      });
      

      function email_formate(emailIdFeild)
      {
        var email=$("#"+emailIdFeild).val(); 
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var blnValidate=re.test(String(email).toLowerCase());
        
        
        if(blnValidate==false)
        {
          custom_swal("Already Exist!","login into to your account","Email");
          $("#"+emailIdFeild).addClass('danger-alter');
          $("#"+emailIdFeild).tooltip();
          return false;

        }
        else
        {
          $("#"+emailIdFeild).removeClass('danger-alter');
          return true; 
        }
      }
      function validatePassword(inputtxt)
      {  
        // alert(inputtxt);
        var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        // alert(.val());
        if($('#'+inputtxt).val().match(passw)) 
        { 
          $('#password').removeClass('danger-alter');
          return true;
        }
        else
        { 
          return false;
        }
      }
      function validateConfirmpass()
      {
        var pass_1 = $('#password').val();
        var pass_2 = $('#c_password').val();
        if(pass_1 === pass_2) 
        { 
          $('#c_password').removeClass('danger-alter');
          return true;
        }
        else
        { 
          return false;
        } 
      }
      /* Reset camera option */
      function reset_snapshot()
      {
        Webcam.reset();
        Webcam.set({
            //width: 207,
            //height: 270,
            //dest_width: 207,
            //dest_height: 270,
            image_format: 'jpeg',
            jpeg_quality: 90
          });
        Webcam.attach( '#my_camera' );
      }
      /*function reset(){
        Webcam.reset();
        Webcam.off();
      }*/
      //
      //-----------
      function logout_account()
      {
        $.ajax({
          type: "POST",
          url: "http://127.0.0.1/Mbaye/index.php/home/logout",
          data: "",
          dataType: "json",
          success: function (result) 
          {
            window.location.href = "http://127.0.0.1/Mbaye/index.php/home/login";
          },
          error: function () 
          {
            alert("Error while logouting!");
          }
        });
      }

      function loadSelect_for_org_type(org)
      {  //alert(org);
        $('#org_types').find('option[value='+org+']').attr('selected', 'selected');
        $('#org_type').val(org);
      }
      function loadSelect_for_gender(gender)
      {
        $('#var_genders').find('option[value='+gender+']').attr('selected', 'selected');
        $('#var_gender').val(gender);
      }
      
      function openwikipedia()
      {
        setTimeout(function(){
          var div = document.getElementById("Div_for_wiki");
          var page = document.getElementById("wikiPage");
          page.data  ="https://en.wikipedia.org/wiki/Michael_Collins_(astronaut)";
          if(div.style.visibility != "visible")
          {
            div.style.visibility = "visible";
            $(".close_btn ").show();
          }
          else return;
        },1000);
      }
      function hidePage()
      {
        var div = document.getElementById("Div_for_wiki");
        var page = document.getElementById("wikiPage");
        page.data = "";
        $(".close_btn ").hide();
        div.style.visibility = "hidden";
      }
      function goto_wiki2()
      {
        setTimeout(function(){
          
          var div = document.getElementById("Div_for_wiki2");
          var page = document.getElementById("wikiPage2");
          page.data  ="https://en.wikipedia.org/wiki/Michael_Schumacher";
          if(div.style.visibility != "visible")
          {
            div.style.visibility = "visible";
            $(".close_btn2 ").show();
          }else return;
        },1000);
      }
      function hidePage2()
      {
        var div = document.getElementById("Div_for_wiki2");
        var page = document.getElementById("wikiPage2");
        page.data = "";
        if($(".close_btn2 ").hide());
            div.style.visibility = "hidden";
      }

      $(document).ready(function(){
        $("#Div_for_wiki2").click(function(){
            $("#Div_for_wiki").hide();
          });
        $("#divv").click(function(){
          $("#Div_for_wiki").show();
        });
        $("#viki").click(function(){
          $("#Div_for_wiki2").show();
        });
      });
      /*
      Function to redirect to home page after registration  save sucess
      */
     function redirectToHome()
     {
        window.location = "{{route('frontend.index')}}";
      }
       /*
      Function to redirect to login  page after registration  save sucess
      */
      function redirectToLogin()
      {
        window.location.href = url+'/login';
      }
      /**
      Function to validate form
      */
      $(document).ready(function(){
          $("#term").click(function(){
            $("#myModal").modal({show:true});
          });
        });
      function validateMyForm()
      {
        $("#MyForm").event.preventDefault();
        //checking terms and condition Check box checked or not
        
      }
      /**
      Click function for agree button
      */
      $('#btn_agree').click(function(){
        $('#is_term_accept').prop("checked",true);
      });

      /**
      Click function for disagree button
      */
      $('#btn_dagree').click(function(){
        $('#is_term_accept').prop("checked",false);
      });
      /*
      Function for set annd reset check box
      */
      function setCheckbox()
      {
        if($(this). prop("checked") == true)
        {
           $('#is_term_accept').prop("checked",false);
        }
        else if($(this). prop("checked") == false)
        {
          $('#is_term_accept').prop("checked",true);
        }
      }
      /**
      Function to show password
      */
      function showpassword(fieldid)
      {
        if($('#'+fieldid+' input').attr("type") == "text")
        {
          $('#'+fieldid+' input').attr('type', 'password');
          $('#'+fieldid+' svg').attr('data-icon', 'eye');
        }
        else if($('#'+fieldid+'  input').attr("type") == "password")
        {
          $('#'+fieldid+'  input').attr('type', 'text');
          $('#'+fieldid+'  svg').attr('data-icon', 'eye-slash');
        }
      }

      //jQuery time
      var current_fs, next_fs, previous_fs; //fieldsets
      var left, opacity, scale; //fieldset properties which we will animate
      var animating; //flag to prevent quick multi-click glitches

      $(".next").click(function(){

        current_fs = $(this).parent();
        // LOGIN DETAILS SECTION JS START
        if (current_fs.attr('attr-tab-id') == 1) 
        {
          $('#Email').removeClass('danger-alter');
          $('#password').removeClass('danger-alter');
          $('#c_password').removeClass('danger-alter');

          var check1 = email_formate('Email');
          var check2 = validatePassword('password');
          var check3 = validateConfirmpass();
          if(valideemail== false)
          {
            custom_swal("Error!","Enter a Valid Email!","Email");
            $('#Email').tooltip();
            return false;
          }
          if (check1 == false) 
          {
            custom_swal("Error!","Please Enter Valid Email Id","Email");
            $('#Email').tooltip();
            return false;
          }
          if (check2 == false) 
          {
            custom_swal("The password must be at least 8 characters!","Password must contain at least one number and both uppercase and lowercase letters","password");
            return false;
          }
          if (check3 == false) 
          {
            custom_swal("Confirm Password Failed!","Enter The Correct Password!","c_password");
            return false;
          }
          if (check1 && check2 && check3)
          {
            if(animating) return false;
            animating = true;
          }            
        }
        // LOGIN DETAILS SECTION JS END
        // PERSONAL INFORMATION SECTION START
        if (current_fs.attr('attr-tab-id') == 2) 
        {
          $('#fname').removeClass('danger-alter');
          $('#lname').removeClass('danger-alter');
          $('#genders').removeClass('danger-alter');
          $('#date').removeClass('danger-alter');

          if ($('#fname').val() == '')
          {
            custom_swal("Required !","Enter a valid First Name!","fname");
            return false; 
          }
          else if ($('#lname').val() == '')
          {
            custom_swal("Required !","Enter a valid Last Name!","lname");
            return false; 
          }
          else if ($('#genders').val() == '')
          {
            custom_swal("Gender is Required !","Select a Gender!","genders");
            return false; 
          }
          else if ($('#date').val() == '')
          {
            custom_swal("Date of Birth is Required !","Select a Date!","date");
            return false; 
          }
        }
        // PERSONAL INFORMATION SECTION END
        // CONTACT INFORMATION SECTION START
        if (current_fs.attr('attr-tab-id') == 3) 
        {
          $('#address').removeClass('danger-alter');
          $('#countryId').removeClass('danger-alter');
          $('#stateId').removeClass('danger-alter');
          $('#cityId').removeClass('danger-alter');
          $('#mob_no').removeClass('danger-alter');

          if ($('#address').val() == '')
          {
            custom_swal("Required !","Enter Your Address!","address");
            return false; 
          }
          if ($('#countryId').val() == '')
          {
            custom_swal("Required !","Enter Your Country!","countryId");
            return false; 
          }
          if ($('#stateId').val() == '')
          {
            custom_swal("Required !","Enter Your State!","stateId");
            return false; 
          }
          if ($('#cityId').val() == '')
          {
            custom_swal("Required !","Enter Your City!","cityId");
            return false; 
          }
          
          if ($('#mob_no').val() == '')
          {
            custom_swal("Required !","Enter Your Mobile Number!","mob_no");
            return false; 
          }
        }
        // CONTACT INFORMATION SECTION END
        // ORGANIZATION INFORMATION SECTION START
        if (current_fs.attr('attr-tab-id') == 4) 
        {
          $('#org_types').removeClass('danger-alter');
          $('#org_name').removeClass('danger-alter');
          $('#sname').removeClass('danger-alter');
          $('#sponsor_email').removeClass('danger-alter');

          if ($('#org_types').val() == '')
          {
            custom_swal("Required !","Select Organization Type!","org_types");
            return false; 
          }
          
          if ($('#org_name').val() == '')
          {
            custom_swal("Required !","Enter Organization Name!","org_name");
            return false; 
          }
          if($('#age').val() < 18)
          {
            var check_1 = email_formate('sponsor_email');
            
            if ($('#sname').val() == '')
            {
              custom_swal("Required !","Enter Sponsor Name!","sname");
              return false; 
            }
            if (check_1 == false) 
            {
              custom_swal("Error!","Please Enter Valid Email Id","sponsor_email");
              $('#sponsor_email').tooltip();
              return false;
            } 
            if ($('#sponsor_email').val() == '')
            {
              custom_swal("Required !","Enter Sponsor Email!","sponsor_email");
              return false; 
            }
          }
        }
        // ORGANIZATION INFORMATION SECTION END
        next_fs = $(this).parent().next();
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
              'transform': 'scale('+scale+')',
              'position': 'absolute'
            });
            next_fs.css({'left': left, 'opacity': opacity});
          }, 
          duration: 800, 
          complete: function(){
            current_fs.hide();
            animating = false;
          }, 
          //this comes from the custom easing plugin
          easing: 'easeInOutBack'
        });
      });

      $(".previous").click(function(){
        if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
          }, 
          duration: 800, 
          complete: function(){
            current_fs.hide();
            animating = false;
          }, 
          //this comes from the custom easing plugin
          easing: 'easeInOutBack'
        });
      });

      $(".submit").click(function(){
        if ($('#list_occupation').val() == '')
        {
          custom_swal("Required !","Enter Your Occupation !","list_occupation");
          return false; 
        };

        if ($('#img_photo_register').val() == '')
        {
          custom_swal("Required !","Image is Required !","img_photo_register");
          return false; 
        };

          
        if($("#is_term_accept").prop("checked") == true)
        {
          $("#MyForm").submit();
        }
        else
        {
          $('#myModal').modal({ show: true });
          return false; 
        }
      })


    function custom_swal(title,message,focus_id,alert_type)
    {
      Swal.fire({
              imageUrl: '../front/icons/alert-icon.png',
              imageWidth: 80,
              imageHeight: 80,
              imageAlt: 'Mbaye The lioness',
              title: "<span id='error'>"+title+"</span>",
              html: message,
              customClass: 'swal-wide',
              padding: '1rem',
              background: 'rgba(8, 64, 147, 0.62)'
            }).then((result) => {
                    $('#'+focus_id).focus();
                    $('#'+focus_id).addClass('danger-alter');
      });
    }


      
     

