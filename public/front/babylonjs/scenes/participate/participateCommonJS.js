//function that creates the scene's cameras
function create_camera(scene){
    var camera = new BABYLON.ArcRotateCamera("Earth Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,1000),scene);
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    //set zoom in and zoom out capability
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.attachControl(canvas, true);
    camera.wheelPrecision = 3;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10; 
    camera.panningDistanceLimit = 1500;
    camera.pinchPrecision = 1;
    scene.activeCamera = camera;
    camera.maxZ = 28000;
    camera.viewport = new BABYLON.Viewport(0, 0, 1, 1);

    return camera;
}//end of create camera function


  

//function that creates scene's hemispheric light
function create_light(scene){
    var light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(1,3,100), scene);
    light.radius = 500;
    light.specular = new BABYLON.Color3(0,0,0);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.groundColor = new BABYLON.Color3(0.5,0.5,0.5);
    light.intensity = 3;
    return light;

}//end of create earth light function


//function that will create the skybox for the second scene
function create_skybox(scene){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("earthSkybox", {size:25000.0}, scene);
    //console.log(skybox);
    //skybox position: negative value - move the skybox towards the bottom; positive value - move the skybox towards the top
    skybox.position.y = 100;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("earthSkyboxMaterial", scene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
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


   

let solarOrbit;
function create_solar_orbit(scene){
    solarOrbit = BABYLON.Mesh.CreateGround("orbit", 3000, 2600, 1, scene);
    solarOrbit.isPickable = false;
    solarOrbit.scaling = new BABYLON.Vector3(2.5,2.5,2.5);
    solarOrbit.position = new BABYLON.Vector3(200,0,-100);
    solarOrbit.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(-10),BABYLON.Tools.ToRadians(180),BABYLON.Tools.ToRadians(0));

    var solarOrbitMatl = new BABYLON.StandardMaterial("orbitMatl", scene);
    solarOrbitMatl.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/earthSceneOrbit2.png", scene);
    solarOrbitMatl.diffuseTexture.hasAlpha = true;
    solarOrbitMatl.backFaceCulling = false;
    solarOrbit.material = solarOrbitMatl;
    solarOrbit.material.freeze();
    solarOrbit.freezeWorldMatrix();
}

function add_hdr_environment(scene){
    var hdrTextureEarth = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene); 
    hdrTextureEarth.gammaSpace = false;
    hdrTextureEarth.level = 0.5;
    scene.environmentTexture = hdrTextureEarth;                    //set the environment's texture
}



let initVideo;  
let initWebCamScreen,initWebCamScreen22;  
function enable_init_webcamera(scene){
    // console.log("this is called");
    var isAssigned = false; // Is the Webcam stream assigned to material?

    initWebCamScreen = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen", {radius:110, tessellation: 0}, scene);
    initWebCamScreen.position = new BABYLON.Vector3(3536,461,-648);
    initWebCamScreen.isPickable = false;
    initWebCamScreen22 = BABYLON.MeshBuilder.CreateDisc("initWebCamScreen22", {radius:110, tessellation: 0}, scene);
    initWebCamScreen22.position = new BABYLON.Vector3(3536,461,-648);
    if(sun) initWebCamScreen.setParent(sun);

    initWebCamScreen.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen22.rotationQuaternion = new BABYLON.Quaternion(0,-0.6424,0,0.7663);
    initWebCamScreen.setEnabled(false);
    initWebCamScreen.isVisible = false;
    initWebCamScreen22.setEnabled(false);
    initWebCamScreen22.isVisible = false;
  
    var videoMaterial2 = new BABYLON.StandardMaterial("initWebCamScreenTexture", scene);
    videoMaterial2.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial2.backFaceCulling = false;  


    var videoMaterial3 = new BABYLON.StandardMaterial("initWebCamScreenTexture", scene);
    videoMaterial3.specularColor = new BABYLON.Color3(0,0,0);
    videoMaterial3.backFaceCulling = false;  

    initWebCamScreen22.material = videoMaterial3;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(scene, function (videoTexture2) {
        initVideo = videoTexture2;
        videoMaterial2.diffuseTexture = initVideo;
    }, { maxWidth: 256, maxHeight: 256 });
  
    scene.onBeforeRenderObservable.add(function () {
        if (initVideo !== undefined && isAssigned == false) {
            if (initVideo.video.readyState == 4) {
                initWebCamScreen.material = videoMaterial2;
                
                isAssigned = true;
            }
        }
    });

}//end of function



