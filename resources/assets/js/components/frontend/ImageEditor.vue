<template>
   
     <div class="collage-editor">
            <button class="cancel-btn" id="cancel-btn" type="button">Cancel</button>
            <div class="canvas">
                 <!-- canvas portion of the image editor-->
                <canvas id="c"></canvas>
            </div>

            <!--The toolbar of the image editor-->
             <div class="controls">
                <button id="undo" class="undo" disabled data-toggle="tooltip" data-placement="top" title="Undo"><i class="fas fa-undo"></i></button>
                <button id="redo" class="redo" disabled data-toggle="tooltip" data-placement="top" title="Redo"><i class="fas fa-redo"></i></button>
                <button id="clear_canvas" class="clear_canvas" disabled data-toggle="tooltip" data-placement="top" title="Reset"><i class="fas fa-retweet"></i></button>     
                <button class="zoom-in" title="Zoom In" data-toggle="tooltip" data-placement="top"><i class="fas fa-search-plus"></i></button>
                <button class="zoom-out" data-toggle="tooltip" data-placement="top" title="Zoom Out"><i class="fas fa-search-minus"></i></button>
                <button class="original-size" data-toggle="tooltip" data-placement="top" title="100%"><i class="fas fa-expand-arrows-alt"></i></button>
                <button class="bring-forward" data-toggle="tooltip" data-placement="top" title="Bring Forward"></button>
                <button class="send-backward" data-toggle="tooltip" data-placement="top" title="Send Backward"></button>
                <button id="add_shapes" class="add_shapes" data-toggle="tooltip" data-placement="top" title="Shapes Tool"><i class="fas fa-shapes"></i></button>
                <button id="add_text" class="add_text" data-toggle="tooltip" data-placement="top" title="Texts Tool"><i class="fas fa-font"></i></button>
                <button data-toggle="tooltip" data-placement="top" title="Upload image(s)"><label for="imgLoader" class="custom-file-upload">
                    <i class="far fa-images"></i></label>
                </button>
                <input type="file" name="image" id="imgLoader" accept="image/x-png,image/jpeg" multiple>
                <button id="cropImage" class="cropImage" data-target="#cropperModal" data-toggle="modal"><i class="fa fa-crop" data-toggle="tooltip" data-placement="top" title="Crop"></i></button> 
                <button class="remove_object" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></button>  
                <button class="save" id="saveImg" disabled data-toggle="tooltip" data-placement="top" title="Save"><i class="fas fa-save"></i></button>
                <button class="download" disabled data-toggle="tooltip" data-placement="top" title="Download"><i class="fas fa-download"></i></button>
                <button id="open_tuiEditor" class="open_tuiEditor" data-toggle="tooltip" data-placement="top" title="Open in 2nd Editor"><i class="fas fa-link"></i></button>                       
                
            </div>
            <!--end of the canvas toolbar-->

             <!-- section for the shapes selection div. also contains the selection for the shape color and stroke-->
            <div id="shape-select" class="shape-select" style="display:none;">
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
            <div id="text-styles" class="text-styles" style="display:none;">
                <div id='text-option-box' style="overflow-y: visible;overflow-x:hidden">
                    <div style="width: 100%;position: relative;">
                        <label for="addTxtBtn" title="">
                            <button id="addTxtBtn" class="btn btn-success">Add Text</button>
                        </label>
                    </div>
                    <div style="width: 100%;position: relative;">
                        <input type="color" id="text-color" name="text-color"/><br/>
                        Color
                    </div>
                    <div class="font-picker">
                        <input id="font-picker" type="text"><br/>
                        Font Style
                    </div>
                </div>
            </div> <!--end of text styles div-->

            
           
            <!--Instructions overlay -->
            <div class="instructions" id="instructionsDiv">
                <span class="instruction-close-btn"><i class="far fa-times-circle"></i></span>
                <div class="instruction instruction-3" data-text-div="instruction-text-3"></div>
                <div class="instruction instruction-4" data-text-div="instruction-text-4"></div>
                <div class="instruction instruction-5" data-text-div="instruction-text-5"></div>

                <div class="instruction-text instruction-text-3">Canvas controls</div>
                <div class="instruction-text instruction-text-4">Canvas</div>
                <div class="instruction-text instruction-text-5">Cancel</div>
            </div>

            <div class="help">
                <a class=""><i class="fa fa-question-circle icon-help" aria-hidden="true"></i></a>
            </div>
            <!--End of Instructions overlay-->


            <!--Start of image cropper modal-->
                 <!-- Modal -->
            <div class="modal" id="cropperModal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Cropper</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                        <img id="cropperImage" src="" alt="Picture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" id="saveCroppedImg" data-dismiss="modal" class="btn btn-success">Save</button>
                    </div>
                    </div>
                </div>
            </div>
            <!--end of cropper-->
    </div>

