

//define the scene
var homeScene;  
                                                            //var to handle the earth scene
//define the scene's camera
var initCamera;                                                    //var to hold the first camera upon loading the earth scene

//define the scene's light
var initLight;                                                     //active hemispheric light for the earth scene
var initSkybox;

//define the asset loaders of scene
var mbayeTask;                                                 //asset loader of scene's mbaye

//define the objects of scene                                           //var for the earth names mesh
var mbayeObject;                                              //var for the scene's mbaye mesh

//define the scene's planets
var mercury;
var venus;
var earth;
var earthMoon;
var mars;
var jupiter;
var saturn;
var neptune;
var pluto;
var sun;

//define constants for zoom in/out limits
const LOWER_RADIUS_VAL = 1;                                         //zoom in limit                       
const UPPER_RADIUS_VAL = 2000;                                      //zoom out limit
var isHomeCounterReady = false;

let theCurrRadius;






function createScene(){
    engine.enableOfflineSupport = true;
                 
    homeScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    initCamera = create_init_camera();                                //create earth scene's camera
    create_init_light();                                  //create earth scene's light
    initSkybox = create_init_skybox();                                              //create earth scene's skybox
    load_home_meshes();
    create_home_planets();
    // homeScene.debugLayer.show();
    create_home_halo();
    create_home_labels();
   
    add_home_mouse_listener();

    enable_webcamera();

    enable_init_webcamera();

    init_texts();
    
    return homeScene;
} //end of create scene function



//function that creates the scene's cameras
function create_init_camera(){
    let camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,900),homeScene);

    //set zoom in and zoom out capability
    // camera.allowUpsideDown = false;
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.lowerRadiusLimit = 0.1;
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10;
    camera.panningDistanceLimit = 2000;
    camera.attachControl(canvas,true);
    camera.pinchPrecision = 1;
    homeScene.activeCamera = camera;
    return camera;
}//end of create camera function
                   
var planetsLight;
//function that creates scene's hemispheric light
function create_init_light(){
    initLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,1000), homeScene);
    initLight.radius = 1000;
    initLight.specular = new BABYLON.Color3(0,0,0);
    initLight.diffuse = new BABYLON.Color3(1,1,1);
    initLight.groundColor = new BABYLON.Color3(1,1,1);
    initLight.intensity = 1.3;

    planetsLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,700), homeScene);
    planetsLight.radius = 500;
    planetsLight.specular = new BABYLON.Color3(0,0,0);
    planetsLight.diffuse = new BABYLON.Color3(1,1,1);
    planetsLight.groundColor = new BABYLON.Color3(0.1,0.1,0.1);
    planetsLight.intensity = 1;

    // return light;
}//end of create earth light function

function create_init_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("initSkybox", {size:8500.0}, homeScene);
    // skybox.position.y = -3000;
     skybox.position.y = -500;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("initSkyboxMaterial", homeScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, homeScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function

function create_vr_scene(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("designSkybox", {size:200.0}, homeScene);
            skybox.backFaceCulling = false;
            skybox.isPickable = false;

            skybox.position = new BABYLON.Vector3(0,-300,0);
            skybox.scaling = new BABYLON.Vector3(1,1,-1);

            var skyboxMatl = new BABYLON.StandardMaterial("skyboxMatl", homeScene);
            // skyboxMatl.backFaceCulling = false;

              var files = [   
              "finalSkybox/vr/px.jpg",   
              "finalSkybox/vr/py.jpg",   
              "finalSkybox/vr/pz.jpg",   
              "finalSkybox/vr/nx.jpg",              
              "finalSkybox/vr/ny.jpg",   
              "finalSkybox/vr/nz.jpg",    
              ];


            skyboxMatl.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, homeScene);
            skyboxMatl.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
            skyboxMatl.disableLighting = true;
            skyboxMatl.specular = new BABYLON.Vector3(0,0,0);
            skybox.material = skyboxMatl;
    // skyboxMaterial.freeze();
    // skybox.freezeWorldMatrix();
    // enable_home_gizmo(skybox);

}//end of create skybox function

var mbayeInit_object;
var mbayeInitTask;
var initEarth_object;
var theVideoParent;
var agreeCameraUseDisc;
let startTime;
function load_home_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/homeScene/", "discThin2.glb", homeScene,
                    function (evt) {
                    // onProgress
                    var loadedPercent = 0;
                    if (evt.lengthComputable) {
                        loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                    } else {
                        var dlCount = evt.loaded / (1024 * 1024);
                        loadedPercent = Math.floor(dlCount * 100.0) / 100.0;
                    }
                    // assuming "loadingScreenPercent" is an existing html element
                    document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
            }).then(function (result){
                    for(var i=0;i<result.meshes.length;i++){
                        if(result.meshes[i].name === "top"){
                            videoHome_obj = result.meshes[i];
                        }else if(result.meshes[i].name === "bot"){
                            videoHome_obj2 = result.meshes[i];
                        }
                    }
                  
                    result.meshes[1].isVisible = false;
                    result.meshes[1].setParent(result.meshes[3]);
                    result.meshes[2].setParent(result.meshes[3]);
                    result.meshes[4].setParent(result.meshes[3]);
                    
                    theVideoParent = result.meshes[3];
                    agreeCameraUseDisc = result.meshes[1];

                    //result.meshes[3].position = new BABYLON.Vector3( -127, -64,-124);
                    // {x: .63145374998968, y: -7.822672727941687, z: -68.04359296575824}
                    result.meshes[3].position = new BABYLON.Vector3( -54, -10,-68);
                    result.meshes[3].rotationQuaternion = new BABYLON.Quaternion( 0.0437,0.8910,0.0985,-0.4409);
        })

    ]).then(() => {
        add_video_to_mesh(1);
        // setTimeout(function(){
            initLight.includedOnlyMeshes.push(videoHome_obj);
            initLight.includedOnlyMeshes.push(videoHome_obj2);
            initLight.includedOnlyMeshes.push(agreeCameraUseDisc);
           
            initCamera.target = new BABYLON.Vector3(0,0,0);
            initCamera.radius = 1400;
        // },1000);

        // setTimeout(function(){
        //     document.getElementById("loadingScreenPercent").style.visibility = "hidden";
        //     document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
        //     document.getElementById("loadingScreenDiv").remove();
        
        // },5000);
       
    });
}//end of function load meshes

