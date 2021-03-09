//earth scene: the structure used for the country names

var earthCountriesMap = new Map([                                                            //var to keep track of the variety of flowers
    ["Afghanistan",null],["Albania",null],["Algeria",null],["Andorra",null],["Angola",null],["Antigua_and_Barbuda",null],["Argentina",null],
    ["Armenia",null],["Australia",null],["Austria",null],["Azerbaijan",null],["Bahamas",null],["Bahrain",null],["Bangladesh",null],
    ["Barbados",null],["Belarus",null],["Belgium",null],["Belize",null],["Benin",null],["Bhutan",null],["Bolivia",null],["Bosnia_and_Herzegovina",null],
    ["Botswana",null],["Brazil",null],["Brunei",null],["Bulgaria",null],["Burkina_Faso",null],["Burundi",null],["Cape_Verde",null],
    ["Cambodia",null],["Cameroon",null],["Canada",null],["Central_African_Republic",null],
    ["Chad",null],["Chile",null],["China",null],["Colombia",null],["Comoros",null],["Chile",null],["China",null],["Colombia",null],
    ["Democratic_Republic_of_the_Congo",null],["Republic_of_the_Congo",null],["Costa_Rica",null],["Ivory_Coast",null],["Croatia",null],["Cuba",null],["Cyprus",null],["Czechia",null],
    ["Czech_Republic",null],["Denmark",null],["Djibouti",null],["Dominica",null],["Dominican_Republic",null],["Ecuador",null],["Egypt",null],["El_Salvador",null],["Equatorial_Guinea",null],
    ["Eritrea",null],["Estonia",null],["Swaziland",null],["Ethiopia",null],["Fiji",null],["Finland",null],["France",null],["Guinea-Bissau",null],["French_Guiana",null],
    ["Falkland_Islands",null],["Gabon",null],["The_Gambia",null],["Georgia",null],["Germany",null],["Ghana",null],["Greece",null],["Grenada",null],["Guatemala",null],
    ["Guinea-Bissau",null],["Guinea",null],["Haiti",null],["Honduras",null],["Hungary",null],["Iceland",null],["India",null],["Indonesia",null],["Iran",null],["Iraq",null],
    ["Ireland",null],["Israel",null],["Italy",null],["Jamaica",null],["Japan",null],["Jordan",null],["Kazakhstan",null],["Kenya",null],
    ["Kiribati",null],["Kosovo",null],["Kuwait",null],["Kyrgyzstan",null],["Japan",null],["Jordan",null],["Kazakhstan",null],["Kenya",null],
    ["Laos",null],["Latvia",null],["Lebanon",null],["Lesotho",null],["Liberia",null],["Libya",null],["Liechtenstein",null],["Lithuania",null],
    ["Luxembourg",null],["Madagascar",null],["Malawi",null],["Malaysia",null],["Maldives",null],["Mali",null],["Malta",null],["Marshall_Islands",null],
    ["Mauritania",null],["Mauritius",null],["Mexico",null],["Federated_States_of_Micronesia",null],["Moldova",null],["Monaco",null],["Mongolia",null],["Montenegro",null],
    ["Morocco",null],["Mozambique",null],["Myanmar",null],["Namibia",null],["Nauru",null],["Nepal",null],["Netherlands",null],["New_Zealand",null],
    ["Nicaragua",null],["Niger",null],["Nigeria",null],["North_Korea",null],["North_Macedonia",null],["Norway",null],["Oman",null],
    ["Pakistan",null],["Palau",null],["Palestine",null],["Panama",null],["Papua_New_Guinea",null],["Paraguay",null],["Peru",null],
    ["Philippines",null],["Poland",null],["Portugal",null],["Qatar",null],["Romania",null],["Russia",null],["Rwanda",null],
    ["Saint_Kitts_and_Nevis",null],["Saint_Lucia",null],["Saint_Vincent_and_the_Grenadines",null],["Samoa",null],["San_Marino",null],["Sao_Tome_and_Principe",null],
    ["Saudi_Arabia",null],["Senegal",null],["Serbia",null],["Seychelles",null],["Sierra_Leone",null],["Singapore",null],
    ["Slovakia",null],["Slovenia",null],["Solomon_Islands",null],["Somalia",null],["South_Africa",null],["South_Korea",null],
    ["South_Sudan",null],["Spain",null],["Sri_Lanka",null],["Somalia",null],["Sudan",null],["Suriname",null],
    ["Sweden",null],["Switzerland",null],["Syria",null],["Taiwan",null],["Tajikistan",null],["Tanzania",null],
    ["Thailand",null],["East_Timor",null],["Togo",null],["Tongo_Island",null],["Trinidad_and_Tobago",null],["Tunisia",null],
    ["Turkey",null],["Turkmenistan",null],["Tuvalu",null],["Ukraine",null],["United_Arab_Emirates",null],["United_Kingdom",null],
    ["United_States",null],["Uruguay",null],["Uzbekistan",null],["Vanuatu",null],["Vatican_City",null],["Venezuela",null],
    ["Vietnam",null],["Yemen",null],["Zambia",null],["Zimbabwe",null],["Uganda",null],["Sardinia",null],
   
    ["Chukchi_Sea",null],["Bering_Sea",null],["Gulf_of_Alaska",null],["Lincoln_Sea",null],["Baffin_Bay",null],["Labrador_Sea",null],
    ["Sargasso_Sea",null],["Carribean_Sea",null],["Chilean_Sea",null],["Scotia_Sea",null],["Weddell_Sea",null],["Amundsen_Sea",null],  
    ["Greenland_Sea",null],["Norwegian_Sea",null],["North_Sea",null],["Mediterranean_Sea",null],["Gulf_of_Guinea",null],["Barents_Sea",null],
    ["Black_Sea",null],["Caspian_Sea",null],["Red_Sea",null],["Arabian_Sea",null],["KeraSea",null],["Bay_of_Bengal",null],
    ["LaplevSea",null],["East_Siberian_Sea",null],["Sea_of_Okhotsk",null],["SeaOfJapan",null],["East_China_Sea",null],["South_China_Sea",null], 
    ["Timor_Sea",null],["Arafura_Sea",null],["Coral_Sea",null],["Tasman_Sea",null],["Ross_Sea",null],["Great_Australian_Bight",null],
    ["Pacific_Ocean",null],["Atlantic_Ocean",null],["Indian_Ocean",null],["Arctic_Ocean",null],["Beaufort_Sea",null],
    ["Philippine_Sea",null],["Southern_Ocean",null],["Sea_of_Japan",null],["Kara_Sea",null],["Laptev_Sea",null],["Persian_Gulf",null],

    ["helmetText",null],["helmetStars",null],
]);


