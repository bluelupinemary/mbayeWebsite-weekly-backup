
let selectedFlowerCamera;                                                               //var for the camera of this scene
let earthFlowersSkybox;                                                               //var for the skybox of this scene
let earthFlowers_object;                                                              //var for holding the earthflowers object
let isZoomPanelActive = true;                                                         //var to check if panel zoom in/out is enabled
let isEarthFlowersHit = false;
const MAX_NUM_FLOWERS = 5;
let worldFlowerPicked;
let isWorldFlowersReady;
let worldLoadedPercent;
let flowerMat;                                                                        //var for the flower material
let objHighlight;                                                                     //var for highlighting the clickable parts
let light2;


//create the scene
function createSelectedFlowerScene(){
    selectedFlowerScene = new BABYLON.Scene(engine);
    engine.enableOfflineSupport = true;
    selectedFlowerScene.enableSceneOffline = true;
    BABYLON.Database.IDBStorageEnabled = true;
    selectedFlowerScene.autoClear = false;

    create_selected_flower_camera();
    create_selected_flower_skybox();
    //create the lights
    let light = new BABYLON.HemisphericLight("selectedFlowersLight", new BABYLON.Vector3(-0.5,0.2,-0.9), selectedFlowerScene);
    light2 = new BABYLON.HemisphericLight("speechCloudLight", new BABYLON.Vector3(0.83, 10, 0.56), selectedFlowerScene);
    light.radius = 300;
    light2.radius = 300;
    light.intensity = 1;
    light2.intensity = 0.9;

    //load the world of flowers
    load_earth_with_flowers_mesh();
    add_mouse_listener_selected_flower();

    create_orig_flower();
    // selectedFlowerScene.debugLayer.show();
    

    objHighlight = new BABYLON.HighlightLayer("objHighlight", selectedFlowerScene);
    // selectedFlowerScene.debugLayer.show();
    return selectedFlowerScene;
}

