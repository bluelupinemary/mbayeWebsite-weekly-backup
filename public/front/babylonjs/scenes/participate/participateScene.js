/*===============================================START OF MOVE MBAYE SCENE======================================================================*/
//define the earthScene's scene
var earthScene;  
                                                                    //var to handle the earth scene
//define the earthScene's camera
var earthCamera;                                                    //var to hold the first camera upon loading the earth scene
var exploreCamera;                                                  //camera for explore earth feature

//define the earthScene's light
var earthLight;                                                     //active hemispheric light for the earth scene
var earthLight2;

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
var mbayeEarth_object;                                              //var for the earthScene's mbaye mesh
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
var earthSkybox;

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
var earthGizmo;                                                    //var to hold the roation gizmo of earth


//initial values of earth's rotation and position for the resetPosition button
var initEarthCameraState = {alpha:0,beta:0};
var initEarthCameraPos = {x:-1135,y:486,z:995};
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
let isEarthRotating = true;
let isOnOverPlanetOrbitActive = true;
let isEarthSceneActive = false;
var planetAxis = new BABYLON.Vector3(0,4,0);  
//rotation speed      
var redAngle = 0.01;   
var yellowAngle = 0.02;
var grayAngle = -0.01;
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
    // if(scene) scene.dispose();    
    // if(designScene) designScene.dispose();                                         //if main scene is existing, dispose it
    // //console.log("inside earth scene 2");
   
    engine.enableOfflineSupport = true;
    // initialize_variables();                                             //re-initialize some of global variables' values in MainSceneJS.js

    //enable the loading screen
    // isLoadingScreenOn = true;
    // startAstronautScene = createAstronautScene();
    earthScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene

    // engine.loadingScreen = new loadingScreenHome(earthScene);
    // engine.displayLoadingUI();


    earthCamera = create_earth_camera();                                //create earth scene's camera
    create_earth_light();                                  //create earth scene's light
    earthSkybox = create_earth_skybox();                                     //create earth scene's skybox
    // create_orbit();
    // load_earth_mesh2();

    

                                                    //load the earth, borders, countries and mbaye for this scene
   
  
    // // load_earth_sea_mesh();                                              //load the sea creatures meshes for this scene

                                                                    
    // var hdrTextureEarth = new BABYLON.CubeTexture.CreateFromPrefilteredData("textures/dds/environmentSpecular.env", earthScene);    //add HDR texture so that mbaye's textures would be rendered correctly
    // hdrTextureEarth.gammaSpace = false;
    // hdrTextureEarth.level = 0.5;
    // earthScene.environmentTexture = hdrTextureEarth;                    //set the environment's texture



    // // create_earth_gui();                                                      //create the earth scene's GUI
    // create_earth_planets();                                             //create the earth scene's planets
    // addMouseListener();
    // enable_webcamera();
    // create_planet_orbit();
    // // create_earth_constellations();
    // load_constellation_plane();

    // earthScene.autoClear = false;


    return earthScene;
} //end of create earth scene function


//function to dispose scene objects before creating a new one
function remove_earth_scene_objects(){

    earthMercury.dispose();
    earthVenus.dispose();
    earthMars.dispose();
    earthJupiter.dispose();
    earthSaturn.dispose();
    earthUranus.dispose();
    earthNeptune.dispose();
    earthPluto.dispose();
    earthMoon.dispose();
    sun.dispose();

    if(planetsOrbitArr.length > 0 ){
        for(var i=0;i<planetsOrbitArr.length;i++){
            planetsOrbitArr[i].dispose();
        }
    }


    earthNormal_object.dispose();                                         
    earthBorders_object.dispose();                                          
    earthNames_object.dispose();                                             
    mbayeEarth_object.dispose(); 
    earthSkybox.dispose();


    //sea objects
    // dolphinEarth_object.dispose();
    // starfishEarth_object.dispose();
    // crabEarth_object.dispose();
    // swordfishEarth_object.dispose();

    //constellations
    leoStars.dispose();
    ariesStars.dispose();
    taurusStars.dispose();
    piscesStars.dispose();
    scorpioStars.dispose();
    sagittariusStars.dispose();
    virgoStars.dispose();
    libraStars.dispose();
    geminiStars.dispose();
    capricornStars.dispose();
    aquariusStars.dispose();
    cancerStars.dispose();

    earthMercury = null;
    earthVenus = null;
    earthMars = null;
    earthJupiter = null;
    earthSaturn = null;
    earthUranus = null;
    earthNeptune = null;
    earthPluto = null;
    earthMoon = null;
    sun  = null;

    earthNormal_object = null;            
    earthBorders_object = null;                                 
    earthNames_object = null;                                   
    mbayeEarth_object = null;

    //constellations
    leoStars = null;
    ariesStars = null;
    taurusStars = null;
    piscesStars = null;
    scorpioStars = null;
    sagittariusStars = null;
    virgoStars = null;
    libraStars = null;
    geminiStars = null;
    capricornStars = null;
    aquariusStars = null;
    cancerStars = null;

    //sea objects
    // dolphinEarth_object = null;
    // starfishEarth_object = null;
    // crabEarth_object = null;
    earthSkybox = null;   
    myVideo.dispose();
    webCamScreen.dispose();

    hideWiki();

    //remove astronaut scene objects
    remove_astro_scene_objects();



   
    // ps.dispose();
}
//function that creates the earthScene's cameras
function create_earth_camera(){
    var camera = new BABYLON.ArcRotateCamera("Earth Camera",BABYLON.Tools.ToRadians(0),BABYLON.Tools.ToRadians(0),30.0, new BABYLON.Vector3(-1135,486,1000),earthScene);
    
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
    earthScene.activeCamera = camera;

    camera.viewport = new BABYLON.Viewport(0, 0, 1, 1);
 
    return camera;
}//end of create camera function
       

//function that creates earthScene's hemispheric light
function create_earth_light(){
    var light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(20,0,300), earthScene);
    light.radius = 300;
    light.specular = new BABYLON.Color3(0,0,0);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.groundColor = new BABYLON.Color3(1,1,1);
    light.intensity = 1.5;


    earthLight2 = new BABYLON.HemisphericLight("hemilightEarth",  new BABYLON.Vector3(20,0,300), earthScene);
    earthLight2.radius = 300;
    earthLight2.diffuse = new BABYLON.Color3(1,1,1);
    earthLight2.groundColor = new BABYLON.Color3(0.2,0.2,0.2);
    earthLight2.intensity = 1;


   //return light;
}//end of create earth light function


function create_orbit(){
    orbit = BABYLON.Mesh.CreateGround("orbit", 3000, 2600, 1, earthScene);
    orbit.isPickable = false;
    orbit.scaling = new BABYLON.Vector3(2.5,2.5,2.5);
    orbit.position = new BABYLON.Vector3(200,0,-100);
    orbit.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(-10),BABYLON.Tools.ToRadians(180),BABYLON.Tools.ToRadians(0));

    var orbitMatl = new BABYLON.StandardMaterial("orbitMatl", earthScene);
    orbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/min/earthSceneOrbit2.png", earthScene);
    orbitMatl.diffuseTexture.hasAlpha = true;
    orbitMatl.backFaceCulling = false;
    orbit.material = orbitMatl;
    orbit.material.freeze();
    orbit.freezeWorldMatrix();
    orbit.setEnabled(false);
    orbit.isVisible =false; 
}

