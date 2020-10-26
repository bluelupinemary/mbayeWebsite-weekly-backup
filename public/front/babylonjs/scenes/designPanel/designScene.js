

let designLight;                                                              //let to hold the design scene's light obj
let designCamera;                                                             //let to hold the design scene's camera obj
let panelCamera;                                                              //let to hold the panel Camera / camera for designing the panel
let designScene;                                                              //let to hold the scene
let mbayeDesign_object;                                                       //let to hold this scene's Mbaye
let returnPanel_btn;                                                           //let to hold the btn for rotating the panel
let theDesignMesh;                                                             //let to hold the value of the panel clicked (when choosing a panel before dragging)
let designSkybox;                                                             //let to hold the current active skybox
let designGizmoManager;                                                       //let for the gizmo functions of flowers

let cameraPosForRightPanelsPos = {x:-81,y:17,z:111};                          //lets for the position of design camera after returning a panel
let cameraPosForLeftPanelsPos = {x:29,y:17,z:-87};

let panelInitPos = {x:0,y:0,z:0};                                             //get initial position of selected panel
let panelInitRot = {x:0,y:0,z:0,w:0};                                         //get initial position of selected panel
let isPanelReturned = false;                                                  //check if current panel is returned to mbaye
let isPanelCameraMoving = false;                                              //check if panel camera is animating

let isPanelMovementDone = false;                                              //let to check if panel movement from mbaye to design part is done; cant move panel while panel is moving
let isDesignSceneActive = false;                                              //let to enable the rendering of the earthFlowers scene
let isCurrentPanelInLocation = false;                                         //let to check if the current panel selected is in the design location             

let mbayeDesignInitPos = {x:-5.5129,y:0.7417,z:1.3953};                                     //let for holding the initial position of Mbaye (at the start of the scene)




let bookFlowers_object;                                                       //let to hold the book of flowers gltf object
let isReturnPanelBtnActive = true;                                            //let to check if the return panel button is active or not
let isBookFlowersActive = false;                                              //let to check if book of flowers is active or on the screen

let flowersPanelsMap = new Map();                                             //let to hold the main structure of flowers in panels
let theCurrentPanel = {obj:null,isActive:false, isDragPanelAttached:false, initPos:null, isDelta1:false};   //let to hold the current active panel


let currentPanel = null;                                                      //let to hold the current active panel
let isPanelMeshClicked = false;                                               //let to check if the panel mesh is clicked
let isAnimatePanelOn = false;                                                 //let to check if panel animation is active
let currentPanelPos = {x:-23.05,y:0.32, z:6}                              //let to set the position of panel for designing part]
// let currentPanelPos = {x:-50,y:0.32, z:13}                              //let to set the position of panel for designing part]

let currentPanelDesignPos = new Map([
    [0, {x:-23.05,y:0.32, z:6}],
    [1, {x:-23.05,y:0.32, z:5.7}]
]);


let panelInitScale;                                                           //let to hold the initial scale of a panel

let isPanelRotationActive = false;                                            //let to check if panel can be rotated
let isStartOfDesignPanel = false;                                             //let to chedk if arranging the flowers to the panel has started

//======part of the current panel rotation ====== 
let timeoutID;
let isCurrPanelClicked = false;
let currentPosition = { x: 0, y: 0 };
let currentRotation = { x: 0, y: 0 };
//letiables to set last angle and curr angle in each frame
//so we can calculate angleDiff and use it for inertia
let lastAngleDiff = { x: 0, y: 0 };
let oldAngle = { x: 0, y: 0 };
let newAngle = { x: 0, y: 0 };
//letiable to check whether mouse is moved or not in each frame
let mousemov = false;
//framecount reset and max framecount(secs) for inertia
let framecount = 0;
let mxframecount = 120; //4 secs at 60 fps
//=============================================== 

// ========== part of load flower ==========
let flowerSelectionCount=0;                                                           //let for keeping track of the current number of flowers; max is 5
let selectedFlowersMap = new Map();                                                   //let to keep track of all the selected flowers from the world
let flowerVarietyArr = [];                                                            //let to keep track of the letieties of the current flower selected from the world
let theCurrentFlower = {obj:null,hasParent:false,initPos:null};                       //let to keep track of the current flowre selected
//===========================================

let panelsWithFlowersCount = 0;
let isEarthButtonClicked = false;
let focusCamera;
let bookFlowersInitPos = {x:461.19,y:24.22,z:150.54};

let bookFlowersInitRot = {x:0.0987,y:0.8133,z:0.2029,w:-0.5354};
let isLightsDisabled = false;
let bookTask;
let panelFlowerBox;
let panelFlowerBoxInitPos = {x:0,y:-0.2459,z:0,w:0.9690};
let isMbayeModelReady = false;
let isBookFlowerReady = false;
let designOrigFlower;
let panelPointerDragBehavior = new BABYLON.PointerDragBehavior({dragPlaneNormal: new BABYLON.Vector3(1,1,1)});
let charPointerDragBehavior = new BABYLON.PointerDragBehavior({dragPlaneNormal: new BABYLON.Vector3(1,1,1)});
let isOpenBookFlowers = false;
let isGizmoDragging = false;

let isRuruClicked = false;
let overHighlight;
let modified_panels_list = new Map();
let panels_from_db = new Map();
let is_design_saved = null;


//main function to create the scene
function create_design_scene(){
    designScene = new BABYLON.Scene(engine);
    designScene.enableSceneOffline = true;
    BABYLON.Database.IDBStorageEnabled = true;

    try{
        designCamera = create_design_camera();
        designLight = create_design_light();
        create_design_skybox();
        create_design_hdr(designScene);
        let cam = create_design_focusCamera().then(function(result){
            focusCamera = result;
        });
        create_orig_flower();
        create_panel_box();
        load_design_meshes();
    }catch(err){
      
    }
    //add the gui for the buttons
    create_design_gui();
    //add mouse event listener
    add_designScene_mouse_listener();
    //do not autoClear the scene
    designScene.autoClear = false;
    overHighlight = new BABYLON.HighlightLayer("hoverHighlight", designScene);


    let panels = user_panels.split(",");
    for(const panel of panels){   
        panels_from_db.set(panel,null);
        
    }
   
    return designScene;
} //end of create scene function

function create_design_camera(){
    //the design camera; camera focused on the Mbaye model when picking a panel
    let camera = new BABYLON.ArcRotateCamera("Design Camera",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),110.0, new BABYLON.Vector3(0,0,0),designScene);
    
    camera.checkCollisions = true;
    camera.target = new BABYLON.Vector3(-30,5 ,10);
    camera.angularSensibilityX = 2000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 2000;  //old value: 4000
    camera.pinchPrecision = 2;
    
    designScene.activeCamera = camera;
    camera.lowerRadiusLimit = 1;
    camera.upperRadiusLimit = 300;                                //set zoom out limit
    camera.wheelPrecision = 5;                                    //zoom in/out speed; speed - lower numer, faster zoom in/out
    // camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera2 =  new BABYLON.ArcRotateCamera("Screenshot",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),105.0, new BABYLON.Vector3(0,0,0),designScene);
    //the camera when arranging flowers to the panel
    panelCamera = new BABYLON.ArcRotateCamera("Panel Camera",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),110.0, new BABYLON.Vector3(0,0,0),designScene);
    // panelCamera.mode = BABYLON.Camera.ORTOGRAPHIC_CAMERA;
    return camera;
}//end of create camera function

//function that creates design scene's light
function create_design_light(){
    let light = new BABYLON.HemisphericLight("designHemiLight",  new BABYLON.Vector3(0.5,5,-2), designScene);
    light.radius = 500;
    light.specular = new BABYLON.Color3(0,0,0);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.groundColor = new BABYLON.Color3(0,0,0);
    light.intensity = 1;
    
    return light;
}//end of create design light function

//function that creates the skybox
async function create_design_skybox(){ 
    designSkybox = BABYLON.MeshBuilder.CreateBox("designSkybox", {size:7000.0}, designScene);
    designSkybox.backFaceCulling = false;
    designSkybox.checkCollisions = true;

    designSkybox.isPickable = false;
    designSkybox.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-30),0);


    let designSkyboxMaterial = new BABYLON.StandardMaterial("designSkyboxMaterial", designScene);
    designSkyboxMaterial.backFaceCulling = false;


      let files = [   
      "front/finalSkybox/px.png",   
      "front/finalSkybox/py.png",   
      "front/finalSkybox/pz.png",   
      "front/finalSkybox/nx.png",              
      "front/finalSkybox/ny.png",   
      "front/finalSkybox/nz.png",    
      ];



    designSkyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, designScene);
    designSkyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    designSkyboxMaterial.disableLighting = true;
    designSkyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    designSkybox.material = designSkyboxMaterial;   
}//end of create skybox function


async function create_design_hdr(designScene){
    //add HDR environemnt
    let designHDRTexture = await new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/dds/environment.dds", designScene);
    designHDRTexture.gammaSpace = false;
    designHDRTexture.level = 0.5;
    designScene.environmentTexture = designHDRTexture;
  }

  //function to create the cameras for the design Scene
async function create_design_focusCamera(){
    let camera = await new BABYLON.ArcRotateCamera("Panel Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),70.0, new BABYLON.Vector3(469,23,167),designScene);
    camera.viewport = new BABYLON.Viewport(0, 0, 1, 1);
   camera.fov = focusCameraDesignFOV;
   camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    return camera;
}//end of create camera function

var mbayePanelsMeshes = [];
let nuvolaSpeechCloud;
 //function to load the meshes of the scene
function load_design_meshes(){
    Promise.all([
        //BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/mbaye/", "mbaye062020.glb", designScene
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/mbaye/", "mbaye062020-2.babylon", designScene
        // BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/mbaye/", "mbayebody2.babylon", designScene
        ).then(function (result) {
            //   result.meshes[0].position = new BABYLON.Vector3(-26.8381,5.6957,7.1077);
            // result.meshes[0].position = new BABYLON.Vector3(-27.70,3.9930,7.0471);
            result.meshes[0].position = new BABYLON.Vector3(-5.2520,1.5579,0.9552);
           
            result.meshes[0].rotationQuaternion = new BABYLON.Quaternion( 0.0017,0.9644,-0.0058,0.2641);

            for(let i=0;i<result.meshes.length;i++){
              
                if(result.meshes[i].name === "BODYPIPES" || result.meshes[i].name === "HEAD" || result.meshes[i].name === "TAIL"){
                    let pbr = new BABYLON.PBRMaterial("pbr", designScene);
                    result.meshes[i].material = pbr;
                    result.meshes[i].material.backFaceCulling = false;
                    pbr.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
                    pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                    pbr.metallic = 1;
                    pbr.metallicF0Factor = 0.50;
                    pbr.roughness = 0.15;
                    pbr.microSurface = 1; 
                }else if(mbayePanelsMap.has(result.meshes[i].name)){ //else if the part is a panel, change panel color to transparent
                    if(result.meshes[i].material){
                        let tempMatl = new BABYLON.PBRMaterial("panelMatl"+i, designScene);
                        tempMatl.diffuseColor = BABYLON.Color3.Black();
                        tempMatl.alpha = 0.1;
                        tempMatl.metallic = 1;
                        tempMatl.roughness = 0.06;
                        tempMatl.reflectivityColor = new BABYLON.Color3(1,1,1);
                        result.meshes[i].material = tempMatl;
                        result.meshes[i].isPickable = true;
                        mbayePanelsMap.set(result.meshes[i].name,result.meshes[i]);
                    }
                   
                }else if(result.meshes[i].name === "R_EYE" || result.meshes[i].name === "L_EYE"){
                    result.meshes[i].material.subMaterials[2].emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
                }
                if(i===result.meshes.length-1) isMbayeModelReady = true;
               
            }//end of for
            mbayeDesign_object = result.meshes[0];
            // temp_gizmo(mbayeDesign_object);
      }),
   
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/seaObjects/nuvola/", "nuvolaSwimming.babylon", designScene).then(function (result) {
          
          nuvolaDesign_obj = result.meshes[0];
          nuvolaDesign_obj.scaling = new BABYLON.Vector3(0.07,0.07,0.07);
          nuvolaDesign_obj.position = new BABYLON.Vector3(12.50,-8.30,55.92);
          nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0570,-0.4064,0.0516,0.9102);
          nuvolaDesign_obj.isPickable = true;
        //   add_action_mgr(result.meshes[0]);
      }),
      
      
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/seaObjects/ruru/", "ruruAnimated.babylon", designScene).then(function (result) {   
          result.meshes[0].scaling = new BABYLON.Vector3(0.3,0.3,0.3);
          result.meshes[0].position = new BABYLON.Vector3(59,8.5,9);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.6481,-0.3413,0.2794,0.6202);
          ruruDesign_obj = result.meshes[0];
          ruruDesign_obj.isPickable = true;
        //   add_action_mgr(result.meshes[0]);
        }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/", "speechCloud.glb", designScene).then(function (result) {
          mermaidSpeechCloud = result.meshes[0];
          result.meshes[1].isPickable = false;
          mermaidSpeechCloud.isPickable = false;
          mermaidSpeechCloud.position = new BABYLON.Vector3(-4,-9,18);
          mermaidSpeechCloud.scaling = new BABYLON.Vector3(5,5,-5);
          mermaidSpeechCloud.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(5),BABYLON.Tools.ToRadians(80),0);

        //   ruruSpeechCloud = mermaidSpeechCloud.clone("ruruCloud");
        //   ruruSpeechCloud.position = new BABYLON.Vector3(48.50,19.5,12.15);
        //   ruruSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.1210,0.6063,-0.08125,0.7816);
        //   ruruSpeechCloud.isPickable = false;

        //   nuvolaSpeechCloud = mermaidSpeechCloud.clone("nuvolaCloud");
        //   nuvolaSpeechCloud.position = new BABYLON.Vector3(18,8.5,60);
        //   nuvolaSpeechCloud.isPickable = false;

          mermaidSpeechCloud.isVisible = false;
          mermaidSpeechCloud.setEnabled(false);
      }),
      
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/book/", "bookFlowersDesign.glb", designScene).then(function (result) {
        // for(i=0;i<result.meshes.length;i++){
        //     console.log(i,result.meshes[i].name);
        // }

          result.animationGroups[0].loopAnimation = false;
          result.meshes[0].position =  new BABYLON.Vector3(461.19,24.22,150.54);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0987,0.8133,0.2029,-0.5354);
          result.meshes[0].scaling =  new BABYLON.Vector3(0.012,0.012,-0.012);
          bookFlowers_object = result.meshes[0];

          bookFlowers_object.isPickable = false;
          bookFlowers_object.isVisible = false;
          bookFlowers_object.setEnabled(false);
          bookLabel = result.meshes[20];                              //the plane for the book's label
          bookLeftPages = result.meshes[16];                          //bookLeftPages
          bookRightPages = result.meshes[22];                         //bookRightPages
          result.meshes[19].scaling = new BABYLON.Vector3(0.8,0.8, -0.8);   //book's log
          bookTask = result;
          
          add_action_mgr(result.meshes[17]);                            //book screenshot wood
          add_action_mgr(result.meshes[37]);                            //book post top
          add_action_mgr(result.meshes[39]);                            //book post bottom


      }),
    //   BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/nuvola/", "nuvolaDesign1.glb", designScene).then(function (result) {
    //       result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
    //       result.meshes[0].position = new BABYLON.Vector3(18.9,8.67,59.4);
    //       result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0664,0.7116,-0.0546,0.6970);
    //       nuvolaSpeech = result.meshes[0];
    //   }),
    //   BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/ruru/", "ruruDesign1.glb", designScene).then(function (result) {
    //       result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
    //       result.meshes[0].position = new BABYLON.Vector3(48.65,19.67,12.85);
    //       result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0936,.5051,-0.0944,0.8520);
    //       ruruSpeech = result.meshes[0];
    //   }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/nuvola/", "nuvolaDesign2.glb", designScene).then(function (result) {
          result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
          result.meshes[0].position = new BABYLON.Vector3(388.01,19.01,156.72);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.0964,0.6455,-0.0877,0.7524);
          result.meshes[0].isVisible = false;
          result.meshes[0].setEnabled(false);
          nuvolaSpeech2 = result.meshes[0];
      }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/nuvola/", "nuvolaFocus.glb", designScene).then(function (result) {
          result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
          result.meshes[0].position = new BABYLON.Vector3( 514.69,48.44,80.21);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.2044,-0.2045,-0.0377, 0.9563);
          nuvolaSpeech3 = result.meshes[0];
      }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/ruru/", "ruruDesign2.glb", designScene).then(function (result) {
          result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
          result.meshes[0].position = new BABYLON.Vector3( 396.77,49.41,116.98);
          result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1860,0.5200,-0.1480,0.8202);
          result.meshes[0].isVisible = false;
          result.meshes[0].setEnabled(false);
          ruruSpeech2 = result.meshes[0];
      }),
      BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/cloud/ruru/", "ruruDesign3.glb", designScene).then(function (result) {
        result.meshes[0].scaling = new BABYLON.Vector3(9.5,9.5,-9.5);
        result.meshes[0].position = new BABYLON.Vector3( 396.77,49.41,116.68);
        result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1860,0.5200,-0.1480,0.8202);
        result.meshes[0].isVisible = false;
        result.meshes[0].setEnabled(false);
        ruruSpeech3 = result.meshes[0];
        ruruSpeech3.isPickable = false;
        
      }),
  ]).then(() => {  

        // console.log(JSON.stringify(mbayePanelsMap));
         

        isBookFlowerReady = true;
        // create_flower_label();
        enable_design_utility();
        listen_to_panel_rotation();
        listen_to_wheelscroll();

        // console.log(mbayePanelsMap);
        enable_home_gizmo2();

        create_cloud_speeches();

    });
}//end of load design meshes





