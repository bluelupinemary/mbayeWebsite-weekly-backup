
//define the scene
var flowersScene;  
                                                    //var to handle the earth scene
//define the scene's camera
var flowersCamera;                                                    //var to hold the first camera upon loading the earth scene

//define the scene's light
var flowersLight;                                                     //active hemispheric light for the earth scene
var skybox;


//define constants for zoom in/out limits
const LOWER_RADIUS_VAL = 1;                                         //zoom in limit                       
const UPPER_RADIUS_VAL = 2000;                                      //zoom out limit
let hl;
let sceneSkybox;
let isShowFlowerScene = false;
let focusSpeechSpecs = [{x: 132, y: 1588, z: 15},2.7495,1.5629, 1];
let initCameraSpecs = [{x: -1187, y: 214, z: 626},2.6563,1.4124, 1360];


function createScene(){
    engine.enableOfflineSupport = true;
    
    BABYLON.Database.IDBStorageEnabled = true;
    
    flowersScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    flowersScene.enableSceneOffline = true;
    flowersScene.ambientColor = new BABYLON.Color3(0.3, 0.3, 0.3);
    // flowersScene.debugLayer.show();
    flowersCamera = create_flowers_camera();                                //create earth scene's camera
    create_flowers_light();                                  //create earth scene's light
    sceneSkybox = create_flowers_skybox();                                              //create earth scene's skybox
    load_meshes();

    load_orig_flowers();
    add_mouse_listener();
    
   
    hl = new BABYLON.HighlightLayer("hl1", flowersScene);

    //add HDR texture so that mbaye's textures would be rendered correctly                                                             
    var hdrTextureEarth = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", flowersScene); 
    hdrTextureEarth.gammaSpace = false;
    hdrTextureEarth.level = 0.5;
    flowersScene.environmentTexture = hdrTextureEarth;                    //set the environment's texture
    isShowFlowerScene = true;
    return flowersScene;
} //end of create scene function



//function that creates the scene's cameras
function create_flowers_camera(){
    // var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,700),flowersScene);
    var camera = new BABYLON.ArcRotateCamera("Initial Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1191,185,628),flowersScene);

    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    camera.checkCollisions = true;
    //set zoom in and zoom out capability
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.lowerRadiusLimit = LOWER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    camera.pinchDeltaPercentage = 800; 
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10;
    // camera.panningDistanceLimit = 500;
    camera.attachControl(canvas,true);
    // camera.position = new BABYLON.Vector3(-1135,486,1000);
    // camera.radius = 1500;
    flowersScene.activeCamera = camera;
    camera.maxZ = 21000;

    return camera;
}//end of create camera function
                   
var planetsLight;
//function that creates scene's hemispheric light
function create_flowers_light(){
    flowersLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,1000), flowersScene);
    flowersLight.radius = 1000;
    flowersLight.specular = new BABYLON.Color3(0,0,0);
    flowersLight.diffuse = new BABYLON.Color3(1,1,1);
    flowersLight.groundColor = new BABYLON.Color3(1,1,1);
    flowersLight.intensity = 1.3;

    // planetsLight = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,-50,700), flowersScene);
    // planetsLight.radius = 500;
    // planetsLight.specular = new BABYLON.Color3(0,0,0);
    // planetsLight.diffuse = new BABYLON.Color3(1,1,1);
    // planetsLight.groundColor = new BABYLON.Color3(0.1,0.1,0.1);
    // planetsLight.intensity = 1;

    // return light;
}//end of create earth light function

function create_flowers_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("skybox", {size:20000.0}, flowersScene);
    // skybox.position.y = -3000;
     skybox.position.y = -500;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("skyboxMaterial", flowersScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];
    skybox.infiniteDistance = true;
    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, flowersScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();
    return skybox;
}//end of create skybox function

