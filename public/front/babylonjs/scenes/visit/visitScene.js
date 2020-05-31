
//define the scene
var visitScene;  
                                                                    //var to handle the earth scene
//define the scene's camera
var visitCamera;                                                    //var to hold the first camera upon loading the earth scene

//define the scene's light
var visitLight;                                                     //active hemispheric light for the earth scene
var visitSkybox;

//define the asset loaders of scene
var mbayeTask;                                                 //asset loader of scene's mbaye

//define the objects of scene                                           //var for the earth names mesh
var mbayeObject;                                              //var for the scene's mbaye mesh

//define the scene's planets


//define constants for zoom in/out limits
const LOWER_RADIUS_VAL = 0.5;                                         //zoom in limit                       
const UPPER_RADIUS_VAL = 3000;                                      //zoom out limit
var isHomeCounterReady = false;

let visitCamInitPos = {x:-2123,y:-215,z:1653}




function createScene(){
    engine.enableOfflineSupport = true;
                      
    visitScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    visitCamera = create_visit_camera();                                //create earth scene's camera
    create_visit_light();                                  //create earth scene's light
    visitSkybox = create_visit_skybox();                                              //create earth scene's skybox
    create_visit_planets();

    set_vr_next_scene(1);
   
    add_visit_mouse_listener();

    create_part_disc();
    add_vr_clickable_parts(1);



    return visitScene;
} //end of create scene function




let cameraInitDict = {x:-1135,y:486,z:900,radius:2700};
//function that creates the scene's cameras
function create_visit_camera(){
    //var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,900),visitScene);

    var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-2123,-215,1653),visitScene);
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    
    //set zoom in and zoom out capability
    camera.lowerRadiusLimit = LOWER_RADIUS_VAL;
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10;
    camera.panningDistanceLimit = 1500;
    camera.attachControl(canvas,true);
    // console.log("CAMERA: ", camera);

    camera.pinchPrecision = 1;
    // camera.pinchPrecision = 100;
    
    visitScene.activeCamera = camera;
   
    return camera;
}//end of create camera function
                   
var planetsLight;
//function that creates scene's hemispheric light
function create_visit_light(){
    visitLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,0,100), visitScene);
    visitLight.radius = 500;
    visitLight.specular = new BABYLON.Color3(0,0,0);
    visitLight.diffuse = new BABYLON.Color3(1,1,1);
    visitLight.groundColor = new BABYLON.Color3(0.13,0.13,0.13);
    visitLight.intensity = 1.2;
    // return light;
}//end of create earth light function

function create_visit_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("visitSkybox", {size:8500.0}, visitScene);
    // skybox.position.y = -3000;
     skybox.position.y = -500;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("visitSkyboxMaterial", visitScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, visitScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;

}//end of create skybox function


let vrDome ;
function set_vr_next_scene(sceneNum){
    if(vrDome) vrDome.dispose();
     vrDome = new BABYLON.PhotoDome(
        "testdome",
        "front/finalSkybox/vr/"+sceneNum+".jpg",
        { 
            resolution: 64,
            size: 2000
        },
        visitScene
    );
    // console.log("DOME: ", vrDome);
    
    visitCamera.target = new BABYLON.Vector3(0,0,0);
    if(sceneNum === 4){         //inside museum
        vrDome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(120),0);
    }else if(sceneNum === 5){    //inside museum
        vrDome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(140),0);
    }else if(sceneNum === 8){    //underneath mbaye
        vrDome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-50),0);
    }else{
        visitCamera.position = visitCamInitPos;
        visitCamera.radius = 2700;
        vrDome.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-50),0);
    }

}