function create_selected_flower_camera(){
  //create the camera
    selectedFlowerCamera = new BABYLON.ArcRotateCamera("selectedFlowerCamera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-165.11,57.58,97.05), selectedFlowerScene);
    selectedFlowerCamera.checkCollisions = true;
    selectedFlowerCamera.panningSensibility = 500;
    selectedFlowerCamera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    selectedFlowerCamera.fov = 1.4;
    
    selectedFlowerCamera.lowerRadiusLimit = 35;
    selectedFlowerCamera.upperRadiusLimit = 400;
    selectedFlowerCamera.wheelPrecision = 10;   
    selectedFlowerCamera.angularSensibilityX = 2000;
    selectedFlowerCamera.angularSensibilityY = 2000;
    selectedFlowerCamera.alpha = 2.61;
    selectedFlowerCamera.beta = 1.27;
}

function reset_selected_flower_camera(){
    selectedFlowerCamera.position = new BABYLON.Vector3(-157.38,81.72,92.44);
    selectedFlowerCamera.alpha = 2.61;
    selectedFlowerCamera.beta = 1.14;
}

let nuvola_obj, solar_obj,book_obj;
let bookLeftPages,bookRightPages;
let solar_carpet, nuvola_carpet;
let mermaidSpeechCloud,nuvolaSpeech1;
//function to load the world of flowers
function load_earth_with_flowers_mesh(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "nuvolaCarpet.glb", selectedFlowerScene).then(function (result) {
           
            nuvola_obj = result.meshes[0];
            nuvola_obj.isPickable = true;
            nuvola_obj.scaling = new BABYLON.Vector3(0.07,0.07,0.07);
            // result.meshes[8].name = "nuvolaCountries";               //the plane for countries
            result.meshes[2].name = "nuvola";
            nuvola_carpet = result.meshes[8];
            // result.meshes[8].isVisible = false;
            nuvola_obj.position = new BABYLON.Vector3(-54.38,40.87,-79.02);
            nuvola_obj.rotationQuaternion = new BABYLON.Quaternion( -0.0023,0.7212, -0.0022,0.6925);
            add_obj_action_mgr(result.meshes[2]);
        }),
      
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "solarCarpet.glb", selectedFlowerScene).then(function (result) {
            console.log("solar: ", result.meshes);
            solar_obj = result.meshes[0];
            solar_obj.isPickable = true;
            solar_obj.scaling = new BABYLON.Vector3(0.07,0.07,0.07);
            // result.meshes[1].name = "solarCountries";               //the plane for the countries
            solar_carpet =  result.meshes[1];
            result.meshes[7].name = "blueBottom";
            // result.meshes[1].isVisible = false;
            result.meshes[2].name = "solarLamp";                    //rename the lamp of solar
            solar_obj.position = new BABYLON.Vector3(26.44,9.25,19.39);
            solar_obj.rotationQuaternion = new BABYLON.Quaternion(  0.0004,0.0272,0.0332,-0.9980);
            add_obj_action_mgr(result.meshes[2]);
            //add_obj_action_mgr(result.meshes[7]);
            // console.log(result.meshes);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "book.glb", selectedFlowerScene).then(function (result) {
            bookTask = result;
            result.animationGroups[0].loopAnimation = false;
            result.animationGroups[0].stop();
            // result.meshes[0].scaling =  new BABYLON.Vector3(0.05,0.05,-0.05);
            result.meshes[0].scaling =  new BABYLON.Vector3(0.07,0.07,-0.07);
            // result.meshes[0].position = new BABYLON.Vector3( -92.64,27.76,33.34);
            result.meshes[0].position = new BABYLON.Vector3( -78.87,23.71,23.35);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0846,0.8822,-0.0874, 0.4546);
            bookLeftPages = result.meshes[16];                          //bookLeftPages
            bookRightPages = result.meshes[21];                         //bookRightPages
            book_obj = result.meshes[0];
            light2.includedOnlyMeshes.push(bookLeftPages);
            light2.includedOnlyMeshes.push(bookRightPages);
            
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/", "speechCloud.glb", selectedFlowerScene).then(function (result) {
            mermaidSpeechCloud = result.meshes[0];
            result.meshes[1].isPickable = false;
            mermaidSpeechCloud.isPickable = false;
            // mermaidSpeechCloud.position = new BABYLON.Vector3(-50.11,58.76,-135.46);
            mermaidSpeechCloud.position = new BABYLON.Vector3( -58.34,51.68,-129.43);
            mermaidSpeechCloud.scaling = new BABYLON.Vector3(10,10,-10);
            // mermaidSpeechCloud.rotationQuaternion = new BABYLON.Quaternion( -0.0024,-0.2285,-0.0435,0.9725);
            mermaidSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.0138,-0.2008,-0.0438,0.9783);
            light2.includedOnlyMeshes.push(result.meshes[1]);
        
            // mermaidSpeechCloud.isVisible = false;
            // mermaidSpeechCloud.setEnabled(false);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/cloud/", "flowersNuvola1.glb", selectedFlowerScene).then(function (result) {
            result.meshes[0].scaling = new BABYLON.Vector3(22,22,-22);
            // result.meshes[0].position = new BABYLON.Vector3(-50.35,60.03,-136.66);
            // result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0850,-0.2042,-0.0225,0.9746);
            result.meshes[0].position = new BABYLON.Vector3(-59.17,50.25,-130.12);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion( -0.0190,-0.1905,-0.0420, 0.9802);
            nuvolaSpeech1 = result.meshes[0];
            light2.includedOnlyMeshes.push(result.meshes[1]);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/cloud/", "flowersNuvola2.glb", selectedFlowerScene).then(function (result) {
            result.meshes[0].scaling = new BABYLON.Vector3(22,22,-22);
            // result.meshes[0].position = new BABYLON.Vector3(-50.35,60.03,-136.66);
            // result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0850,-0.2042,-0.0225,0.9746);
            result.meshes[0].position = new BABYLON.Vector3(-59.17,50.25,-130.12);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion( -0.0190,-0.1905,-0.0420, 0.9802);
            nuvolaSpeech2 = result.meshes[0];
            nuvolaSpeech2.isVisible = false;
            nuvolaSpeech2.setEnabled(false);
            light2.includedOnlyMeshes.push(result.meshes[1]);
        }),
    ]).then(() => {
        selectedFlowerCamera.setTarget(new BABYLON.Vector3(0,0,0));
        nuvolaSpeech1.setParent(mermaidSpeechCloud);
        nuvolaSpeech2.setParent(mermaidSpeechCloud);
        mermaidSpeechCloud.isVisible = false;
        mermaidSpeechCloud.setEnabled(false);

       
        // enable_gizmo2(nuvolaSpeech1);
        
    });
} //end of load world of flowers mesh function

