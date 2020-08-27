let astronautCamera;                                                               //var for the camera of this scene
let astronautScene;
let ASTRO_CAMERA_INIT_ALPHA = -1.649277713156782;
let ASTRO_CAMERA_INIT_BETA = 1.3138466593021418;
let astronautLight;
var astroMichael_obj;
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
    // add_mouse_listener_astroScene();
    // load_earth_with_flowers_mesh();
    // add_mouse_listener_earthflowers();
    // // earthFlowersScene.defaultCursor = "url('cursor/astro-cursor.png') 12 12, auto ";

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
var astroBagTexts = new Map([                                                            //var to keep track of the variety of flowers
    ["placeMbaye",null],["designPanels",null],["rotateEarth",null],["showCountries",null],
    ["showBorders",null],["showLabels",null],["showInstructions",null],["initialView",null],
    ["removeFlower",null],["toolPosition",null],["toolRotation",null],["toolScaleUp",null],
    ["toolScaleDown",null],["rotateEarthWithMbaye",null],["toolDisable",null]
]);
//function to load the world of flowers
function load_astro_meshes(){
  Promise.all([
    BABYLON.SceneLoader.ImportMeshAsync(null, "objects/astronaut/michael/", "michaelGLB022620.glb", astronautScene).then(function (result) {   
               // console.log("ASTRO ", result.meshes);

            result.meshes[0].scaling = new BABYLON.Vector3(0.02,0.02,-0.02);
            result.meshes[0].position = new BABYLON.Vector3(6,0,0);
           //  // // result.meshes[4].scaling = new BABYLON.Vector3(5,5,-5);
           result.meshes[0].rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(10),BABYLON.Tools.ToRadians(22),BABYLON.Tools.ToRadians(2));

            for(var i=0;i<result.meshes.length;i++){
              // result.meshes[i].isVisible = true;
              // console.log("ASTRO PART: ", result.meshes[i].name);
                // result.meshes[i].setParent(result.meshes[1]);
                result.meshes[i].isPickable = true;
                astronautPartsMap.set(result.meshes[i].name,result.meshes[i])
                 if(astroBagTexts.has(result.meshes[i].name)){
                    result.meshes[i].material.emissiveColor = BABYLON.Color3.White();
                    // console.log("trueee");
                }
            }
            // astronautPartsMap.set(result.meshes[1].name,result.meshes[1])
           //  astronautTask = result.meshes;
            // result.meshes[1].isPickable = true;

            astroMichael_obj = result.meshes[0];
          }),
  ]).then(() => {
     
        astronautCamera.alpha = ASTRO_CAMERA_INIT_ALPHA;
        astronautCamera.beta = ASTRO_CAMERA_INIT_BETA;
        // astronautCamera.setTarget(f);
        astronautCamera.viewport = new BABYLON.Viewport(0,0,1,1);
        // astronautCamera.viewport = new BABYLON.Viewport(0.6,0,0.5,1);
        // isEarthSceneActive = false;
        // enable_astro_movement();
       
  });
} 


var onOverAstronaut =(meshEvent)=>{
    // let theVal = astronautPartsMap.get(meshEvent.source.name);
    // if(theVal === 1){
    //   console.log(meshEvent.source);
    //     // astronautScene.hoverCursor = "pointer";
    // }
    // //   meshEvent.source.name) return;
    // else{
    //   // hl = new BABYLON.HighlightLayer("hl", earthFlowersScene, earthFlowersCamera);
    //   // hl.addMesh(meshEvent.source, BABYLON.Color3.Red());
    //   // earthFlowersScene.setRenderingAutoClearDepthStencil(1, true, true, false);
    //   meshEvent.source.material.emissiveColor = new BABYLON.Color4(0.2,0.2,0,0.2);
    //  // meshEvent.source.material.alpha = 0.1;
      
     
    // }
};

var onOutAstronaut =(meshEvent)=>{
 
};

var isAstronautClicked = false;


function remove_astro_scene_objects(){
  astronautPartsMap.clear();
  astroMichael_obj.dispose();
  astronautCamera.dispose();
  astronautLight.dispose();
  astronautScene.dispose();
  astroMichael_obj = null;
  astronautPartsMap = null;
}


