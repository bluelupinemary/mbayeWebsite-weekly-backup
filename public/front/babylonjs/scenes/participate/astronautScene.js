let astronautCamera;                                                               //var for the camera of this scene
let astronautScene;
let ASTRO_CAMERA_INIT_ALPHA = -1.649277713156782;
let ASTRO_CAMERA_INIT_BETA = 1.3138466593021418;
let astronautLight;
var astronaut_obj;
var hl;
//create the scene
function createAstronautScene(){

    astronautScene = new BABYLON.Scene(engine);
    astronautScene.autoClear = false;
    // autoClearDepthAndStencil = false;
    // astronautScene.clearColor = new BABYLON.Color3(0.5, 0.8, 0.5);
        // astronautScene.createDefaultEnvironment();
    //create the camera

    astronautCamera = create_astro_camera();


    
    //create the lights
 
    astronautLight = create_astro_light();
    load_astro_meshes();
    listen_to_astronaut_rotation();
    listen_to_astronaut_wheelscroll();

    hl = new BABYLON.HighlightLayer("hl1", astronautScene);

    return astronautScene;
}

function create_astro_camera(){
    var camera = new BABYLON.ArcRotateCamera("astronautCamera", 0,0, 10, BABYLON.Vector3(0,0,0), astronautScene);
        // astronautCamera.attachControl(canvas,true)
        camera.checkCollisions = true;
        camera.lowerRadiusLimit = 1;
        camera.upperRadiusLimit = 100;
        camera.wheelPrecision = 30;                              
        camera.panningSensibility = 1000;     
        camera.panningDistanceLimit = 15;                   
        camera.speed = 0.1;  
    return camera;
}


function create_astro_light(){
    var light = new BABYLON.HemisphericLight("astronautLight1", new BABYLON.Vector3(0, 20, -20), astronautScene);
   
    light.radius = 300;
    light.intensity = 0.8;
    light.groundColor = new BABYLON.Color3(0.3,0.3,0.3);

   return light;
}

var astronautTask;
//function to load the world of flowers
function load_astro_meshes(){

  user_gender = document.getElementById('userGender').value;
  let objPath;
  let model;
  if(user_gender === 'female'){
    objPath = 'front/objects/astronaut/thomasina/';
    model = 'MajorThomasina3.babylon';
  }
  else{
    objPath = 'front/objects/astronaut/tom/'
    model = 'MajorTom2.babylon';
  }
  
  Promise.all([
    BABYLON.SceneLoader.ImportMeshAsync(null, objPath, model, astronautScene,
        function (evt) {

      }).then(function (result) {
          for(let i=0;i<result.meshes.length;i++){
              result.meshes[i].isPickable = true;
              astronautPartsMap.set(result.meshes[i].name,result.meshes[i])
              if(result.meshes[i].name === "face"){
                  theAstroFace = result.meshes[i];
              }else if(result.meshes[i].name === "helmetFace"){
                  // console.log("THE HELMET: ", result.meshes[i]);
                  result.meshes[i].visibility = 0.5;
              }else if(result.meshes[i].name === "helmet") result.meshes[i].material.backFaceCulling = false;
              else if(result.meshes[i].name === "Navigator"){
                 navigator_obj = result.meshes[i];
                 add_action_mgr(navigator_obj);
              }else if(result.meshes[i].name === "body"){
                  astronaut = result.meshes[i];
                  astronaut_obj = result.meshes[i];
                  // result.meshes[i].scaling = new BABYLON.Vector3(0.02,0.02,0.02);
                  result.meshes[i].position = new BABYLON.Vector3(6,0,0);
              }else if(astronautTextsBtnMap.has(result.meshes[i].name)){
                  let textMatl = new BABYLON.StandardMaterial("textMatl", astronautScene);
                  textMatl.diffuseColor = new BABYLON.Color3(1,1,1);
                  textMatl.emissiveColor = new BABYLON.Color3(1,1,1);

                  if(result.meshes[i].name === "showLabels") textMatl.emissiveColor = BABYLON.Color3.Red();
                  textMatl.backFaceCulling = false;//Allways show the front and the back of an element
                  result.meshes[i].material = textMatl;
              }
          }
          astronaut.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(30),BABYLON.Tools.ToRadians(0));
          if(user_gender === 'female') astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
          else{
            astronaut.scaling = new BABYLON.Vector3(0.02,0.02,0.02); 
          }
          
      }),
   
  ]).then(() => {
     
        astronautCamera.alpha = ASTRO_CAMERA_INIT_ALPHA;
        astronautCamera.beta = ASTRO_CAMERA_INIT_BETA;
        astronautCamera.viewport = new BABYLON.Viewport(0,0,1,1);
       
  });
} 