let mbaye_object,earth_object;
let temp;
let earth_submeshes = new Map();
function load_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/mbaye/", "MbayePipes.glb", flowersScene,  function (evt) {
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
            
            result.meshes[0].position = new  BABYLON.Vector3(-24.95,172.79,9.30);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion( -0.025,0.9991, 0.0119, -0.01717);
            
            // result.meshes[0].position = new  BABYLON.Vector3(-20.87,170, 9.09);
            // result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(  0.0316,0.9989,0.0043, -0.0180);

            result.meshes[0].scaling = new BABYLON.Vector3(6.5,6.5,-6.5);
            mbaye_object = result.meshes[0];
            // mbaye_object.isPickable = false;
           
           
            result.meshes.forEach(function(m) {
                m.isPickable = true;
               
                if(m.name === "MbayeBody"){
                    let pbr = new BABYLON.PBRMaterial("pbr", flowersScene);
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
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", flowersScene).then(function (result) {
                // earthNormalMesh = result.meshes;
                
                result.meshes[9].scaling = new BABYLON.Vector3(0.45,0.45,0.45);
                result.meshes[9].rotationQuaternion = new BABYLON.Quaternion(0, -0.7648,0,0.6442);
                
                result.meshes.forEach(function(m) {
                    m.checkCollisions = true;
                    m.isPickable = true;
                    earth_submeshes.set(m.name,null);
                    add_action_mgr(m);
                    if(m.name === "Sea"){
                        water = new BABYLON.WaterMaterial("water", flowersScene, new BABYLON.Vector2(2048, 2048));
                        water.backFaceCulling = true;
                        water.bumpTexture = new BABYLON.Texture("front/textures/participate/waterbump.png", flowersScene);
                        water.windForce = 10;
                        water.windDirection = new BABYLON.Vector2(-1,0);
                        water.waveHeight = 0.2;
                        water.bumpHeight = 0.3;
                        water.waveLength = 0.1;
                        water.colorBlendFactor = 0.25714;
                        water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                        water.addToRenderList(sceneSkybox);
                        m.material = water;
                    }
                });

                earth_object = result.meshes[9];      
                
          }),
          
    ]).then(() => {
        mbaye_object.setParent(earth_object);
        setTimeout(function(){
            // add_video_to_mesh();
            flowersCamera.target = new BABYLON.Vector3(0,0,0);
            flowersCamera.radius = 1360;
        },500);

     
            
        setup_music_player();
        
        let nuvola = create_mesh("Nuvola","front/images3D/flowersScene/nuvola.png",600,380,1,{x:1314,y:1388,z:-1869},{x: -0.0069650546525626645, y: -0.9541632952945934, z: -0.0009096510902198634, w: -0.299204054887531});
        init_scrollable_viewer("SolarNuvolaSpeech","front/images3D/flowersScene/solarNuvolaSpeech.png",2000,1000,{x:1763,y:1608,z:-686},{x: -0.00014, y: 0.8504, z:  0.00123, w: 0.5260});
        let solar = create_mesh("Solar","front/images3D/homeScene/solarSitting2.png",550,454,1,{x:2063,y:1749,z:394},{x: 0.02928221765496565, y: -0.7179153418377492, z: -0.03922121198480947, w: -0.6944075245946241});

        add_action_mgr(nuvola);
        add_action_mgr(solar);
        
         
        // enable_gizmo(temp);
        // enable_gizmo(temp);
       
    });
}//end of function load meshes


//function that enables the on mouse over and on mouse out events on a flower
function add_action_mgr(theFlower){
    theFlower.actionManager = new BABYLON.ActionManager(flowersScene);
    theFlower.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverFlower
        )
    );
    theFlower.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutFlower
        )
    );
}



//handles the on mouse over event
let origScaling, origColor, nuvolaOrigScaling;
let flowerLbl;

