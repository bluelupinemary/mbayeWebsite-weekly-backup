
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
       

        <title>@yield('title', app_name())</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Hammersmith One|Pacifico|Anton|Sigmar One|Righteous|VT323|Quicksand|Inconsolata' rel='stylesheet' type='text/css'>
        <!-- Styles -->
        <style>
    body {
                background-image: url(../../front/images/skybox_bg1.png);
                background-size: cover; 
    }
    canvas{
                border: 1px solid red;
               /* background-image: url(skybox_bg1.jpg); 
                background-size: 100% 100%; */
    }
    button {
                padding: 10px 20px;
    }
    select {
                padding: 10px 20px;
    }
    .collage-editor .canvas {
                position: absolute;
                top: 55%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 80%; 
                height: 80vh;
                margin: 0 auto;
                overflow: auto;
                border: 1px solid #3e3e3e;
                display: flex;
                justify-content: center;
                align-items: center;
                scrollbar-width: thin;
                scrollbar-color: #047999 #c1d7e491;
            }
    .collage-editor .canvas::-webkit-scrollbar {
                width: 0.8em;
                background:transparent;
            }            
    .collage-editor .canvas::-webkit-scrollbar-thumb {
                background: transparent;
            }
    .collage-editor .canvas-container {
                position: absolute !important;
                transform: scale(1);
            }
    input, label {
                /* display: block; */
                color: white;
                text-align: center;
    }
    input[type="file"] {
                display: none;
    }
    .custom-file-upload {
                border: 1px solid #ccc;
                display: inline-block;
                padding: 6px 12px;
                cursor: pointer;
    }

        /* hammersmith-one-regular - latin */
@font-face {
  font-family: 'Hammersmith One';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/hammersmith-one-v10-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('Hammersmith One'), local('HammersmithOne'),
       url('../fonts/hammersmith-one-v10-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/hammersmith-one-v10-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/hammersmith-one-v10-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/hammersmith-one-v10-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/hammersmith-one-v10-latin-regular.svg#HammersmithOne') format('svg'); /* Legacy iOS */
}

  /* pacifico-regular - latin */
@font-face {
  font-family: 'Pacifico';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/pacifico-v16-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('Pacifico Regular'), local('Pacifico-Regular'),
       url('../fonts/pacifico-v16-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/pacifico-v16-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/pacifico-v16-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/pacifico-v16-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/pacifico-v16-latin-regular.svg#Pacifico') format('svg'); /* Legacy iOS */
    }

    /* anton-regular - latin */
@font-face {
  font-family: 'Anton';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/anton-v11-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('Anton Regular'), local('Anton-Regular'),
       url('../fonts/anton-v11-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/anton-v11-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/anton-v11-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/anton-v11-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/anton-v11-latin-regular.svg#Anton') format('svg'); /* Legacy iOS */
}

/* sigmar-one-regular - latin */
@font-face {
  font-family: 'Sigmar One';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/sigmar-one-v10-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('Sigmar One Regular'), local('SigmarOne-Regular'),
       url('../fonts/sigmar-one-v10-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/sigmar-one-v10-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/sigmar-one-v10-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/sigmar-one-v10-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/sigmar-one-v10-latin-regular.svg#SigmarOne') format('svg'); /* Legacy iOS */
}

/* righteous-regular - latin */
@font-face {
  font-family: 'Righteous';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/righteous-v8-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('Righteous'), local('Righteous-Regular'),
       url('../fonts/righteous-v8-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/righteous-v8-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/righteous-v8-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/righteous-v8-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/righteous-v8-latin-regular.svg#Righteous') format('svg'); /* Legacy iOS */
}

/* vt323-regular - latin */
@font-face {
  font-family: 'VT323';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/vt323-v11-latin-regular.eot'); /* IE9 Compat Modes */
  src: local('VT323 Regular'), local('VT323-Regular'),
       url('../fonts/vt323-v11-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/vt323-v11-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/vt323-v11-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/vt323-v11-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/vt323-v11-latin-regular.svg#VT323') format('svg'); /* Legacy iOS */
}

