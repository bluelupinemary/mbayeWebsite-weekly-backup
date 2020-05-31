var url = $('meta[name="url"]').attr('content');

$( "#draggable" ).draggable();
$( ".dialog" ).draggable();

$(document).ready(function () {
  	$( "#draggable" ).draggable();
});

$(window).on('load', function() {
	$('#container, .logout-area').fadeIn(1000);
	$('.main-planet').css('opacity', '1');
	$('.astronaut-img-div').css('opacity', '1');
});
    
var timeout;
$('#container').mousemove(function(e){
	if(timeout) clearTimeout(timeout);
	else{
		setTimeout(callParallax.bind(null, e), 200);
	}
});
    
/* for animation of planets*/
function callParallax(e){
	parallaxIt(e, '.img_bg', -10);
	//  parallaxIt(e, '.astronaut-img', -10);
	parallaxIt(e, '.slide_1', -25);
	parallaxIt(e, '.slide_2', -15); 
	parallaxIt(e, '.slide_3', 20); 
	parallaxIt(e, '.slide_4', 20); 
	parallaxIt(e, '.slide_5', 40); 
	parallaxIt(e, '.slide_6', -17); 
	parallaxIt(e, '.slide_7', -25); 
	parallaxIt(e, '.slide_8', 15); 
	parallaxIt(e, '.slide_9', 20); 
	parallaxIt(e, '.slide_10', 20);
	parallaxIt(e, '.slide_11', 20);
	parallaxIt(e, '.slide12', 20);
	parallaxIt(e, '.slide_13', -18);
}

/* for animation of planets*/
function parallaxIt(e, target, movement){
	var $this = $('#container');
	var relX = e.pageX - $this.offset().left;
	var relY = e.pageY - $this.offset().top;

	TweenMax.to(target, 1, {
		x: (relX - $this.width()/2) / $this.width() * movement,
		y: (relY - $this.height()/2) / $this.height() * movement,
		ease: Power2.easeOut
	})
}
	
// Hide active planet when another planet is clicked
$('.main-planet').click(function() {
	$('.zoom-in-planet').css('display', 'none');
	$('.planet-back-button').css('display', 'none');
	$('.main-planet').css('display', 'block');
})

function hideZoomInPlanet() {
	$('.zoom-in-planet').css({
		'display': 'none',
		'pointer-events': 'none'
	});
	$('.zoom-in-planet img').css('pointer-events', 'none');
	$('.planet-back-button').css('display', 'none');
	$('.main-planet').css('display', 'block');
}

$('.planet-back-button').click(function() {
	hideZoomInPlanet();
});

// Zoom-in planet animation and blog preview
// Pluto
$(".img_pluto").removeClass("ani-rolloutPluto");

$('.pluto-img').click(function() {
	$('.pluto-img').hide();
	$(".img_pluto").addClass("ani-rolloutPluto");
	$(".img_pluto").css("display", "flex");
	
	$('.img_pluto').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_pluto").removeClass("ani-rolloutPluto");
		$(".img_pluto button").show();
		$('.img_pluto').append('<div class="preview pluto_preview"></div>');
		$('.img_pluto, .img_pluto img').css('pointer-events', 'auto');
	});
});

$(".img_pluto img").mouseenter(function() {
	$('.pluto_preview').show();
	$('.img_pluto img').css('opacity', '0');
}).mouseleave(function() {
	$('.pluto_preview').hide();
	$('.img_pluto img').css('opacity', '1');
});

$('.travel-back').click(function() {
	hideZoomInPlanet()
	$('.pluto_preview').remove();
});

$('.img_pluto').on('dblclick', function() {
	window.open(url+'/home/travel', '_blank'); 
	// alert('hello');
});

// Neptune
$(".img_neptune").removeClass("ani-rolloutNeptune");