var planetsMap = new Map([                                                            //var to keep track of the variety of flowers
    //key, val ; val => [texture name, normal map name, position,radius]
    ["sun",['sun.jpg','sunnormal.jpg',{x:-78,y:319,z:-2097},250]],
    ["mercury",['mercury.jpg','mercurynormal.jpg',{x:-442,y:226,z:-1428},0.32]],
    ["venus",['venus.jpg','venusnormal.jpg',{x:-317,y:95,z:-684},0.48]],
    ["moon",['moon.jpg','moonnormal.jpg',{x:329,y:163,z:-263},0.2]],
    ["mars",['mars.jpg','marsnormal.jpg',{x:-752,y:-42,z:78},0.3]],
    ["jupiter",['jupiter.jpg','jupiternormal.jpg',{x:210,y:-144,z:730},0.48]],
    ["saturn",['saturn.jpg','saturnnormal.jpg',{x:2551,y:436,z:-2414},220]],
    ["uranus",['uranus.jpg','uranusnormal.jpg',{x:-2097,y:-91,z:337},0.48]],
    ["neptune",['neptune.jpg','neptunenormal.jpg',{x:2835,y:-5,z:-76},0.92]],
    ["pluto",['pluto.jpg','plutonormal.jpg',{x:2300,y:400,z:500},0.4]],
]);



