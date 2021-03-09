$(window).load(function() {
    testOrientation();
});
$(document).ready(function() {
    //hide the education section first div's remove button
    $(".education-body.main_education_div.div_0 #remove_educ_btn_0").hide();
    $(".work-experience-body.main_work_experience_div.div_0 #remove_work_btn_0").hide();
    $(".reference-body.main_reference_div.div_0 #remove_refr_btn_0").hide();
});

var url = $('meta[name="url"]').attr('content');


// ############################################## FUNCTIONS RELATED TO EDUCATION MODAL  ############################################## //

//for the education clone button
$('.clone-btn-education').click(function(e){
    e.preventDefault();
    var $form = $('form#education-form');
    var newel = $('.education-body:first').clone();  
    $(newel).insertAfter(".education-body:last");
    var new_ele = $('.education-body:last');
    new_ele.find('input').val("");
    new_ele.find('textarea').val("");
    var count = $(".education-body");
    
    //the first element copied has always div_0 class, remove this class and change class with current div count
    new_ele.removeClass('div_0')
    new_ele.addClass('div_'+(educ_div_count))


    //set new id of the newly added education fields
    $(".education-body.main_education_div.div_"+educ_div_count+" #SchoolName_0").attr('id','SchoolName_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #FieldOfStudy_0").attr('id','FieldOfStudy_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #Description_0").attr('id','Description_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #StartDate_0").attr('id','StartDate_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #EndDate_0").attr('id','EndDate_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #id_0").attr('id','id_'+(educ_div_count));
    $(".education-body.main_education_div.div_"+educ_div_count+" #educationLevel_0").attr('id','educationLevel_'+(educ_div_count));
    

    if(count.length>1){
        $(".education-body:last .clone-btn-education").hide();
        $(".education-body:last .remove-btn-education").show();
    }
    //focus the cursor on the newly added div
    $(".education-body:last #SchoolName_"+educ_div_count).focus().select();  

    //increase the count of education div count
    educ_div_count++;        
}); //end of clone education form



var err_message = {};                   //for holding the error messages
function validate_education_fields(num){
    //flag for alerting error message
    var alert_status=false;
    
    //for each div in the  education modal
    for(var i=0;i<num;i++){

        //get the value of each input field from each div in the form
        var start_date = $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).val();
        var end_date = $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).val();
        var school_name = $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).val();
        var field_of_study = $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).val();
        var description = $(".education-body.main_education_div.div_"+i+" #Description_"+i).val();
    
        //check if the field is empty, if empty, show the input field in red and add the error message to the err_message var
        //used key-value pair so the values can easily be checked thru the key
        if(start_date == ""){
            alert_status = true;
            message = 'Start Date';
            err_message[message] = null;
            $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).css('border-color', 'red');
        }else{
            $(".education-body.main_education_div.div_"+i+" #StartDate_"+i).css('border-color', 'white');
        }

        if(end_date==''){
            alert_status = true;
            message = 'End Date';
            err_message[message] = null;
            $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
        }else{
            $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'white');
        }

        if(school_name==''){
            alert_status = true;
            message = 'School Name';
            err_message[message] = null;
            $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).css('border-color', 'red');
        }else{
            $(".education-body.main_education_div.div_"+i+" #SchoolName_"+i).css('border-color', 'white');
        }

        if(field_of_study==''){
            alert_status = true;
            message = 'Field of Study';
            err_message[message] = null;
            $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).css('border-color', 'red');
        }else{
            $(".education-body.main_education_div.div_"+i+" #FieldOfStudy_"+i).css('border-color', 'white');
        }

        if(description==''){
            alert_status = true;
            message = 'Description';
            err_message[message] = null;
            $(".education-body.main_education_div.div_"+i+" #Description_"+i).css('border-color', 'red');
        }else{
            $(".education-body.main_education_div.div_"+i+" #Description_"+i).css('border-color', 'white');
        }

        

        if ((Date.parse(end_date) <= Date.parse(start_date))) {
                alert_status = true;
                 message = 'End Date should not be less than Start Date';
                 err_message[message] = null;
                 $(".education-body.main_education_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
        }
    }//end of for loop
    
    //if there's an error
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
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Ok',
            confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#submit_education').text("Update");
                $('#submit_education').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_education').prop("disabled",false);
                return false;
            }else{
                $('#submit_education').text("Update");
                $('#submit_education').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_education').prop("disabled",false);
            }
        });
    }else{
        //no errors found
        return true;
    }

}//end of validating in the frontend if the fields are with values