/* quicksand-regular - latin */
@font-face {
  font-family: 'Quicksand';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/quicksand-v21-latin-regular.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('../fonts/quicksand-v21-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/quicksand-v21-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/quicksand-v21-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/quicksand-v21-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/quicksand-v21-latin-regular.svg#Quicksand') format('svg'); /* Legacy iOS */
}

/* inconsolata-regular - latin */
@font-face {
  font-family: 'Inconsolata';
  font-style: normal;
  font-weight: 400;
  src: url('../fonts/inconsolata-v20-latin-regular.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('../fonts/inconsolata-v20-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('../fonts/inconsolata-v20-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
       url('../fonts/inconsolata-v20-latin-regular.woff') format('woff'), /* Modern Browsers */
       url('../fonts/inconsolata-v20-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
       url('../fonts/inconsolata-v20-latin-regular.svg#Inconsolata') format('svg'); /* Legacy iOS */
}

        </style>
    </head>
    <body>
        <div class="collage-editor">
            <button><label for="imgLoader" class="custom-file-upload" title="Upload image(s)">
                <i class="far fa-images"></i>
            </label></button>
            <input type="file" name="image" id="imgLoader" accept="image/x-png,image/jpeg" multiple>
          <!--  <label title="Add a background" class="myFile2"><span class="mdi mdi-image"> Add Background</span>&nbsp;
              <input type="file" id="file2" />
           </label> -->
          <select id="shapes" name="shapes">
            <option disabled selected value>Select a Shape</option>
            <option value="circle">Circle</option>
            <option value="tri">Triangle</option>
            <option value="square">Square</option> 
            <option value="rect">Rectangle</option>
            <option value="diam">Diamond</option>
            <option value="parallelo">Parallelogram</option>
            <option value="ellipse">Ellipse</option>
            <option value="trapez">Trapezoid</option>
            <option value="star">Star</option>
            <option value="penta">Pentagon</option>
            <option value="hexa">Hexagon</option>   
            <option value="hepta">Heptagon</option>
            <option value="octa">Octagon</option>
            <option value="nona">Nonagon</option>
            <option value="deca">Decagon</option>
            <option value="bevel">Bevel</option>
            <option value="rabbet">Rabbet</option>
            <option value="rtpoint">Point</option>
            <option value="rtchev">Chevron</option>
            <option value="msg">Message</option>
          </select>
          <button id="text">Text</button>
          <button id="delete">Delete</button>  
          <button id="save" onclick="downloadFabric(canvas,'profile');">Save</button>  
          <br><br>
          <div style="float:left; margin-right:20px;">
            <select name="FontStyle" id="FontStyle">
              <option value="Times New Roman" style="font-family:Times New Roman">Times New Roman</option>
              <option value="Arial" style="font-family:arial">Arial</option>
              <option value="Georgia" style="font-family:Georgia">Georgia</option>
              <option value="Hammersmith One" style="font-family:Hammersmith One">Hammersmith One</option>
              <option value="Pacifico" style="font-family:Pacifico">Pacifico</option>
              <option value="Anton" style="font-family:Anton">Anton</option>
              <option value="Sigmar One" style="font-family:Sigmar One">Sigmar One</option>
              <option value="Righteous" style="font-family:Righteous">Righteous</option>
              <option value="VT323" style="font-family:VT323">VT323</option>
              <option value="Quicksand" style="font-family:Quicksand">Quicksand</option>
              <option value="Inconsolata" style="font-family:Inconsolata">Inconsolata</option>
            </select>
          </div>
          <div style="float:left; margin-right:20px;">
            <label for="text-color">Text color</label>
            <input type="color" id="text-color" data-type="color" />
          </div>
          <div style="float:left; margin-right:20px;">
            <label for="bg-color">Text highlight</label>
            <input type="color" id="bg-color" data-type="color" />
          </div> 
          <div id="myDIV" class="canvas">
          <canvas id="c" width="1200" height="550"></canvas>
          <br>  
          <p class="save">
          </p>  
        </div>
        </div>

        <script src="{{asset('front/JS/fabric.min.js')}}"></script>
        <script src="{{asset('front/JS/gaTrackingJSFiddle.js')}}"></script>
        <script src="{{asset('front/JS/jquery-2.1.3x.min.js')}}"></script>
        <script src="{{asset('front/JS/lodash.min.js')}}"></script>
        <script>
          var canvas = window._canvas = new fabric.Canvas('c',{ renderOnAddRemove: false });
fabric.Object.prototype.objectCaching = false;

let imagesMap = new Map();
let shapesMap = new Map();
let textMap = new Map();

//function to reset on select shapes
$("#myDIV").on("click", function () {
        $("#shapes").val($("#shapes").data("default-value"));
    });

    $("#shapes").data("default-value", $("#shapes").val())

//function to select image/s
document.getElementById('imgLoader').onchange = function handleImage(e) {
                    // console.log(e);
                    $('.start-message').hide();
                    var files = this.files;

                    for (var i = 0, f; f = files[i]; i++) {

                            var reader = new FileReader();
                            //   var radius = 300;
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
                                    name:"img"+(imagesMap.size+1),                              
                                    // lockUniScaling: true
                                });
                                //image.scale(getRandomNum(0.1, 0.25)).setCoords();
                                image.scaleToWidth(canvas.getWidth()/4);
                                // image.scaleToHeight(canvas.getHeight());
                                canvas.add(image).centerObject(image);
                                imagesMap.set(image.name,image);
                                console.log("images map: ", imagesMap);
                                // image.setCoords();
                                canvas.renderAll();
                                //save();
                                // end fabricJS stuff
                            }
                            
                        }
                        reader.readAsDataURL(f);
                    }
                }

