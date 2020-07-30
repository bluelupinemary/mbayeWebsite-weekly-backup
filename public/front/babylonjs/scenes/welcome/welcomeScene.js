
//define the scene
var initScene;  
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



//define constants for zoom in/out limits
const LOWER_RADIUS_VAL = 1;                                         //zoom in limit                       
const UPPER_RADIUS_VAL = 3000;                                      //zoom out limit






function createScene(){
    engine.enableOfflineSupport = true;
           
    initScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    initCamera = create_init_camera();                                //create earth scene's camera
    initLight = create_init_light();                                  //create earth scene's light
    initSkybox = create_init_skybox();                                              //create earth scene's skybox
    load_init_meshes();
    create_init_planets();

    create_init_orbit();
    create_init_planet_orbit();

    enable_init_webcamera();
    add_init_mouse_listener();
    create_constellation_planes();

   

    //add HDR texture so that mbaye's textures would be rendered correctly                                                             
    var hdrTextureEarth = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", initScene); 
    hdrTextureEarth.gammaSpace = false;
    hdrTextureEarth.level = 0.5;
    initScene.environmentTexture = hdrTextureEarth;                    //set the environment's texture

    return initScene;
} //end of create scene function


//function that creates the scene's cameras
function create_init_camera(){
    var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,1000),initScene);
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
    initScene.activeCamera = camera;

    return camera;
}//end of create camera function
                   
//function that creates scene's hemispheric light
function create_init_light(){
    var light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(-10,10,-10), initScene);
    light.radius = 300;
    light.specular = new BABYLON.Color3(0,0,0);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.groundColor = new BABYLON.Color3(0.3,0.3,0.3);
    light.intensity = 1;

    return light;
}//end of create earth light function