//when done is clicked from education modal, save ecucation form
$('.education-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/update_education';
    var $form = $('form#education-form');
    var form_data = $('#education-form').serialize();
    var post_data = new FormData($form[0]);
    var count = $(".education-body");
    totalDiv=count.length;

    //validate the form
    var isValid = validate_education_fields(totalDiv);

    //if there are no errors in the form
    if(isValid){
        $.ajax({
            url: form_url,
            method: 'post', 
            data:post_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#submit_education').text("Update");
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
                    //clear the fields set with changed values
                    if(res){
                        $('.modal-backdrop').remove();
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
        });//end of ajax
        
    } //end of if valid
    
});   //end of education done button

  

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
        new_ele.removeClass('div_0')
        new_ele.addClass('div_'+(work_div_count))
        
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #company_name_0").attr('id','company_name'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #Address_0").attr('id','Address'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #CompRole_0").attr('id','CompRole_'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #CompDesig_0").attr('id','CompDesig_'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #StartDate_0").attr('id','StartDate_'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #EndDate_0").attr('id','EndDate_'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #id_0").attr('id','id_'+(work_div_count));
        $(".work-experience-body.main_work_experience_div.div_"+work_div_count+" #educationLevel_0").attr('id','educationLevel_'+(work_div_count));
              
             if(count.length>1){
                $(".work-experience-body:last .clone-btn-workexperience").hide();
                $(".work-experience-body:last .remove-btn-workexperience").show();

             }
 
       $(".work-experience-body:last #company_name_"+work_div_count).focus().select();
       //increase the count of work div count
       work_div_count++;        
        }); //end of clone work form
        var err_message = {};                   //for holding the error messages
        function validate_workExperience_fields(num){
            //flag for alerting error message
            var alert_status=false;     
    //work experience save

    for(var i=0;i<num;i++){

            var start_date = $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).val();
            var end_date = $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).val();
            var company_name = $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).val();
            var CompRole = $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).val();
            var CompDesig = $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).val();
            var Contact = $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).val();
            var Address = $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).val();

           if(start_date == ""){
                alert_status = true;
                message = 'Start Date';
                err_message[message] = null;
                $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #StartDate_"+i).css('border-color', 'white');
            }
             if(end_date==''){
                 alert_status = true;
                 message = 'End Date is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'white');
            }
             if(company_name==''){
                 alert_status = true;
                 message = 'Company Name is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #company_name_"+i).css('border-color', 'white');
            }
             if(CompRole==''){
                 alert_status = true;
                 message = 'Role is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #CompRole_"+i).css('border-color', 'white');
            }
             if(CompDesig==''){
                 alert_status = true;
                 message = 'Designation is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #CompDesig_"+i).css('border-color', 'white');
            }
             if(Contact==''){
                 alert_status = true;
                 message = 'Contact is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #Contact_"+i).css('border-color', 'white');
            }
             if(Address==''){
                 alert_status = true;
                 message = 'Address is required';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).css('border-color', 'red');
            }else{
                $(".work-experience-body.main_work_experience_div.div_"+i+" #Address_"+i).css('border-color', 'white');
            }
            if ((Date.parse(end_date) <= Date.parse(start_date))) {
                alert_status = true;
                 message = 'End Date should not be less than Start Date';
                 err_message[message] = null;
                 $(".work-experience-body.main_work_experience_div.div_"+i+" #EndDate_"+i).css('border-color', 'red');
            }
        }   //end for loop
      
//if there's an error
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
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Ok',
            confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#WorkData').text("Update");
                $('#WorkData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#WorkData').prop("disabled",false);
                return false;
            }else{
                $('#WorkData').text("Update");
                $('#WorkData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#WorkData').prop("disabled",false);
            }
        });
    }else{
        //no errors found
        return true;
    }

}//end of validating in the frontend if the fields are with values




