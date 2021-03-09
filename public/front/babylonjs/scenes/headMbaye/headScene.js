
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let headCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,flowerColor;
let createContactScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });

    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;
    scene.collisionsEnabled = true;
    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
    load_orig_flowers();
    create_skybox();
    headCamera = create_camera();
    create_light();
    // create_contacts_gui();
    

    hl = new BABYLON.HighlightLayer("hl1", scene);
    flowerColor = new BABYLON.HighlightLayer("flowerColor", scene);


    return scene;
}

//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-60.752,10,7.05),scene);

    //zoom in/out speed; speed - lower numer, faster zoom in/out

    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 40;                    //zoom in limit
    camera.upperRadiusLimit = 200;                 //zoom out limit
    camera.wheelPrecision = 3;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 300;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 70;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 1;
    camera.radius = 100;
    camera.maxZ = 280000;
   
    camera.alpha =  2.8985;
    camera.beta = 1.5703;


    camera.attachControl(canvas,true);
    scene.activeCamera = camera;
    camera.checkCollisions = true;

    // //save the initial state of the camera
    cameraInitState.position = new BABYLON.Vector3(-198.34,80.42,162.37);
    cameraInitState.a = camera.alpha;
    cameraInitState.b = camera.beta;
    cameraInitState.r = camera.radius;

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
    skybox.position = new BABYLON.Vector3(942,-500,-1500);
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
let rfoot_obj;
let rfoot_meshes;
let foot_plane, foot_heart_label;
let panelFlowersMap = new Map();
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/headMbayeScene/", "HeadMbaye0803.glb", scene,
          // BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/headMbayeScene/", "SamplePanel.glb", scene,
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
            

                result.meshes[0].scaling = new BABYLON.Vector3(8,8,-8);
                // result.meshes[0].scaling = new BABYLON.Vector3(12,12,-12);
                result.meshes[0].rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(12),0);
                result.meshes[0].isPickable = true;
                rfoot_obj = result.meshes[0];
                rfoot_obj.checkCollisions = true;
                rfoot_meshes = result.meshes;
               
                result.meshes.forEach(function(m) {
                 
                    if(m.name === "FP7") {
                      m.hasVertexAlpha = false;
                    }
                    
                    //fixes for the parts of the head with wrong filename
                    if(m.name === 'no name') m.name = "82Gladiolus";
                    if(m.name === '23westernColumbine') m.name = "23WesternColumbine (5)";


                    m.isPickable = true;
                    if(m.name === "Head" || m.name === "FP1" || m.name === "FP2" || m.name === "FP3" || m.name === "FP4" || m.name === "FP5" || m.name === "FP6"
                    || m.name === "FP7" || m.name === "FP8" || m.name === "FP9" || m.name === "FP10" || m.name === "FP11" || m.name === "FP12" || m.name === "FP13" 
                    || m.name === "FP14" || m.name === "FP15" || m.name === "FP16" || m.name === "FP17" || m.name === "FP18" || m.name === "FP17_primitive0" || m.name === "FP17_primitive1"
                    || m.name === "FP8_primitive0" || m.name === "FP8_primitive1"){
                    
                        let pbr = new BABYLON.PBRMaterial("pbr", scene);
                        m.material = pbr;
                        m.material.backFaceCulling = false;
                        pbr.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
                        pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                        pbr.metallic = 1;
                        pbr.metallicF0Factor = 0.50;
                        pbr.roughness = 0.15;
                        pbr.microSurface = 1; 
                    }else if(m.name === "L_EYEAventurine" || m.name === "R_EYEAventurine" ){
                        m.material.albedoColor = new BABYLON.Color3(0.01,0.2,0.07);
                    }else if(m.name === "L_EYEObsidian" || m.name === "R_EYEObsidian" || m.name === "__root__"){
                    }else if(m.name === "HeadCover"){
                        m.visibility = 0.7;
                    }else{
                        //the part is a flower of the panel
                        let mtl = new BABYLON.StandardMaterial("pbr", scene);
                        m.material.transparencyMode = 0;
                        m.visibility = 0;
                        m.material = mtl;
                        panelFlowersMap.set(m.name,m);


                    }
                });//end of foreach

               
            }),
      
      ]).then(() => {
        add_mouse_listener();
        setup_music_player();
       
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
let cameraInitPos = {a:null, b:null};
let tempFlower;
let isPointerDown = false;
function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
          let mesh_arr = [];
          // console.log("flower ", theMesh.name, theMesh.position);
        
          if(headFlowersMap.has(theMesh.name)){
           
            get_head_mesh(theMesh.name);

            let music = flowersMbayeMap.get(theMesh.name);
            let videoId = music[3].id;                            //4th value is the video id
            let startTime = music[3].start;
            
          
            if(theMesh.name!=currFlower){
                load_flower_music(videoId, startTime);          //load the music video
                currFlower = theMesh.name;
            }else if(theMesh.name==currFlower) $("#musicVideoDiv").css('display','flex');
          }//end of if
    }else{
        if(!isPointerDown){
           isPointerDown = true;
        }
    }//end of else
    
  }//end of on pointer down function

  var onPointerUpVisit = function () {
     isPointerDown = false;
    //  isFlowerRotated = false;
  }//end of on pointer up function

  let isFlowerRotated = false;
  var onPointerMoveVisit = function (evt) {
      if(isPointerDown){
        set_flower_angle();
      }
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

//function to rotate the flower as the camera angle is moved to the left or right
function set_flower_angle(){
    for(const [key,val] of origFlowersMap.entries()){
        val.rotation.y += 0.015;
    }
}

let litFlowersMap = new Map();
function get_head_mesh(theMesh){
  // console.log(panelFlowersMap);
  // console.log("camAngle", camAngle);

  //set to original color
  if(litFlowersMap.size > 0){
    for(const [key,val] of litFlowersMap.entries()){
      key.visibility = 0;
      // key.actionManager = null;
      flowerColor.removeMesh(key);
    }
    litFlowersMap.clear(); 
  }
 
  let ctr=0;
    //for each flower identified from the loaded head of mbaye, check for the flower mapping of the currently selected flower
    panelFlowersMap.forEach(function(m) {
     
      if (m.name == theMesh || m.name.indexOf(theMesh) >= 0) {
        // console.log("here: ", m.name);
          litFlowersMap.set(m,m.material);
          m.material.emissiveColor = new BABYLON.Color3(0,1,0);
          // m.material.emissiveColor = new BABYLON. Color4(0.7,0.5,0,0.2);
          m.visibility = 1;
         
          // flowerColor.addMesh(m, BABYLON.Color3.Yellow());
           flowerColor.addMesh(m, BABYLON.Color3.Green());
          flowerColor.innerGlow = false;


          // add_action_mgr(m);
      }
    });
  
  
}

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



let focusTimer;
//focus on the flower
function set_camera_specs(camAngle){
    if(camAngle === "init"){
        headCamera.position = cameraInitState.position;
        headCamera.alpha = cameraInitState.a;
        headCamera.beta = cameraInitState.b;
        headCamera.radius = cameraInitState.r;
    }else{
    // if(theMesh.name == "10Poppy"){
      if(camAngle == "b") headCamera.position = new BABYLON.Vector3(127.24,-4.45,-11.36);
      else if(camAngle == "f") headCamera.position = new BABYLON.Vector3(-60.752,10,7.05);

      let val = cameraAngleMap.get(camAngle);
      headCamera.alpha = val[0].a;
      headCamera.beta = val[0].b;
    // }

    // headCamera.focusOn([theMesh], true);
      headCamera.radius = 115;
    }
   

    
    
    
   
}
















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
let origFlowersMap = new Map();
function load_orig_flowers(){
  for (const [flowerName,val] of headFlowersMap.entries()) {
      // let thePos = set_position();
      let thePos;
      if(val[0]!==null) thePos = val[0];
      let theSize = set_scale();
      let samp = init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
      origFlowersMap.set(flowerName, samp);
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

function init_foot_label(){
  let plane = BABYLON.Mesh.CreatePlane("footHoverLbl", 10, scene);
  plane.isVisible = true;
  plane.position = new BABYLON.Vector3(0,3,-0);
  plane.rotationQuaternion = new BABYLON.Quaternion(0,-0.7324,0,-0.6808);

  let planeMatl = new BABYLON.StandardMaterial("footHoverLblMatl", scene);
  planeMatl.diffuseColor = BABYLON.Color3.Black();
  // planeMatl.diffuseTexture = new BABYLON.Texture(imgPath, scene);
  
  planeMatl.alpha = 0;
  // planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
 
  planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
  // planeMatl.freeze();
  
  plane.material = planeMatl;
  foot_plane = plane;
  add_action_mgr(plane);
  // return plane;
}

function init_foot_heart_label(){
  let plane = BABYLON.MeshBuilder.CreatePlane("footHeartLbl", {width:14,height:12}, scene);
  plane.isVisible = false;
  plane.position = new BABYLON.Vector3(-2.20,0.40,-21.28);
  plane.rotationQuaternion = new BABYLON.Quaternion(0,-0.8200,0,-0.5721);

  let planeMatl = new BABYLON.StandardMaterial("footHeartLbl", scene);
  
  planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/feetScene/footHeartLabel.png", scene);
  planeMatl.emissiveColor = new BABYLON.Color3(1,1,1);
  planeMatl.diffuseTexture.hasAlpha = true;

  // planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
 
  planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
  // planeMatl.freeze();
  foot_heart_label = plane;
  plane.material = planeMatl;
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

function remove_action_mgr(){

}

//handles the on mouse over event
let origScaling, origColor;
let flowerLbl;
let footMatl;
var onOverFlower =(meshEvent)=>{
      //floating flowers
      origScaling = meshEvent.source.scaling;
      meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.4,origScaling.y*1.4,origScaling.z*1.4);
      let a = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      let b = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      let c = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      hl.addMesh(meshEvent.source, new BABYLON.Color3(a,b,c));

      flowerLbl = document.createElement("span");
      flowerLbl.setAttribute("id", "flowerLbl");
      var sty = flowerLbl.style;
      sty.position = "absolute";
      sty.color = "#00BFFF";
      sty.fontFamily = "Courgette-Regular";
      sty.top = (scene.pointerY) + "px";
      sty.left = (scene.pointerX+20) + "px";
      sty.cursor = "pointer";
      sty.textShadow = "2px 0px 5px black"; 
      
      if(isMobile() || isSmallDevice()) sty.fontSize = "1.7em";
      else sty.fontSize = "2em";
      
      let theName =  meshEvent.meshUnderPointer.name;
      document.body.appendChild(flowerLbl);
      flowerLbl.textContent = flowerName.get(theName);
};

//handles the on mouse out event
var onOutFlower =(meshEvent)=>{
 
    if(meshEvent.source.parent == null) {
        if(meshEvent.source == rfoot_obj){
          //the foot
        }else if(meshEvent.source == foot_plane){
          foot_heart_label.isVisible = false;
        }else{
          //floating flowers
          meshEvent.source.scaling = origScaling;
          hl.removeMesh(meshEvent.source);
        }
     
    }else{
        //flowers on the foot
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,0,0.5);
    }
  
    while (document.getElementById("flowerLbl")) {
      document.getElementById("flowerLbl").parentNode.removeChild(document.getElementById("flowerLbl"));
    }   
};


/*################################################### END OF SETUP FLOWERS FUNCTION ############################################## */

let footGalleryMap = new Map();
function init_flower_photo(name,pos,rot,size){
  let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:size.w,height:size.h}, scene);
  plane.isVisible = false;

  plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
  plane.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y, rot.z, rot.w);
 
   
  let planeMatl = new BABYLON.StandardMaterial(name, scene);
  planeMatl.diffuseColor = BABYLON.Color3.Black();
  planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/feetScene/gallery/"+name+".png", scene);
  planeMatl.diffuseTexture.uScale = -1;
  // planeMatl.alpha = 0.7;
  // planeMatl.alpha = 0.3;
  planeMatl.diffuseTexture.hasAlpha = true;
  planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
  planeMatl.emissiveColor = BABYLON.Color3.White();
  planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
  // planeMatl.freeze();
  
  plane.material = planeMatl;
  
  footGalleryMap.set(plane,null);
  
  
  return plane;
}


