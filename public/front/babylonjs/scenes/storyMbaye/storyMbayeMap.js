

let marblePhotos = new Map(
    [
   
    //TIMES 2.5
    
    //row 1 left
    [ 1,[{x:973.67,y:321,z:203.18},{x:-0.0056, y: -0.7895, z:-0.0019, w:0.6129},{w:200,h:150}]], 
    [ 2,[{x:993.91,y:321,z:-0.77},{x: -0.0054, y: -0.6910, z:  -0.0029, w: 0.7224},{w:200,h:150}]], 
   
    //middle
    [ 3,[{x:976.81,y:321,z:-157.75},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 
    [ 4,[{x: 953.77,y:321.3,z: -260.73},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 

    //right
    [ 5,[{x: 893.70,y:321.3,z:-403.85},{x: -0.00461, y: -0.5052, z: -0.0041, w: 0.8627},{w:200,h:150}]], 
    [ 6,[{x: 766.25,y:321.3,z:-560.98},{x: -0.0038, y: -0.3530, z: -0.0048, w: 0.9352},{w:200,h:150}]], 
        
    //row 2 left
    [ 7,[{x:973.67,y:165,z:203.18},{x:-0.0056, y: -0.7895, z:-0.0019, w:0.6129},{w:200,h:150}]], 
    [ 8,[{x:993.91,y:165.3,z:-0.77},{x: -0.0054, y: -0.6910, z:  -0.0029, w: 0.7224},{w:200,h:150}]], 

    //middle
    [ 9,[{x:976.81,y:165,z:-157.75},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]],           
    [ 10,[{x: 953.77,y:165.3,z:-260.73},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 
   
     //right
    [ 11,[{x: 893.70,y:165,z:-403.85},{x: -0.00461, y: -0.5052, z: -0.0041, w: 0.8627},{w:200,h:150}]], 
    [ 12,[{x: 766.25,y:165.3,z:-560.98},{x: -0.0038, y: -0.3530, z: -0.0048, w: 0.9352},{w:200,h:150}]], 

    //row 3 left
    [ 13,[{x:973.67,y:10,z:203.18},{x:-0.0056, y: -0.7895, z:-0.0019, w:0.6129},{w:200,h:150}]], 
    [ 14,[{x:993.91,y:10.3,z:-0.77},{x: -0.0054, y: -0.6910, z:  -0.0029, w: 0.7224},{w:200,h:150}]], 

    //middle
    [ 15,[{x:976.81,y:10,z: -157.75},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 
    [ 16,[{x: 953.77,y:10.3,z:-260.73},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 
    
     //right
     [ 17,[{x: 893.70,y:10,z:-403.85},{x: -0.00461, y: -0.5052, z: -0.0041, w: 0.8627},{w:200,h:150}]], 
     [ 18,[{x: 766.25,y:10.3,z:-560.98},{x: -0.0038, y: -0.3530, z: -0.0048, w: 0.9352},{w:200,h:150}]], 

     //row 4 left
    [ 19,[{x:973.67,y:-147,z:203.18},{x:-0.0056, y: -0.7895, z:-0.0019, w:0.6129},{w:200,h:150}]], 
    [ 20,[{x:993.91,y:-148.5,z:-0.77},{x: -0.0054, y: -0.6910, z:  -0.0029, w: 0.7224},{w:200,h:150}]], 

    //middle
    [ 21,[{x:976.81,y: -147,z:-157.75},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]],
    [ 22,[{x: 953.77,y: -148.5,z:-260.73},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 

    //right
    [ 23,[{x: 893.70,y:-147,z:-403.85},{x: -0.00461, y: -0.5052, z: -0.0041, w: 0.8627},{w:200,h:150}]], 
    [ 24,[{x: 766.25,y:-148.5,z:-560.98},{x: -0.0038, y: -0.3530, z: -0.0048, w: 0.9352},{w:200,h:150}]], 

    //row 4 left
    [ 25,[{x:973.67,y:-305,z:203.18},{x:-0.0056, y: -0.7895, z:-0.0019, w:0.6129},{w:200,h:150}]], 
    [ 26,[{x:993.91,y:-306.5,z:-0.77},{x: -0.0054, y: -0.6910, z:  -0.0029, w: 0.7224},{w:200,h:150}]], 

    //middle
    [ 27,[{x:976.81,y:-305,z:-157.75},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]],
    [ 28,[{x: 953.77,y:-306.5,z:-260.73},{x: -0.005157576919988086, y: -0.6220353361347846, z: -0.0034800004655963193, w: 0.7826924936376735},{w:100,h:150}]], 

    //right
    [ 29,[{x: 893.70,y:-305,z:-403.85},{x: -0.00461, y: -0.5052, z: -0.0041, w: 0.8627},{w:200,h:150}]], 
    [ 30,[{x: 766.25,y:-306.5,z:-560.98},{x: -0.0038, y: -0.3530, z: -0.0048, w: 0.9352},{w:200,h:150}]], 
    
    
]);