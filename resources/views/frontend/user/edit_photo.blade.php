@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <link href="{{ asset('front/CSS/croppie.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/CSS/edit-photo.css') }}" rel="stylesheet">
@endsection

@section('before-scripts')
    <script src="{{ asset('front/JS/jquery.min.js') }}"></script>
    <script src="{{ asset('front/JS/jquery.device.detector.js') }}"></script>
@endsection

@section('after-styles')
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <style>
        .lds-ellipsis div {
            background: #f3ca05;
        }
    </style>
@endsection

@section('content')


<div id="vanilla-demo" style="visibility: hidden"></div>


<div id="imgDiv">
    <img id="myImage" crossOrigin="Anonymous"
        src="{{ asset('storage/profilepicture/'.access()->user()->getOriginalProfilePicture()) }}" />

</div>



<div id="austronut-bg">
    <div>
        <img src="../../front/images/astronut/{{ access()->user()->getAstronautHalf() }}" height="100%" width="100%" />
        <div class="communicator-hover tooltips top" id="Communicator" style="">

        </div>
        <span class="communicator-span">Communicator</span>
    </div>
</div>


<div class="tooltips right cropper-tip">
    <span class="">Use mouse wheel to crop image.</span>
</div>


<!-- Auto Landscape -->
<div id="block_land">
    <div class="content">
        <h1 class="text-glow">Turn your device in landscape mode.</h1>
        <img src="{{ asset('front/images/rotate-screen.gif') }}" alt="">
    </div>
</div>



<!-- Crop Control Buttons -->
<main>
    <div class="box box-mobile">
        <div class="d-flex flex-column align-items-center" style="width:100%;height:100%">
            <div class="tooltips left tip-1 image-btn music-btn">
                <img src="../../front/images/astronut/musicBtn.png" class="music-btn image-btn" />
                <span class="">Music</span>
            </div>
            <div class="tooltips right tip-1 image-btn free-btn">
                <img src="../../front/images/astronut/freeBtn.png" class="image-btn free-btn" />
                <span class="">Free Button</span>
            </div>
            <div class="tooltips left tip-1 image-btn home-btn" id="HomePage">
                <img src="../../front/images/astronut/homeBtn.png" class="home-btn image-btn" id="Home Page" />
                <span class="">Home</span>
            </div>
            <div class="tooltips right tip-1 image-btn profile-btn" id="ProfilePage"><img
                    src="../../front/images/astronut/profileBtn.png" class="profile-btn image-btn" id="Profile Page" />
                <span class="">User Profile</span>
            </div>
            <div id="button-div">
                <!-- Save button -->
                <button class="btn-crop save-btn hide" type="button">Save</button>
                <!-- Crop btn -->
                <button class="btn-crop save hide crop-btn">Crop</button>
                <!-- Download btn -->
                <button class="btn-crop download download-btn hide">
                    Download
                </button>
                <!-- Reset btn -->
                <button class="btn-crop editbtn reset-btn hide">Reset</button>
            </div>
        </div>
    </div>

    <div class="tooltips right tip-1" id="instructions">
        <a href="{{ url('/instructions') }}">
            <img src="../../front/images/astronut/instructionsBtn.png" width="100%" style="pointer-events: all" />
            <span class="">Instructions</span>
        </a>
        </div>
    <button class="help-button" >
        <i class="far fa-question-circle"></i>
        
    </button>
</main>



{{-- Instructions Overlay --}}
<div class="instructions">
    <img class="instruction-close-btn" src="{{ asset('front') }}/images/close-btn.png" />
    <div class="instruction-1 instruction"></div>
    <div class=" instruction-text-1">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-2 instruction"></div>
    <div class="instruction-text instruction-text-2">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-3 instruction"></div>
    <div class="instruction-text instruction-text-3">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-4 instruction"></div>
    <div class="instruction-text instruction-text-4">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-5 instruction"></div>
    <div class="instruction-text instruction-text-5">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-6 instruction"></div>
    <div class="instruction-text instruction-text-6">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
    <div class="instruction-7 instruction"></div>
    <div class="instruction-text instruction-text-7">Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.</div>