var homeHalo;
function create_home_halo(){

    var plane = BABYLON.MeshBuilder.CreatePlane("homeHalo", {height:1200,width:2250}, homeScene);
    plane.position = new BABYLON.Vector3(26,40,-50);
    plane.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(75),BABYLON.Tools.ToRadians(128),0);
  
    var planeMatl = new BABYLON.StandardMaterial("plane1", homeScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/textures/home/haloThin2.png", homeScene);
    planeMatl.opacityTexture = new BABYLON.Texture("front/textures/home/haloThin2.png", homeScene);
    planeMatl.alpha = 0.9;
    
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
   
    plane.material = planeMatl;
    plane.isPickable = false;

    homeHalo = plane;

    initLight.includedOnlyMeshes.push(homeHalo);
}



let venusInfoTxt;
function create_home_labels(){
   
    initLight.includedOnlyMeshes.push(init_planet_label("participate","front/textures/home/planetText/participate.png", 175,325,945,198,526));
    initLight.includedOnlyMeshes.push(init_planet_label("design","front/textures/home/planetText/design.png", 110,200,792,133,472));
    initLight.includedOnlyMeshes.push(init_planet_label("member","front/textures/home/planetText/member.png", 110,200,913,490,-1443));
    initLight.includedOnlyMeshes.push(init_planet_label("special","front/textures/home/planetText/special.png", 135,200,-413,202,-919));
    initLight.includedOnlyMeshes.push(init_planet_label("captain","front/textures/home/planetText/captain.png", 100,120,-854,55,100));
    initLight.includedOnlyMeshes.push(init_planet_label("building","front/textures/home/planetText/building.png", 135,200,122,-177,823));
    initLight.includedOnlyMeshes.push(init_planet_label("story","front/textures/home/planetText/story.png", 110,200,1024,349,-2269));
    initLight.includedOnlyMeshes.push(init_planet_label("visit","front/textures/home/planetText/flower.png", 220,350,1305,91,-682));
    initLight.includedOnlyMeshes.push(init_planet_label("flower","front/textures/home/planetText/visit.png", 200,300,1209,283,-1315));
    initLight.includedOnlyMeshes.push(init_planet_label("contact","front/textures/home/planetText/careers.png", 80,150,-50,-273,366));
   
    venusInfoTxt = init_planet_label("venusInfo","front/textures/home/venusHover.png", 200,400,-413,400,-919);
    venusInfoTxt.isVisible = false;
    initLight.includedOnlyMeshes.push(venusInfoTxt);
}

function init_planet_label(name,matlPath,h,w,x,y,z){
    var plane = BABYLON.MeshBuilder.CreatePlane(name, {height:h,width:w}, homeScene);
    plane.position = new BABYLON.Vector3(x,y,z);
    
    let planeMatl = new BABYLON.StandardMaterial("labelMal", homeScene);
    // planeMatl.diffuseColor = BABYLON.Color3.Red();
    planeMatl.diffuseTexture = new BABYLON.Texture(matlPath, homeScene);
    planeMatl.opacityTexture = new BABYLON.Texture(matlPath, homeScene);
    planeMatl.alpha = 0.9;
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element

    plane.isPickable = false;
   
    
    if(name === "participate"){
        plane.rotationQuaternion = new BABYLON.Quaternion (0,0.7315,0,0.6817);
    }else if(name === "design"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0189,0.7312, 0.0176,0.6814);
    }else if(name === "special"){
        plane.rotationQuaternion = new BABYLON.Quaternion (0.0250,0.9679,-0.1088,0.2240);
        //plane.rotationQuaternion = new BABYLON.Quaternion (0.0011,0.9740,-0.0053,0.2254);
    }else if(name === "captain"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0682,0.9388,0.0407,0.3346);
        // plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0140,0.9411, 0.0213,0.3363);
    }else if(name === "visit"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0817, 0.7915,0.0937,0.5979);
    }else if(name === "flower"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( -0.0176, 0.9270,0.0615,0.3690);
    }else if(name === "member"){
        plane.rotationQuaternion = new BABYLON.Quaternion (  -0.0124, 0.9133, 0.0279, 0.4056);
    }else if(name === "story"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.2328,0.9158, 0.1327,0.2985);
    }else if(name === "building"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0393,0.8215, -0.1371,0.5518);
    }else if(name === "contact"){
        plane.rotationQuaternion = new BABYLON.Quaternion ( 0.0727, 0.8678,-0.1614,0.4633);
    }else if(name === "venusInfo"){
         plane.rotationQuaternion = new BABYLON.Quaternion (0,  0.9814,-0.0005,0.1912);
    }else{
        plane.rotationQuaternion = new BABYLON.Quaternion (0,0.7315,0,0.6817);
    }

    plane.material = planeMatl;

    return plane;
}


