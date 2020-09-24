@extends('frontend.layouts.app')

@section('before-styles')

<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/register_style.css') }}">

    <style>
    </style>
@endsection

@section('content')
    <div  id="block_land"  >
<div class="app"></div>
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <div><img src="{{ asset('front') }}/images/rotate-screen.gif" alt=""></div>
        </div>
    </div>
    <div class="flex" >
    <section class="container-fluid" style="height:100vh">
        <div class="sub_container" style="border:0px solid white">
         <div class="page">
          <div id="overlay"></div>
                  @if(session('success'))
                      <script>

                        document.getElementById("overlay").style.display = "block";
                          $(document).ready(function(){

                            if(sweetMessage){
                                  Swal.fire({
                                      imageUrl: '../front/icons/alert-icon.png',
                                      imageWidth: 80,
                                      imageHeight: 80,
                                      imageAlt: 'Mbaye Logo',
                                      title: "<span id='success'>Congratulations!</span>",
                                      html: sweetMessage,
                                      width: '30%',
                                      padding: '1rem',
                                      background: 'rgba(8, 64, 147, 0.62)'
                                            });
                                          }
                      });
                    </script>

                       <div class="sucess_msg " >
                        <div><img  id='swal.fire' class="logo_mbaye  img-fluid"
                        src="{{ asset('front') }}/icons/alert-icon.png" />
                        </div>
                        <span class="alert-success">
                          <h2 style="color:#09b523">Congratulations!</h2>
                            <p style="font-size:1.1vw ; color: #ffffff;font-family:Nasalization">{{ session('success') }}</p>

                        </span>
                      <input type="button"  style="position: absolute; left: 45%;background:#f00000;color: #faf5f5;top: 82% ; border: hidden; border-radius: 8px;width: 6vw;height: 3vw" value="OK" class="navbar-toggle collapsed"onclick="redirectToLogin()"/>

                      </div>
                  @endif
          {{ Form::open(['route' => 'frontend.auth.register','files'=>true , 'class' => 'form-horizontal form_details', 'id'=>'MyForm','onsubmit' => 'event.preventDefault(); validateMyForm();']) }}
          <div class="page-header">
              <h1 class=" head_1 col_white" style="">CREATE YOUR PROFILE</h1>
              <p class="col_white label_info">Please fill in this form to create an account.</p>
          </div>
          <div class="div_error">
          </div>
          <br>
          <br>
          <br>
          <br>

          <div class="row border1 cls_zr">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0  border1"></div>

              <div class="col-lg-4  col-xl-3  col-sm-4  col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="first_name" class="col_white lbl_text">First Name:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8  cls_zr col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control cls_zr lbl_text @error('first_name') is-invalid @enderror" type="text" id="fname" name="first_name"  value="{{ old('first_name') }}" required/>
                          @error('first_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                  </div>
              </div>

              <div class="cls_zr col-lg-4 col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="cls_zr col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="last_name " class="col_white lbl_text">Last Name:<span style="color:red">*</span></label>
                      </div>
                      <div class="cls_zr col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                      <input type="text" class="cls_zr form-control lbl_text" id="lname" name="last_name"  value="{{ old('last_name') }}" required/>
                    </div>
                  </div>
              </div>

               <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3  col-0  border1"></div>
          </div>

        <br>

          <div class="row border1">
              <div class="col-lg-1 col-xl-2  col-sm-1 col-md-1 col-0  border1"></div>

              <div class="col-lg-4 col-xl-3 col-sm-4  col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label for ="dob"class="control-label col_white lbl_text ">Date Of Birth<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input class="form-control lbl_text" id="date" name="dob" placeholder="MM/DD/YYYY" type="date" value="{{ old('dob') }}" required onchange="calculate_age()"/>
                      </div>

                  </div>
              </div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 border1 " >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3" >
                          <label for="age" class="col_white lbl_text">Age:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" id="age" value="{{ old('age') }}" name="age" readonly>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0  border1 "></div>
          </div>
          <br>


          <div class="row  sponser_name border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1 "></div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 sponser_name border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="sname" class="col_white lbl_text">Sponsor Name:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-lg-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="sname"  value="{{ old('sponser_name') }}" name="sponser_name"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 sponser_id border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label  for="sid" class="col_white lbl_text">Sponsor ID:<span style="color:red">*</span></label>
                      </div>

                        <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="sid"  value="{{ old('sponser_id') }}" name="sponser_id"/>
                       </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 sponser_name border1"></div>
          </div>

          <!--4-->

          <br>

          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1 ">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                      <label for="gender" class="col_white lbl_text">Gender: &nbsp;<span style="color:red">*</span> </label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                        <select name="gender" class=" mb-3 form-control lbl_text" id="genders" value="{{ old('gender') }}" required>
                            <option value="" name="gender" disable selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="male">Other</option>
                        </select>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1" >
                  <div class="row">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label for="sname" class="col_white lbl_text">Address:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input  class="form-control lbl_text" type="text" id="address" value="{{ old('address') }}" required name="address"/>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 border1"></div>
          </div>

          <!--5-->

         <br>
          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3 border1" >
                          <label for="country" class="col_white lbl_text">Country:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >

                        <select id="countries" required name="country" value="{{ old('country') }}" class="form-control lbl_text output">
                          <option value="" disable selected>Select Country</option>
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
                      </div>

                  </div>
              </div>

              <div class="col-lg-4 col-xl-3 col-sm-4 col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                          <label for="id" class="col_white lbl_text">ID Number:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6  border1" >
                          <input type="text" class="form-control lbl_text" type="text" id="id_number" value="{{ old('id_number') }}" required name="id_number"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2  col-xl-4 col-sm-3 col-md-3 col-0  border1"></div>
          </div>

          <!--6-->

          <br>
          <div class="row  border1">
              <div class="col-lg-1  col-xl-2 col-sm-1  col-md-1 col-0  border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12  border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                        <label for="email" class="col_white lbl_text">Email:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8  col-sm-7 col-md-7 col-6  border1" >
                        <input type="email" class="form-control lbl_text mb-3 " id="Email" value="{{ old('email') }}"  onchange="validateEmail()" required name="email"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4 col-12  border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5 col-3  border1" >
                          <label for="mob" class="col_white lbl_text">Mobile Number:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6  border1" >
                          <input type="number" class="form-control lbl_text" id="mob_no" value="{{ old('mobile_number') }}" required name="mobile_number"/>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-xl-4 col-sm-3 col-md-3 col-0 border1 "></div>
          </div>

          <!--7-->

          <br>
          <div class="row  border1">
              <div class="col-lg-1 col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>
              <div class="col-lg-4 col-xl-3  col-sm-4  col-md-4 col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3  border1" >
                        <label for="org_type" class="col_white lbl_text">Organization Type:</label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6  border1" >
                          <select name="org_type" value="{{ old('org_type') }}" class=" form-control lbl_text" id="org_types" >
                              <option value="" disable selected>Select Organization Type</option>
                              <option value="School">School</option>
                              <option value="Club">Club</option>
                              <option value="Company">Company</option>
                              <option value="Non-profit Organization"> Non-profit Organization</option>
                              <option value="International Organization">International Organization</option>
                              <option value="Group">Group</option>
                              <option value="Individual">Individual</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5  col-3 border1" >
                        <label for="org_name" class="col_white lbl_text">Organization Name:</label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7 col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="org_name" value="{{ old('org_name') }}" name="org_name"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4  col-sm-3  col-md-3 col-0 border1"></div>
          </div>

          <!--8-->
          <br>


          <div class="row  border1 ">
              <div class="col-lg-1  col-xl-2 col-sm-1 col-md-1 col-0 border1"></div>

              <div class="col-lg-4  col-xl-3 col-sm-4 col-md-4  col-12 border1">
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5  col-md-5 col-3 border1" >
                          <label for="username" class="col_white lbl_text">Username:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input type="text" class="form-control lbl_text" id="username" value="{{ old('username') }}" required name="username"/>
                      </div>
                  </div>
              </div>

              <div class="col-lg-4  col-xl-3 col-sm-4  col-md-4 col-12 border1" >
                  <div class="row border1">
                      <div class="col-lg-4 col-xl-4 col-sm-5 col-md-5  col-3 border1" >
                          <label for="passwd" class="col_white lbl_text">Password:<span style="color:red">*</span></label>
                      </div>

                      <div class="col-lg-8 col-xl-8 col-sm-7  col-md-7 col-6 border1" >
                          <input type="password" class="form-control lbl_text"  id="password" value="{{ old('password') }}" required name="password"/>
                          <span  class="btn-showpassword" onclick="showpassword()" >
                            <i class="eye fas fa-eye"></i>
                            <i class="eye_slash fas fa-eye-slash"></i>
                          </span>
                      </div>
                  </div>
              </div>

              <div class="col-lg-2 col-xl-4  col-sm-3  col-md-3 col-0 border1"></div>
          </div>

          <br>

          <div class="row">
              <div class="col-lg-1 col-xl-2  col-sm-1  col-md-1 col-0 border1"></div>

              <div class="col-lg-4 col-xl-4 col-sm-6  col-md-6 col-7 border1">
                  <label for="u_name" class="col_white lbl_text">
                    By creating an account you agree to our&nbsp;<a id="term" style="color:#0066ff;" onmouseover="style='text-decoration:underline;color:#0066ff;'" onmouseout="style='text-decoration:none;color:#0066ff;'">Terms & Agreement.</a>
                    <input type="checkbox"   id="is_term_accept" name="is_term_accept" onchange="setCheckbox();">
                <br>
               <a href="#"></a><br>
                    Already have an account?&nbsp;<a  class="" href="{{url('/login')}}">Sign in</a>
                  </label>
              </div>

              <div class="col-lg-3 col-xl-2 col-sm-2 col-md-2 col-2 border1">
                  <input type='submit'   id="" class="btn btn-info lbl_text" style="" value='Submit'>
              </div>

              <div class="col-lg-4 col-xl-4 col-sm-3  col-md-3 col-5 border1"></div>
          </div>

          <!--form rows ends-->

         <!---camera section---->
          <div id="my_camera" class="camera_alignment" style="display: block; width: 320vw;" ></div>
          <div><input type="button"  class="btn btn-info btn_reg_snap_shot border1"  accept="image/*" capture ="camera" value="Take Snapshot" onClick="take_snapshot()"></div>
          <div><input type="button"  class="btn btn-info btn_reg_cam_reset border1"  accept="image/*" capture ="camera" value="Reset" onClick="reset_snapshot()"></div>
          <div id="results" ></div>

          <!---camera section ends---->

          <!------Occupation --------->

          <label for="occupation" class="lbl_occupation col_white lbl_text">Occupation:<span style="color:red">*</span></label>

          <img  id='cloud' class="occupation" src="{{ asset('front') }}/images/cloud_occupation_1.png"   />

          <img  class="cloud_bg mt-xl-4"  src="{{ asset('front') }}/images/speechCloud.png" >

          <textarea readonly rows="3" class='txtarea_occup' id='list_occupation' name="list_occupation" style="background:transparent;overflow-x: hidden;overflow-y: auto;resize: none;" onClick="load_animation_astronut();">{{{ Request::old('occupation') }}}</textarea>

          <!------ <input type="hidden" class="form-control txt_occup" id="occupation_text_area" value="{{ old('occupation') }}" required name="list_occupation" /> ---->
          <!------Occupation ends---->

          <!--hidden fields -->

          <div class="container">
          <div class="row ">
             <div class="col-lg-12 col-xl-12" >
                <div><input type="hidden" class="form-control"  id="img_photo_register" name="photo"  value="{{ old('photo') }}" /></div>
                <div><input type="hidden" class="form-control"  id="id" name="img_id"/></div>
                <!-- <div><input type="text" class="form-control"  name="occupation" id="occupation_txt"  value="{{ old('occupation') }}" /> </div> -->
                <input type="hidden" name="occupation" id="occupation" value="{{ old('occupation') }}">
                <div><input type="hidden" class="form-control"  id="pk_user_id" name="pk_user_id"/>
              </div></div>
          </div></div>
          <!------hidden fields-->

          <!-------------------------------------------------------------->
          <!------------------For astronut div---------------------------->

        <div class="div_for_astro" style="display:none" >
        <img id="div" src="{{ asset('front') }}/images/close-btn.png" style="width:3%;max-width:100%;height:auto; z-index: 1; " align="right">
        <img class="astro_occupation"  style="display:none"  src="{{ asset('front') }}/images/astronut/backpack 2.png">
          <div id = 'viki' class="div_helmet"  style="display:none" onClick="goto_wiki2()"></div>
          <div class="occ_description" style="display:none">
          <p>
            Hello,<br>I am <span id = 'divv' onClick="openwikipedia()" style="color: chocolate;">General Michael.</span>
            <br>Your occupation in life will <br> most probably change, <br> as these changes of life go on,
            <br>you should be able to note <br> here on your site.
            <br><br>The record of your occupations <br> will stay here forever.
            <br><br>So if your occupation is, example; <br> shoveling poo from a
            <span style="color:#c6552b" onClick="show_cuckoo()" title="Click here to know about  cuckoo clock">cuckoo clock</span>.
            <br><br>And then you become an astronaut.
            <br><br>It will be always on your profile.
            <br><br>So have fun, but remember everything <br> you say in life can have a consequence.
          </p>
          <br>
          <center><div class="txtocp"><input type="text" class="text_occup"  id="text_occupation_astro" placeholder="Your occupation" value="{{ old('occupation') }}"/></div></center>
          <br class="">
          <button type="button" class="btn btn-info btn_occ_submit">Submit</button>
          </div>
          <div class="div_clock overlay" style="display:none" >
          <img  class='cuckoo_image'  title="Cuckoo clock" src="{{ asset('front') }}/images/astronut/cuckoo clock.png">
          <p class="cuckoo_text">A Cuckoo clock as in the picture is a German black forest clock
                                 with a little bird that comes out  and goes cuckoo. Actually
                                 somebody  really useless in life like villa the crab.
                                 We say they are so useless they couldn’t shovel poo out of a cuckoo clock.
          </p>
      </div>
        </div>
      {{ Form::close() }}

  <!-------Form Details End---------->

  <!---------------------------------Constellation images ----------------------------------------->
<div class="box_for_stars" style="position:fixed; top:0; left:0; width:100vw;height:100vh;z-index: -10;">
  <div id='constellations'>

     <span class="text_Aquaris" style=""><i>Aquarius</i></span>
      <img class='aquarius aq_normal img_1' title="Aquarius" src="{{ asset('front') }}/images/constellations/aquarius_1.png">

  </div>

  <div class="cls_zc">
      <span class="text_Aries" style=""><i>Aries</i></span>
      <img  class='aries ar_normal img_1 cls_zc'  title="Aries" src="{{ asset('front') }}/images/constellations/aries_1.png">

  </div>

  <div class="cls_zc">
      <span class="text_Cancer" style="" ><i>Cancer</i></span>
      <img  class='cancer c_normal img_1 cls_zc' title="Cancer" src="{{ asset('front') }}/images/constellations/cancer_1.png">

  </div>

  <div class="cls_zc">
    <span class="text_Capricorn"  style=""><i>Capricorn</i></span>
    <img  class='capricorn cp_normal img_1 cls_zc' title="Capricorn" src="{{ asset('front') }}/images/constellations/capricorn_1.png">

  </div>

  <div  class="cls_zc">
    <span class="text_Libra" style=""><i>Libra</i></span>
    <img  class='libra  li_normal img_1 cls_zc' title="Libra" src="{{ asset('front') }}/images/constellations/libra_1.png">

  </div>

  <div  class="cls_zc">
    <span class="text_Gemini" style=""><i>Gemini</i></span>
    <img  class='gemini gm_normal img_1 cls_zc' title="Gemini" src="{{ asset('front') }}/images/constellations/gemini_1.png">

  </div>

  <div  class="cls_zc">
    <span class="text_Leo" style=""><i>Leo</i></span>
    <img  class='leo  le_normal img_1 cls_zc' title="Leo" src="{{ asset('front') }}/images/constellations/leo_1.png">

  </div>

  <div class="cls_zc">
    <span class="text_Pisces" style=""><i>Pisces</i></span>
    <img  class='pisces  p_normal img_1 cls_zc' title="Pisces" src="{{ asset('front') }}/images/constellations/pisces_1.png">

  </div>

  <div class="cls_zc">
    <span class="text_Sagittarius" style=""><i>Sagittarius</i></span>
    <img  class='sagittarius sg_normal img_1 cls_zc'  title="Sagittarius" src="{{ asset('front') }}/images/constellations/sagittarius_1.png">


  </div>

  <div class="cls_zc">
    <span class="text_Scorpio" style=""><i>Scorpio</i></span>
    <img  class='scorpio sc_normal img_1 cls_zc'  title="Scorpio" src="{{ asset('front') }}/images/constellations/scorpio_1.png">

  </div>

  <div class="cls_zc" >
    <span class="text_Taurus" style=""><i>Taurus</i></span>
    <img  class='taurus t_normal img_1 cls_zc' title="Taurus" src="{{ asset('front') }}/images/constellations/taurus_1.png">

  </div>

  <div class="cls_zc">
    <span class="text_Virgo" style=""><i>Virgo</i></span>
    <img  class='virgo v_normal img_1 cls_zc'  title="Virgo" src="{{ asset('front') }}/images/constellations/virgo_1.png">

  </div></div>


      <!--- div for helmet--->



      <!--------------------->

      <!-------------------------------------------------------------->
      <!--audio for cuckoo clock -->
  <audio id="audio_cuckoo" src="{{ asset('front') }}/images/astronut/Cuckoo.wav"></audio>
      <!-------------------------------------------------------------->

      <!----wikipedia div -->
      <div id = "div_for_wikki"  >
  <div id="Div_for_wiki">
      <img class="close_btn" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute;left:94%;width:4%;max-width:100%;height:auto; z-index: 1; " align="right" onclick="hidePage()"/>
      <object id="wikiPage" type="text/html" data="" style="overflow:auto;width:100%;height: 100%;">
      </object>
  </div>
  <div id="Div_for_wiki2">
      <img  class="close_btn2" src="{{ asset('front') }}/images/close-btn.png" style="position:absolute;left:94%;width:4%;max-width:100%;height:auto; z-index: 1; " align="right" onclick="hidePage2()"/>
      <object id="wikiPage2" type="text/html" data="" style="overflow:auto;width:100%;height: 100%;">
      </object>/
  </div></div>
  <!----------------->



<!-- Modal -->

<!-- The Modal -->

  <!-- The Modal -->
  <div class="modal" id="myModal" style="z-index:50000;height: 35vw;top: 6vw;width: 82vw !important">

      <div class="modal-content" style="width: 67vw;left: 15vw">

        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">TERMS OF SERVICE AGREEMENT</h1>
          <br>

          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <h5 class="">LAST REVISION: [16-03-2020]</h5><br>
          <p class="">
            PLEASE READ THIS TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
          </p>

          <p class="">
            This Terms of Service Agreement (the "Agreement") governs your use of this website, www.Mbaye.com (the "Website. This Agreement includes,
            and incorporates by this reference, the policies and guidelines referenced below. Inox Arabia FZC and associated companies reserve the
             right to change or revise the terms and conditions of this Agreement at any time by posting any changes or a revised Agreement on
              this Website. Inox Arabia FZC and associated companies will alert you that changes or revisions have been made by indicating on the
              top of this Agreement the date it was last revised. The changed or revised Agreement will be effective immediately after it is
               posted on this Website. Your use of the Website following the posting any such changes or of a revised Agreement will constitute
                your acceptance of any such changes or revisions. Inox Arabia FZC and associated companies encourage you to review this Agreement
                 whenever you visit the Website to make sure that you understand the terms and conditions governing use of the Website. This
                 Agreement does not alter in any way the terms or conditions of any other written agreement you may have with Inox Arabian
                  Technical Services LLC for other products or services. If you do not agree to this Agreement (including any referenced
                  policies or guidelines), please immediately terminate your use of the Website. If you would like to print this Agreement,
                   please click the print button on your browser toolbar.
          </p>


        <h3 class="">I. WEBSITE</h3>

        <p class="">
        <b>Content; Intellectual Property; Third Party Links.</b>
         In addition to making Products available, this Website also offers information and allows you to play game. This Website also offers
          information, both directly and through indirect links to third-party websites. Mbaye.com does not always create the information offered
           on this Website; instead the information is often gathered from other sources. To the extent that Inox Arabia FZC and associated companies
           do create the content on this Website, such content is protected by intellectual property laws of the foreign nations, and international
           bodies. Unauthorized use of the material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content
           on this Website is for personal, noncommercial use. Any links to third-party websites are provided solely as a convenience to you.
            Inox Arabia FZC and associated companies do not endorse the contents on any such third-party websites.
             Inox Arabia FZC and associated companies are not responsible for the content of or any damage that may result from your access to or reliance
              on these third-party websites. If you link to third-party websites, you do so at your own risk.
        </p>


        <p class="">
          <b>Use of Website;</b>
           Inox Arabia FZC and associated companies are not responsible for any damages resulting from use of this website by anyone. You will not use
            the Website for illegal purposes. You will
           <ul>
             <li>
                Abide by all applicable local, state, national, and international laws and regulations in your use of the Website (including laws
                regarding intellectual property)
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

        <p class="">
          <b>License.</b> By using this Website, you are granted a limited, non-exclusive, non-transferable right to use the content and materials on
           the Website in connection with your normal, noncommercial, use of the Website. You may not copy, reproduce, transmit, distribute, or create
            derivative works of such content or information without express written authorization from Inox Arabia FZC and associated companies or the applicable
             third party (if third party content is at issue).
        </p>
        <br>

        <p class="">
          <b>Posting.</b> By posting, storing, or transmitting any content on the Website, you hereby grant Inox Arabia FZC and associated companies a perpetual,
           worldwide, non-exclusive, royalty-free, assignable, right and license to use, copy, display, perform, create derivative works from, distribute,
            have distributed, transmit and assign such content in any form, in all media now known or hereinafter created, anywhere in the world.
            Inox Arabia FZC and associated companies do not have the ability to control the nature of the user-generated content offered through the Website.
            You are solely responsible for your interactions with other users of the Website and any content you post. Inox Arabia FZC and associated companies
            is not liable for any damage or harm resulting from any posts by or interactions between users. Inox Arabia FZC and associated companies reserve
            the right, but has no obligation, to monitor interactions between and among users of the Website and to remove any content Inox Arabian
            Technical Services LLC deems objectionable.
          </p>
          <br>

          <h3 class="">II. DISCLAIMER OF WARRANTIES</h3>
          <p class="">
                  YOUR USE OF THIS WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE IS OFFERED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WITHOUT LIMITING
                   THE GENERALITY OF THE FOREGOING, INOX ARABIA FZC AND ASSOCIATED COMPANIES  MAKE NO WARRANTY:
              THAT THE INFORMATION PROVIDED ON THIS WEBSITE IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
              THAT THE LINKS TO THIRD-PARTY WEBSITES ARE TO INFORMATION THAT IS ACCURATE, RELIABLE, COMPLETE, OR TIMELY.
              NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM THIS WEBSITE WILL CREATE ANY WARRANTY NOT EXPRESSLY STATED HEREIN.
          </p>

          <br>
          <h3 class="">III. INDEMNIFICATION</h3>
          <p class="">
            You will release, indemnify, defend and hold harmless Inox Arabia FZC and associated companies, and any of its contractors, agents, employees,
             officers, directors, shareholders, affiliates and assigns from all liabilities, claims, damages, costs and expenses, including reasonable
              attorneys' fees and expenses, of third parties relating to or arising out of
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
                any information or data you supplied to Inox Arabia FZC and associated companies. When Inox Arabia FZC and associated companies is threatened with
                suit or sued by a third party, Inox Arabia FZC and associated companies may seek written assurances from you concerning your promise to indemnify
                Inox Arabia FZC and associated companies;
              </li>
            </ul>
              <p class="">
                  your failure to provide such assurances may be considered by Inox Arabia FZC and associated companies to be a material breach of this Agreement.
                   Inox Arabia FZC and associated companies will have the right to participate in any defense by you of a third-party claim related to your use of
                    any of the Website content, with counsel of Inox Arabia FZC and associated companies choice at its expense. Inox Arabia FZC and associated companies
                    will reasonably cooperate in any defense by you of a third-party claim at your request and expense. You will have sole responsibility to
                    defend Inox Arabia FZC and associated companies against any claim, but you must receive Inox Arabia FZC and associated companies prior written
                    consent regarding any related settlement. The terms of this provision will survive any termination or cancellation of this Agreement
                     or your use of the Website or Products.
          </p>
          <br>

          <h3 class="">IV. PRIVACY</h3>
          <p class="">
            Inox Arabia FZC and associated companies believe strongly in protecting user privacy and providing you with notice of Mbaye.com’s use of data.
             Please refer to Inox Arabia FZC and associated companies privacy policy, incorporated by reference herein that is posted on the Website.
          </p>
          <br>

          <h3 class="">V. AGREEMENT TO BE BOUND</h3>
          <p class="">
            By using this Website, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions on this Website.
          </p>
          <br>

          <h3 class="">VI. GENERAL</h3>
          <p class="">
            <b>Force Majeure.</b> Inox Arabia FZC and associated companies will not be deemed in default hereunder or held responsible for any cessation,
             interruption or delay in the performance of its obligations hereunder due to earthquake, flood, fire, storm, natural disaster, act of God,
              war, terrorism, armed conflict, labor strike, lockout , boycott or any national or international pandemic.
          </p>
          <br>

          <p class="">
            <b>Cessation of Operation. </b> Inox Arabia FZC and associated companies may at any time, in its sole discretion and without advance notice to you,
             cease operation of the Website and distribution of the Products.
          </p>
          <br>

          <p class="">
            <b>Entire Agreement.</b> This Agreement comprises the entire agreement between you and Inox Arabia FZC and associated companies and supersedes any
            prior agreements pertaining to the subject matter contained herein.
         </p>
          <br>

          <p class="">
            <b>Effect of Waiver.</b> The failure of Inox Arabia FZC and associated companies to exercise or enforce any right or provision of this Agreement
            will not constitute a waiver of such right or provision. If any provision of this Agreement is found by a court of competent jurisdiction to
             be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the
             provision, and the other provisions of this Agreement remain in full force and effect.
          </p>
          <br>

          <p class="">
            <b>Governing Law; Jurisdiction. </b> This Website originates from the Dubai, United Arab Emirates, This Agreement will be governed by the
            laws of the State of European Union  without regard to its conflict of law principles to the contrary. Neither you nor
             Inox Arabia FZC and associated companies will commence or prosecute any suit, proceeding or claim to enforce the provisions of this
              Agreement, to recover damages for breach of or default of this Agreement, or otherwise arising under or by reason of this Agreement,
               other than in courts located in State of European Union . By using this Website or ordering Products, you consent to the jurisdiction
                and venue of such courts in connection with any action, suit, proceeding or claim arising under or by reason of this Agreement.
                You hereby waive any right to trial by jury arising out of this Agreement and any related documents.
          </p>
          <br>

          <p class="">
            <b>Statute of Limitation. </b> You agree that regardless of any statute or law to the contrary, any claim or cause of action arising
            out of or related to use of the Website or Products or this Agreement must be filed within one (1) year after such claim or cause of
            action arose or be forever barred.
          </p>
          <br>

          <p class="">
            <b>Waiver of Class Action Rights.  </b> BY ENTERING INTO THIS AGREEMENT, YOU HEREBY IRREVOCABLY WAIVE ANY RIGHT YOU MAY HAVE TO JOIN
            CLAIMS WITH THOSE OF OTHER IN THE FORM OF A CLASS ACTION OR SIMILAR PROCEDURAL DEVICE. ANY CLAIMS ARISING OUT OF, RELATING TO, OR
            CONNECTION WITH THIS AGREEMENT MUST BE ASSERTED INDIVIDUALLY.
         </p>
          <br>

          <p class="">
            <b>Termination. </b> Inox Arabia FZC and associated companies reserve the right to terminate your access to the Website if it reasonably
            believes, in its sole discretion, that you have breached any of the terms and conditions of this Agreement. Following termination,
            you will not be permitted to use the Website and Inox Arabia FZC and associated companies may, in its sole discretion and without advance
             notice to you, cancel any outstanding orders for Products. If your access to the Website is terminated, Inox Arabia FZC and associated companies
              reserves the right to exercise whatever means it deems necessary to prevent unauthorized access of the Website. This Agreement will
               survive indefinitely unless and until Inox Arabia FZC and associated companies choose, in its sole discretion and without advance to you, to terminate it.
          </p>


          <p class="">
            <b>Domestic Use. </b> Inox Arabia FZC and associated companies make no representation that the Website is appropriate or available for use in
            locations outside UAE. Users who access the Website from outside UAE do so at their own risk and initiative and must bear all responsibility
            for compliance with any applicable local laws.
          </p>
          <br>

          <p class="">
            <b>Assignment. </b> You may not assign your rights and obligations under this Agreement to anyone. Inox Arabia FZC and associated companies may
            assign its rights and obligations under this Agreement in its sole discretion and without advance notice to you.
         </p>
          <br>

          <p class="">
            BY USING THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.
          </p>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="btn_agree" class="btn btn-success" data-dismiss="modal">I Agree</button>
          <button type="button" id="btn_dagree" class="btn btn-danger" data-dismiss="modal">I Disagree</button>
        </div>

      </div>

  </div>



</div>
<!---model ends -->
        </div>
    </section>
@endsection

@section('after-scripts')
    <!-----------------------------------   script section ------------------------------------------>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="{{ asset('front') }}/JS/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
    <script src="{{ asset('front') }}/JS/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('front/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('front') }}/JS/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

        <!-- Webcam.min.js -->
    <!--------------------------------------- For camera--------------------------------------------->

  <script language="JavaScript">

   Webcam.set({
   width: 240,
   height: 240,
   image_format: 'jpeg',
   jpeg_quality: 90
  });
  Webcam.attach( '#my_camera' );

 // A button for taking snaps


 function take_snapshot() {

  // take snapshot and get image data
  Webcam.snap( function(data_uri) {
  // display results in page
  document.getElementById('results').innerHTML =
   '<img id="imageprev" src="'+data_uri+'"/>';
  } );

  Webcam.reset();
 }

  $("#MyForm input#text_occupation_astro").keyup(function(){
  var value = $(this).val();
    $("#MyForm input#occupation").val(value);
});
    </script>
    <!--------------------------------------- Manual script ------------------------------------------>
 <script>


  window.onload = function() {
        calculate_age();
  };

//Get old selected gender, country, organization type;
        $(document).ready(function() {
          var url = $('meta[name="url"]').attr('content');
          // $("#date").datepicker({
          //   constrainInput:"true",
          //   dateFormat:"mm/dd/yy"
          // });


          var maskConfig = {
                leapday: "29-02-",
                separator: "/",
                showMaskOnHover: false,
                showMaskOnFocus: false,
                placeholder: "__/__/____"
          }

          // $('#date').inputmask('mm/dd/yyyy',maskConfig);
          $(".datepicker").css({'display':'none'});

        //   $('#date').on('change', function() {
        //     if(this.value){
        //       $(this).attr('data-date', moment(this.value, 'MM/DD/YYYY').format($(this).attr('data-dateformat')));
        //     } else{
        //       $(this).attr('data-date', '');
        //     }

        // });

          var elem = document.documentElement;
        function openFullscreen()
         {
            if (elem.mozRequestFullScreen) {  /* Firefox */
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
            else{ 
                contentDisplay();
            }

        }
if(window.innerWidth < 991 ){
$(document).ready(()=>{
    Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
            padding: '15px',
            background: 'rgba(8, 64, 147, 0.62)',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen()
            }
        });
    });
}
else  contentDisplay();

function contentDisplay() { 
  
  
  setTimeout(function(){
        $(".sub_container").show();  
        $(".sub_container").addClass('animate-zoomIn-arm');
        $('.sub_container').on("webkitAnimationEnd oanimationend msAnimationEnd animationend",
          function(){ 
            //  $(".sub_container").removeClass('animate-zoomIn-armanimate-zoomIn-arm');
            //  $(".sub_container").addClass('zoomIn-arm');
                  });
                 }, 1000 );
}
        const genderOldValue = '{{ old('gender') }}';
        const countryOldValue = '{{ old('country') }}';
        const orgtypeOldValue = '{{ old('org_type') }}';

        if(genderOldValue !== '') {
        $('#genders').val(genderOldValue);
        }

        if(countryOldValue !== '') {
        $('#countries').val(countryOldValue);
        }

        if(orgtypeOldValue !== '') {
        $('#org_types').val(orgtypeOldValue);
        }
        });

        //var global_occupation='';
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
                $('section').show();
            }
            else{
                 document.getElementById('block_land').style.display =  'block';
                  $('section').hide();
            }
    }
    function show_cuckoo(){
        $('.div_clock').css({'display':'block'});
        var audio = document.getElementById("audio_cuckoo");
        audio.playbackRate =1;
        audio.play();
        }
        $(document).ready(function () {


          var options = {
                          data: countries,
                          getValue: "name",
                          list: {
                              match: {
                                  enabled: true
                              }
                          }
               };


//$("#countries").easyAutocomplete(options);


    //for identifying zordiac sign in the edit mode
   // $("#list_occupation ").hide();
    $(".close_btn ").hide();

    var org='';
    var country='';
    //var occupation='';
    var gender='';
    var count='';
    var width='';
    var height='';



 org='DUMMY';
 country='dummy';

 /* For occupation cloud */

 //occupation='dummy';

 gender='dummy';
 count='dummy';
 width = document.getElementById('cloud').offsetWidth;
 height = document.getElementById('cloud').offsetHeight;
 if(count>=4){
    width=width+1;
    height=height+15;

 }


document.getElementById('countryIds').value = country;


/* $("#list_occupation").show();
$("#list_occupation ").html(occupation);
if(occupation!='')
  $("#list_occupation ").val(occupation.split(",").join("\n"));
global_occupation=occupation; */


var encodedString='dummy';
var img_src='';
var img_src=decodeURIComponent(encodedString);
document.getElementById('my_camera').innerHTML =
       '<img  name="photo" id="img_photo"class="cam_photo camera" style="" src="'+img_src+'"/>';



    //For the name  of zordiac signs
    $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
    $(".text_Pisces").removeClass("ani-rollouttext_Pisces");
    $(".text_Aries ").removeClass("ani-rollouttext_Aries");
    $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
    $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
    $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
    $(".text_Leo").removeClass("ani-rollouttext_Leo");
    $(".text_Virgo").removeClass("ani-rollouttext_Virgo");
    $(".text_Libra ").removeClass("ani-rollouttext_Libra");
    $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
    $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
    $(".text_Capricorn").removeClass("ani-rollouttext_Capricorn");

    //$('.img_2').css({'display':'none'});
    $('.img_1').css({'display':'block'});

    $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
    $('.text_Aquaris').css({'display':'none'});
    $(".text_Pisces ").removeClass("ani-rollouttext_Pisces");
    $('.text_Pisces').css({'display':'none'});
    $(".text_Aries ").removeClass("ani-rollouttext_Aries");
    $('.text_Aries').css({'display':'none'});
    $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
    $('.text_Taurus').css({'display':'none'});
    $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
    $('.text_Gemini').css({'display':'none'});
    $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
    $('.text_Cancer').css({'display':'none'});
    $(".text_Leo ").removeClass("ani-rollouttext_Leo");
    $('.text_Leo').css({'display':'none'});
    $(".text_Virgo ").removeClass("ani-rollouttext_Virgo");
    $('.text_Virgo').css({'display':'none'});
    $(".text_Libra ").removeClass("ani-rollouttext_Libra");
    $('.text_Libra').css({'display':'none'});
    $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
    $('.text_Scorpio').css({'display':'none'});
    $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
    $('.text_Sagittarius').css({'display':'none'});
    $(".text_Capricorn ").removeClass("ani-rollouttext_Capricorn");
    $('.text_Capricorn').css({'display':'none'});
    $(".sponser_name").hide(); //for hiding sponser name and sponser id

    calculate_age();
    // Date time picker change value
    $('#date').change(function(){
    $(this).attr('value', $('#date').val());
    $("#age").val(' ');
});
//combo box  value setting
//loadSelect_for_country(country);
if(org!='')
 loadSelect_for_org_type(org);
 if(gender!='')
 loadSelect_for_gender(gender);
});

            /*
            Button click function for registration
            */
          /*  $('#btn_Register').click(function(){

             /* var str_occupation= $("#text_occupation_astro").val();   */
             /* $("#occupation_txt").val(str_occupation);
             var str = $("form").serializeArray();

                     $.ajax({
                        type: "POST",
                        url: "http://localhost/Mbaye/index.php/home/Save_registration_details",
                        data: str,
                        dataType: "json",
                        success: function (result) {
                          var msg =  result;
                          alert(msg);

                        },
                        error: function () {
                         alert("Error while Registering!!");
                        }
                    });


                  }); */
                   $('#div').click(function(){
                   $('.div_for_astro').css('display','none');})
                   $('#div').click(function(){
                   $('.div_for_astro').css('display','none');
                   $('#Div_for_wiki').css('display','none');
                   $('#Div_for_wiki2').css('display','none');
                   $('.div_clock').css('display','none');
                   $('.occ_description').css('display','none');
                 })
            /*
            * Click function  for cloud to view the astronut with description
            */
            $('.astro_occupation').css({'display':'block'});
            $('.div_for_astro').css({'display':'none'});
            //$(".astro_occupation ").removeClass("img_astro");

            $('#cloud').click(function(){
                load_animation_astronut();
            });

            $(".btn_occ_submit").click(function(e){

              $(".astro_occupation ").removeClass("img_astro_down");
              var occ_astro=$("#text_occupation_astro").val();
              if(occ_astro=='' || occ_astro==null){
                alert("Please Enter Your Occupation !!");
              }
              else{
               /* var str_occupation= $("#text_occupation_astro").val();
                var occ_astro=$("#text_occupation_astro").val(); */

                $("#list_occupation ").html('');
                $("#list_occupation ").html(occ_astro);
                $("#list_occupation ").val(occ_astro.split(",").join("\n"));
                hidePage();
                hidePage2();



               // $("#text_occupation_astro").val()
                $('.occ_description').css({'display':'none'});
                $('.text_occup').css({'display':'none'});
                $('.btn_occ_submit').css({'display':'none'});
                $('.div_clock').css({'display':'none'});
                $('.div_helmet').css({'display':'none'});
                $('.txtarea_occup').css({'display':'block'});
                  //for playing audio

                  var audio = document.getElementById("audio_cuckoo");
                  audio.playbackRate =1;
                  audio.play();


                $('.div_for_astro').css({'display':'none'});
                $(".astro_occupation ").addClass("img_astro_down");

                setTimeout(function(){

                    $('.astro_occupation').css({'display':'none'});


                    $(".astro_occupation ").removeClass("img_astro_down");
                 });

              }
                  //load_animation_astronut();

            });

            /*$('#list_occupation').click(function(){

            load_animation_astronut();
            $('.div_for_astro').css({'display':'none'});
                $(".astro_occupation ").addClass("img_astro_down");

              });*/

            function load_animation_astronut(){

              $('.astro_occupation').css({'display':'block'});
              $('.div_for_astro').css({'display':'block'});
              $('.astro_occupation').css({'display':'block'});
              $(".astro_occupation ").addClass("img_astro");
              $('.text_occup').css({'display':'block'});
              $('.btn_occ_submit').css({'display':'block'});

              setTimeout(function(){
                $('.occ_description').css({'display':'block'});
                $('.div_helmet').css({'display':'block'});

                 }, 3000);

            }


            /*
            Function to take snapshot
            */
            function take_snapshot() {

               $('#my_camera').css({'border':'0px'});
                 // take snapshot and get image data
                   Webcam.snap( function(data_uri) {
                  // display results in page
                   document.getElementById('my_camera').innerHTML =
                   '<img  name="photo" id="img_photo"class="camera" style="object-fit: cover"; src="'+data_uri+'"/>';
                  $("#img_photo_register").val(data_uri);
                  } );

                }
             
            //Function for age calculation
            function calculate_age()
            {
              $("#sname").removeAttr('required');
              $("#sid").removeAttr('required');
              $("#age").val(' ');
              //DATE validation
              var dob=$("#date").val();

                //$('.img_2').css({'display':'none'});
                $('.img_1').css({'display':'block'});
                $(".text_Aquaris ").removeClass("ani-rollouttext_Aquaris");
                $('.text_Aquaris').css({'display':'none'});
                $('.aq_normal').css({'filter': 'none'});
                $(".text_Pisces ").removeClass("ani-rollouttext_Pisces");
                $('.text_Pisces').css({'display':'none'});
                $('.p_normal').css({'filter': 'none'});
                $(".text_Aries ").removeClass("ani-rollouttext_Aries");
                $('.text_Aries').css({'display':'none'});
                $('.ar_normal').css({'filter': 'none'});
                $(".text_Taurus ").removeClass("ani-rollouttext_Taurus");
                $('.text_Taurus').css({'display':'none'});
                $('.t_normal').css({'filter': 'none'});
                $(".text_Gemini ").removeClass("ani-rollouttext_Gemini");
                $('.text_Gemini').css({'display':'none'});
                $('.gm_normal').css({'filter': 'none'});
                $(".text_Cancer ").removeClass("ani-rollouttext_Cancer");
                $('.text_Cancer').css({'display':'none'});
                $('.c_normal').css({'filter': 'none'});
                $(".text_Leo ").removeClass("ani-rollouttext_Leo");
                $('.text_Leo').css({'display':'none'});
                $('.le_normal').css({'filter': 'none'});
                $(".text_Virgo ").removeClass("ani-rollouttext_Virgo");
                $('.text_Virgo').css({'display':'none'});
                $('.v_normal').css({'filter': 'none'});
                $(".text_Libra ").removeClass("ani-rollouttext_Libra");
                $('.text_Libra').css({'display':'none'});
                $('.li_normal').css({'filter': 'none'});
                $(".text_Scorpio ").removeClass("ani-rollouttext_Scorpio");
                $('.text_Scorpio').css({'display':'none'});
                $('.sc_normal').css({'filter': 'none'});
                $(".text_Sagittarius ").removeClass("ani-rollouttext_Sagittarius");
                $('.text_Sagittarius').css({'display':'none'});
                $('.sg_normal').css({'filter': 'none'});
                $(".text_Capricorn ").removeClass("ani-rollouttext_Capricorn");
                $('.text_Capricorn').css({'display':'none'});
                $('.cp_normal').css({'filter': 'none'});

                
                var zordiac=check_zordiac(dob); // Checking zordiac signs

            if(dob!=''){
                if(zordiac=='Aquarius')
                {
                  $('.text_Aquaris').css({'display':'block'});
                  $(".text_Aquaris ").addClass("ani-rollouttext_Aquaris");
                  $('.aq_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
                }
                else if(zordiac=='Pisces')
                {
                  $('.text_Pisces').css({'display':'block'});
                  $(".text_Pisces ").addClass("ani-rollouttext_Pisces");
                  $('.p_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
                }
                else if(zordiac=='Cancer')
                {
                  $(".text_Cancer ").addClass("ani-rollouttext_Cancer");
                  $('.text_Cancer').css({'display':'block'});
                  $('.c_normal').css({'filter': 'drop-shadow(0px 2px 3px #2b4fff)'});
                }
                else if(zordiac=='Taurus')
                {
                  $(".text_Taurus ").addClass("ani-rollouttext_Taurus");
                  $('.text_Taurus').css({'display':'block'});
                  $('.t_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});
                }
                else if(zordiac=='Gemini')
                {
                  $(".text_Gemini ").addClass("ani-rollouttext_Gemini");
                  $('.text_Gemini').css({'display':'block'});
                  $('.gm_normal').css({'filter': 'drop-shadow(0px 2px 3px #b905f5)'});
                }
                else if(zordiac=='Aries')
                {
                   $(".text_Aries ").addClass("ani-rollouttext_Aries");
                   $('.text_Aries').css({'display':'block'});
                   $('.ar_normal').css({'filter': 'drop-shadow(0px 2px 3px #e00202)'});
                }
                else if(zordiac=='Leo')
                {
                  $(".text_Leo ").addClass("ani-rollouttext_Leo");
                  $('.text_Leo').css({'display':'block'});
                  $('.le_normal').css({'filter': 'drop-shadow(0px 2px 3px #f5dc00)'});
                }
                else if(zordiac=='Virgo')
                {
                  $(".text_Virgo ").addClass("ani-rollouttext_Virgo");
                  $('.text_Virgo').css({'display':'block'});
                  $('.v_normal').css({'filter': 'drop-shadow(0px 2px 3px #00f234)'});
                }
                else if(zordiac=='Libra')
                {
                  $(".text_Libra ").addClass("ani-rollouttext_Libra");
                  $('.text_Libra').css({'display':'block'});
                  $('.li_normal').css({'filter': 'drop-shadow(0px 2px 3px #3700ed)'});



                }
                else if(zordiac=='Scorpio')
                {
                  $(".text_Scorpio ").addClass("ani-rollouttext_Scorpio");
                  $('.text_Scorpio').css({'display':'block'});
                  $('.sc_normal').css({'filter': 'drop-shadow(0px 2px 3px #bd0202)'});
                }
                else if(zordiac=='Sagittarius')
                {
                  $(".text_Sagittarius ").addClass("ani-rollouttext_Sagittarius");
                  $('.text_Sagittarius').css({'display':'block'});
                  $('.sg_normal').css({'filter': 'drop-shadow(0px 2px 3px #8502bd)'});
                }
                else // Capricorn
                {
                  $(".text_Capricorn ").addClass("ani-rollouttext_Capricorn");
                  $('.text_Capricorn').css({'display':'block'});
                  $('.cp_normal').css({'filter': 'drop-shadow(0px 2px 3px #00a323)'});
                }
              }



            //  var dat_Validation=isValidDate(dob); //commented for now
            var dat_Validation=true;
                if(dat_Validation==true)
                 {
                     var dob=$("#date").val();
                     $("#age").val(' ');
                    if(dob!=''){
                        d1=new Date(dob);
                        d2 = new Date();
                          var diff = d2.getTime() - d1.getTime();
                          age= Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));

                          if( Number.isNaN(age)==true){
                            age='';
                          }
                            
                          if(age<0)
                            age=0;
                          $("#age").val(age);

                          if(age<18)
                          {
                          $(".sponser_name").show();
                          $(".sponser_hide").show();
                          document.getElementById("sname").required = true;
                          document.getElementById("sid").required = true;

                          }
                          else{
                            $(".sponser_name").hide();
                            $(".sponser_hide").hide();
                            $("#sname").removeAttr('required');
                            $("#sid").removeAttr('required');
                          }
                        }
                }
                else{
                  alert("Invalid DOB!");
                  $("#date").val('');
                }
            }


            /*
            Function to check zordiac signs with DOb
            */

            function check_zordiac(dob){

               // Parse the date parts to integers
                var parts   = dob.split("-");
                var day     = parseInt(parts[2], 10); //day
                var month   = parseInt(parts[1], 10); //month
                var year    = parseInt(parts[0], 10); //year
                var zordiac='';
                // alert(month)

                if(dob!='')
                {
                  if(month==1){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Aquarius';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Capricorn';
                            }
                           
                  }
                  else if(month==2){
                          if(day>=19 && day<=31)
                            {
                              zordiac='Pisces';
                            }
                            else if(day>=1 && day<=18)
                            {
                              zordiac='Aquarius';
                            }
                  }
                  else if(month==3){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Aries';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Pisces';
                            }
                  }
                  else if(month==4){
                          if(day>=21 && day<=31)
                            {
                              zordiac='Taurus';
                            }
                            else if(day>=1 && day<=20)
                            {
                              zordiac='Aries';
                            }
                  }
                  else if(month==5){
                          if(day>=22 && day<=31)
                            {
                              zordiac='Gemini';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Taurus';
                            }
                  }
                  else if(month==6){
                          if(day>=22 && day<=31)
                            {
                              zordiac='Cancer';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Gemini';
                            }
                  }
                  else if(month==7){
                          if(day>=24 && day<=31)
                            {
                              zordiac='Leo';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Cancer';
                            }
                  }
                  else if(month==8){
                          if(day>=24 && day<=31)
                            {
                              zordiac='Virgo';
                            }
                            else if(day>=1 && day<=23)
                            {
                              zordiac='Leo';
                            }
                  }
                  else if(month==9){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Libra';
                            }
                            else if(day>=1 && day<=22)
                            {
                              zordiac='Virgo';
                            }
                  }
                  else if(month==10){
                          if(day>=23 && day<=31)
                            {
                              zordiac='Scorpio';
                            }
                            else if(day>=1 && day<=23)
                            {
                              zordiac='Libra';
                            }
                  }

                  else if(month==11){
                          if(day>=22 && day<=31)
                            {
                              zordiac='Sagittarius';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Scorpio';
                            }
                  }
                else{     //if(month==12)
                          if(day>=22 && day<=31)
                            {
                              zordiac='Capricorn';
                            }
                            else if(day>=1 && day<=21)
                            {
                              zordiac='Sagittarius';
                            }

                  }

                return zordiac;
            }
                }
            /*
            Function for validatng date
            */
            function isValidDate(dateString)
            {
                // First check for the pattern
                var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

                if(!regex_date.test(dateString))
                {
                    return false;
                }

                // Parse the date parts to integers
                var parts   = dateString.split("-");
                var day     = parseInt(parts[2], 10);
                var month   = parseInt(parts[1], 10);
                var year    = parseInt(parts[0], 10);

                // Check the ranges of month and year
                if(year < 1000 || year > 3000 || month == 0 || month > 12)
                {
                    return false;
                }

                var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

                // Adjust for leap years
                if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
                {
                    monthLength[1] = 29;
                }

                // Check the range of the day
                return day > 0 && day <= monthLength[month - 1];
            }

            /*
            Function for validating date
            */

            function validateDate(testDate){
              var result=true;
              var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
            if(!(date_regex.test(testDate)))
            {
              result= false;
            }
            return result;
            }

            /**
            Function to validate email address
            */
            function validateEmail() {
                  var email=$("#Email").val(); 
                  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                  var blnValidate=re.test(String(email).toLowerCase());
                  
                  if(blnValidate==false){
                        Swal.fire({
                                  imageUrl: '../front/icons/alert-icon.png',
                                  imageWidth: 80,
                                  imageHeight: 80,
                                  imageAlt: 'Mbaye Logo',
                                  title: "<span id='error'>Error!</span>",
                                  html: 'Please Enter Valid Email Id',
                                  width: '30%',
                                  padding: '1rem',
                                  background: 'rgba(8, 64, 147, 0.62)'
                                        });
                  }

                }

            /* Reset camera option */

            function reset_snapshot(){
              Webcam.reset();

                Webcam.set({
                    //width: 207,
                    //height: 270,
                    //dest_width: 207,
                    //dest_height: 270,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach( '#my_camera' );
            }
            /*function reset(){
              Webcam.reset();
              Webcam.off();
            }*/
            //
            //-----------

            function logout_account(){

             $.ajax({
                   type: "POST",
                   url: "http://127.0.0.1/Mbaye/index.php/home/logout",
                   data: "",
                   dataType: "json",
                   success: function (result) {

                   window.location.href = "http://127.0.0.1/Mbaye/index.php/home/login";
                   },
                   error: function () {
                    alert("Error while logouting!");
                   }
               });
            }


            function loadSelect_for_org_type(org){  //alert(org);
                $('#org_types').find('option[value='+org+']').attr('selected', 'selected');
                $('#org_type').val(org);
            }
            function loadSelect_for_gender(gender){
                $('#var_genders').find('option[value='+gender+']').attr('selected', 'selected');
                $('#var_gender').val(gender);
            }

            function openwikipedia(){

                setTimeout(function(){

                    var div = document.getElementById("Div_for_wiki");
                    var page = document.getElementById("wikiPage");
                    page.data  ="https://en.wikipedia.org/wiki/Michael_Collins_(astronaut)";
                    if(div.style.visibility != "visible"){
                      div.style.visibility = "visible";
                      $(".close_btn ").show();

                    }else return;
                  },1000);

            }

            function hidePage(){
                    var div = document.getElementById("Div_for_wiki");
                    var page = document.getElementById("wikiPage");
                    page.data = "";


                    $(".close_btn ").hide();


                    div.style.visibility = "hidden";


                }

            function goto_wiki2(){

                setTimeout(function(){

              var div = document.getElementById("Div_for_wiki2");
                  var page = document.getElementById("wikiPage2");
                  page.data  ="https://en.wikipedia.org/wiki/Michael_Schumacher";
                  if(div.style.visibility != "visible"){
                    div.style.visibility = "visible";
                    $(".close_btn2 ").show();



                  }else return;
              },1000);

            }
            function hidePage2(){
                    var div = document.getElementById("Div_for_wiki2");
                    var page = document.getElementById("wikiPage2");
                    page.data = "";

                    if($(".close_btn2 ").hide());

                    div.style.visibility = "hidden";



                }

                 $(document).ready(function(){
                 $("#Div_for_wiki2").click(function(){
                 $("#Div_for_wiki").hide();
                });
                 $("#divv").click(function(){
                 $("#Div_for_wiki").show();
                });
                 $("#viki").click(function(){
                 $("#Div_for_wiki2").show();
                });
                });


                /*
                Function to redirect to home page after registration  save sucess
                */
               function redirectToHome(){
                  window.location = "{{route('frontend.index')}}";
                }
                 /*
                Function to redirect to login  page after registration  save sucess
                */
                function redirectToLogin(){
                  window.location.href = url+'/login';
                }
                /**
                Function to validate form
                */
                $(document).ready(function(){

                             $("#term").click(function(){
                               $("#myModal").modal({show:true});
                  });
                           });

            function validateMyForm(){
              //checking terms and condition Check box checked or not
              if($("#is_term_accept").prop("checked") == true)
                  {
                   document.getElementById("MyForm").submit();
                  }
                  else
                  {
                    $('#myModal').modal({ show: true });
                  }

            }



            /**
            Click function for agree button
            */
            $('#btn_agree').click(function(){
              $('#is_term_accept').prop("checked",true);

            });

            /**
            Click function for disagree button
            */
            $('#btn_dagree').click(function(){
              $('#is_term_accept').prop("checked",false);

            });

            /*
            Function for set annd reset check box
            */
            function setCheckbox(){

               if($(this). prop("checked") == true){
                $('#is_term_accept').prop("checked",false);
                }
                else if($(this). prop("checked") == false){
                  $('#is_term_accept').prop("checked",true);
                }
            }

            /**
            Function to show password
            */
            function showpassword(){
              var password = document.getElementById("password");
                if (password.type === "password") {
                  password.type = "text";
                  $(".eye").hide();
                  $(".eye_slash").show();
               
                } else {
                  password.type = "password";
                  $(".eye_slash").hide();
                  $(".eye").show(); 
                }
            }

              $(document).ready(function(){
                  if({{count($errors) }} > 0)
    {
        var errorMessage = {!! html_entity_decode($errors, ENT_QUOTES, 'UTF-8') !!};
        var sweetMessage = '';
        if(typeof(errorMessage==="object")){
        var errType = Object.keys(errorMessage)[0];
        sweetMessage = errorMessage[errType][0];
        }
        else{
            sweetMessage = errorMessage[0][0];
        }
        }
                  if(sweetMessage){
                        Swal.fire({
                            imageUrl: '../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: "<span id='error'>Registration Failed!</span>",
                            html: sweetMessage,
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                                  });
                                }
    }
    );

</script>


@endsection
