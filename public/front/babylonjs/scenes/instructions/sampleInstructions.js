

let canvas;
let engine;
let theAstroFace;
let theAstroBackButton;
let astronaut_screenBag;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let insCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let cameraCurrtState = {position:null,a:null,b:null,r:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;


let createContactScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
  
    create_skybox();
    insCamera = create_camera();
    create_light();
    // create_contacts_gui();
    

    hl = new BABYLON.HighlightLayer("hl1", scene);
    starColor = new BABYLON.HighlightLayer("starColor", scene);


    return scene;
}

//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    // let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-198.34,80.42,162.37),scene);
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0,new BABYLON.Vector3(-198.34,80.42,162.37),scene);
    // console.log(camera);
    //zoom in/out speed; speed - lower numer, faster zoom in/out
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.attachControl(canvas,true);
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 3;                    //zoom in limit
    camera.upperRadiusLimit = 2000;                 //zoom out limit
    camera.wheelPrecision = 10;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 100;               //movement of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 500;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 1;
    
    //save the initial state of the camera
    cameraInitState.position = new BABYLON.Vector3(-198.34,80.42,162.37);
    cameraInitState.a = camera.alpha;
    cameraInitState.b = camera.beta;
    cameraInitState.r = camera.radius;
    cameraInitState.upperA = camera.upperAlphaLimit;
    cameraInitState.lowerA = camera.lowerAlphaLimit;
    cameraInitState.upperB = camera.upperBetaLimit;
    cameraInitState.lowerB = camera.lowerBetaLimit;
    cameraInitState.upperR = camera.upperRadiusLimit;
    cameraInitState.lowerR = camera.lowerRadiusLimit;
    cameraInitState.angularY = camera.angularSensibilityY;

    return camera;
}//end of create camera function

//############################################# CREATE THE SCENE'S LIGHTS #############################################//
//function to add light to the scene
function create_light(){
    let light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(-30,200,10), scene);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.radius = 500;
    light.specular = new BABYLON.Color3(0,0,0);
    light.groundColor = new BABYLON.Color3(0.3,0.3,0.3);
    
}//end of create light function


//############################################# CREATE THE SCENE'S SKYBOX #############################################//
//function to create the scene's skybox
function create_skybox(){ 
    let skybox = BABYLON.MeshBuilder.CreateBox("contactSkybox", {size:8500.0}, scene);
    // skybox.position.y = 100;
    // skybox.position.z = 1000;
    // skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    
    //create and set skybox material
    let skyboxMaterial = new BABYLON.StandardMaterial("contactSkyboxMaterial", scene);
    skyboxMaterial.backFaceCulling = false;

    let files = [   
      "front/skybox/px.png",  
      "front/skybox/py.png",  
      "front/skybox/pz.png",  
      "front/skybox/nx.png",  
      "front/skybox/ny.png",   
      "front/skybox/nz.png",
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, scene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function


//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let astronaut,navigator_obj;
let astronautParts = {savePnl:null, launchPnl:null};
function load_3D_mesh(){
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
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, objPath, model, scene,
              function (evt) {
                  // onProgress
                  
                  if (evt.lengthComputable) {
                      loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                  } else {
                      var dlCount = evt.loaded / (1024 * 1024);
                      loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                  }
                  
                  document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
            }).then(function (result) {
                
                for(let i=0;i<result.meshes.length;i++){
                  
                  result.meshes[i].isPickable = true;
                  
                  if(result.meshes[i].name === "face"){
                      theAstroFace = result.meshes[i];
                  }else if(result.meshes[i].name === "helmetFace"){
                      // console.log("THE HELMET: ", result.meshes[i]);
                      result.meshes[i].visibility = 0.5;
                  }else if(result.meshes[i].name === "helmet") result.meshes[i].material.backFaceCulling = false;
                  // else if(result.meshes[i].name === "Navigator") navigator_obj = result.meshes[i];
                  else if(result.meshes[i].name === "body") astronaut = result.meshes[i];
                  else if(result.meshes[i].name === "screenBag"){
                    result.meshes[i].scaling = new BABYLON.Vector3(0.63, 2.8, 0.95);
                    astronaut_screenBag = result.meshes[i];
                  }
                  else if(result.meshes[i].name === "arrowUp"){
                    result.meshes[i].position = new BABYLON.Vector3(-20.67, 72.75, 34.60);
                    // console.log(result.meshes[i].position);
                    result.meshes[i].material.diffuseColor = new BABYLON.Color3(0.273, 0.51, 0.09);
                  }
                  else if(result.meshes[i].name === "arrowDown"){
                    result.meshes[i].position = new BABYLON.Vector3(-20.93, 61.23, 34.80);
                    result.meshes[i].material.diffuseColor = new BABYLON.Color3(0.273, 0.51, 0.09);
                  }
                  else{
                    add_action_mgr_astrobody(result.meshes[i]);
                  } 
                  // else if(result.meshes[i].name === "chest_yellowBtn") add_action_mgr_astrobody(result.meshes[i]);
                  // else if(result.meshes[i].name === "chest_blueBtn") add_action_mgr_astrobody(result.meshes[i]);
                  
                  if(i===result.meshes.length-1) loadedPercent = 100;
                }
                astronaut.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(130),0);
                if(user_gender === 'female') astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
            }),
            
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/", "speechCloud.glb", scene).then(
              function (result) {
                console.log("result: ", result.meshes[0]);
            }),
      ]).then(() => {
        add_mouse_listener();
        setTimeout(function(){
            if(loadedPercent >= 100){
              document.getElementById("loadingScreenDiv").style.display = "none";
              document.getElementById("loadingScreenPercent").style.display = "none";
            }
        },1000);
        // create_closeBtn();
        // scene.debugLayer.show();
        // console.log(insCamera.target);
    });
}//end of load design meshes



