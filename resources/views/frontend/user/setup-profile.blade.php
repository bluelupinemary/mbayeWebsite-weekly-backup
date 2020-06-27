@extends('frontend.layouts.app')

@section('before-styles')

<link rel="stylesheet" href="{{ asset('front/CSS/setup.css') }}">
@endsection

 <!-----------------------------------  script section  ------------------------------------------>

 <!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-----------------------------------  end of script section  ------------------------------------------>


@section('content')
    <div  id="block_land"  >
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <div><img src="{{ asset('front') }}/images/rotate-screen.gif" alt=""></div>
        </div>
    </div>
    <section class="container-fluid" style="height:100vh">
        <div class="sub_container" style="border:0px solid white">

                <div class="box about initial_title" onclick="show_about()">
                  <span>ABOUT YOURSELF</span>
                </div>

                <div class="box educ initial_title" onclick="show_educ()">
                  <span>EDUCATION</span>
                </div>

                <div class="box contact_num initial_title" onclick="show_contact()">
                  <span>CONTACT INFO</span>
                </div>

                <div class="featpic initial_title" onclick="">
                  <span>UPLOAD YOUR FEATURED IMAGE HERE</span>
                </div>

                <div class="work initial_title" onclick="show_work()">
                  <span>WORK EXPERIENCE</span>
                </div>

                <div class="box char_ref initial_title" onclick="show_charref()">
                  <span>CHARACTER REFERENCE</span>
                </div>

                <div class="box about about_info" onclick="show_about()">
                    <b>Name:</b>&nbsp;<span id="display_name"></span><br>
                    <b>Email:</b> user@user.com<br>
                    <b>Objective:</b>&nbsp;<span id="display_obj"></span><br>
                    <b>Skills:&nbsp;<span id="display_skills"></span></b> 
                </div>

                <div class="box educ educ_info" onclick="show_educ()">
                    <span id="display_fieldstudy" class="fieldstudy"></span><br>
                    <span id="display_school"></span><br>                   
                    <span id="display_educstartdate"></span>&nbsp;-&nbsp;<span id="display_educenddate"></span><br>
                    <span id="display_educ_desc"></span>
                </div>

          
                <div class="box contact_num contactnum_info" onclick="show_contact()">
                  0123456<br>
                </div>
     

                <div class="featpic featpic_info">
                  <img class="close_btn" style="position:absolute; max-width:35vw; height:auto; z-index:1;" src="{{ asset('front') }}/images/sample-featured-image.jpg"/>
                </div>

                <div class="work work_info" onclick="show_work()">
                    Frontend Web Developer<br>
                    Inox Arabia<br>
                    Dubai, UAE<br>
                    May 2020 - Present<br>
                    - Lorem ipsum dolor sit amet, consectetur adipiscing elit <br>
                    - sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                </div>

                <div class="box char_ref charref_info" onclick="show_charref()">
                    Billy Zane Cortez   +9710123456<br>
                    Daphne Padua        +9710123456
                </div>

            <div id="about_panel" style="display: none;" class="panel about_panel">
            <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute; left:94%; max-width:2vw; height:auto; z-index:1;" align="right" onclick="hide_about()"/>
            <p class="header">About Yourself</p><br>
            {{Form::open(['class' => 'form-horizontal form_details', 'id'=>'SetupForm'])}}
            <div class="all_forms">

              <div class="form">  
              <label for="fname" class="lbl_text">First Name<span style="color:red">*</span></label>
              <input  class="name" type="text" id="user_name" name="name" value="{{ $user->first_name }}" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="lname" class="lbl_text">Last Name<span style="color:red">*</span></label>
              <input  class="name" type="text" id="user_name" name="name" value="{{ $user->last_name }}" spellcheck="false" required/>
              </div><br>

              <div class="form"> 
              <label for="educ_start_date" class="lbl_text">Date of Birth</label>
              <input type="date" class="dob" type="text" id="user_educstartdate" name="" value="{{ $user->dob }}" required/>
              </div><br>

              <div class="form">  
              <label for="address" class="lbl_text">Address<span style="color:red">*</span></label>
              <input  class="workcontact" type="text" id="" name="" value="{{ $user->address }}" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="country" class="lbl_text">Country<span style="color:red">*</span></label>
              <select id="countries" class="workcontact" name="country" value="{{ $user->country }}" class="form-control lbl_text" required>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
              </select>
              </div><br>
              
              <div class="form"> 
              <p class="txtfield"> 
              <label for="objective" class="lbl_text">Objective</label>
              <textarea class="long_forms objective" type="text" id="user_obj" name="" spellcheck="false" rows="3"></textarea></p>
              </div><br>

              <div class="form"> 
                <p class="txtfield"> 
                <label for="objective" class="lbl_text">Skills</label>
                <textarea class="long_forms charref_email" type="text" id="user_skills" name="" spellcheck="false" rows="3"></textarea></p>
                </div><br>
            
              <div class="form">  
              <input type="button" id="" class="btn btn-info lbl_text" style="position:absolute; left:25vw;" value="Submit" onclick="display_about();">
              </div>
            </div>
            {{Form::close()}}
            </div>

            <div id="educ_panel" style="display: none;" class="panel about_panel">
            <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute; left:94%; max-width:2vw; height:auto; z-index:1;" align="right" onclick="hide_educ()"/>
            <p class="header">Education</p><br>
            {{Form::open(['class' => 'form-horizontal form_details', 'id'=>'SetupForm'])}}
            <div class="all_forms">

              <div class="form">
              <label for="schoolname" class="lbl_text">Education Level<span style="color:red">*</span></label>
                <select id="educ_lvl" name="" class="dob">
                  <option value="Primary">Primary</option>
                  <option value="Secondary">Secondary</option>
                  <option value="Tertiary">Tertiary</option>
                  <option value="Graduate">Graduate</option>
                </select> 
              </div><br>

              <div class="form">  
              <label for="schoolname" class="lbl_text">School Name<span style="color:red">*</span></label>
              <input  class="schoolname" type="text" id="user_school" name="name" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="studyfield" class="lbl_text">Field of Study</label>
              <input  class="dob" type="text" id="user_fieldstudy" name="" spellcheck="false" required/>
              </div><br>
              
              <div class="form"> 
              <label for="educ_start_date" class="lbl_text">Start Date</label>
              <input type="date" class="educ_start_form" type="text" id="user_educstartdate" name="" required/>
              </div><br>

              <div class="form">  
              <label for="educ_end_date" class="lbl_text">End Date</label>
              <input type="date" class="educ_end_form" type="text" id="user_educenddate" name="" required/>
              </div><br>

              <div class="form">  
              <p class="txtfield">
              <label for="educ_desc" class="lbl_text">Description</label>
              <textarea class="long_forms skills" type="text" id="user_educ_desc" name="" spellcheck="false" rows="3"></textarea></p>
              </div>
            
              <div class="form">  
              <input type="button" id="" class="btn btn-info lbl_text" style="" value="Submit" onclick="display_educ();">
              </div>
            </div>
            {{Form::close()}}
            </div>

            <div id="contact_panel" style="display: none;" class="contact_panel">
            <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute; left:94%; max-width:2vw; height:auto; z-index:1;" align="right" onclick="hide_contact()"/>
            <p class="header">Contact</p><br>
            {{Form::open(['class' => 'form-horizontal form_details', 'id'=>'SetupForm'])}}
              <div class="form">  
              <label for="email" class="contactlbl_text">Primary Email address</label>
              <input  class="email_form" type="text" id="" name="" value="{{ $user->email }}" spellcheck="false" readonly/>
              <img class="add_btn" src="{{ asset('front') }}/images/add-btn.png" style="position:absolute; left:89%; top: 16%; max-width:2vw; height:auto; z-index:1;" onclick="show_secemail()"/>
              </div><br>

              <div class="form" id="secemail_div" style="display: none;">  
                <label for="email" class="contactlbl_text">Secondary Email address</label>
                <input  class="studyfield" type="text" id="" name="" value="" spellcheck="false" readonly/>
              </div><br>
            
              <div class="form">  
              <label for="contactnum" class="contactlbl_text">Primary Contact #</label>
              <input  class="contactnum_form" type="text" id="" name="" value="{{ $user->mobile_number }}" spellcheck="false" readonly/>
              <img class="add_btn" src="{{ asset('front') }}/images/add-btn.png" style="position:absolute; left:89%; max-width:2vw; height:auto; z-index:1;" onclick="show_secnum()"/>
              </div><br>

              <div class="form" id="secnum_div" style="display: none;">  
                <label for="contactnum" class="contactlbl_text">Secondary Contact #</label>
                <input  class="work_start_form" type="text" id="" name="" value="" spellcheck="false" readonly/>
              </div>

              <div class="form">  
              <input type="submit" id="" class="btn btn-info lbl_text" style="" value="Submit">
              </div>
            {{Form::close()}}
            </div>

            <div id="work_panel" style="display: none;" class="panel about_panel">
            <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute; left:94%; max-width:2vw; height:auto; z-index:1;" align="right" onclick="hide_work()"/>
            <p class="header">Work Experience</p><br>
            {{Form::open(['class' => 'form-horizontal form_details', 'id'=>'SetupForm'])}}
            <div class="all_forms">

              <div class="form">  
              <label for="designation" class="lbl_text">Designation<span style="color:red">*</span></label>
              <input  class="designation" type="text" id="name" name="name" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="company" class="lbl_text">Company<span style="color:red">*</span></label>
              <input  class="skills" type="text" id="" name="" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="workaddress" class="lbl_text">Address<span style="color:red">*</span></label>
              <input  class="educ_start_form" type="text" id="" name="" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="worknum" class="lbl_text">Contact #<span style="color:red">*</span></label>
              <input  class="workcontact" type="text" id="" name="" spellcheck="false" required/>
              </div><br>
              
              <div class="form"> 
              <label for="work_start_date" class="lbl_text">Start Date<span style="color:red">*</span></label>
              <input type="date" class="work_start_form" type="text" id="" name="" required/>
              </div><br>

              <div class="form">  
              <label for="work_end_date" class="lbl_text">End Date<span style="color:red">*</span></label>
              <input type="date" class="work_end_form" type="text" id="" name="" required/>
              </div><br>

              <div class="form">  
              <p class="txtfield">
              <label for="workrole" class="lbl_text">Role</label>
              <textarea class="long_forms workrole" type="text" id="" name="" spellcheck="false" rows="3"></textarea></p>
              </div>

              <div class="form">  
              <input type="submit" id="" class="btn btn-info lbl_text" style="" value="Submit">
              </div>
            </div>
            {{Form::close()}}
            </div>

            <div id="charref_panel" style="display: none;" class="panel about_panel">
            <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute; left:94%; max-width:2vw; height:auto; z-index:1;" align="right" onclick="hide_charref()"/>
            <p class="header">Character Reference</p><br>
            {{Form::open(['class' => 'form-horizontal form_details', 'id'=>'SetupForm'])}}
            <div class="all_forms">

            <div class="form">  
              <label for="charref_name" class="lbl_text">Name<span style="color:red">*</span></label>
              <input class="charref_name" type="text" id="name" name="name" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="charref_email" class="lbl_text">Email<span style="color:red">*</span></label>
              <input class="charref_email" type="text" id="" name="" spellcheck="false" required/>
              </div><br>
              
              <div class="form">  
              <label for="charref_company" class="lbl_text">Company<span style="color:red">*</span></label>
              <input  class="skills" type="text" id="" name="" spellcheck="false" required/>
              </div><br>

              <div class="form">  
              <label for="charref_designation" class="lbl_text">Designation<span style="color:red">*</span></label>
              <input  class="designation" type="text" id="name" name="name" spellcheck="false" required/>
              </div>
            
              <div class="form">  
              <input type="submit" id="" class="btn btn-info lbl_text" style="" value="Submit">
              </div>
            </div>
            {{Form::close()}}
            </div>

        </div>
    </section>

    
