@extends('frontend.layouts.profile_layout')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('after-styles')
       

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
        {{-- <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
        <script src="{{asset('front/JS/fabric.min.js')}}"></script> --}}
        <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
        <link rel="stylesheet" href="{{asset('front/CSS/jobseeker-profile.css')}}">
@endsection
@section('content')  
        <div class="collage-editor">
            <button class="cancel-btn" type="button">Cancel</button>
            <button class="save-btn " type="button">Save</button>
            
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8810;</a>
            <h3 class="heading_setup">Setup Profile</h3>
            <a href="" class="AboutMe" data-toggle="modal" data-target="#AboutMeModal">About Me</a>
            <a href="" class="profession" data-toggle="modal" data-target="#">Profession And Skills</a>
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

            <!-- section for drawing canvas -->
            <div class="canvas">
                <div class="start-message" style="display:none">
                    <p>
                        <label for="startImageLoader" class="custom-file-upload">
                            <i class="far fa-images"></i> Upload Your Image
                        </label>
                    </p>
                    <input type="file" name="image" id="startImageLoader" accept="image/x-png,image/jpeg" multiple>
                </div>
                <canvas id="c"></canvas>
            </div>

            <!-- section for the toolbar-->
            <div class="controls">
                <button id="undo" class="undo" disabled><label for="" title="Undo"><i class="fas fa-undo"></i></label></button>
                <button id="redo" class="redo" disabled><label for="" title="Redo"><i class="fas fa-redo"></i></label></button>
                <button id="clear_canvas" class="clear_canvas" disabled><label for="" title="Reset"><i class="fas fa-retweet"></i></label></button>                            
                <button class="zoom-in"><label for="" title="Zoom In"><i class="fas fa-search-plus"></i></label></button>
                <button class="zoom-out"><label for="" title="Zoom Out"><i class="fas fa-search-minus"></i></label></button>
                <button class="original-size"><label for="" title="100%"><i class="fas fa-expand-arrows-alt"></label></i></button>
                <button id="add_shapes" class="add_shapes"><label title="Add Shapes"><i class="fas fa-shapes"></label></i></button>
                <button id="add_text" class="add_text"><label for="" title="Add Text"><i class="fas fa-font"></label></i></button>
                <button class="upload"><label for="imgLoader" class="custom-file-upload" title="Upload image(s)">
                    <i class="far fa-images"></i>
                </label></button>
                <button id="selCrop" class="crop"><label for="" title="Crop"><i class="fa fa-crop"></i></label></button>  
                <button class="remove_object"><label for="" title="Delete"><i class="far fa-trash-alt"></i></label></button>                
                <input type="file" name="image" id="imgLoader" accept="image/x-png,image/jpeg" multiple>
                <button class="save" disabled><label for="" title="Save"><i class="fas fa-save"></i></label></button>
                <button class="download" disabled><label for="" title="Download"><i class="fas fa-download"></i></label></button>
                <button class="editor-link" disabled><label for="" title="Use in Second Editor"><i class="fas fa-copy"></i></label></button>
            </div>

            <!-- section for the shapes selection div. also contains the selection for the shape color and stroke-->
            <div id="shape-select" class="shape-select" style="display:none;">
                <div class='toolbar-close' id='close-shapes' style=""><i class="fas fa-times" ></i></div>
                <div id='shape-color-box' style="overflow-y: visible;overflow-x:hidden">
                    <div style="width: 100%;position: relative;">
                        <input type="color" id="shapeFill" name="fill" value="#e66465">
                        <br><label for="fill">Fill</label>
                    </div>
                    <div style="width: 100%;position: relative;">
                        <input type="color" id="shapeStroke" name="stroke" value="#e66465"><br>
                        <label for="stroke">Stroke</label>
                    </div>
                    <div class="strokeWidthContainer" style="width: 100%;position: relative;">
                      <input type="range" min="1" max="5" value="1" class="strokeSlider" id="strokeRange">
                      <br/>
                       <label for="strokeWidth">Width: <span id="strokeVal"></span></label>
                    </div>
                </div>
                <div id='shapes-box' style="">
                    <button id="circle" class="circle"> 
                        <label for="circle" title="Circle"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon circle">
                        <circle cx="50" cy="50" r="50"/>
                        </svg></label>
                    </button>
                   
                    <button id="triangle" class="triangle">
                        <label for="tri" title="Triangle"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="50 15, 100 100, 0 100"/>
                        </svg></label>
                    </button>
                  
                 
                    <button id="square" class="square">
                        <label for="" title="Square"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <rect width="100" height="100"/>
                        </svg></label>
                    </button>
                  
                    <button id="rectangle" class="rectangle">
                        <label for="" title="Rectangle"><svg viewBox="-60 0 230 55" height="2.5vw" width="2.5vw" class="shapes-icon">
                        <rect width="300" height="100"/>
                        </svg></label>
                    </button>
                   
                    <button id="diamond" class="diamond">
                        <label for="" title="Diamond"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="50,0 100,50 50,100 0,50"/>
                        </svg></label>
                    </button>
                  
                    <button id="parallelogram" class="parallelogram">
                        <label for="" title="Parallelogram"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="25,0 100,0 75,100 0,100"/>
                        </svg></label>
                    </button>
                  
                    <button id="ellipse" class="ellipse">
                        <label for="" title="Ellipse"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <ellipse cx="50" cy="60" rx="75" ry="37.5"/>
                        </svg>
                        </label>
                    </button>
                
                    <button id="trapezoid" class="trapezoid">
                        <label for="" title="Trapezoid"><svg viewBox="130 75 230 55" height="2vw" width="2vw" class="shapes-icon">
                        <polygon points="180,10 300,50 300,180 180,220"/>
                        </svg></label>
                    </button>
                 
                    <button id="star" class="star">
                        <label for="star" title="Star"><svg viewBox="-60 50 320 55" height="3vw" width="3vw" class="shapes-icon">
                        <polygon points="100,10 40,198 190,78 10,78 160,198"/>
                        </svg></label>
                    </button>
                  
                    <button id="pentagon" class="pentagon">
                        <label for="" title="Pentagon"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="50,0 100,38 82,100 18,100 0,38"/>
                        </svg></label>
                    </button>

                    <button id="chevron" class="chevron">
                        <label for="" title="Chevron"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="75,0 100,50 75,100 0,100 25,50 0,0"/>
                        </svg></label>
                    </button>
                  
                   
                    <button id="heptagon" class="heptagon">
                        <label for="" title="Heptagon"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="50,0 90,20 100,60 75,100 25,100 0,60 10,20"/>
                        </svg></label>
                    </button>
                    
                    <button id="octagon" class="octagon">
                        <label for="" title="Octagon"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="30,0 70,0 100,30 100,70 70,100 30,100 0,70 0,30"/>
                        </svg></label>
                    </button>
             
                    <button id="nonagon" class="nonagon">
                        <label for="" title="Nonagon"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="50,0 83,12 100,43 94,78 68,100 32,100 6,78 0,43 17,12"/>
                        </svg></label>
                    </button>
                   
                    <button id="bevel" class="bevel">
                        <label for="" title="Bevel"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="20,0 80,0 100,20 100,80 80,100 20,100 0,80 0,20"/>
                        </svg></label>
                    </button>
                    
                    <button id="message" class="message">
                        <label for="" title="Message"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="0,0 100,0 100,75 75,75 75,100 50,75 0,75"/>
                        </svg></label>
                    </button>

                  
                    <button id="rabbet" class="rabbet">
                        <label for="" title="Rabbet"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="0,15 15,15 15,0 85,0 85,15 100,15 100,85 85,85 85,100 15,100 15,85 0,85"/>
                        </svg></label>
                    </button>
                  
                    <button id="point" class="point">
                        <label for="" title="Point"><svg viewBox="-60 0 230 55" height="3.5vw" width="3.5vw" class="shapes-icon">
                        <polygon points="0,0 75,0 100,50 75,100 0,100"/>
                        </svg></label>
                    </button>

                    <button id="heart" class="heart">
                        <label for="" title="Heart"><svg viewBox="-53 0 230 55" height="4.5vw" width="4.5vw" class="shapes-icon">
                        <path id="heart" d="M 10,30 A 20,20 0,0,1 50,30 A 20,20 0,0,1 90,30 Q 90,60 50,90 Q 10,60 10,30 z" />
                        </svg></label>
                    </button>

                    <button id="hexagon" class="hexagon">
                        <label for="" title="Hexagon"><svg viewBox="-45 0 230 55" height="4.75vw" width="4.75vw" class="shapes-icon">
                        <polygon points="30.1,84.5 10.2,50 30.1,15.5 69.9,15.5 89.8,50 69.9,84.5"/>
                        </svg></label>
                    </button>

                   
                </div><!-- end of shapes box-->
            </div><!--end of shapes selection div-->

            <!--section for the adding texts to the editor-->
            <div id="text-styles" class="text-styles" style="display:none">
                <!-- <div id="close_textstyles" class="close" style=""><img style="width:1.5vw;" src="{{asset('front')}}/images3D/close-btn2.png"/></div> -->
                <div class='toolbar-close' style=""><i class="fas fa-times" ></i></div>
                <div id='text-option-box' style="overflow-y: visible;overflow-x:hidden">
                    <div style="width: 100%;position: relative;">
                        <input type="color" id="text-color" name="text-color"/><br/>
                        Color
                    </div>

                    <div class="font-picker">
                        <input id="font-picker" type="text"/><br/>
                        Font Style
                    </div>
                </div>
            </div> <!--end of text styles div-->

            <!-- 
            <div id="crop-options" class="crop-options-styles" style="display:none">
                <span id="close_crop-options" class="close">&times;</span> 
            </div>  -->

            <!--Instructions overlay-->
            <div class="instructions">
                <span class="instruction-close-btn"><i class="far fa-times-circle"></i></span>
                <div class="instruction instruction-1" data-text-div="instruction-text-1"></div>
                <div class="instruction instruction-2" data-text-div="instruction-text-2"></div>
                <div class="instruction instruction-3" data-text-div="instruction-text-3"></div>
                <div class="instruction instruction-4" data-text-div="instruction-text-4"></div>
                <div class="instruction instruction-5" data-text-div="instruction-text-5"></div>

                <div class="instruction-text instruction-text-1">Left controls</div>
                <div class="instruction-text instruction-text-2">Right controls</div>
                <div class="instruction-text instruction-text-3">Canvas controls</div>
                <div class="instruction-text instruction-text-4">Canvas</div>
                <div class="instruction-text instruction-text-5">Cancel</div>
            </div>

            <div class="help">
                <a class=""><i class="fa fa-question-circle icon-help" aria-hidden="true"></i></a>
            </div>
        <form method="POST" action="{{url('save_work_experience')}}" id="work-experience-form"  enctype="multipart/form-data">
             <div class="modal" id="WorkExperienceModal"  class="WorkExperienceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="form-block"> <div class="modal-dialog  modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Work Experiences</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="app" style="display: none;">
                    </div>
                    <div class="modal-body work-modal-body">
                        <div class="work-experience-body main_work_experience_div workDiv_1">
                            <fieldset>
                                <button type="button"  class="close clone-btn-workexperience"  title="Add More Work Experience " aria-label="Clone">
                                    <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                  </button>
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
                    <div class="app" style="display: none;">
                      
                    </div>
                    <div class="modal-body education-modal-body">
                       
                        <div class="education-body main_education_div div_1">
                           
                            <fieldset>
                                <button type="button"  class="close clone-btn-education  "  title="Add More Education" aria-label="Clone">
                                    <span aria-hidden="true" class="btn-plus" ><i class="fas fa-plus-circle"></i></span>
                                  </button>

                                  <button type="button"  class="close remove-btn-education"  title="Remove Education " aria-label="Clone" onclick="remove(this)">
                                    <span aria-hidden="true" class="btn-remove" ><i class="fas fa-minus-circle"></i></span>
                                    </button>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="StartDate">Start Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" id="StartDate"  name="start_date[]" required >
                                        </div>
                                        <div class="form-group col-md-6 input-group-sm">
                                          <label for="EndDate">End Date<span style="color:red">*</span></label>
                                          <input type="date" class="form-control" id="EndDate" name="end_date[]" required >
                                        </div>
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="education_level">Level Of  Education<span style="color:red">*</span></label>
                                            <select class="form-control" name="education_level[]" required>
                                                <option value="Primary">Primary</option>
                                                <option value="Secondary">Secondary</option>
                                                <option value="Undergraduate">Undergraduate</option>
                                                <option value="Graduate">Graduate</option>
                                                <option value="Post-graduate">Post-graduate</option>
                                            </select>
                                    </div> 

                                        <div class="form-group input-group-sm">
                                            <label for="SchoolName">School Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="SchoolName" name="school_name[]"  required>
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="FieldOfStudy">Field Of Study<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="FieldOfStudy"  name="field_of_study[]"  required>
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Description">Description<span style="color:red">*</span></label><br>
                                        <textarea id="Description" name="description[]" rows="7" cols="72" required>
                                            </textarea>
                                      </div>
                              
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
                    <div class="app" style="display: none;">
                      
                    </div>
                    <div class="modal-body reference-modal-body">
                       <div class="reference-body  main_reference_div referenceDiv_1">
                         <fieldset> 
                                <button type="button"  class="close clone-btn-reference"  title="Add More Character Reference "aria-label="Clone">
                                    <span aria-hidden="true" class="btn-plus"><i class="fas fa-plus-circle"></i></span>
                                  </button>
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
                    <div class="app" style="display: none;">
                      
                    </div>
                    <div class="modal-body">
                        <div class="aboutme-body">
                            <fieldset>
                                <form action="" id="aboutme-form">
                                   
                                        <div class="form-group input-group-sm">
                                            <label for="fName"> First Name</label>
                                            <input type="text"  class="form-control disabled_field" id="fName" disabled value="{{ $user->first_name }}">
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="lName">Last Name</label>
                                        <input type="text" class="form-control disabled_field" id="lName" disabled value="{{ $user->last_name }}">
                                      </div>
                                      
                                      <div class="form-group input-group-sm">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control disabled_field" id="dob" disabled value="{{ $user->dob }}">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control disabled_field" id="age" disabled value="{{ $user->age }}">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control disabled_field" id="gender" disabled value="{{ $user->gender }}">
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="Address"> Registered Address</label>
                                        <input type="text" class="form-control disabled_field" id="my_Address" disabled value="{{ $user->address }}">
                                      </div>
                                       <div class="form-group input-group-sm">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control disabled_field" id="Country" disabled value="{{ $user->country }}">
                                      </div>

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
              <div class="modal" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Contact Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="app" style="display: none;">
                      
                    </div>
                    <div class="modal-body">
                        <div class="contact-body">
                            <fieldset>
                                <form action="" id="contact-form">
                                   
                                        <div class="form-group input-group-sm">
                                            <label for="pEmail"> Primary Email</label>
                                            <input type="text"  class="form-control disabled_field" id="pEmail" name="email" disabled value="{{ $user->email }}" >
                                        </div>
                                      <div class="form-group input-group-sm">
                                        <label for="pMobNumber">Primary Mobile Number</label>
                                        <input type="text" class="form-control disabled_field" id="pMobNumber" name="mobile_number" disabled value="{{ $user->mobile_number }}" >
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="sEmail">Secondary Email</label>
                                        <input type="email" class="form-control" id="sEmail" name="secondary_email" >
                                      </div>
                                      <div class="form-group input-group-sm">
                                        <label for="sMobNumber">Secondary  Mobile Number</label>
                                        <input type="text" class="form-control" id="sMobNumber" name="secondary_mobile_number" >
                                      </div>
                                     
                                </form>
                            </fieldset>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary contact-done">Done</button>
                    </div>
                  </div>
                </div>
              </div>


    
              <form method="POST" action="" id="profession-form" enctype="multipart/form-data">
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
                        <div class="app" style="display: none;">
                        </div>
                        <div class="modal-body ">
                            <div class="profession-body">
                                <fieldset>
                                   
                                        <div class="form-row">
                                            <div class="form-group col-md-12 input-group-sm">
                                              <label for="Profession">Profession<span style="color:red">*</span></label>
                                              <input type="text" class="form-control" id="Profession"  name="Profession" >
                                              <button type="button"  class="dropdown-btn" >
                                                <span aria-hidden="true" class="btn-down"><i class="fas fa-angle-down"></i></span>
                                              </button>
                                              {{-- <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                   aria-haspopup="true" aria-expanded="false">Dropdown
                                                    <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li>@foreach($profession ?? '' as $profession)
                                                            <a href="{{URL::route('home',$profession ?? ''->id)}}">
                                                                <option value="{{$profession ?? ''->id}}">{{ $profession ?? ''->profession_name }}</option>
                                                            </a>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </li> --}}
                                        </div>
                                        <div id="profession_list"></div>      
                                          </div>
                                          <div class="form-row"> 
                                          <div class="form-group col-md-10 input-group-sm">
                                            <label for="skills">Skills<span style="color:red">*</span></label>
                                            <textarea id="skills" name="skills" rows="7" cols="72">
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


