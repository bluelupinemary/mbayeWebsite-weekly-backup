
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
const UPPER_RADIUS_VAL = 3000;                                      //zoom out limit
var isHomeReady = false;

let theCurrRadius;
let isCharViewActive = false;

let charImgMap = new Map([
    //key, val[position, alpha, beta, radius]

    ['InitialView',[{x: 0, y: 0, z: 0},2.4706,1.2283, 1400]],
    ['Ruru',[{x:463,y:3988, z:-1858},2.3873,1.5126,0.1]],
    ['Solar',[{x:-1581,y:-2052, z:-83},2.4736,1.2661,100]],
    ['Ally',[{x:-834,y:1781, z:4093},4.4214,1.4373,30]],
    ['William',[{x:2810,y:3902, z:1922},3.1701,1.5520,0.1]],
    ['Villa',[{x:-885,y:-4200, z:4160}, 4.8796,1.4463,0.1]],
    ['Bruce',[{x:-5617,y:-856, z:-1729},6.549,1.4465,0.1]],
    ['Trevor',[{x:-3140,y:1746, z:-3836},1.0788,1.5568,30]],
    ['Manny',[{x:3237,y:-696, z:3860},4.3098,1.5425,0.1]],
]);





function createScene(){
    engine.enableOfflineSupport = true;
    BABYLON.Database.IDBStorageEnabled = true;

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
    // enable_webcamera();
   

    enable_init_webcamera();

    create_characters();

    create_video_functions();
    homeScene.collisionsEnabled = true;
    hl = new BABYLON.HighlightLayer("hl1", homeScene);
   
   
    return homeScene;
} //end of create scene function



//function that creates the scene's cameras
function create_init_camera(){
    let camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,900),homeScene);

    //set zoom in and zoom out capability
    camera.allowUpsideDown = false;
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
    camera.panningDistanceLimit = 6000;
    camera.attachControl(canvas,true);
    camera.pinchPrecision = 1;
    homeScene.activeCamera = camera;
    camera.maxZ = 25000;
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
    var skybox = BABYLON.MeshBuilder.CreateBox("initSkybox", {size:20000.0}, homeScene);
   
    skybox.position = new BABYLON.Vector3(942,-500,-1500);

    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.infiniteDistance = true;
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
    skybox.checkCollisions = true;
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function


