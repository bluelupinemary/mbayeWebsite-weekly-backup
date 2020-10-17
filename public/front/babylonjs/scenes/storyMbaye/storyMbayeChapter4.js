
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

    if(stageNo === 48){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(150);
        $('.firstVideoOverlayText').css('font-size','3.2vw');
       let initdelay = 1000;
        for(i=0;i<imgArr.length;i++){
            let pos = stageMap.get(stageNo).imagePos;
            let temp = init_photo(imgArr[i],{w:200,h:200},{x:20,y:-15,z:-250},stageNo);
            add_delay(temp,initdelay,3000);
            currStageObjMap.set(temp.name, temp);
            animateObjectPosition(temp,20,frameCount,pos[i]);
            initdelay += 1000;
        }//end of for loop
       
    }else if(stageNo === 49){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(150);
         $('.firstVideoOverlayText').css('font-size','3.2vw');
        
         let initdelay = 1000;
         for(i=0;i<imgArr.length;i++){
             let pos = stageMap.get(stageNo).imagePos;
             let temp = init_photo(imgArr[i],{w:200,h:200},pos[i],stageNo);
             add_delay(temp,initdelay,4000);
             currStageObjMap.set(temp.name, temp);
             initdelay += 3000;
         }//end of for loop

    }else if(stageNo === 50){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(120);
        head_obj.rotation.y = BABYLON.Tools.ToRadians(90);
        head_obj.isVisible = true;
        head_obj.setEnabled(true);
        $('.firstVideoOverlayText').css('font-size','3.2vw');

    
        animateObjectRotationNoEase(head_obj, 40, frameCount, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(270),0));
        let imgs = [];
        for(i=0;i<imgArr.length;i++){
            let temp = init_photo(imgArr[i],{w:25,h:25},{x:0,y:0,z:0},stageNo);
            temp.rotation.y = BABYLON.Tools.ToRadians(180);
            temp.visibility = 0;
            currStageObjMap.set(temp.name, temp);
            temp.setParent(head_obj);
            imgs.push(temp);
            hl.addMesh(temp, new BABYLON.Color3(0,0.5,0.5));
           
        }//end of for loop

        currTimer = setTimeout(function(){
            let pos = stageMap.get(stageNo).imagePos;
            for(i=0;i<imgs.length;i++){
                animateObjectFadeOut(imgs[i], 30, 200, 1);
                animateObjectPosition(imgs[i],25,100,pos[i]);
            }
        },5000);
    }else if(stageNo === 51){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        setCamDefault(100);
        head_obj.rotation.y = BABYLON.Tools.ToRadians(90);
        head_obj.isVisible = false;
        head_obj.setEnabled(false);
         $('.firstVideoOverlayText').css({'font-size':'4.7vw','color' : '#0ee6e6'});
         scene.animatables.forEach(function(anim){
            anim.stop();
          });
          let delay = 1000;
          let imgs = [];
          let scale = stageMap.get(stageNo).imageScale;
          let startPos = stageMap.get(stageNo).startPos;
          let pos = stageMap.get(stageNo).imagePos;
          for(i=0;i<imgArr.length;i++){
                s = scale[i];
                let temp = init_photo(imgArr[i],{w:50,h:50},{x:pos[i].x,y:pos[i].y-800,z:pos[i].z},stageNo);
                temp.scaling = new BABYLON.Vector3(s.x,s.y,s.z);    
                currStageObjMap.set(temp.name, temp);
                imgs.push(temp);
                hl.addMesh(temp, new BABYLON.Color3(0,0.5,0.5));
            }//end of for loop 

            
            animateObjectPositionNoEase(imgs[0],40,frameCount,pos[0]);
            animateObjectPositionNoEase(imgs[1],25,frameCount,pos[1]);
            animateObjectPositionNoEase(imgs[2],30,frameCount,pos[2]);
            animateObjectPositionNoEase(imgs[3],25,frameCount,pos[3]);
            animateObjectPositionNoEase(imgs[4],35,frameCount,pos[4]);

       
        // animateCameraToRadius(storyCamera,50,frameCount,150);
        
    }else if(stageNo === 52){                                      
        //for the current stage, change font size of text; show texts; add zoomin animation
        head_obj.isVisible = true;
        head_obj.setEnabled(true);
        head_obj.position = BABYLON.Vector3.Zero();
        head_obj.rotation.y = BABYLON.Tools.ToRadians(90);
        setCamDefault(200);
        
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'3.7vw'});
         scene.animatables.forEach(function(anim){
            anim.stop();
        });

        animateCameraToRadius(storyCamera,50,frameCount,100);
        isHeadRotateActive = true;
        
    }else if(stageNo === 53){                                      
        unhighlightFlowers();
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'3.8vw'});
        head_obj.isVisible = false;
        head_obj.setEnabled(false);
        let theDisc = init_disc(stageNo);
        currStageObjMap.set(theDisc.name, theDisc);
        setCamInferior();
        animateObjectPosition(theDisc, 20, frameCount, new BABYLON.Vector3(0,500,0));

    }else if(stageNo === 54){      
        setCamDefault(200);
                                
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'4.3vw'});
        head_obj.isVisible = false;
        head_obj.setEnabled(false);
        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:0,y:0,z:-500},stageNo); 
        currStageObjMap.set(temp.name,temp);     
        add_delay(temp, 2000, 5000);

    }else if(stageNo === 55){                                      
        setCamDefault(200);                          
        $("#firstVideoOverlayText").css({ 'color' : '#0ee6e6','font-size':'5vw'});
        head_obj.isVisible = false;
        head_obj.setEnabled(false);
        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:1000,y:0,z:-500},stageNo); 
        currStageObjMap.set(temp.name,temp);     
        animateObjectPosition(temp, 20, frameCount, new BABYLON.Vector3(0,0,-500));
        add_delay(temp, 2000, 5000);

    }else if(stageNo === 56){                                      
        setCamDefault(200);                          
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'4.2vw'});
        head_obj.isVisible = false;
        head_obj.setEnabled(false);
        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:1000,y:0,z:-500},stageNo); 
        currStageObjMap.set(temp.name,temp);     
        animateObjectPosition(temp, 20, frameCount, new BABYLON.Vector3(0,0,-500));
        add_delay(temp, 2000, 5000);

    }else if(stageNo === 57){                                      
        setCamDefault(150);
         $('.firstVideoOverlayText').css('font-size','4.2vw');
         let pos = stageMap.get(stageNo).imagePos;
         let imgs = [];
         let initdelay = 1000;
         for(i=0;i<imgArr.length;i++){
            let temp = init_photo(imgArr[i],{w:200,h:200},pos[i],stageNo);
            imgs.push(temp);
            hl.addMesh(temp, new BABYLON.Color3(0,0.5,0.5));
            currStageObjMap.set(temp.name, temp);
         }//end of for loop

    }else if(stageNo === 58){                                      
        setCamDefault(200);
        $("#firstVideoOverlayText").css({ 'color' : '#0ee6e6','font-size':'4.2vw'});
         let pos = stageMap.get(stageNo).imagePos;
         let startPos = stageMap.get(stageNo).startPos;
         let scale = stageMap.get(stageNo).imageScale;
         let imgs = [];
        //  let initdelay = 1000;
         for(i=0;i<imgArr.length;i++){
            let temp = init_photo(imgArr[i],{w:200,h:200},startPos[i],stageNo);
            imgs.push(temp);
            temp.scaling = new BABYLON.Vector3(scale[i].x,scale[i].y, scale[i].z);
            currStageObjMap.set(temp.name, temp);
         }//end of for loop

         for(i=0;i<imgs.length;i++){
            animateObjectPosition(imgs[i], 30,frameCount, pos[i]);
         }

    }else if(stageNo === 59){                                      
        // setCamDefault(150);
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'4.2vw'});

        setCamDefault(500);
        videoDisc = init_video("59Welding",550,stageNo);
        videoDisc.material.diffuseTexture.uOffset = 0.16;
        videoDisc.material.diffuseTexture.uScale = 0.7;
        currStageObjMap.set(videoDisc.name, videoDisc);
        hl.addMesh(videoDisc, new BABYLON.Color3(0,0.5,0.5));
         
    }else if(stageNo === 60){                                      
        setCamDefault();
        if(videoDisc){
            try{
                let theVid = videoDisc.material.diffuseTexture.video;
                theVid.pause();
                theVid.currentTime = 0;
            }catch(e){

            };
        }
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'5vw'});
        let theDisc = init_disc(stageNo);
        animateObjectPosition(theDisc, 50, frameCount, new BABYLON.Vector3(0,500,0));
        currStageObjMap.set(theDisc.name, theDisc);
        setCamInferior();
        

    }else if(stageNo === 61){                                      
        setCamDefault(200);
        $("#firstVideoOverlayText").css({ 'color' : '#0ee6e6','font-size':'3.5vw'});
        
        let imgs = [];
        let pos = stageMap.get(stageNo).imagePos;
        let startPos = stageMap.get(stageNo).startPos;
        let temp = init_photo(imgArr[0],{w:200,h:250},startPos[0],stageNo);
        currStageObjMap.set(temp.name, temp);
        imgs.push(temp);
        for(i=1;i<imgArr.length;i++){
            let temp = init_photo(imgArr[i],{w:450,h:250},startPos[i],stageNo);
            imgs.push(temp);
            currStageObjMap.set(temp.name, temp);
         }//end of for loop

         for(i=0;i<imgs.length;i++){
            animateObjectPosition(imgs[i], 30,frameCount, pos[i]);
         }
    }


    currentStage++;
    // currentStage = 31;

    
    // console.log("the scene: ", scene.activeCamera);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}

function highlightFlowers(){
    faceFlowersMap.forEach(function(m) {
            m.material.emissiveColor = new BABYLON.Color3(0,1,0);
            // m.material.emissiveColor = new BABYLON. Color4(0.7,0.5,0,0.2);
            m.visibility = 1;
           
            flowerColor.addMesh(m, BABYLON.Color3.Green());
            flowerColor.innerGlow = false;

           
      });
}

function unhighlightFlowers(){
    faceFlowersMap.forEach(function(m) {
            
            m.visibility = 0;
           
            flowerColor.removeMesh(m);

           
      });
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
    currentStage = 48;
    setup_stage(48);                                                 //start showing the script 1, stage 1
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
    // $('#continueBtnDiv').css('visibility','hidden');
    // setup_stage(currentStage);

    if(currentStage <= 61){
      $('#continueBtnDiv').css('visibility','hidden');
      setup_stage(currentStage);
    }else{
        let cNo = 5;
        $.ajax({
        type: "get",
        url:urlStory,
        data:{chapter_no:cNo,
                _token:token
        },
        success: function(result){
                window.location.href=urlStory+"?cNo="+cNo;
        }
        });
    }
    
    //console.log("continue button is clicked");
  });