$(document).ready(function() {
    var options = {
        // data: countries,
        url: url+'/front/json/countries.json',
        getValue: "name",
        list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function() {
                    var selectedItemValue = $("#countries").getSelectedItemData().name;
                    
                    $("#countries").val(selectedItemValue).trigger("change");
                    $('#cities').val('').trigger("change");
                    
                    setCities(selectedItemValue);
                }
            }
    };
    $("#countries").easyAutocomplete(options);

    var allcities;
    $.getJSON( "/front/json/city-countries.json", function( data ) {
        allcities = data;
    });

    function setCities(country)
    {
        var cities = allcities[country];
        var newcities = _.uniq(cities, JSON.stringify);
        
        var options = {
            data: newcities,
            list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function() {
                    var selectedItemValue = $("#cities").getSelectedItemData();

                    $("#cities").val(selectedItemValue).trigger("change");

                    // setCities(selectedItemValue);
                },
            }
        };
        $("#cities").easyAutocomplete(options);
    }
});

if(isMobile()) {
    $('.easy-autocomplete-container').hide();
}

$('.blog-search input').click(function() {
    if(isMobile()) {
        $('.navigator-div').hide();
        $('.easy-autocomplete-container').show();
    }
});

$('.blog-search #countries, .blog-search #cities').click(function() {
    if(isMobile()) {
        $('.easy-autocomplete-container').show();
    }
});

$('.blog-search .search-btn').click(function() {
    if(isMobile()) {
        $('.navigator-div').css('display', 'flex');
    }
});

$('.search-toggle').on('click', function() {
    $('.blog-search').fadeToggle();
});

$(document).click(function(event) {
    if(isMobile()) {
        if ( !$(event.target).hasClass('form-control')) {
            $('.navigator-div').css('display', 'flex');
            $('.easy-autocomplete-container').hide();
        }
    }
});