var mbayeInit_object;
var mbayeInitTask;
var initEarth_object;
var agreeCameraUseDisc;
function load_home_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/homeScene/", "homeDisc.glb", homeScene,
                    function (evt) {
                    // onProgress
                    var loadedPercent = 0;
                    if (evt.lengthComputable) {
                        loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                    } else {
                        var dlCount = evt.loaded / (1024 * 1024);
                        loadedPercent = Math.floor(dlCount * 100.0) / 100.0;
                    }
                    document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
            }).then(function (result){
                    for(var i=0;i<result.meshes.length;i++){
                        if(result.meshes[i].name === "top"){
                            videoHome_obj = result.meshes[i];
                            add_action_mgr(videoHome_obj);
                        }else if(result.meshes[i].name === "bot"){
                            videoHome_obj2 = result.meshes[i];
                            videoHome_obj2.isPickable = false;
                            videoHome_obj2.name = "top";
                        }
                    }
                  
                    result.meshes[1].isVisible = false;
                    result.meshes[1].setParent(result.meshes[3]);
                    result.meshes[2].setParent(result.meshes[3]);
                    result.meshes[4].setParent(result.meshes[3]);
                    
                    agreeCameraUseDisc = result.meshes[1];

                    let browser = testBrowser();
                    if(browser === 'Safari'){
                        result.meshes[3].position = new BABYLON.Vector3(-41.27, 37.91,-58.68);
                        result.meshes[3].rotationQuaternion = new BABYLON.Quaternion(0.8909,-0.0453,-0.4411,-0.0977);
                    }else{
                        result.meshes[3].position = new BABYLON.Vector3( -54, -10,-68);
                        result.meshes[3].rotationQuaternion = new BABYLON.Quaternion( 0.0437,0.8910,0.0985,-0.4409);
                    }
        })

    ]).then(() => {
        //remove code below when testing in ios
        add_video_to_mesh(1);
    
        initLight.includedOnlyMeshes.push(videoHome_obj);
        initLight.includedOnlyMeshes.push(videoHome_obj2);
        initLight.includedOnlyMeshes.push(agreeCameraUseDisc);
        
        initCamera.target = new BABYLON.Vector3(0,0,0);
        initCamera.radius = 1400;

        
       
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

//======================================= INITIALIZE VIDEO FUNCTIONS ICONS ============================================================

function create_video_functions(){
    let play = init_music_icon("playIcon", "playMusic.png", 100,100,{x:-142,y:-40,z:95},{x: -0.3377, y: 0.5646, z: 0.7043, w: 0.2660});
    let pause = init_music_icon("pauseIcon", "pauseMusic.png", 100,100,{x:-142,y:-39,z:95},{x: -0.3377, y: 0.5646, z: 0.7043, w: 0.2660});

    if(isSmallDevice() || isMobile()){
        play.position = new BABYLON.Vector3(347,102,-303);
        pause.position = new BABYLON.Vector3(347,102,-303);
        play.isVisible = true;
        pause.isVisible = true;
        play.isPickable = true;
        pause.isPickable = true;
    }
}

function init_music_icon(name,imgName,w,h,pos,rot){
    let temp = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, homeScene);
    temp.position = new BABYLON.Vector3(pos.x, pos.y, pos.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
    temp.isVisible = false;
 
    var tempMatl = new BABYLON.StandardMaterial(name+"Matl", homeScene);
    tempMatl.diffuseTexture = new BABYLON.Texture("front/images3D/"+imgName, homeScene);
    tempMatl.opacityTexture = new BABYLON.Texture("front/images3D/"+imgName, homeScene);
    tempMatl.backFaceCulling = false;
    temp.material = tempMatl;
    initLight.includedOnlyMeshes.push(temp);
    
    return temp;
}

//======================================= END OF INITIALIZE VIDEO FXNS ICONS =====================================================


let videoTexture;
let videoTexture2;
let discvideoTexture;
let videoHome_obj, videoHome_obj2;
let theVideoMatl;
function add_video_to_mesh(vidNo){
    let mat = new BABYLON.StandardMaterial("videoMat", homeScene);
   
    if(!discvideoTexture){
        discvideoTexture = new BABYLON.VideoTexture("discVideo1", ["front/videos/homeIntro.webm","front/videos/homeIntro.mp4"], homeScene, true, false,{ streaming: true, autoplay: true });
        
        mat.backFaceCulling = false;
        
        let browser = testBrowser();
        if(browser === 'Safari'){
            //for safari
            discvideoTexture.uOffset = 0;
            discvideoTexture.vOffset = 0.020;
            discvideoTexture.uScale = 1.030;
            discvideoTexture.vScale = 2.510;
            discvideoTexture.uAng = 1.078;
        }else{
            discvideoTexture.uOffset = 0.04;
            discvideoTexture.vOffset = 0.14;
            discvideoTexture.uScale = -1.1;
            discvideoTexture.vScale = 1.15;
        }
        



        mat.diffuseTexture = discvideoTexture;
        videoHome_obj.material = mat;           //the top disc
        // videoHome_obj2.material = mat;          //the bottom disc
        // videoTexture2.video.pause();
        discvideoTexture.video.loop = true;
        discvideoTexture.video.autoUpdateTexture = true;
        discvideoTexture.video.pause();
      
        theVideoMatl = mat;
    }

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

       videoTexture.vScale = -1;

        myVideo = videoTexture;
        videoMaterial.diffuseTexture = myVideo;
    }, { maxWidth: 256, maxHeight: 256 });

   
}



let homeSun, homeMercury, homeVenus, homeEarth, homeMars, homeJupiter, homeSaturn, homeUranus, homeNeptune, homePluto, homeMoon;
let planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
let redAngle = -0.01;   
let yellowAngle = -0.02;
let grayAngle = 0.005;
let sunOrigTexture;
let sunGlowLayer;
function create_home_planets(){
    //create the sun

    homeSun = init_planet("sun","sunMatl","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg",3755,463,-716,250);
    //add glow effect to the sun
    sunGlowLayer = new BABYLON.GlowLayer("glow", homeScene);
    sunGlowLayer.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
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

let planetsMap = new Map();
//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    let temp = BABYLON.Mesh.CreateSphere(name, 0, radius, homeScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    let temp_material = new BABYLON.StandardMaterial(material_name,homeScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, homeScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,homeScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp.material = temp_material;

    planetsMap.set(temp.name);

    if(name === "sun") sunOrigTexture = temp_material.diffuseTexture;

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

    planetsMap.set(temp.name);

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
    //{x: 3531.764649204403, y: 461, z: -671.8764069833452}
    // console.log(homeGizmo);
}