$('.neptune-img').click(function() {
	$('.neptune-img').hide();
	$(".img_neptune").addClass("ani-rolloutNeptune");
	$(".img_neptune").css('display', 'flex');
	
	$('.img_neptune').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_neptune").removeClass("ani-rolloutNeptune");
		$(".img_neptune button").show();
		$('.img_neptune').append('<div class="preview neptune_preview"></div>');
		$('.img_neptune, .img_neptune img').css('pointer-events', 'auto');
	});
});

$(".img_neptune img").mouseenter(function() {
	$('.neptune_preview').show();
	$('.img_neptune img').css('opacity', '0');
}).mouseleave(function() {
	$('.neptune_preview').hide();
	$('.img_neptune img').css('opacity', '1');
});

$('.neptune-back').click(function() {
	hideZoomInPlanet();
	$('.neptune_preview').remove();
});

// Uranus
$(".img_uranus").removeClass("ani-rolloutUranus");

$('.uranus-img').click(function() {
	$('.uranus-img').hide();
	$(".img_uranus").addClass("ani-rolloutUranus");
	$(".img_uranus").css('display', 'flex');

	$('.img_uranus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_uranus").removeClass("ani-rolloutUranus");
		$(".img_uranus button").show();
		$('.img_uranus, .img_uranus img').css('pointer-events', 'auto');
	});
});

$(".img_uranus").mouseenter(function(event) {
	$('.uranus_preview').show();
	$('.img_uranus img.planet-img').css('opacity', '0');
	// console.log(event.type);
}).mouseleave(function(event) {
	function str(el) {
		if (!el) return "null"
		return el.className || el.tagName;
	}

	// console.log(str(event.relatedTarget));
	if(str(event.relatedTarget) == 'img_bg' || str(event.relatedTarget) == 'null') {
		$('.uranus_preview').hide();
		$('.img_uranus img.planet-img').css('opacity', '1');
		// console.log(event.type);
	}
});

$('.uranus_preview .map a, .saturn_preview .map a').tooltip({
	// show: null,
	// position: {
    //     my: "center bottom+20",
	// 	at: "center bottom",
	// },
	track: true
});

$('.uranus-back').click(function() {
	hideZoomInPlanet();
});

// Jupiter
$(".img_jupiter").removeClass("ani-rolloutJupiter");

$('.jupiter-img').click(function() {
	$('.jupiter-img').hide();
	$(".img_jupiter").addClass("ani-rolloutJupiter");
	$(".img_jupiter").css('display', 'flex');
	
	$('.img_jupiter').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_jupiter").removeClass("ani-rolloutJupiter");
		$(".img_jupiter button").show();
		$('.img_jupiter').append('<div class="preview jupiter_preview"></div>');
		$('.img_jupiter, .img_jupiter img').css('pointer-events', 'auto');
	});
});

$(".img_jupiter img").mouseenter(function() {
	$('.jupiter_preview').show();
	$('.img_jupiter img').css('opacity', '0');
}).mouseleave(function() {
	$('.jupiter_preview').hide();
	$('.img_jupiter img').css('opacity', '1');
});

$('.jupiter-back').click(function() {
	hideZoomInPlanet()
	$('.jupiter_preview').remove();
});

$('.img_jupiter').on('dblclick', function() {
	window.open(url+'/home/register', '_blank'); 
	// alert('hello');
});

// Moon
$(".img_moon").removeClass("ani-rolloutMoon");

$('.moon-img').click(function() {
	$('.moon-img').hide();
	$(".img_moon").addClass("ani-rolloutMoon");
	$(".img_moon").css('display', 'flex');

	$('.img_moon').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_moon").removeClass("ani-rolloutMoon");
		$(".img_moon button").show();
		$('.img_moon').append('<div class="preview moon_preview"></div>');
		$('.img_moon, .img_moon img').css('pointer-events', 'auto');
	});
});

$(".img_moon img").mouseenter(function() {
	$('.moon_preview').show();
	$('.img_moon img').css('opacity', '0');
}).mouseleave(function() {
	$('.moon_preview').hide();
	$('.img_moon img').css('opacity', '1');
});

$('.moon-back').click(function() {
	hideZoomInPlanet();
	$('.moon_preview').remove();
});

