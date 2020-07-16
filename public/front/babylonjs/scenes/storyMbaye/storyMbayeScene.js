
//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    // let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),100, new BABYLON.Vector3(-122.65,34.86,101.49),scene);
    // let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),100, new BABYLON.Vector3(-14.53,4.380,694.85),scene);
     let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),100, new BABYLON.Vector3(0,0,0),scene);

    //zoom in/out speed; speed - lower numer, faster zoom in/out

    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 30;                    //zoom in limit
    camera.upperRadiusLimit = 1500;                 //zoom out limit
    camera.wheelPrecision = 2;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 100;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 1500;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 1;
    camera.radius = 1500;
   
    camera.alpha = BABYLON.Tools.ToRadians(90);
    camera.beta = BABYLON.Tools.ToRadians(90);
    // camera.beta = 1.5812;
    // camera.alpha =  2.9088;
    // camera.beta = 1.5066;
    // camera.alpha =  -3.8328;
    // camera.beta = 1.3551;
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
    let skybox = BABYLON.MeshBuilder.CreateBox("contactSkybox", {size:9000.0}, scene);
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
    // skyboxMaterial.freeze();
    // skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function




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

  
    // homeGizmo.onDragStartObservable.add(function () {
    //     isGizmoDragging = true;
    // });
    // homeGizmo.onDragEndObservable.add(function () {
    //     isGizmoDragging = false;
    //     homeGizmo2.attachedMesh = null;
    //     homeGizmo.attachedMesh = null;
        
    // });
}




//############################################# HANDLE USER'S INTERACTION #############################################//
let isPlane2Selected = false;
let isLaunchEnabled = false;
let currFlower;
function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;

    //   console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
          console.log("camera: ", storyCamera.position, storyCamera.alpha, storyCamera.beta, storyCamera.radius);
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
          let mesh_arr = [];
         
          // if(!isGizmoDragging ) {
          // // if(marblePhotos.has(theMesh.name)) enable_gizmo(theMesh);
        
        //   if(pipesMap.has(theMesh.name))  enable_gizmo(theMesh);
          // }
          console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
       
        //   enable_gizmo(theMesh);
        //   console.log("camera: ", storyCamera.position, storyCamera.alpha, storyCamera.beta, storyCamera.radius);
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


/*################################################### START CREATE COLLAGES FUNCTION ############################################## */
function setup_collage(scriptNo){
    if(scriptNo == 1){
        let wallMatl = new BABYLON.StandardMaterial(name, scene);
        wallMatl.diffuseColor = BABYLON.Color3.Black();
        // wallMatl.diffuseTexture = new BABYLON.Texture("front/images3D/feetScene/gallery/"+name+".png", scene);
        wallMatl.diffuseTexture = new BABYLON.Texture("front/textures/storyMbaye/collage-1-2.png", scene);
        wallMatl.opacityTexture = new BABYLON.Texture("front/textures/storyMbaye/collage-1-2.png", scene);
        wallMatl.diffuseTexture.uScale = 1;
        wallMatl.diffuseTexture.vScale = -1;
        // wallMatl.alpha = 0.7;
        // wallMatl.alpha = 0.3;
        wallMatl.diffuseTexture.hasAlpha = true;
        wallMatl.specularColor = new BABYLON.Color3(0, 0, 0);
        wallMatl.emissiveColor = BABYLON.Color3.White();
        wallMatl.backFaceCulling = false;//Allways show the front and the back of an element

        collage_wall.material = wallMatl;
        add_delay(collage_wall,4000,5000);   
        
    }
}

