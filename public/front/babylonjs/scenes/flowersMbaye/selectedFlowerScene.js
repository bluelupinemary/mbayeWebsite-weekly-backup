
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
    // selectedFlowerCamera =  new BABYLON.ArcRotateCamera("selectedFlowerCamera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-165.11,57.58,97.05), selectedFlowerScene);
    // selectedFlowerCamera.position = new BABYLON.Vector3(-165.11,57.58,97.05);
    // selectedFlowerCamera.alpha = 2.61;
    // selectedFlowerCamera.beta = 1.27;
    selectedFlowerCamera.position = new BABYLON.Vector3(-157.38,81.72,92.44);
    selectedFlowerCamera.alpha = 2.61;
    selectedFlowerCamera.beta = 1.14;
    selectedFlowerCamera.radius = 200;
    selectedFlowerCamera.target = new BABYLON.Vector3(0,0,0);
    // selectedFlowerCamera.attachControl();
    // selectedFlowerCamera.radius = 200;
   console.log("camera: ", selectedFlowerCamera.position);
}

let nuvola_obj, solar_obj,book_obj;
let bookLeftPages,bookRightPages;
let solar_carpet, nuvola_carpet;
let mermaidSpeechCloud,nuvolaSpeech1;
let flower3D_nuvola = [];
//function to load the world of flowers
function load_earth_with_flowers_mesh(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "nuvolaCarpet.glb", selectedFlowerScene).then(function (result) {
            
            nuvola_obj = result.meshes[0];
            nuvola_obj.isPickable = true;
            nuvola_obj.scaling = new BABYLON.Vector3(0.07,0.07,0.07);
            // result.meshes[8].name = "nuvolaCountries";               //the plane for countries
            result.meshes[4].name = "nuvola";
            nuvola_carpet = result.meshes[9];                           //the plane for countries
            result.meshes[10].name = "pinkBottom";                       //the bottom plane
            flower3D_nuvola.push(result.meshes[12]);                    //plane for 3d flower   , 1st pos
            flower3D_nuvola.push(result.meshes[11]);                    //2nd pos plane for 3d flower
            flower3D_nuvola.push(result.meshes[13]);                    //3rd pos plane for 3d flower
            result.meshes[12].isVisible = false;
            result.meshes[11].isVisible = false;
            result.meshes[13].isVisible = false;
            nuvola_carpet_bot = result.meshes[10];
            nuvola_bot_matl = result.meshes[10].material;
            // result.meshes[8].isVisible = false;
            nuvola_obj.position = new BABYLON.Vector3(-54.38,40.87,-79.02);
            nuvola_obj.rotationQuaternion = new BABYLON.Quaternion( -0.0023,0.7212, -0.0022,0.6925);
            light2.includedOnlyMeshes.push(result.meshes[12]);          //middle top 3d flower spot
            light2.includedOnlyMeshes.push(result.meshes[11]);          //bottom right 3d flower spot
            light2.includedOnlyMeshes.push(result.meshes[13]);          //bottom left 3d flower spot
            add_obj_action_mgr(result.meshes[4]);                       //nuvola's body
            add_obj_action_mgr(result.meshes[12]);                       //3d flower plane
            add_obj_action_mgr(result.meshes[11]);                       //3d flower plane
            add_obj_action_mgr(result.meshes[13]);                       //3d flower plane
            add_obj_action_mgr(result.meshes[10]);                       //bottom pink carpet
        }),
      
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "solarCarpet.glb", selectedFlowerScene).then(function (result) {
        //    for(i=0;i<result.meshes.length;i++){
        //         console.log(i, result.meshes[i].name);
        //     }
            // console.log("solar: ", result.meshes);
            solar_obj = result.meshes[0];
            solar_obj.isPickable = true;
            solar_obj.scaling = new BABYLON.Vector3(0.07,0.07,0.07);
            // result.meshes[1].name = "solarCountries";               //the plane for the countries
            solar_carpet =  result.meshes[1];
            result.meshes[9].name = "blueBottom";                       //the bottom plane
            solar_bot_matl = result.meshes[9].material;
            solar_carpet_bot = result.meshes[9];
            // result.meshes[1].isVisible = false;
            result.meshes[3].name = "solarLamp";                    //rename the lamp of solar
            solar_obj.position = new BABYLON.Vector3(26.44,9.25,19.39);
            solar_obj.rotationQuaternion = new BABYLON.Quaternion(  0.0004,0.0272,0.0332,-0.9980);
            add_obj_action_mgr(result.meshes[3]);                   //add action mgr to the lamp
            add_obj_action_mgr(result.meshes[9]);                   //bottom of blue carpet
            // console.log(result.meshes);
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/flowersMbayeScene/", "bookFlowersCarpet.glb", selectedFlowerScene).then(function (result) {
         
            bookTask = result;
            result.animationGroups[0].loopAnimation = false;
            result.animationGroups[0].stop();
            // result.meshes[0].scaling =  new BABYLON.Vector3(0.05,0.05,-0.05);
            result.meshes[0].scaling =  new BABYLON.Vector3(0.07,0.07,-0.07);
            // result.meshes[0].position = new BABYLON.Vector3( -92.64,27.76,33.34);
            result.meshes[0].position = new BABYLON.Vector3( -78.87,23.71,23.35);
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0846,0.8822,-0.0874, 0.4546);
            result.meshes[0].isPickable = false;
            result.meshes[18].isPickable = false;                       //the music video wood text
            bookLabel = result.meshes[42];                              //the plane for the book's label
            bookLeftPages = result.meshes[16];                          //book's left top
            bookRightPages = result.meshes[20];                         //book's right top 
            book_obj = result.meshes[0];
            
            light2.includedOnlyMeshes.push(bookLeftPages);
            light2.includedOnlyMeshes.push(bookRightPages);
            add_obj_action_mgr(result.meshes[35]);                                       //add action mgr to the home post text
            add_obj_action_mgr(result.meshes[37]);                                       // add action mgr to the design a panel post text
            add_obj_action_mgr(result.meshes[39]);                                       // add action mgr to the foot of mbaye post text
            add_obj_action_mgr(result.meshes[17]);                                       //add action mgr to the  music video wood
            
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

        

        // create_3D_flower("2Sunflower"); 
        // selectedFlowerScene.debugLayer.show();
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
        set_flower_label(theFlowerName);
    
        //start animation of the book of flowers
        // bookTask.animationGroups[0].reset();
        bookTask.animationGroups[0].play();

       
        // //show book of flowers
        // book_obj.setEnabled(true);
        // book_obj.isVisible = true;
        
        // isOpenBookFlowers = true;   
}

