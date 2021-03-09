/*===============================================START OF MOVE MBAYE SCENE======================================================================*/

//define the earthScene's scene
var earthScene;  
                                                                    //var to handle the earth scene
//define the earthScene's camera
var initCamera;                                                    //var to hold the first camera upon loading the earth scene
var exploreCamera;                                                  //camera for explore earth feature

//define the earthScene's light
var initLight;                                                     //active hemispheric light for the earth scene
var initLight2;

//define the asset loaders of earthScene
var earthNormalTask;                                                //asset loader of earth base sphere
var mbayeEarthTask;                                                 //asset loader of earthScene's mbaye
var earthBordersTask;                                               //asset loader of earth borders
var earthNamesTask;                                                 //asset loader of countrynames
let earthDivisionTask;

//define the objects of earthScene
var earthNormal_object;                                             //var for the earth sphere mesh
var earthBorders_object;                                            //var for the earth borders mesh
var earthNames_object;                                              //var for the earth names mesh
var mbayeInit_object;                                              //var for the earthScene's mbaye mesh
let earthDivision_object;

//define flags of borders and countries
var isBorderOn;                                                     //var that determines if the earth border is visible or not
var isCountryOn;                                                    //var that determines if the earth names is visible or not   

//define var to check whether the earth scene meshes have finished loading
var isEarthModelLoaded;

//define global buttons for earthScene's GUI
var home_btn;
var showBorders_btn;
var showBorders2_btn;
var showNames_btn;
var showNames2_btn;
var exploreEarth_btn;
var moveEarth_btn;
var rotateEarth_btn;
var resetEarth_btn;
var designPanel_btn;
var showLabels_btn;

//define global variables related to the gui buttons
var isExploreBtnActive;                                             //flag to determine if explore earth button is clicked or not
var isEarthExplored;                                                //flag to determine if exploreCamera is active
var isMoveEarthBtnActive;                                           //flag to determine if moveEarth tuton is clicked or not                   
var exploreBtnCounter;                                              //var to determine if it's the first time cliking explore earth btn


//define vars related to explore camera's orientation (tilt left or right)
var currExploreCameraRotZ;                                          //var to determine current rotation z value of exploreCamera
var currExploreCameraRotX;                                          //var to determine current rotation x value of exploreCamera
var currExploreCameraRotY;                                          //var to determine current rotation y value of exploreCamera
var currExploreCameraPosX;                                          //var that updates the current x pos of exploreCamera
var currExploreCameraPosY;                                          //var that updates the current y pos of exploreCamera
var currExploreCameraPosZ;                                          //var that updates the current z pos of exploreCamera

//define the var for earthScene's skybox
var initSkybox;

//define the earthScene's planets
var sun;
var earthMercury;
var earthVenus;
var earthMars;
var earthJupiter;
var earthSaturn;
var earthNeptune;
var earthPluto;
var earthMoon;

//define the variables for the continents so mbaye's intersection with them can be checked
var earthNorthAmerica;
var earthSouthAmerica;


//define Mbaye's feet for intersection / collision checking
var mbayeEarthFeet_object;


//define global var of earth gizmo's initial scale ratio
var currentEarthGizmoScale;                                        //var to hold the current scale ratio value of earth gizmo                  
                                                    //var to hold the roation gizmo of earth


//initial values of earth's rotation and position for the resetPosition button
var initinitCameraState = {alpha:0,beta:0};
var initinitCameraPos = {x:-1135,y:486,z:995};
var initEarthMbayeRot = {x:0,y:0,z:0};
var initEarthMbayePos = {x:0,y:0,z:0};

//define var for the earth Camera's change in position along the y axis
var earthCamTargetY;

//define the vars for the sea creatures
var dolphinEarth_object;
var starfishEarth_object;
var crabEarth_object;
// var swordfishEarth_object;

var isEarthSeaObjectLoaded;                                         //var to check if sea creatures are already loaded

var isEarthClicked = false;
var currentDraggableMesh;
var isMbayeDragged = false;