// Saturn
$(".img_saturn").removeClass("ani-rolloutSaturn");

$('.saturn-img').click(function() {
	$('.saturn-img').hide();
	$(".img_saturn").addClass("ani-rolloutSaturn");
	$(".img_saturn").css('display', 'flex');

	$('.img_saturn').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_saturn").removeClass("ani-rolloutSaturn");
		$(".img_saturn button").show();
		$('.img_saturn, .img_saturn img').css('pointer-events', 'auto');
	});
});

$(".img_saturn").mouseenter(function(event) {
	$('.saturn_preview').show();
	$('.img_saturn img.planet-img').css('opacity', '0');
	// console.log(event.type);
}).mouseleave(function(event) {
	function str(el) {
		if (!el) return "null"
		return el.className || el.tagName;
	}

	// console.log(str(event.relatedTarget));
	if(str(event.relatedTarget) == 'img_bg' || str(event.relatedTarget) == 'null') {
		$('.saturn_preview').hide();
		$('.img_saturn img.planet-img').css('opacity', '1');
		// console.log(event.type);
	}
});

function hidePreview()
{
	// console.log('hide');
	$('.preview').hide();
	$('.zoom-in-planet img').css('opacity', '1');
}

$('.saturn-back').click(function() {
	hideZoomInPlanet();
});
  
// Mars
$(".img_mars").removeClass("ani-rolloutMars");

$('.mars-img').click(function() {
	$('.mars-img').hide();
	$(".img_mars").addClass("ani-rolloutMars");
	$(".img_mars").css('display', 'flex');

	$('.img_mars').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_mars").removeClass("ani-rolloutMars");
		$(".img_mars button").show();
		$('.img_mars').append('<div class="preview mars_preview"></div>');
		$('.img_mars, .img_mars img').css('pointer-events', 'auto');
	});
});

$(".img_mars img").mouseenter(function() {
	$('.mars_preview').show();
	$('.img_mars img').css('opacity', '0');
}).mouseleave(function() {
	$('.mars_preview').hide();
	$('.img_mars img').css('opacity', '1');
});

$('.mars-back').click(function() {
	hideZoomInPlanet();
	$('.mars_preview').remove();
});

// Venus
$(".img_venus").removeClass("ani-rolloutVenus");

$('.venus-img').click(function() {
	$('.venus-img').hide();
	$(".img_venus").addClass("ani-rolloutVenus");
	$(".img_venus").css('display', 'flex');

	$('.img_venus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_venus").removeClass("ani-rolloutVenus");
		$(".img_venus button").show();
		$('.img_venus').append('<div class="preview venus_preview"></div>');
		$('.img_venus, .img_venus img').css('pointer-events', 'auto');
	});
});

$(".img_venus img").mouseenter(function() {
	$('.venus_preview').show();
	$('.img_venus img').css('opacity', '0');
}).mouseleave(function() {
	$('.venus_preview').hide();
	$('.img_venus img').css('opacity', '1');
});

$('.venus-back').click(function() {
	hideZoomInPlanet();
	$('.venus_preview').remove();
});

// Mercury
$(".img_mercury").removeClass("ani-rolloutMercury");

$('.mercury-img').click(function() {
	$('.mercury-img').hide();
	$(".img_mercury").addClass("ani-rolloutMercury");
	$(".img_mercury").css('display', 'flex');

	$('.img_mercury').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_mercury").removeClass("ani-rolloutMercury");
		$(".img_mercury button").show();
		$('.img_mercury').append('<div class="preview mercury_preview"></div>');
		$('.img_mercury, .img_mercury img').css('pointer-events', 'auto');
	});
});

$(".img_mercury img").mouseenter(function() {
	$('.mercury_preview').show();
	$('.img_mercury img').css('opacity', '0');
}).mouseleave(function() {
	$('.mercury_preview').hide();
	$('.img_mercury img').css('opacity', '1');
});

$('.mercury-back').click(function() {
	hideZoomInPlanet();
	$('.mercury_preview').remove();
});