function create_init_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("initSkybox", {size:9000.0}, initScene);
    skybox.position.y = 100;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("initSkyboxMaterial", initScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, initScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function

var mbayeInit_object;
var mbayeInitTask;
var initEarth_object;
let nuvolaSpeechCloud;
let nuvolaSpeech;
function load_init_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/mbaye/", "MbayePipes.glb", initScene).then(function (result) {
            // console.log(result.meshes);
            mbayeInitTask = result.meshes;
            
            result.meshes[0].position = new  BABYLON.Vector3(-467.95,285.39,642.78);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1173,0.9809,-0.0854,-0.1289);
            result.meshes[0].scaling = new BABYLON.Vector3(20,20,-20);
            mbayeInit_object = result.meshes[0];
            mbayeInit_object.isPickable = false;
           
           
         
            // pbr.reflectionTexture = rp.cubeTexture

            result.meshes.forEach(function(m) {
                m.isPickable = true;
                if(m.name === "MbayeBody"){
                    let pbr = new BABYLON.PBRMaterial("pbr", initScene);
                    m.material = pbr;
                    m.material.backFaceCulling = false;
                    pbr.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
                    pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                    pbr.metallic = 1;
                    pbr.metallicF0Factor = 0.50;
                    pbr.roughness = 0.15;
                    pbr.microSurface = 1; 
                }else if(m.name === "R_EYEAventurine_primitive1" || m.name === "L_EYEAventurine_primitive1" ){
                    m.material.albedoColor = new BABYLON.Color3(0.01,0.2,0.07);
                }
            });

                    
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/nuvola/", "mermaidTail.babylon", initScene).then(function (result) {
          mermaidTail_object = result.meshes[0];
          
          initScene.ambientColor = new BABYLON.Color3(0.2,0.2,0.2);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/nuvola/", "mermaidBody.babylon", initScene).then(function (result) {
          mermaidHead =result.meshes[0];
          mermaidHair = result.meshes[1];
          
          mermaidHead.material.glossiness = 2;
          mermaidHead.material.roughness = 0.2;
        }),
         BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/", "speechCloud.glb", initScene).then(function (result) {
          
          result.meshes[0].scaling = new BABYLON.Vector3(20,20,-20);
          result.meshes[0].position = new BABYLON.Vector3(-568.34,260.86,678.33);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1162,0.5704,0.0147,-0.8129);

          nuvolaSpeechCloud = result.meshes[0];

          // console.log(result.meshes);
          // result.meshes[1].isPickable = true;
          
        }),
         BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/cloud/", "nuvolaParticipate1.glb", initScene).then(function (result) {
          // console.log("Ruru Speech: ", result.meshes);
          result.meshes[0].scaling = new BABYLON.Vector3(40,40,-40);
          result.meshes[0].position = new BABYLON.Vector3(-566.16,262.82, 679.201);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0888,0.6065,0.0013,-0.7899);

          result.meshes[0].isPickable = true;
          nuvolaSpeech = result.meshes[0];
          // enable_home_gizmo2(nuvolaSpeech);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", initScene, 
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
            }).then(function (result) {
                // earthNormalMesh = result.meshes;
                
                result.meshes[9].scaling = new BABYLON.Vector3(0.6,0.6,0.6);
               
                
                water = new BABYLON.WaterMaterial("water", initScene, new BABYLON.Vector2(2048, 2048));
                water.backFaceCulling = true;
                water.bumpTexture = new BABYLON.Texture("front/textures/participate/waterbump.png", initScene);
                water.windForce = 10;
                water.windDirection = new BABYLON.Vector2(-1,0);
                water.waveHeight = 0.2;
                water.bumpHeight = 0.3;
                water.waveLength = 0.1;
                water.colorBlendFactor = 0.25714;
                water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                water.addToRenderList(initSkybox);
                result.meshes[7].material = water;
            
                result.meshes.forEach(function(e){
                    e.actionManager = new BABYLON.ActionManager(initScene);
                    e.actionManager.registerAction(
                        new BABYLON.ExecuteCodeAction(
                            BABYLON.ActionManager.OnPointerOverTrigger,
                            onOverPlanetInit
                        )
                    );
                    e.actionManager.registerAction(
                        new BABYLON.ExecuteCodeAction(
                            BABYLON.ActionManager.OnPointerOutTrigger,
                            onOutPlanetInit
                        )
                    );
                });//end of for loop

                initEarth_object = result.meshes[9];      
          }),
    ]).then(() => {
         mermaidHead.setParent(mermaidTail_object);
          mermaidHair.setParent(mermaidTail_object);
          mermaidTail_object.position = new BABYLON.Vector3( -551.84,219.14,709.45);
          mermaidTail_object.rotationQuaternion = new BABYLON.Quaternion(-0.0946,-0.8844,0.1707,-0.4235);
          mermaidTail_object.scaling = new BABYLON.Vector3(0.15,0.15,0.15);


        // enable_home_gizmo2(mermaidTail_object);


          // mermaidTail_object.isVisible = false;
          // mermaidTail_object.setEnabled(false);
          mermaidTail_object.isPickable = true;
        // setTimeout(function(){
            initCamera.target = new BABYLON.Vector3(0,0,0);
            initCamera.radius = 1360;
            mbayeInit_object.isPickable = true;
            
        // },1000);
       
    });
}//end of function load meshes



let designUtilLayer;
let homeGizmo,homeGizmo2;
function enable_home_gizmo2(theObj){
    // Create gizmo
    designUtilLayer = new BABYLON.UtilityLayerRenderer(initScene);
    designUtilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo.attachedMesh = theObj;
    // homeGizmo.scaleRatio = 1.5;

     homeGizmo2 = new BABYLON.PositionGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo2.attachedMesh = theObj;
    homeGizmo2.scaleRatio = 1.5;

   
}

var initOrbit;
function create_init_orbit(){
    initOrbit = BABYLON.Mesh.CreateGround("initOrbit", 3000, 2600, 1, initScene);
    initOrbit.isPickable = false;
    initOrbit.scaling = new BABYLON.Vector3(2.5,2.5,2.5);
    initOrbit.position = new BABYLON.Vector3(200,0,-100);
    initOrbit.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(-10),BABYLON.Tools.ToRadians(180),BABYLON.Tools.ToRadians(0));

    var initOrbitMatl = new BABYLON.StandardMaterial("initOrbitMatl", initScene);
    initOrbitMatl.diffuseTexture = new BABYLON.Texture("front/textures/participate/welcomeOrbit.png", initScene);
    initOrbitMatl.diffuseTexture.hasAlpha = true;
    initOrbitMatl.backFaceCulling = false;
    initOrbit.material = initOrbitMatl;
    initOrbit.material.freeze();
    initOrbit.freezeWorldMatrix();
}

