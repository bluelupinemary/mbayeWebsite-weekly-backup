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
      <h2 class="col_white">  COPYRIGHT CLAIMS</h2>
      <br>

  <ol type="a">
    <li>
     We respect the intellectual property rights of others. You may not infringe the copyright, trademark or other proprietary informational rights of any party. We may in our sole discretion remove any Content we have reason to believe violates any of the intellectual property rights of others and may terminate your use of the Website if you submit any such Content.
    </li>
 <br>
    <li>
     <b>REPEAT INFRINGER POLICY. AS PART OF OUR REPEAT-INFRINGEMENT POLICY, ANY USER FOR WHOSE MATERIAL WE RECEIVE THREE GOOD-FAITH AND EFFECTIVE COMPLAINTS WITHIN ANY CONTIGUOUS SIX-MONTH PERIOD WILL HAVE HIS GRANT OF USE OF THE WEBSITE TERMINATED.</b>
    </li>
    <br>
    <li>
     Although we are not subject to United States law, we voluntarily comply with the Digital Millennium Copyright Act. Pursuant to Title 17, Section 512(c)(2) of the United States Code, if you believe that any of your copyrighted material is being infringed on the Website, we have designated an agent to receive notifications of claimed copyright infringement. Notifications should be e-mailed to info@inoxarabia.com or sent to:
    <br>
     <p class="col_white" style="text-align:center">
      Copyright Agent<br>
Inox Arabia<br>
22 nd street<br>
Al Qouz Industrial Area 3<br>
Green Warehouse No 2<br>
Dubai<br>
United Arab Emirates<br>

    </p>

    </li>
    <br>


    <li>
      All notifications not relevant to us or ineffective under the law will receive no response or action thereupon. An effective notification of claimed infringement must be a written communication to our agent that includes substantially the following:
      <ol type="i">
        <li>
         Identification of the copyrighted work that is believed to be infringed. Please describe the work and, where possible, include a copy or the location (e.g., a URL) of an authorized version of the work;
        </li>
        <br>
        <li>
          Identification of the material that is believed to be infringing and its location or, for search results, identification of the reference or link to material or activity claimed to be infringing. Please describe the material and provide a URL or any other pertinent information that will allow us to locate the material on the Website or on the Internet;
        </li>
        <br>
        <li>
           Information that will allow us to contact you, including your address, telephone number and, if available, your e-mail address;
        </li>
         <br>
         <li>
           A statement that you have a good faith belief that the use of the material complained of is not authorized by you, your agent or the law;
         </li>
         <br>
         <li>
          	A statement that the information in the notification is accurate and that under penalty of perjury that you are the owner or are authorized to act on behalf of the owner of the work that is allegedly infringed; and
         </li>
         <br>
         <li>
          A physical or electronic signature from the copyright holder or an authorized representative.
         </li>
         <br>

     </ol>
     <br>


  <li>
    If your User Submission or a search result to your website is removed pursuant to a notification of claimed copyright infringement, you may provide us with a counter-notification, which must be a written communication to our above listed agent and satisfactory to us that includes substantially the following:
   <br>
    <ol type="i">
      <li>Your physical or electronic signature;      </li>
      <br>
     <li>
      Identification of the material that has been removed or to which access has been disabled and the location at which the material appeared before it was removed or access to it was disabled;
     </li>
     <br>

     <li>
      A statement under penalty of perjury that you have a good faith belief that the material was removed or disabled as a result of mistake or misidentification of the material to be removed or disabled;
     </li>
     <br>

     <li>
    	Your name, address, telephone number, email address and a statement that you consent to the jurisdiction of the courts in the address you provided, Anguilla, and the location(s) in which the purported copyright owner is located; and
     </li>
     <br>

     <li>
     A statement that you will accept service of process from the purported    copyright owner or its agent.
     </li>
     <br>

<br>

  </li>
  </ol>

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