//#################################################### FUNCTIONS FOR THE CHOSEN PANEL #######################################################//
let currCharSelected;
function enable_home_gizmo2(){
    // Create gizmo
    designUtilLayer = new BABYLON.UtilityLayerRenderer(designScene);
    designUtilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo.attachedMesh = theFlower;
    // homeGizmo.scaleRatio = 1.5;

    homeGizmo2 = new BABYLON.PositionGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    // homeGizmo2.attachedMesh = theFlower;
    homeGizmo2.scaleRatio = 1.5;
}

function test_gizmo(theObj){
    // Create gizmo
    designUtilLayer = new BABYLON.UtilityLayerRenderer(designScene);
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


function temp_gizmo(obj){
    designUtilLayer = new BABYLON.UtilityLayerRenderer(designScene);
    designUtilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    gizmoR = new BABYLON.RotationGizmo(designUtilLayer);
    gizmoR = new BABYLON.RotationGizmo(designUtilLayer);
    gizmoR.attachedMesh = obj;
    // homeGizmo.scaleRatio = 1.5;

    gizmoP = new BABYLON.PositionGizmo(designUtilLayer);
    // homeGizmo = new BABYLON.RotationGizmo(designUtilLayer);
    gizmoP.attachedMesh = obj;
    gizmoP.scaleRatio = 1.5;
}

//function to change the color of the panel to solid or transparent
function set_current_panel_color(panel,mode){
    //mode 1 - make the panel's solid; mode 2 - make the panel transparent; 
    if(mode==1){
      panel.material.microSurface = 1;
      panel.material.reflectivityColor = new BABYLON.Color3(1,1,1);
      panel.material.disableLighting = true;
      panel.material.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
      panel.material.emissiveColor = new BABYLON.Color3(0,0,0);
      panel.material.metallic = 1;
      panel.material.roughness = 0.15;
      panel.material.alpha = 1;
      panel.material.ambientColor =  new BABYLON.Color3(0,0,0);
      panel.material.backFaceCulling = false;
    }else{
      panel.material.alpha = 0.1;
      panel.material.metallic = 1;
      panel.material.roughness = 0.06;
      panel.material.reflectivityColor = new BABYLON.Color3(1,1,1);
    }
}//end of function


//function to set the current active panel being designed
function set_current_panel(panel){ 
    //the current panel is the current panel dragged; theCurrentPanel.obj is for comparison
    //if there is an existing current panel, check if it has children
   
    if(theCurrentPanel.isActive){
        //check if the panel has children
        let count = theCurrentPanel.obj.getChildren().length;
        //if there are no children, set the panel to transparent; else, the panel's color is solid
        if(count < 1){
            set_current_panel_color(theCurrentPanel.obj,2);
            set_current_panel_color(panel,1);
        }else  set_current_panel_color(panel,1); 
    }else{
        set_current_panel_color(panel,1);
    }

    //set the current panel as theCurrentPanel.obj's value
    theCurrentPanel.obj = panel;
    theCurrentPanel.initPos = panel.position;
    theCurrentPanel.isActive = true;
   
    // get the position and scaling of the current panel for when we return it 
    panelInitPos.x = panel.position.x;
    panelInitPos.y = panel.position.y;
    panelInitPos.z = panel.position.z; 

    
    panelInitScale = panel.scaling;
    

    //set the panel as the currentPanel
    currentPanel = panel;
}//end of function


//function to create the box that will check if a flower is out of bounds of the panel
function create_panel_box(){
    panelFlowerBox = BABYLON.Mesh.CreateBox("FlowerBox", 5, designScene);
    panelFlowerBox.position = new BABYLON.Vector3(467.75,24.43,152.02);
    panelFlowerBox.rotationQuaternion = new BABYLON.Quaternion(0,-0.2459,0,0.9690);
    panelFlowerBox.scaling = new BABYLON.Vector3(1.8,1.8,1.5);
    panelFlowerBox.material = new BABYLON.StandardMaterial("flowerBoxMatl", designScene);
    panelFlowerBox.material.diffuseColor = BABYLON.Color3.White();
    panelFlowerBox.material.alpha = 0;
    panelFlowerBox.isPickable = false;
}


function create_cloud_speeches(){
    ruruSpeechCloud =  init_image("ruruSpeech1", "front/images3D/designScene/ruruDesign1.png",14 , 20, 1, {x:54.8,y:20.9,z:15.6}, {x:0.0028,y:-0.8282,z:0.0128,w:0.5599});
    nuvolaSpeechCloud =  init_image("nuvolaSpeech1", "front/images3D/designScene/nuvolaDesign1.png",14 , 20, 1, {x:24.4,y:11.80,z:52.82}, {x:-0.0005,y:-0.6610,z:0.0130,w:0.7499});

    // test_gizmo(nuvolaSpeechCloud);
}


function init_image(name, matlPath, h, w, scale,pos,rot){
    var temp= BABYLON.MeshBuilder.CreatePlane(name, {height:h, width: w}, designScene);
    temp.scaling = new BABYLON.Vector3(scale, scale, scale);
    temp.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    temp.rotationQuaternion = new BABYLON.Quaternion(rot.x, rot.y,rot.z,rot.w);
    
    var tempMatl = new BABYLON.StandardMaterial(name+"matl", designScene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, designScene);
    tempMatl.opacityTexture = new BABYLON.Texture(matlPath, designScene);
    tempMatl.ambientColor = new BABYLON.Color3(1,1,1);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;

    return temp;
}












//#################################################### FUNCTIONS FOR THE FLOWERS #######################################################//

//function to check if the clicked mesh is a flower
function check_if_mesh_is_flower(mesh){
    let id = mesh.uniqueId;
    let isFlower = selectedFlowersMap.has(id);
    let isInFlowersMap = false;
    if(flowersPanelsMap.has(currentPanel)) isInFlowersMap = flowersPanelsMap.get(currentPanel).has(id);
    // console.log("mesh" , mesh, "id", id, "isFLower: ", isFlower, "isInFlowersMap: ", isInFlowersMap, "flowesPanelsMap ", flowersPanelsMap);
    if(isFlower || isInFlowersMap) return true;
    return false;
}//end of function 

//check if mesh clicked is a variety of a flower
function check_if_mesh_is_flower_variety(flower){
    for(let i=0;i<flowerVarietyArr.length;i++){
      if(flower === flowerVarietyArr[i]){
        return true;
      }
    }
    return false;
}

//function to create copy of the flower clicked from the book of flowers
function create_black_flower_copy(theFlower){
    //create a clone of the flower clicked
    let theFlowerCopy = theFlower.clone(theFlower.name);
    let flowerHasParent = false;
    
    //if the active camera is panel camera or focus camera
    if(designScene.activeCamera === panelCamera ){
        if(theFlower.parent === bookLeftPages) flowerHasParent = true;
    }else{
        if(theFlower.parent === bookLeftPages) flowerHasParent = true;
    }

    //if the clone has a parent, set position x and y depending if the camera is panel or focus
    if(flowerHasParent){                        //if focus camera
        theFlowerCopy.position.y += 50;
        theFlowerCopy.position.x -= 50;
        theFlowerCopy.setParent(null);
    }else{                                      //if panel camera
        theFlowerCopy.position.y += 1;
        theFlowerCopy.position.x += 0.1;
    }
      
    //increment the current flower selection count
    flowerSelectionCount++;
    if(theCurrentFlower.obj) theCurrentFlower.obj.showBoundingBox = false;
    //attach the gizmo to the flower clone
    designGizmoManager.attachToMesh(theFlowerCopy);
    //set the clone as the current flower and show bounding box
    theCurrentFlower.obj = theFlowerCopy;
    theCurrentFlower.obj.showBoundingBox = true;
    //add the flower to the selected flowers map
    selectedFlowersMap.set(theFlowerCopy.uniqueId, theFlowerCopy);
    //console.log("SELECTED FLOWERS: ", selectedFlowersMap, flowerSelectionCount);
}

//function for creating the flower mesh in a plane and adding material with transparent bg for the book of flowers
function create_black_flower(name,matlName,imgPath,size,x,y,z){
    let plane = BABYLON.Mesh.CreatePlane(name, size, designScene);
    plane.isVisible = false;
    plane.position = new BABYLON.Vector3(x,y,z);
    plane.rotation.y = BABYLON.Tools.ToRadians(-100);
    
    let planeMatl = new BABYLON.StandardMaterial(matlName, designScene);
    planeMatl.diffuseColor = BABYLON.Color3.Black();
    planeMatl.diffuseTexture = new BABYLON.Texture(imgPath, designScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.emissiveColor = BABYLON.Color3.Green();
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
   
    plane.material = planeMatl;
   

    return plane;
}


//function add flower to the flowerPanelsMap to keep track of the flowers added to the panel; related to flower-panel intersection
function add_flower_to_panel(){
    let id = theCurrentFlower.obj.uniqueId;
    let flowersMap = flowersPanelsMap.get(currentPanel);                    //get the flowers list on the current panel
    flowersMap.set(id,theCurrentFlower.obj);                                //add the flower to the flowers list, set flower id as key
    flowersPanelsMap.set(currentPanel, flowersMap);                         //set/add the flowers list to the current panel in the map
    if(theCurrentFlower.obj.parent) flowerSelectionCount--;     //part of the designScene and earthFlowersScene
    // console.log("FLOWERS MAP ADD: ", flowersPanelsMap, "selection count : ", flowerSelectionCount, "selection : ", selectedFlowersMap);
}//end of function

//function to remove the flowers from the panel; related to flower-panel intersection
function remove_flower_from_panel(id){
    // let id = theCurrentFlower.obj.uniqueId;
    let flowersMap = flowersPanelsMap.get(currentPanel);                    //get the flowers list on the current panel
    if(theCurrentFlower.obj.parent) flowerSelectionCount++;
    flowersMap.delete(id,theCurrentFlower.obj);     
    flowersPanelsMap.set(currentPanel, flowersMap);   
    // console.log("FLOWERS MAP REMOVE: ", flowersPanelsMap, "selection count: ", flowerSelectionCount, "selection: ", selectedFlowersMap);
}//end of function










//#################################################### FUNCTIONS FOR THE BOOK OF FLOWERS #######################################################//

//function to play animation of book of flowers and set the orig flower, field and label
function open_book_of_flowers(theFlowerName){
    //set the book flower, field and label
    set_orig_flower(theFlowerName);
    set_flower_field(theFlowerName)
    set_flower_label(theFlowerName);
    if(designScene.activeCamera === focusCamera) set_book_flowers_position();

    //start animation of the book of flowers
    bookTask.animationGroups[0].reset();
    bookTask.animationGroups[0].play();
    //show book of flowers
    bookFlowers_object.setEnabled(true);
    bookFlowers_object.isVisible = true;
    
    isOpenBookFlowers = true;
}


function set_book_flowers_position(){
    //if(focusCameraDesignFOV === 1.2) bookFlowers_object.position = new BABYLON.Vector3(467.64, 23.33, 145.91);
    if(focusCameraDesignFOV === 1.2) bookFlowers_object.position = new BABYLON.Vector3( 468.72, 23.31, 145.86);
    else if(focusCameraDesignFOV === 1.25) bookFlowers_object.position = new BABYLON.Vector3( 469.31,23.59,145.20);
    else if(focusCameraDesignFOV === 1.3) bookFlowers_object.position = new BABYLON.Vector3( 469.28,23.85,144.60);
    else if(focusCameraDesignFOV === 1.5) bookFlowers_object.position = new BABYLON.Vector3( 469.26,24.14,143.95);
    else bookFlowers_object.position = focusCameraBookPosition;         //1.4 is the default fov
}



//function to remove the book of flowers after selecting a flower from the array of variety of flowers
function remove_book_of_flowers(){

    //delete all flower variety from the book of flowers
    for(let i=0;i<flowerVarietyArr.length;i++){
        flowerVarietyArr[i].dispose();
    }
    flowerVarietyArr = [];

    //if the selected flowers map has content and the parent is the book, set the parent to null
    for(let val of selectedFlowersMap.values()){
        if(val.parent===bookLeftPages) val.setParent(null);
    }

    //if the book of flowers is currently open and the black versions are loaded
    if(isBookFlowersActive){
        //hide the plane for the orig flower
        designOrigFlower.isVisible = false;
        designOrigFlower.setEnabled(false);
        designOrigFlower.scaling = new BABYLON.Vector3(0.1,0.1,0.1);
        //make the log smaller
        bookTask.meshes[19].scaling = new BABYLON.Vector3(0.1,0.1, -0.1);
        //remove the current material of the orig flower plane
        if(designOrigFlower){
            designOrigFlower.material.dispose();
            //if there is a currenet material of the flower label, dispose the material and hide the label plane
            bookLabel.material.dispose();
        }
        //hide the book of flowers and set that the book is not active
        bookFlowers_object.setEnabled(false);
        bookFlowers_object.isVisible = false;
        if(designScene.activeCamera === focusCamera) bookFlowers_object.position = focusCameraBookPosition;
        else if(designScene.activeCamera === panelCamera) bookFlowers_object.position = bookFlowersInitPos;
        isBookFlowersActive = false;
    }
}//end of function


//function to delete/remove a flower selected after pressing the 'Del' key
function delete_flower_selected(theFlower){
    let flowersMap = flowersPanelsMap.get(currentPanel);                    //set the key:value  pair's value of flowersMap to the let
    let id = theFlower.uniqueId;
  
    //if the flower is on the current panel
    if(theFlower.parent===currentPanel){
        let flower = flowersMap.get(id);
        flower.dispose();
        flowersMap.delete(id);
        flowersPanelsMap.set(currentPanel,flowersMap);
    }else{
        theFlower.setParent(null);
        theFlower.dispose();
        flowerSelectionCount--;
    }
    selectedFlowersMap.delete(id);
    designGizmoManager.attachToMesh(null);
}//end of function


//function to remove the flowers that are not in panel
function remove_flowers_not_in_panel(isReturned){
    for (const [key,val] of selectedFlowersMap.entries()) {
      let isInFlowersMap = flowersPanelsMap.get(currentPanel).has(key);
      if(!isInFlowersMap){
        val.dispose();
        selectedFlowersMap.delete(key);
        flowerSelectionCount--;
      }
    }

    let flowersMap = flowersPanelsMap.get(currentPanel);
    for(let val of flowersMap.values()){
        if(val.showBoundingBox) val.showBoundingBox = false;
        if(isReturned) val.isPickable = false;
    }

    let tempsize = flowersMap.size;
    if(tempsize > 0) panelsWithFlowersCount++;
    designGizmoManager.attachToMesh(null);
    selectedFlowersMap.clear();
}//end of function




//fucnction called if the current panel being designed is double-clicked
let returnPanel =(meshEvent)=>{
    returnPanelViaButton();
};


function set_flower_field(theFlowerName){
    let planeMatl = new BABYLON.StandardMaterial("flowerFieldMatl", designScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/field/"+theFlowerName+".png", designScene);
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;

    bookLeftPages.material = planeMatl;
    bookRightPages.material = planeMatl;
}//end of function


function create_orig_flower(){
    let plane = BABYLON.Mesh.CreatePlane("origFlower", 2  , designScene);
    plane.position = new BABYLON.Vector3(467.71,19.9,153.5);
    plane.rotationQuaternion = new BABYLON.Quaternion(0.5406,-0.2502, 0.7903,0.1409);
    plane.scaling = new BABYLON.Vector3(0.1,0.1,0.1);
    plane.isVisible = false;
    plane.setEnabled(false);
    designOrigFlower = plane;
}//end of function

function create_post_labels(){
    let plane = BABYLON.Mesh.CreatePlane("postTop", 2  , designScene);
   
    plane.position = new BABYLON.Vector3(0,0,0);

    let planeMatl = new BABYLON.StandardMaterial("postTopMatl", designScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("images/postTop.png", designScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;//Allways show the front and the back of an element
    

    plane.material = planeMatl;
    
}//end of function


function set_flower_label(theFlowerName){
    
    //function to set flower label on the center wood
    let planeMatl = new BABYLON.StandardMaterial("labelMatl", designScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/label/"+theFlowerName+".png", designScene);
    // planeMatl.diffuseColor = BABYLON.Color3.Red();
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.diffuseTexture.uScale = -3.4;
    planeMatl.diffuseTexture.vScale = -8;
    planeMatl.diffuseTexture.uOffset = -0.77;
    planeMatl.diffuseTexture.vOffset = -1.08;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;

    bookLabel.material = planeMatl;
}


function set_orig_flower(theFlowerName){
    designOrigFlower.setParent(bookLeftPages);
    let planeMatl = new BABYLON.StandardMaterial(theFlowerName, designScene);
    planeMatl.diffuseTexture = new BABYLON.Texture("front/images3D/flowers2D/orig/"+theFlowerName+".png", designScene);
    
    planeMatl.diffuseTexture.hasAlpha = true;
    planeMatl.specularColor = new BABYLON.Color3(0, 0, 0);
    planeMatl.backFaceCulling = false;//Always show the front and the back of an element
    planeMatl.diffuseTexture.uScale = -1;
    
   
    designOrigFlower.material = planeMatl;
    designOrigFlower.position = new BABYLON.Vector3(122.22, 86.60,-13.85);
    designOrigFlower.rotationQuaternion = new BABYLON.Quaternion( -0.0326, -0.0415, 0.9982,0.0275);
    
    designOrigFlower.isVisible = true;
    designOrigFlower.setEnabled(true);
}



//function to load the versions of a flower
function load_design_flower_versions(flowersArr){
  
    let len = flowersArr.length;
    for(let i=0;i<len;i++){
        let x = blackFlowerPositionMap.get(i).x;
        let y = blackFlowerPositionMap.get(i).y;
        let z = blackFlowerPositionMap.get(i).z;

        if(designScene.activeCamera === focusCamera){
            
            x = blackFlowerPositionMap_focus.get(i).x;
            y = blackFlowerPositionMap_focus.get(i).y;
            z = blackFlowerPositionMap_focus.get(i).z;
        }
        let theFlower = create_black_flower(flowersArr[i], flowersArr[i]+"_matl","front/images3D/flowers2D/"+flowersArr[i]+".png",1,x,y,z);
        flowerVarietyArr.push(theFlower);
        if(designScene.activeCamera === focusCamera){
            theFlower.rotationQuaternion = new BABYLON.Quaternion(0.0090, 0.9778,0.2058,-0.0194);
            theFlower.setParent(bookLeftPages);
            // theFlower.rotationQuaternion = new BABYLON.Quaternion(0.0386, -0.8338,-0.0202,0.5502);
        }
    }//end of for loop
    isBookFlowersActive = true;
}//end of function



//function to set flowers in the panel to pickable
function set_flowers_to_pickable(){
    let isPanelInMap = flowersPanelsMap.has(currentPanel);
    let flowersMap;
    let id = currentPanel.uniqueId;
    if(isPanelInMap){
      flowersMap = flowersPanelsMap.get(currentPanel);
      for(let val of flowersMap.values()){
          val.isPickable = true;
      }
    }
  }



function show_book_flowers(val){
    bookFlowers_object.isVisible = val;
    bookFlowers_object.setEnabled(val);
    if(flowerVarietyArr && flowerVarietyArr.length>0){
        for(let i=0;i<flowerVarietyArr.length;i++){
            flowerVarietyArr[i].isVisible = val;
        }
    }
    
    
}


function show_nuvola(val){
    //show nuvola
    if(designScene.activeCamera === panelCamera){
        if(val) nuvolaDesign_obj.position.z -= 100;
        else nuvolaDesign_obj.position.z += 100;
    }else{
        nuvolaSpeech3.isVisible = val;
        nuvolaSpeech3.setEnabled(val);
    }

    nuvolaSpeechCloud.isVisible = val;
    nuvolaSpeechCloud.setEnabled(val);
    nuvolaSpeech2.isVisible =val;
    nuvolaSpeech2.setEnabled(val);
}

function show_ruru(val){
    ruruDesign_obj.isVisible = val;
    ruruSpeechCloud.isVisible = val;
    ruruSpeechCloud.setEnabled(val);
    ruruSpeech2.isVisible=val;
    ruruSpeech2.setEnabled(val);
    ruruSpeech3.isVisible=val;
    ruruSpeech3.setEnabled(val);
}



let screenshotData;
function take_panel_screenshot(){

    

    let panelName = "";
   
    if(currentPanel) panelName = currentPanel.name;
    if(designScene.activeCamera === panelCamera || designScene.activeCamera === focusCamera){
        let cam;
        if(designScene.activeCamera === panelCamera) cam = camera2;
        else cam = focusCamera;
        show_book_flowers(false);
        show_ruru(false);
        show_nuvola(false);
       
        BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine, cam, {width:1024, height:768, precision:1},function(img){
            // screenshotImg = img;
            if (modified_panels_list.has(panelName) || panels_from_db.has(panelName)) {
                // $('#modalScreenshot').attr('src', img);
                $('#modalScreenshot').css({'background-image':'url('+img+')'});
                $("#showScreenshotModal").modal('show');            //show screenshot modal
                screenshotData = img;
              
            }//end of if
            else{
                Swal.fire({
                    width: '10vw',
                    padding: '3em',
                    background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                    title: '<br/><br/><br/><span style="color:red; padding-top:20%;">Please save/design your panel first! Click Ruru to save your progress.</span>',
                    showConfirmButton: false,
                    position: 'top-end',
                    // timer: 3000,
                    width: 100,
                    customClass: {
                        popup: 'trevor-popup-class',
                    }
                });
            }//end of else
        });
        
        show_book_flowers(true);
        show_ruru(true);
        show_nuvola(true);
    }
    // else if(designScene.activeCamera === focusCamera){
    //     hide_book_flowers();
    //     BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine, focusCamera, {width:1024, height:768, precision:1},null,null,null,false,"Mbaye_panel_"+currentPanel.name);
    //     show_book_flowers(false);
    // }
    else if(designScene.activeCamera === designCamera){
        BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine, designCamera, {width:1600, height:800, precision:1},function(img){
            $('#modalScreenshot').css({'background-image':'url('+img+')'});
            $("#showScreenshotModal").modal('show');            //show screenshot modal
           screenshotData = img;
        });
    }
    // console.log(screenshotImg);
    // Swal.fire({
    //     width: '10vw',
    //     padding: '3em',
    //     background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
    //     title: '\n\n\n\nScreenshot of panel '+panelName+' saved succesfully!',
    //     showConfirmButton: false,
    //     position: 'top-end',
    //     // timer: 3000,
    //     width: 100,
    //     customClass: {
    //       popup: 'trevor-popup-class',
    //     }
    //   });
    // var screenshotURL = 

      
    

}


  


//#################################################### FUNCTIONS FOR RETURNING THE PANEL #######################################################//
let isDesignMermaidActive = false;
//function to return panel to mbaye
function returnPanelViaButton(){
  //if in design panel mode and the panel is not yet returned (not double-clicked or return panel button not clicked)
  if(!isPanelReturned && isStartOfDesignPanel){
        //show the screenshot icon
        $('#takeScreenshotMain').show();

        designLight.direction = new BABYLON.Vector3(0.5,5,-2);
        designScene.activeCamera = panelCamera;
       

        //call the function to remove all the flowers from the scene that are placed in the panel
        remove_flowers_not_in_panel(true);
        remove_book_of_flowers();


        //hide the book of flowers
        bookFlowers_object.isVisible = false;
        bookFlowers_object.setEnabled(false);
        //set the angle of the design camera
        bookFlowers_object.position = bookFlowersInitPos;
        bookFlowers_object.rotationQuaternion = bookFlowersInitRot;

       
        posTool_btn.isVisible = false;
        rotTool_btn.isVisible = false;
        scaleTool_btn.isVisible = false;
        offTool_btn.isVisible = false;
        // screenshot_btn.isVisible = true;
        if(load_hd_world_btn) load_hd_world_btn.isVisible = false;
        // delTool_btn.isVisible = false;


        //set the original position, rotation and scaling of the panel back to Mbaye
        let panel = theCurrentPanel.obj;
        // console.log("curr scale: ", panel.scaling);
        if(panel.showBoundingBox) panel.showBoundingBox = false;

    
        panel.position = new BABYLON.Vector3(panelInitPos.x,panelInitPos.y,panelInitPos.z);
        panel.rotationQuaternion = panelInitRot;
       
        panel.scaling = panelInitScale;

        //set the original scaling and position of Mbaye
        mbayeDesign_object.scaling = new BABYLON.Vector3(1,1,1);
        mbayeDesign_object.position = mbayeDesignInitPos;

        //modify the var values
        flowerSelectionCount = 0; 
        isPanelReturned = true;
        isPanelCameraMoving = true;
        isDesignSceneActive = false;  
        isStartOfDesignPanel = false;
        isPanelRotationActive = false;
        
        

        //detach the design gizmo manger 
        designGizmoManager.attachToMesh(null);
        currentPanel = null;
        if(earthFlowersCamera) earthFlowersCamera.detachControl(canvas);
        earthFlowers_object.setEnabled(false);
        earthFlowers_object.isVisible = false;
    

        let count = theCurrentPanel.obj.getChildren().length;
        if(count < 1){
            set_current_panel_color(panel,2);
            // if(panels_from_db.has(panel.name)) modified_panels_list.set(panel.name,null);
            
        }
        else{
            modified_panels_list.set(panel.name,null);
           
        }
      
        if(panels_from_db.has(panel.name)) modified_panels_list.set(panel.name,null);
        let currentPanelInitZPos = theCurrentPanel.obj.position.z;
        theCurrentPanel.obj = null;
        theCurrentPanel.isActive = false;
        theCurrentFlower.obj = null;

            
         
        if(flowersPanelsMap.size >= 1){   
            designCamera = new BABYLON.ArcRotateCamera("Design Camera",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),110.0, new BABYLON.Vector3(0,0,0),designScene); 
            designCamera.checkCollisions = true;
            designCamera.target = new BABYLON.Vector3(-30,5 ,10);
            designCamera.lowerRadiusLimit = 1;
            designCamera.upperRadiusLimit = 300;    

            
            set_chars_position(1);
            set_clouds_position(1);
        

            nuvolaSpeech3.isVisible = false;
            nuvolaSpeech3.setEnabled(false);

            
            
            if(currentPanelInitZPos > 0){
                designCamera.position = cameraPosForLeftPanelsPos; 
            }else designCamera.position = cameraPosForRightPanelsPos;  
        }
        designCamera.attachControl(canvas,true);
    }else{
      isPanelReturned = false;
    }
    designCamera.attachControl(canvas,true);
}//end of function



//#################################################### FUNCTIONS FOR THE BOOK OF FLOWERS #######################################################//
function focus_on_panel(){
  
      if(bookFlowers_object.isVisible){
            if(theCurrentFlower.obj && !theCurrentFlower.obj.parent){
                    theCurrentFlower.obj = null;
                    theCurrentFlower.hasParent = false;
            }
            remove_flowers_not_in_panel(false);  
      } 
      
    
      if(designScene.activeCamera !== focusCamera && isStartOfDesignPanel){
            if(currentPanel){
            //   currentPanel.rotation = new BABYLON.Vector3(0, BABYLON.Tools.ToRadians(25),0);
              panelFlowerBox.rotationQuaternion = new BABYLON.Quaternion(0,-0.0077,0,0.9996);
            }
            //set position of flowers by setting the parent of the flowers
             if(flowerVarietyArr && flowerVarietyArr.length>0){
              // console.log("this is trueeee");
                for(let i=0;i<flowerVarietyArr.length;i++){
                  // flowerVarietyArr[i].rotation.y = BABYLON.Tools.ToRadians(90);
                  flowerVarietyArr[i].setParent(bookLeftPages);
                  flowerVarietyArr[i].rotationQuaternion = new BABYLON.Quaternion(0.9683,0.0015,-0.1033,0.2269);
                }
             }


             set_chars_position(3);
             set_clouds_position(3);

           

             // focusPanel_btn.background = "red";
             focusCamera.target = currentPanel;
             focusCamera.targetScreenOffset = new BABYLON.Vector2(0,1);
             // focusCamera.target = new BABYLON.Vector3(469.27,22,164.60);

             designLight.direction = new BABYLON.Vector3(-500,300,100);

             focusCamera.alpha = 1.5594;
             focusCamera.beta =  1.6239;
             // focusCamera.fov = 0.5; 
             focusCamera.radius = 12;

             designScene.activeCamera = focusCamera;
            //  focusCamera.attachControl(canvas,true);
             set_book_flowers_position();
            bookFlowers_object.rotationQuaternion = new BABYLON.Quaternion(0.0090, 0.9778,0.2058,-0.0194);
       
    }else{
            if(currentPanel){
            //   currentPanel.rotation = new BABYLON.Vector3(0, BABYLON.Tools.ToRadians(90),0);
              panelFlowerBox.rotationQuaternion = panelFlowerBoxInitPos;
            }
           
            if(flowerVarietyArr && flowerVarietyArr.length>0){
                for(let i=0;i<flowerVarietyArr.length;i++){
                  flowerVarietyArr[i].setParent(bookLeftPages);
                }
            }

           
            designLight.direction = new BABYLON.Vector3(0.5,5,-2);

            set_chars_position(2);
            set_clouds_position(2);
            
            

            bookFlowers_object.position = bookFlowersInitPos;
            bookFlowers_object.rotationQuaternion = bookFlowersInitRot;
            designScene.activeCamera = panelCamera;
    }

    theCurrentFlower.obj = null;
    theCurrentFlower.hasParent = false;
  
}     

//TEMP FUNCTION
function enable_panel_rotation(thePanel){
    var theGizmo = new BABYLON.PlaneRotationGizmo(new BABYLON.Vector3(0,0,1), BABYLON.Color3.FromHexString("#00b894"))
    theGizmo.attachedMesh = thePanel;
}


//#################################################### FUNCTIONS FOR MANIPULATING A FLOWER #######################################################//
//function that creates position, rotation, bounding box gizmo for flowers
function enable_design_utility(){
    
    

    designGizmoManager = new BABYLON.GizmoManager(designScene);
    //this gizmo is only attachable to flowers
    designGizmoManager.attachableMeshes = [];                              
    // Initialize all gizmos
    designGizmoManager.positionGizmoEnabled = false; 
    designGizmoManager.boundingBoxGizmoEnabled = false;
    designGizmoManager.rotationGizmoEnabled = false;
    designGizmoManager.scaleGizmoEnabled = false;
    // console.log("design gizmo : ", designGizmoManager);


    
   
    //onPointerOutObservable
    // Modify gizmos based on keypress
    document.onkeydown = (evt)=>{
     
        //key press: p or P - enable position arrows
        //key press: r or R - enable rotation arrows
        //key press: s or S - enable bounding box for scaling / bounding box gizmo

        if(evt.key == 'p' || evt.key == 'P' || evt.key =='R' ||  evt.key == 'r' || evt.key == 's' ||  evt.key == 'S'){
            // Switch gizmo type
            designGizmoManager.positionGizmoEnabled = false;
            designGizmoManager.rotationGizmoEnabled = false;
            designGizmoManager.scaleGizmoEnabled = false;
            designGizmoManager.boundingBoxGizmoEnabled = false;


            if(evt.key == 'p' || evt.key == 'P'){
                designGizmoManager.positionGizmoEnabled = true;
                designGizmoManager.gizmos.positionGizmo.onDragStartObservable.add(function () {
                    isGizmoDragging = true;
                });
                designGizmoManager.gizmos.positionGizmo.onDragEndObservable.add(function () {
                    isGizmoDragging = false;
                });
            }

            if(evt.key == 'r' || evt.key == 'R'){
                designGizmoManager.rotationGizmoEnabled = true;
                designGizmoManager.gizmos.rotationGizmo.onDragStartObservable.add(function () {
                    isGizmoDragging = true;
                });
                designGizmoManager.gizmos.rotationGizmo.onDragEndObservable.add(function () {
                    isGizmoDragging = false;
                });
            }

            if(evt.key == 's' || evt.key == 'S'){
                designGizmoManager.boundingBoxGizmoEnabled = true;
                designGizmoManager.gizmos.boundingBoxGizmo.setEnabledRotationAxis("xyz");
                designGizmoManager.gizmos.boundingBoxGizmo.setEnabledScaling(true,true);
                designGizmoManager.gizmos.boundingBoxGizmo.onDragStartObservable.add(function () {
                    isGizmoDragging = true;
                });
                designGizmoManager.gizmos.boundingBoxGizmo.onScaleBoxDragEndObservable.add(function () {
                    isGizmoDragging = false;
                });
                designGizmoManager.gizmos.boundingBoxGizmo.onRotationSphereDragEndObservable.add(function () {
                    isGizmoDragging = false;
                });
            }
        }

        //key press : o or O - remove the gizmo attached to a mesh and do not show the bounding box
        if(evt.key == 'o' || evt.key == 'O'){
            // hide the gizmo
            designGizmoManager.attachToMesh(null);
            //if there is a current panel/ currently designing a panel, hide the bounding box
            if(currentPanel){
                if(currentPanel.showBoundingBox){
                    currentPanel.showBoundingBox = false;
                }
            }
            //if there is a current flower, hide the bounding box
            if(theCurrentFlower.obj){
                if(theCurrentFlower.obj.showBoundingBox){
                    theCurrentFlower.obj.showBoundingBox = false;
                    theCurrentFlower.obj = null;
                }
            }
            designGizmoManager.positionGizmoEnabled = true;
            designGizmoManager.boundingBoxGizmoEnabled = false;
            designGizmoManager.rotationGizmoEnabled = false;
            designGizmoManager.scaleGizmoEnabled = false;

            if(isTakePhotoStatus && homeGizmo && homeGizmo2){
                homeGizmo.attachedMesh = null;
                homeGizmo2.attachedMesh = null;
            }
            
        }

        // key press: Delete - remove the selected flower from the scene
        if(evt.key == 'Delete'){
            //if there is a current flower seleected
            if(theCurrentFlower.obj){
                //call the function to delete the currently selected flower
                delete_flower_selected(theCurrentFlower.obj);
                theCurrentFlower.obj.dispose();
                theCurrentFlower.obj = null;
                theCurrentFlower.hasParent = false;
               
            }
        }
    }
    // Start by only enabling position control
    document.onkeydown({key: 'p'})
}


//#################################################### FUNCTIONS FOR THE SCENE'S GUI #######################################################//
//function that creates the GUI for the buttons
let isTakePhotoStatus = false;
let currBtn;
function create_design_gui(){
    let advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("DesignSceneUI");
    //create simple button params: button Name, button Label
    posTool_btn = BABYLON.GUI.Button.CreateSimpleButton("PosToolBtn", "Tool: Position");
    rotTool_btn = BABYLON.GUI.Button.CreateSimpleButton("RotToolBtn", "Tool: Rotation");
    scaleTool_btn = BABYLON.GUI.Button.CreateSimpleButton("ScaleToolBtn", "Tool: Scale");
    offTool_btn = BABYLON.GUI.Button.CreateSimpleButton("OffToolBtn", "Tool: Off");
    //delTool_btn = BABYLON.GUI.Button.CreateSimpleButton("DelToolBtn", "Tool: Delete");
    delTool_btn = BABYLON.GUI.Button.CreateSimpleButton("Temp Btn", "Save");
    load_hd_world_btn = BABYLON.GUI.Button.CreateSimpleButton("hdWorldBtn", "Load More Flowers");
    // screenshot_btn = BABYLON.GUI.Button.CreateSimpleButton("ScreenshotBtn", "Take Photo");
    // reset_btn = BABYLON.GUI.Button.CreateSimpleButton("ResetPosBtn", "Reset");
    // cancel_btn = BABYLON.GUI.Button.CreateSimpleButton("ExitSSBtn", "Cancel");

    let btnWidth = canvas.width*0.04;
    let btnHeight = canvas.height*0.04;
    let fontSz = "11em";
    
    currBtn = posTool_btn;
    //button for returning the panel
   
    offTool_btn.height = btnHeight+"px";
    offTool_btn.width = btnWidth+"px";
    offTool_btn.color = "white";
    offTool_btn.alpha = 0.6;
    offTool_btn.fontSize = fontSz;
    offTool_btn.background = "green";
    // offTool_btn.verticalAlignment = 1;
    // offTool_btn.horizontalAlignment = 1;
    offTool_btn.left = canvas.width/2 - 40;
    offTool_btn.top = canvas.height/2 - 70;
    offTool_btn.isVisible = false;

    

    //return button functions
    offTool_btn.onPointerDownObservable.add(
    function(info) {
        currBtn.background = "green";
        offTool_btn.background = "red";
        currBtn = offTool_btn;
        design_handle_tool(0);
    });
    offTool_btn.onPointerUpObservable.add(
        function(info) {
            offTool_btn.background = "green";
    });
    offTool_btn.onPointerEnterObservable.add(
        function() {
            offTool_btn.background = "red";
    });
    offTool_btn.onPointerOutObservable.add(
        function() {
            offTool_btn.background = "green";

    });    
    offTool_btn.onPointerMoveObservable.add(
        function(coordinates) {
            
    }); 

    scaleTool_btn.height = btnHeight+"px";
    scaleTool_btn.width = btnWidth+"px";
    scaleTool_btn.color = "white";
    scaleTool_btn.alpha = 0.6;
    scaleTool_btn.fontSize = fontSz;
    scaleTool_btn.background = "green";
    scaleTool_btn.left = canvas.width/2 - 40;
    scaleTool_btn.top = canvas.height/2 - 30;
    scaleTool_btn.isVisible = false;
    

    //scale tool button functions
    scaleTool_btn.onPointerDownObservable.add(
    function(info) {
        currBtn.background = "green";
        scaleTool_btn.background = "red";
        currBtn = scaleTool_btn;
        design_handle_tool(3);
    });
    scaleTool_btn.onPointerUpObservable.add(
        function(info) {
            
    });
    scaleTool_btn.onPointerEnterObservable.add(
        function() {
    });
    scaleTool_btn.onPointerOutObservable.add(
        function() {

    });    
    scaleTool_btn.onPointerMoveObservable.add(
        function(coordinates) {
            
    }); 

    rotTool_btn.height = btnHeight+"px";
    rotTool_btn.width = btnWidth+"px";
    rotTool_btn.color = "white";
    rotTool_btn.alpha = 0.6;
    rotTool_btn.fontSize = fontSz;
    rotTool_btn.background = "green";
    rotTool_btn.left = canvas.width/2 - 40;
    rotTool_btn.top = canvas.height/2 - 110;
    rotTool_btn.isVisible = false;
    

    //scale tool button functions
    rotTool_btn.onPointerDownObservable.add(
    function(info) {
        currBtn.background = "green";
        rotTool_btn.background = "red";
        currBtn = rotTool_btn;
        design_handle_tool(2);
    });
    rotTool_btn.onPointerUpObservable.add(
        function(info) {
            
    });
    rotTool_btn.onPointerEnterObservable.add(
        function() {
    });
    rotTool_btn.onPointerOutObservable.add(
        function() {

    });    
    rotTool_btn.onPointerMoveObservable.add(
        function(coordinates) {
            
    }); 

    posTool_btn.height = btnHeight+"px";
    posTool_btn.width = btnWidth+"px";
    posTool_btn.color = "white";
    posTool_btn.alpha = 0.6;
    posTool_btn.fontSize = fontSz;
    posTool_btn.background = "red";
    posTool_btn.left = canvas.width/2 - 40;
    posTool_btn.top = canvas.height/2 - 150;
    posTool_btn.isVisible = false;
    

    //pos tool button functions
    posTool_btn.onPointerDownObservable.add(
    function(info) {
        currBtn.background = "green";
        posTool_btn.background = "red";
        currBtn = posTool_btn;
        design_handle_tool(1);
    });
    posTool_btn.onPointerUpObservable.add(
        function(info) {
            
    });
    posTool_btn.onPointerEnterObservable.add(
        function() {
    });
    posTool_btn.onPointerOutObservable.add(
        function() {

    });    
    posTool_btn.onPointerMoveObservable.add(
        function(coordinates) {
            
    }); 

    // delTool_btn.height = btnHeight+"px";
    // delTool_btn.width = btnWidth+"px";
    // delTool_btn.color = "white";
    // delTool_btn.alpha = 0.6;
    // delTool_btn.fontSize = fontSz;
    // delTool_btn.background = "green";
    // delTool_btn.left = canvas.width/2 - 150;
    // delTool_btn.top = canvas.height/2 - 30;
    // // delTool_btn.isVisible = false;
    

    // //pos tool button functions
    // delTool_btn.onPointerDownObservable.add(
    // function(info) {
        
    //     // console.log("PANELS : ", flowersPanelsMap, "USER CURRENTLY LOGGED IN: ", userId);
    //     save_designed_panels(userId+"_designedPanel");
    // });
    // delTool_btn.onPointerUpObservable.add(
    //     function(info) {
            
    // });
    // delTool_btn.onPointerEnterObservable.add(
    //     function() {
    // });
    // delTool_btn.onPointerOutObservable.add(
    //     function() {

    // });    
    // delTool_btn.onPointerMoveObservable.add(
    //     function(coordinates) {
            
    // }); 

    
    // screenshot_btn.height = btnHeight+"px";
    // screenshot_btn.width = btnWidth+"px";
    // screenshot_btn.color = "white";
    // screenshot_btn.alpha = 0.6;
    // screenshot_btn.fontSize = fontSz;
    // screenshot_btn.background = "green";
    // screenshot_btn.verticalAlignment = 0;
    // screenshot_btn.horizontalAlignment = 1;
    // // screenshot_btn.left = canvas.width/2 - 50;
    // // screenshot_btn.top = canvas.height/2 - 150;
    // // screenshot_btn.isVisible = false;
    

    // //pos tool button functions
    // screenshot_btn.onPointerDownObservable.add(
    // function(info) {
    //     // console.log("take screenshot");
    //     // 
    //     if(!isTakePhotoStatus){
    //         //change button color and text so the user will have the option to move the characters
    //         screenshot_btn.background = "red";
    //         screenshot_btn.textBlock.text = "Capture Now";
    //         isTakePhotoStatus = true;
    //         //set the characters to movable; tell the user that they can move RuRu and Nuvola
    //         set_char_movable();
    //         reset_btn.isVisible = true;
    //         cancel_btn.isVisible = true;
    //     }else{
    //         take_panel_screenshot();
    //         screenshot_btn.background = "green";
    //         screenshot_btn.textBlock.text = "Take Photo";
    //         isTakePhotoStatus = false;
    //         reset_btn.isVisible = false;
    //         offTool_btn.isVisible = false;
    //         cancel_btn.isVisible = false;
    //         nuvolaDesign_obj.actionManager = null;
    //         ruruDesign_obj.actionManager = null;
    //        //return nuvola and ruru to their original position?
    //     }
        
    // });
    // screenshot_btn.onPointerUpObservable.add(
    //     function(info) {
            
    // });
    // screenshot_btn.onPointerEnterObservable.add(
    //     function() {
    // });
    // screenshot_btn.onPointerOutObservable.add(
    //     function() {
    // });    
    // screenshot_btn.onPointerMoveObservable.add(
    //     function(coordinates) {
            
    // });


    // reset_btn.height = btnHeight+"px";
    // reset_btn.width = btnWidth+"px";
    // reset_btn.color = "white";
    // reset_btn.alpha = 0.6;
    // reset_btn.fontSize = fontSz;
    // reset_btn.background = "green";
    // reset_btn.verticalAlignment = 0;
    // reset_btn.horizontalAlignment = 1;
    // // screenshot_btn.left = canvas.width/2 - 50;
    // reset_btn.top = 50;
    // reset_btn.isVisible = false;
    

    // //pos tool button functions
    // reset_btn.onPointerDownObservable.add(
    // function(info) {
    //     reset_btn.background = "red";
    //     // console.log("reset the positions of the chars");
    //     ruruDesign_obj.position = new BABYLON.Vector3(59,8.5,9);
    //     ruruDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.6481,-0.3413,0.2794,0.6202);
    //     nuvolaDesign_obj.position = new BABYLON.Vector3(12.50,-8.30,55.92);
    //     nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0570,-0.4064,0.0516,0.9102);
    // });
    // reset_btn.onPointerUpObservable.add(
    //     function(info) {
    //         reset_btn.background = "green";
    // });
    // reset_btn.onPointerEnterObservable.add(
    //     function() {
    //         reset_btn.background = "red";
    // });
    // reset_btn.onPointerOutObservable.add(
    //     function() {
    //         reset_btn.background = "green";

    // });    
    // reset_btn.onPointerMoveObservable.add(
    //     function(coordinates) {
            
    // }); 

    
    // cancel_btn.height = btnHeight+"px";
    // cancel_btn.width = btnWidth+"px";
    // cancel_btn.color = "white";
    // cancel_btn.alpha = 0.6;
    // cancel_btn.fontSize = fontSz;
    // cancel_btn.background = "green";
    // cancel_btn.verticalAlignment = 0;
    // cancel_btn.horizontalAlignment = 1;
    // // screenshot_btn.left = canvas.width/2 - 50;
    // cancel_btn.top = 100;
    // cancel_btn.isVisible = false;
    

    // //pos tool button functions
    // cancel_btn.onPointerDownObservable.add(
    // function(info) {
    //     cancel_btn.background = "red";
    //     screenshot_btn.background = "green";
    //     screenshot_btn.textBlock.text = "Take Photo";
    //     isTakePhotoStatus = false;
    //     reset_btn.isVisible = false;
    //     offTool_btn.isVisible = false;
    //     cancel_btn.isVisible = false;
    //     nuvolaDesign_obj.actionManager = null;
    //     ruruDesign_obj.actionManager = null;
    // });
    // cancel_btn.onPointerUpObservable.add(
    //     function(info) {
    //         cancel_btn.background = "green";
    // });
    // cancel_btn.onPointerEnterObservable.add(
    //     function() {
    //         cancel_btn.background = "red";
    // });
    // cancel_btn.onPointerOutObservable.add(
    //     function() {
    //         cancel_btn.background = "green";

    // });    
    // cancel_btn.onPointerMoveObservable.add(
    //     function(coordinates) {
            
    // }); 


    load_hd_world_btn.height = btnHeight+"px";
    load_hd_world_btn.width = btnWidth+"px";
    load_hd_world_btn.color = "white";
    load_hd_world_btn.alpha = 0.6;
    load_hd_world_btn.fontSize = fontSz;
    load_hd_world_btn.background = "green";
    load_hd_world_btn.verticalAlignment = 0;
    load_hd_world_btn.horizontalAlignment = 1;
    load_hd_world_btn.isVisible = false;

    

    //return button functions
    load_hd_world_btn.onPointerDownObservable.add(
    function(info) {
        load_hd_world();
        load_hd_world_btn.dispose();
    });
    load_hd_world_btn.onPointerUpObservable.add(
        function(info) {
            load_hd_world_btn.background = "green";
    });
    load_hd_world_btn.onPointerEnterObservable.add(
        function() {
            load_hd_world_btn.background = "red";
    });
    load_hd_world_btn.onPointerOutObservable.add(
        function() {
            load_hd_world_btn.background = "green";

    });    
    load_hd_world_btn.onPointerMoveObservable.add(
        function(coordinates) {
            
    }); 


    //add the buttons to the gui
    advancedTexture.addControl(posTool_btn);
    advancedTexture.addControl(rotTool_btn);
    // advancedTexture.addControl(cancel_btn);
    advancedTexture.addControl(scaleTool_btn);
    advancedTexture.addControl(offTool_btn);
    // advancedTexture.addControl(screenshot_btn);
    // advancedTexture.addControl(reset_btn);
    advancedTexture.addControl(load_hd_world_btn);
    // advancedTexture.addControl(delTool_btn);
}//end of create gui function


function design_handle_tool(theGizmo){
    if(designGizmoManager){
        // console.log(mbayeGizmoManager);
        
        if(theGizmo == 0){
            // 0 - turn off gizmos
            designGizmoManager.attachToMesh(null);
            if(theCurrentFlower.obj){
                theCurrentFlower.obj.showBoundingBox = false;
                theCurrentFlower.obj = null;
                theCurrentFlower.hasParent = false;
            }
            if(isTakePhotoStatus){
                homeGizmo.attachedMesh = null;
                homeGizmo2.attachedMesh = null;
            }
        }else if(theGizmo == 2){
            //2 - change gizmo to rotation
            if(designGizmoManager.positionGizmoEnabled) designGizmoManager.positionGizmoEnabled = false;
            if(designGizmoManager.boundingBoxGizmoEnabled) designGizmoManager.boundingBoxGizmoEnabled = false;
            designGizmoManager.rotationGizmoEnabled = true;
        }else if(theGizmo == 1){
             //1- change gizmo to position
            if(designGizmoManager.boundingBoxGizmoEnabled) designGizmoManager.boundingBoxGizmoEnabled = false;
            if(designGizmoManager.rotationGizmoEnabled) designGizmoManager.rotationGizmoEnabled = false;
            designGizmoManager.positionGizmoEnabled = true;   
        }else if(theGizmo == 3){
             //3 - change gizmo to bounding box
            if(designGizmoManager.positionGizmoEnabled) designGizmoManager.positionGizmoEnabled = false;
            if(designGizmoManager.rotationGizmoEnabled) designGizmoManager.rotationGizmoEnabled = false;
            designGizmoManager.boundingBoxGizmoEnabled = true;  
        }else if(theGizmo == 4){
            //3 - change gizmo to bounding box
            if(theCurrentFlower.obj){
                //call the function to delete the currently selected flower
                delete_flower_selected(theCurrentFlower.obj);
                theCurrentFlower.obj.dispose();
                theCurrentFlower.obj = null;
                theCurrentFlower.hasParent = false;
            }
       }
    }
}//end of handle gizmo 


//#################################################### FUNCTION TO HANDLE MOUSE EVENTS #######################################################//
let isCharMovementEnabled;
function add_designScene_mouse_listener(){
      //handle the dragging behavior of the panel selected
      designScene.onPointerObservable.add((pointerInfo) => {          
        switch (pointerInfo.type) {
          case BABYLON.PointerEventTypes.POINTERUP:
                  if(pointerInfo.pickInfo.hit && mbayePanelsMap.has(pointerInfo.pickInfo.pickedMesh.name) && !isPanelRotationActive) {
                      // If handling drag events manually is desired, set move attached to false
                    panelPointerDragBehavior.enabled = true;
                    panelPointerDragBehavior.moveAttached = true;

                    // Use drag plane in world space
                    panelPointerDragBehavior.useObjectOrienationForDragging = false;
                    panelPointerDragBehavior.dragDeltaRatio = 0.2;
                    panelPointerDragBehavior.attach(pointerInfo.pickInfo.pickedMesh);


            

                      // add double click event listener to the panel
                      pointerInfo.pickInfo.pickedMesh.actionManager = new BABYLON.ActionManager(designScene);
                      pointerInfo.pickInfo.pickedMesh.actionManager
                          .registerAction(
                                new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnDoublePickTrigger,
                                returnPanel)
                          );
                  }//eof if

                  if(pointerInfo.pickInfo.hit &&  (pointerInfo.pickInfo.pickedMesh === ruruDesign_obj || pointerInfo.pickInfo.pickedMesh === nuvolaDesign_obj) && designScene.activeCamera === designCamera && isCharMovementEnabled) {
                    // If handling drag events manually is desired, set move attached to false
                    charPointerDragBehavior.enabled = true;
                    charPointerDragBehavior.moveAttached = true;

                    // Use drag plane in world space
                    charPointerDragBehavior.useObjectOrienationForDragging = false;
                    charPointerDragBehavior.dragDeltaRatio = 0.2;
                    charPointerDragBehavior.attach(pointerInfo.pickInfo.pickedMesh);


                }//eof if
          break;
          }
      });
      
    

      let onPointerDownDesign = function (evt) {
          if (evt.button !== 0) {
              return;
          }
          if(evt.button === 2){
              if(designScene.activeCamera === focusCamera){
                  focusCamera.attachControl(canvas,true);
              }
          }
          if(designScene && evt.button === 0 ){
            //get the pick info if mouse is pressed
              let pickInfo = designScene.pick(designScene.pointerX, designScene.pointerY);
              
        
              //check if the clicked mesh should be draggable/modified
              if (pickInfo.hit) {
                //global var for tracking the current mesh clicked
                theDesignMesh = pickInfo.pickedMesh;              
                console.log("the mesh clicked: ", theDesignMesh.name, theDesignMesh.position, theDesignMesh.rotationQuaternion);  

                //check if the mesh clicked is a flower from the book of flowers
                let isFlower = check_if_mesh_is_flower(theDesignMesh);
            
                //if the mesh clicked is a panel from mbaye (not yet in design a panel view)
                if(designScene.activeCamera === designCamera && !isFlower && mbayePanelsMap.has(theDesignMesh.name)){
                    //if the mesh clicked is a panel, detach earthFLowerCamera control
                      earthFlowersCamera.detachControl(canvas);
                      //if the panel clicked is not the current panel, set the clicked panel as the current panel
                      if(currentPanel==null || theDesignMesh!=theCurrentPanel.obj)  set_current_panel(theDesignMesh);
                      isPanelMeshClicked = true;
                }//end of if a panel is clicked from Mbaye

                if(designScene.activeCamera === designCamera && isTakePhotoStatus){
                    if(theDesignMesh === ruruDesign_obj || theDesignMesh === nuvolaDesign_obj){
                        homeGizmo.attachedMesh = theDesignMesh;
                        homeGizmo2.attachedMesh = theDesignMesh;
                        offTool_btn.isVisible = true;
                    }
                }

                if(designScene.activeCamera === panelCamera && theDesignMesh === ruruDesign_obj){
                   // console.log("return the panel and then save the game");
                   
                    Swal.fire({
                        title: 'Are you sure you want to save your current game progress?',
                        text: "This will overwrite your current progress!",
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: '10vw',
                        imageHeight: 'auto',
                        imageAlt: 'Warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, save it!',
                        width: '20%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)',
                    }).then((result) => {
                        if (result.value) {
                            returnPanelViaButton();
                            isRuruClicked = true;
                        }
                    });
                    //removed the 2 lines below for testing
                   
                }

                //if the user has clicked anything from the book of flowers
                if(bookFlowersMap.has(theDesignMesh.name)){
                    if(theDesignMesh.name === "wood" || theDesignMesh.name == "Object072") remove_book_of_flowers();        //if the middle wood is clicked
                    else if(theDesignMesh.name =="postTop_primitive0" || theDesignMesh.name =="postTop_primitive1") focus_on_panel();
                    else if(theDesignMesh.name =="postBottom_primitive0"  || theDesignMesh.name =="postBottom_primitive1") returnPanelViaButton();  
                    else if(theDesignMesh.name =="wood001_primitive0"  || theDesignMesh.name =="wood001_primitive1") take_panel_screenshot();
                }//end of if book of flowers
                
                //for the movement of the flower / arrangement to the panel; if the clicked mesh is a flower
                if(isFlower && !isGizmoDragging){
                    //disable earthflower object's movement by disabling the scene's camera
                    earthFlowersCamera.detachControl(canvas);
                    earthFlowersCamera.setEnabled(false);
                    //if the clicked mesh is not the current flower active
                    if(theCurrentFlower.obj != theDesignMesh){  //if the current mesh selected is not the current flower active
                        if(theCurrentFlower.obj) theCurrentFlower.obj.showBoundingBox = false;
                        theCurrentFlower.hasParent = false;
                        theCurrentFlower.obj = theDesignMesh;                       //set the flower is the current flower
                        theCurrentFlower.obj.showBoundingBox = true;
                        designGizmoManager.attachToMesh(theDesignMesh);
                    }
                  }//end of if flower is clicked

                //check if the flower clicked is a version of a flower if the book of flowers is active
                if(isBookFlowersActive){
                    earthFlowersCamera.detachControl(canvas);
                    let isFlowerVariety = check_if_mesh_is_flower_variety(theDesignMesh);
                    if(isFlowerVariety && flowerSelectionCount < MAX_NUM_FLOWERS) create_black_flower_copy(theDesignMesh);  
                }//end of if book of flowers active
            }//end of pick info hit
        }//end of if there is a design Scene
    }//end of on pointer down function

    //on mouse pointer up
    let onPointerUpDesign = function (evt) {
        isPanelMeshClicked = false;
    }//end of on pointer up function

    let onPointerMoveDesign = function (evt) {  
        //on pointer movement, check if there is a current panel set and if the the onpointerdown is triggered
        if(isPanelMeshClicked && currentPanel){
            //compute for changes in x, y, z / distance from original pos
            let deltaX = Math.abs(currentPanel.position.x - panelInitPos.x);
            let deltaY = Math.abs(currentPanel.position.y - panelInitPos.y);
            let deltaZ = Math.abs(currentPanel.position.z - panelInitPos.z);
    
            //if abs distance of panel from its orig position is > 10
            if((deltaX>=8 || deltaY>=8 || deltaZ >= 8) && !isStartOfDesignPanel){
                set_current_panel_to_location();
            }//end of delta x , y, z
        }else return; //end of if current panel is set and pointer down is observed            
    }//end of on pointer move function

    canvas.addEventListener("pointerdown", onPointerDownDesign, false);
    canvas.addEventListener("pointerup", onPointerUpDesign, false);
    canvas.addEventListener("pointermove", onPointerMoveDesign, false);

    designScene.onDispose = function() {
        //related to the drag and drop
        canvas.removeEventListener("pointerdown", onPointerDownDesign);
        canvas.removeEventListener("pointerup", onPointerUpDesign);
        canvas.removeEventListener("pointermove", onPointerMoveDesign);
    };

   


    //related to the panel rotation
    designScene.beforeRender = function () {
      //set mousemov as false everytime before the rendering a frame
      mousemov = false;
    }

    designScene.afterRender = function () { 
      //we are checking if the mouse is moved after the rendering a frame
      //will return false if the mouse is not moved in the last frame
      //possible drop of 1 frame of animation, which will not be noticed 
      //by the user most of the time
      if (!mousemov && framecount <mxframecount && currentPanel) {
        //divide the lastAngleDiff to slow or ease the animation
        lastAngleDiff.x = lastAngleDiff.x / 1.1;
        lastAngleDiff.y = lastAngleDiff.y / 1.1;
        //apply the rotation
        currentPanel.rotation.x += lastAngleDiff.x;
        currentPanel.rotation.y += lastAngleDiff.y
        //increase the framecount by 1
        //this doesnt make sense right now as it resets
        framecount++;
        currentRotation.x = currentPanel.rotation.x;
        currentRotation.y = currentPanel.rotation.y;
      } else if(framecount>=mxframecount) {
        framecount = 0;
      }
    };
}//end of mouse listener


function set_current_panel_to_location(){
        
        //detach control of design and earth flower camera
        designCamera.detachControl(canvas);
        earthFlowersCamera.detachControl(canvas);

        //if ruru doesnt have pointer event hander yet, assign 
        if(!ruruDesign_obj.actionManager) add_action_mgr(ruruDesign_obj);
        
        isAnimatePanelOn = true;

        //disable the dragging behavior of the panel if the distance is reached
        panelPointerDragBehavior.releaseDrag();
        panelPointerDragBehavior.detach();
        panelPointerDragBehavior.enabled = false;
        panelPointerDragBehavior.moveAttached = false;
        
        panelCamera = new BABYLON.ArcRotateCamera("Panel Camera",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),130.0, new BABYLON.Vector3(0,0,0),designScene);
        panelCamera.detachControl(canvas);
        panelCamera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
        panelCamera.fov = panelCameraDesignFOV;


        
    
        //enable panel rotation and set the start of design panel from here
        isPanelRotationActive = true;
        isStartOfDesignPanel = true;
        
        //if the current panel dragged is not yet in the desired flower arranging position;
        if(!isCurrentPanelInLocation){
            setTimeout(function(){
                //set the buttons to active
                posTool_btn.isVisible = true;
                rotTool_btn.isVisible = true;
                scaleTool_btn.isVisible = true;
                offTool_btn.isVisible = true;
                // delTool_btn.isVisible = true;
                // screenshot_btn.isVisible = false;
                load_hd_world_btn.isVisible = true;
                //get and set the current panel's initial rotation for when the panel is returned back to Mbaye
                // let temp = mbayePanelsPosRotMap.get(currentPanel.name);
                // let rot = temp[1];
                // panelInitRot = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);;
                panelInitRot = currentPanel.rotationQuaternion;

                //make the world of flowers visible
                earthFlowers_object.setEnabled(true);
                earthFlowers_object.isVisible = true;

                //the current active camera is the panel camera
                designScene.activeCamera = panelCamera;
                panelCamera.target = new BABYLON.Vector3(0,7 ,20);
                panelCamera.viewport = new BABYLON.Viewport(0, 0, 1, 1);

                
                //normalize the scaling for panel scaling while designing the panel
                let x = Math.abs(currentPanel.scaling.x);
                let y = Math.abs(currentPanel.scaling.y);
                let z = Math.abs(currentPanel.scaling.z);
                //currentPanel.scaling = new BABYLON.Vector3(x,y,z);
                
                //set the world of flower's camera location and radius
                earthFlowersCamera.position = new BABYLON.Vector3(-48,24,84);
                earthFlowersCamera.radius = earthCameraDesignRadius;

                set_chars_position(2);
                set_clouds_position(2);
                

                isDesignSceneActive = true;
                // enable_home_gizmo2(currentPanel);

                //set panel flowers to pickable and setup the design a panel scene
                set_flowers_to_pickable();
                start_design_setup();
                // earthFlowersScene.debugLayer.show();

                //hide the take screenshot for main view icon
                $('#takeScreenshotMain').hide();
            }, 1000);
            isCurrentPanelInLocation = true;
        }//end of if in location
}

function start_design_setup(){
        if(!flowersPanelsMap.has(currentPanel)) flowersPanelsMap.set(currentPanel, new Map());
        
        panelCamera.radius = 500;

        mbayeDesign_object.position = new BABYLON.Vector3(64.66,4.58, 22.55);
        // mbayeDesign_object.position = new BABYLON.Vector3(326.13,24.23, 113.003);
       
        mbayeDesign_object.rotationQuaternion = new BABYLON.Quaternion(0.0017,0.9674,-0.0057,0.2530);
        mbayeDesign_object.scaling = new BABYLON.Vector3(1.25,1.25,1.25);
       
        currentPanel.position = currentPanelPos;
        // temp_gizmo(currentPanel);
        // currentPanel.position = currentPanelDesignPos.get(0);
        // currentPanel.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(180),0);
        currentPanel.rotation = new BABYLON.Vector3(-0.9158, 1.8938,0);
        isAnimatePanelOn = false;
        isPanelMovementDone = true;                         //let to indicate that panel is done moving away from Mbaye to the design location

        if(camera2){
            camera2.dispose();
            camera2 =  new BABYLON.ArcRotateCamera("Screenshot",BABYLON.Tools.ToRadians(25),BABYLON.Tools.ToRadians(85),105.0, new BABYLON.Vector3(0,0,0),designScene);
        }
        let pos = panelCamera.position;
        camera2.position = new BABYLON.Vector3(pos.x+15,pos.y,pos.z+10);
        camera2.setTarget(currentPanel);
        camera2.radius = 20;
        
       
        // panelCamera.attachControl(canvas,true);
        
        
}

function listen_to_panel_rotation(){
        let onPointerDownRotate = function (evt) {
        if (evt.button !== 0) {
            return;
        }
        //get the pick info if mouse is pressed
        let pickInfo = designScene.pick(designScene.pointerX, designScene.pointerY);
       
        //check if the clicked mesh should be draggable/modified
        if (pickInfo.hit) {
            if(isStartOfDesignPanel){
                    let thePanel =  pickInfo.pickedMesh;
                      if(currentPanel && currentPanel === thePanel){
                          currentPosition.x = evt.clientX;
                          currentPosition.y = evt.clientY;
                          currentRotation.x = currentPanel.rotation.x;
                          currentRotation.y = currentPanel.rotation.y;
                          isZoomPanelActive = true;
                        //   isCurrPanelClicked = true;
                          if(!isGizmoDragging){
                              isCurrPanelClicked = true;
                          }else isCurrPanelClicked = false;
                          
                      }
            }
        }//end of pick info hit
    }//end of on pointer down function

    //on mouse pointer up
    let onPointerUpRotate = function () {
        isCurrPanelClicked = false;
       
    }//end of on pointer up function

    let onPointerMoveRotate = function (evt) {  
        //on pointer movement, check if there is a current panel set and if the the onpointerdown is triggered
        if(isStartOfDesignPanel && isCurrPanelClicked){
            if(panelCamera) panelCamera.detachControl(canvas);
            // earthFlowersCamera.detachControl(canvas);
            if(isCurrPanelClicked) {
              //set mousemov as true if the pointer is still down and moved
              mousemov = true;
              earthFlowersCamera.detachControl(canvas);
            }
            if (!isCurrPanelClicked) {
                return;
            }
            //set last angle before changing the rotation
            if(currentPanel &&  isStartOfDesignPanel){
                  oldAngle.x = currentPanel.rotation.x;
                  oldAngle.y = currentPanel.rotation.y;
                  //rotate the mesh
                  currentPanel.rotation.y += (evt.clientX - currentPosition.x) / 300.0;
                  currentPanel.rotation.x += (evt.clientY - currentPosition.y) / 300.0;
                  //set the current angle after the rotation
                  newAngle.x = currentPanel.rotation.x;
                  newAngle.y = currentPanel.rotation.y;
                  //calculate the anglediff
                  lastAngleDiff.x = newAngle.x - oldAngle.x;
                  lastAngleDiff.y = newAngle.y - oldAngle.y;
                  currentPosition.x = evt.clientX;
                  currentPosition.y = evt.clientY;
            }     
        }          
    }//end of on pointer move function

    canvas.addEventListener("pointerdown", onPointerDownRotate, false);
    canvas.addEventListener("pointerup", onPointerUpRotate, false);
    canvas.addEventListener("pointermove", onPointerMoveRotate, false);

    designScene.onDispose = function() {
        //related to the drag and drop
        canvas.removeEventListener("pointerdown", onPointerDownRotate);
        canvas.removeEventListener("pointerup", onPointerUpRotate);
        canvas.removeEventListener("pointermove", onPointerMoveRotate);
    };
}

//function that enables zoom in/out of panel when using the mouse wheelscroll
function listen_to_wheelscroll(){
    if(designScene){
      designScene.onPrePointerObservable.add( function(pointerInfo, eventState) {
          if(currentPanel && (designScene.activeCamera == panelCamera || designScene.activeCamera == focusCamera) ){
             panelCamera.detachControl(canvas);
             focusCamera.detachControl(canvas);
              let event = pointerInfo.event;
              let delta = 0;
              if (event.wheelDelta) {
                  delta = event.wheelDelta;
              }
              else if (event.detail) {
                  delta = -event.detail;
              }

              if (delta && isZoomPanelActive) {
                  let x = currentPanel.scaling.x;
                  let y = currentPanel.scaling.y;
                  let z = currentPanel.scaling.z;
                 
                  if(delta < 0){
                    if(currentPanel.scaling.x > 0.5 ) currentPanel.scaling = new BABYLON.Vector3(x-0.05,y-0.05,z-0.05);
                    else if(currentPanel.scaling.x > 0.004 && currentPanel.scaling.x < 0.03) currentPanel.scaling = new BABYLON.Vector3(x-0.001,y-0.001,z-0.001);
                  }else{
                    if(currentPanel.scaling.x < 2 && currentPanel.scaling.x > 0.4) currentPanel.scaling = new BABYLON.Vector3(x+0.05,y+0.05,z+0.05);
                    else if(currentPanel.scaling.x < 0.028 ) currentPanel.scaling = new BABYLON.Vector3(x+0.001,y+0.001,z+0.001);
                    
                
                  }
              }
          }//end of if current panel
         
      }, BABYLON.PointerEventTypes.POINTERWHEEL, false);



     
  }
}//end of listen to wheel scroll function


function add_action_mgr(theObj){
    theObj.actionManager = new BABYLON.ActionManager(designScene);
    theObj.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverChar
        )
    );
    theObj.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutChar
        )
    );
}