var initSun, initMercury, initVenus, initEarth, initMars, initJupiter, initSaturn, initUranus, initNeptune, initPluto, initMoon;
var planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
var redAngle = 0.01;   
var yellowAngle = 0.02;
var grayAngle = -0.01;
function create_init_planets(){
    //create the sun
    initSun = init_planet("sun","sunMatl","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg",-78,319,-2097,250);
    //add glow effect to the sun
    var gl = new BABYLON.GlowLayer("glow", initScene);
    gl.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
        if (mesh.name === "sun") {
            result.set(235, 192, 52, 0.2);
        }else {
            result.set(0, 0, 0, 0);
        }
    }

    initMercury = initSun.clone("mercury");
    init_clone_planet(initMercury,"mercuryMatl","front/textures/home/planets/mercury.jpg","front/textures/home/planets/mercurynormal.jpg", -442,226,-1428,0.32);

    initVenus = initSun.clone("initVenus");
    init_clone_planet(initVenus,"venusMatl","front/textures/home/planets/venus.jpg","front/textures/home/planets/venusnormal.jpg",-317,95,-684,0.48);
    
    initMoon = initSun.clone("initMoon");
    init_clone_planet(initMoon,"moonMatl","front/textures/home/planets/moon.jpg","front/textures/home/planets/moonnormal.jpg",329,163,-263,0.2);

    initMars = initSun.clone("initMars");
    init_clone_planet(initMars,"marsMatl","front/textures/home/planets/mars.jpg","front/textures/home/planets/marsnormal.jpg",-752,-42,78,0.3);

    initJupiter = initSun.clone("earthJupiter");
    init_clone_planet(initJupiter,"jupiterMatl","front/textures/home/planets/jupiter.jpg","front/textures/home/planets/jupiternormal.jpg",210,-144,730,0.48);

    initSaturn = init_planet("initSaturn","saturnMatl","front/textures/home/planets/saturn.jpg","front/textures/home/planets/saturnnormal.jpg",2551,436,-2414,220);
    var saturnRing = BABYLON.Mesh.CreateGround("rings", 490, 490, 1, initScene);
    saturnRing.isPickable = false;
    saturnRing.parent = initSaturn;

    initSaturn.rotationQuaternion = new BABYLON.Quaternion(0.28,0.18,0.02,0.94);
    var ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", initScene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/saturnRing2.png", initScene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;

    initUranus = initSun.clone("initUranus");
    init_clone_planet(initUranus,"uranusMatl","front/textures/home/planets/uranus.jpg","front/textures/home/planets/uranusnormal.jpg",-2097,-91,337,0.48);

    initNeptune = initSun.clone("initNeptune");
    init_clone_planet(initNeptune,"neptuneMatl","front/textures/home/planets/neptune.jpg","front/textures/home/planets/neptunenormal.jpg",2835,-5,-76,0.92);

    initPluto = initSun.clone("initPluto");
    init_clone_planet(initPluto,"plutoMatl","front/textures/home/planets/pluto.jpg","front/textures/home/planets/plutonormal.jpg",2300,400,500,0.4);
    
    initSun.actionManager = new BABYLON.ActionManager(initScene);
    initSun.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverSunInit)
    );
    initSun.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
           onOutSunInit)
    );


    //rotate the planets
    
    engine.runRenderLoop(function () {
        // if(mbayeEarth_object) console.log("mbaye: ", mbayeEarth_object.position, mbayeEarth_object.rotationQuaternion);
        if(initScene && initEarth_object){
            initMercury.rotation.y = Math.PI / 2;
            initMercury.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initVenus.rotation.y = Math.PI / 2;
            initVenus.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            initMars.rotation.y = Math.PI / 2;
            initMars.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initJupiter.rotation.y = Math.PI / 2;
            initJupiter.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initSaturn.rotation.y = Math.PI / 2;
            initSaturn.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initUranus.rotation.y = Math.PI / 2;
            initUranus.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            initNeptune.rotation.y = Math.PI / 2;
            initNeptune.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initPluto.rotation.y = Math.PI / 2;
            initPluto.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);

            // if( && isEarthRotating){
                initEarth_object.rotation.y = Math.PI / 2;
                initEarth_object.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            // }
        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 10, radius, initScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    var temp_material = new BABYLON.StandardMaterial(material_name,initScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, initScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,initScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp_material.freeze();
    temp.freezeWorldMatrix();
    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();

    
    return temp;
}//end of init planet function


function init_clone_planet(temp,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,scale){
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    var temp_material = new BABYLON.StandardMaterial(material_name,initScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, initScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,initScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);

    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();

    temp.actionManager = new BABYLON.ActionManager(initScene);
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverPlanetInit)
    );
    temp.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
           onOutPlanetInit)
    );
}//end of init planet function


