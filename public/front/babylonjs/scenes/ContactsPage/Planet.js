class Planet {
    constructor(scene, position, radius,name,texPath,normalTexPath){
        this.scene = scene
        this.name = name;
        this.position = position;
        this.radius = radius;
        this.texPath = texPath;
        this.normalTexPath = normalTexPath;
        

        //if this is the sun, create new main planet obj that will be the basis for the planet clones and add glow; else, clone  the sun
        if(this.name === "sun"){
            this.obj = this.makeMainPlanet();
            this.obj.material.emissiveColor = BABYLON.Color3.White();
        }else{
            this.obj = this.clonePlanet();
        }
    //   this.addMaterial();

    
    //   temp.position = new BABYLON.Vector3(x_pos,y_pos,z_pos);
    // var temp_material = new BABYLON.StandardMaterial(material_name,homeScene);
    // temp_material.diffuseTexture = new BABYLON.Texture(texture_path, homeScene);
    // temp_material.bumpTexture = new BABYLON.Texture(normal_texture_path,homeScene);
    // temp_material.specularColor = new BABYLON.Color3(0,0,0);
    // // temp_material.freeze();
    // // temp.freezeWorldMatrix();
    // temp.material = temp_material;



    //   this.top = this.makeTop();
    //   this.bottom = this.makeBottom();
    //   this.stump = this.makeStump();
    //   this.stump.material = stumpMaterial;
    //   this.meshes= [...this.meshes, ...[this.top, this.bottom, this.stump]];
      
      // console.log(this.meshes)
    }
    makeMainPlanet(){
        let planet = BABYLON.Mesh.CreateSphere(this.name,0,this.radius,this.scene);
        planet.position = this.position;
        
        let planetMatl = new BABYLON.StandardMaterial(this.name+"matl",this.scene);
        planetMatl.diffuseTexture = new BABYLON.Texture(this.texPath, this.scene);
        planetMatl.bumpTexture = new BABYLON.Texture(this.normalTexPath,this.scene);
        planetMatl.specularColor = new BABYLON.Color3(0,0,0);
        planet.material = planetMatl;



        return planet; 
    }
    clonePlanet(){

    }
    
 
    // makeTop(){
    //   let _this = this;
    //   var top = BABYLON.MeshBuilder.CreateCylinder("cone", {diameterTop: 0, height:1, size: .5, tessellation: 6}, _this.scene);
    //   var newY = this.position.y + .7;
    //   top.parentMesh = _this;
    //   top.position = new BABYLON.Vector3(this.position.x, newY, this.position.z)
    //   return top;
    // }
    // makeBottom(){
    //   let _this = this;
    //   var bottom = BABYLON.MeshBuilder.CreateCylinder("cone", {diameterTop: 0, diameterBottom: 1.5, height: 1.2, tessellation: 6}, _this.scene);
    //   bottom.position = this.position
    //   bottom.parentMesh = _this;
    //   return bottom;
    // }
    // makeStump(){
    //   let _this = this;
    //   var stump = BABYLON.MeshBuilder.CreateCylinder("cone", {diameterTop: 0, diameterBottom: .5, diameterTop:.5, height: 1, tessellation: 6}, _this.scene);
      
    //   var newY = this.position.y - .8;
    //   stump.parentMesh = _this;
    //   stump.position = new BABYLON.Vector3(this.position.x, newY, this.position.z);
    //   stump.ignoreMaterials = true;
    //   return stump;
    // }
    // assignMaterial(mat){
    //   // console.log(mat)
    //   this.meshes.forEach(mesh=>{
    //     if(mesh.ignoreMaterials) return;
    //     mesh.material = mat;
    //   })
    // }
    // remove(){
    //   this.meshes.forEach( mesh=>{
    //     mesh.dispose();
    //   });
    // }
  }



//VUE JS SAMPLE
//   const Stage = {
//     data(){
//       return {
//         app: null,
//         balls: 0,
//         engine: null,
//         canvas: null,
//         scene: null,
//         hoveredMesh: null,
//         assets: {},
//         selectedBall: null,
//         previousMaterial: null
//       }
//     },
//     mounted(){
//       // console.log('loading stage');
//       this.init()
//       console.log(this.scene)
//     },
//     methods:{
//        init(){
//          const _this = this;
//          this.canvas = this.$refs.canvas;
//          this.engine = new BABYLON.Engine(this.canvas, true);
//           this.scene = new BABYLON.Scene(this.engine);
         