let charLabel;
var onOverChar =(meshEvent)=>{
    
    if(designScene.activeCamera === designCamera && isCharMovementEnabled){ 
        // console.log("over: ", meshEvent.source.name);
        // overHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0.7,0.4,0.1));
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0.2,0.2,0.2);
        if(meshEvent.source.name === "Mermaid_Body_Rev"){
            meshEvent.source.material.subMaterials[0].emissiveColor = new BABYLON.Color3(0.2,0.2,0.2);
            meshEvent.source.material.subMaterials[1].emissiveColor = new BABYLON.Color3(0.2,0.2,0.2);
        }
    }

    if(designScene.activeCamera === panelCamera && meshEvent.source === ruruDesign_obj){                                               //hover on ruru during design a panel part
        let partTooltip = document.createElement("span");
        partTooltip.setAttribute("id", "partTooltip");
        var sty = partTooltip.style;
        sty.position = "absolute";
        // sty.lineHeight = "1.2em";
        sty.paddingLeft = "0.5%";
        sty.paddingRight = "0.5%";
        sty.color = "#00BFFF";
        sty.fontFamily = "Courgette-Regular";
        // sty.backgroundColor = "#0b91c3a3";
        // sty.opacity = "0.7";
        sty.fontSize = "2em";
        sty.top = designScene.pointerY + "px";
        sty.left = (designScene.pointerX+20) + "px";
        sty.cursor = "pointer";
        // sty.borderRadius = "30px";
        document.body.appendChild(partTooltip);
        partTooltip.textContent = "Save Game";
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0.4,0.4,0.4);
        // overHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0.7,0.4,0.1));
    }

    if(bookFlowersMap.has(meshEvent.source.name)){
        overHighlight.addMesh(meshEvent.source, new BABYLON.Color3(0,0.3,0));
    }
};

