var url = $('meta[name="url"]').attr('content');

$( "#draggable" ).draggable();
$( ".dialog" ).draggable();

$(document).ready(function () {
	$( "#draggable" ).draggable();

	// var elem = document.documentElement;
	// function openFullscreen() {
	// 	if (elem.mozRequestFullScreen) { /* Firefox */
	// 	elem.mozRequestFullScreen();
	// 	contentDisplay();
	// 	} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
	// 		elem.webkitRequestFullscreen();
	// 		contentDisplay();
	// 	} else if (elem.msRequestFullscreen) { /* IE/Edge */
	// 		elem.msRequestFullscreen();
	// 		contentDisplay();
	// 	}
	// 	else if (elem.requestFullscreen) {
	// 		elem.requestFullscreen();
	// 		contentDisplay();
	// 	} 
	// }

	// function contentDisplay() {
	// 	// $(window).on('load', function() {
	// 		$('#container, .logout-area').fadeIn(1000);
	// 		$('.main-planet').css('opacity', '1');
	// 		$('.astronaut-img-div').css('opacity', '1');
	// 	// });
	// }

	// var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
	// console.log(orientation);
	// if(window.innerWidth < 991  && orientation.includes('landscape')){
	// 	Swal.fire({
	// 		imageUrl: '../../front/icons/alert-icon.png',
	// 		imageWidth: 80,
	// 		imageHeight: 80,
	// 		html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
	// 		padding: '15px',
	// 		background: 'rgba(8, 64, 147, 0.62)',
	// 		allowOutsideClick: false
	// 	}).then((result) => {
	// 		// if (result.value) {
	// 			openFullscreen()
	// 		// }
	// 	});
	// } else {
	// 	contentDisplay();
	// }
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
	// $('.zoom-in-planet').css('display', 'none');
	// $('.planet-back-button').css('display', 'none');
	// $('.main-planet').css('display', 'block');
	$('.zoom-in-planet').css({
		'display': 'none',
		'pointer-events': 'none'
	});
	$('.preview').hide();
	$('img.planet-img').css('opacity', '1');
	$(".planet-buttons").hide();
	$('.zoom-in-planet img').css('pointer-events', 'none');
	$('.planet-back-button').css('display', 'none');
	$('.main-planet').css('display', 'block');

	$('.pluto_preview, .neptune_preview, .jupiter_preview, .moon_preview, .venus_preview, .mars_preview, .mercury_preview, .sun_preview').remove();
})

function hideZoomInPlanet() {
	$('.zoom-in-planet').css({
		'display': 'none',
		'pointer-events': 'none'
	});
	$('.preview').hide();
	$('img.planet-img').css('opacity', '1');
	$(".planet-buttons").hide();
	$('.zoom-in-planet img').css('pointer-events', 'none');
	$('.planet-back-button').css('display', 'none');
	$('.main-planet').css('display', 'block');
	
	
	if(isZoomIn()) {
		if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
			$('.navigator-div-zoomed-in').show();
		} else {
			$('.navigator-div.zoomin').show();
		}
	} else {
		$('.astronaut-img-div').fadeIn();
	}
}

$('.planet-back-button').click(function() {
	hideZoomInPlanet();
});

// Zoom-in planet animation and blog preview
// Pluto
$(".img_pluto").removeClass("ani-rolloutPluto");

$('.pluto-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.pluto-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.pluto-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();
			
			$(".img_pluto").addClass("ani-rolloutPluto");
			$(".img_pluto").css("display", "flex");
			
			$('.img_pluto').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_pluto").removeClass("ani-rolloutPluto");
				$(".img_pluto button").show();
				$('.img_pluto').append('<div class="preview pluto_preview"></div>');
				$('.img_pluto, .img_pluto img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.pluto-img').hide();
		$(".img_pluto").addClass("ani-rolloutPluto");
		$(".img_pluto").css("display", "flex");
		
		$('.img_pluto').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_pluto").removeClass("ani-rolloutPluto");
			$(".img_pluto button").show();
			$('.img_pluto').append('<div class="preview pluto_preview"></div>');
			$('.img_pluto, .img_pluto img').css('pointer-events', 'auto');
		});
	}
});

