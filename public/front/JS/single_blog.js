var naff_fart_animation = true;

$(document).on('ready', function() {
    if(document.querySelector('.blog-summary .content') || document.querySelector('.trix-content div')) {
        if (typeof Trix == 'undefined') {
            $('head').prepend('<script src="'+url+'/trix/trix.js">');
            $('head').prepend('<link rel="stylesheet" type="text/css" href="'+url+'/trix/trix.css">');
        }

        scaleAstronaut();
        // init();
        // console.log(blog);
        $('.blog-summary .content').html(trimHtml(blog.summary, { limit: 200 }).html);
        $('.trix-content div').children().each( (index, element) => {
            // console.log(index);     // children's index
            // console.log(element);   // children's element

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

                    // return element.style.fontFamily;
                }
            }
        });
    }

    // $('.internal-share').tooltip({
    //     track: true
    // });
});

$(window).on('load', function() {
        $('.navigator-div').css("display", "flex").hide().fadeIn(1000);
        $('.single-blog, .reaction-div').fadeIn(1000, function() {
            if(naff_fart_status) {
                $('#page-content').on('click', function(){
                    if(naff_fart_animation) {
                        animateNaffFart();
                        naff_fart_animation = !naff_fart_animation;
                    }
                });
            } else {
                naff_fart_animation = false;
            }
        });
    
});

$('.internal-share').click(function() {
    $('.blog-share-preview .blog-description').html(trimHtml(blog.summary, { limit: 130 }).html);
});

function trimHtml(html, options) {
    // console.log(html);
    options = options || {};

    var limit = options.limit || 100,
        preserveTags = (typeof options.preserveTags !== 'undefined') ? options.preserveTags : true,
        wordBreak = (typeof options.wordBreak !== 'undefined') ? options.wordBreak : false,
        suffix = options.suffix || '...',
        moreLink = options.moreLink || '';

    var arr = html.replace(/</g, "\n<")
        .replace(/>/g, ">\n")
        .replace(/\n\n/g, "\n")
        .replace(/^\n/g, "")
        .replace(/\n$/g, "")
        .split("\n");

    var sum = 0,
        row, cut, add,
        tagMatch,
        tagName,
        tagStack = [],
        more = false;

    for (var i = 0; i < arr.length; i++) {

        row = arr[i];
        // count multiple spaces as one character
        rowCut = row.replace(/[ ]+/g, ' ');

        if (!row.length) {
            continue;
        }

        if (row[0] !== "<") {

            if (sum >= limit) {
                row = "";
            } else if ((sum + rowCut.length) >= limit) {

                cut = limit - sum;

                if (row[cut - 1] === ' ') {
                    while(cut){
                        cut -= 1;
                        if(row[cut - 1] !== ' '){
                            break;
                        }
                    }
                } else {

                    add = row.substring(cut).split('').indexOf(' ');

                    // break on halh of word
                    if(!wordBreak) {
                        if (add !== -1) {
                            cut += add;
                        } else {
                            cut = row.length;
                        }
                    }
                }

                row = row.substring(0, cut) + suffix;

                if (moreLink) {
                    row += '<a href="' + moreLink + '" style="display:inline">»</a>';
                }

                sum = limit;
                more = true;
            } else {
                sum += rowCut.length;
            }
        } else if (!preserveTags) {
            row = '';
        } else if (sum >= limit) {

            tagMatch = row.match(/[a-zA-Z]+/);
            tagName = tagMatch ? tagMatch[0] : '';

            if (tagName) {
                if (row.substring(0, 2) !== '</') {

                    tagStack.push(tagName);
                    row = '';
                } else {

                    while (tagStack[tagStack.length - 1] !== tagName && tagStack.length) {
                        tagStack.pop();
                    }

                    if (tagStack.length) {
                        row = '';
                    }

                    tagStack.pop();
                }
            } else {
                row = '';
            }
        }

        arr[i] = row;
    }

    return {
        html: arr.join("\n").replace(/\n/g, ""),
        more: more
    };
}

var fart_audio = document.getElementById("fart-audio"); 
function animateNaffFart()
{
    // var fart_url = url+'/front/sound-effects/fart.mp3';
    // fart_audio.play();
    // fart_audio.pause();
    // fart_audio.load(function() {
        fart_audio.currentTime = 0;
        fart_audio.play();

        $('.naff-fart-reaction').show();
        $('.naff-fart-reaction').addClass('animate-naff-fart-reaction');
    // });
    
    $('.naff-fart-reaction').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $('.naff-fart-reaction').removeClass('animate-naff-fart-reaction');
        $('.naff-fart-reaction').css('width', '70%');
        
        fart_audio.onended = function() {
            $('.naff-fart-reaction').fadeOut(500);
            $('.naff-fart-reaction').css('width', '0');
        };
    });
}