function change_collage_photo(stageNo){
    if(collage_wall.material) collage_wall.material.dispose();
    // let matlName = stageMap.get(stageNo).collage;
    let wallMatl = new BABYLON.StandardMaterial(name, scene);
        wallMatl.diffuseColor = BABYLON.Color3.Black();
        // wallMatl.diffuseTexture = new BABYLON.Texture("front/images3D/feetScene/gallery/"+name+".png", scene);
        wallMatl.diffuseTexture = new BABYLON.Texture("front/textures/storyMbaye/collage-3-1.png", scene);
        wallMatl.opacityTexture = new BABYLON.Texture("front/textures/storyMbaye/collage-3-1.png", scene);

        wallMatl.diffuseTexture.uScale = 1;
        wallMatl.diffuseTexture.vScale = -1;
        // wallMatl.alpha = 0.7;
        // wallMatl.alpha = 0.3;
        wallMatl.diffuseTexture.hasAlpha = true;
        wallMatl.specularColor = new BABYLON.Color3(0, 0, 0);
        wallMatl.emissiveColor = BABYLON.Color3.White();
        wallMatl.backFaceCulling = false;//Allways show the front and the back of an element

        collage_wall.material = wallMatl;
}






function init_photo(name,size,pos){
    let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:size.w,height:size.h}, scene);
    // plane.isVisible = false;
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    // plane.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y, rot.z, rot.w);
    
    
    let planeMatl = new BABYLON.StandardMaterial(name, scene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/textures/storyMbaye/"+name+".png", scene);
    // planeMatl.opacityTexture = new BABYLON.Texture("front/textures/storyMbaye/"+name+".png", scene);
    planeMatl.diffuseTexture.hasAlpha = true;
   
    // planeMatl.opacityTexture = new BABYLON.Texture("front/textures/storyMbaye/"+name+".png", scene);
    planeMatl.diffuseTexture.uScale = -1;
   
    
    // planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.emissiveColor = BABYLON.Color3.White();
    planeMatl.backFaceCulling = false;                          //Allways show the front and the back of an element
    
    plane.material = planeMatl;

    
    return plane;
}


let collage1Map = new Map();
function init_collage_photo(name,pos,rot,size){
    let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:size.w,height:size.h}, scene);
    //   plane.isVisible = false;

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
    
    //   collage1Map.set(plane,null);
    
    
    return plane;
}

/*################################################### END OF COLLAGES FUNCTION ############################################## */




// let delayManager;
function add_delay(theMesh,delaytime,fadetime){
    let delayManager = new BABYLON.FadeInOutBehavior();
   
    delayManager.attach(theMesh);
    
    delayManager.fadeIn(true);
    delayManager.delay = delaytime;
    delayManager.fadeInTime = fadetime;
}












/*################################################### SETUP ORIG FLOWERS ############################################## */

// function set_scale(){
//   let size = getRandomInt(4,5)
//   return size;
// }

// //function that randomizes int
// function getRandomInt(min, max) {
//   return Math.floor(Math.random() * (max - min + 1) + min);
// }

// let nb = 100;
// var TWO_PI = Math.PI * 2;
// var angle =  TWO_PI/ nb;
// function load_orig_flowers(){
//   for (const [flowerName,val] of rFootFlowersMap.entries()) {
//       // let thePos = set_position();
//       let thePos;
//       if(val[0]!==null) thePos = val[0];
//       let theSize = set_scale();
//       let samp = init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
//   }
// }


function init_plane(name,matlName,imgPath,w,h,pos, rot){
  let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:w,height:h}, scene);
  plane.isVisible =false;
  plane.isPickable = true;
          
  plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
  plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
  
  let planeMatl = new BABYLON.StandardMaterial(matlName, scene);
  planeMatl.diffuseColor = BABYLON.Color3.Black();
  planeMatl.diffuseTexture = new BABYLON.Texture(imgPath, scene);
  
  planeMatl.diffuseTexture.hasAlpha = true;
  planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
  planeMatl.emissiveColor = BABYLON.Color3.White();
  planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
//   planeMatl.freeze();
  
  plane.material = planeMatl;
  // plane.freezeWorldMatrix();
//   add_action_mgr(plane);
  return plane;
}


// //function that enables the on mouse over and on mouse out events on a flower
// function add_action_mgr(theFlower){
//   theFlower.actionManager = new BABYLON.ActionManager(scene);
//   theFlower.actionManager.registerAction(
//           new BABYLON.ExecuteCodeAction(
//               BABYLON.ActionManager.OnPointerOverTrigger,
//               onOverFlower
//       )
//   );
//   theFlower.actionManager.registerAction(
//       new BABYLON.ExecuteCodeAction(
//           BABYLON.ActionManager.OnPointerOutTrigger,
//           onOutFlower
//       )
//   );
// }