let isFirstClickOfMbaye = false;
let isStartZoomInMbaye = false;

let mbayeLastPos = {x:0,y:0,z:0}
let mbayeLastRot = {x:0,y:0,z:0,w:0}
let mbayeLastRot2 = {x:0,y:0,z:0};
let isOnOverPlanetOrbitActive = true;
let isEarthSceneActive = false;
var planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
var redAngle = 0.01;   
var yellowAngle = 0.02;
var grayAngle = -0.005;
//define constants for zoom in/out limits
//const LOWER_RADIUS_VAL = 1;                                       //zoom in limit                       
const UPPER_RADIUS_VAL = 1700;                                      //zoom out limit
const BTN_LBL_FONTSIZE = '10vw';

var mbaye_object_with_panels = null;
var mbaye_eyes_material;
var starsLight;
var isLabelShown = false;

let orbit;
var isMbayeFromDesignScene = false;
var planetsOrbitArr = [];


//constellations
var leoStars;
var ariesStars;
var taurusStars;
var piscesStars;
var scorpioStars;
var sagittariusStars;
var virgoStars;
var libraStars;
var geminiStars;
var capricornStars;
var aquariusStars;
var cancerStars;



//function that will create the earth scene/ Scene 2 of the game
function createEarthScene(){
    engine.enableOfflineSupport = true;
 
    startAstronautScene = createAstronautScene();
    earthScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene

    initCamera = create_camera(earthScene);                                //create earth scene's camera
    initLight = create_light(earthScene);                                  //create earth scene's light
    initSkybox = create_skybox(earthScene);                                     //create earth scene's skybox
    create_solar_orbit(earthScene);
    load_meshes();
                                                
    add_hdr_environment(earthScene);

    create_planets(earthScene);                                             //create the earth scene's planets
    create_planet_orbit(earthScene);
    create_constellation_planes(earthScene);
    addMouseListener();
    
    enable_init_webcamera(earthScene);
    create_planet_labels();

    earthScene.autoClear = false;
    
    return earthScene;
} //end of create earth scene function




// var earthNormal_object2;
var earthNames_object2;
var earthSea_obj;
var water;
var mbayeEarthTask;
function load_meshes(){
     Promise.all([
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon",  earthScene, 
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
                earthNormalMesh = result.meshes;
                
                result.meshes[9].scaling = new BABYLON.Vector3(0.6,0.6,0.6);
               
                for(let i=0;i<result.meshes.length-1;i++){
                    result.meshes[i].isPickable = true;
                    if(result.meshes[i].name === "Sea"){
                        water = new BABYLON.WaterMaterial("water", earthScene, new BABYLON.Vector2(2048, 2048));
                        water.backFaceCulling = true;
                        water.bumpTexture = new BABYLON.Texture("front/textures/participate/waterbump.png", earthScene);
                        water.windForce = 10;
                        water.windDirection = new BABYLON.Vector2(-1,0);
                        water.waveHeight = 0.2;
                        water.bumpHeight = 0.3;
                        water.waveLength = 0.1;
                        water.colorBlendFactor = 0.25714;
                        water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                        water.addToRenderList(initSkybox);
                       result.meshes[i].material = water;
                    }
                    result.meshes[i].actionManager = new BABYLON.ActionManager(earthScene);
                    result.meshes[i].actionManager.registerAction(
                        new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
                        onOverPlanet)
                    );
                    result.meshes[i].actionManager.registerAction(
                        new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
                        onOutPlanet)
                    );   
                }
                earthNormal_object = result.meshes[9];  
          }),
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "border.babylon", earthScene).then(function (result) {
                // console.log(result.meshes);
                earthBordersTask = result.meshes;
                result.meshes[1].position = new BABYLON.Vector3(0.2,6.8,-5.7); 
                result.meshes[1].scaling = new BABYLON.Vector3(1.001,1.001,1.001);  
                result.meshes[1].isVisible = false;
                result.meshes[1].setEnabled(false);
                earthBorders_object = result.meshes[1];  
                
          }), 
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "names.glb", earthScene).then(function (result) {
                earthNamesTask = result.meshes;
                result.meshes[0].scaling = new BABYLON.Vector3(1,1,-1); 
                result.meshes[0].position = new BABYLON.Vector3(2,6.8,-5.85); 
                result.meshes[0].isVisible = false; 
                result.meshes[0].setEnabled(false);
                earthNames_object = result.meshes[0];  
                
          }),
         
          BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/mbaye/", "MbayePipes.glb", earthScene).then(function (result) {
                // console.log(result.meshes);
                mbayeInitTask = result.meshes;
                
                result.meshes[0].position = new  BABYLON.Vector3(-467.95,285.39,642.78);
                result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1173,0.9809,-0.0854,-0.1289);
                result.meshes[0].scaling = new BABYLON.Vector3(20,20,-20);
                mbayeInit_object = result.meshes[0];
                mbayeInit_object.isPickable = false;
            

                result.meshes.forEach(function(m) {
                    m.isPickable = true;
                    if(m.name === "MbayeBody"){
                        let pbr = new BABYLON.PBRMaterial("pbr", earthScene);
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
    ]).then(() => {
        earthBorders_object.parent = earthNormal_object;
        earthNames_object.parent = earthNormal_object;
      
        isEarthModelLoaded = true;
        
        //set target view location of initCamera
        initCamera.target = new BABYLON.Vector3(0,0,0);
        initCamera.radius = 1360;

        initCamera.attachControl(canvas,true);
        isEarthSceneActive = true;

        enable_mbaye_utility();
        enable_earth_utility();
        
    });
}