$(".img_pluto").on('mouseenter', function(event) {
	$('.pluto_preview').show();
	$('.img_pluto img.planet').css('opacity', '0');
	$(".img_pluto .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_pluto .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.pluto_preview').hide();
	$('.img_pluto img.planet').css('opacity', '1');
	$(".img_pluto .planet-buttons").hide();
});

$('.img_pluto .planet-buttons button.back').click(function() {
	hideZoomInPlanet()
	$('.pluto_preview').remove();
});

$('.zoom-in-planet').on('dblclick', function() {
	window.open(url+'/page_under_development', '_blank'); 
	// alert('hello');
});

// Neptune
$(".img_neptune").removeClass("ani-rolloutNeptune");

$('.neptune-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.neptune-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.neptune-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_neptune").addClass("ani-rolloutNeptune");
			$(".img_neptune").css('display', 'flex');
			
			$('.img_neptune').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_neptune").removeClass("ani-rolloutNeptune");
				$(".img_neptune button").show();
				$('.img_neptune').append('<div class="preview neptune_preview"></div>');
				$('.img_neptune, .img_neptune img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.neptune-img').hide();
		$(".img_neptune").addClass("ani-rolloutNeptune");
		$(".img_neptune").css('display', 'flex');
		
		$('.img_neptune').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_neptune").removeClass("ani-rolloutNeptune");
			$(".img_neptune button").show();
			$('.img_neptune').append('<div class="preview neptune_preview"></div>');
			$('.img_neptune, .img_neptune img').css('pointer-events', 'auto');
		});
	}
});

$(".img_neptune").on('mouseenter', function(event) {
	$('.neptune_preview').show();
	$('.img_neptune img.planet').css('opacity', '0');
	$(".img_neptune .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_neptune .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.neptune_preview').hide();
	$('.img_neptune img.planet').css('opacity', '1');
	$(".img_neptune .planet-buttons").hide();
});

$('.img_neptune .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
	$('.neptune_preview').remove();
});

// Uranus
$(".img_uranus").removeClass("ani-rolloutUranus");

$('.uranus-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.uranus-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.uranus-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_uranus").addClass("ani-rolloutUranus");
			$(".img_uranus").css('display', 'flex');

			$('.img_uranus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_uranus").removeClass("ani-rolloutUranus");
				$(".img_uranus button").show();
				$('.img_uranus, .img_uranus img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}
		
		$('.uranus-img').hide();
		$(".img_uranus").addClass("ani-rolloutUranus");
		$(".img_uranus").css('display', 'flex');

		$('.img_uranus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_uranus").removeClass("ani-rolloutUranus");
			$(".img_uranus button").show();
			$('.img_uranus, .img_uranus img').css('pointer-events', 'auto');
		});
	}
});

$(".img_uranus").on('mouseenter', function(event) {
	if(isMobile() || isSmallDevice()) {
		$('.uranus_preview .map').hide();
		$('.uranus_preview').show();
		$('.img_uranus img.planet-img').css('opacity', '0');
		$(".img_uranus .planet-buttons").show();
		if(isMobile() || isSmallDevice()) {
			$(".img_uranus .planet-buttons .pop-up").show();
		}

		$('.uranus_preview .mover-1').on("webkitAnimationStart animationstart", function(){
			$('.uranus_preview .map').show();
		});
	} else {
		$('.uranus_preview').fadeIn();
		$('.img_uranus img.planet-img').css('opacity', '0');
		$(".img_uranus .planet-buttons").show();
		if(isSmallDevice()) {
			$(".img_uranus .planet-buttons .pop-up").show();
		}
	}
	// console.log(event.type);
}).on('mouseleave', function(event) {
	function str(el) {
		if (!el) return "null"
		return el.className || el.tagName;
	}

	// console.log(str(event.relatedTarget));
	if(str(event.relatedTarget) == 'img_bg' || str(event.relatedTarget) == 'null') {
		$('.uranus_preview').hide();
		$('.img_uranus img.planet-img').css('opacity', '1');
		$(".img_uranus .planet-buttons").hide();
		// console.log(event.type);
	}
});

if(!isMobile()) {
	$('.uranus_preview .map a, .saturn_preview .map a').tooltip({
		// show: null,
		// position: {
		//     my: "center bottom+20",
		// 	at: "center bottom",
		// },
		track: true
	});
}

$('.img_uranus .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
});

// Jupiter
$(".img_jupiter").removeClass("ani-rolloutJupiter");