let theAstroFace;

function create_face_texture(thePath){
  
    let faceMatl = new BABYLON.StandardMaterial("facePhoto", astronautScene);
    faceMatl.diffuseColor = new BABYLON.Color3(0,0,0);
    faceMatl.emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
    faceMatl.diffuseTexture = new BABYLON.Texture(thePath, astronautScene);
    faceMatl.diffuseTexture.hasAlpha = true;
    faceMatl.backFaceCulling = false;//Allways show the front and the back of an element
    theAstroFace.material = faceMatl;
    theAstroFace.material.canRescale = true;
    theAstroFace.material.diffuseTexture.level = 2;
    theAstroFace.material.diffuseTexture.uScale = 1;
    theAstroFace.material.diffuseTexture.vScale =  1;
}

var onOverAstronaut =(meshEvent)=>{
   
};

var onOutAstronaut =(meshEvent)=>{
 
};

var isAstronautClicked = false;


function remove_astro_scene_objects(){
  astronautPartsMap.clear();
  astronaut_obj.dispose();
  astronautCamera.dispose();
  astronautLight.dispose();
  astronautScene.dispose();
  astronaut_obj = null;
  astronautPartsMap = null;
}


var isAstronautScalingOn = false;
var isAstronautRightClicked = false;
var astroMouseMov = false;
var astroLastAngleDiff = { x: 0, y: 0 };
var astroOldAngle = { x: 0, y: 0 };
var astroNewAngle = { x: 0, y: 0 };
//variable to check whether mouse is moved or not in each frame
//framecount reset and max framecount(secs) for inertia
var astroFramecount = 0;
var astroMxframecount = 120; //4 secs at 60 fps
let isAstronautFirstClick = false;