let charTooltip;
var onOverPlanet =(meshEvent)=>{
    if(charImgMap.has(meshEvent.source.name)){
        charTooltip = document.createElement("span");
        charTooltip.setAttribute("id", "charTooltip");
        var sty = charTooltip.style;
        sty.position = "absolute";
        sty.lineHeight = "1.2em";
        sty.padding = "0.2%";
        sty.color = "#00BFFF";
        sty.fontFamily = "Courgette-Regular";
        sty.fontSize = "1.5em";
        sty.top = (homeScene.pointerY - 50) + "px";
        sty.left = (homeScene.pointerX +50) + "px";
        sty.cursor = "pointer";

        document.body.appendChild(charTooltip);
        if(currCamTarget!= meshEvent.source.name) charTooltip.textContent = "View";
        else charTooltip.textContent = "Return";

        origScaling = meshEvent.source.scaling;
        meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.1,origScaling.y*1.1,origScaling.z*1.1);

    }else if(planetsMap.has(meshEvent.source.name)){
        origScaling = meshEvent.source.scaling;
        meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.1,origScaling.y*1.1,origScaling.z*1.1);
 
    }else if(meshEvent.source.name === "top" && (!isSmallDevice() && !isMobile())){
        if(isVideoPlaying) homeScene.getMeshByName("pauseIcon").isVisible = true;
        else homeScene.getMeshByName("playIcon").isVisible = true;
    }

    if(meshEvent.source.name === "homeVenus"){
        venusInfoTxt.isVisible = true;
    } 
};


//handles the on mouse out event
var onOutPlanet =(meshEvent)=>{
    if(charImgMap.has(meshEvent.source.name)){
        while (document.getElementById("charTooltip")) {
            document.getElementById("charTooltip").parentNode.removeChild(document.getElementById("charTooltip"));
        }
        meshEvent.source.scaling = origScaling;
        venusInfoTxt.isVisible = false; 
    }else if(planetsMap.has(meshEvent.source.name)){
        meshEvent.source.scaling = origScaling;
        venusInfoTxt.isVisible = false;
    }
    
    if(meshEvent.source.name === "top" && (!isSmallDevice() && !isMobile())){
        homeScene.getMeshByName("pauseIcon").isVisible = false;
        homeScene.getMeshByName("playIcon").isVisible = false;
    }
    
    
  
};



var onOverSun =(meshEvent)=>{
    var theMeshID = meshEvent.source.id;
  
    let lbl = document.createElement("span");
    lbl.setAttribute("id", "sunLbl");
    var sty = lbl.style;
    sty.position = "absolute";
    sty.lineHeight = "1.5em";
    sty.padding = "0.2%";
    sty.color = "#efad0c";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "1.5em";
    sty.top = meshEvent.pointerY + "px";
    sty.left = meshEvent.pointerX + "px";
    sty.cursor = "pointer";
    
 
    if(initWebCamScreen){
        if(theMeshID == "sun"){
           
            // homeSun.material.diffuseTexture = initVideo;
            homeSun.material.diffuseTexture = initVideo;
            sunGlowLayer.intensity = 0;

            document.body.appendChild(lbl);
            lbl.textContent = "All About You";


        } 
    } 
};