var initWebCamScreen;
var onOverSunInit =(meshEvent)=>{
    var theMeshID = meshEvent.source.id;
    if(initWebCamScreen){
        if(theMeshID == "sun"){
            initWebCamScreen.setEnabled(true);
            initWebCamScreen.isVisible = true;  
            // console.log(" earth cam's position: ",earthCamera.position);
            let camX = initCamera.position.x;
            let camY = initCamera.position.y;
            let x = -122;
            let y = 323;
            let z = -1960;
             if( camX<-700 && camX>=-900) x = -110;
            else if( camX<-500 && camX>=-700) x = -105;
            else if( camX<-300 && camX>=-500) x = -90;
            else if(camX<100 && camX>=-300) x = -80;
            else if(camX<300 && camX>=100) x = -70;
            else if(camX<700 && camX>=300) x = -55;
            else if(camX<900 && camX>=700) x = -40;
            else if(camX<1000 && camX>=900) x = -30;
            else if(camX>=1000) x = -25;
            //else initWebCamScreen.position = new BABYLON.Vector3(-122,320,-1960);   //the initial position

            if(camY>700 && camY <= 1000) y = 335;
            else if(camY>500 && camY <= 700) y = 330;
            else if(camY>300 && camY <= 500) y = 323;
            else if(camY>0 && camY <= 300) y = 310;
            else if(camY>-200 && camY <= 0) y = 300;
            else if(camY>-500 && camY <= -200) y = 290;
            else if(camY>-700 && camY <= -500) y = 280;
            else if(camY>-900 && camY <= -700) y = 270;
            else if(camY>-1100 && camY <= -900) y = 260; 
            else if(camY>-1300 && camY <= -1100) y = 250    ;   
            initWebCamScreen.position = new BABYLON.Vector3(x,y,z);
        } 
    } 
};

//handles the on mouse out event
var onOutSunInit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    if(initWebCamScreen){
        initWebCamScreen.setEnabled(false);
        initWebCamScreen.isVisible = false; 
    }
    
    
};


var initVideo;    
function enable_init_webcamera(){
    var isAssigned = false; // Is the Webcam stream assigned to material?

    initWebCamScreen = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen", {radius:110, tessellation: 0}, initScene);

    initWebCamScreen.rotationQuaternion = new BABYLON.Quaternion(0.023,0.990,-0.002,0.009);
    initWebCamScreen.setEnabled(false);
    initWebCamScreen.isVisible = false;
  
    var videoMaterial = new BABYLON.StandardMaterial("initWebCamScreenTexture", initScene);
    videoMaterial.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial.emissiveColor = BABYLON.Color3.White();

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(initScene, function (videoTexture) {
        initVideo = videoTexture;
        videoMaterial.diffuseTexture = initVideo;
    }, { maxWidth: 256, maxHeight: 256 });

    // When there is a video stream (!=undefined),
    // check if it's ready          (readyState == 4),
    // before applying videoMaterial to avoid the Chrome console warning.
    // [.Offscreen-For-WebGL-0xa957edd000]RENDER WARNING: there is no texture bound to the unit 0
    initScene.onBeforeRenderObservable.add(function () {
        if (initVideo !== undefined && isAssigned == false) {
            if (initVideo.video.readyState == 4) {
                initWebCamScreen.material = videoMaterial;
                isAssigned = true;
            }
        }
    });

}//end of function