let isGalleryVisible = false;
function set_gallery_visible(isSet){
  for(const [key,val] of footGalleryMap.entries()){
      if(isSet){
        key.isVisible = true;
      }
      else key.isVisible = false;
  }
 
}








//function that will render the scene on loop
var theScene = createContactScene();
  
theScene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    document.getElementById("loadingScreenOverlay").style.display = "block";
    testFullscreen();

    //scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(theScene, options);


    engine.runRenderLoop(function(){
      if(theScene){
          theScene.render();
      }
    });//end of renderloop

});

// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
    testOrientation();
    testFullscreen();
});

window.addEventListener("orientationchange", function(event) {
  testOrientation();
}, false); 

$( document ).ready(function() {
    testOrientation();
});





/*################################################### START OF YOUTUBE PLAYER SETUP ############################################## */

  let yt_player;
  let isMusicChanged = false;
  let theClick = 0;
  function setup_music_player(){
      // console.log("setup music");
     
      $('.player').empty();
      let initVideo = "";
      var video_player = document.getElementById('player');

      
      yt_player = new YT.Player(video_player, {
      host: 'https://www.youtube.com',
      height: '0',
      width: '0',
      videoId: initVideo,
      playerVars: {
          autoplay: 0,
          loop: 0,
          start: 0,
          enablejsapi: 1,
          origin : window.location.href,
          widget_referrer: window.location.href
      },
      events: {
          'onReady': onPlayerReady,
      } 
      });
  }


  function onPlayerReady(event) {
      event.target.playVideo();
  }

  function load_flower_music(videoId,start) {
     
      $('.player').empty();
      yt_player.loadVideoById(videoId,start);
      yt_player.playVideo();
      // document.getElementById("musicVideoDiv").style.visibility = "visible";
      $('#musicVideoDiv').css('display','flex');
  }


  function stop_flower_music(){
      yt_player.stopVideo(); 
  }


