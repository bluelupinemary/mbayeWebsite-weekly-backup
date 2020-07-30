
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let storyCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
let skybox;

let currentStage = 24;
let imagePath = 'front/images3D/storyMbayeScene/';
let texturePath = 'front/textures/storyMbaye/';

let createChapter2Scene = function(){
    
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
    skybox = create_skybox();
    storyCamera = create_camera();
    storyLight = create_light();
    load_orig_flowers();
    // create_contacts_gui();
    
    // scene.debugLayer.show();
    hl = new BABYLON.HighlightLayer("hl1", scene);

    

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let earth_obj;
let collage_wall;
var WALL_INIT_POS = new BABYLON.Vector3(-9.12,0,-1500);
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/storyMbayeScene/", "MbayeRandomPanels.glb", scene, function (evt) {
                // onProgress
                
                if (evt.lengthComputable) {
                    loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                } else {
                    var dlCount = evt.loaded / (1024 * 1024);
                    loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                }
                document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
          }).then(function (result) {
                result.meshes[0].scaling = new BABYLON.Vector3(3,3,-3);
                mbaye_obj = result.meshes[0];

                result.meshes.forEach(function(m){
                  m.isPickable = true;
                  if(m.name === "MbayeBody" || m.name === "BodyPanels"){
                      let pbr = new BABYLON.PBRMaterial("pbr", scene);
                      m.material = pbr;
                      m.material.backFaceCulling = false;
                      pbr.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
                      pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                      pbr.metallic = 1;
                      pbr.metallicF0Factor = 0.50;
                      pbr.roughness = 0.15;
                      pbr.microSurface = 1; 
                  }else if(m.name === "R_EYEAventurine_primitive1" || m.name === "L_EYEAventurine_primitive1" ){
                      m.material.albedoColor = new BABYLON.Color3(0.01,0.2,0.07);
                  }
              });

            ;

            }),
      ]).then(() => {
        earth_obj = init_earth();
        earth_obj.setEnabled(false);
        add_mouse_listener();
        
    });
}//end of load design meshes






let currStageObjMap = new Map();
let currTimer;
let secondCamView, isMbayeRotating=false, isWorldFlowersActive = false;
let worldFlowers;