function set_orbit_enability(val){
    for (const [name,orbit] of planetOrbitsObjMap.entries()) {
            orbit.isPickable = val;
    }
}//end of function

function set_constellation_enability(val){
    for (const [name,star] of starsObjMap.entries()) {
            star.isPickable = val;
    }
}//end of function

function set_solar_orbit_enability(val){
    solarOrbit.isVisible = val;
    solarOrbit.setEnabled(val);
}

function set_earth_gizmo_enability(){
    earthGizmo.attachedMesh = earthNormal_object;
}

var mbayeGizmoManager;
var isMbayeGizmoDragging;
function enable_mbaye_utility(){
    mbayeGizmoManager = new BABYLON.GizmoManager(earthScene);
    mbayeGizmoManager.attachableMeshes = [mbayeInit_object];
 
    // Initialize all gizmos
    mbayeGizmoManager.positionGizmoEnabled = false;
    mbayeGizmoManager.boundingBoxGizmoEnabled = false;
    mbayeGizmoManager.rotationGizmoEnabled = false;
    mbayeGizmoManager.scaleGizmoEnabled = false;

    // Modify gizmos based on keypress
    document.onkeydown = (evt)=>{
        //key press: p or P - enable position arrows
        //key press: e or E - enable scaling arrows 
        //key press: r or R - enable rotation arrows
        //key press: q or Q - enable bounding box for scaling

        if(earthScene && (evt.key == 'p' || evt.key == 'P' || evt.key =='R' ||  evt.key == 'r' || evt.key == '+' ||  evt.key == '-')){
            // Switch gizmo type
            mbayeGizmoManager.positionGizmoEnabled = false;
            mbayeGizmoManager.rotationGizmoEnabled = false;
            mbayeGizmoManager.scaleGizmoEnabled = false;
            mbayeGizmoManager.boundingBoxGizmoEnabled = false;

            if(evt.key == 'p' || evt.key == 'P'){
                mbayeGizmoManager.positionGizmoEnabled = true;
                //enable draggable behavior of Mbaye
                var sixDofDragBehavior = new BABYLON.SixDofDragBehavior();
                if(mbayeInit_object) mbayeInit_object.addBehavior(sixDofDragBehavior);

                mbayeGizmoManager.gizmos.positionGizmo.onDragStartObservable.add(function () {
                    isMbayeGizmoDragging = true;
                });
                mbayeGizmoManager.gizmos.positionGizmo.onDragEndObservable.add(function () {
                    isMbayeGizmoDragging = false;
                });
            }

            if(evt.key == 'r' || evt.key == 'R'){
                mbayeGizmoManager.rotationGizmoEnabled = true;
                mbayeGizmoManager.gizmos.rotationGizmo.onDragStartObservable.add(function () {
                    isMbayeGizmoDragging = true;
                });
                mbayeGizmoManager.gizmos.rotationGizmo.onDragEndObservable.add(function () {
                    isMbayeGizmoDragging = false;
                });
            }

            if(evt.key == '+'){
                mbaye_scale_up();
            }

            if(evt.key == '-'){
               mbaye_scale_down();
            }
        }//end of if keypress is p or r or + or -

        if(evt.key == 'o' || evt.key == 'O'){
            // hide the gizmo
            mbayeGizmoManager.attachToMesh(null);
            if(earthGizmo) earthGizmo.attachedMesh = null;
            isEarthWithGizmo = false;
        }

        if(evt.key == 'z' || evt.key == 'Z'){
            //make the earthGizmo scale bigger
            if(earthGizmo) earthGizmo.scaleRatio += 0.05;
            currentEarthGizmoScale = earthGizmo.scaleRatio;
           
        }
        if(evt.key == 'x' || evt.key == 'X'){
            //make the earthGizmo scale smaller
            if(earthGizmo) earthGizmo.scaleRatio -= 0.05;
            currentEarthGizmoScale = earthGizmo.scaleRatio;
        }

       

    }
    // Start by only enabling position control
    document.onkeydown({key: 'p'})
}//end of function





