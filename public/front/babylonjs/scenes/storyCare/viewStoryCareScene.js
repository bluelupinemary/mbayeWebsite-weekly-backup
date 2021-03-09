
let canvas;
let engine;
// let theAstroFace;
// let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let insCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,target:null, upperA:null, lowerA:null, upperB:null, lowerB:null};
// let astroInitState = {x:0,y:0,z:0};
// let hl,starColor;
//s = start of animation, e = end of animation
let prevNextMap = new Map([
    ['open',{l:null,r:'next1'}],
    ['next1',{l:'left2',r:'next3'}], 
    ['next3',{l:'left4',r:'next5'}], 
    ['next5',{l:'left6',r:'next7'}], 
    ['next7',{l:'left8',r:'next9'}], 
    ['next9',{l:'left10',r:'next11'}], 
    ['next11',{l:'left12',r:'next13'}], 
    ['next13',{l:'left14',r:'next15'}],
    ['next15',{l:'left16',r:'next17'}], 
    ['next17',{l:'left18',r:'close'}],

    ['left2',{l:'open',r:'next1'}],
    ['left4',{l:'left2',r:'next3'}], 
    ['left6',{l:'left4',r:'next5'}], 
    ['left8',{l:'left6',r:'next7'}],
    ['left10',{l:'left8',r:'next9'}],
    ['left12',{l:'left10',r:'next11'}],
    ['left14',{l:'left12',r:'next13'}], 
    ['left16',{l:'left14',r:'next15'}], 
    ['left18',{l:'left16',r:'next17'}],
]);

let bookAnimationMap = new Map([
    ['open',{s:0,e:1.5}],
    ['next1',{s:1.5,e:3}], 
    ['next3',{s:3.5,e:5.2}], 
    ['next5',{s:5.3,e:7}], 
    ['next7',{s:7.1,e:9.1}], 
    ['next9',{s:9.2,e:11}], 
    ['next11',{s:11.5,e:13}],
    ['next13',{s:13.5,e:15.3}],
    ['next15',{s:15.5,e:17.3}],
    ['next17',{s:17.5,e:19.3}],

    ['left2',{s:3,e:1.5}], 
    ['left4',{s:5.2,e:3.5}],
    ['left6',{s:7,e:5.3}], 
    ['left8',{s:9.1,e:7.1}], 
    ['left10',{s:11,e:9.2}], 
    ['left12',{s:13,e:11.5}], 
    ['left14',{s:15.3,e:13.5}], 
    ['left16',{s:17.3,e:15.5}], 
    ['left18',{s:19.3,e:17.5}], 
    ['close',{s:19.7,e:21.7}]
]);

let createStoryCareScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("../front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
  
    sceneSkybox = create_skybox();  
    insCamera = create_camera();
    hemiLight = create_light();
   
    create_planets();
    create_planet_labels();


    return scene;
}


// //############################################# CREATE THE SCENE'S CAMERAS #############################################//
// //function to add the camera to the scene
function create_camera(){
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-513.412,178.501,216.138),scene);
    
    //zoom in/out speed; speed - lower numer, faster zoom in/out  {x: 7793166649, y: 30.553155515922136, z: 51.91456022076615}
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.attachControl(canvas,true);
    camera.upperAlphaLimit = 1000;                  //up down tilt upper limit
    camera.lowerRadiusLimit = 1;                    //zoom in limit
    camera.upperRadiusLimit = 1300;                 //zoom out limit
    camera.wheelPrecision = 3;                      //wheel scroll speed; lower number faster
    camera.panningSensibility = 100;               //movment of camera when right mouse is clicked; lower number, faster
    camera.target = new BABYLON.Vector3(0,0,0);     //focus the camera on 0,0,0
    camera.panningDistanceLimit = 1500;             //maximum allowable movement via right mouse button
    camera.pinchPrecision = 10;
    // camera.wheelDeltaPercentage = 100;
    camera.maxZ = 28000;
    camera.alpha = 127.21;
    camera.beta = 72.26;
    camera.radius = 500;


    

    return camera;
}//end of create camera function

// //############################################# CREATE THE SCENE'S LIGHTS #############################################//
// //function to add light to the scene
function create_light(){
    let light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,0,30), scene);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.radius = 500;
    light.intensity = 0.8;
    light.specular = new BABYLON.Color3(0,0,0);
    light.groundColor = new BABYLON.Color3(0,0,0);
    return light;
    
}//end of create light function


// //############################################# CREATE THE SCENE'S SKYBOX #############################################//
// //function to create the scene's skybox
function create_skybox(){ 
    let skybox = BABYLON.MeshBuilder.CreateBox("contactSkybox", {size:25000.0}, scene);
    skybox.position = new BABYLON.Vector3(0, 100, 1000);
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    let skyboxMaterial = new BABYLON.StandardMaterial("contactSkyboxMaterial", scene);
    skyboxMaterial.backFaceCulling = false;

    let files = [   
      "../front/finalSkybox/px.png",  
      "../front/finalSkybox/py.png",  
      "../front/finalSkybox/pz.png",  
      "../front/finalSkybox/nx.png",  
      "../front/finalSkybox/ny.png",   
      "../front/finalSkybox/nz.png",
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


// //############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let earth_submeshes = new Map();
let theBook;
let bookTask;
let viewIcon, leftIcon, rightIcon, imagesLeftIcon, imagesRightIcon, videosLeftIcon, vidoesRightIcon;
let earth_object;
let viewBookIcon;
let theBookCover;
function load_3D_mesh(){
  
    var loadedPercent = 0;
    Promise.all([
      BABYLON.SceneLoader.ImportMeshAsync(null, "../front/objects/storyCareScene/", "storyCareBook19.glb", scene,
              function (evt) {
                  // onProgress
                  if (evt.lengthComputable) {
                      loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                  } else {
                      var dlCount = evt.loaded / (1024 * 1024);
                      loadedPercent += (Math.floor(dlCount * 100.0) / 100.0);
                  }
                  if(loadedPercent > 0 && loadedPercent < 100) document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
          
              }).then(function (result) {
            
            bookTask = result;
            theBook = result.meshes[0];

            theBook.scaling = new BABYLON.Vector3(0.4,0.4,-0.4);

            // theBook.position = new BABYLON.Vector3(-40.2090,17.0245,33.2045);            
            theBook.position = new BABYLON.Vector3(-200.069,-4.626,162.992);  
            theBook.rotationQuaternion = new BABYLON.Quaternion(-0.1428,0.8608,0.2685,0.4063);
          
            let ctr = 1;
            result.meshes.forEach(function(m) {
                // // console.log("part: ", m.name);
                

                //dispose the current material of the page and create new one
                if(m.material && bookPagesMap.has(m.name)){ 
                    if(m.name === 'page1' || m.name === 'page3' || m.name === 'page5' || m.name === 'page7' || m.name === 'page9' || m.name === 'page11' || m.name === 'page17' || m.name === 'page19'){
                        m.material.albedoTexture = new BABYLON.Texture('../front/textures/storyCare/story.jpg', scene); 
                    }else if(m.name === 'page2' || m.name === 'page4' || m.name === 'page6' || m.name === 'page8' || m.name === 'page9' || m.name === 'page10' || m.name === 'page16' || m.name === 'page18'){
                        m.material.albedoTexture = new BABYLON.Texture('../front/textures/storyCare/photos.jpg', scene); 
                    }else if(m.name === 'page12' || m.name === 'page13' || m.name === 'page14' || m.name === 'page15'){
                        m.material.albedoTexture = new BABYLON.Texture('../front/textures/storyCare/videos.jpg', scene); 
                    }else{
                        m.material.albedoTexture = new BABYLON.Texture('../front/textures/storyCare/free.jpg', scene); 
                    }
                    
                    m.material.albedoTexture.uScale = -2;
                    m.material.albedoTexture.vScale = 1.5;
                    bookPagesMap.set(m.name,m);
                }else if(bookPrevBtnsMap.has(m.name)){
                    m.material.albedoTexture = new BABYLON.Texture("../front/images3D/icons/prev.png", scene);
                    m.material.opacityTexture = new BABYLON.Texture("../front/images3D/icons/prev.png", scene);
                    m.material.transparencyMode = null;
                    if(m.name === 'left4' || m.name === 'left6' || m.name === 'left8' || m.name==='left12' || m.name === 'left14'){
                        m.material.albedoTexture.uScale = -1;
                        m.material.albedoTexture.vScale = -1;
                        m.material.opacityTexture.uScale = -1; 
                        m.material.opacityTexture.vScale = -1; 
                    }else if(m.name === 'left10'  || m.name === 'left18'){
                        m.material.albedoTexture.vScale = -1;
                        m.material.opacityTexture.vScale = -1; 
                    }else if(m.name === 'left16'){
                        m.material.albedoTexture.vScale = -1;
                        m.material.opacityTexture.vScale = -1; 
                    }
                }else if(bookNextBtnsMap.has(m.name)){
                    m.material.albedoTexture = new BABYLON.Texture("../front/images3D/icons/next.png", scene);
                    m.material.opacityTexture = new BABYLON.Texture("../front/images3D/icons/next.png", scene);
                    m.material.transparencyMode = null;
                    m.material.albedoTexture.vScale = -1;
                    m.material.opacityTexture.vScale = -1;
                  
                }else if(bookStoryPlanes.has(m.name)){
                    if(m.name === "plane11") m.position = new BABYLON.Vector3(99.89,0.8,9.342);
                    else if(m.name === "plane18"){
                        if(m.getClassName() == "InstancedMesh") {
                            const newMesh = m.sourceMesh.clone(m.name, m.parent)
                            newMesh.position = m.position.clone();
                            newMesh.rotation = m.rotation.clone(); 
                            newMesh.scaling = m.scaling.clone();
                            newMesh.parent = m.parent;
                            m.dispose()
                        }
                    }else if(m.name === "plane19") m.position = new BABYLON.Vector3(97.341,0.859,9.341);
                    m.isVisible = false;
                    bookStoryPlanes.set(m.name,m);
                }else if(bookPhotoPlanes.has(m.name)){
                    if(m.name === 'photo8' || m.name === 'photo2' || m.name === 'photo3' || m.name === 'photo4'|| m.name === 'photo5' || m.name === 'photo6' || m.name === 'photo7'|| m.name === 'photo9' || m.name === 'photo10' || m.name === 'photo11' || m.name === 'photo13' || m.name === 'photo14' || m.name === 'photo15' || m.name === 'photo16' || m.name === 'photo17'){
                        m.material.albedoTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere8.png", scene);
                        m.material.opacityTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere8.png", scene);
                        m.material.name = "imageHere";
                    }else if( m.name === 'photo12'){
                        m.material.albedoTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere12.png", scene);
                        m.material.opacityTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere12.png", scene);
                        m.material.name = "imageHere";
                    }else{
                        m.material.albedoTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere2.png", scene);
                        m.material.opacityTexture = new BABYLON.Texture("../front/images3D/storyCareScene/imageHere2.png", scene);
                        m.material.name = "imageHere";
                    }
                    m.material.transparencyMode = null;
                    bookPhotoPlanes.set(m.name,m);
                }else if(bookVideoPlanes.has(m.name)){
                    if(m.name === 'video1' || m.name === 'video2' || m.name === 'video5' || m.name === 'video6'){
                        m.material.albedoTexture = new BABYLON.Texture("../front/images3D/storyCareScene/videoHere2.png", scene);
                        m.material.opacityTexture = new BABYLON.Texture("../front/images3D/storyCareScene/videoHere2.png", scene);
                    }else{
                        m.material.albedoTexture = new BABYLON.Texture("../front/images3D/storyCareScene/videoHere.png", scene);
                        m.material.opacityTexture = new BABYLON.Texture("../front/images3D/storyCareScene/videoHere.png", scene);
                    }
                    m.material.name = "videoHere";
                    m.material.transparencyMode = null;
                    bookVideoPlanes.set(m.name,m);
                    // m.link = '';
                }
                
                if(m.name === "bookCover"){
                    theBookCover = m;
                    m.isPickable = false;
                    hemiLight.excludedMeshes.push(m);
                }
                
            });
  }),
      ]).then(() => {
        add_mouse_listener();
        earth_object = init_planet2("earth","earthMatl","front/textures/home/planets/earth.jpg","front/textures/home/planets/earthnormal.png",11,10,-15,50);
        bookTask.animationGroups[0].stop();
        storyCareOuter = init_planet2("goFundMeLabel","goFundMeLabelMatl","front/textures/home/planets/goFundMeLabel.png","",11,10,-15,55);
        animatePlanetRotation(storyCareOuter,5,200,new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360),0));

        // scene.debugLayer.show();

        viewBookIcon = init_plane('viewBookIcon','../front/images3D/icons/view.png',5,5,{x:-190.137,y:-5.334,z:199.981},{x:0.2203,y:0.8421,z:-0.3993,w:0.2876});
        viewBookIcon.actionManager = new BABYLON.ActionManager(scene);
        viewBookIcon.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet)
        );
        viewBookIcon.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet)
        );

        insCamera.position = new BABYLON.Vector3(-389.4888,97.0194,298.9656);
        insCamera.alpha = 2.4446;
        insCamera.beta = 1.3335;
        insCamera.target = new BABYLON.Vector3(-22.4299,-47.3962,-5.1459);
        insCamera.radius = 1300;

        cameraInitState.position = new BABYLON.Vector3(-354.0642,83.0819,269.6160);
        cameraInitState.a =  2.4497;
        cameraInitState.b = 1.2766;
        cameraInitState.upperA = insCamera.upperAlphaLimit;
        cameraInitState.lowerA = insCamera.lowerAlphaLimit;
        cameraInitState.upperB = insCamera.upperBetaLimit;
        cameraInitState.lowerB = insCamera.lowerBetaLimit;
        cameraInitState.target = new BABYLON.Vector3(-22.4299,-47.3962,-5.1459);    

        // scene.debugLayer.show();
    });
}//end of load design meshes