function setup_stage(stageNo){

    let imgArr=[];
    if(currTimer) clearTimeout(currTimer);
    remove_texts();                                                 //delete/remove html texts from the dom tree
    remove_stage_objects();                                         //delete/remove previously created objects from the scene thru currStageObjMap
    
    if(stageMap.has(stageNo)) imgArr = stageMap.get(stageNo).imagesUsed;                  //the arr of images set in the stage map

    setTimeout(function(){
          create_texts(stageNo);                                  //fetch texts from stage map and add to dom tree
    },100);

    if(stageNo === 24){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
      $('.firstVideoOverlayText').css('font-size','3vw');
      
        setCamDefault(500);
        mbaye_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-105),0);
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,-2);
        animateCameraToRadius(storyCamera, 25, frameCount, 80);
        isMbayeRotateActive = true;

        
    }else if(stageNo === 25){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(500);
        mbaye_obj.setEnabled(false);
        mbaye_obj.isVisible =false;
        let d1 = init_photo(imgArr[0],{w:350,h:400},{x: 0, y: 100, z: -300},stageNo);           
        let d2 = init_photo(imgArr[1],{w:350,h:400},{x: -400, y: 0, z: -300},stageNo);
        let d3 = init_photo(imgArr[2],{w:350,h:400},{x: 400, y: 0, z: -300},stageNo);  
       
        let s1 = init_photo(imgArr[3],{w:350,h:400},{x: 0, y: 100, z: -300},stageNo);           
        let s2 = init_photo(imgArr[4],{w:350,h:400},{x: -400, y: 0, z: -300},stageNo);
        let s3 = init_photo(imgArr[5],{w:350,h:400},{x: 400, y: 0, z: -300},stageNo);  
        
        d1.visibility  = 0;
        d2.visibility =0;
        d3.visibility =0;
  
      
        currStageObjMap.set(s1.name, s1);
        currStageObjMap.set(s2.name, s2);
        currStageObjMap.set(s3.name, s3);
     
        currStageObjMap.set(d1.name, d1);
        currStageObjMap.set(d2.name, d2);
        currStageObjMap.set(d3.name, d3);
      
        add_delay(s1,500,2500);
        add_delay(s2,500,2500);
        add_delay(s3,500,2500);
    
        
        currTimer = setTimeout(function(){
          animateObjectFadeOut(s1, 30, 200, 0);
          animateObjectFadeOut(s2, 30, 200, 0);
          animateObjectFadeOut(s3, 30, 200, 0);
         
          animateObjectFadeOut(d1, 30, 200, 1);
          animateObjectFadeOut(d2, 30, 200, 1);
          animateObjectFadeOut(d3, 30, 200, 1);
          
        },3000);
    
    }else if(stageNo === 26){                                      
      //for the current stage, change font color, show 360 photo of flower shop  
        $('#firstVideoOverlayText').css('color','#0ab7ea');
        setup_3D_photo();
        set_camera_specs(stageNo);
        let boy = init_photo(imgArr[0],{w:500,h:500},{x: -200, y: -70, z: -30},stageNo);  
        currStageObjMap.set(boy.name, boy);
        add_delay(boy,2000,3000);
    
    }else if(stageNo === 27){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        $("#firstVideoOverlayText").css({ 'color' : '#0ab7ea', 'font-size':'3.2vw'});
        setCamDefault();
        set_camera_specs(stageNo);
        if(dome) dome.dispose();
        let e1 = init_photo(imgArr[1],{w:700,h:700},{x: -800, y: 200, z: -1200},stageNo);           
        let e2 = init_photo(imgArr[2],{w:700,h:700},{x: 0, y: 0, z: -1200},stageNo);
        let e3 = init_photo(imgArr[0],{w:700,h:700},{x: 800, y: 200, z: -1200},stageNo);  
        currStageObjMap.set(e1.name, e1);
        currStageObjMap.set(e2.name, e2);
        currStageObjMap.set(e3.name, e3);

        if(e1) animateObjectPosition(e1, 20, frameCount, new BABYLON.Vector3(-800,200,0));
        if(e2) animateObjectPosition(e2, 10, 100, new BABYLON.Vector3(0,0,-600));
        if(e3) animateObjectPosition(e3, 20, frameCount, new BABYLON.Vector3(800,200,0));
        hl.addMesh(e1, new BABYLON.Color3(0.5,0.5,0.5));
        hl.addMesh(e2, new BABYLON.Color3(0.5,0.5,0.5));
        hl.addMesh(e3, new BABYLON.Color3(0.5,0.5,0.5));
    }else if(stageNo === 28){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        mbaye_obj.setEnabled(false);
        mbaye_obj.isVisible =false;

        $("#firstVideoOverlayText").css({ 'color' : '#efad0c', 'font-size':'3.5vw'});
        setCamLateralLeft();
        setFlowerVisibility();
        
        worldFlowers = init_photo(imgArr[0],{w:600,h:600},{x: 1200, y: 0, z:-300},stageNo);
        worldFlowers.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-90),0);
        set_camera_specs(stageNo);
        currStageObjMap.set(worldFlowers.name, worldFlowers);
    }else if(stageNo === 29){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault();
        removeFlowers();
        set_camera_specs(stageNo);
      
        scene.animatables.forEach(function(anim){
              anim.stop();
        });
       
       
    
    }else if(stageNo === 30){                                      
        //for the current stage,add images of black and orig flowers
        setCamDefault();
        set_camera_specs(stageNo);
        let f1 = init_photo(imgArr[0],{w:250,h:300},{x: 0, y: 500, z: -800},stageNo);           
        let f2 = init_photo(imgArr[1],{w:250,h:300},{x: -1000, y: 0, z: -800},stageNo);
        let f3 = init_photo(imgArr[2],{w:250,h:300},{x: 1000, y: 0, z: -800},stageNo);  
        let f4 = init_photo(imgArr[3],{w:250,h:300},{x: -700, y: -500, z: -800},stageNo);
        let f5 = init_photo(imgArr[4],{w:250,h:300},{x: 700, y: -500, z: -800},stageNo);  

        let b1 = init_photo(imgArr[5],{w:250,h:300},{x: 0, y: 500, z: -800},stageNo);           
        let b2 = init_photo(imgArr[6],{w:250,h:300},{x: -1000, y: 0, z: -800},stageNo);
        let b3 = init_photo(imgArr[7],{w:250,h:300},{x: 1000, y: 0, z: -800},stageNo);  
        let b4 = init_photo(imgArr[8],{w:250,h:300},{x: -700, y: -500, z: -800},stageNo);
        let b5 = init_photo(imgArr[9],{w:250,h:300},{x: 700, y: -500, z: -800},stageNo);  
        b1.visibility  = 0;
        b2.visibility =0;
        b3.visibility =0;
        b4.visibility =0;
        b5.visibility =0;
      
        currStageObjMap.set(f1.name, f1);
        currStageObjMap.set(f2.name, f2);
        currStageObjMap.set(f3.name, f3);
        currStageObjMap.set(f4.name, f4);
        currStageObjMap.set(f5.name, f5);

        currStageObjMap.set(b1.name, b1);
        currStageObjMap.set(b2.name, b2);
        currStageObjMap.set(b3.name, b3);
        currStageObjMap.set(b4.name, b4);
        currStageObjMap.set(b5.name, b5);

        add_delay(f1,500,2500);
        add_delay(f2,500,2500);
        add_delay(f3,500,2500);
        add_delay(f4,500,2500);
        add_delay(f5,500,2500);
        
        currTimer = setTimeout(function(){
          animateObjectFadeOut(f1, 30, 200, 0);
          animateObjectFadeOut(f2, 30, 200, 0);
          animateObjectFadeOut(f3, 30, 200, 0);
          animateObjectFadeOut(f4, 30, 200, 0);
          animateObjectFadeOut(f5, 30, 200, 0);

          animateObjectFadeOut(b1, 30, 200, 1);
          animateObjectFadeOut(b2, 30, 200, 1);
          animateObjectFadeOut(b3, 30, 200, 1);
          animateObjectFadeOut(b4, 30, 200, 1);
          animateObjectFadeOut(b5, 30, 200, 1);
          
        },3000);
    }else if(stageNo === 31){                                      
      //for the current stage,add images of black and orig flowers
        setCamDefault(80);
        mbaye_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-105),0);
        mbaye_obj.setEnabled(true);
        mbaye_obj.isVisible = true;

        scene.animatables.forEach(function(anim){
            anim.stop();
        });

        currTimer = setTimeout(function(){
            animateObjectRotation(mbaye_obj, 20, 200, new BABYLON.Vector3(-0.2,2.7,0));
        },500);
        


     
    }
    currentStage++;
    // currentStage = 31;

    
    // console.log("the scene: ", scene.activeCamera);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}