let videoTexture;
let videoTexture2;
let videoHome_obj, videoHome_obj2;
let theVideoMatl;
function add_video_to_mesh(vidNo){
    let mat = new BABYLON.StandardMaterial("videoMat", homeScene);
    // if(vidNo == 2){
    //     videoTexture.video.pause();
    //     videoTexture.currentTime = 0;
    //     if(!isVideoSkipped && !isOverlayRemoved){
    //         document.getElementById('firstVideoOverlay').remove();
    //         document.getElementById('placeholderDiv').remove();
    //     }
    //     videoTexture = videoTexture2;
    //     mat.diffuseTexture = videoTexture;
    //     videoHome_obj.material = mat;            //top disc
    //     videoHome_obj2.material = mat;           //bottom disc
    // }
    if(!videoTexture){
        videoTexture = new BABYLON.VideoTexture("discVideo1", ["front/videos/homeIntro.webm","front/videos/homeIntro.mp4"], homeScene, false, false);
        // videoTexture2 = new BABYLON.VideoTexture("discVideo2", ["front/videos/homeVideoTrim.webm","front/videos/homeVideoTrim.mp4"], homeScene, false, false);
        mat.backFaceCulling = false;
        
        videoTexture.invertX = true;
        
        videoTexture.uOffset = 0.04;
        videoTexture.vOffset = 0.14;

    
        videoTexture.uScale = -1.1;
        videoTexture.vScale = 1.15;
        // videoTexture2.uScale = -1;
        mat.diffuseTexture = videoTexture;

        videoHome_obj.material = mat;           //the top disc
        videoHome_obj2.material = mat;          //the bottom disc
        // videoTexture2.video.pause();
        videoTexture.video.loop = true;
        videoTexture.video.pause();
      
        theVideoMatl = mat;

        // let agreeMatl = new BABYLON.StandardMaterial("agreeMatl", homeScene);
        // agreeMatl.diffuseTexture = new BABYLON.Texture("front/textures/home/information.png", homeScene);
        // agreeMatl.diffuseTexture.hasAlpha = true;
        // agreeMatl.backFaceCulling = false;
        // agreeMatl.invertX = true;
        // agreeCameraUseDisc.material = agreeMatl;
    }
    
    // if(vidNo==2){ 
    //     videoTexture.video.play();
        
    // }
    
   
   
   
}

let webCamScreen;
let myVideo;    
let isAssignedWebcam = false;
let isWebcamEnabled = true;
function enable_webcamera(){

    let videoMaterial = new BABYLON.StandardMaterial("webCamScreenTexture", homeScene);
    videoMaterial.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial.backFaceCulling = false;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(homeScene, function (videoTexture) {
       console.log("webcam",videoTexture)
       videoTexture.vScale = -1;

        myVideo = videoTexture;
        videoMaterial.diffuseTexture = myVideo;
    }, { maxWidth: 256, maxHeight: 256 });

    homeScene.onBeforeRenderObservable.add(function () {
        if (myVideo !== undefined && isAssignedWebcam) {
            if (myVideo.video.readyState == 4){
                videoTexture.video.pause();
                videoHome_obj.material = videoMaterial;

                setTimeout(function(){
                    videoHome_obj.material = theVideoMatl;
                    videoTexture.video.play();
                },5000);
                isAssignedWebcam = false;
            }
        }
    });
}



