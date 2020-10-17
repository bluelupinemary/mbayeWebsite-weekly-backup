<meta name="url" content="{{ url('') }}">
@extends('frontend.layouts.profile_layout')
@section('before-styles')
<style>
</style>
@endsection

   

@section('after-styles')
<link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/terms.css') }}">
@endsection

@section('content')
{{-- <div id="block_land">
  <div class="content">
      <h1 class="text-glow">Turn your device in landscape mode.</h1>
      <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
  </div>
</div> --}}
<div class="app">
</div>
<div id="page-content" class="page">
    <div class="communicator">
        <div class="main-screen">
            <div class="astronautarm-img">
                <div class="main-form form_content">
                   
                       <button type="button" class="fullscreen" Title="Full screen">
                               <i  class="fas fa-expand" Title="Full screen"></i>
                          
                        </button>
                  

                    <div class="home-div">
                      <input type="hidden" id="myurl" url="{{url('/dashboard')}}" />
                      <img src="{{asset('front/images/communicator-buttons/buttons/homeBtn.png')}}" class="communicator-button back-button" alt="">
                    </div>
                    <div class="back-div">
                      <input type="hidden" id="myurl" url="{{url('/login')}}" />
                      <img src="{{asset('front/images/communicator-buttons/buttons/backBtn.png')}}" class="communicator-button back-button" alt="">
                  </div>
             
                    <div class="tos-div">
                      <img src="{{asset('front/images/communicator-buttons/buttons/termsBtn.png')}}" class="communicator-button terms-button" alt="">
                    </div>


                
                  <div class="full_form">   
                        <div class="head-div">
                          <p class="title">TERMS OF SERVICES</p>
                        </div>
                        <div class="terms_form">
                            <!--terms of services-->
                            <div class="terms_and_conditions">
                                                                                
                                                <!--<h2 class="col_white">  TERMS OF SERVICE AGREEMENT</h2>-->
                                                <h5 class="col_white">LAST REVISION: [14-03-2020]</h5>
                                              
                                                <p class="col_white">
                                                  PLEASE READ THESE TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  These Terms of Service Agreement (the "Agreement") governs your use of this website, www.Mbaye.com (the "Website. This Agreement includes,
                                                  and incorporates by this reference, the policies and guidelines referenced below. Inox Arabia FZC and associated companies reserve the right
                                                    to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on this Website.
                                                    Inox Arabia FZC and associated companies will alert you that changes or revisions have been made by indicating on the top of this Agreement the date it was last revised.
                                                      The changed or revised Agreement will be effective immediately after it is posted on this Website. Your use of the Website following the 
                                                      posting any such changes or of a revised Agreement will constitute your acceptance of any such changes or revisions. Inox Arabia FZC and associated companies 
                                                      encourage   you to review this Agreement whenever you visit the Website to make sure that you understand the terms and conditions governing use of the Website.
                                                        This Agreement does not alter in any way the terms or conditions of any other written agreement you may have with Inox Arabia FZC and associated companies
                                                        for other products or services. If you do not agree to this Agreement (including any referenced policies or guidelines), please immediately terminate 
                                                        your use of the Website. If you would like to print this Agreement, please click the print button on your browser toolbar.
                                                </p>
                                                <br>
                                              
                                              <h3 class="col_white">I. WEBSITE</h3>
                                              
                                              <p class="col_white">
                                              <b>Content; Intellectual Property; Third Party Links.</b>
                                              In addition to making Products available, this Website also offers information and allows you to play game. This Website also offers information,
                                                both directly and through indirect links to third-party websites. Mbaye.com does not always create the information offered on this Website; 
                                                instead the information is often gathered from other sources. To the extent that Inox Arabia FZC and associated companies do create the content on this Website,
                                                such content is protected by intellectual property laws of the foreign nations, and international bodies. Unauthorized use of the material 
                                                may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, noncommercial use.
                                                  Any links to third-party websites are provided solely as a convenience to you. Inox Arabia FZC and associated companies do not endorse the contents on any such
                                                  third-party websites. Inox Arabia FZC and associated companies are not responsible for the content of or any damage that may result from your access to or reliance 
                                                  on these third-party websites. If you link to third-party websites, you do so at your own risk. 
                                              </p>
                                              
                                              <br>
                                              <p class="col_white">
                                                <b>Use of Website;</b>
                                                Inox Arabia FZC and associated companies are not responsible for any damages resulting from use of this website by anyone. You will not use the Website for illegal purposes. You will
                                                <ul>
                                                  <li>
                                                      Abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws regarding 
                                                      intellectual property)
                                                  </li>
                                                  <li>    Not interfere with or disrupt the use and enjoyment of the Website by other users
                                                  </li>
                                                  <li>
                                                    Not resell material on the Website
                                                  </li>
                                                  <li>
                                                    Not engage, directly or indirectly, in transmission of "spam", chain letters, junk mail or any other type of unsolicited communication, and 
                                                  </li>
                                                  <li>Not defame, harass, abuse, or disrupt other users of the Website.
                                                  </li>
                                                  </ul>
                                              </p>
                                              <br>
                                              
                                              <p class="col_white">
                                                <b>License.</b> By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on the
                                                Website in connection with your normal, noncommercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create derivative
                                                  works of such content or information without express written authorization from Inox Arabia FZC and associated companies or the applicable third party (if third party content is at issue).
                                              </p>
                                              <br>
                                              
                                              <p class="col_white">
                                                <b>Posting.</b> By posting, storing, or transmitting any content on the Website, you hereby grant Inox Arabia FZC and associated companies a perpetual, worldwide,
                                                non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute,
                                                  have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world.
                                                  Inox Arabia FZC and associated companies do not have the ability to control the nature of the user-generated content offered through the Website. 
                                                  You are solely responsible for your interactions with other users of the Website and any content you post. Inox Arabia FZC and associated companies
                                                    are not liable for any damage or harm resulting from any posts by or interactions between users. Inox Arabia FZC and associated companies reserves the right,
                                                    but has no obligation, to monitor interactions between and among users of the Website and to remove any content Inox Arabia FZC and associated companies deems
                                                      objectionable. 
                                                </p>
                                                <br>
                                              
                                                <h3 class="col_white">II. DISCLAIMER OF WARRANTIES</h3>
                                                <p class="col_white">
                                                        YOUR USE OF THIS WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE IS OFFERED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WITHOUT LIMITING THE 
                                                        GENERALITY OF THE FOREGOING, Inox Arabia FZC and associated companies MAKE NO WARRANTY:
                                                    THAT THE INFORMATION PROVIDED ON THIS WEBSITE IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
                                                    THAT THE LINKS TO THIRD-PARTY WEBSITES ARE TO INFORMATION THAT IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
                                                    NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THIS WEBSITE WILL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN. 
                                                </p>
                                                
                                                <br>
                                                <h3 class="col_white">III. INDEMNIFICATION</h3>
                                                <p class="col_white">
                                                  You will release, indemnify, defend and hold harmless Inox Arabia FZC and associated companies, and any of its contractors, agents, employees, officers, directors,
                                                  shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable attorneys' fees and 
                                                  expenses, of third parties relating to or arising out of
                                                </p>
                                                <ul>
                                                    <li> this Agreement or the breach of your warranties, representations and obligations under this Agreement;
                                                    </li>
                                                    <li>the Website content or your use of the Website content
                                                    </li>
                                                    <li>
                                                      any intellectual property or other proprietary right of any person or entity; 
                                                    </li><li>
                                                    your violation of any provision of this Agreement; or 
                                                    </li>
                                                    <li>
                                                      any information or data you supplied to Inox Arabia FZC and associated companies. When Inox Arabia FZC and associated companies are threatened with suit or sued by a third party, 
                                                      Inox Arabia FZC and associated companies may seek written assurances from you concerning your promise to indemnify Inox Arabia FZC and associated companies;
                                                    </li></ul>
                                                    <p class="col_white">
                                                        your failure to provide such assurances may be considered by Inox Arabia FZC and associated companies to be a material breach of this Agreement.
                                                        Inox Arabia FZC and associated companies will have the right to participate in any defense by you of a third-party claim related to your use of any of the Website content,
                                                        with counsel of Inox Arabia FZC and associated companies choice at its expense. Inox Arabia FZC and associated companies will reasonably cooperate in any defense by you of a third-party 
                                                        claim at your request and expense. You will have sole responsibility to defend Inox Arabia FZC and associated companies against any claim, but you must receive
                                                          Inox Arabia FZC and associated companies prior written consent regarding any related settlement. The terms of this provision will survive any termination or 
                                                          cancellation of this Agreement or your use of the Website or Products.
                                                </p>
                                                <br>
                                              
                                                <h3 class="col_white">IV. PRIVACY</h3>
                                                <p class="col_white">
                                                  Inox Arabia FZC and associated companies believe strongly in protecting user privacy and providing you with notice of Mbaye.com’s use of data. Please refer to
                                                  Inox Arabia FZC and associated companies privacy policy, incorporated by reference herein that is posted on the Website.
                                                </p>
                                                <br>
                                              
                                                <h3 class="col_white">V. AGREEMENT TO BE BOUND</h3>
                                                <p class="col_white">
                                                  By using this Website, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.  
                                                </p>
                                                <br>
                                              
                                                <h3 class="col_white">VI. GENERAL</h3>
                                                <p class="col_white">
                                                  <b>Force Majeure.</b> Inox Arabia FZC and associated companies will not be deemed in default hereunder or held responsible for any cessation, interruption or delay 
                                                  in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God, war, terrorism, armed 
                                                  conflict, labor strike, lockout, boycott or any national or international pandemic.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Cessation of Operation. </b> Inox Arabia FZC and associated companies may at any time, in its sole discretion and without advance notice to you, cease operation
                                                  of the Website and distribution of the Products.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Entire Agreement.</b> This Agreement comprises the entire agreement between you and Inox Arabia FZC and associated companies and supersedes any prior agreements 
                                                  pertaining to the subject matter contained herein.
                                              </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Effect of Waiver.</b> The failure of Inox Arabia FZC and associated companies to exercise or enforce any right or provision of this Agreement will not constitute 
                                                  a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to be invalid, the parties
                                                  nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the provision, and the other provisions
                                                    of this Agreement remain in full force and effect.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Governing Law; Jurisdiction. </b> This Website originates from the Dubai, United Arab Emirates, This Agreement will be governed by the laws 
                                                  of the State of European Union  without regard to its conflict of law principles to the contrary. Neither you nor Inox Arabia FZC and associated companies will commence
                                                  or prosecute any suit, proceeding or claim to enforce the provisions of this Agreement, to recover damages for breach of or default of this Agreement,
                                                    or otherwise arising under or by reason of this Agreement, other than in courts located in State of [State Name]. By using this Website or 
                                                    ordering Products, you consent to the jurisdiction and venue of such courts in connection with any action, suit, proceeding or claim arising 
                                                    under or by reason of this Agreement. You hereby waive any right to trial by jury arising out of this Agreement and any related documents.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Statute of Limitation. </b> You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or
                                                  related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of action arose or be forever barred.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Waiver of Class Action Rights.  </b> BY ENTERING INTO THIS AGREEMENT, YOU HEREBY IRREVOCABLY WAIVE ANY RIGHT YOU MAY HAVE TO JOIN CLAIMS 
                                                  WITH THOSE OF OTHER IN THE FORM OF A CLASS ACTION OR SIMILAR PROCEDURAL DEVICE. ANY CLAIMS ARISING OUT OF, RELATING TO, OR CONNECTION WITH
                                                  THIS AGREEMENT MUST BE ASSERTED INDIVIDUALLY.
                                              </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Termination. </b> Inox Arabia FZC and associated companies reserve the right to terminate your access to the Website if it reasonably believes, in its sole discretion,
                                                  that you have breached any of the terms and conditions of this Agreement. Following termination, you will not be permitted to use the Website 
                                                  and Inox Arabia FZC and associated companies may, in its sole discretion and without advance notice to you, cancel any outstanding orders for Products. If your access 
                                                  to the Website is terminated, Inox Arabia FZC and associated companies reserve the right to exercise whatever means it deems necessary to prevent unauthorized access 
                                                  of the Website. This Agreement will survive indefinitely unless and until Inox Arabia FZC and associated companies choose, in its sole discretion and without advance
                                                    to you, to terminate it.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Domestic Use. </b> Inox Arabia FZC and associated companies make no representation that the Website is appropriate or available for use in locations outside UAE.
                                                  Users who access the Website from outside UAE do so at their own risk and initiative and must bear all responsibility for compliance with 
                                                  any applicable local laws.
                                                </p>
                                                <br>
                                              
                                                <p class="col_white">
                                                  <b>Assignment. </b> You may not assign your rights and obligations under this Agreement to anyone. Inox Arabia FZC and associated companies may assign its rights and
                                                  obligations under this Agreement in its sole discretion and without advance notice to you.
                                              </p>
                                                <br>
                                                <p class="col_white">
                                                  BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
                                                </p>

                            </div>
                            <!--Privacy policy-->
                            <div class="privacy_policy">
                                  
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
                            </div>
                            <!--copy_right_claims-->  
                            <div class="copy_right_claims">
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
                            </div>

                              <!--sra-->  
                            <div class="sra">
                              <p class="col_white">
                                These Terms and Conditions, which supplement our standard terms and conditions for use of our services on our 
                                website, govern the use of a rights holder’s use of the Special Rights holders Account (“SRA”). These Terms constitute 
                                a contractual agreement between you and us. By accessing, using and/or signing up for an SRA, you express your 
                                understanding and acceptance of these Terms. As used in this document, the terms “you” or “your” refers to you, 
                                any entity you represent, your or its representatives, successors, assigns and affiliates, and any of your or their 
                                devices. If you do not agree to be bound by these Terms, you may not use an SRA.
                              </p>
                              <br>
                              <ol type="1">
                                <li><b>Eligibility</b>
                                  <ol type="a">
                                    <li>We provide and withdraw SRAs in our sole and complete discretion. You must create an account with us (an “Account”) to use an SRA. You represent and warrant that all information that you provide to us in creating your Account is complete and accurate. You shall update such
                                      information when it changes or when we request.
                                    </li>
                                    <br>
                              
                                    <li>
                                    You shall not use another person or entity's Account without authorization. You shall be solely responsible for maintaining the confidentiality of and restricted access to your Account. You shall be solely responsible for all activities that occur under your Account. You shall notify us immediately of any breach of security or unauthorized use of your Account. Pursuant to the terms herein, we shall not be liable for any losses resulting from any unauthorized use of your Account and, without limitation of any other provisions herein, you shall indemnify us and hold us harmless for any such unauthorized use.
                                    </li>
                                    <br>
                              
                                    <li>
                                      c.	Your use of an SRA is terminable by us at will for any reason and at our sole discretion, with or without prior notice. Upon termination, we may, but shall not be obligated to: (i) delete or deactivate your Account, and/or (ii) block your e-mail and/or IP addresses or otherwise terminate your use of and ability to use an SRA. You agree not to use or attempt to use an SRA after said termination. Upon termination, the grant of your right to use an SRA shall terminate, but all other portions of these Terms shall survive. You acknowledge that we are not responsible to you or any third party for the termination of your grant of use of an SRA.
                                    </li>
                                  </ol>
                                </li>
                                <br>
                              
                              
                              
                                <li><b>SRAs</b>
                                  <ol type="a">
                                    <li>
                                      SRAs allow you the ability to directly identify specific 
                                      content or links as infringing and which removes such content or link from our website automatically (subject still to a counter-notification in accordance with law).
                                    </li>
                                    <br>
                              
                                    <li>You acknowledge and understand that if you identify any content or website on our website as infringing using an SRA, it shall be deemed as if you have sent us a notification of alleged infringement in accordance with our copyright claims. As such, you acknowledge and understand that you shall only mark content or a website for which you could in good faith send a notification of alleged infringement in accordance with copyright claims. Without limiting the foregoing:
                              
                                      <ol type="i">
                                        <li>
                                          By identifying content or a link as infringing, you are representing and warranting that you believe the identified content or link constitutes or contains material that is infringing your intellectual property rights;
                                        </li>
                                        <br>
                              
                                        <li>
                                          By identifying content or a link as infringing, you are representing and warranting that you have a good faith belief that the use of the material (or of the material at the link) is not authorized by you, your agent or the law;
                                        </li>
                                        <br>
                              
                                        <li>
                                          By identifying content or a link as infringing, you are representing and warranting that all information that you have provided in connection with the SRA (including your contact information) is accurate;
                                        </li>
                                        <br>
                              
                                        <li>
                                        By identifying content or a link as infringing, you are stating under the penalty of perjury that you are the rights holder of the allegedly infringed content or that you are authorized to act on behalf of the rights holder of the allegedly infringed content;
                                        </li>
                                        <br>
                              
                                        <li>
                                          By identifying content or a link as infringing, you are providing your electronic signature confirming all of the foregoing.
                                        </li>
                                        <br>
                              
                                      </ol>
                              
                                    </li>
                                    <br>
                              <li>
                              You shall not identify any content or links as infringing unless the content or link contains material that infringes your intellectual property rights.
                              </li>
                              <br>
                              
                              
                                  </ol>
                                  
                                </li>
                                <li><b>Modification of These Terms</b>
                                  <p class="col_white">
                                    We reserve the right to amend these Terms at any time by posting such amended Terms to our website or the amended Terms to you. No other notification may be made to you about any amendments. YOU ACKNOWLEDGE THAT YOUR CONTINUED USE OF THE SRA FOLLOWING SUCH AMENDMENTS WILL CONSTITUTE YOUR ACCEPTANCE OF SUCH AMENDMENTS, REGARDLESS OF WHETHER YOU HAVE ACTUALLY READ THEM.
                                  </p>
                                </li>
                                <br>
                              
                                <li><b>Indemnification</b>
                              
                                  <p class="col_white">You hereby agree to indemnify us and hold us harmless from any and all damages and third-party claims and expenses, including attorney's fees and costs, arising from your use of the SRA or from your breach of these Terms.</p>
                                </li>
                                <br>
                              
                                
                                <li><b>Release</b>
                              
                                  <p class="col_white">In the event that you have a dispute with any third parties (including those that you allege have infringed your rights), you hereby release us, our officers, employees, agents and successors-in-right from claims, demands and damages (actual and consequential) of every kind or nature, known and unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or in any way related to such disputes and/or our service and/or the SRA.</p>
                                </li>
                                <br>
                              
                              
                                
                                <li><b>Disclaimer of Warranties</b>
                              
                                <ol type="a">
                              
                                  <li>READ THIS SECTION CAREFULLY AS IT LIMITS OUR LIABILITY TO THE MAXIMUM EXTENT PERMITTED UNDER APPLICABLE LAW (BUT NO FURTHER).</li><br>
                              
                                  <li>SRAs are provided “AS-IS” and without any warranty or condition, express, implied or statutory. We specifically disclaim to the fullest extent any implied warranties of merchantability, fitness for a particular purpose, non-infringement, information accuracy, integration, interoperability or quiet enjoyment. We disclaim any warranties for viruses or other harmful components in connection with SRAs. Some jurisdictions do not allow the disclaimer of some warranties, therefore in such jurisdictions, some of the foregoing disclaimers may not apply to you insofar as they relate to such warranties.</li><br>
                              
                                  <li>WE DO NOT WARRANT THAT (i) THE SRA WILL MEET YOUR REQUIREMENTS OR EXPECTATIONS, (ii) THE SRA WILL BE UNINTERRUPTED, TIMELY, SECURE, OR ERROR-FREE, (iii) THE RESULTS THAT MAY BE OBTAINED FROM YOUR USE OF THE SRA WILL BE ACCURATE OR RELIABLE, (iv) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION, CONTENT OR OTHER MATERIAL OBTAINED THROUGH THE SRA WILL MEET YOUR REQUIREMENTS OR EXPECTATIONS, OR (v) ANY ERRORS WILL BE CORRECTED.</li><br>
                              
                                  <li>ANYTHING OBTAINED THROUGH THE USE OF THE SRA IS OBTAINED AT YOUR OWN DISCRETION AND RISK. YOU ARE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR OTHER DEVICE OR LOSS OF DATA THAT RESULTS FROM SUCH USE.</li><br>
                                </ol>
                                </li>
                                <br>
                              
                                
                                <li><b>Limitations of Liability</b>
                                  <ol type="a">
                                    <li>UNDER NO CIRCUMSTANCES SHALL WE BE LIABLE FOR DIRECT, INDIRECT INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES (EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES) RESULTING FROM ANY ASPECT OF YOUR USE OF AN SRA, WHETHER, WITHOUT LIMITATION, SUCH DAMAGES ARISE FROM (i) YOUR USE, MISUSE OR INABILITY TO USE AN SRA, (ii) YOUR RELIANCE ON AN SRA, (iii) THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION OR COMPLETE DISCONTINUANCE OF THE SRA OR (iv) THE TERMINATION OF SERVICE BY US. THESE LIMITATIONS ALSO APPLY WITH RESPECT TO DAMAGES INCURRED BY REASON OF OTHER SERVICES OR PRODUCTS RECEIVED OR ADVERTISED IN CONNECTION WITH AN SRA. SOME JURISDICTIONS DO NOT ALLOW SOME LIMITATIONS OF LIABILITY, THEREFORE, IN SUCH JURISDICTIONS, SOME OF THE FOREGOING LIMITATIONS MAY NOT APPLY TO YOU.</li><br>
                              
                                    <li>YOUR SOLE AND EXCLUSIVE RIGHT AND REMEDY IN CASE OF DISSATISFACTION WITH AN SRA OR ANY OTHER GRIEVANCE SHALL BE THE TERMINATION OF YOUR USE OF THE SRA. WITHOUT LIMITING THE FOREGOING, IN NO CASE SHALL THE MAXIMUM LIABILITY OF US ARISING FROM OR RELATING TO YOUR USE OF THE SRA OR RELATING TO THESE TERMS EXCEED $100.</li><br>
                              
                              
                                    
                                  </ol>
                                
                                </li>
                                <br>
                              
                                <li><b>Legal Disputes</b>
                                  <ol type="a">
                                  <li>To the maximum extent permitted by law, these Terms as well as any claim, cause of action, or dispute that may arise between you and us (including any claims of infringement arising on or through our service), are governed by the laws of European Union, without regard to conflict of law provisions. FOR ANY CLAIM BROUGHT BY YOU AGAINST US, YOU AGREE TO SUBMIT AND CONSENT TO THE PERSONAL AND EXCLUSIVE JURISDICTION IN, AND THE EXCLUSIVE VENUE OF THE COURTS IN -----. FOR ANY CLAIM BROUGHT BY US AGAINST YOU, YOU AGREE TO SUBMIT AND CONSENT TO PERSONAL JURISDICTION IN AND THE VENUE OF THE COURTS IN ------ AND ANYWHERE ELSE YOU CAN BE FOUND. You hereby waive any right to seek another venue because of improper or inconvenient forum. </li>
                                  <br>
                              
                              
                                  <li>YOU AGREE THAT YOU MAY BRING CLAIMS ONLY IN YOUR INDIVIDUAL CAPACITY AND NOT AS A PLAINTIFF OR CLASS MEMBER IN ANY PURPORTED CLASS OR REPRESENTATIVE ACTION.  </li>
                                  <br>
                              
                              
                                  </ol>
                              
                                  <li> <b>General Terms</b>
                                    <ol type="a">
                              
                                      <li>These Terms, as amended from time to time, constitute the entire agreement between you and us and supersede all prior agreements between you and us and may not be modified without our written consent.</li><br>
                              
                                      <li>Our failure to enforce any provision of these Terms will not be construed as a waiver of any provision or right.</li><br>
                              
                                      <li>If any part of these Terms is determined to be invalid or unenforceable pursuant to applicable law, then the invalid and unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of the agreement shall continue in effect.</li><br>
                              
                              
                                      <li>Nothing herein is intended, nor will be deemed, to confer rights or remedies upon any third party.</li><br>
                              
                              
                                      <li>These Terms are not assignable, transferable or sub-licensable by you except with our prior written consent, but may be assigned or transferred by us without restriction.</li><br>
                              
                              
                                      <li>You agree that we may provide you with notices by email (to the email address associated with your Account), regular mail, or postings to our service. You may serve provide us notice by email to info@inoxarabia.com.</li><br>
                              
                              
                                      <li>The section titles in these Terms are for convenience only and have no legal or contractual effect.</li><br>
                              
                                      <li>As used in these Terms, the term “including” is illustrative and not limitative.</li><br>
                              
                              
                                      <li>If these Terms or any other documents between you and us are translated and executed in any language other than English and there is any conflict as between the translation and the English version, the English version shall control.</li><br>
                              
                              
                                  
                                    </ol>
                                  </li><br>
                                
                                </li><br>
                              </ol>

                              </div>


                          
                        </div>
                        <div class="slide-div">
                          <p class="next communicator-button">></p>
                          <p class="prev communicator-button"><</p>
                          <input type="hidden" id="prev_no" value="4">
                          <input type="hidden" id="next_no" value="1">
                          <input type="hidden" id="no" value="0">
                        </div>
                        <div class="label-div">
                          <p class="next_label communicator-button"></p>
                          <p class="prev_label communicator-button"></p>
                        </div>
                  </div>

                </div>
              
            </div>
            <div class="start-div">
                <p>Click Here For Terms And Conditions</p>
            </div>
            
        </div>


        <div class="full_form_full">   
          <div class="head-div_full">
            <p class="title">TERMS OF SERVICES</p>
          </div>
        <a href="#"  onclick="exit()"><button type="button" class="exit-fullscreen" Title="Exit Full Screen">
            <i class="fas fa-compress exit" Title="Exit screen"></i></button></a>
        
          <div class="terms_form_full">
              <!--terms of services-->
              <div class="terms_and_conditions_full">
                                                                  
                                  <!--<h2 class="col_white">  TERMS OF SERVICE AGREEMENT</h2>-->
                                  <h5 class="col_white">LAST REVISION: [14-03-2020]</h5>
                                
                                  <p class="col_white">
                                    PLEASE READ THESE TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    These Terms of Service Agreement (the "Agreement") governs your use of this website, www.Mbaye.com (the "Website. This Agreement includes,
                                    and incorporates by this reference, the policies and guidelines referenced below. Inox Arabia FZC and associated companies reserve the right
                                      to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on this Website.
                                      Inox Arabia FZC and associated companies will alert you that changes or revisions have been made by indicating on the top of this Agreement the date it was last revised.
                                        The changed or revised Agreement will be effective immediately after it is posted on this Website. Your use of the Website following the 
                                        posting any such changes or of a revised Agreement will constitute your acceptance of any such changes or revisions. Inox Arabia FZC and associated companies 
                                        encourage   you to review this Agreement whenever you visit the Website to make sure that you understand the terms and conditions governing use of the Website.
                                          This Agreement does not alter in any way the terms or conditions of any other written agreement you may have with Inox Arabia FZC and associated companies
                                          for other products or services. If you do not agree to this Agreement (including any referenced policies or guidelines), please immediately terminate 
                                          your use of the Website. If you would like to print this Agreement, please click the print button on your browser toolbar.
                                  </p>
                                  <br>
                                
                                <h3 class="col_white">I. WEBSITE</h3>
                                
                                <p class="col_white">
                                <b>Content; Intellectual Property; Third Party Links.</b>
                                In addition to making Products available, this Website also offers information and allows you to play game. This Website also offers information,
                                  both directly and through indirect links to third-party websites. Mbaye.com does not always create the information offered on this Website; 
                                  instead the information is often gathered from other sources. To the extent that Inox Arabia FZC and associated companies do create the content on this Website,
                                  such content is protected by intellectual property laws of the foreign nations, and international bodies. Unauthorized use of the material 
                                  may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, noncommercial use.
                                    Any links to third-party websites are provided solely as a convenience to you. Inox Arabia FZC and associated companies do not endorse the contents on any such
                                    third-party websites. Inox Arabia FZC and associated companies are not responsible for the content of or any damage that may result from your access to or reliance 
                                    on these third-party websites. If you link to third-party websites, you do so at your own risk. 
                                </p>
                                
                                <br>
                                <p class="col_white">
                                  <b>Use of Website;</b>
                                  Inox Arabia FZC and associated companies are not responsible for any damages resulting from use of this website by anyone. You will not use the Website for illegal purposes. You will
                                  <ul>
                                    <li>
                                        Abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws regarding 
                                        intellectual property)
                                    </li>
                                    <li>    Not interfere with or disrupt the use and enjoyment of the Website by other users
                                    </li>
                                    <li>
                                      Not resell material on the Website
                                    </li>
                                    <li>
                                      Not engage, directly or indirectly, in transmission of "spam", chain letters, junk mail or any other type of unsolicited communication, and 
                                    </li>
                                    <li>Not defame, harass, abuse, or disrupt other users of the Website.
                                    </li>
                                    </ul>
                                </p>
                                <br>
                                
                                <p class="col_white">
                                  <b>License.</b> By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on the
                                  Website in connection with your normal, noncommercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create derivative
                                    works of such content or information without express written authorization from Inox Arabia FZC and associated companies or the applicable third party (if third party content is at issue).
                                </p>
                                <br>
                                
                                <p class="col_white">
                                  <b>Posting.</b> By posting, storing, or transmitting any content on the Website, you hereby grant Inox Arabia FZC and associated companies a perpetual, worldwide,
                                  non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute,
                                    have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world.
                                    Inox Arabia FZC and associated companies do not have the ability to control the nature of the user-generated content offered through the Website. 
                                    You are solely responsible for your interactions with other users of the Website and any content you post. Inox Arabia FZC and associated companies
                                      are not liable for any damage or harm resulting from any posts by or interactions between users. Inox Arabia FZC and associated companies reserves the right,
                                      but has no obligation, to monitor interactions between and among users of the Website and to remove any content Inox Arabia FZC and associated companies deems
                                        objectionable. 
                                  </p>
                                  <br>
                                
                                  <h3 class="col_white">II. DISCLAIMER OF WARRANTIES</h3>
                                  <p class="col_white">
                                          YOUR USE OF THIS WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE IS OFFERED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WITHOUT LIMITING THE 
                                          GENERALITY OF THE FOREGOING, Inox Arabia FZC and associated companies MAKE NO WARRANTY:
                                      THAT THE INFORMATION PROVIDED ON THIS WEBSITE IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
                                      THAT THE LINKS TO THIRD-PARTY WEBSITES ARE TO INFORMATION THAT IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
                                      NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THIS WEBSITE WILL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN. 
                                  </p>
                                  
                                  <br>
                                  <h3 class="col_white">III. INDEMNIFICATION</h3>
                                  <p class="col_white">
                                    You will release, indemnify, defend and hold harmless Inox Arabia FZC and associated companies, and any of its contractors, agents, employees, officers, directors,
                                    shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable attorneys' fees and 
                                    expenses, of third parties relating to or arising out of
                                  </p>
                                  <ul>
                                      <li> this Agreement or the breach of your warranties, representations and obligations under this Agreement;
                                      </li>
                                      <li>the Website content or your use of the Website content
                                      </li>
                                      <li>
                                        any intellectual property or other proprietary right of any person or entity; 
                                      </li><li>
                                      your violation of any provision of this Agreement; or 
                                      </li>
                                      <li>
                                        any information or data you supplied to Inox Arabia FZC and associated companies. When Inox Arabia FZC and associated companies are threatened with suit or sued by a third party, 
                                        Inox Arabia FZC and associated companies may seek written assurances from you concerning your promise to indemnify Inox Arabia FZC and associated companies;
                                      </li></ul>
                                      <p class="col_white">
                                          your failure to provide such assurances may be considered by Inox Arabia FZC and associated companies to be a material breach of this Agreement.
                                          Inox Arabia FZC and associated companies will have the right to participate in any defense by you of a third-party claim related to your use of any of the Website content,
                                          with counsel of Inox Arabia FZC and associated companies choice at its expense. Inox Arabia FZC and associated companies will reasonably cooperate in any defense by you of a third-party 
                                          claim at your request and expense. You will have sole responsibility to defend Inox Arabia FZC and associated companies against any claim, but you must receive
                                            Inox Arabia FZC and associated companies prior written consent regarding any related settlement. The terms of this provision will survive any termination or 
                                            cancellation of this Agreement or your use of the Website or Products.
                                  </p>
                                  <br>
                                
                                  <h3 class="col_white">IV. PRIVACY</h3>
                                  <p class="col_white">
                                    Inox Arabia FZC and associated companies believe strongly in protecting user privacy and providing you with notice of Mbaye.com’s use of data. Please refer to
                                    Inox Arabia FZC and associated companies privacy policy, incorporated by reference herein that is posted on the Website.
                                  </p>
                                  <br>
                                
                                  <h3 class="col_white">V. AGREEMENT TO BE BOUND</h3>
                                  <p class="col_white">
                                    By using this Website, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.  
                                  </p>
                                  <br>
                                
                                  <h3 class="col_white">VI. GENERAL</h3>
                                  <p class="col_white">
                                    <b>Force Majeure.</b> Inox Arabia FZC and associated companies will not be deemed in default hereunder or held responsible for any cessation, interruption or delay 
                                    in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God, war, terrorism, armed 
                                    conflict, labor strike, lockout, boycott or any national or international pandemic.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Cessation of Operation. </b> Inox Arabia FZC and associated companies may at any time, in its sole discretion and without advance notice to you, cease operation
                                    of the Website and distribution of the Products.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Entire Agreement.</b> This Agreement comprises the entire agreement between you and Inox Arabia FZC and associated companies and supersedes any prior agreements 
                                    pertaining to the subject matter contained herein.
                                </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Effect of Waiver.</b> The failure of Inox Arabia FZC and associated companies to exercise or enforce any right or provision of this Agreement will not constitute 
                                    a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to be invalid, the parties
                                    nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the provision, and the other provisions
                                      of this Agreement remain in full force and effect.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Governing Law; Jurisdiction. </b> This Website originates from the Dubai, United Arab Emirates, This Agreement will be governed by the laws 
                                    of the State of European Union  without regard to its conflict of law principles to the contrary. Neither you nor Inox Arabia FZC and associated companies will commence
                                    or prosecute any suit, proceeding or claim to enforce the provisions of this Agreement, to recover damages for breach of or default of this Agreement,
                                      or otherwise arising under or by reason of this Agreement, other than in courts located in State of [State Name]. By using this Website or 
                                      ordering Products, you consent to the jurisdiction and venue of such courts in connection with any action, suit, proceeding or claim arising 
                                      under or by reason of this Agreement. You hereby waive any right to trial by jury arising out of this Agreement and any related documents.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Statute of Limitation. </b> You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or
                                    related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of action arose or be forever barred.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Waiver of Class Action Rights.  </b> BY ENTERING INTO THIS AGREEMENT, YOU HEREBY IRREVOCABLY WAIVE ANY RIGHT YOU MAY HAVE TO JOIN CLAIMS 
                                    WITH THOSE OF OTHER IN THE FORM OF A CLASS ACTION OR SIMILAR PROCEDURAL DEVICE. ANY CLAIMS ARISING OUT OF, RELATING TO, OR CONNECTION WITH
                                    THIS AGREEMENT MUST BE ASSERTED INDIVIDUALLY.
                                </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Termination. </b> Inox Arabia FZC and associated companies reserve the right to terminate your access to the Website if it reasonably believes, in its sole discretion,
                                    that you have breached any of the terms and conditions of this Agreement. Following termination, you will not be permitted to use the Website 
                                    and Inox Arabia FZC and associated companies may, in its sole discretion and without advance notice to you, cancel any outstanding orders for Products. If your access 
                                    to the Website is terminated, Inox Arabia FZC and associated companies reserve the right to exercise whatever means it deems necessary to prevent unauthorized access 
                                    of the Website. This Agreement will survive indefinitely unless and until Inox Arabia FZC and associated companies choose, in its sole discretion and without advance
                                      to you, to terminate it.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Domestic Use. </b> Inox Arabia FZC and associated companies make no representation that the Website is appropriate or available for use in locations outside UAE.
                                    Users who access the Website from outside UAE do so at their own risk and initiative and must bear all responsibility for compliance with 
                                    any applicable local laws.
                                  </p>
                                  <br>
                                
                                  <p class="col_white">
                                    <b>Assignment. </b> You may not assign your rights and obligations under this Agreement to anyone. Inox Arabia FZC and associated companies may assign its rights and
                                    obligations under this Agreement in its sole discretion and without advance notice to you.
                                </p>
                                  <br>
                                  <p class="col_white">
                                    BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
                                  </p>

              </div>
              <!--Privacy policy-->
              <div class="privacy_policy_full">
                    
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
              </div>
              <!--copy_right_claims-->  
              <div class="copy_right_claims_full">
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
              </div>

                <!--sra-->  
              <div class="sra_full">
                <p class="col_white">
                  These Terms and Conditions, which supplement our standard terms and conditions for use of our services on our 
                  website, govern the use of a rights holder’s use of the Special Rights holders Account (“SRA”). These Terms constitute 
                  a contractual agreement between you and us. By accessing, using and/or signing up for an SRA, you express your 
                  understanding and acceptance of these Terms. As used in this document, the terms “you” or “your” refers to you, 
                  any entity you represent, your or its representatives, successors, assigns and affiliates, and any of your or their 
                  devices. If you do not agree to be bound by these Terms, you may not use an SRA.
                </p>
                <br>
                <ol type="1">
                  <li><b>Eligibility</b>
                    <ol type="a">
                      <li>We provide and withdraw SRAs in our sole and complete discretion. You must create an account with us (an “Account”) to use an SRA. You represent and warrant that all information that you provide to us in creating your Account is complete and accurate. You shall update such
                        information when it changes or when we request.
                      </li>
                      <br>
                
                      <li>
                      You shall not use another person or entity's Account without authorization. You shall be solely responsible for maintaining the confidentiality of and restricted access to your Account. You shall be solely responsible for all activities that occur under your Account. You shall notify us immediately of any breach of security or unauthorized use of your Account. Pursuant to the terms herein, we shall not be liable for any losses resulting from any unauthorized use of your Account and, without limitation of any other provisions herein, you shall indemnify us and hold us harmless for any such unauthorized use.
                      </li>
                      <br>
                
                      <li>
                        c.	Your use of an SRA is terminable by us at will for any reason and at our sole discretion, with or without prior notice. Upon termination, we may, but shall not be obligated to: (i) delete or deactivate your Account, and/or (ii) block your e-mail and/or IP addresses or otherwise terminate your use of and ability to use an SRA. You agree not to use or attempt to use an SRA after said termination. Upon termination, the grant of your right to use an SRA shall terminate, but all other portions of these Terms shall survive. You acknowledge that we are not responsible to you or any third party for the termination of your grant of use of an SRA.
                      </li>
                    </ol>
                  </li>
                  <br>
                
                
                
                  <li><b>SRAs</b>
                    <ol type="a">
                      <li>
                        SRAs allow you the ability to directly identify specific 
                        content or links as infringing and which removes such content or link from our website automatically (subject still to a counter-notification in accordance with law).
                      </li>
                      <br>
                
                      <li>You acknowledge and understand that if you identify any content or website on our website as infringing using an SRA, it shall be deemed as if you have sent us a notification of alleged infringement in accordance with our copyright claims. As such, you acknowledge and understand that you shall only mark content or a website for which you could in good faith send a notification of alleged infringement in accordance with copyright claims. Without limiting the foregoing:
                
                        <ol type="i">
                          <li>
                            By identifying content or a link as infringing, you are representing and warranting that you believe the identified content or link constitutes or contains material that is infringing your intellectual property rights;
                          </li>
                          <br>
                
                          <li>
                            By identifying content or a link as infringing, you are representing and warranting that you have a good faith belief that the use of the material (or of the material at the link) is not authorized by you, your agent or the law;
                          </li>
                          <br>
                
                          <li>
                            By identifying content or a link as infringing, you are representing and warranting that all information that you have provided in connection with the SRA (including your contact information) is accurate;
                          </li>
                          <br>
                
                          <li>
                          By identifying content or a link as infringing, you are stating under the penalty of perjury that you are the rights holder of the allegedly infringed content or that you are authorized to act on behalf of the rights holder of the allegedly infringed content;
                          </li>
                          <br>
                
                          <li>
                            By identifying content or a link as infringing, you are providing your electronic signature confirming all of the foregoing.
                          </li>
                          <br>
                
                        </ol>
                
                      </li>
                      <br>
                <li>
                You shall not identify any content or links as infringing unless the content or link contains material that infringes your intellectual property rights.
                </li>
                <br>
                
                
                    </ol>
                    
                  </li>
                  <li><b>Modification of These Terms</b>
                    <p class="col_white">
                      We reserve the right to amend these Terms at any time by posting such amended Terms to our website or the amended Terms to you. No other notification may be made to you about any amendments. YOU ACKNOWLEDGE THAT YOUR CONTINUED USE OF THE SRA FOLLOWING SUCH AMENDMENTS WILL CONSTITUTE YOUR ACCEPTANCE OF SUCH AMENDMENTS, REGARDLESS OF WHETHER YOU HAVE ACTUALLY READ THEM.
                    </p>
                  </li>
                  <br>
                
                  <li><b>Indemnification</b>
                
                    <p class="col_white">You hereby agree to indemnify us and hold us harmless from any and all damages and third-party claims and expenses, including attorney's fees and costs, arising from your use of the SRA or from your breach of these Terms.</p>
                  </li>
                  <br>
                
                  
                  <li><b>Release</b>
                
                    <p class="col_white">In the event that you have a dispute with any third parties (including those that you allege have infringed your rights), you hereby release us, our officers, employees, agents and successors-in-right from claims, demands and damages (actual and consequential) of every kind or nature, known and unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or in any way related to such disputes and/or our service and/or the SRA.</p>
                  </li>
                  <br>
                
                
                  
                  <li><b>Disclaimer of Warranties</b>
                
                  <ol type="a">
                
                    <li>READ THIS SECTION CAREFULLY AS IT LIMITS OUR LIABILITY TO THE MAXIMUM EXTENT PERMITTED UNDER APPLICABLE LAW (BUT NO FURTHER).</li><br>
                
                    <li>SRAs are provided “AS-IS” and without any warranty or condition, express, implied or statutory. We specifically disclaim to the fullest extent any implied warranties of merchantability, fitness for a particular purpose, non-infringement, information accuracy, integration, interoperability or quiet enjoyment. We disclaim any warranties for viruses or other harmful components in connection with SRAs. Some jurisdictions do not allow the disclaimer of some warranties, therefore in such jurisdictions, some of the foregoing disclaimers may not apply to you insofar as they relate to such warranties.</li><br>
                
                    <li>WE DO NOT WARRANT THAT (i) THE SRA WILL MEET YOUR REQUIREMENTS OR EXPECTATIONS, (ii) THE SRA WILL BE UNINTERRUPTED, TIMELY, SECURE, OR ERROR-FREE, (iii) THE RESULTS THAT MAY BE OBTAINED FROM YOUR USE OF THE SRA WILL BE ACCURATE OR RELIABLE, (iv) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION, CONTENT OR OTHER MATERIAL OBTAINED THROUGH THE SRA WILL MEET YOUR REQUIREMENTS OR EXPECTATIONS, OR (v) ANY ERRORS WILL BE CORRECTED.</li><br>
                
                    <li>ANYTHING OBTAINED THROUGH THE USE OF THE SRA IS OBTAINED AT YOUR OWN DISCRETION AND RISK. YOU ARE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR OTHER DEVICE OR LOSS OF DATA THAT RESULTS FROM SUCH USE.</li><br>
                  </ol>
                  </li>
                  <br>
                
                  
                  <li><b>Limitations of Liability</b>
                    <ol type="a">
                      <li>UNDER NO CIRCUMSTANCES SHALL WE BE LIABLE FOR DIRECT, INDIRECT INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES (EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES) RESULTING FROM ANY ASPECT OF YOUR USE OF AN SRA, WHETHER, WITHOUT LIMITATION, SUCH DAMAGES ARISE FROM (i) YOUR USE, MISUSE OR INABILITY TO USE AN SRA, (ii) YOUR RELIANCE ON AN SRA, (iii) THE INTERRUPTION, SUSPENSION, MODIFICATION, ALTERATION OR COMPLETE DISCONTINUANCE OF THE SRA OR (iv) THE TERMINATION OF SERVICE BY US. THESE LIMITATIONS ALSO APPLY WITH RESPECT TO DAMAGES INCURRED BY REASON OF OTHER SERVICES OR PRODUCTS RECEIVED OR ADVERTISED IN CONNECTION WITH AN SRA. SOME JURISDICTIONS DO NOT ALLOW SOME LIMITATIONS OF LIABILITY, THEREFORE, IN SUCH JURISDICTIONS, SOME OF THE FOREGOING LIMITATIONS MAY NOT APPLY TO YOU.</li><br>
                
                      <li>YOUR SOLE AND EXCLUSIVE RIGHT AND REMEDY IN CASE OF DISSATISFACTION WITH AN SRA OR ANY OTHER GRIEVANCE SHALL BE THE TERMINATION OF YOUR USE OF THE SRA. WITHOUT LIMITING THE FOREGOING, IN NO CASE SHALL THE MAXIMUM LIABILITY OF US ARISING FROM OR RELATING TO YOUR USE OF THE SRA OR RELATING TO THESE TERMS EXCEED $100.</li><br>
                
                
                      
                    </ol>
                  
                  </li>
                  <br>
                
                  <li><b>Legal Disputes</b>
                    <ol type="a">
                    <li>To the maximum extent permitted by law, these Terms as well as any claim, cause of action, or dispute that may arise between you and us (including any claims of infringement arising on or through our service), are governed by the laws of European Union, without regard to conflict of law provisions. FOR ANY CLAIM BROUGHT BY YOU AGAINST US, YOU AGREE TO SUBMIT AND CONSENT TO THE PERSONAL AND EXCLUSIVE JURISDICTION IN, AND THE EXCLUSIVE VENUE OF THE COURTS IN -----. FOR ANY CLAIM BROUGHT BY US AGAINST YOU, YOU AGREE TO SUBMIT AND CONSENT TO PERSONAL JURISDICTION IN AND THE VENUE OF THE COURTS IN ------ AND ANYWHERE ELSE YOU CAN BE FOUND. You hereby waive any right to seek another venue because of improper or inconvenient forum. </li>
                    <br>
                
                
                    <li>YOU AGREE THAT YOU MAY BRING CLAIMS ONLY IN YOUR INDIVIDUAL CAPACITY AND NOT AS A PLAINTIFF OR CLASS MEMBER IN ANY PURPORTED CLASS OR REPRESENTATIVE ACTION.  </li>
                    <br>
                
                
                    </ol>
                
                    <li> <b>General Terms</b>
                      <ol type="a">
                
                        <li>These Terms, as amended from time to time, constitute the entire agreement between you and us and supersede all prior agreements between you and us and may not be modified without our written consent.</li><br>
                
                        <li>Our failure to enforce any provision of these Terms will not be construed as a waiver of any provision or right.</li><br>
                
                        <li>If any part of these Terms is determined to be invalid or unenforceable pursuant to applicable law, then the invalid and unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of the agreement shall continue in effect.</li><br>
                
                
                        <li>Nothing herein is intended, nor will be deemed, to confer rights or remedies upon any third party.</li><br>
                
                
                        <li>These Terms are not assignable, transferable or sub-licensable by you except with our prior written consent, but may be assigned or transferred by us without restriction.</li><br>
                
                
                        <li>You agree that we may provide you with notices by email (to the email address associated with your Account), regular mail, or postings to our service. You may serve provide us notice by email to info@inoxarabia.com.</li><br>
                
                
                        <li>The section titles in these Terms are for convenience only and have no legal or contractual effect.</li><br>
                
                        <li>As used in these Terms, the term “including” is illustrative and not limitative.</li><br>
                
                
                        <li>If these Terms or any other documents between you and us are translated and executed in any language other than English and there is any conflict as between the translation and the English version, the English version shall control.</li><br>
                
                
                    
                      </ol>
                    </li><br>
                  
                  </li><br>
                </ol>

                </div>


            
          </div>
          <div class="slide-div_full">
            <p class="next_full communicator-button" onclick="next_terms_full()">></p>
            <p class="prev_full communicator-button" onclick="prev_terms_full()"><</p>
            <input type="hidden" id="prev_no" value="4">
            <input type="hidden" id="next_no" value="1">
            <input type="hidden" id="no" value="0">
          </div>
          <div class="label-div_full">
            <p class="next_label_full communicator-button"></p>
            <p class="prev_label_full communicator-button"></p>
          </div>
    </div>
        <div class="form-fullview">
     
          <button type="button" class="exit-fullscreen"><i class="fas fa-compress"></i> <span>Exit Fullscreen</span></button>
      </div>
    </div>
    <div id="app"></div>
</div>
@endsection

@section('after-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/JS/musicplay.js')}}" type="text/jscript"></script>
    <script src="{{asset('front/JS/music-wave.js')}}"></script>
    {{-- <script src="{{asset('trix/trix.js')}}"></script> --}}
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('front/slick/slick.min.js')}}"></script>
    

    <script>

    </script>
 

   
    <script src="{{asset('front/JS/terms.js')}}"></script>
@endsection
