@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <link href="{{asset('front/CSS/cropper.min.css')}}" rel="stylesheet">
    <style>
        body {
            background-image: url('../../front/images/skybox_bg1.png');
            height: 99vh;
            width: 100vw;
            overflow:hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-attachment: fixed;
        }

        .editing-div {
            width:100%;
            text-align: center;
            opacity: 0;
        }

        /* Astronaut & Cropper div */
        .astronaut-img-div {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center bottom;
            margin: auto;
            display: block;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 100vh;
        }
        
        /* Cropper div */
        .user-img-div{
            position: absolute;
            left: 49%;
            transform: translate(-49%, 0);
            height: 145%;
            display: block;
            margin: auto;
            min-width: 330px;
            width: auto;
        }

        .box-2 {
            position: relative;
            top: 13.5%;
            left: -1%;
            width: 100%;
            height: 60%;
            display: block;
            margin: auto;
        }

        .cropped {
            height: 45%;
            margin: 0 auto;
        }
    
        .cropper-crop-box, .cropper-view-box, .cropper-container,.cropper-wrap-box, .cropper-drag-box, .cropped{
            border-radius: 33% 33% 30% 30%;
    
        }

        .cropper-crop-box {
            width: auto !important;
            height: auto !important;
        }
    
        .cropper-view-box {
            box-shadow: 0 0 0 1px #39f;
            outline: 0;
        }

        .box-2.img-result {
            left: -1%;
        }
    
        #cropperbox {
          max-width: 100%;
            height: 45%;
            width: 100%;
            margin: 0 auto;
        }

        #userphotosrc {
            position: absolute;
            height:100%;
        }
    
        /* Cropper buttons div */
        .page {
            margin: 0 auto;
            max-width: 768px;
            width: 100%;
            height: 136px;
            position: absolute;
            bottom: 26px;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        /* Cropper buttons position */
        .box .btn {
            cursor: pointer;
            margin-left: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 1em;
            font-family: 'Space Age';
            text-decoration: none;
            color: #fff;
            &: visited {
            color: #5ea97d;
            }
            height: 65px;
            line-height: 48px;
            padding: 0 1.5rem;;
            display: inline-block;
            width: auto;
            background: linear-gradient(0deg, rgba(45,124,20,1) 0%, rgba(0,0,0,1) 50%, rgba(45,124,20,1) 100%);
            border-radius: 5px;
            border: 0px;
            -webkit-transition: all 0.06s ease-out;
            transition: all 0.06s ease-out;
            position: relative;
        }
        
        .box .btn:disabled {
            cursor: no-drop;
            color: #7e7e7e;
            background: linear-gradient(0deg, rgba(45,124,20,1) 0%, rgba(0,0,0,1) 50%, rgba(45,124,20,1) 100%);
            opacity: 1;
        }
        
        .box .btn:hover:not([disabled]) {
            color: #5ea97d;
        }
        
        .box .btn:active {
            top: 6px;
            text-shadow: 0 -2px 0 #7fbb98, 0 1px 1px #c2dece, 0 0 4px white;
            color: white;
            &:before {
            top:0;
            box-shadow: 0 3px 3px rgba(0,0,0,.7),0 3px 9px rgba(0,0,0,.2);
        
            }
        }
        
        .box .btn:before {
            display: inline-block;
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            z-index: -1;
            top: 6px;
            border-radius: 5px;
            height: 49px;
            background: linear-gradient(to top, #183b0d 0%, #183b0d 6px);
            -webkit-transition: all 0.078s ease-out;
            transition: all 0.078s ease-out;
            box-shadow: 0 1px 0 2px rgba(0, 0, 0, 0.3), 0 5px 2.4px rgba(0, 0, 0, 0.5), 0 10.8px 9px rgba(0, 0, 0, 0.2);
        }

        /* .save_photo {
            position: absolute;
            top: 25%;
            left: 22%;
        }

        .save {
            position: absolute;
            top: 25%;
            right: 215px;
        }

        .download {
            position: absolute;
            top: 78%;
            left: -66px;
            transform: rotate3d(0, -1, 1, -73deg);
        }

        .editbtn {
            position: absolute;
            right: 0;
            top: 78%;
        } */
    
        .options label,
        .options input {
            width:4em;
            padding:0.5em 1em;
        }
    
        .hide {
            display: none;
        }
    
        img {
            max-width: 100%;
            height: 100%;
        }
        
        #astroimg {
            position: absolute;
            left: 50%;
            transform: translate(-50%, 0);
            width: auto;
            min-width: 600px;
        }
    
        /* Page Loader */
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            /* background: url('../../front/images/skybox_bg1-1.jpg') center no-repeat #fff; */
            background: #fff0;
        }

        /* Modal */
        .modal-backdrop {
            background-color: #05050580 !important;
        }
    </style>
@endsection

@section('after-styles')
    <style>
        .lds-ellipsis div {
            background: #f3ca05;
        }
    </style>
@endsection