var onOverFlower =(meshEvent)=>{
    flowerLbl = document.createElement("span");
    flowerLbl.setAttribute("id", "flowerLbl");
    var sty = flowerLbl.style;
    sty.position = "absolute";
    // sty.padding = "0.5%";
    sty.color = "#00BFFF  ";
    sty.fontFamily = "Courgette-Regular";
    sty.fontSize = "2rem";
    sty.textShadow = "1px 1px 3px black";
    sty.top = (flowersScene.pointerY-50) + "px";
    sty.left = (flowersScene.pointerX+10) + "px";
    sty.cursor = "pointer";
    
    let theName =  meshEvent.meshUnderPointer.name;
    if(earth_submeshes.has(meshEvent.source.name)){
        document.body.appendChild(flowerLbl);
        flowerLbl.textContent = "Click for Culture."
    }else if(meshEvent.source.name === "Nuvola" || meshEvent.source.name === "Solar"){
        meshEvent.source.material.emissiveColor = BABYLON.Color3.White();
        nuvolaOrigScaling = meshEvent.source.scaling;
       
        meshEvent.source.scaling = new BABYLON.Vector3(nuvolaOrigScaling.x*1.1,nuvolaOrigScaling.y*1.1,nuvolaOrigScaling.z*1.1);
        document.body.appendChild(flowerLbl);
        if(!isSpeechViewActive) flowerLbl.textContent = "View";
        else flowerLbl.textContent = "Return";
    }
    
    if(floatingFlowersMap.has(theName)){
        //flower
        origScaling = meshEvent.source.scaling;
        meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.6,origScaling.y*1.6,origScaling.z*1.6);
        // hl.addMesh(meshEvent.source, new BABYLON.Color3(1,1,0.8));
      
        meshEvent.source.material.emissiveColor = BABYLON.Color3.Random();
        
        document.body.appendChild(flowerLbl);
        flowerLbl.textContent = flowerName.get(theName);
    }
};

//handles the on mouse out event
var onOutFlower =(meshEvent)=>{

    if(earth_submeshes.has(meshEvent.source.name)){
        // console.log("out of earth earth");
    }else if(meshEvent.source.name === "Nuvola" || meshEvent.source.name === "Solar"){
        
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0.4,0.4,0.4);
        meshEvent.source.scaling = nuvolaOrigScaling;
        // console.log("hereeee",nuvolaOrigScaling);
    }else{
        //flower
        meshEvent.source.scaling = origScaling;
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(1,1,1);
        // hl.removeMesh(meshEvent.source);
    }
    
    
    while (document.getElementById("flowerLbl")) {
        document.getElementById("flowerLbl").parentNode.removeChild(document.getElementById("flowerLbl"));
    }  
};



function create_mesh(name, matlPath, h, w, scale, pos,rot){
    var temp= BABYLON.MeshBuilder.CreatePlane(name, {height:h, width: w}, flowersScene);
    temp.scaling = new BABYLON.Vector3(scale, scale, scale);
    temp.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y,rot.z,rot.w);
    
    var tempMatl = new BABYLON.StandardMaterial(name+"matl", flowersScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, flowersScene);
    tempMatl.opacityTexture = new BABYLON.Texture(matlPath, flowersScene);
    if(name == "Nuvola") tempMatl.emissiveColor = new BABYLON.Color3(0.4,0.4,0.4);

    tempMatl.ambientColor = new BABYLON.Color3(1,1,1);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;
    // temp.material.backFaceCulling = false;
    
    return temp;
}

let isSpeechViewActive = false;
function init_scrollable_viewer(name,matlPath,w,h,pos,rot){
    //create plane for the texts
    let plane = BABYLON.MeshBuilder.CreatePlane(name, {width:w, height: h}, flowersScene);
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);

    let discmatl = new BABYLON.StandardMaterial(name+"Matl", flowersScene);
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
        // console.log(sv.position, sv.rotai);
        if(isSpeechViewActive) flowersCamera.detachControl(canvas);
    });
    sv.onPointerUpObservable.add(function() {
        if(isSpeechViewActive) flowersCamera.attachControl(canvas,true);
    });
    advancedTexture.addControl(sv);

    //create holder of solar's text image
    var rc = new BABYLON.GUI.Rectangle();
    rc.thickness = 0;
    rc.width = 1;
    
   
    rc.height = 7;
    rc.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
    rc.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
    // rc.isPickable = false;

    sv.addControl(rc);

    //create the image and add to the rectangle holder
    var image = new BABYLON.GUI.Image(name+"Img", matlPath);
    image.width = 1;
    image.height = 1;
    rc.addControl(image);
    return plane;
}






function set_scale(){
    let size = getRandomInt(40, 50)
    return size;
}

let nb = 100;
var TWO_PI = Math.PI * 2;
var angle =  TWO_PI/ nb;
let floatingFlowersMap = new Map();
function load_orig_flowers(){
    for (const [flowerName,val] of flowersMbayeMap.entries()) {
        let thePos;
        if(val[0]!==null) thePos = val[0];
        let theSize = set_scale();
        init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
        floatingFlowersMap.set(flowerName,null);
    }
}


