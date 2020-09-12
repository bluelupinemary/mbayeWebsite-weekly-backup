@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>
    </style>

   
@endsection

@section('after-styles')
    @trixassets
    <link rel="stylesheet" type="text/css" href="{{asset('front/CSS/company-profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate-3.7.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
    <!-- <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile.css')}}">
@endsection

@section('content')
<div id="page-content">
    
        <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
                              
         



                                            
              <div class="modal" id="AboutMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">About Me</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="app" style="display: none;">
                      
                    </div>
                    <div class="modal-body">
                        <div class="aboutme-body">
                            <fieldset>
                                <form action="" id="aboutme-form">
                                   
                                       

                                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                     Add Current Address
                                      </button>
                                    <br>  <br>
                                      <div class="collapse" id="collapseExample">
                                            <div class="form-group input-group-sm ">
                                                <label for="country">Present Country</label>
                                                <select class="countries" name="country" id="countryId" required>&#x25BC;
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm">
                                                <label for="state">Present State</label>
                                                <select id="stateId" class="states" name="state" required>
                                                    <option value="">Select State</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm">
                                                <label for="city">Present City</label>
                                                <select id="cityId" class="cities" name="city" required>
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group-sm">
                                                <label for="pAddress">Present Address</label>
                                                <input type="text" class="form-control" id="pAddress" >
                                            </div>
                                      </div>
                                     
                                      
                                      
                                     
                                </form>
                            </fieldset>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                      <button type="button" class="btn btn-primary aboutme-done">Done</button>
                    </div>
                  </div>
                </div>
              </div>
                                                
    
</div>
@endsection
@section('after-scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
{{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/jquery-ui.js')}}"></script>
<script src="{{asset('front/JS/popper.min.js')}}"></script>

<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
<script src="{{asset('front/system-google-font-picker/jquery.fontselect.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>

<script type="text/javascript">

    
    var url = $('meta[name="url"]').attr('content');
    var ClickCount=0;

    (function () {
    
        $(".img-nouvela").removeClass("ani-rollout_naff");
          // for showing message to turn to landscape 
          testOrientation();
          window.addEventListener("orientationchange", function(event) {
          testOrientation();
        }, false);

        window.addEventListener("resize", function(event) {
        testOrientation();
        }, false);

        function testOrientation() 
        {
            document.getElementById('block_land').style.display = (screen.width>screen.height) ? 'none' : 'block';
            //above condition is not working sometimes then this condition will work
            if(window.innerHeight< window.innerWidth)
                {
                    document.getElementById('block_land').style.display = 'none' ;
                }
                else{
                    document.getElementById('block_land').style.display =  'block';
                }
        }

        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .overlay").css({'display':'none'});   
            $("#clicked_img .div_title").css({'display':'none'});   
            $("#clicked_img .div_btn").css({'display':'none'});
            $(".div_overlay").removeClass("div_overlay_p");
            $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'unset','left':'0'});
            $(".blog-buttons_overlay .button-div").css({'flex-direction':'unset'});
            $('div.cell').removeAttr('id');
            $(this).attr('id','clicked_img');
            var clicked_img_id = $(this).attr('id');
            var img = $("#clicked_img> a>img");
            var pos = $("#clicked_img> a>img").position();
            var  top=$("#clicked_img> a>img").css("top");
            var  left=$("#clicked_img> a>img").css("left");
            var  width=$("#clicked_img> a>img").css("width");
            var  height=$("#clicked_img> a>img" ).css("height");
         
            $("#clicked_img .overlay").css({'display':'flex'});
            $("#clicked_img .div_title").css({'display':'block'});
            $("#clicked_img .div_btn").css({'display':'block'});

           /* for checking orientation of an image*/

            if (img.width() > img.height()){
                var differernce=img.width() -img.height();
            }

         if (img.width() > img.height()){
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
              $(".blog-buttons_overlay").css({'top':'50%','left':'50%','width':'82%','transform':'translate(-49%, -67%)'});
           
            } 
            else {
              $(".div_overlay").addClass("div_overlay_p");
              $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'column','top':'50%','left':'50%','width':'82%','transform':'translate(-29%, -67%)'});
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
            } 
   
});

    })();

    
   
   

    </script>

@endsection
