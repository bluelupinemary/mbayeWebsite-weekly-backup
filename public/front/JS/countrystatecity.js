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
     var c_check = $('#countryId').val();
     let state_count = 0;
     $('#stateId').html('');
     $('#cityId').html('');
     $.each( alldata, function( key, val ) {
       if(val.name === c_check)
       {
         if(val.states.length)
         {
           $.each( val.states , function( key_c, val_c ) {
             if(state_count == 0 ){
                $('#stateId').append("<option value='" + val_c.name + "'  selected>" + val_c.name + "</option>");
                
                //for the first state in the country, get all cities for that state
                let city_count = 0;
                $.each( val_c.cities , function( key_c, val_city ) {
                    if(city_count == 0) $('#cityId').append("<option value='" + val_city.name + "' selected>" + val_city.name + "</option>");
                    else $('#cityId').append("<option value='" + val_city.name + "'>" + val_city.name + "</option>");
                    city_count++;
                });

             }
             else $('#stateId').append("<option value='" + val_c.name + "'>" + val_c.name + "</option>");
 
              state_count++;
           })
         }
         else
         {
           $('#stateId').append("<option value='" + c_check + "'>" + c_check + "</option>");
         }
       }
     });
   });
  // SECLTING THE STATE TO GET THE CITIES
  $('#stateId').change(function(){
    var c_check = $('#stateId').val();
    $('#cityId').html('');
    
    $.each( alldata, function( key, val ) {
      $.each( val.states , function( key_c, val_c ) {
        if(val_c.name === c_check)
        { 
          
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
// function ajaxCall() {
//     this.send = function(data, url, method, success, type) {
//         type = type||'json';
//         var successRes = function(data) {
//             success(data);
//         }

//         var errorRes = function(e) {
//             console.log(e);
//             //alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
//             //jQuery('#loader').modal('hide');
//         }
//         jQuery.ajax({
//             url: url,
//             type: method,
//             data: data,
//             success: successRes,
//             error: errorRes,
//             dataType: type,
//             timeout: 60000
//         });

//     }

// }

// function locationInfo() {
//     var rootUrl = "//geodata.solutions/api/api.php";
//     //set default values
//     var username = 'demo';
//     var ordering = 'name';
//     //now check for set values
//     var addParams = '';
//     if(jQuery("#gds_appid").length > 0) {
//         addParams += '&appid=' + jQuery("#gds_appid").val();
//     }
//     if(jQuery("#gds_hash").length > 0) {
//         addParams += '&hash=' + jQuery("#gds_hash").val();
//     }

//     var call = new ajaxCall();

//     this.confCity = function(id) {
//      //   console.log(id);
//      //   console.log('started');
//         var url = rootUrl+'?type=confCity&countryId='+ jQuery('#countryId option:selected').attr('countryid') +'&stateId=' + jQuery('#stateId option:selected').attr('stateid') + '&cityId=' + id;
//         var method = "post";
//         var data = {};
//         call.send(data, url, method, function(data) {
//             if(data){
//                 //    alert(data);
//             }
//             else{
//                 //   alert('No data');
//             }
//         });
//     };


//     this.getCities = function(id) {
//         jQuery(".cities option:gt(0)").remove();
//         //get additional fields
//         var stateClasses = jQuery('#cityId').attr('class');

//         var cC = stateClasses.split(" ");
//         cC.shift();
//         var addClasses = '';
//         if(cC.length > 0)
//         {
//             acC = cC.join();
//             addClasses = '&addClasses=' + encodeURIComponent(acC);
//         }
//         var url = rootUrl+'?type=getCities&countryId='+ jQuery('#countryId option:selected').attr('countryid') +'&stateId=' + id + addParams + addClasses;
//         var method = "post";
//         var data = {};
//         jQuery('.cities').find("option:eq(0)").html("Please wait..");
//         call.send(data, url, method, function(data) {
//             jQuery('.cities').find("option:eq(0)").html("Select City");
//             if(data.tp == 1){
//                 if(data.hits > 1000)
//                 {
//                     //alert('Free usage far exceeded. Please subscribe at geodata.solutions.');
//                     console.log('Daily geodata.solutions request limit exceeded count:' + data.hits + ' of 1000');
//                 }
//                 else
//                 {
//                     console.log('Daily geodata.solutions request count:' + data.hits + ' of 1000')
//                 }

//                 var listlen = Object.keys(data['result']).length;

//                 if(listlen > 0)
//                 {
//                     jQuery.each(data['result'], function(key, val) {

//                         var option = jQuery('<option />');
//                         option.attr('value', val).text(val);
//                         jQuery('.cities').append(option);
//                     });
//                 }
//                 else
//                 {
//                     var usestate = jQuery('#stateId option:selected').val();
//                     var option = jQuery('<option />');
//                     option.attr('value', usestate).text(usestate);
//                     option.attr('selected', 'selected');
//                     jQuery('.cities').append(option);
//                 }

//                 jQuery(".cities").prop("disabled",false);
//             }
//             else{
//                 alert(data.msg);
//             }
//         });
//     };

//     this.getStates = function(id) {
//         jQuery(".states option:gt(0)").remove();
//         jQuery(".cities option:gt(0)").remove();
//         //get additional fields
//         var stateClasses = jQuery('#stateId').attr('class');

//         var cC = stateClasses.split(" ");
//         cC.shift();
//         var addClasses = '';
//         if(cC.length > 0)
//         {
//             acC = cC.join();
//             addClasses = '&addClasses=' + encodeURIComponent(acC);
//         }
//         var url = rootUrl+'?type=getStates&countryId=' + id + addParams  + addClasses;
//         var method = "post";
//         var data = {};
//         jQuery('.states').find("option:eq(0)").html("Please wait..");
//         call.send(data, url, method, function(data) {
//             jQuery('.states').find("option:eq(0)").html("Select State");
//             if(data.tp == 1){
//                 if(data.hits > 1000)
//                 {
//                     //alert('Free usage far exceeded. Please subscribe at geodata.solutions.');
//                     console.log('Daily geodata.solutions request limit exceeded:' + data.hits + ' of 1000');
//                 }
//                 else
//                 {
//                     console.log('Daily geodata.solutions request count:' + data.hits + ' of 1000')
//                 }
//                 jQuery.each(data['result'], function(key, val) {
//                     var option = jQuery('<option />');
//                     option.attr('value', val).text(val);
//                     option.attr('stateid', key);
//                     jQuery('.states').append(option);
//                 });
//                 jQuery(".states").prop("disabled",false);
//             }
//             else{
//                 alert(data.msg);
//             }
//         });
//     };

//     this.getCountries = function() {
//         //get additional fields
//         var countryClasses = jQuery('#countryIds').attr('class');

//         var cC = countryClasses.split(" ");
//         cC.shift();
//         var addClasses = '';
//         if(cC.length > 0)
//         {
//             acC = cC.join();
//             addClasses = '&addClasses=' + encodeURIComponent(acC);
//         }

//         var presel = false;
//         var iip = 'N';
//         jQuery.each(cC, function( index, value ) {
//             if (value.match("^presel-")) {
//                 presel = value.substring(7);

//             }
//             if(value.match("^presel-byi"))
//             {
//                 var iip = 'Y';
//             }
//         });


//         var url = rootUrl+'?type=getCountries' + addParams + addClasses;
//         var method = "post";
//         var data = {};
//         jQuery('.countries').find("option:eq(0)").html("Please wait..");
//         call.send(data, url, method, function(data) {
//             jQuery('.countries').find("option:eq(0)").html("Select Country");

//             if(data.tp == 1){
//                 if(data.hits > 1000)
//                 {
//                     //alert('Free usage far exceeded. Please subscribe at geodata.solutions.');
//                     console.log('Daily geodata.solutions request limit exceeded:' + data.hits + ' of 1000');
//                 }
//                 else
//                 {
//                     console.log('Daily geodata.solutions request count:' + data.hits + ' of 1000')
//                 }
//                 if(presel == 'byip')
//                 {
//                     presel = data['presel'];
//                     console.log('2 presel is set as ' + presel);
//                 }


//                 if(jQuery.inArray("group-continents",cC) > -1)
//                 {
//                     var $select = jQuery('.countries');
//                     console.log(data['result']);
//                     jQuery.each(data['result'], function(i, optgroups) {
//                         var $optgroup = jQuery("<optgroup>", {label: i});
//                         if(optgroups.length > 0)
//                         {
//                             $optgroup.appendTo($select);
//                         }

//                         jQuery.each(optgroups, function(groupName, options) {
//                             var coption = jQuery('<option />');
//                             coption.attr('value', options.name).text(options.name);
//                             coption.attr('countryid', options.id);
//                             if(presel) {
//                                 if (presel.toUpperCase() == options.id) {
//                                     coption.attr('selected', 'selected');
//                                 }
//                             }
//                             coption.appendTo($optgroup);
//                         });
//                     });
//                 }
//                 else
//                 {
//                     jQuery.each(data['result'], function(key, val) {
//                         var option = jQuery('<option />');
//                         option.attr('value', val).text(val);
//                         option.attr('countryid', key);
//                         if(presel)
//                         {
//                             if(presel.toUpperCase() ==  key)
//                             {
//                                 option.attr('selected', 'selected');
//                             }
//                         }
//                         jQuery('.countries').append(option);
//                     });
//                 }
//                 if(presel)
//                 {
//                     jQuery('.countries').trigger('change');
//                 }
//                 jQuery(".countries").prop("disabled",false);
//             }
//             else{
//                 alert(data.msg);
//             }
//         });
//     };

// }

// jQuery(function() {
//     var loc = new locationInfo();
//     loc.getCountries();
//     jQuery(".countries").on("change", function(ev) {
//         var countryId = jQuery("option:selected", this).attr('countryid');
//         if(countryId != ''){
//             loc.getStates(countryId);
//         }
//         else{
//             jQuery(".states option:gt(0)").remove();
//         }
//     });
//     jQuery(".states").on("change", function(ev) {
//         var stateId = jQuery("option:selected", this).attr('stateid');
//         if(stateId != ''){
//             loc.getCities(stateId);
//         }
//         else{
//             jQuery(".cities option:gt(0)").remove();
//         }
//     });

//     jQuery(".cities").on("change", function(ev) {
//         var cityId = jQuery("option:selected", this).val();
//         if(cityId != ''){
//             loc.confCity(cityId);
//         }
//     });
// });