var astronautArr = {"currentPos":{x:null,y:null,z:null}, 
                    "currentRot":{x:null,y:null,z:null}
};
let isPlanetLabelActive = true;
let astronautPartsMap = new Map();
function listen_to_astronaut_rotation(){
        var onPointerDownRotate = function (evt) {
        if (evt.button == 1) {    //if the middle click is triggered
            if(astronautCamera) astronautCamera.detachControl(canvas);
            return;
        }else if(evt.button == 2){  //if the right click is triggered
            
            var pickInfo = astronautScene.pick(astronautScene.pointerX, astronautScene.pointerY);
            // console.log("Right click triggered ");
            if (pickInfo.hit) {
                var theMeshName = pickInfo.pickedMesh.name;
                console.log("the mesh clicked: ", theMeshName);
               if(astronautPartsMap.has(theMeshName)){
                  // console.log("this is trueeeee");
                  if(astronautCamera) astronautCamera.attachControl(canvas,true);
                  if(initCamera) initCamera.detachControl(canvas);
                  isAstronautRightClicked = true;
                  if(earthScene) earthScene.doNotHandleCursors = true;
               }//end of if the astronaut is hit by right click
               
            }//end of pickInfo.hit
            else{ //if nothing is hit, enable the earth camera's panning
                  if(initCamera) initCamera.attachControl(canvas,true);
                  if(astronautCamera) astronautCamera.detachControl(canvas);
                  isAstronautRightClicked = false;
            }
            
        }else{
            // console.log("left click triggered");
            //get the pick info if mouse is pressed
            var pickInfo = astronautScene.pick(astronautScene.pointerX, astronautScene.pointerY);
            
            //check if the clicked mesh should be draggable/modified
            if (pickInfo.hit){
                let theMeshName = pickInfo.pickedMesh.name;
                // console.log("the mesh clicked: ", theMeshName);
                if(astronautPartsMap.has(theMeshName)){ 
                  if(!isAstronautFirstClick){
                      
                  }
                  if(initCamera) initCamera.detachControl(canvas);
                  if(astronautCamera) astronautCamera.detachControl(canvas);
                    let theAstro =  pickInfo.pickedMesh;
                        //   if(currentPanel && currentPanel === thePanel){
                        astronautArr.currentPos.x = evt.clientX;
                        astronautArr.currentPos.y = evt.clientY;
                        astronautArr.currentRot.x = astronaut_obj.rotation.x;
                        astronautArr.currentRot.y = astronaut_obj.rotation.y;
                        // console.log("Start the rotation of astronaut here ", astronautArr.currentPos, astronautArr.currentRot);
                        isAstronautClicked = true;
                        isAstronautScalingOn = true;
              }//end of the mesh name



              //if a button is clicked
              if( theMeshName === "btn1" ){
                //call function from earth scene
                 earth_place_mbaye_on_earth();
                 var text = astronautPartsMap.get("placeMbaye");
                 text.material.emissiveColor = BABYLON.Color3.Red();
                 setTimeout(function(){
                    text.material.emissiveColor = BABYLON.Color3.White();
                 },1000);
              }else if( theMeshName === "btn2" ){
                //call function from earth scene
                 earth_show_countries();
              }else if( theMeshName === "btn3" ){
                //call function from earth scene
                 earth_show_borders();
              }else if( theMeshName === "btn4" ){
                //call function from earth scene
                
                isPlanetLabelActive = !isPlanetLabelActive;
                set_orbit_enability(isPlanetLabelActive);
                var text = astronautPartsMap.get("showLabels");
                if(isPlanetLabelActive) text.material.emissiveColor = BABYLON.Color3.Red();
                else text.material.emissiveColor = BABYLON.Color3.White();
                 
                
                
              }else if( theMeshName === "btn5" ){
                //call function from earth scene
                earth_rotate_earth_with_mbaye();
                 
              }else if( theMeshName === "btn6" ){
                //call function from earth scene
                earth_rotate();
                 
              }else if( theMeshName === "btn8" ){
                 var text = astronautPartsMap.get("designPanels");
                 text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                    // remove_earth_scene_objects();
                    // currentScene = createDesignScene();
                     window.open('designPanel');  
                  },1000);
              }else if( theMeshName === "btn10" ){
                  earth_initial_view();
                  var text = astronautPartsMap.get("initialView");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                      // earth_initial_view();
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
                  
              // }
              // else if( theMeshName === "btn8" ){
              //    // var text = astronautPartsMap.get("designPanels");
              //    // text.material.emissiveColor = BABYLON.Color3.Red();
              //     setTimeout(function(){
              //       remove_earth_scene_objects();
              //       currentScene = createScene();

              //     },500);
                  
              }else if( theMeshName === "btn16" ){ //enable position gizmo
                  earth_handle_gizmo(1);
                  var text = astronautPartsMap.get("toolPosition");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
                  
              }else if( theMeshName === "btn17" ){  //enable rotation gizmo
                  earth_handle_gizmo(2);
                  var text = astronautPartsMap.get("toolRotation");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn18" ){
                  earth_handle_gizmo(3);
                  var text = astronautPartsMap.get("toolScaleUp");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn19" ){
                  earth_handle_gizmo(4);
                  var text = astronautPartsMap.get("toolScaleDown");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn20" ){
                  earth_handle_gizmo(0);
                  var text = astronautPartsMap.get("toolDisable");
                  text.material.emissiveColor = BABYLON.Color3.Red();
                  setTimeout(function(){ 
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }
              // else if(theMeshName === "helmetText") showWiki("Michael_Collins_(astronaut)");
              // else if(theMeshName === "helmetStars") showWiki("Michael_Schumacher");
                    
              

            }else{   //else if astronaut is not clicked
                isAstronautScalingOn = false;
                if(initCamera) initCamera.attachControl(canvas,true);
                if(astronautCamera) astronautCamera.detachControl(canvas);
            }
      }//end of else
    }//end of on pointer down function

    //on mouse pointer up
    var onPointerUpRotate = function () {
        isAstronautClicked = false;
    }//end of on pointer up function

    var onPointerMoveRotate = function (evt) {  
        //on pointer movement, check if there is a current panel set and if the the onpointerdown is triggered
        if(!isAstronautClicked){
          return;
        }
        if(isAstronautClicked){
            // console.log("this is trueeee");
            astroMouseMov = true;
        }

        astroOldAngle.x = astronaut_obj.rotation.x;
        astroOldAngle.y = astronaut_obj.rotation.y;
        //rotate the mesh
        astronaut_obj.rotation.y += (evt.clientX - astronautArr.currentPos.x) / 300.0;
        astronaut_obj.rotation.x += (evt.clientY - astronautArr.currentPos.y) / 300.0;
        //set the current angle after the rotation
        astroNewAngle.x = astronaut_obj.rotation.x;
        astroNewAngle.y = astronaut_obj.rotation.y;
        //calculate the anglediff
        astroLastAngleDiff.x = astroNewAngle.x - astroOldAngle.x;
        astroLastAngleDiff.y = astroNewAngle.y - astroOldAngle.y;
        astronautArr.currentPos.x = evt.clientX;
        astronautArr.currentPos.y = evt.clientY;

    }//end of on pointer move function

    var onPointerDblClick = function(evt){
        var pickInfo = astronautScene.pick(astronautScene.pointerX, astronautScene.pointerY);
       
        var theMesh = pickInfo.pickedMesh;
        if (pickInfo.hit) {
            if(theMesh == navigator_obj){
              window.open('communicator');
            }
        }
    }//end of dbl click

    canvas.addEventListener("pointerdown", onPointerDownRotate, false);
    canvas.addEventListener("pointerup", onPointerUpRotate, false);
    canvas.addEventListener("pointermove", onPointerMoveRotate, false);
    canvas.addEventListener("dblclick", onPointerDblClick, false);

    astronautScene.onDispose = function() {
        //related to the drag and drop
        canvas.removeEventListener("pointerdown", onPointerDownRotate);
        canvas.removeEventListener("pointerup", onPointerUpRotate);
        canvas.removeEventListener("pointermove", onPointerMoveRotate);
        canvas.removeEventListener("dblclick", onPointerDblClick);
    };

    //related to the panel rotation
    astronautScene.beforeRender = function () {
      //set mousemov as false everytime before the rendering a frame
      astroMouseMov = false;
    }

    astronautScene.afterRender = function () { 
      if(astronaut_obj){
      //we are checking if the mouse is moved after the rendering a frame
      //will return false if the mouse is not moved in the last frame
      //possible drop of 1 frame of animation, which will not be noticed 
      //by the user most of the time
          if (!astroMouseMov && astroFramecount < astroMxframecount) {
          //   //divide the lastAngleDiff to slow or ease the animation
              astroLastAngleDiff.x = astroLastAngleDiff.x / 1.04;
              astroLastAngleDiff.y = astroLastAngleDiff.y / 1.04;
          //apply the rotation
              astronaut_obj.rotation.x += astroLastAngleDiff.x;
              astronaut_obj.rotation.y += astroLastAngleDiff.y
          //increase the framecount by 1
              astroFramecount++;
              astronautArr.currentRot.x = astronaut_obj.rotation.x;
              astronautArr.currentRot.y = astronaut_obj.rotation.y;
          } else if(astroFramecount >= astroMxframecount) {
            astroFramecount = 0;
          }
      }
    };



    // engine.runRenderLoop(function () {
    //    if(astronautCamera && isAstronautRightClicked){
    //        // console.log("check screen", astronautCamera.position);
    //        if(astronautCamera){ 
    //             // if(astronautCamera.position.x <= -2) astronautCamera.detachControl(canvas);
    //        }
    //    }

    // });
}


