
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let storyCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
let skybox;

let currentStage = 35;


let createChapter3Scene = function(){
    
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
    load_orig_flowers(3);
    // create_contacts_gui();
    
    // scene.debugLayer.show();
    hl = new BABYLON.HighlightLayer("hl1", scene);

    

    return scene;
}



//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let rfoot_obj;
let collage_wall;
var WALL_INIT_POS = new BABYLON.Vector3(-9.12,0,-1100);
function load_3D_mesh(){
    var loadedPercent = 0;
    Promise.all([
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/feetMbayeScene/", "FrontRFoot.babylon", scene).then(function (result) {
        

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
        setup_music_player();
        
    });
}//end of load design meshes





let earth_obj;
let currStageObjMap = new Map();
let currTimer;
let worldFlowers;
let videoDisc;

function setup_stage(stageNo){

    let imgArr=[];
    if(currTimer) clearTimeout(currTimer);
  
    remove_texts();                                                 //delete/remove html texts from the dom tree
    remove_stage_objects();                                         //delete/remove previously created objects from the scene thru currStageObjMap
    remove_highlighted_objects(hl);
    if(stageMap.has(stageNo)) imgArr = stageMap.get(stageNo).imagesUsed;                  //the arr of images set in the stage map

    setTimeout(function(){
          create_texts(stageNo);                                  //fetch texts from stage map and add to dom tree
    },100);

    if(stageNo === 35){                                      
      //for the current stage, change font size of text; show texts; add zoomin animation
       $('.firstVideoOverlayText').css('font-size','3vw');
        storyCamera.radius = 45;
        rfoot_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,2);
        
        animateObjectRotationNoEase(rfoot_obj, 10, frameCount, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(450),0));
    }else if(stageNo === 36){  
        $('.firstVideoOverlayText').css('font-size','4.5vw');        
        setCamDefault(150);   
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,0);
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);

        let temp = init_photo(imgArr[0],{w:700,h:450},{x:0,y:0,z:0},stageNo); 
        currStageObjMap.set(temp.name,temp);                 
      
        animateCameraToRadius(storyCamera, 20, frameCount, 500);

    }else if(stageNo === 37){   
      $("#firstVideoOverlayText").css({ 'color' : '#37fff6','font-size':'3vw'});
        scene.animatables.forEach(function(anim){
          anim.stop();
        });

        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
      
        setCamDefault(50); 
        change_collage_photo(stageNo);
        collage_wall.isVisible = true;
        collage_wall.setEnabled(true);

    }else if(stageNo === 38){   
        $("#firstVideoOverlayText").css({ 'color' : '#efad0c','font-size':'3.5vw'});
        collage_wall.isVisible = false;
        collage_wall.setEnabled(false);

        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
     
        storyCamera.radius = 140;
        storyCamera.alpha = 1.5784;
        storyCamera.beta = 1.5814;
  

        let initDelay = 1000;
        for(i=0;i<imgArr.length;i++){
            let pos = stageMap.get(stageNo).imagePos;
            let temp = init_photo(imgArr[i],{w:70,h:70},pos[i],stageNo);
            add_delay(temp,initDelay,2000);
            currStageObjMap.set(temp.name, temp);
            initDelay += 2000;
           
        }//end of for loop

         
    }else if(stageNo === 39){
       $("#firstVideoOverlayText").css({'font-size':'3vw'});
      
        setCamDefault(500);
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
        rfoot_obj.position = new BABYLON.Vector3(0,0,0);
        videoDisc = init_video("videoStage39",550,stageNo);
        videoDisc.material.diffuseTexture.uOffset = 0.16;
        videoDisc.material.diffuseTexture.uScale = 0.7;
        currStageObjMap.set(videoDisc.name, videoDisc);
        hl.addMesh(videoDisc, new BABYLON.Color3(0,0.5,0.5));

    }else if(stageNo === 40){   
        $("#firstVideoOverlayText").css({'font-size':'4vw'});

        if(videoDisc){
            try{
                let theVid = videoDisc.material.diffuseTexture.video;
                theVid.pause();
                theVid.currentTime = 0;
            }catch(e){

            };
        }
        setCamDefault(850);
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
        rfoot_obj.position = new BABYLON.Vector3(0,0,0);

        let imgs = [];
        let pos = stageMap.get(stageNo).imagePos;

        for(i=0;i<imgArr.length;i++){
          let temp = init_photo(imgArr[i],{w:250,h:300},pos[i],stageNo);
          imgs.push(temp);
          currStageObjMap.set(temp.name, temp);
          if(i>4) temp.visibility = 0;
          
        }

        currTimer = setTimeout(function(){
          for(i=0;i<imgs.length;i++){
            if(i<5) animateObjectFadeOut(imgs[i], 30, 200, 0);
            else animateObjectFadeOut(imgs[i], 30, 200, 1);
          }
        },2000); 
    }else if(stageNo === 41){   
        $("#firstVideoOverlayText").css({'font-size':'3.5vw'});
        try{
          stop_music();
        }catch(e){

        }
        // setCamDefault(1500);
        rfoot_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);

        setCamLateralLeft();
        storyCamera.alpha = 2.8724466335934786;
        storyCamera.beta= 1.3812596352337896;
        setFlowerVisibility();
        storyCamera.upperRadiusLimit = 1800;
        storyCamera.radius = 1000;
        animateCameraToRadius(storyCamera,20,frameCount,1700);


    }else if(stageNo === 42){   
        $("#firstVideoOverlayText").css({'font-size':'3.7vw'});
        removeFlowers();
        setCamDefault(300);
        
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,0);
        storyCamera.upperRadiusLimit = 1500;
        let worldFlowers = init_photo(imgArr[0],{w:700,h:700},{x: 0, y: 0, z:-1000},stageNo);
        currStageObjMap.set(worldFlowers.name, worldFlowers);
    
    }else if(stageNo === 43){   
        $("#firstVideoOverlayText").css({'font-size':'4vw'});
     
        setCamDefault(180);
        
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);

        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:0,y:0,z:-500},stageNo); 
        currStageObjMap.set(temp.name,temp);      

        add_delay(temp,1000,4000);

    }else if(stageNo === 44){   
        $("#firstVideoOverlayText").css({'font-size':'3.5vw'});
        
        setCamDefault(300);
        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);

        change_collage_photo(stageNo);
        collage_wall.isVisible = true;
        collage_wall.setEnabled(true);

        animateCameraToRadius(storyCamera,30,frameCount,800);
       
    }else if(stageNo === 45){   
        $("#firstVideoOverlayText").css({'font-size':'3.2vw'});
        collage_wall.isVisible = false;
        collage_wall.setEnabled(false);

        rfoot_obj.position = new BABYLON.Vector3(-70,-25,390);
        rfoot_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(115),0);
        rfoot_obj.isVisible = true;
        rfoot_obj.setEnabled(true);
        setCamDefault(200);

        let imgs = [];
        let pos = stageMap.get(stageNo).imagePos;

        for(i=0;i<imgArr.length;i++){
          let temp = init_photo(imgArr[i],{w:10,h:10},{x:-80,y:-25,z:380},stageNo);
          imgs.push(temp);
          currStageObjMap.set(temp.name, temp);
          hl.addMesh(temp,new BABYLON.Color3(0,0.5,0.5));
        }

        currTimer = setTimeout(function(){
            for(i=0;i<imgs.length;i++){
                animateObjectPosition(imgs[i],20,frameCount,pos[i]);
                animateObjectScaling(imgs[i],20,frameCount,new BABYLON.Vector3(15,15,15));
            }
        },3000);
        

        animateCameraToRadius(storyCamera,50,frameCount,500);
    }else if(stageNo === 46){   
        $("#firstVideoOverlayText").css({'font-size':'3.5vw'});
        rfoot_obj.position = new BABYLON.Vector3(0,0,0);
        setCamDefault(200);

        collage_wall.isVisible = false;
        collage_wall.setEnabled(false);

        rfoot_obj.isVisible = false;
        rfoot_obj.setEnabled(false);
        let temp = init_photo(imgArr[0],{w:1200,h:600},{x:0,y:0,z:-500},stageNo); 
        currStageObjMap.set(temp.name,temp);      
     
    }else if(stageNo === 47){   
        $("#firstVideoOverlayText").css({'font-size':'3.7vw'});
        // storyCamera.position = new BABYLON.Vector3(0,0,0);
        rfoot_obj.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
        rfoot_obj.isVisible = true;
        rfoot_obj.setEnabled(true);
        setCamSuperior(300);
      
        storyCamera.targetScreenOffset = new BABYLON.Vector2(0,-4);
        animateCameraToRadius(storyCamera,40,frameCount,45);

        
     
    }


    currentStage++;
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
  var scene = createChapter3Scene();
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
    currentStage = 35;
    setup_stage(35);                                                 //start showing the script 1, stage 1
    // currentStage = 36;
    // setup_stage(36); 
    
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

    if(currentStage <= 47){
      $('#continueBtnDiv').css('visibility','hidden');
      setup_stage(currentStage);
    }else{
        let cNo = 4;
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


// $(function() {
//   function clock() {
//     var theDate = new Date();
//     var t = theDate.getHours() + ":" + theDate.getMinutes() + ":" + theDate.getSeconds();
//     console.log(t);
//   }
//   setInterval(clock, 1000);
// });