
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
    // create_contacts_gui();
    
    // scene.debugLayer.show();
    hl = new BABYLON.HighlightLayer("hl1", scene);

    

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let mbaye_obj;
let collage_wall;
var WALL_INIT_POS = new BABYLON.Vector3(-9.12,0,-1500);
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/mbaye/", "MbayeWhole.glb", scene, function (evt) {
                // onProgress
                
                if (evt.lengthComputable) {
                    loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                } else {
                    var dlCount = evt.loaded / (1024 * 1024);
                    loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                }
                document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
          }).then(function (result) {
                result.meshes[0].scaling = new BABYLON.Vector3(1.5,1.5,-1.5);
                result.meshes[1].name = "mbaye";
                // result.meshes[0].isPickable = true;
                mbaye_obj = result.meshes[1];
                
                result.meshes.forEach(function(mesh){
                    // if(mesh.name === "MbayeFeet_primitive0" || mesh.name === "MbayeFeet_primitive1"  || mesh.name === "L_EYEAventurine_primitive0" 
                    //  || mesh.name === "L_EYEAventurine_primitive1" || mesh.name === "L_EYEObsidian"  || mesh.name === "R_EYEAventurine_primitive0"
                    //  || mesh.name === "R_EYEAventurine_primitive1" || mesh.name === "R_EYEObsidian")
                    //  {
                    if(mesh.name === 'mbaye'){
                        let pbr = new BABYLON.PBRMaterial("pbr", scene);
                        mesh.material = pbr;
                        mesh.material.backFaceCulling = false;
                        pbr.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
                        pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                        pbr.metallic = 1;
                        pbr.metallicF0Factor = 0.50;
                        pbr.roughness = 0.15;
                        pbr.microSurface = 1; 
                    }
                   
                });//end of for

            ;

            }),
      ]).then(() => {
        add_mouse_listener();
        
    });
}//end of load design meshes







let currStageObjMap = new Map();
let currTimer;
function setup_stage(stageNo){
                                        //call from storyMbayeScene
   console.log("current stage no: ", stageNo);
    if(stageNo === 24){                                      //if this is the first stage
        setCamDefault(100);
        remove_texts();
        // $('.firstVideoOverlayText div').each(function() {
        //     $(this).attr('class', 'overlayTxt');
        // });
        
        scene.meshes.forEach(function(mesh){
          console.log(mesh.name);
        });


    }
    // else if(stageNo >= 3){                             
    //     //if this is not the first scene,
    //     if(collage_wall) collage_wall.isVisible = false;
    //     if(currTimer) clearTimeout(currTimer);
    //     remove_texts();                                                 //delete/remove html texts from the dom tree
    //     remove_stage_objects();                                         //delete/remove previously created objects from the scene thru currStageObjMap
    //     let imgArr = stageMap.get(stageNo).imagesUsed;                  //the arr of images set in the stage map
        
    //     setTimeout(function(){
    //             create_texts(stageNo);                                  //fetch texts from stage map and add to dom tree
    //     },100);

    //     if(stageNo === 3){
    //             //set camera to default/init view and zoom in animation on the collage wall, change collage wall photo, add fade-in effect to collage wall
    //             setCamDefault(); 
    //             animateCameraToRadius(storyCamera, 20, frameCount, 500);
    //             change_collage_photo(stageNo);
    //             collage_wall.isVisible = true;
    //             add_delay(collage_wall,5000,5000); 

    //     }

    //     // scene.meshes.forEach(function(mesh){
    //     //   console.log(mesh.name);
    //     // });
        
        
    // }//end of if else

    currentStage++;

    
    // console.log("the scene: ", scene.meshes);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}




  //function that will render the scene on loop
  var scene = createChapter2Scene();
  
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    $('.firstVideoOverlayText').css('display', 'block');

    rotate_sky();                                                   //start rotating the sky
    // currentStage = 24;
    setup_stage(24);                                                 //start showing the script 1, stage 1
    
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