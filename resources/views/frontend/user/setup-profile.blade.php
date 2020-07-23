
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="url" content="{{ url('') }}">

        <title>@yield('title', app_name())</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
        
        <!-- Styles -->
        <style>
            @font-face {
                font-family: "Nasalization";
                src: url("../../fonts/nasalization-rg.ttf");
            }

            /* hammersmith-one-regular - latin */
            @font-face {
            font-family: 'Hammersmith One';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/hammersmith-one-v10-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Hammersmith One'), local('HammersmithOne'),
            url('../fonts/hammersmith-one-v10-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/hammersmith-one-v10-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/hammersmith-one-v10-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/hammersmith-one-v10-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/hammersmith-one-v10-latin-regular.svg#HammersmithOne') format('svg'); /* Legacy iOS */
            }

            /* pacifico-regular - latin */
            @font-face {
            font-family: 'Pacifico';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/pacifico-v16-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Pacifico Regular'), local('Pacifico-Regular'),
            url('../fonts/pacifico-v16-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/pacifico-v16-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/pacifico-v16-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/pacifico-v16-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/pacifico-v16-latin-regular.svg#Pacifico') format('svg'); /* Legacy iOS */
            }

            /* anton-regular - latin */
            @font-face {
            font-family: 'Anton';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/anton-v11-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Anton Regular'), local('Anton-Regular'),
            url('../fonts/anton-v11-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/anton-v11-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/anton-v11-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/anton-v11-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/anton-v11-latin-regular.svg#Anton') format('svg'); /* Legacy iOS */
            }

            /* sigmar-one-regular - latin */
            @font-face {
            font-family: 'Sigmar One';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/sigmar-one-v10-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Sigmar One Regular'), local('SigmarOne-Regular'),
            url('../fonts/sigmar-one-v10-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/sigmar-one-v10-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/sigmar-one-v10-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/sigmar-one-v10-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/sigmar-one-v10-latin-regular.svg#SigmarOne') format('svg'); /* Legacy iOS */
            }

            /* righteous-regular - latin */
            @font-face {
            font-family: 'Righteous';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/righteous-v8-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Righteous'), local('Righteous-Regular'),
            url('../fonts/righteous-v8-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/righteous-v8-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/righteous-v8-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/righteous-v8-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/righteous-v8-latin-regular.svg#Righteous') format('svg'); /* Legacy iOS */
            }

            /* vt323-regular - latin */
            @font-face {
            font-family: 'VT323';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/vt323-v11-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('VT323 Regular'), local('VT323-Regular'),
            url('../fonts/vt323-v11-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/vt323-v11-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/vt323-v11-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/vt323-v11-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/vt323-v11-latin-regular.svg#VT323') format('svg'); /* Legacy iOS */
            }

            /* quicksand-regular - latin */
            @font-face {
            font-family: 'Quicksand';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/quicksand-v21-latin-regular.eot'); /* IE9 Compat Modes */
            src: local(''),
            url('../fonts/quicksand-v21-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/quicksand-v21-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/quicksand-v21-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/quicksand-v21-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/quicksand-v21-latin-regular.svg#Quicksand') format('svg'); /* Legacy iOS */
            }

            /* inconsolata-regular - latin */
            @font-face {
            font-family: 'Inconsolata';
            font-style: normal;
            font-weight: 400;
            src: url('../fonts/inconsolata-v20-latin-regular.eot'); /* IE9 Compat Modes */
            src: local(''),
            url('../fonts/inconsolata-v20-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('../fonts/inconsolata-v20-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('../fonts/inconsolata-v20-latin-regular.woff') format('woff'), /* Modern Browsers */
            url('../fonts/inconsolata-v20-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
            url('../fonts/inconsolata-v20-latin-regular.svg#Inconsolata') format('svg'); /* Legacy iOS */
            }

            html, body {
                background-image: url(../../front/images/skybox_bg1.png);
                background-size: cover; 
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

            /*body {
                background: #1e1e1e;
            } */

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
                width: 1200px;
                height: 550px;
                margin: 0 auto;
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
            }
            
            /* Handle */
            .collage-editor .canvas::-webkit-scrollbar-thumb {
                width: 0.8em;
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

            .shape-select {
                position: fixed;
                background: #161616;
                bottom: 8vh;
                left: 55vw;
                transform: translate(-50%, 0);
                width: 23vw;
                height: 15vh;
                margin: 0 auto;
                padding: 0.3vw;
                justify-content: center;
                align-items: center;
                overflow-y: scroll;
                color: #fff;
            }

            .shape-select button {
                width: 5vw;
                height: 7vh;
                font-size: 1.3vw;
                border: 0;
                background: #161616;
                color: #fff;
            }

            .text-styles {
                position: fixed;
                background: #161616;
                bottom: 8vh;
                left: 60vw;
                transform: translate(-50%, 0);
                width: 23vw;
                height: 15vh;
                margin: 0 auto;
                padding: 0.3vw;
                justify-content: center;
                align-items: center;
                color: #fff;
            }

            .text-styles table {
                padding: 0.7vw;
            }

            /* The Close Button */
            .close {
                position: fixed;
                right: 2%;
                color: #aaaaaa;
                font-size: 20px;
                font-weight: bold;
                margin: 0 auto;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
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
                <button id="add_shapes" class="add_shapes"><label title="Add Shapes"><i class="fas fa-shapes"></label></i></button>
                <button id="add_text" class="add_text"><label for="" title="Add Text"><i class="fas fa-font"></label></i></button>
                <button class="remove_object"><label for="" title="Delete Image"><i class="far fa-trash-alt"></i></label></button>
                <button><label for="imgLoader" class="custom-file-upload" title="Upload image(s)">
                    <i class="far fa-images"></i>
                </label></button>
                <input type="file" name="image" id="imgLoader" accept="image/x-png,image/jpeg" multiple>
                <button class="save" disabled><label for="" title="Save"><i class="fas fa-save"></i></label></button>
            </div>

            <div id="shape-select" class="shape-select" style="display:none">
            <span id="close_shapes" class="close">&times;</span>
            <table>
            <tr><td><button id="circle" class="circle"><label for="" title="Circle"><i class="fas fa-circle"></i></label></button></td>
                <td><button id="tri" class="triangle"><label for="" title="Triangle"><i class="fas fa-shapes"></i></label></button></td>
                <td><button id="square" class="square"><label for="" title="Square"><i class="fas fa-square-full"></i></label></button></td>
                <td><button id="rectangle" class="rectangle"><label for="" title="Rectangle"><i class="fas fa-shapes"></i></label></button></td>
            </tr>
            <tr><td>
                    <button id="diamond" class="diamond">
                    <label for="" title="Diamond"><svg height="5" width="5">
                    <polygon points="50,0 100,50 50,100 0,50" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="parallelogram" class="parallelogram">
                    <label for="" title="Parallelogram"><svg height="5" width="5">
                    <polygon points="25,0 100,0 75,100 0,100" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="ellipse" class="ellipse">
                    <label for="" title="Ellipse">
                    </label>
                    </button>
                </td>

                <td>
                    <button id="trapezoid" class="trapezoid">
                    <label for="" title="Trapezoid"><svg height="5" width="5">
                    <polygon points="180,10 300,50 300,180 180,220" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>
            </tr>
            
            <tr><td>
                    <button id="star" class="star">
                    <label for="" title="Star"><i class="fas fa-star"></i></label></button>
                </td>

                <td>
                    <button id="penta" class="penta">
                    <label for="" title="Pentagon"><svg height="5" width="5">
                    <polygon points="50,0 100,38 82,100 18,100 0,38" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="hexa" class="hexa">
                    <label for="" title="Hexagon"><svg height="5" width="5">
                    <polygon points="850,75 958,137.5 958,262.5 850,325 742,262.5 742,137.5" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="hepta" class="hepta">
                    <label for="" title="Heptagon"><svg height="5" width="5">
                    <polygon points="50,0 90,20 100,60 75,100 25,100 0,60 10,20" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>
            </tr>
            
            <tr><td>
                    <button id="octa" class="octa">
                    <label for="" title="Octagon"><svg height="5" width="5">
                    <polygon points="30,0 70,0 100,30 100,70 70,100 30,100 0,70 0,30" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
            </td>

                <td>
                    <button id="nona" class="nona">
                    <label for="" title="Nonagon"><svg height="5" width="5">
                    <polygon points="50,0 83,12 100,43 94,78 68,100 32,100 6,78 0,43 17,12" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="deca" class="deca">
                    <label for="" title="Decagon"><svg height="5" width="5">
                    <polygon points="50,0 80,10 100,35 100,70 80,90 50,100 20,90 0,70 0,35 20,10" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="bevel" class="bevel">
                    <label for="" title="Bevel"><svg height="5" width="5">
                    <polygon points="20,0 80,0 100,20 100,80 80,100 20,100 0,80 0,20" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>
            </tr>
            
            <tr><td>
                    <button id="rabbet" class="rabbet">
                    <label for="" title="Rabbet"><svg height="5" width="5">
                    <polygon points="0,15 15,15 15,0 85,0 85,15 100,15 100,85 85,85 85,100 15,100 15,85 0,85" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td>
                    <button id="point" class="point">
                    <label for="" title="Point"><svg height="5" width="5">
                    <polygon points="0,0 75,0 100,50 75,100 0,100" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td><button id="chevron" class="chevron">
                    <label for="" title="Chevron"><svg height="5" width="5">
                    <polygon points="75,0 100,50 75,100 0,100 25,50 0,0" style="fill:white;fill-rule:nonzero;" />
                    </svg></label>
                    </button>
                </td>

                <td><button id="message" class="message">
                    <label for="" title="Message"><svg height="5" width="5">
                    <polygon points="0,0 100,0 100,75 75,75 75,100 50,75 0,75" style="fill:white;fill-rule:nonzero;" />
                    </svg></label></button>
                </td>
            </tr>
            </table>
            </div>

            <div id="text-styles" class="text-styles" style="display:none">
                <span id="close_textstyles" class="close">&times;</span>
                <table>
                <tr><td><label for="FontStyle">Text Style</label></td>
                    <td>
                    <select name="FontStyle" id="FontStyle">
                    <option value="Times New Roman" style="font-family:Times New Roman">Times New Roman</option>
                    <option value="Arial" style="font-family:arial">Arial</option>
                    <option value="Georgia" style="font-family:Georgia">Georgia</option>
                    <option value="Hammersmith One" style="font-family:Hammersmith One">Hammersmith One</option>
                    <option value="Pacifico" style="font-family:Pacifico">Pacifico</option>
                    <option value="Anton" style="font-family:Anton">Anton</option>
                    <option value="Sigmar One" style="font-family:Sigmar One">Sigmar One</option>
                    <option value="Righteous" style="font-family:Righteous">Righteous</option>
                    <option value="VT323" style="font-family:VT323">VT323</option>
                    <option value="Quicksand" style="font-family:Quicksand">Quicksand</option>
                    <option value="Inconsolata" style="font-family:Inconsolata">Inconsolata</option>
                    </select></td>                
                    </tr>
                <tr><td><label for="text-color">Text color</label></td>
                    <td><input type="color" id="text-color" data-type="color"/></td>
                    <td><label for="bg-color">Text highlight</label></td>
                    <td><input type="color" id="bg-color" data-type="color"/></td> 
                </tr>  
                <tr>   
                </tr>         
                </table>
                </div>
        </div>
        
        <script src="{{asset('front/JS/jquery-1.11.1.min.js')}}"></script>
        <!-- <script src="{{asset('front/JS/jquery-2.1.3x.min.js')}}"></script> -->
        <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
        <script src="{{asset('front/JS/fabric.min.js')}}"></script>
        <script src="{{asset('front/JS/FileSaver.js')}}"></script>       
        <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
        <script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
        <script src="{{asset('front/JS/lodash.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                var url = $('meta[name="url"]').attr('content');
                var canvas = new fabric.Canvas('c', 
                {
                    width: '1200',
                    height: '550',
                    preserveObjectStacking: true,
                    renderOnAddRemove: false,
                }
                );
                fabric.Object.prototype.objectCaching = false;
                canvas.backgroundColor="transparent";
                // var canvasWrapper = document.getElementById('canvasWrap');
                // canvasWrapper.addEventListener("keydown", OnkeyDown, false);

                // save initial state
                save();

                // register event listener for user's actions
                canvas.on('object:modified', function() {
                    save();
                }); 
                
                //function to hide DIV of shape selector
                $(document).ready(function(){
                $("#close_shapes").click(function(){
                $("#shape-select").hide();
                });
                });

                //function to hide DIV of text styles selector
                $(document).ready(function(){
                $("#close_textstyles").click(function(){
                $("#text-styles").hide();
                });
                });

                //function to show DIV of shape selector
                $(document).ready(function(){
                $("#add_shapes").click(function(){
                $("#shape-select").show();
                $("#text-styles").hide();
                });
                });

                //function to show DIV of text styles selector
                $(document).ready(function(){
                $("#add_text").click(function(){
                $("#text-styles").show();
                $("#shape-select").hide();
                });
                });

                //function to change background color of selected text
                $('#bg-color').change((e) => {
                let obj = canvas.getActiveObject();
                let $this = $(e.currentTarget);
                obj.setSelectionStyles({textBackgroundColor:$this.val()});
                canvas.renderAll();
                });

                //function to change text color of selected text
                $('#text-color').change((e) => {
                let obj = canvas.getActiveObject();
                let $this = $(e.currentTarget);
                obj.setSelectionStyles({fill:$this.val()});
                //obj.textBackgroundColor =$this.val();
                canvas.renderAll();
                });

                //function to set font style
                $('#FontStyle').change(function() {    
                var mFont = $(this).val();
                var tObj = canvas.getActiveObject();
                tObj.set({
                    fontFamily: mFont
                });
                canvas.renderAll();
                }); 

                //function to show DIV of shape selector when text is selected
                canvas.on('selection:created', function() {
                    if(canvas.getActiveObject().get('type')==="i-text"){
                    $("#text-styles").show();
                    $("#shape-select").hide();
                    }
                });

                canvas.on('selection:cleared', function() {
                    $("#text-styles").hide();
                });
                
                let imagesMap = new Map();
                let shapesMap = new Map();
                let textMap = new Map();

                //function to select image/s
                document.getElementById('imgLoader').onchange = function handleImage(e) {
                    // console.log(e);
                    $('.start-message').hide();
                    var files = this.files;

                    for (var i = 0, f; f = files[i]; i++) {

                            var reader = new FileReader();
                            //   var radius = 300;
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
                                    name:"img"+(imagesMap.size+1),                          
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                imagesMap.set(image.name,image);
                                console.log("images map: ", imagesMap);
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
                                    name:"img"+(imagesMap.size+1),     
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                // image.setCoords();
                                imagesMap.set(image.name,image);
                                console.log("images map: ", imagesMap);
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
                                if(canvas.getActiveObject().get('type')==="image"){
                                var obj = canvas.getActiveObject();
                                console.log("image deleted");
                                imagesMap.delete(obj.name,obj);
                                canvas.remove(obj); 
                                }      
                                else if(canvas.getActiveObject().get('type')==="i-text"){
                                var obj = canvas.getActiveObject();
                                console.log("text deleted");
                                textMap.delete(obj.name,obj);
                                canvas.remove(obj);     
                                }      
                                else if(canvas.getActiveObject().get('type')==="circle"){
                                var obj = canvas.getActiveObject();
                                console.log("shape deleted");
                                shapesMap.delete(obj.name,obj);
                                canvas.remove(obj);         
                                }       
                                else if(canvas.getActiveObject().get('type')==="triangle"){
                                var obj = canvas.getActiveObject();
                                console.log("shape deleted");
                                shapesMap.delete(obj.name,obj);
                                canvas.remove(obj);         
                                }     
                                else if(canvas.getActiveObject().get('type')==="rect"){
                                var obj = canvas.getActiveObject();
                                console.log("shape deleted");
                                shapesMap.delete(obj.name,obj);
                                canvas.remove(obj);         
                                }    
                                else if(canvas.getActiveObject().get('type')==="ellipse"){
                                var obj = canvas.getActiveObject();
                                console.log("shape deleted");
                                shapesMap.delete(obj.name,obj);
                                canvas.remove(obj);         
                                }   
                                else if(canvas.getActiveObject().get('type')==="polygon"){
                                var obj = canvas.getActiveObject();
                                console.log("shape deleted");
                                shapesMap.delete(obj.name,obj);
                                canvas.remove(obj);         
                                }           
                            });
                            canvas.discardActiveObject().renderAll();
                            countObjects();
                        }
                    });
                });

                $('html').keyup(function(e){
                    if(e.keyCode == 46) {
                        canvas.getActiveObjects().forEach((obj) => {
                        deleteMap();
                        canvas.remove(obj);                        
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
                                canvas.clear();
                                imagesMap.clear();
                                shapesMap.clear();
                                textMap.clear(); 
                            countObjects();
                        }
                    });
                });

                $("#add_text").on("click", function(e) {
                add_text();
                }); 

                $("#circle").on("click", function(e) {
                addCircle();
                });

                $("#tri").on("click", function(e) {
                addTri();
                }); 

                $("#square").on("click", function(e) {
                addSquare();
                });

                $("#rectangle").on("click", function(e) {
                addRect();
                });

                $("#diamond").on("click", function(e) {
                addDiam();
                }); 

                $("#parallelogram").on("click", function(e) {
                addParallelo();
                });

                $("#ellipse").on("click", function(e) {
                addEllipse();
                }); 

                $("#trapezoid").on("click", function(e) {
                addTrapez();
                });

                $("#star").on("click", function(e) {
                addStar();
                });

                $("#penta").on("click", function(e) {
                addPenta();
                }); 

                $("#hexa").on("click", function(e) {
                addHexa();
                });

                $("#hepta").on("click", function(e) {
                addHepta();
                }); 

                $("#octa").on("click", function(e) {
                addOcta();
                });

                $("#nona").on("click", function(e) {
                addNona();
                }); 

                $("#deca").on("click", function(e) {
                addDeca();
                });

                $("#bevel").on("click", function(e) {
                addBevel();
                }); 

                $("#rabbet").on("click", function(e) {
                addRabbet();
                });

                $("#point").on("click", function(e) {
                addRtPoint();
                }); 

                $("#chevron").on("click", function(e) {
                addRtChev();
                });

                $("#message").on("click", function(e) {
                addMsg();
                });

                //function to add text
                var text;
                function add_text() { 
                $('.start-message').hide();
                    text = new fabric.IText('Click here to edit text', { 
                    fontFamily: 'Calibri',
                    left: 100, 
                    top: 100,
                    fill: '#FFFFFF', 
                    name:"text"+(textMap.size+1),   
                });
                text.scaleToWidth(canvas.getWidth()/5);
                canvas.add(text);  
                canvas.renderAll();
                textMap.set(text.name,text);
                console.log("textMap", textMap);
                }

                //functions to add shapes
                //Circle
                function addCircle(){ 
                $('.start-message').hide();
                var Circle = new fabric.Circle({
	                radius: 300,
                    scaleX: 0.35, 
                    scaleY: 0.35,
	                fill: '#DDD',
                    left: 450,
                    top: 175,
                    name:"shape"+(shapesMap.size+1),  
                });  
                canvas.add(Circle);
                canvas.sendToBack(Circle);
                canvas.renderAll();
                save();
                shapesMap.set(Circle.name,Circle);
                console.log("shapesMap", shapesMap);
                }

                //Triangle
                function addTri(){ 
                $('.start-message').hide();
                var Tri = new fabric.Triangle({
                    width: 200, 
                    height: 200, 
                    scaleX: 1, 
                    scaleY: 1,
                    left: 450,
                    top: 175,
                    fill: '#DDD',
                    name:"shape"+(shapesMap.size+1),    
                });
  
                canvas.add(Tri);
                canvas.sendToBack(Tri);
                canvas.renderAll();
                save();
                shapesMap.set(Tri.name,Tri);
                console.log("shapesMap", shapesMap);
                }

                //Square
                function addSquare(){ 
                $('.start-message').hide();
                var Square = new fabric.Rect({
                    width: 100, 
                    height: 100, 
                    scaleX: 2, 
                    scaleY: 2,
                    left: 450,
                    top: 175,
                    fill: '#DDD',
                    name:"shape"+(shapesMap.size+1), 
                });
  
                canvas.add(Square);
                canvas.sendToBack(Square);
                canvas.renderAll();
                save();
                shapesMap.set(Square.name,Square);
                console.log("shapesMap", shapesMap);
                } 

                //Rectangle
                function addRect(){ 
                $('.start-message').hide();
                var Rect = new fabric.Rect({
                    width: 200, 
                    height: 100, 
                    scaleX: 1.5, 
                    scaleY: 1.5,
                    left: 450,
                    top: 175, 
                    fill: '#DDD',
                    name:"shape"+(shapesMap.size+1), 
                });
  
                canvas.add(Rect);
                canvas.sendToBack(Rect);
                canvas.renderAll();
                save();
                shapesMap.set(Rect.name,Rect);
                console.log("shapesMap", shapesMap);
                } 

                //Diamonds
                function addDiam(){
                $('.start-message').hide(); 
                var Diam;
                    Diam = new fabric.Polygon([
                    {x:50,y:0},
                    {x:100,y:50},
                    {x:50,y:100},
                    {x:0,y:50}
                    ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),         
                });
  
                canvas.add(Diam);
                canvas.sendToBack(Diam);
                canvas.renderAll();
                save();
                shapesMap.set(Diam.name,Diam);
                console.log("shapesMap", shapesMap);
                }

                //Parallelogram
                function addParallelo(){ 
                $('.start-message').hide();
                var Parallelo;
                    Parallelo = new fabric.Polygon([
                    {x:25,y:0},
                    {x:100,y:0},
                    {x:75,y:100},
                    {x:0,y:100}
                    ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Parallelo);
                canvas.sendToBack(Parallelo);
                canvas.renderAll();
                save();
                shapesMap.set(Parallelo.name,Parallelo);
                console.log("shapesMap", shapesMap);
                } 

                //Ellipse
                function addEllipse(){
                $('.start-message').hide(); 
                var ellipse = new fabric.Ellipse({ 
                    rx: 80, 
                    ry: 40, 
                    scaleX: 2, 
                    scaleY: 2,
                    fill: '#DDD', 
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),  
                }); 
  
                canvas.add(ellipse);
                canvas.sendToBack(ellipse);
                canvas.renderAll();
                save();
                shapesMap.set(ellipse.name,ellipse);
                console.log("shapesMap", shapesMap);
                }

                //Trapezoid
                function addTrapez(){ 
                $('.start-message').hide();
                var clipPoly;
                    clipPoly = new fabric.Polygon([
                    { x: 180, y: 10 },
                    { x: 300, y: 50 },
                    { x: 300, y: 180 },
                    { x: 180, y: 220 }
                ], {
                    scaleX: 1.15, 
                    scaleY: 1.15,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(clipPoly);
                canvas.sendToBack(clipPoly);
                canvas.renderAll();
                save();
                shapesMap.set(clipPoly.name,clipPoly);
                console.log("shapesMap", shapesMap);
                } 

                //Star
                function addStar(){
                $('.start-message').hide(); 
                var Star;
                    Star = new fabric.Polygon([
                    {x:350,y:75},
                    {x:380,y:160},
                    {x:470,y:160},
                    {x:400,y:215},
                    {x:423,y:301},
                    {x:350,y:250},
                    {x:277,y:301},
                    {x:303,y:215},
                    {x:231,y:161},
                    {x:321,y:161}
                ], {
                    scaleX: 1, 
                    scaleY: 1,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Star);
                canvas.sendToBack(Star);
                canvas.renderAll();
                save();
                shapesMap.set(Star.name,Star);
                console.log("shapesMap", shapesMap);
                }

                //Pentagon
                function addPenta(){ 
                $('.start-message').hide();
                var Penta;
                    Penta = new fabric.Polygon([
                    {x:50,y:0},
                    {x:100,y:38},
                    {x:82,y:100},
                    {x:18,y:100},
                    {x:0,y:38}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Penta);
                canvas.sendToBack(Penta);
                canvas.renderAll();
                save();
                shapesMap.set(Penta.name,Penta);
                console.log("shapesMap", shapesMap);
                }

                //Hexagon
                function addHexa(){ 
                $('.start-message').hide();
                var Hexa;
                    Hexa = new fabric.Polygon([
                    {x:850,y:75},
                    {x:958,y:137.5},
                    {x:958,y:262.5},
                    {x:850,y:325},
                    {x:742,y:262.5},
                    {x:742,y:137.5},
                ], {
                    scaleX: 0.9, 
                    scaleY: 0.9,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Hexa);
                canvas.sendToBack(Hexa);
                canvas.renderAll();
                save();
                shapesMap.set(Hexa.name,Hexa);
                console.log("shapesMap", shapesMap);
                }

                //Heptagon
                function addHepta(){ 
                $('.start-message').hide();
                var Hepta;
                    Hepta = new fabric.Polygon([
                    {x:50,y:0},
                    {x:90,y:20},
                    {x:100,y:60},
                    {x:75,y:100},
                    {x:25,y:100},
                    {x:0,y:60},
                    {x:10,y:20}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Hepta);
                canvas.sendToBack(Hepta);
                canvas.renderAll();
                save();
                shapesMap.set(Hepta.name,Hepta);
                console.log("shapesMap", shapesMap);
                }

                //Octagon
                function addOcta(){ 
                $('.start-message').hide();
                var Octa;
                    Octa = new fabric.Polygon([
                    {x:30,y:0},
                    {x:70,y:0},
                    {x:100,y:30},
                    {x:100,y:70},
                    {x:70,y:100},
                    {x:30,y:100},
                    {x:0,y:70},
                    {x:0,y:30}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Octa);
                canvas.sendToBack(Octa);
                canvas.renderAll();
                save();
                shapesMap.set(Octa.name,Octa);
                console.log("shapesMap", shapesMap);
                }

                //Nonagon
                function addNona(){ 
                $('.start-message').hide();
                var Nona;
                    Nona = new fabric.Polygon([
                    {x:50,y:0},
                    {x:83,y:12},
                    {x:100,y:43},
                    {x:94,y:78},
                    {x:68,y:100},
                    {x:32,y:100},
                    {x:6,y:78},
                    {x:0,y:43},
                    {x:17,y:12}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Nona);
                canvas.sendToBack(Nona);
                canvas.renderAll();
                save();
                shapesMap.set(Nona.name,Nona);
                console.log("shapesMap", shapesMap);
                }

                //Decagon
                function addDeca(){ 
                $('.start-message').hide();
                var Deca;
                    Deca = new fabric.Polygon([
                    {x:50,y:0},
                    {x:80,y:10},
                    {x:100,y:35},
                    {x:100,y:70},
                    {x:80,y:90},
                    {x:50,y:100},
                    {x:20,y:90},
                    {x:0,y:70},
                    {x:0,y:35},
                    {x:20,y:10}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Deca);
                canvas.sendToBack(Deca);
                canvas.renderAll();
                save();
                shapesMap.set(Deca.name,Deca);
                console.log("shapesMap", shapesMap);
                }

                //Bevel
                function addBevel(){ 
                $('.start-message').hide();
                var Bevel;
                    Bevel = new fabric.Polygon([
                    {x:20,y:0},
                    {x:80,y:0},
                    {x:100,y:20},
                    {x:100,y:80},
                    {x:80,y:100},
                    {x:20,y:100},
                    {x:0,y:80},
                    {x:0,y:20}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Bevel);
                canvas.sendToBack(Bevel);
                canvas.renderAll();
                save();
                shapesMap.set(Bevel.name,Bevel);
                console.log("shapesMap", shapesMap);
                }

                //Rabbet
                function addRabbet(){ 
                $('.start-message').hide();
                var Rabbet;
                    Rabbet = new fabric.Polygon([
                    {x:0,y:15},
                    {x:15,y:15},
                    {x:15,y:0},
                    {x:85,y:0},
                    {x:85,y:15},
                    {x:100,y:15},
                    {x:100,y:85},
                    {x:85,y:85},
                    {x:85,y:100},
                    {x:15,y:100},
                    {x:15,y:85},
                    {x:0,y:85}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Rabbet);
                canvas.sendToBack(Rabbet);
                canvas.renderAll();
                save();
                shapesMap.set(Rabbet.name,Rabbet);
                console.log("shapesMap", shapesMap);
                }

                //Point
                function addRtPoint(){ 
                $('.start-message').hide();
                var RtPoint;
                    RtPoint = new fabric.Polygon([
                    {x:0,y:0},
                    {x:75,y:0},
                    {x:100,y:50},
                    {x:75,y:100},
                    {x:0,y:100}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(RtPoint);
                canvas.sendToBack(RtPoint);
                canvas.renderAll();
                save();
                shapesMap.set(RtPoint.name,RtPoint);
                console.log("shapesMap", shapesMap);
                }

                //Chevron
                function addRtChev(){ 
                $('.start-message').hide();
                var RtChev;
                    RtChev = new fabric.Polygon([
                    {x:75,y:0},
                    {x:100,y:50},
                    {x:75,y:100},
                    {x:0,y:100},
                    {x:25,y:50},
                    {x:0,y:0}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(RtChev);
                canvas.sendToBack(RtChev);
                canvas.renderAll();
                save();
                shapesMap.set(RtChev.name,RtChev);
                console.log("shapesMap", shapesMap);
                }

                //Message
                function addMsg(){ 
                $('.start-message').hide();
                var Msg;
                    Msg = new fabric.Polygon([
                    {x:0,y:0},
                    {x:100,y:0},
                    {x:100,y:75},
                    {x:75,y:75},
                    {x:75,y:100},
                    {x:50,y:75},
                    {x:0,y:75}
                ], {
                    scaleX: 2, 
                    scaleY: 2,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 200,
                    height: 200,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false, 
                    name:"shape"+(shapesMap.size+1),    
      
                });
  
                canvas.add(Msg);
                canvas.sendToBack(Msg);
                canvas.renderAll();
                save();
                shapesMap.set(Msg.name,Msg);
                console.log("shapesMap", shapesMap);
                }

                canvas.on({
                'object:moving': onMoving,
                'object:scaling': onScaling,
                'object:rotating': onRotating,
                'mouse:down': onSelected,
                });


                let lastShapeSelected;
                let lastImgIntersected;

                //function to check if image intersects with shape and the image is in front of the shape
                function checkIntersectionWithShape(theImg){
                // if(theImg.globalCompositeOperation === 'source-atop') theImg.set({globalCompositeOperation:'source-over'});
                    for(const [key,val] of shapesMap.entries()){
                        if(theImg.intersectsWithObject(val)){
                        //if the image is in front of  a shape, set the image atop

                        theImg.set({globalCompositeOperation:'source-atop'});
                    // console.log("img pos: ",theImg.globalCompositeOperation);
                    // console.log("shape pos: ",val.globalCompositeOperation);
                        return true;
                         }
                    }
                return false;
                }

                //function to check if image intersects with shape and the image is at the back of the shape
                let theImgUnderShape;
                function checkIntersectionWithImg(theShape){
                    for(const [key,val] of imagesMap.entries()){
                        if(theShape.intersectsWithObject(val)){
                        //if the shape is in front of the image
                        //set the image as active object
                        canvas.setActiveObject(val);        
                        val.set({globalCompositeOperation:'source-atop'});
                        theImgUnderShape = val;
                        return true;
                        }else{
                        // console.log("not anymore");
                        // if(theImgUnderShape) theImgUnderShape.set({globalCompositeOperation:'source-over'});
                        }
                    }  
                return false;
                }

                //function to check if image intersects with text and the image is at the back of the text
                function checkIntersectionWithText(theTxt){
                // if(theImg.globalCompositeOperation === 'source-atop') theImg.set({globalCompositeOperation:'source-over'});
                    for(const [key,val] of imagesMap.entries()){
                        if(theTxt.intersectsWithObject(val)){
                        //if the image is in front of  a shape, set the image atop
                        canvas.bringToFront(theTxt);
                        // theTxt.set({globalCompositeOperation:'source-atop'});
                        // console.log("img pos: ",theImg.globalCompositeOperation);
                        // console.log("shape pos: ",val.globalCompositeOperation);
                        return true;
                        }
                    }
                return false;
                }

                //function to check if image intersects with shape and the image is at the back of the shape
                let theTextUnderImg;
                function checkIntersectionWithBackText(theImg){
                    for(const [key,val] of textMap.entries()){
                        if(theImg.intersectsWithObject(val)){
                        //if the shape is in front of the image    
                        canvas.bringToFront(val);
                        theTextUnderImg = val;
                        return true;
                        }else{
                        // console.log("not anymore");
                        // if(theImgUnderShape) theImgUnderShape.set({globalCompositeOperation:'source-over'});
                        }
                    }  
                return false;
                }

                //function to check if object is on scaling
                function onScaling(options){
                console.log("selected is scaling",options.target.name);
                }

                //function to check if the image is not in front of any shape
                var isIntersecting = false;
                var objSelected;
                function onMoving(options){
   
                // console.log("selected is moving",options.target.name);
                // console.log("obj: ",obj);
                // console.log("options.target: ", options.target);
                options.target.setCoords();

                    //if the current selected is an image
                    if(imagesMap.has(options.target.name)){
                        let temp = checkIntersectionWithShape(options.target);
                            //if the image is not in front of any shape
                            if(!temp) options.target.set({globalCompositeOperation:'source-over'});
                            console.log("image over shape? :",temp);
                            
                        let temp_1 = checkIntersectionWithBackText(options.target);
                            if(!temp_1){
                            console.log("text not in front of image");
                            if(theTextUnderImg){
                            canvas.bringToFront(theTextUnderImg);
                            }
                            }
                        console.log("text over image?:",temp_1);
                        }
                        
                    else if(shapesMap.has(options.target.name)){
                        let temp = checkIntersectionWithImg(options.target);
                            if(!temp){
                            console.log("shape not in front of image");
                            if(theImgUnderShape){
                            theImgUnderShape.set({globalCompositeOperation:'source-over'});
                            }
                            }
                        console.log("shape over image?:",temp);
                        }

                    //if the current selected is a text
                    else if(textMap.has(options.target.name)){
                        let temp = checkIntersectionWithText(options.target);
                            //if the image is not in front of any shape
                            if(!temp)  
                            console.log("selected", options.target.name);
                            console.log("text over image?:",temp);
                        }  
                }

                //function to check if object is on rotating
                function onRotating(options){
                console.log("selected is rotating",options.target.name);
                }

                canvas.on('selection:cleared', function() {
                console.log("nothing selected");
                // canvas.requestRenderAll();
                });

                //function to check if object is on selected
                function onSelected(options){
                    if(options.target){
                    console.log("selected", options.target.name);
                    objSelected = options.target;
                    }
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
                            // var tag = $.urlParam('tag');
                            var user_id = '{{Auth::user()->id}}';
                            var data = new FormData();
                            data.append('file', blob);
                            // data.append('tag', tag);
                            data.append('user_id', user_id);

                            $.ajax({
                                type: "POST",
                                url: url+'/api/save-careerprofile',
                                data: data,
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    // console.log(res);
                                    // alert('Collage Saved! Filename: '+res.filename);
                                    Swal.fire({
                                        title: '<span class="success">Success!</span>',
                                        text: 'Featured Image successfully saved!',
                                        imageUrl: '../../front/icons/alert-icon.png',
                                        imageWidth: 80,
                                        imageHeight: 80,
                                        imageAlt: 'Mbaye Logo',
                                        width: '30%',
                                        padding: '1rem',
                                        background: 'rgba(8, 64, 147, 0.62)'
                                    }).then((res) => {
                                      //  window.location.href = url+'/dashboard';
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