
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
    BABYLON.Database.IDBStorageEnabled = true;

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
    camera.allowUpsideDown = false;
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    //set zoom in and zoom out capability
    camera.lowerRadiusLimit = 200;
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10;
    camera.panningDistanceLimit = 1500;
    camera.pinchPrecision = 1;
    camera.attachControl(canvas,true);
    camera.maxZ = 28000;
    initScene.activeCamera = camera;

    return camera;
}//end of create camera function
                   
//function that creates scene's hemispheric light
var light2;
function create_init_light(){
    var light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(1,3,100), initScene);
    light.radius = 500;
    light.specular = new BABYLON.Color3(0,0,0);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.groundColor = new BABYLON.Color3(0.5,0.5,0.5);
    light.intensity = 1;

    light2 = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(1,3,100), initScene);
    light2.radius = 500;
    light2.specular = new BABYLON.Color3(0,0,0);
    light2.diffuse = new BABYLON.Color3(1,1,1);
    light2.intensity = 4;

    return light;

}//end of create earth light function

function create_init_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("initSkybox", {size:25000.0}, initScene);
    skybox.position = new BABYLON.Vector3(942,-500,-1500);

    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.infiniteDistance = true;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("captSkyboxMaterial", initScene);
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
                    pbr.roughness = 0.08;
                    pbr.microSurface = 1; 
                }else if(m.name === "R_EYEAventurine_primitive1" || m.name === "L_EYEAventurine_primitive1" ){
                    m.material.albedoColor = new BABYLON.Color3(0.01,0.2,0.07);
                }
            });

                    
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/nuvola/", "mermaidTail.babylon", initScene).then(function (result) {
          mermaidTail_object = result.meshes[0];
          
        //   initScene.ambientColor = new BABYLON.Color3(0.2,0.2,0.2);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/nuvola/", "mermaidBody.babylon", initScene).then(function (result) {
          mermaidHead =result.meshes[0];
          mermaidHair = result.meshes[1];
       
        }),
      
    ]).then(() => {
        mermaidHead.setParent(mermaidTail_object);
        mermaidHair.setParent(mermaidTail_object);
        mermaidTail_object.position = new BABYLON.Vector3( -551.84,219.14,709.45);
        mermaidTail_object.rotationQuaternion = new BABYLON.Quaternion(-0.0946,-0.8844,0.1707,-0.4235);
        mermaidTail_object.scaling = new BABYLON.Vector3(0.15,0.15,0.15);

        mermaidTail_object.isPickable = true;
    
        initCamera.target = new BABYLON.Vector3(0,0,0);
        initCamera.radius = 1360;
        mbayeInit_object.isPickable = true;

        nuvolaSpeech =  create_mesh("nuvolaSpeech", "front/images3D/participateScene/nuvolaNonmember.png",78 , 110, 1, -566, 278, 684, {x:0.0249,y:0.8594,z:-0.1207,w:0.4959});
        let temp = init_scrollable_viewer("speech1Nonmember","speech1Nonmember.png",2000,1000,{x:-5300,y:413,z:2148},{x:0.1143,  y:-0.5471, z:0.0752, w:0.8256});
        let solar = create_mesh("Solar","front/images3D/homeScene/solarSitting2.png",800,650,1,-6040,297,1069,{x:0.0899,  y:-0.6906, z:0.0035, w:0.7171});
       

        solar.actionManager = new BABYLON.ActionManager(initScene);
        solar.actionManager.registerAction(
              new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
              onOverSun)
        );
        solar.actionManager.registerAction(
              new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
               onOutSun)
        );
       
        // enable_home_gizmo2(solar);
    });
}//end of function load meshes