// var webcamScreen;
// var myVideo;    
// function enable_webcamera(scene){
//     // Our Webcam stream (a DOM <video>)
//     var isAssigned = false; // Is the Webcam stream assigned to material?

//     webcamScreen = BABYLON.MeshBuilder.CreateDisc("webcamScreen2", {radius:110, tessellation: 0}, scene);
//     webcamScreen.position = new BABYLON.Vector3(-122,321,-1961);
//     webcamScreen.rotationQuaternion = new BABYLON.Quaternion(0.023,0.990,-0.002,0.009);
//     webcamScreen.setEnabled(false);
//     webcamScreen.isVisible = false;

//     var videoMaterial = new BABYLON.StandardMaterial("webcamScreenTexture", scene);

//     videoMaterial.specularColor = new BABYLON.Color3(0,0,0);

//     // Create our video texture
//     BABYLON.VideoTexture.CreateFromWebCam(scene, function (videoTexture) {
//         myVideo = videoTexture;
//         videoMaterial.diffuseTexture = myVideo;
//     }, { maxWidth: 256, maxHeight: 256 });

//     scene.onBeforeRenderObservable.add(function () {
//         if(myVideo !== undefined && isAssigned == false) {
//             if(myVideo.video.readyState == 4) {
//                 webcamScreen.material = videoMaterial;
//                 isAssigned = true;
//             }
//         }
//     });
// }//end of enable webcam function


// function add_glow(mesh,scene){
//     var gl = new BABYLON.GlowLayer("glow", scene);
//     gl.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
//         if (mesh.name === "sun") {
//             result.set(235, 192, 52, 0.2);
//         }else {
//             result.set(0, 0, 0, 0);
//         }
//     }
// }


var sun;
var planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
var redAngle = 0.01;   
var yellowAngle = 0.02;
var grayAngle = -0.01;
let TEXTURE_PATH = "front/textures/home/planets/";
let sunOrigTexture;


function create_planets(scene){
    //create the sun
   
    try{
        for (const [planet,val] of planetsMap.entries()) {
            //val 0 - texture name, 1 - normal texture name, 2 - position, 3- radius
            if(planet === "sun"){
                let temp = init_planet(planet, planet+"matl",TEXTURE_PATH+val[0], TEXTURE_PATH+val[1], val[2], val[3], scene);
                // add_glow(temp, scene);
                sun = temp;
                sunOrigTexture = temp.material.diffuseTexture;
               
            }else if(planet === "saturn"){
                let temp = init_planet(planet, planet+"matl",TEXTURE_PATH+val[0], TEXTURE_PATH+val[1], val[2], val[3], scene);
                create_saturn_ring(temp,scene);
            }else{
                let temp = sun.clone(planet);
                init_clone_planet(temp,planet+"matl",TEXTURE_PATH+val[0],TEXTURE_PATH+val[1],val[2],val[3],scene);
                if(planet==='venus' || planet === 'uranus') animatePlanetRotation(temp,10,200,new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-360),0));
                else animatePlanetRotation(temp,10,200,new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(360),0));
            }
            // 
        }
        
    }catch(err){
        // console.log(err,"cannot access the map");
    }


} // end of create_planets function



var onOverPlanetOrbit =(meshEvent)=>{

    let wikiBtn = document.createElement("span");
    wikiBtn.setAttribute("id", "planetOrbitLbl");
    var sty = wikiBtn.style;
    sty.position = "absolute";
    sty.color = "#00BFFF  ";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "2rem";
    sty.top = meshEvent.pointerY + "px";
    sty.left = meshEvent.pointerX + "px";
    sty.cursor = "pointer";
    sty.textShadow = "1px 1px 3px black";
    
    let theMesh = meshEvent.meshUnderPointer.name;
    if(wikiMap.has(theMesh)){
        let link = wikiMap.get(theMesh);
        if(link) wikiBtn.setAttribute("onclick", "showPage('"+link+"')");
        else wikiBtn.setAttribute("onclick", "showPage('"+theMesh+"')");
    }
    document.body.appendChild(wikiBtn);
    wikiBtn.textContent = meshEvent.meshUnderPointer.name;
};

