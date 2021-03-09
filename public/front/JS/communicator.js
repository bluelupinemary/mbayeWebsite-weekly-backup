var text_editor = document.querySelector("trix-editor");
var url = $('meta[name="url"]').attr('content');
let window_url = window.location.href;
var browser = Object.keys($.browser)[0];
var color_hex;
var colors = [
    "#1abc9c"
    , "#2ecc71"
    , "#3498db"
    , "#9b59b6"
    , "#000000"
    , "#16a085"
    , "#27ae60"
    , "#1B4F72"
    , "#8e44ad"
    , "#495057"
    , "#f1c40f"
    , "#e67e22"
    , "#e74c3c"
    , "#ecf0f1"
    , "#95a5a6"
    , "#f39c12"
    , "#d35400"
    , "#c0392b"
    , "#bdc3c7"
    , "#7f8c8d"
];

$(document).ready(function() {
    if (typeof Trix == 'undefined') {
        $('head').append('<link rel="stylesheet" type="text/css" href="'+url+'/trix/trix.css">');
        $('head').append('<script src="'+url+'/trix/trix.js">');
    }

    // element.editor.insertHTML("<div>Enter content here...</div>");
    $('input[type="checkbox"]').prop('checked', false);
    trixTextColorButton('.trix-editor');

    $('.main-form #font-picker').fontselect({
        searchable: false,
    })
    .on('change', function() {
        applyFont(this.value, '.trix-editor');
        $('.main-form .font-picker').hide();
    });

    Trix.config.textAttributes.foregroundColor = {
        styleProperty: "color",
        inheritable: true,
        // tagName: 'span',
        // className: ['.text-color'],
        nestable: true,
        parser: function(element) {
            return element.style.color;
        },
    }

    Trix.config.textAttributes.fontFamily = {
        styleProperty: "font-family",
        inheritable: true,
        nestable: true,
        parser: function(element) {
            if(element.style.fontFamily) {
                // remove quotes on string
                var font = element.style.fontFamily.replace(/['"]+/g, '');
                // console.log(font);
                if(font != null || font != '') {
                    // console.log(document.fonts.check('1em '+font));
                    // check if font exist
                    var check_font = document.fonts.check('1em '+font);
                    if(!check_font) {
                        // append link stylesheet
                        $('head').append('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='+font+'">');
                    }

                    return element.style.fontFamily;
                }
            }
        },
    }

    Trix.config.textAttributes.fontWeight = {
        styleProperty: "font-weight",
        inheritable: true,
        // tagName: 'span',
        // className: ['.text-color'],
        nestable: true,
        parser: function(element) {
            return element.style.fontWeight;
        },
    }

    var main_pk = new Piklor(".color-picker", colors, {
            open: ".trix-button--icon-text-color",
            style: { display: 'flex'},
            // autoclose: false,
            closeOnBlur: true
        });

        main_pk.colorChosen(function (col) {
            setForegroundColor(col, '.trix-editor');
        });
});

function setForegroundColor(col, editorClass) {
    var trixEditor = document.querySelector(editorClass+' trix-editor');
    trixEditor.editor.activateAttribute("foregroundColor", col);
}

function applyFont(font, editorClass) {
    console.log('You selected font: ' + font);
  
    // Replace + signs with spaces for css
    font = font.replace(/\+/g, ' ');
  
    // Split font into family and weight
    font = font.split(':');
  
    var fontFamily = font[0];
    var fontWeight = font[1] || 400;
  
    // Set selected font on paragraphs
    // $('p').css({fontFamily:"'"+fontFamily+"'", fontWeight:fontWeight});
    var trixEditor = document.querySelector(editorClass+' trix-editor');
    trixEditor.editor.activateAttribute("fontFamily", fontFamily);
    trixEditor.editor.activateAttribute("fontWeight", fontWeight);
}

function getRGB(str){
    var match = str.match(/rgba?\((\d{1,3}), ?(\d{1,3}), ?(\d{1,3})\)?(?:, ?(\d(?:\.\d?))\))?/);
    return match ? {
      red: match[1],
      green: match[2],
      blue: match[3]
    } : {};
}

function rgbToHex(rgb) { 
    var hex = Number(rgb).toString(16);
    if (hex.length < 2) {
         hex = "0" + hex;
    }
    return hex;
}

function fullColorHex(r,g,b) {   
    var red = rgbToHex(r);
    var green = rgbToHex(g);
    var blue = rgbToHex(b);

    return red+green+blue;
}

function trixTextColorButton(editorClass) {
    var trixEditor_class = editorClass+' trix-editor';
    var text_color = '<button type="button" class="trix-button trix-button--icon trix-button--icon-text-color" data-trix-attribute="foregroundColor" data-trix-action="text-color" title="Text color" tabindex="-1">Text color</button>'
    var font = '<button type="button" class="trix-button trix-button--icon trix-button--icon-text-font" data-trix-attribute="fontFamily" data-trix-action="font-family" title="Text Font" tabindex="-1">Text Font</button>'
    
    var trixEditor = document.querySelector(trixEditor_class);
    console.log(trixEditor_class);
    var toolbarElement = trixEditor.toolbarElement;
    var groupElement = toolbarElement.querySelector(".trix-button-group.trix-button-group--text-tools");
      
    groupElement.insertAdjacentHTML("afterbegin", font);
    groupElement.insertAdjacentHTML("beforeend", text_color);

    $(editorClass+' button.trix-button--icon-text-font').click(function() {
        $(editorClass+' .font-picker').toggle();
    });
}

// get URl parameter value
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    
    if(results) {
        return results[1] || 0;
    } else {
        return 0;
    }
}


function removeURLParameter(parameter) {
    //prefer to use l.search if you have a location/link object
    var url = window.location.href;
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0]+'?'+pars.join('&');
        window.history.pushState({path:url},'',url);
    }
}

$(window).load(function() {
    if(window_url.includes('?') && $.urlParam('action') == 'edit_blog') {
        setButtonLabel(blog);
        $(".astronautarm-img").show();
        $(".start-div").hide();
        $(".astronautarm-img").addClass('animate-zoomIn-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-zoomIn-arm');
            $(".astronautarm-img").addClass('zoomIn-arm');
            $('.blog-btn').addClass('active');
            setBlogFormValue(blog);
            showBlogSection();
        });

        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .top-buttons, .camera-div, .voice-recorder-div').css('pointer-events', 'auto');
    } else if(window_url.includes('?') && $.urlParam('action') == 'edit_career_blog') {
        setButtonLabel(blog);
        $(".astronautarm-img").show();
        $(".start-div").hide();
        $(".astronautarm-img").addClass('animate-zoomIn-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-zoomIn-arm');
            $(".astronautarm-img").addClass('zoomIn-arm');
            $('.blog-btn').addClass('active');
            setBlogFormValue(blog);
            showCareerBlogSection();
        });

        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .top-buttons, .camera-div, .voice-recorder-div').css('pointer-events', 'auto');
    } else if (window_url.includes('?') && $.urlParam('action') == 'edit_design_blog') {
        $(".astronautarm-img").show();
        $(".start-div").hide();
        $(".astronautarm-img").addClass('animate-zoomIn-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-zoomIn-arm');
            $(".astronautarm-img").addClass('zoomIn-arm');
            // $('.blog-btn').addClass('active');
            hideBlogSection();
            setDesignBlogFormValue(blog);
            showDesignsBlogSection();
            setButtonLabel(blog);
        });

        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .top-buttons, .camera-div, .voice-recorder-div').css('pointer-events', 'auto');
    } else if (window_url.includes('?') && $.urlParam('action') == 'edit_general_blog') {
        $(".astronautarm-img").show();
        $(".start-div").hide();
        $(".astronautarm-img").addClass('animate-zoomIn-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-zoomIn-arm');
            $(".astronautarm-img").addClass('zoomIn-arm');
            // $('.blog-btn').addClass('active');
            hideBlogSection();
            setGeneralBlogFormValue(blog);
            showGeneralBlogSection();
            setButtonLabel(blog);
        });

        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .top-buttons, .camera-div, .voice-recorder-div').css('pointer-events', 'auto');
    } else {
        // if url has parameters and if action is edit_blog
        removeURLParameter('section')

        $(".astronautarm-img").show();
        $(".astronautarm-img").addClass('animate-arm');

        $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            $(".astronautarm-img").removeClass('animate-arm');
            $(".start-div").animate({opacity:1},500);
            // alert(slider_height);
            // $('.slick-list').height(slider_height);
            // $('.slick-track').css('transform', 'translate3d(0px, '+Math.ceil(slider_height)+', 0px) !important');
        });
    }
});

$('trix-editor').focus( function() {
    removeTrixPlaceholder();
});

// Zoom in arm
$('.start-div').click( function() {
    $(this).hide();
    
    $(".astronautarm-img").addClass('animate-zoomIn-arm');

    $('.astronautarm-img').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $(".astronautarm-img").removeClass('animate-zoomIn-arm');
        $(".astronautarm-img").addClass('zoomIn-arm');
        // $(".blog-btn").delay(1000).animate({opacity:1},100);
        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .top-buttons, .camera-div, .voice-recorder-div').css('pointer-events', 'auto');
        $('.blog-btn').addClass('active');
        showBlogSection();
    });
});

