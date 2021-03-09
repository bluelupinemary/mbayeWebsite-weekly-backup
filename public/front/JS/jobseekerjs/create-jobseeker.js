var url = $('meta[name="url"]').attr('content');
$(".save-btn").click(function(){
    var object_count = canvas.getObjects().length;
    if(object_count < 1) { 
     
        Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: 'Error!',
                    html: 'Please Upload Image(s)',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });

    }
    else{
        $(".save").click();
    }
});

//TOOLTIP POSITION FOR THE ICONS
$( document ).tooltip({
    position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
        $( this ).css( position );
        $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
    }
}); 

//function to check if save icon should be enabled
function countObjects(){
    var object_count = canvas.getObjects().length;

    if(object_count < 1) {
        $('.save').prop('disabled', true);
    }
}


$(".remove-btn-education").hide();
$(".remove-btn-workexperience").hide();
$(".remove-btn-reference").hide();
        
// clone-btn-workexperience
$('.clone-btn-workexperience').click(function(e) {
    e.preventDefault();
                                                                                                    
    var $form = $('form#work-experience-form');                                                 
    var newel = $('.work-experience-body:first').clone();
    $(newel).insertAfter(".work-experience-body:last");
    var new_ele = $('.work-experience-body:last');
    new_ele.find('input').val("");
    new_ele.find('textarea').val("");
    var count = $(".work-experience-body");
            new_ele.removeClass('workDiv_'+(count.length-1))
            new_ele.addClass('workDiv_'+count.length)
          
         if(count.length>1){
            $(".work-experience-body:last .clone-btn-workexperience").hide();
            $(".work-experience-body:last .remove-btn-workexperience").show();

         }
   $(".work-experience-body:last #start_date").focus().select();
});
//work experience save
$('.work-experience-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/save_work_experience';
    var $form = $('form#work-experience-form');
    var form_data = $('#work-experience-form').serialize();
    var post_data = new FormData($form[0]);
    var count = $(".work-experience-body");
    totalDiv=count.length;
    var alert_status;
    var err_message = {}; 
    for(var i=1;i<=totalDiv;i++){

        var start_date = $("form#work-experience-form .workDiv_"+i+" #start_date").val();
        var end_date = $("form#work-experience-form .workDiv_"+i+' #end_date').val();
        var company_name = $("form#work-experience-form .workDiv_"+i+' #company_name').val();
        var CompRole = $("form#work-experience-form .workDiv_"+i+' #CompRole').val();
        var CompDesig = $("form#work-experience-form .workDiv_"+i+' #CompDesig').val();
        var Contact = $("form#work-experience-form .workDiv_"+i+' #Contact').val();
        var Address = $("form#work-experience-form .workDiv_"+i+' #Address').val();

       

        if(start_date==''){
            alert_status = true;
             message = 'Start Date is required';
             err_message[message] = null;
             $("form#work-experience-form .workDiv_"+i+" #StartDate").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #StartDate").css('border-color', 'white');
        }
        
        if(end_date==''){
             alert_status = true;
             message = 'End Date is required';
             err_message[message] = null;
             $("form#work-experience-form .workDiv_"+i+" #EndDate").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #EndDate").css('border-color', 'white');
        }
        
        if(company_name==''){
             alert_status = true;
             message = 'Company Name is required';
             err_message[message] = null;
             $("form#work-experience-form .workDiv_"+i+" #company_name").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #company_name").css('border-color', 'white');
        }
        
        if(CompRole==''){
             alert_status = true;
             message = 'Role is required';
             err_message[message] = null;
             $("form#work-experience-form .div_"+i+" #CompRole").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #CompRole").css('border-color', 'white');
        }
        
        if(CompDesig==''){
             alert_status = true;
             message = 'Designation is required';
             err_message[message] = null;
             $("form#work-experience-form .div_"+i+" #CompDesig").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #CompDesig").css('border-color', 'white');
        }
        
        if(Contact==''){
             alert_status = true;
             message = 'Contact is required';
             err_message[message] = null;
             $("form#work-experience-form .div_"+i+" #Contact").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #Contact").css('border-color', 'white');
        }
        
        if(Address==''){
             alert_status = true;
             message = 'Address is required';
             err_message[message] = null;
             $("form#work-experience-form .div_"+i+" #Address").css('border-color', 'red');
        }
        else{
            $("form#work-experience-form .workDiv_"+i+" #Address").css('border-color', 'white');
        }

        if ((Date.parse(end_date) <= Date.parse(start_date))) {
            alert_status = true;
             message = 'End Date should not be less than Start Date';
             err_message[message] = null;
             $("form#work-experience-form .workDiv_"+i+" #EndDate").css('border-color', 'red');
        }
    }
  
    if(alert_status) {
        let errors = "The following fields are required: ";
            for (var k in err_message) {
            errors = errors + "<br/>" +k;
            }
        Swal.fire({
                title: 'Error!',
                html: errors,
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Ok',
                confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#WorkData').text("Done");
                $('#WorkData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#WorkData').prop("disabled",false);
                return false;
            }else{
                $('#WorkData').text("Done");
                $('#WorkData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#WorkData').prop("disabled",false);
            }
        });
    } else {
        $.ajax({
            url: form_url,
            method: 'post',
            data: post_data ,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                    $('#WorkData').text("Done");
                    $('#WorkData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                    $('#WorkData').prop("disabled",false);
            
                    Swal.fire({
                    title: '<span class="success">Success!</span>',
                    text: data.message,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)',
                    allowOutsideClick: false
                }).then((res) => {
                    $('#WorkExperienceModal').modal('hide');
                    $('#ContactModal').modal('show');
                    $('.modal-backdrop').remove();
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
        });
    }
            
});