/*document.getElementById('file2').addEventListener("change", function(e) {
   var file = e.target.files[0];
   var reader = new FileReader();
   reader.onload = function(f) {
      var data = f.target.result;
      fabric.Image.fromURL(data, function(img) {
         // add background image
         canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height
         });
      });
   };
   reader.readAsDataURL(file);
}); 

//set background image
/*var canvasHeight = canvas.height;
var canvasWidth = canvas.width;
var bgImg = new fabric.Image();
bgImg.setSrc('skybox_bg1.jpg', function () {
  bgImg.set({
    top: 0,
    left: 0,
    scaleX: canvasWidth/bgImg.width,
    scaleY: canvasHeight/bgImg.height,
    name:"bg"+(bgMap.size+1),  
  });
  canvas.setBackgroundImage(bgImg);
  canvas.renderAll();
  bgMap.set(bgImg.name,bgImg);
  console.log("bgMap", bgMap);
});  */

/* document.getElementById('file2').addEventListener("change", function(e) {
   var file = e.target.files[0];
   var reader = new FileReader();
   reader.onload = function(f) {
      var data = f.target.result;
      fabric.Image.fromURL(data, function(img) {
         // add background image
         canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height
         });
      });
   };
   reader.readAsDataURL(file);
}); */

//buttons functions
$("#text").on("click", function(e) {
  addText();
}); 

$("#delete").on("click", function(e) {
  removeObj();
});

$("#bringFront").on("click", function(e) {
  bringFront();
});

/*$("#save").on("click", function(e) {
   saveImage();
}); */

//functions to save
function download(url, name) {
  // make the link. set the href and download. emulate dom click
  $('<a>').attr({
    href: url,
    download: name
  })[0].click();
}

function downloadFabric(canvas, name) {
  //  convert the canvas to a data url and download it.
  var bgImage = canvas.backgroundImage;
  canvas.backgroundImage = null;
  canvas.renderAll();
  download(canvas.toDataURL({
    multiplier: 2
  }), name + '.png');
  canvas.setBackgroundImage(bgImage, canvas.renderAll.bind(canvas))
}