// save blog as DRAFT
$('.communicator-buttons .save-button').click(function (e) {
    e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'none');

    // initialize form and other input fields
    var $form = $('form#main-form');
    var content = $("input[name='blog-trixFields[content]']").val();
    var tags = getTagIDs();
    var form_url = url+'/blogs';
    var blog_id = $form.find("input[name='blog_id']").val();
    var attachments = $('input[name="attachment-blog-trixFields[content]"]').val();
    var save_status = $form.find("input[name='save_status']").val();
    var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
        return this.value;
    }).toArray();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.delete('video_link');
    post_data.append('content', content);
    post_data.append('tags', tags);
    post_data.append('status', save_status);
    post_data.append('attachments', attachments);
    post_data.append('privacy', privacy);

    // update blog if blog_id is not null
    if(blog_id != '') {
        form_url = form_url+'/'+blog_id;

        Swal.fire({
            text: "Are you sure you want to save the changes made to the entry?",
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
        if (result.value) {
            $('.main-screen').hide();
            $('.main-body').fadeIn();
            $('.main-body .saving').fadeIn();

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                    // Swal.fire({
                    //     title: '<span class="success">Success!</span>',
                    //     text: data.message,
                    //     imageUrl: '../../front/icons/alert-icon.png',
                    //     imageWidth: 80,
                    //     imageHeight: 80,
                    //     imageAlt: 'Mbaye Logo',
                    //     width: '30%',
                    //     padding: '1rem',
                    //     background: 'rgba(8, 64, 147, 0.62)'
                    // });

                    
                    $('.main-body').fadeOut(function() {
                        $('.main-body .saving').fadeOut();
                        $('.main-screen').fadeIn();
                    });

                    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
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

                    $('.main-body').fadeOut(function() {
                        $('.main-body .saving').fadeOut();
                        $('.main-screen').fadeIn();

                        Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: title,
                            html: errorString,
                            // width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                        });
                    });

                    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
                }
            });
        }
        })
        
    } else {  // create new blog
        $('.main-screen').hide();
        $('.main-body').fadeIn();
        $('.main-body .saving').fadeIn();

        $.ajax({
            url: form_url,
            method: 'post',
            data: post_data ,
            // dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $form.append('<input type="hidden" name="_method" value="PUT">');
                $('input[name="blog_id"]').val(data.data.id);

                // Swal.fire({
                //     title: '<span class="success">Success!</span>',
                //     text: data.message,
                //     imageUrl: '../../front/icons/alert-icon.png',
                //     imageWidth: 80,
                //     imageHeight: 80,
                //     imageAlt: 'Mbaye Logo',
                //     width: '30%',
                //     padding: '1rem',
                //     background: 'rgba(8, 64, 147, 0.62)'
                // });

                $('.main-body').fadeOut(function() {
                    $('.main-body .saving').fadeOut();
                    $('.main-screen').fadeIn();
                });

                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
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

                $('.main-body').fadeOut(function() {
                    $('.main-body .saving').fadeOut();
                    $('.main-screen').fadeIn();

                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        // width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                });

                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
            }
        });
    }
});

// republish blog
// $('.communicator-buttons .publish-button.republish-blog').click(function (e) {
function republishBlog() {
    // alert('republish');
    // e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'none');
    
    // initialize form and other input fields
    var $form = $('form#main-form');
    var content = $(".main-form input[name='blog-trixFields[content]']").val();
    var tags = getTagIDs();
    var form_url = url+'/republish_blog';
    var blog_id = $form.find("input[name='blog_id']").val();
    var attachments = $('.main-form input[name="attachment-blog-trixFields[content]"]').val();
    var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
        return this.value;
    }).toArray();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.delete('_method');
    post_data.delete('video_link');
    post_data.append('content', content);
    post_data.append('tags', tags);
    post_data.append('status', 'Published');
    post_data.append('blog_id', blog_id);
    post_data.append('attachments', attachments);
    post_data.append('privacy', privacy);

    $('.main-screen').hide();
    $('.main-body').fadeIn();
    $('.main-body .prepare').fadeIn();
    // update blog if blog_id is not null
    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data ,
        // dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('.main-body .prepare').fadeOut();
            $('.exhaust-flame').addClass('exhaust-flame2');
            $('.exhaust-fumes').fadeOut(function() {

                $('.rocket-launching').addClass('launch');

                $('.launch').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.rocket-launching').hide();
                    $('.main-body .success').css('display', 'flex').hide().fadeIn();

                    $('.message.success button').click(function() {
                        // $('.main-body').fadeOut(function() {
                        //     $('.main-body .prepare').fadeOut();
                        //     $('.main-screen').fadeIn();
                        // });

                        // reset form
                        // resetBlogForm();
                        // unsetButtonLabel();

                        // // show rocket
                        // $('.main-body, .main-body .prepare').fadeOut();
                        // $('.main-screen').fadeIn();
                        // $('.exhaust-fumes').show();
                        // $('.exhaust-flame').removeClass('exhaust-flame2');
                        // $('.main-body .success').hide();
                        // $('.rocket-launching').show();
                        // $('.rocket-launching').removeClass('launch');
                        
                        // // enable buttons
                        // $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');

                        // redirect to single_blog
                        // window.open(url+'/single_blog/'+data.data.id, '_blank');
                        window.location.href = url+'/single_blog/'+data.data.id; 
                    });
                });
            });

            // Swal.fire({
            //     title: '<span class="success">Success!</span>',
            //     text: data.message,
            //     imageUrl: '../../front/icons/alert-icon.png',
            //     imageWidth: 80,
            //     imageHeight: 80,
            //     imageAlt: 'Mbaye Logo',
            //     width: '30%',
            //     padding: '1rem',
            //     background: 'rgba(8, 64, 147, 0.62)'
            // }).then((res) => {
            //     // window.open(url+'/single_blog/'+data.data.id);
            //     window.location.href = url+'/single_blog/'+data.data.id;
            // });
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

            $('.main-body').fadeOut(function() {
                $('.main-body .prepare').fadeOut();
                $('.main-screen').fadeIn();
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: title,
                    html: errorString,
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });
            });

            $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
        }
    });
}

// publish/launch blog
$('.communicator-buttons .publish-button.publish-blog').click(function (e) {
    if (!$(this).hasClass('republish-blog')) {
        // alert('publish');
        e.preventDefault();

        $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'none');
        
        // initialize form and other input fields
        var $form = $('form#main-form');
        var content = $(".main-form input[name='blog-trixFields[content]']").val();
        var tags = getTagIDs();
        var form_url = url+'/publish_blog';
        var blog_id = $form.find("input[name='blog_id']").val();
        var attachments = $('.main-form input[name="attachment-blog-trixFields[content]"]').val();
        var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
            return this.value;
        }).toArray();

        // prepare post data
        var post_data = new FormData($form[0]);
        post_data.delete('_method');
        post_data.delete('video_link');
        post_data.append('content', content);
        post_data.append('tags', tags);
        post_data.append('status', 'Published');
        post_data.append('blog_id', blog_id);
        post_data.append('attachments', attachments);
        post_data.append('privacy', privacy);

        $('.main-screen').hide();
        $('.main-body').fadeIn();
        $('.main-body .prepare').fadeIn();
        // update blog if blog_id is not null
        $.ajax({
            url: form_url,
            method: 'post',
            data: post_data ,
            // dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.main-body .prepare').fadeOut();
                $('.exhaust-flame').addClass('exhaust-flame2');
                $('.exhaust-fumes').fadeOut(function() {

                    $('.rocket-launching').addClass('launch');

                    $('.launch').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.rocket-launching').hide();
                        $('.main-body .success').css('display', 'flex').hide().fadeIn();

                        $('.message.success button').click(function() {
                            // $('.main-body').fadeOut(function() {
                            //     $('.main-body .prepare').fadeOut();
                            //     $('.main-screen').fadeIn();
                            // });
                            window.location.href = url+'/single_blog/'+data.data.id;
                        });
                    });
                });

                // Swal.fire({
                //     title: '<span class="success">Success!</span>',
                //     text: data.message,
                //     imageUrl: '../../front/icons/alert-icon.png',
                //     imageWidth: 80,
                //     imageHeight: 80,
                //     imageAlt: 'Mbaye Logo',
                //     width: '30%',
                //     padding: '1rem',
                //     background: 'rgba(8, 64, 147, 0.62)'
                // }).then((res) => {
                //     // window.open(url+'/single_blog/'+data.data.id);
                //     window.location.href = url+'/single_blog/'+data.data.id;
                // });
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

                $('.main-body').fadeOut(function() {
                    $('.main-body .prepare').fadeOut();
                    $('.main-screen').fadeIn();
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        // width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                });

                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .communicator-buttons').css('pointer-events', 'auto');
            }
        });
    }
});