$('.jupiter-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.jupiter-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.jupiter-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_jupiter").addClass("ani-rolloutJupiter");
			$(".img_jupiter").css('display', 'flex');
			
			$('.img_jupiter').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_jupiter").removeClass("ani-rolloutJupiter");
				$(".img_jupiter button").show();
				$('.img_jupiter').append('<div class="preview jupiter_preview"></div>');
				$('.img_jupiter, .img_jupiter img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.jupiter-img').hide();
		$(".img_jupiter").addClass("ani-rolloutJupiter");
		$(".img_jupiter").css('display', 'flex');
		
		$('.img_jupiter').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_jupiter").removeClass("ani-rolloutJupiter");
			$(".img_jupiter button").show();
			$('.img_jupiter').append('<div class="preview jupiter_preview"></div>');
			$('.img_jupiter, .img_jupiter img').css('pointer-events', 'auto');
		});
	}
});

$(".img_jupiter").on('mouseenter', function(event) {
	$('.jupiter_preview').show();
	$('.img_jupiter img.planet').css('opacity', '0');
	$(".img_jupiter .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_jupiter .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.jupiter_preview').hide();
	$('.img_jupiter img.planet').css('opacity', '1');
	$(".img_jupiter .planet-buttons").hide();
});

$('.img_jupiter .planet-buttons button.back').click(function() {
	hideZoomInPlanet()
	$('.jupiter_preview').remove();
});

// $('.img_jupiter').on('dblclick', function() {
// 	window.open(url+'/page_under_development', '_blank'); 
// 	// alert('hello');
// });

// Moon
$(".img_moon").removeClass("ani-rolloutMoon");

$('.moon-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.moon-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.moon-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_moon").addClass("ani-rolloutMoon");
			$(".img_moon").css('display', 'flex');

			$('.img_moon').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_moon").removeClass("ani-rolloutMoon");
				$(".img_moon button").show();
				$('.img_moon').append('<div class="preview moon_preview"></div>');
				$('.img_moon, .img_moon img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.moon-img').hide();
		$(".img_moon").addClass("ani-rolloutMoon");
		$(".img_moon").css('display', 'flex');

		$('.img_moon').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_moon").removeClass("ani-rolloutMoon");
			$(".img_moon button").show();
			$('.img_moon').append('<div class="preview moon_preview"></div>');
			$('.img_moon, .img_moon img').css('pointer-events', 'auto');
		});
	}
});

$(".img_moon").on('mouseenter', function(event) {
	$('.moon_preview').show();
	$('.img_moon img.planet').css('opacity', '0');
	$(".img_moon .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_moon .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.moon_preview').hide();
	$('.img_moon img.planet').css('opacity', '1');
	$(".img_moon .planet-buttons").hide();
});

$('.img_moon .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
	$('.moon_preview').remove();
});

// Saturn
$(".img_saturn").removeClass("ani-rolloutSaturn");

$('.saturn-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.saturn-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.saturn-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_saturn").addClass("ani-rolloutSaturn");
			$(".img_saturn").css('display', 'flex');

			$('.img_saturn').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_saturn").removeClass("ani-rolloutSaturn");
				$(".img_saturn button").show();
				$('.img_saturn, .img_saturn img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.saturn-img').hide();
		$(".img_saturn").addClass("ani-rolloutSaturn");
		$(".img_saturn").css('display', 'flex');

		$('.img_saturn').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_saturn").removeClass("ani-rolloutSaturn");
			$(".img_saturn button").show();
			$('.img_saturn, .img_saturn img').css('pointer-events', 'auto');
		});
	}
	
});

$(".img_saturn").on('mouseenter', function(event) {
	if(isMobile() || isSmallDevice()) {
		$('.saturn_preview .map').hide();
		$('.saturn_preview').show();
		$('.img_saturn img.planet-img').css('opacity', '0');
		$(".img_saturn .planet-buttons").show();
		if(isMobile() || isSmallDevice()) {
			$(".img_saturn .planet-buttons .pop-up").show();
		}

		$('.saturn_preview .mover-1').on("webkitAnimationStart animationstart", function(){
			$('.saturn_preview .map').show();
		});
	} else {
		$('.saturn_preview').show();
		$('.img_saturn img.planet-img').css('opacity', '0');
		$(".img_saturn .planet-buttons").show();
		if(isSmallDevice()) {
			$(".img_saturn .planet-buttons .pop-up").show();
		}
	}
	
	// console.log(event.type);
}).on('mouseleave', function(event) {
	function str(el) {
		if (!el) return "null"
		return el.className || el.tagName;
	}

	// console.log(str(event.relatedTarget));
	if(str(event.relatedTarget) == 'img_bg' || str(event.relatedTarget) == 'null') {
		$('.saturn_preview').hide();
		$('.img_saturn img.planet-img').css('opacity', '1');
		$(".img_saturn .planet-buttons").hide();
		// console.log(event.type);
	}
});