function enable_gizmo(){
    // Create gizmo
    var utilLayer = new BABYLON.UtilityLayerRenderer(initScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    initGizmo = new BABYLON.RotationGizmo(utilLayer);
    initGizmo.attachedMesh = scorpioStars;
}

let initPointer = {x:null,y:null,z:null};
let deltaPointer = {x:0,y:0,z:0};
var timestamp = null;
let lastMouseX;
let lastMouseY;
let startTime;

function add_init_mouse_listener(){
    
        var onPointerDownInit = function (evt) {
            if(initScene) var pickinfo = initScene.pick(initScene.pointerX, initScene.pointerY);
            else return;
            if(pickinfo.hit){
                var theInitMesh = pickinfo.pickedMesh.name;
                console.log("THe mesh clicked: ", theInitMesh, pickinfo.pickedMesh.position,pickinfo.pickedMesh.rotationQuaternion);
                
                //THIS IS A TEMPORARY LINK; MODIFY THIS PART
               // if(theInitMesh === "initWebCamScreen") window.open('http://localhost/Mbaye_bootstrap_new/index.php',"_self");
                if(theInitMesh === "initWebCamScreen") window.open('http://127.0.0.1:8000/register',"_self");
                //http://127.0.0.1:8000/register                
           }
           if(evt.button === 0){
                deltaPointer.x = 0;
                deltaPointer.y = 0;
                deltaPointer.z = 0;
                initPointer.x = evt.clientX;
                initPointer.y = evt.clientY;

                isFast = false;
                startTime = new Date();
           }
        }//end of on pointer down function

        var onPointerUpInit = function () {
            if(deltaPointer.x){
                // console.log("delta X and Y ",deltaPointer.x, deltaPointer.y, deltaPointer.z);
            }
            initPointer.x = null;
            initPointer.y = null;
            initPointer.z = null;
            startTime = 0;
            timestamp = 0;

            whoaAudio.pause();
            whoaAudio.currentTime = 0;
        }//end of on pointer up function

        var onPointerMoveInit = function (e) {
          //compute for changes in x, y, z / distance from original pos
            if (timestamp === null) {
                timestamp = new Date();
            }
                    
            
           if(initPointer.x){
                var dt = timestamp -  startTime;
                var dx =  Math.abs(e.clientX - initPointer.x);
                var dy =  Math.abs(e.clientY - initPointer.y);
                var speedX = (dx / dt) * 100;
                var speedY = (dy / dt) * 100;

                timestamp = new Date();

                if(speedX >= 400){
                whoaAudio.play();
                }
           }

               
    
        }//end of on pointer move function

        canvas.addEventListener("pointerdown", onPointerDownInit, false);
        canvas.addEventListener("pointerup", onPointerUpInit, false);
        canvas.addEventListener("pointermove", onPointerMoveInit, false);


        //remove the text span on dispose
        initScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDownInit);
            canvas.removeEventListener("pointerup", onPointerUpInit);
            canvas.removeEventListener("pointermove", onPointerMoveInit);

        };
    
}//end of listen to mouse function

var earthOrbit, mercuryOrbit,venusOrbit,jupiterOrbit,saturnOrbit,uranusOrbit,neptuneOrbit,plutoOrbit,sunOrbit,moonOrbit;
function create_init_planet_orbit(){
    //params: name, matlName, matlPath, xPos, yPos, zPos, scaling, radius, xRotation
    earthOrbit = init_orbit("Earth","orbitMatl", "front/textures/participate/planetorbit2.png",0,0,0,1.1,200,90);
    mercuryOrbit = init_orbit("Mercury","orbitMatl", "front/textures/participate/planetorbit5.png",-444.158,226.007,-1427.216,0.3,200,110);
    venusOrbit = init_orbit("Venus","orbitMatl", "front/textures/participate/planetorbit.png",-317.946,90.369,-681.065,0.4,200,100);
    marsOrbit = init_orbit("Mars","orbitMatl", "front/textures/participate/planetorbit3.png",-754.426,-45.511,78.592,0.25,200,90);
    jupiterOrbit = init_orbit("Jupiter","orbitMatl", "front/textures/participate/planetorbit3.png",210.424,-145.791,729.638,0.4,200,90);
    saturnOrbit = init_orbit("Saturn","orbitMatl", "front/textures/participate/planetorbit.png",2568.391,456.358,-2411.465,1.1,200,100);
    uranusOrbit = init_orbit("Uranus","orbitMatl", "front/textures/participate/planetorbit.png",-2100.472,-98.486,339.091,0.5,200,110);
    neptuneOrbit = init_orbit("Neptune","orbitMatl", "front/textures/participate/planetorbit6.png",2833.940,-1.771,-79.771,0.9,200,110);
    plutoOrbit = init_orbit("Pluto","orbitMatl", "front/textures/participate/planetorbit.png",2299.891,400.604,500.918,0.4,200,100);
    sunOrbit = init_orbit("Sun","orbitMatl", "front/textures/participate/planetorbit6.png",-80.91,308.13,-2082.51,0.8,200,110);
    moonOrbit = init_orbit("Moon","orbitMatl", "front/textures/participate/planetorbit6.png",329.613,157.802,-263.126,0.25,200,110);
}//end of fxn