$('.general-blog-buttons .publish-button').click(function (e) {
    e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .general-blog-buttons').css('pointer-events', 'none');

    // initialize form and other input fields
    var $form = $('form#general-blog-form');
    var content = $(".general-blog-form input[name='blog-trixFields[general_blog_content]']").val();
    var form_url = url+'/publish_general_blog';
    var attachments = $('.general-blog-form input[name="attachment-blog-trixFields[general_blog_content]"]').val();
    var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
        return this.value;
    }).toArray();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.delete('_method');
    post_data.delete('video_link');
    post_data.append('content', content);
    post_data.append('status', 'Published');
    post_data.append('attachments', attachments);
    post_data.append('privacy', privacy);

    $('.main-screen').hide();
    $('.main-body').fadeIn();
    $('.main-body .prepare').fadeIn();
    // update blog if blog_id is not null
    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data ,
        // dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('.main-body .prepare').fadeOut();
            $('.exhaust-flame').addClass('exhaust-flame2');
            $('.exhaust-fumes').fadeOut(function() {

                $('.rocket-launching').addClass('launch');

                $('.launch').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.rocket-launching').hide();
                    $('.main-body .success').css('display', 'flex').hide().fadeIn();

                    $('.message.success button').click(function() {
                        // $('.main-body').fadeOut(function() {
                        //     $('.main-body .prepare').fadeOut();
                        //     $('.main-screen').fadeIn();
                        // });
                        // alert();
                        window.location.href = url+'/single_general_blog/'+data.data.id;
                    });
                });
            });

            // Swal.fire({
            //     title: '<span class="success">Success!</span>',
            //     text: data.message,
            //     imageUrl: '../../front/icons/alert-icon.png',
            //     imageWidth: 80,
            //     imageHeight: 80,
            //     imageAlt: 'Mbaye Logo',
            //     width: '30%',
            //     padding: '1rem',
            //     background: 'rgba(8, 64, 147, 0.62)'
            // }).then((res) => {
            //     // window.open(url+'/single_blog/'+data.data.id);
            //     window.location.href = url+'/single_general_blog/'+data.data.id;
            //     // resetGeneralBlogForm();
            // });
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
            
            $('.main-body').fadeOut(function() {
                $('.main-body .prepare').fadeOut();
                $('.main-screen').fadeIn();
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: title,
                    html: errorString,
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });
            });

            $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .general-blog-buttons').css('pointer-events', 'auto');
        }
    });
});

$('.designs-blog-buttons .save-button').click(function (e) {
    e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'none');

    // initialize form and other input fields
    var $form = $('form#designs-blog-form');
    var content = $(".designs-blog-form input[name='blog-trixFields[designs_blog_content]']").val();
    var form_url = url+'/publish_design_blog';
    var blog_id = $form.find("input[name='blog_id']").val();
    var attachments = $('.designs-blog-form input[name="attachment-blog-trixFields[designs_blog_content]"]').val();
    var save_status = $form.find("input[name='save_status']").val();
    var tags = ["8"];
    var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
        return this.value;
    }).toArray();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.append('content', content);
    post_data.append('status', save_status);
    post_data.append('attachments', attachments);
    post_data.append('tags', tags);
    post_data.append('privacy', privacy);

    // update blog if blog_id is not null
    if(blog_id != '') {
        Swal.fire({
            text: "Are you sure you want to save the changes made to the entry?",
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
        if (result.value) {
            $('.main-screen').hide();
            $('.main-body').fadeIn();
            $('.main-body .saving').fadeIn();

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                    // Swal.fire({
                    //     title: '<span class="success">Success!</span>',
                    //     text: data.message,
                    //     imageUrl: '../../front/icons/alert-icon.png',
                    //     imageWidth: 80,
                    //     imageHeight: 80,
                    //     imageAlt: 'Mbaye Logo',
                    //     width: '30%',
                    //     padding: '1rem',
                    //     background: 'rgba(8, 64, 147, 0.62)'
                    // });

                    $('.main-body').fadeOut(function() {
                        $('.main-body .saving').fadeOut();
                        $('.main-screen').fadeIn();
                    });

                    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
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
                    
                    $('.main-body').fadeOut(function() {
                        $('.main-body .saving').fadeOut();
                        $('.main-screen').fadeIn();

                        Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: title,
                            html: errorString,
                            // width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                        });
                    });

                    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
                }
            });
        }
        })
        
    } else {  // create new blog
        $('.main-screen').hide();
        $('.main-body').fadeIn();
        $('.main-body .saving').fadeIn();

        $.ajax({
            url: form_url,
            method: 'post',
            data: post_data ,
            // dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // $form.append('<input type="hidden" name="_method" value="PUT">');
                $('input[name="blog_id"]').val(data.data.id);

                // Swal.fire({
                //     title: '<span class="success">Success!</span>',
                //     text: data.message,
                //     imageUrl: '../../front/icons/alert-icon.png',
                //     imageWidth: 80,
                //     imageHeight: 80,
                //     imageAlt: 'Mbaye Logo',
                //     width: '30%',
                //     padding: '1rem',
                //     background: 'rgba(8, 64, 147, 0.62)'
                // });

                $('.main-body').fadeOut(function() {
                    $('.main-body .saving').fadeOut();
                    $('.main-screen').fadeIn();
                });

                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
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
                
                $('.main-body').fadeOut(function() {
                    $('.main-body .saving').fadeOut();
                    $('.main-screen').fadeIn();

                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        // width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                });

                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
            }
        });
    }

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
});

$('.designs-blog-buttons .publish-button').click(function (e) {
    e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'none');

    // initialize form and other input fields
    var $form = $('form#designs-blog-form');
    var content = $(".designs-blog-form input[name='blog-trixFields[designs_blog_content]']").val();
    var form_url = url+'/publish_design_blog';
    var blog_id = $form.find("input[name='blog_id']").val();
    var attachments = $('.designs-blog-form input[name="attachment-blog-trixFields[designs_blog_content]"]').val();
    var tags = ["8"];
    var privacy = $('form#custom-privacy-form input:checkbox:checked').map(function(){
        return this.value;
    }).toArray();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.delete('_method');
    post_data.append('content', content);
    post_data.append('status', 'Published');
    post_data.append('blog_id', blog_id);
    post_data.append('attachments', attachments);
    post_data.append('tags', tags);
    post_data.append('privacy', privacy);

    $('.main-screen').hide();
    $('.main-body').fadeIn();
    $('.main-body .prepare').fadeIn();
    // update blog if blog_id is not null
    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data ,
        // dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('.main-body .prepare').fadeOut();
            $('.exhaust-flame').addClass('exhaust-flame2');
            $('.exhaust-fumes').fadeOut(function() {

                $('.rocket-launching').addClass('launch');

                $('.launch').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.rocket-launching').hide();
                    $('.main-body .success').css('display', 'flex').hide().fadeIn();

                    $('.message.success button').click(function() {
                        // $('.main-body').fadeOut(function() {
                        //     $('.main-body .prepare').fadeOut();
                        //     $('.main-screen').fadeIn();
                        // });
                        window.location.href = url+'/single_blog/'+data.data.id;
                    });
                });
            });

            // Swal.fire({
            //     title: '<span class="success">Success!</span>',
            //     text: data.message,
            //     imageUrl: '../../front/icons/alert-icon.png',
            //     imageWidth: 80,
            //     imageHeight: 80,
            //     imageAlt: 'Mbaye Logo',
            //     width: '30%',
            //     padding: '1rem',
            //     background: 'rgba(8, 64, 147, 0.62)'
            // }).then((res) => {
            //     // window.open(url+'/single_blog/'+data.data.id);
            //     window.location.href = url+'/single_blog/'+data.data.id;
            // });
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
            
            $('.main-body').fadeOut(function() {
                $('.main-body .prepare').fadeOut();
                $('.main-screen').fadeIn();
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: title,
                    html: errorString,
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });
            });

            $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .designs-blog-buttons').css('pointer-events', 'auto');
        }
    });
});

// highlighting selected blog tags
$('.tag-btn').click(function () {
    var tag = $(this).data('tag');
    var checkbox = '#'+tag+'_tag';

    $(this).toggleClass('shadow');
    if($(this).hasClass('shadow')) {
        $(checkbox).prop("checked", true);
        $(checkbox).attr("value", '1');
    } else {
        $(checkbox).prop("checked", false);
        $(checkbox).attr("value", '0');
    }
});

// upload featured image
$("#featured_image").change(function (event) {
    console.log(this.files[0].size);
    if (this.files[0].size > 5242880 ) {
        $(this).val('');

        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: '',
            html: '<p>Allowed file size exceeded. (Max. 5 MB)</p>',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
        });
    } else {
        filePreview(this);
    }
});

$("#general_blog_featured_image").change(function (event) {
    console.log(this.files[0].size);
    if (this.files[0].size > 5242880 ) {
        $(this).val('');

        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: '',
            html: '<p>Allowed file size exceeded. (Max. 5 MB)</p>',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
        });
    } else {
        generalBlogfilePreview(this);
    }
});

// hide and show video form
$('.add-video-btn').click(function(e) {
    e.preventDefault();
    $('.video-form').toggle();
});

// insert video link
$('.video-insert-btn').click(function(e) {
    e.preventDefault();
    
    var link = $(this).closest( "div.video-form" ).find('input[name="video_link"]').val();

    if(isUrlValid(link)) {
        $(this).closest( "div.video-form" ).find('.video-links-list table').append(`
        <tr>
            <td>`+link+` <input type="hidden" name="videos[]" value="`+link+`"></td>
            <td class="remove-btn"><i class="fas fa-times-circle remove-link"></td>
        </tr>`);

        $('input[name="video_link"]').val('');
    } else {
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: '',
            html: 'Invalid link.',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
        });
    }
});

// remove video link
$('.video-links-list table').on('click', '.remove-btn', function() {
    $(this).closest('tr').remove();
});