let homeSun, homeMercury, homeVenus, homeEarth, homeMars, homeJupiter, homeSaturn, homeUranus, homeNeptune, homePluto, homeMoon;
let planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
let redAngle = -0.01;   
let yellowAngle = -0.02;
let grayAngle = 0.005;
function create_home_planets(){
    //create the sun

    homeSun = init_planet("sun","sunMatl","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg",3755,463,-716,250);
    //add glow effect to the sun
    let gl = new BABYLON.GlowLayer("glow", homeScene);
    gl.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
        if (mesh.name === "sun") {
            result.set(235, 192, 52, 0.2);
        }else {
            result.set(0, 0, 0, 0);
        }
    }

    homeMercury = homeSun.clone("homeMercury");
    init_clone_planet(homeMercury,"mercuryMatl","front/textures/home/planets/mercury.jpg","front/textures/home/planets/mercurynormal.jpg", 954,500,-1499,0.5);

    homeVenus = homeSun.clone("homeVenus");
    init_clone_planet(homeVenus,"venusMatl","front/textures/home/planets/venus.jpg","front/textures/home/planets/venusnormal.jpg",-384,201, -1000,0.6);

    homeEarth = homeSun.clone("homeEarth");
    init_clone_planet(homeEarth,"earthMatl","front/textures/home/planets/earth.jpg","textures/planets2/normals/earthnormal.png",1076.28,178.44,515,0.95);
    
    homeMoon = homeSun.clone("homeMoon"); 
    init_clone_planet(homeMoon,"moonMatl","front/textures/home/planets/moon.jpg","front/textures/home/planets/moonnormal.jpg",840,129,465,0.35);

    homeMars = homeSun.clone("homeMars");
    init_clone_planet(homeMars,"marsMatl","front/textures/home/planets/mars.jpg","front/textures/home/planets/marsnormal.jpg",-837,38,55,0.32);

    homeJupiter = homeSun.clone("homeJupiter");
    init_clone_planet(homeJupiter,"jupiterMatl","front/textures/home/planets/jupiter.jpg","front/textures/home/planets/jupiternormal.jpg",215,-212,821,0.6);
    
    homeSaturn = init_planet("homeSaturn","saturnMatl","front/textures/home/planets/saturn.jpg","front/textures/home/planets/saturnnormal.jpg",1091,328,-2390,150);
    let saturnRing = BABYLON.Mesh.CreateGround("rings", 335, 335, 1, homeScene);
    saturnRing.parent = homeSaturn;


    homeSaturn.rotationQuaternion = new BABYLON.Quaternion(0.2302, 0.245,-0.105,0.932);
    let ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", homeScene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/saturnRing2.png", homeScene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;

    homeUranus = homeSun.clone("homeUranus");
    init_clone_planet(homeUranus,"uranusMatl","front/textures/home/planets/uranus3.jpg","front/textures/home/planets/uranusnormal.jpg",1412,55,-732,0.8);

    let uranusRing = BABYLON.Mesh.CreateGround("uranusRing", 490, 490, 1, homeScene);
    uranusRing.parent = homeUranus;

    let ringsMaterial2 = new BABYLON.StandardMaterial("ringsMaterial", homeScene);
    ringsMaterial2.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/uranusRing.png", homeScene);
    ringsMaterial2.opacityTexture = new BABYLON.Texture("front/textures/home/planets/uranusRing.png", homeScene);
    ringsMaterial2.alpha = 0.9;
    ringsMaterial2.diffuseTexture.hasAlpha = true;
    ringsMaterial2.backFaceCulling = false;
    uranusRing.material = ringsMaterial2;

    homeNeptune = homeSun.clone("homeNeptune");
    init_clone_planet(homeNeptune,"neptuneMatl","front/textures/home/planets/neptune.jpg","front/textures/home/planets/neptunenormal.jpg",1326,259,-1414,0.7);
  

    homePluto = homeSun.clone("homePluto");
    init_clone_planet(homePluto,"plutoMatl","front/textures/home/planets/pluto.jpg","front/textures/home/planets/plutonormal.jpg",0.21,-300,346,0.4);
    
 
    initLight.includedOnlyMeshes.push(homeSun);
    initLight.includedOnlyMeshes.push(homeEarth);
    planetsLight.includedOnlyMeshes.push(homeMercury);
    planetsLight.includedOnlyMeshes.push(homeVenus);
    planetsLight.includedOnlyMeshes.push(homeMars);
    planetsLight.includedOnlyMeshes.push(homeJupiter);
    planetsLight.includedOnlyMeshes.push(homeSaturn);
    planetsLight.includedOnlyMeshes.push(homeUranus);
    planetsLight.includedOnlyMeshes.push(homeNeptune);
    planetsLight.includedOnlyMeshes.push(homePluto);
    planetsLight.includedOnlyMeshes.push(homeMoon);
    planetsLight.includedOnlyMeshes.push(saturnRing);
    initLight.includedOnlyMeshes.push(uranusRing);

    add_action_mgr(homeMercury);
    add_action_mgr(homeVenus);
    add_action_mgr(homeEarth);
    add_action_mgr(homeMars);
    add_action_mgr(homeJupiter);
    add_action_mgr(homeSaturn);
    add_action_mgr(homeUranus);
    add_action_mgr(homeNeptune);
    add_action_mgr(homePluto);
    add_action_mgr(homeMoon);
    add_action_mgr(homeSun);

    homeSun.actionManager = new BABYLON.ActionManager(homeScene);
    homeSun.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverSun)
    );
    homeSun.actionManager .registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
            onOutSun)
    );




    //rotate the planets
    
    engine.runRenderLoop(function () {
       
        if(homeScene){
            homeMercury.rotation.y = Math.PI / 2;
            homeMercury.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            homeVenus.rotation.y = Math.PI / 2;
            homeVenus.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            homeEarth.rotation.y = Math.PI / 2;
            homeEarth.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            homeMoon.rotation.y = Math.PI / 2;
            homeMoon.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            homeMars.rotation.y = Math.PI / 2;
            homeMars.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            homeJupiter.rotation.y = Math.PI / 2;
            homeJupiter.rotate(planetAxis, yellowAngle, BABYLON.Space.LOCAL);
            homeSaturn.rotation.y = Math.PI / 2;
            homeSaturn.rotate(planetAxis, yellowAngle, BABYLON.Space.LOCAL);
            homeUranus.rotation.y = Math.PI / 2;
            homeUranus.rotate(planetAxis, yellowAngle, BABYLON.Space.LOCAL);
            homeNeptune.rotation.y = Math.PI / 2;
            homeNeptune.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            homePluto.rotation.y = Math.PI / 2;
            homePluto.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    let temp = BABYLON.Mesh.CreateSphere(name, 30, radius, homeScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    let temp_material = new BABYLON.StandardMaterial(material_name,homeScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, homeScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,homeScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp.material = temp_material;

    return temp;
}//end of init planet function


function init_clone_planet(temp,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,scale){
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    let temp_material = new BABYLON.StandardMaterial(material_name,homeScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, homeScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,homeScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);

    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();

    if(temp.name === "homeUranus"){
        temp.rotationQuaternion =  new BABYLON.Quaternion( 0.1342,0.0422,-0.0156, 0.9898);
    }else if(temp.name === "homeJupiter"){
        temp.rotationQuaternion =  new BABYLON.Quaternion(-0.1126,0.1480,-0.1873,0.9645);
    }else if(temp.name === "homeMars"){
         temp.rotationQuaternion =  new BABYLON.Quaternion(-0.0111,0.0016,-0.1497,0.9886);
    }

}//end of init planet function

let homeGizmo;
function enable_home_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(homeScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
   homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;
   
}



var onOverPlanet =(meshEvent)=>{
    origScaling = meshEvent.source.scaling;
    meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.1,origScaling.y*1.1,origScaling.z*1.1);
    if(meshEvent.source.name === "homeVenus"){
        venusInfoTxt.isVisible = true;
    }
};

//handles the on mouse out event
var onOutPlanet =(meshEvent)=>{
    meshEvent.source.scaling = origScaling;
    venusInfoTxt.isVisible = false;
    //part of the 3d text on hover on mesh
    // console.log("out planet");
};



var onOverSun =(meshEvent)=>{
  
    var theMeshID = meshEvent.source.id 
    if(initWebCamScreen){
        if(theMeshID == "sun"){
            initWebCamScreen.setEnabled(true);
            initWebCamScreen.isVisible = true;  
            console.log(" cam's position: ",initCamera.position, initWebCamScreen.radius);
           
            let camX = initCamera.position.x;
            let camY = initCamera.position.y;
            let camZ = initCamera.position.z;
            let x = 3536;
            let y = 461;
            let z = -648;

            if(camX< 850 && camX >=-900){
            	if(camZ > 0){
                   x = 3538;
                   z = -634;
                }
            }else if(camX <-900 && camX >= -1000){
            	if(camZ > 0) x = 3550;
                else{
                   x = 3615;
                   z = -710;
                }
            }else if(camX<-1000 && camX>=-1050){ //from -1000 to -1050
                if(camZ > 0) x = 3560;
                else{
                   x = 3609;
                   z = -715;
                }
            }else if(camX<-1050 && camX>=-1110){
                
                if(camZ > 0) x = 3550;
                else{
                    x = 3525;
                    z = -709;
                }
            }else if(camX<-1110 && camX>=-1120){
                if(camZ > 0) x = 3550;
                else{
                    x = 3500;
                    z =  -709;
                }
            }else if( camX<-1120 && camX>=-1130){
                if(camZ > 0) x = 3500;
                else{
                    x = 3618;
                    z = -713;
                }
            }else if( camX<-1130 && camX>=-1140){
                if(camZ > 0) x = 3500;
                else{
                    x = 3622;
                    z =  -712;
                }
            }else if( camX<-1140 && camX>=-1160){
                if(camZ > 0) x = 3500;
                else{
                    x = 3487;
                    z = -703;
                }
            }else if( camX<-1160 && camX>=-1180){
                if(camZ > 0) x = 3500;
                else{                 
                    x = 3550;
                    z = -685;
                }
            }else if( camX < -1180 && camX>=-1245){
                if(camZ > 0) x = 3450;
                else{
                    x = 3527;
                    z = -696;
                }
            }else if( camX < -1245 && camX>=-1270){
                if(camZ > 0) x = 3530;
                else{
                   x = 3621; 
                   z = -697;
                }
            }else if( camX < -1270 && camX>=-1300){
                if(camZ > 0) x = 3530;
                else{
                    x = 3633;
                    z = -699;
                }
            }else if(camX < -1300 && camX >= -1350){
                if(camZ > 0) x = 3400;
                else{
                    x = 3528;
                    z = -688;
                }
                 
            }else if(camX < -1350 && camX >= -1400){
                if(camZ > 0) x = 3530;
                else{
                    x = 3529;
                    z = -683;
                }
            }

            if(camY>0 && camY <= 250) y = 450;
            else if(camY>-300 && camY <= 0) y = 425;
            else if(camY>-450 && camY <= -300) y = 420;
            else if(camY>-550 && camY <= -450) y = 415;
            else if(camY>-650 && camY <= -550) y = 409;
            else if(camY>-700 && camY <= -650) y = 409;
            // else if() y = 

            else if(camY>-750 && camY <= -700) y = 405;
            else if(camY>-900 && camY <= -750) y = 400;


            initWebCamScreen.position = new BABYLON.Vector3(x,y,z);
        } 
    } 
};

//handles the on mouse out event
var onOutSun =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    if(initWebCamScreen){
        initWebCamScreen.scaling = new BABYLON.Vector3(1,1,1);
        initWebCamScreen.setEnabled(false);
        initWebCamScreen.isVisible = false; 
    }
};


function add_action_mgr(thePlanet){
    thePlanet.actionManager = new BABYLON.ActionManager(homeScene);
    thePlanet.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanet
        )
    );
    thePlanet.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );
}



