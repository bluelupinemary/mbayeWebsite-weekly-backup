
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let footCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
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
    footCamera = create_camera();
    create_light();
    // create_contacts_gui();
    

    hl = new BABYLON.HighlightLayer("hl1", scene);
    starColor = new BABYLON.HighlightLayer("starColor", scene);


    return scene;
}

//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-60.752,10,7.05),scene);

    //zoom in/out speed; speed - lower numer, faster zoom in/out

    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    // camera.ellipsoid = new BABYLON.Vector3(10,10,10);

    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 20;                    //zoom in limit
    camera.upperRadiusLimit = 500;                 //zoom out limit
    camera.wheelPrecision = 3;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 500;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 1500;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 1;
    camera.radius = 100;
   
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
let rfoot_obj;
let rfoot_meshes;
let foot_plane, foot_heart_label;
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/feetMbayeScene/", "FrontRFoot.babylon", scene,
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
            

                result.meshes[0].scaling = new BABYLON.Vector3(12,12,12);
                result.meshes[0].isPickable = true;
                rfoot_obj = result.meshes[0];
                rfoot_obj.checkCollisions = true;
                rfoot_meshes = result.meshes;
              

                result.meshes.forEach(function(m) {
                    m.isPickable = true;
                });

            }),
      
      ]).then(() => {
        add_mouse_listener();
        setup_music_player();

        for(const [key,val] of marblePhotos.entries()){
          // console.log(val);
          init_flower_photo(key,val[0],val[1],val[2]);
        }

        init_foot_label();
        init_foot_heart_label();
        add_action_mgr(rfoot_obj);

       
      

          
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
         
          if(theMesh.name === "footHeartLbl") enable_gizmo(theMesh);
          //   enable_gizmo(theMesh);
          // }
          console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
          console.log("camera: ", footCamera.position, footCamera.alpha, footCamera.beta, footCamera.radius);
          // console.log("parent of mesh: ", theMesh.parent);
        
          if(rFootFlowersMap.has(theMesh.name)){
              if(theMesh.parent){
                  //this is the flower on the foot
                if( litFlowersMap.has(theMesh)){
                    let val = rFootFlowersMap.get(theMesh.name);

                    showFlowerModelDiv(val[2]);     //pass the 3d flower name from the mapping
                }

              }else{
                  let angle = rFootFlowersMap.get(theMesh.name);
                 
              
                  clearTimeout(focusTimer);

                  let music = flowersMbayeMap.get(theMesh.name);
                  let videoId = music[3].id;                            //4th value is the video id
                  let startTime = music[3].start;
                  
                  get_foot_mesh(theMesh.name,angle[1]);
                  if(theMesh.name!=currFlower){
                    load_flower_music(videoId, startTime);          //load the music video
                    currFlower = theMesh.name;
                  }else if(theMesh.name==currFlower) document.getElementById("musicVideoDiv").style.visibility = "visible";
              }//end of if has parent
              
              
          }

          if(theMesh === foot_plane){
              if(!isGalleryVisible){
                set_gallery_visible(true);
                isGalleryVisible = true;
                set_camera_specs("init");
              }else {
                set_gallery_visible(false);
                isGalleryVisible = false;
              }
          }

         
         
         

         

    }//eof if
    
  }//end of on pointer down function

  var onPointerUpVisit = function () {
     
  }//end of on pointer up function

  var onPointerMoveVisit = function (evt) {
   
  }//end of on pointer move function

  canvas.addEventListener("pointerdown", onPointerDownVisit, false);
  canvas.addEventListener("pointerup", onPointerUpVisit, false);
  canvas.addEventListener("pointermove", onPointerMoveVisit, false);

  // canvas.addEventListener("dblclick", function (e) {
  //     var pickInfo = scene.pick(scene.pointerX, scene.pointerY);
  //     if (pickInfo.hit) {
  //       // console.log(pickInfo);
  //       let theMesh = pickInfo.pickedMesh;
     
       
  //     }	   
	// });


  //remove the text span on dispose
  scene.onDispose = function() {
      //related to the drag and drop
      canvas.removeEventListener("pointerdown", onPointerDownVisit);
      canvas.removeEventListener("pointerup", onPointerUpVisit);
      canvas.removeEventListener("pointermove", onPointerMoveVisit);

  };

}//end of listen to mouse function

