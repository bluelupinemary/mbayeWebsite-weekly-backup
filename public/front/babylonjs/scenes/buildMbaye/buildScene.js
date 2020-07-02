
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let buildCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
let createBuildScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
    // load_orig_flowers();
    create_skybox();
    buildCamera = create_camera();
    create_light();
    // create_contacts_gui();
    

    hl = new BABYLON.HighlightLayer("hl1", scene);
    starColor = new BABYLON.HighlightLayer("starColor", scene);


    return scene;
}

//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-122.65,34.86,101.49),scene);

    //zoom in/out speed; speed - lower numer, faster zoom in/out

    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 8;                    //zoom in limit
    camera.upperRadiusLimit = 200;                 //zoom out limit
    camera.wheelPrecision = 10;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 500;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 1500;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 1;
    camera.radius = 10;
   
    // camera.alpha =  2.9088;
    // camera.beta = 1.5066;
    camera.alpha =  -3.8328;
    camera.beta = 1.3551;
    camera.attachControl(canvas,true);
    scene.activeCamera = camera;
    camera.checkCollisions = true;
    

    // //save the initial state of the camera
    // cameraInitState.position = new BABYLON.Vector3(-198.34,80.42,162.37);
    // cameraInitState.a = camera.alpha;
    // cameraInitState.b = camera.beta;
    // cameraInitState.r = camera.radius;
    // cameraInitState.upperA = camera.upperAlphaLimit;
    // cameraInitState.lowerA = camera.lowerAlphaLimit;
    // cameraInitState.upperB = camera.upperBetaLimit;
    // cameraInitState.lowerB = camera.lowerBetaLimit;
    // cameraInitState.upperR = camera.upperRadiusLimit;
    // cameraInitState.lowerR = camera.lowerRadiusLimit;
    // cameraInitState.angularY = camera.angularSensibilityY;

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
    skybox.infiniteDistance = true;
    skybox.renderingGroupId = 0;
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
let pipes;
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/buildMbayeScene/", "pipesTest062820.babylon", scene,
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
                console.log(result.meshes);
              
                result.meshes.forEach(function(m){
                      console.log("part ", m.name);
                      if(m.parent) console.log(m.parent.name);
                      else console.log("no parent");
                  }
                );
              
                buildCamera.target = result.meshes[0];
                buildCamera.radius = 10;
            }),
      
      ]).then(() => {
        add_mouse_listener();
       
    });
}//end of load design meshes


let homeGizmo;
let homeGizmo2;
let isGizmoDragging = false;
function enable_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(scene);

    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    // homeGizmo3 = new BABYLON.ScaleGizmo(utilLayer);
    
    
    
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;

    // homeGizmo3.attachedMesh = themesh;

  
    homeGizmo.onDragStartObservable.add(function () {
        isGizmoDragging = true;
    });
    homeGizmo.onDragEndObservable.add(function () {
        isGizmoDragging = false;
        homeGizmo2.attachedMesh = null;
        homeGizmo.attachedMesh = null;
        
    });
}




//############################################# HANDLE USER'S INTERACTION #############################################//
let isPlane2Selected = false;
let isLaunchEnabled = false;
let currFlower;
function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
          let mesh_arr = [];
         
          // if(!isGizmoDragging ) {
          // // if(marblePhotos.has(theMesh.name)) enable_gizmo(theMesh);
        
          if(pipesMap.has(theMesh.name))  enable_gizmo(theMesh);
          // }
          console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
        //   console.log("camera: ", buildCamera.position, buildCamera.alpha, buildCamera.beta, buildCamera.radius);
          // console.log("parent of mesh: ", theMesh.parent);
        
      
         
         
         

         

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


document.onkeydown = (evt)=>{
     
  //key press: p or P - enable position arrows
  //key press: r or R - enable rotation arrows
  //key press: s or S - enable bounding box for scaling / bounding box gizmo
  // console.log(evt.key);
  if(evt.key == 'o' || evt.key == 'O'){

      homeGizmo.attachedMesh = null;
      homeGizmo2.attachedMesh = null;
  }

}


/*################################################### END OF MOUSE EVENT FUNCTION ############################################## */















/*################################################### SETUP ORIG FLOWERS ############################################## */

function set_scale(){
  let size = getRandomInt(4,5)
  return size;
}

//function that randomizes int
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

let nb = 100;
var TWO_PI = Math.PI * 2;
var angle =  TWO_PI/ nb;
function load_orig_flowers(){
  for (const [flowerName,val] of rFootFlowersMap.entries()) {
      // let thePos = set_position();
      let thePos;
      if(val[0]!==null) thePos = val[0];
      let theSize = set_scale();
      let samp = init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
  }
}


function init_flower(name,matlName,imgPath,size, x, y, z){
  let plane = BABYLON.Mesh.CreatePlane(name, size, scene);
  plane.isVisible = true;
          
  plane.position = new BABYLON.Vector3(x,y,z);
  plane.rotation.y = BABYLON.Tools.ToRadians(-250);
  
  let planeMatl = new BABYLON.StandardMaterial(matlName, scene);
  planeMatl.diffuseColor = BABYLON.Color3.Black();
  planeMatl.diffuseTexture = new BABYLON.Texture(imgPath, scene);
  
  planeMatl.diffuseTexture.hasAlpha = true;
  planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
  planeMatl.emissiveColor = BABYLON.Color3.White();
  planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
  planeMatl.freeze();
  
  plane.material = planeMatl;
  // plane.freezeWorldMatrix();
  add_action_mgr(plane);
  return plane;
}


//function that enables the on mouse over and on mouse out events on a flower
function add_action_mgr(theFlower){
  theFlower.actionManager = new BABYLON.ActionManager(scene);
  theFlower.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction(
              BABYLON.ActionManager.OnPointerOverTrigger,
              onOverFlower
      )
  );
  theFlower.actionManager.registerAction(
      new BABYLON.ExecuteCodeAction(
          BABYLON.ActionManager.OnPointerOutTrigger,
          onOutFlower
      )
  );
}

//handles the on mouse over event
let origScaling, origColor;
var onOverFlower =(meshEvent)=>{
  origScaling = meshEvent.source.scaling;
  meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.4,origScaling.y*1.4,origScaling.z*1.4);
  // hl.addMesh(meshEvent.source, new BABYLON.Color3(1,1,0.8));
  let a = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
  let b = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
  let c = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
  hl.addMesh(meshEvent.source, new BABYLON.Color3(a,b,c));
};

//handles the on mouse out event
var onOutFlower =(meshEvent)=>{
  meshEvent.source.scaling = origScaling;
  hl.removeMesh(meshEvent.source);
};


/*################################################### END OF SETUP FLOWERS FUNCTION ############################################## */





  //function that will render the scene on loop
  var scene = createBuildScene();
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    engine.runRenderLoop(function(){
      if(scene){
          scene.render();
        //  console.log(buildCamera.position, buildCamera.alpha, buildCamera.beta);
      }
      
  
    });//end of renderloop

    window.addEventListener("resize", function () {
      engine.resize();
    });
  });