var planetsLinkTextMap = new Map([   
    //var to keep track of the variety of flowers
    //key, val ; val => [texture name, normal map name, position,radius]
    ["mercury",["Careers","blogview/tagwise/all?tag=careers"]],
    ["venus",["Films","blogview/tagwise/all?tag=films"]],
    ["moon",["Sports","blogview/tagwise/all?tag=travel"]],
    ["mars",["Our Mountains and Seas","blogview/tagwise/all?tag=mountains_and_seas"]],
    ["jupiter",["General","blogview/general/all"]],
    ["saturn",["Music","blogview/tagwise/all?tag=music"]],
    ["uranus",["Politics","blogview/tagwise/all?tag=politics"]],
    ["neptune",["Designs","blogview/designed-panel/all"]],
    ["pluto",["Travel","blogview/tagwise/all?tag=travel"]],
    ["sun",["You, Your Family and Friends","blogview/tagwise/all?tag=family_and_friends"]],
]);

var planetOrbitsMap = new Map([                                                            //var to keep track of the variety of flowers
    //key, val ; val => [texture name, position,rotation, scaling, radius]
    ["Earth",['planetorbit2.png',{x:0,y:0,z:0},{x:90,y:0,z:0},1.1,200]],
    ["Mercury",['planetorbit5.png',{x:-444.158,y:226.007,z:-1427.216},{x:110,y:0,z:0},0.3,200]],
    ["Venus",['planetorbit.png',{x:-317.946,y:90.369,z:-681.065},{x:100,y:0,z:0},0.4,200]],
    ["Mars",['planetorbit3.png',{x:-754.426,y:-45.511,z:78.592},{x:90,y:0,z:0},0.25,200]],
    ["Jupiter",['',{x:210.424,y:-145.791,z:729.638},{x:90,y:0,z:0},0.4,200]],
    ["Saturn",['',{x:2568.391,y:456.358,z:-2411.465},{x:90,y:0,z:0},1.1,200]],
    ["Uranus",['',{x:-2100.472,y:-98.486,z:339.091},{x:110,y:0,z:0},0.5,200]],
    ["Neptune",['planetorbit6.png',{x:2833.940,y:-1.771,z:-79.771},{x:110,y:0,z:0},0.9,200]],
    ["Pluto",['planetorbit6.png',{x:2299.891,y:400.604,z:500.918},{x:110,y:0,z:0},0.4,200]],
    ["Moon",['',{x:329.613,y:157.802,z:-263.126},{x:110,y:0,z:0},0.25,200]],
    ["Sun",['planetorbit6.png',{x:-80.91,y:308.13,z:-2082.51},{x:110,y:0,z:0},0.8,200]],
    
]);

//to be modified
var constellationsMap = new Map([                                                            //var to keep track of the variety of flowers
    //key, val ; val => [texture name, position,rotationQ, scaling]
    ["Leo",['leo.png',{x:-2877,y:4345,z:1908},{x:-0.553,y:0.438,z:0.438,w:0.553},14]],
    ["Gemini",['gemini.png',{x:4000,y:2823,z:900},{x:-0.149,y:0.729,z:0.179,w:0.632},14]],
 
    
]);

var wikiMap = new Map([                                                            //var to keep track of the variety of flowers
    //wiki links for each planet, if null, the key will be used as value
    ["Earth",null],
    ["Mercury","Mercury_(planet)"],
    ["Venus",null],
    ["Mars",null],
    ["Jupiter",null],
    ["Saturn",null],
    ["Uranus",null],
    ["Neptune",null],
    ["Pluto",null],
    ["Moon",null],
    ["Sun",null],

    //wiki links for each constellation
    ["Leo","Leo_(constellation)"],
    ["Gemini","Gemini_(constellation)"],
    ["Aquarius","Aquarius_(constellation)"],
    ["Aries","Aries_(constellation)"],
    ["Cancer","Cancer_(constellation)"],
    ["Capricorn","Capricorn_(constellation)"],
    ["Libra","Libra_(constellation)"],
    ["Pisces","Pisces_(constellation)"],
    ["Sagittarius","Sagittarius_(constellation)"],
    ["Scorpio","Scorpio_(constellation)"],
    ["Taurus","Taurus_(constellation)"],
    ["Virgo","Virgo_(constellation)"],

    //michael's wiki
    ["helmetStars","Michael_Schumacher"]
]);