//handles the on mouse out event
var onOutSun =(meshEvent)=>{
    if(!isMobile()) homeSun.material.diffuseTexture = sunOrigTexture;
    while (document.getElementById("sunLbl")) {
        document.getElementById("sunLbl").parentNode.removeChild(document.getElementById("sunLbl"));
    } 
    sunGlowLayer.intensity = 1;
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
//function to create the text speech of solar
function create_characters(){
    //create solar's image
    let solar = init_char_image("Solar","solarSitting2.png",1100,898,{x:1315,y:-2825,z:-315.96},{x:-0.0610, y:-0.8762, z:0.1403, w:-0.4562});
    init_scrollable_viewer("SolarText","solarText.png",3000,2000,{x:37,y:-2810,z:-1934},{x:-0.0659,  y:-0.8884, z:0.1383, w:-0.4323});
    add_action_mgr(solar);

  
    let ruru = init_char_image("Ruru","ruruHome.png",1000,433,{x:2136,y:3857,z:-2348},{x:-0.0112, y:-0.9151, z:0.0009, w:-0.4019});
    init_scrollable_viewer("RuruText","ruruText.png",1542,1000,{x:1265,y:3912,z:-3125},{x:0.0089, y:0.9193, z:-0.0253, w:0.3919});
    add_action_mgr(ruru);


    let villa = init_char_image("Villa","villaHome.png",964,351,{x:-1200,y:-5142,z:6251},{x:0.1672, y:-0.0551, z:-0.0130, w:0.9841});
    init_char_image("VillaSpeech","villaText.png",2500,1200,{x:-1172,y:-4203,z:6173},{x:0.01112, y:-0.0890, z:-0.0003, w:0.9958});
    add_action_mgr(villa);

   
    let ally = init_char_image("Ally","allyHome.png",809,355,{x: -1191, y: 1514, z: 5634},{x: -0.0241, y: -0.1397, z: -0, w: -0.9894});
    init_scrollable_viewer("AllyText","allyText.png",1500,850,{x:-318,y:1611,z:5172},{x:-0.0623,  y:-0.1487, z:0.0079, w:-0.9864});
    add_action_mgr(ally);


    let bruce = init_char_image("Bruce","bruceHome.png",940,775,{x: -7261, y: -1196, z: -3329},{x: 0.0041, y: 0.9142, z: -0.0261, w: -0.4026});
    init_scrollable_viewer("BruceText","bruceText.png",1500,850,{x: -6938, y: -1022, z: -1801},{x:-0.0320,  y:0.7894, z:-0.0425, w:-0.6108});
    add_action_mgr(bruce);

    
    let william = init_char_image("William","williamHome.png",790,390,{x: 4100, y: 3899, z: 2750},{x:-0.2367, y:-0.6905, z:-0.2064, w: -0.6500});
    init_scrollable_viewer("WilliamText","williamText.png",1500,850,{x: 3981, y: 3882, z: 1757},{x:-0.0082,  y:-0.6961, z:0.0033, w:-0.7173});
    add_action_mgr(william);

    let trevor = init_char_image("Trevor","trevorHome.png",334,646,{x: -3072, y: 1720, z: -5227},{x:-0.0083, y:0.9959, z:-0.0414, w: -0.0674});
    init_scrollable_viewer("TrevorText","trevorText.png",1500,850,{x: -3745, y: 1732, z: -4736},{x: -0.0016, y:0.9671, z:-0.0066, w: -0.2518});
    add_action_mgr(trevor);
   
    let manny = init_char_image("Manny","mannyHome.png",566,714,{x: 3181, y: -755, z: 5436},{x: -0.0345, y: -0.0750, z: 0.0148, w: 0.9954});
    init_scrollable_viewer("MannyText","mannyText.png",1500,850,{x: 4143, y: -745, z: 5165},{x:0.0068,  y:-0.1934, z:-0.0030, w:-0.9803});
    add_action_mgr(manny);

    init_char_image("tempText1","tempText1.png",1230,616,{x: 311, y: -850, z: 592},{x:0.0552, y: 0.8709, z: -0.1573, w: 0.4596});
    let tempText1 = init_char_image("tempText2","tempText2.png",1500,750,{x: -3290, y: -692, z: -2806},{x:0.0321, y: 0.9532, z: -0.0584, w: -0.2899});
   
    // enable_home_gizmo(tempText1);
    
}

function init_char_image(name,imgName,w,h,pos,rot){
    //create solar's image
    let temp = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, homeScene);
    temp.position = new BABYLON.Vector3(pos.x, pos.y, pos.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
    
    var tempMatl = new BABYLON.StandardMaterial(name+"Matl", homeScene);
    tempMatl.diffuseTexture = new BABYLON.Texture("front/images3D/homeScene/"+imgName, homeScene);
    tempMatl.opacityTexture = new BABYLON.Texture("front/images3D/homeScene/"+imgName, homeScene);
    tempMatl.backFaceCulling = false;
    temp.material = tempMatl;
    initLight.includedOnlyMeshes.push(temp);
    
    return temp;
}

function init_scrollable_viewer(name,imgName,w,h,pos,rot){
    //create plane for the texts
    let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, homeScene);
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);

    let discmatl = new BABYLON.StandardMaterial(name+"Matl", homeScene);
    discmatl.diffuseColor = new BABYLON.Color3(1,0,0);
    discmatl.backFaceCulling = false;
    plane.material = discmatl;

    var advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(plane);

    //create scrollable viwer for solar's text
    var sv = new BABYLON.GUI.ScrollViewer();
    sv.thickness = 0;
    sv.width = 1;
    sv.height = 1;
    sv.barColor = "green";

    sv.thumbLength = 0.3;
    sv.thumbHeight = 0.1;
    sv.verticalBar.border = 0;
    sv.barSize = 40;

    if(isSmallDevice() || isMobile()){
        sv.barSize = 60;
    }

    sv.onPointerDownObservable.add(function() {
        if(isCharViewActive) initCamera.detachControl(canvas);
    });
    sv.onPointerUpObservable.add(function() {
        if(isCharViewActive) initCamera.attachControl(canvas,true);
    });
    advancedTexture.addControl(sv);

    //create holder of solar's text image
    var rc = new BABYLON.GUI.Rectangle();
    rc.thickness = 0;
    rc.width = 1;
    
    if(name === "TrevorText") rc.height = 17;
    else if(name === "MannyText") rc.height = 21;
    else if(name === "RuruText") rc.height = 4;
    else if(name === "SolarText") rc.height = 9;
    else if(name === "BruceText") rc.height = 9;
    else rc.height = 7;
    rc.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
    rc.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
    rc.isPickable = false;

    sv.addControl(rc);

    //create the image and add to the rectangle holder
    var image = new BABYLON.GUI.Image(name+"Img", "front/images3D/homeScene/"+imgName);
    image.width = 1;
    image.height = 1;
    rc.addControl(image);
    return plane;
}





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
    if(homeSun) initWebCamScreen.setParent(homeSun);
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
    }, { maxWidth: 256, maxHeight: 256 });
  
    homeScene.onBeforeRenderObservable.add(function () {
        if (initVideo !== undefined && isAssigned == false) {
            if (initVideo.video.readyState == 4) {
                initWebCamScreen.material = videoMaterial2;
                
                isAssigned = true;
            }
        }
    });

}//end of function