//handles the on mouse out event
var onOutChar =(meshEvent)=>{
    if(designScene.activeCamera === designCamera && isCharMovementEnabled){
        // overHighlight.removeMesh(meshEvent.source);
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,0,0);
        if(meshEvent.source.name === "Mermaid_Body_Rev"){
            meshEvent.source.material.subMaterials[0].emissiveColor = new BABYLON.Color3(0,0,0);
            meshEvent.source.material.subMaterials[1].emissiveColor = new BABYLON.Color3(0,0,0);
        }
    }else{
        overHighlight.removeMesh(meshEvent.source);
        meshEvent.source.material.emissiveColor = new BABYLON.Color3(0,0,0);
    }

    while (document.getElementById("partTooltip")) {
        document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }

};





















/* ######################################################### END OF MOUSE EVENTS ####################################################################### */

function animate_ruru_speech(){
    let i=0;
    setInterval(function(){
        if(i<8 && isStartRuruSpeech2){
            ruruSpeech2.setEnabled(true);
            ruruSpeech2.isVisible = true;
            ruruSpeech3.setEnabled(false);
            ruruSpeech3.isVisible = false;
        }else if(i>=8 && i<15 && isStartRuruSpeech2){
            ruruSpeech2.setEnabled(false);
            ruruSpeech2.isVisible = false;
            ruruSpeech3.setEnabled(true);
            ruruSpeech3.isVisible = true;
        }else i=0;
        i++;
    }, 1000);
}