var earthPartsMap = new Map([                                                            //var to keep track of the parts of the earth
    ["NorthPole",null],
    ["North America",null],
    ["South America",null],
    ["Antartica",null],
    ["Europe",null],
    ["Africa",null],
    ["Autralia",null],
    ["Sea",null],
    ["Asia",null],
]);


var astronautTextsMap = new Map([                                                            //var to keep track of the parts of the earth
    ["placeMbaye",null],
    ["showCountries",null],
    ["showBorders",null],
    ["showLabels",null],
    ["rotateEarthWithMbaye",null],
    ["rotateEarth",null],
    ["designPanels",null],
    ["showInstructions",null],
    ["initialView",null],
    ["removeFlower",null],
    ["toolPosition",null],
    ["toolRotation",null],
    ["toolScaleUp",null],
    ["toolScaleDown",null],
    ["toolDisable",null],
]);

var astronautTextsBtnMap = new Map([                                                            //var to keep track of the parts of the earth
    ["placeMbaye","btn1"],
    ["showCountries","btn2"],
    ["showBorders","btn3"],
    ["showLabels","btn4"],
    ["rotateEarthWithMbaye","btn5"],
    ["rotateEarth","btn6"],
    ["designPanels","btn8"],
    ["showInstructions","btn9"],
    ["initialView","btn10"],
    ["removeFlower","btn15"],
    ["toolPosition","btn16"],
    ["toolRotation","btn17"],
    ["toolScaleUp","btn18"],
    ["toolScaleDown","btn19"],
    ["toolDisable","btn20"],
]);

var astronautBtnsMap = new Map([                                                            //var to keep track of the parts of the earth
    ["btn1",null],
    ["btn2",null],
    ["btn3",null],
    ["btn4",null],
    ["btn5",null],
    ["btn6",null],
    ["btn8",null],
    ["btn9",null],
    ["btn10",null],
    ["btn15",null],
    ["btn16",null],
    ["btn17",null],
    ["btn18",null],
    ["btn19",null],
    ["btn20",null],
]);


var astronautChestParts = new Map([
    // ["chest_yellowBtn",["",null]],
    ["chest_blueBtn",["User Profile","dashboard"]],
    ["chest_orangeBtn",["Home","/"]],
    ["chest_purpleBtn",["Instructions","instructions"]],
    // ["chest_redBtn",["",null]],
    ["Navigator",["Communicator","communicator"]]
]);


/** initialize planet labels **/
let planet_labels_map = new Map([
    ["travel",[250, 120,{x:2195, y:415,z:527},{x:-0.0443,y:0.8338,z:0.0517,w:0.5475}]],
    ["postDesigns",[400, 250,{x:2707, y:-3,z:-42},{x:0.0195,y:0.8354,z:-0.0450,w:0.5469}]],
    ["sports",[160, 80,{x:303, y:173,z:-240},{x:0.0368,y:0.9078,z:-0.0534,w:0.4134}]],
    ["storyCare",[400, 200,{x:-156, y:30,z:129},{x:0.0096,y:0.9093,z:0.0060,w:0.4149}]],
    ["general",[170, 85,{x:143, y:-111,z:748},{x:0.0056,y:0.8513,z:-0.0723,w:0.5187}]],
    ["music",[470, 275,{x:2410, y:462,z:-2245},{x:0.2091,y:0.8090,z:0.0806,w:0.5427}]],
    ["films",[250, 100,{x:-338, y:120,z:-617},{x:0.0697,y:0.9644,z:0.0235,w:0.2519}]],
    ["careers",[180, 130,{x:-451, y:244,z:-1381},{x:0.0697,y:0.9644,z:0.0235,w:0.2519}]],
    ["mountainsSeas",[150, 75,{x:-766, y:-20,z:120},{x:0.0707,y:0.9515,z:0.0202,w:0.2968}]],
    ["yourStory",[400, 200,{x:-133, y:301,z:-1896},{x:0.0373,y:0.9829,z:0.0198,w:0.1759}]],
    ["politics",[300, 150,{x:-2022, y:-81,z:331},{x:0.0115,y:0.6707,z:0.0726,w:-0.7372}]],
]);