function enable_gizmo2(theFlower){
    // Create gizmo
    designUtilLayer = new BABYLON.UtilityLayerRenderer(selectedFlowerScene);
    designUtilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo.attachedMesh = theFlower;
    homeGizmo.scaleRatio = 1;

    homeGizmo2 = new BABYLON.PositionGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    homeGizmo2.attachedMesh = theFlower;
    homeGizmo2.scaleRatio = 2;
}



function create_selected_flower_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("skybox", {size:8300.0}, selectedFlowerScene);
    // skybox.position.y = -3000;
     skybox.position.y = -500;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    // skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("skybox", selectedFlowerScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];

    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, selectedFlowerScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    skyboxMaterial.freeze();
    skybox.freezeWorldMatrix();

}//end of create skybox function


function open_book_of_flowers(theFlowerName){
        //set the book flower, field and label
        set_orig_flower(theFlowerName);
        set_flower_field(theFlowerName)
        // set_flower_label(theFlowerName);
    
        //start animation of the book of flowers
        // bookTask.animationGroups[0].reset();
        bookTask.animationGroups[0].play();

       
        // //show book of flowers
        // book_obj.setEnabled(true);
        // book_obj.isVisible = true;
        
        // isOpenBookFlowers = true;   
}

let grownCarpetMatl, locatedCarpetMatl;
function set_carpet_countries(theFlowerName){
    grownCarpetMatl = new BABYLON.StandardMaterial("grownInCarpet", selectedFlowerScene);
    grownCarpetMatl.diffuseTexture = new BABYLON.Texture("front/textures/flowersMbaye/grown/"+theFlowerName+".png", selectedFlowerScene);
    grownCarpetMatl.diffuseTexture.hasAlpha = true;
    grownCarpetMatl.diffuseTexture.vScale = -1;
    grownCarpetMatl.diffuseTexture.uScale = -1;
    grownCarpetMatl.specularColor = new BABYLON.Color3(0, 0, 0);


    locatedCarpetMatl = new BABYLON.StandardMaterial("locatedInCarpet", selectedFlowerScene);
    locatedCarpetMatl.diffuseTexture = new BABYLON.Texture("front/textures/flowersMbaye/located/"+theFlowerName+".png", selectedFlowerScene);
    locatedCarpetMatl.diffuseTexture.hasAlpha = true;
    locatedCarpetMatl.diffuseTexture.vScale = -1;
    locatedCarpetMatl.diffuseTexture.uScale = -1;
    locatedCarpetMatl.specularColor = new BABYLON.Color3(0, 0, 0);

    solar_carpet.material = grownCarpetMatl;
    nuvola_carpet.material = locatedCarpetMatl;
}



let chosenFlower;
function create_orig_flower(){
    let plane = BABYLON.Mesh.CreatePlane("origFlower", 10  , selectedFlowerScene);
    // plane.position = new BABYLON.Vector3(-118.49, 39.12,50.40);
    plane.position = new BABYLON.Vector3(-115.44,38.96, 49.62);
    plane.rotationQuaternion = new BABYLON.Quaternion(-0.1399,-0.4303,-0.1012,0.8853);
    plane.isPickable = true;
    plane.setParent(bookLeftPages);
    plane.isVisible= false;
    plane.setEnabled(false);
    chosenFlower = plane;
    light2.includedOnlyMeshes.push(plane);
    // enable_gizmo2(chosenFlower);
}//end of function


function remove_book_materials(){
    if(bookLeftPages.material){
        
        bookTask.animationGroups[0].reset();
        bookLeftPages.material.dispose();
        // bookRightPages.material.dispose();
        chosenFlower.material.dispose();
        chosenFlower.isVisible= false;
        chosenFlower.setEnabled(false);
    }

}//end of function


