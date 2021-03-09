var url = $('meta[name="url"]').attr('content');
    
$(document).ready(function() {
    /**
     * If browser is Chrome, add transform-style preserve-3d to .view div
     */
    if(navigator.userAgent.includes('Chrome') && !navigator.userAgent.includes('Chromium')) {
        // alert();
        $('.view').css('transform-style', 'preserve-3d');
    }

    /**
     * GENERAL PAGE CAROUSEL
     */
    $('#myCarousel').carousel({
        interval: false
    });
});

$(window).load(function() {
    $('.astro-div').css('display', 'flex').hide().fadeIn();

    /**
     * START GENERAL PAGE CAROUSEL JS
     */
    $('.carousel .item').each(function(){
        var next = $(this).next();
        console.log('next: ', next);
        if (!next.length) {
            next = $(this).siblings(':first');
            console.log('next siblings: ', next);
        }
        if(blogs_count > 2 && !isMobile()) {
        console.log('next child: ', next.children(':first-child'));
        next.children(':first-child').clone().appendTo($(this));
        }
        
        if (next.next().length>0) {
            console.log('next next: ', next.next().children(':first-child'));
            next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });

    var blog_name = '';
    var naff_count = '';

    $('.carousel .item-slide').mouseover(function() {
            // alert();
            var item_class = '';
            $(this).attr('class').split(' ').map(function(className){     
                item_class += '.'+className;
                // alert(clssName)
            });

            var parent_item_classes = '';
            $(this).closest('.item').attr('class').split(' ').map(function(className){     
                parent_item_classes += '.'+className;
                // alert(clssName)
            });

            var iwidth = $(parent_item_classes+' '+item_class).find('img').width();
            var iheight = $(parent_item_classes+' '+item_class).find('img').height();
            var blog_name_id =  $(parent_item_classes+' '+item_class).find('.blog_name').attr('id');
            var naff_count_id = $(parent_item_classes+' '+item_class).find('.naff_count').attr('id');
            
            // console.log(item_classes, item_classes+' #'+blog_name_id);

            console.log(iwidth, iheight);
            var ratio = 4;
            if(iwidth < iheight) {
                ratio = 6;
            } else if (iwidth > iheight) {
                ratio = 4;
            } else if (iwidth == iheight) {
                ratio = 7;
            }

            $(parent_item_classes+' '+item_class).find('.blog_name').css({
                'top': "-"+ ((iheight/ratio)) + "px",
            });

            $(parent_item_classes+' '+item_class).find('.naff_count').css({
                'bottom': "-"+ ((iheight/ratio)) + "px",
            });
            // blog_name = '';
            // naff_count = '';
            if(blog_name == '' && naff_count == '') {
                console.log('circle', blog_name_id, naff_count_id);
                var radius = 80;

                if(window.innerWidth >= 1920) {
                    radius = 120;
                }

                blog_name = new CircleType(document.querySelector(parent_item_classes+' '+item_class+' #'+blog_name_id))
                    .dir(1)
                    .radius(radius);

                naff_count = new CircleType(document.querySelector(parent_item_classes+' '+item_class+' #'+naff_count_id))
                    .dir(-1)
                    .radius(radius);

                $(parent_item_classes+' '+item_class).find('.blog_name, .naff_count').addClass('animated zoomIn');
                $(parent_item_classes+' '+item_class).find('.blog_name, .naff_count').css('opacity', '1');
            }
        }).mouseout(function() {
            $('.blog_name, .naff_count').removeClass('animated zoomIn');
            $('.blog_name, .naff_count').css('opacity', '0');
            console.log('remove circle');

            if(blog_name && naff_count) {
                blog_name.destroy();
                naff_count.destroy();
                
            }

            blog_name = '';
            naff_count = '';
        });

    var elements = document.querySelectorAll('.carousel .img-responsive');

    for (var i=0; i<elements.length; i++) {
        if(elements[i].width < elements[i].height) {
            elements[i].classList.add("img-portrait");
        } else if(elements[i].width == elements[i].height) {
            elements[i].classList.add("img-square");
        }
    }

    if(isMobile()) {
        $('.carousel').addClass('carousel-fade');
    }
    $('.most-naffed').css('display', 'block').hide().fadeIn();

    /**
     * END GENERAL PAGE CAROUSEL JS
     */
});

/**
 * Check if device is in mobile
 */
function isMobile() {
    try{ document.createEvent("TouchEvent"); return true; }
    catch(e){ return false; }
}

/**
    Click function for the div to show the tittle and content and 
*/
$(document).on("click",".div_img", function () { 
    
    $(".div_count_icon").css({'display':'none'});
    $(".div_count_bg").css({'display':'none'});
    $("#clicked_img .overlay").css({'display':'none'});   
    $("#clicked_img .div_title").css({'display':'none'});   
    $("#clicked_img .div_btn").css({'display':'none'});
    $(".tag.front").show();
    $(this).find(".tag.front").hide();
    $(".overlay").removeClass("overlay_portrait");
    $(".div_overlay").removeClass("div_overlay_p");
    // $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'unset','left':'0'});
    // $(".blog-buttons_overlay .button-div").css({'flex-direction':'unset'});
    $('div.cell').removeAttr('id');
    $(this).attr('id','clicked_img');
    var clicked_img_id = $(this).attr('id');
    var img = $("#clicked_img> a>img");
    var pos = $("#clicked_img> a>img").position();
    var  top=$("#clicked_img> a>img").css("top");
    var  left=$("#clicked_img> a>img").css("left");
    var  width=$("#clicked_img> a>img").css("width");
    var  height=$("#clicked_img> a>img" ).css("height");

    $("#clicked_img .overlay").css({'display':'flex'});
    $("#clicked_img .div_title").css({'display':'block'});
    $("#clicked_img .div_btn").css({'display':'block'});

    /* for checking orientation of an image*/

    if (img.width() > img.height()){
        var differernce=img.width() -img.height();
    }

    // if (img.width() > img.height()) {
        $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
        $(".blog-buttons_overlay").css({'width':'82%'});
    
    // } 
    // else {
        // $(".overlay").addClass("overlay_portrait");
        // $(".div_overlay").addClass("div_overlay_p");
        // $(".blog-buttons_overlay").css({'display':'flex','flex-flow':'row wrap', 'width':'100%'});
        // $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
    // } 

});

/**
 * NAVIGATOR ASTRONAUT BUTTON FUNCTIONALITY
 */

$('.communicator-div').click( function() {
    window.location.href = url+'/communicator';
});

$('.home-btn').click( function() {
    window.location.href = url;
});

$('.profile-btn').click( function() {
    window.location.href = url+'/dashboard';
});

$('.participate-btn').click( function() {
    window.location.href = url+'/participateMbaye';
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

var astronaut_zoom = 0;
var navigator_zoom = 0;
$('button.zoom-btn').click( function() { 

    if(!navigator_zoom) {
        // alert('zoomin');
        $('.zoom-btn').hide();
        $('.navigator-div').addClass('animate-navigator-zoomin');
        
        $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $('.navigator-div').removeClass('animate-navigator-zoomin');
            $('.navigator-div').addClass('zoomin');

            // $('.zoom-btn').hide();
            $('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'auto');
            // $('.btn_pointer').css('pointer-events', 'auto');
            
        });
    }
    
    // }

    navigator_zoom = !navigator_zoom;
});
//Zoom out animation
$('.navigator-zoomout-btn').click(function() {
    // alert('zoomout');
    $('.navigator-div').addClass('animate-navigator-zoomout');

    $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $('.navigator-div').removeClass('animate-navigator-zoomout');
        $('.navigator-div').removeClass('zoomin');
        $('.zoom-btn').show();
        
        $('.navigator-buttons, .communicator-div, .instructions-div, .tos-div, .navigator-zoomout-btn').css('pointer-events', 'none');
    });

    navigator_zoom = !navigator_zoom;
});