//handles the on mouse out event
var onOutPlanetOrbit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    while (document.getElementById("planetOrbitLbl")) {
            document.getElementById("planetOrbitLbl").parentNode.removeChild(document.getElementById("planetOrbitLbl"));
    }   
};


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

     if(initWebCamScreen){
        if(theMeshID == "sun") sun.material.diffuseTexture = initVideo;
    } 

    // if(meshEvent.meshUnderPointer.name === "sun"){
    //     if(webcamScreen){
    //         webcamScreen.setEnabled(true);
    //         webcamScreen.isVisible = true;  
    //         let camX = initCamera.position.x;
    //         let camY = initCamera.position.y;
    //         let x = -122;
    //         let y = 323;
    //         let z = -1960;
    //         if( camX<-700 && camX>=-900) x = -110;
    //         else if( camX<-500 && camX>=-700) x = -105;
    //         else if( camX<-300 && camX>=-500) x = -90;
    //         else if(camX<100 && camX>=-300) x = -80;
    //         else if(camX<300 && camX>=100) x = -70;
    //         else if(camX<700 && camX>=300) x = -55;
    //         else if(camX<900 && camX>=700) x = -40;
    //         else if(camX<1000 && camX>=900) x = -30;
    //         else if(camX>=1000) x = -25;
    //         //else webcamScreen.position = new BABYLON.Vector3(-122,320,-1960);   //the initial position

    //         if(camY>700 && camY <= 1000) y = 335;
    //         else if(camY>500 && camY <= 700) y = 330;
    //         else if(camY>300 && camY <= 500) y = 323;
    //         else if(camY>0 && camY <= 300) y = 310;
    //         else if(camY>-200 && camY <= 0) y = 300;
    //         else if(camY>-500 && camY <= -200) y = 290;
    //         else if(camY>-700 && camY <= -500) y = 280;
    //         else if(camY>-900 && camY <= -700) y = 270;
    //         else if(camY>-1100 && camY <= -900) y = 260; 
    //         else if(camY>-1300 && camY <= -1100) y = 250;   
    //         webcamScreen.position = new BABYLON.Vector3(x,y,z);

    //         let theMesh = meshEvent.meshUnderPointer.name;
    //         let val = planetsLinkTextMap.get(theMesh);

    //         if(val) wikiBtn.setAttribute("onclick", "window.open('"+val[1]+"')");
    
    //         document.body.appendChild(wikiBtn);
    //         wikiBtn.textContent = val[0];
    //     } 
    // }=
    if(planetsMap.has(theMeshID)){
        planetOrigScaling = meshEvent.meshUnderPointer.scaling;
        let scale = meshEvent.meshUnderPointer.scaling;
        meshEvent.meshUnderPointer.scaling = new BABYLON.Vector3(scale.x*1.1, scale.y*1.1, scale.z*1.1);

    }
};

//handles the on mouse out event
var onOutPlanet=(meshEvent)=>{
    // if(initWebCamScreen){
    //     webcamScreen.setEnabled(false);
    //     webcamScreen.isVisible = false; 
    // }

    if(!isMobile()) sun.material.diffuseTexture = sunOrigTexture;
    
    if(planetsMap.has(meshEvent.meshUnderPointer.name)){
        meshEvent.meshUnderPointer.scaling = planetOrigScaling;
    }

    while (document.getElementById("planetLbl")) {
        document.getElementById("planetLbl").parentNode.removeChild(document.getElementById("planetLbl"));
    } 
};