function init_planet2(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    let temp = BABYLON.Mesh.CreateSphere(name, 0, radius, scene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(5,5,5);
    let temp_material = new BABYLON.StandardMaterial(material_name,scene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, scene);
    
    // temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp.material = temp_material;

    if(name === "goFundMeLabel"){
        // temp_material.diffuseColor = BABYLON.Color3.Red();
        temp_material.opacityTexture = new BABYLON.Texture(texture_path, scene);
        temp.material.hasAlpha = true;
        temp.isPickable = false;
    }else{
        temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,scene);

        temp.actionManager = new BABYLON.ActionManager(scene);
        temp.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet)
        );
        temp.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet)
        );
    }
    
    

    return temp;
}//end of init planet function




let homeGizmo,homeGizmo2;
function enable_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(scene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;
}






//############################################# HANDLE USER'S INTERACTION #############################################//
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

let isPlane2Selected = false;
let isLaunchEnabled = false;
let imgCtr = 0;

function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
        //   console.log("the mesh clicked: ", theMesh,theMesh.name, theMesh.position, theMesh.rotationQuaternion);
        //   console.log("camera: ", insCamera.position, insCamera.alpha, insCamera.beta, insCamera.radius, insCamera.target);
        // console.log("material name: ", theMesh.material.name);
          let substr = theMesh.name.substring(0, 4);

          if(theMesh.name === 'viewBookIcon'){
                focusOnBook(isBookZoomed);
                isBookZoomed = !isBookZoomed;
          }else if(substr === 'left'){
                bookPrevPage2(theMesh.name);
          }else if( substr === 'next'){
                bookNextPage2(theMesh.name);
          }else if(bookVideoPlanes.has(theMesh.name)){
              console.log("themesh link", theMesh.link);
                if(theMesh.link != 'undefined' && theMesh.link != '' && theMesh.link != null) load_music(theMesh.link,1);
          }


          if(planetsLinkTextMap.has(theMesh.name)){
            let res = planetsLinkTextMap.get(theMesh.name);
            evt.preventDefault();
            checkScreenAndDoubleClick(res);
         }

         if(theMesh.name === "earth" && story_gofundme != null){
            evt.preventDefault();
            res = ['GoFundMe',story_gofundme]
            checkScreenAndDoubleClick(res);
         }

         if((has_story === 'false' || !has_story) && theMesh === theBookCover){
            alert_no_story();
         }

         if(bookPhotoPlanes.has(theMesh.name) && theMesh.material.name === "imageHere" && isAuthUser){
            evt.preventDefault();
            res = ['Communicator','communicator?action=edit_storyofcare&section=storyofcare']
            checkScreenAndDoubleClick(res);
         }

         if(bookVideoPlanes.has(theMesh.name) && theMesh.material.name === "videoHere" && isAuthUser){
            evt.preventDefault();
            res = ['Communicator','communicator?action=edit_storyofcare&section=storyofcare']
            checkScreenAndDoubleClick(res);
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


  //remove the text span on dispose
  scene.onDispose = function() {
      //related to the drag and drop
      canvas.removeEventListener("pointerdown", onPointerDownVisit);
      canvas.removeEventListener("pointerup", onPointerUpVisit);
      canvas.removeEventListener("pointermove", onPointerMoveVisit);
  };
}//end of listen to mouse function

/*################################################### END OF MOUSE EVENT FUNCTION ############################################## */


let isBookZoomed = false;
function focusOnBook(isFocused){
    if(!isFocused){
        insCamera.target = new BABYLON.Vector3(-118.0403,-153.7473,65.0928);
        insCamera.position = new BABYLON.Vector3(-298.1260,125.3651,182.4755);
        insCamera.alpha = 2.4430;
        insCamera.beta = 0.6587;
        insCamera.upperAlphaLimit = insCamera.lowerAlphaLimit = 2.4430;
        insCamera.upperBetaLimit = insCamera.lowerBetaLimit = 0.6587;
        insCamera.radius = 360;
        
    }else{
        insCamera.position = cameraInitState.position;
        insCamera.radius = cameraInitState.radius;
        insCamera.target = cameraInitState.target;
        insCamera.alpha = cameraInitState.a;
        insCamera.beta = cameraInitState.b;
        insCamera.upperAlphaLimit = cameraInitState.upperA;
        insCamera.lowerAlphaLimit = cameraInitState.lowerA;
        insCamera.upperBetaLimit = cameraInitState.upperB;
        insCamera.lowerBetaLimit = cameraInitState.lowerB;
    }
}

// let bookAnimationMapNext = new Map(
//     [1,{s:2,e:4}],
// );

// let bookAnimationMapPrev = new Map(
//     [1,{s:4,e:6}],
// );



//material flipping, page no params
function flipTexture(val,pageNo){
    let res = bookPagesMap.get(pageNo);
    
    setTimeout(function(){
        res.material.albedoTexture.uScale = val;
    },1200);
}

//animation start and end params
function playAnimation(){
    // console.log('playing the animation for ', bookTask.animationGroups[0]);
    let anim = bookAnimationMap.get(currentPage);
    if(bookTask.animationGroups[0].isPlaying) bookTask.animationGroups[0].stop();
    bookTask.animationGroups[0].start(false, 0.7,anim.s,anim.e, false);    
}

let currentPage;
let photo_count_idx=0;


function startBookAnimation(type, isLongStory, btnType){
    // console.log('start book animation ', type, isLongStory);
    //goes here if parts are repeating because stories need to be repeating
    if(type === 'right'){
        if(isLongStory){
            // console.log("story count: ", story_count_idx);
            // console.log("next story clicked in long story if part");
            // console.log("isMiddleBookRepeatingForPhotos",isMiddleBookRepeatingForPhotos);
            next_story_plane();
           
            currentPage = 'next5';
            playAnimation();
        }else{
            // console.log("im in long story else part. stopped counting story count idx at: ", story_count_idx);
            
            let goNextPage = check_photos_left(btnType);
            if(goNextPage) currentPage = prevNextMap.get(currentPage).r;
            else currentPage = 'next5';
            playAnimation();
        }
        // console.log("the prev page map: ", prevPagesMap, "the counter ", prevPageMapCtr);
        
    }else if(type === 'left'){
        if(isLongStory){
            // console.log("LEFT: story clicked in long story if part");
            // console.log("story count: ", story_count_idx);
            left_story_plane();
            currentPage = 'left6';
            playAnimation();
        }else{
            // // console.log("im in long story else part. stopped counting story count idx at: ", story_count_idx);
            // currentPage = prevNextMap.get(currentPage).l;
            let goPrevPage = check_photos_left2(btnType);
            if(goPrevPage) currentPage = prevNextMap.get(currentPage).l;
            else currentPage = 'left6';
            playAnimation();
        }
    }
}

 

async function bookOpenPage(){
    // currentPage = 'open';
    // playAnimation();
    
    // isBookFocused = true;
    // insCamera.radius = 40;

    await set_pages_to_map();
    loadFonts();

    
    // insCamera.detachControl(canvas);

    // scene.debugLayer.show();
    // viewIcon.isVisible = true;
    // rightIcon.isVisible = true;
    // rightIcon.isPickable = true;
    // // storyPlane.isVisible = true;
    // // add_delay(storyPlane, 3000, 3000);
    // // add_delay(viewIcon,3000,2000);
    // add_delay(rightIcon,1000,2000); 
    // enable_gizmo(rightIcon);
}








// handle next page of book flipping
function bookNextPage(nextBtn){
    //isMiddleBookRepeating is true only when stories length > 8
    if(isMiddleBookRepeating && (nextBtn === 'next7' || nextBtn === 'next5') && story_count_idx < story_content_arr.length-4) startBookAnimation('right',true,nextBtn);
    else startBookAnimation('right',false, nextBtn);
}

//handle prev page of book flipping
function bookPrevPage(leftBtn){
    //isMiddleBookRepeating is true only when stories length > 8
    if(isMiddleBookRepeating && (leftBtn === 'left6' || leftBtn === 'left8' || leftBtn === 'left4') && story_count_idx >= 3 && isNextStarted) startBookAnimation('left',true,leftBtn);
    else startBookAnimation('left',false,leftBtn);
}


/*################################### START OF FORM ##################################################################*/
let panelPlane, imagesPlane;
let videosInitPlanes = new Map();
let bookPlanesMap = new Map([
   
]);
let bookPagesMap = new Map([
    ['page1',null],
    ['page2',null],
    ['page3',null],
    ['page4',null],
    ['page5',null],
    ['page6',null],
    ['page7',null],
    ['page8',null],
    ['page9',null],
    ['page10',null],
    ['page11',null],
    ['page12',null],
    ['page13',null],
    ['page14',null],
    ['page15',null],
    ['page16',null],
    ['page17',null],
    ['page18',null],
    ['page19',null],
    ['page20',null],
]);

let bookNextBtnsMap = new Map([
    ['next1',null],
    ['next3',null],
    ['next5',null],
    ['next7',null],
    ['next9',null],
    ['next11',null],
    ['next13',null],
    ['next15',null],
    ['next17',null],
    ['next19',null],
]);

let bookPrevBtnsMap = new Map([
    ['left2',null],
    ['left4',null],
    ['left6',null],
    ['left8',null],
    ['left10',null],
    ['left12',null],
    ['left14',null],
    ['left16',null],
    ['left18',null],
]);


let bookStoryPlanes = new Map([
    ['plane1',null],
    ['plane3',null],
    ['plane5',null],
    ['plane7',null],
    ['plane9',null],
    ['plane11',null],
    ['plane18',null],
    ['plane19',null],
]);