//######################################################### FUNCTIONS TO CREATE TEXTS BELOW THE HALO #############################################################
let solarTextMap = new Map([
    [1,{
        "images":['text1.png','text2.png','text3.png','text4.png','text5.png','text6.png'],
        "imagesPos":[{x:0,y:0,z:0},{x:0,y:0,z:0},{x:0,y:0,z:0},{x:0,y:0,z:0},{x:0,y:0,z:0},{x:0,y:0,z:0}]
        }
    ],
]);

let solarTextObjects = new Map();
let currSolarText;
function init_texts(){

    let solar = BABYLON.MeshBuilder.CreatePlane("First Plane", {width:957, height: 782}, homeScene);
    solar.position = new BABYLON.Vector3( 1003.42,-2104,780.96);
    solar.rotationQuaternion = new BABYLON.Quaternion(-0.0311, -0.7644, 0.1500, -0.6259);

   
   var solarMatl = new BABYLON.StandardMaterial("plane1", homeScene);
   solarMatl.diffuseTexture = new BABYLON.Texture("front/images3D/homeScene/solarSitting2.png", homeScene);
   solarMatl.opacityTexture = new BABYLON.Texture("front/images3D/homeScene/solarSitting2.png", homeScene);
    solarMatl.backFaceCulling = false;

    enable_home_gizmo(solar);

    solar.material = solarMatl;

    initLight.includedOnlyMeshes.push(solar);
    
    let theParent;
    for(i=0;i<6;i++){
        
        let name = solarTextMap.get(1).images[i];
        let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:1500, height: 840}, homeScene);
        plane.position = new BABYLON.Vector3(621.199,-2000,-400);
        plane.rotation.y = BABYLON.Tools.ToRadians(130);
        plane.rotation.x = BABYLON.Tools.ToRadians(20);
        // plane.rotation.z = 0.37;
        let planeMatl = new BABYLON.StandardMaterial("solarText"+i, homeScene);
        planeMatl.diffuseTexture = new BABYLON.Texture('front/images3D/homeScene/'+name, homeScene);
        planeMatl.diffuseTexture.hasAlpha = true;
        planeMatl.backFaceCulling = false;
        plane.material = planeMatl;

        initLight.includedOnlyMeshes.push(plane);

        solarTextObjects.set(name,plane);

        // if(i>0){
        //      plane.isVisible = false;
        // }
        // else currSolarText = plane;
        
    }

    //  // Plane
    //  var plane = BABYLON.Mesh.CreatePlane("nextBtn", 500);
    // //  plane.parent = theParent;
    //  plane.position.y = -500;
    // // enable_home_gizmo(plane);

    // plane.position = new BABYLON.Vector3(417.36,-2290.68,-217.55);
    // plane.rotationQuaternion = new BABYLON.Quaternion(0.0368,0.8782,-0.1402,0.4556);
 

 
    //  // GUI
    //  var advancedTexture2 = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(plane);
 
    //  var panel2 = new BABYLON.GUI.StackPanel();  
    //  panel2.top = "100px";
    //  advancedTexture2.addControl(panel2);    
 
    //  var button1 = BABYLON.GUI.Button.CreateSimpleButton("nextBtn", " >> ");
    //  button1.width = 0.5;
    //  button1.height = "100px";
    //  button1.color = "white";
    //  button1.fontSize = 60;
    //  button1.background = "green";
    //  panel2.addControl(button1);
   
    // let plane = BABYLON.MeshBuilder.CreatePlane("First Plane", {width:2000, height: 1000}, homeScene);
    // plane.position.y = -1800;
    // plane.position.z = -320;
    // plane.position.x = 400;
    // plane.rotationQuaternion = new BABYLON.Quaternion(-0.0650, -0.8885,  0.1388, -0.4322);

    // // enable_home_gizmo(plane);
   
    // let discmatl = new BABYLON.StandardMaterial("planeMatl", homeScene);
    // discmatl.diffuseColor = new BABYLON.Color3(1,0,0);
    // discmatl.backFaceCulling = false;
    // // discmatl.alpha = 0.5;
    
    // plane.material = discmatl;
    
    // var advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(plane);

    // // var panel2 = new BABYLON.GUI.StackPanel();  
    // // panel2.top = "100px";
    // // advancedTexture2.addControl(panel2);    

    // var sv = new BABYLON.GUI.ScrollViewer();
    // sv.thickness = 0;
    // // sv.color = "green";
    // sv.width = 1;
    // sv.height = 1;
    // // sv.barBackground = "black";
    // sv.barColor = "green";

    // sv.thumbLength = 0.1;
    // sv.thumbHeight = 0.1;

    // console.log("the thumb: ",sv);
    

    // sv.onPointerDownObservable.add(function() {
    //     initCamera.detachControl(canvas);
    // });
    // sv.onPointerUpObservable.add(function() {
    //     initCamera.attachControl(canvas,true);
    // });

    // advancedTexture.addControl(sv);

    // var rc = new BABYLON.GUI.Rectangle();
    // rc.thickness = 0;
    // rc.width = 1;
    // rc.height = 5;
    // rc.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
    // rc.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;


    // console.log(rc);

   
    // sv.addControl(rc);

    // var image = new BABYLON.GUI.Image("solarTexts", "front/images3D/homeScene/solarSpeech.png");
    // image.width = 1;
    // image.height = 1;
    // rc.addControl(image);
}