//function to set flower label on the center wood
function set_flower_label(theFlowerName){  
    let planeMatl = new BABYLON.StandardMaterial("labelMatl", selectedFlowerScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/label/"+theFlowerName+".png", selectedFlowerScene);
    // planeMatl.diffuseColor = BABYLON.Color3.Red();
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.diffuseTexture.uScale = 3.4;
    planeMatl.diffuseTexture.vScale = -9.200;
    planeMatl.diffuseTexture.uOffset = 0.77;
    planeMatl.diffuseTexture.vOffset = -1.15;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;

    bookLabel.material = planeMatl;
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


function set_carpet_bot(mode){
    
    if(mode === 1){
        let matl = new BABYLON.StandardMaterial("solarCarpetBot", selectedFlowerScene);
        matl.diffuseTexture = new BABYLON.Texture("front/textures/flowersMbaye/solarBottomText.png", selectedFlowerScene);
        matl.diffuseTexture.hasAlpha = true;
        matl.diffuseTexture.vScale = 1;
        matl.diffuseTexture.uScale = -1;
        matl.specularColor = new BABYLON.Color3(0, 0, 0);

        solar_carpet_bot.material = matl;
    }else if(mode === 2){
        let matl = new BABYLON.StandardMaterial("solarCarpetBot", selectedFlowerScene);
        matl.diffuseTexture = new BABYLON.Texture("front/textures/flowersMbaye/nuvolaBottomText.png", selectedFlowerScene);
        matl.diffuseTexture.hasAlpha = true;
        matl.diffuseTexture.vScale = 1;
        matl.diffuseTexture.uScale = -1;
        matl.specularColor = new BABYLON.Color3(0, 0, 0);

        nuvola_carpet_bot.material = matl;
    }
    else{
        solar_carpet_bot.material = solar_bot_matl;
        nuvola_carpet_bot.material = nuvola_bot_matl;
    }
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
    for(i=0;i<flower3D_nuvola.length;i++){
        flower3D_nuvola[i].isVisible = false;
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
    chosenFlower.name = theFlowerName;
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

let flowers3D = [];
function create_3D_flower(theFlowerName){
    // console.log(theFlowerName, flowers3DMap);
    // console.log("hasflower: ", flowers3DMap.get(theFlowerName));

    if(flowers3DMap.has(theFlowerName)){
        // console.log("this is true");
        let val = flowers3DMap.get(theFlowerName);
        // console.log("the file: ", val[0]);
        for(i=0;i<val.length;i++){
            let plane = BABYLON.Mesh.CreatePlane(val[i], 13  , selectedFlowerScene);
            
            plane.isPickable = true;

            let planeMatl = new BABYLON.StandardMaterial(val[i]+"matl", selectedFlowerScene);
            planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/3D/"+val[i]+".png", selectedFlowerScene);
            planeMatl.diffuseTexture.hasAlpha = true;
            planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
            planeMatl.backFaceCulling = false;
            plane.material = planeMatl;
            light2.includedOnlyMeshes.push(plane);
            if(i==0){
                // plane.position = new BABYLON.Vector3(-33.56,34,-47.75);
                // plane.rotationQuaternion = new BABYLON.Quaternion(0,0.9136,0,0.4064);

                plane.position = new BABYLON.Vector3(-73.34,27.6,-50.20);
                plane.rotationQuaternion = new BABYLON.Quaternion(0.1279,0.6883,-0.7027,0.1249);

            }else if(i==1){
                // plane.position = new BABYLON.Vector3(-60.72,32.5,-133.12);
                // plane.rotationQuaternion = new BABYLON.Quaternion(0,0.9478,0,0.3184);

                plane.position = new BABYLON.Vector3(-77.82,28.5, -38.95);
                plane.rotationQuaternion = new BABYLON.Quaternion(0.1967,0.7024,-0.6541, 0.1989);
            }
            else if(i==2){
                // plane.position = new BABYLON.Vector3(-60.72,32.5,-133.12);
                // plane.rotationQuaternion = new BABYLON.Quaternion(0,0.9478,0,0.3184);

                plane.position = new BABYLON.Vector3(-58.14,27.8,-38.41);
                plane.rotationQuaternion = new BABYLON.Quaternion(0.0486,0.7075,-0.7030,0.0457);

            }
            
            animate_3D_flower(plane,i);
        
            // add_obj_action_mgr(plane);
            flowers3D.push(plane);
        }

    }
}

function set_3D_flower(theFlowerName){
    // selectedFlowerScene.debugLayer.show();
    let val = flowers3DMap.get(theFlowerName);
    for(i=0;i<val.length;i++){

        let planeMatl = new BABYLON.StandardMaterial(val[i]+"matl", selectedFlowerScene);
        planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/3D/"+val[i]+".png", selectedFlowerScene);

        //1st position of 3d flower
        if(i===0){
            planeMatl.diffuseTexture.uScale = -6.140;
            planeMatl.diffuseTexture.vScale = -8.150;
            planeMatl.diffuseTexture.uOffset = 1.740;
            planeMatl.diffuseTexture.vOffset = 0.280;
        }else if(i===1){
            planeMatl.diffuseTexture.uScale = -6.2;
            planeMatl.diffuseTexture.vScale = -8;
            planeMatl.diffuseTexture.uOffset = -0.42;
            planeMatl.diffuseTexture.vOffset = -0.420;
        }else if(i===2){
            planeMatl.diffuseTexture.uScale = -5.500;
            planeMatl.diffuseTexture.vScale = -8.780;
            planeMatl.diffuseTexture.uOffset = 0.280;
            planeMatl.diffuseTexture.vOffset = -0.070;
        }

        planeMatl.diffuseTexture.hasAlpha = true;
        planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
        planeMatl.backFaceCulling = false;
        flower3D_nuvola[i].material = planeMatl;
        flower3D_nuvola[i].name = val[i];
        flower3D_nuvola[i].isVisible = true;
        // light2.includedOnlyMeshes.push(plane);
    }
}

function delete_3D_flowers(){
    for(i=0;i<flowers3D.length;i++){
        flowers3D[i].dispose();
    }
}


function animate_3D_flower(theFlower, num){
      //ADD GROWING ANIMTION TO THE FLOWER
    let turnPt = 30;
    let end = 70;
    let nextPos = theFlower.position.add(new BABYLON.Vector3(0,3,0));
    if(num==0) {turnPt = 35;
    
    }
    else if(num==1){ 
        turnPt = 20; 
        end = 70;
        nextPos = theFlower.position.add(new BABYLON.Vector3(0,2,0));
    }

    var flowerAnimation = new BABYLON.Animation("starAnimation", "position", 30, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CYCLE);
    
    // Animation keys
    var keys = [];
    keys.push({ frame: 0, value: theFlower.position });
    keys.push({ frame: turnPt, value: nextPos });
    keys.push({ frame: end, value: theFlower.position });
    flowerAnimation.setKeys(keys);

    theFlower.animations.push(flowerAnimation); 
    //Finally, launch animations on torus, from key 0 to key 100 with loop activated
    selectedFlowerScene.beginAnimation(theFlower, 0, end, true);
    //END OF ANIMATION
}

function is_3d_flower(the3DFlower){
    if(flowers3DMap.has(chosenFlower.name)){
        let val = flowers3DMap.get(chosenFlower.name);   //chosenFlower       
        for(i=0;i<val.length;i++){
            if(the3DFlower === val[i]) return true;
        }
    }
    return false;

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
            console.log("inside the selected flower scene", theMeshClicked, theMeshClicked.position, theMeshClicked.rotationQuaternion);
           
            if(showSelectedFlowerScene){     
                if(theMeshClicked.name === "solarLamp"){
                    if(isVideoEnabled){
                        document.getElementById("player").style.visibility = "hidden";
                        isVideoEnabled = false;
                    }
                    hidePage(3); //hide wiki
                    currScene = "flowersScene";
                    isFlowerClicked = false;
                    flowersCamera.attachControl(canvas,true);
                    selectedFlowerCamera.detachControl(canvas);
                    remove_book_materials();
                    stop_flower_music();
                    delete_3D_flowers();
                    showSelectedFlowerScene = false;
                    isShowFlowerScene = true;
                }
                else if(theMeshClicked.name === "wood001_primitive0"){            //show video function enable/disable
                    // console.log("wood clicked");
                    if(!isVideoEnabled){
                        isVideoEnabled = true;
                        document.getElementById("player").style.visibility = "visible";
                    }else{
                        document.getElementById("player").style.visibility = "hidden";
                        isVideoEnabled = false;
                    }
                }else if(theMeshClicked.name === "postTop_primitive0" || theMeshClicked.name === "postTop_primitive1"){
                    show_alert_box("Are you sure you want to go to the HOME page?","/");
                    
                }else if(theMeshClicked.name === "postMiddle_primitive0" || theMeshClicked.name === "postMiddle_primitive1"){
                    show_alert_box("Are you sure you want to Design A Panel now?","/designPanel");  
                }else if(theMeshClicked.name === "postBottom_primitive0" || theMeshClicked.name === "postBottom_primitive1"){
                    show_alert_box("Are you sure you want to view Mbaye's Feet now?","/designPanel");  
                }



                if(is_3d_flower(theMeshClicked.name)){
                    showFlowerModelDiv(theMeshClicked.name);
                }

                if(theMeshClicked.name === "blueBottom"){
                    showPage2("https://en.wikipedia.org/wiki/Persian_carpet");
                }else if(theMeshClicked.name === "pinkBottom"){
                    showPage2("https://en.wikipedia.org/wiki/Oriental_rug");  
                }


           }//end of show selected
            

           
          
           
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
    if(showSelectedFlowerScene){
    // console.log(meshEvent.source.name);
        if(meshEvent.source.name === "solarLamp"){
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
        }else if(meshEvent.source.name === "nuvola"){
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
        }else if(is_3d_flower(meshEvent.source.name)){
            objHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0.7,0.5,0));
        }else if(bookPartsMap.has(meshEvent.source.name)){
            objHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0,0.3,0));
        }else if(meshEvent.source.name === "blueBottom"){
            // console.log("bottom of solar");
            //solar_carpet_bot.isVisible = false;
            set_carpet_bot(1);
        }
        else if(meshEvent.source.name === "pinkBottom"){
            // console.log("bottom of nuvola");
           // nuvola_carpet_bot.isVisible = false;
           set_carpet_bot(2);
        }
    }
};

