@extends('frontend.layouts.app')

@section('before-styles')
<link rel="stylesheet" href="{{ asset('front/CSS/terms_and_conditions_style.css') }}">
@endsection

@section('content')
<div id="block_land">
  <div class="content">
      <h1 class="text-glow">Turn your device in landscape mode.</h1>
      <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
  </div>
</div>

  <section class="container">
    <div class=" div_container">
      <br>
      <h2 class="col_white">  PRIVACY POLICY</h2>
      <br>
      <p class="col_white">
        Pursuant to our Terms of Use, this document describes how we treat personal information related to your use of this website and the services offered on and through it, including information you provide when using it.
We expressly and strictly limit use of the Website to adults over 18 years of age or the age of majority in the individual's jurisdiction, whichever is greater. Minors should be guided by sponsors and data for the website should be provided by them.
We do not knowingly seek or collect any personal information or data from persons who have not attained this age.

      </p>
      <br>
      <h4 class="col_white"> Data Collected</h4>
      <p class="col_white">
      <b>  Using the Service.</b> When you access the Website, use the search function to view files. Your IP address, country of origin and other non-personal information about your computer or device (such as web requests, browser type, browser language, referring URL, operating system and date and time of requests) may be recorded for log file information, aggregated traffic information and in the event that there is any misappropriation of information and/or content.
      </p>
      <br>
      <p class="col_white">
        <b>Usage Information.</b> We may record information about your usage of the Website such as your search terms, the content you access and download and other statistics.
      </p>
      <br>
      <p class="col_white">
        <b>Uploaded Content.</b> Any content that you upload, access or transmit through the Website may be collected by us.
      </p>
      <br>
      <p class="col_white">
       <b> Correspondences.</b> We may keep a record of any correspondence between you and us.
      </p>
      <br>
      <p class="col_white">
      <b>Cookies. </b>When you use the Website, we may send cookies to your computer to uniquely identify your browser session. We may use both session cookies and persistent cookies.
      </p>
      <br>
      <h4 class="col_white">Data Usage</h4>


      <p class="col_white">
        We may use your information to provide you with certain features and to create a personalized experience on the website. We may also use that information to operate, maintain and improve features and functionality of the Website.
We use cookies, web beacons and other information to store information so that you will not have to re-enter it on future visits, provide personalized content and information, monitor the effectiveness of the Website and monitor aggregate metrics such as the number of visitors and page views (including for use in monitoring visitors from affiliates). They may also be used to provide targeted advertising based on your country of origin and other personal information.
We may aggregate your personal information with personal information of other members and users, and disclose such information to advertisers and other third-parties for marketing and promotional purposes.
We may use your information to run promotions, contests, surveys and other features and events.

      </p>

      <br>
      <h4 class="col_white">Disclosures of Information</h4>
      <p class="col_white">
        We may be required to release certain data to comply with legal obligations or in order to enforce our Terms of Use and other agreements. We may also release certain data to protect the rights, property or safety of us, our users and others. This includes providing information to other companies or organizations like the police or governmental authorities for the purposes of protection against or prosecution of any illegal activity, whether or not it is identified in the Terms of Use.
        If you upload, access or transmit any illegal or unauthorized material to or through the Website, or you are suspected of doing such, we may forward all available information to relevant authorities, including respective copyright owners, without any notice to you.
        
      </p>
      <br>

      <h4 class="col_white">Miscellaneous</h4>
      <p class="col_white">
        While we use commercially reasonable physical, managerial and technical safeguards to secure your information, the transmission of information via the Internet is not completely secure and we cannot ensure or warrant the security of any information or content you transmit to us. Any information or content you transmit to us is done at your own risk.
      </p>
      <br>

  

<div id="footer">
 <a href="{{url('/copyright_claims')}}">Copyright Claims</a><a href="{{url('/privacy_policy')}}">Privacy Policy</a><a href="{{url('/special_rightholders_accounts')}}">SRA</a><a href="{{url('/terms_and_agreement')}}">ToS</a>
 </div>
 </div>
  </section>
@endsection

@section('after-scripts')
  <script>
      // for showing message to turn to landscape 
      testOrientation();
      window.addEventListener("orientationchange", function(event) {    
      testOrientation();
      }, false);

    window.addEventListener("resize", function(event) {
        testOrientation();
    }, false);

    function testOrientation() {
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
   

  $(document).ready(function () {
     
});
	

  </script>
@endsection