function create_lowres_earth(){
    initEarth_object = init_planet("earth","earthMatl","front/textures/home/planets/earth.jpg","front/textures/home/planets/earthnormal.png",0,0,0,400);
    animateObjectRotationNoEase(initEarth_object, 10, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
}


function load_highres_earth(){
    Promise.all([
        
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", initScene 
            ).then(function (result) {
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
        animateObjectRotationNoEase(initEarth_object, 10, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
    });
}




function init_scrollable_viewer(name,imgName,w,h,pos,rot){
    //create plane for the texts
    let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, initScene);
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);

    let discmatl = new BABYLON.StandardMaterial(name+"Matl", initScene);
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
        if(isSpeechViewActive) initCamera.detachControl(canvas);
    });
    sv.onPointerUpObservable.add(function() {
        if(isSpeechViewActive) initCamera.attachControl(canvas,true);
    });
    advancedTexture.addControl(sv);

    //create holder of solar's text image
    var rc = new BABYLON.GUI.Rectangle();
    rc.thickness = 0;
    rc.width = 1;
    
   
    rc.height = 4;
    rc.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
    rc.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
    rc.isPickable = false;

    sv.addControl(rc);

    //create the image and add to the rectangle holder
    var image = new BABYLON.GUI.Image(name+"Img", "front/images3D/participateScene/"+imgName);
    image.width = 1;
    image.height = 1;
    rc.addControl(image);
    return plane;
}


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
let sunOrigTexture;
let sunGlowLayer;
function create_init_planets(){
    //create the sun
    initSun = init_planet("sun","sunMatl","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg",-78,319,-2097,250);
    //add glow effect to the sun
    sunGlowLayer = new BABYLON.GlowLayer("glow", initScene);
    sunGlowLayer.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
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
          onOverSun)
    );
    initSun.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
           onOutSun)
    );

  
    animateObjectRotationNoEase(initVenus, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(360), 0));
    animateObjectRotationNoEase(initMars, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
    animateObjectRotationNoEase(initJupiter, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
    animateObjectRotationNoEase(initUranus, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
    animateObjectRotationNoEase(initNeptune, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
    animateObjectRotationNoEase(initPluto, 15, 200, new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360), 0));
   
} // end of create_planets function



var animateObjectRotationNoEase = function(obj, speed, frameCount, newRot) {
    BABYLON.Animation.CreateAndStartAnimation('objRot'+obj.name, obj, 'rotation', speed, frameCount, obj.rotation, newRot, 1, null);
}

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 0, radius, initScene);
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

    if(name === "sun")  sunOrigTexture = temp.material.diffuseTexture;

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


let origScaling;
var onOverSun =(meshEvent)=>{
    var theMeshID = meshEvent.source.id;
  
    let lbl = document.createElement("span");
    lbl.setAttribute("id", "sunLbl");
    var sty = lbl.style;
    sty.position = "absolute";
    // sty.lineHeight = "2em";
    sty.padding = "0.2%";
    sty.color = "#efad0c";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "2em";
    sty.top = meshEvent.pointerY + "px";
    sty.left = meshEvent.pointerX + "px";
    sty.cursor = "pointer";
    
 
    if(initWebCamScreen){
        if(theMeshID == "sun"){
           
            initSun.material.diffuseTexture = initVideo;
            sunGlowLayer.intensity = 0;
        } 
    }

    if(theMeshID === "Solar"){
        meshEvent.source.material.emissiveColor = BABYLON.Color3.White();
        origScaling = meshEvent.source.scaling;
        meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.1,origScaling.y*1.1,origScaling.z*1.1);
        document.body.appendChild(lbl);
        if(!isSpeechViewActive) lbl.textContent = "View";
        else lbl.textContent = "Return";
    }
};

//handles the on mouse out event
var onOutSun =(meshEvent)=>{
    if(!isMobile()) initSun.material.diffuseTexture = sunOrigTexture;
    if(meshEvent.source.id === "Solar"){
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0.4,0.4,0.4);
        meshEvent.source.scaling = origScaling;
    }
    while (document.getElementById("sunLbl")) {
        document.getElementById("sunLbl").parentNode.removeChild(document.getElementById("sunLbl"));
    } 
    sunGlowLayer.intensity = 1;
};

let initVideo;  
let initWebCamScreen,initWebCamScreen22;  
function enable_init_webcamera(){
    // console.log("this is called");
    var isAssigned = false; // Is the Webcam stream assigned to material?

    initWebCamScreen = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen", {radius:110, tessellation: 0}, initScene);
    initWebCamScreen.position = new BABYLON.Vector3(3536,461,-648);
    initWebCamScreen.isPickable = false;
    initWebCamScreen22 = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen22", {radius:110, tessellation: 0}, initScene);
    initWebCamScreen22.position = new BABYLON.Vector3(3536,461,-648);
    if(initSun) initWebCamScreen.setParent(initSun);
    // initLight.includedOnlyMeshes.push(initWebCamScreen);
    // initLight.includedOnlyMeshes.push(initWebCamScreen22);

    initWebCamScreen.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen22.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen.setEnabled(false);
    initWebCamScreen.isVisible = false;
    initWebCamScreen22.setEnabled(false);
    initWebCamScreen22.isVisible = false;
  
    var videoMaterial2 = new BABYLON.StandardMaterial("initWebCamScreenTexture", initScene);
    videoMaterial2.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial2.backFaceCulling = false;  


 var videoMaterial3 = new BABYLON.StandardMaterial("initWebCamScreenTexture", initScene);
    videoMaterial3.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial3.backFaceCulling = false;  

    initWebCamScreen22.material = videoMaterial3;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(initScene, function (videoTexture2) {
        initVideo = videoTexture2;
        videoMaterial2.diffuseTexture = initVideo;
        // console.log("init video",initVideo);
    }, { maxWidth: 256, maxHeight: 256 });
  
    initScene.onBeforeRenderObservable.add(function () {
        if (initVideo !== undefined && isAssigned == false) {
            if (initVideo.video.readyState == 4) {
                initWebCamScreen.material = videoMaterial2;
                
                isAssigned = true;
            }
        }
    });

}//end of function