function create_text_plane(){

}





    



//FUNCTIONS BELOW TO BE FIXED

let initVideo;  
let initWebCamScreen,initWebCamScreen22;  
function enable_init_webcamera(){
    // console.log("this is called");
    var isAssigned = false; // Is the Webcam stream assigned to material?

    initWebCamScreen = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen", {radius:110, tessellation: 0}, homeScene);
    initWebCamScreen.position = new BABYLON.Vector3(3536,461,-648);
    initWebCamScreen.isPickable = false;
    initWebCamScreen22 = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen22", {radius:110, tessellation: 0}, homeScene);
    initWebCamScreen22.position = new BABYLON.Vector3(3536,461,-648);
   
    initLight.includedOnlyMeshes.push(initWebCamScreen);
    initLight.includedOnlyMeshes.push(initWebCamScreen22);

    initWebCamScreen.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen22.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen.setEnabled(false);
    initWebCamScreen.isVisible = false;
     initWebCamScreen22.setEnabled(false);
    initWebCamScreen22.isVisible = false;
  
    var videoMaterial2 = new BABYLON.StandardMaterial("initWebCamScreenTexture", homeScene);
    videoMaterial2.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial2.backFaceCulling = false;  


 var videoMaterial3 = new BABYLON.StandardMaterial("initWebCamScreenTexture", homeScene);
    videoMaterial3.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial3.backFaceCulling = false;  

    initWebCamScreen22.material = videoMaterial3;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(homeScene, function (videoTexture2) {
        initVideo = videoTexture2;
        videoMaterial2.diffuseTexture = initVideo;
        // console.log("init video",initVideo);
    }, { maxWidth: 256, maxHeight: 256 });
    // console.log(initVideo);
    // When there is a video stream (!=undefined),
    // check if it's ready          (readyState == 4),
    // before applying videoMaterial to avoid the Chrome console warning.
    // [.Offscreen-For-WebGL-0xa957edd000]RENDER WARNING: there is no texture bound to the unit 0
    homeScene.onBeforeRenderObservable.add(function () {
        if (initVideo !== undefined && isAssigned == false) {
            if (initVideo.video.readyState == 4) {
                initWebCamScreen.material = videoMaterial2;
                 // initWebCamScreen22.material = videoMaterial2;
                isAssigned = true;
            }
        }
    });

}//end of function


