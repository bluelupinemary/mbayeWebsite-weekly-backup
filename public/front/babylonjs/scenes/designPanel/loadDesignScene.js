
let canvas;
let engine;
let rp;
let isWorldFlowersReady = true;

        
var createScene = function(){
    canvas = document.getElementById('canvas');
    engine = new BABYLON.Engine(canvas, true,{ preserveDrawingBuffer: true, stencil: true });

    engine.enableOfflineSupport = false;
    scene = new BABYLON.Scene(engine);
    
    load_waterdrop_mesh();
    camera = create_camera();
    light = create_light();
    create_skybox();
    create_waterdrop_orbit();


    return scene;
}


    

//function that creates the skybox
function create_skybox(){ 
    let skybox = BABYLON.MeshBuilder.CreateBox("designSkybox", {size:5000.0}, scene);
    skybox.backFaceCulling = false;
    skybox.isPickable = false;


    let skyboxMatl = new BABYLON.StandardMaterial("skyboxMatl", scene);
    skyboxMatl.backFaceCulling = false;

    let files = [   
        "front/finalSkybox/px.png",   
        "front/finalSkybox/py.png",   
        "front/finalSkybox/pz.png",   
        "front/finalSkybox/nx.png",              
        "front/finalSkybox/ny.png",   
        "front/finalSkybox/nz.png", 
        ];


    skyboxMatl.reflectionTexture = new BABYLON.CubeTexture.CreateFromImages(files, scene);
    skyboxMatl.reflectionTexture.coordinatesMode = BABYLON.Texture.SKYBOX_MODE;
    skyboxMatl.disableLighting = true;
    skyboxMatl.specular = new BABYLON.Vector3(0,0,0);
    skybox.material = skyboxMatl;


}


//function to add the camera to the scene
function create_camera(){
        var camera = new BABYLON.ArcRotateCamera("Camera",BABYLON.Tools.ToRadians(-30),BABYLON.Tools.ToRadians(60),14.0, new BABYLON.Vector3(0,0,0),scene);

        camera.setTarget(new BABYLON.Vector3(0,3.5,0));
        camera.attachControl(canvas,true);
        // camera.attachControl(canvas, true);
        //set zoom in and zoom out capability
        camera.lowerRadiusLimit = 1;
        camera.upperRadiusLimit = 50;

        //set 1.3 to .99 to disable peeking from the bottom
        //camera.upperBetaLimit = (Math.PI / 2) * 1.3;

        //zoom in/out speed
        camera.wheelPrecision = 20;

        let theHDRTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("front/textures/dds/environment.dds", scene);
        theHDRTexture.gammaSpace = false;
        theHDRTexture.level = 0.5;
        scene.environmentTexture = theHDRTexture;

        //camera auto rotate
        camera.useAutoRotationBehavior = true;
        //camera.autoRotationBehavior.idleRotationSpinupTime = 5000;
        camera.autoRotationBehavior.idleRotationSpeed = 0.08;
        //  console.log(camera.autoRotationBehavior);
        return camera;
}//end of create camera function

//function to add light to the scene
function create_light(){

    let light = new BABYLON.HemisphericLight("hemiLight",  new BABYLON.Vector3(0,100,0), scene);
    light.diffuse = new BABYLON.Color3(1,1,1);
    light.radius = 100;
    light.specular = new BABYLON.Color3(0,0,0);
    light.groundColor = new BABYLON.Color3(0.2,0.2,0.2);
    light.intensity = 1;

    return light;
}//end of create light function

let waterdropTask;
let worldLoadedPercent;
//function to load the mbaye mesh
function load_waterdrop_mesh(){
    Promise.all([

        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/waterdropScene/", "waterdropPatternV2.babylon", scene,
                    function (evt) {
                        // onProgress
                        //var totalLengthComputable += evt.lengthComputable;
                        var loadedPercent = 0;
                        if (evt.lengthComputable) {
                            loadedPercent = (evt.loaded * 100 / evt.total).toFixed();
                        } else {
                            var dlCount = evt.loaded / (1024 * 1024);
                            loadedPercent += Math.floor(dlCount * 100.0) / 100.0;
                        }
                        document.getElementById("loadingScreenPercent").innerHTML = "Loading: "+loadedPercent+" %";
                        worldLoadedPercent = loadedPercent;
                
                }
            ).then(function (result) {
            
            // result.meshes[1].scaling = new BABYLON.Vector3(2,2,2);
            for(let i=1;i<result.meshes.length;i++){
                if(result.meshes[i].name === "Line100") result.meshes[i].position = new BABYLON.Vector3(0,0,0);
                else if(result.meshes[i].name === "Sphere006") continue;
                else if(result.meshes[i].name === "Object134") continue;
                else if(result.meshes[i].name === "Object111") continue;
                else if(result.meshes[i].name === "Object056xz002") continue;
                else if(result.meshes[i].name === "Object056xz001") continue;
                else if(result.meshes[i].name === "Object056xz") continue;
                else if(result.meshes[i].name === "Object019xzx") continue;
                else if(result.meshes[i].name === "bt1") continue;
                else if(result.meshes[i].name === "bt2") continue;

                result.meshes[i].position = new BABYLON.Vector3(5,0,0);

                if(i < 30){
                    result.meshes[i].position = new BABYLON.Vector3(Math.random() * ((Math.random()*(20- -20)+ -20) - 5) + (5), -2, Math.random() * (20 - 7) + (7));
                }else result.meshes[i].position = new BABYLON.Vector3((Math.random()*(-20)+ -3),-2,Math.random() * (-20) + (-3));
            }
            waterdropTask = result.meshes;
        }),
    ]).then(() => {
            let pbr = new BABYLON.PBRMaterial("pbr", scene);
            for(let i=0;i<waterdropTask.length;i++){
                waterdropTask[i].material = pbr;
                waterdropTask[i].material.backFaceCulling = false;
            }
            pbr.albedoColor = new BABYLON.Color3(1.0, 1, 1);
            pbr.microSurface = 1.0; // Let the texture controls the value 
            pbr.useMicroSurfaceFromReflectivityMapAlpha = true;
    });
} //end of load mbaye mesh function

function create_waterdrop_orbit(){
    let theOrbit = BABYLON.MeshBuilder.CreateDisc("theOrbit", {radius:3, tessellation: 0}, scene);
    theOrbit.scaling = new BABYLON.Vector3(1,-1,1);
    theOrbit.position = new BABYLON.Vector3(0,0,0.2);
    theOrbit.rotation.x =  BABYLON.Tools.ToRadians(90);

    let theOrbitMatl = new BABYLON.StandardMaterial("theOrbitMatl", scene);
    theOrbitMatl.diffuseTexture = new BABYLON.Texture("front/textures/waterdropScene/waterdropOrbit.png", scene);
    theOrbitMatl.diffuseTexture.hasAlpha = true;
    theOrbit.material = theOrbitMatl;
    theOrbit.material.backFaceCulling = false;
    theOrbit.freezeWorldMatrix();
    theOrbit.convertToUnIndexedMesh();
}



//function that will render the scene on loop
var scene = createScene();


engine.runRenderLoop(function(){
    
    if(scene){
        if(worldLoadedPercent >= 100 && isWorldFlowersReady){
            document.getElementById("loadingScreenDiv").style.visibility = "hidden";
            document.getElementById("loadingScreenPercent").style.visibility = "hidden";
            document.getElementById("loadingScreenPercent").innerHTML = "Loading: 0 %";
            isWorldFlowersReady = false;
        }
        scene.render();  
    }

});//end of renderloop

// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
});