function animateNaffFartReaction()
{
    // var fart_url = url+'/front/sound-effects/fart.mp3';
    // fart_audio.play();
    // fart_audio.pause();
    // fart_audio.load(function() {
        fart_audio.currentTime = 0;
        fart_audio.play();

        $('.naff-fart-reaction').show();
        $('.naff-fart-reaction').addClass('animate-naff-fart-reaction');
    // });
    
    $('.naff-fart-reaction').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
        $('.naff-fart-reaction').removeClass('animate-naff-fart-reaction');
        $('.naff-fart-reaction').css('width', '70%');

        fart_audio.onended = function() {
            $('.naff-fart-reaction').fadeOut(500);
            $('.naff-fart-reaction').css('width', '0');
            
            $('.reaction-popup').fadeIn('slow', function() {
                $('.reaction-popup button').click();
                $('.reaction-popup').delay(1000).fadeOut('slow');
                $('.reaction-popup button').click();
            });
        };
    });
}

function getEmotion(emotion_id) {
    var array;
    

    if (emotion_id == '0') {
        array = {
            emotion: 'hot',
            img: hot_img
        };
    } else if (emotion_id == '1') {
        array = {
            emotion: 'cool',
            img: cool_img
        };
    } else if (emotion_id == '2') {
        array = {
            emotion: 'naff',
            img: naff_img
        };
    }

    return array;
}

// function emotion(blogid, emotion, event) {
//     // alert("change likable to "+emotion);
//     event.preventDefault();

//     $.ajax({
//         method: 'POST',
//         url: urlLike,
//         data: {
//             emotion: emotion,
//             blog_id: blogid,
//             _token: token
//         },
//         success: function (data) {
//             if (data.status == 'like') {
//                 var emotion = getEmotion(data.data.emotion);

//                 $('.reaction-button button').removeClass('selected-reaction');
//                 $('.reaction-button button.' + emotion.emotion).addClass('selected-reaction');
//                 $('.reaction-popup img').removeClass();
//                 $('.reaction-popup img').attr('src', emotion.img);

//                 if (emotion.emotion == 'cool') {
//                     $('.reaction-popup img').addClass('coolIcon');
//                 } else if (emotion.emotion == 'hot') {
//                     $('.reaction-popup img').addClass('hotIcon');
//                 }

//                 $('.reaction-popup').fadeIn('slow', function() {
//                     $('.reaction-popup button').click();
//                     $('.reaction-popup').delay(5000).fadeOut('slow');
//                     $('.reaction-popup button').click();
//                 });
                
//                 // $('.blog-buttons .button-div.naffIcon button').click();
                
//             } else if (data.status == 'unlike') {
//                 $('.reaction-button button').removeClass('selected-reaction');
//             }
//         }
//     });
// };

function goToComments() {
    blogFullview();

    setTimeout(function () {
        $("html").animate({
            scrollTop: $('#app').offset().top
        }, 800);
    }, 1000);
}

function blogFullview() {
    $('.blog-fullview').fadeOut( function() {
        $('.blog-buttons.blog-button-1').css('opacity', 0);
    
        $('.blog-summary .content').fadeOut(1000, 'linear', function() {
            $('.blog-buttons.blog-button-2').addClass('fullview');
        });
        $('.single-blog').addClass('fullview');
        $('.blog-body').addClass('show-blogcontent');
    });
}

function blogMinimize() {
    $('.blog-fullview').fadeIn();

    $('.blog-buttons.blog-button-1').css('opacity', 1);
    $('.blog-summary .content').show();

    $('.single-blog').removeClass('fullview');
    $('.blog-body').removeClass('show-blogcontent');
    $('.blog-buttons').removeClass('fullview');
}

$('[data-toggle="tooltip"]').tooltip();

$('.blog-fullview').click(function () {
    blogFullview();
});

$('.blog-minimize').click(function () {
    blogMinimize();
});

$(".owl-carousel").owlCarousel({
    items: 1,
    merge: true,
    // loop:true,
    margin: 10,
    video: true,
    // center:true,
    // lazyLoad: true,
    dots: true,
    dotsEach: true,
    responsive: {
        480: {
            items: 2,
            dots: true,
        },
        600: {
            items: 3,
            dots: true
        }
    }
});

var thatDiv, rightDiv, animation_interval, scale, window_width, scale_astronaut;

window.addEventListener("orientationchange", function(event) {
    // Generate a resize event if the device doesn't do it
    // window.dispatchEvent(new Event("resize"));
    
    // clearInterval(animation_interval);
    scaleAstronaut();
    // init();
}, false);

window.addEventListener("resize", function(event) {
    // Generate a resize event if the device doesn't do it
    // window.dispatchEvent(new Event("resize"));
    // clearInterval(animation_interval);
    scaleAstronaut();
    // init();
}, false);