function create_planet_orbit(){

    var earthOrbit = BABYLON.MeshBuilder.CreateDisc("Earth", {radius:200, tessellation: 0}, earthScene);
    earthOrbit.scaling = new BABYLON.Vector3(1.1,1.1,1.1);
    earthOrbit.position = new BABYLON.Vector3(0,0,0);
    earthOrbit.rotation.x =  BABYLON.Tools.ToRadians(90);

    var earthOrbitMatl = new BABYLON.StandardMaterial("planetOrbitMatl", earthScene);
    earthOrbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/planetorbit2.png", earthScene);
    earthOrbitMatl.diffuseTexture.hasAlpha = true;
    earthOrbit.material = earthOrbitMatl;
    earthOrbit.material.backFaceCulling = false;
    earthOrbit.freezeWorldMatrix();
    earthOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(earthOrbit);


    var venusOrbit = BABYLON.MeshBuilder.CreateDisc("Venus", {radius:200, tessellation: 0}, earthScene);
    venusOrbit.position = new BABYLON.Vector3(-317.946,90.369,-681.065);
    venusOrbit.rotation.x =  BABYLON.Tools.ToRadians(100);

    var venusOrbitMatl = new BABYLON.StandardMaterial("planetOrbitMatl", earthScene);
    venusOrbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/planetorbit.png", earthScene);
    venusOrbit.scaling = new BABYLON.Vector3(0.4,0.4,0.4);
    venusOrbitMatl.diffuseTexture.hasAlpha = true;
    venusOrbit.material = venusOrbitMatl;
    venusOrbit.material.backFaceCulling = false;
    venusOrbit.freezeWorldMatrix();
    earthOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(venusOrbit);


    var marsOrbit = BABYLON.MeshBuilder.CreateDisc("Mars", {radius:200, tessellation: 0}, earthScene);
    marsOrbit.position = new BABYLON.Vector3(-754.426,-45.511,78.592);
    marsOrbit.rotation.x =  BABYLON.Tools.ToRadians(90);

    var marsOrbitMatl = new BABYLON.StandardMaterial("planetOrbitMatl", earthScene);
    marsOrbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/planetorbit3.png", earthScene);
    marsOrbit.scaling = new BABYLON.Vector3(0.25,0.25,0.25);
    marsOrbitMatl.diffuseTexture.hasAlpha = true;
    marsOrbit.material = venusOrbitMatl;
    marsOrbit.material.backFaceCulling = false;
    marsOrbit.freezeWorldMatrix();
    marsOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(marsOrbit);


    var jupiterOrbit = marsOrbit.createInstance("Jupiter");
    jupiterOrbit.position = new BABYLON.Vector3(210.424,-145.791,729.638);
    jupiterOrbit.scaling = new BABYLON.Vector3(0.4,0.4,0.4);
    jupiterOrbit.freezeWorldMatrix();
    // jupiterOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(jupiterOrbit);

    var saturnOrbit = venusOrbit.createInstance("Saturn");
    saturnOrbit.position = new BABYLON.Vector3(2568.391,456.358,-2411.465);
    saturnOrbit.rotationQuaternion = new BABYLON.Quaternion(-0.4710,0.112,0.142,0.859);
    saturnOrbit.scaling = new BABYLON.Vector3(1.1,1.1,1.1);
    saturnOrbit.freezeWorldMatrix();
    // saturnOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(saturnOrbit);

    
    var neptuneOrbit = BABYLON.MeshBuilder.CreateDisc("Neptune", {radius:200, tessellation: 0}, earthScene);
    neptuneOrbit.position = new BABYLON.Vector3(2833.940,-1.771,-79.771);
    neptuneOrbit.rotation.x =  BABYLON.Tools.ToRadians(110);

    var neptuneOrbitMatl = new BABYLON.StandardMaterial("planetOrbitMatl", earthScene);
    neptuneOrbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/planetorbit6.png", earthScene);
    neptuneOrbit.scaling = new BABYLON.Vector3(0.9,0.9,0.9);
    neptuneOrbitMatl.diffuseTexture.hasAlpha = true;
    neptuneOrbit.material = neptuneOrbitMatl;
    neptuneOrbit.material.backFaceCulling = false;
    neptuneOrbit.freezeWorldMatrix();
    neptuneOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(neptuneOrbit);



    var mercuryOrbit = BABYLON.MeshBuilder.CreateDisc("Mercury", {radius:200, tessellation: 0}, earthScene);
    mercuryOrbit.position = new BABYLON.Vector3(-444.158,226.007,-1427.216);
    mercuryOrbit.rotation.x =  BABYLON.Tools.ToRadians(110);

    var mercuryOrbitMatl = new BABYLON.StandardMaterial("planetOrbitMatl2", earthScene);
    mercuryOrbitMatl.diffuseTexture = new BABYLON.Texture("textures/planets2/planetorbit5.png", earthScene);
    mercuryOrbit.scaling = new BABYLON.Vector3(0.3,0.3,0.3);
    mercuryOrbitMatl.diffuseTexture.hasAlpha = true;
    mercuryOrbit.material = mercuryOrbitMatl    ;
    mercuryOrbit.material.backFaceCulling = false;
    mercuryOrbit.freezeWorldMatrix();
    mercuryOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(mercuryOrbit);

    var uranusOrbit = mercuryOrbit.createInstance("Uranus");
    uranusOrbit.position = new BABYLON.Vector3(-2100.472,-98.486,339.091);
    uranusOrbit.scaling = new BABYLON.Vector3(0.5,0.5,0.5);
    uranusOrbit.freezeWorldMatrix();
    // uranusOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(uranusOrbit);

    var plutoOrbit = venusOrbit.createInstance("Pluto");
    plutoOrbit.position = new BABYLON.Vector3(2299.891,400.604,500.918);
    plutoOrbit.rotationQuaternion = new BABYLON.Quaternion(0.692,0.143,0.143,0.692);
    plutoOrbit.scaling = new BABYLON.Vector3(0.4,0.4,0.4);
    plutoOrbit.freezeWorldMatrix();
    // plutoOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(plutoOrbit);

    var moonOrbit = neptuneOrbit.createInstance("Moon");
    moonOrbit.position = new BABYLON.Vector3(329.613,157.802,-263.126);
    moonOrbit.scaling = new BABYLON.Vector3(0.25,0.25,0.25);
    moonOrbit.freezeWorldMatrix();
    // moonOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(moonOrbit);

    var sunOrbit = neptuneOrbit.createInstance("Sun");
    sunOrbit.position = new BABYLON.Vector3(-80.91,308.13,-2082.51);
    sunOrbit.scaling = new BABYLON.Vector3(0.8,0.8,0.8);
    sunOrbit.freezeWorldMatrix();
    // sunOrbit.convertToUnIndexedMesh();
    planetsOrbitArr.push(sunOrbit);


    for(var i=0;i<planetsOrbitArr.length;i++){
        planetsOrbitArr[i].actionManager = new BABYLON.ActionManager(earthScene);
        planetsOrbitArr[i].actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
            )
        );
        planetsOrbitArr[i].actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOutTrigger,
                onOutPlanetOrbit
            )
        );
    }//end of for loop
}//end of fxn



// var earthNormal_object2;
var earthNames_object2;
var earthSea_obj;
var water;
var mbayeEarthTask;
function load_earth_mesh2(){

     Promise.all([
        // BABYLON.SceneLoader.ImportMeshAsync(null, "objects/", "Mbaye-transparent-panels2.gltf", buildScene).then(function (result) {
          BABYLON.SceneLoader.ImportMeshAsync(null, "objects/sphere/earthScene/", "earth122319.babylon", earthScene, 
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
                    earthLight2.includedOnlyMeshes.push(result.meshes[i]);
                    // result.meshes[i].scaling = new BABYLON.Vector3(0.6,0.6,0.6);
                    result.meshes[i].isPickable = true;
                    if(result.meshes[i].name === "Sea"){
                        water = new BABYLON.WaterMaterial("water", earthScene, new BABYLON.Vector2(2048, 2048));
                        water.backFaceCulling = true;
                        water.bumpTexture = new BABYLON.Texture("textures/water/waterbump.png", earthScene);
                        water.windForce = 10;
                        water.windDirection = new BABYLON.Vector2(-1,0);
                        water.waveHeight = 0.2;
                        water.bumpHeight = 0.3;
                        water.waveLength = 0.1;
                        water.colorBlendFactor = 0.25714;
                        water.waterColor = new BABYLON.Color3(0.31428,0.2,0.80357);

                        water.addToRenderList(earthSkybox);
                       result.meshes[i].material = water;
                    }
                }
                earthNormal_object = result.meshes[9];      
          }),
          BABYLON.SceneLoader.ImportMeshAsync(null, "objects/sphere/earthScene/", "border.babylon", earthScene).then(function (result) {
                // console.log(result.meshes);
                earthBordersTask = result.meshes;
                result.meshes[1].position = new BABYLON.Vector3(0.2,6.8,-5.7); 
                result.meshes[1].scaling = new BABYLON.Vector3(1.001,1.001,1.001);  
                // result.meshes[1].scaling = new BABYLON.Vector3(0.603,0.603,0.603);  
                // result.meshes[1].rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-50),0);
                earthBorders_object = result.meshes[1];  
          }), 
          BABYLON.SceneLoader.ImportMeshAsync(null, "objects/sphere/earthScene/", "names.glb", earthScene).then(function (result) {
                earthNamesTask = result.meshes;
                result.meshes[0].scaling = new BABYLON.Vector3(1,1,-1); 
                result.meshes[0].position = new BABYLON.Vector3(2,6.8,-5.85);  
                earthNames_object = result.meshes[0];  
                
          }),
         
          BABYLON.SceneLoader.ImportMeshAsync(null, "assets/mbaye/", "MbayePipes0107.glb", earthScene).then(function (result) {
            // console.log(result.meshes);
                mbayeEarthTask = result.meshes;
                
               // mbayeEarth_object.position = new BABYLON.Vector3(0,300,0);
                result.meshes[0].position = new  BABYLON.Vector3(-467.95,285.39,642.78);
                result.meshes[0].rotationQuaternion = new BABYLON.Quaternion(0.1173,0.9809,-0.0854,-0.1289);
                // //result.meshes[0].rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(8),BABYLON.Tools.ToRadians(-135),BABYLON.Tools.ToRadians(-15));
                result.meshes[0].scaling = new BABYLON.Vector3(20,20,-20);
                mbayeEarth_object = result.meshes[0];
                mbayeEarth_object.isPickable = false;
               
               
                mbayeEarthFeet_object = result.meshes[4];

                var pbr = new BABYLON.PBRMaterial("pbr", earthScene);
                // pbr.reflectionTexture = rp.cubeTexture
      
                for(let i=0;i<result.meshes.length;i++){
                    // console.log("material here", mbayeEarthTask[i]);
                    
                    if(result.meshes[i].name == "Mbaye_primitive1" || result.meshes[i].name == "Mbaye_primitive0"){
                        result.meshes[i].material = pbr;
                        result.meshes[i].material.backFaceCulling = false;
                    }
                }//end of for loop

            
                pbr.albedoColor = new BABYLON.Color3(0.7,0.7,0.7);
                pbr.emissiveColor = new BABYLON.Color3(0,0,0);
                pbr.metallic = 1;
                pbr.metallicF0Factor = 0.50;
                pbr.roughness = 0.1;

                pbr.microSurface = 1; // Let the texture controls the value 
                        
          })
    ]).then(() => {
        // if(mbaye_object_with_panels){
        // // load_earth_mbaye();
        //     load_mbaye_with_panels();
        // }
      
      
        


        earthBorders_object.setEnabled(false);
        earthNames_object.setEnabled(false);
        
        earthSouthAmerica = earthNormalMesh[1];
        earthNorthAmerica = earthNormalMesh[7];

         for(var i=1;i<earthNormalMesh.length;i++){
            earthNormalMesh[i].actionManager = new BABYLON.ActionManager(earthScene);
            earthNormalMesh[i].actionManager.registerAction(
                new BABYLON.ExecuteCodeAction(
                    BABYLON.ActionManager.OnPointerOverTrigger,
                    onOverPlanet
                )
            );
            earthNormalMesh[i].actionManager.registerAction(
                new BABYLON.ExecuteCodeAction(
                    BABYLON.ActionManager.OnPointerOutTrigger,
                    onOutPlanet
                )
            );
        }



        earthBorders_object.parent = earthNormal_object;
        earthNames_object.parent = earthNormal_object;
      

        isEarthModelLoaded = true;
        
        //set target view location of earthCamera
        earthCamera.target = new BABYLON.Vector3(0,0,0);
        earthCamera.radius = 1360;

        

        enable_mbaye_utility(mbayeEarth_object, earthNormal_object);
        attach_gizmo_to_earth();
        enableEarthUtility();

        orbit.setEnabled(true);
        orbit.isVisible = true;
       

        setTimeout(function(){
            earthCamera.attachControl(canvas,true);
           isEarthSceneActive = true;
            fullscreenGUI.removeControl(loadingBG);
             mbayeEarth_object.isPickable = true;
            // document.getElementById("loadingScreenPercent").remove();
            document.getElementById("loadingScreenPercent").style.visibility = "hidden";
            document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
        },2000);
       
    });
}

