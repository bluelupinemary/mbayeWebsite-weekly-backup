
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

let faceFlowersMap = new Map();
let createChapter4Scene = function(){
    
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
   
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
    
    load_3D_mesh();
    skybox = create_skybox();
    storyCamera = create_camera();
    storyLight = create_light();
    hl = new BABYLON.HighlightLayer("hl1", scene);
    flowerColor = new BABYLON.HighlightLayer("hl1", scene);

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let head_obj;
let collage_wall;
var WALL_INIT_POS = new BABYLON.Vector3(-9.12,0,-1100);
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/headMbayeScene/", "HeadMbaye0803.glb", scene).then(function (result) {
        

            result.meshes[0].scaling = new BABYLON.Vector3(12,12,-12);
            result.meshes[0].isPickable = true;
            head_obj = result.meshes[0];
            head_obj.checkCollisions = true;

            result.meshes[0].rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
            head_obj.isVisible = false;
            head_obj.setEnabled(false);

            result.meshes.forEach(function(m) {
                 
                if(m.name === "FP7") {
                  m.hasVertexAlpha = false;
                }
               
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
                    m.isVisible = false;
                }else{
                    //the part is a flower of the panel
                    let mtl = new BABYLON.StandardMaterial("pbr", scene);
                    m.material.transparencyMode = 0;
                    m.visibility = 0;
                    m.material = mtl;

                    faceFlowersMap.set(m.name, m);
   
                }
            });//end of foreach

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
let videoDisc;
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

    if(stageNo === 62){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(150);
        $('.firstVideoOverlayText').css('font-size','5.5vw');
        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:0,y:0,z:-700},stageNo); 
        currStageObjMap.set(temp.name,temp);      

        add_delay(temp,1000,4000);
        animateObjectPosition(temp, 20, frameCount, new BABYLON.Vector3(0,0,-500));
    }else if(stageNo === 63){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(150);
        $('.firstVideoOverlayText').css('font-size','5vw');
        
    }else if(stageNo === 63){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(150);
        $('.firstVideoOverlayText').css('font-size','5.5vw');
    }


    currentStage++;
    // currentStage = 31;

    
    // console.log("the scene: ", scene.activeCamera);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}


let dome;
function setup_3D_photo(){
  if(dome) dome.dispose();
   dome = new BABYLON.PhotoDome(
      "testdome",
      "front/textures/storyMbaye/collage-37-1.png",
      { 
          resolution: 64,
          size: 1000
      },
      scene
  );

  dome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-130),0);

}






  //function that will render the scene on loop
  var scene = createChapter4Scene();
  let loadingTimer;
  if(scene.isLoading){
      let c=0;
      loadingTimer = setInterval(function () {

        if(c<101){
          document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+c+" %";
          c++;
        }
        
    }, 250);
  }

  scene.executeWhenReady(function () {    
    clearInterval(loadingTimer);
    document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+"100%";
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    $('.firstVideoOverlayText').css('display', 'block');

    rotate_sky();                                                   //start rotating the sky
    currentStage = 62;
    setup_stage(62);                                                 //start showing the script 1, stage 1
    // currentStage = 49;
    // setup_stage(49); 
    
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

    // if(currentStage <= 61){
    //   $('#continueBtnDiv').css('visibility','hidden');
    //   setup_stage(currentStage);
    // }else{
    //     let cNo = 5;
    //     $.ajax({
    //     type: "get",
    //     url:urlStory,
    //     data:{chapter_no:cNo,
    //             _token:token
    //     },
    //     success: function(result){
    //             window.location.href=urlStory+"?cNo="+cNo;
    //     }
    //     });
    // }
    
    //console.log("continue button is clicked");
  });