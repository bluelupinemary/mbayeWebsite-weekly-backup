// CODE THAT WAS HERE IS NOW IN ANOTHER FILE NAME COUNTRIESSTATE_ONLOAD 
$.each( alldata, function( countryKey, countryVal ) { //iterate the countires-state-cityobj
    if(countryVal.name == "{{ $user->country }}") //check if users country match woth any country
    {
      $('#countryId').append("<option Selected value='" + countryVal.name + "'>" + countryVal.name + "</option>");

      if(countryVal.states.length) //check if country has any states
      {
        $.each( countryVal.states , function( stateKey, stateVal ) //iterate through states 
        {
          if(stateVal.name === "{{ $user->state }}") //if state match with users state
          {
            // add selected attribute to the select
            $('#stateId').append("<option selected value='" + stateVal.name + "'>" + stateVal.name + "</option>");
          }
          else
          {
            $('#stateId').append("<option value='" + stateVal.name + "'>" + stateVal.name + "</option>");
          }
           
          //  iterate through the cities added in the JSON Object
          if(stateVal.cities.length)
          {
            $.each( stateVal.cities , function( cityKey, cityVal ) //iterate through cities 
            {
              if(cityVal.name === "{{ $user->city }}") //if state match with users state
              {
                // add selected attribute to the select
                $('#cityId').append("<option selected value='" + cityVal.name + "'>" + cityVal.name + "</option>");
              }
              else
              {
                $('#cityId').append("<option value='" + cityVal.name + "'>" + cityVal.name + "</option>");
              }
            });   
          }
        }); //iteration through the states ends here
      }
    }
    else
    {
      $('#countryId').append("<option value='" + countryVal.name + "'>" + countryVal.name + "</option>");
    }     
  });