function set_orig_flower(theFlowerName){
    // chosenFlower.setParent(bookLeftPages);
    let planeMatl = new BABYLON.StandardMaterial(theFlowerName, selectedFlowerScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/orig/"+theFlowerName+".png", selectedFlowerScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;//Always show the front and the back of an element
    planeMatl.diffuseTexture.uScale = -1;
    
   
    chosenFlower.material = planeMatl;
    // chosenFlower.position = new BABYLON.Vector3( 122.206,86.61,-13.83);
    // chosenFlower.rotationQuaternion = new BABYLON.Quaternion(-0.0316, -0.0213, -0.0041, 0.9992);
    chosenFlower.scaling = new BABYLON.Vector3(0.01,0.01,0.01);

    chosenFlower.isVisible = true;
    chosenFlower.setEnabled(true);
    //ADD GROWING ANIMTION TO THE FLOWER

   
    var flowerAnimation = new BABYLON.Animation("starAnimation", "scaling", 30, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    
    // var nextPos = chosenFlower.scaling.add(new BABYLON.Vector3(0.5,0.5,0.5));
    var nextPos = chosenFlower.scaling.add(new BABYLON.Vector3(0.8,0.8,0.8));
    
    // Animation keys
    var keys = [];
    keys.push({ frame: 0, value: chosenFlower.scaling });
    keys.push({ frame: 20, value: chosenFlower.scaling });
    keys.push({ frame: 60, value: nextPos });
    flowerAnimation.setKeys(keys);
        
    
    // // Adding animation to my torus animations collection
    chosenFlower.animations.push(flowerAnimation); 
    //Finally, launch animations on torus, from key 0 to key 100 with loop activated
    selectedFlowerScene.beginAnimation(chosenFlower, 0, 60, true);
    //END OF ANIMATION
   
    
    
    chosenFlower.isVisible = true;
    chosenFlower.setEnabled(true);
}


function set_flower_field(theFlowerName){
    let planeMatl = new BABYLON.StandardMaterial("flowerFieldMatl", selectedFlowerScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/field/"+theFlowerName+".png", selectedFlowerScene);
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;

    bookLeftPages.material = planeMatl;
    bookRightPages.material = planeMatl;
}//end of function


let isVideoEnabled = false;
let currNuvolaText = 1;
function add_mouse_listener_selected_flower(){
    var onPointerDownFlowers = function (evt) {
        if (evt.button !== 0) {
            return;
        }
  
        var pickInfo = selectedFlowerScene.pick(selectedFlowerScene.pointerX, selectedFlowerScene.pointerY);
    
        //check if the world of flowers mesh should be draggable/modified
        if (pickInfo.hit && evt.button === 0) {
            var theMeshClicked = pickInfo.pickedMesh;
           console.log("inside the selected flower scene", theMeshClicked.name, theMeshClicked.position, theMeshClicked.rotationQuaternion);
          

           if(showSelectedFlowerScene){     
                if(theMeshClicked.name === "solarLamp"){
                    if(isVideoEnabled){
                        document.getElementById("player").style.visibility = "hidden";
                        isVideoEnabled = false;
                    }
                    hidePage(); //hide wiki
                    currScene = "flowersScene";
                    isFlowerClicked = false;
                    flowersCamera.attachControl(canvas,true);
                    selectedFlowerCamera.detachControl(canvas);
                    showSelectedFlowerScene = false;
                    isShowFlowerScene = true;
                    remove_book_materials();
                    stop_flower_music();
                }
                else if(theMeshClicked.name === "wood001" || theMeshClicked.name === "Text001" ){            //show video function enable/disable
                    // console.log("wood clicked");
                    if(!isVideoEnabled){
                        isVideoEnabled = true;
                        document.getElementById("player").style.visibility = "visible";
                    }else{
                        document.getElementById("player").style.visibility = "hidden";
                        isVideoEnabled = false;
                    }
                }
           }//end of if
          
           
        }//end of something is hit
    }//end of on pointer down function

    var onPointerUpFlowers = function () {
      isEarthFlowersHit = false;
    }//end of on pointer up function

    var onPointerMoveFlowers = function (evt) {
      if(!isEarthFlowersHit) return;             
    }//end of on pointer move function

    canvas.addEventListener("pointerdown", onPointerDownFlowers, false);
    canvas.addEventListener("pointerup", onPointerUpFlowers, false);
    canvas.addEventListener("pointermove", onPointerMoveFlowers, false);

    selectedFlowerScene.onDispose = function() {
        canvas.removeEventListener("pointerdown", onPointerDownFlowers);
        canvas.removeEventListener("pointerup", onPointerUpFlowers);
        canvas.removeEventListener("pointermove", onPointerMoveFlowers);
    };
}//end of add mouse listeners



//function that enables the on mouse over and on mouse out events on a flower
function add_obj_action_mgr(thePart){
    thePart.actionManager = new BABYLON.ActionManager(flowersScene);
    thePart.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPart
        )
    );
    thePart.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPart
        )
    );
}