// Sun
$(".img_sun").removeClass("ani-rolloutSun");

$('.sun-img').click(function() {
	$('.sun-img').hide();
	$(".img_sun").addClass("ani-rolloutSun");
	$(".img_sun").css('display', 'flex');

	$('.img_sun').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$(".img_sun").removeClass("ani-rolloutSun");
		$(".img_sun button").show();
		$('.img_sun').append('<div class="preview sun_preview"></div>');
		$('.img_sun, .img_sun img').css('pointer-events', 'auto');
	});
});

$(".img_sun img").mouseenter(function() {
	$('.sun_preview').show();
	$('.img_sun img').css('opacity', '0');
}).mouseleave(function() {
	$('.sun_preview').hide();
	$('.img_sun img').css('opacity', '1');
});

$('.sun-back').click(function() {
	hideZoomInPlanet();
	$('.sun_preview').remove();
});

// Show title on hover
$('.main-planet').mouseover(function() {
	$(this).find('.planet_name').addClass('animated zoomIn');
	$(this).find('.planet_name').css('opacity', '1');
}).mouseout(function() {
	$(this).find('.planet_name').removeClass('animated zoomIn');
	$(this).find(' .planet_name').css('opacity', '0');
});

// $('.back-to-homepage').mouseover(function() {
// 	$(this).find('.planet_name').addClass('animated zoomIn');
// 	$(this).find('.planet_name').css('opacity', '1');
// 	}).mouseout(function() {
// 	$(this).find('.planet_name').removeClass('animated zoomIn');
// 	$(this).find(' .planet_name').css('opacity', '0');
// 	});
	
$('.profilepicture').mouseover(function() {
	$('h2#edit-photo').addClass('animated zoomIn');
	$('h2#edit-photo').css('opacity', '1');
	}).mouseout(function() {
	$('h2#edit-photo').removeClass('animated zoomIn');
	$('h2#edit-photo').css('opacity', '0');
	});

$("div.main-planet").on("taphold", function() {
	$('.planet_name').css('opacity', '0');
	$(this).find('.planet_name').addClass('animated zoomIn');
	$(this).find('.planet_name').css('opacity', '1');
});

// $(".back-to-homepage").on("taphold", function() {
// 	$('.planet_name').css('opacity', '0');
// 	$(this).find('.planet_name').addClass('animated zoomIn');
// 	$(this).find('.planet_name').css('opacity', '1');
// });

$(".profilepicture").on("taphold", function() {
	$('.planet_name').css('opacity', '0');
	$('h2#edit-photo').addClass('animated zoomIn');
	$('h2#edit-photo').css('opacity', '1');
});
    
// Planet name circle style
new CircleType(document.getElementById('planet_name_pluto'))
.dir(-1)
.radius(40);

new CircleType(document.getElementById('planet_name_saturn'))
.dir(-1)
.radius(40);

new CircleType(document.getElementById('planet_name_neptune'))
.dir(-1)
.radius(45);

new CircleType(document.getElementById('planet_name_jupiter'))
.dir(-1)
.radius(40);

new CircleType(document.getElementById('planet_name_earth'))
.dir(-1)
.radius(80);

new CircleType(document.getElementById('planet_name_uranus'))
.dir(-1)
.radius(40);

new CircleType(document.getElementById('planet_name_moon'))
.dir(-1)
.radius(40);

new CircleType(document.getElementById('planet_name_mars'))
.dir(-1)
.radius(50);

new CircleType(document.getElementById('planet_name_venus'))
.dir(-1)
.radius(50);

new CircleType(document.getElementById('planet_name_mercury'))
.dir(-1)
.radius(45);

new CircleType(document.getElementById('planet_name_sun'))
.dir(-1)
.radius(50);

// new CircleType(document.getElementById('back-to-homepage'))
// .dir(-1)
// .radius(90);

new CircleType(document.getElementById('edit-photo'))
.dir(1)
.radius(60);