function hidePreview()
{
	// console.log('hide');
	$('.preview').hide();
	$('.zoom-in-planet img').css('opacity', '1');
	$(".planet-buttons").hide();
}

$('.img_saturn .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
});
  
// Mars
$(".img_mars").removeClass("ani-rolloutMars");

$('.mars-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.mars-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){4
			$('.mars-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_mars").addClass("ani-rolloutMars");
			$(".img_mars").css('display', 'flex');

			$('.img_mars').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_mars").removeClass("ani-rolloutMars");
				$(".img_mars button").show();
				$('.img_mars').append('<div class="preview mars_preview"></div>');
				$('.img_mars, .img_mars img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.mars-img').hide();
		$(".img_mars").addClass("ani-rolloutMars");
		$(".img_mars").css('display', 'flex');

		$('.img_mars').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_mars").removeClass("ani-rolloutMars");
			$(".img_mars button").show();
			$('.img_mars').append('<div class="preview mars_preview"></div>');
			$('.img_mars, .img_mars img').css('pointer-events', 'auto');
		});
	}
});

$(".img_mars").on('mouseenter', function(event) {
	$('.mars_preview').show();
	$('.img_mars img.planet').css('opacity', '0');
	$(".img_mars .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_mars .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.mars_preview').hide();
	$('.img_mars img.planet').css('opacity', '1');
	$(".img_mars .planet-buttons").hide();
});

$('.img_mars .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
	$('.mars_preview').remove();
});

// Venus
$(".img_venus").removeClass("ani-rolloutVenus");

$('.venus-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.venus-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.venus-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_venus").addClass("ani-rolloutVenus");
			$(".img_venus").css('display', 'flex');

			$('.img_venus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_venus").removeClass("ani-rolloutVenus");
				$(".img_venus button").show();
				$('.img_venus').append('<div class="preview venus_preview"></div>');
				$('.img_venus, .img_venus img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.venus-img').hide();
		$(".img_venus").addClass("ani-rolloutVenus");
		$(".img_venus").css('display', 'flex');

		$('.img_venus').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_venus").removeClass("ani-rolloutVenus");
			$(".img_venus button").show();
			$('.img_venus').append('<div class="preview venus_preview"></div>');
			$('.img_venus, .img_venus img').css('pointer-events', 'auto');
		});
	}
});

$(".img_venus").on('mouseenter', function(event) {
	$('.venus_preview').show();
	$('.img_venus img.planet').css('opacity', '0');
	$(".img_venus .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_venus .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.venus_preview').hide();
	$('.img_venus img.planet').css('opacity', '1');
	$(".img_venus .planet-buttons").hide();
});

$('.img_venus .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
	$('.venus_preview').remove();
});

// Mercury
$(".img_mercury").removeClass("ani-rolloutMercury");

$('.mercury-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.mercury-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.mercury-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_mercury").addClass("ani-rolloutMercury");
			$(".img_mercury").css('display', 'flex');

			$('.img_mercury').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_mercury").removeClass("ani-rolloutMercury");
				$(".img_mercury button").show();
				$('.img_mercury').append('<div class="preview mercury_preview"></div>');
				$('.img_mercury, .img_mercury img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();
			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.mercury-img').hide();
		$(".img_mercury").addClass("ani-rolloutMercury");
		$(".img_mercury").css('display', 'flex');

		$('.img_mercury').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_mercury").removeClass("ani-rolloutMercury");
			$(".img_mercury button").show();
			$('.img_mercury').append('<div class="preview mercury_preview"></div>');
			$('.img_mercury, .img_mercury img').css('pointer-events', 'auto');
		});
	}
});

