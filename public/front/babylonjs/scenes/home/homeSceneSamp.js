<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Babylon.js sample code</title>

        <!-- Babylon.js -->
        <script src="https://code.jquery.com/pep/0.4.2/pep.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.2/dat.gui.min.js"></script>
        <script src="https://preview.babylonjs.com/ammo.js"></script>
        <script src="https://preview.babylonjs.com/cannon.js"></script>
        <script src="https://preview.babylonjs.com/Oimo.js"></script>
        <script src="https://preview.babylonjs.com/earcut.min.js"></script>
        <script src="https://preview.babylonjs.com/babylon.js"></script>
        <script src="https://preview.babylonjs.com/inspector/babylon.inspector.bundle.js"></script>
        <script src="https://preview.babylonjs.com/materialsLibrary/babylonjs.materials.min.js"></script>
        <script src="https://preview.babylonjs.com/proceduralTexturesLibrary/babylonjs.proceduralTextures.min.js"></script>
        <script src="https://preview.babylonjs.com/postProcessesLibrary/babylonjs.postProcess.min.js"></script>
        <script src="https://preview.babylonjs.com/loaders/babylonjs.loaders.js"></script>
        <script src="https://preview.babylonjs.com/serializers/babylonjs.serializers.min.js"></script>
        <script src="https://preview.babylonjs.com/gui/babylon.gui.min.js"></script>

        <style>
            html, body {
                overflow: hidden;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            #renderCanvas {
                width: 100%;
                height: 100%;
                touch-action: none;
            }
        </style>
    </head>
<body>
    <canvas id="renderCanvas"></canvas>
    <script>
        var canvas = document.getElementById("renderCanvas");

        var engine = null;
        var scene = null;
        var sceneToRender = null;
        var createDefaultEngine = function() { return new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true }); };
        var createScene = function () {
        
            // This creates a basic Babylon Scene object (non-mesh)
            var scene = new BABYLON.Scene(engine);
        
            // This creates and positions a free camera (non-mesh)
            var camera = new BABYLON.ArcRotateCamera("arcR", Math.PI/2, Math.PI/2, 15, BABYLON.Vector3.Zero(), scene);
        
            // This attaches the camera to the canvas
            camera.attachControl(canvas, true);
        
            var ANote0 = BABYLON.MeshBuilder.CreateBox("ANote0", {width: 7.646700, height: 5.726200, depth: 0.100000 }, scene);
        	ANote0.position = BABYLON.Vector3.Zero();
        	var mat = new BABYLON.StandardMaterial("ANote0Mat",scene);
        	mat.diffuseColor = new BABYLON.Color4(0, 0, 0, 1);
        	ANote0.material = mat;
        	var planeOpts = {
        			height: 5.4762, 
        			width: 7.3967, 
        			sideOrientation: BABYLON.Mesh.BACKSIDE
        	};
        	var ANote0Video = BABYLON.MeshBuilder.CreatePlane("plane", planeOpts, scene);
        	var vidPos = (new BABYLON.Vector3(0,0,0.1)).addInPlace(ANote0.position);
            ANote0Video.position = vidPos;
        	var ANote0VideoMat = new BABYLON.StandardMaterial("m", scene);
        	var ANote0VideoVidTex = new BABYLON.VideoTexture("vidtex","public/front/videos/homeVideoTrim.mp4", scene);
        	ANote0VideoMat.diffuseTexture = ANote0VideoVidTex;
        	ANote0VideoMat.roughness = 1;
        	ANote0VideoMat.emissiveColor = new BABYLON.Color3.White();
        	ANote0Video.material = ANote0VideoMat;
        	scene.onPointerObservable.add(function(evt){
        			if(evt.pickInfo.pickedMesh === ANote0Video){
                        //console.log("picked");
        					if(ANote0VideoVidTex.video.paused)
        						ANote0VideoVidTex.video.play();
        					else
        						ANote0VideoVidTex.video.pause();
                            console.log(ANote0VideoVidTex.video.paused?"paused":"playing");
        			}
        	}, BABYLON.PointerEventTypes.POINTERPICK);
            //console.log(ANote0Video);
            return scene;
        
        };
    var engine;
    try {
    engine = createDefaultEngine();
    } catch(e) {
    console.log("the available createEngine function failed. Creating the default engine instead");
    engine = createDefaultEngine();
    }
        if (!engine) throw 'engine should not be null.';
        scene = createScene();;
        sceneToRender = scene

        engine.runRenderLoop(function () {
            if (sceneToRender) {
                sceneToRender.render();
            }
        });

        // Resize
        window.addEventListener("resize", function () {
            engine.resize();
        });
    </script>
</body>
</html>
