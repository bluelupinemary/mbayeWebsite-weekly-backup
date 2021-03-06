//define the scene
let captScene;  
                                                    //var to handle the earth scene
//define the scene's camera
let captCamera;                                                    //var to hold the first camera upon loading the earth scene

//define the scene's light
let captLight;                                                     //active hemispheric light for the earth scene
let captSkybox;

//define constants for zoom in/out limits
const LOWER_RADIUS_VAL = 1;                                         //zoom in limit                       
const UPPER_RADIUS_VAL = 2000;                                      //zoom out limit


let earthTxt,mercuryTxt,venusTxt,marsTxt,jupiterTxt,saturnTxt,uranusTxt,neptuneTxt,plutoTxt,moonTxt,sunTxt,searchTxt;
let planetsLight;
let homeSun, homeMercury, homeVenus, homeEarth, homeMars, homeJupiter, homeSaturn, homeUranus, homeNeptune, homePluto, homeMoon;
let planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
let speed1 = -0.01;   
let speed2 = -0.02;
let speed3 = 0.005;


function createScene(){
    engine.enableOfflineSupport = true;
    captScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    captCamera = create_capt_camera();                                //create earth scene's camera
    create_capt_light();                                  //create earth scene's light
    captSkybox = create_capt_skybox();                                              //create earth scene's skybox
    load_capt_meshes();
    create_capt_planets();
    create_capt_halo();
    create_capt_labels();
    add_capt_mouse_listener();
    enable_capt_webcamera();
    return captScene;
} //end of create scene function

//function that creates the scene's cameras
function create_capt_camera(){
    var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,900),captScene);
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    //set zoom in and zoom out capability
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.pinchPrecision = 1;
    camera.upperBetaLimit = 10;
    camera.panningDistanceLimit = 1500;
    camera.attachControl(canvas,true);
    camera.maxZ = 280000;
    captScene.activeCamera = camera;

    return camera;
}//end of create camera function
                   

//function that creates scene's hemispheric light
function create_capt_light(){
    captLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,1000), captScene);
    captLight.radius = 1000;
    captLight.specular = new BABYLON.Color3(0,0,0);
    captLight.diffuse = new BABYLON.Color3(1,1,1);
    captLight.groundColor = new BABYLON.Color3(1,1,1);
    captLight.intensity = 1.3;

    planetsLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,700), captScene);
    planetsLight.radius = 500;
    planetsLight.specular = new BABYLON.Color3(0,0,0);
    planetsLight.diffuse = new BABYLON.Color3(1,1,1);
    planetsLight.groundColor = new BABYLON.Color3(0.1,0.1,0.1);
    planetsLight.intensity = 1;

    // return light;
}//end of create earth light function

function create_capt_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("captSkybox", {size:25000.0}, captScene);
    skybox.position = new BABYLON.Vector3(942,-500,-1500);

    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.infiniteDistance = true;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("captSkyboxMaterial", captScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, captScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function


var videoHome_obj2;
var theVideoParent;
var agreeCameraUseDisc;
function load_capt_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/homeScene/", "homeDisc.glb", captScene,
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

                    result.meshes[3].position = new BABYLON.Vector3( -54, -10,-68);
                    result.meshes[3].rotationQuaternion = new BABYLON.Quaternion( 0.0437,0.8910,0.0985,-0.4409);
        })

    ]).then(() => {
        setTimeout(function(){
            captLight.includedOnlyMeshes.push(videoHome_obj);
            captLight.includedOnlyMeshes.push(videoHome_obj2);
            captLight.includedOnlyMeshes.push(agreeCameraUseDisc);
            add_material_to_disc();
            captCamera.target = new BABYLON.Vector3(0,0,0);
            captCamera.radius = 1400;
        },1000);
    });
}//end of function load meshes

function create_capt_halo(){

    let plane = BABYLON.MeshBuilder.CreatePlane("captHalo", {height:1200,width:2250}, captScene);
    plane.position = new BABYLON.Vector3(26,40,-50);
    plane.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(75),BABYLON.Tools.ToRadians(128),0);
  
    let planeMatl = new BABYLON.StandardMaterial("plane1", captScene);
     planeMatl.diffuseTexture = new BABYLON.Texture("front/textures/home/haloThin2.png", captScene);
    planeMatl.opacityTexture = new BABYLON.Texture("front/textures/home/haloThin2.png", captScene);
    planeMatl.alpha = 0.9;
    
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
   
    plane.material = planeMatl;
    plane.isPickable = false;

    captHalo = plane;
    captLight.includedOnlyMeshes.push(captHalo);

}


