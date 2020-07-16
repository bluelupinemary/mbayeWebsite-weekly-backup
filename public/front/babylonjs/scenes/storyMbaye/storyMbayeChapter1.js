let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let storyCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
let skybox;

let currentStage = 1;

let createChapter1Scene = function(){
    
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
    create_light();
    // create_contacts_gui();
    
    // scene.debugLayer.show();
    hl = new BABYLON.HighlightLayer("hl1", scene);
    starColor = new BABYLON.HighlightLayer("starColor", scene);
    

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let earth_obj;
let collage_wall;
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", scene,
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
                
                
                result.meshes[9].scaling = new BABYLON.Vector3(0.2,0.2,0.2);
                let water = new BABYLON.WaterMaterial("water", scene, new BABYLON.Vector2(2048, 2048));
                water.backFaceCulling = true;
                water.bumpTexture = new BABYLON.Texture("front/textures/participate/waterbump.png", scene);
                water.windForce = 10;
                water.windDirection = new BABYLON.Vector2(-1,0);
                water.waveHeight = 0.2;
                water.bumpHeight = 0.3;
                water.waveLength = 0.1;
                water.colorBlendFactor = 0.25714;
                water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                water.addToRenderList(skybox);
                result.meshes[7].material = water;
                result.meshes[9].setEnabled(false);
                
                earth_obj = result.meshes[9];

                
            }),
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/storyMbayeScene/", "collageWall2.glb", scene).then(function (result) {
                result.meshes[0].scaling = new BABYLON.Vector3(0.7,0.4,-0.5);
                // result.meshes[0].isPickable = true;
                collage_wall = result.meshes[1];
                
                result.meshes[0].position = new BABYLON.Vector3(-9.12,0,-1508);
                // enable_gizmo(result.meshes[0]);
            ;

            }),
      ]).then(() => {
        add_mouse_listener();
    });
}//end of load design meshes


  //function that will render the scene on loop
  var scene = createChapter1Scene();
  
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    $('.firstVideoOverlayText').css('display', 'block');

    rotate_sky();                                                   //start rotating the sky
    currentStage = 1;
    setup_stage(1,null);                                                 //start showing the script 1, stage 1
    
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
    
    setup_stage(currentStage);
    //console.log("continue button is clicked");
  });