//function to bring to front
function bringFront() { 
  let activeObject = this.canvas.getActiveObject();
  activeObject.bringToFront();
  canvas.renderAll();
}

//function to add text
var text;
function addText() { 
text = new fabric.IText('Click here to edit text', { 
  fontFamily: 'Calibri',
  left: 100, 
  top: 100,
  fontSize: 25,
  fill: '#FFFFFF', 
  name:"text"+(textMap.size+1),   
});
  canvas.add(text);  
  canvas.renderAll();
  textMap.set(text.name,text);
  console.log("textMap", textMap);
}

//function to set font style
$('#FontStyle').change(function() {
    
    var mFont = $(this).val();
    var tObj = canvas.getActiveObject();
    tObj.set({
      fontFamily: mFont
    });
    canvas.renderAll();
  }); 

//function to remove selected object/s using DEL key
$('html').keyup(function(e){
        if(e.keyCode == 46) {
          removeObj();
        }
}); 

//function to remove selected object/s using Delete button
function removeObj(){ 
    var selection = canvas.getActiveObject();
    if (selection.type === 'activeSelection') {
        selection.forEachObject(function(element) {
            console.log(element);
            canvas.remove(element);
        });
    }
    else{
        canvas.remove(selection);
    }
    canvas.discardActiveObject();
    canvas.requestRenderAll();
}

//function to select shape
function selShape() {
  if ($("#shapes option:selected").val() === "circle") {
    addCircle();
  }
  if ($("#shapes option:selected").val() === "square") {
    addSquare();
  }
  if ($("#shapes option:selected").val() === "rect")  {
    addRect();
  }
  if ($("#shapes option:selected").val() === "trapez") {
    addTrapez();
  }
  if ($("#shapes option:selected").val() === "tri")  {
    addTri();
  }
  if ($("#shapes option:selected").val() === "ellipse")  {
    addEllipse();
  }
  if ($("#shapes option:selected").val() === "hexa")  {
    addHexa();
  }
  if ($("#shapes option:selected").val() === "star")  {
    addStar();
  }
  if ($("#shapes option:selected").val() === "parallelo")  {
    addParallelo();
  }
  if ($("#shapes option:selected").val() === "diam")  {
    addDiam();
  }
  if ($("#shapes option:selected").val() === "penta")  {
    addPenta();
  }
  if ($("#shapes option:selected").val() === "hepta")  {
    addHepta();
  }
  if ($("#shapes option:selected").val() === "octa")  {
    addOcta();
  }
  if ($("#shapes option:selected").val() === "nona")  {
    addNona();
  }
  if ($("#shapes option:selected").val() === "deca")  {
    addDeca();
  }
  if ($("#shapes option:selected").val() === "bevel")  {
    addBevel();
  }
  if ($("#shapes option:selected").val() === "rabbet")  {
    addRabbet();
  }
  if ($("#shapes option:selected").val() === "rtpoint")  {
    addRtPoint();
  }
  if ($("#shapes option:selected").val() === "rtchev")  {
    addRtChev();
  }
  if ($("#shapes option:selected").val() === "msg")  {
    addMsg();
  }
  
}
$("#shapes").change(selShape)

//functions to add shapes
//Circle
function addCircle(){ 
  var Circle = new fabric.Circle({
	            radius: 300,
              scaleX: 0.35, 
              scaleY: 0.35,
	            fill: '#DDD',
              left: 450,
              top: 175,
              name:"shape"+(shapesMap.size+1),  
});  
  canvas.add(Circle);
  canvas.sendToBack(Circle);
  canvas.renderAll();
  shapesMap.set(Circle.name,Circle);
  console.log("shapesMap", shapesMap);
} 