function create_capt_labels(){
    //params: name, matlPath, height, width,xpos, ypos, zpos
    earthTxt = init_planet_label("story","front/textures/captMbaye/planetText/story.png", 175,325,929,195,528,{x:-0.0388,y:0.7695,z:0.0712,w:0.6330});
    moonTxt = init_planet_label("home","front/textures/captMbaye/planetText/home.png", 60,130,792,133,472,{x:0,y:0.7315,z:0,w:0.6817});
    venusTxt = init_planet_label("foundation","front/textures/captMbaye/planetText/foundation.png", 135,200,-413,202,-919,{x:0.0250,y:0.9679,z:-0.1088,w:0.2240});
    marsTxt = init_planet_label("youtube","front/textures/captMbaye/planetText/youtube.png", 70,110,-854,55,100,{x:0.0682,y:0.9388,z:0.0407,w:0.3346});
    jupiterTxt = init_planet_label("eyes","front/textures/captMbaye/planetText/eyes.png", 135,200,122,-177,823,{x:0.0393,y:0.8215, z:-0.1371,w:0.5518});
    saturnTxt = init_planet_label("wikipedia","front/textures/captMbaye/planetText/wikipedia.png", 150,250,1024,349,-2269,{x:0.2328,y:0.9158, z:0.1327,w:0.2985}); 
    uranusTxt = init_planet_label("un","front/textures/captMbaye/planetText/un.png", 190,350,1309,86,-665,{x:0.0817, y:0.7915,z:0.0937,w:0.5979});
    plutoTxt = init_planet_label("bbc","front/textures/captMbaye/planetText/bbc.png", 80,150,-50,-273,366,{x:0.0727, y:0.8678,z:-0.1614,w:0.4633});
    neptuneTxt = init_planet_label("visit","front/textures/captMbaye/planetText/visit.png", 280,490,2416,290,-2236,{x:0, y:0.8872,z:0,w:0.4610});
    mercuryTxt = init_planet_label("member","front/textures/captMbaye/planetText/member.png", 130,220,854,510,-1405,{x:0, y:0.9115,z:0,w:0.4106});


}

function init_planet_label(name,matlPath,h,w,x,y,z,rot){
    var plane = BABYLON.MeshBuilder.CreatePlane(name, {height:h,width:w}, captScene);
    plane.position = new BABYLON.Vector3(x,y,z);
    var planeMatl = new BABYLON.StandardMaterial("labelMatl", captScene);
    plane.scaling = new BABYLON.Vector3(1.3,1.3,1.3);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
    plane.isPickable = false;
    planeMatl.diffuseTexture = new BABYLON.Texture(matlPath, captScene);
    planeMatl.opacityTexture = new BABYLON.Texture(matlPath, captScene);
    planeMatl.alpha = 0.9;
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
    captLight.includedOnlyMeshes.push(plane);


    plane.material = planeMatl;

    return plane;
}


function add_material_to_disc(){
    var discMatl = new BABYLON.StandardMaterial("mbayeDiscMatl", captScene);
    discMatl.diffuseTexture = new BABYLON.Texture("front/textures/captMbaye/captDisc.png", captScene);
    discMatl.diffuseTexture.uScale = -1;
    discMatl.backFaceCulling = false;
    videoHome_obj.material = discMatl;
}


let homeGizmo;
function enable_home_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(captScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;
}