let earthGizmo;
//function that creates rotation gizmo for earth
function enable_earth_utility(){
    // Create gizmo
    var utilLayer = new BABYLON.UtilityLayerRenderer(earthScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    earthGizmo = new BABYLON.RotationGizmo(utilLayer);
}


            
var isInitViewClicked = false;

function earth_rotate_earth_with_mbaye(){
    // var text = astronautPartsMap.get("rotateEarthWithMbaye");
    
    //if(isFirstClickOfMbaye){
        if(mbayeInit_object.parent!=null){
            mbayeInit_object.setParent(null);
            // text.material.emissiveColor = BABYLON.Color3.White();
        }
        else{
            mbayeInit_object.setParent(earthNormal_object);
            // text.material.emissiveColor = BABYLON.Color3.Red();
        }
                
  //  }    
}

function earth_rotate(){
    // var text = astronautPartsMap.get("rotateEarth");
    if(isEarthRotating){
        isEarthRotating = false;
        // text.material.emissiveColor = BABYLON.Color3.White();
    }else{
        isEarthRotating = true;
        // text.material.emissiveColor = BABYLON.Color3.Red();
    }  
}


function earth_initial_view(){
    initCamera.position = new BABYLON.Vector3(-1135,486,1000);
    initCamera.radius = 1360;
    mbayeInit_object.setParent(null);
    mbayeInit_object.scaling = new BABYLON.Vector3(20,20,-20);
    mbayeInit_object.position = new  BABYLON.Vector3(-467.95,285.39,642.78);
    mbayeInit_object.rotationQuaternion = new BABYLON.Quaternion(0.1173,0.9809,-0.0854,-0.1289);
   
    set_solar_orbit_enability(true);
    // mbayeInit_object.rotationQuaternion = new BABYLON.Quaternion(0.9152,0.1417,0.3771,0.0089);
}


function earth_place_mbaye_on_earth(){
    if(earthScene.activeCamera == initCamera){
        if(mbayeInit_object.parent === null){
            mbayeInit_object.setParent(earthNormal_object);
        }
        earthNormal_object.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-120),0);
        earthNormal_object.position = new BABYLON.Vector3(0,0,0);

        mbayeInit_object.position = new BABYLON.Vector3(350,30,150);
        mbayeInit_object.rotation = new BABYLON.Vector3(0, BABYLON.Tools.ToRadians(-110),0);
        mbayeInit_object.scaling = new BABYLON.Vector3(5,5,-5);

        initCamera.alpha = initinitCameraState.alpha;
        initCamera.beta = initinitCameraState.beta;
        initCamera.position = initinitCameraPos;

        initCamera.radius = 600;
        initCamera.target = new BABYLON.Vector3(0,0,0);
        isEarthRotating = false;

        if(solarOrbit.isVisible) set_solar_orbit_enability(false);

    }
}

