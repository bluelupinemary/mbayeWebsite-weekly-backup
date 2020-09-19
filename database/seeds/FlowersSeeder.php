<?php

use Illuminate\Database\Seeder;

class FlowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flowers')->truncate();
        $tags = [
            [
                'id'                    => 1,
                'codename'              => '1Protea',
                'flower_name'           => 'Protea',
            ],
            [
                'id'                    => 2,
                'codename'              => '2Sunflower',
                'flower_name'           => 'Sunflower',
            ],
            [
                'id'                    => 3,
                'codename'              => '3ArumLily',
                'flower_name'           => 'ArumLily',
            ],
            [
                'id'                    => 4,
                'codename'              => '4ColoradoBlueColumbine',
                'flower_name'           => 'ColoradoBlueColumbine',
            ],
            [
                'id'                    => 5,
                'codename'              => '5AlpineColumbine',
                'flower_name'           => 'AlpineColumbine',
            ],
            [
                'id'                    => 6,
                'codename'              => '6BlackEyedSusan',
                'flower_name'           => 'BlackEyedSusan',
            ],
            [
                'id'                    => 7,
                'codename'              => '7Daylily',
                'flower_name'           => 'Daylily',
            ],
            [
                'id'                    => 8,
                'codename'              => '8Chickweed',
                'flower_name'           => 'Chickweed',
            ],
            [
                'id'                    => 9,
                'codename'              => '9Damiana',
                'flower_name'           => 'Damiana',
            ],
            [
                'id'                    => 10,
                'codename'              => '10Poppy',
                'flower_name'           => 'Poppy',
            ],
            [
                'id'                    => 11,
                'codename'              => '11ArnicaMontana',
                'flower_name'           => 'ArnicaMontana',
            ],
            [
                'id'                    => 12,
                'codename'              => '12Buttercup',
                'flower_name'           => 'Buttercup',
            ],
            [
                'id'                    => 13,
                'codename'              => '13PinkCampion',
                'flower_name'           => 'PinkCampion',
            ],
            [
                'id'                    => 14,
                'codename'              => '14IxiaVersicolor',
                'flower_name'           => 'IxiaVersicolor',
            ],
            [
                'id'                    => 15,
                'codename'              => '15Iris',
                'flower_name'           => 'Iris',
            ],
            [
                'id'                    => 16,
                'codename'              => '16Pasque',
                'flower_name'           => 'Pasque',
            ],
            [
                'id'                    => 17,
                'codename'              => '17AfricanDaisy',
                'flower_name'           => 'AfricanDaisy',
            ],
            [
                'id'                    => 18,
                'codename'              => '18QueenElizabethRose',
                'flower_name'           => '18QueenElizabethRose',
            ],
            [
                'id'                    => 19,
                'codename'              => '19MorningGlory',
                'flower_name'           => 'MorningGlory',
            ],
            [
                'id'                    => 20,
                'codename'              => '20Primrose',
                'flower_name'           => 'Primrose',
            ],
            [
                'id'                    => 21,
                'codename'              => '21Malva',
                'flower_name'           => 'Malva',
            ],
            [
                'id'                    => 22,
                'codename'              => '22Cuckoo',
                'flower_name'           => 'Cuckoo',
            ],
            [
                'id'                    => 23,
                'codename'              => '23WesternColumbine',
                'flower_name'           => 'WesternColumbine',
            ],
            [
                'id'                    => 24,
                'codename'              => '24Harebell',
                'flower_name'           => 'Harebell',
            ],
            [
                'id'                    => 25,
                'codename'              => '25PilosellaAurantiaca',
                'flower_name'           => 'PilosellaAurantiaca',
            ],
            [
                'id'                    => 26,
                'codename'              => '26ChileanBellflower',
                'flower_name'           => 'ChileanBellflower',
            ],
            [
                'id'                    => 27,
                'codename'              => '27IrisPurdyi',
                'flower_name'           => 'IrisPurdyi',
            ],
            [
                'id'                    => 28,
                'codename'              => '28Petunia',
                'flower_name'           => 'Petunia',
            ],
            [
                'id'                    => 29,
                'codename'              => '29PetuniaExserta',
                'flower_name'           => 'PetuniaExserta',
            ],
            [
                'id'                    => 30,
                'codename'              => '30Pansy',
                'flower_name'           => 'Pansy',
            ],
            [
                'id'                    => 31,
                'codename'              => '31Willowherb',
                'flower_name'           => 'Willowherb',
            ],
            [
                'id'                    => 32,
                'codename'              => '32GeraldtonWax',
                'flower_name'           => 'GeraldtonWax',
            ],
            [
                'id'                    => 33,
                'codename'              => '33YulanMagnolia',
                'flower_name'           => 'YulanMagnolia',
            ],
            [
                'id'                    => 34,
                'codename'              => '34Tormentil',
                'flower_name'           => 'Tormentil',
            ],
            [
                'id'                    => 35,
                'codename'              => '35SpringGentian',
                'flower_name'           => 'SpringGentian',
            ],
            [
                'id'                    => 36,
                'codename'              => '36Foxglove',
                'flower_name'           => 'Foxglove',
            ],
            [
                'id'                    => 37,
                'codename'              => '37Snapdragon',
                'flower_name'           => 'Snapdragon',
            ],
            [
                'id'                    => 38,
                'codename'              => '38Anthurium',
                'flower_name'           => 'Anthurium',
            ],
            [
                'id'                    => 39,
                'codename'              => '39Amaryllis',
                'flower_name'           => 'Amaryllis',
            ],
            [
                'id'                    => 40,
                'codename'              => '40BlueWaterLily',
                'flower_name'           => 'BlueWaterLily',
            ],
            [
                'id'                    => 41,
                'codename'              => '41GenistaCorsica',
                'flower_name'           => 'GenistaCorsica',
            ],
            [
                'id'                    => 42,
                'codename'              => '42YellowLily',
                'flower_name'           => 'YellowLily',
            ],
            [
                'id'                    => 43,
                'codename'              => '43ArabianJasmine',
                'flower_name'           => 'ArabianJasmine',
            ],
            [
                'id'                    => 44,
                'codename'              => '44IrisAlbicans',
                'flower_name'           => 'IrisAlbicans',
            ],
            [
                'id'                    => 45,
                'codename'              => '45Euphorbia',
                'flower_name'           => 'Euphorbia',
            ],
            [
                'id'                    => 46,
                'codename'              => '46WesternWallflower',
                'flower_name'           => 'WesternWallflower',
            ],
            [
                'id'                    => 47,
                'codename'              => '47Plumeria',
                'flower_name'           => 'Plumeria',
            ],
            [
                'id'                    => 48,
                'codename'              => '48Fuchsia',
                'flower_name'           => 'Fuchsia',
            ],
            [
                'id'                    => 49,
                'codename'              => '49BoatOrchid',
                'flower_name'           => 'BoatOrchid',
            ],
            [
                'id'                    => 50,
                'codename'              => '50BeachRose',
                'flower_name'           => 'BeachRose',
            ],
            [
                'id'                    => 51,
                'codename'              => '51CypressVine',
                'flower_name'           => 'CypressVine',
            ],
            [
                'id'                    => 52,
                'codename'              => '52Hollyhocks',
                'flower_name'           => 'Hollyhocks',
            ],
            [
                'id'                    => 53,
                'codename'              => '53Rose',
                'flower_name'           => 'Rose',
            ],
            [
                'id'                    => 54,
                'codename'              => '54GardeniaThunbergia',
                'flower_name'           => 'GardeniaThunbergia',
            ],
            [
                'id'                    => 55,
                'codename'              => '55BlueEyedGrass',
                'flower_name'           => 'BlueEyedGrass',
            ],
            [
                'id'                    => 56,
                'codename'              => '56Trillium',
                'flower_name'           => 'Trillium',
            ],
            [
                'id'                    => 57,
                'codename'              => '57TigerLily',
                'flower_name'           => 'TigerLily',
            ],
            [
                'id'                    => 58,
                'codename'              => '58Spathodea',
                'flower_name'           => 'Spathodea',
            ],
            [
                'id'                    => 59,
                'codename'              => '59WhiteLotus',
                'flower_name'           => 'WhiteLotus',
            ],
            [
                'id'                    => 60,
                'codename'              => '60VeronicaChamaedrys',
                'flower_name'           => 'VeronicaChamaedrys',
            ],
            [
                'id'                    => 61,
                'codename'              => '61WildBluePhlox',
                'flower_name'           => '61WildBluePhlox',
            ],
            [
                'id'                    => 62,
                'codename'              => '62FirePink',
                'flower_name'           => 'FirePink',
            ],
            [
                'id'                    => 63,
                'codename'              => '63Clivia',
                'flower_name'           => 'Clivia',
            ],
            [
                'id'                    => 64,
                'codename'              => '64Laelia',
                'flower_name'           => 'Laelia',
            ],
            [
                'id'                    => 65,
                'codename'              => '65MicheliaFigo',
                'flower_name'           => 'MicheliaFigo',
            ],
            [
                'id'                    => 66,
                'codename'              => '66Fritillaries',
                'flower_name'           => 'Fritillaries',
            ],
            [
                'id'                    => 67,
                'codename'              => '67PeruvianLily',
                'flower_name'           => 'PeruvianLily',
            ],
            [
                'id'                    => 68,
                'codename'              => '68MexicanMarigold',
                'flower_name'           => 'MexicanMarigold',
            ],
            [
                'id'                    => 69,
                'codename'              => '69GeraniumCalifornicum',
                'flower_name'           => 'GeraniumCalifornicum',
            ],
            [
                'id'                    => 70,
                'codename'              => '70NarcissusPoeticus',
                'flower_name'           => 'NarcissusPoeticus',
            ],
            [
                'id'                    => 71,
                'codename'              => '71NarcissusLongispathus',
                'flower_name'           => 'NarcissusLongispathus',
            ],
            [
                'id'                    => 72,
                'codename'              => '72Aster',
                'flower_name'           => 'Aster',
            ],
            [
                'id'                    => 73,
                'codename'              => '73Strelitzia',
                'flower_name'           => 'Strelitzia',
            ],
            [
                'id'                    => 74,
                'codename'              => '74Poinsettia',
                'flower_name'           => 'Poinsettia',
            ],
            [
                'id'                    => 75,
                'codename'              => '75HydrangeaMacrophylla',
                'flower_name'           => 'HydrangeaMacrophylla',
            ],
            [
                'id'                    => 76,
                'codename'              => '76Wallflower',
                'flower_name'           => 'Wallflower',
            ],
            [
                'id'                    => 77,
                'codename'              => '77SweetPea',
                'flower_name'           => 'SweetPea',
            ],
            [
                'id'                    => 78,
                'codename'              => '78Camellia',
                'flower_name'           => 'Camellia',
            ],
            [
                'id'                    => 79,
                'codename'              => '79Freesia',
                'flower_name'           => 'Freesia',
            ],
            [
                'id'                    => 80,
                'codename'              => '80ThymeBroomrape',
                'flower_name'           => 'ThymeBroomrape',
            ],
            [
                'id'                    => 81,
                'codename'              => '81LeopardFlower',
                'flower_name'           => 'LeopardFlower',
            ],

            [
                'id'                    => 82,
                'codename'              => '82Gladiolus',
                'flower_name'           => 'Gladiolus',
            ],
            [
                'id'                    => 83,
                'codename'              => '83Heilala',
                'flower_name'           => 'Heilala',
            ],
            [
                'id'                    => 84,
                'codename'              => '84Tulips',
                'flower_name'           => 'Tulips',
            ],
            [
                'id'                    => 85,
                'codename'              => '85GoldenLily',
                'flower_name'           => 'GoldenLily',
            ],
            [
                'id'                    => 86,
                'codename'              => '86Welwitschia',
                'flower_name'           => 'Welwitschia',
            ],
            [
                'id'                    => 87,
                'codename'              => '87BlackOrchid',
                'flower_name'           => 'BlackOrchid',
            ],
            [
                'id'                    => 88,
                'codename'              => '88DevilsClaw',
                'flower_name'           => 'DevilsClaw',
            ],
            [
                'id'                    => 89,
                'codename'              => '89Baobab',
                'flower_name'           => 'Baobab',
            ],
            [
                'id'                    => 90,
                'codename'              => '90Cornflower',
                'flower_name'           => 'Cornflower',
            ],
            [
                'id'                    => 91,
                'codename'              => '91AloePolyphylla',
                'flower_name'           => 'AloePolyphylla',
            ],
            [
                'id'                    => 92,
                'codename'              => '92CalophyllumInophyllum',
                'flower_name'           => 'CalophyllumInophyllum',
            ],
            [
                'id'                    => 93,
                'codename'              => '93Dahlias',
                'flower_name'           => 'Dahlias',
            ],
            [
                'id'                    => 94,
                'codename'              => '94IberisGibraltarica',
                'flower_name'           => 'IberisGibraltarica',
            ],
            [
                'id'                    => 95,
                'codename'              => '95Dendrobium',
                'flower_name'           => 'Dendrobium',
            ],
            [
                'id'                    => 96,
                'codename'              => '96Poinciana',
                'flower_name'           => 'Poinciana',
            ],
            [
                'id'                    => 97,
                'codename'              => '97EasterLily',
                'flower_name'           => 'EasterLily',
            ],
            [
                'id'                    => 98,
                'codename'              => '98FlameLily',
                'flower_name'           => 'FlameLily',
            ],
            [
                'id'                    => 99,
                'codename'              => '99Agave',
                'flower_name'           => 'Agave',
            ],
            [
                'id'                    => 100,
                'codename'              => '100CockspurCoral',
                'flower_name'           => '100CockspurCoral',
            ],
            [
                'id'                    => 101,
                'codename'              => '101AcaciaFlower',
                'flower_name'           => 'AcaciaFlower',
            ],
            [
                'id'                    => 102,
                'codename'              => '102Edelweiss',
                'flower_name'           => 'Edelweiss',
            ],
            [
                'id'                    => 103,
                'codename'              => '103GerberaDaisy',
                'flower_name'           => 'GerberaDaisy',
            ],
            [
                'id'                    => 104,
                'codename'              => '104Lantana',
                'flower_name'           => 'Lantana',
            ],
            [
                'id'                    => 105,
                'codename'              => '105DwarfPoinciana',
                'flower_name'           => 'DwarfPoinciana',
            ],
            [
                'id'                    => 106,
                'codename'              => '106Flax',
                'flower_name'           => 'Flax',
            ],
            [
                'id'                    => 107,
                'codename'              => '107HimalayanBluePoppy',
                'flower_name'           => 'HimalayanBluePoppy',
            ],
            [
                'id'                    => 108,
                'codename'              => '108MyrtleMirto',
                'flower_name'           => 'MyrtleMirto',
            ],
            [
                'id'                    => 109,
                'codename'              => '109SimpohAir',
                'flower_name'           => 'SimpohAir',
            ],
            [
                'id'                    => 110,
                'codename'              => '110RothecaMyricoides',
                'flower_name'           => 'RothecaMyricoides',
            ],
            [
                'id'                    => 111,
                'codename'              => '111Rumduol',
                'flower_name'           => 'Rumduol',
            ],
            [
                'id'                    => 112,
                'codename'              => '112RedStinkwood',
                'flower_name'           => 'RedStinkwood',
            ],
            [
                'id'                    => 113,
                'codename'              => '113Bunchberry',
                'flower_name'           => 'Bunchberry',
            ],
            [
                'id'                    => 114,
                'codename'              => '114AerangisBiloba',
                'flower_name'           => 'AerangisBiloba',
            ],
            [
                'id'                    => 115,
                'codename'              => '115PlumBlossom',
                'flower_name'           => 'PlumBlossom',
            ],
            [
                'id'                    => 116,
                'codename'              => '116CattleyaTrianae',
                'flower_name'           => 'CattleyaTrianae',
            ],
            [
                'id'                    => 117,
                'codename'              => '117YlangYlang',
                'flower_name'           => 'YlangYlang',
            ],
            [
                'id'                    => 118,
                'codename'              => '118BlackGuarea',
                'flower_name'           => 'BlackGuarea',
            ],
            [
                'id'                    => 119,
                'codename'              => '119HexalobusMonopetalus',
                'flower_name'           => 'HexalobusMonopetalus',
            ],
            [
                'id'                    => 120,
                'codename'              => '120HedychiumCoronarium',
                'flower_name'           => 'HedychiumCoronarium',
            ],
            [
                'id'                    => 121,
                'codename'              => '121SolanumIncanum',
                'flower_name'           => 'SolanumIncanum',
            ],
            [
                'id'                    => 122,
                'codename'              => '122BayahibeRose',
                'flower_name'           => 'BayahibeRose',
            ],
            [
                'id'                    => 123,
                'codename'              => '123Hibiscus',
                'flower_name'           => 'Hibiscus',
            ],
            [
                'id'                    => 124,
                'codename'              => '124FlorDeIzote',
                'flower_name'           => 'FlorDeIzote',
            ],
            [
                'id'                    => 125,
                'codename'              => '125VernoniaDjalonensis',
                'flower_name'           => 'VernoniaDjalonensis',
            ],
            [
                'id'                    => 126,
                'codename'              => '126Tagimoucia',
                'flower_name'           => 'Tagimoucia',
            ],
            [
                'id'                    => 127,
                'codename'              => '127LilyOfTheValley',
                'flower_name'           => 'LilyOfTheValley',
            ],
            [
                'id'                    => 128,
                'codename'              => '128BearsBreech',
                'flower_name'           => 'BearsBreech',
            ],
            [
                'id'                    => 129,
                'codename'              => '129LycasteSkinneri',
                'flower_name'           => 'LycasteSkinneri',
            ],
            [
                'id'                    => 130,
                'codename'              => '130HibbertiaDentata',
                'flower_name'           => 'HibbertiaDentata',
            ],
            [
                'id'                    => 131,
                'codename'              => '131RhyncholaeliaDigbyana',
                'flower_name'           => 'RhyncholaeliaDigbyana',
            ],
            [
                'id'                    => 132,
                'codename'              => '132MountainAvens',
                'flower_name'           => 'MountainAvens',
            ],
            [
                'id'                    => 133,
                'codename'              => '133Rafflesia',
                'flower_name'           => 'Rafflesia',
            ],
            [
                'id'                    => 134,
                'codename'              => '134Shamrock',
                'flower_name'           => 'Shamrock',
            ],
            [
                'id'                    => 135,
                'codename'              => '135LignumVitae',
                'flower_name'           => 'LignumVitae',
            ],
            [
                'id'                    => 136,
                'codename'              => '136Chrysanthemum',
                'flower_name'           => 'Chrysanthemum',
            ],
            [
                'id'                    => 137,
                'codename'              => '137MagnoliaSieboldii',
                'flower_name'           => 'MagnoliaSieboldii',
            ],
            [
                'id'                    => 138,
                'codename'              => '138Paeony',
                'flower_name'           => 'Paeony',
            ],
            [
                'id'                    => 139,
                'codename'              => '139RhanteriumEpapposum',
                'flower_name'           => 'RhanteriumEpapposum',
            ],
            [
                'id'                    => 140,
                'codename'              => '140Rhododendron',
                'flower_name'           => 'Rhododendron',
            ],
            [
                'id'                    => 141,
                'codename'              => '141Pepper',
                'flower_name'           => 'Pepper',
            ],
            [
                'id'                    => 142,
                'codename'              => '142PomegranateBlossom',
                'flower_name'           => 'PomegranateBlossom',
            ],
            [
                'id'                    => 143,
                'codename'              => '143Rue',
                'flower_name'           => 'Rue',
            ],
            [
                'id'                    => 144,
                'codename'              => '144TrochetiaBoutoniana',
                'flower_name'           => 'TrochetiaBoutoniana',
            ],
            [
                'id'                    => 145,
                'codename'              => '145Olive',
                'flower_name'           => 'Olive',
            ],
            [
                'id'                    => 146,
                'codename'              => '146Scabiosa',
                'flower_name'           => 'Scabiosa',
            ],
            [
                'id'                    => 147,
                'codename'              => '147Padauk',
                'flower_name'           => 'Padauk',
            ],
            [
                'id'                    => 148,
                'codename'              => '148Kowhai',
                'flower_name'           => 'Kowhai',
            ],
            [
                'id'                    => 149,
                'codename'              => '149SilverFern',
                'flower_name'           => 'SilverFern',
            ],
            [
                'id'                    => 150,
                'codename'              => '150YellowTrumpet',
                'flower_name'           => 'YellowTrumpet',
            ],
            [
                'id'                    => 151,
                'codename'              => '151OpiumPoppy',
                'flower_name'           => 'OpiumPoppy',
            ],
            [
                'id'                    => 152,
                'codename'              => '152Heather',
                'flower_name'           => 'Heather',
            ],
            [
                'id'                    => 153,
                'codename'              => '153Peristeria',
                'flower_name'           => 'Peristeria',
            ],
            [
                'id'                    => 154,
                'codename'              => '154PassionFlower',
                'flower_name'           => 'PassionFlower',
            ],
            [
                'id'                    => 155,
                'codename'              => '155Qantuta',
                'flower_name'           => 'Qantuta',
            ],
            [
                'id'                    => 156,
                'codename'              => '156Lavender',
                'flower_name'           => 'Lavender',
            ],
            [
                'id'                    => 157,
                'codename'              => '157Limonium',
                'flower_name'           => 'Limonium',
            ],
            [
                'id'                    => 158,
                'codename'              => '158DogRose',
                'flower_name'           => 'DogRose',
            ],
            [
                'id'                    => 159,
                'codename'              => '159Camomile',
                'flower_name'           => 'Camomile',
            ],
            [
                'id'                    => 160,
                'codename'              => '160SoufriereTree',
                'flower_name'           => 'Camomile',
            ],
            [
                'id'                    => 161,
                'codename'              => '161RedGinger',
                'flower_name'           => 'RedGinger',
            ],
            [
                'id'                    => 162,
                'codename'              => '162Cyclamen',
                'flower_name'           => 'Cyclamen',
            ],
            [
                'id'                    => 163,
                'codename'              => '163PorcelainRose',
                'flower_name'           => 'PorcelainRose',
            ],
            [
                'id'                    => 164,
                'codename'              => '164PapilionantheMiss',
                'flower_name'           => 'PapilionantheMiss',
            ],
            [
                'id'                    => 165,
                'codename'              => '165Carnation',
                'flower_name'           => 'Carnation',
            ],
            [
                'id'                    => 166,
                'codename'              => '166MargueriteDaisy',
                'flower_name'           => 'MargueriteDaisy',
            ],
            [
                'id'                    => 167,
                'codename'              => '167Ixora',
                'flower_name'           => 'Ixora',
            ],
            [
                'id'                    => 168,
                'codename'              => '168LinnaeaBorealis',
                'flower_name'           => 'LinnaeaBorealis',
            ],
            [
                'id'                    => 169,
                'codename'              => '169Gagea',
                'flower_name'           => 'Gagea',
            ],
            [
                'id'                    => 170,
                'codename'              => '170Ratchaphruek',
                'flower_name'           => 'Ratchaphruek',
            ],
            [
                'id'                    => 171,
                'codename'              => '171SyzygiumAromaticum',
                'flower_name'           => 'SyzygiumAromaticum',
            ],
            [
                'id'                    => 172,
                'codename'              => '172Chaconia',
                'flower_name'           => 'Chaconia',
            ],
            [
                'id'                    => 173,
                'codename'              => '173Tribulus',
                'flower_name'           => 'Tribulus',
            ],
            [
                'id'                    => 174,
                'codename'              => '174ArabianCoffee',
                'flower_name'           => 'ArabianCoffee',
            ],
            [
                'id'                    => 175,
                'codename'              => '175ThymusCapitatus',
                'flower_name'           => 'ThymusCapitatus',
            ],
            [
                'id'                    => 176,
                'codename'              => '176BananaOrchid',
                'flower_name'           => 'BananaOrchid',
            ],
            [
                'id'                    => 177,
                'codename'              => '177Bougainvillea',
                'flower_name'           => 'Bougainvillea',
            ],
            [
                'id'                    => 178,
                'codename'              => '178Thistle',
                'flower_name'           => 'Thistle',
            ],
            [
                'id'                    => 179,
                'codename'              => '179Aerangis',
                'flower_name'           => 'Aerangis',
            ],
            [
                'id'                    => 180,
                'codename'              => '180PolystachyaBicalcarata',
                'flower_name'           => 'PolystachyaBicalcarata',
            ],
            [
                'id'                    => 181,
                'codename'              => '181VictoriaAmazonica',
                'flower_name'           => 'VictoriaAmazonica',
            ],
            [
                'id'                    => 182,
                'codename'              => '182Commelina',
                'flower_name'           => 'Commelina',
            ],
            [
                'id'                    => 183,
                'codename'              => '183Hyacinth',
                'flower_name'           => 'Hyacinth',
            ],
            [
                'id'                    => 184,
                'codename'              => '184ColchicumCupanii',
                'flower_name'           => 'ColchicumCupanii',
            ],
            [
                'id'                    => 185,
                'codename'              => '185BrimeuraAmethystina',
                'flower_name'           => 'BrimeuraAmethystina',
            ],
            [
                'id'                    => 186,
                'codename'              => '186LilyleafLadybells',
                'flower_name'           => 'LilyleafLadybells',
            ],
            [
                'id'                    => 187,
                'codename'              => '187Cactus',
                'flower_name'           => 'Cactus',
            ],
            [
                'id'                    => 188,
                'codename'              => '188AlliumSpathaceum',
                'flower_name'           => 'AlliumSpathaceum',
            ],
            [
                'id'                    => 189,
                'codename'              => '189GoldenDewdrop',
                'flower_name'           => 'GoldenDewdrop',
            ],
            [
                'id'                    => 190,
                'codename'              => '190EucalyptusAlba',
                'flower_name'           => 'EucalyptusAlba',
            ],
            [
                'id'                    => 191,
                'codename'              => '191PentasLanceolata',
                'flower_name'           => 'PentasLanceolata',
            ],
            [
                'id'                    => 192,
                'codename'              => '192EricaCerinthoides',
                'flower_name'           => 'EricaCerinthoides',
            ],
            [
                'id'                    => 193,
                'codename'              => '193Arundina',
                'flower_name'           => 'Arundina',
            ],
            [
                'id'                    => 194,
                'codename'              => '194YellowCrownImperial',
                'flower_name'           => 'YellowCrownImperial',
            ],
            [
                'id'                    => 195,
                'codename'              => '195PeganumHarmala',
                'flower_name'           => 'PeganumHarmala',
            ],
            [
                'id'                    => 196,
                'codename'              => '196Lycoris',
                'flower_name'           => 'Lycoris',
            ],
            [
                'id'                    => 197,
                'codename'              => '197PurpleBall',
                'flower_name'           => 'PurpleBall',
            ],
            [
                'id'                    => 198,
                'codename'              => '198TrochetiopsisEbenus',
                'flower_name'           => 'TrochetiopsisEbenus',
            ],
            [
                'id'                    => 199,
                'codename'              => '199CaribWood',
                'flower_name'           => 'CaribWood',
            ],
            [
                'id'                    => 200,
                'codename'              => '200RosaLaevigata',
                'flower_name'           => 'RosaLaevigata',
            ],
            [
                'id'                    => 201,
                'codename'              => '201PaleMaiden',
                'flower_name'           => 'PaleMaiden',
            ],
            [
                'id'                    => 202,
                'codename'              => '202TiareFlower',
                'flower_name'           => 'TiareFlower',
            ],
            [
                'id'                    => 203,
                'codename'              => '203ScorpionGrasses',
                'flower_name'           => 'ScorpionGrasses',
            ],
            [
                'id'                    => 204,
                'codename'              => '204CherryBlossom',
                'flower_name'           => 'CherryBlossom',
            ],
            [
                'id'                    => 205,
                'codename'              => '205Wisteria',
                'flower_name'           => 'Wisteria',
            ],
        ];

        DB::table('flowers')->insert($tags);
    }
}