let bookPhotoPlanes = new Map([
    ['photo1',null],
    ['photo2',null],
    ['photo3',null],
    ['photo4',null],
    ['photo5',null],
    ['photo6',null],
    ['photo7',null],
    ['photo8',null],
    ['photo9',null],
    ['photo10',null],
    ['photo11',null],
    ['photo12',null],
    ['photo13',null],
    ['photo14',null],
    ['photo15',null],
    ['photo16',null],
    ['photo17',null],
]);

let bookVideoPlanes = new Map([
    ['video1',null],
    ['video2',null],
    ['video3',null],
    ['video4',null],
    ['video5',null],
    ['video6',null],
    ['video7',null],
    ['video8',null]
]);


let storyPlanesSeq = ['plane1','plane3','plane5','plane7','plane9','plane11','plane18','plane19'];






function show_video_links(isActive){
    for(const [key,val] of videosInitPlanes.entries()){
        val.isVisible = isActive;
        if(isActive){
            add_delay(val,500,2000);
        }else{
            animateObjectFadeOut(val,130,200,0);
        }
    }

}


var animateObjectFadeOut = function(obj, speed, frameCount, visibility) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('objVisible', obj, 'visibility', speed, frameCount, obj.visibility, visibility, 0, null, fadeOutAnimEnded);
}

var animateObjectPositionNoEase = function(obj, speed, frameCount, newPos,alpha, beta) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);

    BABYLON.Animation.CreateAndStartAnimation('objPos', obj, 'position', speed, frameCount, obj.position, newPos, 0, null);
}

var animateObjectRotation = function(obj, speed, frameCount, newRot, isLooping) {
    // var ease = new BABYLON.CubicEase();
    // ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('objPos', obj, 'rotation', speed, frameCount, obj.rotation, newRot, isLooping);
}

var animateCameraToRadius = function(cam, speed, frameCount, newRad) {
    var ease = new BABYLON.CubicEase();
    ease.setEasingMode(BABYLON.EasingFunction.EASINGMODE_EASEINOUT);
    BABYLON.Animation.CreateAndStartAnimation('at4', cam, 'radius', speed, frameCount, cam.radius, newRad, 0, ease, radiusAnimEnded);
}


var radiusAnimEnded = function() {
    if(has_story === 'true'){
        bookOpenPage();
        add_delay(viewBookIcon, 3000, 5000);
        viewBookIcon.isVisible = true;
    }

}



var fadeOutAnimEnded = function() {
    if(this.target.name === "right" && currentPage != "open"){
        rightIcon.visibility = 1;
        leftIcon.visibility = 1;
    }
        if(this.target.name === "left" && currentPage === "next5"){
            // console.log("left and next5");
            rightIcon.visibility = 1;}
        if(this.target.name === "right" && currentPage === "next5"){
            // console.log("right and next5");
            rightIcon.visibility = 0;}
    
    if(this.target.name === "left" && currentPage == "prev1"){
        leftIcon.isVisible = false;
    }
}




function show_images_panel(){
    let plane2Matl = new BABYLON.StandardMaterial("imagesPanel", scene);
    plane2Matl.diffuseTexture = new BABYLON.Texture("../storage/saveState/designPanel/screenshots/3_P2_5_img.jpg", scene);
    plane2Matl.backFaceCulling = false;
    imagesPlane.material = plane2Matl;
}

let videoLinksMap = new Map([
    [1,['this is the link content 1',{x:-46.117,y:27.437, z:27.319}]],
    [2,['this is the link content 2',{x:-47.113,y:24.739, z:28.132}]],
    [3,['this is the link content 3',{x:-48.053,y:22.120, z:28.950}]],
    [4,['this is the link content 4',{x:-49.043,y:19.442, z:29.755}]],
    [5,['this is the link content 5',{x:-49.979,y:16.910, z:30.515}]]
]);




function show_designed_panel(){
    let plane2Matl = new BABYLON.StandardMaterial("designedPanel", scene);
    plane2Matl.diffuseTexture = new BABYLON.Texture("../storage/img/story_of_care/"+story_featured_img, scene);
    plane2Matl.backFaceCulling = false;
    panelPlane.material = plane2Matl;
    panelPlane.isVisible = true;

    add_delay(panelPlane, 2000, 2000);
}



function load_image(val){
    // console.log("imgctr: ",val);
    if(val < attached_images_arr.length && val >= 0){
        // if(imagesPlane.material) imagesPlane.material.dispose();

        let tempMatl = new BABYLON.StandardMaterial(val+"Matl", scene);
        tempMatl.diffuseColor = new BABYLON.Color3(1,1,1);
        tempMatl.diffuseTexture = new BABYLON.Texture(attached_images_arr[val], scene);
        var sizearray = tempMatl.diffuseTexture._texture;
        // console.log("image size", sizearray);
        tempMatl.opacityTexture = new BABYLON.Texture(attached_images_arr[val], scene);
        tempMatl.backFaceCulling = false;
        tempMatl.diffuseTexture.hasAlpha = true;

        imagesPlane.material = tempMatl;
        // console.log("theMatl", imagesPlane.material);
    }
}


function init_plane(name,matlPath,w, h,pos, rot){
    let temp = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, scene);
   
    let tempMatl = new BABYLON.StandardMaterial(name+"Matl", scene);
    tempMatl.diffuseColor = new BABYLON.Color3(1,1,1);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, scene);
    tempMatl.opacityTexture = new BABYLON.Texture(matlPath, scene);
    tempMatl.backFaceCulling = false;
    tempMatl.diffuseTexture.hasAlpha = true;
   
    temp.position = new BABYLON.Vector3(pos.x, pos.y, pos.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y, rot.z, rot.w);
    if(name === "viewBookIcon") temp.scaling = new BABYLON.Vector3(3,3,1);
    // temp.isPickable = false;
    temp.isVisible = false;

    temp.material = tempMatl;

    return temp;
}


