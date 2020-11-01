
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let insCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;

let createStoryCareScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
  
    sceneSkybox = create_skybox();
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
    camera.maxZ = 28000;
    
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
    let skybox = BABYLON.MeshBuilder.CreateBox("contactSkybox", {size:25000.0}, scene);
    skybox.position = new BABYLON.Vector3(0, 100, 1000);
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
let earth_submeshes = new Map();
function load_3D_mesh(){
  
    var loadedPercent = 0;
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", scene).then(function (result) {
            // earthNormalMesh = result.meshes;
            
            result.meshes[9].scaling = new BABYLON.Vector3(0.25,0.25,0.25);
            result.meshes[9].rotationQuaternion = new BABYLON.Quaternion(0, -0.7648,0,0.6442);
            result.meshes[9].position = new BABYLON.Vector3(0,0,0);
            
            result.meshes.forEach(function(m) {
                m.isPickable = true;
                earth_submeshes.set(m.name,null);
                // add_action_mgr(m);
                if(m.name === "Sea"){
                    water = new BABYLON.WaterMaterial("water", scene, new BABYLON.Vector2(2048, 2048));
                    water.backFaceCulling = true;
                    water.bumpTexture = new BABYLON.Texture("front/textures/participate/waterbump.png", scene);
                    water.windForce = 10;
                    water.windDirection = new BABYLON.Vector2(-1,0);
                    water.waveHeight = 0.2;
                    water.bumpHeight = 0.3;
                    water.waveLength = 0.1;
                    water.colorBlendFactor = 0.25714;
                    water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                    water.addToRenderList(sceneSkybox);
                    m.material = water;
                }
            });

            earth_object = result.meshes[9];      
            
      }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/storyCareScene/", "storyCareBookGLB.glb", scene).then(function (result) {
            result.meshes.forEach(function(part){
                console.log(part);
            });     
        
  }),
      ]).then(() => {
        add_mouse_listener();
       

          
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


$( document ).ready(function() {
    testOrientation();
});




//function that will render the scene on loop
var theScene = createStoryCareScene();
    $("#loadingScreenPercent").css('visibility', 'hidden');
    $("#loadingScreenPercent").html("Loading: 0 %");
    $("#loadingScreenDiv").remove();
    $("#loadingScreenOverlay").html('display', 'block');

   //scene optimizer
   var options = new BABYLON.SceneOptimizerOptions();
   options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
   var optimizer = new BABYLON.SceneOptimizer(theScene, options);
    

    theScene.executeWhenReady(function () {   
    engine.runRenderLoop(function(){
        if(scene){
            scene.render();
        }
        
    });//end of renderloop
});

    window.addEventListener("resize", function () {
        engine.resize();
        testOrientation();
        testFullscreen();
    });



    window.addEventListener("orientationchange", function(event) {
        testOrientation();
    }, false); 