let earthAnimation;
var animatePlanetRotation = function(obj, speed, frameCount, newRot) {
    
    let anim = BABYLON.Animation.CreateAndStartAnimation('objRot', obj, 'rotation', speed, frameCount, obj.rotation, newRot, 1, null);
    if(obj === earthNormal_object) earthAnimation = anim;

}



//show_alert_box("Are you sure you want to go to the HOME page?","/");

// function show_alert_box(titleText,path){
//     Swal.fire({
//         title: titleText,
//         imageUrl: '../../front/icons/alert-icon.png',
//         imageWidth: '10vw',
//         imageHeight: 'auto',
//         imageAlt: 'Warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, I\'m sure!',
//         width: '20%',
//         padding: '1rem',
//         background: 'rgba(8, 64, 147, 0.62)',
//     }).then((result) => {
//         if (result.value) {
//             window.open(path,"_self"); 
//         }
//       });
// }

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

let ORBIT_TEXTURE_PATH = "front/textures/participate/";
let earthOrbit,marsOrbit,venusOrbit,mercuryOrbit,neptuneOrbit;
function init_planet_orbit(name,imgName,pos,rot,scale,r,scene){
    var temp;
    if(name === "Earth"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation: 0}, scene);
        earthOrbit = temp;
    }else if(name === "Venus"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation: 0}, scene);
        venusOrbit = temp;
    }else if(name === "Mars"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation: 0}, scene);
        marsOrbit = temp;
    }else if(name === "Neptune"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation: 0}, scene);
        neptuneOrbit = temp;
    }else if(name === "Mercury"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation: 0}, scene);
        mercuryOrbit = temp;
    }else if(name === "Saturn"){
        temp = venusOrbit.createInstance(name);
    }else if(name === "Uranus"){
        temp = mercuryOrbit.createInstance(name);
    }else if(name === "Moon"){
        temp = neptuneOrbit.createInstance(name);
    }else if(name === "Sun"){
        temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:r, tessellation:0},scene);
    }else{
        temp = marsOrbit.createInstance(name);
    }

    if(name === "Saturn") temp.rotationQuaternion = new BABYLON.Quaternion(-0.4710,0.112,0.142,0.859);
    else if(name === "Pluto") temp.rotationQuaternion = new BABYLON.Quaternion(0.692,0.143,0.143,0.692);
    else temp.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(rot.x), BABYLON.Tools.ToRadians(rot.y), BABYLON.Tools.ToRadians(rot.z));
   
    temp.position =  new BABYLON.Vector3(pos.x, pos.y, pos.z);
    temp.scaling = new BABYLON.Vector3(scale, scale, scale);
    var orbitMatl = new BABYLON.StandardMaterial(name+"Matl", scene);
    orbitMatl.diffuseTexture = new BABYLON.Texture(ORBIT_TEXTURE_PATH+imgName, scene);
    orbitMatl.diffuseTexture.hasAlpha = true;
    temp.material = orbitMatl;
    temp.material.backFaceCulling = false;
    
    return temp;
}

let planetOrbitsObjMap = new Map();
function create_planet_orbit(scene){
    try{
        for (const [planet,val] of planetOrbitsMap.entries()) {
            //val 0 - texture name, 1 - position, 2 - rotation, 3- scaling, 4-radius
            let orbit = init_planet_orbit(planet,val[0], val[1],val[2],val[3],val[4],scene);
            planetOrbitsObjMap.set(orbit.name, orbit);

            orbit.actionManager = new BABYLON.ActionManager(scene);
            orbit.actionManager.registerAction(
                new BABYLON.ExecuteCodeAction(
                    BABYLON.ActionManager.OnPointerOverTrigger,
                    onOverPlanetOrbit
                )
            );
            orbit.actionManager.registerAction(
                new BABYLON.ExecuteCodeAction(
                    BABYLON.ActionManager.OnPointerOutTrigger,
                    onOutPlanetOrbit
                )
            );

        }
    }catch(err){
        console.log(err);
    }
}//end of fxn