function init_video_link_plane(name,link,pos){
    var font_type = "Arial";
	//Set width an height for plane
    var planeWidth = 14.5;
    var planeHeight = 2.5;
    //Create plane
    var plane = BABYLON.MeshBuilder.CreatePlane(name, {width:planeWidth, height:planeHeight}, scene);
    plane.position = new BABYLON.Vector3(pos.x, pos.y, pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(-0.0974,-0.8863,0.1977,-0.4069);
    plane.isPickable = true;

    //Set width and height for dynamic texture using same multiplier
    var DTWidth = planeWidth * 60;
    var DTHeight = planeHeight * 60;

    //Set text
    var text = "youtube.com/v=123dslasdf/song-title";
    
    //Create dynamic texture
    var dynamicTexture = new BABYLON.DynamicTexture(name+"Matl", {width:DTWidth, height:DTHeight}, scene);

    //Check width of text for given font type at any size of font
    var ctx = dynamicTexture.getContext();
	var size = 12; //any value will work
    ctx.font = size + "px " + font_type;
    var textWidth = ctx.measureText(text).width;
    
    //Calculate ratio of text width to size of font used
    var ratio = textWidth/size;
	
	//set font to be actually used to write text on dynamic texture
    var font_size = Math.floor(DTWidth / (ratio * 1)); //size of multiplier (1) can be adjusted, increase for smaller text
    var font = font_size + "px " + font_type;
	
	//Draw text
    dynamicTexture.drawText(text, null, null, font, "#000000", false, true);

    //create material
    var mat = new BABYLON.StandardMaterial("mat", scene);
    
    mat.diffuseTexture = dynamicTexture;
    mat.opacityTexture = dynamicTexture;
   
    //apply material
    plane.material = mat;
    mat.diffuseTexture.hasAlpha = true;

    return plane;
}


function show_story_care(count,storyPlane,content,fontFamily){
        // console.log("storyPlane ",storyPlane);
        
        var advancedTexture2 = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(storyPlane);
        // storyPlane.isPickable = false;

        // var advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(storyPlane);
        var sv = new BABYLON.GUI.ScrollViewer("sv"+count);
        sv.width = 1;
        sv.height = 1;
        sv.thickness = 0.2;
        sv.barColor = "#834d27";
        sv.thumbLength = 0.2;
        sv.thumbHeight = 0.1;
        sv.verticalBar.border = 1;
        sv.barSize = 70;
        sv.ignoreLayoutWarnings = true
        sv.adaptHeightToChildren = true;
        // sv.background = 'red';
      


       advancedTexture2.addControl(sv);
        // console.log('create plane',advancedTexture, "sv: ", sv);
       
       
        var tb = new BABYLON.GUI.TextBlock();
        tb.textWrapping = BABYLON.GUI.TextWrapping.WordWrap;
        tb.resizeToFit = true;
        tb.paddingTop = "1%";
        tb.paddingLeft = "30px";
        tb.paddingRight = "20px"
        tb.paddingBottom = "4%";
        tb.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
        tb.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
        tb.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
        tb.textVerticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
        tb.color = "#2a290b";
        tb.fontFamily = fontFamily;
        tb.fontSize = "42px";   
        if(count === 0) tb.text = "TITLE: "+story_title+"\nBY: "+user_name+"\n\n"+content;
        else tb.text = content;

        sv.isEnabled = true;
        sv.isPickable = true;

       
        sv.addControl(tb);
        // sv.onPointerEnterObservable.add(function() {
        //     // insCamera.attachControl(canvas,true);
        //     console.log('up sv'+sv.name);
        // });
        // sv.onPointerOutObservable.add(function() {
        //     // insCamera.attachControl(canvas,true);
        //     console.log('up sv'+sv.name);
        // });
        
        // console.log("sv",sv);
      
 
}


var createLink = function(fontFamily) {
			
    var headID = document.head;
    var link = document.createElement('link');
    link.rel = 'stylesheet';
            
    headID.appendChild(link);
    link.href = 'https://fonts.googleapis.com/css?family=' + fontFamily;
}

var loadFonts = function() {

	jQuery.getScript('https://cdnjs.cloudflare.com/ajax/libs/fontfaceobserver/2.0.1/fontfaceobserver.js', function () {

		var font = new FontFaceObserver("Charm");
        createLink(font.family);

		font.load().then(function () {
            create_story_plane2(font.family);
            currentPage = 'open';
            playAnimation();
            // isBookFocused = true;
            
		});
		
	});

}


function alert_no_story(){
    Swal.fire({
        title: 'It seems that you haven\'t posted your Story of Care yet, do you want to submit one now?',
        imageUrl: '../../front/icons/alert-icon.png',
        imageWidth: '10vw',
        imageHeight: 'auto',
        imageAlt: 'Warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Create Story of Care',
        width: '20%',
        padding: '1rem',
        background: 'rgba(8, 64, 147, 0.62)',
        
    }).then((result) => {
        if (result.value) {
           window.location.href = urlCommunicator; 
        }
    });
}



// let delayManager;
function add_delay(theMesh,delaytime,fadetime){
    let delayManager = new BABYLON.FadeInOutBehavior();
    delayManager.attach(theMesh);
    delayManager.fadeIn(true);
    delayManager.delay = delaytime;
    delayManager.fadeInTime = fadetime;
}


var story_title;
var story_content;
var story_featured_img;
var story_panel_no;
var story_images;
var story_videos;
var attached_images_arr;
var story_gofundme;
var attached_videos_arr = [];
var story_content_arr = [];
var story_count_idx=0;
var isAuthUser = false;
var story_status = {'story':false, 'photos':false, 'videos':false};

$( document ).ready(function() {
    
    testOrientation();
   
    
    //function that will render the scene on loop
    var theScene = createStoryCareScene();
    
    //scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(theScene, options);

    
        

    theScene.executeWhenReady(function () {   
        setup_music_player();
        // storyCareLbl.setParent(earth_object);
        animateCameraToRadius(insCamera, 30, 200, 450);
        // animateCameraToRadius(insCamera, 100, 200, 450);
        
        // loadFonts();
        
        if(has_story === 'true'){
            story_title = user_story['name'];
            story_content = user_story['content'];
            story_featured_img = '../storage/img/story_of_care/'+user_story['featured_image'];
            story_panel_no = user_story['panel_number'];
            story_images = user_story['images'];
            story_videos = user_story['videos'];
            attached_images_arr = [];
            story_gofundme = user_story['go_fund_me_link'];
            story_images.forEach(function(img){
                attached_images_arr.push('../storage/img/storyofcare_attachments/'+img['imageurl']);
                // console.log("the image: ", img);
            });
            

            story_videos.forEach(function(vid){
                attached_videos_arr.push(vid.videourl);
            });
            
            if(auth_id === user_id) isAuthUser = true;

            
            //divide the story of care into several parts
            let num_entries = Math.ceil(story_content.length / 500);
            let start=0;
            let end = 500;
            let multiple = 500;
            for(i=0;i<num_entries;i++){
                story_content_arr.push(story_content.substring(start, end));
                start += multiple;
                end += multiple;
            }

            // create_book_pages();

            //create the first 4 photos if possible
            // create_photo_plane();
        }else{
            theBookCover.isPickable = true;
            alert_no_story();
            
        }
       

        $("#loadingScreenPercent").css('visibility', 'hidden');
        $("#loadingScreenPercent").html("Loading: 0 %");
        $("#loadingScreenDiv").remove();
        $("#loadingScreenOverlay").html('display', 'block');

        // bookOpenPage();
       

        // scene.debugLayer.show();
    
        
        // show_images_panel();
        // show_videos_panel
        
        engine.runRenderLoop(function(){
            if(theScene){
                theScene.render();
                if(earth_object){
                    earth_object.rotation.y = Math.PI / 2;
                    earth_object.rotate(new BABYLON.Vector3(0,4,0), -0.005, BABYLON.Space.LOCAL);
                }
                
            }
            
        });//end of renderloop
    });//end of executeready


});//end of document ready

window.addEventListener("resize", function () {
    engine.resize();
    testOrientation();
    testFullscreen();
});



window.addEventListener("orientationchange", function(event) {
    testOrientation();
}, false); 






//##################################################################################################################

let allPagesMap = new Map();
let allPagesCtr = 1;
let globalRepeatTimes;
let photosSlots = [];
let endRepeatTimes = null;

let videosInPagesMap = new Map();
let videosInPagesCtr = 1;
let videoRepeatTimes;

async function set_pages_to_map(){
    // console.log("story_content_arr.length: ",story_content_arr.length, "photos.length: ", attached_images_arr.length);
    let storiesLen = story_content_arr.length;
    let photosLen = attached_images_arr.length;
    let storyCtr = 1;
    let photoCtr = 1;
    // let pageContent = {'isRepeating':false, 'story':null, 'photos':null};
    let maxPages = 8;
    let photos = [];
    //conditions
    
    //if stories length is less than 8 and photos length is less than 17, map everything to each page
    // if(storiesLen <= 8){
        for(i=0;i<storiesLen;i++){
            let pageContent = {'isRepeating':false, 'story':null,'isStartPage8':false,'photos':null};
            pageContent['story'] = story_content_arr[i]; 
            allPagesMap.set(allPagesCtr, pageContent);
            allPagesCtr++;
            // console.log("story: ", story_content_arr[i], allPagesCtr);
        }
       
        //reset count  from 2
        allPagesCtr = 2;
        photos = [];
    
        let repeatStoriesTimes = (storiesLen - 8);
        let repeatTimes = Math.ceil((photosLen - 17)/3) > 0 ? Math.ceil((photosLen - 17)/3) : 1;
        globalRepeatTimes = repeatTimes;
        

        if(repeatStoriesTimes > repeatTimes){
            repeatTimes = repeatStoriesTimes;
        }
        
        
        // console.log("NUMBER OF TIMES TO REPEAT 5-7 ", repeatTimes);
        let startSlots = [1,3,3];       //number of images slots for the first four pages, 1 to 4, page 1 dont have image
        let endSlots = [4,1,3,2]               //number of images slots for the last 4 pages
        let repeatingSlots = [];
        if(repeatTimes > 1){
            //loop repeatTimes + 1 to include the first set of 5-7 planes
            for(i=0;i<repeatTimes;i++){
                startSlots.push(3)
                repeatingSlots.push(4+i);
            }
           
        }
        photosSlots = [].concat(startSlots, endSlots);
        let lenRepeatSlots = repeatingSlots.length;
        endRepeatTimes = repeatingSlots[lenRepeatSlots-1];

       
        // console.log("photosSlots length",photosSlots.length);

        if(photosLen > 0){
            let currPhotoIdx=0;            //counter for the photosArray indexing
            let max;

            for(j=0;j<photosSlots.length;j++){
                //setup the content map for the photos
                let contentMap;
                if(allPagesMap.has(allPagesCtr)){
                    contentMap = allPagesMap.get(allPagesCtr);
                }else{
                    let pageContent;
                    pageContent = {'isRepeating':false, 'story':null, 'isStartPage8':false};
                    allPagesMap.set(allPagesCtr, pageContent);
                    // console.log('im in the else part created this: ', allPagesMap, "counter: ", allPagesCtr);
                    contentMap = allPagesMap.get(allPagesCtr);
                }
               
                
                
                // console.log("max ",photosSlots[j], "start of i for the photo array: ",currPhotoIdx);
                //if i is still less than the total len of photos array, add the photos to the mapping
                if(currPhotoIdx < photosLen){
                    //j is the start of value at the photosSlots / the number of photos
                    await some_function(contentMap,currPhotoIdx,photosLen,j).then(function(content){
                        //if there are repeating parts, set that content to repeating
                        allPagesMap.set(allPagesCtr, content);
                        allPagesCtr++;
                        // currPhotoIdx += (max);
                        currPhotoIdx += (photosSlots[j]);
                        
                        // console.log("the all pages map after setting: ", allPagesMap, "allPagesCtr: ", allPagesCtr);
                    });
                }
            }

            if(repeatTimes > 1 && repeatingSlots.length >0){
                for(i=0;i<repeatingSlots.length;i++){
                    allPagesMap.get(repeatingSlots[i]).isRepeating = true;
                    allPagesMap.get(repeatingSlots[i]).isStartPage8 = false;
                }
                allPagesMap.get((repeatingSlots[repeatingSlots.length-1])+1).isRepeating = true;
                allPagesMap.get(repeatingSlots[repeatingSlots.length-1]+1).isStartPage8 = false;
                allPagesMap.get(endRepeatTimes+2).isStartPage8 = true;
            }
           
            

            // console.log("FINAL MAPPING:", allPagesMap,"repeating slots: ",repeatingSlots);
        }

        allPagesCtr = allPagesMap.size;
    // }

        //SETUP THE VIDEOS IN PLANES
        let videosLen = attached_videos_arr.length;
        videoRepeatTimes = Math.ceil((videosLen - 4)/4) > 0 ? Math.ceil((videosLen - 4)/4) : 0;
        console.log("video repeat times: ", videoRepeatTimes);
        for(a=0;a<attached_videos_arr.length;a++){
            let videoContent = {'isRepeating':false, 'link':null,'videoId':false};
            console.log("attached_videos_arr a",a,attached_videos_arr[a]);
            videoContent['link'] = attached_videos_arr[a]; 
            let temp = attached_videos_arr[a].split("=");
            let vidIdTemp = temp[1].split("&");
            videoContent['videoId'] = vidIdTemp[0];
            videosInPagesMap.set(videosInPagesCtr,videoContent);
            if(videosInPagesCtr+1 <= attached_videos_arr.length) videosInPagesCtr++;
        }
        
        console.log(videosInPagesMap);
 
}



var some_function = function(contentMap, i,photosLen,photosSlotsIdx)
{
   
    return new Promise(function(resolve, reject)
    {
        photos = [];
        // if(i === 0){
        let max = photosSlots[photosSlotsIdx];
        // console.log("INSIDE SOME_FUNCTION: i ",i, "max: ",max,"photosSlotsIdx ",photosSlotsIdx,"photosSlots: ",photosSlots, "endRepeatTimes: ",endRepeatTimes);
        // if(max === 4) contentMap.isStartPage8 = true;
        for(k=0;k<max;k++){
            if(i+k < photosLen){
                photos.push(attached_images_arr[i+k]);
                contentMap['photos'] = photos;
            }
            if(k==max-1) resolve(contentMap);
        }

    });
}



async function create_story_plane2(fontFamily){
    storyFontFamily = fontFamily;
   
    let numPages = allPagesMap.size;
    let photoCtr = 1;
    // console.log("all pages map size:", numPages, "all pages counter: ", allPagesCtr);
    
    if(numPages <= 8){
        //create all stories in each story plane
        for(i=1;i<=numPages;i++){
            // console.log("current i-1: ",i-1);
            let storyPlane = bookStoryPlanes.get(storyPlanesSeq[i-1]);  //-1 for the array iteration
            let story = allPagesMap.get(i).story;
            let photosArr = allPagesMap.get(i).photos;
            //create the stories
            if(story != null){
                show_story_care(i-1,storyPlane,story,fontFamily);
                storyPlane.material.opacityTexture.vScale = -1;
                storyPlane.isVisible = true;
               
                
            }else{
                storyPlane.isVisible = false;
            }
            
            if(photosArr!=null){
                switch(i){
                    case 2: photoCtr = 1; break;
                    case 3: photoCtr = 2; break;
                    case 4: photoCtr = 5; break;
                    case 5: photoCtr = 8; break;
                    case 6: photoCtr = 12; break;
                    case 7: photoCtr = 13; break;
                    case 8: photoCtr = 16; break;
                }
        
                // console.log("photos array: ", photosArr);
                await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                    // console.log("the result ", result);
                });
            }//end of if

        }//end of for


       
    }else if(numPages > 8){
        // create all stories in each story plane
        let lastPagePhotosSeq = [8,12,13,16];
        let lastPagePhotosSeqCtr = 0;


        for(i=1;i<=numPages;i++){
            let story = allPagesMap.get(i).story;
            let photosArr = allPagesMap.get(i).photos;
            let isTobeRepeated = allPagesMap.get(i).isRepeating;
            
            if(i <= 4){
                // console.log("i: ",i,"current i-1: ",i-1);
                let storyPlane = bookStoryPlanes.get(storyPlanesSeq[i-1]);  //-1 for the array iteration
                
                //create the stories
                if(story != null){
                    show_story_care(i-1,storyPlane,story,fontFamily);
                    storyPlane.material.opacityTexture.vScale = -1;
                    storyPlane.isVisible = true;
                }else{
                    storyPlane.isVisible = false;
                }

                
                if(photosArr!=null){
                    
                    switch(i){
                        case 2: photoCtr = 1; break;
                        case 3: photoCtr = 2; break;
                        case 4: photoCtr = 5; break;
                    }
    
                
                    // console.log("photos array: ", photosArr);
                    await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                        // console.log("the result ", result);
                    });
                
                    
                }//end of if
            }else{
                if(!isTobeRepeated){
                    // console.log('IS START OF PAGE 8: ', );
                    // console.log("not to be repeated i=", i);
                    // console.log("photos array: ", photosArr);
                    // if(photosArr!=null){
                    //     await add_photos(photosArr,lastPagePhotosSeq[lastPagePhotosSeqCtr], photosArr.length).then(function(result){
                    //         // console.log("the result ", result);
                    //         lastPagePhotosSeqCtr++;
                    //     });
                    // }
                }else{
                    // console.log("to be repeated", i);
                    continue;
                }
            }
            
        }//end of for



        //for the videos

    }
    //open the book
    

} 


