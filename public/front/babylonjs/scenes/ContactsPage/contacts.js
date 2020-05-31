
let canvas;
let engine;
let theAstroFace;
let DISC_CAM_INIT_POS = {x:2.83, y:0.44,z:580.01};
let contactsCamera;
let cameraInitState = {position:null,a:null,b:null,r:null,upperA:null, lowerA:null, upperB:null, lowerB:null,upperR:null, lowerR:null,angularY:null};
let astroInitState = {x:0,y:0,z:0};
let hl,starColor;
let createContactScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });
    engine.enableOfflineSupport = true;
    scene = new BABYLON.Scene(engine);
    BABYLON.Database.IDBStorageEnabled = true;

    let hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/environment.dds", scene);
    hdrTexture.gammaSpace = false;
    scene.environmentTexture = hdrTexture;
  
    load_3D_mesh();
    create_init_planets();
    // create_init_planet_orbit(); 
    create_skybox();
    contactsCamera = create_camera();
    create_light();
    create_solar_orbit();
    // create_contacts_gui();
    

    hl = new BABYLON.HighlightLayer("hl1", scene);
    starColor = new BABYLON.HighlightLayer("starColor", scene);


    return scene;
}

//############################################# CREATE THE SCENE'S CAMERAS #############################################//
//function to add the camera to the scene
function create_camera(){
    let camera = new BABYLON.ArcRotateCamera("Main Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-301.761,123.02,246.54),scene);
    //zoom in/out speed; speed - lower numer, faster zoom in/out
    camera.attachControl(canvas,true);
    camera.pinchPrecision = 1;
    camera.upperAlphaLimit = 1000;
    camera.wheelPrecision = 3;
    camera.lowerRadiusLimit = 3;
    camera.upperRadiusLimit = 2000;
    camera.wheelPrecision = 1;
    camera.allowUpsideDown = true;
    camera.panningSensibility = 1000;
    camera.target = new BABYLON.Vector3(0,0,0);
    camera.panningDistanceLimit = 1500;

    
    cameraInitState.position = new BABYLON.Vector3(-301.761,123.02,246.54);
    cameraInitState.a = camera.alpha;
    cameraInitState.b = camera.beta;
    cameraInitState.r = camera.radius;
    cameraInitState.upperA = camera.upperAlphaLimit;
    cameraInitState.lowerA = camera.lowerAlphaLimit;
    cameraInitState.upperB = camera.upperBetaLimit;
    cameraInitState.lowerB = camera.lowerBetaLimit;
    cameraInitState.upperR = camera.upperRadiusLimit;
    cameraInitState.lowerR = camera.lowerRadiusLimit;
    cameraInitState.angularY = camera.angularSensibilityY;

    return camera;
}//end of create camera function

function create_contact_disc_camera(){
    let camera = new BABYLON.ArcRotateCamera("Disc Camera",BABYLON.Tools.ToRadians(-50),BABYLON.Tools.ToRadians(88),30.0, new BABYLON.Vector3(0,0,300),scene);
    camera.position = DISC_CAM_INIT_POS;
    camera.lowerRadiusLimit = 1;
    camera.upperRadiusLimit = 2000;
    camera.wheelPrecision = 5;
    scene.activeCamera = camera;

   
    
}


//############################################# CREATE THE SCENE'S LIGHTS #############################################//
//function to add light to the scene
function create_light(){
    let light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(-30,200,10), scene);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.radius = 500;
    light.specular = new BABYLON.Color3(0,0,0);
    light.groundColor = new BABYLON.Color3(0.3,0.3,0.3);
    
}//end of create light function


//############################################# CREATE THE SCENE'S SKYBOX #############################################//
//function to create the scene's skybox
function create_skybox(){ 
    let skybox = BABYLON.MeshBuilder.CreateBox("contactSkybox", {size:8500.0}, scene);
    skybox.position.y = 100;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    let skyboxMaterial = new BABYLON.StandardMaterial("contactSkyboxMaterial", scene);
    skyboxMaterial.backFaceCulling = false;

    let files = [   
      "front/skybox/px.png",  
      "front/skybox/py.png",  
      "front/skybox/pz.png",  
      "front/skybox/nx.png",  
      "front/skybox/ny.png",   
      "front/skybox/nz.png",
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


//############################################# LOAD THE SCENE'S MODELS #############################################//
//function to load the 3D meshes
let astronaut,navigator_obj;
let astronautParts = {savePnl:null, launchPnl:null};
function load_3D_mesh(){
    user_gender = document.getElementById('userGender').value;
    let objPath;
    let model;
    if(user_gender === 'female'){
      objPath = 'front/objects/astronaut/thomasina/';
      model = 'MajorThomasina3.babylon';
    }
    else{
      objPath = 'front/objects/astronaut/tom/'
      model = 'MajorTom2.babylon';
    }
    var loadedPercent = 0;
    Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, objPath, model, scene,
              function (evt) {
                  // onProgress
                  
                  if (evt.lengthComputable) {
                      loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                  } else {
                      var dlCount = evt.loaded / (1024 * 1024);
                      loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                  }
                  document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
            }).then(function (result) {
                
                for(let i=0;i<result.meshes.length;i++){
                  result.meshes[i].isPickable = true;
                    if(result.meshes[i].name === "face"){
                      theAstroFace = result.meshes[i];
                    }else if(result.meshes[i].name === "helmetFace"){
                      // console.log("THE HELMET: ", result.meshes[i]);
                      result.meshes[i].visibility = 0.5;
                    }else if(result.meshes[i].name === "helmet") result.meshes[i].material.backFaceCulling = false;
                    else if(result.meshes[i].name === "Navigator") navigator_obj = result.meshes[i];
                    else if(result.meshes[i].name === "body") astronaut = result.meshes[i];
                    
                    if(communicatorMap.has(result.meshes[i].name)) add_action_mgr(result.meshes[i]);
                    // else if(result.meshes[i].name === "save_pnl") astronautParts.savePnl = result.meshes[i];
                    // else if(result.meshes[i].name === "launch_pnl") astronautParts.launchPnl = result.meshes[i];
                    if(i===result.meshes.length-1) loadedPercent = 100;
                }
                astronaut.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(130),0);
                if(user_gender === 'female') astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
                
            }),
      
      ]).then(() => {
        add_mouse_listener();
        setTimeout(function(){
            if(loadedPercent >= 100){
              document.getElementById("loadingScreenDiv").style.display = "none";
              document.getElementById("loadingScreenPercent").style.display = "none";
              // enable_gizmo(astronaut);
              // create_plane_background();
            }
        },1000);

          
    });
}//end of load design meshes