function set_chars_position(viewNo){
    if(viewNo === 1){   //if initial view
        nuvolaDesign_obj.position = new BABYLON.Vector3(12.50,-8.30,55.92);
        nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0570,-0.4064,0.0516,0.9102);
        ruruDesign_obj.position = new BABYLON.Vector3(59,8.5,9);
        ruruDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.6481,-0.3413,0.2794,0.6202);
    }else if(viewNo === 2){
        nuvolaDesign_obj.position = new BABYLON.Vector3(354.72, -0.45, 163.23);
        nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0585,-0.4413,0.0794,0.8910);
        ruruDesign_obj.position = new BABYLON.Vector3(401.08,38.04,114.31);
        ruruDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.6671,-0.3473,0.1862,0.6314);
    }else{
        nuvolaDesign_obj.position = new BABYLON.Vector3(562.69,52.97,6.62);
        nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0304,-0.9951, -0.0841,0.0099);
        
        
    }
}

function set_clouds_position(viewNo){
    if(viewNo === 1){   //if initial view
        // ruruSpeechCloud.position = new BABYLON.Vector3(48.50,19.5,12.15);
        // ruruSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.1210,0.6063,-0.08125,0.7816);

        // nuvolaSpeechCloud.position = new BABYLON.Vector3(18,8.5,60);
        // nuvolaSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.0331,0.6358,-0.0283,0.7705);
        ruruSpeechCloud.isVisible = false;
        ruruSpeechCloud.setEnabled(false);
        nuvolaSpeechCloud.isVisible = false;
        nuvolaSpeechCloud.setEnabled(false);

        ruruSpeech2.isVisible = false;
        ruruSpeech2.setEnabled(false);

        nuvolaSpeech2.isVisible = false;
        nuvolaSpeech2.setEnabled(false);

        ruruSpeech3.isVisible = false;
        ruruSpeech3.setEnabled(false);

        nuvolaSpeech3.isVisible = false;
        nuvolaSpeech3.setEnabled(false);

        isStartRuruSpeech2 = false;

    }else if(viewNo === 2){
         //set position and rotation of nuvola's speech cloud
        nuvolaSpeechCloud.position = new BABYLON.Vector3(386.64,17.46,156.72);
        nuvolaSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.0403,0.6396, -0.0343,0.7667);

        ruruSpeechCloud.position = new BABYLON.Vector3(394.43,49.3,115.14);
        ruruSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.0606,0.5774,-0.0598,0.8119);

        ruruSpeechCloud.isVisible = true;
        ruruSpeechCloud.setEnabled(true);
        nuvolaSpeechCloud.isVisible = true;
        nuvolaSpeechCloud.setEnabled(true);


        //hide the first speeches of ruru and nuvola
        // ruruSpeech.isVisible = false;
        // ruruSpeech.setEnabled(false);

        // nuvolaSpeech.isVisible = false;
        // nuvolaSpeech.setEnabled(false);

        //show the 2nd speeches of ruru and nuvola
        ruruSpeech2.isVisible = true;
        ruruSpeech2.setEnabled(true);

        nuvolaSpeech2.isVisible = true;
        nuvolaSpeech2.setEnabled(true);
    }else if(viewNo === 3){
        nuvolaSpeechCloud.position = new BABYLON.Vector3(519.04,50.53,73.52);
        nuvolaSpeechCloud.rotationQuaternion = new BABYLON.Quaternion(0.1268,-0.1632,-0.0212,0.9780);

        nuvolaSpeech3.isVisible = true;
        nuvolaSpeech3.setEnabled(true);
        
    }
}