var add_photos = function(photosArr, photoCtr, maxPhotos)
{
   
    return new Promise(function(resolve, reject)
    {
            // console.log("starting plane count: ", photoCtr);
            for(j=0;j<maxPhotos;j++){
                //     //create the photos
                   
                        let photoPlane = bookPhotoPlanes.get('photo'+photoCtr);
                        show_photo_to_plane2(photosArr[j],photoPlane);
                        // console.log("set photos to plane", photoPlane.name, photosArr[j], "photos counter: ", photoCtr);
                        photoCtr++;
                    
                    
                if(j === maxPhotos-1) resolve("ADDING OF PHOTOS IS DONE")
            }
    });
}

let lastPagePhotosSeq = [8,12,13,16];
let lastPagePhotosSeqCtr = 0;
let lastPageStorySeqCtr = 4;
// let hasMovedToLastPart = false;

async function set_page_content(isPageRepeating){
    let fontFamily = storyFontFamily;
    let numPages = allPagesMap.size;
    let photoCtr = 1;
    let isStartPage8 = allPagesMap.get(currentPageCtr).isStartPage8;
    // console.log("all pages map:", allPagesMap, "all pages counter: ", allPagesCtr);
    // console.log("CURRENT PAGE COUNTER: ", currentPageCtr, "IS PAGE REPEATING: ",isPageRepeating);
    // console.log("IS START OF NEW PAGE: ", isStartPage8);
    

    

    //do this only if there are more than 4 stories
    if(currentPageCtr > 4){
        //create all stories in each story plane
      //  for(i=1;i<=numPages;i++){
          //if the current page should repeat
          if(isPageRepeating){
                // console.log("current i-1: ",i-1);
                let storyPlane = bookStoryPlanes.get('plane7');  //-1 for the array iteration
                let storyPlanePrev = bookStoryPlanes.get('plane5');  //-1 for the array iteration
                let story = allPagesMap.get(currentPageCtr).story;
                let storyPrev = allPagesMap.get(currentPageCtr-1).story;
                let photosArr = allPagesMap.get(currentPageCtr).photos;
                let photosArrPrev = allPagesMap.get(currentPageCtr-1).photos;
                //create the stories
                if(story != null){
                    // console.log("NEXT BUTTON IF PART, HAS STORY");
                    show_story_care(i-1,storyPlanePrev,storyPrev,fontFamily);
                    storyPlanePrev.material.opacityTexture.vScale = -1;

                    show_story_care(i-1,storyPlane,story,fontFamily);
                    storyPlane.material.opacityTexture.vScale = -1;
                    // storyPlane.material.alpha = 1;
                    storyPlane.isVisible = true;
                    storyPlanePrev.isVisible = true;
                }else{
                    // console.log("NEXT BUTTON ELSE PART NO STORY");
                    if(storyPrev != null){
                        show_story_care(i-1,storyPlanePrev,storyPrev,fontFamily);
                        storyPlanePrev.material.opacityTexture.vScale = -1;
                        storyPlanePrev.isVisible = true
                    }else{
                        storyPlanePrev.isVisible = false;
                    }
                    storyPlane.isVisible = false;
                   
                }

                // console.log("PHOTOS PREV ARRAY: ", photosArrPrev, "LEN: ");
                // console.log("PHOTOS ARRAY: ", photosArr);
                if(photosArrPrev != null){
                     await set_old_planes_photos_story(photosArrPrev,2, photosArrPrev.length).then(function(result){
                        // console.log("done with prev photos setup");
                        if(photosArrPrev.length === 1) set_photo_planes_none(3,2);
                        else if(photosArrPrev.length === 2) set_photo_planes_none(4,1);
                    });
                }else{
                    set_photo_planes_none(2,3);
                }

                
                if(photosArr!=null){
                    photoCtr = 5;
            
                    // await set_old_planes_photos_story(photosArrPrev,2, photosArrPrev.length).then(function(result){
                    //     console.log("done with prev photos setup");
                    // });
                    
                    
                    // console.log("photos array: ", photosArr);
                    await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                        // console.log("the result ", result);
                        
                    });
                    if(photosArr.length === 1) set_photo_planes_none(6,2);
                    else if(photosArr.length === 2) set_photo_planes_none(7,1);
                }//end of if
                else{
                    set_photo_planes_none(5,3);
                }
        }//end of if the current page should repeat
        else{
            if(currentPageCtr >= 4 + globalRepeatTimes){
                // hasMovedToLastPart = true;
                let storyPlane = bookStoryPlanes.get(storyPlanesSeq[lastPageStorySeqCtr]);
                let story = allPagesMap.get(currentPageCtr).story;
              
                let photosArr = allPagesMap.get(currentPageCtr).photos;
                photoCtr = lastPagePhotosSeq[lastPagePhotosSeqCtr];

                let storyPlanePrev;

                if(isStartPage8 && lastPagePhotosSeqCtr == 0 ){
                   storyPlanePrev = bookStoryPlanes.get('plane7');
                   if(lastPageStorySeqCtr+1 < storyPlanesSeq.length) lastPageStorySeqCtr++;
                }else{
                    storyPlanePrev = bookStoryPlanes.get(storyPlanesSeq[lastPageStorySeqCtr-1])
                    if(lastPageStorySeqCtr+1 < storyPlanesSeq.length) lastPageStorySeqCtr++;
                }
                let storyPrev = allPagesMap.get(currentPageCtr-1).story;
                let photosArrPrev = allPagesMap.get(currentPageCtr-1).photos;
                

                // console.log("lastPageStorySeqCtr", lastPageStorySeqCtr, "storyPlanesSeq[lastPageStorySeqCtr-1]",storyPlanesSeq[lastPageStorySeqCtr-1]);
                // console.log("lastPagePhotosSeqCtr", lastPagePhotosSeqCtr, "lastPagePhotosSeq[lastPagePhotosSeqCtr]",photoCtr);
                

                if(story != null){
                    // console.log('I AM IN IF PART');
                    show_story_care(i-1,storyPlanePrev,storyPrev,fontFamily);
                    storyPlanePrev.material.opacityTexture.vScale = -1;

                    show_story_care(i-1,storyPlane,story,fontFamily);
                    storyPlane.material.opacityTexture.vScale = -1;

                    

                    storyPlane.isVisible = true;
                    storyPlanePrev.isVisible = true;


                    // console.log("lastPageStorySeqCtr AFTER", lastPageStorySeqCtr, "storyPlanesSeq[lastPageStorySeqCtr-1]",storyPlanesSeq[lastPageStorySeqCtr-1]);
                    // console.log("lastPagePhotosSeqCtr", lastPagePhotosSeqCtr, "lastPagePhotosSeq[lastPagePhotosSeqCtr]",photoCtr);
                }else{
                    // console.log('I AM IN ELSE PART storyPrev', storyPrev, "story: ", story, "story plane: ", storyPlane);
                    if(storyPrev != null){
                        show_story_care(i-1,storyPlanePrev,storyPrev,fontFamily);
                        storyPlanePrev.material.opacityTexture.vScale = -1;
                        storyPlanePrev.isVisible = true;
                    }else{
                        storyPlanePrev.isVisible = false;
                        storyPlane.isVisible = false;
                    }
                    storyPlane.isVisible = false;
                }

                
                
                if(photosArr!=null){
                    // console.log("lastPagePhotosSeqCtr",lastPagePhotosSeqCtr);
                    if(isStartPage8 && lastPagePhotosSeqCtr == 0 ){
                        await set_old_planes_photos_story(photosArrPrev,5, photosArrPrev.length).then(function(result){
                            // console.log("done with prev photos setup");
                        });
                    }else{
                        // let photoCtrStart = lastPagePhotosSeq[lastPagePhotosSeqCtr-1];
                        // await set_old_planes_photos_story(photosArrPrev,photoCtrStart, photosArrPrev.length).then(function(result){
                        //     // console.log("done with prev photos setup 2 lastPagePhotosSeqCtr",lastPagePhotosSeqCtr);
                        // });
                    }
                        await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                            // console.log("the result ", result);
                            if(lastPagePhotosSeqCtr+1 < lastPagePhotosSeq.length) lastPagePhotosSeqCtr++;
                            
                        });  
                 
    
                    
                }


                // console.log("photos array: ", photosArr,"photoCounter: ",photoCtr, "storyplane: ",storyPlane.name, "story",story);
                
            }//end of currentPageCtr >= 4 + globalRepeatTimes
            // console.log("this page should not repeat now, move to the next; CURR PAGE COUNT + REPEAT TIMES", currentPageCtr + globalRepeatTimes);
        }
    }//end of if current count > 4
    else{
        // console.log("THE CURRENT PAGE COUNTER IS: ", currentPageCtr);
    }

 
}

var set_old_planes_photos_story = function(photosArr,photoCtr, maxPhotos)
{
    return new Promise(function(resolve, reject)
    {
        
        for(j=0;j<maxPhotos;j++){
            //     //create the photos
            let photoPlane = bookPhotoPlanes.get('photo'+photoCtr);
            show_photo_to_plane2(photosArr[j],photoPlane);
            // console.log("set photos to plane", photoPlane.name, photosArr[j], "photos counter: ", photoCtr);
            photoCtr++;
                
                
            if(j === maxPhotos-1) resolve("ADDING OF PHOTOS IS DONE")
        }
       
    });
}



var set_old_planes_photos_story_left = function(photosArr,photoCtr, maxPhotos)
{
    return new Promise(function(resolve, reject)
    {
        
        for(j=0;j<maxPhotos;j++){
            //     //create the photos
            let photoPlane = bookPhotoPlanes.get('photo'+photoCtr);
            show_photo_to_plane2(photosArr[j],photoPlane);
            // console.log("set photos to plane", photoPlane.name, photosArr[j], "photos counter: ", photoCtr);
            photoCtr++;
                
                
            if(j === maxPhotos-1) resolve("ADDING OF PHOTOS IS DONE")
        }
       
    });
}


var set_photo_planes_none = function(photoStart,maxPhotos)
{
    return new Promise(function(resolve, reject)
    {
        
        for(j=0;j<maxPhotos;j++){
            //     //create the photos
            let photoPlane = bookPhotoPlanes.get('photo'+photoStart);
            show_photo_to_plane2('front/images3D/storyCareScene/imageHere2.png',photoPlane);
            photoStart++;
                
                
            if(j === maxPhotos-1) resolve("ADDING OF PHOTOS TO NONE IS DONE")
        }
       
    });
}



function show_photo_to_plane2(photo,photoPlane){
        photoPlane.material.albedoTexture = new BABYLON.Texture(photo, scene);
        photoPlane.material.opacityTexture = new BABYLON.Texture(photo, scene);
        photoPlane.material.albedoColor = BABYLON.Color3.White();
        photoPlane.material.hasAlpha = true;
            if(photoPlane.name === 'photo1' ){
                photoPlane.material.albedoTexture.vScale = 1;
                photoPlane.material.opacityTexture.vScale = 1;
            }else if(photoPlane.name === 'photo12'){
                photoPlane.material.albedoTexture.vScale = -1;
                photoPlane.material.opacityTexture.vScale = -1;
            }else if(photoPlane.name === 'video3' || photoPlane.name === 'video4' || photoPlane.name === 'video7' || photoPlane.name === 'video8'){
                photoPlane.material.albedoTexture.vScale = -1;
                photoPlane.material.opacityTexture.vScale = -1;
            }else{
                photoPlane.material.albedoTexture.uScale = -1;
                photoPlane.material.albedoTexture.vScale = -1;
                photoPlane.material.opacityTexture.uScale = -1;
                photoPlane.material.opacityTexture.vScale = -1;
            }
        photoPlane.material.name = photo;
      
        
    
}


let currentPageCtr = 1;
// handle next page of book flipping
function bookNextPage2(nextBtn){
   //if there are 8 pages filled
   
   if(allPagesMap.size <= 8){
        startBookAnimation2('right',nextBtn,false)
   }else if(allPagesMap.size > 8){
        startBookAnimation2('right',nextBtn,true)
   }

   if(nextBtn  === 'next11' || nextBtn === 'next13' || nextBtn === 'next15'){
       console.log("start book animation now");
        set_video_plane_thumbnail();
    }
    if(nextBtn === 'next1') viewBookIcon.isVisible = false;
}