function init_orbit( name, matlName, matlPath, x, y, z, scale, radiusVal, xRot ){
    var temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:radiusVal, tessellation: 0}, initScene);
    temp.scaling = new BABYLON.Vector3( scale, scale, scale );
    temp.position = new BABYLON.Vector3(x,y,z);
    temp.rotation.x =  BABYLON.Tools.ToRadians(xRot);

    var tempMatl = new BABYLON.StandardMaterial(matlName, initScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, initScene);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;
    temp.material.backFaceCulling = false;
    temp.freezeWorldMatrix();
    temp.convertToUnIndexedMesh();

    temp.actionManager = new BABYLON.ActionManager(initScene);
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanetOrbitInit
        )
    );
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbitInit
        )
    );

    if(name == "Saturn"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.4710,0.112,0.142,0.859);
    }else if(name == "Pluto"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.692,0.143,0.143,0.692);
    }
   
}// end of init orbit function



var wikiBtn;
var onOverPlanetOrbitInit =(meshEvent)=>{
   
    wikiBtn = document.createElement("span");
    wikiBtn.setAttribute("id", "planetOrbitLbl");
    var sty = wikiBtn.style;
    sty.position = "absolute";
      sty.lineHeight = "1.2em";
      sty.padding = "0.5%";
      sty.color = "#00BFFF  ";
      sty.fontFamily = "Courgette-Regular";
      sty.fontSize = "1vw";
      sty.top = (initScene.pointerY-10) + "px";
      sty.left = (initScene.pointerX+10) + "px";
      sty.cursor = "pointer";
    
    
    if(meshEvent.meshUnderPointer.name == "Earth") wikiBtn.setAttribute("onclick", "showPage('Earth')");
    else if(meshEvent.meshUnderPointer.name == "Mercury") wikiBtn.setAttribute("onclick", "showPage('Mercury_(planet)')");
    else if(meshEvent.meshUnderPointer.name == "Venus") wikiBtn.setAttribute("onclick", "showPage('Venus')");
    else if(meshEvent.meshUnderPointer.name == "Mars") wikiBtn.setAttribute("onclick", "showPage('Mars')");
    else if(meshEvent.meshUnderPointer.name == "Jupiter") wikiBtn.setAttribute("onclick", "showPage('Jupiter')");
    else if(meshEvent.meshUnderPointer.name == "Saturn") wikiBtn.setAttribute("onclick", "showPage('Saturn')");
    else if(meshEvent.meshUnderPointer.name == "Uranus") wikiBtn.setAttribute("onclick", "showPage('Uranus')");
    else if(meshEvent.meshUnderPointer.name == "Neptune") wikiBtn.setAttribute("onclick", "showPage('Neptune')");
    else if(meshEvent.meshUnderPointer.name == "Pluto") wikiBtn.setAttribute("onclick", "showPage('Pluto')");
    else if(meshEvent.meshUnderPointer.name == "Moon") wikiBtn.setAttribute("onclick", "showPage('Moon')");
    else if(meshEvent.meshUnderPointer.name == "Sun") wikiBtn.setAttribute("onclick", "showPage('Sun')");

    //constellations
    else if(meshEvent.meshUnderPointer.name == "Leo") wikiBtn.setAttribute("onclick", "showPage('Leo_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Aquarius") wikiBtn.setAttribute("onclick", "showPage('Aquarius_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Aries") wikiBtn.setAttribute("onclick", "showPage('Aries_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Cancer") wikiBtn.setAttribute("onclick", "showPage('Cancer_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Capricorn") wikiBtn.setAttribute("onclick", "showPage('Capricorn_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Gemini") wikiBtn.setAttribute("onclick", "showPage('Gemini_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Libra") wikiBtn.setAttribute("onclick", "showPage('Libra_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Pisces") wikiBtn.setAttribute("onclick", "showPage('Pisces_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Sagittarius") wikiBtn.setAttribute("onclick", "showPage('Sagittarius_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Scorpio") wikiBtn.setAttribute("onclick", "showPage('Scorpio_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Taurus") wikiBtn.setAttribute("onclick", "showPage('Taurus_(constellation)')");
    else if(meshEvent.meshUnderPointer.name == "Virgo") wikiBtn.setAttribute("onclick", "showPage('Virgo_(constellation)')");

    document.body.appendChild(wikiBtn);
    wikiBtn.textContent = meshEvent.meshUnderPointer.name;
};