// show fullscreen trix editor
$('.main-form .trix-editor .fullscreen span').click(function() {

    $('#main-form input[name="name"]').blur();
    document.querySelector('.main-form trix-editor').blur();

    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.blog-content';
    if (document.querySelector('.text-editor-fullview.blog-content .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_blog_pk = new Piklor(".fullscreen-blog-color-picker", colors, {
        open: ".text-editor-fullview.blog-content .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_blog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.main-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.main-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
});

function showBlogFullscreen() {
    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.blog-content';
    if (document.querySelector('.text-editor-fullview.blog-content .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_blog_pk = new Piklor(".fullscreen-blog-color-picker", colors, {
        open: ".text-editor-fullview.blog-content .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_blog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.main-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.main-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
}

var isFullScreenEditor = false;
if(isSmallDevice() || isMobile()) {
    // regular blog & career blog
    $('#main-form input[name="name"]').on('focus', function() {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('#main-form input[name="name"]').blur();
        showBlogFullscreen();
    });

    document.querySelector('.main-form trix-editor').addEventListener("click", function(event) {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        document.querySelector('.main-form trix-editor').blur();
        showBlogFullscreen();
    });

    // general blog
    $('#general-blog-form input[name="name"]').on('focus', function() {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('#general-blog-form input[name="name"]').blur();
        showGeneralBlogFullscreen();
    });

    document.querySelector('.general-blog-form trix-editor').addEventListener("click", function(event) {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('.general-blog-form trix-editor').blur();
        showGeneralBlogFullscreen();
    });

    // designs blog
    $('#designs-blog-form input[name="name"]').on('focus', function() {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('#designs-blog-form input[name="name"]').blur();
        showDesignsBlogFullscreen();
    });

    document.querySelector('.designs-blog-form trix-editor').addEventListener("click", function(event) {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('.designs-blog-form trix-editor').blur();
        showDesignsBlogFullscreen();
    });

    // email
    document.querySelector('.email-form trix-editor').addEventListener("click", function(event) {
        if(!isWindowFullscreen()) {
            // alert();
            openFullscreen();
        }
        $('.email-form trix-editor').blur();
        showEmailFullscreen();
    });
}

function isWindowFullscreen() {
    if (document.fullscreenElement) {
        return true;
    } else {
        return false;
    }
}

// hide fullscreen trix editor
$('.exit-fullscreen').click(function() {
    testOrientation();
    window.addEventListener("orientationchange", testOrientation, false);
    window.addEventListener("resize", testOrientation, false);

    $('.main-form input[name="name"]').val($('.text-editor-fullview.blog-content input[name="fullscreen_name"]').val());
    $('.main-form .trix-editor trix-editor').html($('.text-editor-fullview.blog-content trix-editor').html());
    
    $('.text-editor-fullview.blog-content').css('display', 'none');
});

// show fullscreen email trix editor
$('.email-form .trix-editor .fullscreen span').click(function() {
    document.querySelector('.email-form trix-editor').blur();

    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.email-content';
    if (document.querySelector('.text-editor-fullview.email-content .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_email_pk = new Piklor(".fullscreen-email-color-picker", colors, {
        open: ".text-editor-fullview.email-content .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_email_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.email-form .trix-editor trix-editor').html());
    $(editor).css('display', 'flex').hide().fadeIn();
});

function showEmailFullscreen() {
    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.email-content';
    if (document.querySelector('.text-editor-fullview.email-content .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_email_pk = new Piklor(".fullscreen-email-color-picker", colors, {
        open: ".text-editor-fullview.email-content .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_email_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.email-form .trix-editor trix-editor').html());
    $(editor).css('display', 'flex').hide().fadeIn();
}

// hide fullscreen email trix editor
$('.exit-email-fullscreen').click(function() {
    testOrientation();
    window.addEventListener("orientationchange", testOrientation, false);
    window.addEventListener("resize", testOrientation, false);

    $('.email-form .trix-editor trix-editor').html($('.text-editor-fullview.email-content trix-editor').html());
    $('.text-editor-fullview.email-content').css('display', 'none');
});

// show fullscreen general blog trix editor
$('.general-blog-form .trix-editor .fullscreen span').click(function() {
    $('#general-blog-form input[name="name"]').blur();
    document.querySelector('.general-blog-form trix-editor').blur();

    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.general-blog-content';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_genblog_pk = new Piklor(".fullscreen-genblog-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_genblog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.general-blog-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.general-blog-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
});

function showGeneralBlogFullscreen() {
    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.general-blog-content';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_genblog_pk = new Piklor(".fullscreen-genblog-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_genblog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.general-blog-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.general-blog-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
}

// hide fullscreen email trix editor
$('.exit-general-blog-fullscreen').click(function() {
    testOrientation();
    window.addEventListener("orientationchange", testOrientation, false);
    window.addEventListener("resize", testOrientation, false);

    $('.general-blog-form input[name="name"]').val($('.text-editor-fullview.general-blog-content input[name="fullscreen_name"]').val());
    $('.general-blog-form .trix-editor trix-editor').html($('.text-editor-fullview.general-blog-content trix-editor').html());
    
    $('.text-editor-fullview.general-blog-content').css('display', 'none');
});

// show fullscreen designs blog trix editor
$('.designs-blog-form .trix-editor .fullscreen span').click(function() {
    $('#designs-blog-form input[name="name"]').blur();
    document.querySelector('.designs-blog-form trix-editor').blur();

    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.designs-blog-content';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_designsblog_pk = new Piklor(".fullscreen-designs-blog-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_designsblog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.designs-blog-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.designs-blog-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
});

function showDesignsBlogFullscreen() {
    window.removeEventListener("orientationchange", testOrientation, false);
    window.removeEventListener("resize", testOrientation, false);

    var editor = '.text-editor-fullview.designs-blog-content';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }

    var fullscreen_designsblog_pk = new Piklor(".fullscreen-designs-blog-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    fullscreen_designsblog_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $(editor+' trix-editor').html($('.designs-blog-form .trix-editor trix-editor').html());
    $(editor+' input[name="fullscreen_name"]').val($('.designs-blog-form input[name="name"]').val());
    $(editor).css('display', 'flex').hide().fadeIn();
}

// hide fullscreen designs blog trix editor
$('.exit-designs-blog-fullscreen').click(function() {
    testOrientation();
    window.addEventListener("orientationchange", testOrientation, false);
    window.addEventListener("resize", testOrientation, false);

    $('.designs-blog-form input[name="name"]').val($('.text-editor-fullview.designs-blog-content input[name="fullscreen_name"]').val());
    $('.designs-blog-form .trix-editor trix-editor').html($('.text-editor-fullview.designs-blog-content trix-editor').html());
    $('.text-editor-fullview.designs-blog-content').css('display', 'none');
});

// hide/show blog submenu
$('.blog-btn').click(function() {
    $('.submenu').not('.blog-submenu').hide();
    $('.blog-submenu').fadeToggle();
});

$('.groups-btn').click(function() {
    checkForm(url+'/my-groups');
});

$('.general-button').click(function() {
    $('.submenu').not('.general-submenu').hide();
    $('.general-submenu').fadeToggle();

    

});

$('.blogtags-button').click(function() {
    $('.submenu').not('.blogtags-submenu').hide();
    $('.blogtags-submenu').fadeToggle();
});

$('.careers-btn').click(function() {
    $('.submenu').not('.career-submenu').hide();
    $('.career-submenu').fadeToggle();
});

$('.yourstars-btn').click(function() {
    $('.submenu').not('.your-stars-submenu').hide();
    $('.your-stars-submenu').fadeToggle();
});

$('.connect-btn').click(function() {
    $('.submenu').not('.connects-submenu').hide();
    $('.connects-submenu').fadeToggle();
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

function setSectionParam(section)
{
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?section='+section;
    window.history.pushState({path:newurl},'',newurl);
}

// click blog submenu create blog
$('.create-blog').click(function(e) {
    e.preventDefault();
    $('.blog-submenu').fadeToggle();

    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('blog');
        showBlogSection();
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('blog');
                showBlogSection();
            }
        });
    }
});

$('.view-all-blogs').click(function(e) {
    e.preventDefault();

    checkForm(url+'/blogs');
});

$('.view-all-general-blogs').click(function(e) {
    e.preventDefault();

    checkForm(url+'/stories?type=stories');
});

$('.create-career-account').click(function(e) {
    e.preventDefault();
    $('.career-submenu').fadeToggle();

    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('career_account');
        showCareerAccountSection();
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('career_account');
                showCareerAccountSection();
            }
        });
    }
});

$('.create-career-blog').click(function(e) {
    e.preventDefault();
    $('.career-submenu').fadeToggle();

    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('career_blog');
        showCareerBlogSection();
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('career_blog');
                showCareerBlogSection();
            }
        });
    }
});

$('.list-friends').click(function(e) {
    e.preventDefault();

    checkForm(url+'/friends');
});

$('.friends-activities').click(function(e) {
    e.preventDefault();

    checkForm(url+'/earthlings_activities');
});

$('.send-friend-requests').click(function(e) {
    e.preventDefault();

    checkForm(url+'/listusers');
});

$('.accept-friend-requests').click(function(e) {
    e.preventDefault();

    checkForm(url+'/requests');
});

