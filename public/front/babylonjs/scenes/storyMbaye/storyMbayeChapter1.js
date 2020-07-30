
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
    storyLight = create_light();
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
            BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/storyMbayeScene/", "collageWall2.glb", scene, function (evt) {
                // onProgress
                
                if (evt.lengthComputable) {
                    loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                } else {
                    var dlCount = evt.loaded / (1024 * 1024);
                    loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                }
                document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
          }).then(function (result) {
                result.meshes[0].scaling = new BABYLON.Vector3(0.7,0.4,-0.5);
                result.meshes[1].name = "collageWall";
                // result.meshes[0].isPickable = true;
                collage_wall = result.meshes[1];
                
                result.meshes[0].position = WALL_INIT_POS;
                
                // enable_gizmo(result.meshes[0]);
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
function setup_stage(stageNo){
                                        //call from storyMbayeScene
   // console.log("current stage no: ", stageNo);
    if(stageNo === 1){                                      //if this is the first stage
        setCamDefault();
        $('.firstVideoOverlayText div').each(function() {
            $(this).attr('class', 'overlayTxt');
        });
        
     

        setup_collage();
        
        let burj = init_photo("burj.png",{w:40,h:80},{x: 0, y: 55, z: -889.87},stageNo);
        burj.setEnabled(false);
        
        currStageObjMap.set(burj.name, burj);                                                //add the object to a map

        currTimer = setTimeout(function(){
            burj.setEnabled(true);
            animateObjectScaling(burj, 20, frameCount, new BABYLON.Vector3(10,10,10));
            animateCameraToRadius(storyCamera, 20, frameCount, 500);
        },6000);
        

    }else if(stageNo >= 3){                             
        //if this is not the first scene,
        if(collage_wall) collage_wall.isVisible = false;
        if(currTimer) clearTimeout(currTimer);
        remove_texts();                                                 //delete/remove html texts from the dom tree
        remove_stage_objects();                                         //delete/remove previously created objects from the scene thru currStageObjMap
        let imgArr = stageMap.get(stageNo).imagesUsed;                  //the arr of images set in the stage map
        
        setTimeout(function(){
                create_texts(stageNo);                                  //fetch texts from stage map and add to dom tree
        },100);

        if(stageNo === 3){
                //set camera to default/init view and zoom in animation on the collage wall, change collage wall photo, add fade-in effect to collage wall
                setCamDefault(); 
                animateCameraToRadius(storyCamera, 20, frameCount, 500);
                change_collage_photo(stageNo);
                collage_wall.isVisible = true;
                add_delay(collage_wall,5000,5000); 

        }else if(stageNo === 4){
                //set camera to default/init view; hide collage wall; create image disc; view skybox top; add scaling animation to disc
                setCamDefault();
                $('.firstVideoOverlayText').css('font-size','3.8vw');
                let theDisc = init_disc(stageNo);
                currStageObjMap.set(theDisc.name, theDisc);                     //add to map so it can be deleted when continue button is clicked
                setCamInferior();
                collage_wall.setEnabled(false);
                currTimer = setTimeout(function(){
                    if(theDisc) animateObjectScaling(theDisc, 20, frameCount, new BABYLON.Vector3(1.7,1.7,1.7));
                },100);
        
        }else if(stageNo === 5){
                //set camera to default/init view; create planes of lions; set camera view to bottom of skybox
                setCamDefault();
                storyLight.intensity = 0.5;
                let lion1 = init_photo(imgArr[0],{w:500,h:400},{x: 0, y: -1000, z: -100},stageNo);           
                let lion2 = init_photo(imgArr[1],{w:500,h:400},{x: -500, y: -1000, z: 200},stageNo);
                let lion3 =  init_photo(imgArr[2],{w:600,h:480},{x: 600, y: -1000, z: 200},stageNo);
                currStageObjMap.set(lion1.name, lion1);
                add_delay(lion1,2000,3000);  
                currStageObjMap.set(lion2.name, lion2); 
                add_delay(lion2,4000,3000); 
                currStageObjMap.set(lion3.name, lion3); 
                add_delay(lion3,6000,3000); 
                setCamSuperior();
        }else if(stageNo === 6){
                //same camera view with prev; create man in bed photo
                let man = init_photo(imgArr[0],{w:600,h:480},{x: 520, y: -1000, z: -150},stageNo);           
                add_delay(man,2000,5000);  
                currStageObjMap.set(man.name, man);   
        }else if(stageNo === 7){
                //same camera view with prev; create man seating photos
                let man1 = init_photo(imgArr[0],{w:500,h:400},{x: 650, y: -1000, z: -220},stageNo);           
                let man2 = init_photo(imgArr[1],{w:600,h:480},{x: -600, y: -1000, z: 100},stageNo);
                currStageObjMap.set(man1.name, man1);
                add_delay(man1,2000,4000);  
                currStageObjMap.set(man2.name, man2); 
                add_delay(man2,5000,4000); 
        }else if(stageNo === 8){
                //change font color, shadow, stroke
                $('#firstVideoOverlayText').css('color','white');
                $('#firstVideoOverlayText').css('-webkit-text-stroke','2px #06508dbf');
                

                //set camera to default/init view and zoom in animation on the collage wall, change collage wall photo, add fade-in effect to collage wall
                setCamDefault(); 
                animateCameraToRadius(storyCamera, 20, frameCount, 500);
                change_collage_photo(stageNo);
                collage_wall.setEnabled(true);
                collage_wall.isVisible = true;
                add_delay(collage_wall,2000,5000);
            
        }else if(stageNo === 9){
                //set camera view to top of skybox/to the disc; remove collage and font stroke and assign back the orig color and shadow; create disc and add scaling animation to it
                $("#firstVideoOverlayText").css({ 'color' : '#efad0c', 'text-shadow' : '-2px 1px 10px #000000','-webkit-text-stroke': '', 'font-weight':''});
                let theDisc = init_disc(stageNo);
                currStageObjMap.set(theDisc.name, theDisc);                     //add to map so it can be deleted when continue button is clicked
                setCamInferior();
                currTimer = setTimeout(function(){
                    if(theDisc) animateObjectScaling(theDisc, 20, frameCount, new BABYLON.Vector3(1.9,1.9,1.9));
                },100);
        }else if(stageNo === 10){
                collage_wall.isVisible = false;
                //retain camera view; create disc and animate disc position
                if(currTimer) clearTimeout(currTimer);
                let theDisc = init_disc(stageNo,400);
                currStageObjMap.set(theDisc.name, theDisc);
                //set camera view to top of skybox/to the disc; remove collage and font stroke and assign back the orig color and shadow
                currTimer = setTimeout(function(){
                    if(theDisc) animateObjectPosition(theDisc, 20, frameCount, new BABYLON.Vector3(-400,1000,0));
                },1000);
        }else if(stageNo === 11){
                $('.firstVideoOverlayText').css('font-size','3vw');
                $('#firstVideoOverlayText').css('color','#1bbceb');
                $('#firstVideoOverlayText').css('-webkit-text-stroke','2px #06508dbf');
                //set camera to default/init view and zoom in animation on the collage wall, change collage wall photo, add fade-in effect to collage wall
                setCamDefault(); 
                animateCameraToRadius(storyCamera, 20, frameCount, 500);
                change_collage_photo(stageNo);
                collage_wall.isVisible = true;
                add_delay(collage_wall,2000,5000); 

                let store = init_photo(imgArr[0],{w:50,h:50},{x: -60, y: 0, z: -800},stageNo);      
                store.setEnabled(false);
                
                currStageObjMap.set(store.name, store);                                                //add the object to a map
                currTimer = setTimeout(function(){
                    store.setEnabled(true);
                    animateObjectScaling(store, 20, frameCount, new BABYLON.Vector3(20,20,5));
                },8000);
           
        }else if(stageNo === 12){
                $('.firstVideoOverlayText').css('font-size','4.2vw');
                $("#firstVideoOverlayText").css({ 'color' : '#efad0c', 'text-shadow' : '-2px 1px 10px #000000','-webkit-text-stroke': '', 'font-weight':''});
                //set camera to top view ; disable the collage wall and create disc for mbaye diagne; add fade-in animation effect to the disc
               
                setCamInferior();
                collage_wall.setEnabled(false);
                let theDisc = init_disc(stageNo,300);
                currStageObjMap.set(theDisc.name, theDisc);                     //add to map so it can be deleted when continue button is clicked    
        
        }else if(stageNo === 13){
                $('.firstVideoOverlayText').css('font-size','3vw');
                //set camera to init view ; show earth; create planes for the wire toys; animate position and scaling of planes;
                setCamDefault(500);
                earth_obj.setEnabled(true);   
                let toy1 = init_photo(imgArr[0],{w:20,h:20},{x: 0, y: 0, z: 0},stageNo);           
                let toy2 = init_photo(imgArr[1],{w:20,h:20},{x: 0, y: 0, z: 0},stageNo);
                currStageObjMap.set(toy1.name, toy1);
                currTimer = setTimeout(function(){
                    if(toy1) animateObjectPosition(toy1, 20, frameCount, new BABYLON.Vector3(150,-30,0));
                    animateObjectScaling(toy1, 20, frameCount, new BABYLON.Vector3(10,10,5));
                },100);
                currTimer = setTimeout(function(){
                    if(toy2) animateObjectPosition(toy2, 20, frameCount, new BABYLON.Vector3(-300,100,0));
                    animateObjectScaling(toy2, 20, frameCount, new BABYLON.Vector3(10,10,5));
                },1000);
                currStageObjMap.set(toy2.name, toy2);
        }
        else if(stageNo === 14){
                //set camera to top view ; create disc for pipes bending
                earth_obj.setEnabled(false);
                setCamInferior();
                let theDisc = init_disc(stageNo,300);
                currStageObjMap.set(theDisc.name, theDisc);                     //add to map so it can be deleted when continue button is clicked    
        
        }else if(stageNo === 15){
                //set camera to init view ; focus on countries?
                earth_obj.setEnabled(true);
                setCamDefault(400);
        
        }else if(stageNo === 16){
                //set camera to init view ; focus on countries?
                setCamDefault();
                change_collage_photo(stageNo);
                collage_wall.setEnabled(true);
                collage_wall.isVisible = true;
                isEarthRotating = false;
                earth_obj.position = new BABYLON.Vector3(250,-120,1100);
                earth_obj.rotation = new BABYLON.Vector3(0,-3.5,0);
                // animateObjectRotation(earth_obj, 50, 100, new BABYLON.Vector3(-0.2,2.7,0));
                currTimer = setTimeout(function(){
                    isEarthRotating = true;
                },2000);   
        }else if(stageNo === 17){
                //set camera to init view ; show collage wall
                $('#firstVideoOverlayText').css('color','#0ab7ea');
                create_snow_emitter(); 
                setCamDefault(490);
                change_collage_photo(stageNo);
                collage_wall.isVisible = true; 
                add_delay(collage_wall,100,2000); 
                collage_wall.position = new BABYLON.Vector3(0,0,1600);
                isEarthRotating = false;
                earth_obj.rotation = new BABYLON.Vector3(0,1,0.3);
                earth_obj.setEnabled(false);
                earth_obj.isVisible = false;
        }else if(stageNo === 18){
                //set camera to init view ; show collage wall
                $("#firstVideoOverlayText").css({ 'color' : '#efad0c', 'font-size':'3.5vw'});
                earth_obj.position = new BABYLON.Vector3(270,-120,500);
                // setCamDefault(900);
               
                // let temp = init_photo(imgArr[0],{w:65,h:47},{x: 250, y: -120, z: 500},stageNo);   
                // if(temp){
                //     animateObjectScaling(temp, 15, frameCount, new BABYLON.Vector3(10,10,10));
                //     animateObjectPosition(temp, 30, frameCount, new BABYLON.Vector3(0,25,0));
                // }
                //show earth
                earth_obj.setEnabled(true);
                earth_obj.isVisible = true;
                
                setCamDefault(490);
                animateCameraToRadius(storyCamera, 50, frameCount, 900);
                collage_wall.position = new BABYLON.Vector3(0,0,-1100);
                change_collage_photo(stageNo);
                collage_wall.isVisible = true; 
                add_delay(collage_wall,1000,2000); 
                
                currTimer = setTimeout(function(){
                    isEarthRotating = true;
                },3000);
        
        }else if(stageNo === 19){
                //set camera to init view ; show collage wall
                $("#firstVideoOverlayText").css({'font-size':'3vw'});
                earth_obj.setEnabled(false);
                earth_obj.isVisible = false;
                collage_wall.position = WALL_INIT_POS;
                collage_wall.isVisible = true;
                change_collage_photo(stageNo);
                add_delay(collage_wall,2000,5000); 
                setCamDefault();
            
              
                animateCameraToRadius(storyCamera, 15, frameCount, 100);
        
        }else if(stageNo === 20){
                //set camera to init view ; show collage wall
                $("#firstVideoOverlayText").css({'font-size':'4.2vw'});
                change_collage_photo(stageNo);
                collage_wall.isVisible = false; 
                setCamDefault(1000);
                currTimer = setTimeout(function(){
                    collage_wall.isVisible = true;
                    animateCameraToRadius(storyCamera, 20, frameCount, 100);
                    add_delay(collage_wall,1000,5000); 
                },1000);
       
        }else if(stageNo === 21){
                //set camera to init view ; hide collage wall; show earth; show photos
                $("#firstVideoOverlayText").css({'font-size':'3.2vw'});
                earth_obj.position = new BABYLON.Vector3(-270,-120,500);
                earth_obj.rotation = new BABYLON.Vector3(0,0,0);
                //show earth
                earth_obj.setEnabled(true);
                earth_obj.isVisible = true;
                
                setCamDefault(600);
                animateCameraToRadius(storyCamera, 50, frameCount, 900);
                isEarthRotating = true;

                let allan = init_photo(imgArr[0],{w:500,h:500},{x: 700, y: 170, z: -300},stageNo);           
                let julian = init_photo(imgArr[1],{w:500,h:500},{x: 0, y: -170, z: -300},stageNo);
                currStageObjMap.set(allan.name, allan);
                currStageObjMap.set(julian.name, julian);

                hl.addMesh(allan, new BABYLON.Color3(0,0.5,0.5));
                hl.addMesh(julian, new BABYLON.Color3(0,0.5,0.5));
                

        }else if(stageNo === 22){
                //set camera to init view ; 
                $("#firstVideoOverlayText").css({'font-size':'3.2vw'});
                setCamInferior();
                earth_obj.setEnabled(false);
                earth_obj.isVisible = false;
                let theDisc = init_disc(stageNo,300);
                currStageObjMap.set(theDisc.name, theDisc);   
                scene.meshes.forEach(function(mesh){
                        console.log(mesh.name);
                }); 

        }else if(stageNo === 23){
                //set camera to init view ;
                // $("#firstVideoOverlayText").css({'font-size':'3.2vw'});
                setCamDefault(50);
                animateCameraToRadius(storyCamera, 30, frameCount, 1300);
                

                change_collage_photo(stageNo);
                collage_wall.isVisible = true;
                // add_delay(collage_wall,2000,5000); 


        }

        // scene.meshes.forEach(function(mesh){
        //   console.log(mesh.name);
        // });
        
        
    }//end of if else

    if(currentStage===1) currentStage = 20;
    else currentStage++;
//     else currentStage++;

    
    // console.log("the scene: ", scene.meshes);
    // scene.meshes.forEach(function(mesh){console.log(mesh.name);});
}


function create_snow_emitter(){
        // Ground
        var sky = BABYLON.Mesh.CreatePlane("sky", 500, scene);
        sky.position = new BABYLON.Vector3(0, 600, -300);
        sky.isVisible = false;
        sky.scaling = new BABYLON.Vector3(10,1,10);

        

        // Create a particle system
        var particleSystem = new BABYLON.ParticleSystem("particleSys", 200000, scene);
        particleSystem.renderingGroupId = 2;
        //Texture of each particle
        particleSystem.particleTexture = new BABYLON.Texture(texturePath+"flare.png", scene);
        
        // Where the particles come from
        particleSystem.emitter = sky; // the starting object, the emitter
        particleSystem.minEmitBox = new BABYLON.Vector3(-100, 0, -100); // Starting all from
        particleSystem.maxEmitBox = new BABYLON.Vector3(100, 0, 100); // To...

        // Colors of all particles
        particleSystem.color1 = new BABYLON.Color4(1, 1, 1.0, 1.0);
        particleSystem.color2 = new BABYLON.Color4(1, 1, 1.0, 0.7);
        particleSystem.colorDead = new BABYLON.Color4(0, 0, 0.2, 0.0);

        // Size of each particle (random between...
        particleSystem.minSize = 5;
        particleSystem.maxSize = 10;

        // Life time of each particle (random between...
        particleSystem.minLifeTime = 0.3;
        particleSystem.maxLifeTime = 15;

        // Emission rate
        particleSystem.emitRate = 1000;

        // Blend mode : BLENDMODE_ONEONE, or BLENDMODE_STANDARD
        particleSystem.blendMode = BABYLON.ParticleSystem.BLENDMODE_ONEONE;

        // Set the gravity of all particles
        particleSystem.gravity = new BABYLON.Vector3(0, -9.81, 0);

        // Direction of each particle after it has been emitted
        particleSystem.direction1 = new BABYLON.Vector3(-7, -8, 3);
        particleSystem.direction2 = new BABYLON.Vector3(7, -8, -3);

        // Angular speed, in radians
        particleSystem.minAngularSpeed = 0;
        particleSystem.maxAngularSpeed = Math.PI;

        // Speed
        particleSystem.minEmitPower = 1;
        particleSystem.maxEmitPower = 3;
        particleSystem.updateSpeed = 0.02;
        
        currStageObjMap.set(sky.name,sky);
        currStageObjMap.set(particleSystem.name, particleSystem);
        // Start the particle system
        particleSystem.start();
}





  //function that will render the scene on loop
  var scene = createChapter1Scene();
  
    
  scene.executeWhenReady(function () {    
    document.getElementById("loadingScreenDiv").style.display = "none";
    document.getElementById("loadingScreenPercent").style.display = "none";
    $('.firstVideoOverlayText').css('display', 'block');

    rotate_sky();                                                   //start rotating the sky
    currentStage = 1;
    setup_stage(1);                                                 //start showing the script 1, stage 1
    
    engine.runRenderLoop(function(){
      if(scene){
          scene.render();
      }
    });//end of renderloop

    window.addEventListener("resize", function () {
      engine.resize();
    });
  });



//   //if continue button is clicked
//   $('#continueBtn').on('click',function(evt){
//     // if(currentStage <= 23){

//         $('#continueBtnDiv').css('visibility','hidden');
//         setup_stage(currentStage);
//     // }else{
//     //     let url = window.location.origin;
//     //     window.open(url+'/storyMbaye/2','_self');
//     // }
    
    
//     //console.log("continue button is clicked");
//   });

//if continue button is clicked
$('#continueBtn').on('click',function(evt){
        if(currentStage <= 23){
    
            $('#continueBtnDiv').css('visibility','hidden');
            setup_stage(currentStage);
        }else{
            let cNo = 2;
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