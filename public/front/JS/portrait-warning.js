$(document).ready(function() {
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

    function testOrientation() {
        var width = $(window).width();
        var height = $(window).height();
        document.getElementById('block_land').style.display = (width > height) ? 'none' : 'block';
        document.getElementById('page-content').style.display = (width > height) ? 'block' : 'none';
    }
    // End Force landscape orientation
});