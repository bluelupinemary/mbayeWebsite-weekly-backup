@extends('frontend.layouts.career_setup-profile_layout')
@section('after-styles')
       

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{ asset('front/CSS/cropper.min.css') }}">
        {{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
        {{--<script src="{{asset('front/JS/fabric.min.js')}}"></script> --}}
        <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
        <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile.css')}}">
        <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile-responsive.css')}}">
        <link rel="stylesheet" href="{{asset('front/CSS/image-editor.css')}}">
        <link rel="stylesheet" href="{{asset('front/CSS/jquery.fontselect.css')}}"/>
        <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}"> 
        <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>  
        <script src="{{asset('front/JS/popper.min.js')}}"></script>
        <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
        <script src="{{asset('front/JS/jquery.fontselect.js')}}"></script>
        <script src="{{asset('front/JS/cropper.js')}}"></script>
@endsection
@section('content')

    <div id="page-content">
        <div class="app">  
            <div class="image-editor-modal" id="imageEditorModal">
                <imageeditor-component :edit_blog="1"></imageeditor-component>
            </div>
            <div class="tui-editor-modal" id="tuiEditorModal">
                <tuieditor-component></tuieditor-component>
            </div>
    
            {{-- <button class="cancel-btn" type="button">Cancel</button>
            <button class="save-btn " type="button">Save</button> --}}
            
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a>
            <h3 class="heading_setup">Setup Profile</h3>
            <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
            <a href="" class="profession" data-toggle="modal" data-target="#ProfessionSkillModal">Profession And Skills</a>
            <a href="" class="education" data-toggle="modal" data-target="#EducationModal">Education</a>
            <a href="" class="work-experience" data-toggle="modal" data-target="#WorkExperienceModal">Work Experience</a>
            <a href="" class="contacts" data-toggle="modal" data-target="#ContactModal">Contact</a>
            <a href="" class="reference" data-toggle="modal" data-target="#CharacterReferencesModal">Character References</a>
           
            
        </div>  
            <div class="slider">
            </div>
            <div class="sidenav-left">
            <!-- left controls -->
         
                <div id="main"  >
                    <span  class="arrows" style="font-size:17px;font-family:Nasalization;cursor:pointer" onclick="openNav()">&#8811;</span>
                </div>
            </div>

            <div class="sidenav-right">
            <!-- right controls -->
            </div>

            
        <form method="POST" action="{{url('save_work_experience')}}" id="work-experience-form"  enctype="multipart/form-data">
            @csrf
             <div class="modal" id="WorkExperienceModal"  class="WorkExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="form-block"> <div class="modal-dialog  modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Work Experiences</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                    </div> --}}
                    <div class="modal-body work-modal-body">
                        <div class="work-experience-body main_work_experience_div workDiv_1">
                            <fieldset>
                               
                                  <button type="button"  class="close remove-btn-workexperience"   title="Remove Work Experience "aria-label="Clone" onclick="remove_work_experience(this)">
                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                    </button>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="StartDate">Start Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" id="start_date" name="start_date[]" >
                                        </div>
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="EndDate">End Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" id="end_date" name="end_date[]" >
                                        </div>
                                      </div>
                                        <div class="form-group input-group-sm">
                                            <label for="CompName">Company Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="company_name" name="company_name[]" placeholder="">
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="CompRole">Role<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="CompRole" name="role[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="CompDesig">Designation<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="CompDesig" name="designation[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Contact">Contact<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="Contact" name="contact_no[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Address">Address<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="Address" name="address[]" placeholder="">
                                      </div>
                                      <button type="button"  class="close clone-btn-workexperience"  title="Add More Work Experience " aria-label="Clone">
                                        <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                      </button>
                            </fieldset>
                        </div>
                    </div>
                    <div class="work_experience-clone"></div>
                    <div class="modal-footer">
                        <input type="submit"  class="btn btn-primary work-experience-done" value="Done" id="submit"/>
                    </div>
                </div>
            </div>
           </div>
         </div>
        </form>


        <form method="POST" action="{{url('save_education')}}" id="education-form" enctype="multipart/form-data">
            @csrf
            <div class="modal" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="education_form-block"> 
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Education</h5>

                     
                     
                      <button type="button" class="close" data-dismiss="modal"   aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}

                    <div class="modal-body education-modal-body">
                       
                        <div class="education-body main_education_div div_1">
                           
                            <fieldset>
                                {{-- <button type="button"  class="close clone-btn-education  "  title="Add More Education" aria-label="Clone">
                                    <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                  </button> --}}

                                  <button type="button"  class="close remove-btn-education"  title="Remove Education " aria-label="Clone" onclick="remove(this)">
                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                    </button>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 input-group-sm" id="education_dropdown">
                                            <label for="education_level">Level Of  Education<span style="color:red">*</span></label>
                                                <select class="form-control" name="education_level[]" id="xyz"  required>
                                                    <option value="Select" selected disabled>Select</option>
                                                    <option value="Doctrate">Doctrate</option>
                                                    <option value="Post-graduate">Post-graduate</option>
                                                    <option value="Undergraduate">Undergraduate</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Secondary">Secondary</option>
                                                </select>
                                        </div> 
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="SchoolName">School Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="SchoolName" name="school_name[]"  required>
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="FieldOfStudy">Field Of Study<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="FieldOfStudy"  name="field_of_study[]"  required>
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="Description">Description<span style="color:red">*</span></label><br>
                                        <textarea id="Description" name="description[]" required>
                                            </textarea>
                                      </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                          <label for="StartDate" style="">Start Date<span style="color:red">*</span><span></span></label>
                                          <input type="date" class="form-control" id="StartDate"  name="start_date[]" required >
                                        </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                         
                                        </div>
                                        <div class="form-group col-md-4 input-group-sm">
                                            <label for="EndDate">End Date<span style="color:red">*</span></label>
                                            <input type="date" class="form-control" id="EndDate" name="end_date[]" required >
                                          </div>
                                      </div>
                                      

                                       
                                      <button type="button"  class="close clone-btn-education"  title="Add More Education" aria-label="Clone">
                                        <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                      </button>
                            </fieldset>
                        </div>  
             
                    </div>
              
                    <div class="education-clone"></div>
                    <div class="modal-footer">
                     <input type="submit"  class="btn btn-primary education-done" value="Done" id="submit_education"/>
                    </div>
                </div>
            </div>
       
              </div>
            </div>
         </form>


         <form method="POST" action="" id="reference-form"  enctype="multipart/form-data">
            @csrf
              <div class="modal" id="CharacterReferencesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="reference_form-block ">
                 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Character References</h5>

                    

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body reference-modal-body">
                       <div class="reference-body  main_reference_div referenceDiv_1">
                         <fieldset> 
                                
                                  <button type="button"  class="close remove-btn-reference"  aria-label="Clone" title="Remove Character Reference" onclick="remove_reference(this)">
                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                    </button>
                                        <div class="form-group input-group-sm">
                                            <label for="Name"> Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="Name" name="name[]" placeholder="">
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Email">Email<span style="color:red">*</span></label>
                                        <input type="email" class="form-control" id="Email"  name="email[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="CompName">Company Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="CompName"  name="company_name[]" placeholder="">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Designation">Designation<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="Designation"  name="designation[]" placeholder="">
                                      </div>
                                      <button type="button"  class="close clone-btn-reference"  title="Add More Character Reference "aria-label="Clone">
                                        <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                      </button>
                            </fieldset>
                        </div>
                    </div>
           
                    <div class="reference-clone"></div>
                    <div class="modal-footer">
                        <input type="submit"  class="btn btn-primary characterRederences-done" value="Done" id="submit_reference"/>
                    </div>
                </div>
            </div>
        </div>  
        </div>
       </form>  


       
              <div class="modal" id="AboutMeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">About Me</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body">
                        <div class="aboutme-body">
                            <fieldset>
                                <form action="" id="aboutme-form">
                                @csrf
                                <div class="form-row">
                                    
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="fName"> First Name</label>
                                            <input type="text"  class="form-control disabled_field" id="fName" disabled value="{{ $user->first_name }}">
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="lName">Last Name</label>
                                        <input type="text" class="form-control disabled_field" id="lName" disabled value="{{ $user->last_name }}">
                                      </div>
                                      
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control disabled_field" id="dob" disabled value="{{ $user->dob }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control disabled_field" id="age" disabled value="{{ $user->age }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control disabled_field" id="gender" disabled value="{{ $user->gender }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="Address"> Registered Address</label>
                                        <input type="text" class="form-control disabled_field" id="my_Address" disabled value="{{ $user->address }}">
                                      </div>
                                       <div class="form-group col-md-12 input-group-sm">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control disabled_field" id="Country" disabled value="{{ $user->country }}">
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                     Add Current Address
                                      </button>
                                      </div>
                                    <br>  <br>
                                      <div class="collapse" id="collapseExample">
                                            <div class="form-group col-md-12 input-group-sm ">
                                                <label for="country">Present Country</label>
                                                <select class="countries" name="present_country" id="countryId" required>&#x25BC;
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="state">Present State</label>
                                                <select id="stateId" class="states" name="state" required>
                                                    <option value="">Select State</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="city">Present City</label>
                                                <select id="cityId" class="cities" name="present_city" required>
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 input-group-sm">
                                                <label for="pAddress">Present Address</label>
                                                <input type="text" class="form-control" name="present_address" id="pAddress" >
                                            </div>
                                      </div>
                                     
                                      {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                                      
                                    </div>    
                                
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
            </form>

              <form action="" id="contact-form">
                @csrf
              <div class="modal" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Contact Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    {{-- <div class="app" style="display: none;">
                      
                    </div> --}}
                    <div class="modal-body">
                        <div class="contact-body">
                            <fieldset>
                                
                                <div class="form-row">
                                        <div class="form-group col-md-12 input-group-sm">
                                            <label for="pEmail"> Primary Email</label>
                                            <input type="text"  class="form-control disabled_field" id="pEmail" name="email" disabled value="{{ $user->email }}" >
                                        </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="pMobNumber">Primary Mobile Number</label>
                                        <input type="text" class="form-control disabled_field" id="pMobNumber" name="mobile_number" disabled value="{{ $user->mobile_number }}" >
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="sEmail">Secondary Email</label>
                                        <input type="email" class="form-control" id="sEmail" name="secondary_email" >
                                      </div>
                                      <div class="form-group col-md-12 input-group-sm">
                                        <label for="sMobNumber">Secondary  Mobile Number</label>
                                        <input type="text" class="form-control" id="sMobNumber" name="secondary_mobile_number" >
                                      </div>
                                </div>
                            </fieldset>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary contact-done">Done</button>
                    </div>
                  </div>
                </div>
              </div>
            
        </form>

    
              
                <div class="modal" id="ProfessionSkillModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="profession_form-block"> 
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Profession And Skills</h5>
    
                         
                         
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          
                        </div>
                        {{-- <div class="app" style="display: none;">
                        </div> --}}
                        <div class="modal-body ">
                            <div class="profession-body" id="Profession-body">
                                <form method="POST" action="" id="profession-form" enctype="multipart/form-data">
                                    @csrf
                                <fieldset>
                                   
                                        <div class="form-row">
                                            <div class="form-group col-md-12 input-group-sm">
                                              <label for="Profession">Profession<span style="color:red">*</span></label>
                                              <select id="Profession" class="form-control" name="profession_id" required>&#x25BC;
                                                    <option value="public" selected disabled>Select</option>
                                                    @foreach($profession as $profession)
                                                    <option value="{{$profession->id}}" id="hhh">{{$profession->profession_name}}</option>
                                                    @endforeach
                                               </select>
                                              {{-- <input type="text" class="form-control" id="Profession"  name="Profession" >
                                              <button type="button"  class="dropdown-btn" >
                                                <span aria-hidden="true" class="btn-down"><i class="fas fa-angle-down"></i></span>
                                              </button> --}}
                                              
                                        </div>
                                        <div id="profession_list"></div>      
                                          </div>
                                          <div class="form-row"> 
                                          <div class="form-group col-md-12 input-group-sm">
                                            <label for="skills">Skills<span style="color:red">*</span></label>
                                            <textarea id="skills" name="skills">
                                            </textarea>
                                     
                                          </div>  
                                        </div>
                                  
                                </fieldset>
                            </div>  
                 
                        </div>
                  
         
                        <div class="modal-footer">
                         <input type="submit"  class="btn btn-primary profession-done" value="Done" id="submit_profession"/>
                        </div>
                    </div>
                </div>
           
                  </div>
                </div>
             </form>
    
</div>
@endsection
@section('after-scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
{{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script> --}}
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
<script src="{{asset('front/JS/jquery-ui.js')}}"></script>
{{-- <script src="{{asset('front/JS/popper.min.js')}}"></script> --}}

<script src="{{asset('front/JS/fabric.min.js')}}"></script>
<script src="{{asset('front/JS/FileSaver.js')}}"></script>      
<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>        
<script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>     
<script src="{{asset('front/JS/lodash.min.js')}}"></script>
{{-- <script src="{{asset('front/system-google-font-picker/jquery.fontselect.js')}}"></script> --}}
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>

<script>
    $(function() {
  // choose target dropdown
  var select = $('#Profession');
  select.html(select.find('option').sort(function(x, y) {
    // to change to descending order switch "<" for ">"
    return $(x).text() > $(y).text() ? 1 : -1;
  }));

  // select default item after sorting (first item)
//   $('#Profession').get(0).selectedIndex = 0;
document.getElementById("Profession").selectedIndex = "52";
});
</script>

<script>
    $(document).ready(function() {
        var url = $('meta[name="url"]').attr('content');
//    
        // var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        // var height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
        // // var canvas = document.getElementById("c");

        // let imagesMap = new Map();              //data structure for the images added
        // let shapesMap = new Map();              //data structure for the shapes added
        // let textMap = new Map();                //data structure for the texts added
 
        
        

        /**
         * save job seeker profile image
         * 
         * */
        $(".save-btn").click(function(){
            var object_count = canvas.getObjects().length;
            if(object_count < 1) { 
             
                Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: 'Error!',
                            html: 'Please Upload Image(s)',
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                        });
      
            }
            else{
                $(".save").click();
            }
        });

        //TOOLTIP POSITION FOR THE ICONS
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

        // //REDIRECT TO DASHBOARD IF CANCEL BUTTON IS CLICKED
        // $('button.cancel-btn').click(function() {
        //     window.location.href = url+'/dashboard';
        // });

        // $(".remove-btn-education").hide();
        // $(".remove-btn-workexperience").hide();
        // $(".remove-btn-reference").hide();


        //function to check if save icon should be enabled
        function countObjects(){
            var object_count = canvas.getObjects().length;

            if(object_count < 1) {
                $('.save').prop('disabled', true);
            }
        }
  
        // //function to download the image
        // function downloadImage() {
        //     var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will 

        //     var link = window.document.createElement('a');
        //     link.href = image;
        //     link.download = "screenshot.jpg";
        //     var click = document.createEvent("MouseEvents");
        //     click.initEvent("click", true, false);
        //     link.dispatchEvent(click); 

        // }


    

        /*FUNCTIONS RELATED TO THE INSTRUCTIONS OVERLAY*/
        // show instruction overlay
        // $('.help a').click(function () {
        //     $('.instructions').fadeIn();
        // });

        // // hide instruction overlay
        // $('.instruction-close-btn').click(function() {
        //     $('.instructions').fadeOut();
        //     $('#main').show();
        //     $('.start-message').show();
            
        // });

        // show instruction text on hover of each box
        // $('.instruction').hover(
        //     function() {
        //         var text_div = $(this).data('text-div');
        //         $('.'+text_div).fadeIn();
        //     },
        //     function() {
        //         var text_div = $(this).data('text-div');
        //         $('.'+text_div).hide();
        //     }
        // );
        $(".remove-btn-education").hide();
        $(".remove-btn-workexperience").hide();
        $(".remove-btn-reference").hide();
                
        // clone-btn-workexperience
        $('.clone-btn-workexperience').click(function(e) {
            e.preventDefault();
            
            var $form = $('form#work-experience-form');
            var newel = $('.main_work_experience_div').clone();
            $(newel).insertAfter(".work-experience-body:last");
            var new_ele = $('.work-experience-body:last');
            new_ele.find('input').val("");
            var count = $(".work-experience-body");
                    new_ele.removeClass('workDiv_'+(count.length-1))
                    new_ele.addClass('workDiv_'+count.length)
                  
                 if(count.length>1){
                    $(".work-experience-body:last .clone-btn-workexperience").hide();
                    $(".work-experience-body:last .remove-btn-workexperience").show();

                 }
           $(".work-experience-body:last #start_date").focus().select();
        });
        //work experience save
        $('.work-experience-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_work_experience';
            var $form = $('form#work-experience-form');
            var form_data = $('#work-experience-form').serialize();
            var post_data = new FormData($form[0]);
            var count = $(".work-experience-body");
            totalDiv=count.length;
            var alert_status;
        
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var start_date = $("form#work-experience-form .workDiv_"+i+" #start_date").val();
                var end_date = $("form#work-experience-form .workDiv_"+i+' #end_date').val();
                var company_name = $("form#work-experience-form .workDiv_"+i+' #company_name').val();
                var CompRole = $("form#work-experience-form .workDiv_"+i+' #CompRole').val();
                var CompDesig = $("form#work-experience-form .workDiv_"+i+' #CompDesig').val();
                var Contact = $("form#work-experience-form .workDiv_"+i+' #Contact').val();
                var Address = $("form#work-experience-form .workDiv_"+i+' #Address').val();

               

                if(start_date==''){
                    alert_status = true;
                     message = 'Start Date is required';
                     $("form#work-experience-form .workDiv_"+i+" #StartDate").focus();
                }
                else if(end_date==''){
                     alert_status = true;
                     message = 'End Date is required';
                     $("form#work-experience-form .workDiv_"+i+" #EndDate").focus();
                }
                else if(company_name==''){
                     alert_status = true;
                     message = 'Company Name is required';
                     $("form#work-experience-form .workDiv_"+i+" #company_name").focus();
                }
                else if(CompRole==''){
                     alert_status = true;
                     message = 'Role is required';
                     $("form#work-experience-form .div_"+i+" #CompRole").focus();
                }
                else if(CompDesig==''){
                     alert_status = true;
                     message = 'Designation is required';
                     $("form#work-experience-form .div_"+i+" #CompDesig").focus();
                }
                else if(Contact==''){
                     alert_status = true;
                     message = 'Contact is required';
                     $("form#work-experience-form .div_"+i+" #Contact").focus();
                }
                else if(Address==''){
                     alert_status = true;
                     message = 'Address is required';
                     $("form#work-experience-form .div_"+i+" #Address").focus();
                }
            }
          
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#WorkExperienceModal').modal('hide');
                        $('#ContactModal').modal('show');
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
    }
                    
     });
     
        // clone-btn-education
        $('.clone-btn-education').click(function(e){
            e.preventDefault();
            // alert('jjkkk');
                //    $(".remove-btn-education").hide();
                
                    var $form = $('form#education-form');
                    var newel = $('.education-body:last').clone();
                    $(newel).insertAfter(".education-body:last");
                    var new_ele = $('.education-body:last');
                    new_ele.find('input').val("");
                    var count = $(".education-body");
                    new_ele.removeClass('div_'+(count.length-1))
                    new_ele.addClass('div_'+count.length)
                    // document.getElementById("remove-btn-education").style.cssFloat = "right";
                 if(count.length>1){
                    $(".education-body:last .clone-btn-education").hide();
                    $(".education-body:last .remove-btn-education").show();
                 }
                 $(".education-body:last #StartDate").focus().select();  
                 
        });
        
        // var $dropdown1 = $("select[name='education_level']");
        // var $dropdown2 = $("select[name='dropdown2']");

        // $dropdown1.change(function() {
        // $dropdown1.children().show();
        // var selectedItem = $($dropdown1).val();
        // if (selectedItem != "")
        //     $('select[name="dropdown"] option[value="' + selectedItem + '"]').hide();
        // });
        // $dropdown1.change(function() {
        // $dropdown1.children().show();
        // var selectedItem = $($dropdown1).val();
        // if (selectedItem != "")
        //     $('select[name="dropdown1"] option[value="' + selectedItem + '"]').hide();
        // });
 
    //education save
    $('.education-done').click(function(e) {
        
            e.preventDefault();
            var form_url = url+'/save_education';
            var $form = $('form#education-form');
            var form_data = $('#education-form').serialize();
            var post_data = new FormData($form[0]);
            var count = $(".education-body");
            totalDiv=count.length;
            var alert_status=false;
          
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var start_date = $("form#education-form .div_"+i+" #StartDate").val();
                var end_date = $("form#education-form .div_"+i+' #EndDate').val();
                var school_name = $("form#education-form .div_"+i+' #SchoolName').val();
                var field_of_study = $("form#education-form .div_"+i+' #FieldOfStudy').val();
                var desccription = $("form#education-form .div_"+i+' #Description').val();
               

                if(start_date==''){
                    alert_status = true;
                     message = 'Start Date is required';
                     $("form#education-form .div_"+i+" #StartDate").focus();
                }
                else if(end_date==''){
                     alert_status = true;
                     message = 'End Date is required';
                     $("form#education-form .div_"+i+" #EndDate").focus();
                }
                else if(school_name==''){
                     alert_status = true;
                     message = 'School Name is required';
                     $("form#education-form .div_"+i+" #SchoolName").focus();
                }
                else if(field_of_study==''){
                     alert_status = true;
                     message = 'Filed Of study is required';
                     $("form#education-form .div_"+i+" #FieldOfStudy").focus();
                }
                else if(desccription==''){
                     alert_status = true;
                     message = 'Description is required';
                     $("form#education-form .div_"+i+" #Description").focus();
                }
            }
            
            
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
        

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#EducationModal').modal('hide');
                        $('#WorkExperienceModal').modal('show');
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
        }      
                });   


        // clone-btn-character reference
        $('.clone-btn-reference').click(function(e) {
                            e.preventDefault();
                            var $form = $('form#reference-form');
                            var newel = $('.main_reference_div').clone();
                            $(newel).insertAfter(".reference-body:last");
                            var new_ele = $('.reference-body:last');
                            new_ele.find('input').val("");
                            var count = $(".reference-body");
                            new_ele.removeClass('referenceDiv_'+(count.length-1))
                            new_ele.addClass('referenceDiv_'+count.length)
                           
                            if(count.length>1){
                                $(".reference-body:last .clone-btn-reference").hide();
                                $(".reference-body:last .remove-btn-reference").show();
                            }
                            $(".reference-body:last #Name").focus().select();    
                        
                });

        //Character reference save
        $('.characterRederences-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_character_references';
            var $form = $('form#reference-form');
            var post_data = new FormData($form[0]);
            var count = $(".reference-body");
            totalDiv=count.length;
            var alert_status;
          
            for(var i=1;i<=totalDiv;i++){

                // console.log("here");
                var Name = $("form#reference-form .referenceDiv_"+i+" #Name").val();
                var Email = $("form#reference-form .referenceDiv_"+i+' #Email').val();
                var CompName = $("form#reference-form .referenceDiv_"+i+' #CompName').val();
                var Designation = $("form#reference-form .referenceDiv_"+i+' #Designation').val();
               

                if(Name==''){
                    alert_status = true;
                     message = 'Name is required';
                     $("form#reference-form .referenceDiv_"+i+" #Name").focus();
                }
                else if(Email==''){
                     alert_status = true;
                     message = 'Email is required';
                     $("form#reference-form .referenceDiv_"+i+' #Email').focus();
                }
                else if(CompName==''){
                     alert_status = true;
                     message = 'Company Name is required';
                     $("form#reference-form .referenceDiv_"+i+' #CompName').focus();
                }
                else if(Designation==''){
                     alert_status = true;
                     message = 'Designation is required';
                     $("form#reference-form .referenceDiv_"+i+' #Designation').focus();
                }
               
            }
            
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                    
    } 
                });   

        //conatct details save
        $('.contact-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_contact_details';
            var $form = $('form#contact-form');
            var post_data = new FormData($form[0]);
            var alert_status;
                    var secondary_email = $("form#contact-form #sEmail").val();
                    var secondary_mobNumber = $("form#contact-form #sMobNumber").val();
                
                    if(secondary_email==''){
                        alert_status = true;
                        message = 'Secondary Email is required';
                        $("form#contact-form  #sEmail").focus();
                    }
                    if(secondary_mobNumber==''){
                        alert_status = true;
                        message = 'Secondary Mobile Number is required';
                        $("form#contact-form  #sEmail").focus();
                    }
                    if(alert_status) {
                    Swal.fire({
                        title: 'Discard Changes',
                        text: message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: true,
                        confirmButtonText:
                            'Discard Changes',
                        cancelButtonText:
                            'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((res) => {
                        if (res.value) {
                            if(action) {
                                window.location.href = action;
                            }
                        }
                    });
                } else {
           
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#ContactModal').modal('hide');
                        $('#CharacterReferencesModal').modal('show');
                        
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                }    
                }); 

                //About me save
                $('.aboutme-done').click(function(e) {
                    
                    e.preventDefault();
                    var form_url = url+'/save_aboutme_details';
                    // alert(form_url);
                    var $form = $('form#aboutme-form');
                    var post_data = new FormData($form[0]);
                    var alert_status;
                    var present_address = $("form#aboutme-form #pAddress").val();
                    
                
                    if(present_address==''){
                        alert_status = true;
                        message = 'Present address is required';
                        $("form#aboutme-form  #pAddress").focus();
                    }
                    if(alert_status) {
                    Swal.fire({
                        title: 'Discard Changes',
                        text: message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: true,
                        confirmButtonText:
                            'Discard Changes',
                        cancelButtonText:
                            'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((res) => {
                        if (res.value) {
                            if(action) {
                                window.location.href = action;
                            }
                        }
                    });
                } else {
                   
                
                    $.ajax({
                        url: form_url,
                        method: 'post',
                        data:post_data,
                          
                        // dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            Swal.fire({
                                title: '<span class="success">Success!</span>',
                                text: data.message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            }).then((res) => {
                                if (res.value) {
                                    // document.getElementByClassName("profession").click;
                                    $('#AboutMeModal').modal('hide');
                                    // $('#ProfessionSkillModal').show();
                                    $("#ProfessionSkillModal").modal('show');
                        }
                                
                                // $('#Profession-body').parent().parent().show();
                                // document.getElementById("aboutme-body").innerHTML = "hide";
                                // document.getElementById("Profession-body").innerHTML = "show";
                                 
                               
                                 
                                
                                
                                // window.open(url+'/single_blog/'+data.data.id);
                                // window.location.href = url+'/single_general_blog/'+data.data.id;
                                // resetGeneralBlogForm();
                                

                            });
                        },
                        error: function (request, status, error) {
                            var response = JSON.parse(request.responseText);
                            var errorString = '';
                            var title = 'Error!';

                            if(response.errors) {
                                title = 'Error in processing request...';
                                $.each( response.errors, function( key, value) {
                                    errorString += '<p>' + value + '</p>';
                                });
                            }
                            
                            Swal.fire({
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: title,
                                html: errorString,
                                width: '30%',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                        }
                    });
                }
                            
                        }); 
                
    
                //About me end

               //Character reference save
        $('.profession-done').click(function(e) {
            e.preventDefault();
            var form_url = url+'/save_professional_details';
            var $form = $('form#profession-form');
            var post_data = new FormData($form[0]);
            var alert_status;
          
          
                var professsion = $("form#profession-form #Profession").val();
                var skills = $("form#profession-form  #skills").val();
              
                if(professsion==''){
                    alert_status = true;
                     message = 'Profession is required';
                     $("form#profession-form  #Profession").focus();
                }
                else if(skills==''){
                     alert_status = true;
                     message = 'Skills is required';
                     $("form#profession-form #skills").focus();
                }
               
               
                   
    if(alert_status) {
        Swal.fire({
            title: 'Discard Changes',
            text: message,
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            imageAlt: 'Mbaye Logo',
            width: '30%',
            padding: '1rem',
            background: 'rgba(8, 64, 147, 0.62)',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:
                'Discard Changes',
            cancelButtonText:
                'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((res) => {
            if (res.value) {
                if(action) {
                    window.location.href = action;
                }
            }
        });
    } else {
            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data ,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#ProfessionSkillModal').modal('hide');
                        $('#EducationModal').modal('show');
                        // window.open(url+'/single_blog/'+data.data.id);
                        //window.location.href = url+'/single_general_blog/'+data.data.id;
                        // resetGeneralBlogForm();
                    });
                },
                error: function (request, status, error) {
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Error in processing request...';
                        $.each( response.errors, function( key, value) {
                            errorString += '<p>' + value + '</p>';
                        });
                    }
                    
                    Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: title,
                        html: errorString,
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                }
            });
                    
    } 
                });   

                 $('#Profession').on('keyup',function() {
                    var query = $(this).val(); 
                    var form_url = url+'/search';
                    $.ajax({
                        url:form_url,
                        type:"GET",
                        data:{'profession':query},
                        success:function (data) {
                            $('#profession_list').html(data);
                        }
                    })
                    // end of ajax call
                });    

                $(document).on('click', 'li', function(){
                  
                  var value = $(this).text();
                  $('#Profession').val(value);
                  $('#profession_list').html("");
              });

              $(".dropdown-btn").click(function() {
                $('#Profession').val(" ");
                $( "#Profession" ).keyup();
              });
       
    });
                function openNav()
                 {
                document.getElementById("mySidenav").style.width = "10vw";
                // document.getElementById("main").style.marginLeft = "250px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
                }

                function closeNav()
                 {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
                }
                function remove(e){
                    $(e).closest('.education-body').remove();
                }
                function remove_work_experience(e){
                    $(e).closest('.work-experience-body').remove();
                }
                function remove_reference(e){
                    $(e).closest('.reference-body').remove();
                }
                // $('.close').on('click',function(){
                //     alert('hhh');
                // })
                // -------------------------- ADDED FUNCTIONS FOR THE IMAGE EDITOR -------------------------//

    //function called with edit image button is clicked
    $('#edit_uploaded_image').on('click', function(){
        $("#imageEditorModal").css("display","block");
        $('#page-content').hide();
    });


    //font selection for the font picker in the editor's toolbar
    $('#font-picker').fontselect({
    fonts: [
        "Aclonica",
        "Allan",
        "Annie+Use+Your+Telescope",
        "Anonymous+Pro",
        "Allerta+Stencil",
        "Allerta",
        "Amaranth",
        "Anton",
        "Architects+Daughter",
        "Arimo",
        "Artifika",
        "Arvo",
        "Asset",
        "Astloch",
        "Bangers",
        "Bentham",
        "Bevan",
        "Bigshot+One",
        "Bowlby+One",
        "Bowlby+One+SC",
        "Brawler",
        "Buda:300",
        "Cabin",
        "Calligraffitti",
        "Candal",
        "Cantarell",
        "Cardo",
        "Carter One",
        "Caudex",
        "Cedarville+Cursive",
        "Cherry+Cream+Soda",
        "Chewy",
        "Coda",
        "Coming+Soon",
        "Copse",
        "Corben:700",
        "Cousine",
        "Covered+By+Your+Grace",
        "Crafty+Girls",
        "Crimson+Text",
        "Crushed",
        "Cuprum",
        "Damion",
        "Dancing+Script",
        "Dawning+of+a+New+Day",
        "Didact+Gothic",
        "Droid+Sans",
        "Droid+Sans+Mono",
        "Droid+Serif",
        "EB+Garamond",
        "Expletus+Sans",
        "Fontdiner+Swanky",
        "Forum",
        "Francois+One",
        "Geo",
        "Give+You+Glory",
        "Goblin+One",
        "Goudy+Bookletter+1911",
        "Gravitas+One",
        "Gruppo",
        "Hammersmith+One",
        "Holtwood+One+SC",
        "Homemade+Apple",
        "Inconsolata",
        "Indie+Flower",
        "IM+Fell+DW+Pica",
        "IM+Fell+DW+Pica+SC",
        "IM+Fell+Double+Pica",
        "IM+Fell+Double+Pica+SC",
        "IM+Fell+English",
        "IM+Fell+English+SC",
        "IM+Fell+French+Canon",
        "IM+Fell+French+Canon+SC",
        "IM+Fell+Great+Primer",
        "IM+Fell+Great+Primer+SC",
        "Irish+Grover",
        "Irish+Growler",
        "Istok+Web",
        "Josefin+Sans",
        "Josefin+Slab",
        "Judson",
        "Jura",
        "Jura:500",
        "Jura:600",
        "Just+Another+Hand",
        "Just+Me+Again+Down+Here",
        "Kameron",
        "Kenia",
        "Kranky",
        "Kreon",
        "Kristi",
        "La+Belle+Aurore",
        "Lato:100",
        "Lato:100italic",
        "Lato:300", 
        "Lato",
        "Lato:bold",  
        "Lato:900",
        "League+Script",
        "Lekton",  
        "Limelight",  
        "Lobster",
        "Lobster Two",
        "Lora",
        "Love+Ya+Like+A+Sister",
        "Loved+by+the+King",
        "Luckiest+Guy",
        "Maiden+Orange",
        "Mako",
        "Maven+Pro",
        "Maven+Pro:500",
        "Maven+Pro:700",
        "Maven+Pro:900",
        "Meddon",
        "MedievalSharp",
        "Megrim",
        "Merriweather",
        "Metrophobic",
        "Michroma",
        "Miltonian Tattoo",
        "Miltonian",
        "Modern Antiqua",
        "Monofett",
        "Molengo",
        "Mountains of Christmas",
        "Muli:300", 
        "Muli", 
        "Neucha",
        "Neuton",
        "News+Cycle",
        "Nixie+One",
        "Nobile",
        "Nova+Cut",
        "Nova+Flat",
        "Nova+Mono",
        "Nova+Oval",
        "Nova+Round",
        "Nova+Script",
        "Nova+Slim",
        "Nova+Square",
        "Nunito:light",
        "Nunito",
        "OFL+Sorts+Mill+Goudy+TT",
        "Old+Standard+TT",
        "Open+Sans:300",
        "Open+Sans",
        "Open+Sans:600",
        "Open+Sans:800",
        "Open+Sans+Condensed:300",
        "Orbitron",
        "Orbitron:500",
        "Orbitron:700",
        "Orbitron:900",
        "Oswald",
        "Over+the+Rainbow",
        "Reenie+Beanie",
        "Pacifico",
        "Patrick+Hand",
        "Paytone+One", 
        "Permanent+Marker",
        "Philosopher",
        "Play",
        "Playfair+Display",
        "Podkova",
        "PT+Sans",
        "PT+Sans+Narrow",
        "PT+Sans+Narrow:regular,bold",
        "PT+Serif",
        "PT+Serif Caption",
        "Puritan",
        "Quattrocento",
        "Quattrocento+Sans",
        "Radley",
        "Raleway:100",
        "Redressed",
        "Rock+Salt",
        "Rokkitt",
        "Ruslan+Display",
        "Schoolbell",
        "Shadows+Into+Light",
        "Shanti",
        "Sigmar+One",
        "Six+Caps",
        "Slackey",
        "Smythe",
        "Sniglet:800",
        "Special+Elite",
        "Stardos+Stencil",
        "Sue+Ellen+Francisco",
        "Sunshiney",
        "Swanky+and+Moo+Moo",
        "Syncopate",
        "Tangerine",
        "Tenor+Sans",
        "Terminal+Dosis+Light",
        "The+Girl+Next+Door",
        "Tinos",
        "Ubuntu",
        "Ultra",
        "Unkempt",
        "UnifrakturCook:bold",
        "UnifrakturMaguntia",
        "Varela",
        "Varela Round",
        "Vibur",
        "Vollkorn",
        "VT323",
        "Waiting+for+the+Sunrise",
        "Wallpoet",
        "Walter+Turncoat",
        "Wire+One",
        "Yanone+Kaffeesatz",
        "Yanone+Kaffeesatz:300",
        "Yanone+Kaffeesatz:400",
        "Yanone+Kaffeesatz:700",
        "Yeseva+One",
        "Zeyada"
    ]
    });
// -------------------------- END OF  FUNCTIONS FOR THE IMAGE EDITOR -------------------------//
// $("#education_dropdown").change(function() {
//     $("select option").prop("disabled", false);
// )};

</script>
@endsection