let tempFlowersMap = new Map();
function init_flower(name,matlName,imgPath,size, x, y, z){
    let plane = BABYLON.Mesh.CreatePlane(name, size, flowersScene);
    plane.isVisible = true;
            
    plane.position = new BABYLON.Vector3(x,y,z);
    plane.rotation.y = BABYLON.Tools.ToRadians(-250);
    
    let planeMatl = new BABYLON.StandardMaterial(matlName, flowersScene);
    planeMatl.diffuseColor = BABYLON.Color3.Black();
    planeMatl.diffuseTexture = new BABYLON.Texture(imgPath, flowersScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.emissiveColor = BABYLON.Color3.White();
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
    // planeMatl.freeze();
    
    plane.material = planeMatl;
    // plane.freezeWorldMatrix();
    add_action_mgr(plane);
    flowerObjMap.set(name,plane);

    let tempName = name.toLowerCase();

    tempName = tempName.replace(/\s/g, '');
    tempFlowersMap.set(tempName,plane);
    
    return plane;
}



function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}


function enable_gizmo(theFlower){
    // Create gizmo
    designUtilLayer = new BABYLON.UtilityLayerRenderer(flowersScene);
    designUtilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo.attachedMesh = theFlower;
    // homeGizmo.scaleRatio = 1.5;

    homeGizmo2 = new BABYLON.PositionGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo2.attachedMesh = theFlower;
    homeGizmo2.scaleRatio = 1.5;
}


//function that will show the wiki for the flower if the mesh clicked is a flower
function get_has_flower_name(theFlower){
    let val = flowersMbayeMap.get(theFlower);
    if(val){
        return true;
    }else return false;
    //the wiki page val[3]
}


function set_scene_active_meshes(scene,isActive){
    scene.meshes.forEach(function(mesh){
        mesh.setEnabled(isActive);
        if(mesh.name === "cloud" || mesh.name === "speech1" || mesh.cloud === "speech2") mesh.setEnabled(false);
    });
}