// //handles the on mouse over event
// let origScaling, origColor;
// var onOverFlower =(meshEvent)=>{
//   origScaling = meshEvent.source.scaling;
//   meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.4,origScaling.y*1.4,origScaling.z*1.4);
//   // hl.addMesh(meshEvent.source, new BABYLON.Color3(1,1,0.8));
//   let a = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
//   let b = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
//   let c = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
//   hl.addMesh(meshEvent.source, new BABYLON.Color3(a,b,c));
// };

// //handles the on mouse out event
// var onOutFlower =(meshEvent)=>{
//   meshEvent.source.scaling = origScaling;
//   hl.removeMesh(meshEvent.source);
// };


/*################################################### END OF SETUP FLOWERS FUNCTION ############################################## */
function next_stage(stageNo){
    if(stageNo == 1){
       /* console.log("stage 1 set");
        var animationcamera = new BABYLON.Animation( "cameraAnimation", "position", 30, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);

        var keys = []; 

        keys.push({
        frame: 0,
        value: storyCamera.position.clone(),
        // outTangent: new BABYLON.Vector3(1, 0, 0)
        });

        keys.push({
            frame: 50,
            value: new BABYLON.Vector3(-255.52, 361, 335),
           
        });

        keys.push({
            frame: 100,
            // inTangent: new BABYLON.Vector3(-1, 0, 0),
            //value: new BABYLON.Vector3(-58.47, 75, 63.56),
            value: new BABYLON.Vector3(-179.35, 75, 133.31),
        });

        animationcamera.setKeys(keys);

        storyCamera.animations = [];
        storyCamera.animations.push(animationcamera);
        
      

        scene.beginAnimation(storyCamera, 0, 100, false, 1, itEnded);*/

        animateCameraTargetToPosition(storyCamera, speed, frameCount, new BABYLON.Vector3(0, 100, 0));
        // animateCameraToPosition(storyCamera, speed, frameCount, new BABYLON.Vector3(-73.34,  67.66, 108.483));
        animateCameraToPosition(storyCamera, speed, frameCount, new BABYLON.Vector3(-55.43, 71.79, 63.59));
        
        // {x: 407037648794, y: 86203449502, z: 895255889096}
    }
}


var speed = 45;
var frameCount = 200;

var animateCameraTargetToPosition = function(cam, speed, frameCount, newPos) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('at5', cam, 'target', speed, frameCount, cam.target, newPos, 0, ease);
}

var animateCameraToPosition = function(cam, speed, frameCount, newPos) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('at4', cam, 'position', speed, frameCount, cam.position, newPos, 0, ease,itEnded);
}

var animateCameraToRadius = function(cam, speed, frameCount, newRad) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('at4', cam, 'radius', speed, frameCount, cam.radius, newRad, 0, ease);
}

var animateObjectScaling = function(obj, speed, frameCount, newScale) {
    console.log("scale this: ", obj.name);
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('at4', obj, 'scaling', speed, frameCount, obj.scaling, newScale, 0, ease);
}



var itEnded = function(test) {
    console.log("end of animation");
    // document.getElementById("streetViewDiv").style.visibility = "visible";
    document.getElementById("continueBtnDiv").style.visibility = "visible";
    // smallHeathLbl.isVisible = true;
    // carpenterImg.isVisible = true;
    
//    storyCamera.targetScreenOffset = new BABYLON.Vector2(0,-50);
}


// var setCamDefault = function() {
//     animateCameraTargetToPosition(camera, speed, frameCount, new BABYLON.Vector3(0, 0, 0));
//     animateCameraToPosition(camera, speed, frameCount, new BABYLON.Vector3(-45, 55, -45));
// };