function load_earth_sea_mesh(){
    var assetsManager2 = new BABYLON.AssetsManager(earthScene);

    var dolphinTask = assetsManager2.addMeshTask("dolphinTask", "", "objects/trials/", "dolphinTrialV9.glb");
    var starfishTask = assetsManager2.addMeshTask("starfishTask", "", "objects/seaObjects/", "starfish.gltf");
    var crabTask = assetsManager2.addMeshTask("crabTask", "", "objects/seaObjects/", "crab.gltf");
    //var swordfishTask = assetsManager2.addMeshTask("swordfishTask", "", "objects/trials/", "swordfishTrialV2.glb");
   
    //handles the user-mesh interaction once the asset manager is done on loading all the assetsManager
   assetsManager2.onFinish = function (tasks) {
        var dolphinMesh = dolphinTask.loadedMeshes;
        dolphinEarth_object = dolphinTask.loadedMeshes[0];
        dolphinEarth_object.position = new BABYLON.Vector3(0,300,0);
        // dolphinMain_object.isVisible = false;
        // dolphinMain_object.setEnabled(false);

        starfishEarth_object = starfishTask.loadedMeshes[0];
        starfishEarth_object.position = new BABYLON.Vector3(20,297,0);
        starfishEarth_object.scaling = new BABYLON.Vector3(1.5,1.5,1.5);

        crabEarth_object = crabTask.loadedMeshes[0];
        crabEarth_object.position = new BABYLON.Vector3(0,296,25);
        crabEarth_object.scaling = new BABYLON.Vector3(2,2,2);
        

        // var swordfishMesh = swordfishTask.loadedMeshes;
        // swordfishEarth_object = swordfishTask.loadedMeshes[0];
        // swordfishEarth_object.position = new BABYLON.Vector3(20,298,-20);

        isEarthSeaObjectLoaded = true;
    

        // dolphinEarth_object.parent = earthNormal_object;
        // swordfishEarth_object.parent = earthNormal_object;
        // console.log(dolphinEarth_object);
      

        //on mouse over event listeners for dolphin object
        // var dolphinTemp_object = dolphinTask.loadedMeshes[1];
        // var swordfishTemp_object = swordfishTask.loadedMeshes[1];

        // dolphinTemp_object.actionManager = new BABYLON.ActionManager(scene);
        // swordfishTemp_object.actionManager = new BABYLON.ActionManager(scene);

         };//end of asset manager

          
        //load the mesh thru the assetsManager
        assetsManager2.load();



} //end of load earth sea mesh function

function set_earth_mbaye_material(){
    

}


function set_earth_water_material(){
            //add water material to earth
      
}

var mbayeGizmoManager;
//function that enables movement, scaling, rotation of Mbaye through the babylon gizmo function
function enable_mbaye_utility(mbayeMesh, earthNormalMesh){
    mbayeGizmoManager = new BABYLON.GizmoManager(earthScene);
    //mbayeGizmoManager.attachableMeshes = [mbayeMesh];                                           //this gizmo is only attachable to mbaye mesh
    mbayeGizmoManager.attachableMeshes = [mbayeMesh,importedPanel[0]];
    //mbayeGizmoManager.attachableMeshes = [webCamScreen];
 
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
                if(mbayeEarth_object) mbayeEarth_object.addBehavior(sixDofDragBehavior);
            }

            if(evt.key == 'r' || evt.key == 'R'){
                mbayeGizmoManager.rotationGizmoEnabled = true;
            }

            if(evt.key == '+'){
                earth_mbaye_scale_up();
               //  let isParentSetHere = false;
               // if(mbayeEarth_object.parent === null){
               //      mbayeEarth_object.setParent(earthNormal_object);
               //      isParentSetHere = true;
               // }
               //  //mbayeGizmoManager.scaleGizmoEnabled = true;
               //  var x = mbayeEarth_object.scaling.x + 0.1;
               //  var y = mbayeEarth_object.scaling.y - 0.1;
               //  var z = mbayeEarth_object.scaling.z + 0.1;

                
               //  if(mbaye_object_with_panels) z = mbayeEarth_object.scaling.z - 0.1;
               //  else z = mbayeEarth_object.scaling.z + 0.1;
                

               //  if(y < 0) y = mbayeEarth_object.scaling.y - 0.1;
               //  else y = mbayeEarth_object.scaling.y + 0.1;


               //  if(x>=20) x=20;
               //  if(y>=20) y=20;
               //  if(y<=-20) y=-20;
               //  if(z>=20) z=20;
                
               //  mbayeEarth_object.scaling = new BABYLON.Vector3(x,y,z);
               //  mbayeGizmoManager.boundingBoxGizmoEnabled = true;
               //  if(isParentSetHere) mbayeEarth_object.setParent(null);
            }

            if(evt.key == '-'){
                earth_mbaye_scale_down();
            //    // mbayeGizmoManager.scaleGizmoEnabled = true;
            //    let isParentSetHere = false;
            //    if(mbayeEarth_object.parent === null){
            //         mbayeEarth_object.setParent(earthNormal_object);
            //         isParentSetHere = true;
            //    }

            //     var x = mbayeEarth_object.scaling.x - 0.1;
            //     var y = mbayeEarth_object.scaling.y + 0.1;
            //     var z = mbayeEarth_object.scaling.z - 0.1;


            //     // if(mbaye_object_with_panels) z = mbayeEarth_object.scaling.z - 0.1;
            //     // else z = mbayeEarth_object.scaling.z + 0.1;
                

            //     // if(y < 0) y = mbayeEarth_object.scaling.y + 0.1;
            //     // else y = mbayeEarth_object.scaling.y - 0.1;

            //     if(x<1){
            //         x = mbayeEarth_object.scaling.x;
            //         y = mbayeEarth_object.scaling.y;
            //         z = mbayeEarth_object.scaling.z;
            //     }

            //     // if(y<=-1) y= -1;
            //     // if(z<1) z = 1;

              
            //     console.log(x,y,z);
            //    // console.log("size: ", x,y,z);
            //     mbayeEarth_object.scaling = new BABYLON.Vector3(x,y,z);
            //     mbayeGizmoManager.boundingBoxGizmoEnabled = true;

            //     if(isParentSetHere) mbayeEarth_object.setParent(null);
             }
          
        }

        if(evt.key == 'o' || evt.key == 'O'){
            // hide the gizmo
            mbayeGizmoManager.attachToMesh(null);
            if(earthGizmo) earthGizmo.attachedMesh = null;
            isMbayeWithGizmo = false;
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

        if(evt.key == 'i' || evt.key == 'I'){
            //move earth camera up
            //console.log(earthCamera);
           if(earthScene.activeCamera == earthCamera){
                earthCamTargetY += 10;
                if(earthCamTargetY <= 2000){
                     earthCamera.position = new BABYLON.Vector3(earthCamera.position.x,earthCamera.position.y+10,earthCamera.position.z);
                     earthCamera.target = new BABYLON.Vector3(0,earthCamTargetY,0);
                }else{
                    earthCamTargetY = 2000;   //limit the position of camera so it won't go beyond the skybox
                }            
            }
        }
        if(evt.key == 'k' || evt.key == 'K'){
            //move earth camera down
           if(earthScene.activeCamera == earthCamera){
              earthCamTargetY -= 10;
                if(earthCamTargetY >= -2000){
                     earthCamera.position = new BABYLON.Vector3(earthCamera.position.x,earthCamera.position.y-10,earthCamera.position.z);
                     earthCamera.target = new BABYLON.Vector3(0,earthCamTargetY,0);
                }else{
                    earthCamTargetY = -2000;   //limit the position of camera so it won't go beyond the skybox
                }            
            }
        }



        if(evt.key == 'q' || evt.key == 'Q'){
            if(earthScene.activeCamera == exploreCamerax){
                //var temp = exploreCamera.rotation.z + 0.01;
                var x = exploreCamera.rotation.x;
                var y = exploreCamera.rotation.y;
                var z = exploreCamera.rotation.z-0.005;
                exploreCamera.rotation = new BABYLON.Vector3(x,y,z);
                currExploreCameraRotZ = z;
                //e
                //console.log(exploreCamera);
            }
        }

         if(evt.key == 'e' || evt.key == 'E'){
            if(earthScene.activeCamera == exploreCamera){
                //var temp = exploreCamera.rotation.z + 0.01;
                var x = exploreCamera.rotation.x;
                var y = exploreCamera.rotation.y;
                var z = exploreCamera.rotation.z+0.005;
                exploreCamera.rotation = new BABYLON.Vector3(x,y,z);
                currExploreCameraRotZ = z;
                //e
               // console.log(exploreCamera);
            }
        }

    }
    // Start by only enabling position control
    document.onkeydown({key: 'p'})
}//end of enable mbaye utility function