let homeGizmo,homeGizmo2;
function enable_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(scene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;
}



//######################################## CREATE THE ASTRONAUT'S FACE ########################################//
function create_face_texture(thePath){
  
    let faceMatl = new BABYLON.StandardMaterial("facePhoto", scene);
    faceMatl.diffuseColor = new BABYLON.Color3(0,0,0);
    faceMatl.emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
    faceMatl.diffuseTexture = new BABYLON.Texture(thePath, scene);
    faceMatl.diffuseTexture.hasAlpha = true;
    faceMatl.backFaceCulling = false;//Always show the front and the back of an element
    theAstroFace.material = faceMatl;
    theAstroFace.material.canRescale = true;
    theAstroFace.material.diffuseTexture.level = 2;
    theAstroFace.material.diffuseTexture.uScale = 1;
    theAstroFace.material.diffuseTexture.vScale =  1;
}

//##########################################  CREATE INSTRUCTIONS BUTTON CONTENT ################################//

function create_instruction_texture(){
  
  let backMatl = new BABYLON.StandardMaterial("btn1-instruction-matl", scene);
  backMatl.diffuseColor = new BABYLON.Color3(0,0,0);
  backMatl.emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
  backMatl.diffuseTexture = new BABYLON.Texture("front/images3D/instructionsScene/"+imgpathArr[imgTextureCtr], scene);
  backMatl.diffuseTexture.hasAlpha = true;
  backMatl.backFaceCulling = false;//Allways show the front and the back of an element'

  astronaut_screenBag.material = backMatl;
  astronaut_screenBag.material.canRescale = true;
  astronaut_screenBag.material.diffuseTexture.uOffset = 0;
  astronaut_screenBag.material.diffuseTexture.vOffset = 0.060;
  astronaut_screenBag.material.diffuseTexture.level = 2;
  astronaut_screenBag.material.diffuseTexture.uScale = 9.725;
  astronaut_screenBag.material.diffuseTexture.vScale =  19.990;
  astronaut_screenBag.material.diffuseTexture.vAng =  BABYLON.Tools.ToRadians(3.90);

}

function focus_screen_bag(){
  
  insCamera.position = new BABYLON.Vector3(45.71,67.73,-38.67);
  insCamera.alpha = 5.586667150115886;
  insCamera.beta = 1.5377454719064156;
  insCamera.radius = 24.139843318668298;
  insCamera.setTarget(astronaut_screenBag);
  insCamera.detachControl(canvas,true);
}


function closeBtn(){
  // console.log(insCamera.position, insCamera.radius, insCamera.alpha, insCamera.beta);
  
  insCamera.setTarget(new BABYLON.Vector3(0,0,0));
  insCamera.attachControl(canvas,true);
  insCamera.position = cameraCurrtState.position;
  insCamera.alpha = cameraCurrtState.a;
  insCamera.beta =cameraCurrtState.b;
  insCamera.radius = cameraCurrtState.r;
  document.getElementById("closeButton").style.display = "none";
  
}


//set the current state of camera before zooming in
function set_curr_camera_state(){
  // console.log(insCamera.position, insCamera.radius, insCamera.alpha, insCamera.beta);
  cameraCurrtState.position = insCamera.position;
  cameraCurrtState.a = insCamera.alpha;
  cameraCurrtState.b = insCamera.beta;
  cameraCurrtState.r = insCamera.radius;
  // console.log('current camera',cameraCurrtState);
}



//############################################# HANDLE USER'S INTERACTION #############################################//
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