<script>
    $(document).ready(function() {
        var url = $('meta[name="url"]').attr('content');
        var profile_id='<? {{$profile->id}}';
        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        var height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
        var canvas = document.getElementById("c");

        let imagesMap = new Map();              //data structure for the images added
        let shapesMap = new Map();              //data structure for the shapes added
        let textMap = new Map();                //data structure for the texts added
 
        
        /*===========================FUNCTIONS RELATED TO THE EDITOR=======================================*/
        //create a new fabric canvas
        var canvas = new fabric.Canvas('c', 
        {
            width: width,
            height: height,
            preserveObjectStacking: true,
            renderOnAddRemove: false,
        }
        );
        fabric.Object.prototype.objectCaching = false;

        // save initial state
        save();
        $("#main").hide();
        // register event listener for user's actions
        canvas.on('object:modified', function() {
            save();
        }); 
        
        $('[data-toggle="tooltip"]').tooltip();
        //function to show DIV of text styles selector when text is selected
        canvas.on('selection:created', function() {
            if(canvas.getActiveObject().get('type')==="i-text"){
                $("#text-styles").show();
                $("#shape-select").hide();
                $("#crop-options").hide();
            }
        });

        //function to hide DIV of text styles selector when text is not selected
        canvas.on('selection:cleared', function() {
            $("#text-styles").hide();
            $("#crop-options").hide();
        });

        
        //setup mouse events functions
        canvas.on({
        'object:moving': onMoving,
        'object:scaling': onScaling,
        'object:rotating': onRotating,
        'mouse:down': onSelected,
        });  


        //FUNCTIONS RELATED TO MOUSE EVENTS
        let lastShapeSelected;
        let lastImgIntersected;

        //function to check if image intersects with shape and the image is in front of the shape
        function checkIntersectionWithShape(theImg){
        // if(theImg.globalCompositeOperation === 'source-atop') theImg.set({globalCompositeOperation:'source-over'});
            for(const [key,val] of shapesMap.entries()){
                if(theImg.intersectsWithObject(val)){
                //if the image is in front of  a shape, set the image atop

                theImg.set({globalCompositeOperation:'source-atop'});
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

                }
            }  
        return false;
        }

        //function to check if object is on scaling
        function onScaling(options){
            //def scaling here
        }

        //function to check if the image is not in front of any shape
        var isIntersecting = false;
        var objSelected;
        function onMoving(options){
            options.target.setCoords();

            //if the current selected is an image
            if(imagesMap.has(options.target.name)){
                let temp = checkIntersectionWithShape(options.target);
                    //if the image is not in front of any shape
                    if(!temp) options.target.set({globalCompositeOperation:'source-over'});
                    
                let temp_1 = checkIntersectionWithBackText(options.target);
                    if(!temp_1){
                    if(theTextUnderImg){
                    canvas.bringToFront(theTextUnderImg);
                    }
                    }
                }
                
            else if(shapesMap.has(options.target.name)){
                let temp = checkIntersectionWithImg(options.target);
                    if(!temp){
                    if(theImgUnderShape){
                    theImgUnderShape.set({globalCompositeOperation:'source-over'});
                    }
                    }
                }

            //if the current selected is a text
            else if(textMap.has(options.target.name)){
                let temp = checkIntersectionWithText(options.target);
                    //if the image is not in front of any shape
                   
                }  
        }

        //function to check if object is on rotating
        function onRotating(options){
        }

        canvas.on('selection:cleared', function() {
            // canvas.requestRenderAll();
            // currShapeSelected = null;
            if(currTextSelected) currTextSelected = null;
            if(currShapeSelected) currShapeSelected = null;
        });

        //function to check if object is on selected
        let currShapeSelected, currTextSelected;
        function onSelected(options){
            if(options.target){
                

                if(shapesMap.has(options.target.name)){
                    let width = Math.ceil(options.target.strokeWidth/2);
                    strokeVal.innerHTML = width+"";
                    strokeSlider.value = width+"";
                    shapeFill.value = options.target.fill;
                    shapeStroke.value = options.target.stroke;
                    
                    
                    currShapeSelected = options.target;
                }else if(textMap.has(options.target.name)){
                    currTextSelected = options.target;
                }

                objSelected = options.target;

            }
        }
        $(".remove-btn-education").hide();
        $(".remove-btn-workexperience").hide();
        $(".remove-btn-reference").hide();
        
        /*FUNCTIONS RELATED TO THE EDITOR TOOLBAR*/
        //function to hide DIV of shape, text, crop divs of toolbar when x icon is clicked
        $(".toolbar-close").on('click',function(){
            $(this).parent().hide();
        });
       

        //function to show DIV of shape selector when add shape button is clicked
        $("#add_shapes").click(function(){
            $("#shape-select").show();
            $("#text-styles").hide();
            $("#crop-options").hide();
        });
       
        //function to show DIV of text styles selector when add text button is clicked
        $("#add_text").click(function(){
            $("#text-styles").show();
            $("#shape-select").hide();
            $("#crop-options").hide();
        }); 

         //if any of the shape is selected
        $("#circle, #triangle, #square, #rectangle, #diamond, #parallelogram, #ellipse, #trapezoid, #star, #pentagon, #hexagon, #heptagon,#octagon,#nonagon,#decagon,#bevel,#heart, #rabbet,#point,#message").on("click", function() {
            addShape(this.id);
        });
                 //FUNCTIONS RELATED TO THE TOOLBAR
        $("#add_text").on("click", function(e) {
            add_text();
        }); 

         // undo and redo buttons
        $('#undo').click(function() {
            replay(undo, redo, '#redo', this);
        });
        $('#redo').click(function() {
            replay(redo, undo, '#undo', this);
        })
        $('#clear_canvas').click(function() {
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

          //ZOOM IN / ZOOM OUT ICON IS CLICKED
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

        //if download icon is clicked
        $(".download").on("click", function(e) {
                downloadImage();
        });



        //function to upload images to the editor
        document.getElementById('imgLoader').onchange = function handleImage(e) {
      
            $('.start-message').hide();
            var files = this.files;
          
            //for each image selected by the user from the local dir
            for (var i = 0, f; f = files[i]; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var imgObj = new Image();
                    imgObj.src = event.target.result;
                    imgObj.onload = function () {
                        // start fabricJS stuff
                        
                        var image = new fabric.Image(imgObj);
                     
                        image.set({
                            left: 0, 
                            top: 0, 
                            angle: 0, 
                            borderColor: '#d6d6d6',
                            cornerColor: '#d6d6d6',
                            cornerSize: 10,
                            transparentCorners: false,
                            name:"img"+(imagesMap.size+1),                          
                        });
                        image.scaleToWidth(canvas.getWidth()/6);
                        canvas.add(image).centerObject(image);
                        imagesMap.set(image.name,image);
                        canvas.renderAll();
                        save();
                    }//end of img onload
                }//end of reader onload
                reader.readAsDataURL(f);
            }//end of for each image selected
        }//end of when image loader is selected

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
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                // image.setCoords();
                                canvas.renderAll();
                                save();
                                // end fabricJS stuff
                            }
                            
                        }
                        reader.readAsDataURL(f);
                    }
                }


        //function when removing objects
        $('.remove_object').click(function() {
            delete_object();
        });

        $('body').keyup(function(e){
            if(e.keyCode == 46) {       
                delete_object();
            }
        });

        //delete the current object selected
        function delete_object(){
            let theObj = canvas.getActiveObject();
            //if more than one object is selected
            if(theObj._objects){
                theObj._objects.forEach(function(obj){
                    if(imagesMap.has(obj.name)){
                        imagesMap.delete(obj.name);
                    }else if(shapesMap.has(obj.name)){
                        shapesMap.delete(obj.name);
                    }else if(textMap.has(obj.name)){
                        textMap.delete(obj.name);
                    }
                    canvas.remove(obj);
                    canvas.discardActiveObject().renderAll();
                    countObjects();
                    save();
                });
            //only 1 object is selected
            }else{
                if(imagesMap.has(theObj.name)){
                    imagesMap.delete(theObj.name);
                }else if(shapesMap.has(theObj.name)){
                    shapesMap.delete(theObj.name);
                }else if(textMap.has(theObj.name)){
                    textMap.delete(theObj.name);
                }
                canvas.remove(theObj);
                canvas.discardActiveObject().renderAll();
                countObjects();
                save();
            }
            
        }//end of function



        //FUNCTIONS FOR THE STATE OF THE CANVAS RELATED TO UNDO,  REDO , RESET CANVAS
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
                $('.download').prop('disabled', false);
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

       


       





        //FUNCTIONS RELATED TO TEXTS
        //function to add text
        var text;
        function add_text() { 
        $('.start-message').hide();
            text = new fabric.IText('Click here to edit text', { 
            fontFamily: 'Calibri',
            left: 100, 
            top: 100,
            fill: '#FFFFFF', 
            cache: false,
            borderColor: '#d6d6d6',
            cornerColor: '#d6d6d6',
            name:"text"+(textMap.size+1),   
        });
            text.scaleToWidth(canvas.getWidth()/5);
            canvas.add(text);
            canvas.setActiveObject(text); 
            canvas.renderAll();
            textMap.set(text.name,text);
        }

        //if the text created is clicked
       canvas.on("text:editing:entered", function (e) {
        var obj = canvas.getActiveObject();
            if(obj.text === 'Click here to edit text'){
                obj.text = "";
                obj.hiddenTextarea.value = "";
                obj.enterEditing();
                obj.dirty = true;
                obj.setCoords();
                canvas.renderAll();
            }
        });

       //if the text created is unselected
        canvas.on('text:editing:exited', function(e) {
            if(text.text === ''){
                text.text = "Click here to edit text";
                text.dirty = true;
                text.setCoords(); 
                canvas.renderAll();
            } 
        }); 

        //function to change the font style
        function applyFont(font) {
            console.log('You selected font: ' + font);

            // Replace + signs with spaces for css
            font = font.replace(/\+/g, ' ');

            // Split font into family and weight
            font = font.split(':');

            var fontSelected = font[0];
            var fontWeight = font[1] || 400;

            if(currTextSelected){
                currTextSelected.set({
                    fontFamily: fontSelected
                });
                canvas.renderAll();
            }
        }

        $('#font-picker').fontselect().on('change', function() {
            applyFont(this.value);
        });

        
        //function to change the font color
        $('#text-color').on('input',function(){
            if(currTextSelected){
                currTextSelected.setSelectionStyles({
                    fill: $(this).val()
                });
                canvas.renderAll();
            }

        });






        //function to add shapes
        function addShape(shape){
            if(shape==='circle'){
                var theShape = new fabric.Circle({
                    radius: 300,
                    scaleX: 0.35, 
                    scaleY: 0.35,
                    fill: '#DDD',
                    left: 450,
                    top: 175,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    name:"shape"+(shapesMap.size+1),  
                });  
            }else if(shape==='triangle'){
                var theShape = new fabric.Triangle({
                    width: 200, 
                    height: 200, 
                    scaleX: 1, 
                    scaleY: 1,
                    left: 450,
                    top: 175,
                    fill: '#DDD',
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    name:"shape"+(shapesMap.size+1),    
                });

            }else if(shape==='square'){
                var theShape = new fabric.Rect({
                    width: 100, 
                    height: 100, 
                    scaleX: 2, 
                    scaleY: 2,
                    left: 450,
                    top: 175,
                    fill: '#DDD',
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    name:"shape"+(shapesMap.size+1), 
                });
            }else if(shape==='rectangle'){
                var theShape = new fabric.Rect({
                    width: 200, 
                    height: 100, 
                    scaleX: 1.5, 
                    scaleY: 1.5,
                    left: 450,
                    top: 175, 
                    fill: '#DDD',
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    name:"shape"+(shapesMap.size+1), 
                });
            }else if(shape==='diamond'){
                var theShape = new fabric.Polygon([
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

            }else if(shape==='parallelogram'){
                var theShape = new fabric.Polygon([
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

            }else if(shape==='ellipse'){
                var theShape = new fabric.Ellipse({ 
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
            }else if(shape==='trapezoid'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='star'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='pentagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='hexagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='heptagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='octagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='nonagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='decagon'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='bevel'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='heart'){
                var theShape = new fabric.Path('M 272.70141,238.71731 \
                    C 206.46141,238.71731 152.70146,292.4773 152.70146,358.71731  \
                    C 152.70146,493.47282 288.63461,528.80461 381.26391,662.02535 \
                    C 468.83815,529.62199 609.82641,489.17075 609.82641,358.71731 \
                    C 609.82641,292.47731 556.06651,238.7173 489.82641,238.71731  \
                    C 441.77851,238.71731 400.42481,267.08774 381.26391,307.90481 \
                    C 362.10311,267.08773 320.74941,238.7173 272.70141,238.71731  \
                    z ');   
                
                theShape.set({ 
                    scaleX: 0.5, 
                    scaleY: 0.5,
                    originX: 'left',
                    originY: 'top',
                    left: 450,
                    top: 175,
                    width: 450,
                    height: 450,
                    fill: '#DDD', 
                    strokeWidth: 0,
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false,
                    name:"shape"+(shapesMap.size+1),     
                });
                    
            }else if(shape==='rabbet'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='point'){
                var theShape = new fabric.Polygon([
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

            }else if(shape==='chevron'){
                var theShape = new fabric.Polygon([
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
            }else if(shape==='message'){
                var theShape = new fabric.Polygon([
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
            }
                canvas.add(theShape);
                canvas.sendToBack(theShape);
                canvas.renderAll();
                save();
                shapesMap.set(theShape.name,theShape);

        }//end of addshape function

       

        //for setting the shape color
        let shapeFillColor;
        $('#shapeFill').on('input',function(){
            if(currShapeSelected){
                currShapeSelected.fill = $('#shapeFill').val();
                canvas.renderAll();
            }
        });

        //for setting the shape stroke
        $('#shapeStroke').on('input',function(){
            if(currShapeSelected){
                currShapeSelected.stroke = $('#shapeStroke').val();
                canvas.renderAll();
            }
        });
        //for the shape stroke width slider
        var strokeSlider = document.getElementById("strokeRange");
        var strokeVal = document.getElementById("strokeVal");
        strokeVal.innerHTML = strokeSlider.value;

        strokeSlider.oninput = function() {
            if(currShapeSelected){
                currShapeSelected.strokeWidth =  strokeSlider.value*2;
                strokeVal.innerHTML = strokeSlider.value;
                canvas.renderAll();
            }
            
        }

      
        // SAVE ICON IS CLICKED
        $(".save").click(function(){
            Swal.fire({
                html: "Are you sure you want to save the changes made to the entry? <br><br> This will overwrite your previous career profile image.",
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
                    var user_id = '{{Auth::user()->id}}';
                    var data = new FormData();
                    data.append('file', blob);
                    data.append('user_id', user_id);

                    $.ajax({
                        type: "POST",
                        url: url+'/api/save-careerprofile',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            Swal.fire({
                                title: '<span class="success">Success!</span>',
                                text: 'Your Career Profile image was successfully saved!',
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

        //REDIRECT TO DASHBOARD IF CANCEL BUTTON IS CLICKED
        $('button.cancel-btn').click(function() {
            window.location.href = url+'/dashboard';
        });




        //function to check if save icon should be enabled
        function countObjects(){
            var object_count = canvas.getObjects().length;

            if(object_count < 1) {
                $('.save').prop('disabled', true);
            }
        }
  
        //function to download the image
        function downloadImage() {
            var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will 

            var link = window.document.createElement('a');
            link.href = image;
            link.download = "screenshot.jpg";
            var click = document.createEvent("MouseEvents");
            click.initEvent("click", true, false);
            link.dispatchEvent(click); 

        }


    

        /*FUNCTIONS RELATED TO THE INSTRUCTIONS OVERLAY*/
        // show instruction overlay
        $('.help a').click(function () {
            $('.instructions').fadeIn();
        });

        // hide instruction overlay
        $('.instruction-close-btn').click(function() {
            $('.instructions').fadeOut();
            $('#main').show();
            $('.start-message').show();
            
        });

        // show instruction text on hover of each box
        $('.instruction').hover(
            function() {
                var text_div = $(this).data('text-div');
                $('.'+text_div).fadeIn();
            },
            function() {
                var text_div = $(this).data('text-div');
                $('.'+text_div).hide();
            }
        );
                
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
        $('.clone-btn-education').click(function(e) {
                    e.preventDefault();
                //    $(".remove-btn-education").hide();
                    var $form = $('form#education-form');
                    var newel = $('.education-body:last').clone();
                    $(newel).insertAfter(".education-body:last");
                    var new_ele = $('.education-body:last');
                    new_ele.find('input').val("");
                    var count = $(".education-body");
                    new_ele.removeClass('div_'+(count.length-1))
                    new_ele.addClass('div_'+count.length)
                  
                 if(count.length>1){
                    $(".education-body:last .clone-btn-education").hide();
                    $(".education-body:last .remove-btn-education").show();
                 }
                 $(".education-body:last #StartDate").focus().select();    
        });
 
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
                    
                }); 

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
       

              $('.profession').click(function(e) {
                 e.preventDefault();

                 var form_url = url+'/get_career_details';
                    $.ajax({
                    url: form_url,
                    method: 'post',
                    data: { 
                        profile_id: profile_id,
                        user_id: user_id,
                        },
                    dataType: 'json',
                success: function(data) {
                  

                },
                error: function (request, status, error) {
                   
                }
                });

             });
    });
                function openNav()
                 {
                document.getElementById("mySidenav").style.width = "17vw";
                document.getElementById("main").style.marginLeft = "250px";
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
</script>
@endsection