var url = $('meta[name="url"]').attr('content');

toastr.options = {
    "closeButton": true,
    "timeOut": 10000,
    "extendedTimeOut": 10000,
}

$(document).ready(function() {
    animateDolphin();

    if($.urlParam('search') != '') {
        $('input[name="search"]').val(decodeURIComponent($.urlParam('search')));
    }
    
    if($.urlParam('sort') != '') {
        $('select[name="sort"]').val($.urlParam('sort'));
    }

    if($.urlParam('status') != '') {
        $('select[name="status"]').val($.urlParam('status'));
    }
});

$(window).on('load', function() {
    $('.navigator-div').css("display", "flex").hide().fadeIn(1000);
    $('.wrapper').fadeIn(1000);
});

function animateDolphin() {
    $('.cloud-message').hide();
    $('.cloud-message .message').hide();

    $('.ally-dolphin .dolphin').on('load', function() {
        // console.log('loaded');
        // $(".ally-dolphin .dolphin").on('load', function() {
        // setTimeout(function() {
            // $('.ally-dolphin .dolphin').delay(1000).addClass('animate-ally-1');
            // $('.ally-dolphin').delay(1000).show();
            $('.ally-dolphin .dolphin').addClass('animate-ally-1');
            $('.ally-dolphin').show();
        
        // });
        // var has_started = 0;
        // $('.ally-dolphin').on("webkitAnimationStart animationstart", function(){
        //     if(!has_started) {
        //         $('.cloud-message .message-1').css("display", "flex");

        //         setTimeout(function() {
        //             $('.cloud-message').css("display", "flex");
        //         }, 1000);
                
        //         console.log('start');

        //         has_started = 1;
        //     }
        // });

        var has_added_swim_ally_1 = 0;
        
        $('.ally-dolphin .dolphin.animate-ally-1').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $('.ally-dolphin .dolphin').removeClass('animate-ally-1');
            $('.cloud-message .message-1').css("display", "flex");
            $('.cloud-message').css("display", "flex").hide().fadeIn(300);
            if(!has_added_swim_ally_1) {
                $('.ally-dolphin .dolphin').addClass('swim-ally-1');
                has_added_swim_ally_1 = 1;
            }
            
            $('.ally-dolphin .dolphin.swim-ally-1').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.ally-dolphin .dolphin').removeClass('swim-ally-1');
                $('.cloud-message .message-1').hide();
                $('.cloud-message').hide();
                
                $('.ally-dolphin .dolphin').addClass('animate-ally-2');

                $('.ally-dolphin .dolphin.animate-ally-2').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.ally-dolphin .dolphin').removeClass('animate-ally-2');
                    $('.cloud-message .message-2').css("display", "flex");
                    $('.cloud-message').css("display", "flex");
                    $('.ally-dolphin .dolphin').addClass('swim-ally-2');

                    
                });
            });
        });
    });
}

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if(results) {
        return results[1] || 0;
    } else {
        return '';
    }
}

$('.blog-action-buttons .delete').click(function() {
    var url = $(this).data('url');

    Swal.fire({
        text: "Are you sure you want to delete this story?",
        imageUrl: '../../front/icons/alert-icon.png',
        imageWidth: 80,
        imageHeight: 80,
        imageAlt: 'Mbaye Logo',
        // width: '30%',
        padding: '1rem',
        background: 'rgba(8, 64, 147, 0.78)',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {
        $.ajax({
        type: "DELETE",
        url: url,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            Swal.fire({
                title: '<span class="success">Success!</span>',
                text: data.message,
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                // width: '30%',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.78)'
            }).then((res) => {
                if(res.value) {
                    location.reload(true);
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
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.78)'
                });
            }
        });
    }
    })
});

var navigator_zoom = 0;
var img_has_loaded = 0;

$('button.navigator-zoomin').click( function() {
    if(!navigator_zoom) {
        if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
            $('.navigator-div').hide();
            $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
            // if(!img_has_loaded) {
            //     $('.navigator-div-zoomed-in .lds-ellipsis').show();
            //     // $('.navigator-div-zoomed-in img.astronaut').on('load', function() {
            //         $('.navigator-div-zoomed-in .lds-ellipsis').hide();
            //         $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
            //         img_has_loaded = !img_has_loaded;
            //     });
            // } else {
                $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
            // }
        } else {
            $(this).fadeOut();
            $('.navigator-div').addClass('animate-navigator-zoomin');

            $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.navigator-div').removeClass('animate-navigator-zoomin');
                $('.navigator-div').addClass('zoomin');
            });
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

$('.instructions-btn').click( function() {
    window.location.href = url+'/instructions';
});

$('.tos-btn').click( function() {
    window.location.href = url+'/terms';
});

$('.editphoto-btn').click( function() {
    window.location.href = url+'/profile/edit-photo';
});

$('.participate-btn').click( function() {
    window.location.href = url+'/participateMbaye';
});