//handles the on mouse out event
var onOutPart =(meshEvent)=>{
    objHighlight.removeMesh(meshEvent.source);
    while (document.getElementById("partTooltip")) {
        document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }
    
    if(showSelectedFlowerScene){
        if(meshEvent.source.name === "nuvola"){
            mermaidSpeechCloud.isVisible = false;
            mermaidSpeechCloud.setEnabled(false);
            nuvolaSpeech1.isVisible = false;
            nuvolaSpeech1.setEnabled(false);
            nuvolaSpeech2.isVisible = false;
            nuvolaSpeech2.setEnabled(false);

        }else if(meshEvent.source.name === "blueBottom" || meshEvent.source.name === "pinkBottom"){
                set_carpet_bot(0);      //reset carpets
            
        }
    }
};



function show_alert_box(titleText,path){
    Swal.fire({
        title: titleText,
        imageUrl: '../../front/icons/alert-icon.png',
        imageWidth: '10vw',
        imageHeight: 'auto',
        imageAlt: 'Warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I\'m sure!',
        width: '20%',
        padding: '1rem',
        background: 'rgba(8, 64, 147, 0.62)',
    }).then((result) => {
        if (result.value) {
            window.open(path,"_self"); 
        }
      });
}






function showFlowerModelDiv(theFlowerName){
    document.getElementById("flowerViewer").src = "front/objects/flowersMbayeScene/flowers3D/"+theFlowerName+".glb";
    document.getElementById("flowerModelDiv").style.visibility = "visible";
    // $('#flowerModelDiv').show();
}//end of showCharDescDiv function