// clone-btn-education
$('.clone-btn-education').click(function(e){
    e.preventDefault();
            var $form = $('form#education-form');
            var newel = $('.education-body:first').clone();
            $(newel).insertAfter(".education-body:last");
            var new_ele = $('.education-body:last');
            new_ele.find('input').val("");
            new_ele.find('textarea').val("");
            var count = $(".education-body");
            new_ele.removeClass('div_'+(count.length-1))
            new_ele.addClass('div_'+count.length)
            if(count.length>1){
                $(".education-body:last .clone-btn-education").hide();
                $(".education-body:last .remove-btn-education").show();
            }
            $(".education-body:last #SchoolName").focus().select();  
});


//education save
$('.education-done').click(function(e) {

    e.preventDefault();
    var form_url = url+'/save_education';
    var $form = $('form#education-form');
    var form_data = $('#education-form').serialize();
    var post_data = new FormData($form[0]);
    var count = $(".education-body");
    var err_message = {};
    totalDiv=count.length;
    var alert_status=false;
  
    for(var i=1;i<=totalDiv;i++){

        var start_date = $("form#education-form .div_"+i+" #StartDate").val();
        var end_date = $("form#education-form .div_"+i+' #EndDate').val();
        var school_name = $("form#education-form .div_"+i+' #SchoolName').val();
        var field_of_study = $("form#education-form .div_"+i+' #FieldOfStudy').val();
        var desccription = $("form#education-form .div_"+i+' #Description').val();
       

        if(start_date==''){
            alert_status = true;
             message = 'Start Date is required';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #StartDate").css('border-color', 'red');
        }
        else{ 
            $("form#education-form .div_"+i+" #StartDate").css('border-color', 'white');
        }
        if(end_date==''){
             alert_status = true;
             message = 'End Date is required';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #EndDate").css('border-color', 'red');
        }
        else{ 
            $("form#education-form .div_"+i+" #EndDate").css('border-color', 'white');
        }
         if(school_name==''){
             alert_status = true;
             message = 'School Name is required';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #SchoolName").css('border-color', 'red');
        }
        else{ 
            $("form#education-form .div_"+i+" #SchoolName").css('border-color', 'white');
        }
         if(field_of_study==''){
             alert_status = true;
             message = 'Filed Of study is required';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #FieldOfStudy").css('border-color', 'red');
        }
        else{ 
            $("form#education-form .div_"+i+" #FieldOfStudy").css('border-color', 'white');
        }
         if(desccription==''){
             alert_status = true;
             message = 'Description is required';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #Description").css('border-color', 'red');
        }
        else{ 
            $("form#education-form .div_"+i+" #Description").css('border-color', 'white');
        }

        if ((Date.parse(end_date) <= Date.parse(start_date))) {
            alert_status = true;
             message = 'End Date should not be less than Start Date';
             err_message[message] = null;
             $("form#education-form .div_"+i+" #EndDate").css('border-color', 'red');
        }
    }
    
    
if(alert_status) {
let errors = "The following fields are required: ";
    for (var k in err_message) {
       errors = errors + "<br/>" +k;
    }
Swal.fire({
        title: 'Error!',
        html: errors,
        imageUrl: '../../front/icons/alert-icon.png',
        imageWidth: 80,
        imageHeight: 80,
        imageAlt: 'Mbaye Logo',
        padding: '1rem',
        background: 'rgba(8, 64, 147, 0.62)',
        showCloseButton: true,
        focusConfirm: true,
        confirmButtonText:
            'Ok',
        confirmButtonColor: '#3085d6',
}).then((res) => {
    if (res.value) {
        err_message = {}; 
        $('#submit_education').text("Done");
        $('#submit_education').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
        $('#submit_education').prop("disabled",false);
        return false;
    }else{
        $('#submit_education').text("Done");
        $('#submit_education').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
        $('#submit_education').prop("disabled",false);
    }
});
} else {


    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data ,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('#submit_education').text("Done");
            $('#submit_education').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
            $('#submit_education').prop("disabled",false);
            Swal.fire({
                title: '<span class="success">Success!</span>',
                text: data.message,
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                allowOutsideClick: false
            }).then((res) => {
                $('#EducationModal').modal('hide');
                $('#WorkExperienceModal').modal('show');
                $('.modal-backdrop').remove();
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
    });
}      
        });   