//handles the on mouse out event
var onOutPlanetOrbitInit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    while (document.getElementById("planetOrbitLbl")) {
            document.getElementById("planetOrbitLbl").parentNode.removeChild(document.getElementById("planetOrbitLbl"));
    }   
};


var onOverPlanetInit =(meshEvent)=>{
    // console.log("over planet");
};

//handles the on mouse out event
var onOutPlanetInit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    // console.log("out planet");
};


function init_constellation(name, matlPath, h, w, scale, x, y, z){
    var temp= BABYLON.MeshBuilder.CreatePlane(name, {height:h, width: w}, initScene);
    temp.scaling = new BABYLON.Vector3(scale, scale, scale);
    temp.position = new BABYLON.Vector3(x,y,z);
    
    var tempMatl = new BABYLON.StandardMaterial("starMatl", initScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, initScene);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;
    temp.material.backFaceCulling = false;
    temp.freezeWorldMatrix();

    temp.actionManager = new BABYLON.ActionManager(initScene);
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbitInit
        )
    );
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbitInit
        )
    );

    if(name === "Leo"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.553,0.438,0.438, 0.553);
    }

}

function init_clone_constellation(name, temp, matlPath,scale, x, y, z){
    temp.position = new BABYLON.Vector3(x,y,z);
    temp.name = name;
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    
    var tempMatl = new BABYLON.StandardMaterial("starsMatl",initScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, initScene);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl; 
    // temp.freezeWorldMatrix();

    temp.actionManager = new BABYLON.ActionManager(initScene);
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbitInit
        )
    );
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbitInit
        )
    );

    if(name === "Gemini"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.149,0.729,0.179,0.632);
    }else if(name === "Virgo"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.0105,0.707,-0.014,-0.702);
    }else if(name === "Pisces"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.005,-0.698,-0.709,0.0155);
    }else if(name === "Sagittarius"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.411,-0.562,0.589,0.389);
    }else if(name === "Capricorn"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.694,0.0323,-0.106, 0.702);
    }else if(name === "Libra"){
        temp.rotationQuaternion = new BABYLON.Quaternion(0.152, -0.945, 0.043,0.256);
    }else if(name === "Aries"){
        temp.rotationQuaternion = new BABYLON.Quaternion( -0.0299, 0.158,  0.070,0.976);
    }else if(name === "Cancer"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.0469,-0.889,0.427,0.055);
    }else if(name === "Scorpio"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.0297,0.132,0.213,0.954);
    }else if(name === "Taurus"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.703, 0.010, 0.0256,0.695);
    }else if(name === "Aquarius"){
        temp.rotationQuaternion = new BABYLON.Quaternion(-0.032,-0.710,0.027,0.687);    
    }

    
    

}//end of init planet function