//Triangle
function addTri(){ 
  var Tri = new fabric.Triangle({
              width: 200, 
              height: 200, 
              scaleX: 1, 
              scaleY: 1,
              left: 450,
              top: 175,
              fill: '#DDD',
              name:"shape"+(shapesMap.size+1),    
  });
  
  canvas.add(Tri);
  canvas.sendToBack(Tri);
  canvas.renderAll();
  shapesMap.set(Tri.name,Tri);
  console.log("shapesMap", shapesMap);
}

//Square
function addSquare(){ 
  var Square = new fabric.Rect({
              width: 100, 
              height: 100, 
              scaleX: 2, 
              scaleY: 2,
              left: 450,
              top: 175,
              fill: '#DDD',
              name:"shape"+(shapesMap.size+1), 
  });
  
  canvas.add(Square);
  canvas.sendToBack(Square);
  canvas.renderAll();
  shapesMap.set(Square.name,Square);
  console.log("shapesMap", shapesMap);
} 

//Rectangle
function addRect(){ 
  var Rect = new fabric.Rect({
            width: 200, 
            height: 100, 
            scaleX: 1.5, 
            scaleY: 1.5,
            left: 450,
            top: 175, 
            fill: '#DDD',
            name:"shape"+(shapesMap.size+1), 
  });
  
  canvas.add(Rect);
  canvas.sendToBack(Rect);
  canvas.renderAll();
  shapesMap.set(Rect.name,Rect);
  console.log("shapesMap", shapesMap);
} 

