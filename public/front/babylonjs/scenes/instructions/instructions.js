
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let insCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
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
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-198.34,80.42,162.37),scene);
    //zoom in/out speed; speed - lower numer, faster zoom in/out
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.attachControl(canvas,true);
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 3;                    //zoom in limit
    camera.upperRadiusLimit = 2000;                 //zoom out limit
    camera.wheelPrecision = 1;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 500;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 1500;             //maximum allowable movement via right mouse button
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
    skybox.position.y = 100;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
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
                    else if(result.meshes[i].name === "Navigator") navigator_obj = result.meshes[i];
                    else if(result.meshes[i].name === "body") astronaut = result.meshes[i];
                    else if(result.meshes[i].name === "screenBag"){ 
                        let tempMatl = new BABYLON.StandardMaterial("facePhoto", scene);
                        tempMatl.diffuseColor = new BABYLON.Color3(0,0,0);
                        tempMatl.emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
                        tempMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/field/1Protea.png", scene);
                        tempMatl.diffuseTexture.hasAlpha = true;
                        tempMatl.backFaceCulling = false;//Allways show the front and the back of an element
                        result.meshes[i].material = tempMatl;
                        // theAstroFace.material.canRescale = true;
                        // theAstroFace.material.diffuseTexture.level = 2;
                        // theAstroFace.material.diffuseTexture.uScale = 1;
                        // theAstroFace.material.diffuseTexture.vScale =  1;
                    }
                    
                   
                    if(i===result.meshes.length-1) loadedPercent = 100;
                }
                astronaut.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(130),0);
                if(user_gender === 'female') astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
                
            }),
      
      ]).then(() => {
        add_mouse_listener();
        setTimeout(function(){
            if(loadedPercent >= 100){
              document.getElementById("loadingScreenDiv").style.display = "none";
              document.getElementById("loadingScreenPercent").style.display = "none";
             
            }
        },1000);

          
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
    faceMatl.backFaceCulling = false;//Allways show the front and the back of an element
    theAstroFace.material = faceMatl;
    theAstroFace.material.canRescale = true;
    theAstroFace.material.diffuseTexture.level = 2;
    theAstroFace.material.diffuseTexture.uScale = 1;
    theAstroFace.material.diffuseTexture.vScale =  1;
}




//############################################# HANDLE USER'S INTERACTION #############################################//
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

let isPlane2Selected = false;
let isLaunchEnabled = false;

function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
          console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);

    }//eof if
    
  }//end of on pointer down function

  var onPointerUpVisit = function () {
     
  }//end of on pointer up function

  var onPointerMoveVisit = function (evt) {
   
  }//end of on pointer move function

  canvas.addEventListener("pointerdown", onPointerDownVisit, false);
  canvas.addEventListener("pointerup", onPointerUpVisit, false);
  canvas.addEventListener("pointermove", onPointerMoveVisit, false);


  //remove the text span on dispose
  scene.onDispose = function() {
      //related to the drag and drop
      canvas.removeEventListener("pointerdown", onPointerDownVisit);
      canvas.removeEventListener("pointerup", onPointerUpVisit);
      canvas.removeEventListener("pointermove", onPointerMoveVisit);

  };

}//end of listen to mouse function

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
  
  engine.runRenderLoop(function(){
    if(isSceneLoaded){
        scene.render();
    //    console.log(insCamera.position, insCamera.alpha, insCamera.beta);
    }
    
    if(isImgPathSet && theAstroFace){
        isImgPathSet = false;
        create_face_texture(img_path);
    }
  });//end of renderloop

  window.addEventListener("resize", function () {
    engine.resize();
  });







