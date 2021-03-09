let astronautCamera;                                                               //var for the camera of this scene
let astronautScene;
let ASTRO_CAMERA_INIT_ALPHA = -1.649277713156782;
let ASTRO_CAMERA_INIT_BETA = 1.3138466593021418;
let astronautLight;
var astronaut_obj;
var hl;
let astro_curr_state = {'rot':null, 'pos':null, 'scale':null,'alpha':null, 'beta':null, 'radius':null, 'target':null};

//create the scene
function createAstronautScene(){
    astronautScene = new BABYLON.Scene(engine);
    astronautScene.autoClear = false;
  
    astronautCamera = create_astro_camera();
    //create the lights
    astronautLight = create_astro_light();
    load_astro_meshes();
    listen_to_astronaut_rotation();
    listen_to_astronaut_wheelscroll();

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
        camera.maxZ = 28000; 
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
var astronautRotateMap = new Map();
//function to load the world of flowers
function load_astro_meshes(){

  user_gender = document.getElementById('userGender').value;
  let objPath;
  let model;
  if(user_gender.toLowerCase() === 'female'){
    user_gender = 'female';
    objPath = 'front/objects/astronaut/thomasina/';
    model = 'MajorThomasina3.babylon';
  }
  else{
    user_gender = 'male';
    objPath = 'front/objects/astronaut/tom/'
    model = 'MajorTom2.babylon';
  }
  
  Promise.all([
    BABYLON.SceneLoader.ImportMeshAsync(null, objPath, model, astronautScene,
        function (evt) {

      }).then(function (result) {

          result.meshes.forEach(function(mesh){
            mesh.isPickable = true;
            
            astronautPartsMap.set(mesh.name,mesh)

            add_action_mgr_astrobody(mesh);
            if(mesh.name === "face"){
                theAstroFace = mesh;
            }else if(mesh.name === "helmetFace"){
                mesh.visibility = 0.5;
            }else if(mesh.name === "helmet"){
                mesh.material.backFaceCulling = false;
            }else if(mesh.name === "helmetStars"){
                add_action_mgr(mesh);
            }else if(mesh.name === "Navigator"){
                navigator_obj = mesh;
                add_action_mgr(mesh);
            }else if(astronautChestParts.has(mesh.name)){
                add_action_mgr(mesh);
            }else if(mesh.name === "body"){
                astronautRotateMap.set(mesh.name,mesh);
                astronaut = mesh;
                astronaut_obj = mesh;
                // mesh.scaling = new BABYLON.Vector3(0.02,0.02,0.02);
                if(isMobile() && (isSmallDevice()|| isMediumDevice())) mesh.position = new BABYLON.Vector3(4,0,0);
                else mesh.position = new BABYLON.Vector3(6,0,0);
            }else if(astronautTextsBtnMap.has(mesh.name)){
                let textMatl = new BABYLON.StandardMaterial("textMatl", astronautScene);
                textMatl.diffuseColor = new BABYLON.Color3(1,1,1);
                textMatl.emissiveColor = new BABYLON.Color3(1,1,1);

                if(mesh.name === "showLabels") textMatl.emissiveColor = BABYLON.Color3.Red();
                textMatl.backFaceCulling = false;//Allways show the front and the back of an element
                mesh.material = textMatl;
            }else if(mesh.name === "BackPack" || mesh.name === "bagWires")  {
                astronautRotateMap.set(mesh.name,mesh);
            }
          });
        
          astronaut.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(30),BABYLON.Tools.ToRadians(0));
          if(user_gender === 'female') astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
          // else astronaut.scaling = new BABYLON.Vector3(0.02,0.02,0.02); 
          
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
            if (pickInfo.hit) {
                var theMeshName = pickInfo.pickedMesh.name;
                
               if(astronautPartsMap.has(theMeshName)){
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
            //get the pick info if mouse is pressed
            var pickInfo = astronautScene.pick(astronautScene.pointerX, astronautScene.pointerY);
            
            
            //check if the clicked mesh should be draggable/modified
            if (pickInfo.hit){
                let theMeshName = pickInfo.pickedMesh.name;
                let theMesh = pickInfo.pickedMesh;

                console.log(pickInfo.pickedMesh.position, pickInfo.pickedMesh.rotation);
                
                  if(astronautRotateMap.has(theMeshName)){ 
                          if(initCamera) initCamera.detachControl(canvas);
                          if(astronautCamera) astronautCamera.detachControl(canvas);
                          astronautArr.currentPos.x = evt.clientX;
                          astronautArr.currentPos.y = evt.clientY;
                          astronautArr.currentRot.x = astronaut_obj.rotation.x;
                          astronautArr.currentRot.y = astronaut_obj.rotation.y;
                          isAstronautClicked = true;
                          isAstronautScalingOn = true;
                  }//end of the mesh name



                //if a button is clicked
                if( theMeshName === "btn1" ){
                  //call function from earth scene
                  earth_place_mbaye_on_earth();
                  // var text = astronautPartsMap.get("placeMbaye");
                  // theMesh.material.emissiveColor = BABYLON.Color3.Red();
                  // setTimeout(function(){
                  //     text.material.emissiveColor = BABYLON.Color3.White();
                  // },1000);
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
                  set_constellation_enability(isPlanetLabelActive);
                  // var text = astronautPartsMap.get("showLabels");
                  // if(isPlanetLabelActive) text.material.emissiveColor = BABYLON.Color3.Red();
                  // else text.material.emissiveColor = BABYLON.Color3.White();

                }else if( theMeshName === "btn5" ){
                  //call function from earth scene
                  earth_rotate_earth_with_mbaye();
                  
                }else if( theMeshName === "btn6" ){
                  //call function from earth scene
                  earth_rotate();
                  
                }else if( theMeshName === "btn8" ){
                  // var text = astronautPartsMap.get("designPanels");
                  // text.material.emissiveColor = BABYLON.Color3.Red();
                    setTimeout(function(){
                      window.open('designPanel');  
                    },1000);
                }else if( theMeshName === "btn10" ){
                    earth_initial_view();
                    // var text = astronautPartsMap.get("initialView");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){
                    //     // earth_initial_view();
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                    
                }else if( theMeshName === "btn16" ){ //enable position gizmo
                    earth_handle_gizmo(1);
                    // var text = astronautPartsMap.get("toolPosition");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                    
                }else if( theMeshName === "btn17" ){  //enable rotation gizmo
                    earth_handle_gizmo(2);
                    // var text = astronautPartsMap.get("toolRotation");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                }else if( theMeshName === "btn18" ){
                    earth_handle_gizmo(3);
                    // var text = astronautPartsMap.get("toolScaleUp");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                }else if( theMeshName === "btn19" ){
                    earth_handle_gizmo(4);
                    // var text = astronautPartsMap.get("toolScaleDown");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                }else if( theMeshName === "btn20" ){
                    earth_handle_gizmo(0);
                    // var text = astronautPartsMap.get("toolDisable");
                    // text.material.emissiveColor = BABYLON.Color3.Red();
                    // setTimeout(function(){ 
                    //     text.material.emissiveColor = BABYLON.Color3.White();
                    // },1000);
                }else if(theMeshName === "helmetStars") {
                    let link = wikiMap.get(theMeshName);
                    if(link) showPage(link);
                }else if(astronautChestParts.has(theMeshName)){
                    let val = astronautChestParts.get(theMeshName);
                    checkScreenAndDoubleClick(val);
                }

              
                    
              

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

function add_action_mgr_astrobody(thePart){
  thePart.actionManager = new BABYLON.ActionManager(astronautScene);
  thePart.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction(
              BABYLON.ActionManager.OnPointerOverTrigger,
              onOverAstronaut
      )
  );
  thePart.actionManager.registerAction(
      new BABYLON.ExecuteCodeAction(
          BABYLON.ActionManager.OnPointerOutTrigger,
          onOutAstronaut
      )
  );
}

let origScaling, origColor;
let partTooltip,astroToolsDiv;
var onOverPart =(meshEvent)=>{
    partTooltip = document.createElement("span");
    partTooltip.setAttribute("id", "partTooltip");
    var sty = partTooltip.style;
    sty.position = "absolute";
    // sty.lineHeight = "1.2em";
    sty.padding = "0.2%";
    sty.color = "#00BFFF";
    sty.textShadow = "1px 1px 3px black";
    // sty.color = "white";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "2rem";
    sty.top = astronautScene.pointerY + "px";
    sty.left = (astronautScene.pointerX) + "px";
    sty.cursor = "pointer";
    sty.pointerEvents = "none";

  if(astronautChestParts.has(meshEvent.source.name)){
        let val = astronautChestParts.get(meshEvent.source.name);
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,1,1);
        document.body.appendChild(partTooltip);
        partTooltip.textContent = val[0];
        // partTooltip.setAttribute("onclick", "window.open('"+val[1]+"')");
  }else if(meshEvent.source.name === "helmetStars"){
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,1,1);
        // hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
  }


};

//handles the on mouse out event
var onOutPart =(meshEvent)=>{
    // hl.removeMesh(meshEvent.source);
    meshEvent.source.material.emissiveColor = new BABYLON.Color3(1,1,1);
    while (document.getElementById("partTooltip")) {
      document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }   

    while (document.getElementById("astroToolsDiv")) {
      document.getElementById("astroToolsDiv").parentNode.removeChild(document.getElementById("astroToolsDiv"));
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
                  //if scrolling to make the obj smaller
                  if(delta < 0){
                     set_astronaut_scaling('down');
                  }else{ //if scrolling to make the obj bigger
                    set_astronaut_scaling('up');
                  }
              }
          }
         
      }, BABYLON.PointerEventTypes.POINTERWHEEL, false);
  }
}//end of listen to wheel scroll function

function set_astronaut_scaling(mode){
    let x = astronaut_obj.scaling.x;
    let y = astronaut_obj.scaling.y;
    let z = astronaut_obj.scaling.z;
    if(mode === "down"){
        // if(user_gender === 'female'){
          if(astronaut_obj.scaling.x <= 0.2 && astronaut_obj.scaling.y <= 0.2 && astronaut_obj.scaling.z <= 0.2){
            astronaut_obj.scaling = new BABYLON.Vector3(0.2,0.2,0.2);
          }else{
            astronaut_obj.scaling = new BABYLON.Vector3(x-0.05,y-0.05,z-0.05);
          }
        // }else{  //if astronaut is male
            // if(astronaut_obj.scaling.x <= 0.005 && astronaut_obj.scaling.y <= 0.005 && astronaut_obj.scaling.z <= 0.005){
            //     astronaut_obj.scaling = new BABYLON.Vector3(0.005,0.005,0.005);
            // }else{
            //     astronaut_obj.scaling = new BABYLON.Vector3(x-0.005,y-0.005,z-0.005);
            // }
            // if(astronaut_obj.scaling.x <= 0.2 && astronaut_obj.scaling.y <= 0.2 && astronaut_obj.scaling.z <= 0.2){
        //       astronaut_obj.scaling = new BABYLON.Vector3(0.2,0.2,0.2);
        //     }else{
        //       astronaut_obj.scaling = new BABYLON.Vector3(x-0.05,y-0.05,z-0.05);
        //     }
        // }
    }else{  //if scaling is up
        // if(user_gender === 'female'){
          if(astronaut_obj.scaling.x >= 4 && astronaut_obj.scaling.y >= 4 && astronaut_obj.scaling.z >= 4 ){
            astronaut_obj.scaling = new BABYLON.Vector3(4,4,4);
          }else{
            astronaut_obj.scaling = new BABYLON.Vector3(x+0.05,y+0.05,z+0.05);
          }
        // }else{  //if astronaut is male
              // if(astronaut_obj.scaling.x >= 0.15 && astronaut_obj.scaling.y >= 0.15 && astronaut_obj.scaling.z >= 0.15){
              //   astronaut_obj.scaling = new BABYLON.Vector3(0.15,0.15,0.15);
              // }else{
              //   astronaut_obj.scaling = new BABYLON.Vector3(x+0.005,y+0.005,z+0.005);
              // }
        //       if(astronaut_obj.scaling.x >= 4 && astronaut_obj.scaling.y >= 4 && astronaut_obj.scaling.z >= 4 ){
        //         astronaut_obj.scaling = new BABYLON.Vector3(4,4,4);
        //       }else{
        //         astronaut_obj.scaling = new BABYLON.Vector3(x+0.05,y+0.05,z+0.05);
        //       }
        // }
    }
}//end of function

function show_astro_backpack(val){
    if(astronaut_obj && val){
          if(astro_curr_state.rot === null){    //if first time showing the controls
              reset_astro();
          }else{
              astronaut_obj.rotation =  astro_curr_state.rot;
              astronaut_obj.scaling = astro_curr_state.scale;
              astronautCamera.position = astro_curr_state.pos;
              astronautCamera.alpha = astro_curr_state.alpha;
              astronautCamera.beta = astro_curr_state.beta;
              astronautCamera.radius = astro_curr_state.radius;
              astronautCamera.target = astro_curr_state.target;
          }
          
    }else{
          astro_curr_state.rot = astronaut_obj.rotation;
          astro_curr_state.pos = astronautCamera.position;
          astro_curr_state.scale = astronaut_obj.scaling;
          astro_curr_state.alpha = astronautCamera.alpha;
          astro_curr_state.beta = astronautCamera.beta;
          astro_curr_state.radius = astronautCamera.radius;
          astro_curr_state.target = astronautCamera.target;
    }
}

function reset_astro(){
    if(user_gender === 'male'){
        astronaut_obj.scaling = new BABYLON.Vector3(0.08,0.08,0.08);
        astronaut_obj.rotation =  new BABYLON.Vector3(-0.1454,3.4757,0);
    }else{
        astronaut_obj.scaling = new BABYLON.Vector3(3.5,3.5,3.5);
        astronaut_obj.rotation =  new BABYLON.Vector3(0.2664,3.5101,0);
    }
    astronautCamera.position = new BABYLON.Vector3(1.7257, 5.5630,-9.0408);
    astronautCamera.alpha = -1.64927;
    astronautCamera.beta = 1.3138
    astronautCamera.radius = 10;
    astronautCamera.target = new BABYLON.Vector3(2.0222,2.7470,0.5651);
}