let sunOrigTexture;
let sunGlowLayer;
function create_capt_planets(){
    //create the sun

    homeSun = init_planet("sun","sunMatl","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg",3755,463,-716,250);
    var gl = new BABYLON.GlowLayer("glow", captScene);
    gl.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
        if (mesh.name === "sun") {
            result.set(235, 192, 52, 0.2);
        }else {
            result.set(0, 0, 0, 0);
        }
    }

    sunGlowLayer = gl;
  

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
    var saturnRing = BABYLON.Mesh.CreateGround("rings", 335, 335, 1, captScene);
    // saturnRing.isPickable = false;
    saturnRing.parent = homeSaturn;
    saturnRing.isPickable = false;


    homeSaturn.rotationQuaternion = new BABYLON.Quaternion(0.2302, 0.245,-0.105,0.932);
    var ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", captScene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/saturnRing2.png", captScene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;

    homeUranus = homeSun.clone("homeUranus");
    init_clone_planet(homeUranus,"uranusMatl","front/textures/home/planets/uranus3.jpg","front/textures/home/planets/uranusnormal.jpg",1412,55,-732,0.8);

    var uranusRing = BABYLON.Mesh.CreateGround("uranusRing", 490, 490, 1, captScene);
    // saturnRing.isPickable = false;
    uranusRing.parent = homeUranus;


    // homeSaturn.rotationQuaternion = new BABYLON.Quaternion(0.2302, 0.245,-0.105,0.932);
    var ringsMaterial2 = new BABYLON.StandardMaterial("ringsMaterial", captScene);
    ringsMaterial2.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/uranusRing.png", captScene);
    ringsMaterial2.opacityTexture = new BABYLON.Texture("front/textures/home/planets/uranusRing.png", captScene);
    ringsMaterial2.alpha = 0.9;
    ringsMaterial2.diffuseTexture.hasAlpha = true;
    ringsMaterial2.backFaceCulling = false;
    uranusRing.material = ringsMaterial2;

    homeNeptune = homeSun.clone("homeNeptune");
    init_clone_planet(homeNeptune,"neptuneMatl","front/textures/home/planets/neptune.jpg","front/textures/home/planets/neptunenormal.jpg",2603,259,-2397,0.92);


    homePluto = homeSun.clone("homePluto");
    init_clone_planet(homePluto,"plutoMatl","front/textures/home/planets/pluto.jpg","front/textures/home/planets/plutonormal.jpg",0.21,-300,346,0.4);


    captLight.includedOnlyMeshes.push(homeSun);
    captLight.includedOnlyMeshes.push(homeEarth);
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
    captLight.includedOnlyMeshes.push(uranusRing);
    

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
   

    homeSun.actionManager = new BABYLON.ActionManager(captScene);
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
        // if(mbayeEarth_object) console.log("mbaye: ", mbayeEarth_object.position, mbayeEarth_object.rotationQuaternion);
        if(captScene){
            homeMercury.rotation.y = Math.PI / 2;
            homeMercury.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);
            homeVenus.rotation.y = Math.PI / 2;
            homeVenus.rotate(planetAxis, speed3, BABYLON.Space.LOCAL);
            homeEarth.rotation.y = Math.PI / 2;
            homeEarth.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);
            homeMoon.rotation.y = Math.PI / 2;
            homeMoon.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);
            homeMars.rotation.y = Math.PI / 2;
            homeMars.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);
            homeJupiter.rotation.y = Math.PI / 2;
            homeJupiter.rotate(planetAxis, speed2, BABYLON.Space.LOCAL);
            homeSaturn.rotation.y = Math.PI / 2;
            homeSaturn.rotate(planetAxis, speed2, BABYLON.Space.LOCAL);
            homeUranus.rotation.y = Math.PI / 2;
            homeUranus.rotate(planetAxis, speed2, BABYLON.Space.LOCAL);
            homeNeptune.rotation.y = Math.PI / 2;
            homeNeptune.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);
            homePluto.rotation.y = Math.PI / 2;
            homePluto.rotate(planetAxis, speed1, BABYLON.Space.LOCAL);

        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 0, radius, captScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    var temp_material = new BABYLON.StandardMaterial(material_name,captScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, captScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,captScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    // temp_material.freeze();
    // temp.freezeWorldMatrix();
    temp.material = temp_material;
    if(name === "sun") sunOrigTexture = temp_material.diffuseTexture;
    return temp;
}//end of init planet function


function init_clone_planet(temp,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,scale){
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    var temp_material = new BABYLON.StandardMaterial(material_name,captScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, captScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,captScene);
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

function add_action_mgr(thePlanet){
    thePlanet.actionManager = new BABYLON.ActionManager(captScene);
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


var origScaling;
var onOverPlanet =(meshEvent)=>{
    origScaling = meshEvent.source.scaling;
    meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.1,origScaling.y*1.1,origScaling.z*1.1);
};

//handles the on mouse out event
var onOutPlanet =(meshEvent)=>{
    meshEvent.source.scaling = origScaling;
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
  
    var theMeshID = meshEvent.source.id 
    if(initWebCamScreen){
        if(theMeshID == "sun"){
            homeSun.material.diffuseTexture = initVideo;
            sunGlowLayer.intensity = 0;

            document.body.appendChild(lbl);
            lbl.textContent = "All About You";


        } 
    } 
};

//handles the on mouse out event
var onOutSun =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    if(initWebCamScreen){
        homeSun.material.diffuseTexture = sunOrigTexture;
        sunGlowLayer.intensity = 1;
    }

    while (document.getElementById("sunLbl")) {
        document.getElementById("sunLbl").parentNode.removeChild(document.getElementById("sunLbl"));
    } 
    
    
};