$("#infoIcon").on('click',function(){
    $('#instruction-left-div').toggle();
    $('#infoIconTextup').toggle();
});

let initPointer = {x:null,y:null,z:null};
let deltaPointer = {x:0,y:0,z:0};
var timestamp = null;
let lastMouseX;
let lastMouseY;
let startTime;
let isSpeechViewActive = false;
let focusSpeechSpecs = [{x: -4169, y: 761, z: 1350},5.8836,1.2971, 100];
let initCameraSpecs = [{x: -1134, y: 516, z: 1000},2.4193,1.2420, 1350];

function add_init_mouse_listener(){
        var onPointerDownInit = function (evt) {
            if(initScene) var pickinfo = initScene.pick(initScene.pointerX, initScene.pointerY);
            else return;
            if(pickinfo.hit){
                
                var theInitMesh = pickinfo.pickedMesh.name;
                console.log(pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
                console.log(initCamera.position, initCamera.alpha, initCamera.beta, initCamera.radius);

                if(theInitMesh === "sun"){
                    checkScreenAndDoubleClick('register', 'register');
                }
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

           if(orbitsMap.has(theInitMesh)){
                //check if the screen is mobile/tablet
               checkScreenAndDoubleClick(theInitMesh, 'orbit');
           }
           if(starsMap.has(theInitMesh)){
                //check if the screen is mobile/tablet
                checkScreenAndDoubleClick(theInitMesh,'star');
            }

            if(theInitMesh === "Solar"){
                // initCamera.position = new BABYLON.Vector3( -4258, 738, 1708);
                let pos = focusSpeechSpecs[0];
                if(!isSpeechViewActive){
                    initCamera.setTarget(new BABYLON.Vector3(pos.x,pos.y,pos.z));
                    initCamera.alpha = focusSpeechSpecs[1];
                    initCamera.beta = focusSpeechSpecs[2];
                    initCamera.radius = focusSpeechSpecs[3];
                    isSpeechViewActive = true;
                }else{
                    initCamera.setTarget(new BABYLON.Vector3(0,0,0));
                    initCamera.alpha = initCameraSpecs[1];
                    initCamera.beta = initCameraSpecs[2];
                    initCamera.radius = initCameraSpecs[3];
                    // initCamera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,1000),initScene);
                    isSpeechViewActive = false;
                }
            }

            // if(theInitMesh === "Solar" && isSpeechViewActive){
            //     let pos = initCameraSpecs[0];
            //     initCamera.setTarget(new BABYLON.Vector3(0,0,0));
            //     initCamera.alpha = initCameraSpecs[1];
            //     initCamera.beta = initCameraSpecs[2];
            //     initCamera.radius = initCameraSpecs[3];
            //     // initCamera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,1000),initScene);
            //     isSpeechViewActive = false;
            // }
           

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

                if(speedX >= 800){
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


let orbitsMap = new Map();
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

    orbitsMap.set(name,null);
   
}// end of init orbit function


function openWikipediaPage(theObj, type){
    
    if(theObj == "Mercury") showPage('Mercury_(planet)');
    else showPage(theObj);    

    if(type == 'star'){
        if(theObj== "Leo") showPage('Leo_(constellation)');
        else if(theObj== "Aquarius") showPage('Aquarius_(constellation)');
        else if(theObj== "Aries") showPage('Aries_(constellation)');
        else if(theObj== "Cancer") showPage('Cancer_(constellation)');
        else if(theObj== "Capricorn") showPage('Capricorn_(constellation)');
        else if(theObj== "Gemini") showPage('Gemini_(constellation)');
        else if(theObj== "Libra") showPage('Libra_(constellation)');
        else if(theObj== "Pisces") showPage('Pisces_(constellation)');
        else if(theObj== "Sagittarius") showPage('Sagittarius_(constellation)');
        else if(theObj== "Scorpio") showPage('Scorpio_(constellation)');
        else if(theObj== "Taurus") showPage('Taurus_(constellation)');
        else if(theObj== "Virgo") showPage('Virgo_(constellation)');
    }


}

var wikiBtn;
var onOverPlanetOrbitInit =(meshEvent)=>{
   
    wikiBtn = document.createElement("span");
    wikiBtn.setAttribute("id", "planetOrbitLbl");
    var sty = wikiBtn.style;
    sty.position = "absolute";
    //   sty.lineHeight = "1.2em";
    //   sty.padding = "0.5%";
      sty.color = "#00BFFF  ";
      sty.fontFamily = "Courgette-Regular";
      sty.fontSize = "3rem";   
      sty.top = (initScene.pointerY-50) + "px";
      sty.left = (initScene.pointerX-50) + "px";
      sty.cursor = "pointer";
    
    if(orbitsMap.has(meshEvent.meshUnderPointer.name)) wikiBtn.setAttribute("onclick", "openWikipediaPage('"+meshEvent.meshUnderPointer.name+"', 'orbit')");
    //constellations
    if(meshEvent.meshUnderPointer.name == "Leo") wikiBtn.setAttribute("onclick", "showPage('Leo_(constellation)')");
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


//added so the orbit label wont show when a planet is hovered
var onOverPlanetInit =(meshEvent)=>{
    // console.log("over planet");
};

//handles the on mouse out event
var onOutPlanetInit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    // console.log("out planet");
};


function create_mesh(name, matlPath, h, w, scale, x, y, z,rot){
    var temp= BABYLON.MeshBuilder.CreatePlane(name, {height:h, width: w}, initScene);
    temp.scaling = new BABYLON.Vector3(scale, scale, scale);
    temp.position = new BABYLON.Vector3(x,y,z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y,rot.z,rot.w);
    
    var tempMatl = new BABYLON.StandardMaterial(name+"matl", initScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, initScene);
    tempMatl.opacityTexture = new BABYLON.Texture(matlPath, initScene);
    if(name == "Solar") tempMatl.emissiveColor = new BABYLON.Color3(0.4,0.4,0.4);

    tempMatl.ambientColor = new BABYLON.Color3(1,1,1);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;
    // temp.material.backFaceCulling = false;
    
    return temp;
}

let starsMap = new Map();
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
    starsMap.set(name, null);

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

    starsMap.set(name, null);

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
    
    //make the stars shine brighter, add to 2nd light
    light2.includedOnlyMeshes.push(leoStars);
    light2.includedOnlyMeshes.push(geminiStars);
    light2.includedOnlyMeshes.push(virgoStars);
    light2.includedOnlyMeshes.push(sagittariusStars);
    light2.includedOnlyMeshes.push(capricornStars);
    light2.includedOnlyMeshes.push(ariesStars);
    light2.includedOnlyMeshes.push(cancerStars);
    light2.includedOnlyMeshes.push(scorpioStars);
    light2.includedOnlyMeshes.push(taurusStars);
    light2.includedOnlyMeshes.push(aquariusStars);

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


let loadCounter=0;
setInterval(function(){ 
    if(loadCounter<100) $('#loadingScreenPercent').html("Loading: "+loadCounter+" %");
    loadCounter++;
}, 700);



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
    
   
    // scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(theScene, options);

    // if the current screen is a mobile/tablet device
    if(isSmallDevice() || isMobile()){
        if(initSun){
            initSun.material.diffuseTexture = initVideo;
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


//check orientation of screen when page is loaded
$( document ).ready(function() {
    testOrientation();
    if(isSmallDevice() || isMobile()) create_lowres_earth();
    else load_highres_earth();  
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
    $('#fullscreenIcon').hide();

    
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
    $('#fullscreenIcon').show();
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


    //check if a mesh is clicked
var isMeshClicked = false;
function checkScreenAndDoubleClick(theMesh, type){
    if(isMobile()){
        if(isMeshClicked){
            isMeshClicked = false;
            if(type=='register') window.location.href = theMesh; 
            else openWikipediaPage(theMesh, type);
        }else{
            isMeshClicked = true;
            // setTimeout(function(){
            //     if(isMeshClicked){
            //         isMeshClicked = false;
            //             Swal.fire({
            //                 width: '10vw',
            //                 padding: '3em',
            //                 title: 'Double Tap to enter the planet.',
            //                 showConfirmButton: false,
            //                 position: 'top-end',
            //                 showClass:{
            //                     backdrop: 'swal2-backdrop-hide',
            //                 },
            //                 timer: 2000,
            //                 width: 100,
            //                 customClass: {
            //                     popup: 'trevor-popup-class',
            //                 }
            //             });
            //         }
            // },500);
        }
    }else{
        if(type === 'orbit') openWikipediaPage(theMesh, type);
        else if(type=='register') window.location.href = theMesh; 
    }
    
}