function create_animation(theObjName){
    // var animationcamera = new BABYLON.Animation(
    //     "myAnimationcamera", 
    //     "position", 
    //     30, 
    //     BABYLON.Animation.ANIMATIONTYPE_VECTOR3, 
    //     BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT
    // );

    //  var keys = []; 

    //  keys.push({
    //  frame: 0,
    //  value: camera.position.clone(),
    //  // outTangent: new BABYLON.Vector3(1, 0, 0)
    //  });

    //  keys.push({
    //  frame: 50,
    //  value: new BABYLON.Vector3(-400, 85, 5),
    //  });

    //  keys.push({
    //  frame: 100,
    //  // inTangent: new BABYLON.Vector3(-1, 0, 0),
    //  value: new BABYLON.Vector3(-400, 385, 5),
    //  });

    //  animationcamera.setKeys(keys);

    //  camera.animations = [];
    //  camera.animations.push(animationcamera);

    //  scene.beginAnimation(camera, 0, 100, false, 1, itEnded);
    if(theObjName === "earth") theObj = earth_obj;
}

let isRotateSkybox = true;
function rotate_sky(){
    let isStartStory = true;
    
    
    engine.runRenderLoop(function(){
        if(isStartStory){
            earth_obj.rotate(new BABYLON.Vector3(0,4,0), -0.005, BABYLON.Space.LOCAL);
        }
        if(skybox && isRotateSkybox){
            skybox.rotate(new BABYLON.Vector3(0,4,0), 0.001, BABYLON.Space.LOCAL);
        }
        
    });
}

function remove_stage_objects(){
    for(const [key,val] of stageObjMap.entries()){
        console.log("remove obj: ", key,val);
        val.dispose();
    }
    stageObjMap.clear();
    console.log(stageObjMap);
}

function remove_text_class(){
    $('.firstVideoOverlayText div').each(function() {
        $(this).removeClass('overlayTxt');
    });

}

function start_text_animation(stageNo){
    let i=0;
    let textArr = stageMap.get(stageNo).texts;
    $('.firstVideoOverlayText div').each(function() {
       
        $(this).attr('class','overlayTxt');
        $(this).text(textArr[i]);
        i++;
        // console.log('counter: ',a);
    });
    // console.log("restarted animation");
}


let stageObjMap = new Map();
function setup_stage(stageNo){
    if(stageNo === 1){
        
        $('.firstVideoOverlayText div').each(function() {
            $(this).attr('class', 'overlayTxt');
        });

        setup_collage(1);
        currentStage =3;
        let burj = init_photo("burj",{w:40,h:80},{x: 0, y: 55, z: -889.87});
        burj.setEnabled(false);
        
        stageObjMap.set(burj.name, burj)                                                //add the object to a map

        setTimeout(function(){
            burj.setEnabled(true);
            animateObjectScaling(burj, 20, frameCount, new BABYLON.Vector3(10,10,10));
            animateCameraToRadius(storyCamera, 20, frameCount, 500);
        },10000);
        

    }else if(stageNo === 3){
        collage_wall.isVisible = false;
        remove_text_class();
        remove_stage_objects();
        setTimeout(function(){
            start_text_animation(stageNo);
        },100);
        change_collage_photo(stageNo);
        collage_wall.isVisible = true;
        add_delay(collage_wall,5000,5000); 
        
    }

    
    // console.log("the scene: ", scene.meshes);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}


function showContinueButton(){
    $('#continueBtnDiv').css('visibility','visible');
}



let lastScriptTxt = document.getElementById("txt7");

function whichAnimationEvent(){

    var animations = {
      "animation"      : "animationend",
      "OAnimation"     : "oAnimationEnd",
      "MozAnimation"   : "animationend",
      "WebkitAnimation": "webkitAnimationEnd"
    }
  
    for (t in animations){
      if (lastScriptTxt.style[t] !== undefined){
        return animations[t];
      }
    }
  }
  
  var animationEvent = whichAnimationEvent();
  lastScriptTxt.addEventListener(animationEvent, showContinueButton);




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

function load_music(videoId,start) {
   
    $('.player').empty();
    yt_player.loadVideoById(videoId,start);
    yt_player.playVideo();
    // document.getElementById("musicVideoDiv").style.visibility = "visible";
}


function stop_flower_music(){
    yt_player.stopVideo(); 
}


/*################################################### END OF SETUP YOUTUBE PLAYER FUNCTION ############################################## */