let initVideo;  
let initWebCamScreen,initWebCamScreen22;  
function enable_capt_webcamera(){
    var isAssigned = false; // Is the Webcam stream assigned to material?

    initWebCamScreen = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen", {radius:110, tessellation: 0}, captScene);
    initWebCamScreen.position = new BABYLON.Vector3(3536,461,-648);
    initWebCamScreen.isPickable = false;
    initWebCamScreen22 = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen22", {radius:110, tessellation: 0}, captScene);
    initWebCamScreen22.position = new BABYLON.Vector3(3536,461,-648);
   
    captLight.includedOnlyMeshes.push(initWebCamScreen);
    captLight.includedOnlyMeshes.push(initWebCamScreen22);

    initWebCamScreen.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen22.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen.setEnabled(false);
    initWebCamScreen.isVisible = false;
    initWebCamScreen22.setEnabled(false);
    initWebCamScreen22.isVisible = false;
  
    var videoMaterial2 = new BABYLON.StandardMaterial("initWebCamScreenTexture", captScene);
    videoMaterial2.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial2.backFaceCulling = false;  


 var videoMaterial3 = new BABYLON.StandardMaterial("initWebCamScreenTexture", captScene);
    videoMaterial3.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial3.backFaceCulling = false;  

    initWebCamScreen22.material = videoMaterial3;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(captScene, function (videoTexture2) {
        initVideo = videoTexture2;
        videoMaterial2.diffuseTexture = initVideo;
    }, { maxWidth: 256, maxHeight: 256 });


}//end of function

function add_capt_mouse_listener(){
    
        var onPointerDownInit = function (evt) {
            // console.log(evt);
            if(captScene) var pickinfo = captScene.pick(captScene.pointerX, captScene.pointerY);
            else return;
            if(pickinfo.hit){
                var theInitMesh = pickinfo.pickedMesh.name;
                // console.log("THe mesh clicked: ", theInitMesh, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
                // console.log("camera: ", captCamera.position, captCamera.radius, captCamera.alpha, captCamera.beta);
            
                if(theInitMesh === "a"){
                    agreeCameraUseDisc.isVisible = false;
                    captCamera.attachControl(canvas,true);
                    setTimeout(function(){
                         videoTexture.video.play();
                    },1000);

                    setTimeout(function(){
                        isAssignedWebcam = true;
                    },5000);

                }else if(theInitMesh === "homeMoon" ){
                    checkScreenAndDoubleClick("/");
                }else if(theInitMesh === "homeSaturn"){
                    showPage("https://en.wikipedia.org/wiki/Mbaye_Diagne");
                }else if(theInitMesh === "homeJupiter"){
                    showPage("inOurEyes");
                }else if(theInitMesh === "homeUranus"){
                    showPage("https://www.youtube.com/embed/2tF1uEyvojU");
                }else if(theInitMesh ===  "homeMars"){
                    showPage("https://www.youtube.com/embed/uuElJ1XApLo");
                }else if(theInitMesh ===  "homeVenus"){
                    showPage("https://www.captaindiagne.org/");
                }else if(theInitMesh ===  "homePluto"){
                    showPage(" https://www.bbc.co.uk/news/special/2014/newsspec_6954/index.html");
                }else if(theInitMesh ===  "sun"){
                    checkScreenAndDoubleClick("dashboard");
                }else if(theInitMesh ===  "homeNeptune"){
                    checkScreenAndDoubleClick("visitingMbaye");
                }else if(theInitMesh ===  "homeMercury"){
                    checkScreenAndDoubleClick("blogviewMembers");
                }
           }
           
        }//end of on pointer down function

        var onPointerUpInit = function () {
               
        }//end of on pointer up function

        var onPointerMoveInit = function (evt) {
          
        }//end of on pointer move function

        canvas.addEventListener("pointerdown", onPointerDownInit, false);
        canvas.addEventListener("pointerup", onPointerUpInit, false);
        canvas.addEventListener("pointermove", onPointerMoveInit, false);


        //remove the text span on dispose
        captScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDownInit);
            canvas.removeEventListener("pointerup", onPointerUpInit);
            canvas.removeEventListener("pointermove", onPointerMoveInit);

        };
    
}//end of listen to mouse func