function add_action_mgr(thePart){
  thePart.actionManager = new BABYLON.ActionManager(astronautScene);
  thePart.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction(
              BABYLON.ActionManager.OnPointerOverTrigger,
              onOverPart
      )
  );
  thePart.actionManager.registerAction(
      new BABYLON.ExecuteCodeAction(
          BABYLON.ActionManager.OnPointerOutTrigger,
          onOutPart
      )
  );
}

let origScaling, origColor;
let partTooltip;
var onOverPart =(meshEvent)=>{
    partTooltip = document.createElement("span");
    partTooltip.setAttribute("id", "partTooltip");
    var sty = partTooltip.style;
    sty.position = "absolute";
    sty.lineHeight = "1.2em";
    sty.padding = "0.2%";
    sty.color = "#efad0c  ";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "1.5em";
    // sty.backgroundColor = "#0b91c3a3";
    // sty.opacity = "0.7";
    sty.top = astronautScene.pointerY + "px";
    sty.left = (astronautScene.pointerX) + "px";
    sty.cursor = "pointer";

  if(meshEvent.source.name === "Navigator"){
        hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
        document.body.appendChild(partTooltip);
        partTooltip.textContent = "Communicator";
        partTooltip.setAttribute("onclick", "window.open('communicator')");
       
  }


};