function set_camera_specs(stageNo){
  if(stageNo === 26){
      storyCamera.lowerAlphaLimit = 0.9059762890318959;
      storyCamera.upperAlphaLimit = 2.152565254742033;

      storyCamera.lowerBetaLimit = 1.154381248012086;
      storyCamera.upperBetaLimit = 2.3110118760751495;

      storyCamera.upperRadiusLimit = 600;
  }else if(stageNo === 27){
      storyCamera.lowerAlphaLimit = null;
      storyCamera.upperAlphaLimit = 1000;

      storyCamera.lowerBetaLimit = 0.01;
      storyCamera.upperBetaLimit = 3.1315926535897933;

      storyCamera.upperRadiusLimit = 1500;
      storyCamera.radius = 1500;
  }else if(stageNo === 28){
      storyCamera.upperRadiusLimit = 150;
  }else if(stageNo === 29){
      storyCamera.upperRadiusLimit = 1500;
  }else if(stageNo === 30){
    storyCamera.radius = 900;
}
}

let dome;
function setup_3D_photo(){
  if(dome) dome.dispose();
   dome = new BABYLON.PhotoDome(
      "testdome",
      "front/images3D/storyMbayeScene/flower.jpg",
      { 
          resolution: 64,
          size: 1000
      },
      scene
  );

  dome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-130),0);

}





function set_scale(){
  let size = getRandomInt(4,5)
  return size;
}

//function that randomizes int
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

let stageFlowersMap = new Map();
function load_orig_flowers(){
  for (const [flowerName,val] of rFootFlowersMap.entries()) {
      // let thePos = set_position();
      let thePos;
      if(val[0]!==null) thePos = val[0];
      let theSize = set_scale();
      let samp = init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
      stageFlowersMap.set(flowerName,samp);
  }
}


function init_flower(name,matlName,imgPath,size, x, y, z){
  let plane = BABYLON.Mesh.CreatePlane(name, size, scene);
  plane.isVisible = false;
          
  plane.position = new BABYLON.Vector3(x,y,z);
  plane.rotation.y = BABYLON.Tools.ToRadians(-90);
  
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
  // add_action_mgr(plane);
  return plane;
}

function setFlowerVisibility(){
  for (const [flowerName,val] of stageFlowersMap.entries()) {
      val.isVisible = true;
  }
}

function removeFlowers(){
  for (const [flowerName,val] of stageFlowersMap.entries()) {
      val.dispose();
  }
  stageFlowersMap.clear();
}





  //function that will render the scene on loop
  var scene = createChapter2Scene();
  
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    $('.firstVideoOverlayText').css('display', 'block');

    rotate_sky();                                                   //start rotating the sky
    // currentStage = 24;
    // setup_stage(24);                                                 //start showing the script 1, stage 1
    currentStage = 24;
    setup_stage(24); 
    
    engine.runRenderLoop(function(){
      if(scene){
          scene.render();
      }
    });//end of renderloop

    window.addEventListener("resize", function () {
      engine.resize();
    });
  });



  //if continue button is clicked
  $('#continueBtn').on('click',function(evt){
    $('#continueBtnDiv').css('visibility','hidden');
    setup_stage(currentStage);
    
    //console.log("continue button is clicked");
  });