var isPlanetClicked = false;
function checkScreenAndDoubleClick(theLink){
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

theScene.executeWhenReady(function () {   
        document.getElementById("loadingScreenPercent").style.visibility = "hidden";
        document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
        document.getElementById("loadingScreenDiv").remove();
        testFullscreen();

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
            //render the scene
                theScene.render();
            }    
        }); 
});

// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
    testOrientation();
    testFullscreen();
});
     

/* Related to the wiki page */
$('#wikiPage').on('load',function(){
    $('.iframe-loading').hide();
});


let isScreenVisible = false;
let isCharDivFullscreen = false;
function showPage(pageName) {
    $('.iframe-loading').show();
    let loader = document.getElementById("iframe-loading");
    let x = document.getElementById("wikipediaDiv");
    let page = document.getElementById("wikiPage");

    if(pageName === "inOurEyes"){
        document.getElementById("page-url").textContent = "Mbaye In Our Eyes";
        $('#wikipediaDiv').css('background','url("front/images/skybox_bg1.jpg")');
        $('#wikipediaDiv').css('background-size','cover');
        document.getElementById("fullscreen-btn").src= "front/images3D/minimize-btn.png";
        document.getElementById("fullscreen-btn").title= "Windowed";
        document.getElementById("wikipediaDiv").style.width = "100%";
        isCharDivFullscreen = true;
        $('.iframe-loading').hide();
        showInOurEyes();

    }else{
        page.src  = pageName;
        document.getElementById("page-url").textContent = pageName+"";
        if(loader.style.visibility != "visible") loader.style.visibility = "visible";
    }
    $('#fullscreenIcon').hide();
   
    if(x.style.visibility != "visible"){
        x.style.visibility = "visible";  
        isScreenVisible = true;
    }else return;
}


function hidePage(){
    let loader = document.getElementById("iframe-loading");
    var x = document.getElementById("wikipediaDiv");
    var page = document.getElementById("wikiPage");
    
    page.src = "";
    
    x.style.visibility = "hidden";
    loader.style.visibility = "hidden";
    isScreenVisible = false;
    
    $('#fullscreenIcon').show();
    $('#wikipediaDiv').css('background','black');
    $('#inOurEyesDiv').hide();
   
}

function fullscreenDescDiv(){
    if(!isCharDivFullscreen){
        document.getElementById("fullscreen-btn").src= "front/images3D/minimize-btn.png";
        document.getElementById("fullscreen-btn").title= "Windowed";
        document.getElementById("wikipediaDiv").style.width = "100%";
        isCharDivFullscreen = true;
    }else{
        document.getElementById("fullscreen-btn").title= "Fullscreen";
        document.getElementById("fullscreen-btn").src= "front/images3D/fullscreen-btn.png";
        if(isSmallDevice() || isMobile()) document.getElementById("wikipediaDiv").style.width = "50%";
        else document.getElementById("wikipediaDiv").style.width = "30%";
        isCharDivFullscreen = false;
    }
}//end of fullscreenDescDiv



function showInOurEyes(){
    // $('#wikiPage').hide();
    $('#inOurEyesDiv').show();
}


/*======================================================== TEST THE DEVICE'S ORIENTATION =====================================================*/
$( document ).ready(function() {
    testOrientation();
});


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
    if((window.innerHeight !== window.screen.height) || (window.innerWidth !== window.screen.width)){
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

$("#infoIcon").on('click',function(){
    $('#instructionCaptDiv').toggle();
    $('#infoIconTextcapt').toggle();
    $('#arrowGIF').toggle();
    isIns2Active = !isIns2Active;
    
    $('#textCurve1').toggle();
    // $('#textCurve2').toggle();
    // $('#textCurveanticlock').toggle();
    // $('#textCurveanticlock2').toggle();
    set_circle_type();
});

let isIns2Active = false;
function set_circle_type(){
if(isIns2Active){
 circleType = new CircleType(document.getElementById('textCurve1'));
 

 // Set the text radius and direction. Note: setter methods are chainable.
 circleType.radius(150).dir(-1);
 
}else{
 //destroy the instructions
 circleType.destroy();
 

}
}