// clone-btn-character reference
$('.clone-btn-reference').click(function(e) {
                    e.preventDefault();
                    var $form = $('form#reference-form');
                    var newel = $('.reference-body:first').clone();
                    $(newel).insertAfter(".reference-body:last");
                    var new_ele = $('.reference-body:last');
                    new_ele.find('input').val("");
                    var count = $(".reference-body");
                    new_ele.removeClass('referenceDiv_'+(count.length-1))
                    new_ele.addClass('referenceDiv_'+count.length)
                   
                    if(count.length>1){
                        $(".reference-body:last .clone-btn-reference").hide();
                        $(".reference-body:last .remove-btn-reference").show();
                    }
                    $(".reference-body:last #Name").focus().select();    
                
        });

//Character reference save
$('.characterRederences-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/save_character_references';
    var $form = $('form#reference-form');
    var post_data = new FormData($form[0]);
    var count = $(".reference-body");
    totalDiv=count.length;
    var alert_status;
    var err_message = {}; 
    for(var i=1;i<=totalDiv;i++){
        
        var Name = $("form#reference-form .referenceDiv_"+i+" #Name").val();
        var Email = $("form#reference-form .referenceDiv_"+i+' #Email').val();
        var CompName = $("form#reference-form .referenceDiv_"+i+' #CompName').val();
        var Designation = $("form#reference-form .referenceDiv_"+i+' #Designation').val();
       

        if(Name==''){
            alert_status = true;
             message = 'Name is required';
             err_message[message] = null;
             $("form#reference-form .referenceDiv_"+i+" #Name").css('border-color', 'red');
        }
        else{
            $("form#reference-form .referenceDiv_"+i+" #Name").css('border-color', 'white');
        }

        if(Email == '' || !validateEmail(Email)){
            alert_status = true;
            message = 'Invalid email address';
            err_message[message] = null;
            $(".reference-body.main_reference_div.div_"+i+" #Email_"+i).css('border-color', 'red');
        }else{
                $(".reference-body.main_reference_div.div_"+i+" #Email_"+i).css('border-color', 'white');
        }
        
        if(CompName==''){
             alert_status = true;
             message = 'Company Name is required';
             err_message[message] = null;
             $("form#reference-form .referenceDiv_"+i+' #CompName').css('border-color', 'red');
        }
        else{
            $("form#reference-form .referenceDiv_"+i+" #CompName").css('border-color', 'white');
        }

        if(Designation==''){
             alert_status = true;
             message = 'Designation is required';
             err_message[message] = null;
             $("form#reference-form .referenceDiv_"+i+' #Designation').css('border-color', 'red');
        }
       else{
            $("form#reference-form .referenceDiv_"+i+" #Designation").css('border-color', 'white');
        }
    }
    
    if(alert_status) {
        let errors = "The following fields are required: ";
            for (var k in err_message) {
            errors = errors + "<br/>" +k;
            }
        Swal.fire({
                title: 'Error!',
                html: errors,
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Ok',
                confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#submit_reference').text("Done");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
                return false;
            }else{
                $('#submit_reference').text("Done");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
            }
        });
    } else {
        $.ajax({
            url: form_url,
            method: 'post',
            data: post_data ,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#submit_reference').text("Done");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
                Swal.fire({
                    title: '<span class="success">Your Jobseeker Profile is created successfully!</span>',
                    text: data.message,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)',
                    allowOutsideClick: false
                }).then((res) => {
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
        });
            
    } 
});   

