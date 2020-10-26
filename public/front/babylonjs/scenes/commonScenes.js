/*======================================================== CHECK IF FULLSCREEN FEATURE IS ACTIVATABLE =====================================================*/
var elem = document.documentElement;
function openFullscreen() {
    if (elem.mozRequestFullScreen) { /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE/Edge */
        elem.msRequestFullscreen();
    }else if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }else{
        elem.webkitRequestFullscreen();
    }
}


$('#fullscreenIcon').on('click',function(){
    openFullscreen();
    $(this).hide();
});

function testFullscreen(){
    if((window.innerHeight !== window.screen.height) || (window.innerWidth !== window.screen.width)){
        $('#fullscreenIcon').show();
    }
}


/*======================================================== CHECK THE BROWSWER BEING USED =====================================================*/
function testBrowser() { 
    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ){
       return 'Opera';
    }else if(navigator.userAgent.indexOf("Chrome") != -1 ){
        return 'Chrome';
    }else if(navigator.userAgent.indexOf("Safari") != -1){
        return 'Safari';
    }else if(navigator.userAgent.indexOf("Firefox") != -1 ){
        return 'Firefox';
    }else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )){
        return 'IE'; 
    }else{
        return 'unknown';
    }
}



/*======================================================= CHECK PLATFORM TYPE============================================================ */

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


//show alert to fullscreen function
function alert_fullscreen(){
	  Swal.fire({
			imageUrl: '../../front/icons/alert-icon.png',
			imageWidth: '15vw',
			imageHeight: '15vw',
			html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
			padding: '5%',
			background: 'rgba(8, 64, 147, 0.62)',
			allowOutsideClick: false
		  }).then((result) => {
			  if (result.value){
				openFullscreen()
			  }
		});
}

function testOrientation() {
    if (window.innerHeight < window.innerWidth) {
        document.getElementById('block_land').style.display = 'none';
    } else {
        document.getElementById('block_land').style.display = 'block';
    }
}