//the function that will listen to mouse events
let currFlower;
function add_mouse_listener(){
        var onPointerDownInit = function (evt) {
            // console.log(evt);
            if(flowersScene) var pickinfo = flowersScene.pick(flowersScene.pointerX, flowersScene.pointerY);
            else return;
            if(pickinfo.hit){
                var theInitMesh = pickinfo.pickedMesh.name;
                // console.log("speech",temp.position, temp.rotationQuaternion);
                // console.log("camera",flowersCamera.position, flowersCamera.alpha, flowersCamera.beta, flowersCamera.radius);
               
                if(flowersMbayeMap.has(theInitMesh) && currScene == "flowersScene"){
                    let hasName = get_has_flower_name(theInitMesh);
                    
                    if(hasName){
                        let val = flowersMbayeMap.get(theInitMesh);
                        let videoId = val[3].id;                            //4th value is the video id
                        let startTime = val[3].start;
                        set_carpet_countries(theInitMesh);
                        
                        setTimeout(function(){
                            reset_selected_flower_camera();
                            flowersCamera.detachControl(canvas);
                            set_3D_flower(theInitMesh);
                            open_book_of_flowers(theInitMesh);              //open book of flowers
                            load_flower_music(videoId, startTime);          //load the music video
                            // showPage(val[2],videoId);                       //show wikipedia page
                            showSelectedFlowerScene = true;
                            set_scene_active_meshes(flowersScene,false);
                            set_scene_active_meshes(selectedFlowerScene,true);
                            set_wiki_values(val[2],videoId);
                            //show wiki icon
                            $('#wikipediaIcon').show();
                            //remove all meshes with highlight
                            hl.removeAllMeshes();
                            
                        },1000);
                       
                    }
                }//end of flowersmap



                
        
                if(theInitMesh === "Solar" || theInitMesh === "Nuvola"){
                    // initCamera.position = new BABYLON.Vector3( -4258, 738, 1708);
                    let pos = focusSpeechSpecs[0];
                    if(!isSpeechViewActive){
                        flowersCamera.setTarget(new BABYLON.Vector3(pos.x,pos.y,pos.z));
                        flowersCamera.alpha = focusSpeechSpecs[1];
                        flowersCamera.beta = focusSpeechSpecs[2];
                        flowersCamera.radius = focusSpeechSpecs[3];
                        isSpeechViewActive = true;
                    }else{
                        flowersCamera.setTarget(new BABYLON.Vector3(0,0,0));
                        flowersCamera.alpha = initCameraSpecs[1];
                        flowersCamera.beta = initCameraSpecs[2];
                        flowersCamera.radius = initCameraSpecs[3];
                        isSpeechViewActive = false;
                    }
                }

                if(earth_submeshes.has(theInitMesh)){
                    randomize_flower();
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
        flowersScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDownInit);
            canvas.removeEventListener("pointerup", onPointerUpInit);
            canvas.removeEventListener("pointermove", onPointerMoveInit);

        };
    
}//end of listen to mouse function


let flowerObjMap = new Map();
let randomFlower;
function randomize_flower(){
    let i=0;
    let num = Math.floor(Math.random() * Math.floor(205));
    
    for(const [flower,val] of flowersMbayeMap.entries()){
    
        if(num === i){
            let videoId = val[3].id;                            //4th value is the video id
            let startTime = val[3].start;
            load_flower_music(videoId, startTime);              //load the music video
            
            //if there's a flower previously scaled and highlighted, remove highlight and scaling
            if(tempOrigScaling){
                randomFlower.scaling = tempOrigScaling;
                hl.removeAllMeshes();
            }
            
            //find the flower from the floating flowers
            randomFlower = flowerObjMap.get(flower);
            //highlight the flower, change scaling
            hl.addMesh(randomFlower, new BABYLON.Color3.Green());
            tempOrigScaling = randomFlower.scaling;
            randomFlower.scaling = new BABYLON.Vector3(tempOrigScaling.x * 2, tempOrigScaling.y * 2, tempOrigScaling.z * 2, );
           
            //open the music video
            if(!isVideoEnabled){
                isVideoEnabled = true;
                $('#musicVideoDiv').css('display','flex');
            }

        }//eof if
        i++;
    }
}
   

//create the game engine
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);

//create the scene
var theScene = createScene();
var selectedFlowerScene = createSelectedFlowerScene();
var i=0;
let showSelectedFlowerScene = false;
let isFlowerClicked = false;
let currScene = "flowersScene";

theScene.executeWhenReady(function () {   
    document.getElementById("loadingScreenPercent").style.visibility = "hidden";
    document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
    document.getElementById("loadingScreenDiv").remove();
    // set_to_fullscreen();

    engine.runRenderLoop(function () {

        if(theScene && selectedFlowerScene){
            // if(chosenFlower) console.log(chosenFlower.position, chosenFlower.rotationQuaternion);
            // console.log(flowersCamera.position);
            // if(nuvolaSpeech1) console.log(nuvolaSpeech1.position, nuvolaSpeech1.rotationQuaternion);
            //render the scene
            if(isShowFlowerScene) theScene.render();
            // selectedFlowerScene.render();
            if(showSelectedFlowerScene){ selectedFlowerScene.render();}
            // console.log(selectedFlowerCamera.position, selectedFlowerCamera.rotationQuaternion, selectedFlowerCamera.radius, selectedFlowerCamera.alpha, selectedFlowerCamera.beta);}
           
            if(showSelectedFlowerScene && !isFlowerClicked){
                flowersCamera.detachControl(canvas);
                selectedFlowerCamera.attachControl(canvas,true);
                currScene = "selectedFlowerScene";
                isFlowerClicked = true;
                isShowFlowerScene = false;
                
            }

            if(flowersScene && earth_object && mbaye_object){
                earth_object.rotate(new BABYLON.Vector3(0,4,0), -0.01, BABYLON.Space.LOCAL);
                // if(book_obj) console.log(book_obj.position, book_obj.rotationQuaternion);
                // if(selectedFlowerCamera) console.log(selectedFlowerCamera.position, selectedFlowerCamera.alpha, selectedFlowerCamera.beta);
            }

            // if(book_obj) console.log(book_obj.position, book_obj.rotationQuaternion);
            
        }    
    }); 
});