let isTrevorFirstAppear = true;
function set_char_movable(isScreenshotActive){
    if(isScreenshotActive){
        add_action_mgr(nuvolaDesign_obj);
        add_action_mgr(ruruDesign_obj);
    
        isCharMovementEnabled = true;

        //hide the clouds of RuRu and Nuvola
        ruruSpeechCloud.isVisible = false;
        ruruSpeechCloud.setEnabled(false);

        nuvolaSpeechCloud.isVisible = false;
        nuvolaSpeechCloud.setEnabled(false);

        //show trevor's message
        if(isTrevorFirstAppear){
            Swal.fire({
                width: '10vw',
                padding: '3em',
                background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                title: '\n\n\n\nHi! Take a good photo of your panel on Mbaye! You can reposition RuRu and Nuvola as you wish! Click the "Capture Now" to take a screenshot.',
                width:100,
                showConfirmButton: false,
                position: 'top-end',
                customClass: {
                    popup: 'trevor-popup-class',
                }
            });
            isTrevorFirstAppear = false;
        }else{
            Swal.fire({
                width: '10vw',
                padding: '3em',
                title: 'Try to click and drag RURU or NUVOLA anywhere in the page.',
                background: 'rgba(8, 64, 147, 0.6)',
                showConfirmButton: false,
                position: 'top-end',
                showClass:{
                    backdrop: 'swal2-backdrop-hide',
                },
                width: 100,
                // timer: 3000,
                customClass: {
                    popup: 'screenshot-popup-class',
                }
            });
        }
        
    }else{
        //remove the action manager from the characters
        nuvolaDesign_obj.actionManager = null;
        ruruDesign_obj.actionManager = null;
    }
}