/*################################################### END OF SETUP YOUTUBE PLAYER FUNCTION ############################################## */

/*################################################### MUSIC VIDEO SECTIONFUNCTIONS         ############################################## */
// $('#musicVideoDiv #close-btn').on("click", function (e) {
//     // $('#flowerModelDiv').hide();
//     document.getElementById("musicVideoDiv").style.visibility = "hidden";
//  });


// let isFlowerFullscreen = false;
// $('#musicVideoDivHeader #fullscreen-btn, #musicVideoDivHeader #minimize-btn').on("click", function (e) {
//    if(!isFlowerFullscreen){
//        $('#musicVideoDiv #player').css({ 
//            width :'100vw',
//            height: '100vh'
//        });
//        $("#musicVideoDivHeader #fullscreen-btn").hide();
//        $("#musicVideoDivHeader #minimize-btn").show();
//    }else{
//         if(isMobile() || isSmallDevice()){
//           $('#musicVideoDiv #player').css({ 
//             width: '30vw',
//             height: '18vw'
//           });
//         }else{
//           $('#musicVideoDiv #player').css({ 
//               width: '20vw',
//               height: '12vw'
//           });
//         }
       
//        $("#musicVideoDivHeader #fullscreen-btn").show();
//        $("#musicVideoDivHeader #minimize-btn").hide();
//    }
//    isFlowerFullscreen = !isFlowerFullscreen;
// });