window.addEventListener("orientationchange", function(event) {
    testOrientation();
}, false); 

window.addEventListener("resize", function(event) {
    engine.resize();
    testOrientation();
    testFullscreen();
}, false);
 


$('#wikiPage').on('load',function(){
    $('.iframe-loading').hide();
});

$('#carpetsWikiPage').on('load',function(){
    $('.iframe-loading').hide();
});

    let isScreenVisible = false;
    let isCharDivFullscreen = false;
    let isCharDivFullscreen2 = false;
    function showPage(pageName,videoId) {
        console.log("this is called");
        $('.iframe-loading').show();
        // let loader = document.getElementById("iframe-loading");
        let x = document.getElementById("flowersWikipediaDiv");
        let page = document.getElementById("wikiPage");

        // if(loader.style.visibility != "visible") loader.style.visibility = "visible";
        

        page.src = pageName;
        document.getElementById("page-url").textContent = pageName+"";
        document.getElementById("song-url").href = "https://www.youtube.com/watch?v="+videoId;
        document.getElementById("song-url-span").textContent = "https://www.youtube.com/watch?v="+videoId;
        // if(x.style.visibility != "visible"){
        //     x.style.visibility = "visible";  
        //     isScreenVisible = true;
        // }else return;
    }

    function showPage2(pageName) {
        $('.iframe-loading').show();
        let loader = document.getElementById("iframe-loading");
        let x = document.getElementById("carpetsWikipediaDiv");
        let page = document.getElementById("carpetsWikiPage");

        if(loader.style.visibility != "visible") loader.style.visibility = "visible";
        

        page.src = pageName;
        document.getElementById("carpet-page-url").textContent = pageName+"";
        if(x.style.visibility != "visible"){
            x.style.visibility = "visible";  
            isScreenVisible = true;
        }else return;
    }

    function hidePage(mode){

        if(mode===1){
            document.getElementById("flowersWikipediaDiv").style.visibility = "hidden";
            document.getElementById("wikiPage").src = "";
        }else if(mode===2){
            document.getElementById("carpetsWikipediaDiv").style.visibility = "hidden";
            document.getElementById("carpetsWikiPage").src = "";;
        }else{
            document.getElementById("flowersWikipediaDiv").style.visibility = "hidden";
            document.getElementById("wikiPage").src = "";
            document.getElementById("carpetsWikipediaDiv").style.visibility = "hidden";
            document.getElementById("carpetsWikiPage").src = "";;
        }
        let loader = document.getElementById("iframe-loading");
        
      
        loader.style.visibility = "hidden";
        isScreenVisible = false;
        document.getElementById("flowerModelDiv").style.visibility = "hidden";
        // $('#flowerModelDiv').hide();
    }

  
    // //enable fullscreen, minimization and close options for the wiki section
    // $('#flowersWikipediaDiv #close-btn').on("click", function (e) {
    //     $('#flowersWikipediaDiv').hide();
    // });

    $('#carpetsWikipediaDiv #close-btn').on("click", function (e) {
        $('#carpetsWikipediaDiv').hide();
    });
    $('#flowersWikiDivHeader #close-btn').on("click", function (e) {
        $('#flowersWikipediaDiv').hide();
    });


    

    // $('#flowersWikipediaDiv #fullscreen-btn').on("click", function (e) {
    //     if(!isCharDivFullscreen){
    //         $('#flowersWikipediaDiv').css({ 
    //             width :'100vw', 
    //         });
    //         $("#flowersWikipediaDiv #fullscreen-btn").attr("src", "front/images3D/minimize-btn.png")
    //         isCharDivFullscreen = true;
    //     }else{
    //         $('#flowersWikipediaDiv').css({ 
    //             width :'25vw', 
    //         });
    //         $("#flowersWikipediaDiv #fullscreen-btn").attr("src", "front/images3D/fullscreen-btn.png")
    //         isCharDivFullscreen = false;
    //     }
    // });

    $('#carpetsWikipediaDiv #fullscreen-btn').on("click", function (e) {
        if(!isCharDivFullscreen2){
            $('#carpetsWikipediaDiv').css({ 
                width :'100vw', 
            });
            $("#carpetsWikipediaDiv #fullscreen-btn").attr("src", "front/images3D/minimize-btn.png")
            isCharDivFullscreen2 = true;
        }else{
            $('#carpetsWikipediaDiv').css({ 
                width :'25vw', 
            });
            $("#carpetsWikipediaDiv #fullscreen-btn").attr("src", "front/images3D/fullscreen-btn.png")
            isCharDivFullscreen2 = false;
        }
    });

        
    /*################################################### 3D FLOWERS SECTION FUNCTIONS ############################################## */

    $('#flowerModelDiv #close-btn').on("click", function (e) {
        document.getElementById("flowerModelDiv").style.visibility = "hidden";
        $('.modelArrow').css('display','none');
    });

    let isFlowerFullscreen = false;
    $('#flowerModelDivHeader #fullscreen-btn, #flowerModelDivHeader #minimize-btn').on("click", function (e) {
        if(!isFlowerFullscreen){
            resize_window('full', '3dflower');
            if(isSmallDevice() || isMobile()) $("#flowerModelDivHeader").css('height','10%');
            else $("#flowerModelDivHeader").css('height','6%');
            $("#flowerModelDivHeader #fullscreen-btn").hide();
            $("#flowerModelDivHeader #minimize-btn").show();
            
        }else{
            resize_window('window', '3dflower');
            $("#flowerModelDivHeader").css('height','25%');
            $("#flowerModelDivHeader #fullscreen-btn").show();
            $("#flowerModelDivHeader #minimize-btn").hide();
        }
        isFlowerFullscreen = !isFlowerFullscreen;
    });

   

    // //enable fullscreen, minimization and close options for the 3d viewer section
    // $('#flowerModelDiv #close-btn').on("click", function (e) {
    //    // $('#flowerModelDiv').hide();
    //    document.getElementById("flowerModelDiv").style.visibility = "hidden";
    // });

    // let isFlowerFullscreen = false;
    // $('#flowerModelDiv #fullscreen-btn').on("click", function (e) {
    //     if(!isFlowerFullscreen){
    //         $('#flowerModelDiv').css({ 
    //             width :'100vw',
    //             height: "100vh",
    //             left: '0' 
    //         });
    //         $("#flowerModelDiv #fullscreen-btn").attr("src", "front/images3D/minimize-btn.png")
    //         isFlowerFullscreen = true;
    //     }else{
    //         $('#flowerModelDiv').css({ 
    //             width:'20vw',
    //             height:'20vh',
    //             bottom:'0vw',
    //             left:'26vw'
    //         });
    //         $("#flowerModelDiv #fullscreen-btn").attr("src", "front/images3D/fullscreen-btn.png")
    //         isFlowerFullscreen = false;
    //     }
    // });


    // $('.music-close-btn').on("click", function (e) {
    //     $('.music-player-parent-div').hide();
    //     isVideoEnabled = false;
    //  });


    document.onkeydown = (evt)=>{
     
        if(evt.key == 'o' || evt.key == 'O'){
            currFlower = null;
            homeGizmo.attachedMesh = null;
            homeGizmo2.attachedMesh = null;
        }
     
    }
    



    //the music player
    
    let yt_player;
    let isMusicChanged = false;
    let theClick = 0;
    function setup_music_player(){
        console.log("setup music");
       
        $('.musicPlayer').empty();
        let initVideo = "";
        var video_player = document.getElementById('player');

        
        yt_player = new YT.Player(video_player, {
        host: 'https://www.youtube.com',
        height: '0',
        width: '0',
        videoId: initVideo,
        playerVars: {
            autoplay: 0,
            loop: 0,
            start: 0,
            enablejsapi: 1,
            origin : window.location.href,
            widget_referrer: window.location.href
        },
        events: {
            'onReady': onPlayerReady,
        } 
        });
    }


    function onPlayerReady(event) {
        event.target.playVideo();
    }

    function load_flower_music(videoId,start) {
        $('.musicPlayer').empty();
        yt_player.loadVideoById(videoId,start);
        yt_player.playVideo();
       
    }


    function stop_flower_music(){
        yt_player.stopVideo(); 
    }


    /*################################################### MUSIC VIDEO SECTION FUNCTIONS ############################################## */