//handles the on mouse over event
var onOverPart =(meshEvent)=>{
    if(showSelectedFlowerScene && meshEvent.source.name === "solarLamp"){
        let partTooltip = document.createElement("span");
        partTooltip.setAttribute("id", "partTooltip");
        var sty = partTooltip.style;
        sty.position = "absolute";
        sty.lineHeight = "1.2em";
        sty.paddingLeft = "0.5%";
        sty.paddingRight = "0.5%";
        sty.color = "#ffffff";
        sty.fontFamily = "Courgette-Regular";
        sty.backgroundColor = "#0b91c3a3";
        sty.opacity = "0.7";
        sty.fontSize = "1vw";
        sty.top = selectedFlowerScene.pointerY + "px";
        sty.left = (selectedFlowerScene.pointerX+20) + "px";
        sty.cursor = "pointer";

        document.body.appendChild(partTooltip);
        partTooltip.textContent = "Pick another flower";
        objHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0.7,0.5,0));
    }else if(showSelectedFlowerScene && meshEvent.source.name === "nuvola"){
        if(currNuvolaText==1){
            nuvolaSpeech1.isVisible = true;
            nuvolaSpeech1.setEnabled(true);
            currNuvolaText = 0;
        }else{
            nuvolaSpeech2.isVisible = true;
            nuvolaSpeech2.setEnabled(true);
            currNuvolaText = 1;
        }
        mermaidSpeechCloud.isVisible = true;
        mermaidSpeechCloud.setEnabled(true);
    }else if(showSelectedFlowerScene && meshEvent.source.name === "blueBottom"){
        let partTooltip = document.createElement("span");
        partTooltip.setAttribute("id", "partTooltip");
        var sty = partTooltip.style;
        sty.position = "absolute";
        sty.lineHeight = "1.2em";
        sty.paddingLeft = "0.5%";
        sty.paddingRight = "0.5%";
        sty.color = "#ffffff";
        sty.fontFamily = "Courgette-Regular";
        sty.backgroundColor = "#0b91c3a3";
        sty.opacity = "0.7";
        sty.fontSize = "1vw";
        sty.top = selectedFlowerScene.pointerY + "px";
        sty.left = (selectedFlowerScene.pointerX+20) + "px";
        sty.cursor = "pointer";

        document.body.appendChild(partTooltip);
        partTooltip.textContent = "These carpet designs from your flowers may help you in designing your panels. Each one is different. Made so by mirroring, twisting, sizing.";
        objHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0.7,0.5,0));
    }
};

//handles the on mouse out event
var onOutPart =(meshEvent)=>{
    objHighlight.removeMesh(meshEvent.source);
    while (document.getElementById("partTooltip")) {
        document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }
    
    if(showSelectedFlowerScene && meshEvent.source.name === "nuvola"){
        mermaidSpeechCloud.isVisible = false;
        mermaidSpeechCloud.setEnabled(false);
        nuvolaSpeech1.isVisible = false;
        nuvolaSpeech1.setEnabled(false);
        nuvolaSpeech2.isVisible = false;
        nuvolaSpeech2.setEnabled(false);
    }
};

