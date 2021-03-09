
//1 - initial view of park
//2 - Ground view of park
//3 - Museum view of park
//4 - Window view of museum
//5 - Capt Mbaye view of museum
//6 - View of Mbaye's head of park view
//7 - Underneath Mbaye view of park
//8 - Close-up view of feet in underneath Mbaye
//9 - Lift Scene view of the park
//10 - Different angle view of the head of mbaye in head scene
//11 - Night Scene
//12 - To the lift view
//13 - View Side of mbaye
//14 - View of head
var vrPartsMap = new Map([                                                       
    [1,[    {name:"Lift",x: 702,y:-402,z:-559,rotX: -0.7328, rotY:-0.4978, rotZ:-0.2175,rotW:-0.4082,scale:1},
            {name:"Museum",x: 801,y:-197,z:544,rotX:-0.4029, rotY:-0.2341, rotZ:-0.6281,rotW:-0.6220,scale:1},
            {name:"pond",x: 817,y:-563,z:54,rotX:-0.6765, rotY:-0.0802, rotZ:-0.5501,rotW:-0.4812,scale:0.7},
            {name:"Ground",x: 584,y:-786,z: -153,rotX:-0.7679, rotY:0.0385, rotZ:-0.3861,rotW:-0.5078,scale:0.7},
            {name:"mbayeBot",x: 222,y:-358,z: -900,rotX:-0.9667, rotY:0.1309, rotZ: -0.1345,rotW:-0.1682,scale:0.6},
            {name:"mbayeHead",x: 590,y:16,z: -800,rotX:-0.9466, rotY:0.01407, rotZ: -0.3179,rotW:0.02433,scale:0.6},
            {name:"Night",x: 417,y:560,z:692,rotX:-0.0528, rotY:-0.3694, rotZ:-0.8022,rotW:-0.4643,scale:0.8},
        ]
    ],

    [2,[
            {name:"Back",x: -826,y:459,z:272,rotX:0.6641, rotY:-0.3353, rotZ:-0.8318,rotW:-0.0515,scale:1},
			{name:"Head",x: 654,y:660,z:-323,rotX:0.9038, rotY:0.1666, rotZ:0.4463,rotW:-0.4518,scale:1},
			{name:"Museum",x: -46,y:-58,z:979,rotX:0.0013, rotY: 0.0375, rotZ:-1.0903,rotW:-0.2402,scale:0.5},
		]
    ],
    [3,[
            {name:"Exit",x: -668,y:-60,z:698,rotX: 0.2608, rotY:0.2679, rotZ:-0.7005,rotW:-0.6063,scale:1},
            {name:"Window",x: 812,y:72,z:-573,rotX: -0.5747, rotY: -0.6674, rotZ:-0.3411,rotW:-0.3250,scale:0.3},
            {name:"Captain Mbaye",x: 688,y:-6,z:-719,rotX:-0.5978, rotY:-0.6929, rotZ:-0.2889,rotW:-0.2769,scale:0.3},
        ]
    ],
    [4,[
            {name:"Museum Entrance",x:-782,y:-98,z:602,rotX:0.2955, rotY:0.3222, rotZ:-0.6830,rotW:-0.5833,scale:0.3},
            {name:"Captain Mbaye",x: -891,y:-248,z:-370,rotX:0.5225, rotY:0.6513, rotZ:-0.4434,rotW:-0.3220,scale:0.4},
        ]
    ],
    [5,[
            {name:"Museum Entrance",x: -907,y:0,z:409,rotX: 0.6809, rotY:0.0134, rotZ:-0.8853,rotW:-0.0039,scale:0.4},
            {name:"pond",x: 962,y:-72,z:223,rotX: -0.7741, rotY:0.0396, rotZ:-0.8038,rotW:-0.0186,scale:0.7},
        ]
    ],
    [6,[
            {name:"Back",x: -736,y:462,z:-455,rotX:0.9302, rotY:0.1636, rotZ:-0.3788,rotW:-0.4607,scale:1},
            {name:"Head",x: 763,y:191,z:-581,rotX:1.031, rotY: -0.0244, rotZ:0.3872,rotW:-0.1834,scale:1},
        ]
    ],
    [7,[
            {name:"Foot",x: 616,y:-149,z:-746,rotX:-1.0569, rotY:0.0570, rotZ: -0.3443,rotW:-0.0940,scale:1},
            {name:"Back",x: 651,y:634,z:358,rotX:-0.4279, rotY:-0.5670, rotZ:-0.8438,rotW:-0.1765,scale:1},
        ]
    ],
    [8,[
            {name:"Back",x: 375,y:613,z:669,rotX:-0.2189, rotY:-0.4673, rotZ:-0.9790,rotW:-0.1513,scale:0.8},
        ]
    ],
    [9,[
            {name:"Back",x: -526,y:440,z:-693,rotX:-0.2639, rotY:-0.9680, rotZ:-0.1078,rotW:0.4787,scale:1},
            {name:"Museum",x: -736,y:-165,z:634,rotX:0.4194, rotY:-0.2049, rotZ:-0.6491,rotW:0.7798,scale:0.7},
        ]
    ],
    [10,[
            {name:"Back",x: -526,y:440,z:-693,rotX:-0.2639, rotY:-0.9680, rotZ:-0.1078,rotW:0.4787,scale:1},
            {name:"Museum",x: -753,y:-225,z:600,rotX:0.1789, rotY:-0.3753, rotZ:-0.1122,rotW:1.0304,scale:1},
        ]
    ],
    [11,[
            {name:"Back",x: -565,y:666,z:-454,rotX:-0.2844, rotY:-0.8832, rotZ:-0.2284,rotW:0.5781,scale:1},
            {name:"Side View",x: 304,y:-246,z:-902,rotX:0.1029, rotY:-1.0930, rotZ: 0.1315,rotW: -0.1570,scale:0.7},
            {name:"View Head",x: 766,y:321,z:-515,rotX:-0.0975, rotY:-0.9371, rotZ:-0.2161,rotW:-0.5592,scale:1},

        ]
    ],
    [12,[
            {name:"Back",x: -565,y:666,z:-454,rotX:-0.2844, rotY:-0.8832, rotZ:-0.2284,rotW:0.5781,scale:1},
			{name:"Lift",x: 881,y:16,z:-459,rotX:-0.1517, rotY:-0.8894, rotZ:-0.0908,rotW:-0.6514,scale:0.6},
        ]
    ],
	[13,[
            {name:"Back",x: -565,y:666,z:-454,rotX:-0.2844, rotY:-0.8832, rotZ:-0.2284,rotW:0.5781,scale:1},
        ]
    ],
    [14,[
            {name:"Back",x: -565,y:666,z:-454,rotX:-0.2844, rotY:-0.8832, rotZ:-0.2284,rotW:0.5781,scale:1},
        ]
    ],

  
  ]);