//          //camera
//          this.mainCamera =  new BABYLON.ArcRotateCamera("ArcRotateCamera", 1.5, 1.3, 20, BABYLON.Vector3.Zero(), this.scene);
  
//          //lights
//          this.mainLight = new BABYLON.HemisphericLight('light1', new BABYLON.Vector3(0,1,0), this.scene);
         
//          //Render Stuff
//          this.scene.beforeRender = function(){
           
//          }
         
         
//          this.engine.runRenderLoop( function(){
//            _this.scene.render();
//          });
//          window.addEventListener('resize', function(){
//            _this.engine.resize();
//          });
         
//          setTimeout( ()=>{
//            this.addBall();
//          }, 500);
//          setTimeout( ()=>{
//            this.addBall();
//          }, 1000);
//          setTimeout( ()=>{
//            this.addBall();
//          }, 1500);
         
//        },
      
//        addBall(){
//         if(this.balls >= 25){
//           alert('Play with the trees you\'ve got!');
//           return;
//         }
//         //
//         let x = Math.random() * 10;
//         x = Math.random() > .5 ? x : -x;
//         let y = 1//Math.random() * 5;
//         let z = Math.random() * 5;
//         let size = Math.random() * 5;
//         this.balls ++;
//         let key = this.balls;
         
//         // let orb = new BABYLON.Mesh.CreateSphere('sphere-' + key , 16, size, this.scene);
//         // orb.position = new BABYLON.Vector3(x, y, z);
//          let orb = new Piece(this.scene, key, x, y, z, size)
  
//           orb.top.actionManager = new BABYLON.ActionManager(this.scene);	
         
//          let orbMat = new BABYLON.StandardMaterial('orbMat-' + key, this.scene);
//          orbMat.diffuseColor = new BABYLON.Color3(Math.random(),Math.random(),Math.random());
     
//        orb.assignMaterial(orbMat);
//       },
//       canvasHover(e){
//         console.log(this.hoveredItem)
//       },
//       canvasClick(evt){
//         var _this = this;
//         var pickResult = this.scene.pick(evt.clientX, evt.clientY);
//         var mesh = pickResult.pickedMesh;
//         if(!mesh) return false;
//         if(this.selectedMesh && this.previousMaterial){
//           this.selectedMesh.material = this.previousMaterial;
//         }
//         this.selectedMesh = mesh;
        
//         console.log(evt)
        
//         var mat = mesh.material;
//         this.previousMaterial = mat;
//         var newMat = new BABYLON.StandardMaterial('testMat', this.scene);
//         newMat.diffuseColor = new BABYLON.Color3(1,1,1);
//         mesh.parentMesh.assignMaterial(newMat);
//         setTimeout( ()=>{
//           this.balls --;
//           mesh.parentMesh.remove();
//         }, 30)
//       },
//       canvasHover(){
//         this.hoveredMesh = this.scene.meshUnderPointer || false
//         console.log(this.hoveredMesh)
//       },
//       mouseOverMesh (unit_mesh) {
//         console.log ("mouse over");
//         console.log (unit_mesh);
//         // if (unit_mesh.meshUnderPointer !== null) {
//         //     unit_mesh.meshUnderPointer.renderOutline = false;	
//         //     unit_mesh.meshUnderPointer.outlineWidth = 1;
//         // }
//       },
//       mouseOutUnit (unit_mesh) {
//         console.log ("mouse out");
//         console.log (unit_mesh);
//         // if (unit_mesh.meshUnderPointer !== null) {
//         //     unit_mesh.meshUnderPointer.renderOutline = true;	
//         //     unit_mesh.meshUnderPointer.outlineWidth = 1;
//         // }
//       }
    
//     },
//     computed:{
//       hoveredItem(){
//         return this.scene && this.scene.meshUnderPointer || false;
//         // return false
//         // return this.scene
//       }
//     },
//     template: "#stage"
//   };
  
  
//   new Vue({
//     el: "#app",
//     render: h => h(Stage)
//   })