//function that creates rotation gizmo for earth
function enableEarthUtility(){
    // Create gizmo
    var utilLayer = new BABYLON.UtilityLayerRenderer(earthScene)
    utilLayer.utilityLayerScene.autoClearDepthAndStencil = false;
    earthGizmo = new BABYLON.RotationGizmo(utilLayer);

    //console.log(earthGizmo);
}


//function that listens to mouse wheel scrolling
function listenToWheelScroll(){
    if(earthScene.activeCamera == exploreCamera){  
        earthScene.onPrePointerObservable.add( function(pointerInfo, eventState) {
            var event = pointerInfo.event;
            var delta = 0;
            if (event.wheelDelta) {
                delta = event.wheelDelta;
            }
            else if (event.detail) {
                delta = -event.detail;
            }
            if (delta) {
                //console.log(delta);
                var dir = exploreCamera.getDirection(BABYLON.Axis.Z);
                dir.z += 10;
                //scene.activeCamera.position.z += delta/10;
                if(exploreCamera.position.z < 3000 && exploreCamera.position.z > -3000){
                    if (delta>0) exploreCamera.position.subtractInPlace(dir);
                    else exploreCamera.position.addInPlace(dir);
                }
                if(exploreCamera.position.z < -3000) exploreCamera.position.z = -3000;
                if(exploreCamera.position.z > 3000) exploreCamera.position.z = 3000;
            }
        }, BABYLON.PointerEventTypes.POINTERWHEEL, false);
    }else return;

}//end of listen to wheel scroll function


//function that will create the skybox for the second scene
function create_earth_skybox(){ 
    var skybox = BABYLON.MeshBuilder.CreateBox("earthSkybox", {size:9000.0}, earthScene);
    //console.log(skybox);
    //skybox position: negative value - move the skybox towards the bottom; positive value - move the skybox towards the top
    skybox.position.y = 100;
    skybox.position.z = 1000;
    skybox.rotation.y = BABYLON.Tools.ToRadians(-60);
    skybox.isPickable = false;
    skybox.checkCollisions = true;
    var skyboxMaterial = new BABYLON.StandardMaterial("earthSkyboxMaterial", earthScene);
    skyboxMaterial.backFaceCulling = false;
   
    var files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png",    
    ];


    skyboxMaterial.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, earthScene);
    skyboxMaterial.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMaterial.disableLighting = true;
    skyboxMaterial.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMaterial;   
    // skyboxMaterial.freeze();
    // skybox.freezeWorldMatrix();

    return skybox;
}//end of create skybox function
            
var isInitViewClicked = false;

function earth_rotate_earth_with_mbaye(){
    var text = astronautPartsMap.get("rotateEarthWithMbaye");
    
    //if(isFirstClickOfMbaye){
        if(mbayeEarth_object.parent!=null){
            mbayeEarth_object.setParent(null);
            text.material.emissiveColor = BABYLON.Color3.White();
        }
        else{
            mbayeEarth_object.setParent(earthNormal_object);
            text.material.emissiveColor = BABYLON.Color3.Green();
        }
                
  //  }    
}

function earth_rotate(){
    var text = astronautPartsMap.get("rotateEarth");
    if(isEarthRotating){
        isEarthRotating = false;
        text.material.emissiveColor = BABYLON.Color3.White();
    }else{
        isEarthRotating = true;
        text.material.emissiveColor = BABYLON.Color3.Green();
    }  
}


function earth_initial_view(){
    earthCamera.position = new BABYLON.Vector3(-1135,486,1000);
    earthCamera.radius = 1360;
    mbayeEarth_object.setParent(null);
    mbayeEarth_object.scaling = new BABYLON.Vector3(20,20,-20);
    mbayeEarth_object.position = new  BABYLON.Vector3(-467.95,285.39,642.78);
    mbayeEarth_object.rotationQuaternion = new BABYLON.Quaternion(0.1173,0.9809,-0.0854,-0.1289);
    // if(astroMichael_obj){
    //     astroMichael_obj.position =  new BABYLON.Vector3(6,-3,0);
    //     astroMichael_obj.scaling = new BABYLON.Vector3(0.02,0.02,-0.02);
    //     astroMichael_obj.rotation = new BABYLON.Vector3(BABYLON.Tools.ToRadians(10),BABYLON.Tools.ToRadians(22),BABYLON.Tools.ToRadians(2));

    // }
    orbit.isVisible = true;
    orbit.setEnabled(true);
    // mbayeEarth_object.rotationQuaternion = new BABYLON.Quaternion(0.9152,0.1417,0.3771,0.0089);
}


function earth_place_mbaye_on_earth(){
    if(earthScene.activeCamera == earthCamera){
                if(mbayeEarth_object.parent === null){
                    mbayeEarth_object.setParent(earthNormal_object);
                    // rotateEarth_btn.background = "red";
                }
                earthNormal_object.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(-120),0);
                earthNormal_object.position = new BABYLON.Vector3(0,0,0);


                // mbayeEarth_object.rotation = new BABYLON.Vector3(initEarthMbayeRot.x,initEarthMbayeRot.y,initEarthMbayeRot.z);

                // mbayeEarth_object.position = new BABYLON.Vector3(initEarthMbayePos.x,initEarthMbayePos.y,initEarthMbayePos.z);
                // mbayeEarth_object.position = new BABYLON.Vector3(358,50,-164);
                // mbayeEarth_object.rotation = new BABYLON.Vector3(0, BABYLON.Tools.ToRadians(-60),0);
                mbayeEarth_object.position = new BABYLON.Vector3(350,30,150);
                mbayeEarth_object.rotation = new BABYLON.Vector3(0, BABYLON.Tools.ToRadians(-110),0);
                mbayeEarth_object.scaling = new BABYLON.Vector3(5,5,-5);

                earthCamera.alpha = initEarthCameraState.alpha;
                earthCamera.beta = initEarthCameraState.beta;
                earthCamera.position = initEarthCameraPos;

                earthCamera.radius = 600;
                earthCamera.target = new BABYLON.Vector3(0,0,0);
                // xslider.value = 0;
                // yslider.value = 0;
                // zslider.value = 0;
                isEarthRotating = false;

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
            earth_mbaye_scale_up();
        }else if(theGizmo == 4){
             //3 - change gizmo to bounding box
            if(mbayeGizmoManager.positionGizmoEnabled) mbayeGizmoManager.positionGizmoEnabled = false;
            if(mbayeGizmoManager.rotationGizmoEnabled) mbayeGizmoManager.rotationGizmoEnabled = false;
            mbayeGizmoManager.boundingBoxGizmoEnabled = true;  
            earth_mbaye_scale_down();
        }
    }
}//end of handle gizmo 