// hide/show remove featured image button
$(".featured-image-preview").hover(function(){
    if($(this).find('img').attr('src') != '') {
        $(this).find('.featured-image-remove').show();
    }
}, function(){
    if($(this).find('img').attr('src') != '') {
        $(this).find('.featured-image-remove').hide();
    }
});

// remove featured image
$('.featured-image-remove').click(function() {
    $(this).hide();
    removeFeaturedImage();
    $('.edit_image').prop('disabled', true);
});

$('.email-button').click( function() {
    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('email');
        showEmailSection();
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('email');
                showEmailSection();
            }
        });
    }
    
});

// send email
$('.email-send').click(function (e) {
    e.preventDefault();

    $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .email-buttons').css('pointer-events', 'none');

    // initialize form and other input fields
    var $form = $('form#email-form');
    var content = $("#email-form input[name='blog-trixFields[email_content]']").val();
    var form_url = $form.attr('action');
    var attachments = $('#email-form input[name="attachment-blog-trixFields[email_content]"]').val();

    // prepare post data
    var post_data = new FormData($form[0]);
    post_data.append('content', content);
    post_data.append('attachments', attachments);

    // update blog if blog_id is not null
    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data ,
        // dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
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
                background: 'rgba(8, 64, 147, 0.62)'
            }).then((res) => {
                $form[0].reset();
                $(".email-form trix-editor div").empty();
                $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .email-buttons').css('pointer-events', 'auto');
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
                background: 'rgba(8, 64, 147, 0.62)'
            });

            $('.menu-div, .email-div, .chat-div, .home-div, .menu-div-2, .music-knobs, .show-instruction a, .tos-div, .email-buttons').css('pointer-events', 'auto');
        }
    });
});

$('.create-general-blog').click( function(e) {
    e.preventDefault();
    $('.general-submenu').fadeToggle();

    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('general_blog');
        showGeneralBlogSection();
        //related to the image editor
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('general_blog');
                showGeneralBlogSection();
            }
        });
    }
    
});

$('.designs-button').click( function() {
    if(checkCurrentForm()) {
        hideCurrentSection();
        setSectionParam('designs_blog');
        showDesignsBlogSection();
    } else {
        Swal.fire({
            title: 'Discard Changes',
            text: 'You have unsaved changes',
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                hideCurrentSection();
                setSectionParam('designs_blog');
                showDesignsBlogSection();
            }
        });
    }
    
});


// // next slider initialization
// var $nextSlider = $('.slick-carousel-1').slick({
//     infinite: true,
//     vertical:true,  
//     // swipe: true,
//     verticalSwiping:true,
//     // swipeToSlide: true,
//     // draggable: true,
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     // variableWidth: true,
//     arrows: false,
//     // adaptiveHeight: true,
//     // centerMode: true
// });

// // volume slider initialization
// var $volumeSlider = $('.slick-carousel-2').slick({
//     infinite: true,
//     vertical:true,  
//     // swipe: true,
//     verticalSwiping:true,
//     // swipeToSlide: true,
//     // draggable: true,
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     // variableWidth: true,
//     arrows: false,
//     // adaptiveHeight: true,
//     // centerMode: true
// });

// // next color initialization
// var $nextColorSlider = $('.next-colors-slider').slick({
//     infinite: true,
//     vertical:true,  
//     // swipe: true,
//     // verticalSwiping:true,
//     // swipeToSlide: true,
//     // draggable: true,
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     // variableWidth: true,
//     arrows: false,
//     // adaptiveHeight: true,
//     // centerMode: true
// });

// // volume color initialization
// var $volumeColorSlider = $('.volume-colors-slider').slick({
//     infinite: true,
//     vertical:true,  
//     // swipe: true,
//     // verticalSwiping:true,
//     // swipeToSlide: true,
//     // draggable: true,
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     // variableWidth: true,
//     arrows: false,
//     // adaptiveHeight: true,
//     // centerMode: true
// });

// var enable_mousewheel = true;

// if(browser == 'webkit') {
//     enable_mousewheel = false;
//     $nextSlider.slick('slickSetOption', 'verticalSwiping', false);
//     $volumeSlider.slick('slickSetOption', 'verticalSwiping', false);

//     $('.slick-carousel-1').click(function() {
//         playMusic();
//         showMusicPlayer();
        
//         enable_mousewheel = true;
//         $nextSlider.slick('slickSetOption', 'verticalSwiping', true);
//         $volumeSlider.slick('slickSetOption', 'verticalSwiping', true);
//         // $('.slick-carousel-1').slick({
//         //     verticalSwiping: true
//         // });
//     });
// }

// // scroll next slider to go to next and previous songs
// $('.slick-carousel-1').bind('wheel', function(e){
//     if(enable_mousewheel) {
//         if(e.originalEvent.deltaY < 0) {
//             //scroll down
//             $nextSlider.slick('slickPrev')
//             $nextColorSlider.slick('slickPrev')
//             playNextSong();
//         }else {
//             //scroll up
//             $nextSlider.slick('slickNext')
//             $nextColorSlider.slick('slickNext')
//             // $audio_player.play()
//             playPrevSong();
//         }
    
//         //prevent page fom scrolling
//         return false;
//     }
// });

// // scroll volume slider to adjust volume
// $('.slick-carousel-2').bind('wheel', function(e){
//     if(enable_mousewheel) {
//         if(e.originalEvent.deltaY < 0) {
//             //scroll down
//             $volumeSlider.slick('slickPrev')
//             $volumeColorSlider.slick('slickPrev')
//             volumeDown();
//         }else {
//             //scroll up
//             $volumeSlider.slick('slickNext')
//             $volumeColorSlider.slick('slickNext')
//             volumeUp();
//         }
    
//         //prevent page fom scrolling
//         return false;
//     }
// });

// // swipe next slider to go to next and previous songs
// $('.slick-carousel-1').on('swipe', function(event, slick, direction){
//     if(direction == 'up') {
//         $nextColorSlider.slick('slickPrev');
//         playNextSong();
//         // audio.play();
//     } else if(direction == 'down') {
//         $nextColorSlider.slick('slickNext');
//         playPrevSong();
//     }
// });

// // swipe volume slider to adjust volume
// $('.slick-carousel-2').on('swipe', function(event, slick, direction){
//     console.log(direction);
//     if(direction == 'up') {
//         $volumeColorSlider.slick('slickPrev');
//         volumeDown();
//     } else if(direction == 'down') {
//         $volumeColorSlider.slick('slickNext')
//         volumeUp();
//     }
// });

// // Start setup music player
// var audio = document.querySelector("audio"); 
// audio.volume = 0.5;
// initAudio($('.playlist li:first-child'));

// // hide music player
// $('.close-btn').click(function() {
//     $('.music-player').hide();
//     $('.featured-image-div').show();
// });

// // play music
// $('.play-button').click(function() {
//     playMusic();
//     $(this).css('display', 'none');
//     $('.pause-button').css('display', 'block');
// });

// // pause music
// $('.pause-button').click(function() {
//     pauseMusic();
//     $(this).css('display', 'none');
//     $('.play-button').css('display', 'block');
// });

// var audio_volume;
// var src, context, analyser, gainNode;
// // mute/unmute music player
// $('.volume-progress .mute-music').toggle(
//     function() {
//         // audio_volume = audio.volume;
//         // audio.volume = 0;
//         gainNode.gain.value = -1;

//         $('.volume-progress i').removeClass('fa-volume-up');
//         $('.volume-progress i').addClass('fa-volume-mute');

//         if($('#bars').css('display') != 'none'){
//             $('#bars').addClass('hide-bars');
//         }
//         // console.log('volume:'+ audio.volume);
//         // alert('volume:'+ audio.volume);
//     },
//     function() {
//         // audio.volume = audio_volume;
//         gainNode.gain.value = 1;

//         $('.volume-progress i').removeClass('fa-volume-mute');
//         $('.volume-progress i').addClass('fa-volume-up');

//         if($('#bars').css('display') != 'none'){
//             $('#bars').removeClass('hide-bars');
//         }

//         // console.log('volume:'+ audio.volume);
//         // alert('volume:'+ audio.volume);
//     }
// );

// // initialize song
// function initAudio(element){
//     var song = element.data('src');
//     var title = element.data('songtitle');
//     var artist = element.data('artist');

//     $('#music_player').attr('src', song);
//     $('.music-player .music-title').text(title);
//     $('.music-player .music-singer').text(artist);

//     $('.playlist li').removeClass('active');
//     element.addClass('active');
// }

// // play next song after the song finished
// audio.onended = function() {
//     playNextSong();
// };

// // show music player
// function showMusicPlayer()
// {
//     $('.music-player').show();
//     $('.featured-image-div').hide();
//     playAudio();
// }

// // play music function
// function playMusic()
// {
//     audio.play();  
//     // $('#music_player').animate({volume: 1}, 1000);

//     if($('#bars').css('display') != 'none'){
//         $('#bars').removeClass('hide-bars');
//     }
// }

// // pause music function
// function pauseMusic()
// {
//     // audio_volume = gainNode.gain.value;
//     // $('#music_player').animate({volume: 0}, 1000, 'swing', function() {
//         // really stop the music 
//         audio.pause();   
//         // audio.volume = audio_volume;
        