$('.work-experience-done').click(function(e) {
    e.preventDefault();
    var form_url = url+'/update_work-experience';
    var $form = $('form#work-experience-form');
    var form_data = $('#work-experience-form').serialize();                           
    var post_data = new FormData($form[0]);
    var count = $(".work-experience-body");
    totalDiv=count.length;

    //validate the form
    var isValid = validate_workExperience_fields(totalDiv);

    //if there are no errors in the form
    if(isValid){
        $.ajax({
            url: form_url,
            method: 'post', 
            data:post_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#WorkData').text("Update");
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
                    //clear the fields set with changed values
                    if(res){
                        $('.modal-backdrop').remove();
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
        });//end of ajax
        
    } //end of if valid
    
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
        new_ele.removeClass('div_0')
        new_ele.addClass('div_'+(refr_div_count))

        $(".reference-body.main_reference_div.div_"+refr_div_count+" #Name_0").attr('id','Name'+(refr_div_count));
        $(".reference-body.main_reference_div.div_"+refr_div_count+" #Email_0").attr('id','Email'+(refr_div_count));
        $(".reference-body.main_reference_div.div_"+refr_div_count+" #CompName_0").attr('id','CompName'+(refr_div_count));
        $(".reference-body.main_reference_div.div_"+refr_div_count+" #Designation_0").attr('id','Designation'+(refr_div_count));
                       
                       
        if(count.length>1){
        $(".reference-body:last .clone-btn-reference").hide();
        $(".reference-body:last .remove-btn-reference").show();
        }
        $(".reference-body:last #Name"+refr_div_count).focus().select();
        refr_div_count++;    
                    
    });
    var err_message = {};                   //for holding the error messages
    function validate_Reference_fields(num){
    //flag for alerting error message
    var alert_status=false;
    for(var i=0;i<num;i++){

        var Name = $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).val();
        var Email = $(".reference-body.main_reference_div.div_"+i+" #Email_"+i).val();
        var CompName = $(".reference-body.main_reference_div.div_"+i+" #CompName_"+i).val();
        var Designation = $(".reference-body.main_reference_div.div_"+i+" #Designation_"+i).val();

        if(Name == ''){
                alert_status = true;
                message = 'Name is required';
                err_message[message] = null;
                $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).css('border-color', 'red');
        }else{
                $(".reference-body.main_reference_div.div_"+i+" #Name_"+i).css('border-color', 'white');
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
            $(".reference-body.main_reference_div.div_"+i+" #CompName_"+i).css('border-color', 'red');
        }else{
                $(".reference-body.main_reference_div.div_"+i+" #CompName_"+i).css('border-color', 'white');
        }
        if(Designation==''){
            alert_status = true;
            message = 'Designation is required';
            err_message[message] = null;
            $(".reference-body.main_reference_div.div_"+i+" #Designation_"+i).css('border-color', 'red');
        }else{
                $(".reference-body.main_reference_div.div_"+i+" #Designation_"+i).css('border-color', 'white');
        }

    } //end for loop

    //if there's an error
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
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Ok',
            confirmButtonColor: '#3085d6',
        }).then((res) => {
            if (res.value) {
                err_message = {}; 
                $('#submit_reference').text("Update");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
                return false;
            }else{
                $('#submit_reference').text("Update");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
            }
        });
    }else{
        //no errors found
        return true;
    }

}//end of validating in the frontend if the fields are with values

           

    //Character reference save
    $('.characterRederences-done').click(function(e) {
        e.preventDefault();
    var form_url = url+'/update_character_reference';
    var $form = $('form#reference-form');
    var form_data = $('#reference-form').serialize();                           
    var post_data = new FormData($form[0]);
    var count = $(".reference-body");
    
    totalDiv=count.length;

    //validate the form
    var isValid = validate_Reference_fields(totalDiv);

    //if there are no errors in the form
    if(isValid){
        $.ajax({
            url: form_url,
            method: 'post', 
            data:post_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#submit_reference').text("Update");
                $('#submit_reference').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                $('#submit_reference').prop("disabled",false);
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
                    if(res){
                        window.location.href = url+'/jobseekers/view-profile/'+ id;
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
        });//end of ajax
        
    } //end of if valid
    
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
                if(secondary_email && !validateEmail(secondary_email)){
                    alert_status = true;
                    message = 'Invalid email address';
                    err_message[message] = null;
                    $("#sEmail").css('border-color', 'red');
                }
                else{
                    $("#sEmail").css('border-color', 'white');
                    }
                if(secondary_mobNumber && !validateMobileNumber(secondary_mobNumber)){
                    alert_status = true;
                    message = 'Invalid mobile number';
                    err_message[message] = null;
                    $("#sMobNumber").css('border-color', 'red');
                }
                else{
                    $("#sMobNumber").css('border-color', 'white');
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
                        $('#ContactData').text("Update");
                        $('#ContactData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#ContactData').prop("disabled",false);
                        return false;
                    }else{
                        $('#ContactData').text("Update");
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
                $('#ContactData').text("Update");
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
            $('.aboutme-done,#FeaturedImageData').click(function(e) {
                
                e.preventDefault();
                var form_url = url+'/update_aboutme_details';
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
                        $('#AboutMeData').text("Update");
                        $('#AboutMeData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#AboutMeData').prop("disabled",false);
                        return false;
                    }else{
                        $('#AboutMeData').text("Update");
                        $('#AboutMeData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#AboutMeData').prop("disabled",false);
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
                        $('#AboutMeData').text("Update");
                        $('#AboutMeData').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                        $('#AboutMeData').prop("disabled",false);
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
                                $('.modal-backdrop').remove();
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
           
           
               
            if(alert_status) {
                    let errors = "The following fields are required: ";
                    for (var k in err_message) {
                    errors = errors + "<br/>" +k;
            }Swal.fire({
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
                            $('#Professiondata').text("Update");
                            $('#Professiondata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                            $('#Professiondata').prop("disabled",false);
                            return false;
                        }else{
                            $('#Professiondata').text("Update");
                            $('#Professiondata').css({'background-color':'rgb(48, 133, 214)','cursor':'disabled'});
                            $('#Professiondata').prop("disabled",false);
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
                                $('#Professiondata').text("Update");
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

        function openNav(){  
            document.getElementById("mySidenav").style.width = "14vw";
            document.getElementById("slider").style.display = "none";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav(){
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("slider").style.display = "block";
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
    $("#infoIcon").hide();
    $('#jobseekerEditInstructions').hide();
    $('#arrowGIF2').hide();
    $('.image-editor-modal').show();
    $('#page-content').hide();
}); 

// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//
let oldFeaturedImg;
let isNewImg = true;
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
        $('.image-update').css('display','block');
    }
  

    if(oldFeaturedImg != image.src){
        oldFeaturedImg = image.src;
        isNewImg = true;
    }
    $('#jobseekerEditInstructions').hide();
    $('#arrowGIF2').hide();
    
};


$(".fa-image").on({
     mouseenter: function () {
        $('.fa-image span').css('display', 'block');
    },
    mouseleave: function () {
        $('.fa-image span').css('display', 'none');
        }

});

$('#AboutMeData,#submit_reference,#Professiondata,#submit_education,#WorkData,#ContactData').on('click',function(e){
    $(this).text("Saving...");
    $(this).css({'background-color':'grey','cursor':'disabled'});
    $(this).prop("disabled",true);
});

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    console.log(emailReg.test( $email ));
    return emailReg.test( $email );
}

function validateMobileNumber($mobile){
    var mobileReg =/([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
    return mobileReg.test( $mobile );
}

$("#infoIcon").on('click',function(){
    $('#jobseekerEditInstructions').toggle();
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
}else

{
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


$('#cvDelete').on('click',function(e){

var form_url = url+'/delete_jobseeker_cv';
var filename = $('#cvName').text();


        Swal.fire({
                    title: 'Are you sure yo want to delete this ?',
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
                            $.ajax({
                                type:'POST',
                                url:form_url,
                                data:{
                                    cvfilename: filename,
                                    _token:token
                                },
                                success: function(res) {
                                    $('.cv-delete').hide();
                                    $('.cv-name-divv').css({'padding-top':'4%','padding-bottom':'4%'});
                                }
                            });
                    }
                    
                    });
});

window.addEventListener("resize", function () {
    testFullscreen();
    testOrientation();
});