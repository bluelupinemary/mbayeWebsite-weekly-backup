(function() {
    this.Carousel = function() {
        // function Carousel(element, settings) {
            var _ = this;
            _.carousel = {
                id: '',
                // width: 100,     // Images are forced into a width of this many pixels.
                numVisible: 4,  // The number of images visible at once.
                duration: 600,  // Animation duration in milliseconds.
                padding: 2      // Vertical padding around each image, in pixels.
            };

            // Create options by extending defaults with the passed in arugments
            if (arguments[0] && typeof arguments[0] === "object") {
                this.options = extendDefaults(_.carousel, arguments[0]);
            }

            function rotateForward(id) {
                var carousel = document.querySelector(id),
                    children = carousel.children,
                    firstChild = children[0],
                    lastChild = children[children.length - 1];
                carousel.insertBefore(lastChild, firstChild);
            }
            function rotateBackward(id) {
                var carousel = document.querySelector(id),
                    children = carousel.children,
                    firstChild = children[0],
                    lastChild = children[children.length - 1];
                carousel.insertBefore(firstChild, lastChild.nextSibling);
            }

            function animate(begin, end, finalTask, id) {
                var wrapper = _.carousel.wrapper,
                    carousel = document.querySelector(id),
                    change = end - begin,
                    duration = _.carousel.duration,
                    startTime = Date.now();
                carousel.style.top = begin + 'px';
                var animateInterval = window.setInterval(function () {
                var t = Date.now() - startTime;
                if (t >= duration) {
                    window.clearInterval(animateInterval);
                    finalTask();
                    return;
                }
                t /= (duration / 2);
                var top = begin + (t < 1 ? change / 2 * Math.pow(t, 3) :
                                            change / 2 * (Math.pow(t - 2, 3) + 2));
                carousel.style.top = top + 'px';
                }, 1000 / 60);
            }

            // window.onload = function () {
            document.getElementById('spinner').style.display = 'none';
            var carousel = _.carousel.carousel = document.querySelector(_.carousel.id),
                images = carousel.getElementsByTagName('img'),
                numImages = images.length,
                imageWidth = _.carousel.width,
                aspectRatio = images[0].width / images[0].height,
                imageHeight = imageWidth / aspectRatio,
                padding = _.carousel.padding,
                rowHeight = _.carousel.rowHeight = imageHeight + 2 * padding;
            carousel.style.width = imageWidth + 'px';
            for (var i = 0; i < numImages; ++i) {
            var image = images[i],
                frame = document.createElement('div');
            frame.className = 'pictureFrame';
            var aspectRatio = image.offsetWidth / image.offsetHeight;
            image.style.width = frame.style.width = imageWidth + 'px';
            image.style.height = imageHeight + 'px';
            image.style.paddingTop = padding + 'px';
            image.style.paddingBottom = padding + 'px';
            frame.style.height = rowHeight + 'px';
            carousel.insertBefore(frame, image);
            frame.appendChild(image);
            }
            _.carousel.rowHeight = carousel.getElementsByTagName('div')[0].offsetHeight;
            carousel.style.height = _.carousel.numVisible * _.carousel.rowHeight + 'px';
            carousel.style.visibility = 'visible';
            var wrapper = _.carousel.wrapper = document.createElement('div');
            wrapper.id = 'carouselWrapper';
            wrapper.style.width = carousel.offsetWidth + 'px';
            wrapper.style.height = carousel.offsetHeight + 'px';
            carousel.parentNode.insertBefore(wrapper, carousel);
            wrapper.appendChild(carousel);
                // var prevButton = document.getElementById('prev'),
                //     nextButton = document.getElementById('next');
            
            // };
        // }

        Carousel.prototype.previousSlide = function(id) {
            // prevButton.disabled = nextButton.disabled = true;
            rotateForward(id);
            animate(-_.carousel.rowHeight, 0, function () {
                carousel.style.top = '0';
                // prevButton.disabled = nextButton.disabled = false;
            }, id);
        }
        Carousel.prototype.nextSlide = function(id) {
            // prevButton.disabled = nextButton.disabled = true;
            animate(0, -_.carousel.rowHeight, function () {
                rotateBackward(id);
                carousel.style.top = '0';
                // prevButton.disabled = nextButton.disabled = false;
            }, id);
        }

    }

    // Utility method to extend defaults with user options
    function extendDefaults(source, properties) {
        var property;
        for (property in properties) {
        if (properties.hasOwnProperty(property)) {
            source[property] = properties[property];
        }
        }
        return source;
    }   
    

    
}());