let starsObjMap = new Map();
function init_clone_constellation(name, temp, matlPath,scale, x, y, z,scene){
    temp.position = new BABYLON.Vector3(x,y,z);
    temp.name = name;
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    
    var tempMatl = new BABYLON.StandardMaterial("starsMatl",scene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, scene);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl; 
    // temp.freezeWorldMatrix();

    temp.actionManager = new BABYLON.ActionManager(scene);
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    temp.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
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

    starsObjMap.set(temp.name, temp);

}//end of init planet function

var leoStars,geminiStars;
function create_constellation_planes(scene){
    //params: name, matlpath, height, width, scaling, xPos, yPos, zPos
    // leoStars = init_constellation("Leo","front/textures/participate/constellations/leo.png",150,300,14,-2877, 4345, 1908);
    leoStars= BABYLON.MeshBuilder.CreatePlane("Leo", {height:150, width: 300}, scene);
    leoStars.scaling = new BABYLON.Vector3(14,14,14);
    leoStars.position = new BABYLON.Vector3(-2877, 4345, 1908);
    leoStars.rotationQuaternion = new BABYLON.Quaternion(-0.553,0.438,0.438, 0.553);
    var leoStarsMatl = new BABYLON.StandardMaterial("leoMatl", scene);
    leoStarsMatl.diffuseTexture = new BABYLON.Texture("front/textures/participate/constellations/leo.png", scene);
    leoStarsMatl.diffuseTexture.hasAlpha = true;
    leoStars.material = leoStarsMatl;
    leoStars.material.backFaceCulling = false;
    leoStars.freezeWorldMatrix();

    leoStars.actionManager = new BABYLON.ActionManager(scene);
    leoStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    leoStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );

    starsObjMap.set(leoStars.name, leoStars);
    //params of clones: name, temp, matlPath,scale, x, y, z
    geminiStars = leoStars.clone();
    init_clone_constellation("Gemini",geminiStars,"front/textures/participate/constellations/gemini.png",14,4227,2823,806,scene);

    virgoStars = leoStars.clone();
    init_clone_constellation("Virgo",virgoStars,"front/textures/participate/constellations/virgo.png",14,-4242, 2864,-9,scene);

    piscesStars = leoStars.clone();
    init_clone_constellation("Pisces",piscesStars,"front/textures/participate/constellations/pisces.png",14,942, 4350,1731,scene);

    sagittariusStars = leoStars.clone();
    init_clone_constellation("Sagittarius",sagittariusStars,"front/textures/participate/constellations/sagittarius.png",14,2917, -4081,614,scene);

    capricornStars = leoStars.clone();
    init_clone_constellation("Capricorn",capricornStars,"front/textures/participate/constellations/capricorn.png",14,-1996,-3873,2000,scene);

    libraStars = leoStars.clone();
    init_clone_constellation("Libra",libraStars,"front/textures/participate/constellations/libra.png",14,-766,1584,-3235,scene);

    ariesStars = leoStars.clone();
    init_clone_constellation("Aries",ariesStars,"front/textures/participate/constellations/aries2.png",14,664,3268,5197,scene);

    cancerStars = leoStars.clone();
    init_clone_constellation("Cancer",cancerStars,"front/textures/participate/constellations/cancer.png",14,-417,-3774,-2125,scene);

    scorpioStars = leoStars.clone();
    init_clone_constellation("Scorpio",scorpioStars,"front/textures/participate/constellations/scorpio.png",14,1000,-2362,5218,scene);

    taurusStars = leoStars.clone();
    init_clone_constellation("Taurus",taurusStars,"front/textures/participate/constellations/taurus.png",14,-121,4275,-982,scene);

    aquariusStars = leoStars.clone();
    init_clone_constellation("Aquarius",aquariusStars,"front/textures/participate/constellations/aquarius.png",14,-4223, -2058,773,scene);
    

}



let homeGizmo; 
let homeGizmo2;
let isGizmoDragging = false;
function enable_gizmo(themesh,scene){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(scene);

    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;

}




$('#wikiPage').on('load',function(){
    $('.iframe-loading').hide();
});

// let isScreenVisible = false;
// let isCharDivFullscreen = false;
// function showPage(pageName) {
//     $('.iframe-loading').show();
//     let loader = document.getElementById("iframe-loading");
//     let x = document.getElementById("wikipediaDiv");
//     let page = document.getElementById("wikiPage");