$(".img_mercury").on('mouseenter', function(event) {
	$('.mercury_preview').show();
	$('.img_mercury img.planet').css('opacity', '0');
	$(".img_mercury .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_mercury .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.mercury_preview').hide();
	$('.img_mercury img.planet').css('opacity', '1');
	$(".img_mercury .planet-buttons").hide();
});

$('.img_mercury .planet-buttons button.back').click(function() {
	hideZoomInPlanet();
	$('.mercury_preview').remove();
});

// Sun
$(".img_sun").removeClass("ani-rolloutSun");

$('.sun-img').on('click', function() {
	// hide profile details
	if($('.profile-details').hasClass('show')) {
		$('.profile-details').removeClass('fadeInUpBig');
		$('.profile-details').addClass('fadeOutDown');
	}

	if(isMobile()) {
		$(this).find('.planet_name').addClass('animated zoomIn');
		$(this).find('.planet_name').css('opacity', '1');

		// hide notifications list
		show_notifications = 0;
		$('.hologram').removeClass('full');
		$('.notifications-list-div').fadeOut();
		$('.earth-holo span').html('View Notification');

		$('.sun-img .planet_name').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.sun-img').hide();
			$('.astronaut-img-div').hide();
			$('.navigator-div-zoomed-in').hide();

			$(".img_sun").addClass("ani-rolloutSun");
			$(".img_sun").css('display', 'flex');

			$('.img_sun').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$(".img_sun").removeClass("ani-rolloutSun");
				$(".img_sun button").show();
				$('.img_sun').append('<div class="preview sun_preview"></div>');
				$('.img_sun, .img_sun img').css('pointer-events', 'auto');
			});
		});
	} else {
		if(isSmallDevice()) {
			$('.astronaut-img-div').hide();

			// hide notifications list
			show_notifications = 0;
			$('.hologram').removeClass('full');
			$('.notifications-list-div').fadeOut();
			$('.earth-holo span').html('View Notification');
		}

		if(isZoomIn()) {
			$('.navigator-div.zoomin').hide();
			$('.navigator-div-zoomed-in').hide();
		}

		$('.sun-img').hide();
		$(".img_sun").addClass("ani-rolloutSun");
		$(".img_sun").css('display', 'flex');

		$('.img_sun').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$(".img_sun").removeClass("ani-rolloutSun");
			$(".img_sun button").show();
			$('.img_sun').append('<div class="preview sun_preview"></div>');
			$('.img_sun, .img_sun img').css('pointer-events', 'auto');
		});
	}
});

$(".img_sun").on('mouseenter', function(event) {
	$('.sun_preview').show();
	$('.img_sun img.planet').css('opacity', '0');
	$(".img_sun .planet-buttons").show();
	if(isMobile() || isSmallDevice()) {
		$(".img_sun .planet-buttons .pop-up").show();
	}
}).on('mouseleave', function(event) {
	$('.sun_preview').hide();
	$('.img_sun img.planet').css('opacity', '1');
	$(".img_sun .planet-buttons").hide();
});

$('.img_sun .planet-buttons button.back').click(function() {
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
// $('.profile-picture-overlay').mouseover(function() {
// 	$('h2.edit-photo').addClass('animated zoomIn');
// 	$('h2.edit-photo').css('opacity', '1');
// }).mouseout(function() {
// 	$('h2.edit-photo').removeClass('animated zoomIn');
// 	$('h2.edit-photo').css('opacity', '0');
// });

var zoomedin_edit_photo = '';
$('.profile-picture-overlay').mouseover(function() {
	if(zoomedin_edit_photo == '') {
		zoomedin_edit_photo = new CircleType(document.getElementById('zoomedin-edit-photo'))
			.dir(1)
			.radius(150);
	}
	
	$('h2.edit-photo').addClass('animated zoomIn');
	$('h2.edit-photo').css('opacity', '1');
}).mouseout(function() {
	$('h2.edit-photo').removeClass('animated zoomIn');
	$('h2.edit-photo').css('opacity', '0');
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

$(".profile-picture-overlay").on("taphold", function() {
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
// if(window.innerWidth >= 2560) {
// 	new CircleType(document.getElementById('zoomedin-edit-photo'))
// 	.dir(1)
// 	.radius(100);
// } else if(window.innerWidth >= 1680) {
// 	new CircleType(document.getElementById('zoomedin-edit-photo'))
// 	.dir(1)
// 	.radius(80);
// } else {
// 	new CircleType(document.getElementById('zoomedin-edit-photo'))
// 	.dir(1)
// 	.radius(60);
// }

if(window.innerWidth >= 1920) {
	new CircleType(document.getElementById('edit-photo'))
	.dir(1)
	.radius(100);
} else {
	new CircleType(document.getElementById('edit-photo'))
	.dir(1)
	.radius(70);
}

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
		if($('.profile-details').hasClass('show')) {
			$('.profile-details').removeClass('fadeInUpBig');
			$('.profile-details').addClass('fadeOutDown');
		}
		
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
	}

	navigator_zoom = !navigator_zoom;
});

$('.navigator-zoomout-btn').click(function() {

	if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
		$('.navigator-div').fadeIn();
        $('.navigator-div-zoomed-in').hide();
	} else {
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
	}

	navigator_zoom = !navigator_zoom;
});

$('.zoomout-btn').click(function() {

	if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
		$('.navigator-div').fadeIn();
        $('.navigator-div-zoomed-in').hide();
	} else {
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
	}

	navigator_zoom = !navigator_zoom;
});

function isZoomIn()
{
	if(navigator_zoom) {
		return true;
	} else {
		return false;
	}
}

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

var edit_photo = '';

$('.navigator-div .profile-picture-overlay').click(function() {
	if(isMobile()) {
		$('.navigator-div h2.edit-photo').addClass('animated zoomIn');
		$('.navigator-div h2.edit-photo').css('opacity', '1');

		$('.navigator-div h2.edit-photo').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			window.location.href = url+'/profile/edit-photo';
		});
	} else {
		window.location.href = url+'/profile/edit-photo';
	}
});