//         // console.log($('#bars').css('display'));
//         if($('#bars').css('display') != 'none'){
//             $('#bars').addClass('hide-bars');
//         }
//     // });
// }

// // play next song
// function playNextSong()
// {
//     audio.pause();
//     $('.play-button').css('display', 'none');
//     $('.pause-button').css('display', 'block');
//     var next = $('.playlist li.active').next();
//     if (next.length == 0) {
//         next = $('.playlist li:first-child');
//     }
//     initAudio(next);
//     // $('#music_player').prop('volume', audio_volume);
//     audio.play();
//     showMusicPlayer();
// }

// // play previous song
// function playPrevSong()
// {
//     audio.pause();
//     $('.play-button').css('display', 'none');
//     $('.pause-button').css('display', 'block');
//     var prev = $('.playlist li.active').prev();
//     if (prev.length == 0) {
//         prev = $('.playlist li:first-child');
//     }
//     initAudio(prev);

//     // $('#music_player').prop('volume', audio_volume);
//     audio.play();
//     showMusicPlayer();
// }

// // higher volume
// function volumeUp()
// {
//     var volume = gainNode.gain.value+0.1;
//     var maxValue = 5;
//     $('.volume-progress i').removeClass('fa-volume-mute');
//     $('.volume-progress i').addClass('fa-volume-up');


//     if(volume > maxValue) {
//         volume = maxValue;
//     }

//     $('.volume-progress .progress-bar').css('height', ((volume/maxValue)*100)+'%');
//     gainNode.gain.value = volume;
// }

// // lower volume
// function volumeDown()
// {
//     var volume = gainNode.gain.value-0.1;
//     var minValue = -1;
//     var maxValue = 5;
    
//     if(volume < minValue) {
//         volume = minValue;
//     }

//     if(volume == -1) {
//         $('.volume-progress i').removeClass('fa-volume-up');
//         $('.volume-progress i').addClass('fa-volume-mute');
//     }

//     $('.volume-progress .progress-bar').css('height', ((volume/maxValue)*100)+'%');
//     gainNode.gain.value = volume;
// }

// // audio visualizer setup
// function playAudio() { 
//     // audio.load();
//     // audio.play();
//     var AudioContext = window.AudioContext          // Default
//       || window.webkitAudioContext;  // Safari and old versions of Chrome
      
//     if(!src && !context && !analyser) {
//         context = new AudioContext();
//         src = context.createMediaElementSource(audio);
//         analyser = context.createAnalyser();
//         analyser.smoothingTimeConstant = 0.85;
//         // Create a gain node.
//         gainNode = context.createGain();
//         // Connect the source to the gain node.
//         src.connect(gainNode);
//         // Connect the gain node to the destination.
//         gainNode.connect(analyser);
//     }

//     var canvas = document.getElementById("canvas");
//     canvas.width = $('.music-player').innerWidth();
//     canvas.height = 270;
//     // console.log($('.music-player').innerHeight());
//     var ctx = canvas.getContext("2d");

//     src.connect(analyser);
//     analyser.connect(context.destination);

//     analyser.fftSize = 256;

//     var bufferLength = analyser.frequencyBinCount;
//     console.log(bufferLength);

//     var dataArray = new Uint8Array(bufferLength);

//     var WIDTH = canvas.width;
//     var HEIGHT = canvas.height;

//     var barWidth = (WIDTH / bufferLength) * 5;
//     var barHeight;
//     var x = 0;

//     // ctx.clearRect(0, 0, WIDTH, HEIGHT);
//     audio.play(); 
    
//     if(browser == 'webkit') {
//         $('#bars').removeClass('hide-bars');
//         $('#bars').show();
//     } else {
//         renderFrame();
//     }
   

//     function renderFrame() {
//         requestAnimationFrame(renderFrame);

//         var x = 0;
//         var color = 0;
//         analyser.getByteFrequencyData(dataArray);
//         var gr = ctx.createLinearGradient(0, 100, 0, 100); 
//         gr.addColorStop(0, "rgba(77,92,129,1)"); 
//         gr.addColorStop(1, "rgba(123,139,179,1)"); 
//         // gr.addColorStop(2, "rgba(77,92,129,1)"); 
//         ctx.fillStyle = 'rgba(77,92,129,1)';
//         ctx.fillRect(0, 0, WIDTH, HEIGHT);

//         for (var i = 0; i < bufferLength; i++) {
//             barHeight = dataArray[i];

//             // if(barHeight == 0 && !audio.paused && !music_player_ismute) {
//             //     barHeight = bufferLength + (Math.floor(Math.random() * 100));
//             // }

//             var height = ctx.canvas.height;
//             var r = color + (0 * (i/bufferLength));
//             var g = 50 * (i/bufferLength);
//             var b = 131;
            
//             ctx.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
//             ctx.fillRect(x, HEIGHT - barHeight, barWidth, barHeight);
//             // console.log(barHeight);
//             color += barWidth;
//             x += barWidth + 1;
//         }
//     }
// }
// // End setup music player

// show instruction overlay
$('.show-instruction a').click(function () {
    $('.instructions').fadeIn();
});

// hide instruction overlay
$('.instruction-close-btn').click(function() {
    $('.instructions').fadeOut();
});

// show instruction text on hover of each box
$('.instruction').hover(
    function() {
        var text_div = $(this).data('text-div');
        $('.'+text_div).fadeIn();
    },
    function() {
        var text_div = $(this).data('text-div');
        $('.'+text_div).hide();
    }
);

// redirect buttons to under development page
$('.chat-button').click(function() {
    checkForm(url+'/page_under_development');
});

$('.home-button').click(function() {
    checkForm(url);
});

$('.tos-button').click(function() {
    checkForm(url+'/terms');
});

$('.back-button').click(function() {
    window.history.back();
});

// $('.view-company-profile').click(function() {
//     var redirect = $(this).data('url');
//     checkForm(redirect);
// });

// $('.view-jobseeker-profile').click(function() {
//     checkForm(url+'/my_career_profile');
// });

// $(document).delegate("[data-trix-color]","click",function(){

// 	var color_hex = $(this).css('background-color');

// 	Trix.config.textAttributes.dynamicColor = {
// 		style: { color: color_hex },
// 	  parser: function(element) {
// 			return element.style.color != null;
// 	  }
// 	}

// 	trixEditor.activateAttribute("dynamicColor");
// });

// limit trix editor attachment to image only and limit file size to 5MB
addEventListener("trix-file-accept", function(event) {
    var failed = false;
    var failed_content = '';

    // Prevent attaching .png files
    if (event.file.type != "image/png" && event.file.type != "image/jpeg") {
        event.preventDefault();
        failed = true;
        failed_content += '<p>File attachment only accepts images in jpeg and png.</p>';
    } else {
        // Prevent attaching files > 5242880 bytes
        if (event.file.size > 5242880 ) {
            event.preventDefault();
            failed = true;
            failed_content += '<p>Allowed file size exceeded. (Max. 5 MB)</p>';
        }
    }
  
    if(failed) {
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: '',
            html: failed_content,
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)'
        });
    }
});

// FUNCTIONS

// remove trix editor placeholder
function removeTrixPlaceholder()
{
    $('trix-editor div').remove( ":contains('Enter content here...')" );
}

// hide blog section and forms
function hideBlogSection()
{
    resetBlogForm();
    unsetButtonLabel();
    $('.main-form').hide();
    $('.featured-image-div.all-blog').hide();
    $('.communicator-buttons').hide();
    $('.communicator-buttons').css('pointer-events', 'none');
    $('.blog-tags img').css('pointer-events', 'none');
    $('.blog-btn').removeClass('active');
}

// show blog section and forms
function showBlogSection()
{
    $('.music-player-div').hide();
    $('.main-form').show();
    $('.featured-image-div.all-blog').show();
    $('.communicator-buttons').css('display', 'flex');
    $('.communicator-buttons').css('pointer-events', 'auto');
    $('.blog-tags img').css('pointer-events', 'auto');
}

// hide email section
function hideEmailSection()
{
    $('.email-button').removeClass('active');
    $('.email-buttons').hide();
    $('.email-form').hide();
    $('.email-send-button').hide();
}

