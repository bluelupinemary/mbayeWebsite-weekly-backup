 
// Force landscape orientation
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

function testOrientation() {
    var width = $(document).width();
    var height = $(document).height();
    document.getElementById('block_land').style.display = (width >= 	height) ? 'none' : 'block';
    // console.log("w: ", viewportWidth, "h: ", viewportHeight, "aR: ", viewportAR);
}