</div>

@endsection

@section('after-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"
    integrity="sha256-u/CKfMqwJ0rXjD4EuR5J8VltmQMJ6X/UQYCFA4H9Wpk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"
    integrity="sha256-bQTfUf1lSu0N421HV2ITHiSjpZ6/5aS6mUNlojIGGWg=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{ asset('front/JS/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/JS/jquery-ui.js') }}"></script>
<script src="{{ asset('front/sweetalert/dist/sweetalert2.all.min.js') }}"></script>


<script>
    // Force Landscape orientation 
    $('body').removeClass('mbaye_body');
    $(window).load(function () {
        $("#vanilla-demo,#austronut-bg").delay(1000).animate({
            opacity: 1
        }, 1000);
    });

    testOrientation();
    window.addEventListener("orientationchange", function(event) {
        testOrientation();
    }, false); 

    window.addEventListener("resize", function(event) {
        testOrientation();
    }, false);

    
    function testOrientation() {
        document.getElementById('block_land').style.display = (screen.width > screen.height) ? 'none' : 'block';

        //above condition is not working sometimes then this condition will work
        if (window.innerHeight < window.innerWidth) {
            document.getElementById('block_land').style.display = 'none';
        } else {
            document.getElementById('block_land').style.display = 'block';
        }
    }

</script>




<script>
    // Fullscreen Function 
    var elem = document.documentElement;
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
    }
    else if (elem.requestFullscreen) {
        elem.requestFullscreen();
        contentDisplay();
    } 
    else contentDisplay();
    }


    // Opening fullscreen only on mobile screens
    function fullScreen(){
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || 
    /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)) ||
    (navigator.maxTouchPoints &&
    navigator.maxTouchPoints > 2 &&
    /Macintosh/.test(navigator.userAgent) )
    )
    {
        alert('It is Goning Here');
        Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        html: "<h5 id='f-screen' style='font:inherit; color:white !important'>Initializing fullscreen mode . . .</h5>",
                        padding: '15px',
                        confirmButtonColor:"red",
                        background: 'rgba(8, 64, 147, 0.62)',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.value) {
                            this.openFullscreen();
                        }
                    });
            }
            else  contentDisplay();
    }

    // fullScreen();
    
    


// Function called after page is in fullscreen on mobile and normally on pc screen  
    function contentDisplay() {
        $('#austronut-bg').css('display','flex');
        $('.box').css('display','flex');
        $('#instructions').css('display','flex');
        $('#vanilla-demo').css('visibility','visible');
        $('.cr-boundary').css('visibility','visible');
        this.showOverlay();
    }

// Instructions button on click
$('.help-button').click(()=>this.showOverlay())

// Instruction overlay hover effects
        function showOverlay() {
            $('.instructions').fadeIn();
            };

        $(".instruction-close-btn").click(function(){
            $('.instructions').fadeOut();
        })

        $('.instruction-1').hover(
            function() {
                $('.instruction-text-1').fadeIn();
            },
            function() {
                $('.instruction-text-1').fadeOut();
            }
        );

        $('.instruction-2').hover(
            function() {
                $('.instruction-text-2').fadeIn();
            },
            function() {
                $('.instruction-text-2').fadeOut();
            }
        );
        $('.instruction-2').hover(
            function() {
                $('.instruction-text-2').fadeIn();
            },
            function() {
                $('.instruction-text-2').fadeOut();
            }
        );
        $('.instruction-3').hover(
            function() {
                $('.instruction-text-3').fadeIn();
            },
            function() {
                $('.instruction-text-3').fadeOut();
            }
        );
        $('.instruction-4').hover(
            function() {
                $('.instruction-text-4').fadeIn();
            },
            function() {
                $('.instruction-text-4').fadeOut();
            }
        );
        $('.instruction-5').hover(
            function() {
                $('.instruction-text-5').fadeIn();
            },
            function() {
                $('.instruction-text-5').fadeOut();
            }
        );

        $('.instruction-6').hover(
            function() {
                $('.instruction-text-6').fadeIn();
            },
            function() {
                $('.instruction-text-6').fadeOut();
            }
        );

        $('.instruction-7').hover(
            function() {
                $('.instruction-text-7').fadeIn();
            },
            function() {
                $('.instruction-text-7').fadeOut();
            }
        );
        var w = window.innerWidth;
        var h = window.innerHeight;
        if(h <= 768 && w<=1024)
        {
            $('.communicator-span').css('display', 'inline');
        }
        else
        {
            // communicator hover
            $('.communicator-hover,.thomasina').mouseenter(()=>{
                $('.communicator-span').css('display', 'inline');
            });


            $('.communicator-hover,.thomasina').mouseleave(()=>{
                $('.communicator-span').css('display', 'none')
            })
        }