$('#musicVideoDivHeader #close-btn').on("click", function (e) {
    $('#musicVideoDiv').hide();
    //show fullscreenIcon
});


let isMusicFullscreen = false;
$('#musicVideoDivHeader #fullscreen-btn, #musicVideoDivHeader #minimize-btn').on("click", function (e) {
    if(!isMusicFullscreen){
        resize_window('full', 'youtube');
        $("#musicVideoDivHeader #fullscreen-btn").hide();
        $("#musicVideoDivHeader #minimize-btn").show();
        //hide the flower div and wiki icon

        // $('#flowerModelDiv').hide();
    }else{
        resize_window('window', 'youtube');
        $("#musicVideoDivHeader #fullscreen-btn").show();
        $("#musicVideoDivHeader #minimize-btn").hide();
        //show back the flower div
        // $('#flowerModelDiv').show();
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
        if(section === '3dflower') theSection.css('height','100vh');
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
          }
        }else{
          theSection.css({ 
              width: '20vw',
              height: '12vw'
          });
          if(section === 'youtube'){
            $('#musicVideoDiv').css('width','20vw');
          }
        }
    }
}



function showFlowerModelDiv(theFlowerName){
    document.getElementById("flowerViewer").src = "front/objects/flowersMbayeScene/flowers3D/"+theFlowerName+".glb";
    document.getElementById("flowerModelDiv").style.visibility = "visible";
    // $('#flowerViewer').attr('src',"front/objects/flowersMbayeScene/flowers3D/"+theFlowerName+".glb");
    // $('#flowerModelDiv').show();
}//end of showCharDescDiv function



    





    // function set_to_fullscreen(){
    //     //function to lock the screen. in this case the screen will be locked in portrait-primary mode.
    //     var elem = document.documentElement;
    //     function openFullscreen() {
    //         if (elem.mozRequestFullScreen) { /* Firefox */
    //         elem.mozRequestFullScreen();
            
    //         } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    //             elem.webkitRequestFullscreen();
            
    //         } else if (elem.msRequestFullscreen) { /* IE/Edge */
    //             elem.msRequestFullscreen();
            
    //         }
    //         else if (elem.requestFullscreen) {
    //             elem.requestFullscreen();
            
    //         } 
    //     }

    //     if(window.innerWidth <= 991 ){
    //             Swal.fire({
    //                 imageUrl: '../../front/icons/alert-icon.png',
    //                 imageWidth: 80,
    //                 imageHeight: 80,
    //                 html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
    //                 padding: '15px',
    //                 background: 'rgba(8, 64, 147, 0.62)',
    //                 allowOutsideClick: false
    //             }).then((result) => {
    //                 // if (result.value) {
    //                     openFullscreen()
    //                 // }
    //             });

    //     }//end of if small screen size
    // }

    let tempOrigScaling;
    $('#searchFlowerBtn').on('click',function(){
        let flower = $('#searchFlowerField').val();
        flower = flower.toLowerCase();
        flower = flower.replace(/\s/g, '');
        console.log("the flower: ", flower);

        for (const [name,val] of tempFlowersMap.entries()) {
           if(name.includes(flower)){
                hl.addMesh(val, new BABYLON.Color3.Green());
                tempOrigScaling = val.scaling;
                val.scaling = new BABYLON.Vector3(tempOrigScaling.x * 1.5, tempOrigScaling.y * 1.5, tempOrigScaling.z * 1.5, );
                setTimeout(function(){
                    hl.removeMesh(val);
                    val.scaling = tempOrigScaling;
                },3000);

           }
        }
        
    });

    $('#wikipediaIcon').on('click',function(){
         let loader = document.getElementById("iframe-loading");
        //  let x = document.getElementById("flowersWikipediaDiv");
         if(loader.style.visibility != "visible") loader.style.visibility = "visible";

         $('#flowersWikipediaDiv').toggle();
        //  isScreenVisible = !isScreenVisible;
        //  if(x.style.visibility != "visible") x.style.visibility = "visible";  
        //  else x.style.visibility = "hidden";  

         
         
         isScreenVisible = !isScreenVisible;
    });

    function set_wiki_values(wikiId, videoId){
        showPage(wikiId,videoId);                       //show wikipedia page
    }


    
    $( document ).ready(function() {
        testOrientation();
    });       