//     if(loader.style.visibility != "visible") loader.style.visibility = "visible";
    

    
//     document.getElementById("page-url").textContent = "https://en.wikipedia.org/wiki/"+pageName+"";
//     page.src  = "https://en.wikipedia.org/wiki/"+pageName;
//     if(x.style.visibility != "visible"){
//         x.style.visibility = "visible";  
//         isScreenVisible = true;
//     }else return;
// }

// let isScreenVisible = false;
// let isCharDivFullscreen = false;
// function showPage(pageName) {
//     $('.iframe-loading').show();
//     let loader = document.getElementById("iframe-loading");
//     let x = document.getElementById("wikipediaDiv");
//     let page = document.getElementById("wikiPage");

//     if(loader.style.visibility != "visible") loader.style.visibility = "visible";
//     $('#fullscreenIcon').hide();

    
//     document.getElementById("page-url").textContent = "https://en.wikipedia.org/wiki/"+pageName+"";
//     page.src  = "https://en.wikipedia.org/wiki/"+pageName;

//     if(x.style.visibility != "visible"){
//         x.style.visibility = "visible";  
//         isScreenVisible = true;
//     }else return;
// }

let isScreenVisible = false;
// let isCharDivFullscreen = false;
// let isCharDivFullscreen2 = false;
function showPage(pageName) {
    $('.iframe-loading').show();
    // let loader = document.getElementById("iframe-loading");
    let page = document.getElementById("wikiPage");
    let x = document.getElementById("planetWikipediaDiv");

    // if(loader.style.visibility != "visible") loader.style.visibility = "visible";

    page.src = "https://en.wikipedia.org/wiki/"+pageName;
    document.getElementById("page-url").href = "https://en.wikipedia.org/wiki/"+pageName+"";
    document.getElementById("page-url-span").textContent = "https://en.wikipedia.org/wiki/"+pageName+"";
    if(x.style.visibility != "visible"){
        x.style.visibility = "visible";  
        isScreenVisible = true;
    }
}


// function hidePage(){
//     let loader = document.getElementById("iframe-loading");
//     var x = document.getElementById("wikipediaDiv");
//     var page = document.getElementById("wikiPage");
//     page.src = "";

//     x.style.visibility = "hidden";
//     loader.style.visibility = "hidden";
//     isScreenVisible = false;
//     $('#fullscreenIcon').show();
// }

function hidePage(mode){

        document.getElementById("planetWikipediaDiv").style.visibility = "hidden";
        document.getElementById("wikiPage").src = "";

    let loader = document.getElementById("iframe-loading");
    
  
    loader.style.visibility = "hidden";
    isScreenVisible = false;
    // document.getElementById("flowerModelDiv").style.visibility = "hidden";
   
}


let isWikiFullscreen = false;
$('#planetWikiHeader #fullscreen-btn, #planetWikiHeader #minimize-btn').on("click", function (e) {
    if(!isWikiFullscreen){
       
        $("#planetWikipediaDiv").css({width:'100vw', height:'100%'});
        if(isSmallDevice() || isMobile()) $("#planetWikiHeader").css('height','10%');
        else $("#planetWikiHeader").css('height','6%');
        $("#planetWikiHeader #fullscreen-btn").hide();
        $("#planetWikiHeader #minimize-btn").show();
        // $('.modelFullscreenLabel').html('Minimize');
        
    }else{
        if(isMobile() || isSmallDevice()) $("#planetWikipediaDiv").css('width','50vw');
        else $("#planetWikipediaDiv").css('width','30vw');

        $("#planetWikiHeader #fullscreen-btn").show();
        $("#planetWikiHeader #minimize-btn").hide();
        // $('.modelFullscreenLabel').html('Fullscreen');
    }
    isWikiFullscreen = !isWikiFullscreen;
});

$('#planetWikiHeader #close-btn').on("click", function (e) {
    document.getElementById("planetWikipediaDiv").style.visibility = "hidden";
});