function earth_mbaye_scale_up(){
    let isParentSetHere = false;
    if(mbayeEarth_object.parent === null){
        mbayeEarth_object.setParent(earthNormal_object);
        isParentSetHere = true;
    }
    var x = mbayeEarth_object.scaling.x + 0.5;
    var y = mbayeEarth_object.scaling.y - 0.5;
    var z = mbayeEarth_object.scaling.z + 0.5;

    if(mbaye_object_with_panels) z = mbayeEarth_object.scaling.z - 0.5;

    if(y < 0) y = mbayeEarth_object.scaling.y - 0.5;
    else y = mbayeEarth_object.scaling.y + 0.5;


    if(x>=30) x=30;
    if(y>=30) y=30;
    if(y<=-30) y=-30;
    if(z>=30) z=30;

    mbayeEarth_object.scaling = new BABYLON.Vector3(x,y,z);
    mbayeGizmoManager.boundingBoxGizmoEnabled = true;
    if(isParentSetHere) mbayeEarth_object.setParent(null);
}

function earth_mbaye_scale_down(){
   let isParentSetHere = false;
   if(mbayeEarth_object.parent === null){
        mbayeEarth_object.setParent(earthNormal_object);
        isParentSetHere = true;
   }

    var x = mbayeEarth_object.scaling.x - 0.5;
    var y = mbayeEarth_object.scaling.y + 0.5;
    var z = mbayeEarth_object.scaling.z - 0.5;

    if(x<1){
        x = mbayeEarth_object.scaling.x;
        y = mbayeEarth_object.scaling.y;
        z = mbayeEarth_object.scaling.z;
    }

  
    mbayeEarth_object.scaling = new BABYLON.Vector3(x,y,z);
    mbayeGizmoManager.boundingBoxGizmoEnabled = true;

    if(isParentSetHere) mbayeEarth_object.setParent(null);

}


function earth_show_countries(){
    var text = astronautPartsMap.get("showCountries");
    if(!isCountryOn){
        earthNames_object.setEnabled(true);
        isCountryOn = true;
        text.material.emissiveColor = BABYLON.Color3.Green();
       
    }else{
        earthNames_object.setEnabled(false);
        text.material.emissiveColor = BABYLON.Color3.White();
        isCountryOn = false;
    }
}

function earth_show_borders(){
     var text = astronautPartsMap.get("showBorders");
    if(!isBorderOn){
        earthBorders_object.setEnabled(true);
        isBorderOn = true;
        text.material.emissiveColor = BABYLON.Color3.Green();
    }else{
        earthBorders_object.setEnabled(false);
        isBorderOn = false;
        text.material.emissiveColor = BABYLON.Color3.White();
    }
}


function earth_show_labels(){
    if(!isOnOverPlanetOrbitActive){
        for(var i=0;i<planetsOrbitArr.length;i++){
            planetsOrbitArr[i].isPickable = true;
        }//end of for loop
        isOnOverPlanetOrbitActive = true;
    }
}

function create_earth_planets(){
    //create the sun


    sun = init_earth_planet("sun","sunMatl","textures/planets2/min/sun.jpg","textures/planets2/min/sunnormal.jpg",-78,319,-2097,250);
    //add glow effect to the sun
    var gl = new BABYLON.GlowLayer("glow", earthScene);
    gl.customEmissiveColorSelector = function(mesh, subMesh, material, result) {
        if (mesh.name === "sun") {
            result.set(235, 192, 52, 0.2);
        }else {
            result.set(0, 0, 0, 0);
        }
    }

    

    earthMercury = sun.clone("earthMercury");
    init_earth_planet2(earthMercury,"earthMercuryMatl","textures/planets2/min/mercury.jpg","textures/planets2/min/mercurynormal.jpg", -442,226,-1428,0.32);

    earthVenus = sun.clone("earthVenus");
    init_earth_planet2(earthVenus,"earthVenusMatl","textures/planets2/min/venus.jpg","textures/planets2/min/venusnormal.jpg",-317,95,-684,0.48);
    
    earthMoon = sun.clone("earthMoon");
    init_earth_planet2(earthMoon,"earthMoonMatl","textures/planets2/min/moon.jpg","textures/planets2/min/moonnormal.jpg",329,163,-263,0.2);

    earthMars = sun.clone("earthMars");
    init_earth_planet2(earthMars,"earthMarsMatl","textures/planets2/min/mars.jpg","textures/planets2/min/marsnormal.jpg",-752,-42,78,0.3);

    earthJupiter = sun.clone("earthJupiter");
    init_earth_planet2(earthJupiter,"earthJupiterMatl","textures/planets2/min/jupiter.jpg","textures/planets2/min/jupiternormal.jpg",210,-144,730,0.48);

    // earthSaturn = sun.clone("earthSaturn");
    // init_earth_planet2(earthSaturn,"earthSaturnMatl","textures/planets2/saturn2.jpg","textures/planets2/normals/saturnnormal.jpg",2551,436,-2414,0.88);
    earthSaturn = init_earth_planet("earthSaturn","earthSaturnMatl","textures/planets2/min/saturn.jpg","textures/planets2/min/saturnnormal.jpg",2551,436,-2414,220);
    var saturnRing = BABYLON.Mesh.CreateGround("rings", 490, 490, 1, earthScene);
    saturnRing.isPickable = false;
    saturnRing.parent = earthSaturn;

    earthSaturn.rotationQuaternion = new BABYLON.Quaternion(0.28,0.18,0.02,0.94);
    var ringsMaterial = new BABYLON.StandardMaterial("ringsMaterial", earthScene);
    ringsMaterial.diffuseTexture = new BABYLON.Texture("textures/planets2/saturnRing2.png", earthScene);
    ringsMaterial.diffuseTexture.hasAlpha = true;
    ringsMaterial.backFaceCulling = false;
    saturnRing.material = ringsMaterial;

    earthUranus = sun.clone("earthUranus");
    init_earth_planet2(earthUranus,"earthUranusMatl","textures/planets2/min/uranus.jpg","textures/planets2/min/uranusnormal.jpg",-2097,-91,337,0.48);

    earthNeptune = sun.clone("earthNeptune");
    init_earth_planet2(earthNeptune,"earthNeptuneMatl","textures/planets2/min/neptune.jpg","textures/planets2/min/neptunenormal.jpg",2835,-5,-76,0.92);

    earthPluto = sun.clone("earthPluto");
    init_earth_planet2(earthPluto,"earthPlutoMatl","textures/planets2/min/pluto.jpg","textures/planets2/min/plutonormal.jpg",2300,400,500,0.4);
    
    sun.actionManager = new BABYLON.ActionManager(earthScene);
    sun.actionManager.registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
          onOverSun)
    );
    sun.actionManager .registerAction(
          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOutTrigger,
            onOutSun)
    );

    earthMercury.actionManager = new BABYLON.ActionManager(earthScene);
    earthMercury.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthMercury.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthVenus.actionManager = new BABYLON.ActionManager(earthScene);
    earthVenus.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthVenus.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

   

    earthMars.actionManager = new BABYLON.ActionManager(earthScene);
    earthMars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthMars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthJupiter.actionManager = new BABYLON.ActionManager(earthScene);
    earthJupiter.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthJupiter.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthSaturn.actionManager = new BABYLON.ActionManager(earthScene);
    earthSaturn.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthSaturn.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthUranus.actionManager = new BABYLON.ActionManager(earthScene);
    earthUranus.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthUranus.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthNeptune.actionManager = new BABYLON.ActionManager(earthScene);
    earthNeptune.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthNeptune.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthPluto.actionManager = new BABYLON.ActionManager(earthScene);
    earthPluto.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthPluto.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );

    earthMoon.actionManager = new BABYLON.ActionManager(earthScene);
    earthMoon.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOverTrigger,
            onOverPlanet
        )
    );
    earthMoon.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanet
        )
    );






    //rotate the planets
    
    engine.runRenderLoop(function () {
        // if(mbayeEarth_object) console.log("mbaye: ", mbayeEarth_object.position, mbayeEarth_object.rotationQuaternion);
        if(earthScene && earthNormal_object){
            earthMercury.rotation.y = Math.PI / 2;
            earthMercury.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            earthVenus.rotation.y = Math.PI / 2;
            earthVenus.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            earthMars.rotation.y = Math.PI / 2;
            earthMars.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            earthJupiter.rotation.y = Math.PI / 2;
            earthJupiter.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            earthSaturn.rotation.y = Math.PI / 2;
            earthSaturn.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            earthUranus.rotation.y = Math.PI / 2;
            earthUranus.rotate(planetAxis, redAngle, BABYLON.Space.LOCAL);
            earthNeptune.rotation.y = Math.PI / 2;
            earthNeptune.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            earthPluto.rotation.y = Math.PI / 2;
            earthPluto.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);

            if(earthNormal_object && isEarthRotating){
                earthNormal_object.rotation.y = Math.PI / 2;
                earthNormal_object.rotate(planetAxis, grayAngle, BABYLON.Space.LOCAL);
            }
        }else return;
    });
} // end of create_planets function