let currCamTarget;
let cnt = 0;
let theTexts = ['text1.png','text2.png','text3.png','text4.png','text5.png','text6.png']
let textCnt = 1;
function add_home_mouse_listener(){
        var onPointerDownInit = function (evt) {
            
            if(homeScene) var pickinfo = homeScene.pick(homeScene.pointerX, homeScene.pointerY);
            else return;
          
           
            if(pickinfo.hit){
              
                let theInitMesh = pickinfo.pickedMesh;
                console.log("clicked:", theInitMesh.name, theInitMesh.position, theInitMesh.rotationQuaternion);

                
                // if(theInitMesh.name == "nextBtn"){
                //     console.log("i am here", currSolarText);
                //     currSolarText.isVisible = false;
                //     let name = theTexts[textCnt];
                //     let plane = solarTextObjects.get(name);
                //     plane.isVisible = true;
                //     currSolarText = plane;
                //     textCnt++;
                //     if(textCnt == 6) textCnt = 0;
                    
                // }
                
                if(theInitMesh.name === "a"){
                    agreeCameraUseDisc.isVisible = false;
                    initCamera.attachControl(canvas,true);
                    setTimeout(function(){
                         videoTexture.video.play();
                    },1000);

                    setTimeout(function(){
                        isAssignedWebcam = true;
                       
                    },5000);

                }else if(theInitMesh.name === "homeEarth"){
                    // initCamera.setTarget(theInitMesh);
                    window.open('participateMbaye',"_self");     
                }else if(theInitMesh.name === "homeMars"){
                    window.open('captainMbaye',"_self");     
                }else if(theInitMesh.name === "testdome_mesh"){
                    // initCamera.position = new BABYLON.Vector3(0,-800,0);
                }else if(theInitMesh.name === "homeNeptune"){
                    // initCamera.setTarget(theInitMesh);
                    // initCamera.radius = 400;
                    window.open('visitingMbaye',"_self");
                }else if(theInitMesh.name === "sun"){
                    // window.open('http://localhost/mbaye-faith/index.php/home/login',"_self");     
                }else if(theInitMesh.name === "homeMoon"){
                    // window.open('MbayeGamePage.php',"_self");     
                }
                else if(theInitMesh.name === "homeUranus"){
                    window.open('flowersMbaye',"_self");     
                }else if(theInitMesh.name === "homeJupiter"){
                    let cNo = $('#storyChapter').val();
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
                if(theInitMesh.name === "homeSun" || theInitMesh.name === "sun"){
                    window.open('login',"_self");     
                }

            
           }
           
        }//end of on pointer down function

        var onPointerUpInit = function (evt) {
              
        }//end of on pointer up function

        var onPointerMoveInit = function (evt) {
          
        }//end of on pointer move function

        canvas.addEventListener("pointerdown", onPointerDownInit, false);
        canvas.addEventListener("pointerup", onPointerUpInit, false);
        canvas.addEventListener("pointermove", onPointerMoveInit, false);


        //remove the text span on dispose
        homeScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDownInit);
            canvas.removeEventListener("pointerup", onPointerUpInit);
            canvas.removeEventListener("pointermove", onPointerMoveInit);

        };
    
}//end of listen to mouse function





/* HALO ASTEROID BELT */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