let homeGizmo,homeGizmo2;
function enable_gizmo(themesh){
    // Create gizmo
    let utilLayer = new BABYLON.UtilityLayerRenderer(scene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    homeGizmo = new BABYLON.PositionGizmo(utilLayer);
    homeGizmo2 = new BABYLON.RotationGizmo(utilLayer);
    homeGizmo.attachedMesh = themesh;
    homeGizmo.scaleRatio = 2;
    homeGizmo2.attachedMesh = themesh;
    //{x: 3531.764649204403, y: 461, z: -671.8764069833452}
    // console.log(homeGizmo);
}



//######################################## CREATE THE ASTRONAUT'S FACE ########################################//
function create_face_texture(thePath){
  
    let faceMatl = new BABYLON.StandardMaterial("facePhoto", scene);
    faceMatl.diffuseColor = new BABYLON.Color3(0,0,0);
    faceMatl.emissiveColor = new BABYLON.Color3(0.5,0.5,0.5);
    faceMatl.diffuseTexture = new BABYLON.Texture(thePath, scene);
    faceMatl.diffuseTexture.hasAlpha = true;
    faceMatl.backFaceCulling = false;//Allways show the front and the back of an element
    theAstroFace.material = faceMatl;
    theAstroFace.material.canRescale = true;
    theAstroFace.material.diffuseTexture.level = 2;
    // theAstroFace.material.diffuseTexture.uOffset = 0.61;
    // theAstroFace.material.diffuseTexture.vOffset = 0.5;
    theAstroFace.material.diffuseTexture.uScale = 1;
    theAstroFace.material.diffuseTexture.vScale =  1;
    // theAstroFace.material.diffuseTexture.uAngle = 0.29;
    // theAstroFace.material.diffuseTexture.vAngle = -0.080;
    // theAstroFace.material.diffuseTexture.wScale = 0.010;
}

//############################################# CREATE THE PLANETS #############################################//
function create_planets(){
    let sun = new Planet(scene, {x:-78,y:319,z:-2097}, 250, "sun","front/textures/home/planets/sun.jpg","front/textures/home/planets/sunnormal.jpg");
  //  let mercury = 

}




//############################################# HANDLE USER'S INTERACTION #############################################//
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

let isPlane2Selected = false;
let isLaunchEnabled = false;
let userContactsMap = new Map();
function add_mouse_listener(){
  var onPointerDownVisit = function (evt) {
      if(scene) var pickinfo = scene.pick(scene.pointerX, scene.pointerY);
      else return;
      if(pickinfo.hit){
          let theMesh = pickinfo.pickedMesh;
          console.log("the mesh clicked: ", theMesh,theMesh.name, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);
          // console.log("THE CAMERA:", scene.activeCamera.position);
          let validateArr = [];
          let userInfo = [];
          if(theMesh.name === "save_pnl" && isFocusNavigator && !isPlane2Selected){      //if the mesh is clicked
            let isValidEmail = validateEmail(emailInput.text);
            if(!isValidEmail || emailInput.text === "") validateArr.push("Please enter a valid email address.");
            if(nameInput.text === "") validateArr.push("<br>Please provide your friend\'s Name.");
           
            if(validateArr.length >0){ 
              Swal.fire({
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: '7vw',
                imageHeight: 'auto',
                background: 'rgba(8, 64, 147, 0.6)',
                title: 'Oops...',
                html: validateArr,
              });
            }else{
                if(!isDefaultImgSet){
                    Swal.fire({
                      title: 'Custom width, padding, background.',
                      width: '10vw',
                      padding: '3em',
                      background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
                      title: '\n\n\n\n\nWe added a temporary image for your friend, Major Tom.',
                      showConfirmButton: false,
                      position: 'top-end',
                      customClass: {
                        popup: 'trevor-popup-class',
                      }
                    });
                    discmatl2.diffuseTexture =  new BABYLON.Texture("storage/contactDirectory/MajorTomDefault.png", scene);
                    discmatl2.diffuseTexture.uScale = -1;
                    discmatl2.alpha = 1;
                    imageDisc.material = discmatl2;
                }
                userInfo.push(nameInput.text);
                userInfo.push(emailInput.text);
                userInfo.push(mobileInput.text);
                userInfo.push(aliasInput.text);
               
                plane.isVisible = false;
                plane.setEnabled(false);
                plane2.isVisible = true;
                plane2.setEnabled(true);  
                isPlane2Selected = true;
                add_star_details(userInfo);
            }
            isLaunchEnabled = true;
          }

          if(theMesh.name === "Navigator" && !isFocusNavigator){
              focus_on_navigator();
          }


          if(theMesh.name === "launch_pnl" && isFocusNavigator && isPlane2Selected){
              if(!chosenPlanet || chosenPlanet ===""){
                  Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: '7vw',
                    imageHeight: 'auto',
                    background: 'rgba(8, 64, 147, 0.6)',
                    title: 'Oops...',
                    text: 'Please choose a planet from the selection.'
                  });
              }else{
                unfocus_on_navigator();
              }
              
          }

          //if the obj clicked is a star created
          // if(contactDetailsMap.has(theMesh.name)){
          //     //zoom in on the star
          //     // contactsCamera.setTarget = theMesh;
          //     // contactsCamera.radius = 100;
          // }
          

    }//eof if
    
  }//end of on pointer down function

  var onPointerUpVisit = function () {
      // if(isPlane2Selected){
      //   isPlane2Selected = false;
      //   contactsCamera.attachControl(canvas,true);
      // }
  }//end of on pointer up function

  var onPointerMoveVisit = function (evt) {
    // if(isPlane2Selected) contactsCamera.detachControl(true);
  }//end of on pointer move function

  canvas.addEventListener("pointerdown", onPointerDownVisit, false);
  canvas.addEventListener("pointerup", onPointerUpVisit, false);
  canvas.addEventListener("pointermove", onPointerMoveVisit, false);


  //remove the text span on dispose
  scene.onDispose = function() {
      //related to the drag and drop
      canvas.removeEventListener("pointerdown", onPointerDownVisit);
      canvas.removeEventListener("pointerup", onPointerUpVisit);
      canvas.removeEventListener("pointermove", onPointerMoveVisit);

  };

}//end of listen to mouse function

/*################################################### END OF MOUSE EVENT FUNCTION ############################################## */

/*################################################### START OF SET POSITION OF STARS FUNCTION ############################################## */
function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