function earth_handle_gizmo(theGizmo){
    if(mbayeGizmoManager){
        // console.log(mbayeGizmoManager);
        
        if(theGizmo == 0){
            // 0 - turn off gizmos
            mbayeGizmoManager.attachToMesh(null);
            earthGizmo.attachedMesh = null;
        }else if(theGizmo == 2){
            //2 - change gizmo to rotation
            if(mbayeGizmoManager.positionGizmoEnabled) mbayeGizmoManager.positionGizmoEnabled = false;
            if(mbayeGizmoManager.boundingBoxGizmoEnabled) mbayeGizmoManager.boundingBoxGizmoEnabled = false;
            mbayeGizmoManager.rotationGizmoEnabled = true;
        }else if(theGizmo == 1){
             //1- change gizmo to position
            if(mbayeGizmoManager.boundingBoxGizmoEnabled) mbayeGizmoManager.boundingBoxGizmoEnabled = false;
            if(mbayeGizmoManager.rotationGizmoEnabled) mbayeGizmoManager.rotationGizmoEnabled = false;
            mbayeGizmoManager.positionGizmoEnabled = true;   
        }else if(theGizmo == 3){
             //3 - change gizmo to bounding box
            if(mbayeGizmoManager.positionGizmoEnabled) mbayeGizmoManager.positionGizmoEnabled = false;
            if(mbayeGizmoManager.rotationGizmoEnabled) mbayeGizmoManager.rotationGizmoEnabled = false;
            mbayeGizmoManager.boundingBoxGizmoEnabled = true;  
            mbaye_scale_up();
        }else if(theGizmo == 4){
             //3 - change gizmo to bounding box
            if(mbayeGizmoManager.positionGizmoEnabled) mbayeGizmoManager.positionGizmoEnabled = false;
            if(mbayeGizmoManager.rotationGizmoEnabled) mbayeGizmoManager.rotationGizmoEnabled = false;
            mbayeGizmoManager.boundingBoxGizmoEnabled = true;  
            mbaye_scale_down();
        }
    }
}//end of handle gizmo 

function mbaye_scale_up(){
    let isParentSetHere = false;
    if(mbayeInit_object.parent === null){
        mbayeInit_object.setParent(earthNormal_object);
        isParentSetHere = true;
    }
    var x = mbayeInit_object.scaling.x + 0.5;
    var y = mbayeInit_object.scaling.y - 0.5;
    var z = mbayeInit_object.scaling.z + 0.5;

    if(y < 0) y = mbayeInit_object.scaling.y - 0.5;
    else y = mbayeInit_object.scaling.y + 0.5;


    if(x>=30) x=30;
    if(y>=30) y=30;
    if(y<=-30) y=-30;
    if(z>=30) z=30;

    mbayeInit_object.scaling = new BABYLON.Vector3(x,y,z);
    mbayeGizmoManager.boundingBoxGizmoEnabled = true;
    if(isParentSetHere) mbayeInit_object.setParent(null);
}

function mbaye_scale_down(){
   let isParentSetHere = false;
   if(mbayeInit_object.parent === null){
        mbayeInit_object.setParent(earthNormal_object);
        isParentSetHere = true;
   }

    var x = mbayeInit_object.scaling.x - 0.5;
    var y = mbayeInit_object.scaling.y + 0.5;
    var z = mbayeInit_object.scaling.z - 0.5;

    if(x<1){
        x = mbayeInit_object.scaling.x;
        y = mbayeInit_object.scaling.y;
        z = mbayeInit_object.scaling.z;
    }

  
    mbayeInit_object.scaling = new BABYLON.Vector3(x,y,z);
    mbayeGizmoManager.boundingBoxGizmoEnabled = true;

    if(isParentSetHere) mbayeInit_object.setParent(null);

}