//functiont o set panel's list of flowers
let objectUrl;

function set_panel_children(flowers){
    let children = new Map();
    // console.log("flowers imported: ", flowers);
    if(flowers){
        for(let i=0;i<flowers.length;i++){
            children.set(flowers[i].uniqueId, flowers[i]);
        }
    }
    return children;
}




function load_saved_game(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "storage/saveState/designPanel/", load_filename, designScene).then(function (result) {
            // console.log("user panels: ", user_panels);
            for(let i=0;i<result.meshes.length;i++){
                if(mbayePanelsMap.has(result.meshes[i].name)){
                    // console.log(result.meshes[i].name, result.meshes[i]);
                    result.meshes[i].setParent(mbayeDesign_object);
                    if(mbayePanelsMap.get(result.meshes[i].name) !== null)  mbayePanelsMap.get(result.meshes[i].name).dispose();
                    result.meshes[i].isPickable = true;
                    mbayePanelsMap.set(result.meshes[i].name, result.meshes[i]);
                   
                   
                    let children = set_panel_children(result.meshes[i]._children);
                    flowersPanelsMap.set(result.meshes[i], children);

                    // console.log("mbayePanelsMap: ",mbayePanelsMap);
                    // console.log("flowersPanelsMap: ",flowersPanelsMap);
                }
            }
        }),
        
    ]).then(() => {
       
    });
}



function save_designed_panels(filename) {
    designCamera.detachControl(canvas);
    var serializedMesh;       
    let savedFlowersList = {};
    var meshes_to_save = {                       
        "materials": [],                        
        "geometries":    {    
            "boxes":[],                                            
            "spheres":[],                                            
            "cylinders":[],                                            
            "toruses":[],                                            
            "grounds":[],                                            
            "planes":[],                                            
            "torusKnots":[],                                            
            "vertexData":[]                        
        },                        
        "meshes": []            
    };  

    // console.log("save current progress",flowersPanelsMap);
    if(objectUrl) {
        window.URL.revokeObjectURL(objectUrl);
    }

    
    for (const [panel,val] of flowersPanelsMap.entries()) {
        // console.log("thepanel:", panel.name,val,val.size);
        if(val.size>0){
            serializedMesh = BABYLON.SceneSerializer.SerializeMesh(panel,false,true);    
            for (let i=0;i<serializedMesh["meshes"].length;i++) { 
                meshes_to_save["materials"].push(serializedMesh["materials"][i]);            
                meshes_to_save["geometries"]["vertexData"].push(serializedMesh["geometries"]["vertexData"][i]);   
                meshes_to_save["meshes"].push(serializedMesh["meshes"][i]);  
            } 
        }
    }

    for (const [panel,val] of flowersPanelsMap.entries()) {
        // console.log("PANEL NAME: ", panel.name);
        if(modified_panels_list.has(panel.name)){
            let temp = [];
           
                for(const a of val.values()){
                    temp.push(a.name);
                }
          
            if(temp.length == 0) temp = "0";
            
           savedFlowersList[panel.name] = temp;
        }
        // if(val.size<0) flowersPanelsMap.delete(panel);
    }


    // console.log("modified flowers list: ", modified_panels_list);
    // console.log("saved flowers list: ", savedFlowersList);
    var strMesh = JSON.stringify(meshes_to_save);
    
   
    var blob = new Blob ( [ strMesh ], { type : "octet/stream" } );
    if (filename.toLowerCase().lastIndexOf(".babylon") !== filename.length - 8 || filename.length < 9){
        filename += ".babylon";
    }

    if(blob){
        $.ajax({
            type: "POST",
            url:urlDesignPanel,
            data:{
                uid: userId,
                designPath:userId+"_designedPanel.babylon",
                babylonFile:strMesh,
                flowersList:savedFlowersList,
                _token:token
            },
            success: function(result){
                Swal.fire({
                    width: '10vw',
                    padding: '3em',
                    background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                    title: '\n\n\n\nYour progress has been saved.',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000,
                    customClass: {
                      popup: 'trevor-popup-class',
                    }
                  });
            
                designCamera.attachControl(canvas,true);
                savedFlowersList = {};
                is_design_saved = true;
            },
            error: function(result){
                Swal.fire({
                    width: '10vw',
                    padding: '3em',
                    background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                    title: '\n\n\n\nOops...something went wrong. Your progress was not saved.',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000,
                    customClass: {
                        title: 'error-title-class',
                        popup: 'trevor-popup-class',
                    },
                });
            }
        });
    }
    

    // var blob = new Blob ( [ strMesh ], { type : "octet/stream" } );

    // // turn blob into an object URL; saved as a member, so can be cleaned out later
    // objectUrl = (window.webkitURL || window.URL).createObjectURL(blob);

    // var link = window.document.createElement('a');
    // link.href = objectUrl;
    // link.download = filename;
    // var click = document.createEvent("MouseEvents");
    // click.initEvent("click", true, false);
    // link.dispatchEvent(click);          
}




var viewport_init_specs = new Map([
    [1,{'designCamRadius':158, 'earthCamRadius':180,'panelCamFOV':1.2, 'focusCamFOV':1.2}],
    [2,{'designCamRadius':150, 'earthCamRadius':200,'panelCamFOV':1.2, 'focusCamFOV':1.2}],
    [3,{'designCamRadius':142, 'earthCamRadius':180,'panelCamFOV':1.25, 'focusCamFOV':1.25}],
    [4,{'designCamRadius':140.5, 'earthCamRadius':140,'panelCamFOV':1.3, 'focusCamFOV':1.3}],
    [5,{'designCamRadius':120, 'earthCamRadius':140,'panelCamFOV':1.4, 'focusCamFOV':1.4}],
    [6,{'designCamRadius':134, 'earthCamRadius':120,'panelCamFOV':1.5, 'focusCamFOV':1.5}],
]);


//set the intital camera specs based on viewport
function set_camera_viewport_specs(num){
    let val;
    if(viewport_init_specs.has(num)) val = viewport_init_specs.get(num);
    designCamera.radius = val.designCamRadius;
    earthCameraDesignRadius = val.earthCamRadius;
    panelCameraDesignFOV = val.panelCamFOV;
    focusCameraDesignFOV = val.focusCamFOV;
}













//#################################################### THE MAIN GAME ENGINE #######################################################//
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true });
engine.enableOfflineSupport = true;
//create the scene
var flowerScene = create_earth_flower_scene();
var currentScene = create_design_scene();


let isFlowerRemoved = false;
// let isViewportCameraSet = false;
let panelCameraDesignRadius = 500;
let earthCameraDesignRadius = 140;
let panelCameraDesignFOV = 1.4;                                                 //the default fov of panel camera
let focusCameraDesignFOV = 1.4;                                                 //the default fov of focus camear
let focusCameraBookPosition = new BABYLON.Vector3(469.28,23.98,144.33);         //the book position for focuscameraFOV = 1.4s
let isProgressLoaded = false;
let isStartRuruSpeech2 = false;