//handle prev page of book flipping
function bookPrevPage2(leftBtn){
    if(allPagesMap.size <= 8){
        startBookAnimation2('left',leftBtn,false)
    }else if(allPagesMap.size > 8){
        startBookAnimation2('left',leftBtn,true)
    }
    if(leftBtn === 'left2') setTimeout(function(){ viewBookIcon.isVisible = true; },1000);

    // if(leftBtn === 'left14' || leftBtn === 'left16'){
    //     console.log("start book animation now");
    //      set_video_plane_thumbnail_left();
    //  }
}




//animation start and end params
function playAnimation2(){
    // // console.log('playing the animation for ', bookTask.animationGroups[0]);
    let anim = bookAnimationMap.get(currentPage);
    if(bookTask.animationGroups[0].isPlaying) bookTask.animationGroups[0].stop();
    bookTask.animationGroups[0].start(false, 0.7,anim.s,anim.e, false);    
}

let notStoryPagesBtnsMap = new Map([
    ['next11',null],
    ['next13',null],
    ['left14',null],
    ['left16',null]
]);
function startBookAnimation2(type, btnType, repeatPages){
    // console.log('start book animation ', type, 'the current page: ', currentPage, "notStoryPagesBtnsMap.has()",notStoryPagesBtnsMap.has(btnType));
    
    if(type === 'right'){
        if(repeatPages){
            
            if(currentPageCtr+1 <= allPagesMap.size && !notStoryPagesBtnsMap.has(btnType)) currentPageCtr++;
            let res;
            if(allPagesMap.has(currentPageCtr)) res = allPagesMap.get(currentPageCtr);
            // console.log("RIGHT BUTTON CLICKED: CURRENT PAGE COUNTER:", currentPageCtr, "result", res);

            if(res && !notStoryPagesBtnsMap.has(btnType)){
                if(res.isRepeating){
                    set_page_content(res.isRepeating);
                    currentPage = 'next5';
                    playAnimation();
                }else{
                    set_page_content(res.isRepeating);
                    currentPage = prevNextMap.get(currentPage).r;
                    playAnimation();
                }
            }else{
                // if(currVideoMapCtr <= videosInPagesMap.size && videosInPagesMap.size >8 && (notStoryPagesBtnsMap.has(btnType) || btnType === 'next15')){
                //     console.log("currVideoMapCtr",currVideoMapCtr,"btnType", btnType);
                //     currentPage = 'next13';
                // }
                // else{
                    currentPage = prevNextMap.get(currentPage).r;
                   
                // }
                playAnimation();
                
            }
        }else{
            // currentPage = prevNextMap.get(currentPage).r;
            // playAnimation();
            // if(currVideoMapCtr > 4 && currVideoMapCtr <= videosInPagesMap.size && videosInPagesMap.size > 8 && (notStoryPagesBtnsMap.has(btnType) || btnType === 'next15')){
            //     console.log("currVideoMapCtr",currVideoMapCtr,"btnType", btnType);
            //     currentPage = 'next13';
            // }
            // else{
                currentPage = prevNextMap.get(currentPage).r;
               
            // }
            playAnimation();
        }
        
    }
    else if(type === 'left'){
        // currentPage = prevNextMap.get(currentPage).l;
        // playAnimation();
        if(repeatPages){
            if(!notStoryPagesBtnsMap.has(btnType)) currentPageCtr--;
            let res;
            
            
            // let isNextStartPage8;
            let isRepeating;
            // if(currentPageCtr < allPagesMap.size){ 
            let isNextStartPage8 = allPagesMap.get(currentPageCtr+1).isStartPage8;
            // }

            if(allPagesMap.has(currentPageCtr)) res = allPagesMap.get(currentPageCtr);
            isRepeating = res.isRepeating;

            
            if(isNextStartPage8){ 
                isRepeating = false;
                if(lastPagePhotosSeqCtr-1 >= 0) lastPagePhotosSeqCtr--;
            }




            // console.log("LEFT BUTTON CLICKED: CURRENT PAGE COUNTER:", currentPageCtr, "result", res, currentPage, "isRepeating", isRepeating );

            if(res && !notStoryPagesBtnsMap.has(btnType)){
                if(isRepeating){
                    set_page_content_left(isRepeating);
                    currentPage = 'left6';
                    playAnimation();
                }else{
                    if(currentPageCtr === 3){
                        //special case
                        set_page_content_left(true);
                        currentPage = 'left6';
                    }else{
                        set_page_content_left(isRepeating);
                        currentPage = prevNextMap.get(currentPage).l;
                    }
                    
                    playAnimation();
                }
            }else{
                // if(currVideoMapCtr > 4 && currVideoMapCtr <= videosInPagesMap.size && videosInPagesMap.size > 8 && (notStoryPagesBtnsMap.has(btnType) || btnType === 'left14')){
                //     console.log("currVideoMapCtr",currVideoMapCtr,"btnType", btnType);
                //     currentPage = 'left14';
                // }else{
                    currentPage = prevNextMap.get(currentPage).l;
                //     if(currentPage === 'left12'){
                //         currVideoMapCtr = 1;
                //     }
                // }
                playAnimation();
            }
        }else{
            // if(currVideoMapCtr > 4 && currVideoMapCtr <= videosInPagesMap.size && videosInPagesMap.size > 8 && (notStoryPagesBtnsMap.has(btnType) || btnType === 'left14')){
            //     console.log("currVideoMapCtr",currVideoMapCtr,"btnType", btnType);
            //     currentPage = 'left14';
            // }else{
                currentPage = prevNextMap.get(currentPage).l;
                // if(currentPage === 'left12'){
                //     currVideoMapCtr = 1;
                // }
            // }
            
            playAnimation();
        }
    }
        
}




async function set_page_content_left(isPageRepeating){
    let fontFamily = storyFontFamily;
    let numPages = allPagesMap.size;
    let photoCtr = 1;
    let isStartPage8 = allPagesMap.get(currentPageCtr).isStartPage8;
    // console.log("all pages map:", allPagesMap, "all pages counter: ", allPagesCtr);
    // console.log("CURRENT PAGE COUNTER: ", currentPageCtr, "IS PAGE REPEATING: ",isPageRepeating);
    

    //do this only if there are more than 4 stories
    if(currentPageCtr >= 3){
        //create all stories in each story plane
      //  for(i=1;i<=numPages;i++){
          //if the current page should repeat
          if(isPageRepeating){

                // // console.log("current i-1: ",i-1);
                let storyPlane = bookStoryPlanes.get('plane5');  //-1 for the array iteration
                let storyPlaneNext = bookStoryPlanes.get('plane7');  //-1 for the array iteration
                let story = allPagesMap.get(currentPageCtr).story;
                let storyNext = allPagesMap.get(currentPageCtr+1).story;
                let photosArr = allPagesMap.get(currentPageCtr).photos;
                let photosArrNext = allPagesMap.get(currentPageCtr+1).photos;
                // let isNextStartPage8 = allPagesMap.get(currentPageCtr+1).isStartPage8;
                
                // console.log("storyNext",storyNext,"photosArrNext",photosArrNext);
                //create the stories    
                if(story != null){
                    if(storyNext!=null){
                        show_story_care(i-1,storyPlaneNext,storyNext,fontFamily);
                        storyPlaneNext.material.opacityTexture.vScale = -1;
                        storyPlaneNext.isVisible = true;
                    }else{
                        storyPlaneNext.isVisible = false;
                    }

                    show_story_care(i-1,storyPlane,story,fontFamily);
                    storyPlane.material.opacityTexture.vScale = -1;
                    storyPlane.isVisible = true;
                    
                }else{
                    storyPlane.isVisible = false;
                }

                if(photosArrNext != null){
                    await set_old_planes_photos_story_left(photosArrNext,5, photosArrNext.length).then(function(result){
                            // console.log("done with prev photos setup");
                            if(photosArrNext.length === 1) set_photo_planes_none(6,2);
                            else if(photosArrNext.length === 2) set_photo_planes_none(7,1);
                    });
                //     await set_old_planes_photos_story(photosArrPrev,2, photosArrPrev.length).then(function(result){
                //        // console.log("done with prev photos setup");
                //        if(photosArrPrev.length === 1) set_photo_planes_none(3,2);
                //        else if(photosArrPrev.length === 2) set_photo_planes_none(4,1);
                //    });
               }else{
                   set_photo_planes_none(5,3);
               }
                
                
                
                if(photosArr!=null){
                    photoCtr = 2;
            
                    // if(!isNextStartPage8){
                        // await set_old_planes_photos_story_left(photosArrNext,5, photosArrNext.length).then(function(result){
                        //     // console.log("done with prev photos setup");
                        // });
                    // }
                    
                    
                    // console.log("photos array: ", photosArr);
                    await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                        // console.log("the result ", result);
                        
                    });
                }//end of if
        }//end of if the current page should repeat
        else{
            if(currentPageCtr > 4 + globalRepeatTimes){

                // console.log("I CAME FROM PAGE 8 AND REPEATING WILL START NOW");
                // hasMovedToLastPart = true;
                let storyPlane = bookStoryPlanes.get(storyPlanesSeq[lastPageStorySeqCtr]);
                let story = allPagesMap.get(currentPageCtr+1).story;
              
                let photosArr = allPagesMap.get(currentPageCtr+1).photos;
                photoCtr = lastPagePhotosSeq[lastPagePhotosSeqCtr];


        

                // console.log("storyPlane", storyPlane, "story:", story, "photosArr", photosArr, "currentPageCtr", currentPageCtr, "photoCtr", photoCtr);
                // console.log("lastPageStorySeqCtr", lastPageStorySeqCtr, "storyPlanesSeq[lastPageStorySeqCtr-1]",storyPlanesSeq[lastPageStorySeqCtr-1]);
                // console.log("lastPagePhotosSeqCtr", lastPagePhotosSeqCtr, "lastPagePhotosSeq[lastPagePhotosSeqCtr]",photoCtr);
                let storyPlaneNext;

                // if(isStartPage8 && lastPagePhotosSeqCtr == 0 ){
                //     storyPlaneNext = bookStoryPlanes.get('plane9');
                // }else{
                //     storyPlaneNext = bookStoryPlanes.get(storyPlanesSeq[lastPageStorySeqCtr-1])
                // }
                // let storyNext = allPagesMap.get(currentPageCtr+1).story;
                // let photosNext = allPagesMap.get(currentPageCtr+1).photos;

                // // console.log("storyNext: ", storyNext, "photosNext: ", photosNext);
                

                if(story != null){
                    // console.log('I AM IN IF PART');
                    // show_story_care(i-1,storyPlaneNext,storyNext,fontFamily);
                    // storyPlaneNext.material.opacityTexture.vScale = -1;

                    show_story_care(i-1,storyPlane,story,fontFamily);
                    storyPlane.material.opacityTexture.vScale = -1;
                    if(lastPageStorySeqCtr-1 >= 4) lastPageStorySeqCtr--;
                    storyPlane.isVisible = true;
                    // storyPlaneNext.isVisible = true;
                }else{
                    // // console.log('I AM IN ELSE PART', storyNext);
                    // if(storyNext != null){
                    //     show_story_care(i-1,storyPlaneNext,storyNext,fontFamily);
                    //     storyPlaneNext.material.opacityTexture.vScale = -1;
                    //     storyPlaneNext.isVisible = true;
                    // }else{
                    //     storyPlaneNext.isVisible = false;
                    // }
                    storyPlane.isVisible = false;
                }

                
                
                if(photosArr!=null){
                    // if(isStartPage8 && lastPagePhotosSeqCtr == 0 ){
                    //     await set_old_planes_photos_story(photosArrPrev,5, photosArrPrev.length).then(function(result){
                    //         // console.log("done with prev photos setup");
                    //     });
                    // }else{
                    //     let photoCtrStart = lastPagePhotosSeq[lastPagePhotosSeqCtr-1];
                    //     await set_old_planes_photos_story(photosArrPrev,photoCtrStart, photosArrPrev.length).then(function(result){
                    //         // console.log("done with prev photos setup");
                    //     });
                    // }
                        await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
                            // console.log("the result ", result);
                            if(lastPagePhotosSeqCtr-1 >= 0) lastPagePhotosSeqCtr--;
                        });  
                 
    
                    
                }


                // console.log("photos array: ", photosArr,"photoCounter: ",photoCtr, "storyplane: ",storyPlane.name, "story",story);
                
            }
            // if(currentPageCtr >= 5 + globalRepeatTimes){
            //     hasMovedToLastPart = true;
            //     let storyPlane = bookStoryPlanes.get(storyPlanesSeq[lastPageStorySeqCtr]);
            //     let story = allPagesMap.get(currentPageCtr).story;
            //     let photosArr = allPagesMap.get(currentPageCtr).photos;
            //     photoCtr = lastPagePhotosSeq[lastPagePhotosSeqCtr];

            //     if(story != null){
            //         show_story_care(i-1,storyPlane,story,fontFamily);
            //         storyPlane.material.opacityTexture.vScale = -1;
            //         storyPlane.isVisible = true;
            //     }else{
            //         storyPlane.isVisible = false;
            //     }

            //     if(photosArr!=null){
            //         await add_photos(photosArr,photoCtr, photosArr.length).then(function(result){
            //             // console.log("the result ", result);
            //             lastPagePhotosSeqCtr--;
            //             lastPageStorySeqCtr--;
            //         });
            //     }


            //     // console.log("photos array: ", photosArr,"photoCounter: ",photoCtr, "storyplane: ",storyPlane.name, "story",story);
                
            // }
            // console.log("this page should not repeat now, move to the next; CURR PAGE COUNT + REPEAT TIMES", currentPageCtr + globalRepeatTimes);
        }
    }//end of if current count > 4
    else{
        // console.log("THE CURRENT PAGE COUNTER IS: ", currentPageCtr);
    }

 
}