let planetAxis = new BABYLON.Vector3(0,4,0); 
let neptune;
function create_visit_planets(){

    let mercury = init_planet("mercury","mercurymatl","front/textures/home/planets/mercury.jpg","front/textures/home/planets/mercurynormal.jpg", -944,1698,-3107,400);
    neptune = BABYLON.Mesh.CreateSphere("neptune", 30, 2050, visitScene);
    var planeMatl = new BABYLON.StandardMaterial("matl", visitScene);
    // planeMatl.diffuseColor = BABYLON.Color3.Black();
    planeMatl.diffuseTexture = new BABYLON.Texture("front/textures/visiting/vrSky2.png", visitScene);
    planeMatl.opacityTexture = new BABYLON.Texture("front/textures/visiting/vrSky2.png", visitScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
   
    neptune.material = planeMatl;

  
    let saturn = init_planet("saturn","saturnMatl","front/textures/home/planets/saturn.jpg","front/textures/home/planets/saturnnormal.jpg",4340,-208,1369,400);
    let saturnRing = BABYLON.Mesh.CreateGround("rings", 895, 895, 1, visitScene);
    // saturnRing.isPickable = false;
    saturnRing.parent = saturn;
    saturn.rotationQuaternion = new BABYLON.Quaternion(0.3520,0.2328,0.3009,0.8505);
    let ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", visitScene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/saturnRing2.png", visitScene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;
    // enable_visit_gizmo(saturn);
    
    engine.runRenderLoop(function () {
        if(visitScene){
            mercury.rotation.y = Math.PI / 2;
            mercury.rotate(planetAxis, -0.01, BABYLON.Space.LOCAL);
            neptune.rotation.y = Math.PI / 2;
            neptune.rotate(planetAxis, -0.005, BABYLON.Space.LOCAL);
            saturn.rotation.y = Math.PI / 2;
            saturn.rotate(planetAxis, -0.02, BABYLON.Space.LOCAL);
        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 30, radius, visitScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    var temp_material = new BABYLON.StandardMaterial(material_name,visitScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, visitScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,visitScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    temp.material = temp_material;
    
    return temp;
}//end of init planet function

var homeGizmo;
function enable_visit_gizmo(themesh){
    // Create gizmo
    var utilLayer = new BABYLON.UtilityLayerRenderer(visitScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo2.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    // console.log(homeGizmo);
}

let toolTip;
var onOverVRPart =(meshEvent)=>{
   // meshEvent.source.material.diffuseColor = BABYLON.Color3.Green();
   // visitScene.hoverCursor = " 12 12, auto ";
    toolTip = document.createElement("span");
    // wikiBtn.textContent = " ";
    toolTip.setAttribute("id", "toolTipLabel");
    // wikiBtn.zIndex = 0;
    let sty = toolTip.style;
    sty.position = "absolute";
    sty.lineHeight = "1.2em";
    sty.paddingLeft = "10px";
    sty.paddingRight = "10px";
    sty.color = "#ffffff";
    sty.border = "1px ridge gray";
    sty.borderRadius = "5px";
    sty.backgroundColor = "none";
    sty.fontSize = "12pt";
    sty.top = visitScene.pointerY + "px";
    sty.left = visitScene.pointerX + "px";
    sty.cursor = "pointer";

    document.body.appendChild(toolTip);
    if(meshEvent.source.name === "pond")  toolTip.textContent = "To the lift";
    else if(meshEvent.source.name === "mbayeBot")  toolTip.textContent = "Underneath Mbaye";
    else if(meshEvent.source.name === "mbayeHead")  toolTip.textContent = "Head of Mbaye";
    else toolTip.textContent = meshEvent.source.name;
  
};

//handles the on mouse out event
var onOutVRPart =(meshEvent)=>{
    while (document.getElementById("toolTipLabel")) {
            document.getElementById("toolTipLabel").parentNode.removeChild(document.getElementById("toolTipLabel"));
    }   
   // meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,0,0);
};

// function create_tv_screen(){
    
// }

function add_action_mgr(thePart){
    thePart.actionManager = new BABYLON.ActionManager(visitScene);
    thePart.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverVRPart
        )
    );
    thePart.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutVRPart
        )
    );
}


let vrPartsNamesMap = new Map();

function add_vr_clickable_parts(sceneNum){
    vrSceneDiscs.clear();
    // console.log("SCENE NUM: ",sceneNum, "NUM OF DISCS TO BE CREATED: ", vrPartsMap.get(sceneNum).length);
    let numParts = vrPartsMap.get(sceneNum).length;

    for(i=0;i<numParts;i++){
         vrSceneDiscs.set(i,set_part_in_scene(sceneNum,vrPartsMap.get(sceneNum)[i]));
    }
    // console.log("CREATED VR SCENE DISCS: ", vrSceneDiscs);
    discTemp.isVisible = false;
    discTemp.setEnabled(false);

}

let discTemp;
let vrSceneDiscs = new Map();
function create_part_disc(){
    discTemp = BABYLON.MeshBuilder.CreateDisc("tempDisc", {radius:120, tessellation: 0}, visitScene);
    discTemp.position = new BABYLON.Vector3(0,0,0);
    
    let discMatl = new BABYLON.StandardMaterial("discMatl", visitScene);
    discMatl.diffuseColor = new BABYLON.Color3(1,1,1);
    discMatl.alpha = 0.001;
    discTemp.material = discMatl;

}



function set_part_in_scene(sceneNum,val){
    let temp = discTemp.clone(val.name);
    temp.position = new BABYLON.Vector3(val.x,val.y,val.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(val.rotX,val.rotY,val.rotZ,val.rotW);
    temp.scaling = new BABYLON.Vector3(val.scale,val.scale,val.scale);
    add_action_mgr(temp);
    
    temp.isVisible = true;
    temp.setEnabled(true);
        // enable_visit_gizmo(temp);
    //console.log("disc  : ", temp);
    vrPartsNamesMap.set(val.name,null);
    return temp;
}

function remove_prev_scene_parts(_callback){
    while (document.getElementById("toolTipLabel")) {
            document.getElementById("toolTipLabel").parentNode.removeChild(document.getElementById("toolTipLabel"));
    } 
    for(i=0;i<vrSceneDiscs.size;i++){
        // console.log(i, "the mesh: ", vrSceneDiscs.get(i));
        vrSceneDiscs.get(i).dispose();
    }   
    vrPartsNamesMap.clear();
    // do some asynchronous work
    // and when the asynchronous stuff is complete
    _callback();    
}

function change_vr_sky(vrScene){
    if(vrScene === "Museum"){
        var planeMatl = new BABYLON.StandardMaterial("matl", visitScene);
        // planeMatl.diffuseColor = BABYLON.Color3.Black();
        planeMatl.diffuseTexture = new BABYLON.Texture("front/textures/visiting/vrSky3.png", visitScene);
        planeMatl.opacityTexture = new BABYLON.Texture("front/textures/visiting/vrSky3.png", visitScene);
        
        planeMatl.diffuseTexture.hasAlpha = true;
        planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
       
        neptune.material = planeMatl;
    }
}



function add_visit_mouse_listener(){
        var onPointerDownVisit = function (evt) {
            if(visitScene) var pickinfo = visitScene.pick(visitScene.pointerX, visitScene.pointerY);
            else return;
            if(pickinfo.hit){
                let theInitMesh = pickinfo.pickedMesh;
                console.log("THe mesh clicked: ", theInitMesh,theInitMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
                // console.log("THE CAMERA:", visitCamera.position);
                if(theInitMesh.name==="mercury"){
                    window.open('http://localhost/MbayeTesting/MbayeHomepage.php','_self');
                }
                if(vrPartsNamesMap.has(theInitMesh.name)){
                    let sceneNum;
                        if(theInitMesh.name ==="Ground"){
                            // stopSound();
                            set_vr_next_scene(2);
                            sceneNum = 2;
                            
                        }else if(theInitMesh.name === "Back"){
                            playSound(1);
                            set_vr_next_scene(1);
                            sceneNum = 1;
                          
                        }
                        else if(theInitMesh.name === "Museum"){
                            playSound(2);
                            change_vr_sky("Museum")
                            set_vr_next_scene(3);
                            sceneNum = 3;

                           
                        }else if(theInitMesh.name === "Exit"){
                            playSound(1);
                            change_vr_sky("Park")
                            set_vr_next_scene(1);
                            sceneNum = 1;

                          
                        }else if(theInitMesh.name === "Window"){
                            set_vr_next_scene(4);
                            sceneNum = 4;

                           
                        }else if(theInitMesh.name === "Museum Entrance"){
                            set_vr_next_scene(3);
                            sceneNum = 3;

                        }else if(theInitMesh.name === "Captain Mbaye"){
                            set_vr_next_scene(5);
                            sceneNum = 5;

                        }else if(theInitMesh.name === "mbayeHead"){
                            set_vr_next_scene(6);
                            sceneNum = 6;

                        }else if(theInitMesh.name === "mbayeBot"){
                            set_vr_next_scene(7);
                            sceneNum = 7;

                        }else if(theInitMesh.name === "Foot"){
                            set_vr_next_scene(8);
                            sceneNum = 8;

                        }else if(theInitMesh.name === "Lift"){
                            set_vr_next_scene(9);
                            sceneNum = 9;

                        }else if(theInitMesh.name === "Head"){
                            set_vr_next_scene(10);
                            sceneNum = 10;

                        }else if(theInitMesh.name === "Night"){
                            playSound(3);
                            set_vr_next_scene(11);
                            sceneNum = 11;

                        }else if(theInitMesh.name === "pond"){
                            set_vr_next_scene(12);
                            sceneNum = 12;

                        }else if(theInitMesh.name === "Side View"){
                            set_vr_next_scene(13);
                            sceneNum = 13;

                        }else if(theInitMesh.name === "View Head"){
                            set_vr_next_scene(14);
                            sceneNum = 14;

                        }else{
                            console.log(theInitMesh.name);
                        }

                        if(sceneNum){
                            // console.log("this is true: ", sceneNum);
                            // remove_prev_scene_parts();
                            remove_prev_scene_parts(() => 
                                add_vr_clickable_parts(sceneNum)

                            )
                            // console.log("AFTER SCENE CHANGE: ", vrSceneDiscs, vrPartsNamesMap);

                            // setTimeout(function(){
                            //     add_vr_clickable_parts(sceneNum);
                            // },500)
                        }
                        
                        
                }
                
  
           }
           
        }//end of on pointer down function

        var onPointerUpVisit = function () {
               
        }//end of on pointer up function

        var onPointerMoveVisit = function (evt) {
          
        }//end of on pointer move function

        canvas.addEventListener("pointerdown", onPointerDownVisit, false);
        canvas.addEventListener("pointerup", onPointerUpVisit, false);
        canvas.addEventListener("pointermove", onPointerMoveVisit, false);


        //remove the text span on dispose
        visitScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDownVisit);
            canvas.removeEventListener("pointerup", onPointerUpVisit);
            canvas.removeEventListener("pointermove", onPointerMoveVisit);

        };
    
}//end of listen to mouse function

   

//create the game engine
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);

//create the scene
var theScene = createScene();
var i=0;

engine.runRenderLoop(function () {

    if(theScene){
        //render the scene
        theScene.render();

    }    
}); 


// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
});

  
function stopSound(){
    document.getElementById("vrSceneAudio").pause();
}

function playSound(soundNum){
    let theSrc;
    if(soundNum == 2) theSrc = "front/audio/visitingScene/VRSceneMuseum.mp3";
    else theSrc = "front/audio/visitingScene/VRSceneInitial.mp3";
    
    // document.getElementById("vrSceneAudio").pause();
    document.getElementById("vrSceneAudio").src = theSrc;
    // document.getElementById("vrSceneAudio").play();
}