currentScene.executeWhenReady(function () { 
    //remove loading screen display
    $('#loadingScreenOverlay').show();
    $('#loadingScreenPercent').html("Loading: 100 %");      
    loadCounter = 100;


    //scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(currentScene, options);

    //if there's an existing saved game
    if(has_load_game && !isProgressLoaded && isMbayeModelReady){
        load_saved_game();
        isProgressLoaded = true;
    }
    
    //set the initial view of the scene depending on the size of screen
    if(viewportAR){
        if(viewportAR >= 1.2 && viewportAR <= 1.3){
            set_camera_viewport_specs(1);
        }
        //for aspect ratio (w:h): 3:4 and 3:2; ipad pros, ipad minis, ipad air; 768x1024
        else if(viewportAR >= 1.31 && viewportAR <= 1.43){
            set_camera_viewport_specs(2);
        // for aspect ratio (w:h) 5:8; 800x1280; 604x966; 600x960; 320x480 (iphone 4 4s) samsung galaxy tabs, asus nexus    
        }else if(viewportAR >= 1.44 && viewportAR <= 1.65){             
            set_camera_viewport_specs(3);
        // for 768x1366 and 720x1280 and 600x1024; 480x800; 414x736; 360x640; 320x568; 432x768 (lumia); viewport size; microsoft surface, microsoft pro, microsoft pro 2, galaxy tab 2
        }else if(viewportAR >= 1.66 && viewportAR <= 1.79){             
            set_camera_viewport_specs(4);
        //360x740 (galaxy s phones); 375x812 (iphone X); 393x786 (xiaomi redmi note5)
        }else if(viewportAR >= 1.8 && viewportAR <= 2.1){             
            set_camera_viewport_specs(5);
        }else if(viewportAR > 2.1 && viewportAR <= 2.2){
            set_camera_viewport_specs(6);
        }
    }


    
    
    engine.runRenderLoop(function () {

        if(currentScene){

            /*
            if(has_load_game && !isProgressLoaded && isMbayeModelReady){
                // console.log("THERE IS SAVED PROGESS");
                load_saved_game();
                isProgressLoaded = true;
            }
            */
            
            // if(mbayeDesign_object) console.log("mbaye : ",mbayeDesign_object.position, mbayeDesign_object.rotationQuaternion);
            // if(designCamera && !isViewportCameraSet){
            //     //change camera's radius depending on the viewport size
            //     //for 1280 x 991 [ Tablet/iPad Breakpoint 991px ]
            // }   


            // if( isWorldFlowersReady && isMbayeModelReady && isBookFlowerReady){
                
            //     if (worldLoadedPercent==100){
            //         document.getElementById("loadingScreenOverlay").style.display = "block";
            //         document.getElementById("loadingScreenPercent").innerHTML = "Loading: 100 %";            
            //         designCamera.attachControl(canvas,true);
            //         isWorldFlowersReady = false;
            //         i = 100;
            //     }
                
            // }

            //return the panel to Mbaye; if the current active camera is the panel camera and the panel camera should start moving
            if(currentScene.activeCamera === panelCamera && isPanelCameraMoving){
                //subtract radius of panel camera to enable zooming effect
                if(panelCamera.radius >85){
                    panelCamera.radius -= 5; 
                }    //zoom In to Mbaye
                else{
                    currentScene.activeCamera = designCamera;
                    
                    isPanelCameraMoving = false;                    //set to false to exit the game loop
                    isPanelMovementDone = false;                    //disable rotation gui after panel is returned to mbaye
                    isCurrentPanelInLocation = false;               //set to false because current panel is returned to mbaye
                    if(isRuruClicked){
                        setTimeout(function(){
                            save_designed_panels(userId+"_designedPanel");
                        },1000);
                    }
                    isRuruClicked = false;
                }                  
            }

            //if there is a current panel and a current flower and it's the start of design a panel
            if(currentPanel && theCurrentFlower.obj && isStartOfDesignPanel){

            

                // if flower's parent is not yet set, check if it has intersected the panel
                if(theCurrentFlower.obj.intersectsMesh(currentPanel, true)){
                    //if the current flower does not have parent and intersects the current panel, add the panel to the parent
                    if(!theCurrentFlower.obj.parent &&  !theCurrentFlower.hasParent){
                        let scale = theCurrentFlower.obj.scaling;
                        theCurrentFlower.obj.scaling = scale;
                        theCurrentFlower.obj.setParent(currentPanel);
                        
                        add_flower_to_panel();  
                        isFlowerRemoved = false;                               //in designScene
                        theCurrentFlower.hasParent = true;
                    }         
                }else{  //else if the flower does not intersect the panel
                    //if the current flower initially has intersected the panel, remove the flower from panel
                    if(!isFlowerRemoved){   
                        let scale = theCurrentFlower.obj.scaling;
                        theCurrentFlower.obj.scaling = scale;
                        remove_flower_from_panel(theCurrentFlower.obj.uniqueId);
                        theCurrentFlower.hasParent = false;
                        isFlowerRemoved = true;
                    }
                    if(isFlowerRemoved) theCurrentFlower.obj.setParent(null);
                }

                //if the current flower does not intersect the panel flower box (for bounds checking)
                if(!theCurrentFlower.obj.intersectsMesh(panelFlowerBox, true)){        
                    let x = theCurrentFlower.obj.position.x;
                    let y = theCurrentFlower.obj.position.y;
                    let z = theCurrentFlower.obj.position.z;
                    //if the current flower is not yet in the panel
                    if(designScene.activeCamera === panelCamera){
                        if(!theCurrentFlower.obj.parent){
                            if( theCurrentFlower.obj.position.x > 470 ) x = 469;
                            if( theCurrentFlower.obj.position.x < 464 ) x = 463;
                            if( theCurrentFlower.obj.position.y > 29.5 ) y = 28;
                            if( theCurrentFlower.obj.position.y < 18 ) y = 19;
                            if( theCurrentFlower.obj.position.z > 156 ) z = 155;
                            if( theCurrentFlower.obj.position.z < 148 ) z = 149;
                        }else{
                            if( theCurrentFlower.obj.position.x > 20 ) x = 20;
                            if( theCurrentFlower.obj.position.x < -18 ) x = -18;
                            if( theCurrentFlower.obj.position.y > 75 ) y = 75;
                            if( theCurrentFlower.obj.position.y < -78 ) y = -77;
                            if( theCurrentFlower.obj.position.z > -9 ) z = -9;
                            if( theCurrentFlower.obj.position.z < -55 ) z = -55;
                        }
                    }else if(designScene.activeCamera === focusCamera){
                        if(!theCurrentFlower.obj.parent){
                            if( theCurrentFlower.obj.position.x > 472.5 ) x = 471;
                            if( theCurrentFlower.obj.position.x < 464 ) x = 463;
                            if( theCurrentFlower.obj.position.y > 27.5 ) y = 27;
                            if( theCurrentFlower.obj.position.y < 19.5 ) y = 19;
                            if( theCurrentFlower.obj.position.z > 156 ) z = 155;
                            if( theCurrentFlower.obj.position.z < 148 ) z = 149;
                        }
                        else{
                            if( theCurrentFlower.obj.position.x > 15 ) x = 15;
                            if( theCurrentFlower.obj.position.x < -22 ) x = -22;
                            if( theCurrentFlower.obj.position.y > 75 ) y = 75;
                            if( theCurrentFlower.obj.position.y < 11 ) y = 11;
                            if( theCurrentFlower.obj.position.z > -9 ) z = -9;
                            if( theCurrentFlower.obj.position.z < -55 ) z = -55;
                        }
                    }    
                    theCurrentFlower.obj.position = new BABYLON.Vector3(x,y,z);       
                }

                
            
            }//end of if current panel and currentflower

            //if a current panel is active and the book of flowers is active
            if(currentPanel && isOpenBookFlowers){
                //if the book has stopped its animation
                if(!bookTask.animationGroups[0].isPlaying){
                    let isTrue = flowersMap.has(worldFlowerPicked);
                    if(isTrue){
                        for(let i=0;i<flowerVarietyArr.length;i++){
                            flowerVarietyArr[i].isVisible = true;
                        }
                    }
                    isOpenBookFlowers = false;
                }else{              
                    //if the book is still animating, grow the flower
                    if(designOrigFlower.scaling.x < 80){
                        designOrigFlower.scaling.x+= 3;
                        designOrigFlower.scaling.y-= 3;
                        designOrigFlower.scaling.z+= 3;
                    }
                    //scale up the book log
                    if(bookTask.meshes[19].scaling.x < 0.8){
                        bookTask.meshes[19].scaling.x += 0.03;
                        bookTask.meshes[19].scaling.y += 0.03;
                        bookTask.meshes[19].scaling.z -= 0.03;
                    }
                }//eof playing
            }//eof isOpenBook and currentpanel

            if(isStartOfDesignPanel && designScene.activeCamera === panelCamera){
                if(ruruSpeech2 && ruruSpeech3 && !isStartRuruSpeech2){
                    animate_ruru_speech();
                    isStartRuruSpeech2 = true;
                }
            }
    

            // if(mermaidSpeech2) console.log(mermaidSpeech2.position, mermaidSpeech2.rotationQuaternion);
            // if(designScene && designScene.lights && designScene.lights[1] && !isLightsDisabled){
            //     designScene.lights[1].setEnabled(false);
            //     designScene.lights[2].setEnabled(false);
            //     designScene.lights[3].setEnabled(false);
            //     designScene.lights[4].setEnabled(false);
            //     designScene.lights[5].setEnabled(false);
            //     designScene.lights[6].setEnabled(false);
            //     isLightsDisabled =true;
            // }
            
            //render the scene
            currentScene.render();
            // if(isDesignSceneActive){
            flowerScene.render();//earthFlowerScene.render();
            
        
        } //end of if current scene  
    });
}); 


// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
});



var viewportWidth = $(window).innerWidth();
var viewportHeight = $(window).innerHeight();

var viewportAR = $(window).innerWidth() / $(window).innerHeight();
if(viewportWidth < viewportHeight) viewportAR = $(window).innerHeight() / $(window).innerWidth();
// console.log("w: ", viewportWidth, "h: ", viewportHeight, "aR: ", viewportAR);


let userId = document.getElementById('userId').value;

$('#loadingScreenOverlay').on('click', function(evt){
    $(this).remove();
    $('#loadingScreenDiv').remove();
    document.getElementById("loadingScreenPercent").style.visibility = "hidden"; 

    if(has_load_game && isProgressLoaded){
        Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: '10vw',
            imageHeight: 'auto',
            position: 'top-end',
            title: 'Welcome back, Major Tom!<br/><br/>Your game progress has been loaded successfully!',
            showConfirmButton: false,
            timer: 7000,
            width: 100,
            background: 'rgba(8, 64, 147, 0.6)',
        });
    }
    designCamera.attachControl(canvas,true);
    // openFullscreen();
});


let loadCounter=0;
setInterval(function(){ 
    if(loadCounter<100 && isWorldFlowersReady) $('#loadingScreenPercent').html("Loading: "+loadCounter+" %");
    loadCounter++;
}, 700);



$("#saveScreenshotBtn").on('click',function(){
    if(designScene.activeCamera === designCamera){
        var link = window.document.createElement('a');
        link.href = screenshotData;
        link.download = "Mbaye_screenshot";
        var click = document.createEvent("MouseEvents");
        click.initEvent("click", true, false);
        link.dispatchEvent(click);  
    }else{
            let panelName = currentPanel.name;
            $.ajax({
                type: "POST",
                url:urlDesignScreenshot,
                data:{
                    uid: userId,
                    img:screenshotData,
                    panel_no:panelName,
                    _token:token
                },
                success: function(result){
                    Swal.fire({
                        width: '10vw',
                        padding: '3em',
                        background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                        title: '\n\n\n\nScreenshot of panel '+panelName+' saved succesfully!',
                        showConfirmButton: false,
                        position: 'top-end',
                        // timer: 3000,
                        width: 100,
                        customClass: {
                            popup: 'trevor-popup-class',
                        }
                    });

                    // turn blob into an object URL; saved as a member, so can be cleaned out later
                
                    
                    var link = window.document.createElement('a');
                    link.href = screenshotData;
                    link.download = "screenshot";
                    var click = document.createEvent("MouseEvents");
                    click.initEvent("click", true, false);
                    link.dispatchEvent(click);   
                    // BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine, camera2, {width:1024, height:768, precision:1},null,null,null,false,"Mbaye_panel_"+currentPanel.name);
                },
                error: function(result){
                    Swal.fire({
                        width: '10vw',
                        padding: '3em',
                        background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                        title: '\n\n\n\nOops...something went wrong. Your screenshot was not saved.',
                        showConfirmButton: false,
                        position: 'top-end',
                        timer: 3000,
                        customClass: {
                            title: 'error-title-class',
                            popup: 'trevor-popup-class',
                        },
                    });
                }
            });
    }//end of if-else
    $("#showScreenshotModal").modal('hide');
    
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
});

let isScreenshotActive = true;
$('.mainScreenshotIcon').on('click',function(){
    $('.takeScreenshotMain-submenu').fadeToggle();

    //set if nuvola and ruru can be moved by the user
    set_char_movable(isScreenshotActive);
    isScreenshotActive = !isScreenshotActive;
});

$('#take-screenshot-submenu').on('click',function(e){
    e.preventDefault();
    take_panel_screenshot();
});

$('#resetScene-submenu').on('click',function(e){
    e.preventDefault();
    ruruDesign_obj.position = new BABYLON.Vector3(59,8.5,9);
    ruruDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.6481,-0.3413,0.2794,0.6202);
    nuvolaDesign_obj.position = new BABYLON.Vector3(12.50,-8.30,55.92);
    nuvolaDesign_obj.rotationQuaternion = new BABYLON.Quaternion(0.0570,-0.4064,0.0516,0.9102);
});



$(".mainScreenshotIcon").hover(function(){
    //if the user has already clicked the screenshot icon ,change the span content
    if(!isScreenshotActive) $('.tooltips span').html("Disable Screenshot");
    else $('.tooltips span').html("Take Screenshot");
    $('.tooltips span').show();
},function(){
    $('.tooltips span').hide();
});
  
                /*
                $.ajax({
                    type: "POST",
                    url:urlDesignScreenshot,
                    data:{
                        uid: userId,
                        img:img,
                        panel_no:panelName,
                        _token:token
                    },
                    success: function(result){
                        Swal.fire({
                            width: '10vw',
                            padding: '3em',
                            background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                            title: '\n\n\n\nScreenshot of panel '+panelName+' saved succesfully!',
                            showConfirmButton: false,
                            position: 'top-end',
                            // timer: 3000,
                            width: 100,
                            customClass: {
                            popup: 'trevor-popup-class',
                        }
                    });
                    },
                    error: function(result){
                        Swal.fire({
                            width: '10vw',
                            padding: '3em',
                            background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                            title: '\n\n\n\nOops...something went wrong. Your screenshot was not saved.',
                            showConfirmButton: false,
                            position: 'top-end',
                            timer: 3000,
                            customClass: {
                                title: 'error-title-class',
                                popup: 'trevor-popup-class',
                            },
                        });
                    }
                });*/
                // BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine, camera2, {width:1024, height:768, precision:1},null,null,null,false,"Mbaye_panel_"+currentPanel.name);
            
                
                // var showAxis = function(size) {
                //     var makeTextPlane = function(text, color, size) {
                //     var dynamicTexture = new BABYLON.DynamicTexture("DynamicTexture", 50, designScene, true);
                //     dynamicTexture.hasAlpha = true;
                //     dynamicTexture.drawText(text, 5, 40, "bold 36px Arial", color , "transparent", true);
                //     var plane = new BABYLON.Mesh.CreatePlane("TextPlane", size, designScene, true);
                //     plane.material = new BABYLON.StandardMaterial("TextPlaneMaterial", designScene);
                //     plane.material.backFaceCulling = false;
                //     plane.material.specularColor = new BABYLON.Color3(0, 0, 0);
                //     plane.material.diffuseTexture = dynamicTexture;
                //     return plane;
                //      };
                  
                //     var axisX = BABYLON.Mesh.CreateLines("axisX", [ 
                //       new BABYLON.Vector3.Zero(), new BABYLON.Vector3(size, 0, 0), new BABYLON.Vector3(size * 0.95, 0.05 * size, 0), 
                //       new BABYLON.Vector3(size, 0, 0), new BABYLON.Vector3(size * 0.95, -0.05 * size, 0)
                //       ], designScene);
                //     axisX.color = new BABYLON.Color3(1, 0, 0);
                //     var xChar = makeTextPlane("X", "red", size / 10);
                //     xChar.position = new BABYLON.Vector3(0.9 * size, -0.05 * size, 0);
                //     var axisY = BABYLON.Mesh.CreateLines("axisY", [
                //         new BABYLON.Vector3.Zero(), new BABYLON.Vector3(0, size, 0), new BABYLON.Vector3( -0.05 * size, size * 0.95, 0), 
                //         new BABYLON.Vector3(0, size, 0), new BABYLON.Vector3( 0.05 * size, size * 0.95, 0)
                //         ], designScene);
                //     axisY.color = new BABYLON.Color3(0, 1, 0);
                //     var yChar = makeTextPlane("Y", "green", size / 10);
                //     yChar.position = new BABYLON.Vector3(0, 0.9 * size, -0.05 * size);
                //     var axisZ = BABYLON.Mesh.CreateLines("axisZ", [
                //         new BABYLON.Vector3.Zero(), new BABYLON.Vector3(0, 0, size), new BABYLON.Vector3( 0 , -0.05 * size, size * 0.95),
                //         new BABYLON.Vector3(0, 0, size), new BABYLON.Vector3( 0, 0.05 * size, size * 0.95)
                //         ], designScene);
                //     axisZ.color = new BABYLON.Color3(0, 0, 1);
                //     var zChar = makeTextPlane("Z", "blue", size / 10);
                //     zChar.position = new BABYLON.Vector3(0, 0.05 * size, 0.9 * size);
                //   };
                
                //   showAxis(5);