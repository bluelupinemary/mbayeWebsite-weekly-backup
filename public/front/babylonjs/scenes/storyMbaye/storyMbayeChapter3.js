
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
    // load_orig_flowers();
    // create_contacts_gui();
    
    // scene.debugLayer.show();
    hl = new BABYLON.HighlightLayer("hl1", scene);

    

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let rfoot_obj;
let collage_wall;
var WALL_INIT_POS = new BABYLON.Vector3(-9.12,0,-1500);
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
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/storyMbayeScene/", "collageWall2.glb", scene
            ).then(function (result) {
              result.meshes[0].scaling = new BABYLON.Vector3(0.7,0.4,-0.5);
              result.meshes[1].name = "collageWall";
              // result.meshes[0].isPickable = true;
              collage_wall = result.meshes[1];
              collage_wall.isVisible = false;
              
              result.meshes[0].position = WALL_INIT_POS;

          }),
      ]).then(() => {
        // earth_obj = init_earth();
        // earth_obj.setEnabled(false);
        add_mouse_listener();
        setup_collage();
        
    });
}//end of load design meshes





let earth_obj;
let currStageObjMap = new Map();
let currTimer;
let secondCamView, isMbayeRotating=false, isWorldFlowersActive = false;
let worldFlowers;
let video31;
let stage32map = new Map();
let stage25map = [];
function setup_stage(stageNo){

    let imgArr=[];
    if(currTimer) clearTimeout(currTimer);
    remove_texts();                                                 //delete/remove html texts from the dom tree
    remove_stage_objects();                                         //delete/remove previously created objects from the scene thru currStageObjMap
    
    if(stageMap.has(stageNo)) imgArr = stageMap.get(stageNo).imagesUsed;                  //the arr of images set in the stage map

    setTimeout(function(){
          create_texts(stageNo);                                  //fetch texts from stage map and add to dom tree
    },100);

    if(stageNo === 35){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
       $('.firstVideoOverlayText').css('font-size','3vw');
        console.log("here");
        storyCamera.radius = 50;
        rfoot_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,2);
        animateObjectRotationNoEase(rfoot_obj, 10, frameCount, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(450),0));
    }else if(stageNo === 36){             
        storyCamera.radius = 500;                         
        // rfoot_obj.isVisible = false;
        // rfoot_obj.setEnabled(false);

        change_collage_photo(stageNo);
        collage_wall.isVisible = true;
        collage_wall.setEnabled(true);

        animateCameraToRadius(storyCamera, 20, frameCount, 50);

    }else if(stageNo === 37){             
        setCamDefault(500);    
        collage_wall.isVisible = false;
        collage_wall.setEnabled(false);

     

  }
    currentStage++;
    // currentStage = 31;

    
    // console.log("the scene: ", scene.activeCamera);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}

function set_camera_specs(stageNo){
 
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
    currentStage = 35;
    setup_stage(35); 
    
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