</template>

<script>
export default {
    props: {
        edit_blog: Number
    },
    components: {
    },
    data() {
        
       return {
            temp:{},
           
        }
    },
    methods: {
       
    },
    mounted() {
        

        var url = $('meta[name="url"]').attr('content');
        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        var height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
        var canvas = document.getElementById("c");

        let imagesMap = new Map();              //data structure for the images added
        let shapesMap = new Map();              //data structure for the shapes added
        let textMap = new Map();                //data structure for the texts added
        let imgCnt = 0;
        let shapeCnt = 0;
        let textCnt = 0;
 
        
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

        

        //load the image when the user selects from the page where the component is used
        var featured_image_src;
        document.querySelector("#featured-image-previewimg").addEventListener('load', function() {
            //only load the image to the canvas if the user has chosen a new image
            if(isNewImg){
                featured_image_src = document.querySelector("#featured-image-previewimg").getAttribute("src");
                canvasOperations.loadFromUrl();
            }
            
        });
        //function to clear the canvas if new image is loaded
        var canvasOperations = {
            loadFromUrl : function(){
                if(imagesMap.size > 0){
                     canvas.clear();
                     imagesMap.clear();
                     addFeaturedImage();
                }else{
                    addFeaturedImage();
                }
            }
        }
        //function to add the featured image from the page component to the canvas
        function addFeaturedImage(){
            //create the image here
            var imgObj = new Image();
            imgObj.src = featured_image_src;
            imgObj.onload = function () {
                var image = new fabric.Image(imgObj);
                
                image.set({
                    left: 0, 
                    top: 0, 
                    angle: 0, 
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false,
                    name:"img"+(imgCnt++),                          
                });
                image.scaleToWidth(canvas.getWidth()/4);
                canvas.add(image).centerObject(image);
                imagesMap.set(image.name,image);
                canvas.renderAll();
                save();
            }
        }


        //=========================================FUNCTIONS RELATED TO MOUSE EVENTS==========================================
        // register event listener for user's actions
        canvas.on('object:modified', function() {
            save();
        }); 
        
        
        //function to show DIV of text styles selector when text is selected
        canvas.on('selection:created', function() {
            if(canvas.getActiveObject().get('type')==="i-text"){
                $("#text-styles").hide();
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


        
        let lastShapeSelected;
        let lastImgIntersected;

        //function to check if image intersects with shape and the image is in front of the shape
        function checkIntersectionWithShape(theImg){
        //check if the image intersects with any shape in the shapesMap
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
                    //else the shape is not intersecting with any image
                }
            }  
        return false;
        }

        //function to check if image intersects with text and the image is at the back of the text
        function checkIntersectionWithText(theTxt){
            for(const [key,val] of imagesMap.entries()){
                if(theTxt.intersectsWithObject(val)){
                    //if the image is in front of  a shape, set the image atop
                    canvas.bringToFront(theTxt);
                return true;
                }
            }
            return false;
        }

        //function to check if text intersects with image
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

        //function that handles mouse movement event
        var isIntersecting = false;
        var objSelected;
        function onMoving(options){
            options.target.setCoords();
            //if the current selected is an image
            if(imagesMap.has(options.target.name)){
                //check if image intersects with shape
                let temp = checkIntersectionWithShape(options.target);
                //if the image is not in front of any shape ,set position as sourc over
                if(!temp) options.target.set({globalCompositeOperation:'source-over'});
                
                //check if text intersects with any image or shape
                let temp_1 = checkIntersectionWithBackText(options.target);
                //if text is not intersecting
                if(!temp_1){
                    if(theTextUnderImg){
                        //bring the text to front
                        canvas.bringToFront(theTextUnderImg);
                    }
                }
            //if the current moving object is a shape
            }else if(shapesMap.has(options.target.name)){
                //check if shape intersects with any image
                let temp = checkIntersectionWithImg(options.target);
                    //if the shape is not intersecting any image
                    if(!temp){
                        //if the image is under a shape
                        if(theImgUnderShape){
                            //set the image's position to source over
                            theImgUnderShape.set({globalCompositeOperation:'source-over'});
                        }
                    }
            }
        }

        //function to check if object is on rotating
        function onRotating(options){
        }

        //if the no object is under the cursor on mouse click
        canvas.on('selection:cleared', function() {
            if(currTextSelected) currTextSelected = null;
            if(currShapeSelected) currShapeSelected = null;
        });

        //function to check if object is selected
        let currShapeSelected, currTextSelected;
        function onSelected(options){
            //if there's an object under the pointer
            if(options.target){
                //if the object selected is a shape
                if(shapesMap.has(options.target.name)){
                    //set the stroke and color fill of the stroke slider components in the shape div
                    let width = Math.ceil(options.target.strokeWidth/2);
                    strokeVal.innerHTML = width+"";
                    strokeSlider.value = width+"";
                    shapeFill.value = options.target.fill;
                    shapeStroke.value = options.target.stroke;
                    currShapeSelected = options.target;
                //if the current object selected is a text
                }else if(textMap.has(options.target.name)){
                    currTextSelected = options.target;
                }
                //set the current select object to var
                objSelected = options.target;

            }
        }
      
        /*========================================FUNCTIONS RELATED TO THE EDITOR TOOLBAR================================*/
        $("#open_tuiEditor").on('click',function(){
            var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            document.querySelector("#featured-image-previewimg").src = image;
            $("#tuiEditorModal").show();
            $("#imageEditorModal").hide();
        });

        //toolbar toggle function for the shapes div
        let isShapeDivOpen = false;
        $("#add_shapes").on('click',function(){
            if(!isShapeDivOpen){
                $("#shape-select").show();
                $("#text-styles").hide();
            }else{
                $("#shape-select").hide();
            }
            isShapeDivOpen = !isShapeDivOpen;
        });

        //toolbar toggle function for the text div
        let isTextDivOpen = false;
        $("#add_text").on('click',function(){
            if(!isTextDivOpen){
                $("#text-styles").show();
                $("#shape-select").hide();
            }else{
                $("#text-styles").hide();
            }

            isTextDivOpen = !isTextDivOpen;
        });

        //if the ADD TEXT button from text div is clicked
        $("#addTxtBtn").on('click',function(){
             add_text();
        });


         //if any of the shape is selected, add the shape
        $("#circle, #triangle, #square, #rectangle, #diamond, #parallelogram, #ellipse, #trapezoid, #star, #pentagon, #hexagon, #heptagon,#octagon,#nonagon,#decagon,#bevel,#heart, #rabbet,#point,#message").on("click", function() {
            addShape(this.id);
        });
        

        //if undo button is clicked, hide text and shape div if they are open and return canvas to previous state
        $('#undo').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            replay(undo, redo, '#redo', this);
        });

        //if redo button is clicked, hide text and shape div if they are open and return canvas to forward state
        $('#redo').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            replay(redo, undo, '#undo', this);
        })

        //if clear canvas button is clicked, hide text and shape div if they are open and remove all objects from canvas
        $('#clear_canvas').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();

            //ask the user if they really want to clear the canvas
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

        //if zoom in button is clicked, hide text and shape div if they are open and zoom in the canvas 20% closer
        var scale = 1;
        $('.zoom-in').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            scale += 0.2;
            $('.canvas-container').css('transform', 'scale('+scale+')');
        });

        //if zoom in button is clicked, hide text and shape div if they are open and zoom in the canvas 20% farther
        $('.zoom-out').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            if(scale <= 0.2) {
                scale = 0.2;
            } else if (scale > 0) {
                scale -= 0.2;
            }
            $('.canvas-container').css('transform', 'scale('+scale+')');
        });
        
        //if 100% button is clicked, hide text and shape div if they are open and return canvas to original scale
        $('.original-size').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            scale = 1;
            $('.canvas-container').css('transform', 'scale('+scale+')');
        });

        //if download button is clicked, hide text and shape div if they are open and download the image to local dir
        $(".download").on("click", function(e) {
            $("#shape-select").hide();
            $("#text-styles").hide();
            downloadImage();
        });



        //function to upload images to the editor
        document.querySelector('#imgLoader').onchange = function handleImage(e) {
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
                            name:"img"+(imgCnt++),                          
                        });
                        image.scaleToWidth(canvas.getWidth()/3);
                        canvas.add(image).centerObject(image);
                        imagesMap.set(image.name,image);
                        canvas.renderAll();
                        save();
                    }//end of img onload
                }//end of reader onload
                reader.readAsDataURL(f);
            }//end of for each image selected
        }//end of when image loader is selected


        //function when removing/deleting objects from the canvas
        $('.remove_object').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            delete_object();
        });

        //if delete button is pressed from keyboard
        $('body').keyup(function(e){
            if(e.keyCode == 46) {       
                delete_object();
            }
        });

        //if bring forward button is clicked, put the current object selected forward
        $('.bring-forward').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            var currentObject = canvas.getActiveObject();
            canvas.bringToFront(currentObject);
            canvas.renderAll();
            save();
        });

        //if bring forward button is clicked, put the current object selected forward
        $('.send-backward').click(function() {
            $("#shape-select").hide();
            $("#text-styles").hide();
            var currentObject = canvas.getActiveObject()
            canvas.sendToBack(currentObject);
            canvas.renderAll();
            save();
        });

        
        //delete the current object selected
        function delete_object(){
            let theObj = canvas.getActiveObject();
            //if more than one object is selected
            if(theObj._objects){
                theObj._objects.forEach(function(obj){
                    if(imagesMap.has(obj.name)){
                        imagesMap.delete(obj.name);
                        imgCnt--;
                    }else if(shapesMap.has(obj.name)){
                        shapesMap.delete(obj.name);
                        shapeCnt--;
                    }else if(textMap.has(obj.name)){
                        textMap.delete(obj.name);
                        textCnt--;
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
                    imgCnt--;
                }else if(shapesMap.has(theObj.name)){
                    shapesMap.delete(theObj.name);
                    shapeCnt--;
                }else if(textMap.has(theObj.name)){
                    textMap.delete(theObj.name);
                    textCnt--;
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
            if(state) {
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
            text = new fabric.IText('Click here to edit text', { 
                fontFamily: 'Calibri',
                left: 100, 
                top: 100,
                fill: '#FFFFFF', 
                cache: false,
                borderColor: '#d6d6d6',
                cornerColor: '#d6d6d6',
                name:"text"+(textCnt++),   
            });
            text.scaleToWidth(canvas.getWidth()/5);
            canvas.add(text);
            canvas.setActiveObject(text); 
            canvas.renderAll();
            textMap.set(text.name,text);
        }//eof function

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
       
       //function to change the font style
        $('#font-picker').on('change',function(){
            let theFont = $('#font-picker').val();
            applyFont(theFont);
           
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
                    name:"shape"+(shapeCnt++),  
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
                    name:"shape"+(shapeCnt++),    
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
                    name:"shape"+(shapeCnt++), 
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
                    name:"shape"+(shapeCnt++), 
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
                    name:"shape"+(shapeCnt++),         
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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),  
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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),     
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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

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
                    name:"shape"+(shapeCnt++),    

                });
            }
                canvas.add(theShape).centerObject(theShape);
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
        $("#saveImg").click(function(){
            var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            document.querySelector("#featured-image-previewimg").src = image;
            
            document.querySelector('#imageEditorModal').style.display = 'none';
            $('#page-content').show();        

            isNewImg = false;
        }); 

        $("#cancel-btn").on('click', function() {
            document.querySelector('#imageEditorModal').style.display = 'none';
            $('#page-content').show();           
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


        var cropBoxData;
        var canvasData;
        var cropper;
        var theImgBeingCropped;
        $('#cropImage').on('click',function() {
            let theObj = canvas.getActiveObject();
            if(imagesMap.has(theObj.name)){
                var image = theObj.toDataURL("image/png").replace("image/png", "image/octet-stream");
                theImgBeingCropped = theObj;
                document.querySelector("#cropperImage").src = image;
                
            }
            
        }); //end of cropImage btn

        $('#saveCroppedImg').on('click',function() {
            if(cropper){ 
                let cropperCanvas = cropper.getCroppedCanvas();
                let theImg = cropperCanvas.toDataURL();
                replaceWithCroppedImage(theImg);
            }
        }); //end of saveImg btn


        $('#cropperModal').on('shown.bs.modal', function () {
            var theImage = document.getElementById('cropperImage');
            
            cropper = new Cropper(theImage, {
                    autoCropArea: 0.5,
                    ready: function () {
                        //Should set crop box data first here
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                    });
            });

        $('#cropperModal').on('hidden.bs.modal', function () {
            cropBoxData = cropper.getCropBoxData();
            canvasData = cropper.getCanvasData();
            cropper.destroy();
        });

        function replaceWithCroppedImage(image_src){
            //create the image here
           
            var imgObj = new Image();
            imgObj.src = image_src;
            imgObj.onload = function () {
                var image = new fabric.Image(imgObj);
                
                image.set({
                    left: 0, 
                    top: 0, 
                    angle: 0, 
                    borderColor: '#d6d6d6',
                    cornerColor: '#d6d6d6',
                    cornerSize: 10,
                    transparentCorners: false,
                    name:"img"+(imgCnt++),                       
                });
                canvas.add(image).centerObject(image);
                imagesMap.set(image.name,image);
                canvas.renderAll();
                save();
            }

           

            delete_object();

            
        }


        
    }//end of mount
}
</script>

<style scoped>


            
</style>