// function enable_astro_movement(){
//   var pipePointerDragBehavior = new BABYLON.PointerDragBehavior({dragAxis: new BABYLON.Vector3(1,0,0)});
//   // If handling drag events manually is desired, set move attached to false
//   pipePointerDragBehavior.enabled = true;
//   pipePointerDragBehavior.moveAttached = true;

//   // Use drag plane in world space
//   pipePointerDragBehavior.useObjectOrienationForDragging = false;
//   pipePointerDragBehavior.dragDeltaRatio = 0.5;
//   pipePointerDragBehavior.attach(astroMichael_obj);
//   console.log(pipePointerDragBehavior);
// }

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
function listen_to_astronaut_rotation(){
        var onPointerDownRotate = function (evt) {
        console.log("the button: ", evt.button);
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
                  if(earthCamera) earthCamera.detachControl(canvas);
                  isAstronautRightClicked = true;
                  if(earthScene) earthScene.doNotHandleCursors = true;
               }//end of if the astronaut is hit by right click
               
            }//end of pickInfo.hit
            else{ //if nothing is hit, enable the earth camera's panning
                  if(earthCamera) earthCamera.attachControl(canvas,true);
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
                console.log("the mesh clicked: ", theMeshName);
                if(astronautPartsMap.has(theMeshName)){ 
                  if(!isAstronautFirstClick){
                      
                  }
                  if(earthCamera) earthCamera.detachControl(canvas);
                  if(astronautCamera) astronautCamera.detachControl(canvas);
                    let theAstro =  pickInfo.pickedMesh;
                        //   if(currentPanel && currentPanel === thePanel){
                        astronautArr.currentPos.x = evt.clientX;
                        astronautArr.currentPos.y = evt.clientY;
                        astronautArr.currentRot.x = astroMichael_obj.rotation.x;
                        astronautArr.currentRot.y = astroMichael_obj.rotation.y;
                        // console.log("Start the rotation of astronaut here ", astronautArr.currentPos, astronautArr.currentRot);
                        isAstronautClicked = true;
                        isAstronautScalingOn = true;
              }//end of the mesh name



              //if a button is clicked
              if( theMeshName === "btn1" ){
                //call function from earth scene
                 earth_place_mbaye_on_earth();
                 var text = astronautPartsMap.get("placeMbaye");
                 text.material.emissiveColor = BABYLON.Color3.Green();
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
                  earth_show_labels();
                 var text = astronautPartsMap.get("showLabels");
                 text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                    text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn5" ){
                //call function from earth scene
                earth_rotate_earth_with_mbaye();
                 
              }else if( theMeshName === "btn6" ){
                //call function from earth scene
                earth_rotate();
                 
              }else if( theMeshName === "btn7" ){
                 var text = astronautPartsMap.get("designPanels");
                 text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                    // remove_earth_scene_objects();
                    // currentScene = createDesignScene();
                     window.open('MbayeDesignPage.php',"_self");  
                  },1000);
              }else if( theMeshName === "btn9" ){
                  earth_initial_view();
                  var text = astronautPartsMap.get("initialView");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                      // earth_initial_view();
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
                  
              }else if( theMeshName === "btn8" ){
                 // var text = astronautPartsMap.get("designPanels");
                 // text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                    remove_earth_scene_objects();
                    currentScene = createScene();

                  },500);
                  
              }else if( theMeshName === "btn12" ){ //enable position gizmo
                  earth_handle_gizmo(1);
                  var text = astronautPartsMap.get("toolPosition");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
                  
              }else if( theMeshName === "btn13" ){  //enable rotation gizmo
                  earth_handle_gizmo(2);
                  var text = astronautPartsMap.get("toolRotation");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn14" ){
                  earth_handle_gizmo(3);
                  var text = astronautPartsMap.get("toolScaleUp");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn15" ){
                  earth_handle_gizmo(4);
                  var text = astronautPartsMap.get("toolScaleDown");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if( theMeshName === "btn16" ){
                  earth_handle_gizmo(0);
                  var text = astronautPartsMap.get("toolDisable");
                  text.material.emissiveColor = BABYLON.Color3.Green();
                  setTimeout(function(){ 
                      text.material.emissiveColor = BABYLON.Color3.White();
                  },1000);
              }else if(theMeshName === "helmetText") showWiki("Michael_Collins_(astronaut)");
              else if(theMeshName === "helmetStars") showWiki("Michael_Schumacher");
                    
              

            }else{   //else if astronaut is not clicked
                isAstronautScalingOn = false;
                if(earthCamera) earthCamera.attachControl(canvas,true);
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

        astroOldAngle.x = astroMichael_obj.rotation.x;
        astroOldAngle.y = astroMichael_obj.rotation.y;
        //rotate the mesh
        astroMichael_obj.rotation.y += (evt.clientX - astronautArr.currentPos.x) / 300.0;
        astroMichael_obj.rotation.x += (evt.clientY - astronautArr.currentPos.y) / 300.0;
        //set the current angle after the rotation
        astroNewAngle.x = astroMichael_obj.rotation.x;
        astroNewAngle.y = astroMichael_obj.rotation.y;
        //calculate the anglediff
        astroLastAngleDiff.x = astroNewAngle.x - astroOldAngle.x;
        astroLastAngleDiff.y = astroNewAngle.y - astroOldAngle.y;
        astronautArr.currentPos.x = evt.clientX;
        astronautArr.currentPos.y = evt.clientY;

    }//end of on pointer move function

    canvas.addEventListener("pointerdown", onPointerDownRotate, false);
    canvas.addEventListener("pointerup", onPointerUpRotate, false);
    canvas.addEventListener("pointermove", onPointerMoveRotate, false);

    astronautScene.onDispose = function() {
        //related to the drag and drop
        canvas.removeEventListener("pointerdown", onPointerDownRotate);
        canvas.removeEventListener("pointerup", onPointerUpRotate);
        canvas.removeEventListener("pointermove", onPointerMoveRotate);
    };

    //related to the panel rotation
    astronautScene.beforeRender = function () {
      //set mousemov as false everytime before the rendering a frame
      astroMouseMov = false;
    }

    astronautScene.afterRender = function () { 
      if(astroMichael_obj){
      //we are checking if the mouse is moved after the rendering a frame
      //will return false if the mouse is not moved in the last frame
      //possible drop of 1 frame of animation, which will not be noticed 
      //by the user most of the time
          if (!astroMouseMov && astroFramecount < astroMxframecount) {
          //   //divide the lastAngleDiff to slow or ease the animation
              astroLastAngleDiff.x = astroLastAngleDiff.x / 1.04;
              astroLastAngleDiff.y = astroLastAngleDiff.y / 1.04;
          //apply the rotation
              astroMichael_obj.rotation.x += astroLastAngleDiff.x;
              astroMichael_obj.rotation.y += astroLastAngleDiff.y
          //increase the framecount by 1
              astroFramecount++;
              astronautArr.currentRot.x = astroMichael_obj.rotation.x;
              astronautArr.currentRot.y = astroMichael_obj.rotation.y;
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
             console.log("trueeee",delta);

              if (delta) {
                  let x = astroMichael_obj.scaling.x;
                  let y = astroMichael_obj.scaling.y;
                  let z = astroMichael_obj.scaling.z;
                  console.log("current scaling: ", x,y,z);
                  if(delta < 0){
                    // console.log("scroll down => smaller", delta);
                    if(astroMichael_obj.scaling.x <= 0.005 && astroMichael_obj.scaling.y <= 0.005 && astroMichael_obj.scaling.z >= -0.005){
                      astroMichael_obj.scaling = new BABYLON.Vector3(0.005,0.005,-0.005);
                    }else{
                       astroMichael_obj.scaling = new BABYLON.Vector3(x-0.005,y-0.005,z+0.005);
                    }
                  }else{
                    // console.log("scroll up => bigger", delta);
                    // astroMichael_obj.scaling = new BABYLON.Vector3(x+0.001,y+0.001,z-0.001);
                    if(astroMichael_obj.scaling.x >= 0.15 && astroMichael_obj.scaling.y >= 0.15 && astroMichael_obj.scaling.z <= 0.15){
                      astroMichael_obj.scaling = new BABYLON.Vector3(0.15,0.15,-0.15);
                    }else{
                     astroMichael_obj.scaling = new BABYLON.Vector3(x+0.005,y+0.005,z-0.005);
                    }
                  }
                  
                  
              }
          }
         
      }, BABYLON.PointerEventTypes.POINTERWHEEL, false);
  }
}//end of listen to wheel scroll function