function earth_show_countries(){
    // var text = astronautPartsMap.get("showCountries");
    if(!isCountryOn){
        earthNames_object.setEnabled(true);
        isCountryOn = true;
        // text.material.emissiveColor = BABYLON.Color3.Red();
       
    }else{
        earthNames_object.setEnabled(false);
        // text.material.emissiveColor = BABYLON.Color3.White();
        isCountryOn = false;
    }
}

function earth_show_borders(){
    //  var text = astronautPartsMap.get("showBorders");
    if(!isBorderOn){
        earthBorders_object.setEnabled(true);
        isBorderOn = true;
        // text.material.emissiveColor = BABYLON.Color3.Red();
    }else{
        earthBorders_object.setEnabled(false);
        isBorderOn = false;
        // text.material.emissiveColor = BABYLON.Color3.White();
    }
}

$("#infoIcon").on('click',function(){
    $('#instruction-left-div').toggle();
    $('#infoIconTextdown').toggle();
    $('#infoIconTextup').toggle();
    $('#infoIconTextastro').toggle();
  });



let isPlanetOrbitVisible = true;                //var to check if the orbits will show label and if the solar orbit is visible
let isEarthWithGizmo = false;
function addMouseListener(){
    
        var onPointerDown = function (evt) {
            if(earthScene) var pickinfo = earthScene.pick(earthScene.pointerX, earthScene.pointerY);
            else return;
            if(pickinfo.hit){
                var theMesh = pickinfo.pickedMesh;
                // console.log("The mesh clicked: ", theMesh.name, theMesh.position, theMesh.rotationQuaternion);
                
                if(theMesh.name ==="MbayeBody"){    
                    if(isPlanetOrbitVisible){
                        // set_orbit_enability(false);
                        set_solar_orbit_enability(false);
                        isPlanetOrbitVisible = !isPlanetOrbitVisible;
                    }
                    mbayeGizmoManager.attachToMesh(mbayeInit_object);
                    isEarthRotating = false;
                }

                if(earthCountriesMap.has(theMesh.name)){
                    if(theMesh.name === "Sao_Tome_and_Principe") showPage("São_Tomé_and_Príncipe");   
                    else showPage(theMesh.name);
                }

                if(planetsLinkTextMap.has(theMesh.name)){
                    let res = planetsLinkTextMap.get(theMesh.name);
                    checkScreenAndDoubleClick(res);
                }
               
                
           }//end of pickinfo hit
           
          
        }//end of on pointer down function

        var onPointerUp = function () {
                 isEarthClicked = false;
              
           
        }//end of on pointer up function

        var onPointerMove = function (evt) {
            if (!isEarthClicked) {
                 return;
            }
            if(currentDraggableMesh == "MBAYE"){
                var current = earthScene.pick(earthScene.pointerX, earthScene.pointerY);
            }
               
                
        }//end of on pointer move function

        canvas.addEventListener("pointerdown", onPointerDown, false);
        canvas.addEventListener("pointerup", onPointerUp, false);
        canvas.addEventListener("pointermove", onPointerMove, false);


        //remove the text span on dispose
        earthScene.onDispose = function() {
            //related to the drag and drop
            canvas.removeEventListener("pointerdown", onPointerDown);
            canvas.removeEventListener("pointerup", onPointerUp);
            canvas.removeEventListener("pointermove", onPointerMove);

        };
    
}//end of listen to movement function


let isPlanetClicked;
function checkScreenAndDoubleClick(details){
    
    let theTitle = details[0];
    let theLink = details[1];


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
        show_alert_box(theTitle,theLink);
    }
    
}

var isEarthRotating = true;
function set_earth_animation(val){
    isEarthRotating = val;
}