let currCamTarget;
let cnt = 0;
let isPlanetClicked;
function add_home_mouse_listener(){
        var onPointerDownInit = function (evt) {
            if(homeScene) var pickinfo = homeScene.pick(homeScene.pointerX, homeScene.pointerY);
            else return;
          
           
            if(pickinfo.hit){
              
                let theInitMesh = pickinfo.pickedMesh;
                console.log("name: ", theInitMesh.name, "pos: ", theInitMesh.position, "rot: ", theInitMesh.rotationQuaternion);
                
                if(theInitMesh.name === "homeEarth"){ 
                    //check if small device or mobile; if yes, enable double click
                    checkScreenAndDoubleClick("participateMbaye");
                }else if(theInitMesh.name === "homeMercury"){ 
                    checkScreenAndDoubleClick("blogviewMembers");
                }else if(theInitMesh.name === "homeMars"){    
                    checkScreenAndDoubleClick("captainMbaye");
                }else if(theInitMesh.name === "homeNeptune"){
                    checkScreenAndDoubleClick("visitingMbaye");
                }else if(theInitMesh.name === "homeMoon"){
                    checkScreenAndDoubleClick("blogview/designed-panel/all");
                }else if(theInitMesh.name  === "homePluto"){
                    checkScreenAndDoubleClick("blogview/career");
                }else if(theInitMesh.name === "homeUranus"){
                    checkScreenAndDoubleClick("flowersMbaye");
                }else if(theInitMesh.name === "homeVenus"){
                    checkScreenAndDoubleClick("somethingSpecial");
                }else if(theInitMesh.name === "homeJupiter"){
                    let cNo = $('#storyChapter').val();
                    $.ajax({
                        type: "get",
                        url:urlStory,
                        data:{chapter_no:cNo,
                             _token:token
                        },
                        success: function(result){
                            checkScreenAndDoubleClick(urlStory+"?cNo="+cNo);
                        }
                    });
                }
                if(theInitMesh.name === "homeSun" || theInitMesh.name === "sun"){
                    checkScreenAndDoubleClick("dashboard");
                }
                
                if(charImgMap.has(theInitMesh.name) && evt.button === 0){          //if a character is clicked, zoom in to it
                    //if the the camera is currently focused on the character
                    let val;
                    //if the current character target is not the current char selected
                    if(currCamTarget != theInitMesh.name){
                        val = charImgMap.get(theInitMesh.name);
                        currCamTarget = theInitMesh.name;
                        isCharViewActive = true;
                        show_overlay_text(3);
                        // show_return_label(theInitMesh.name);
                    }else{ //if it is the same character
                        val = charImgMap.get("InitialView");
                        currCamTarget = null;
                        isCharViewActive = false;
                        show_overlay_text(4);
                    }
                    let pos = val[0];
                    
                    initCamera.setTarget(new BABYLON.Vector3(pos.x,pos.y,pos.z));
                    initCamera.alpha = val[1];
                    initCamera.beta = val[2];
                    initCamera.radius = val[3];
                }//end of if hit is true

                
                //this is the music playlist
                if(theInitMesh.name === "pauseIcon"){
                    toggle_video_icons("pause");
                }else if(theInitMesh.name === "playIcon"){
                    toggle_video_icons("play");
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

// click info to show overlay

$("#infoIcon").on('click',function(){
    //1 - initial view, 2 - focus view
    if(isCharViewActive) show_overlay_text(2);
    else show_overlay_text(1);               
    
    
    // console.log('hhh');
  });

//   $("#closeInfoBtn").on('click',function(){
//     $('#instruction-left-div').hide();
//     $('#infoIconText').hide();
//   });
  
  function show_overlay_text(mode){
      if(mode == 1){    //if #infoIcon is clicked and it is the initial view
            $('#instruction-left-div').toggle();
            $('#infoIconText').toggle();
            console.log("callled");
      }else if (mode == 2){ //if #infoIcon is clicked and it is the focus view
            $('#instruction-right-div').toggle();
            if(currCamTarget == 'Villa'){
                // console.log('hhh');
                $("#cloudImgDiv").css({'bottom' : '10%', 'left' : '20%', 'top':'unset' });
            }else{
                $('#cloudImgDiv').css({'top':'10%','left':'0'});  
            }
            $('#cloudImgDiv').toggle();
      }else if (mode == 3){ //if character and #infoIcon is clicked and it is the focus view
            $('#instruction-left-div').hide();
            $('#infoIconText').hide();
            
      }else if (mode == 4){ //if character is clicked  and it is the focus view
        $('#instruction-right-div').hide();
        $('#cloudImgDiv').hide();
        }
        // $('#cloudImgDiv').hide();
        
  }
    // if(isCharViewActive){
    //     document.getElementById("instruction-right-div").style.display = "block";
    // }
    // else{
    //     document.getElementById("instruction-left-div").style.display = "block";
    // }
  

function checkScreenAndDoubleClick(theLink){
    if(isMobile()){
        if(isPlanetClicked){
            isPlanetClicked = false;
            window.location.href = theLink; 
        }else{
            isPlanetClicked = true;
            if(theLink === "somethingSpecial"){
                venusInfoTxt.isVisible = true;
                setTimeout(function(){
                    venusInfoTxt.isVisible = false;
                },3000);
            }
            setTimeout(function(){
                if(isPlanetClicked){
                    isPlanetClicked = false;
                        Swal.fire({
                            width: '10vw',
                            padding: '3em',
                            title: 'Double Tap to enter the planet.',
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
        window.location.href = theLink; 
    }
    
}





            //create the game engine
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);
//create the scene
var theScene = createScene();
var i=0;
let isInitCameraMoving = false;
let isIntroDone = false;


theScene.executeWhenReady(function () {   
    document.getElementById("loadingScreenPercent").style.visibility = "hidden";
    document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
    document.getElementById("loadingScreenDiv").remove(); 
    // document.getElementById("loadingScreenOverlay").style.display = "block";
    isHomeReady = true;
    let browser = testBrowser();
    if(browser != 'Safari') discvideoTexture.video.play();
    //scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(theScene, options);


    if(isSmallDevice() || isMobile()){
        if(homeSun){
            homeSun.material.diffuseTexture = initVideo;
            sunGlowLayer.intensity = 0;
        }
    }

    engine.runRenderLoop(function () {
        if(theScene){
            theScene.render();
            if(discvideoTexture){
                if(discvideoTexture.video.currentTime >= 250 && !isIntroDone){
                    discvideoTexture.video.pause();
                    discvideoTexture.video.currentTime = 0;
                    $('#loadingScreenOverlay').append("<div id='overlayText' style='font-size:4.5vw;'>From here on, we trust in you and your social conscience.<br/>Kindly join us and express it.<br/><img style='padding-top:10%;width:7vw;' src=\'front/images3D/playMusic.png\'></div>");
                    document.getElementById("loadingScreenOverlay").style.display = "block";
                    isIntroDone = true;
                }
            }
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


let isFirstClick = false;
let isVideoSkipped = false;

$('#loadingScreenOverlay').on('click',function() {
    //remove condition if testing in ios
    if(discvideoTexture && isHomeReady){
        if(!isIntroDone) openFullscreen();
        $('#fullscreenIcon').hide();
        $(this).hide();
        //remove code below when testing in ios
        discvideoTexture.video.play();
        $('#overlayText').remove();
    }
}); 

let isVideoPlaying = true;
$(document).on('keydown',function(event) { 
  
    if(event.key===" "){
        if(discvideoTexture.video){
            if(isVideoPlaying) toggle_video_icons("pause");
            else toggle_video_icons("play");
        }
        
    }
}); 

function toggle_video_icons(type){
    if(type === "play"){
        discvideoTexture.video.play();
        homeScene.getMeshByName("pauseIcon").isVisible = true;
        homeScene.getMeshByName("playIcon").isVisible = false;
        isVideoPlaying = true;
    }else if(type === "pause"){
        discvideoTexture.video.pause();
        homeScene.getMeshByName("pauseIcon").isVisible = false;
        homeScene.getMeshByName("playIcon").isVisible = true;
        isVideoPlaying = false;
    }
}


/*======================================================== TEST THE DEVICE'S ORIENTATION =====================================================*/
$( document ).ready(function() {
    testOrientation();
});


window.addEventListener("orientationchange", function(event) {
    testOrientation();
}, false); 

window.addEventListener("resize", function(event) {
    testOrientation();
    testFullscreen();
}, false);


function testOrientation() {
    if (window.innerHeight < window.innerWidth) {
        document.getElementById('block_land').style.display = 'none';
    } else {
        document.getElementById('block_land').style.display = 'block';
    }
}



/*======================================================== CHECK IF FULLSCREEN FEATURE IS ACTIVATABLE =====================================================*/
var elem = document.documentElement;
function openFullscreen() {
    if (elem.mozRequestFullScreen) { /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE/Edge */
        elem.msRequestFullscreen();
    }else if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }
}


$('#fullscreenIcon').on('click',function(){
    openFullscreen();
    $(this).hide();
});


function testFullscreen(){
    if(window.innerHeight !== window.screen.height || window.innerWidth !== window.screen.width){
        $('#fullscreenIcon').show();
    }   
}


/*======================================================== CHECK THE BROWSWER BEING USED =====================================================*/

function testBrowser() { 
    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ){
       return 'Opera';
    }else if(navigator.userAgent.indexOf("Chrome") != -1 ){
        return 'Chrome';
    }else if(navigator.userAgent.indexOf("Safari") != -1){
        return 'Safari';
    }else if(navigator.userAgent.indexOf("Firefox") != -1 ){
        return 'Firefox';
    }else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )){
        return 'IE'; 
    }else{
        return 'unknown';
    }
}





/*======================================================= CHECK PLATFORM TYPE============================================================ */
function isMobile() {
	try{ document.createEvent("TouchEvent"); return true; }
	catch(e){ return false; }
}

function isSmallDevice() {
	if(window.innerWidth <= 1024) {
		return true;
	} else {
		return false;
	}
}