// leave page Button Alert
$('.home-btn,.profile-btn,.communicator-hover,.communicator-span').click (() => {
    let id = event.target.id;
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: `<h4 style="font:inherit; color:white !important">You will be redirected to ${id}.</h4><span style="font-size:0.9vw;color:white">[All unsaved changes will be lost]</span>`,
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            showCancelButton: true,
            confirmButtonColor: 'auto',
            cancelButtonColor: 'red',
            confirmButtonText: 'Yes, Redirect!'
        }).then((result) => {
            if (result.value) {
                if(id==="Home Page"){
                location.href = "{{ url('/') }}";
                }
                else if (id==="Profile Page") location.href = "{{ url('/dashboard') }}";

                else location.href = "{{ url('/communicator') }}";
            }
            })
        });

        $('.communicator-span span').click (() => {
            let id = event.target.id;
            Swal.fire({
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                html: `<h4 style="font:inherit; color:white !important">You will be redirected to ${id}.</h4><span style="font-size:0.9vw;color:white">[All unsaved changes will be lost]</span>`,
                padding: '30px',
                background: 'rgba(8, 64, 147, 0.62)',
                showCancelButton: true,
                showCancelButton: true,
                confirmButtonColor: 'auto',
                cancelButtonColor: 'red',
                confirmButtonText: 'Yes, Redirect!'
            }).then((result) => {
                if (result.value) {
                    if(id==="Home Page"){
                    location.href = "{{ url('/') }}";
                    }
                    else if (id==="Profile Page") location.href = "{{ url('/dashboard') }}";

                    else location.href = "{{ url('/communicator') }}";
                }
                })
            });

    // Crop Button Alert
    $(".crop-btn").click(() => {
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: '<h4 style="font:inherit; color:white !important">Are you sure you want to crop the photo?</h4>',
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            showCancelButton: true,
            confirmButtonColor: 'auto',
            cancelButtonColor: 'red',
            confirmButtonText: 'Yes, crop it!'
        }).then((result) => {
            if (result.value) {
                vanilla.result({
                type: 'canvas',
                size: "viewport"
            })
            .then(response => {
                $('.save-btn').attr('disabled', false);
                $('.save-btn').removeClass('disabled-btn');
                $('.download-btn').attr('disabled', false);
                $('.download-btn').removeClass('disabled-btn');
                $('#imgDiv').css('display', 'flex');
                $('#myImage').attr('src', response);
                $('download-cropped').attr('href', response);
                $('#vanilla-demo').css('visibility', 'hidden');
                $('.crop-btn').attr('disabled', 'dsiabled');
                $('.crop-btn').addClass('disabled-btn');
            });
            }
            else return
        });
    });

    // Crop Image Download Function