let litFlowersMap = new Map();
function get_foot_mesh(theMesh,camAngle){
  
  // console.log("camAngle", camAngle);

  //set to original color
  if(litFlowersMap.size > 0){
    for(const [key,val] of litFlowersMap.entries()){
      key.material = val;
      key.actionManager = null;
    }
    litFlowersMap.clear(); 
  }
 
  let ctr=0;
  // for(i=0;i<meshArr.length;i++){
    // console.log(theMesh);
    rfoot_meshes.forEach(function(m) {
      if (m.name === theMesh) {
          litFlowersMap.set(m,m.material);
          if(ctr == 0){
              set_camera_specs(camAngle);
            }
          ctr++;
         
          let newMat= m.material.clone();
          // newMat.emissiveColor = new BABYLON. Color4(0.7,0.5,0,0.2);
          newMat.emissiveColor = new BABYLON.Color3(0,0,0.5);
          m.material.isWorldMatrixFrozen = false;
          m.material = newMat;
          add_action_mgr(m);
      }
      
    });
    
  // }//end of for
  
  
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
        footCamera.position = cameraInitState.position;
        footCamera.alpha = cameraInitState.a;
        footCamera.beta = cameraInitState.b;
        footCamera.radius = cameraInitState.r;
    }else{
    // if(theMesh.name == "10Poppy"){
      if(camAngle == "b") footCamera.position = new BABYLON.Vector3(127.24,-4.45,-11.36);
      else if(camAngle == "f") footCamera.position = new BABYLON.Vector3(-60.752,10,7.05);

      let val = cameraAngleMap.get(camAngle);
      footCamera.alpha = val[0].a;
      footCamera.beta = val[0].b;
    // }

    // footCamera.focusOn([theMesh], true);
      footCamera.radius = 115;
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
  // console.log(meshEvent.source.name);
  

  if(meshEvent.source.parent == null){
    if(meshEvent.source == rfoot_obj){
        // console.log("foot");
    }
    else if(meshEvent.source.name == "footHoverLbl"){
      foot_heart_label.isVisible = true;
    }else{
    //floating flowers
      origScaling = meshEvent.source.scaling;
      meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.4,origScaling.y*1.4,origScaling.z*1.4);
      // hl.addMesh(meshEvent.source, new BABYLON.Color3(1,1,0.8));
      let a = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      let b = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      let c = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
      hl.addMesh(meshEvent.source, new BABYLON.Color3(a,b,c));

      flowerLbl = document.createElement("span");
      flowerLbl.setAttribute("id", "flowerLbl");
      var sty = flowerLbl.style;
      sty.position = "absolute";
      sty.lineHeight = "1.2em";
      sty.padding = "0.5%";
      sty.color = "#00BFFF  ";
      //
      sty.fontFamily = "Courgette-Regular";
      // sty.backgroundColor = "#0b91c3a3";
      // sty.opacity = "0.7";
      sty.fontSize = "1vw";
      sty.top = (scene.pointerY-50) + "px";
      sty.left = (scene.pointerX+10) + "px";
      sty.cursor = "pointer";
      
      let theName =  meshEvent.meshUnderPointer.name;
      document.body.appendChild(flowerLbl);
      flowerLbl.textContent = flowerName.get(theName);
    }
  }else{
      if(meshEvent.source.name !== "footHoverLbl"){
        //flower on the foot
        footMatl = meshEvent.source.material;
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,0.7,0.7);
      }
   
  }
  
  
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
        // meshEvent.source.material.emissiveColor = new BABYLON. Color3(0.7,0.5,0);
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
  var scene = createContactScene();
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    engine.runRenderLoop(function(){
      if(scene){
          scene.render();
      //    console.log(insCamera.position, insCamera.alpha, insCamera.beta);
      }
      
  
    });//end of renderloop

    window.addEventListener("resize", function () {
      engine.resize();
    });
  });





/*################################################### START OF YOUTUBE PLAYER SETUP ############################################## */

  let yt_player;
  let isMusicChanged = false;
  let theClick = 0;
  function setup_music_player(){
      console.log("setup music");
     
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
      document.getElementById("musicVideoDiv").style.visibility = "visible";
  }


  function stop_flower_music(){
      yt_player.stopVideo(); 
  }


  /*################################################### END OF SETUP YOUTUBE PLAYER FUNCTION ############################################## */





$('#musicVideoDiv #close-btn').on("click", function (e) {
    // $('#flowerModelDiv').hide();
    document.getElementById("musicVideoDiv").style.visibility = "hidden";
 });

 $('#flowerModelDiv #close-btn').on("click", function (e) {
  // $('#flowerModelDiv').hide();
  document.getElementById("flowerModelDiv").style.visibility = "hidden";
});

let isFlowerFullscreen = false;
$('#flowerModelDiv #fullscreen-btn').on("click", function (e) {
   if(!isFlowerFullscreen){
       $('#flowerModelDiv').css({ 
           width :'100vw',
           height: "100vh",
           left: '0' 
       });
       $("#flowerModelDiv #fullscreen-btn").attr("src", "front/images3D/minimize-btn.png")
       isFlowerFullscreen = true;
   }else{
       $('#flowerModelDiv').css({ 
           width:'20vw',
           height:'12vw',
           bottom:'0vw',
           left:'0vw'
       });
       $("#flowerModelDiv #fullscreen-btn").attr("src", "front/images3D/fullscreen-btn.png")
       isFlowerFullscreen = false;
   }
});

 function showFlowerModelDiv(theFlowerName){
  document.getElementById("flowerViewer").src = "front/objects/flowersMbayeScene/flowers3D/"+theFlowerName+".glb";
  document.getElementById("flowerModelDiv").style.visibility = "visible";
  // $('#flowerModelDiv').show();
}//end of showCharDescDiv function