let currVideoMapCtr = 1;
let videoPlaneCtr = 1;
let oldVideosMapCtr = 1;
let oldMaxVideos=0;
let currMaxVideos=0;
async function set_video_plane_thumbnail(){
    //if there are 8 or less videos 
    console.log("currVideoMapCtr", currVideoMapCtr,"videosInPagesMap.size", videosInPagesMap.size );
   
    //preparation from the number of videos is greater than 8
    console.log("videoRepeatTimes",videoRepeatTimes, "currVideoMapCtr",currVideoMapCtr);

    if(videosInPagesMap.size > 0 && currVideoMapCtr <= 8 && currVideoMapCtr <= videosInPagesMap.size){

        if(videosInPagesMap.size - currVideoMapCtr >= 4) currMaxVideos = 4;
        else currMaxVideos = videosInPagesMap.size - (currVideoMapCtr-1);    
        let startCnt = 1;
        if(currVideoMapCtr >= 4) startCnt = 5;
    //         else currMaxVideos = videosInPagesMap.size - (currVideoMapCtr-1); 
        //params: start of video counter
        await add_videos(startCnt,currVideoMapCtr,currMaxVideos).then(function(result){
            // console.log("the result ", result);
            currVideoMapCtr += result;
            console.log("currVideoMapCtr",currVideoMapCtr)
        });
    }
    // console.log("oldMaxVideos",oldMaxVideos, "oldVideosMapCtr",oldVideosMapCtr,"currVideoMapCtr",currVideoMapCtr);
    // if(videoRepeatTimes > 1){
    //     //set the first 4 first
    //     if(videosInPagesMap.size > 0 && videosInPagesMap.size > 8 && currVideoMapCtr-1 <= videosInPagesMap.size){
    //         console.log('i am inside the if condition');
    //         if(videosInPagesMap.size - currVideoMapCtr >= 4) currMaxVideos = 4;
    //         else currMaxVideos = videosInPagesMap.size - (currVideoMapCtr-1);     // -1 for the first eleement of the map counter by the currVideoMapCtr
    //         console.log("MAX VIDEOS: ",currMaxVideos, "oldMaxVideos",oldMaxVideos, "oldVideosMapCtr",oldVideosMapCtr,"currVideoMapCtr",currVideoMapCtr);
    //         //start with 

    //         if(currVideoMapCtr > 4){
    //             console.log('setup the old videos map here');
    //             await add_old_videos(oldVideosMapCtr,oldMaxVideos,1).then(function(result){
    //             });

    //             await add_videos(5,currVideoMapCtr,currMaxVideos).then(function(result){
    //                 oldMaxVideos = currMaxVideos;
    //                 oldVideosMapCtr = currVideoMapCtr;
    //                 currVideoMapCtr += result;
    //                 if(currMaxVideos === 1) set_video_planes_none(6,3);
    //                 else if(currMaxVideos === 2) set_video_planes_none(7,2);
    //                 else if(currMaxVideos === 3) set_video_planes_none(8,1);
    //                 console.log("the result IN 2", result, 'the updated currVideoMapCtr', currVideoMapCtr);
    //             });
    //         }else{
    //             await add_videos(1,currVideoMapCtr,currMaxVideos).then(function(result){
    //                 oldMaxVideos = currMaxVideos;
    //                 oldVideosMapCtr = currVideoMapCtr;
    //                 currVideoMapCtr += result;
    //                 if(currMaxVideos === 1) set_video_planes_none(2,3);
    //                 else if(currMaxVideos === 2) set_video_planes_none(3,2);
    //                 else if(currMaxVideos === 3) set_video_planes_none(4,1);
    //                 console.log("the result IN ELSE", result, 'the updated currVideoMapCtr', currVideoMapCtr);
    //             });
    //         }
    //     }

    // }
    
}

async function set_video_plane_thumbnail_left(){
    //if there are 8 or less videos 
    console.log("currVideoMapCtr", currVideoMapCtr,"videosInPagesMap.size", videosInPagesMap.size );
   
    //preparation from the number of videos is greater than 8
    console.log("videoRepeatTimes",videoRepeatTimes, "currVideoMapCtr",currVideoMapCtr);
    // console.log("oldMaxVideos",oldMaxVideos, "oldVideosMapCtr",oldVideosMapCtr,"currVideoMapCtr",currVideoMapCtr);
    
   
    
    if(videoRepeatTimes > 1){
        //set the first 4 first
        if(videosInPagesMap.size > 0 && videosInPagesMap.size > 8 && currVideoMapCtr-1 <= videosInPagesMap.size){
            console.log('i am inside the if condition');
            console.log("GO LEFT NOW MAX VIDEOS: currVideoMapCtr", currVideoMapCtr, "oldVideosMapCtr",oldVideosMapCtr,"currMaxVideos",currMaxVideos,"oldMaxVideos",oldMaxVideos);
            
           
            //start with 

            if(currVideoMapCtr > 4){
            //     console.log('setup the old videos map here');
            //     await add_old_videos(currVideoMapCtr,maxVideos,5).then(function(result){
            //     });

                await add_videos(1,oldVideosMapCtr,oldMaxVideos).then(function(result){
                    if(videosInPagesMap.size - currVideoMapCtr >= 4) currMaxVideos = 4;
                    else currMaxVideos = videosInPagesMap.size - (currVideoMapCtr-1);  
                    
                    currVideoMapCtr -= result;
                    if(oldMaxVideos === 1) set_video_planes_none(2,3);
                    else if(oldMaxVideos === 2) set_video_planes_none(3,2);
                    else if(oldMaxVideos === 3) set_video_planes_none(4,1);
                    console.log("AFTER LEFT CLICK: currVideoMapCtr",currVideoMapCtr,"currMaxVideos",currMaxVideos,"oldMaxVideos",oldMaxVideos,"oldVideosMapCtr",oldVideosMapCtr );
                });
            }
            // else{
            //     await add_videos(1,oldVideosMapCtr,oldMaxVideos).then(function(result){
            //         // oldMaxVideos = maxVideos;
            //         // oldVideosMapCtr = currVideoMapCtr;
            //         currVideoMapCtr -= result;
            //         if(maxVideos === 1) set_video_planes_none(2,3);
            //         else if(maxVideos === 2) set_video_planes_none(3,2);
            //         else if(maxVideos === 3) set_video_planes_none(4,1);
            //         console.log("the result IN ELSE", result, 'the updated currVideoMapCtr', currVideoMapCtr);
            //     });
            // }
        }

    }
    
}


var add_videos = function(videoCnt,videoMapCtr,maxVideos)
{
    return new Promise(function(resolve, reject)
    {
            console.log("starting plane count: ", videoCnt,"max: ",maxVideos);
            for(j=0;j<maxVideos;j++){
                console.log(videoCnt);
                    let videoPlane = bookVideoPlanes.get('video'+videoCnt);
                    console.log("current plane: ", videoPlane, "count: ", videoPlane.name);
                    let val = videosInPagesMap.get(videoMapCtr);
                    videoPlane.link = val.videoId;
                    let videoThumb = 'https://img.youtube.com/vi/'+val.videoId+'/mqdefault.jpg'
                    show_photo_to_plane2(videoThumb,videoPlane);
                    console.log("set photos to plane", videoPlane.name, videoThumb, "photos counter: ", videoCnt, "videoPlane.link",videoPlane.link);
                    videoCnt++;
                    videoMapCtr++;
                    // currVideoMapCtr++;
                    if(j === maxVideos - 1) resolve(maxVideos);
            }
            
    });
}


var add_old_videos = function(videoMapCtr2,maxVideos2,startPlaneCnt)
{
   
    return new Promise(function(resolve, reject)
    {
            console.log("OLD VIDEOS ", startPlaneCnt,"max: ",maxVideos2);
            for(k=0;k<maxVideos2;k++){
                    let videoPlane = bookVideoPlanes.get('video'+startPlaneCnt);
                    console.log("current plane: ", videoPlane, "count: ", videoPlane.name);
                    let val = videosInPagesMap.get(videoMapCtr2);
                    videoPlane.link = val.videoId;
                    let videoThumb = 'http://img.youtube.com/vi/'+val.videoId+'/mqdefault.jpg'
                    show_photo_to_plane2(videoThumb,videoPlane);
                    console.log("set photos to plane", videoPlane.name, videoThumb, "photos counter: ", startPlaneCnt, "videoPlane.link",videoPlane.link);
                    startPlaneCnt++;
                    videoMapCtr2++;
                    // currVideoMapCtr++;
                    if(k === maxVideos2 - 1) resolve("old videos set");
            }
            
    });
}


var set_video_planes_none = function(videoStart,maxVideos)
{
    return new Promise(function(resolve, reject)
    {
        
        for(l=0;l<maxVideos;l++){
            //     //create the photos
            let videoPlane = bookVideoPlanes.get('video'+videoStart);
            show_photo_to_plane2('front/images3D/storyCareScene/imageHere2.png',videoPlane);
            videoStart++;
                
                
            if(l === maxVideos-1) resolve("ADDING OF PHOTOS TO NONE IS DONE")
        }
       
    });
}






/*################################################### START OF YOUTUBE PLAYER SETUP ############################################## */

let yt_player;
let isMusicChanged = false;
let theClick = 0;
let isSoundIconClicked = false;

function setup_music_player(){
    $('.player').empty();
    let initVideo = "";
    var video_player = document.getElementById('player');

    
    yt_player = new YT.Player(video_player, {
    host: 'https://www.youtube.com',
    height: '0',
    width: '0',
    videoId: initVideo,
    playerVars: {
        autoplay: 1,
        loop: 1,
        start: 0,
        fs:0,
        enablejsapi: 1,
        origin : window.location.href,
        widget_referrer: window.location.href
    },
    events: {
        'onReady': onPlayerReady,
        // 'onStateChange': onPlayerStateChange
    } 
    });

    console.log("MUSIC PLAYER IS SETUP",yt_player);
}