<script type="text/javascript">

$(document).ready(function() {
        const countrySavedValue = '{{ $user->country }}';      

        if(countrySavedValue !== '') {
        $('#countries').val(countrySavedValue);
        }
      });

  function show_about() {
    document.getElementById('about_panel').style.display = "block";
  }

  function show_educ() {
    document.getElementById('educ_panel').style.display = "block";
  }

  function show_contact() {
    document.getElementById('contact_panel').style.display = "block";
  }

  function show_work() {
    document.getElementById('work_panel').style.display = "block";
  }

  function show_charref() {
    document.getElementById('charref_panel').style.display = "block";
  }

  function hide_about(){
  document.getElementById('about_panel').style.display='none';
    }

  function hide_educ(){
  document.getElementById('educ_panel').style.display='none';
    }

  function hide_contact(){
  document.getElementById('contact_panel').style.display='none';
    }

  function hide_work(){
  document.getElementById('work_panel').style.display='none';
    }

  function hide_charref(){
  document.getElementById('charref_panel').style.display='none';
    }

  function display_about() {
  document.getElementById("display_name").innerHTML = 
  document.getElementById("user_name").value;

  document.getElementById("display_skills").innerHTML = 
  document.getElementById("user_skills").value;

  document.getElementById("display_obj").innerHTML = 
  document.getElementById("user_obj").value;
    }

  
  function display_educ() {
  document.getElementById("display_school").innerHTML = 
  document.getElementById("user_school").value;

  document.getElementById("display_fieldstudy").innerHTML = 
  document.getElementById("user_fieldstudy").value;

  document.getElementById("display_educstartdate").innerHTML = 
  document.getElementById("user_educstartdate").value;

  document.getElementById("display_educenddate").innerHTML = 
  document.getElementById("user_educenddate").value;

  document.getElementById("display_educ_desc").innerHTML = 
  document.getElementById("user_educ_desc").value;
    }


  function show_secemail() {
    document.getElementById('secemail_div').style.display = "block";
  }

  function show_secnum() {
    document.getElementById('secnum_div').style.display = "block";
  }

</script>

@endsection
