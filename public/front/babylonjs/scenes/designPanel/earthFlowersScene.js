let earthFlowersCamera;                                                               //var for the camera of this scene
let earthFlowersSkybox;                                                               //var for the skybox of this scene
let earthFlowersScene;                                                                //var for holding the scene
let earthFlowers_object;                                                              //var for holding the earthflowers object
let isZoomPanelActive = true;                                                         //var to check if panel zoom in/out is enabled
let isEarthFlowersHit = false;
const MAX_NUM_FLOWERS = 5;
let worldFlowerPicked;
let isWorldFlowersReady;
let worldLoadedPercent;
let flowerMat;                                                                        //var for the flower material


//create the scene
function create_earth_flower_scene(){
    earthFlowersScene = new BABYLON.Scene(engine);
    earthFlowersScene.enableSceneOffline = true;
    BABYLON.Database.IDBStorageEnabled = true;
    earthFlowersScene.autoClear = false;

    create_earth_flower_camera();

    //create the lights
    let light = new BABYLON.HemisphericLight("earthFlowersLight", new BABYLON.Vector3(0, 5, 10), earthFlowersScene);
    let light2 = new BABYLON.HemisphericLight("earthFlowersLight2", new BABYLON.Vector3(0, -5, -10), earthFlowersScene);
    light.radius = 300;
    light2.radius = 300;
    light.intensity = 1;

    //load the world of flowers
    load_earth_with_flowers_mesh();
    add_mouse_listener_earthflowers();

    return earthFlowersScene;
}

function create_earth_flower_camera(){
  //create the camera
    earthFlowersCamera = new BABYLON.ArcRotateCamera("EarthFlowersCamera", 0,0, 1000, BABYLON.Vector3(0,0,0), earthFlowersScene);
    earthFlowersCamera.checkCollisions = true;
    earthFlowersCamera.lowerRadiusLimit = 35;
    earthFlowersCamera.upperRadiusLimit = 200;
    earthFlowersCamera.wheelPrecision = 10;   
    earthFlowersCamera.angularSensibilityX = 2000;
    earthFlowersCamera.angularSensibilityY = 2000;
}

//function to load the world of flowers
function load_earth_with_flowers_mesh(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/designScene/worldFlowers/model/", "worldFlowers040220.babylon", earthFlowersScene,
                function (evt) {
                        // onProgress
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
           
            for(let i=0;i<result.meshes.length;i++){
                if(result.meshes[i].name === "Earth") continue;
                else{
                    result.meshes[i].isPickable = true;

                    result.meshes[i].actionManager = new BABYLON.ActionManager(earthFlowersScene);
                    result.meshes[i].actionManager.registerAction(
                          new BABYLON.ExecuteCodeAction( BABYLON.ActionManager.OnPointerOverTrigger,
                          onOverFlower)
                    );
                    result.meshes[i].actionManager .registerAction(
                          new BABYLON.ExecuteCodeAction(BABYLON.ActionManager.OnPointerOutTrigger,
                          onOutFlower)
                    );
                }

                if(i===result.meshes.length-1)   isWorldFlowersReady = true;
            }//eof for loop
            result.meshes[0].scaling = new BABYLON.Vector3(0.2,0.2,0.2);
           
            //hide the world of flowers
            result.meshes[0].setEnabled(false);
            result.meshes[0].isVisible = false;
            result.meshes[0].isPickable = true;

            earthFlowers_object = result.meshes[0];

            //set the world in this viewport
           earthFlowersCamera.viewport = new BABYLON.Viewport(0.65,0,0.5,1);
        })
   
    ]).then(() => {
      if(!worldLoadedPercent){
        setTimeout(function(){
            worldLoadedPercent = 100;
        },3000);
      }
      earthFlowers_object.rotation = new BABYLON.Vector3(0,BABYLON.Tools.ToRadians(90),0);
    });
} //end of load world of flowers mesh function

 





function add_mouse_listener_earthflowers(){
    var onPointerDownFlowers = function (evt) {
        if (evt.button !== 0) {
            return;
        }
  
        var pickInfo = earthFlowersScene.pick(earthFlowersScene.pointerX, earthFlowersScene.pointerY);
    
        //check if the world of flowers mesh should be draggable/modified
        if (pickInfo.hit && evt.button === 0) {
            var theEarthFlowerMesh = pickInfo.pickedMesh;
           
            if(theEarthFlowerMesh.name == "Earth"){
                isEarthFlowersHit = true;
                isZoomPanelActive = false;
                earthFlowersCamera.attachControl(canvas,true);
            }else if(theEarthFlowerMesh === earthFlowersSkybox){
                earthFlowersCamera.detachControl(canvas);
            }else{    //else, the flower is clicked               
                earthFlowersCamera.detachControl(canvas);
                let flowerName = theEarthFlowerMesh.name;                        
                let flowersArr = [];
                //if the flower is in the flowersMap, get the array of flowers assigned to the flower name
                const isFlowerExisting = flowersMap.has(flowerName);
                if(isFlowerExisting) flowersArr = flowersMap.get(flowerName);

                if(isFlowerExisting){
                    if(!isBookFlowersActive){
                      worldFlowerPicked = flowerName;
                      open_book_of_flowers(flowerName);
                      load_design_flower_versions(flowersArr);
                    }
                }
            }//end of if a flower
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

    earthFlowersScene.onDispose = function() {
        canvas.removeEventListener("pointerdown", onPointerDownFlowers);
        canvas.removeEventListener("pointerup", onPointerUpFlowers);
        canvas.removeEventListener("pointermove", onPointerMoveFlowers);
    };
}//end of add mouse listeners





var onOverFlower =(meshEvent)=>{
    if(meshEvent.source.name!=="Earth"){
      flowerMat = meshEvent.source.material.diffuseColor;
      meshEvent.source.material.diffuseColor = new BABYLON.Color3(0,1,0,0.8);
    }
};

var onOutFlower =(meshEvent)=>{
     meshEvent.source.material.diffuseColor = flowerMat;
};


function remove_earthFlowers_scene_objects(){
    if(earthFlowersSkybox) earthFlowersSkybox.dispose();                                                                                                         
    earthFlowers_object.dispose();        
    earthFlowersScene.dispose();
    earthFlowersScene = null;
    isDesignSceneActive = false;
}
