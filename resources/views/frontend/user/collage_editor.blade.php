
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="url" content="{{ url('') }}">

        <title>@yield('title', app_name())</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
        
        <!-- Styles -->
        <style>
            @font-face {
                font-family: "Nasalization";
                src: url("../../fonts/nasalization-rg.ttf");
            }

            html, body {
                /* background-color: #fff; */
                background-color: #1e1e1e;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            ul.music {
                display: flex;
                list-style: none;
            }

            .music li {
                /* align-self: center; */
                width: 200px;
                margin: 1%;
                overflow: hidden;
                height: 200px;
                cursor: pointer;
            }

            .music img {
                width: 100%;
                /* align-self: center; */
            }

            body {
                background: #1e1e1e;
            }

            .collage-editor {
                /* width: 100%; */
                /* height: 100%; */
                /* padding-top: 3%; */
                /* padding-bottom: 3%; */
                /* border: 1px solid red; */
            }

            .collage-editor .canvas {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 80%;
                height: 80vh;
                margin: 0 auto;
                /* margin-top: 2%; */
                /* position: absolute; */
                overflow: auto;
                border: 1px solid #3e3e3e;
                display: flex;
                justify-content: center;
                align-items: center;
                scrollbar-width: thin;
	            scrollbar-color: #047999 #c1d7e491;
            }

            .collage-editor .canvas::-webkit-scrollbar {
                width: 0.8em;
                background: #353434;
            }
            
            /* Handle */
            .collage-editor .canvas::-webkit-scrollbar-thumb {
                background: #272626;
            }

            .collage-editor .canvas-container {
                position: absolute !important;
                /* top: 50%;
                left: 50%; */
                transform: scale(1);
                /* background: #3e3e3e; */
                /* width: 80vw !important;
                height: 80vh !important; */
            }

            canvas {
                /* background: #3e3e3e; */
            }

            #imgLoader, #startImageLoader {
                display: none;
            }

            .controls {
                position: fixed;
                bottom: 0;
                left: 50%;
                transform: translate(-50%, 0);
                display: flex;
                /* border: 1px solid red; */
                width: 50%;
                margin: 0 auto;
                /* margin-top: 1%; */
                justify-content: center;
                align-items: center;
            }

            .controls button {
                width: 5vw;
                height: 4vw;
                font-size: 1.3vw;
                background: #161616;
                color: #fff;
                border: 0;
                padding: 0;
                /* font-weight: bold; */
                /* border: 1px solid red; */
                padding: 0%;
            }

            .controls button:hover {
                
            }

            .controls button:focus {
                outline: 0;
            }

            .controls button:disabled {
                color: #3a3a3a
            }

            .ui-tooltip, .arrow:after {
                background: black;
                border: 0;
            }
            .ui-tooltip {
                padding: 10px 20px;
                color: white;
                border-radius: 20px;
                font-size: 14px;
                /* font: normal 14px "Helvetica Neue", Sans-Serif; */
                /* border: 1px solid red; */
                text-transform: uppercase;
                box-shadow: none;
                border: 0 !important;
            }
            .arrow {
                width: 70px;
                height: 16px;
                overflow: hidden;
                position: absolute;
                left: 50%;
                margin-left: -35px;
                bottom: -16px;
            }
            .arrow.top {
                top: -16px;
                bottom: auto;
            }
            .arrow.left {
                left: 20%;
            }
            .arrow:after {
                content: "";
                position: absolute;
                left: 20px;
                top: -20px;
                width: 25px;
                height: 25px;
                box-shadow: 6px 5px 9px -9px black;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            .arrow.top:after {
                bottom: -20px;
                top: auto;
            }

            .bring-forward, .send-backward {
                position: relative;
            }

            .bring-forward label, .send-backward label {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 30%;
                height: 30%;
                z-index: 1;
            }

            .bring-forward::before {
                content: '';
                display: inline-block;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                /* opacity: 0.6; */
                background-position: center;
                background-repeat: no-repeat;
                background-image: url(../../front/icons/bring-forward.svg);
                background-size: 50%;
                opacity: 1;
            }

            .send-backward::before {
                content: '';
                display: inline-block;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                opacity: 0.6;
                background-position: center;
                background-repeat: no-repeat;
                background-image: url(../../front/icons/send-backward.svg);
                background-size: 50%;
                opacity: 1;
            }

            .start-message {
                position: absolute;
                /* top: 50%; */
                /* left: 50%; */
                /* transform: translate(-50%, -50%); */
                color: #c5c5c5;
                font-size: 2vw;
                text-transform: uppercase;
                font-weight: bold;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: #3e3e3e;
                z-index: 1;
            }

            .cancel-btn {
                position: absolute;
                left: 2%;
                top: 2%;
                width: 7vw;
                height: 3vw;
                padding: 0;
                line-height: 1em;
                outline: none;
                border-radius: 20px;
                border: 1px solid #ddd;
                font-family: 'Noto Sans', sans-serif;
                font-size: 12px;
                font-weight: bold;
                cursor: pointer;
                vertical-align: middle;
                letter-spacing: 0.3px;
                text-align: center;
            }

            .swal2-popup {
                box-shadow: 0px 0px 20px #17a2b8;
                width: 27vw !important;
                padding: 1vw !important;
            }

            .swal2-image {
                width: 6vw !important;
                height: 6vw !important;
                margin: 1.25vh auto !important;
            }

            .swal2-title {
                font-family: 'Nasalization';
                font-size: 1.5vw !important;
                color: #df1613 !important;
            }

            .swal2-content {
                color: #17a2b8 !important;
                font-size: 1.1vw !important;
                font-family: 'Nasalization';
            }

            .swal2-title span.success {
                color: #25d365 !important;
            }

            .swal2-styled {
                font-size: 1.3vw !important;
                padding: 0.5vw 2vw !important;
            }

            .swal2-actions {
                margin: 1.25vw auto 0 !important;
            }

            .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
                background: rgba(0, 0, 0, 0.7) !important;
            }

            @media (min-width : 320px) 
                and (max-width : 991px)
                and (orientation : landscape) {
                    .collage-editor .canvas-container {
                        /* transform: scale(0.6); */
                    }
                }
        </style>
    </head>
    <body>
        <div class="collage-editor">
            <button class="cancel-btn" type="button">Cancel</button>
            <div class="canvas">
                <div class="start-message">
                    <p>
                        <label for="startImageLoader" class="custom-file-upload">
                            <i class="far fa-images"></i> Upload image(s) to start
                        </label>
                    </p>
                    <input type="file" name="image" id="startImageLoader" accept="image/x-png,image/jpeg" multiple>
                </div>
                <canvas id="c"></canvas>
            </div>
            <div class="controls">
                <button id="undo" disabled><label for="" title="Undo"><i class="fas fa-undo"></i></label></button>
                <button id="redo" disabled><label for="" title="Redo"><i class="fas fa-redo"></i></label></button>
                <button id="clear_canvas" disabled><label for="" title="Reset"><i class="fas fa-retweet"></i></label></button>
                
                
                <button class="zoom-in"><label for="" title="Zoom In"><i class="fas fa-search-plus"></i></label></button>
                <button class="zoom-out"><label for="" title="Zoom Out"><i class="fas fa-search-minus"></i></label></button>
                <button class="original-size"><label for="" title="100%"><i class="fas fa-expand-arrows-alt"></label></i></button>
                <button class="bring-forward"><label title="Bring Forward"></label></button>
                <button class="send-backward"><label for="" title="Send Backward"></label></button>
                <button class="remove_object"><label for="" title="Delete Image"><i class="far fa-trash-alt"></i></label></button>
                <button><label for="imgLoader" class="custom-file-upload" title="Upload image(s)">
                    <i class="far fa-images"></i>
                </label></button>
                <input type="file" name="image" id="imgLoader" accept="image/x-png,image/jpeg" multiple>
                <button class="save" disabled><label for="" title="Save"><i class="fas fa-save"></i></label></button>
            </div>
        </div>
        

        <script src="{{asset('front/JS/jquery-1.11.1.min.js')}}"></script>
        <script src="{{asset('front/JS/fabric.min.js')}}"></script>
        <script src="{{asset('front/JS/FileSaver.js')}}"></script>
        <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
        <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                var url = $('meta[name="url"]').attr('content');
                var canvas = new fabric.Canvas('c', 
                {
                    width: '1000',
                    height: '500',
                    preserveObjectStacking: true
                }
                );
                canvas.backgroundColor="#3e3e3e";
                // var canvasWrapper = document.getElementById('canvasWrap');
                // canvasWrapper.addEventListener("keydown", OnkeyDown, false);

                // save initial state
                save();
                // register event listener for user's actions
                canvas.on('object:modified', function() {
                    save();
                });

                document.getElementById('imgLoader').onchange = function handleImage(e) {
                    // console.log(e);
                    $('.start-message').hide();
                    var files = this.files;

                    for (var i = 0, f; f = files[i]; i++) {

                        var reader = new FileReader();
                        reader.onload = function (event) {
                            var imgObj = new Image();
                            imgObj.src = event.target.result;
                            imgObj.onload = function () {
                                // start fabricJS stuff
                                
                                var image = new fabric.Image(imgObj);
                                // image.set({
                                //     left: 250,
                                //     top: 250,
                                //     // angle: 20,
                                //     padding: 10,
                                //     cornersize: 10
                                //     width: 110,
                                // });
                                image.set({
                                    left: 0, 
                                    top: 0, 
                                    angle: 0, 
                                    // scaleX: 0.1, 
                                    // scaleY: 0.1,
                                    borderColor: '#d6d6d6',
                                    cornerColor: '#d6d6d6',
                                    cornerSize: 10,
                                    transparentCorners: false,
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                // image.setCoords();
                                canvas.renderAll();
                                save();
                                // end fabricJS stuff
                            }
                            
                        }
                        reader.readAsDataURL(f);
                    }
                }

                document.getElementById('startImageLoader').onchange = function handleImage(e) {
                    // console.log(e);
                    $('.start-message').hide();
                    var files = this.files;

                    for (var i = 0, f; f = files[i]; i++) {

                        var reader = new FileReader();
                        reader.onload = function (event) {
                            var imgObj = new Image();
                            imgObj.src = event.target.result;
                            imgObj.onload = function () {
                                // start fabricJS stuff
                                
                                var image = new fabric.Image(imgObj);
                                // image.set({
                                //     left: 250,
                                //     top: 250,
                                //     // angle: 20,
                                //     padding: 10,
                                //     cornersize: 10
                                //     width: 110,
                                // });
                                image.set({
                                    left: 0, 
                                    top: 0, 
                                    angle: 0, 
                                    // scaleX: 0.1, 
                                    // scaleY: 0.1,
                                    borderColor: '#d6d6d6',
                                    cornerColor: '#d6d6d6',
                                    cornerSize: 10,
                                    transparentCorners: false,
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                // image.setCoords();
                                canvas.renderAll();
                                save();
                                // end fabricJS stuff
                            }
                            
                        }
                        reader.readAsDataURL(f);
                    }
                }

                $('.remove_object').click(function() {
                    // canvas.remove(canvas.getActiveObject());
                    Swal.fire({
                        text: "Are you sure you want to delete this image?",
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            canvas.getActiveObjects().forEach((obj) => {
                            canvas.remove(obj)
                            });
                            canvas.discardActiveObject().renderAll();
                            countObjects();
                        }
                    });
                });

                $('html').keyup(function(e){
                    if(e.keyCode == 46) {
                        canvas.getActiveObjects().forEach((obj) => {
                        canvas.remove(obj)
                        });
                        canvas.discardActiveObject().renderAll()
                    }
                });

                 // current unsaved state
                var state;
                // past states
                var undo = [];
                // reverted states
                var redo = [];

                /**
                * Push the current state into the undo stack and then capture the current state
                */
                function save() {
                // clear the redo stack
                redo = [];
                $('#redo').prop('disabled', true);
                // initial call won't have a state
                if (state) {
                    undo.push(state);
                    $('#undo').prop('disabled', false);
                    $('#clear_canvas').prop('disabled', false);
                    $('.save').prop('disabled', false);
                }
                state = JSON.stringify(canvas);
                }

                /**
                * Save the current state in the redo stack, reset to a state in the undo stack, and enable the buttons accordingly.
                * Or, do the opposite (redo vs. undo)
                * @param playStack which stack to get the last state from and to then render the canvas as
                * @param saveStack which stack to push current state into
                * @param buttonsOn jQuery selector. Enable these buttons.
                * @param buttonsOff jQuery selector. Disable these buttons.
                */
                function replay(playStack, saveStack, buttonsOn, buttonsOff) {
                    saveStack.push(state);
                    state = playStack.pop();
                    var on = $(buttonsOn);
                    var off = $(buttonsOff);
                    // turn both buttons off for the moment to prevent rapid clicking
                    on.prop('disabled', true);
                    off.prop('disabled', true);
                    canvas.clear();
                    canvas.loadFromJSON(state, function() {
                        canvas.renderAll();
                        // now turn the buttons back on if applicable
                        on.prop('disabled', false);
                        if (playStack.length) {
                        off.prop('disabled', false);
                        }
                    });
                    countObjects();
                }

                // undo and redo buttons
                $('#undo').click(function() {
                    replay(undo, redo, '#redo', this);
                });
                $('#redo').click(function() {
                    replay(redo, undo, '#undo', this);
                })
                $('#clear_canvas').click(function() {
                    // canvas.clear();
                    // canvas.remove(canvas.getObjects().concat())
                    Swal.fire({
                        text: "Are you sure you want to reset the canvas?",
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            canvas.getObjects().forEach((obj) => {
                                canvas.remove(obj)
                            });
                            countObjects();
                        }
                    });
                });
                // $('.save').click(function() {
                //     // canvas.backgroundColor="transparent";
                //     // canvas.deactivateAll().renderAll();
                //     canvas.renderAll();
                //     var img = canvas.toDataURL({
                //         format: 'png',
                //         // quality: 0.8,
                //         // multiplier: 1,
                //         // left: 0, 
                //         // top: 0, 
                //         // width: 1000,
                //         // height: 600,
                //         enableRetinaScaling: false
                //     });

                //     console.log(img);
                //     // canvas.backgroundColor="#3e3e3e";

                //     // window.open(image);
                // });
                $.urlParam = function(name){
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                    return results[1] || 0;
                }

                $(".save").click(function(){
                    Swal.fire({
                        text: "Are you sure you want to save the changes made to the entry?",
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, save it!'
                    }).then((result) => {
                    if (result.value) {
                        canvas.discardActiveObject();
                        // canvas.setBackgroundColor('transparent', canvas.renderAll.bind(canvas));
                        canvas.renderAll();

                        $("#c").get(0).toBlob(function(blob){
                            // console.log(blob);
                            // saveAs(blob, "myIMG.png");
                            var tag = $.urlParam('tag');
                            var user_id = '{{Auth::user()->id}}';
                            var data = new FormData();
                            data.append('file', blob);
                            data.append('tag', tag);
                            data.append('user_id', user_id);

                            $.ajax({
                                type: "POST",
                                url: url+'/api/save_collage',
                                data: data,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    // console.log(res);
                                    // alert('Collage Saved! Filename: '+res.filename);
                                    Swal.fire({
                                        title: '<span class="success">Success!</span>',
                                        text: 'Collage successfully saved!',
                                        imageUrl: '../../front/icons/alert-icon.png',
                                        imageWidth: 80,
                                        imageHeight: 80,
                                        imageAlt: 'Mbaye Logo',
                                        width: '30%',
                                        padding: '1rem',
                                        background: 'rgba(8, 64, 147, 0.62)'
                                    }).then((res) => {
                                        window.location.href = url+'/dashboard';
                                    });
                                }
                            });
                        });
                    }
                    });
                    // canvas.setBackgroundColor('#3e3e3e', canvas.renderAll.bind(canvas));
                }); 

                var scale = 1;

                $('.zoom-in').click(function() {
                    scale += 0.2;
                    $('.canvas-container').css('transform', 'scale('+scale+')');
                });

                $('.zoom-out').click(function() {
                    console.log(scale);
                    if(scale <= 0.2) {
                        scale = 0.2;
                    } else if (scale > 0) {
                        scale -= 0.2;
                    }
                    
                    $('.canvas-container').css('transform', 'scale('+scale+')');
                });
                
                $('.original-size').click(function() {
                    scale = 1;
                    $('.canvas-container').css('transform', 'scale('+scale+')');
                });

                // canvas.on('mouse:wheel', function(opt) {
                //     var delta = opt.e.deltaY;
                //     var zoom = canvas.getZoom();
                //     zoom *= 0.999 ** delta;
                //     if (zoom > 20) zoom = 20;
                //     if (zoom < 0.01) zoom = 0.01;
                //     canvas.setZoom(zoom);
                //     opt.e.preventDefault();
                //     opt.e.stopPropagation();
                // })

                // var selectedObject;
                // canvas.on('object:selected', function(event) {
                //     selectedObject = event.target;
                // });

                $('.bring-forward').click(function() {
                    var currentObject = canvas.getActiveObject();
                    canvas.bringToFront(currentObject);
                });

                $('.send-backward').click(function() {
                    var currentObject = canvas.getActiveObject()
                    canvas.sendToBack(currentObject);
                });

                var sendSelectedObjectBack = function() {
                    canvas.sendToBack(selectedObject, true);
                }
                
                var sendSelectedObjectToFront = function() {
                    canvas.bringToFront(selectedObject, true);
                }

                $( document ).tooltip({
                    position: {
                        my: "center bottom-20",
                        at: "center top",
                        using: function( position, feedback ) {
                        $( this ).css( position );
                        $( "<div>" )
                            .addClass( "arrow" )
                            .addClass( feedback.vertical )
                            .addClass( feedback.horizontal )
                            .appendTo( this );
                        }
                    }
                });

                $('button.cancel-btn').click(function() {
                    window.location.href = url+'/dashboard';
                });

                function countObjects()
                {
                    var object_count = canvas.getObjects().length;

                    if(object_count < 1) {
                        $('.save').prop('disabled', true);
                    }
                }
            });
        </script>
    </body>
</html>