function scaleAstronaut()
{
    window_width = $(window).width();

    // if(window_width <= 1024) {
    //     clearInterval(animation_interval);
    // }

    if(window_width <= 1024 && window_width >= 991) {
        clearInterval(animation_interval);
        scale = ' scale(1.5)';
        // $('.reaction-div').addClass('zoomin');
    } else if(window_width < 991) {
        clearInterval(animation_interval);
        scale = ' scale(2)';
        // $('.reaction-div').addClass('zoomin');
    } else {
        scale = ' scale(1)';
        // $('.reaction-div').removeClass('zoomin');
    }

    // document.getElementById('thatDiv').style.transform = scale;

}

function init() {
    thatDiv = document.getElementById('thatDiv');
    threeDJitter();
    animation_interval = setInterval(threeDJitter, 3000);
}

function threeDJitter() {
    let randomX = Math.random() * 5; //0-5
    let randomY = Math.random() * 5 + 20; //30-35
    let randomZ = Math.random() * 5;
    let randomTime = Math.random() * 2000 + 2000;
    // thatDiv.style.transform = 'rotateX('+randomX+'deg) rotateY('+randomY+'deg) rotateZ('+randomZ+'deg)';
    thatDiv.style.transform = 'translate(0, -50%) rotateY(' + randomY + 'deg)';

    randomX = Math.random() * 8; //0-5
    randomZ = Math.random() * 8;
    randomY = Math.random() * -5 - 40; //-45 to -40
    randomTime = Math.random() * 2000 + 2000;
    // rightDiv.style.transform = 'rotateX('+randomX+'deg) rotateY('+randomY+'deg) rotateZ('+randomZ+'deg)';
    let allText = document.getElementsByClassName('textGlow');
}

$('.reaction-div').mouseenter( function() {
    // alert('mouseenter')
    clearInterval(animation_interval);
}).mouseleave(function() {
    // alert('mouseleave')
    if($(window).width() > 1024) {
        // console.log(window_width);
        // init();
    }
});

var astronaut_zoom = 0;

$('.zoom-btn').click(function() {21
    if(!naff_fart_animation) {
        if(!astronaut_zoom) {
            // removeAstronautAnimation();
            // $('.reaction-div').css('transition', 'none');
            $('.zoom-in').hide();
            $('.zoom-out').show();
            $('.reaction-div').addClass('animate-zoomIn');

            $('.reaction-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.reaction-div').addClass('zoomin-astronaut');
                $('.reaction-div').removeClass('animate-zoomIn');
            });
        } else {
            $('.zoom-out').hide();
            $('.zoom-in').show();
            
            $('.reaction-div').addClass('animate-zoomOut');


            $('.reaction-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.reaction-div').removeClass('zoomin-astronaut');
                $('.reaction-div').removeClass('animate-zoomOut');
                // $('.reaction-div').addClass('zoomin-astronaut');
                // returnAstronautAnimation();
                // $('.reaction-div').css('transition', 'transform 3s ease 0s');
            });
        }
        
        astronaut_zoom = !astronaut_zoom;
    }
});