//handles the on mouse out event
var onOutPart =(meshEvent)=>{
    hl.removeMesh(meshEvent.source);
    while (document.getElementById("partTooltip")) {
      document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }   
};


//function that enables zoom in/out of panel when using the mouse wheelscroll
function listen_to_astronaut_wheelscroll(){
    if(astronautScene){

      astronautScene.onPrePointerObservable.add( function(pointerInfo, eventState) {
          if( isAstronautScalingOn ){
              if(astronautCamera) astronautCamera.detachControl(canvas);
              var event = pointerInfo.event;
              var delta = 0;
              if (event.wheelDelta) {
                  delta = event.wheelDelta;
                //  if(astronautCamera) astronautCamera.attachControl(canvas,true);
              }
              else if (event.detail) {
                  delta = -event.detail;
              }

              if (delta) {
                  let x = astronaut_obj.scaling.x;
                  let y = astronaut_obj.scaling.y;
                  let z = astronaut_obj.scaling.z;
                  if(delta < 0){
                      if(user_gender === 'female'){
                            if(astronaut_obj.scaling.x <= 0.2 && astronaut_obj.scaling.y <= 0.2 && astronaut_obj.scaling.z <= 0.2){
                              astronaut_obj.scaling = new BABYLON.Vector3(0.2,0.2,0.2);
                            }else{
                              astronaut_obj.scaling = new BABYLON.Vector3(x-0.05,y-0.05,z-0.05);
                            }
                      }else{
                            if(astronaut_obj.scaling.x <= 0.005 && astronaut_obj.scaling.y <= 0.005 && astronaut_obj.scaling.z <= 0.005){
                                astronaut_obj.scaling = new BABYLON.Vector3(0.005,0.005,0.005);
                            }else{
                                astronaut_obj.scaling = new BABYLON.Vector3(x-0.005,y-0.005,z-0.005);
                            }
                      }
                  //if scrolling to make the obj bigger
                  }else{
                    if(user_gender === 'female'){
                            if(astronaut_obj.scaling.x >= 4 && astronaut_obj.scaling.y >= 4 && astronaut_obj.scaling.z >= 4 ){
                              astronaut_obj.scaling = new BABYLON.Vector3(4,4,4);
                            }else{
                              astronaut_obj.scaling = new BABYLON.Vector3(x+0.05,y+0.05,z+0.05);
                            }
                    }else{
                            if(astronaut_obj.scaling.x >= 0.15 && astronaut_obj.scaling.y >= 0.15 && astronaut_obj.scaling.z >= 0.15){
                              astronaut_obj.scaling = new BABYLON.Vector3(0.15,0.15,0.15);
                            }else{
                              astronaut_obj.scaling = new BABYLON.Vector3(x+0.005,y+0.005,z+0.005);
                            }
                    }
                    
                    // console.log("scroll up => bigger", delta);
                    
                  }
                  
                  
              }
          }
         
      }, BABYLON.PointerEventTypes.POINTERWHEEL, false);
  }
}//end of listen to wheel scroll function