// show email section
function showEmailSection()
{
    var editor = '.trix-editor.trix-editor-email';
    if (document.querySelector('.trix-editor.trix-editor-email .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }
    var email_pk = new Piklor(".email-color-picker", colors, {
        open: ".trix-editor.trix-editor-email .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    email_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $('.email-button').addClass('active');
    $('.email-buttons').css('display', 'flex');
    $('.email-buttons').css('pointer-events', 'auto');
    $('.email-form').show();
    $('.email-send-button').show();
}

// hide email section
function hideGeneralBlogSection()
{
    resetGeneralBlogForm();
    $('.general-button').removeClass('active');
    $('.general-blog-buttons').hide();
    $('.general-blog-form').hide()
    $('.featured-image-div.general-blog').hide();
}

// show email section
function showGeneralBlogSection()
{
    var editor = '.trix-editor.trix-editor-general-blog';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }
    var email_pk = new Piklor(".general-blogs-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    email_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $('.music-player-div').hide();
    $('.general-button').addClass('active');
    $('.general-blog-buttons').css('display', 'flex');
    $('.general-blog-buttons').css('pointer-events', 'auto');
    $('.general-blog-form').show();
    $('.featured-image-div.general-blog').show();
    // $('.email-send-button').show();
}

// hide email section
function hideDesignsBlogSection()
{
    resetDesignsBlogForm();
    $('.designs-button').removeClass('active');
    $('.designs-blog-buttons').hide();
    $('.designs-blog-form').hide()
    $('.featured-image-div.designs-blog').hide();
}

// show email section
function showDesignsBlogSection()
{
    var editor = '.trix-editor.trix-editor-designs-blog';
    if (document.querySelector(editor+' .trix-button--icon-text-color') == null) {
        trixTextColorButton(editor);
    }
    var email_pk = new Piklor(".designs-blogs-color-picker", colors, {
        open: editor+" .trix-button--icon-text-color",
        style: { display: 'flex'},
        // autoclose: false,
        closeOnBlur: true
    });

    email_pk.colorChosen(function (col) {
        setForegroundColor(col, editor);
    });

    if (document.querySelector(editor+' .font-select') == null) {
        $(editor+' #font-picker').fontselect({
            searchable: false,
        })
        .on('change', function() {
            applyFont(this.value, editor);
            $(editor+' .font-picker').hide();
        });
    }

    $('.music-player-div').hide();
    $('.designs-button').addClass('active');
    $('.designs-blog-buttons').css('display', 'flex');
    $('.designs-blog-buttons').css('pointer-events', 'auto');
    $('.designs-blog-form').show();
    $('.featured-image-div.designs-blog').show();
    // $('.email-send-button').show();
}

// show blog section and forms
function showCareerBlogSection()
{
    $('.music-player-div').hide();
    $('.main-form').addClass('career-blog-form');
    $('.text-editor-fullview.blog-content').addClass('career-blog-content');
    $('.main-form').show();
    $('.featured-image-div.all-blog').show();
    $('.communicator-buttons').css('display', 'flex');
    $('.communicator-buttons').css('pointer-events', 'auto');
    $('.blog-tags img').css('pointer-events', 'none');
    $('#main-form input[name="career_tag"]').val(1);
}

// show career account section
function showCareerAccountSection()
{
    $('.career-account-div').css('display', 'flex');
}

// hide career account section
function hideCareerAccountSection()
{
    $('.featured-image-div').hide();
    $('.career-account-div').hide();
}

$('#panel_list').on('change', function (e) {
    var optionSelected = $(this).find("option:selected");
    var flowers = optionSelected.data('flowers');
    var screenshot = optionSelected.data('screenshot');

    if(screenshot != '') {
        listFlowers(flowers);
        $('.designs-blog-form .flower-list button').prop('disabled', false);
        $('.designs-blog .edit_image').removeAttr('disabled');
        $('.designs-blog-form #designs_blog_featured_image').val(screenshot);
        $('.designs-blog .featured-image-text').css('opacity', '0');

        $('.music-player-div').hide();
        $('.featured-image-div.designs-blog #featured-image-previewimg').attr('src', url+'/storage/saveState/designPanel/screenshots/'+screenshot);
        $('.featured-image-div.designs-blog, .featured-image-div.designs-blog #featured-image-previewimg').show();
    } else {
        $('.flower-list-div').empty();
        $('.designs-blog-form .flower-list button').prop('disabled', true);
        $('.designs-blog .edit_image').attr('disabled', true);
        $('.designs-blog-form #designs_blog_featured_image').val('');
        $('.designs-blog .featured-image-text').css('opacity', '1');
        $('.featured-image-div.designs-blog #featured-image-previewimg').attr('src', '');
        $('.featured-image-div.designs-blog #featured-image-previewimg').hide();
        $('#panel_list').val('');

        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            title: 'Error!',
            html: 'It seems that you have not saved any screenshot for this panel yet. Please go to <a href="'+url+'/designPanel" style="color: #e6a40f;">design a panel</a> to take a screen shot.',
            // width: '30%',
            padding: '15px',
            background: 'rgba(8, 64, 147, 0.62)'
        });
    }
    
});

var flower_list = {
    '1' : {
        name: 'Protea',
        image: ''
    },
    '55' : {
        name: 'BlueEyedGrass',
        image: ''
    },
    '64' : {
        name: 'Laelia',
        image: ''
    },
    '121' : {
        name: 'SolanumIncanum',
        image: ''
    },
    '133' : {
        name: 'Rafflesia',
        image: ''
    },
    '177' : {
        name: 'Bougainvillea',
        image: ''
    },
};

function listFlowers(flowers)
{
    flowers = flowers.split(',');
    $('.flower-list-div').empty();
    $.each(flowers, function(index, value) {
        var flower_no = parseInt(value.replace(/[a-z]/ig, ""));

        $('.flower-list-div').append(`
            <div class="flower">
                <img src="`+url+`/front/images3D/flowers2D/`+value+`.png" alt="">
                <p class="flower-name">`+flower_list[flower_no].name+`</p>
            </div>
        `);
    });
}

$('.custom-privacy-done').click(function() {
    $('#customPrivacyModal').modal('hide');
});

// privacy settings filter
$('.search-groups').on('keyup', function() {
    var query = this.value;

    $('#custom-privacy-form input[type="checkbox"]').each(function(i, elem) {
        if (elem.id.indexOf(query.toLowerCase()) != -1) {
            $(this).closest('.form-check').show();
        } else{
            $(this).closest('.form-check').hide();
        }

        if($(".form-check:visible").length == 0) {
            $('#custom-privacy-form p').show();
        } else {
            $('#custom-privacy-form p').hide();
        }
    });
});

// get selected blog tag IDs
function getTagIDs() {
    var checked_tags = $('input[type="checkbox"][value="1"]');
    var tag_ids = [];
    
    $('input[type="checkbox"][value="1"]').each(function( ) {
        var $this = $(this);
        tag_ids.push($this.data('id'));
    });

    return tag_ids;
}

// show featured image preview
//vars for the image editor
var isNewImg = true;
var oldFeaturedImg;


function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // $('#uploadForm + img').remove();
            $('.all-blog .featured-image-text').css('opacity', '0');
            $('.all-blog #featured-image-previewimg').attr('src', e.target.result);
            $('.all-blog #featured-image-previewimg').show();
            
            //related to the image editor; check wheter a new image is uploaded
            if(oldFeaturedImg != e.target.result){
                oldFeaturedImg = e.target.result;
                isNewImg = true;
            }
        };
        reader.readAsDataURL(input.files[0]);
        $('.all-blog .edit_image').removeAttr('disabled');

    }
}

function generalBlogfilePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // $('#uploadForm + img').remove();
            $('.general-blog .featured-image-text').css('opacity', '0');
            $('.general-blog #featured-image-previewimg').attr('src', e.target.result);
            $('.general-blog #featured-image-previewimg').show();

            //related to the image editor; check wheter a new image is uploaded
            if(oldFeaturedImg != e.target.result){
                oldFeaturedImg = e.target.result;
                isNewImg = true;
            }
        };
        reader.readAsDataURL(input.files[0]);
        $('.general-blog .edit_image').removeAttr('disabled');
    }
}

// check if URL is valid
function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

var value_set = false;

// set blog form value - edit blog
function setBlogFormValue(blog)
{
    if(!value_set) {
        $('#main-form').find('input[name="blog_id"]').val(blog.id);
        $('#main-form').find('input[name="user_id"]').val(blog.created_by);
        $('#main-form').find('input[name="name"]').val(blog.name);
        $('#main-form').append('<input type="hidden" name="_method" value="PUT">');
        console.log(blog.content);
        // $('.main-form .trix-editor trix-editor').html(blog.content);
        // text_editor.editor.insertHTML("<div></div>");

        // $('.trix-editor trix-editor').html(blog.content);
        // Serialize
        // $('input#edit_content').val(blog.content);
        // var myDocument = JSON.stringify(text_editor.editor)

        // Load
        // element.editor.loadJSON(JSON.parse(myDocument))
        // console.log(JSON.stringify(blog.content));
        // var element = blog.content;
        // text_editor.editor.loadJSON(JSON.parse(myDocument));
        // console.log(text_editor.inputElement.value);
        // $('input#edit_content').val(blog.content);
        // $('.main-form .trix-editor trix-editor').html(text_editor.inputElement.value);
        // $(element).appendTo('.main-form .trix-editor trix-editor');

        $.each( blog.tags, function( key, value) {
            var checkbox = $('input[type="checkbox"][data-id="'+value.id+'"]');
            var tag = checkbox.attr('id');
            checkbox.val('1');
            $('img[data-tag="'+tag.replace("_tag","")+'"]').addClass('shadow');
        });

        $.each( blog.videos, function( key, value) {
            $('.video-links-list table').append(`
            <tr>
                <td>`+value.videourl+` <input type="hidden" name="videos[]" value="`+value.videourl+`"></td>
                <td class="remove-btn"><i class="fas fa-times-circle remove-link"></td>
            </tr>`);
            console.log(value.videourl);
        });

        $.each( blog.privacy, function( key, value) {
            var checkbox = $('#custom-privacy-form input[type="checkbox"][value="'+value.group_id+'"]').prop("checked", true);
            // checkbox.val('1');
        });

        if(blog.featured_image) {
            $('.featured-image-text').css('opacity', '0');
            $('#featured-image-previewimg').attr('src', url+'/storage/img/blog/'+blog.featured_image);
            $('.edit_image').prop('disabled', false);
        }

        value_set = true;
    }
}