//Diamonds
function addDiam(){ 
  var Diam;
  Diam = new fabric.Polygon([
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
  
  canvas.add(Diam);
  canvas.sendToBack(Diam);
  canvas.renderAll();
  shapesMap.set(Diam.name,Diam);
  console.log("shapesMap", shapesMap);
}

//Parallelogram
function addParallelo(){ 
  var Parallelo;
  Parallelo = new fabric.Polygon([
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
  
  canvas.add(Parallelo);
  canvas.sendToBack(Parallelo);
  canvas.renderAll();
  shapesMap.set(Parallelo.name,Parallelo);
  console.log("shapesMap", shapesMap);
} 

//Ellipse
function addEllipse(){ 
  var ellipse = new fabric.Ellipse({ 
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
  
  canvas.add(ellipse);
  canvas.sendToBack(ellipse);
  canvas.renderAll();
  shapesMap.set(ellipse.name,ellipse);
  console.log("shapesMap", shapesMap);
}

function addTrapez(){ 
  var clipPoly;
  clipPoly = new fabric.Polygon([
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
  
  canvas.add(clipPoly);
  canvas.sendToBack(clipPoly);
  canvas.renderAll();
  shapesMap.set(clipPoly.name,clipPoly);
  console.log("shapesMap", shapesMap);
} 

//Star
function addStar(){ 
  var Star;
  Star = new fabric.Polygon([
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
  
  canvas.add(Star);
  canvas.sendToBack(Star);
  canvas.renderAll();
  shapesMap.set(Star.name,Star);
  console.log("shapesMap", shapesMap);
}

//Pentagon
function addPenta(){ 
  var Penta;
  Penta = new fabric.Polygon([
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
  
  canvas.add(Penta);
  canvas.sendToBack(Penta);
  canvas.renderAll();
  shapesMap.set(Penta.name,Penta);
  console.log("shapesMap", shapesMap);
}

//Hexagon
function addHexa(){ 
  var Hexa;
  Hexa = new fabric.Polygon([
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
  
  canvas.add(Hexa);
  canvas.sendToBack(Hexa);
  canvas.renderAll();
  shapesMap.set(Hexa.name,Hexa);
  console.log("shapesMap", shapesMap);
}

//Heptagon
function addHepta(){ 
  var Hepta;
  Hepta = new fabric.Polygon([
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
  
  canvas.add(Hepta);
  canvas.sendToBack(Hepta);
  canvas.renderAll();
  shapesMap.set(Hepta.name,Hepta);
  console.log("shapesMap", shapesMap);
}

//Octagon
function addOcta(){ 
  var Octa;
  Octa = new fabric.Polygon([
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
  
  canvas.add(Octa);
  canvas.sendToBack(Octa);
  canvas.renderAll();
  shapesMap.set(Octa.name,Octa);
  console.log("shapesMap", shapesMap);
}

//Nonagon
function addNona(){ 
  var Nona;
  Nona = new fabric.Polygon([
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
  
  canvas.add(Nona);
  canvas.sendToBack(Nona);
  canvas.renderAll();
  shapesMap.set(Nona.name,Nona);
  console.log("shapesMap", shapesMap);
}

//Decagon
function addDeca(){ 
  var Deca;
  Deca = new fabric.Polygon([
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
  
  canvas.add(Deca);
  canvas.sendToBack(Deca);
  canvas.renderAll();
  shapesMap.set(Deca.name,Deca);
  console.log("shapesMap", shapesMap);
}

//Bevel
function addBevel(){ 
  var Bevel;
  Bevel = new fabric.Polygon([
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
  
  canvas.add(Bevel);
  canvas.sendToBack(Bevel);
  canvas.renderAll();
  shapesMap.set(Bevel.name,Bevel);
  console.log("shapesMap", shapesMap);
}

//Rabbet
function addRabbet(){ 
  var Rabbet;
  Rabbet = new fabric.Polygon([
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
  
  canvas.add(Rabbet);
  canvas.sendToBack(Rabbet);
  canvas.renderAll();
  shapesMap.set(Rabbet.name,Rabbet);
  console.log("shapesMap", shapesMap);
}

//Point
function addRtPoint(){ 
  var RtPoint;
  RtPoint = new fabric.Polygon([
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
  
  canvas.add(RtPoint);
  canvas.sendToBack(RtPoint);
  canvas.renderAll();
  shapesMap.set(RtPoint.name,RtPoint);
  console.log("shapesMap", shapesMap);
}

//Chevron
function addRtChev(){ 
  var RtChev;
  RtChev = new fabric.Polygon([
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
  
  canvas.add(RtChev);
  canvas.sendToBack(RtCHev);
  canvas.renderAll();
  shapesMap.set(RtChev.name,RtChev);
  console.log("shapesMap", shapesMap);
}

//Message
function addMsg(){ 
  var Msg;
  Msg = new fabric.Polygon([
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
  
  canvas.add(Msg);
  canvas.sendToBack(Msg);
  canvas.renderAll();
  shapesMap.set(Msg.name,Msg);
  console.log("shapesMap", shapesMap);
}

//function to add image
var pug;
function addPug(){
  var pugImg = new Image();
  pugImg.onload = function (img) {    
    pug = new fabric.Image(pugImg, {
          angle: 45,         
          scaleX: 0.3,
          scaleY: 0.3,
          left: 230,
          top: 90,        
          borderColor: '#d6d6d6',
          cornerColor: '#d6d6d6',
          cornerSize: 10,
          transparentCorners: false,     
          name:"img"+(imagesMap.size+1),      
      })
      canvas.add(pug);
      canvas.renderAll();
      imagesMap.set(pug.name,pug);
      console.log("images map: ", imagesMap);
  };
  pugImg.src = img02URL;
}

//function to add image from local
/*document.getElementById('file').addEventListener("change", function(e) {
   var file = e.target.files[0];
   var reader = new FileReader();
   reader.onload = function(f) {
      var data = f.target.result;
      fabric.Image.fromURL(data, function(img) {
         var oImg = img.set({
            left: 0,
            top: 0,
            angle: 0,
            name:"img"+(imagesMap.size+1), 
         }).scale(0.3);
         canvas.add(oImg).renderAll();
         imagesMap.set(oImg.name,oImg);
         console.log("images map: ", imagesMap);
         //var a = canvas.setActiveObject(oImg);
         var dataURL = canvas.toDataURL({
            format: 'png',
            quality: 1
         });
      });
   };
   reader.readAsDataURL(file);
}); */

//function to save image
function saveImage(e) {
  var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  
  var link = window.document.createElement('a');
  link.href = image;
  link.download = "profile.jpg";
  var click = document.createEvent("MouseEvents");
  click.initEvent("click", true, false);
  link.dispatchEvent(click);  
}

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
  // if(theImg.globalCompositeOperation === 'source-atop') theImg.set({globalCompositeOperation:'source-over'});
  for(const [key,val] of shapesMap.entries()){
      if(theImg.intersectsWithObject(val)){
          //if the image is in front of  a shape, set the image atop

         theImg.set({globalCompositeOperation:'source-atop'});
         // console.log("img pos: ",theImg.globalCompositeOperation);
         // console.log("shape pos: ",val.globalCompositeOperation);
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
        // console.log("not anymore");
        // if(theImgUnderShape) theImgUnderShape.set({globalCompositeOperation:'source-over'});
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
         // theTxt.set({globalCompositeOperation:'source-atop'});
         // console.log("img pos: ",theImg.globalCompositeOperation);
         // console.log("shape pos: ",val.globalCompositeOperation);
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
        //set the image as active object
         canvas.setActiveObject(val);
         
         canvas.bringToFront(val);
         theTextUnderImg = val;
         return true;
      }else{
        // console.log("not anymore");
        // if(theImgUnderShape) theImgUnderShape.set({globalCompositeOperation:'source-over'});
      }
  }  
  return false;
}

//function to check if object is on scaling
function onScaling(options){
  console.log("selected is scaling",options.target.name);
}

//function to check if the image is not in front of any shape
var isIntersecting = false;
var objSelected;
function onMoving(options){
   
    // console.log("selected is moving",options.target.name);
    // console.log("obj: ",obj);
    // console.log("options.target: ", options.target);
    options.target.setCoords();

    //if the current selected is an image
    if(imagesMap.has(options.target.name)){
        let temp = checkIntersectionWithShape(options.target);
        //if the image is not in front of any shape
        if(!temp) options.target.set({globalCompositeOperation:'source-over'});
        console.log("image over shape? :",temp);

    }else if(shapesMap.has(options.target.name)){
        let temp = checkIntersectionWithImg(options.target);
        if(!temp){
          console.log("shape not in front of image");
          if(theImgUnderShape){
            theImgUnderShape.set({globalCompositeOperation:'source-over'});
          }
        }
        console.log("shape over image?:",temp);

    }
   else if(textMap.has(options.target.name)){
        let temp = checkIntersectionWithText(options.target);
        //if the image is not in front of any shape
        if(!temp) //canvas.bringToFront(options.target);
        console.log("text over image?:",temp);
    }   
    else if(imagesMap.has(options.target.name)){
        let temp = checkIntersectionWithBackText(options.target);
        if(!temp){
          console.log(options.target);
          console.log("text not in front of image");
          if(theTextUnderImg){
            canvas.bringToFront(theTextUnderImg);
          }
        }
        console.log("text over image?:",temp);

    } 
}

//function to check if object is on rotating
function onRotating(options){
  console.log("selected is rotating",options.target.name);
}
canvas.on('selection:cleared', function() {
console.log("nothing selected");
  // canvas.requestRenderAll();
});

//function to check if object is on selected
function onSelected(options){
  if(options.target){
     console.log("selected", options.target.name);
     objSelected = options.target;
  }
}

//function to change background color of selected text
$('#bg-color').change((e) => {
  let obj = canvas.getActiveObject();
  let $this = $(e.currentTarget);
  obj.setSelectionStyles({textBackgroundColor:$this.val()});
  canvas.renderAll();
});

//function to change text color of selected text
$('#text-color').change((e) => {
  let obj = canvas.getActiveObject();
  let $this = $(e.currentTarget);
  obj.setSelectionStyles({fill:$this.val()});
  //obj.textBackgroundColor =$this.val();
  canvas.renderAll();
});


        </script>
    </body>
</html>