var leoStars,geminiStars;
function create_constellation_planes(){
    //params: name, matlpath, height, width, scaling, xPos, yPos, zPos
    // leoStars = init_constellation("Leo","front/textures/participate/constellations/leo.png",150,300,14,-2877, 4345, 1908);
    leoStars= BABYLON.MeshBuilder.CreatePlane("Leo", {height:150, width: 300}, initScene);
    leoStars.scaling = new BABYLON.Vector3(14,14,14);
    leoStars.position = new BABYLON.Vector3(-2877, 4345, 1908);
    leoStars.rotationQuaternion = new BABYLON.Quaternion(-0.553,0.438,0.438, 0.553);
    var leoStarsMatl = new BABYLON.StandardMaterial("leoMatl", initScene);
    leoStarsMatl.diffuseTexture = new BABYLON.Texture("front/textures/participate/constellations/leo.png", initScene);
    leoStarsMatl.diffuseTexture.hasAlpha = true;
    leoStars.material = leoStarsMatl;
    leoStars.material.backFaceCulling = false;
    leoStars.freezeWorldMatrix();

    leoStars.actionManager = new BABYLON.ActionManager(initScene);
    leoStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbitInit
        )
    );
    leoStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbitInit
        )
    );
    //params of clones: name, temp, matlPath,scale, x, y, z
    geminiStars = leoStars.clone();
    init_clone_constellation("Gemini",geminiStars,"front/textures/participate/constellations/gemini.png",14,4227,2823,806);

    virgoStars = leoStars.clone();
    init_clone_constellation("Virgo",virgoStars,"front/textures/participate/constellations/virgo.png",14,-4242, 2864,-9);

    piscesStars = leoStars.clone();
    init_clone_constellation("Pisces",piscesStars,"front/textures/participate/constellations/pisces.png",14,942, 4350,1731);

    sagittariusStars = leoStars.clone();
    init_clone_constellation("Sagittarius",sagittariusStars,"front/textures/participate/constellations/sagittarius.png",14,2917, -4081,614);

    capricornStars = leoStars.clone();
    init_clone_constellation("Capricorn",capricornStars,"front/textures/participate/constellations/capricorn.png",14,-1996,-3873,2000);

    libraStars = leoStars.clone();
    init_clone_constellation("Libra",libraStars,"front/textures/participate/constellations/libra.png",14,-766,1584,-3235);

    ariesStars = leoStars.clone();
    init_clone_constellation("Aries",ariesStars,"front/textures/participate/constellations/aries2.png",14,664,3268,5197);

    cancerStars = leoStars.clone();
    init_clone_constellation("Cancer",cancerStars,"front/textures/participate/constellations/cancer.png",14,-417,-3774,-2125);

    scorpioStars = leoStars.clone();
    init_clone_constellation("Scorpio",scorpioStars,"front/textures/participate/constellations/scorpio.png",14,1000,-2362,5218);

    taurusStars = leoStars.clone();
    init_clone_constellation("Taurus",taurusStars,"front/textures/participate/constellations/taurus.png",14,-121,4275,-982);

    aquariusStars = leoStars.clone();
    init_clone_constellation("Aquarius",aquariusStars,"front/textures/participate/constellations/aquarius.png",14,-4223, -2058,773);
    

//     var gl = new BABYLON.GlowLayer("glow", earthScene);
// gl.addIncludedOnlyMesh(starsForm)
    starsLight = new BABYLON.HighlightLayer("starsLight", initScene);
    starsLight.addMesh(leoStars, BABYLON.Color3.Yellow());
    //starsLight.addMesh(ariesStars, new BABYLON.Color3(1,0.5,0));
    starsLight.addMesh(ariesStars, BABYLON.Color3.Red());
    starsLight.addMesh(taurusStars, BABYLON.Color3.Teal());
    starsLight.addMesh(geminiStars, BABYLON.Color3.Yellow());
    starsLight.addMesh(cancerStars,  BABYLON.Color3.Teal());
    starsLight.addMesh(virgoStars,  BABYLON.Color3.Green());
    starsLight.addMesh(libraStars,  new BABYLON.Color3(1,0.1,0.7));
    starsLight.addMesh(scorpioStars,  BABYLON.Color3.Red());
    starsLight.addMesh(sagittariusStars,  BABYLON.Color3.Purple());
    starsLight.addMesh(capricornStars,  new BABYLON.Color3(0,0.5,0));
    starsLight.addMesh(piscesStars,  BABYLON.Color3.Green());

    starsLight.innerGlow = false;
    starsLight.intensity = 1;
    // console.log("glow color: ", starsLight);

    var alpha = 0;
    initScene.registerBeforeRender(() => {
        alpha += 0.1;
        
        starsLight.blurHorizontalSize = 0.5 + Math.cos(alpha) * 0.4 + 0.4;     
        starsLight.blurVerticalSize = 0.5 + Math.sin(alpha / 3) * 0.4 + 0.4;
    });
   
}


let isFast = false;
let whoaAudio = new Audio('front/audio/participateScene/whoaAudio.mp3');

            //create the game engine
            var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);

            //create the scene
            var theScene = createScene();

            
            theScene.executeWhenReady(function () {  
                document.getElementById("loadingScreenPercent").style.visibility = "hidden";
                document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
                document.getElementById("loadingScreenDiv").remove();
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
            });



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

        if(loader.style.visibility != "visible") loader.style.visibility = "visible";
        

        
        document.getElementById("page-url").textContent = "https://en.wikipedia.org/wiki/"+pageName+"";
        page.src  = "https://en.wikipedia.org/wiki/"+pageName;
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
            document.getElementById("wikipediaDiv").style.width = "30%";
            isCharDivFullscreen = false;
        }
    }//end of fullscreenDescDiv