$('#musicVideoDivHeader #close-btn').on("click", function (e) {
  $('#musicVideoDiv').hide();
});


let isMusicFullscreen = false;
$('#musicVideoDivHeader #fullscreen-btn, #musicVideoDivHeader #minimize-btn').on("click", function (e) {
  if(!isMusicFullscreen){
      resize_window('full', 'youtube');
      $("#musicVideoDivHeader #fullscreen-btn").hide();
      $("#musicVideoDivHeader #minimize-btn").show();
  }else{
      resize_window('window', 'youtube');
      $("#musicVideoDivHeader #fullscreen-btn").show();
      $("#musicVideoDivHeader #minimize-btn").hide();
  }
  isMusicFullscreen = !isMusicFullscreen;
});


function resize_window(size, section){
  let theSection;
  if(section === 'youtube'){
    theSection = $('#musicVideoDiv #player');
  }


  if(size === 'full'){
      theSection.css({ 
        width :'100vw',
        height: '95vh'
      });
      if(section === 'youtube') $('#musicVideoDiv').css({width:'100vw', height:'auto'});
      $('#minimize-btn').css('padding-right','1%');
  }else{ //if windowed size
      if(isMobile() || isSmallDevice()){
        theSection.css({ 
          width: '30vw',
          height: '18vw'
        });
        if(section === 'youtube'){  
          $('#musicVideoDiv').css('width','30vw');
        }
      }else{
        theSection.css({ 
            width: '20vw',
            height: '12vw'
        });
        if(section === 'youtube'){
          $('#musicVideoDiv').css('width','20vw');
        }
      }
  }
}




$('#loadingScreenOverlay').on('click', function(evt){
    $(this).remove();
    $('#loadingScreenDiv').remove();
    document.getElementById("loadingScreenPercent").style.visibility = "hidden";
    openFullscreen();
    $('#fullscreenIcon').hide();
    $('#MbayeHeadinfoIcon').show();
});

 $("#MbayeHeadinfoIcon").on('click',function(){
         $('#flowerInstruction').toggle();
         $('#infoIconTextflowers').toggle();
         $('#infoIconTextdownflower').toggle();
         isIns2Active = !isIns2Active;
         
         $('#textCurve').toggle();
         $('#textCurve2').toggle();
         $('#textCurveanticlock').toggle();
         $('#textCurveanticlock2').toggle();
         set_circle_type();
  });

let isIns2Active = false;
function set_circle_type(){
    if(isIns2Active){
        circleType = new CircleType(document.getElementById('textCurve'));
        circleType3 = new CircleType(document.getElementById('textCurve2'));
        circleType1 = new CircleType(document.getElementById('textCurveanticlock'));
        circleType2 = new CircleType(document.getElementById('textCurveanticlock2'));

        // Set the text radius and direction. Note: setter methods are chainable.
        circleType.radius(150).dir(-1);
        circleType3.radius(150).dir(-1);
        // Set the text radius and direction. Note: setter methods are chainable.
        circleType1.radius(200);
        // Set the text radius and direction. Note: setter methods are chainable.
        circleType2.radius(200);
    }else{
        //destroy the instructions
        circleType.destroy();
        circleType1.destroy();
        circleType2.destroy();
        circleType3.destroy();

    }
}