function onPlayerReady(event) {
    event.target.playVideo();
}

function load_music(videoId,start) {
    $('#musicVideoDiv').css({'visibility':'visible', 'display':'block'});
    $('.player').empty();
    yt_player.loadVideoById(videoId,start);
    yt_player.playVideo();
    isMusicPlaying = true;
}

function stop_music(){
    yt_player.stopVideo(); 
    isMusicPlaying = false;
}

function pause_music(){
    yt_player.pauseVideo(); 
    isMusicPlaying = false;
}


function play_music(){
    yt_player.playVideo(); 
    isMusicPlaying = true;
}

let isMusicPlaying = false;
let isFirstLoad = false;

function onPlayerStateChange(event) {
    switch(event.data) {
      case 0:
        if(isMusicPlaying) yt_player.playVideo();
        break;
    }

    if(!isSoundIconClicked && !isFirstLoad){
        console.log("sound icon not clicked", event.data);
        if(event.data === 1 && testBrowser() === 'Chrome'){ 
            $('.muteUnmuteIcon').remove();
            $('#muteUnmuteIconDiv').append('<i class="fas fa-volume-up muteUnmuteIcon"></i>');
            isMuted = false;
            isMusicPlaying = true;
            isFirstLoad = true;
        }
    }
  }




/*################################################### END OF SETUP YOUTUBE PLAYER FUNCTION ############################################## */


var sun;
var planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
var redAngle = 0.01;   
var yellowAngle = 0.02;
var grayAngle = -0.01;
let TEXTURE_PATH = "front/textures/home/planets/";
let sunOrigTexture;


function create_planets(){
    //create the sun
   
    try{
        for (const [planet,val] of planetsMap.entries()) {
            //val 0 - texture name, 1 - normal texture name, 2 - position, 3- radius
            if(planet === "sun"){
                let temp = init_planet(planet, planet+"matl",TEXTURE_PATH+val[0], TEXTURE_PATH+val[1], val[2], val[3], scene);
                // add_glow(temp, scene);
                sun = temp;
                sunOrigTexture = temp.material.diffuseTexture;
               
            }
            else if(planet === "saturn"){
                let temp = init_planet(planet, planet+"matl",TEXTURE_PATH+val[0], TEXTURE_PATH+val[1], val[2], val[3], scene);
                create_saturn_ring(temp,scene);
            }else if(planet === 'earth'){
                continue;
            }else{
                let temp = sun.clone(planet);
                init_clone_planet(temp,planet+"matl",TEXTURE_PATH+val[0],TEXTURE_PATH+val[1],val[2],val[3],scene);
                if(planet==='venus' || planet === 'uranus') animatePlanetRotation(temp,10,200,new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360),0));
                else animatePlanetRotation(temp,10,200,new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(360),0));
            }
            
        }
        
    }catch(err){
        // console.log(err,"cannot access the map");
    }


} // end of create_planets function



function create_saturn_ring(saturn,scene){
    var saturnRing = BABYLON.Mesh.CreateGround("rings", 490, 490, 1, scene);
    saturnRing.isPickable = false;
    saturnRing.parent = saturn;

    saturn.rotationQuaternion = new BABYLON.Quaternion(0.28,0.18,0.02,0.94);
    var ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", scene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture(TEXTURE_PATH+"saturnRing2.png", scene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;
}

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,pos,radius,scene){
    var temp = BABYLON.Mesh.CreateSphere(name, 0, radius, scene);
    temp.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    var temp_material = new BABYLON.StandardMaterial(material_name,scene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, scene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,scene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp.material = temp_material;
    temp.convertToUnIndexedMesh();

    temp.actionManager = new BABYLON.ActionManager(scene);
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverPlanet)
    );
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
           onOutPlanet)
    );

    
    return temp;
}//end of init planet function


function init_clone_planet(temp,material_name,texture_path,normal_texture_path,pos,scale,scene){
    temp.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    var temp_material = new BABYLON.StandardMaterial(material_name,scene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, scene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,scene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);

    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();

    temp.actionManager = new BABYLON.ActionManager(scene);
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverPlanet)
    );
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
           onOutPlanet)
    );
}//end of init planet function



let storyCareLbl;
function create_planet_labels(){
    let goFundMe;
    for(const [name,val] of planet_labels_map.entries()){
        //val = [width, height, pos, rot]
        if(name == "storyCare") continue;
        else init_planet_label(name,"front/images3D/participateScene/planetTexts/"+name+".png",val[0], val[1],val[2],val[3]);
        // if(name == "storyCare") storyCareLbl = temp;
    }

    // storyCareLbl = init_planet_label('goFundMe',"front/images3D/participateScene/planetTexts/goFundMe2.png",200, 100,{x:-88.099,y:49.982,z:56.993},goFundMe[3]);
    
    // storyCareLbl.setParent(earth_object);
    // scene.debugLayer.show();
}

function init_planet_label(name,matlPath,w,h,pos, rot){
    var plane = BABYLON.MeshBuilder.CreatePlane(name, {height:h,width:w}, scene);
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
    
    let planeMatl = new BABYLON.StandardMaterial(name+"Matl", scene);

    planeMatl.diffuseTexture = new BABYLON.Texture(matlPath, scene);
    planeMatl.opacityTexture = new BABYLON.Texture(matlPath, scene);
    planeMatl.hasAlpha = true;
    plane.isPickable = false;
  
    plane.material = planeMatl;

    return plane;
}

let planetOrigScaling;
var onOverPlanet=(meshEvent)=>{
    var theMeshID = meshEvent.source.name;
     //create planet label
     let lbl = document.createElement("span");
     lbl.setAttribute("id", "planetLbl");
     var sty = lbl.style;
     sty.position = "absolute";
     sty.lineHeight = "1.5em";
     sty.padding = "0.2%";
     sty.color = "#efad0c  ";
     sty.fontFamily = "Courgette-Regular";
     sty.fontSize = "1.5em";
     sty.top = meshEvent.pointerY + "px";
     sty.left = meshEvent.pointerX + "px";
     sty.cursor = "pointer";
     sty.pointerEvents = 'none';

    if(planetsMap.has(theMeshID)){
        planetOrigScaling = meshEvent.meshUnderPointer.scaling;
        let scale = meshEvent.meshUnderPointer.scaling;
        meshEvent.meshUnderPointer.scaling = new BABYLON.Vector3(scale.x*1.1, scale.y*1.1, scale.z*1.1);
    }

    if(theMeshID === 'viewBookIcon'){
        document.body.appendChild(lbl);
        meshEvent.meshUnderPointer.material.emissiveColor = BABYLON.Color3.White();
        lbl.textContent = "View Book";
    }
};

//handles the on mouse out event
var onOutPlanet=(meshEvent)=>{
 
    if(!isMobile()) sun.material.diffuseTexture = sunOrigTexture;
    
    if(planetsMap.has(meshEvent.meshUnderPointer.name)){
        meshEvent.meshUnderPointer.scaling = planetOrigScaling;
    }

    if(meshEvent.meshUnderPointer.name === 'viewBookIcon'){
        meshEvent.meshUnderPointer.material.emissiveColor = new BABYLON.Color3(0,0,0,0);
    }

    while (document.getElementById("planetLbl")) {
        document.getElementById("planetLbl").parentNode.removeChild(document.getElementById("planetLbl"));
    } 
};




let earthAnimation;
var animatePlanetRotation = function(obj, speed, frameCount, newRot) {
    
    let anim = BABYLON.Animation.CreateAndStartAnimation('objRot', obj, 'rotation', speed, frameCount, obj.rotation, newRot, 1, null);
    // if(obj === earth_object) earthAnimation = anim;
}

/*################################################### MUSIC VIDEO SECTION FUNCTIONS ############################################## */
$('#musicVideoDivHeader #close-btn').on("click", function (e) {
    $('#musicVideoDiv').hide();
    isVideoEnabled = false;
    //show fullscreenIcon
});


$('#viewBookImgDiv').on("click", function (e) {
    console.log("is focused on book: ", isBookZoomed);
    focusOnBook(isBookZoomed);
    isBookZoomed = !isBookZoomed;
   
});







let isMusicFullscreen = false;
$('#musicVideoDivHeader #fullscreen-btn, #musicVideoDivHeader #minimize-btn').on("click", function (e) {
    if(!isMusicFullscreen){
        resize_window('full', 'youtube');
        $("#musicVideoDivHeader #fullscreen-btn").hide();
        $("#musicVideoDivHeader #minimize-btn").show();
        //change the fullscreen label
        $('.wikiFullscreenLabel').html('Minimize');
    }else{
        resize_window('window', 'youtube');
        $("#musicVideoDivHeader #fullscreen-btn").show();
        $("#musicVideoDivHeader #minimize-btn").hide();
        $('.wikiFullscreenLabel').html('Fullscreen');
    }
    isMusicFullscreen = !isMusicFullscreen;
});


function resize_window(size, section){
    let theSection;
    if(section === 'youtube'){
        theSection = $('#musicVideoDiv #player');
    }else if(section === '3dflower') theSection = $('#flowerModelDiv'); 

    if(size === 'full'){
        theSection.css({ 
            width :'100vw',
            height: '95vh'
        });
        if(section === 'youtube') $('#musicVideoDiv').css({width:'100vw', height:'auto'});
        else if(section === '3dflower') theSection.css({left:'0', height:'100%'});
        $('#minimize-btn').css('padding-right','1%');
        $('#flowerModelDiv #minimize-btn').css('padding-right','1%');
        
    }else{ //if windowed size
        
        if(isMobile() || isSmallDevice()){
            theSection.css({ 
            width: '30vw',
            height: '18vw'
            });
            if(section === 'youtube'){  
            $('#musicVideoDiv').css('width','30vw');
            }else if(section === '3dflower') theSection.css('left','4%');
        }else{
            theSection.css({ 
                width: '20vw',
                height: '12vw'
            });
            if(section === 'youtube'){
            $('#musicVideoDiv').css('width','20vw');
            }else if(section === '3dflower') theSection.css('left','4%');
        }
        
    }
}
    



let isPlanetClicked;
function checkScreenAndDoubleClick(details){
    
    let theTitle = details[0];
    let theLink = details[1];

    let alertTitle = "Double Tap to enter the planet.";
    if(theTitle === 'Communicator') alertTitle = "Double Tap to view the page.";

    if(isMobile()){
        if(isPlanetClicked){
            isPlanetClicked = false;
            window.location.href = theLink; 
        }else{
            isPlanetClicked = true;
            setTimeout(function(){
                if(isPlanetClicked){
                    isPlanetClicked = false;
                        Swal.fire({
                            width: '10vw',
                            padding: '3em',
                            title: alertTitle,
                            showConfirmButton: false,
                            position: 'top-end',
                            showClass:{
                                backdrop: 'swal2-backdrop-hide',
                            },
                            timer: 2000,
                            width: 100,
                            customClass: {
                                popup: 'trevor-popup-class',
                            }
                        });
                    }
            },500);
        }
    }else{
        show_alert_box(theTitle,theLink);
    }
}

function show_alert_box(titleText,path){
    Swal.fire({
        title: "Are you sure you want to view the "+titleText+" page? ",
        imageUrl: '../../front/icons/alert-icon.png',
        imageWidth: '10vw',
        imageHeight: 'auto',
        imageAlt: 'Warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        allowOutsideClick: false,
        confirmButtonText: 'Yes, I\'m sure!',
        width: '20%',
        padding: '1rem',
        background: 'rgba(8, 64, 147, 0.62)',
      }).then((result) => {
        if (result.value) {
            window.location.href = path;
        }
      });
}
    