let isPlane2Selected = false;
let isLaunchEnabled = false;
let imgpathArr;
let imgTextureCtr=0;
function add_mouse_listener(){
  var onMouseDown = function (evt) {
          if(scene){
            var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
            if(pickinfo.hit){
                // console.log(insCamera.position, insCamera.radius, insCamera.alpha, insCamera.beta);
                let theMesh = pickinfo.pickedMesh.name;     //this is the object clicked from the scene; theMesh is now the key for the map
              if(astronaut_map.has(theMesh)){
                window.location.href = astronaut_map.get(theMesh)[1];
              }
              else if(instructionBtn_map.has(theMesh))
              {
                imgTextureCtr=0;
                // console.log(instructionBtn_map.get(theMesh));
                imgpathArr = instructionBtn_map.get(theMesh);
                
                create_instruction_texture();
                set_curr_camera_state();
                focus_screen_bag();
                document.getElementById("closeButton").style.display = "block";

              }else if(theMesh === 'arrowUp'){
                  update_instruction_texture("up");
              }else if(theMesh === 'arrowDown'){
                  update_instruction_texture("down");
              }
              
              // camera.focusOn([pickinfo.theMesh], true);
              
              // console.log(astronaut_map.get(theMesh));
              
              // }
                // if(theMesh === "chest_yellowBtn") window.location.href = "/participateMbaye";
                // else if(theMesh === "chest_blueBtn") window.location.href = "/dashboard";
             

            }
           
          }
          
  }


  var onMouseUp = function (evt) {
    
    // console.log('done');
  }

  var onMouseMove = function (evt) {
    
    // console.log('done');
  }
  
  canvas.addEventListener("pointerdown", onMouseDown, false);
  canvas.addEventListener("pointerup", onMouseUp, false);
  canvas.addEventListener("pointermove", onMouseMove, false);


  //remove the text span on dispose
  scene.onDispose = function() {
      //related to the drag and drop
      canvas.removeEventListener("pointerdown", onMouseDown);
      // canvas.removeEventListener("pointerup", onPointerUpVisit);
      // canvas.removeEventListener("pointermove", onPointerMoveVisit);

  };
}
$("#closeButton").on('click',function(){
  closeBtn();
});

function update_instruction_texture(mode){
  if(imgpathArr){       //if imgpathArr has value
      if(mode === 'up'){
        imgTextureCtr++;
        if(imgTextureCtr >= imgpathArr.length){
          imgTextureCtr = 0;
        }
        create_instruction_texture();

      }else{    //else if mode is down
        imgTextureCtr--;
        if(imgTextureCtr < 0){
          imgTextureCtr = imgpathArr.length - 1;
        }
        create_instruction_texture();
      }
      // console.log("ctr: ",imgTextureCtr);
  }
  
}


function add_action_mgr_astrobody(thePart){
  // console.log("yellow button is loaded", thePart);
  
  thePart.actionManager = new BABYLON.ActionManager(scene);
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

let partTooltip;
var onOverAstronaut =(meshEvent)=>{
    partTooltip = document.createElement("span");
    partTooltip.setAttribute("id", "partTooltip");
    
    var sty = partTooltip.style;
    sty.position = "absolute";
    sty.padding = "0.2%";
    sty.color = "white";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "1.5em";
    sty.backgroundColor = "#0b91c3a3";
    sty.opacity = "0.7";
    sty.top = scene.pointerY + "px";
    sty.left = (scene.pointerX) + "px";
    sty.cursor = "pointer";

    // if(meshEvent.meshUnderPointer.name){
    //     document.body.appendChild(partTooltip);
    //     hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
    //     partTooltip.textContent = "Participate Page";
    // }
   if(astronaut_map.has(meshEvent.meshUnderPointer.name))
   {
    document.body.appendChild(partTooltip);
    hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
    partTooltip.textContent = astronaut_map.get(meshEvent.meshUnderPointer.name)[0];
   }

};



var onOutAstronaut =(meshEvent)=>{
  while (document.getElementById("partTooltip")) {
    hl.removeMesh(meshEvent.source);
    document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
  }   

};



// function add_mouse_listener(){
//   var onPointerDownVisit = function (evt) {
//       if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
//       else return;
//       if(pickinfo.hit){
//           let theMesh = pickinfo.pickedMesh;
//           console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);

//     }//eof if
    
//   }//end of on pointer down function

//   var onPointerUpVisit = function () {
     
//   }//end of on pointer up function

//   var onPointerMoveVisit = function (evt) {
   
//   }//end of on pointer move function

//   canvas.addEventListener("pointerdown", onPointerDownVisit, false);
//   canvas.addEventListener("pointerup", onPointerUpVisit, false);
//   canvas.addEventListener("pointermove", onPointerMoveVisit, false);


//   //remove the text span on dispose
//   scene.onDispose = function() {
//       //related to the drag and drop
//       canvas.removeEventListener("pointerdown", onPointerDownVisit);
//       canvas.removeEventListener("pointerup", onPointerUpVisit);
//       canvas.removeEventListener("pointermove", onPointerMoveVisit);

//   };

// }//end of listen to mouse function

/*################################################### END OF MOUSE EVENT FUNCTION ############################################## */



let isImgPathSet = false;
let img_path;
let user_gender;
let isSceneLoaded = false;
$(window).on('load',function(){
    isImgPathSet = true;
    img_path = document.getElementById('userPhoto').src;
    isSceneLoaded = true;
})
  //function that will render the scene on loop
  var scene = createContactScene();
  
  // scene.executeWhenReady(function () { 

    
      engine.runRenderLoop(function(){
        if(isSceneLoaded){
            scene.render();
            // console.log("running scene");
        //    console.log(insCamera.position, insCamera.alpha, insCamera.beta);
        }
        
        if(isImgPathSet && theAstroFace){
            isImgPathSet = false;
            create_face_texture(img_path);
        }
      });//end of renderloop
  // });

  window.addEventListener("resize", function () {
    engine.resize();
  });