@section('content')
    <!-- Page Loader -->
    <div class="se-pre-con hide">
        <div class="page-loader">
            <p>Loading</p>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>

    <!-- Auto Landscape -->
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front/images/rotate-screen.gif')}}" alt="">
        </div>
    </div>

    <!-- Main Div -->
    <div class="editing-div">
        <!-- Cropper Buttons -->
        <main class="page">
            <!-- input file -->
            <div class="box">
                <input type="file" id="file-input" style="visibility: hidden">
            </div>
            
            <div class="box">
                <div class="options hide">  
                    <label style="visibility: hidden"> Width</label>
                    <input type="hidden" class="img-w" value="300" min="100" max="1200" />
                </div>
                <!-- Save button -->
                <button class="btn save_photo hide">Save & Exit</button>
                <!-- Crop btn -->
                <button class="btn save hide btn-primary">Crop</button>
                <!-- Download btn -->
                <button class="btn download hide">Download</button>
                <!-- Reset btn -->
                <button class="btn editbtn hide" onClick="window.location.reload()">Reset</button>
            </div>
        </main>

        <!-- Astronaut & Cropper div -->
        <div class="astronaut-img-div" style="background-image: url('../../front/images/astronut/{{access()->user()->getAstronautHalf()}}')">
            <div class="user-img-div">           
                <!--box for the cropped image-->
                <div class="box-2 img-result hide">
                    <!-- result of crop -->
                    <img class="cropped" src="" alt="cropped user img">
                </div>
                <!--box for the cropping box-->
                <div class="box-2">
                    <div id="cropperbox" class="result" >
                        {{-- src img_photo --}}
                        <img id="userphotosrc"  src="{{asset('storage/profilepicture/'.access()->user()->getOriginalProfilePicture())}}">
                    </div>
                </div>
            </div> <!--end of user img div-->
        </div> <!--end of astronaut img div-->
    </div> <!--end of editing div-->
    <div id="app">

    </div>
    {{-- Save and Exit Modal --}}
    <div class="modal" id="saveAndExitModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Save Changes?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Save Changes?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/JS/Draggable.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/JS/cropper.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

    <script>
        $( document ).ready(function() {
            loadUserPhoto();
        });

        // Delay astronaut div display
        $(window).load(function() {
            $(".editing-div").delay(1000).animate({opacity:1},1000);
        });

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
            document.getElementById('block_land').style.display = (width> 	height) ? 'none' : 'block';
        }
    </script>

    <!-- Cropper JS -->
    <script>
        let result = document.querySelector('.result'),
        img_result = document.querySelector('.img-result'),
        img_w = document.querySelector('.img-w'),
        img_h = document.querySelector('.img-h'),
        options = document.querySelector('.options'),
        save = document.querySelector('.save'),
        cropped = document.querySelector('.cropped'),
        dwn = document.querySelector('.download'),
        editbtn = document.querySelector('.editbtn'),
        upload = document.querySelector('#file-input'),
        save_photo = document.querySelector('.save_photo'),
        cropper = '';

        // disable save and download buttons when image is not yet cropped
        $('.save_photo').attr('disabled', 'disabled');
        $('.download').attr('disabled', 'disabled');

        // Crop button
        save.addEventListener('click',(e)=>{
            e.preventDefault();

            // get result to data uri
            let imgSrc = cropper.getCroppedCanvas({
                width: img_w.value // input value
            }).toDataURL();

            // remove hide class of img
            cropped.classList.remove('hide');
            img_result.classList.remove('hide');
              
            // show image cropped
            cropped.src = imgSrc;
            dwn.classList.remove('hide');
            dwn.download = 'imagename.png';
            dwn.setAttribute('href',imgSrc);
            editbtn.classList.remove('hide');
            save_photo.classList.remove('hide');
            var box = document.getElementById("cropperbox");
            box.style.visibility = "hidden";
            $('.save_photo').attr('disabled', false);
            $('.download').attr('disabled', false);
        });
          
        // Save and Exit button
        $('.save_photo').click(function() {
            var str_cropped_img=  $('.cropped').attr('src');
            var int_User_Id = "{{Auth::user()->id}}";
            $.ajax({  
                type: "POST",  
                url: "{{url('/profile/save-cropped-photo')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "str_cropped_img="+str_cropped_img+"&int_User_Id="+int_User_Id+"&csrf-token",
                dataType: "json"
            }).done(function(data) {
                alert(data.message);
                if(data.status == 'success') {
                    location.href = "{{url('/dashboard')}}";
                } else {
                    location.reload(true);
                }
            });
        });  
      
        function loadUserPhoto() {
            let img = document.getElementById("userphotosrc"); 
            save.classList.remove('hide');
            options.classList.remove('hide');

            // init cropper
            cropper = new Cropper(img, {
                viewMode: 3,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                modal: false,
                guides: true,
                highlight: true,
                cropBoxMovable: true,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false
            });
        }
    </script>
@endsection