$('.navigator-div-zoomed-in .profile-picture-overlay').click(function() {
	if(isMobile()) {
		if(zoomedin_edit_photo == '') {
			zoomedin_edit_photo = new CircleType(document.getElementById('zoomedin-edit-photo'))
				.dir(1)
				.radius(150);
		}

		$('.navigator-div-zoomed-in h2.edit-photo').addClass('animated zoomIn');
		$('.navigator-div-zoomed-in h2.edit-photo').css('opacity', '1');

		$('.navigator-div-zoomed-in h2.edit-photo').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			window.location.href = url+'/profile/edit-photo';
		});
	} else {
		window.location.href = url+'/profile/edit-photo';
	}
});

var show_notifications = 0;

// $('.communicator-div').mouseenter(function() {
// 	$('.notifications-div').css("display", "flex").hide().fadeIn();
// }).mouseleave(function() {
// 	$('.notifications-div').fadeOut();
// 	$('.hologram').removeClass('full');
// 	$('.notifications-list-div').hide();

// 	show_notifications = 0;
// });

$('.earth-holo').click( function() {
	if(!show_notifications) {
		$('.hologram').addClass('full', function() {
			$('.notifications-count').addClass('animated pulse');
			$('.notifications-count').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
				$('.notifications-count').removeClass('animated pulse');
			});
			$('.notifications-list-div').fadeIn().css('display', 'flex');
			$('.earth-holo span').html('Hide Notification');
		});
	} else {
		$('.hologram').removeClass('full');
		$('.notifications-count').addClass('animated pulse');
		$('.notifications-count').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
			$('.notifications-count').removeClass('animated pulse');
		});
		$('.notifications-list-div').fadeOut(1000);
		$('.earth-holo span').html('View Notification');
	}

	show_notifications = !show_notifications;
});

if(!isMobile() && !isSmallDevice()) {
	$('.planet-buttons .view').mouseenter(function() {
		$('.planet-buttons span.view-pop-up').show();
	}).mouseleave(function() {
		$('.planet-buttons span.view-pop-up').hide();
	});

	$('.planet-buttons .back').mouseenter(function() {
		$('.planet-buttons span.back-pop-up').show();
	}).mouseleave(function() {
		$('.planet-buttons span.back-pop-up').hide();
	});

	$('.planet-buttons .collage').mouseenter(function() {
		$('.planet-buttons span.collage-pop-up').show();
	}).mouseleave(function() {
		$('.planet-buttons span.collage-pop-up').hide();
	});

	$('.planet-buttons .view-friend').mouseenter(function() {
		$('.planet-buttons span.view-friend-pop-up').show();
	}).mouseleave(function() {
		$('.planet-buttons span.view-friend-pop-up').hide();
	});
}

// $('.planet-buttons .view').on('click',function() {
// 	view_blog("general",1);
// });