//conatct details save
$('.contact-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/save_contact_details';
    var $form = $('form#contact-form');
    var post_data = new FormData($form[0]);
    var alert_status;
    var err_message = {};
            var secondary_email = $("form#contact-form #sEmail").val();
            var secondary_mobNumber = $("form#contact-form #sMobNumber").val();
            if(secondary_email = '' || !validateEmail(secondary_email)){
                validateEmail(secondary_email);
                alert_status = true;
                message = 'Invalid email address';
                err_message[message] = null;
                $("#sEmail").css('border-color', 'red');
            }
            else{
                $("#sEmail").css('border-color', 'white');
            }

            if(alert_status) {
                let errors = "The following fields are required: ";
                    for (var k in err_message) {
                    errors = errors + "<br/>" +k;
                    }
    
                Swal.fire({
                    title: 'Error!',
                    html: errors,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)',
                    showCloseButton: true,
                    focusConfirm: true,
                    confirmButtonText:
                        'Ok',
                    confirmButtonColor: '#3085d6',
                }).then((res) => {
                    if (res.value) {
                        err_message = {}; 
                        $('#ContactData').text("Done");
                        $('#ContactData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#ContactData').prop("disabled",false);
                        return false;
                    }else{
                        $('#ContactData').text("Done");
                        $('#ContactData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#ContactData').prop("disabled",false);
                    }
                });
            } else {
   
                $.ajax({
                    url: form_url,
                    method: 'post',
                    data: post_data ,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#ContactData').text("Done");
                        $('#ContactData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#ContactData').prop("disabled",false);
                        Swal.fire({
                            title: '<span class="success">Success!</span>',
                            text: data.message,
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)',
                            allowOutsideClick: false
                        }).then((res) => {
                            $('#ContactModal').modal('hide');
                            $('#CharacterReferencesModal').modal('show');
                            $('.modal-backdrop').remove();
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
                });
            }    
}); 

        //About me save
$('.aboutme-done').click(function(e) {
            
            e.preventDefault();
            var form_url = url+'/save_aboutme_details';
            var $form = $('form#aboutme-form');
            var post_data = new FormData($form[0]);
            var alert_status;
            var err_message = {};
            var objective = $("form#aboutme-form #objective").val();
            var country = $("form#aboutme-form #countryId").val();
            var state = $("form#aboutme-form #stateId").val();
            var city = $("form#aboutme-form #cityId").val();
            var present_address = $("form#aboutme-form #pAddress").val();
            
            if(objective==''){
                alert_status = true;
                message = 'objective is required';
                err_message[message] = null;
                $("#objective").css('border-color', 'red');
            }
            else{
                $("#objective").css('border-color', 'white');
                }
           
            if(country==''){
                alert_status = true;
                message = 'country is required';
                err_message[message] = null;
                $("#countryId").css('border-color', 'red');
            }
            else{
                $("#countryId").css('border-color', 'white');
                }
            if(state==''){
                alert_status = true;
                message = 'state is required';
                err_message[message] = null;
                $("#stateId").css('border-color', 'red');
            }
            else{
                $("#stateId").css('border-color', 'white');
                }
            if(city==''){
                alert_status = true;
                message = 'city is required';
                err_message[message] = null;
                $("#cityId").css('border-color', 'red');
            }
            else{
                $("#cityId").css('border-color', 'white');
                }
             if(present_address==''){
                alert_status = true;
                message = 'Present address is required';
                err_message[message] = null;
                $("#pAddress").css('border-color', 'red');
            }
            else{
                $("#pAddress").css('border-color', 'white');
                }
            
            if(alert_status) {
                let errors = "The following fields are required: ";
                    for (var k in err_message) {
                    errors = errors + "<br/>" +k;
                    }
                Swal.fire({
                    title: 'Error!',
                    html: errors,
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)',
                    showCloseButton: true,
                    focusConfirm: true,
                    confirmButtonText:
                        'Ok',
                    confirmButtonColor: '#3085d6',
                }).then((res) => {
                    if (res.value) {
                        err_message = {}; 
                        $('#AboutMedata').text("Done");
                        $('#AboutMedata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#AboutMedata').prop("disabled",false);
                        return false;
                    }else{
                        $('#AboutMedata').text("Done");
                        $('#AboutMedata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#AboutMedata').prop("disabled",false);
                    }
                });
         } else {
           
        
            $.ajax({
                url: form_url,
                method: 'post',
                data:post_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#AboutMedata').text("Done");
                    $('#AboutMedata').css({'background-color':'#3085d6','cursor':'pointer'});
                    $('#AboutMedata').prop("disabled",false);
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        if (res.value) {
                            $('#AboutMeModal').modal('hide');
                            $('.modal-backdrop').remove();
                            $('.navbar-tabs #professionTab').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #educationTab').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #workExperienceTab').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #contactTab').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #characterRefTab').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #viewJobseeker').css({'pointer-events':'auto','cursor':'pointer'});
                            $('.navbar-tabs #professionTab').attr('data-toggle', 'modal');
                            $('.navbar-tabs #educationTab').attr('data-toggle', 'modal');
                            $('.navbar-tabs #workExperienceTab').attr('data-toggle', 'modal');
                            $('.navbar-tabs #contactTab').attr('data-toggle', 'modal');
                            $('.navbar-tabs #characterRefTab').attr('data-toggle', 'modal');
                            $('.navbar-tabs #viewJobseeker').attr('href', viewProfileUrl);

                            $('.navbar-tabs #professionTab').attr('data-target', '#ProfessionSkillModal');
                            $('.navbar-tabs #educationTab').attr('data-target', '#EducationModal');
                            $('.navbar-tabs #workExperienceTab').attr('data-target', '#WorkExperienceModal');
                            $('.navbar-tabs #contactTab').attr('data-target', '#ContactModal');
                            $('.navbar-tabs #characterRefTab').attr('data-target', '#CharacterReferencesModal');


                            $("#ProfessionSkillModal").modal('show');
                            
                        }
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
            });
        }
                    
}); 
        

        //About me end

       //Character reference save