function get_random_pos(){
    let temp = {x:0,y:0,z:0};
    let pos = initSun.position;
    
    if(chosenPlanet === "Mercury") pos = initMercury.position;
    else if(chosenPlanet === "Venus") pos = initVenus.position;
    else if(chosenPlanet === "Earth") pos = initEarth.position;
    else if(chosenPlanet === "Mars") pos = initMars.position;
    else if(chosenPlanet === "Jupiter") pos = initJupiter.position;
    else if(chosenPlanet === "Saturn") pos = initSaturn.position;
    else if(chosenPlanet === "Uranus") pos = initUranus.position;
    else if(chosenPlanet === "Neptune") pos = initNeptune.position;
    else if(chosenPlanet === "Pluto") pos = initPluto.position;
    x = getRandomInt(pos.x-200, pos.x+200);                               //x - left right
    y = getRandomInt(pos.y-200, pos.y+200);                               //z - front back
    z = getRandomInt(pos.z-200, pos.z+200);                               //y - up down
    temp.x = x;
    temp.y = y;
    temp.z = z;
    // console.log("position: ", temp);
    return temp;
}


let contactDetailsMap = {};

function set_star_position(starDisc){
  //the init position of the star disc
  starDisc.scaling = new BABYLON.Vector3(30,30,30);
  starDisc.position = new BABYLON.Vector3(-55.47,56.75,-36.32);
  starDisc.rotationQuaternion = new BABYLON.Quaternion(0.9246,-0.0071, 0.3791,0.0015);
  starColor.addMesh(starDisc, starColorMap.get(chosenPlanet));
  starDisc.material.emissiveColor = starColorMap.get(chosenPlanet);

  //add the details to an array
  let contactDetails = [];
  contactDetails.push(nameInput.text);
  contactDetails.push(emailInput.text);
  contactDetails.push(mobileInput.text);
  contactDetails.push(aliasInput.text);
  contactDetails.push(chosenPlanet);

  contactDetailsMap[starDisc.name] = contactDetails;
 
  //add animation to the star
  setTimeout(function(){
      contactsCamera.radius = 2000;
      //Create a Vector3 animation at 30 FPS
      var starAnimation = new BABYLON.Animation("starAnimation", "position", 30, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
      
      // the star destination position
      let pos = get_random_pos();
      
      var nextPos = starDisc.position.add(new BABYLON.Vector3(pos.x,pos.y,pos.z));
      
      // Animation keys
      var keys = [];
      keys.push({ frame: 0, value: starDisc.position });
      keys.push({ frame: 60, value: nextPos });
      keys.push({ frame: 100, value: nextPos });
      starAnimation.setKeys(keys);
      
      // // Adding animation to my torus animations collection
      starDisc.animations.push(starAnimation);
      
      //Finally, launch animations on torus, from key 0 to key 120 with loop activated
      
      
      
      setTimeout(async () => {
        let anim = scene.beginAnimation(starDisc, 0, 100, false);

        console.log("before");
        await anim.waitAsync();
        console.log("after");
        // starDisc.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
        userContactsMap.set(starDisc.name, starDisc);
        console.log("pushed to user contacts meshes: ", userContactsMap);
        saveContacts(userId+"_contacts_meshes");
        imageDisc.dispose();
        
    });
      // await anim.waitAsync();
      // saveContacts(userId+"_contacts_meshes");
      // imageDisc.dispose();
      
     
  },1000);

  // setTimeout(function(){
  //   saveContacts(userId+"_contacts_meshes");
  //   imageDisc.dispose();
  // },2000);

  
  
}

/*################################################### END OF SET POSITION OF STARS FUNCTION ############################################## */




/*##################################### ADD ACTION MANAGER TO THE PARTS OF ASTRONAUT###################################### */

function add_action_mgr(thePart){
  thePart.actionManager = new BABYLON.ActionManager(scene);
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

let origScaling, origColor;
let partTooltip;
var onOverPart =(meshEvent)=>{
    partTooltip = document.createElement("span");
    partTooltip.setAttribute("id", "partTooltip");
    var sty = partTooltip.style;
    sty.position = "absolute";
    sty.lineHeight = "1.2em";
    sty.paddingLeft = "0.5%";
    sty.paddingRight = "0.5%";
    sty.color = "#ffffff";
    sty.fontFamily = "Nasalization Rg";
    sty.backgroundColor = "#0b91c3a3";
    sty.opacity = "0.7";
    sty.fontSize = "1vw";
    sty.top = scene.pointerY + "px";
    sty.left = (scene.pointerX+20) + "px";
    sty.cursor = "pointer";

  if(meshEvent.source.name === "Navigator"){
    if(!isFocusNavigator){
        hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
        document.body.appendChild(partTooltip);
        partTooltip.textContent = "Add a contact";
    }
  }else if(meshEvent.source.name === "launch_pnl" && !isLaunchEnabled){
    hl.addMesh(meshEvent.source, new BABYLON.Color3(0.8,0,0));
  }else if(meshEvent.source.name === "save_pnl" && isPlane2Selected){
    hl.addMesh(meshEvent.source, new BABYLON.Color3(0.8,0,0));
  }else{
    hl.addMesh(meshEvent.source, new BABYLON.Color3(0,0.8,0.8));
  }


};

//handles the on mouse out event
var onOutPart =(meshEvent)=>{
    hl.removeMesh(meshEvent.source);
    while (document.getElementById("partTooltip")) {
      document.getElementById("partTooltip").parentNode.removeChild(document.getElementById("partTooltip"));
    }   
};
/*##################################### ADD ACTION MANAGER TO THE PARTS OF ASTRONAUT###################################### */




//############################################# CREATE THE SCENE'S GUI FOR USER'S INPUT #############################################//
function create_contacts_gui(){
    let advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("ContactsSceneUI");
    //create simple button params: button Name, button Label
    let addContact_btn = BABYLON.GUI.Button.CreateSimpleButton("addContactBtn", "Full view");
    let navigator_btn = BABYLON.GUI.Button.CreateSimpleButton("accessNavigator", "Navigator");

    let btnWidth = canvas.width*0.04;
    let btnHeight = canvas.height*0.04;

    //button for returning the panel
    addContact_btn.width = 0.2;
    addContact_btn.height = btnHeight+"px";
    addContact_btn.width = btnWidth+"px";
    addContact_btn.color = "white";
    addContact_btn.alpha = 0.6;
    addContact_btn.fontSize = 13;
    addContact_btn.background = "green";
    addContact_btn.left = canvas.width/2 - 50;
    addContact_btn.top = canvas.height/2 - 60;

    //add contact button functions
    addContact_btn.onPointerDownObservable.add(
        function(info) {
         
          
         
          // console.log("add contact");
          // create_contact_disc_camera();
          // create_contact_disc();
    });
    addContact_btn.onPointerUpObservable.add(
        function(info) {
    });
    addContact_btn.onPointerEnterObservable.add(
        function() {
    });
    addContact_btn.onPointerOutObservable.add(
        function() {
    });    
    addContact_btn.onPointerMoveObservable.add(
        function(coordinates) {
    }); 

    //button for returning the panel
    navigator_btn.width = 0.2;
    navigator_btn.height = btnHeight+"px";
    navigator_btn.width = btnWidth+"px";
    navigator_btn.color = "white";
    navigator_btn.alpha = 0.6;
    navigator_btn.fontSize = 13;
    navigator_btn.background = "green";
    navigator_btn.left = canvas.width/2 - 50;
    navigator_btn.top = canvas.height/2 - 110;

    //add contact button functions
    navigator_btn.onPointerDownObservable.add(
        function(info) {
          

    });
    navigator_btn.onPointerUpObservable.add(
        function(info) {
    });
    navigator_btn.onPointerEnterObservable.add(
        function() {
    });
    navigator_btn.onPointerOutObservable.add(
        function() {
    });    
    navigator_btn.onPointerMoveObservable.add(
        function(coordinates) {
    }); 
    //add the buttons to the gui
    advancedTexture.addControl(addContact_btn);
    advancedTexture.addControl(navigator_btn);
}//end of create gui function




/**############################################### FUNCTION TO FOCUS AND UNFOCUS ON NAVIGATOR #################################################### */
function focus_on_navigator(){
  contactsCamera.setTarget(navigator_obj);
  navigator_obj.isPickable = false;
  set_camera_specs(1);
  isFocusNavigator = true;
  isLaunchEnabled = false;
  navigator_obj.isPickable = false;
  astroInitState.x = astronaut.rotation.x;
  astroInitState.z = astronaut.rotation.z;
 
  //check if male or female astro
  if(user_gender === 'female'){
    // astronaut.rotation.y = BABYLON.Tools.ToRadians(130);
    astronaut.rotation.x = BABYLON.Tools.ToRadians(37);
  }
  else{
    astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
  // astronaut.rotation.x = BABYLON.Tools.ToRadians(20);
  astronaut.rotation.z = BABYLON.Tools.ToRadians(3);
  }
  create_contact_plane();
}

let contactCnt = 0;
function unfocus_on_navigator(){
  navigator_obj.isPickable = true;
  set_camera_specs(2);
 
  plane.isVisible = false;
  plane2.isVisible = false;
  
  astronaut.rotation.x = astroInitState.x;
  astronaut.rotation.z = astroInitState.z;

  isFocusNavigator = false;
  isPlane2Selected = false;
  if(imageDisc){
    contactCnt++;
    let theStar = imageDisc.clone("Star"+contactCnt);
    set_star_position(theStar);
  }
  
  
}

let isFocusNavigator = false;
function set_camera_specs(mode){
  if(mode==1){  //navigator mode
      contactsCamera.position = new BABYLON.Vector3(-32.44,58.47,-22.15);
      contactsCamera.alpha = 1.005;
      contactsCamera.beta = -0.1;
      contactsCamera.radius = 15;
     
      contactsCamera.upperBetaLimit = 1;
      contactsCamera.lowerBetaLimit = -0.4;
      contactsCamera.lowerAlphaLimit = 1.005;
      contactsCamera.upperAlphaLimit = 1.00;
     
      contactsCamera.upperRadiusLimit = 25;
      contactsCamera.lowerRadiusLimit = 13;
      contactsCamera.angularSensibilityY = 5000;

  }else if(mode==2){  //full view mode
      contactsCamera.position = cameraInitState.position;
      contactsCamera.alpha = cameraInitState.a;
      contactsCamera.beta = cameraInitState.b;
      contactsCamera.radius = cameraInitState.r;
      
      contactsCamera.upperBetaLimit = cameraInitState.upperB;
      contactsCamera.lowerBetaLimit = cameraInitState.lowerB;
      contactsCamera.lowerAlphaLimit = cameraInitState.lowerA;
      contactsCamera.upperAlphaLimit = cameraInitState.upperA;
      contactsCamera.upperRadiusLimit = cameraInitState.upperR;
      contactsCamera.lowerRadiusLimit = cameraInitState.lowerR;
      contactsCamera.angularSensibilityY = cameraInitState.angularY;

   
  }
}
/*##################################### END OF FOCUS UNFOCUS ON NAVIGATOR ###################################### */


/*##################################### START OF ADDING STAR DETAILS ###################################### */

function add_star_details(info){
    var starTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(planeForDetails);
    // imageDisc.material.alpha = 0.6;
      //the stack panel for the labels
    //#############################################==//
    var detailsStack = new BABYLON.GUI.StackPanel();  
    
    // detailsStack.background = "blue";
    detailsStack.color = "white";
    detailsStack.width = 1;
    detailsStack.height = 1;
    detailsStack.horizontalAlignment = 0;
    
    //#############################################==//
    let addLabel = function(text, parent) {
    
      let tempLbl = new BABYLON.GUI.TextBlock();
      tempLbl.height = "200px";
      tempLbl.width = 1;
      tempLbl.fontSize = 100;
      
      tempLbl.fontWeight = "600";
      tempLbl.textWrapping = true;
      tempLbl.lineSpacing = "50px";
      tempLbl.text = text;
      tempLbl.textHorizontalAlignment = 2;
      parent.addControl(tempLbl); 
      // return tempLbl;
    }
    
    // detailsStack.addControl(imageLbl); 
    for(let i=0;i<info.length;i++){
      addLabel(info[i], detailsStack);
    }

    starTexture.addControl(detailsStack);
    console.log("add details to image");
}
/*##################################### END OF ADD STAR DETAILS ###################################### */



/*##################################### START OF COMMUNICATOR FORMS ###################################### */
let plane, plane2, imageDisc,discMatl2,planeForDetails;
let chosenPlanet;
function create_contact_plane(){
    if(plane) plane.dispose();
    if(plane2) plane2.dispose();
    
   
    plane = BABYLON.MeshBuilder.CreatePlane("First Plane", {width:8.5, height: 4.5}, scene);
   
    let discmatl = new BABYLON.StandardMaterial("discMatl", scene);
    discmatl.diffuseColor = new BABYLON.Color3(1,1,1);
    discmatl.backFaceCulling = false;
    discmatl.alpha = 0.5;
    
    plane.material = discmatl;

    // plane.isVisible = false;
    // plane.setEnabled(false);


    imageDisc = BABYLON.MeshBuilder.CreateDisc("Image Disc", {radius:1, tessellation: 0}, scene);
    discmatl2 = new BABYLON.StandardMaterial("discMatl", scene);
    discmatl2.diffuseColor = new BABYLON.Color3(1,1,1);
    discmatl2.backFaceCulling = false;
    discmatl2.alpha = 0.001;
    imageDisc.material = discmatl2;

    planeForDetails = BABYLON.MeshBuilder.CreatePlane("Details Plane", {width:1.8, height:1}, scene);
    // planeForDetails.isPickable = false;
    let planeDeetsMatl = new BABYLON.StandardMaterial("discMatl", scene);
    planeDeetsMatl.diffuseColor = new BABYLON.Color3(1,1,1);
    
    planeDeetsMatl.backFaceCulling = false;
    planeDeetsMatl.alpha = 0;
    planeForDetails.material = planeDeetsMatl;
    // add_star_details();

    if(user_gender === 'female'){
      plane.position = new BABYLON.Vector3(-49.03,33.88,-26.63);
      plane.rotationQuaternion = new BABYLON.Quaternion(0.2337,-0.5777,0.7654,0.1573);
      imageDisc.position = new BABYLON.Vector3(-56.58,33.53,-22.37);
      imageDisc.rotationQuaternion = new BABYLON.Quaternion(0.5959,0.2375,-0.1701, 0.7472);
      planeForDetails.position = new BABYLON.Vector3( -56.35,33.66,-22.04);
      planeForDetails.rotationQuaternion = new BABYLON.Quaternion(0.2309, -0.6166,0.7319,0.1706);
    }else{
      plane.position = new BABYLON.Vector3(-28.28,29.00,-26.40);
      plane.rotationQuaternion = new BABYLON.Quaternion(0.2386,-0.5554,0.7804,0.1572);
      imageDisc.position = new BABYLON.Vector3(-35.67,28.71,-22.25);
      imageDisc.rotationQuaternion = new BABYLON.Quaternion(0.5473, 0.2394,-0.1611, 0.7850);
      planeForDetails.position = new BABYLON.Vector3(-35.41,28.89,-21.87);
      planeForDetails.rotationQuaternion = new BABYLON.Quaternion(-0.2443, 0.5428,-0.7868,-0.1607);
    }
    
   planeForDetails.setParent(imageDisc);



    // enable_gizmo(plane);
    // enable_gizmo(planeForDetails);



    // GUI
    var advancedTexture2 = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(plane);
    let isTextSet = false;
    
      //the stack panel for the labels
    //#############################################==//
    var labelStack = new BABYLON.GUI.StackPanel();  
    advancedTexture2.addControl(labelStack);    
    // labelStack.background = "blue";
    labelStack.color = "white";
    labelStack.width = 0.3;
    labelStack.height = "85%"; 
    labelStack.horizontalAlignment = 0;
    //#############################################==//
    
    let textFont = "Nasalization Rg";
    //text label for the image URL
    let imageLbl = new BABYLON.GUI.TextBlock();
    imageLbl.height = "140px";
    imageLbl.fontSize = 35;
    imageLbl.fontFamily = textFont;
    imageLbl.text = "Friend's Image \nURL :";
    imageLbl.color =  '#0ee3ea';
    imageLbl.outlineColor = 'white';
    imageLbl.outlineWidth = '2px';
    imageLbl.textHorizontalAlignment = 0;
    
    let addLabel = function(text, parent) {
    
      let tempLbl = new BABYLON.GUI.TextBlock();
      tempLbl.height = "115px";
      tempLbl.fontSize = 34;
      tempLbl.text = text;
      tempLbl.fontFamily = textFont;
      tempLbl.color =  '#0ee3ea';
      tempLbl.outlineColor = 'white';
      tempLbl.outlineWidth = '2px';
      tempLbl.textHorizontalAlignment = 0;
      parent.addControl(tempLbl); 
      // return tempLbl;
    }
    
    labelStack.addControl(imageLbl); 
    addLabel("Name : ", labelStack);
    addLabel("Email Address : ", labelStack);
    addLabel("Mobile Number : ", labelStack);
    addLabel("Mbaye Name : ", labelStack);

   

    //text label for the image URL
    let saveLbl = new BABYLON.GUI.TextBlock();
    saveLbl.height = "140px";
    saveLbl.fontSize = 25;
    saveLbl.fontFamily = textFont;
    saveLbl.text = "(Click the save button to add this contact)";
    saveLbl.color =  'white';
    saveLbl.top = "20%";
    // saveLbl.outlineColor = 'white';
    // saveLbl.outlineWidth = '2px';
    saveLbl.textHorizontalAlignment = 0;
    saveLbl.textVerticalAlignment = 1;
    advancedTexture2.addControl(saveLbl);
  
  
  
    //the stack panel for the fields
    //#############################################==//
    var fieldStack = new BABYLON.GUI.StackPanel();  
    advancedTexture2.addControl(fieldStack);    
    // fieldStack.background = "red";
    fieldStack.width = 0.7;
    fieldStack.height = "80%";
    fieldStack.color = "white";
    fieldStack.horizontalAlignment = 1;     //align to the right (0-left, 1-right, 2-center)
    //#############################################==//
    
    isDefaultImgSet = false;
    //input box for the image URL
    var imgInput = new BABYLON.GUI.InputText();
      imgInput.width = 0.95;
      imgInput.height = "90px";
      imgInput.fontSize = 30;
      imgInput.text = "Add image url here";
      imgInput.color = "white";
      imgInput.background = "rgba(0, 0, 0, 0.2)";
      imgInput.fontFamily = textFont;
      
      // imgInput.background = "#5a8ade";
      
      
      imgInput.onPointerDownObservable.add(function() {
        // console.log("on pointer down");
        if(!isTextSet || imgInput.text === "Add image url here"){
          imgInput.text = "";
          
        }
          
      });
      imgInput.onPointerOutObservable.add(function() {
        // console.log("on pointer down");
          if(imgInput.text === "") imgInput.text = "Add image url here";
      });
    
      
      //button for setting the image to the disc
      let addImgBtn = BABYLON.GUI.Button.CreateSimpleButton("but1", "Add");
      addImgBtn.width = 0.2;
      addImgBtn.height = "50px";
      addImgBtn.fontFamily = textFont;
      addImgBtn.fontSize = 25;
      addImgBtn.background = "teal";
      addImgBtn.onPointerDownObservable.add(function() {
          // let imgURL = imgInput.text;
          //check if value is an image first
          if(!isTextSet && !isDefaultImgSet){
            Swal.fire({
              title: 'Custom width, padding, background.',
              width: '10vw',
              padding: '3em',
              background: 'rgba(8, 64, 147, 0.6) url(front/images3D/designScene/trevorSaved.png) ',
              title: '\n\n\n\nWe added a temporary image for your friend, Major Tom.',
              showConfirmButton: false,
              position: 'top-end',
              customClass: {
                popup: 'trevor-popup-class',
              }
            });
            discmatl2.diffuseTexture =  new BABYLON.Texture("storage/contactDirectory/MajorTomDefault.png", scene);
            discmatl2.diffuseTexture.uScale = -1;
            discmatl2.alpha = 1;
            imageDisc.material = discmatl2;
            isDefaultImgSet = true;
          }else{
              discmatl2.diffuseTexture =  new BABYLON.Texture(imgInput.text, scene);
              discmatl2.diffuseTexture.uScale = -1;
              discmatl2.alpha = 1;
              imageDisc.material = discmatl2;
              isTextSet = true;
          }
      });
      addImgBtn.onPointerEnterObservable.add(function() {
        addImgBtn.background = "green";
      });
      addImgBtn.onPointerOutObservable.add(function() {
        addImgBtn.background = "teal";
      });

    
    
    
        
    let addInputField = function(text, parent) {
    
        let tempInput = new BABYLON.GUI.InputText();
        tempInput.width = 0.95;
        tempInput.height = "100px";
        tempInput.fontSize = 30;
        // tempInput.background = "#00003f";
        tempInput.paddingTop = "20px";
        tempInput.color = "white";
        // tempInput.background = "#3b59a9";
        tempInput.background = "rgba(0, 0, 0, 0.2)";
        tempInput.fontFamily = "Nasalization Rg";
    
        tempInput.onPointerDownObservable.add(function() {
    
        });
      parent.addControl(tempInput); 
      return tempInput;
    
    }
  
  
    fieldStack.addControl(imgInput); 
    fieldStack.addControl(addImgBtn);
    nameInput = addInputField("Name : ", fieldStack);
    emailInput = addInputField("Email Address : ", fieldStack);
    mobileInput = addInputField("Mobile Number : ", fieldStack);
    aliasInput = addInputField("Mbaye Name : ", fieldStack);
    // fieldStack.addControl(saveBtn);
  // let nameInput = addInputField("Jupiter", fieldStack);  
  
  
    
    
    
  
  
  
  
  
  
  
    
    
  
    plane2 = BABYLON.MeshBuilder.CreatePlane("plane2", {width:8.5 ,height:4.5});
    plane2BG = BABYLON.MeshBuilder.CreatePlane("plane2BG", {width:9,height:4.4});
    // plane2BG.isPickable = true;
    
    let plane2Matl = new BABYLON.StandardMaterial("plane2", scene);
    plane2Matl.diffuseTexture = new BABYLON.Texture("front/textures/yourStars/form2SkyboxBG.png", scene);
    plane2Matl.backFaceCulling = false;
    plane2Matl.diffuseTexture.hasAlpha = true;
    
    plane2BG.material = plane2Matl;
    // plane2.isPickable = true;
    //  plane.parent = sphere4;

    if(user_gender === 'female'){
      plane2.position = new BABYLON.Vector3(-49.12,33.79,-26.91);
      plane2.rotationQuaternion = new BABYLON.Quaternion(0.2349,-0.5720,0.7696,0.1555);
      plane2BG.position = new BABYLON.Vector3(-49.20,33.75,-26.90);
      plane2BG.rotationQuaternion = new BABYLON.Quaternion( 0.2350,-0.5739, 0.7681,0.1557);
      // imageDisc.position = new BABYLON.Vector3(-37,28.08,-21.44);
      // imageDisc.rotationQuaternion = new BABYLON.Quaternion(0.6135,0.2248,-0.1825,0.7339);
    }else{
      plane2.position = new BABYLON.Vector3(-28.3,28.91,-26.95);
      plane2.rotationQuaternion = new BABYLON.Quaternion(0.2386,-0.5554,0.7804,0.1572);
      plane2BG.position = new BABYLON.Vector3(-28.35,28.86,-26.93);
      plane2BG.rotationQuaternion = new BABYLON.Quaternion(0.2361,-0.5526,0.7831,  0.1576);
    
      // imageDisc.position = new BABYLON.Vector3(  -32.04,29.4,-23.67);
      // imageDisc.rotationQuaternion = new BABYLON.Quaternion( 0.6179,0.2177,-0.1875, 0.7315);
    }
   
      plane2BG.setParent(plane2);
      plane2.isVisible = false;
      plane2.setEnabled(false);
      
      //  enable_gizmo(plane2);
      
      // GUI

      var advancedTexture3 = BABYLON.GUI.AdvancedDynamicTexture.CreateForMesh(plane2);

      /* START OF SCROLL VIEWER FOR PLANET OPTIONS */
      // var sv = new BABYLON.GUI.ScrollViewer();
      //   sv.width = 0.8;
      //   sv.height = 0.5;
      //   // sv.background = "#CCCCCC";

      // advancedTexture3.addControl(sv);
      /* END OF SCROLL VIEWER */  

      /* START OF STACK PANEL FOR LEFT SIDE */
      var planetStackLeft = new BABYLON.GUI.StackPanel();  
      // advancedTexture3.addControl(planetStackLeft);    
      // planetStackLeft.background = "red";
      planetStackLeft.width = 0.6;
      planetStackLeft.height = 0.6;
      planetStackLeft.left = "0%";
      planetStackLeft.top = "1%";
      planetStackLeft.horizontalAlignment = 0;  //to the left
      planetStackLeft.alpha = 0.3;

      advancedTexture3.addControl(planetStackLeft);   //put the left side stack panel to the scroll viewer
      /* END OF PLANET STACK FOR LEFT SIDE */


      /* START OF STACK PANEL FOR RIGHT SIDE */
      var planetStackRight = new BABYLON.GUI.StackPanel();  
      // planetStackRight.background = "green";
      planetStackRight.width = 0.4;
      planetStackRight.height = 0.6;
      planetStackRight.left = "60%";
      planetStackRight.top = "1%";
      planetStackRight.horizontalAlignment = 0;  //to the left
      planetStackRight.alpha = 0.3;

      advancedTexture3.addControl(planetStackRight);   //put the left side stack panel to the scroll viewer
      /* END OF PLANET STACK FOR RIGHT SIDE */


      
      /* START OF BACK BUTTON */
      //button for setting the image to the disc
      let backBtn = BABYLON.GUI.Button.CreateSimpleButton("backBtn", "Back");
      backBtn.horizontalAlignment = 0;
      backBtn.verticalAlignment = 0;
      backBtn.left = "3%";
      backBtn.top = "10%";
      backBtn.width = 0.1;
      backBtn.height = "70px";
      backBtn.fontSize = 30;
      backBtn.color = "white";
      backBtn.fontFamily = textFont;
      backBtn.background = "teal";
      backBtn.hoverCursor = "pointer";
      backBtn.onPointerDownObservable.add(function() {
          plane2.isVisible = false;
          plane2.setEnabled(false);
          plane.isVisible = true;
          plane.setEnabled(true);
          isLaunchEnabled = false;
          isPlane2Selected = false;
      });
      backBtn.onPointerEnterObservable.add(function() {
        backBtn.background = "green";
      });
      backBtn.onPointerOutObservable.add(function() {
        backBtn.background = "teal";
      });

      advancedTexture3.addControl(backBtn);
    /* END OF BACK BUTTON */ 

    /* START OF PLANE2 TITLE */
    let planeTitle = new BABYLON.GUI.TextBlock();
    planeTitle.height = "120px";
    planeTitle.left = "2%";
    planeTitle.top = "-5%";
    planeTitle.fontSize = 40;
    planeTitle.color = "#0ee3ea";
    planeTitle.fontFamily = textFont;
    planeTitle.horizontalAlignment = 0;
    planeTitle.verticalAlignment = 1;
    planeTitle.text = "Where do you want to send your new contact? ";

    advancedTexture3.addControl(planeTitle);
    /* END OF PLANE2 TITLE */

    
    /* START OF RADIO BUTTONS OF PLANETS */
    var addRadio = function(text, parent) {
        
        let theText = text;
        var button = new BABYLON.GUI.RadioButton();
        button.width = "30px";
        button.height = "40px";
        button.color = "white";
        button.hoverCursor = "pointer";
        // button.background="black";
      
        button.onIsCheckedChangedObservable.add(function(state) {
            if (state) {
              planeLbl2.text = "Send your contact to : " + theText;
              chosenPlanet = theText;
            }
        }); 
        text = "";
        
        var header = BABYLON.GUI.Control.AddHeader(button, text, 1, { isHorizontal: true, controlFirst: true });
        header.height = "125px";
        // header.background = "blue";
        header.width = 0.1;       
        header.fontFamily = textFont;
        if(theText === "Pluto") header.left = "57%";
        else if(theText === "Earth") header.left = "82%";
        else if(theText === "Venus") header.left = "14%";
        else if(theText === "Mercury") header.left = "42%";
        else if(theText === "Uranus") header.left = "83%";

        else if(theText === "Mars") header.left = "25%";
        else if(theText === "Jupiter") header.left = "80%";
        else if(theText === "dummy") header.left = "120%";
        else if(theText === "Saturn") header.left = "25%";
        else if(theText === "Neptune") header.left = "71%";

        
        header.horizontalAlignment = 0;
        // header.children[1].textHorizontalAlignment = 2;
        header.children[1].onPointerDownObservable.add(function() {
            button.isChecked = !button.isChecked;
        });
      
        parent.addControl(header);    
    }//end of add radio
    
    
    addRadio("Pluto", planetStackLeft);
    addRadio("Earth", planetStackLeft);
    addRadio("Venus", planetStackLeft);
    addRadio("Mercury", planetStackLeft);
    addRadio("Uranus", planetStackLeft);
    addRadio("Mars", planetStackRight);
    addRadio("Jupiter", planetStackRight); 
    addRadio("dummy", planetStackRight); 
    addRadio("Saturn", planetStackRight);
    addRadio("Neptune", planetStackRight);  
    
    /* END OF RADIO BUTTON ADDITION*/


    
    /* START OF PLANE LABEL FOR SHOWING THE SELECTED PLANET */
    let planeLbl2 = new BABYLON.GUI.TextBlock();
    planeLbl2.height = "120px";
    planeLbl2.textHorizontalAlignment = 0;
    planeLbl2.verticalAlignment = 0;
    planeLbl2.top = "7%";
    planeLbl2.left = "15%";
    planeLbl2.fontSize = 45;
    planeLbl2.fontFamily = textFont;
    planeLbl2.color = "#0ee3ea";
    planeLbl2.text = "Send your contact to : ";
    
    advancedTexture3.addControl(planeLbl2);

} // end of gui function

/*##################################### END OF COMMUNICATOR FORMS ###################################### */





/*##################################### START OF CREATE PLANETS ###################################### */
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
    var gl = new BABYLON.GlowLayer("glow", scene);
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
    
    initEarth = initSun.clone("initEarth");
    init_clone_planet(initEarth,"earthMatl","front/textures/home/planets/earth.jpg","textures/planets2/normals/earthnormal.png", 635.56,45.08,-331.69,0.5);

    initMoon = initSun.clone("initMoon");
    init_clone_planet(initMoon,"moonMatl","front/textures/home/planets/moon.jpg","front/textures/home/planets/moonnormal.jpg",329,163,-263,0.2);

    initMars = initSun.clone("initMars");
    init_clone_planet(initMars,"marsMatl","front/textures/home/planets/mars.jpg","front/textures/home/planets/marsnormal.jpg",-752,-42,78,0.3);

    initJupiter = initSun.clone("earthJupiter");
    init_clone_planet(initJupiter,"jupiterMatl","front/textures/home/planets/jupiter.jpg","front/textures/home/planets/jupiternormal.jpg",210,-144,730,0.48);

    initSaturn = init_planet("initSaturn","saturnMatl","front/textures/home/planets/saturn.jpg","front/textures/home/planets/saturnnormal.jpg",2551,436,-2414,220);
    var saturnRing = BABYLON.Mesh.CreateGround("rings", 490, 490, 1, scene);
    saturnRing.isPickable = false;
    saturnRing.parent = initSaturn;

    initSaturn.rotationQuaternion = new BABYLON.Quaternion(0.28,0.18,0.02,0.94);
    var ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", scene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("front/textures/home/planets/saturnRing2.png", scene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;

    initUranus = initSun.clone("initUranus");
    init_clone_planet(initUranus,"uranusMatl","front/textures/home/planets/uranus.jpg","front/textures/home/planets/uranusnormal.jpg",-2097,-91,337,0.48);

    initNeptune = initSun.clone("initNeptune");
    init_clone_planet(initNeptune,"neptuneMatl","front/textures/home/planets/neptune.jpg","front/textures/home/planets/neptunenormal.jpg",2835,-5,-76,0.92);

    initPluto = initSun.clone("initPluto");
    init_clone_planet(initPluto,"plutoMatl","front/textures/home/planets/pluto.jpg","front/textures/home/planets/plutonormal.jpg",2300,400,500,0.4);
 

    // enable_gizmo(initEarth);

    //rotate the planets
    
    engine.runRenderLoop(function () {
        if(scene){
            initMercury.rotation.y = Math.PI / 2;
            initMercury.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            initVenus.rotation.y = Math.PI / 2;
            initVenus.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            initEarth.rotation.y = Math.PI / 2;
            initEarth.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
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
        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 10, radius, scene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    var temp_material = new BABYLON.StandardMaterial(material_name,scene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, scene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,scene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    // temp_material.freeze();
    // temp.freezeWorldMatrix();
    temp.material = temp_material;
    // temp.material.freeze();
    // temp.convertToUnIndexedMesh();

    
    return temp;
}//end of init planet function


function init_clone_planet(temp,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,scale){
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    var temp_material = new BABYLON.StandardMaterial(material_name,scene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, scene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,scene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);

    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();
}//end of init planet function




var earthOrbit, mercuryOrbit,venusOrbit,jupiterOrbit,saturnOrbit,uranusOrbit,neptuneOrbit,plutoOrbit,sunOrbit,moonOrbit;
function create_init_planet_orbit(){
    //params: name, matlName, matlPath, xPos, yPos, zPos, scaling, radius, xRotation
    earthOrbit = init_orbit("Earth","orbitMatl", "front/textures/participate/planetorbit2.png",0,0,0,1.1,200,90);
    mercuryOrbit = init_orbit("Mercury","orbitMatl", "front/textures/participate/planetorbit5.png",-444.158,226.007,-1427.216,0.3,200,110);
    venusOrbit = init_orbit("Venus","orbitMatl", "front/textures/participate/planetorbit.png",-317.946,90.369,-681.065,0.4,300,100);
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
    var temp = BABYLON.MeshBuilder.CreateDisc(name, {radius:radiusVal, tessellation: 0}, scene);
    temp.scaling = new BABYLON.Vector3( scale, scale, scale );
    temp.position = new BABYLON.Vector3(x,y,z);
    temp.rotation.x =  BABYLON.Tools.ToRadians(xRot);

    var tempMatl = new BABYLON.StandardMaterial(matlName, scene);
    tempMatl.diffuseTexture = new BABYLON.Texture(matlPath, scene);
    tempMatl.diffuseTexture.hasAlpha = true;
    temp.material = tempMatl;
    temp.material.backFaceCulling = false;
    temp.freezeWorldMatrix();
    temp.convertToUnIndexedMesh();
   
}// end of init orbit function



var solarOrbit;
function create_solar_orbit(){
  solarOrbit = BABYLON.Mesh.CreateGround("initOrbit", 3000, 2600, 1, scene);
  solarOrbit.isPickable = false;
  solarOrbit.scaling = new BABYLON.Vector3(2.5,2.5,2.5);
  solarOrbit.position = new BABYLON.Vector3(200,0,-100);
  solarOrbit.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(-10),BABYLON.Tools.ToRadians(180),BABYLON.Tools.ToRadians(0));

    var initOrbitMatl = new BABYLON.StandardMaterial("initOrbitMatl", scene);
    initOrbitMatl.diffuseTexture = new BABYLON.Texture("front/textures/flowersMbaye/solarOrbit2.png", scene);
    initOrbitMatl.diffuseTexture.hasAlpha = true;
    initOrbitMatl.backFaceCulling = false;
    solarOrbit.material = initOrbitMatl;
    solarOrbit.material.freeze();
    solarOrbit.freezeWorldMatrix();
}

/*##################################### END OF CREATE PLANETS AND ORBITS ###################################### */


/*##################################### START OF SAVE CONTACTS POSITION ###################################### */
let objectUrl;
function saveContacts(filename) {

 var serializedMesh;       
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

  

  // console.log("save current progress",userContactsMap);
  
  
  //problem with saving the meshes; babylon file cannot be rendered
  for (const [disc,val] of userContactsMap.entries()) {
      console.log("SAVE : ", disc,val);
      // if(val.size>0) 
      serializedMesh = BABYLON.SceneSerializer.SerializeMesh(val,false,true);                    
      for (let i=0;i<serializedMesh["meshes"].length;i++) { 
          meshes_to_save["materials"].push(serializedMesh["materials"][i]);            
          meshes_to_save["geometries"]["vertexData"].push(serializedMesh["geometries"]["vertexData"][i]);   
          meshes_to_save["meshes"].push(serializedMesh["meshes"][i]);  
      }      

  }
 
  console.log("meshes: ", meshes_to_save);
 
  var strMesh = JSON.stringify(meshes_to_save);
  var contactDetails = JSON.stringify(contactDetailsMap);
  console.log("contact details after: ", contactDetails);
  // console.log("str mesh:", strMesh);
 
  var blob = new Blob ( [ strMesh ], { type : "octet/stream" } );
  if (filename.toLowerCase().lastIndexOf(".babylon") !== filename.length - 8 || filename.length < 9){
      filename += ".babylon";
  }

  if(blob){
      $.ajax({
          type: "POST",
          url:urlStoreContacts,
          data:{
              uid: userId,
              details: contactDetails,
              savePath:userId+"_userContacts.babylon",
              babylonFile:strMesh,
              _token:token
          },
          success: function(result){
              Swal.fire({
                  imageUrl: '../../front/images3D/designScene/trevorSaved.png',
                  imageWidth: '10vw',
                  imageHeight: 'auto',
                  position: 'top-end',
                  title: 'Your star has been saved!',
                  showConfirmButton: false,
                  timer: 3000,
                  width: 100,
                  background: 'rgba(8, 64, 147, 0.6)',
              });
          },
          error: function(result){
              Swal.fire({
                  position: 'top-end',
                  imageUrl: '../../front/images3D/designScene/trevorSaved.png',
                  imageWidth: '10vw',
                  imageHeight: 'auto',
                  title: 'Oops...something went wrong. Your progress was not saved.',
                  showConfirmButton: false,
                  timer: 3000,
                  width: 100,
                  background: 'rgba(8, 64, 147, 0.6)',
                  customClass: {
                      title: 'error-title-class',
                  },
              });
          }
      });
  }//end of blob

/*
   if(objectUrl) {
      window.URL.revokeObjectURL(objectUrl);
    }

    // var serializedMesh = BABYLON.SceneSerializer.SerializeMesh(starDisc,false,true);

    // var strMesh = JSON.stringify(serializedMesh);

    if (filename.toLowerCase().lastIndexOf(".babylon") !== filename.length - 8 || filename.length < 9){
      filename += ".babylon";
    }

    var blob = new Blob ( [ strMesh ], { type : "octet/stream" } );

    // turn blob into an object URL; saved as a member, so can be cleaned out later
    objectUrl = (window.webkitURL || window.URL).createObjectURL(blob);

    var link = window.document.createElement('a');
    link.href = objectUrl;
    link.download = filename;
    var click = document.createEvent("MouseEvents");
    click.initEvent("click", true, false);
    link.dispatchEvent(click); 
      
   */
}
/*##################################### END OF SAVE CONTACTS POSITION ###################################### */






let isImgPathSet = false;
let img_path;
let user_gender;
let isSceneLoaded = false;
let userId = document.getElementById('userId').value;

$(window).on('load',function(){
    isImgPathSet = true;
    img_path = document.getElementById('userPhoto').src;
    isSceneLoaded = true;
})
  //function that will render the scene on loop
  var scene = createContactScene();
  
  engine.runRenderLoop(function(){
    if(isSceneLoaded){
        scene.render();
      //  console.log(contactsCamera.position, contactsCamera.alpha, contactsCamera.beta);
    }
    
    if(isImgPathSet && theAstroFace){
        isImgPathSet = false;
        create_face_texture(img_path);
    }
  });//end of renderloop

  window.addEventListener("resize", function () {
    engine.resize();
  });