function show_alert_box(titleText,path){
    Swal.fire({
        title: "Are you sure you want to view the "+titleText+" page? ",
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
            window.location.href = path;
        }
      });
}



function create_planet_labels(){
    for(const [name,val] of planet_labels_map.entries()){
        //val = [width, height, pos, rot]
        init_planet_label(name,"front/images3D/participateScene/planetTexts/"+name+".png",val[0], val[1],val[2],val[3]);
    }
  
}

function init_planet_label(name,matlPath,w,h,pos, rot){
    var plane = BABYLON.MeshBuilder.CreatePlane(name, {height:h,width:w}, earthScene);
    plane.position = new BABYLON.Vector3(pos.x,pos.y,pos.z);
    plane.rotationQuaternion = new BABYLON.Quaternion(rot.x,rot.y,rot.z,rot.w);
    
    let planeMatl = new BABYLON.StandardMaterial(name+"Matl", earthScene);

    planeMatl.diffuseTexture = new BABYLON.Texture(matlPath, earthScene);
    planeMatl.opacityTexture = new BABYLON.Texture(matlPath, earthScene);
    planeMatl.hasAlpha = true;
    plane.isPickable = false;
  
    plane.material = planeMatl;

    return plane;
}



/* related to the astronaut tools features */
let isAstroToolsActive = false;
$('#astronautToolIcon').on('click', function(){
    if(!isAstroToolsActive){
        $('.astronaut-rotate-controls').css('display','flex');
        $('.astronaut-scale-controls').show();
        show_astro_backpack(true);
    }else{
        $('.astronaut-rotate-controls').hide();
        $('.astronaut-scale-controls').hide();
        show_astro_backpack(false);
    }
    isAstroToolsActive = !isAstroToolsActive;
});

$('.astro-rotate-left').on('click', function(){
    astronaut_obj.rotation.y += BABYLON.Tools.ToRadians(10);
});

$('.astro-rotate-right').on('click', function(){
    astronaut_obj.rotation.y += BABYLON.Tools.ToRadians(-10);
});

$('.astro-scale-up').on('click', function(){
    set_astronaut_scaling("up");
});

$('.astro-scale-down').on('click', function(){
    set_astronaut_scaling("down");
});

$('.astro-reset').on('click', function(){
    reset_astro();
});



//create the game engine
var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);



let isImgPathSet = false;
let img_path;
let user_gender;
let isSceneLoaded = false;
$(window).on('load',function(){
    isImgPathSet = true;
    img_path = document.getElementById('userPhoto').src;
    isSceneLoaded = true;
});

//create the scene
var theScene = createEarthScene();


theScene.executeWhenReady(function () {  
    document.getElementById("loadingScreenPercent").style.visibility = "hidden";
    document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
    document.getElementById("loadingScreenDiv").remove();

    //scene optimizer
    var options = new BABYLON.SceneOptimizerOptions();
    options.addOptimization(new BABYLON.HardwareScalingOptimization(0, 1.5));
    var optimizer = new BABYLON.SceneOptimizer(theScene, options);


    if(isSmallDevice() || isMobile()){
        //if mobile or tablet, always show the photo of user
        if(sun){
            sun.material.diffuseTexture = initVideo;
        }

        //show the buttons if mobile or tablet to control the astronaut scaling and rotation
        $('.sliding-images-controls').show();
    }


    engine.runRenderLoop(function () {
        if(theScene){
            //render the scene
            theScene.render();
            if(isEarthSceneActive) startAstronautScene.render();//earthFlowerScene.render();
            if(isEarthRotating && earthNormal_object){
                earthNormal_object.rotation.y = Math.PI / 2;
                earthNormal_object.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            }
        }    
        if(isImgPathSet && theAstroFace){
            isImgPathSet = false;
            create_face_texture(img_path);
        }
    }); 
}); 

// window resize handler
window.addEventListener("resize", function(event) {
    engine.resize();
    testOrientation();
    testFullscreen();
}, false);


//check orientation of screen when page is loaded
$( document ).ready(function() {
    testOrientation();
});