//set general blog form value 
function setGeneralBlogFormValue(blog)
{
    if(!value_set) {
        $('#general-blog-form').find('input[name="blog_id"]').val(blog.id);
        $('#general-blog-form').find('input[name="user_id"]').val(blog.created_by);
        $('#general-blog-form').find('input[name="name"]').val(blog.name);
        // $('#general-blog-form').append('<input type="hidden" name="_method" value="PUT">');
        
        $.each( blog.videos, function( key, value) {
            $('#general-blog-form .video-links-list table').append(`
            <tr>
                <td>`+value.videourl+` <input type="hidden" name="videos[]" value="`+value.videourl+`"></td>
                <td class="remove-btn"><i class="fas fa-times-circle remove-link"></td>
            </tr>`);
            console.log(value.videourl);
        });

        $.each( blog.privacy, function( key, value) {
            var checkbox = $('#custom-privacy-form input[type="checkbox"][value="'+value.group_id+'"]').prop("checked", true);
            // checkbox.val('1');
        });

        if(blog.featured_image) {
            $('.general-blog .featured-image-text').css('opacity', '0');
            $('.general-blog #featured-image-previewimg').attr('src', url+'/storage/img/blog/'+blog.featured_image);
            $('.general-blog .edit_image').prop('disabled', false);
        }

        value_set = true;
    }
}

// set design blog form value
function setDesignBlogFormValue(blog)
{
    if(!value_set) {
        $('#designs-blog-form').find('input[name="blog_id"]').val(blog.id);
        $('#designs-blog-form').find('input[name="user_id"]').val(blog.created_by);
        $('#designs-blog-form').find('input[name="name"]').val(blog.name);
        $('#designs-blog-form').find('select[name="panel_id"]').val(blog.blog_panel_design.panel_id);
        var optionSelected = $('#designs-blog-form').find('select[name="panel_id"] option:selected');
        var flowers = optionSelected.data('flowers');
        listFlowers(flowers);
        $('.designs-blog-form .flower-list button').prop('disabled', false);
        // $('#custom-privacy-form').find('input[value=""]')

        $.each( blog.privacy, function( key, value) {
            var checkbox = $('#custom-privacy-form input[type="checkbox"][value="'+value.group_id+'"]').prop("checked", true);
            // checkbox.val('1');
        });

        if(blog.featured_image) {
            $('.designs-blog .featured-image-text').css('opacity', '0');
            $('.designs-blog #featured-image-previewimg').attr('src', url+'/storage/img/blog/'+blog.featured_image);
            $('.designs-blog .edit_image').prop('disabled', false);
        }

        value_set = true;
    }
}

// addEventListener('trix-focus', function(event) {
//     $('.main-form .trix-editor trix-editor').html(blog.content);
// });

// set button label - edit blog
function setButtonLabel(blog)
{
    if(blog.status == 'Published' || blog.status == 'Unpublished') {
        $('.save-text').attr('src', url+'/front/images/communicator-buttons/buttons/saveAsDraftBtn.png');
        $('.publish-text').attr('src', url+'/front/images/communicator-buttons/buttons/relaunchBtn.png');
        $('.publish-button').addClass('republish-blog');
        document.querySelector(".republish-blog").addEventListener("click", republishBlog);
        // $('input[name="save_status"]').val('Unpublished');
    }
}

function unsetButtonLabel()
{
    $('.save-text').attr('src', url+'/front/images/communicator-buttons/buttons/saveTxt.png');
    $('.publish-text').attr('src', url+'/front/images/communicator-buttons/buttons/launchTxt.png');
    $('input[name="save_status"]').val('Draft');
    
    if($('.publish-button').hasClass('republish-blog')) {
        document.querySelector(".republish-blog").removeEventListener('click',
            republishBlog,
            false
        );
    }

    $('.publish-button').removeClass('republish-blog');
}

function checkBlogForm()
{
    var title = $("form#main-form input[name='name']").val();
    var content = $(".main-form input[name='blog-trixFields[content]']").val();
    var featured_image = $("form#main-form input[name='featured_image']").val();
    var videos = $('input[name="videos[]"]').serialize();
    var tags = $('.main-form input[type="checkbox"]').serialize();
    // console.log(title, content, featured_image, videos);
    if(title || content || featured_image || videos || tags) {
        return false;
    } else {
        return true;
    }
}

function checkEmailForm()
{
    var subject = $('form#email-form select[name="subject"]').val();
    var content = $("form#email-form input[name='blog-trixFields[email_content]']").val();

    if(subject || content) {
        return false;
    } else {
        return true;
    }
}

function checkGeneralBlogForm()
{
    var title = $("form#general-blog-form input[name='name']").val();
    var content = $(".general-blog-form input[name='blog-trixFields[general_blog_content]']").val();
    var featured_image = $("form#general-blog-form input[name='featured_image']").val();
    var videos = $('.general-blog-form input[name="videos[]"]').serialize();

    // console.log(title, content, featured_image, videos);
    if(title || content || featured_image || videos) {
        return false;
    } else {
        return true;
    }
}

function checkDesignsBlogForm()
{
    var title = $("form#designs-blog-form input[name='name']").val();
    var content = $(".designs-blog-form input[name='blog-trixFields[designs_blog_content]']").val();
    var featured_image = $("form#designs-blog-form input[name='featured_image']").val();

    // console.log(title, content, featured_image, videos);
    if(title || content || featured_image) {
        return false;
    } else {
        return true;
    }
}

function checkForm(action = null)
{
    var section = $.urlParam('section');
    var alert_status;
    var message;

    if(section == 'blog') {
        if(!checkBlogForm()) {
            alert_status = true;
            message = 'You have unsaved changes';
        }
    } else if (section == 'general_blog') {
        if(!checkGeneralBlogForm()) {
            alert_status = true;
            message = 'You have unsaved changes';
        }
    } else if (section == 'designs_blog') {
        if(!checkDesignsBlogForm()) {
            alert_status = true;
            message = 'You have unsaved changes';
        }
    } else if (section == 'email') {
        if(!checkEmailForm()) {
            alert_status = true;
            message = 'You have unsent email';
        }
    } else {
        if(!checkBlogForm()) {
            alert_status = true;
            message = 'You have unsaved changes';
        }
    }
    
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            // width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
        if(action) {
            window.location.href = action;
        }
    }
}

function checkCurrentForm()
{
    var section = $.urlParam('section');
    var status = true;

    if(section == 'blog') {
        if(!checkBlogForm()) {
            status = false;
        }
    } else if (section == 'general_blog') {
        if(!checkGeneralBlogForm()) {
            status = false;
        }
    } else if (section == 'designs_blog') {
        if(!checkDesignsBlogForm()) {
            status = false;
        }
    } else if (section == 'email') {
        if(!checkEmailForm()) {
            status = false;
        }
    } else {
        if(!checkBlogForm()) {
            status = false;
        }
    }

    return status;
}

function removeFeaturedImage()
{
    $("input[name='featured_image']").attr('value', '');
    $('.featured-image-text').css('opacity', '1');
    $(".preview-image").hide();
    $('.preview-image').attr('src', '');
}

function resetBlogForm()
{
    $('form#main-form')[0].reset();
    $(".main-form .trix-editor trix-editor").empty();
    removeFeaturedImage();
    $('.tag-btn').removeClass('shadow');
    $('.main-form input[type="checkbox"]').val('0');
    $('.main-form .video-links-list table').empty();
    resetPrivacyForm();
}

function resetEmailForm()
{
    $('form#email-form')[0].reset();
    $("#email-form .trix-editor trix-editor").empty();
}

function resetGeneralBlogForm()
{
    $('form#general-blog-form')[0].reset();
    $(".general-blog-form .trix-editor trix-editor").empty();
    $('.general-blog-form .video-links-list table').empty();
    removeFeaturedImage();
    resetPrivacyForm();
}

function resetDesignsBlogForm()
{
    $('form#designs-blog-form')[0].reset();
    $(".designs-blog-form .trix-editor trix-editor").empty();
    removeFeaturedImage();
    resetPrivacyForm();
}

function resetPrivacyForm()
{
    $('form#custom-privacy-form')[0].reset();
}

function hideCurrentSection()
{
    var section = $.urlParam('section');

    if(section == 'blog' || section == 'career_blog') {
        $('.main-form').removeClass('career-blog-form');
        $('.text-editor-fullview.blog-content').removeClass('career-blog-content');
        hideBlogSection();
    } else if(section == 'general_blog') {
        hideGeneralBlogSection();
    } else if(section == 'designs_blog') {
        hideDesignsBlogSection();
    } else if(section == 'email') {
        hideEmailSection();
    } else if(section == 'career_account') {
        hideCareerAccountSection();
    } else {
        hideBlogSection();
    }
}

function isMobile() {
	try{ document.createEvent("TouchEvent"); return true; }
	catch(e){ return false; }
}

function isSmallDevice() {
	if(window.innerWidth <= 1024) {
		return true;
	} else {
		return false;
	}
}



/**************** related to the image editor ****************/
$('.edit_image').on('click',function(){
      $('#page-content').hide();
      $("#imageEditorModal").show();

      setTimeout(function(){
            $('.modal-backdrop').css('display','none !important');
            $('.modal-backdrop').hide();
      },200);
     
});   