var nb = 50;       //number of particles
var grey = 0.0;
var alpha = Math.PI;
function create_home_asteroid_belt(){


    var url = "textures/asteroid/rock.jpg";
    var mat = new BABYLON.StandardMaterial("mat1", homeScene);
    var texture = new BABYLON.Texture(url, homeScene);
    mat.diffuseTexture = texture;
    mat.backFaceCulling = false;

     // var pl = new BABYLON.PointLight("pl", new BABYLON.Vector3(0, 0, 0), homeScene);
     //  pl.diffuse = new BABYLON.Color3(1, 1, 1);
     //  pl.specular = new BABYLON.Color3(0.1, 0.1, 0.12);
     //  pl.intensity = 0.75;
     //  // Particle system creation : immutable
     //  // ====================================
     //  var SPS = new BABYLON.SolidParticleSystem('SPS', homeScene, {updatable: false});
      
     //  SPS.addShape(sphere, 500, {positionFunction: myPositionFunction, vertexFunction: myVertexFunction});
     //  sphere.dispose();   // dispose the model
     //  var mesh = SPS.buildMesh();
     //  mesh.material = mat;
   

    
    // var rock = BABYLON.Mesh.CreateSphere("s", 0.5, 16, homeScene);
    // var rock_material = new BABYLON.StandardMaterial("rock_material", homeScene);
    // rock_material.diffuseTexture = new BABYLON.Texture("textures/asteroid/rock.jpg", homeScene);
    // rock_material.diffuseTexture.uScale = 16;
    // rock_material.diffuseTexture.vScale = 16;
    // rock_material.backFaceCulling = false;

    var mat = new BABYLON.StandardMaterial("mat1", homeScene);
    var texture = new BABYLON.Texture("textures/asteroid/rock2.jpg", homeScene);
    mat.diffuseTexture = texture;
    mat.backFaceCulling = false;

    // SPS creation : Immutable {updatable: false}
    var SPS = new BABYLON.SolidParticleSystem('SPS', homeScene, { updatable: false });
    var sphere = BABYLON.MeshBuilder.CreateSphere("s", {diameter: 0.5, segments: 8}, homeScene);
    SPS.addShape(sphere, nb, { positionFunction: myPositionFunction, vertexFunction: myVertexFunction });
    
    sphere.dispose();
    var mesh = SPS.buildMesh();
    mesh.material = mat;
    // SPS.mesh.material = rock.material;
    SPS.mesh.rotation.y = 90;
    SPS.mesh.rotation.x = Math.PI / 2;

    

    var t = 0.0;
    var k = 0.0;
    var a=0.0;
    var b=0.0;
     var alpha = Math.PI;
    homeScene.registerBeforeRender(function () {
        SPS.mesh.rotation.z = t / 50;

         // SPS.mesh.position.addInPlace(new BABYLON.Vector3(Math.sin(alpha)*1, 0, Math.cos(alpha)*5));
         // alpha += 0.005;
        t += 0.5;
        // SPS.mesh.position.y = Math.sin(k) * 1;
         // SPS.mesh.position.x = Math.sin(a) * 1;
          // SPS.mesh.position.y = Math.sin(k) * 1;
        k -= 0.03;
        a -= 10;
        b -= 0;
    });
   
//       homeScene.beforeRender = function () {
//         SPS.mesh.position = new BABYLON.Vector3(300*Math.sin(alpha),80, 800*Math.cos(alpha));
//         SPS.mesh.rotation.y += .03;
//         // console.log(SPS.mesh.position);
//         // moon.position = planet.position;
//         // moon.rotation.y -= .1;
        
//         // moon.position = new BABYLON.Vector3(5 * Math.sin(alpha-.8), moon.parent.position.y, 5 * Math.cos(alpha-.8));
                
//         alpha += 0.009;
                
//         // spin
// //      planet.rotate(BABYLON.Axis.Y, 0.05, BABYLON.Space.WORLD);
// //      planet.rotate(BABYLON.Axis.Y, 0.05, BABYLON.Space.LOCAL);
// //      moon.rotate(BABYLON.Axis.Y, -0.05, BABYLON.Space.LOCAL);
//     };

}

  var myVertexFunction = function (particle, vertex, i) {
        // vertex.x *= (Math.random() + 1) / getRandomInt(5, 7);
        // vertex.y *= (Math.random() + 1) / getRandomInt(5, 7);
        // vertex.z *= (Math.random() + 1) / getRandomInt(5, 7);
          vertex.x *= (Math.random() + 0.7);
          vertex.y *= (Math.random() + 0.7);
          vertex.z *= (Math.random() + 0.7);
    };

    var myPositionFunction = function (particle, i, s) {
       
        var TWO_PI = Math.PI * 2;
        var angle =  TWO_PI/ nb;
         var angle2 =  Math.PI * 4;
        var x, y;

         // SPS.mesh.position = new BABYLON.Vector3(500 * Math.sin(alpha),0, 1000 * Math.cos(alpha));
         x = getRandomInt(400, 500) * Math.sin(angle * i);
        z = getRandomInt(600, 700) * Math.cos(angle * i);
        // x = getRandomInt(90, 100) * 10*Math.sin(angle * i);
        // z = getRandomInt(90, 100) * 0.9*Math.cos(angle * i);

        // // // // x = Math.random(500) * Math.sin(angle * 50);
        // // // // z = Math.random(500) * Math.cos(angle * 100);

        particle.position.x = x;
        particle.position.y = z;
        // // particle.position.z = (Math.random() - 1.5*5) * 7*5;
        // // particle.position.z = (Math.random() - 1.5) * 7;
        particle.position.z = (Math.random() - 1.5) *100;

        particle.scale.x = getRandomInt(5*2, 35*3) / 10*3;
        particle.scale.y = getRandomInt(5*2, 35*3) / 10*3;
        particle.scale.z = getRandomInt(5*2, 35*3) / 10*3;

        particle.rotation.x = Math.random() * 3.15;
        particle.rotation.y = Math.random() * 3.15;
        particle.rotation.z = Math.random() * 1.5;

        grey = 1.0 - Math.random() * 0.3;
        particle.color = BABYLON.Color3.White();
    };




   

            //create the game engine
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);
//create the scene
var theScene = createScene();
var i=0;
let isInitCameraMoving = false;
let isIntroDone = false;
let TWO_MIN=2.3*60*1000;

//check the lenght of the video and set the length of video1 so we know where it stops
theScene.executeWhenReady(function () {   
    document.getElementById("loadingScreenPercent").style.visibility = "hidden";
    document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
    document.getElementById("loadingScreenDiv").remove();
    homeScene.debugLayer.show();
    isHomeCounterReady = true;
    
  
    if(videoTexture){
        videoTexture.video.play();
    }
   
    
   
    // startTime = new Date();

    engine.runRenderLoop(function () {

        if(theScene){
            theScene.render();
     
        }    
    }); 
}); 

// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
});


let theCanvas = document.getElementById("canvas");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;


// let isFirstClick = false;
// let isVideoSkipped = false;

// $('#firstVideoOverlay').click(function() {
//     if(!isIntroDone){
//         $(this).hide();
//         if(!isFirstClick){
//                 $(".overlayTxt").removeAttr("id");
//                 $(".overlayTxt").removeClass( "overlayTxt" ).addClass("glowOverlayTxt");
//                 isFirstClick = true;
//         }
//     }
// }); 

// $( '#placeholderDiv').click(function() {
//     if(!isIntroDone){
//         $('#firstVideoOverlay').show();
//     }
//   });

// $('#skipVideo').on('click', function(evt){
//     add_video_to_mesh(2);
//     isVideoSkipped = true;
//     document.getElementById('firstVideoOverlay').remove();
//     document.getElementById('placeholderDiv').remove();
// });   

// let isOverlayRemoved = false;
// $('#hideOverlay').on('click', function(evt){
//     document.getElementById('firstVideoOverlay').remove();
//     document.getElementById('placeholderDiv').remove();
//     isOverlayRemoved = true;
// }); 

let isVideoPlaying = true;
$(document).keydown(function(event) { 
  
    if(event.key===" "){
        console.log('You pressed down space'); 
        if(videoTexture.video){
            if(isVideoPlaying){ 
                videoTexture.video.pause();
                isVideoPlaying = false;
            }
            else{
                
                videoTexture.video.play();
                isVideoPlaying = true;
            }
        }
        
    }
}); 