var navigator_zoom = 0;
var img_has_loaded = 0;
$('button.navigator-zoomin').click( function() {
    if(!naff_fart_animation) {
        if(!navigator_zoom) {
            if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                $('.navigator-div').hide();
                $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
                // if(!img_has_loaded) {
                //     $('.navigator-div-zoomed-in .lds-ellipsis').show();
                //     $('.navigator-div-zoomed-in .astronaut').on('load', function() {
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
    }
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

// $('.navigator-zoomout').click();

function removeAstronautAnimation()
{
    clearInterval(animation_interval);
    // $('.reaction-div').css('transition', 'none');
}

function returnAstronautAnimation()
{
    // init();
    // $('.reaction-div').css('transition', 'transform 3s ease 0s');
}

$('.img-button').hover(
    function () {
        $(this).parent().find('span').show();
    },
    function () {
        $(this).parent().find('span').hide();
    }
);

$('.astronaut-butt').click(function () {
    var sound_effect = document.getElementById("stop_it_se");
    sound_effect.play();

    sound_effect.onended = function () {
        sound_effect.pause();
        sound_effect.currentTime = 0;
    };
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

// open comments section
$('.reaction-button .comments img').click( function() {
    goToComments();
});

// taken from mo.js demos
function isIOSSafari() {
    var userAgent;
    userAgent = window.navigator.userAgent;
    return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
};

// taken from mo.js demos
function isTouch() {
    var isIETouch;
    isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
    return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
};

// taken from mo.js demos
var isIOS = isIOSSafari(),
    clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

function extend(a, b) {
    for (var key in b) {
        if (b.hasOwnProperty(key)) {
            a[key] = b[key];
        }
    }
    return a;
}

function Animocon(el, options) {
    this.el = el;
    this.options = extend({}, this.options);
    extend(this.options, options);

    this.checked = false;

    this.timeline = new mojs.Timeline();

    for (var i = 0, len = this.options.tweens.length; i < len; ++i) {
        this.timeline.add(this.options.tweens[i]);
    }

    var self = this;
    this.el.addEventListener('click', function () {
        if (self.checked) {
            self.options.onUnCheck();
        } else {
            self.options.onCheck();
            self.timeline.replay();
        }
        self.checked = !self.checked;
    });
}

Animocon.prototype.options = {
    tweens: [
        new mojs.Burst({})
    ],
    onCheck: function () {
        return false;
    },
    onUnCheck: function () {
        return false;
    }
};

if(document.querySelector('.reaction-popup button')) {
/* Icon 3 */
var el8 = document.querySelector('.reaction-popup button'),
    el8span = el8.querySelector('img');
var scaleCurve8 = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');
new Animocon(el8, {
    tweens: [
        // burst animation
        new mojs.Burst({
            parent: el8,
            count: 28,
            radius: {
                50: 110
            },
            children: {
                fill: '#988ADE',
                opacity: 0.6,
                radius: {
                    'rand(5,20)': 0
                },
                scale: 1,
                swirlSize: 15,
                duration: 1600,
                easing: mojs.easing.bezier(0.1, 1, 0.3, 1),
                isSwirl: true
            }
        }),
        // burst animation
        new mojs.Burst({
            parent: el8,
            count: 18,
            angle: {
                0: 10
            },
            radius: {
                140: 200
            },
            children: {
                fill: '#988ADE',
                shape: 'line',
                opacity: 0.6,
                radius: {
                    'rand(5,20)': 0
                },
                scale: 1,
                stroke: '#988ADE',
                strokeWidth: 2,
                duration: 1800,
                delay: 300,
                easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
            }
        }),
        // burst animation
        new mojs.Burst({
            parent: el8,
            radius: {
                40: 80
            },
            count: 18,
            children: {
                fill: '#988ADE',
                opacity: 0.6,
                radius: {
                    'rand(5,20)': 0
                },
                scale: 1,
                swirlSize: 15,
                duration: 2000,
                delay: 500,
                easing: mojs.easing.bezier(0.1, 1, 0.3, 1),
                isSwirl: true
            }
        }),
        // burst animation
        new mojs.Burst({
            parent: el8,
            count: 20,
            angle: {
                0: -10
            },
            radius: {
                90: 130
            },
            children: {
                fill: '#988ADE',
                opacity: 0.6,
                radius: {
                    'rand(10,20)': 0
                },
                scale: 1,
                duration: 3000,
                delay: 750,
                easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
            }
        }),
        // icon scale animation
        new mojs.Tween({
            duration: 400,
            easing: mojs.easing.back.out,
            onUpdate: function (progress) {
                var scaleProgress = scaleCurve8(progress);
                el8span.style.WebkitTransform = el8span.style.transform = 'scale3d(' +
                    progress + ',' + progress + ',1)';
            }
        })
    ],
    onCheck: function () {
        el8.style.color = '#988ADE';
    },
    onUnCheck: function () {
        el8.style.color = '#C0C1C3';
    }
});
/* Icon 3 */
}

$('#share-blog-btn').click(function(e) {
    e.preventDefault();

    // disable form and add loading to button
    $('#share-blog-form textarea').attr('readonly', true);
    $('#shareBlogModal button').prop('disabled', true);
    $(this).addClass('running');
    $('#share-blog-btn .text').html('Sharing Post');
    
    var form_url = share_url;
    var $form = $('form#share-blog-form');
    
    var post_data = new FormData($form[0]);
    // console.log(post_data);
    $.ajax({
        url: form_url,
        method: 'post',
        data: post_data,
        // dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            // console.log(data);
            $('#share-blog-form textarea').attr('readonly', false);
            $('#shareBlogModal button').prop('disabled', false);
            $('#share-blog-btn').removeClass('running');
            $('#share-blog-btn .text').html('Share Now');

            $('#shareBlogModal').modal('hide');
            $('.modal-backdrop').remove();
            
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
                window.open(url+'/shared_blog/'+data.blog_share.id, '_blank'); 
            });
        },
        error: function (request, status, error) {
            $('#shareBlogModal').modal('hide');
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
            }).then((res) => {
                $('#share-blog-form textarea').attr('readonly', false);
                $('#shareBlogModal button').prop('disabled', false);
                $('#share-blog-btn').removeClass('running');
                $('#share-blog-btn .text').html('Share Now');

                $('#shareBlogModal').modal('show');
            });
        }
    });
});