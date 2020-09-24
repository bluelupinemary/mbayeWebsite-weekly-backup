jQuery(function() { 
    // Start Force landscape orientation
    testOrientation();
    window.addEventListener("orientationchange", function(event) {
        // Generate a resize event if the device doesn't do it
        // window.dispatchEvent(new Event("resize"));
        testOrientation();
    }, false);

    window.addEventListener("resize", function(event) {
        // Generate a resize event if the device doesn't do it
        // window.dispatchEvent(new Event("resize"));
        testOrientation();
    }, false);

    var elem = document.documentElement;
    var isFullScreen = 0;

	function openFullscreen() {
		if (elem.mozRequestFullScreen) { /* Firefox */
		    elem.mozRequestFullScreen();
		    contentDisplay();
		} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
			elem.webkitRequestFullscreen();
			contentDisplay();
		} else if (elem.msRequestFullscreen) { /* IE/Edge */
			elem.msRequestFullscreen();
			contentDisplay();
		} else if (elem.requestFullscreen) {
			elem.requestFullscreen();
			contentDisplay();
		} 
	}
	
    function testOrientation() {
        var width = window.innerWidth;
        var height = window.innerHeight;
        var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
        
        // portrait
        if(width < height) {
            isFullScreen = 0;
            $('#page-content').hide();
            $('#block_land').show();
        } else { // landscape
            // check if mobile device
            // fullscreen
            if(width < 991){ 
                if(!isFullScreen) {
                    $('#block_land').hide();
                    $('#page-content').hide();
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
                        padding: '15px',
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false
                    }).then((result) => {
                        // if (result.value) {
                            isFullScreen = 1;
                            openFullscreen();
                        // }
                    });
                }
            } else {
                Swal.close();
                contentDisplay();
            }
        }
    }

    // show page content
    function contentDisplay() {
        $('#page-content').fadeIn();
        $('#block_land').hide();
    }
    // End Force landscape orientation
});