$('.profession-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/save_professional_details';
    var $form = $('form#profession-form');
    var post_data = new FormData($form[0]);
    var alert_status;
    var err_message = {};
  
    var professsion = $("form#profession-form #Profession").val();
    var skills = $("form#profession-form  #skills").val();
    
    if(professsion=='' || professsion==null){
        alert_status = true;
        message = 'Profession is required';
        err_message[message] = null;
        $("#Profession").css('border-color', 'red');
    }else{
        $("#Profession").css('border-color', 'white');
    }

    if(skills==''){
        alert_status = true;
        message = 'Skills are required';
        err_message[message] = null;
        $("#skills").css('border-color', 'red');
    }else{
        $("#skills").css('border-color', 'white');
    }
       
       
           
    if(alert_status){
        let errors = "The following fields are required: ";
        for (var k in err_message) {
            errors = errors + "<br/>" +k;
        }
        Swal.fire({
                title: 'Error!',
                html: errors,
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Ok',
                confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#Professiondata').text("Done");
                $('#Professiondata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#Professiondata').prop("disabled",false);
                return false;
            }else{
                $('#Professiondata').text("Done");
                $('#Professiondata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#Professiondata').prop("disabled",false);
            }
        }); //end of sweetalert
    }else{
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#Professiondata').text("Done");
                    $('#Professiondata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                    $('#Professiondata').prop("disabled",false);
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((res) => {
                        $('#ProfessionSkillModal').modal('hide');
                        $('#EducationModal').modal('show');
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
            });//end of sweetalert
                    
    }//end of else alert status
}); //end of profession-done button


    function openNav(){
            if(isImageAvailable){
                document.getElementById("mySidenav").style.width = "14vw";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }else{
                    Swal.fire({
                        title: 'Upload Image First',
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCloseButton: true,
                        focusConfirm: true,
                        cancelButtonText:'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    })
                 }
        
        }

        function closeNav(){
            document.getElementById("mySidenav").style.width = "0";
            document.body.style.backgroundColor = "white";
        }
        
        function remove(e){
            Swal.fire({
                title: 'Are you sure yo want to remove this',
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Yes, I\'m sure',
                cancelButtonText:
                    'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then((res) => {
                if(res.value){
                    $(e).closest('.education-body').remove();
                }
            });
        }

        function remove_work_experience(e){
            Swal.fire({
                title: 'Are you sure yo want to remove this',
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Yes, I\'m sure',
                cancelButtonText:
                    'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then((res) => {
                if(res.value){
                    $(e).closest('.work-experience-body').remove();
                }
            });
        }

        function remove_reference(e){
            Swal.fire({
                title: 'Are you sure yo want to remove this',
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText:
                    'Yes, I\'m sure',
                cancelButtonText:
                    'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then((res) => {
                if(res.value){
                    $(e).closest('.reference-body').remove();
                }
            });
        }
       
        // -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

//function called with edit image button is clicked
$('#edit_uploaded_image').on('click', function(){
$('.image-editor-modal').show();
$('#page-content').hide();
}); 



// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

let oldFeaturedImg;
let isNewImg = true;
let isImageAvailable = false;
var loadFile = function(event) {
//changed output to featured-image-previewimg
var image = document.getElementById('featured-image-previewimg');
image.src = URL.createObjectURL(event.target.files[0]);

if (typeof image != 'undefined'){
    $('#middle').css('opacity','0');
    $('#middle').css('opacity','0');
    $('#middleText').text("Upload Featured Image");
    $('#edit_uploaded_image').css('display','block');
    $('#featured-image-previewimg').css('display','block');
    isImageAvailable = true;
}


if(oldFeaturedImg != image.src){
    oldFeaturedImg = image.src;
    isNewImg = true;
}
$('.sidenav-heading').click();
$('.view-car-profile').css({'cursor':'not-allowed'});
$('.tab').css({'cursor':'not-allowed'});
$('#jobseekerInstructions').hide();
$('#arrowGIF2').hide();
};

$('.tab').on('click',function(e){
e.preventDefault();
});



$(".fa-image").on({
 mouseenter: function () {
    $('.fa-image span').css('display', 'block');
},
mouseleave: function () {
    $('.fa-image span').css('display', 'none');
    }

});



$('#AboutMedata,#submit_reference,#Professiondata,#submit_education,#WorkData,#ContactData').on('click',function(e){
$(this).text("Saving...");
$(this).css({'background-color':'grey','cursor':'disabled'});
$(this).prop("disabled",true);
});

function validateEmail($email) {
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
return emailReg.test( $email );
}

function validateMobileNumber($mobile){
var mobileReg =/([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
return mobileReg.test( $mobile );
}

$("#infoIcon").on('click',function(){
$('#jobseekerInstructions').toggle();
$('#arrowGIF2').toggle();
});


$('#skills').on("keyup", function(e){
if(e.which === 13 || e.keyCode === 13){
    document.getElementById('skills').value += '•';
}
});


$('#skills').on("focus", function(e){
if (document.getElementById('skills').value === '') {
    document.getElementById('skills').value += '•';
}
});

function checkCompRole(txt){
let theVal = $(txt).val();
if(theVal === "" || theVal === 'undefined'){
    let res2 = theVal + '•';
    $(txt).val(res2);
}
}

function checkCompRoleUp(txt,e){ 
if(e.which === 13 || e.keyCode === 13){
    let theVal = $(txt).val();
    let res2 = theVal + '•';
    $(txt).val(res2);         
}
}

$('#docpicker').on('change',function(e){
var duration = 3000;
var res=$('#docpicker').val();
console.log($('#docpicker'));
var arr = res.split("\\");
var filename=arr.slice(-1)[0];
filextension=filename.split(".");
filext="."+filextension.slice(-1)[0];
valid=[".pdf",".doc",".docx",".odt"];
$(".progress-bar").css('width',0);
$('#cvName').text(filename);
var FileSize = $(this)[0].files[0].size / 1024 / 1024;
if (FileSize > 1) {
$( "#barTextsize" ).show("slow");
$('#docpicker').val('');
$('#progress').hide("slow");
$('#barText').hide("slow");
}else{
    //if file is not valid we show the error icon, the red alert, and hide the submit button
        if (valid.indexOf(filext.toLowerCase())==-1){
            $( ".imgupload" ).hide("slow");
            $( ".imgupload.ok" ).hide("slow");
            $( "#barTextstop" ).show("slow");
            $('#docpicker').val('');
        }else{
            $('#progress').css('display','flex');
            $( "#barTextstop" ).hide("slow");
            $( "#barTextsize" ).hide("slow");
            $('#barText').css('display','none');
            $(".progress-bar").animate({width: "100%"},
                {
                    duration: duration,
                    progress: function(promise, progress, ms) {
                        $(this).text(Math.round(progress * 100) + '%');
                        if(Math.round(progress * 100)=== 100){
                            $('#barText').css('display','block');
                        } 
                    }
                }   
            );

        }
    }    

});

window.addEventListener("resize", function () {
    testFullscreen();
    testOrientation();
});