//function that instantiates a planet
function init_earth_planet(name,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,radius){
    var temp = BABYLON.Mesh.CreateSphere(name, 10, radius, earthScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    var temp_material = new BABYLON.StandardMaterial(material_name,earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, earthScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,earthScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);
    //freezing a material disables it from being edited/modified; for saving memory usage
    // temp_material.freeze();
    // temp.freezeWorldMatrix();
    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();
    // temp.freezeWorldMatrix();
    return temp;
}//end of init planet function

function init_earth_planet2(temp,material_name,texture_path,normal_texture_path,x_pos,y_pos,z_pos,scale){
    // var temp = BABYLON.Mesh.CreateSphere(name, 30, radius, earthScene);
    temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    temp.scaling = new BABYLON.Vector3(scale,scale,scale);
    var temp_material = new BABYLON.StandardMaterial(material_name,earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture(texture_path, earthScene);
    temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,earthScene);
    temp_material.specularColor = new BABYLON.Color3(0,0,0);


    //freezing a material disables it from being edited/modified; for saving memory usage
    // temp_material.freeze();
    // temp.freezeWorldMatrix();
    temp.material = temp_material;
    temp.material.freeze();
    temp.convertToUnIndexedMesh();
    // temp.freezeWorldMatrix();
    // return temp;
}//end of init planet function

var isMbayeWithGizmo = false;

function attach_gizmo_to_earth(){

    var onPointerDown2 = function (evt) {
        if (evt.button !== 0) {
            return;
        }
      
        var pickInfo = earthScene.pick(earthScene.pointerX, earthScene.pointerY);
        
        //check if the clicked mesh should be draggable/modified
        if (pickInfo.hit) {
            //if the mesh clicked is inside the earth scene, detach the camera from the astronaut scene so the astronaut won't move
            if(astronautScene) astronautCamera.detachControl(canvas);
            earthCamera.attachControl(canvas,true);
            var temp;
            draggableMesh = pickInfo.pickedMesh;
            console.log("EARTH SCENE MESH: ", draggableMesh.name);



            //if the clicked mesh is not the skybox, enable the utility
            if(earthGizmo){      //right button is not clicked
                 if(draggableMesh.name=="Earth" || draggableMesh.name=="Sea" || draggableMesh.name == "NorthPole" || draggableMesh.name == "North America" 
                    || draggableMesh.name == "South America" || draggableMesh.name == "Antartica" || draggableMesh.name == "Asia"|| draggableMesh.name == "Autralia" || draggableMesh.name == "Europe" || draggableMesh.name == "Africa"){
                    earthGizmo.attachedMesh = earthNormal_object;                   
                }else{
                    earthGizmo.attachedMesh = null;
                }
            }
           

            if((draggableMesh.name=="Mbaye_primitive0" || draggableMesh.name == "Mbaye_primitive1" || draggableMesh.name == "Mbaye_primitive2" || draggableMesh.name == "Mbaye_primitive3" || draggableMesh.name == "Mbaye_primitive4" || draggableMesh.name == "Mbaye_primitive5"  ) && orbit.isVisible){
                
                isFirstClickOfMbaye = true;
                orbit.isVisible = false;
                orbit.setEnabled(false);
                mbayeGizmoManager.attachToMesh(mbayeEarth_object);
            }


            // if(draggableMesh == earthMoon){
            //     if(isEarthRotating) isEarthRotating = false;
            //     else isEarthRotating = true;
            // }
            // if(draggableMesh == webCamScreen){
            //     console.log("position: ", webCamScreen.position, "rotation: ", webCamScreen.rotationQuaternion);
            //     console.log("camera :", earthCamera.position);
            // }

         
        }

    }//end of on pointer down function

    canvas.addEventListener("pointerdown", onPointerDown2, false);
    
    earthScene.onDispose = function() {
        canvas.removeEventListener("pointerdown", onPointerDown2);
         while (document.getElementById("mybut")) {
            document.getElementById("mybut").parentNode.removeChild(document.getElementById("mybut"));
        }
       
    };
 
}//end of attach gizmo to earth

function addMouseListener(){
    
        var onPointerDown = function (evt) {
            if(earthScene) var pickinfo = earthScene.pick(earthScene.pointerX, earthScene.pointerY);
            else return;
            if(pickinfo.hit){
            var theEarthMesh = pickinfo.pickedMesh.name;
            // console.log("THe mesh clicked: ", theEarthMesh.position, theEarthMesh.rotationQuaternion);
            
                if((theEarthMesh=="Mbaye_primitive0" || theEarthMesh == "Mbaye_primitive1" || theEarthMesh== "MBAYE")){     

                // console.log(pickinfo.pickedMesh);
                  currentDraggableMesh = "MBAYE";
                  isEarthClicked = true;
                  isOnOverPlanetOrbitActive = false;
                  // showLabels_btn.background = "green";
                  for(var i=0;i<planetsOrbitArr.length;i++){
                    planetsOrbitArr[i].isPickable = false;
                  }//end of for loop
              }
                // }else if(theEarthMesh == "Cylinder001"){                     //if the starfish is clicked, show the borders
                //     if(!isBorderOn){
                //         earthBorders_object.setEnabled(true);
                //         earthBorders_object.isVisible = true;
                //         isBorderOn = true;
                //     }else{
                //         earthBorders_object.setEnabled(false);
                //         earthBorders_object.isVisible = false;
                //         isBorderOn = false;
                //     }
                // } else if(theEarthMesh == "10012_crab"){                     //if the crab is clicked, show the names
                //     if(!isCountryOn){
                //         earthNames_object.setEnabled(true);
                //         earthNames_object.isVisible = true;
                //         isCountryOn = true;
                //     }else{
                //         earthNames_object.setEnabled(false);
                //         earthNames_object.isVisible = false;
                //         isCountryOn = false;
                //     }
                //      //console.log("CRAB DEETS: ",crabEarth_object);
                // }else if(theEarthMesh == "dolphin_primitive26"){
                //     remove_earth_scene_objects();  
                //     currentScene = createDesignScene();
                // }

                if(earthCountriesMap.has(theEarthMesh)){
                    if(theEarthMesh === "Sao_Tome_and_Principe") showWiki("São_Tomé_and_Príncipe");
                   
                    showWiki(theEarthMesh);
                }
                
           }
           
          
        }//end of on pointer down function

        var onPointerUp = function () {
                 isEarthClicked = false;
                // currentX = 0;
                // currentY = 0;
                // diffX = 0;
                // diffY = 0;

                // earthPos.x = 0;
                // earthPos.y = 0;
                // earthRotate.x = 0;
                // earthRotate.y = 0;
            
      //    isEarthClicked = false;
            // console.log("POINTER UP new earthRotatex : "+earth.rotation.x+" new earthRotatey "+earth.rotation.y);
           
        }//end of on pointer up function

        var onPointerMove = function (evt) {
            if (!isEarthClicked) {
                 return;
            }
             //console.log("currentdragmesh: ",currentDraggableMesh);
            if(currentDraggableMesh == "MBAYE"){
                     var current = earthScene.pick(earthScene.pointerX, earthScene.pointerY);
              //       console.log(current);
            }
               
         
                // var currentX = earthScene.pointerX;
                // var currentY = earthScene.pointerY;
                //console.log(current);


                // diffX = earthRotate.x + (currentY - earthPos.y) / 500.0;
                // diffY = earthRotate.y - (currentX - earthPos.x) / 500.0;

                // diffX = earthRotate.x + (currentY - earthPos.y) / 800.0;
                // diffY = earthRotate.y - (currentX - earthPos.x) / 800.0;

                // earth.rotation = new BABYLON.Vector3(diffX,diffY,initRotationZ);
                // borders.rotation = new BABYLON.Vector3(diffX,diffY,initRotationZ);
                // names.rotation = new BABYLON.Vector3(diffX,diffY,initRotationZ);
                
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


var webCamScreen;
var myVideo;    
function enable_webcamera(){
            // Our Webcam stream (a DOM <video>)
    var isAssigned = false; // Is the Webcam stream assigned to material?

    // webCamScreen = BABYLON.Mesh.CreatePlane("webCamScreen", 150, earthScene);
    // webCamScreen.position = new BABYLON.Vector3(-95,300,-1932);
    // webCamScreen.rotationQuaternion = new BABYLON.Quaternion(0.99,-0.03,0.01,0.002);
    // webCamScreen.setEnabled(false);
    // webCamScreen.isVisible = false;

    webCamScreen = BABYLON.MeshBuilder.CreateDisc("webCamScreen2", {radius:110, tessellation: 0}, earthScene);
   // webCamScreen.position = new BABYLON.Vector3(-122,321,-1961);
    webCamScreen.rotationQuaternion = new BABYLON.Quaternion(0.023,0.990,-0.002,0.009);
    webCamScreen.setEnabled(false);
    webCamScreen.isVisible = false;

    //   var videoMaterial2 = new BABYLON.StandardMaterial("webCamScreenTexture", earthScene);
    // //videoMaterial.emissiveColor = new BABYLON.Color3(1,1,1);
    // videoMaterial2.specularColor = new BABYLON.Color3(0,0,0);
    // //videoMaterial2.backFaceCulling = false;
    // //videoMaterial.disableLighting = true;
   



    var videoMaterial = new BABYLON.StandardMaterial("webCamScreenTexture", earthScene);
    //videoMaterial.emissiveColor = new BABYLON.Color3(1,1,1);
    videoMaterial.specularColor = new BABYLON.Color3(0,0,0);
    //videoMaterial.alpha = 0.9;
    //videoMaterial.disableLighting = true;

    // Create our video texture
    BABYLON.VideoTexture.CreateFromWebCam(earthScene, function (videoTexture) {
        myVideo = videoTexture;
        videoMaterial.diffuseTexture = myVideo;
    }, { maxWidth: 256, maxHeight: 256 });

    // When there is a video stream (!=undefined),
    // check if it's ready          (readyState == 4),
    // before applying videoMaterial to avoid the Chrome console warning.
    // [.Offscreen-For-WebGL-0xa957edd000]RENDER WARNING: there is no texture bound to the unit 0
    earthScene.onBeforeRenderObservable.add(function () {
        if (myVideo !== undefined && isAssigned == false) {
            if (myVideo.video.readyState == 4) {
                webCamScreen.material = videoMaterial;
                isAssigned = true;
            }
        }
    });

}

var onOverSun =(meshEvent)=>{
    var theMeshID = meshEvent.source.id 
    if(webCamScreen){
        if(theMeshID == "sun"){
            webCamScreen.setEnabled(true);
            webCamScreen.isVisible = true;  
            // console.log(" earth cam's position: ",earthCamera.position);
            let camX = earthCamera.position.x;
            let camY = earthCamera.position.y;
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
            //else webCamScreen.position = new BABYLON.Vector3(-122,320,-1960);   //the initial position

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
            webCamScreen.position = new BABYLON.Vector3(x,y,z);
        } 
    } 
};

//handles the on mouse out event
var onOutSun =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    if(webCamScreen){
        webCamScreen.setEnabled(false);
        webCamScreen.isVisible = false; 
    }
    
    
};

var wikiBtn;
var onOverPlanetOrbit =(meshEvent)=>{
    if(isOnOverPlanetOrbitActive){
        wikiBtn = document.createElement("span");
        // wikiBtn.textContent = " ";
        wikiBtn.setAttribute("id", "planetOrbitLbl");
        // wikiBtn.zIndex = 0;
        var sty = wikiBtn.style;
        sty.position = "absolute";
        sty.lineHeight = "1.2em";
        sty.paddingLeft = "10px";
        sty.paddingRight = "10px";
        sty.color = "#ffffff";
        sty.border = "2px ridge white";
        sty.borderRadius = "5px";
        sty.backgroundColor = "none";
        sty.fontSize = "16pt";
        sty.top = earthScene.pointerY + "px";
        sty.left = earthScene.pointerX + "px";
        sty.cursor = "pointer";
        
        
        // var theLink = "showWiki('"+meshEvent.meshUnderPointer.name+"')";
        // if(meshEvent.meshUnderPointer.name == "Earth") wikiBtn.setAttriwikiBtne("onclick", "window.open('https://en.wikipedia.org/wiki/Earth')");
        if(meshEvent.meshUnderPointer.name == "Earth") wikiBtn.setAttribute("onclick", "showWiki('Earth')");
        else if(meshEvent.meshUnderPointer.name == "Mercury") wikiBtn.setAttribute("onclick", "showWiki('Mercury_(planet)')");
        else if(meshEvent.meshUnderPointer.name == "Venus") wikiBtn.setAttribute("onclick", "showWiki('Venus')");
        else if(meshEvent.meshUnderPointer.name == "Mars") wikiBtn.setAttribute("onclick", "showWiki('Mars')");
        else if(meshEvent.meshUnderPointer.name == "Jupiter") wikiBtn.setAttribute("onclick", "showWiki('Jupiter')");
        else if(meshEvent.meshUnderPointer.name == "Saturn") wikiBtn.setAttribute("onclick", "showWiki('Saturn')");
        else if(meshEvent.meshUnderPointer.name == "Uranus") wikiBtn.setAttribute("onclick", "showWiki('Uranus')");
        else if(meshEvent.meshUnderPointer.name == "Neptune") wikiBtn.setAttribute("onclick", "showWiki('Neptune')");
        else if(meshEvent.meshUnderPointer.name == "Pluto") wikiBtn.setAttribute("onclick", "showWiki('Pluto')");
        else if(meshEvent.meshUnderPointer.name == "Moon") wikiBtn.setAttribute("onclick", "showWiki('Moon')");
        else if(meshEvent.meshUnderPointer.name == "Sun") wikiBtn.setAttribute("onclick", "showWiki('Sun')");

        //constellations
        else if(meshEvent.meshUnderPointer.name == "Leo") wikiBtn.setAttribute("onclick", "showWiki('Leo_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Aquarius") wikiBtn.setAttribute("onclick", "showWiki('Aquarius_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Aries") wikiBtn.setAttribute("onclick", "showWiki('Aries_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Cancer") wikiBtn.setAttribute("onclick", "showWiki('Cancer_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Capricorn") wikiBtn.setAttribute("onclick", "showWiki('Capricorn_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Gemini") wikiBtn.setAttribute("onclick", "showWiki('Gemini_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Libra") wikiBtn.setAttribute("onclick", "showWiki('Libra_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Pisces") wikiBtn.setAttribute("onclick", "showWiki('Pisces_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Sagittarius") wikiBtn.setAttribute("onclick", "showWiki('Sagittarius_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Scorpio") wikiBtn.setAttribute("onclick", "showWiki('Scorpio_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Taurus") wikiBtn.setAttribute("onclick", "showWiki('Taurus_(constellation)')");
        else if(meshEvent.meshUnderPointer.name == "Virgo") wikiBtn.setAttribute("onclick", "showWiki('Virgo_(constellation)')");

        

        document.body.appendChild(wikiBtn);
        wikiBtn.textContent = meshEvent.meshUnderPointer.name;
    }
};

//handles the on mouse out event
var onOutPlanetOrbit =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    while (document.getElementById("planetOrbitLbl")) {
            document.getElementById("planetOrbitLbl").parentNode.removeChild(document.getElementById("planetOrbitLbl"));
    }   
};


var onOverPlanet =(meshEvent)=>{
    // console.log("over planet");
};

//handles the on mouse out event
var onOutPlanet =(meshEvent)=>{
    //part of the 3d text on hover on mesh
    // console.log("out planet");
};



function load_constellation_plane(){
    leoStars= BABYLON.MeshBuilder.CreatePlane("Leo", {height:150, width: 300}, earthScene);
    leoStars.scaling = new BABYLON.Vector3(14,14,14);
    leoStars.position = new BABYLON.Vector3(-2877, 4345, 1908);
    leoStars.rotationQuaternion = new BABYLON.Quaternion(-0.553,0.438,0.438, 0.553);
    var leoStarsMatl = new BABYLON.StandardMaterial("leoMatl", earthScene);
    leoStarsMatl.diffuseTexture = new BABYLON.Texture("textures/constellations/leo.png", earthScene);
    leoStarsMatl.diffuseTexture.hasAlpha = true;
    leoStars.material = leoStarsMatl;
    leoStars.material.backFaceCulling = false;
    leoStars.freezeWorldMatrix();

    leoStars.actionManager = new BABYLON.ActionManager(earthScene);
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


    geminiStars = leoStars.clone();
    geminiStars.name = "Gemini";
    geminiStars.position = new BABYLON.Vector3(4227,2823,806);
    geminiStars.rotationQuaternion = new BABYLON.Quaternion(0.149,0.729,0.179,0.632);
    geminiStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("geminiStarsMatl",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/gemini.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    geminiStars.material = temp_material; 
    geminiStars.freezeWorldMatrix();

    geminiStars.actionManager = new BABYLON.ActionManager(earthScene);
    geminiStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    geminiStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );




    virgoStars = leoStars.clone();
    virgoStars.name = "Virgo";
    virgoStars.position = new BABYLON.Vector3(-4242, 2864,-9);
    virgoStars.rotationQuaternion = new BABYLON.Quaternion(0.0105,0.707,-0.014,-0.702);
    virgoStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("virgoStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/virgo.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    virgoStars.material = temp_material;
    virgoStars.freezeWorldMatrix();

    virgoStars.actionManager = new BABYLON.ActionManager(earthScene);
    virgoStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    virgoStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    piscesStars = leoStars.clone();
    piscesStars.name = "Pisces";
    piscesStars.position = new BABYLON.Vector3(942, 4350,1731);
    piscesStars.rotationQuaternion = new BABYLON.Quaternion(-0.005,-0.698,-0.709,0.0155);
    piscesStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("piscesMatl",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/pisces.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    piscesStars.material = temp_material;
    piscesStars.freezeWorldMatrix();

    piscesStars.actionManager = new BABYLON.ActionManager(earthScene);
    piscesStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    piscesStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    sagittariusStars = leoStars.clone();
    sagittariusStars.name = "Sagittarius";
    sagittariusStars.position = new BABYLON.Vector3(2917, -4081,614);
    sagittariusStars.rotationQuaternion = new BABYLON.Quaternion(0.411,-0.562,0.589,0.389);
    sagittariusStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("sagittariusStarsMatl",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/sagittarius.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    sagittariusStars.material = temp_material;
    sagittariusStars.freezeWorldMatrix();

    sagittariusStars.actionManager = new BABYLON.ActionManager(earthScene);
    sagittariusStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    sagittariusStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );



    capricornStars = leoStars.clone();
    capricornStars.name = "Capricorn";
    capricornStars.position = new BABYLON.Vector3(-1996,-3873,2000);
    capricornStars.rotationQuaternion = new BABYLON.Quaternion(0.694,0.0323,-0.106, 0.702);
    capricornStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("capricornStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/capricorn.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    capricornStars.material = temp_material;
    capricornStars.freezeWorldMatrix();

    capricornStars.actionManager = new BABYLON.ActionManager(earthScene);
    capricornStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    capricornStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    libraStars = leoStars.clone();
    libraStars.name = "Libra";
    libraStars.position = new BABYLON.Vector3(-766,1584,-3235);
    libraStars.rotationQuaternion = new BABYLON.Quaternion(0.152, -0.945, 0.043,0.256);
    libraStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("virgoStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/libra.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    libraStars.material = temp_material;
    libraStars.freezeWorldMatrix();

    libraStars.actionManager = new BABYLON.ActionManager(earthScene);
    libraStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    libraStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    ariesStars = leoStars.clone();
    ariesStars.name = "Aries";
    ariesStars.position = new BABYLON.Vector3(664,3268,5197);
    ariesStars.rotationQuaternion = new BABYLON.Quaternion( -0.0299, 0.158,  0.070,0.976);
    ariesStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("ariesStarsMatl",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/aries2.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    ariesStars.material = temp_material;
    ariesStars.freezeWorldMatrix();

    ariesStars.actionManager = new BABYLON.ActionManager(earthScene);
    ariesStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    ariesStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    cancerStars = leoStars.clone();
    cancerStars.name = "Cancer";
    cancerStars.position = new BABYLON.Vector3( -417,-3774,-2125);
    cancerStars.rotationQuaternion = new BABYLON.Quaternion(-0.0469,-0.889,0.427,0.055);
    cancerStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("cancerStarsMatl",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/cancer.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    cancerStars.material = temp_material;
    cancerStars.freezeWorldMatrix();

    cancerStars.actionManager = new BABYLON.ActionManager(earthScene);
    cancerStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    cancerStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );


    scorpioStars = leoStars.clone();
    scorpioStars.name = "Scorpio";
    scorpioStars.position = new BABYLON.Vector3(1000,-2362,5218);
    scorpioStars.rotationQuaternion = new BABYLON.Quaternion(-0.0297,0.132,0.213,0.954);
    scorpioStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("capricornStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/scorpio.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    scorpioStars.material = temp_material;
    scorpioStars.freezeWorldMatrix();

    scorpioStars.actionManager = new BABYLON.ActionManager(earthScene);
    scorpioStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    scorpioStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );

 
    taurusStars = leoStars.clone();
    taurusStars.name = "Taurus";
    taurusStars.position = new BABYLON.Vector3(-121,4275,-982);
    taurusStars.rotationQuaternion = new BABYLON.Quaternion(-0.703, 0.010, 0.0256,0.695);
    taurusStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("taurusStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/taurus.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    taurusStars.material = temp_material;
    taurusStars.freezeWorldMatrix();

    taurusStars.actionManager = new BABYLON.ActionManager(earthScene);
    taurusStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    taurusStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );



    aquariusStars = leoStars.clone();
    aquariusStars.name = "Aquarius";
    aquariusStars.position = new BABYLON.Vector3(-4223, -2058,773);
    aquariusStars.rotationQuaternion = new BABYLON.Quaternion(-0.032,-0.710,0.027,0.687);
    aquariusStars.scaling = new BABYLON.Vector3(14,14,14);
    var temp_material = new BABYLON.StandardMaterial("aquariusStars",earthScene);
    temp_material.diffuseTexture = new BABYLON.Texture("textures/constellations/aquarius.png", earthScene);
    temp_material.diffuseTexture.hasAlpha = true;
    aquariusStars.material = temp_material;
    aquariusStars.freezeWorldMatrix();

    aquariusStars.actionManager = new BABYLON.ActionManager(earthScene);
    aquariusStars.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                BABYLON.ActionManager.OnPointerOverTrigger,
                onOverPlanetOrbit
        )
    );
    aquariusStars.actionManager.registerAction(
        new BABYLON.ExecuteCodeAction(
            BABYLON.ActionManager.OnPointerOutTrigger,
            onOutPlanetOrbit
        )
    );



   
//     var gl = new BABYLON.GlowLayer("glow", earthScene);
// gl.addIncludedOnlyMesh(starsForm)
    starsLight = new BABYLON.HighlightLayer("starsLight", earthScene);
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
    earthScene.registerBeforeRender(() => {
        alpha += 0.1;
        
        starsLight.blurHorizontalSize = 0.5 + Math.cos(alpha) * 0.4 + 0.4;     
        starsLight.blurVerticalSize = 0.5 + Math.sin(alpha / 3) * 0.4 + 0.4;
    });
   
}










        // this part is for rotating Mbaye around the earth
        var pilot;
        var axis;
        var angle=0.025;
        var sp;
        function createPilot(){
            pilot = BABYLON.MeshBuilder.CreateCylinder("pilot", {height:0.75, diameterTop:0.2, diameterBottom:0.5, tessellation:6, subdivisions:1} , earthScene);
            var greyMat = new BABYLON.StandardMaterial("grey", earthScene);
            greyMat.emissiveColor = new BABYLON.Color3(0.2,0.2,0.2);
            pilot.material = greyMat;

          

            var arm = BABYLON.MeshBuilder.CreateBox("arm", {height:0.75, width:0.3, depth:0.1875 }, earthScene);
            arm.material = greyMat;
            arm.position.x = 0.125;
            arm.parent = pilot;

            var pivotAt = new BABYLON.Vector3(1, 3, 2);
          axis = new BABYLON.Vector3(2, 6, 4);
          var pilotStart = new BABYLON.Vector3(3, 6, 6);
          pilot.position = pivotAt; //mesh starts where pivot is going to be

          var axisLine = BABYLON.MeshBuilder.CreateLines("axisLine", {points:[pivotAt.add(axis.scale(-50)),pivotAt.add(axis.scale(50))]}, earthScene);

        sp = BABYLON.MeshBuilder.CreateSphere("sphere", {diameter:0.25}, earthScene);

  /**********Pilot Pivot*********/ 
  //pivot translation to mesh starting position
  var pivotTranslate = pilotStart.subtract(pivotAt);
  pilot.setPivotMatrix(BABYLON.Matrix.Translation(pivotTranslate.x, pivotTranslate.y, pivotTranslate.z));
  /***************************************************************/

  /**********Pilot Position*********/ 
  sp.position = pilot.position;
  /***************************************************************/
        }
    

                   //create the game engine
                   var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true },true);

                   //create the scene
                   var theScene = createEarthScene();
       
                   
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