$('.download-btn').click(()=>{
    Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: '<h4 style="font:inherit; color:white">Do you really want to download the photo?</h4>',
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: 'red',
            confirmButtonText: 'Download Photo',
        }).then(response=>{
            if(response.value){
                downloadCropped();
            }
        })
});

    downloadCropped = () => {
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: '<h4 style="font:inherit; color:white">Your File Has been downloaded successfully!</h4>',
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: false,
            showConfirmButton: false,
            position:'top-right',
            timer:3000
        });
            var a = document.createElement("a"); //Create <a>
                a.href = $('#myImage').attr('src'); //Image Base64 Goes here
                a.download = "cropped.png"; //File name Here
                a.click(); //Downloaded file
    }

    // Reset Button
    $(".reset-btn").click(() => {
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: '<h4 style="font:inherit; color:white !important">Are you sure you want to reset your changes?</h4>',
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            showCancelButton: true,
            confirmButtonColor: 'auto',
            cancelButtonColor: 'red',
            confirmButtonText: 'Yes, reset!'
        }).then((result) => {
            if (result.value) {
                $('.save-btn').attr('disabled', 'dsiabled');
                $('.save-btn').addClass('disabled-btn');
                $('.download-btn').attr('disabled', 'dsiabled');
                $('.download-btn').addClass('disabled-btn');
                $('#vanilla-demo').css('visibility', 'visible');
                $('#imgDiv').css('display', 'none');
                $('.crop-btn').attr('disabled', false);
                $('.crop-btn').removeClass('disabled-btn');
            }
        });
        $('.swal2-cancel').css('display', 'block');
    });

    // Save and Exit button
    $(".save-btn").click(() => {
        $('.save-btn').attr('disabled','disabled');
        $('.save-btn').addClass('disabled-btn');
        $('.download').addClass('disabled-btn');
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            html: '<h4 style="font:inherit; color:white">Are you sure you want to save the changes?</h4>',
            padding: '30px',
            background: 'rgba(8, 64, 147, 0.62)',
            showCancelButton: true,
            showCancelButton: true,
            confirmButtonColor: 'auto',
            cancelButtonColor: 'red',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.value) {
                this.save()
            }
        });
    });

    // Save Croped Image AJAX Request
    save = () => {
        let str_cropped_img = $('#myImage').attr('src');
        let int_User_Id = "{{ Auth::user()->id }}";
        let csrf = window.Laravel.csrfToken;
        $.ajax({
            type: "POST",
            url: "{{ url('/profile/save-cropped-photo') }}",
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            data: "str_cropped_img=" + str_cropped_img + "&int_User_Id=" + int_User_Id + "&csrf-token",
            dataType: "json"
        }).done(function (data) {
            if (data.status == 'success') {
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    html: `<h4 style="font:inherit; color:white">${data.message}</h4>`,
                    padding: '30px',
                    background: 'rgba(8, 64, 147, 0.62)',
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: "red",
                    timer:3000
                }).then((response)=>{
                    if(response.value){
                        location.href = "{{ url('/dashboard') }}"
                    }
                })
            } else {
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: "<span id='error'>Error!</span>",
                    html: "There was an Error While Processing your Request.",
                    // width: '30%',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });
                setTimeout(() => location.reload(true), 1000);
            }
        });
    }






// Disable save and downlaod buttons at start
    $('.save-btn').attr('disabled', 'dsiabled');
    $('.save-btn').addClass('disabled-btn');
    $('.download-btn').attr('disabled', 'dsiabled');
    $('.download-btn').addClass('disabled-btn');
    $('#vanilla-demo').css('visibility', 'visible');
    $('#imgDiv').css('display', 'none');








    // Cropper Initialization 
    var src =
        "{{ asset('storage/profilepicture/'.access()->user()->getOriginalProfilePicture()) }}";
    var vanilla = new Croppie(document.getElementById('vanilla-demo'), {
        viewport: {
            width: "26.5vw",
            height: "37.5vh",
            type: 'square'
        },
        boundary: {
            width: "50vw",
            height: "72.2vh"
        },
        showZoom: true,
        showZoomer: false
    });

    vanilla.bind({
        url: src
    })



// cropper hover
 $('.cr-boundary').mouseenter(()=>{
     $('.cropper-tip span').css('display', 'inline');
    //  $('.cropper-tip span').css('width', '11vw');
     $('.cropper-tip span').css('padding', '10px');
 });
 $('.cr-boundary').mouseleave(()=>{
    $('.cropper-tip span').css('display', 'none')
 })



// Thomasina Astronaut class switch
 if($('#austronut-bg img').attr('src').includes('Thomasina')){

     $('.communicator-hover.tooltips.top').addClass('thomasina');
     $('.tooltips.top.thomasina').removeClass('communicator-hover');
    
     }
</script>
@endsection