$('button.collage').click(function() {
	var tag = $(this).data('tag');
	window.location.href = url+'/editor_collage?tag='+tag;
});

$('.profile-button').on('click', function() {
	// $('.profile-details').show();
	$('.profile-details').removeClass('fadeOutDown');
	$('.profile-details').addClass('animated fadeInUpBig show');
	// $('.profile-details').css('opacity', '1');

	
});

$('.profile-details.animated.fadeOutDown').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
	$('.profile-details').removeClass('show');
	// $('.profile-details').css('opacity', '0');
	// $('.profile-details').hide();
});

$('.profile-details .close-btn').on('click', function() {
	$('.profile-details').removeClass('fadeInUpBig');
	$('.profile-details').addClass('fadeOutDown');
	
});

$('.profile-details .edit-btn').on('click', function() {
	window.location.href = url+'/profile/edit-profile';
});

$('.profile-details .recruit-btn').on('click', function() {
	var user_id = $(this).data('user-id');
	var button = $(this);
	button.prop('disabled', true);
	button.addClass('running');
	$('.profile-details .text').html('Processing...');

	var form_url = url+'/sendrequest/'+user_id;

	$.ajax({
		url: form_url,
		method: 'get',
		// dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success: function(response) {
			console.log(response);
			
			$('.profile-details').hide();
			$('.navigator-div').hide();

			if(response.status) {
				Swal.fire({
					title: '<span class="success">Success!</span>',
					text: response.message,
					imageUrl: '../../front/icons/alert-icon.png',
					imageWidth: 80,
					imageHeight: 80,
					imageAlt: 'Mbaye Logo',
					// width: '30%',
					padding: '1rem',
					background: 'rgba(8, 64, 147, 0.62)'
				}).then((res) => {
					$('.profile-details').show();
					$('.navigator-div').show();
					button.prop('disabled', false);
					button.removeClass('running');
					$('.profile-details .text').html('Cancel Request');
				});
			} else {
				$('.profile-details').show();
				$('.navigator-div').show();
				button.prop('disabled', false);
				button.removeClass('running');
				$('.profile-details .text').html('Recruit');
			}
		},
		error: function (request, status, error) {
			$('.profile-details').hide();
			$('.navigator-div').hide();
			Swal.fire({
				imageUrl: '../../front/icons/alert-icon.png',
				imageWidth: 80,
				imageHeight: 80,
				imageAlt: 'Mbaye Logo',
				title: 'Error!',
				html: 'Something went wrong.',
				// width: '30%',
				padding: '1rem',
				background: 'rgba(8, 64, 147, 0.62)'
			}).then((res) => {
				$('.profile-details').show();
				$('.navigator-div').show();
				button.prop('disabled', false);
				button.removeClass('running');
				$('.profile-details .text').html('Recruit');
			});
		}
	});
});

/**
 * Function to redirect to general blogs
 * @param {tag} tag 
 * @param {id} id 
 */
function view_blog(tag){
	window.location.href=url_view_tag_wise_blog+'?tag='+tag;
}

/**
 * Function to redirect to general blogs
 * @param {tag} tag 
 * @param {id} id 
 */
function view_general_blogs (){
	window.location.href=url_view_general_blog;
}

/**
 * Function to redirect to tagwise blogs
 * @param {tag} tag 
 * @param {id} id 
 */
function view_my_blogs_tagwise(tag){
	window.location.href=url_view_tag_wise_blog+'?tag='+tag;
}

/**
 *  Function to redirect to my career posts
 * @param {id} id 
 */
function view_my_career_posts(){
	window.location.href=url_view_my_career_blog;
}

function view_my_designs_blogs(){
	window.location.href=url_view_my_designs_blog;
}

/**
 * Function to redirect to general blogs
 * @param {tag} tag 
 * @param {id} id 
 */
function view_friend_general_blogs (){
	window.location.href=url_view_friend_general_blog;
}

/**
 * Function to redirect to tagwise blogs
 * @param {tag} tag 
 * @param {id} id 
 */
function view_friend_blogs_tagwise(tag){
	window.location.href=url_view_friend_tag_wise_blog+'?tag='+tag;
}

/**
 *  Function to redirect to my career posts
 * @param {id} id 
 */
function view_friend_career_posts(){
	window.location.href=url_view_friend_career_blog;
}

function view_friend_designs_blogs(){
	window.location.href=url_view_friend_designs_blog;
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