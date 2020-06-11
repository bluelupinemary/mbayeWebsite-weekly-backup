
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

function createScene(){
    engine.enableOfflineSupport = true;
    
    BABYLON.Database.IDBStorageEnabled = true;
    
    flowersScene = new BABYLON.Scene(engine);                             //intantiate earth scene's scene
    flowersScene.enableSceneOffline = true;
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
    //

    // e {x: -1191.7804986442936, y: 185.4645341513735, z: 628.3805770575444}
    camera.fovMode = BABYLON.Camera.FOVMODE_HORIZONTAL_FIXED;
    camera.fov = 1.4;
    //set zoom in and zoom out capability
    camera.upperRadiusLimit = UPPER_RADIUS_VAL;
    camera.lowerRadiusLimit = LOWER_RADIUS_VAL;
    camera.wheelPrecision = 1;
    camera.angularSensibilityX = 4000;     //rotation speed of camera; lower number, faster rotation
    camera.angularSensibilityY = 4000;
    //for the right mouse button panning function; ;0 -no panning, 1 - fastest panning
    camera.panningSensibility = 10; 
    camera.upperBetaLimit = 10;
    camera.panningDistanceLimit = 500;
    camera.attachControl(canvas,true);
    // camera.position = new BABYLON.Vector3(-1135,486,1000);
    // camera.radius = 1500;
    flowersScene.activeCamera = camera;

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
    var skybox = BABYLON.MeshBuilder.CreateBox("skybox", {size:8300.0}, flowersScene);
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
function load_meshes(){
    Promise.all([
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/mbaye/", "MbayePipes0107.glb", flowersScene,  function (evt) {
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
           
           
            var pbr = new BABYLON.PBRMaterial("pbr", flowersScene);
            // pbr.reflectionTexture = rp.cubeTexture

            for(let i=0;i<result.meshes.length;i++){
                if(result.meshes[i].name == "Mbaye_primitive1" || result.meshes[i].name == "Mbaye_primitive0"){
                    result.meshes[i].material = pbr;
                    result.meshes[i].material.backFaceCulling = false;
                }
            }//end of for loop

        
            pbr.albedoColor = new BABYLON.Color3(0.7,0.7,0.7);
            pbr.emissiveColor = new BABYLON.Color3(0,0,0);
            pbr.metallic = 1;
            pbr.metallicF0Factor = 0.50;
            pbr.roughness = 0.16;

            pbr.microSurface = 1; // Let the texture controls the value 
        }),
        BABYLON.SceneLoader.ImportMeshAsync(null, "front/objects/participateScene/earth/", "earth122319.babylon", flowersScene).then(function (result) {
                // earthNormalMesh = result.meshes;
                
                result.meshes[9].scaling = new BABYLON.Vector3(0.45,0.45,0.45);
                result.meshes[9].rotationQuaternion = new BABYLON.Quaternion(0, -0.7648,0,0.6442);
               
                for(let i=0;i<result.meshes.length-1;i++){
                    result.meshes[i].isPickable = true;
                    if(result.meshes[i].name === "Sea"){
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
                       result.meshes[i].material = water;
                    }
                }

                earth_object = result.meshes[9];      
                
          }),
          
    ]).then(() => {
        mbaye_object.setParent(earth_object);
        setTimeout(function(){
            // add_video_to_mesh();
            flowersCamera.target = new BABYLON.Vector3(0,0,0);
            flowersCamera.radius = 1360;
        },500);

      //  setTimeout(function(){
            
            setup_music_player();
            // enable_gizmo(mbaye_object);
        //},1000);
       
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
let origScaling, origColor;
var onOverFlower =(meshEvent)=>{
    origScaling = meshEvent.source.scaling;
    meshEvent.source.scaling = new BABYLON.Vector3(origScaling.x*1.4,origScaling.y*1.4,origScaling.z*1.4);
    // hl.addMesh(meshEvent.source, new BABYLON.Color3(1,1,0.8));
    let a = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
    let b = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
    let c = (Math.random() * (0.99 - 0.01) + 0.01).toFixed(1);
    hl.addMesh(meshEvent.source, new BABYLON.Color3(a,b,c));
};

//handles the on mouse out event
var onOutFlower =(meshEvent)=>{
    meshEvent.source.scaling = origScaling;
    hl.removeMesh(meshEvent.source);
};


function set_scale(){
    let size = getRandomInt(40, 50)
    return size;
}

let nb = 100;
var TWO_PI = Math.PI * 2;
var angle =  TWO_PI/ nb;
function load_orig_flowers(){
    for (const [flowerName,val] of flowersMbayeMap.entries()) {
        // let thePos = set_position();
        let thePos;
        if(val[0]!==null) thePos = val[0];
        let theSize = set_scale();
        let samp = init_flower(flowerName,flowerName+"Matl", "front/images3D/flowers2D/orig/"+flowerName+".png",theSize,thePos.x,thePos.y,thePos.z);
    }
}


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
    planeMatl.freeze();
    
    plane.material = planeMatl;
    // plane.freezeWorldMatrix();
    add_action_mgr(plane);
    return plane;
}



//function that randomizes int
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


//the function that will listen to mouse events
let currFlower;
function add_mouse_listener(){
        var onPointerDownInit = function (evt) {
            // console.log(evt);
            if(flowersScene) var pickinfo = flowersScene.pick(flowersScene.pointerX, flowersScene.pointerY);
            else return;
            if(pickinfo.hit){
                var theInitMesh = pickinfo.pickedMesh.name;
                console.log("THe mesh clicked: ", theInitMesh, pickinfo.pickedMesh.position, pickinfo.pickedMesh.rotationQuaternion);

                // if(flowersMbayeMap.has(theInitMesh) && currScene == "flowersScene") enable_gizmo(pickinfo.pickedMesh);
               
                if(flowersMbayeMap.has(theInitMesh) && currScene == "flowersScene"){
                    let hasName = get_has_flower_name(theInitMesh);
                    
                    if(hasName){
                        let val = flowersMbayeMap.get(theInitMesh);
                        let videoId = val[4].id;                            //4th value is the video id
                        let startTime = val[4].start;
                        set_carpet_countries(theInitMesh);
                        reset_selected_flower_camera();
                        setTimeout(function(){
                            flowersCamera.detachControl(canvas);
                            open_book_of_flowers(theInitMesh);              //open book of flowers
                            load_flower_music(videoId, startTime);          //load the music video
                            showPage(val[3],videoId);                       //show wikipedia page
                            showSelectedFlowerScene = true;
                            
                        },1500);
                        
                        // if(theClick===0) play_flower_music();
                        // else change_flower_music();
                              
                        
                       
                    }
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

    engine.runRenderLoop(function () {

        if(theScene && selectedFlowerScene){
            // if(chosenFlower) console.log(chosenFlower.position, chosenFlower.rotationQuaternion);
            // console.log(flowersCamera.position);
            // if(nuvolaSpeech1) console.log(nuvolaSpeech1.position, nuvolaSpeech1.rotationQuaternion);
            //render the scene
            if(isShowFlowerScene) theScene.render();
            if(showSelectedFlowerScene){ selectedFlowerScene.render();}
           
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
            
        }    
    }); 

});


// window resize handler
window.addEventListener("resize", function () {
    engine.resize();
});

           


$('#wikiPage').on('load',function(){
    $('.iframe-loading').hide();
});

    let isScreenVisible = false;
    let isCharDivFullscreen = false;
    function showPage(pageName,videoId) {
        $('.iframe-loading').show();
        let loader = document.getElementById("iframe-loading");
        let x = document.getElementById("flowersWikipediaDiv");
        let page = document.getElementById("wikiPage");

        if(loader.style.visibility != "visible") loader.style.visibility = "visible";
        

        page.src = pageName;
        document.getElementById("page-url").textContent = pageName+"";
        document.getElementById("song-url").href = "https://www.youtube.com/watch?v="+videoId;
        document.getElementById("song-url-span").textContent = "https://www.youtube.com/watch?v="+videoId;
        if(x.style.visibility != "visible"){
            x.style.visibility = "visible";  
            isScreenVisible = true;
        }else return;
    }

    

    function hidePage(){
        let loader = document.getElementById("iframe-loading");
        var x = document.getElementById("flowersWikipediaDiv");
        var page = document.getElementById("wikiPage");
        page.src = "";

        x.style.visibility = "hidden";
        loader.style.visibility = "hidden";
        isScreenVisible = false;
    }

    function fullscreenDescDiv(){
        if(!isCharDivFullscreen){
            document.getElementById("fullscreen-btn").src= "front/images3D/minimize-btn.png";
            document.getElementById("fullscreen-btn").title= "Windowed";
            document.getElementById("flowersWikipediaDiv").style.width = "100vw";
            isCharDivFullscreen = true;
        }else{
            document.getElementById("fullscreen-btn").title= "Fullscreen";
            document.getElementById("fullscreen-btn").src= "front/images3D/fullscreen-btn.png";
            document.getElementById("flowersWikipediaDiv").style.width = "25vw";
            isCharDivFullscreen = false;
        }
    }//end of fullscreenDescDiv



    document.onkeydown = (evt)=>{
     
        //key press: p or P - enable position arrows
        //key press: r or R - enable rotation arrows
        //key press: s or S - enable bounding box for scaling / bounding box gizmo
        // console.log(evt.key);
        if(evt.key == 'o' || evt.key == 'O'){
            currFlower = null;
            homeGizmo.attachedMesh = null;
            homeGizmo2.attachedMesh = null;
        }
     
    }
    // Start by only enabling position control
    // document.onkeydown({key: 'p'})




    //the music player
    // let video_player = document.getElementById('player');
    let yt_player;
    let isMusicChanged = false;
    let theClick = 0;
    function setup_music_player(){
        console.log("setup music");
        // stopAllVideos();
        $('.player').empty();
        let initVideo = "";
        // video_player.empty();
        // if(yt_player && isMusicChanged){
            // yt_player = null;
            // isMusicChanged = false;
        // } 
        // ctrlq.innerHTML = '<img id="youtube-icon" src=""/><div id="youtube-player"></div>';
        // var video_id = $(this).data('videoid');
        // var start = $(this).data('starttime');
        var video_player = document.getElementById('player');
        // $('.player').html('<div id="'+video_player+'"></div>')
        // video_player.innerHTML = "<div id="+video_player+"></div>";
        // player.pauseVideo();

        console.log("video id: ", video_player)
        
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
        // player.setPlaybackQuality("small");
        // event.target.pauseVideo(); 
        
        // event.target.playVideo();
        // document.getElementById("youtube-audio").style.display = "block";
        // togglePlayButton(player.getPlayerState() !== 5);
        // console.log("ready",event);
        // event.target.mute();
        event.target.playVideo();
    }

    function load_flower_music(videoId,start) {
        $('.player').empty();
        console.log("load: ", videoId, start);
        // yt_player.seekTo(51);
        yt_player.loadVideoById(videoId,start);
       yt_player.playVideo();
    }


    function stop_flower_music(){
        yt_player.stopVideo(); 
    }



//     var canvas = document.getElementById("renderCanvas");
//     var engine = new BABYLON.Engine(canvas, true);
//     BABYLON.SceneLoader.Load("TestScene/", "test.babylon", engine, function (newScene) {    
//         newScene.executeWhenReady(function () {        
//             newScene.activeCamera.attachControl(canvas);        
//             engine.runRenderLoop(function () {            
//                 newScene.render();        
//             });    
//         });
//     }, function (progress) {    // To do: give progress feedback to user
// });