// Collage image on click, open modal with iframe
$('.map a').on('click', function (e) {
	e.preventDefault();
	var page = $(this).attr("href");
	var pagetitle = $(this).data("title");
	console.log([pagetitle]);
	
	$(".dialog .iframe").hide();
	$(".dialog .iframe-loading").show();

	$('.dialog-title').text(pagetitle);
	$('.dialog iframe').attr('src', page);

	$('.dialog').css('display', 'block');

	$(".dialog .iframe").on('load', function() {
		$(".dialog .iframe-loading").hide();
		$(".dialog .iframe").show();
	});
});

$('a.dialog-close-btn').click(function(e) {
	e.preventDefault();
	$('.dialog').hide();
});

$('a.dialog-fullscreen-btn').click(function(e) {
	e.preventDefault();
	$('.dialog').toggleClass('fullscreen'); 

	if ($('.dialog').hasClass('fullscreen')) {
		$('a.dialog-fullscreen-btn img.fullscreen').addClass('hide');
		$('a.dialog-fullscreen-btn img.minimize').removeClass('hide');
		$('a.dialog-fullscreen-btn').attr('title', 'Minimize');
	} else  {
		$('a.dialog-fullscreen-btn img.fullscreen').removeClass('hide');
		$('a.dialog-fullscreen-btn img.minimize').addClass('hide');
		$('a.dialog-fullscreen-btn').attr('title', 'Fullscreen');
	}
});

var navigator_zoom = 0;

$('button.navigator-zoomin').click( function() {
	if(!navigator_zoom) {
		// $(this).removeClass('navigator-zoomin');
		// $(this).addClass('navigator-zoomout');
		$(this).fadeOut();
		$('.navigator-div').addClass('animate-navigator-zoomin');

		$('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.navigator-div').removeClass('animate-navigator-zoomin');
			$('.navigator-div').addClass('zoomin');

			$( "#draggable" ).draggable({
				disabled: true
			});
			$('.navigator-buttons, .tos-div, .instructions-div, .navigator-zoomout-btn, .communicator-div').css('pointer-events', 'auto');
		});
	}

	navigator_zoom = !navigator_zoom;
});

$('.navigator-zoomout-btn').click(function() {
	$('button.navigator-zoomin').fadeIn();
	$('.navigator-div').removeClass('zoomin');
	$('.navigator-div').addClass('animate-navigator-zoomout');
	

	$('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
		$('.navigator-div').removeClass('animate-navigator-zoomout');
		$('.navigator-div').removeClass('zoomin');

		$( "#draggable" ).draggable({
			disabled: false
		});

		$('.navigator-buttons, .tos-div, .instructions-div, .navigator-zoomout-btn, .communicator-div').css('pointer-events', 'none');
	});

	navigator_zoom = !navigator_zoom;
});

// navigator buttons
$('.communicator-button').click( function() {
	window.location.href = url+'/communicator';
});

$('.home-btn').click( function() {
	window.location.href = url;
});

$('.profile-btn').click( function() {
	window.location.href = url+'/dashboard';
});

$('.instructions-btn, .tos-btn').click( function() {
	window.location.href = url+'/page_under_development';
});

$('.editphoto-btn').click( function() {
	window.location.href = url+'/profile/edit-photo';
});

var show_notifications = 0;

// $('.communicator-div').mouseenter(function() {
// 	$('.notifications-div').css("display", "flex").hide().fadeIn();
// }).mouseleave(function() {
// 	$('.notifications-div').fadeOut();
// 	$('.hologram').removeClass('full');
// 	$('.notifications-list').hide();

// 	show_notifications = 0;
// });

$('.earth-holo').click( function() {
	if(!show_notifications) {
		$('.hologram').addClass('full', function() {
			$('.notifications-count').addClass('float-right');
			$('.notifications-list').fadeIn(1000);
			$('.earth-holo span').html('Hide Notification');
		});
	} else {
		$('.hologram').removeClass('full');
		$('.notifications-count').removeClass('float-right');
		$('.notifications-list').fadeOut(1000);
		$('.earth-holo span').html('View Notification');
	}

	show_notifications = !show_notifications;
});