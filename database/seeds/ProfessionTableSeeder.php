<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // DB::table('professions')->truncate();
        $tags = [
            
                [
                    "id"=> 1,
                    "profession_name"=> "Accountants"
                ],
                [
                    "id"=> 2,
                    "profession_name"=> "Accountants and Auditors"
                ],
                [
                    "id"=> 3,
                    "profession_name"=> "Actors"
                ],
                [
                    "id"=> 4,
                    "profession_name"=> "Actuaries"
                ],
                [
                    "id"=> 5,
                    "profession_name"=> "Acupuncturists"
                ],
                [
                    "id"=> 6,
                    "profession_name"=> "Acute Care Nurses"
                ],
                [
                    "id"=> 7,
                    "profession_name"=> "Adapted Physical Education Specialists"
                ],
                [
                    "id"=> 8,
                    "profession_name"=> "Adhesive Bonding Machine Operators and Tenders"
                ],
                [
                    "id"=> 9,
                    "profession_name"=> "Administrative Law Judges, Adjudicators, and Hearing Officers"
                ],
                [
                    "id"=> 10,
                    "profession_name"=> "Administrative Services Managers"
                ],
                [
                    "id"=> 11,
                    "profession_name"=> "Adult Basic and Secondary Education and Literacy Teachers and Instructors"
                ],
                [
                    "id"=> 12,
                    "profession_name"=> "Advanced Practice Psychiatric Nurses"
                ],
                [
                    "id"=> 13,
                    "profession_name"=> "Advertising and Promotions Managers"
                ],
                [
                    "id"=> 14,
                    "profession_name"=> "Advertising Sales Agents"
                ],
                [
                    "id"=> 15,
                    "profession_name"=> "Aerospace Engineering and Operations Technicians"
                ],
                [
                    "id"=> 16,
                    "profession_name"=> "Aerospace Engineers"
                ],
                [
                    "id"=> 17,
                    "profession_name"=> "Agents and Business Managers of Artists, Performers, and Athletes"
                ],
                [
                    "id"=> 18,
                    "profession_name"=> "Agricultural and Food Science Technicians"
                ],
                [
                    "id"=> 19,
                    "profession_name"=> "Agricultural Engineers"
                ],
                [
                    "id"=> 20,
                    "profession_name"=> "Agricultural Equipment Operators"
                ],
                [
                    "id"=> 21,
                    "profession_name"=> "Agricultural Inspectors"
                ],
                [
                    "id"=> 22,
                    "profession_name"=> "Agricultural Sciences Teachers, Postsecondary"
                ],
                [
                    "id"=> 23,
                    "profession_name"=> "Agricultural Technicians"
                ],
                [
                    "id"=> 24,
                    "profession_name"=> "Agricultural Workers, All Other"
                ],
                [
                    "id"=> 25,
                    "profession_name"=> "Air Crew Members"
                ],
                [
                    "id"=> 26,
                    "profession_name"=> "Air Crew Officers"
                ],
                [
                    "id"=> 27,
                    "profession_name"=> "Air Traffic Controllers"
                ],
                [
                    "id"=> 28,
                    "profession_name"=> "Aircraft Cargo Handling Supervisors"
                ],
                [
                    "id"=> 29,
                    "profession_name"=> "Aircraft Launch and Recovery Officers"
                ],
                [
                    "id"=> 30,
                    "profession_name"=> "Aircraft Launch and Recovery Specialists"
                ],
                [
                    "id"=> 31,
                    "profession_name"=> "Aircraft Mechanics and Service Technicians"
                ],
                [
                    "id"=> 32,
                    "profession_name"=> "Aircraft Structure, Surfaces, Rigging, and Systems Assemblers"
                ],
                [
                    "id"=> 33,
                    "profession_name"=> "Airfield Operations Specialists"
                ],
                [
                    "id"=> 34,
                    "profession_name"=> "Airline Pilots, Copilots, and Flight Engineers"
                ],
                [
                    "id"=> 35,
                    "profession_name"=> "Allergists and Immunologists"
                ],
                [
                    "id"=> 36,
                    "profession_name"=> "Ambulance Drivers and Attendants, Except Emergency Medical Technicians"
                ],
                [
                    "id"=> 37,
                    "profession_name"=> "Amusement and Recreation Attendants"
                ],
                [
                    "id"=> 38,
                    "profession_name"=> "Anesthesiologist Assistants"
                ],
                [
                    "id"=> 39,
                    "profession_name"=> "Anesthesiologists"
                ],
                [
                    "id"=> 40,
                    "profession_name"=> "Animal Breeders"
                ],
                [
                    "id"=> 41,
                    "profession_name"=> "Animal Control Workers"
                ],
                [
                    "id"=> 42,
                    "profession_name"=> "Animal Scientists"
                ],
                [
                    "id"=> 43,
                    "profession_name"=> "Animal Trainers"
                ],
                [
                    "id"=> 44,
                    "profession_name"=> "Anthropologists"
                ],
                [
                    "id"=> 45,
                    "profession_name"=> "Anthropologists and Archeologists"
                ],
                [
                    "id"=> 46,
                    "profession_name"=> "Anthropology and Archeology Teachers, Postsecondary"
                ],
                [
                    "id"=> 47,
                    "profession_name"=> "Appraisers and Assessors of Real Estate"
                ],
                [
                    "id"=> 48,
                    "profession_name"=> "Appraisers, Real Estate"
                ],
                [
                    "id"=> 49,
                    "profession_name"=> "Aquacultural Managers"
                ],
                [
                    "id"=> 50,
                    "profession_name"=> "Arbitrators, Mediators, and Conciliators"
                ],
                [
                    "id"=> 51,
                    "profession_name"=> "Archeologists"
                ],
                [
                    "id"=> 52,
                    "profession_name"=> "Architects, Except Landscape and Naval"
                ],
                [
                    "id"=> 53,
                    "profession_name"=> "Architectural and Civil Drafters"
                ],
                [
                    "id"=> 54,
                    "profession_name"=> "Architectural and Engineering Managers"
                ],
                [
                    "id"=> 55,
                    "profession_name"=> "Architectural Drafters"
                ],
                [
                    "id"=> 56,
                    "profession_name"=> "Architecture Teachers, Postsecondary"
                ],
                [
                    "id"=> 57,
                    "profession_name"=> "Archivists"
                ],
                [
                    "id"=> 58,
                    "profession_name"=> "Area, Ethnic, and Cultural Studies Teachers, Postsecondary"
                ],
                [
                    "id"=> 59,
                    "profession_name"=> "Armored Assault Vehicle Crew Members"
                ],
                [
                    "id"=> 60,
                    "profession_name"=> "Armored Assault Vehicle Officers"
                ],
                [
                    "id"=> 61,
                    "profession_name"=> "Art Directors"
                ],
                [
                    "id"=> 62,
                    "profession_name"=> "Art Therapists"
                ],
                [
                    "id"=> 63,
                    "profession_name"=> "Art, Drama, and Music Teachers, Postsecondary"
                ],
                [
                    "id"=> 64,
                    "profession_name"=> "Artillery and Missile Crew Members"
                ],
                [
                    "id"=> 65,
                    "profession_name"=> "Artillery and Missile Officers"
                ],
                [
                    "id"=> 66,
                    "profession_name"=> "Artists and Related Workers, All Other"
                ],
                [
                    "id"=> 67,
                    "profession_name"=> "Assemblers and Fabricators, All Other"
                ],
                [
                    "id"=> 68,
                    "profession_name"=> "Assessors"
                ],
                [
                    "id"=> 69,
                    "profession_name"=> "Astronomers"
                ],
                [
                    "id"=> 70,
                    "profession_name"=> "Athletes and Sports Competitors"
                ],
                [
                    "id"=> 71,
                    "profession_name"=> "Athletic Trainers"
                ],
                [
                    "id"=> 72,
                    "profession_name"=> "Atmospheric and Space Scientists"
                ],
                [
                    "id"=> 73,
                    "profession_name"=> "Atmospheric, Earth, Marine, and Space Sciences Teachers, Postsecondary"
                ],
                [
                    "id"=> 74,
                    "profession_name"=> "Audio and Video Equipment Technicians"
                ],
                [
                    "id"=> 75,
                    "profession_name"=> "Audio-Visual and Multimedia Collections Specialists"
                ],
                [
                    "id"=> 76,
                    "profession_name"=> "Audiologists"
                ],
                [
                    "id"=> 77,
                    "profession_name"=> "Auditors"
                ],
                [
                    "id"=> 78,
                    "profession_name"=> "Automotive and Watercraft Service Attendants"
                ],
                [
                    "id"=> 79,
                    "profession_name"=> "Automotive Body and Related Repairers"
                ],
                [
                    "id"=> 80,
                    "profession_name"=> "Automotive Engineering Technicians"
                ],
                [
                    "id"=> 81,
                    "profession_name"=> "Automotive Engineers"
                ],
                [
                    "id"=> 82,
                    "profession_name"=> "Automotive Glass Installers and Repairers"
                ],
                [
                    "id"=> 83,
                    "profession_name"=> "Automotive Master Mechanics"
                ],
                [
                    "id"=> 84,
                    "profession_name"=> "Automotive Service Technicians and Mechanics"
                ],
                [
                    "id"=> 85,
                    "profession_name"=> "Automotive Specialty Technicians"
                ],
                [
                    "id"=> 86,
                    "profession_name"=> "Aviation Inspectors"
                ],
                [
                    "id"=> 87,
                    "profession_name"=> "Avionics Technicians"
                ],
                [
                    "id"=> 88,
                    "profession_name"=> "Baggage Porters and Bellhops"
                ],
                [
                    "id"=> 89,
                    "profession_name"=> "Bailiffs"
                ],
                [
                    "id"=> 90,
                    "profession_name"=> "Bakers"
                ],
                [
                    "id"=> 91,
                    "profession_name"=> "Barbers"
                ],
                [
                    "id"=> 92,
                    "profession_name"=> "Baristas"
                ],
                [
                    "id"=> 93,
                    "profession_name"=> "Bartenders"
                ],
                [
                    "id"=> 94,
                    "profession_name"=> "Bicycle Repairers"
                ],
                [
                    "id"=> 95,
                    "profession_name"=> "Bill and Account Collectors"
                ],
                [
                    "id"=> 96,
                    "profession_name"=> "Billing and Posting Clerks"
                ],
                [
                    "id"=> 97,
                    "profession_name"=> "Billing, Cost, and Rate Clerks"
                ],
                [
                    "id"=> 98,
                    "profession_name"=> "Biochemical Engineers"
                ],
                [
                    "id"=> 99,
                    "profession_name"=> "Biochemists and Biophysicists"
                ],
                [
                    "id"=> 100,
                    "profession_name"=> "Biofuels Processing Technicians"
                ],
                [
                    "id"=> 101,
                    "profession_name"=> "Biofuels Production Managers"
                ],
                [
                    "id"=> 102,
                    "profession_name"=> "Biofuels/Biodiesel Technology and Product Development Managers"
                ],
                [
                    "id"=> 103,
                    "profession_name"=> "Bioinformatics Scientists"
                ],
                [
                    "id"=> 104,
                    "profession_name"=> "Bioinformatics Technicians"
                ],
                [
                    "id"=> 105,
                    "profession_name"=> "Biological Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 106,
                    "profession_name"=> "Biological Scientists, All Other"
                ],
                [
                    "id"=> 107,
                    "profession_name"=> "Biological Technicians"
                ],
                [
                    "id"=> 108,
                    "profession_name"=> "Biologists"
                ],
                [
                    "id"=> 109,
                    "profession_name"=> "Biomass Plant Technicians"
                ],
                [
                    "id"=> 110,
                    "profession_name"=> "Biomass Power Plant Managers"
                ],
                [
                    "id"=> 111,
                    "profession_name"=> "Biomedical Engineers"
                ],
                [
                    "id"=> 112,
                    "profession_name"=> "Biostatisticians"
                ],
                [
                    "id"=> 113,
                    "profession_name"=> "Boilermakers"
                ],
                [
                    "id"=> 114,
                    "profession_name"=> "Bookkeeping, Accounting, and Auditing Clerks"
                ],
                [
                    "id"=> 115,
                    "profession_name"=> "Brickmasons and Blockmasons"
                ],
                [
                    "id"=> 116,
                    "profession_name"=> "Bridge and Lock Tenders"
                ],
                [
                    "id"=> 117,
                    "profession_name"=> "Broadcast News Analysts"
                ],
                [
                    "id"=> 118,
                    "profession_name"=> "Broadcast Technicians"
                ],
                [
                    "id"=> 119,
                    "profession_name"=> "Brokerage Clerks"
                ],
                [
                    "id"=> 120,
                    "profession_name"=> "Brownfield Redevelopment Specialists and Site Managers"
                ],
                [
                    "id"=> 121,
                    "profession_name"=> "Budget Analysts"
                ],
                [
                    "id"=> 122,
                    "profession_name"=> "Building Cleaning Workers, All Other"
                ],
                [
                    "id"=> 123,
                    "profession_name"=> "Bus and Truck Mechanics and Diesel Engine Specialists"
                ],
                [
                    "id"=> 124,
                    "profession_name"=> "Bus Drivers, School or Special Client"
                ],
                [
                    "id"=> 125,
                    "profession_name"=> "Bus Drivers, Transit and Intercity"
                ],
                [
                    "id"=> 126,
                    "profession_name"=> "Business Continuity Planners"
                ],
                [
                    "id"=> 127,
                    "profession_name"=> "Business Intelligence Analysts"
                ],
                [
                    "id"=> 128,
                    "profession_name"=> "Business Operations Specialists, All Other"
                ],
                [
                    "id"=> 129,
                    "profession_name"=> "Business Teachers, Postsecondary"
                ],
                [
                    "id"=> 130,
                    "profession_name"=> "Butchers and Meat Cutters"
                ],
                [
                    "id"=> 131,
                    "profession_name"=> "Buyers and Purchasing Agents, Farm Products"
                ],
                [
                    "id"=> 132,
                    "profession_name"=> "Cabinetmakers and Bench Carpenters"
                ],
                [
                    "id"=> 133,
                    "profession_name"=> "Camera and Photographic Equipment Repairers"
                ],
                [
                    "id"=> 134,
                    "profession_name"=> "Camera Operators, Television, Video, and Motion Picture"
                ],
                [
                    "id"=> 135,
                    "profession_name"=> "Captains, Mates, and Pilots of Water Vessels"
                ],
                [
                    "id"=> 136,
                    "profession_name"=> "Cardiovascular Technologists and Technicians"
                ],
                [
                    "id"=> 137,
                    "profession_name"=> "Career/Technical Education Teachers, Middle School"
                ],
                [
                    "id"=> 138,
                    "profession_name"=> "Career/Technical Education Teachers, Secondary School"
                ],
                [
                    "id"=> 139,
                    "profession_name"=> "Cargo and Freight Agents"
                ],
                [
                    "id"=> 140,
                    "profession_name"=> "Carpenters"
                ],
                [
                    "id"=> 141,
                    "profession_name"=> "Carpet Installers"
                ],
                [
                    "id"=> 142,
                    "profession_name"=> "Cartographers and Photogrammetrists"
                ],
                [
                    "id"=> 143,
                    "profession_name"=> "Cashiers"
                ],
                [
                    "id"=> 144,
                    "profession_name"=> "Cement Masons and Concrete Finishers"
                ],
                [
                    "id"=> 145,
                    "profession_name"=> "Chefs and Head Cooks"
                ],
                [
                    "id"=> 146,
                    "profession_name"=> "Chemical Engineers"
                ],
                [
                    "id"=> 147,
                    "profession_name"=> "Chemical Equipment Operators and Tenders"
                ],
                [
                    "id"=> 148,
                    "profession_name"=> "Chemical Plant and System Operators"
                ],
                [
                    "id"=> 149,
                    "profession_name"=> "Chemical Technicians"
                ],
                [
                    "id"=> 150,
                    "profession_name"=> "Chemistry Teachers, Postsecondary"
                ],
                [
                    "id"=> 151,
                    "profession_name"=> "Chemists"
                ],
                [
                    "id"=> 152,
                    "profession_name"=> "Chief Executives"
                ],
                [
                    "id"=> 153,
                    "profession_name"=> "Chief Sustainability Officers"
                ],
                [
                    "id"=> 154,
                    "profession_name"=> "Child, Family, and School Social Workers"
                ],
                [
                    "id"=> 155,
                    "profession_name"=> "Childcare Workers"
                ],
                [
                    "id"=> 156,
                    "profession_name"=> "Chiropractors"
                ],
                [
                    "id"=> 157,
                    "profession_name"=> "Choreographers"
                ],
                [
                    "id"=> 158,
                    "profession_name"=> "City and Regional Planning Aides"
                ],
                [
                    "id"=> 159,
                    "profession_name"=> "Civil Drafters"
                ],
                [
                    "id"=> 160,
                    "profession_name"=> "Civil Engineering Technicians"
                ],
                [
                    "id"=> 161,
                    "profession_name"=> "Civil Engineers"
                ],
                [
                    "id"=> 162,
                    "profession_name"=> "Claims Adjusters, Examiners, and Investigators"
                ],
                [
                    "id"=> 163,
                    "profession_name"=> "Claims Examiners, Property and Casualty Insurance"
                ],
                [
                    "id"=> 164,
                    "profession_name"=> "Cleaners of Vehicles and Equipment"
                ],
                [
                    "id"=> 165,
                    "profession_name"=> "Cleaning, Washing, and Metal Pickling Equipment Operators and Tenders"
                ],
                [
                    "id"=> 166,
                    "profession_name"=> "Clergy"
                ],
                [
                    "id"=> 167,
                    "profession_name"=> "Climate Change Analysts"
                ],
                [
                    "id"=> 168,
                    "profession_name"=> "Clinical Data Managers"
                ],
                [
                    "id"=> 169,
                    "profession_name"=> "Clinical Nurse Specialists"
                ],
                [
                    "id"=> 170,
                    "profession_name"=> "Clinical Psychologists"
                ],
                [
                    "id"=> 171,
                    "profession_name"=> "Clinical Research Coordinators"
                ],
                [
                    "id"=> 172,
                    "profession_name"=> "Clinical, Counseling, and School Psychologists"
                ],
                [
                    "id"=> 173,
                    "profession_name"=> "Coaches and Scouts"
                ],
                [
                    "id"=> 174,
                    "profession_name"=> "Coating, Painting, and Spraying Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 175,
                    "profession_name"=> "Coil Winders, Tapers, and Finishers"
                ],
                [
                    "id"=> 176,
                    "profession_name"=> "Coin, Vending, and Amusement Machine Servicers and Repairers"
                ],
                [
                    "id"=> 177,
                    "profession_name"=> "Combined Food Preparation and Serving Workers, Including Fast Food"
                ],
                [
                    "id"=> 178,
                    "profession_name"=> "Command and Control Center Officers"
                ],
                [
                    "id"=> 179,
                    "profession_name"=> "Command and Control Center Specialists"
                ],
                [
                    "id"=> 180,
                    "profession_name"=> "Commercial and Industrial Designers"
                ],
                [
                    "id"=> 181,
                    "profession_name"=> "Commercial Divers"
                ],
                [
                    "id"=> 182,
                    "profession_name"=> "Commercial Pilots"
                ],
                [
                    "id"=> 183,
                    "profession_name"=> "Communications Equipment Operators, All Other"
                ],
                [
                    "id"=> 184,
                    "profession_name"=> "Communications Teachers, Postsecondary"
                ],
                [
                    "id"=> 185,
                    "profession_name"=> "Community and Social Service Specialists, All Other"
                ],
                [
                    "id"=> 186,
                    "profession_name"=> "Community Health Workers"
                ],
                [
                    "id"=> 187,
                    "profession_name"=> "Compensation and Benefits Managers"
                ],
                [
                    "id"=> 188,
                    "profession_name"=> "Compensation, Benefits, and Job Analysis Specialists"
                ],
                [
                    "id"=> 189,
                    "profession_name"=> "Compliance Managers"
                ],
                [
                    "id"=> 190,
                    "profession_name"=> "Compliance Officers"
                ],
                [
                    "id"=> 191,
                    "profession_name"=> "Computer and Information Research Scientists"
                ],
                [
                    "id"=> 192,
                    "profession_name"=> "Computer and Information Systems Managers"
                ],
                [
                    "id"=> 193,
                    "profession_name"=> "Computer Hardware Engineers"
                ],
                [
                    "id"=> 194,
                    "profession_name"=> "Computer Network Architects"
                ],
                [
                    "id"=> 195,
                    "profession_name"=> "Computer Network Support Specialists"
                ],
                [
                    "id"=> 196,
                    "profession_name"=> "Computer Numerically Controlled Machine Tool Programmers, Metal and Plastic"
                ],
                [
                    "id"=> 197,
                    "profession_name"=> "Computer Occupations, All Other"
                ],
                [
                    "id"=> 198,
                    "profession_name"=> "Computer Operators"
                ],
                [
                    "id"=> 199,
                    "profession_name"=> "Computer Programmers"
                ],
                [
                    "id"=> 200,
                    "profession_name"=> "Computer Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 201,
                    "profession_name"=> "Computer Systems Analysts"
                ],
                [
                    "id"=> 202,
                    "profession_name"=> "Computer Systems Engineers/Architects"
                ],
                [
                    "id"=> 203,
                    "profession_name"=> "Computer User Support Specialists"
                ],
                [
                    "id"=> 204,
                    "profession_name"=> "Computer, Automated Teller, and Office Machine Repairers"
                ],
                [
                    "id"=> 205,
                    "profession_name"=> "Computer-Controlled Machine Tool Operators, Metal and Plastic"
                ],
                [
                    "id"=> 206,
                    "profession_name"=> "Concierges"
                ],
                [
                    "id"=> 207,
                    "profession_name"=> "Conservation Scientists"
                ],
                [
                    "id"=> 208,
                    "profession_name"=> "Construction and Building Inspectors"
                ],
                [
                    "id"=> 209,
                    "profession_name"=> "Construction and Related Workers, All Other"
                ],
                [
                    "id"=> 210,
                    "profession_name"=> "Construction Carpenters"
                ],
                [
                    "id"=> 211,
                    "profession_name"=> "Construction Laborers"
                ],
                [
                    "id"=> 212,
                    "profession_name"=> "Construction Managers"
                ],
                [
                    "id"=> 213,
                    "profession_name"=> "Continuous Mining Machine Operators"
                ],
                [
                    "id"=> 214,
                    "profession_name"=> "Control and Valve Installers and Repairers, Except Mechanical Door"
                ],
                [
                    "id"=> 215,
                    "profession_name"=> "Conveyor Operators and Tenders"
                ],
                [
                    "id"=> 216,
                    "profession_name"=> "Cooks, All Other"
                ],
                [
                    "id"=> 217,
                    "profession_name"=> "Cooks, Fast Food"
                ],
                [
                    "id"=> 218,
                    "profession_name"=> "Cooks, Institution and Cafeteria"
                ],
                [
                    "id"=> 219,
                    "profession_name"=> "Cooks, Private Household"
                ],
                [
                    "id"=> 220,
                    "profession_name"=> "Cooks, Restaurant"
                ],
                [
                    "id"=> 221,
                    "profession_name"=> "Cooks, Short Order"
                ],
                [
                    "id"=> 222,
                    "profession_name"=> "Cooling and Freezing Equipment Operators and Tenders"
                ],
                [
                    "id"=> 223,
                    "profession_name"=> "Copy Writers"
                ],
                [
                    "id"=> 224,
                    "profession_name"=> "Coroners"
                ],
                [
                    "id"=> 225,
                    "profession_name"=> "Correctional Officers and Jailers"
                ],
                [
                    "id"=> 226,
                    "profession_name"=> "Correspondence Clerks"
                ],
                [
                    "id"=> 227,
                    "profession_name"=> "Cost Estimators"
                ],
                [
                    "id"=> 228,
                    "profession_name"=> "Costume Attendants"
                ],
                [
                    "id"=> 229,
                    "profession_name"=> "Counseling Psychologists"
                ],
                [
                    "id"=> 230,
                    "profession_name"=> "Counselors, All Other"
                ],
                [
                    "id"=> 231,
                    "profession_name"=> "Counter and Rental Clerks"
                ],
                [
                    "id"=> 232,
                    "profession_name"=> "Counter Attendants, Cafeteria, Food Concession, and Coffee Shop"
                ],
                [
                    "id"=> 233,
                    "profession_name"=> "Couriers and Messengers"
                ],
                [
                    "id"=> 234,
                    "profession_name"=> "Court Clerks"
                ],
                [
                    "id"=> 235,
                    "profession_name"=> "Court Reporters"
                ],
                [
                    "id"=> 236,
                    "profession_name"=> "Court, Municipal, and License Clerks"
                ],
                [
                    "id"=> 237,
                    "profession_name"=> "Craft Artists"
                ],
                [
                    "id"=> 238,
                    "profession_name"=> "Crane and Tower Operators"
                ],
                [
                    "id"=> 239,
                    "profession_name"=> "Credit Analysts"
                ],
                [
                    "id"=> 240,
                    "profession_name"=> "Credit Authorizers"
                ],
                [
                    "id"=> 241,
                    "profession_name"=> "Credit Authorizers, Checkers, and Clerks"
                ],
                [
                    "id"=> 242,
                    "profession_name"=> "Credit Checkers"
                ],
                [
                    "id"=> 243,
                    "profession_name"=> "Credit Counselors"
                ],
                [
                    "id"=> 244,
                    "profession_name"=> "Criminal Investigators and Special Agents"
                ],
                [
                    "id"=> 245,
                    "profession_name"=> "Criminal Justice and Law Enforcement Teachers, Postsecondary"
                ],
                [
                    "id"=> 246,
                    "profession_name"=> "Critical Care Nurses"
                ],
                [
                    "id"=> 247,
                    "profession_name"=> "Crossing Guards"
                ],
                [
                    "id"=> 248,
                    "profession_name"=> "Crushing, Grinding, and Polishing Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 249,
                    "profession_name"=> "Curators"
                ],
                [
                    "id"=> 250,
                    "profession_name"=> "Customer Service Representatives"
                ],
                [
                    "id"=> 251,
                    "profession_name"=> "Customs Brokers"
                ],
                [
                    "id"=> 252,
                    "profession_name"=> "Cutters and Trimmers, Hand"
                ],
                [
                    "id"=> 253,
                    "profession_name"=> "Cutting and Slicing Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 254,
                    "profession_name"=> "Cutting, Punching, and Press Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 255,
                    "profession_name"=> "Cytogenetic Technologists"
                ],
                [
                    "id"=> 256,
                    "profession_name"=> "Cytotechnologists"
                ],
                [
                    "id"=> 257,
                    "profession_name"=> "Dancers"
                ],
                [
                    "id"=> 258,
                    "profession_name"=> "Data Entry Keyers"
                ],
                [
                    "id"=> 259,
                    "profession_name"=> "Data Warehousing Specialists"
                ],
                [
                    "id"=> 260,
                    "profession_name"=> "Database Administrators"
                ],
                [
                    "id"=> 261,
                    "profession_name"=> "Database Architects"
                ],
                [
                    "id"=> 262,
                    "profession_name"=> "Demonstrators and Product Promoters"
                ],
                [
                    "id"=> 263,
                    "profession_name"=> "Dental Assistants"
                ],
                [
                    "id"=> 264,
                    "profession_name"=> "Dental Hygienists"
                ],
                [
                    "id"=> 265,
                    "profession_name"=> "Dental Laboratory Technicians"
                ],
                [
                    "id"=> 266,
                    "profession_name"=> "Dentists, All Other Specialists"
                ],
                [
                    "id"=> 267,
                    "profession_name"=> "Dentists, General"
                ],
                [
                    "id"=> 268,
                    "profession_name"=> "Dermatologists"
                ],
                [
                    "id"=> 269,
                    "profession_name"=> "Derrick Operators, Oil and Gas"
                ],
                [
                    "id"=> 270,
                    "profession_name"=> "Designers, All Other"
                ],
                [
                    "id"=> 271,
                    "profession_name"=> "Desktop Publishers"
                ],
                [
                    "id"=> 272,
                    "profession_name"=> "Detectives and Criminal Investigators"
                ],
                [
                    "id"=> 273,
                    "profession_name"=> "Diagnostic Medical Sonographers"
                ],
                [
                    "id"=> 274,
                    "profession_name"=> "Dietetic Technicians"
                ],
                [
                    "id"=> 275,
                    "profession_name"=> "Dietitians and Nutritionists"
                ],
                [
                    "id"=> 276,
                    "profession_name"=> "Dining Room and Cafeteria Attendants and Bartender Helpers"
                ],
                [
                    "id"=> 277,
                    "profession_name"=> "Directors, Religious Activities and Education"
                ],
                [
                    "id"=> 278,
                    "profession_name"=> "Directors- Stage, Motion Pictures, Television, and Radio"
                ],
                [
                    "id"=> 279,
                    "profession_name"=> "Dishwashers"
                ],
                [
                    "id"=> 280,
                    "profession_name"=> "Dispatchers, Except Police, Fire, and Ambulance"
                ],
                [
                    "id"=> 281,
                    "profession_name"=> "Distance Learning Coordinators"
                ],
                [
                    "id"=> 282,
                    "profession_name"=> "Document Management Specialists"
                ],
                [
                    "id"=> 283,
                    "profession_name"=> "Door-To-Door Sales Workers, News and Street Vendors, and Related Workers"
                ],
                [
                    "id"=> 284,
                    "profession_name"=> "Drafters, All Other"
                ],
                [
                    "id"=> 285,
                    "profession_name"=> "Dredge Operators"
                ],
                [
                    "id"=> 286,
                    "profession_name"=> "Drilling and Boring Machine Tool Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 287,
                    "profession_name"=> "Driver/Sales Workers"
                ],
                [
                    "id"=> 288,
                    "profession_name"=> "Drywall and Ceiling Tile Installers"
                ],
                [
                    "id"=> 289,
                    "profession_name"=> "Earth Drillers, Except Oil and Gas"
                ],
                [
                    "id"=> 290,
                    "profession_name"=> "Economics Teachers, Postsecondary"
                ],
                [
                    "id"=> 291,
                    "profession_name"=> "Economists"
                ],
                [
                    "id"=> 292,
                    "profession_name"=> "Editors"
                ],
                [
                    "id"=> 293,
                    "profession_name"=> "Education Administrators, All Other"
                ],
                [
                    "id"=> 294,
                    "profession_name"=> "Education Administrators, Elementary and Secondary School"
                ],
                [
                    "id"=> 295,
                    "profession_name"=> "Education Administrators, Postsecondary"
                ],
                [
                    "id"=> 296,
                    "profession_name"=> "Education Administrators, Preschool and Childcare Center/Program"
                ],
                [
                    "id"=> 297,
                    "profession_name"=> "Education Teachers, Postsecondary"
                ],
                [
                    "id"=> 298,
                    "profession_name"=> "Education, Training, and Library Workers, All Other"
                ],
                [
                    "id"=> 299,
                    "profession_name"=> "Educational, Guidance, School, and Vocational Counselors"
                ],
                [
                    "id"=> 300,
                    "profession_name"=> "Electric Motor, Power Tool, and Related Repairers"
                ],
                [
                    "id"=> 301,
                    "profession_name"=> "Electrical and Electronic Engineering Technicians"
                ],
                [
                    "id"=> 302,
                    "profession_name"=> "Electrical and Electronic Equipment Assemblers"
                ],
                [
                    "id"=> 303,
                    "profession_name"=> "Electrical and Electronics Drafters"
                ],
                [
                    "id"=> 304,
                    "profession_name"=> "Electrical and Electronics Installers and Repairers, Transportation Equipment"
                ],
                [
                    "id"=> 305,
                    "profession_name"=> "Electrical and Electronics Repairers, Commercial and Industrial Equipment"
                ],
                [
                    "id"=> 306,
                    "profession_name"=> "Electrical and Electronics Repairers, Powerhouse, Substation, and Relay"
                ],
                [
                    "id"=> 307,
                    "profession_name"=> "Electrical Drafters"
                ],
                [
                    "id"=> 308,
                    "profession_name"=> "Electrical Engineering Technicians"
                ],
                [
                    "id"=> 309,
                    "profession_name"=> "Electrical Engineering Technologists"
                ],
                [
                    "id"=> 310,
                    "profession_name"=> "Electrical Engineers"
                ],
                [
                    "id"=> 311,
                    "profession_name"=> "Electrical Power-Line Installers and Repairers"
                ],
                [
                    "id"=> 312,
                    "profession_name"=> "Electricians"
                ],
                [
                    "id"=> 313,
                    "profession_name"=> "Electro-Mechanical Technicians"
                ],
                [
                    "id"=> 314,
                    "profession_name"=> "Electromechanical Engineering Technologists"
                ],
                [
                    "id"=> 315,
                    "profession_name"=> "Electromechanical Equipment Assemblers"
                ],
                [
                    "id"=> 316,
                    "profession_name"=> "Electronic Drafters"
                ],
                [
                    "id"=> 317,
                    "profession_name"=> "Electronic Equipment Installers and Repairers, Motor Vehicles"
                ],
                [
                    "id"=> 318,
                    "profession_name"=> "Electronic Home Entertainment Equipment Installers and Repairers"
                ],
                [
                    "id"=> 319,
                    "profession_name"=> "Electronics Engineering Technicians"
                ],
                [
                    "id"=> 320,
                    "profession_name"=> "Electronics Engineering Technologists"
                ],
                [
                    "id"=> 321,
                    "profession_name"=> "Electronics Engineers, Except Computer"
                ],
                [
                    "id"=> 322,
                    "profession_name"=> "Elementary School Teachers, Except Special Education"
                ],
                [
                    "id"=> 323,
                    "profession_name"=> "Elevator Installers and Repairers"
                ],
                [
                    "id"=> 324,
                    "profession_name"=> "Eligibility Interviewers, Government Programs"
                ],
                [
                    "id"=> 325,
                    "profession_name"=> "Embalmers"
                ],
                [
                    "id"=> 326,
                    "profession_name"=> "Emergency Management Directors"
                ],
                [
                    "id"=> 327,
                    "profession_name"=> "Emergency Medical Technicians and Paramedics"
                ],
                [
                    "id"=> 328,
                    "profession_name"=> "Endoscopy Technicians"
                ],
                [
                    "id"=> 329,
                    "profession_name"=> "Energy Auditors"
                ],
                [
                    "id"=> 330,
                    "profession_name"=> "Energy Brokers"
                ],
                [
                    "id"=> 331,
                    "profession_name"=> "Energy Engineers"
                ],
                [
                    "id"=> 332,
                    "profession_name"=> "Engine and Other Machine Assemblers"
                ],
                [
                    "id"=> 333,
                    "profession_name"=> "Engineering Teachers, Postsecondary"
                ],
                [
                    "id"=> 334,
                    "profession_name"=> "Engineering Technicians, Except Drafters, All Other"
                ],
                [
                    "id"=> 335,
                    "profession_name"=> "Engineers, All Other"
                ],
                [
                    "id"=> 336,
                    "profession_name"=> "English Language and Literature Teachers, Postsecondary"
                ],
                [
                    "id"=> 337,
                    "profession_name"=> "Entertainers and Performers, Sports and Related Workers, All Other"
                ],
                [
                    "id"=> 338,
                    "profession_name"=> "Entertainment Attendants and Related Workers, All Other"
                ],
                [
                    "id"=> 339,
                    "profession_name"=> "Environmental Compliance Inspectors"
                ],
                [
                    "id"=> 340,
                    "profession_name"=> "Environmental Economists"
                ],
                [
                    "id"=> 341,
                    "profession_name"=> "Environmental Engineering Technicians"
                ],
                [
                    "id"=> 342,
                    "profession_name"=> "Environmental Engineers"
                ],
                [
                    "id"=> 343,
                    "profession_name"=> "Environmental Restoration Planners"
                ],
                [
                    "id"=> 344,
                    "profession_name"=> "Environmental Science and Protection Technicians, Including Health"
                ],
                [
                    "id"=> 345,
                    "profession_name"=> "Environmental Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 346,
                    "profession_name"=> "Environmental Scientists and Specialists, Including Health"
                ],
                [
                    "id"=> 347,
                    "profession_name"=> "Epidemiologists"
                ],
                [
                    "id"=> 348,
                    "profession_name"=> "Equal Opportunity Representatives and Officers"
                ],
                [
                    "id"=> 349,
                    "profession_name"=> "Etchers and Engravers"
                ],
                [
                    "id"=> 350,
                    "profession_name"=> "Excavating and Loading Machine and Dragline Operators"
                ],
                [
                    "id"=> 351,
                    "profession_name"=> "Executive Secretaries and Executive Administrative Assistants"
                ],
                [
                    "id"=> 352,
                    "profession_name"=> "Exercise Physiologists"
                ],
                [
                    "id"=> 353,
                    "profession_name"=> "Explosives Workers, Ordnance Handling Experts, and Blasters"
                ],
                [
                    "id"=> 354,
                    "profession_name"=> "Extraction Workers, All Other"
                ],
                [
                    "id"=> 355,
                    "profession_name"=> "Extruding and Drawing Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 356,
                    "profession_name"=> "Extruding and Forming Machine Setters, Operators, and Tenders, Synthetic and Glass Fibers"
                ],
                [
                    "id"=> 357,
                    "profession_name"=> "Extruding, Forming, Pressing, and Compacting Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 358,
                    "profession_name"=> "Fabric and Apparel Patternmakers"
                ],
                [
                    "id"=> 359,
                    "profession_name"=> "Fabric Menders, Except Garment"
                ],
                [
                    "id"=> 360,
                    "profession_name"=> "Fallers"
                ],
                [
                    "id"=> 361,
                    "profession_name"=> "Family and General Practitioners"
                ],
                [
                    "id"=> 362,
                    "profession_name"=> "Farm and Home Management Advisors"
                ],
                [
                    "id"=> 363,
                    "profession_name"=> "Farm and Ranch Managers"
                ],
                [
                    "id"=> 364,
                    "profession_name"=> "Farm Equipment Mechanics and Service Technicians"
                ],
                [
                    "id"=> 365,
                    "profession_name"=> "Farm Labor Contractors"
                ],
                [
                    "id"=> 366,
                    "profession_name"=> "Farmers, Ranchers, and Other Agricultural Managers"
                ],
                [
                    "id"=> 367,
                    "profession_name"=> "Farmworkers and Laborers, Crop"
                ],
                [
                    "id"=> 368,
                    "profession_name"=> "Farmworkers and Laborers, Crop, Nursery, and Greenhouse"
                ],
                [
                    "id"=> 369,
                    "profession_name"=> "Farmworkers, Farm, Ranch, and Aquacultural Animals"
                ],
                [
                    "id"=> 370,
                    "profession_name"=> "Fashion Designers"
                ],
                [
                    "id"=> 371,
                    "profession_name"=> "Fence Erectors"
                ],
                [
                    "id"=> 372,
                    "profession_name"=> "Fiberglass Laminators and Fabricators"
                ],
                [
                    "id"=> 373,
                    "profession_name"=> "File Clerks"
                ],
                [
                    "id"=> 374,
                    "profession_name"=> "Film and Video Editors"
                ],
                [
                    "id"=> 375,
                    "profession_name"=> "Financial Analysts"
                ],
                [
                    "id"=> 376,
                    "profession_name"=> "Financial Clerks, All Other"
                ],
                [
                    "id"=> 377,
                    "profession_name"=> "Financial Examiners"
                ],
                [
                    "id"=> 378,
                    "profession_name"=> "Financial Managers"
                ],
                [
                    "id"=> 379,
                    "profession_name"=> "Financial Managers, Branch or Department"
                ],
                [
                    "id"=> 380,
                    "profession_name"=> "Financial Quantitative Analysts"
                ],
                [
                    "id"=> 381,
                    "profession_name"=> "Financial Specialists, All Other"
                ],
                [
                    "id"=> 382,
                    "profession_name"=> "Fine Artists, Including Painters, Sculptors, and Illustrators"
                ],
                [
                    "id"=> 383,
                    "profession_name"=> "Fire Inspectors"
                ],
                [
                    "id"=> 384,
                    "profession_name"=> "Fire Inspectors and Investigators"
                ],
                [
                    "id"=> 385,
                    "profession_name"=> "Fire Investigators"
                ],
                [
                    "id"=> 386,
                    "profession_name"=> "Fire-Prevention and Protection Engineers"
                ],
                [
                    "id"=> 387,
                    "profession_name"=> "Firefighters"
                ],
                [
                    "id"=> 388,
                    "profession_name"=> "First-Line Supervisors of Agricultural Crop and Horticultural Workers"
                ],
                [
                    "id"=> 389,
                    "profession_name"=> "First-Line Supervisors of Air Crew Members"
                ],
                [
                    "id"=> 390,
                    "profession_name"=> "First-Line Supervisors of All Other Tactical Operations Specialists"
                ],
                [
                    "id"=> 391,
                    "profession_name"=> "First-Line Supervisors of Animal Husbandry and Animal Care Workers"
                ],
                [
                    "id"=> 392,
                    "profession_name"=> "First-Line Supervisors of Aquacultural Workers"
                ],
                [
                    "id"=> 393,
                    "profession_name"=> "First-Line Supervisors of Construction Trades and Extraction Workers"
                ],
                [
                    "id"=> 394,
                    "profession_name"=> "First-Line Supervisors of Correctional Officers"
                ],
                [
                    "id"=> 395,
                    "profession_name"=> "First-Line Supervisors of Farming, Fishing, and Forestry Workers"
                ],
                [
                    "id"=> 396,
                    "profession_name"=> "First-Line Supervisors of Fire Fighting and Prevention Workers"
                ],
                [
                    "id"=> 397,
                    "profession_name"=> "First-Line Supervisors of Food Preparation and Serving Workers"
                ],
                [
                    "id"=> 398,
                    "profession_name"=> "First-Line Supervisors of Helpers, Laborers, and Material Movers, Hand"
                ],
                [
                    "id"=> 399,
                    "profession_name"=> "First-Line Supervisors of Housekeeping and Janitorial Workers"
                ],
                [
                    "id"=> 400,
                    "profession_name"=> "First-Line Supervisors of Landscaping, Lawn Service, and Groundskeeping Workers"
                ],
                [
                    "id"=> 401,
                    "profession_name"=> "First-Line Supervisors of Logging Workers"
                ],
                [
                    "id"=> 402,
                    "profession_name"=> "First-Line Supervisors of Mechanics, Installers, and Repairers"
                ],
                [
                    "id"=> 403,
                    "profession_name"=> "First-Line Supervisors of Non-Retail Sales Workers"
                ],
                [
                    "id"=> 404,
                    "profession_name"=> "First-Line Supervisors of Office and Administrative Support Workers"
                ],
                [
                    "id"=> 405,
                    "profession_name"=> "First-Line Supervisors of Personal Service Workers"
                ],
                [
                    "id"=> 406,
                    "profession_name"=> "First-Line Supervisors of Police and Detectives"
                ],
                [
                    "id"=> 407,
                    "profession_name"=> "First-Line Supervisors of Production and Operating Workers"
                ],
                [
                    "id"=> 408,
                    "profession_name"=> "First-Line Supervisors of Protective Service Workers, All Other"
                ],
                [
                    "id"=> 409,
                    "profession_name"=> "First-Line Supervisors of Retail Sales Workers"
                ],
                [
                    "id"=> 410,
                    "profession_name"=> "First-Line Supervisors of Transportation and Material-Moving Machine and Vehicle Operators"
                ],
                [
                    "id"=> 411,
                    "profession_name"=> "First-Line Supervisors of Weapons Specialists/Crew Members"
                ],
                [
                    "id"=> 412,
                    "profession_name"=> "Fish and Game Wardens"
                ],
                [
                    "id"=> 413,
                    "profession_name"=> "Fishers and Related Fishing Workers"
                ],
                [
                    "id"=> 414,
                    "profession_name"=> "Fitness and Wellness Coordinators"
                ],
                [
                    "id"=> 415,
                    "profession_name"=> "Fitness Trainers and Aerobics Instructors"
                ],
                [
                    "id"=> 416,
                    "profession_name"=> "Flight Attendants"
                ],
                [
                    "id"=> 417,
                    "profession_name"=> "Floor Layers, Except Carpet, Wood, and Hard Tiles"
                ],
                [
                    "id"=> 418,
                    "profession_name"=> "Floor Sanders and Finishers"
                ],
                [
                    "id"=> 419,
                    "profession_name"=> "Floral Designers"
                ],
                [
                    "id"=> 420,
                    "profession_name"=> "Food and Tobacco Roasting, Baking, and Drying Machine Operators and Tenders"
                ],
                [
                    "id"=> 421,
                    "profession_name"=> "Food Batchmakers"
                ],
                [
                    "id"=> 422,
                    "profession_name"=> "Food Cooking Machine Operators and Tenders"
                ],
                [
                    "id"=> 423,
                    "profession_name"=> "Food Preparation and Serving Related Workers, All Other"
                ],
                [
                    "id"=> 424,
                    "profession_name"=> "Food Preparation Workers"
                ],
                [
                    "id"=> 425,
                    "profession_name"=> "Food Processing Workers, All Other"
                ],
                [
                    "id"=> 426,
                    "profession_name"=> "Food Science Technicians"
                ],
                [
                    "id"=> 427,
                    "profession_name"=> "Food Scientists and Technologists"
                ],
                [
                    "id"=> 428,
                    "profession_name"=> "Food Servers, Nonrestaurant"
                ],
                [
                    "id"=> 429,
                    "profession_name"=> "Food Service Managers"
                ],
                [
                    "id"=> 430,
                    "profession_name"=> "Foreign Language and Literature Teachers, Postsecondary"
                ],
                [
                    "id"=> 431,
                    "profession_name"=> "Forensic Science Technicians"
                ],
                [
                    "id"=> 432,
                    "profession_name"=> "Forest and Conservation Technicians"
                ],
                [
                    "id"=> 433,
                    "profession_name"=> "Forest and Conservation Workers"
                ],
                [
                    "id"=> 434,
                    "profession_name"=> "Forest Fire Fighting and Prevention Supervisors"
                ],
                [
                    "id"=> 435,
                    "profession_name"=> "Forest Fire Inspectors and Prevention Specialists"
                ],
                [
                    "id"=> 436,
                    "profession_name"=> "Forest Firefighters"
                ],
                [
                    "id"=> 437,
                    "profession_name"=> "Foresters"
                ],
                [
                    "id"=> 438,
                    "profession_name"=> "Forestry and Conservation Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 439,
                    "profession_name"=> "Forging Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 440,
                    "profession_name"=> "Foundry Mold and Coremakers"
                ],
                [
                    "id"=> 441,
                    "profession_name"=> "Fraud Examiners, Investigators and Analysts"
                ],
                [
                    "id"=> 442,
                    "profession_name"=> "Freight and Cargo Inspectors"
                ],
                [
                    "id"=> 443,
                    "profession_name"=> "Freight Forwarders"
                ],
                [
                    "id"=> 444,
                    "profession_name"=> "Fuel Cell Engineers"
                ],
                [
                    "id"=> 445,
                    "profession_name"=> "Fuel Cell Technicians"
                ],
                [
                    "id"=> 446,
                    "profession_name"=> "Fundraisers"
                ],
                [
                    "id"=> 447,
                    "profession_name"=> "Funeral Attendants"
                ],
                [
                    "id"=> 448,
                    "profession_name"=> "Funeral Service Managers"
                ],
                [
                    "id"=> 449,
                    "profession_name"=> "Furnace, Kiln, Oven, Drier, and Kettle Operators and Tenders"
                ],
                [
                    "id"=> 450,
                    "profession_name"=> "Furniture Finishers"
                ],
                [
                    "id"=> 451,
                    "profession_name"=> "Gaming and Sports Book Writers and Runners"
                ],
                [
                    "id"=> 452,
                    "profession_name"=> "Gaming Cage Workers"
                ],
                [
                    "id"=> 453,
                    "profession_name"=> "Gaming Change Persons and Booth Cashiers"
                ],
                [
                    "id"=> 454,
                    "profession_name"=> "Gaming Dealers"
                ],
                [
                    "id"=> 455,
                    "profession_name"=> "Gaming Managers"
                ],
                [
                    "id"=> 456,
                    "profession_name"=> "Gaming Service Workers, All Other"
                ],
                [
                    "id"=> 457,
                    "profession_name"=> "Gaming Supervisors"
                ],
                [
                    "id"=> 458,
                    "profession_name"=> "Gaming Surveillance Officers and Gaming Investigators"
                ],
                [
                    "id"=> 459,
                    "profession_name"=> "Gas Compressor and Gas Pumping Station Operators"
                ],
                [
                    "id"=> 460,
                    "profession_name"=> "Gas Plant Operators"
                ],
                [
                    "id"=> 461,
                    "profession_name"=> "Gem and Diamond Workers"
                ],
                [
                    "id"=> 462,
                    "profession_name"=> "General and Operations Managers"
                ],
                [
                    "id"=> 463,
                    "profession_name"=> "Genetic Counselors"
                ],
                [
                    "id"=> 464,
                    "profession_name"=> "Geneticists"
                ],
                [
                    "id"=> 465,
                    "profession_name"=> "Geodetic Surveyors"
                ],
                [
                    "id"=> 466,
                    "profession_name"=> "Geographers"
                ],
                [
                    "id"=> 467,
                    "profession_name"=> "Geographic Information Systems Technicians"
                ],
                [
                    "id"=> 468,
                    "profession_name"=> "Geography Teachers, Postsecondary"
                ],
                [
                    "id"=> 469,
                    "profession_name"=> "Geological and Petroleum Technicians"
                ],
                [
                    "id"=> 470,
                    "profession_name"=> "Geological Sample Test Technicians"
                ],
                [
                    "id"=> 471,
                    "profession_name"=> "Geophysical Data Technicians"
                ],
                [
                    "id"=> 472,
                    "profession_name"=> "Geoscientists, Except Hydrologists and Geographers"
                ],
                [
                    "id"=> 473,
                    "profession_name"=> "Geospatial Information Scientists and Technologists"
                ],
                [
                    "id"=> 474,
                    "profession_name"=> "Geothermal Production Managers"
                ],
                [
                    "id"=> 475,
                    "profession_name"=> "Geothermal Technicians"
                ],
                [
                    "id"=> 476,
                    "profession_name"=> "Glass Blowers, Molders, Benders, and Finishers"
                ],
                [
                    "id"=> 477,
                    "profession_name"=> "Glaziers"
                ],
                [
                    "id"=> 478,
                    "profession_name"=> "Government Property Inspectors and Investigators"
                ],
                [
                    "id"=> 479,
                    "profession_name"=> "Graders and Sorters, Agricultural Products"
                ],
                [
                    "id"=> 480,
                    "profession_name"=> "Graduate Teaching Assistants"
                ],
                [
                    "id"=> 481,
                    "profession_name"=> "Graphic Designers"
                ],
                [
                    "id"=> 482,
                    "profession_name"=> "Green Marketers"
                ],
                [
                    "id"=> 483,
                    "profession_name"=> "Grinding and Polishing Workers, Hand"
                ],
                [
                    "id"=> 484,
                    "profession_name"=> "Grinding, Lapping, Polishing, and Buffing Machine Tool Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 485,
                    "profession_name"=> "Grounds Maintenance Workers, All Other"
                ],
                [
                    "id"=> 486,
                    "profession_name"=> "Hairdressers, Hairstylists, and Cosmetologists"
                ],
                [
                    "id"=> 487,
                    "profession_name"=> "Hazardous Materials Removal Workers"
                ],
                [
                    "id"=> 488,
                    "profession_name"=> "Health and Safety Engineers, Except Mining Safety Engineers and Inspectors"
                ],
                [
                    "id"=> 489,
                    "profession_name"=> "Health Diagnosing and Treating Practitioners, All Other"
                ],
                [
                    "id"=> 490,
                    "profession_name"=> "Health Educators"
                ],
                [
                    "id"=> 491,
                    "profession_name"=> "Health Specialties Teachers, Postsecondary"
                ],
                [
                    "id"=> 492,
                    "profession_name"=> "Health Technologists and Technicians, All Other"
                ],
                [
                    "id"=> 493,
                    "profession_name"=> "Healthcare Practitioners and Technical Workers, All Other"
                ],
                [
                    "id"=> 494,
                    "profession_name"=> "Healthcare Social Workers"
                ],
                [
                    "id"=> 495,
                    "profession_name"=> "Healthcare Support Workers, All Other"
                ],
                [
                    "id"=> 496,
                    "profession_name"=> "Hearing Aid Specialists"
                ],
                [
                    "id"=> 497,
                    "profession_name"=> "Heat Treating Equipment Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 498,
                    "profession_name"=> "Heating and Air Conditioning Mechanics and Installers"
                ],
                [
                    "id"=> 499,
                    "profession_name"=> "Heating, Air Conditioning, and Refrigeration Mechanics and Installers"
                ],
                [
                    "id"=> 500,
                    "profession_name"=> "Heavy and Tractor-Trailer Truck Drivers"
                ],
                [
                    "id"=> 501,
                    "profession_name"=> "Helpers, Construction Trades, All Other"
                ],
                [
                    "id"=> 502,
                    "profession_name"=> "Helpers--Brickmasons, Blockmasons, Stonemasons, and Tile and Marble Setters"
                ],
                [
                    "id"=> 503,
                    "profession_name"=> "Helpers--Carpenters"
                ],
                [
                    "id"=> 504,
                    "profession_name"=> "Helpers--Electricians"
                ],
                [
                    "id"=> 505,
                    "profession_name"=> "Helpers--Extraction Workers"
                ],
                [
                    "id"=> 506,
                    "profession_name"=> "Helpers--Installation, Maintenance, and Repair Workers"
                ],
                [
                    "id"=> 507,
                    "profession_name"=> "Helpers--Painters, Paperhangers, Plasterers, and Stucco Masons"
                ],
                [
                    "id"=> 508,
                    "profession_name"=> "Helpers--Pipelayers, Plumbers, Pipefitters, and Steamfitters"
                ],
                [
                    "id"=> 509,
                    "profession_name"=> "Helpers--Production Workers"
                ],
                [
                    "id"=> 510,
                    "profession_name"=> "Helpers--Roofers"
                ],
                [
                    "id"=> 511,
                    "profession_name"=> "Highway Maintenance Workers"
                ],
                [
                    "id"=> 512,
                    "profession_name"=> "Historians"
                ],
                [
                    "id"=> 513,
                    "profession_name"=> "History Teachers, Postsecondary"
                ],
                [
                    "id"=> 514,
                    "profession_name"=> "Histotechnologists and Histologic Technicians"
                ],
                [
                    "id"=> 515,
                    "profession_name"=> "Hoist and Winch Operators"
                ],
                [
                    "id"=> 516,
                    "profession_name"=> "Home Appliance Repairers"
                ],
                [
                    "id"=> 517,
                    "profession_name"=> "Home Economics Teachers, Postsecondary"
                ],
                [
                    "id"=> 518,
                    "profession_name"=> "Home Health Aides"
                ],
                [
                    "id"=> 519,
                    "profession_name"=> "Hospitalists"
                ],
                [
                    "id"=> 520,
                    "profession_name"=> "Hosts and Hostesses, Restaurant, Lounge, and Coffee Shop"
                ],
                [
                    "id"=> 521,
                    "profession_name"=> "Hotel, Motel, and Resort Desk Clerks"
                ],
                [
                    "id"=> 522,
                    "profession_name"=> "Human Factors Engineers and Ergonomists"
                ],
                [
                    "id"=> 523,
                    "profession_name"=> "Human Resources Assistants, Except Payroll and Timekeeping"
                ],
                [
                    "id"=> 524,
                    "profession_name"=> "Human Resources Managers"
                ],
                [
                    "id"=> 525,
                    "profession_name"=> "Human Resources Specialists"
                ],
                [
                    "id"=> 526,
                    "profession_name"=> "Hunters and Trappers"
                ],
                [
                    "id"=> 527,
                    "profession_name"=> "Hydroelectric Plant Technicians"
                ],
                [
                    "id"=> 528,
                    "profession_name"=> "Hydroelectric Production Managers"
                ],
                [
                    "id"=> 529,
                    "profession_name"=> "Hydrologists"
                ],
                [
                    "id"=> 530,
                    "profession_name"=> "Immigration and Customs Inspectors"
                ],
                [
                    "id"=> 531,
                    "profession_name"=> "Industrial Ecologists"
                ],
                [
                    "id"=> 532,
                    "profession_name"=> "Industrial Engineering Technicians"
                ],
                [
                    "id"=> 533,
                    "profession_name"=> "Industrial Engineering Technologists"
                ],
                [
                    "id"=> 534,
                    "profession_name"=> "Industrial Engineers"
                ],
                [
                    "id"=> 535,
                    "profession_name"=> "Industrial Machinery Mechanics"
                ],
                [
                    "id"=> 536,
                    "profession_name"=> "Industrial Production Managers"
                ],
                [
                    "id"=> 537,
                    "profession_name"=> "Industrial Safety and Health Engineers"
                ],
                [
                    "id"=> 538,
                    "profession_name"=> "Industrial Truck and Tractor Operators"
                ],
                [
                    "id"=> 539,
                    "profession_name"=> "Industrial-Organizational Psychologists"
                ],
                [
                    "id"=> 540,
                    "profession_name"=> "Infantry"
                ],
                [
                    "id"=> 541,
                    "profession_name"=> "Infantry Officers"
                ],
                [
                    "id"=> 542,
                    "profession_name"=> "Informatics Nurse Specialists"
                ],
                [
                    "id"=> 543,
                    "profession_name"=> "Information and Record Clerks, All Other"
                ],
                [
                    "id"=> 544,
                    "profession_name"=> "Information Security Analysts"
                ],
                [
                    "id"=> 545,
                    "profession_name"=> "Information Technology Project Managers"
                ],
                [
                    "id"=> 546,
                    "profession_name"=> "Inspectors, Testers, Sorters, Samplers, and Weighers"
                ],
                [
                    "id"=> 547,
                    "profession_name"=> "Installation, Maintenance, and Repair Workers, All Other"
                ],
                [
                    "id"=> 548,
                    "profession_name"=> "Instructional Coordinators"
                ],
                [
                    "id"=> 549,
                    "profession_name"=> "Instructional Designers and Technologists"
                ],
                [
                    "id"=> 550,
                    "profession_name"=> "Insulation Workers, Floor, Ceiling, and Wall"
                ],
                [
                    "id"=> 551,
                    "profession_name"=> "Insulation Workers, Mechanical"
                ],
                [
                    "id"=> 552,
                    "profession_name"=> "Insurance Adjusters, Examiners, and Investigators"
                ],
                [
                    "id"=> 553,
                    "profession_name"=> "Insurance Appraisers, Auto Damage"
                ],
                [
                    "id"=> 554,
                    "profession_name"=> "Insurance Claims and Policy Processing Clerks"
                ],
                [
                    "id"=> 555,
                    "profession_name"=> "Insurance Claims Clerks"
                ],
                [
                    "id"=> 556,
                    "profession_name"=> "Insurance Policy Processing Clerks"
                ],
                [
                    "id"=> 557,
                    "profession_name"=> "Insurance Sales Agents"
                ],
                [
                    "id"=> 558,
                    "profession_name"=> "Insurance Underwriters"
                ],
                [
                    "id"=> 559,
                    "profession_name"=> "Intelligence Analysts"
                ],
                [
                    "id"=> 560,
                    "profession_name"=> "Interior Designers"
                ],
                [
                    "id"=> 561,
                    "profession_name"=> "Internists, General"
                ],
                [
                    "id"=> 562,
                    "profession_name"=> "Interpreters and Translators"
                ],
                [
                    "id"=> 563,
                    "profession_name"=> "Interviewers, Except Eligibility and Loan"
                ],
                [
                    "id"=> 564,
                    "profession_name"=> "Investment Fund Managers"
                ],
                [
                    "id"=> 565,
                    "profession_name"=> "Investment Underwriters"
                ],
                [
                    "id"=> 566,
                    "profession_name"=> "Janitors and Cleaners, Except Maids and Housekeeping Cleaners"
                ],
                [
                    "id"=> 567,
                    "profession_name"=> "Jewelers"
                ],
                [
                    "id"=> 568,
                    "profession_name"=> "Jewelers and Precious Stone and Metal Workers"
                ],
                [
                    "id"=> 569,
                    "profession_name"=> "Judges, Magistrate Judges, and Magistrates"
                ],
                [
                    "id"=> 570,
                    "profession_name"=> "Judicial Law Clerks"
                ],
                [
                    "id"=> 571,
                    "profession_name"=> "Kindergarten Teachers, Except Special Education"
                ],
                [
                    "id"=> 572,
                    "profession_name"=> "Labor Relations Specialists"
                ],
                [
                    "id"=> 573,
                    "profession_name"=> "Laborers and Freight, Stock, and Material Movers, Hand"
                ],
                [
                    "id"=> 574,
                    "profession_name"=> "Landscape Architects"
                ],
                [
                    "id"=> 575,
                    "profession_name"=> "Landscaping and Groundskeeping Workers"
                ],
                [
                    "id"=> 576,
                    "profession_name"=> "Lathe and Turning Machine Tool Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 577,
                    "profession_name"=> "Laundry and Dry-Cleaning Workers"
                ],
                [
                    "id"=> 578,
                    "profession_name"=> "Law Teachers, Postsecondary"
                ],
                [
                    "id"=> 579,
                    "profession_name"=> "Lawyers"
                ],
                [
                    "id"=> 580,
                    "profession_name"=> "Layout Workers, Metal and Plastic"
                ],
                [
                    "id"=> 581,
                    "profession_name"=> "Legal Secretaries"
                ],
                [
                    "id"=> 582,
                    "profession_name"=> "Legal Support Workers, All Other"
                ],
                [
                    "id"=> 583,
                    "profession_name"=> "Legislators"
                ],
                [
                    "id"=> 584,
                    "profession_name"=> "Librarians"
                ],
                [
                    "id"=> 585,
                    "profession_name"=> "Library Assistants, Clerical"
                ],
                [
                    "id"=> 586,
                    "profession_name"=> "Library Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 587,
                    "profession_name"=> "Library Technicians"
                ],
                [
                    "id"=> 588,
                    "profession_name"=> "License Clerks"
                ],
                [
                    "id"=> 589,
                    "profession_name"=> "Licensed Practical and Licensed Vocational Nurses"
                ],
                [
                    "id"=> 590,
                    "profession_name"=> "Licensing Examiners and Inspectors"
                ],
                [
                    "id"=> 591,
                    "profession_name"=> "Life Scientists, All Other"
                ],
                [
                    "id"=> 592,
                    "profession_name"=> "Life, Physical, and Social Science Technicians, All Other"
                ],
                [
                    "id"=> 593,
                    "profession_name"=> "Lifeguards, Ski Patrol, and Other Recreational Protective Service Workers"
                ],
                [
                    "id"=> 594,
                    "profession_name"=> "Light Truck or Delivery Services Drivers"
                ],
                [
                    "id"=> 595,
                    "profession_name"=> "Loading Machine Operators, Underground Mining"
                ],
                [
                    "id"=> 596,
                    "profession_name"=> "Loan Counselors"
                ],
                [
                    "id"=> 597,
                    "profession_name"=> "Loan Interviewers and Clerks"
                ],
                [
                    "id"=> 598,
                    "profession_name"=> "Loan Officers"
                ],
                [
                    "id"=> 599,
                    "profession_name"=> "Locker Room, Coatroom, and Dressing Room Attendants"
                ],
                [
                    "id"=> 600,
                    "profession_name"=> "Locksmiths and Safe Repairers"
                ],
                [
                    "id"=> 601,
                    "profession_name"=> "Locomotive Engineers"
                ],
                [
                    "id"=> 602,
                    "profession_name"=> "Locomotive Firers"
                ],
                [
                    "id"=> 603,
                    "profession_name"=> "Lodging Managers"
                ],
                [
                    "id"=> 604,
                    "profession_name"=> "Log Graders and Scalers"
                ],
                [
                    "id"=> 605,
                    "profession_name"=> "Logging Equipment Operators"
                ],
                [
                    "id"=> 606,
                    "profession_name"=> "Logging Workers, All Other"
                ],
                [
                    "id"=> 607,
                    "profession_name"=> "Logisticians"
                ],
                [
                    "id"=> 608,
                    "profession_name"=> "Logistics Analysts"
                ],
                [
                    "id"=> 609,
                    "profession_name"=> "Logistics Engineers"
                ],
                [
                    "id"=> 610,
                    "profession_name"=> "Logistics Managers"
                ],
                [
                    "id"=> 611,
                    "profession_name"=> "Loss Prevention Managers"
                ],
                [
                    "id"=> 612,
                    "profession_name"=> "Low Vision Therapists, Orientation and Mobility Specialists, and Vision Rehabilitation Therapists"
                ],
                [
                    "id"=> 613,
                    "profession_name"=> "Machine Feeders and Offbearers"
                ],
                [
                    "id"=> 614,
                    "profession_name"=> "Machinists"
                ],
                [
                    "id"=> 615,
                    "profession_name"=> "Magnetic Resonance Imaging Technologists"
                ],
                [
                    "id"=> 616,
                    "profession_name"=> "Maids and Housekeeping Cleaners"
                ],
                [
                    "id"=> 617,
                    "profession_name"=> "Mail Clerks and Mail Machine Operators, Except Postal Service"
                ],
                [
                    "id"=> 618,
                    "profession_name"=> "Maintenance and Repair Workers, General"
                ],
                [
                    "id"=> 619,
                    "profession_name"=> "Maintenance Workers, Machinery"
                ],
                [
                    "id"=> 620,
                    "profession_name"=> "Makeup Artists, Theatrical and Performance"
                ],
                [
                    "id"=> 621,
                    "profession_name"=> "Management Analysts"
                ],
                [
                    "id"=> 622,
                    "profession_name"=> "Managers, All Other"
                ],
                [
                    "id"=> 623,
                    "profession_name"=> "Manicurists and Pedicurists"
                ],
                [
                    "id"=> 624,
                    "profession_name"=> "Manufactured Building and Mobile Home Installers"
                ],
                [
                    "id"=> 625,
                    "profession_name"=> "Manufacturing Engineering Technologists"
                ],
                [
                    "id"=> 626,
                    "profession_name"=> "Manufacturing Engineers"
                ],
                [
                    "id"=> 627,
                    "profession_name"=> "Manufacturing Production Technicians"
                ],
                [
                    "id"=> 628,
                    "profession_name"=> "Mapping Technicians"
                ],
                [
                    "id"=> 629,
                    "profession_name"=> "Marine Architects"
                ],
                [
                    "id"=> 630,
                    "profession_name"=> "Marine Engineers"
                ],
                [
                    "id"=> 631,
                    "profession_name"=> "Marine Engineers and Naval Architects"
                ],
                [
                    "id"=> 632,
                    "profession_name"=> "Market Research Analysts and Marketing Specialists"
                ],
                [
                    "id"=> 633,
                    "profession_name"=> "Marketing Managers"
                ],
                [
                    "id"=> 634,
                    "profession_name"=> "Marking Clerks"
                ],
                [
                    "id"=> 635,
                    "profession_name"=> "Marriage and Family Therapists"
                ],
                [
                    "id"=> 636,
                    "profession_name"=> "Massage Therapists"
                ],
                [
                    "id"=> 637,
                    "profession_name"=> "Material Moving Workers, All Other"
                ],
                [
                    "id"=> 638,
                    "profession_name"=> "Materials Engineers"
                ],
                [
                    "id"=> 639,
                    "profession_name"=> "Materials Scientists"
                ],
                [
                    "id"=> 640,
                    "profession_name"=> "Mates- Ship, Boat, and Barge"
                ],
                [
                    "id"=> 641,
                    "profession_name"=> "Mathematical Science Occupations, All Other"
                ],
                [
                    "id"=> 642,
                    "profession_name"=> "Mathematical Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 643,
                    "profession_name"=> "Mathematical Technicians"
                ],
                [
                    "id"=> 644,
                    "profession_name"=> "Mathematicians"
                ],
                [
                    "id"=> 645,
                    "profession_name"=> "Meat, Poultry, and Fish Cutters and Trimmers"
                ],
                [
                    "id"=> 646,
                    "profession_name"=> "Mechanical Door Repairers"
                ],
                [
                    "id"=> 647,
                    "profession_name"=> "Mechanical Drafters"
                ],
                [
                    "id"=> 648,
                    "profession_name"=> "Mechanical Engineering Technicians"
                ],
                [
                    "id"=> 649,
                    "profession_name"=> "Mechanical Engineering Technologists"
                ],
                [
                    "id"=> 650,
                    "profession_name"=> "Mechanical Engineers"
                ],
                [
                    "id"=> 651,
                    "profession_name"=> "Mechatronics Engineers"
                ],
                [
                    "id"=> 652,
                    "profession_name"=> "Media and Communication Equipment Workers, All Other"
                ],
                [
                    "id"=> 653,
                    "profession_name"=> "Media and Communication Workers, All Other"
                ],
                [
                    "id"=> 654,
                    "profession_name"=> "Medical and Clinical Laboratory Technicians"
                ],
                [
                    "id"=> 655,
                    "profession_name"=> "Medical and Clinical Laboratory Technologists"
                ],
                [
                    "id"=> 656,
                    "profession_name"=> "Medical and Health Services Managers"
                ],
                [
                    "id"=> 657,
                    "profession_name"=> "Medical Appliance Technicians"
                ],
                [
                    "id"=> 658,
                    "profession_name"=> "Medical Assistants"
                ],
                [
                    "id"=> 659,
                    "profession_name"=> "Medical Equipment Preparers"
                ],
                [
                    "id"=> 660,
                    "profession_name"=> "Medical Equipment Repairers"
                ],
                [
                    "id"=> 661,
                    "profession_name"=> "Medical Records and Health Information Technicians"
                ],
                [
                    "id"=> 662,
                    "profession_name"=> "Medical Scientists, Except Epidemiologists"
                ],
                [
                    "id"=> 663,
                    "profession_name"=> "Medical Secretaries"
                ],
                [
                    "id"=> 664,
                    "profession_name"=> "Medical Transcriptionists"
                ],
                [
                    "id"=> 665,
                    "profession_name"=> "Meeting, Convention, and Event Planners"
                ],
                [
                    "id"=> 666,
                    "profession_name"=> "Mental Health and Substance Abuse Social Workers"
                ],
                [
                    "id"=> 667,
                    "profession_name"=> "Mental Health Counselors"
                ],
                [
                    "id"=> 668,
                    "profession_name"=> "Merchandise Displayers and Window Trimmers"
                ],
                [
                    "id"=> 669,
                    "profession_name"=> "Metal Workers and Plastic Workers, All Other"
                ],
                [
                    "id"=> 670,
                    "profession_name"=> "Metal-Refining Furnace Operators and Tenders"
                ],
                [
                    "id"=> 671,
                    "profession_name"=> "Meter Readers, Utilities"
                ],
                [
                    "id"=> 672,
                    "profession_name"=> "Methane/Landfill Gas Collection System Operators"
                ],
                [
                    "id"=> 673,
                    "profession_name"=> "Methane/Landfill Gas Generation System Technicians"
                ],
                [
                    "id"=> 674,
                    "profession_name"=> "Microbiologists"
                ],
                [
                    "id"=> 675,
                    "profession_name"=> "Microsystems Engineers"
                ],
                [
                    "id"=> 676,
                    "profession_name"=> "Middle School Teachers, Except Special and Career/Technical Education"
                ],
                [
                    "id"=> 677,
                    "profession_name"=> "Midwives"
                ],
                [
                    "id"=> 678,
                    "profession_name"=> "Military Enlisted Tactical Operations and Air/Weapons Specialists and Crew Members, All Other"
                ],
                [
                    "id"=> 679,
                    "profession_name"=> "Military Officer Special and Tactical Operations Leaders, All Other"
                ],
                [
                    "id"=> 680,
                    "profession_name"=> "Milling and Planing Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 681,
                    "profession_name"=> "Millwrights"
                ],
                [
                    "id"=> 682,
                    "profession_name"=> "Mine Cutting and Channeling Machine Operators"
                ],
                [
                    "id"=> 683,
                    "profession_name"=> "Mine Shuttle Car Operators"
                ],
                [
                    "id"=> 684,
                    "profession_name"=> "Mining and Geological Engineers, Including Mining Safety Engineers"
                ],
                [
                    "id"=> 685,
                    "profession_name"=> "Mining Machine Operators, All Other"
                ],
                [
                    "id"=> 686,
                    "profession_name"=> "Mixing and Blending Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 687,
                    "profession_name"=> "Mobile Heavy Equipment Mechanics, Except Engines"
                ],
                [
                    "id"=> 688,
                    "profession_name"=> "Model Makers, Metal and Plastic"
                ],
                [
                    "id"=> 689,
                    "profession_name"=> "Model Makers, Wood"
                ],
                [
                    "id"=> 690,
                    "profession_name"=> "Models"
                ],
                [
                    "id"=> 691,
                    "profession_name"=> "Molders, Shapers, and Casters, Except Metal and Plastic"
                ],
                [
                    "id"=> 692,
                    "profession_name"=> "Molding and Casting Workers"
                ],
                [
                    "id"=> 693,
                    "profession_name"=> "Molding, Coremaking, and Casting Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 694,
                    "profession_name"=> "Molecular and Cellular Biologists"
                ],
                [
                    "id"=> 695,
                    "profession_name"=> "Morticians, Undertakers, and Funeral Directors"
                ],
                [
                    "id"=> 696,
                    "profession_name"=> "Motion Picture Projectionists"
                ],
                [
                    "id"=> 697,
                    "profession_name"=> "Motor Vehicle Operators, All Other"
                ],
                [
                    "id"=> 698,
                    "profession_name"=> "Motorboat Mechanics and Service Technicians"
                ],
                [
                    "id"=> 699,
                    "profession_name"=> "Motorboat Operators"
                ],
                [
                    "id"=> 700,
                    "profession_name"=> "Motorcycle Mechanics"
                ],
                [
                    "id"=> 701,
                    "profession_name"=> "Multimedia Artists and Animators"
                ],
                [
                    "id"=> 702,
                    "profession_name"=> "Multiple Machine Tool Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 703,
                    "profession_name"=> "Municipal Clerks"
                ],
                [
                    "id"=> 704,
                    "profession_name"=> "Municipal Fire Fighting and Prevention Supervisors"
                ],
                [
                    "id"=> 705,
                    "profession_name"=> "Municipal Firefighters"
                ],
                [
                    "id"=> 706,
                    "profession_name"=> "Museum Technicians and Conservators"
                ],
                [
                    "id"=> 707,
                    "profession_name"=> "Music Composers and Arrangers"
                ],
                [
                    "id"=> 708,
                    "profession_name"=> "Music Directors"
                ],
                [
                    "id"=> 709,
                    "profession_name"=> "Music Directors and Composers"
                ],
                [
                    "id"=> 710,
                    "profession_name"=> "Music Therapists"
                ],
                [
                    "id"=> 711,
                    "profession_name"=> "Musical Instrument Repairers and Tuners"
                ],
                [
                    "id"=> 712,
                    "profession_name"=> "Musicians and Singers"
                ],
                [
                    "id"=> 713,
                    "profession_name"=> "Musicians, Instrumental"
                ],
                [
                    "id"=> 714,
                    "profession_name"=> "Nannies"
                ],
                [
                    "id"=> 715,
                    "profession_name"=> "Nanosystems Engineers"
                ],
                [
                    "id"=> 716,
                    "profession_name"=> "Nanotechnology Engineering Technicians"
                ],
                [
                    "id"=> 717,
                    "profession_name"=> "Nanotechnology Engineering Technologists"
                ],
                [
                    "id"=> 718,
                    "profession_name"=> "Natural Sciences Managers"
                ],
                [
                    "id"=> 719,
                    "profession_name"=> "Naturopathic Physicians"
                ],
                [
                    "id"=> 720,
                    "profession_name"=> "Network and Computer Systems Administrators"
                ],
                [
                    "id"=> 721,
                    "profession_name"=> "Neurodiagnostic Technologists"
                ],
                [
                    "id"=> 722,
                    "profession_name"=> "Neurologists"
                ],
                [
                    "id"=> 723,
                    "profession_name"=> "Neuropsychologists and Clinical Neuropsychologists"
                ],
                [
                    "id"=> 724,
                    "profession_name"=> "New Accounts Clerks"
                ],
                [
                    "id"=> 725,
                    "profession_name"=> "Non-Destructive Testing Specialists"
                ],
                [
                    "id"=> 726,
                    "profession_name"=> "Nonfarm Animal Caretakers"
                ],
                [
                    "id"=> 727,
                    "profession_name"=> "Nuclear Engineers"
                ],
                [
                    "id"=> 728,
                    "profession_name"=> "Nuclear Equipment Operation Technicians"
                ],
                [
                    "id"=> 729,
                    "profession_name"=> "Nuclear Medicine Physicians"
                ],
                [
                    "id"=> 730,
                    "profession_name"=> "Nuclear Medicine Technologists"
                ],
                [
                    "id"=> 731,
                    "profession_name"=> "Nuclear Monitoring Technicians"
                ],
                [
                    "id"=> 732,
                    "profession_name"=> "Nuclear Power Reactor Operators"
                ],
                [
                    "id"=> 733,
                    "profession_name"=> "Nuclear Technicians"
                ],
                [
                    "id"=> 734,
                    "profession_name"=> "Nurse Anesthetists"
                ],
                [
                    "id"=> 735,
                    "profession_name"=> "Nurse Midwives"
                ],
                [
                    "id"=> 736,
                    "profession_name"=> "Nurse Practitioners"
                ],
                [
                    "id"=> 737,
                    "profession_name"=> "Nursery and Greenhouse Managers"
                ],
                [
                    "id"=> 738,
                    "profession_name"=> "Nursery Workers"
                ],
                [
                    "id"=> 739,
                    "profession_name"=> "Nursing Assistants"
                ],
                [
                    "id"=> 740,
                    "profession_name"=> "Nursing Instructors and Teachers, Postsecondary"
                ],
                [
                    "id"=> 741,
                    "profession_name"=> "Obstetricians and Gynecologists"
                ],
                [
                    "id"=> 742,
                    "profession_name"=> "Occupational Health and Safety Specialists"
                ],
                [
                    "id"=> 743,
                    "profession_name"=> "Occupational Health and Safety Technicians"
                ],
                [
                    "id"=> 744,
                    "profession_name"=> "Occupational Therapists"
                ],
                [
                    "id"=> 745,
                    "profession_name"=> "Occupational Therapy Aides"
                ],
                [
                    "id"=> 746,
                    "profession_name"=> "Occupational Therapy Assistants"
                ],
                [
                    "id"=> 747,
                    "profession_name"=> "Office and Administrative Support Workers, All Other"
                ],
                [
                    "id"=> 748,
                    "profession_name"=> "Office Clerks, General"
                ],
                [
                    "id"=> 749,
                    "profession_name"=> "Office Machine Operators, Except Computer"
                ],
                [
                    "id"=> 750,
                    "profession_name"=> "Online Merchants"
                ],
                [
                    "id"=> 751,
                    "profession_name"=> "Operating Engineers and Other Construction Equipment Operators"
                ],
                [
                    "id"=> 752,
                    "profession_name"=> "Operations Research Analysts"
                ],
                [
                    "id"=> 753,
                    "profession_name"=> "Ophthalmic Laboratory Technicians"
                ],
                [
                    "id"=> 754,
                    "profession_name"=> "Ophthalmic Medical Technicians"
                ],
                [
                    "id"=> 755,
                    "profession_name"=> "Ophthalmic Medical Technologists"
                ],
                [
                    "id"=> 756,
                    "profession_name"=> "Ophthalmologists"
                ],
                [
                    "id"=> 757,
                    "profession_name"=> "Opticians, Dispensing"
                ],
                [
                    "id"=> 758,
                    "profession_name"=> "Optometrists"
                ],
                [
                    "id"=> 759,
                    "profession_name"=> "Oral and Maxillofacial Surgeons"
                ],
                [
                    "id"=> 760,
                    "profession_name"=> "Order Clerks"
                ],
                [
                    "id"=> 761,
                    "profession_name"=> "Order Fillers, Wholesale and Retail Sales"
                ],
                [
                    "id"=> 762,
                    "profession_name"=> "Orderlies"
                ],
                [
                    "id"=> 763,
                    "profession_name"=> "Orthodontists"
                ],
                [
                    "id"=> 764,
                    "profession_name"=> "Orthoptists"
                ],
                [
                    "id"=> 765,
                    "profession_name"=> "Orthotists and Prosthetists"
                ],
                [
                    "id"=> 766,
                    "profession_name"=> "Outdoor Power Equipment and Other Small Engine Mechanics"
                ],
                [
                    "id"=> 767,
                    "profession_name"=> "Packaging and Filling Machine Operators and Tenders"
                ],
                [
                    "id"=> 768,
                    "profession_name"=> "Packers and Packagers, Hand"
                ],
                [
                    "id"=> 769,
                    "profession_name"=> "Painters, Construction and Maintenance"
                ],
                [
                    "id"=> 770,
                    "profession_name"=> "Painters, Transportation Equipment"
                ],
                [
                    "id"=> 771,
                    "profession_name"=> "Painting, Coating, and Decorating Workers"
                ],
                [
                    "id"=> 772,
                    "profession_name"=> "Paper Goods Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 773,
                    "profession_name"=> "Paperhangers"
                ],
                [
                    "id"=> 774,
                    "profession_name"=> "Paralegals and Legal Assistants"
                ],
                [
                    "id"=> 775,
                    "profession_name"=> "Park Naturalists"
                ],
                [
                    "id"=> 776,
                    "profession_name"=> "Parking Enforcement Workers"
                ],
                [
                    "id"=> 777,
                    "profession_name"=> "Parking Lot Attendants"
                ],
                [
                    "id"=> 778,
                    "profession_name"=> "Parts Salespersons"
                ],
                [
                    "id"=> 779,
                    "profession_name"=> "Pathologists"
                ],
                [
                    "id"=> 780,
                    "profession_name"=> "Patient Representatives"
                ],
                [
                    "id"=> 781,
                    "profession_name"=> "Patternmakers, Metal and Plastic"
                ],
                [
                    "id"=> 782,
                    "profession_name"=> "Patternmakers, Wood"
                ],
                [
                    "id"=> 783,
                    "profession_name"=> "Paving, Surfacing, and Tamping Equipment Operators"
                ],
                [
                    "id"=> 784,
                    "profession_name"=> "Payroll and Timekeeping Clerks"
                ],
                [
                    "id"=> 785,
                    "profession_name"=> "Pediatricians, General"
                ],
                [
                    "id"=> 786,
                    "profession_name"=> "Personal Care Aides"
                ],
                [
                    "id"=> 787,
                    "profession_name"=> "Personal Care and Service Workers, All Other"
                ],
                [
                    "id"=> 788,
                    "profession_name"=> "Personal Financial Advisors"
                ],
                [
                    "id"=> 789,
                    "profession_name"=> "Pest Control Workers"
                ],
                [
                    "id"=> 790,
                    "profession_name"=> "Pesticide Handlers, Sprayers, and Applicators, Vegetation"
                ],
                [
                    "id"=> 791,
                    "profession_name"=> "Petroleum Engineers"
                ],
                [
                    "id"=> 792,
                    "profession_name"=> "Petroleum Pump System Operators, Refinery Operators, and Gaugers"
                ],
                [
                    "id"=> 793,
                    "profession_name"=> "Pharmacists"
                ],
                [
                    "id"=> 794,
                    "profession_name"=> "Pharmacy Aides"
                ],
                [
                    "id"=> 795,
                    "profession_name"=> "Pharmacy Technicians"
                ],
                [
                    "id"=> 796,
                    "profession_name"=> "Philosophy and Religion Teachers, Postsecondary"
                ],
                [
                    "id"=> 797,
                    "profession_name"=> "Phlebotomists"
                ],
                [
                    "id"=> 798,
                    "profession_name"=> "Photographers"
                ],
                [
                    "id"=> 799,
                    "profession_name"=> "Photographic Process Workers and Processing Machine Operators"
                ],
                [
                    "id"=> 800,
                    "profession_name"=> "Photonics Engineers"
                ],
                [
                    "id"=> 801,
                    "profession_name"=> "Photonics Technicians"
                ],
                [
                    "id"=> 802,
                    "profession_name"=> "Physical Medicine and Rehabilitation Physicians"
                ],
                [
                    "id"=> 803,
                    "profession_name"=> "Physical Scientists, All Other"
                ],
                [
                    "id"=> 804,
                    "profession_name"=> "Physical Therapist Aides"
                ],
                [
                    "id"=> 805,
                    "profession_name"=> "Physical Therapist Assistants"
                ],
                [
                    "id"=> 806,
                    "profession_name"=> "Physical Therapists"
                ],
                [
                    "id"=> 807,
                    "profession_name"=> "Physician Assistants"
                ],
                [
                    "id"=> 808,
                    "profession_name"=> "Physicians and Surgeons, All Other"
                ],
                [
                    "id"=> 809,
                    "profession_name"=> "Physicists"
                ],
                [
                    "id"=> 810,
                    "profession_name"=> "Physics Teachers, Postsecondary"
                ],
                [
                    "id"=> 811,
                    "profession_name"=> "Pile-Driver Operators"
                ],
                [
                    "id"=> 812,
                    "profession_name"=> "Pilots, Ship"
                ],
                [
                    "id"=> 813,
                    "profession_name"=> "Pipe Fitters and Steamfitters"
                ],
                [
                    "id"=> 814,
                    "profession_name"=> "Pipelayers"
                ],
                [
                    "id"=> 815,
                    "profession_name"=> "Plant and System Operators, All Other"
                ],
                [
                    "id"=> 816,
                    "profession_name"=> "Plasterers and Stucco Masons"
                ],
                [
                    "id"=> 817,
                    "profession_name"=> "Plating and Coating Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 818,
                    "profession_name"=> "Plumbers"
                ],
                [
                    "id"=> 819,
                    "profession_name"=> "Plumbers, Pipefitters, and Steamfitters"
                ],
                [
                    "id"=> 820,
                    "profession_name"=> "Podiatrists"
                ],
                [
                    "id"=> 821,
                    "profession_name"=> "Poets, Lyricists and Creative Writers"
                ],
                [
                    "id"=> 822,
                    "profession_name"=> "Police and Sheriffs Patrol Officers"
                ],
                [
                    "id"=> 823,
                    "profession_name"=> "Police Detectives"
                ],
                [
                    "id"=> 824,
                    "profession_name"=> "Police Identification and Records Officers"
                ],
                [
                    "id"=> 825,
                    "profession_name"=> "Police Patrol Officers"
                ],
                [
                    "id"=> 826,
                    "profession_name"=> "Police, Fire, and Ambulance Dispatchers"
                ],
                [
                    "id"=> 827,
                    "profession_name"=> "Political Science Teachers, Postsecondary"
                ],
                [
                    "id"=> 828,
                    "profession_name"=> "Political Scientists"
                ],
                [
                    "id"=> 829,
                    "profession_name"=> "Postal Service Clerks"
                ],
                [
                    "id"=> 830,
                    "profession_name"=> "Postal Service Mail Carriers"
                ],
                [
                    "id"=> 831,
                    "profession_name"=> "Postal Service Mail Sorters, Processors, and Processing Machine Operators"
                ],
                [
                    "id"=> 832,
                    "profession_name"=> "Postmasters and Mail Superintendents"
                ],
                [
                    "id"=> 833,
                    "profession_name"=> "Postsecondary Teachers, All Other"
                ],
                [
                    "id"=> 834,
                    "profession_name"=> "Potters, Manufacturing"
                ],
                [
                    "id"=> 835,
                    "profession_name"=> "Pourers and Casters, Metal"
                ],
                [
                    "id"=> 836,
                    "profession_name"=> "Power Distributors and Dispatchers"
                ],
                [
                    "id"=> 837,
                    "profession_name"=> "Power Plant Operators"
                ],
                [
                    "id"=> 838,
                    "profession_name"=> "Precious Metal Workers"
                ],
                [
                    "id"=> 839,
                    "profession_name"=> "Precision Agriculture Technicians"
                ],
                [
                    "id"=> 840,
                    "profession_name"=> "Precision Instrument and Equipment Repairers, All Other"
                ],
                [
                    "id"=> 841,
                    "profession_name"=> "Prepress Technicians and Workers"
                ],
                [
                    "id"=> 842,
                    "profession_name"=> "Preschool Teachers, Except Special Education"
                ],
                [
                    "id"=> 843,
                    "profession_name"=> "Pressers, Textile, Garment, and Related Materials"
                ],
                [
                    "id"=> 844,
                    "profession_name"=> "Preventive Medicine Physicians"
                ],
                [
                    "id"=> 845,
                    "profession_name"=> "Print Binding and Finishing Workers"
                ],
                [
                    "id"=> 846,
                    "profession_name"=> "Printing Press Operators"
                ],
                [
                    "id"=> 847,
                    "profession_name"=> "Private Detectives and Investigators"
                ],
                [
                    "id"=> 848,
                    "profession_name"=> "Probation Officers and Correctional Treatment Specialists"
                ],
                [
                    "id"=> 849,
                    "profession_name"=> "Procurement Clerks"
                ],
                [
                    "id"=> 850,
                    "profession_name"=> "Producers"
                ],
                [
                    "id"=> 851,
                    "profession_name"=> "Producers and Directors"
                ],
                [
                    "id"=> 852,
                    "profession_name"=> "Product Safety Engineers"
                ],
                [
                    "id"=> 853,
                    "profession_name"=> "Production Workers, All Other"
                ],
                [
                    "id"=> 854,
                    "profession_name"=> "Production, Planning, and Expediting Clerks"
                ],
                [
                    "id"=> 855,
                    "profession_name"=> "Program Directors"
                ],
                [
                    "id"=> 856,
                    "profession_name"=> "Proofreaders and Copy Markers"
                ],
                [
                    "id"=> 857,
                    "profession_name"=> "Property, Real Estate, and Community Association Managers"
                ],
                [
                    "id"=> 858,
                    "profession_name"=> "Prosthodontists"
                ],
                [
                    "id"=> 859,
                    "profession_name"=> "Protective Service Workers, All Other"
                ],
                [
                    "id"=> 860,
                    "profession_name"=> "Psychiatric Aides"
                ],
                [
                    "id"=> 861,
                    "profession_name"=> "Psychiatric Technicians"
                ],
                [
                    "id"=> 862,
                    "profession_name"=> "Psychiatrists"
                ],
                [
                    "id"=> 863,
                    "profession_name"=> "Psychologists, All Other"
                ],
                [
                    "id"=> 864,
                    "profession_name"=> "Psychology Teachers, Postsecondary"
                ],
                [
                    "id"=> 865,
                    "profession_name"=> "Public Address System and Other Announcers"
                ],
                [
                    "id"=> 866,
                    "profession_name"=> "Public Relations and Fundraising Managers"
                ],
                [
                    "id"=> 867,
                    "profession_name"=> "Public Relations Specialists"
                ],
                [
                    "id"=> 868,
                    "profession_name"=> "Pump Operators, Except Wellhead Pumpers"
                ],
                [
                    "id"=> 869,
                    "profession_name"=> "Purchasing Agents, Except Wholesale, Retail, and Farm Products"
                ],
                [
                    "id"=> 870,
                    "profession_name"=> "Purchasing Managers"
                ],
                [
                    "id"=> 871,
                    "profession_name"=> "Quality Control Analysts"
                ],
                [
                    "id"=> 872,
                    "profession_name"=> "Quality Control Systems Managers"
                ],
                [
                    "id"=> 873,
                    "profession_name"=> "Radar and Sonar Technicians"
                ],
                [
                    "id"=> 874,
                    "profession_name"=> "Radiation Therapists"
                ],
                [
                    "id"=> 875,
                    "profession_name"=> "Radio and Television Announcers"
                ],
                [
                    "id"=> 876,
                    "profession_name"=> "Radio Frequency Identification Device Specialists"
                ],
                [
                    "id"=> 877,
                    "profession_name"=> "Radio Mechanics"
                ],
                [
                    "id"=> 878,
                    "profession_name"=> "Radio Operators"
                ],
                [
                    "id"=> 879,
                    "profession_name"=> "Radio, Cellular, and Tower Equipment Installers and Repairers"
                ],
                [
                    "id"=> 880,
                    "profession_name"=> "Radiologic Technicians"
                ],
                [
                    "id"=> 881,
                    "profession_name"=> "Radiologic Technologists"
                ],
                [
                    "id"=> 882,
                    "profession_name"=> "Radiologists"
                ],
                [
                    "id"=> 883,
                    "profession_name"=> "Rail Car Repairers"
                ],
                [
                    "id"=> 884,
                    "profession_name"=> "Rail Transportation Workers, All Other"
                ],
                [
                    "id"=> 885,
                    "profession_name"=> "Rail Yard Engineers, Dinkey Operators, and Hostlers"
                ],
                [
                    "id"=> 886,
                    "profession_name"=> "Rail-Track Laying and Maintenance Equipment Operators"
                ],
                [
                    "id"=> 887,
                    "profession_name"=> "Railroad Brake, Signal, and Switch Operators"
                ],
                [
                    "id"=> 888,
                    "profession_name"=> "Railroad Conductors and Yardmasters"
                ],
                [
                    "id"=> 889,
                    "profession_name"=> "Range Managers"
                ],
                [
                    "id"=> 890,
                    "profession_name"=> "Real Estate Brokers"
                ],
                [
                    "id"=> 891,
                    "profession_name"=> "Real Estate Sales Agents"
                ],
                [
                    "id"=> 892,
                    "profession_name"=> "Receptionists and Information Clerks"
                ],
                [
                    "id"=> 893,
                    "profession_name"=> "Recreation and Fitness Studies Teachers, Postsecondary"
                ],
                [
                    "id"=> 894,
                    "profession_name"=> "Recreation Workers"
                ],
                [
                    "id"=> 895,
                    "profession_name"=> "Recreational Therapists"
                ],
                [
                    "id"=> 896,
                    "profession_name"=> "Recreational Vehicle Service Technicians"
                ],
                [
                    "id"=> 897,
                    "profession_name"=> "Recycling and Reclamation Workers"
                ],
                [
                    "id"=> 898,
                    "profession_name"=> "Recycling Coordinators"
                ],
                [
                    "id"=> 899,
                    "profession_name"=> "Refractory Materials Repairers, Except Brickmasons"
                ],
                [
                    "id"=> 900,
                    "profession_name"=> "Refrigeration Mechanics and Installers"
                ],
                [
                    "id"=> 901,
                    "profession_name"=> "Refuse and Recyclable Material Collectors"
                ],
                [
                    "id"=> 902,
                    "profession_name"=> "Registered Nurses"
                ],
                [
                    "id"=> 903,
                    "profession_name"=> "Regulatory Affairs Managers"
                ],
                [
                    "id"=> 904,
                    "profession_name"=> "Regulatory Affairs Specialists"
                ],
                [
                    "id"=> 905,
                    "profession_name"=> "Rehabilitation Counselors"
                ],
                [
                    "id"=> 906,
                    "profession_name"=> "Reinforcing Iron and Rebar Workers"
                ],
                [
                    "id"=> 907,
                    "profession_name"=> "Religious Workers, All Other"
                ],
                [
                    "id"=> 908,
                    "profession_name"=> "Remote Sensing Scientists and Technologists"
                ],
                [
                    "id"=> 909,
                    "profession_name"=> "Remote Sensing Technicians"
                ],
                [
                    "id"=> 910,
                    "profession_name"=> "Reporters and Correspondents"
                ],
                [
                    "id"=> 911,
                    "profession_name"=> "Reservation and Transportation Ticket Agents and Travel Clerks"
                ],
                [
                    "id"=> 912,
                    "profession_name"=> "Residential Advisors"
                ],
                [
                    "id"=> 913,
                    "profession_name"=> "Respiratory Therapists"
                ],
                [
                    "id"=> 914,
                    "profession_name"=> "Respiratory Therapy Technicians"
                ],
                [
                    "id"=> 915,
                    "profession_name"=> "Retail Loss Prevention Specialists"
                ],
                [
                    "id"=> 916,
                    "profession_name"=> "Retail Salespersons"
                ],
                [
                    "id"=> 917,
                    "profession_name"=> "Riggers"
                ],
                [
                    "id"=> 918,
                    "profession_name"=> "Risk Management Specialists"
                ],
                [
                    "id"=> 919,
                    "profession_name"=> "Robotics Engineers"
                ],
                [
                    "id"=> 920,
                    "profession_name"=> "Robotics Technicians"
                ],
                [
                    "id"=> 921,
                    "profession_name"=> "Rock Splitters, Quarry"
                ],
                [
                    "id"=> 922,
                    "profession_name"=> "Rolling Machine Setters, Operators, and Tenders, Metal and Plastic"
                ],
                [
                    "id"=> 923,
                    "profession_name"=> "Roof Bolters, Mining"
                ],
                [
                    "id"=> 924,
                    "profession_name"=> "Roofers"
                ],
                [
                    "id"=> 925,
                    "profession_name"=> "Rotary Drill Operators, Oil and Gas"
                ],
                [
                    "id"=> 926,
                    "profession_name"=> "Rough Carpenters"
                ],
                [
                    "id"=> 927,
                    "profession_name"=> "Roustabouts, Oil and Gas"
                ],
                [
                    "id"=> 928,
                    "profession_name"=> "Sailors and Marine Oilers"
                ],
                [
                    "id"=> 929,
                    "profession_name"=> "Sales Agents, Financial Services"
                ],
                [
                    "id"=> 930,
                    "profession_name"=> "Sales Agents, Securities and Commodities"
                ],
                [
                    "id"=> 931,
                    "profession_name"=> "Sales and Related Workers, All Other"
                ],
                [
                    "id"=> 932,
                    "profession_name"=> "Sales Engineers"
                ],
                [
                    "id"=> 933,
                    "profession_name"=> "Sales Managers"
                ],
                [
                    "id"=> 934,
                    "profession_name"=> "Sales Representatives, Services, All Other"
                ],
                [
                    "id"=> 935,
                    "profession_name"=> "Sales Representatives, Wholesale and Manufacturing, Except Technical and Scientific Products"
                ],
                [
                    "id"=> 936,
                    "profession_name"=> "Sales Representatives, Wholesale and Manufacturing, Technical and Scientific Products"
                ],
                [
                    "id"=> 937,
                    "profession_name"=> "Sawing Machine Setters, Operators, and Tenders, Wood"
                ],
                [
                    "id"=> 938,
                    "profession_name"=> "School Psychologists"
                ],
                [
                    "id"=> 939,
                    "profession_name"=> "Search Marketing Strategists"
                ],
                [
                    "id"=> 940,
                    "profession_name"=> "Secondary School Teachers, Except Special and Career/Technical Education"
                ],
                [
                    "id"=> 941,
                    "profession_name"=> "Secretaries and Administrative Assistants, Except Legal, Medical, and Executive"
                ],
                [
                    "id"=> 942,
                    "profession_name"=> "Securities and Commodities Traders"
                ],
                [
                    "id"=> 943,
                    "profession_name"=> "Securities, Commodities, and Financial Services Sales Agents"
                ],
                [
                    "id"=> 944,
                    "profession_name"=> "Security and Fire Alarm Systems Installers"
                ],
                [
                    "id"=> 945,
                    "profession_name"=> "Security Guards"
                ],
                [
                    "id"=> 946,
                    "profession_name"=> "Security Management Specialists"
                ],
                [
                    "id"=> 947,
                    "profession_name"=> "Security Managers"
                ],
                [
                    "id"=> 948,
                    "profession_name"=> "Segmental Pavers"
                ],
                [
                    "id"=> 949,
                    "profession_name"=> "Self-Enrichment Education Teachers"
                ],
                [
                    "id"=> 950,
                    "profession_name"=> "Semiconductor Processors"
                ],
                [
                    "id"=> 951,
                    "profession_name"=> "Separating, Filtering, Clarifying, Precipitating, and Still Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 952,
                    "profession_name"=> "Septic Tank Servicers and Sewer Pipe Cleaners"
                ],
                [
                    "id"=> 953,
                    "profession_name"=> "Service Unit Operators, Oil, Gas, and Mining"
                ],
                [
                    "id"=> 954,
                    "profession_name"=> "Set and Exhibit Designers"
                ],
                [
                    "id"=> 955,
                    "profession_name"=> "Sewers, Hand"
                ],
                [
                    "id"=> 956,
                    "profession_name"=> "Sewing Machine Operators"
                ],
                [
                    "id"=> 957,
                    "profession_name"=> "Shampooers"
                ],
                [
                    "id"=> 958,
                    "profession_name"=> "Sheet Metal Workers"
                ],
                [
                    "id"=> 959,
                    "profession_name"=> "Sheriffs and Deputy Sheriffs"
                ],
                [
                    "id"=> 960,
                    "profession_name"=> "Ship and Boat Captains"
                ],
                [
                    "id"=> 961,
                    "profession_name"=> "Ship Engineers"
                ],
                [
                    "id"=> 962,
                    "profession_name"=> "Shipping, Receiving, and Traffic Clerks"
                ],
                [
                    "id"=> 963,
                    "profession_name"=> "Shoe and Leather Workers and Repairers"
                ],
                [
                    "id"=> 964,
                    "profession_name"=> "Shoe Machine Operators and Tenders"
                ],
                [
                    "id"=> 965,
                    "profession_name"=> "Signal and Track Switch Repairers"
                ],
                [
                    "id"=> 966,
                    "profession_name"=> "Singers"
                ],
                [
                    "id"=> 967,
                    "profession_name"=> "Skincare Specialists"
                ],
                [
                    "id"=> 968,
                    "profession_name"=> "Slaughterers and Meat Packers"
                ],
                [
                    "id"=> 969,
                    "profession_name"=> "Slot Supervisors"
                ],
                [
                    "id"=> 970,
                    "profession_name"=> "Social and Community Service Managers"
                ],
                [
                    "id"=> 971,
                    "profession_name"=> "Social and Human Service Assistants"
                ],
                [
                    "id"=> 972,
                    "profession_name"=> "Social Science Research Assistants"
                ],
                [
                    "id"=> 973,
                    "profession_name"=> "Social Sciences Teachers, Postsecondary, All Other"
                ],
                [
                    "id"=> 974,
                    "profession_name"=> "Social Scientists and Related Workers, All Other"
                ],
                [
                    "id"=> 975,
                    "profession_name"=> "Social Work Teachers, Postsecondary"
                ],
                [
                    "id"=> 976,
                    "profession_name"=> "Social Workers, All Other"
                ],
                [
                    "id"=> 977,
                    "profession_name"=> "Sociologists"
                ],
                [
                    "id"=> 978,
                    "profession_name"=> "Sociology Teachers, Postsecondary"
                ],
                [
                    "id"=> 979,
                    "profession_name"=> "Software Developers, Applications"
                ],
                [
                    "id"=> 980,
                    "profession_name"=> "Software Developers, Systems Software"
                ],
                [
                    "id"=> 981,
                    "profession_name"=> "Software Quality Assurance Engineers and Testers"
                ],
                [
                    "id"=> 982,
                    "profession_name"=> "Soil and Plant Scientists"
                ],
                [
                    "id"=> 983,
                    "profession_name"=> "Soil and Water Conservationists"
                ],
                [
                    "id"=> 984,
                    "profession_name"=> "Solar Energy Installation Managers"
                ],
                [
                    "id"=> 985,
                    "profession_name"=> "Solar Energy Systems Engineers"
                ],
                [
                    "id"=> 986,
                    "profession_name"=> "Solar Photovoltaic Installers"
                ],
                [
                    "id"=> 987,
                    "profession_name"=> "Solar Sales Representatives and Assessors"
                ],
                [
                    "id"=> 988,
                    "profession_name"=> "Solar Thermal Installers and Technicians"
                ],
                [
                    "id"=> 989,
                    "profession_name"=> "Solderers and Brazers"
                ],
                [
                    "id"=> 990,
                    "profession_name"=> "Sound Engineering Technicians"
                ],
                [
                    "id"=> 991,
                    "profession_name"=> "Spa Managers"
                ],
                [
                    "id"=> 992,
                    "profession_name"=> "Special Education Teachers, All Other"
                ],
                [
                    "id"=> 993,
                    "profession_name"=> "Special Education Teachers, Kindergarten and Elementary School"
                ],
                [
                    "id"=> 994,
                    "profession_name"=> "Special Education Teachers, Middle School"
                ],
                [
                    "id"=> 995,
                    "profession_name"=> "Special Education Teachers, Preschool"
                ],
                [
                    "id"=> 996,
                    "profession_name"=> "Special Education Teachers, Secondary School"
                ],
                [
                    "id"=> 997,
                    "profession_name"=> "Special Forces"
                ],
                [
                    "id"=> 998,
                    "profession_name"=> "Special Forces Officers"
                ],
                [
                    "id"=> 999,
                    "profession_name"=> "Speech-Language Pathologists"
                ],
                [
                    "id"=> 1000,
                    "profession_name"=> "Speech-Language Pathology Assistants"
                ],
                [
                    "id"=> 1001,
                    "profession_name"=> "Sports Medicine Physicians"
                ],
                [
                    "id"=> 1002,
                    "profession_name"=> "Statement Clerks"
                ],
                [
                    "id"=> 1003,
                    "profession_name"=> "Stationary Engineers and Boiler Operators"
                ],
                [
                    "id"=> 1004,
                    "profession_name"=> "Statistical Assistants"
                ],
                [
                    "id"=> 1005,
                    "profession_name"=> "Statisticians"
                ],
                [
                    "id"=> 1006,
                    "profession_name"=> "Stock Clerks and Order Fillers"
                ],
                [
                    "id"=> 1007,
                    "profession_name"=> "Stock Clerks, Sales Floor"
                ],
                [
                    "id"=> 1008,
                    "profession_name"=> "Stock Clerks- Stockroom, Warehouse, or Storage Yard"
                ],
                [
                    "id"=> 1009,
                    "profession_name"=> "Stone Cutters and Carvers, Manufacturing"
                ],
                [
                    "id"=> 1010,
                    "profession_name"=> "Stonemasons"
                ],
                [
                    "id"=> 1011,
                    "profession_name"=> "Storage and Distribution Managers"
                ],
                [
                    "id"=> 1012,
                    "profession_name"=> "Structural Iron and Steel Workers"
                ],
                [
                    "id"=> 1013,
                    "profession_name"=> "Structural Metal Fabricators and Fitters"
                ],
                [
                    "id"=> 1014,
                    "profession_name"=> "Substance Abuse and Behavioral Disorder Counselors"
                ],
                [
                    "id"=> 1015,
                    "profession_name"=> "Subway and Streetcar Operators"
                ],
                [
                    "id"=> 1016,
                    "profession_name"=> "Supply Chain Managers"
                ],
                [
                    "id"=> 1017,
                    "profession_name"=> "Surgeons"
                ],
                [
                    "id"=> 1018,
                    "profession_name"=> "Surgical Assistants"
                ],
                [
                    "id"=> 1019,
                    "profession_name"=> "Surgical Technologists"
                ],
                [
                    "id"=> 1020,
                    "profession_name"=> "Survey Researchers"
                ],
                [
                    "id"=> 1021,
                    "profession_name"=> "Surveying and Mapping Technicians"
                ],
                [
                    "id"=> 1022,
                    "profession_name"=> "Surveying Technicians"
                ],
                [
                    "id"=> 1023,
                    "profession_name"=> "Surveyors"
                ],
                [
                    "id"=> 1024,
                    "profession_name"=> "Sustainability Specialists"
                ],
                [
                    "id"=> 1025,
                    "profession_name"=> "Switchboard Operators, Including Answering Service"
                ],
                [
                    "id"=> 1026,
                    "profession_name"=> "Tailors, Dressmakers, and Custom Sewers"
                ],
                [
                    "id"=> 1027,
                    "profession_name"=> "Talent Directors"
                ],
                [
                    "id"=> 1028,
                    "profession_name"=> "Tank Car, Truck, and Ship Loaders"
                ],
                [
                    "id"=> 1029,
                    "profession_name"=> "Tapers"
                ],
                [
                    "id"=> 1030,
                    "profession_name"=> "Tax Examiners and Collectors, and Revenue Agents"
                ],
                [
                    "id"=> 1031,
                    "profession_name"=> "Tax Preparers"
                ],
                [
                    "id"=> 1032,
                    "profession_name"=> "Taxi Drivers and Chauffeurs"
                ],
                [
                    "id"=> 1033,
                    "profession_name"=> "Teacher Assistants"
                ],
                [
                    "id"=> 1034,
                    "profession_name"=> "Teachers and Instructors, All Other"
                ],
                [
                    "id"=> 1035,
                    "profession_name"=> "Team Assemblers"
                ],
                [
                    "id"=> 1036,
                    "profession_name"=> "Technical Directors/Managers"
                ],
                [
                    "id"=> 1037,
                    "profession_name"=> "Technical Writers"
                ],
                [
                    "id"=> 1038,
                    "profession_name"=> "Telecommunications Engineering Specialists"
                ],
                [
                    "id"=> 1039,
                    "profession_name"=> "Telecommunications Equipment Installers and Repairers, Except Line Installers"
                ],
                [
                    "id"=> 1040,
                    "profession_name"=> "Telecommunications Line Installers and Repairers"
                ],
                [
                    "id"=> 1041,
                    "profession_name"=> "Telemarketers"
                ],
                [
                    "id"=> 1042,
                    "profession_name"=> "Telephone Operators"
                ],
                [
                    "id"=> 1043,
                    "profession_name"=> "Tellers"
                ],
                [
                    "id"=> 1044,
                    "profession_name"=> "Terrazzo Workers and Finishers"
                ],
                [
                    "id"=> 1045,
                    "profession_name"=> "Textile Bleaching and Dyeing Machine Operators and Tenders"
                ],
                [
                    "id"=> 1046,
                    "profession_name"=> "Textile Cutting Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 1047,
                    "profession_name"=> "Textile Knitting and Weaving Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 1048,
                    "profession_name"=> "Textile Winding, Twisting, and Drawing Out Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 1049,
                    "profession_name"=> "Textile, Apparel, and Furnishings Workers, All Other"
                ],
                [
                    "id"=> 1050,
                    "profession_name"=> "Therapists, All Other"
                ],
                [
                    "id"=> 1051,
                    "profession_name"=> "Tile and Marble Setters"
                ],
                [
                    "id"=> 1052,
                    "profession_name"=> "Timing Device Assemblers and Adjusters"
                ],
                [
                    "id"=> 1053,
                    "profession_name"=> "Tire Builders"
                ],
                [
                    "id"=> 1054,
                    "profession_name"=> "Tire Repairers and Changers"
                ],
                [
                    "id"=> 1055,
                    "profession_name"=> "Title Examiners, Abstractors, and Searchers"
                ],
                [
                    "id"=> 1056,
                    "profession_name"=> "Tool and Die Makers"
                ],
                [
                    "id"=> 1057,
                    "profession_name"=> "Tool Grinders, Filers, and Sharpeners"
                ],
                [
                    "id"=> 1058,
                    "profession_name"=> "Tour Guides and Escorts"
                ],
                [
                    "id"=> 1059,
                    "profession_name"=> "Traffic Technicians"
                ],
                [
                    "id"=> 1060,
                    "profession_name"=> "Training and Development Managers"
                ],
                [
                    "id"=> 1061,
                    "profession_name"=> "Training and Development Specialists"
                ],
                [
                    "id"=> 1062,
                    "profession_name"=> "Transit and Railroad Police"
                ],
                [
                    "id"=> 1063,
                    "profession_name"=> "Transportation Attendants, Except Flight Attendants"
                ],
                [
                    "id"=> 1064,
                    "profession_name"=> "Transportation Engineers"
                ],
                [
                    "id"=> 1065,
                    "profession_name"=> "Transportation Inspectors"
                ],
                [
                    "id"=> 1066,
                    "profession_name"=> "Transportation Managers"
                ],
                [
                    "id"=> 1067,
                    "profession_name"=> "Transportation Planners"
                ],
                [
                    "id"=> 1068,
                    "profession_name"=> "Transportation Security Screeners"
                ],
                [
                    "id"=> 1069,
                    "profession_name"=> "Transportation Vehicle, Equipment and Systems Inspectors, Except Aviation"
                ],
                [
                    "id"=> 1070,
                    "profession_name"=> "Transportation Workers, All Other"
                ],
                [
                    "id"=> 1071,
                    "profession_name"=> "Transportation, Storage, and Distribution Managers"
                ],
                [
                    "id"=> 1072,
                    "profession_name"=> "Travel Agents"
                ],
                [
                    "id"=> 1073,
                    "profession_name"=> "Travel Guides"
                ],
                [
                    "id"=> 1074,
                    "profession_name"=> "Treasurers and Controllers"
                ],
                [
                    "id"=> 1075,
                    "profession_name"=> "Tree Trimmers and Pruners"
                ],
                [
                    "id"=> 1076,
                    "profession_name"=> "Tutors"
                ],
                [
                    "id"=> 1077,
                    "profession_name"=> "Umpires, Referees, and Other Sports Officials"
                ],
                [
                    "id"=> 1078,
                    "profession_name"=> "Upholsterers"
                ],
                [
                    "id"=> 1079,
                    "profession_name"=> "Urban and Regional Planners"
                ],
                [
                    "id"=> 1080,
                    "profession_name"=> "Urologists"
                ],
                [
                    "id"=> 1081,
                    "profession_name"=> "Ushers, Lobby Attendants, and Ticket Takers"
                ],
                [
                    "id"=> 1082,
                    "profession_name"=> "Validation Engineers"
                ],
                [
                    "id"=> 1083,
                    "profession_name"=> "Veterinarians"
                ],
                [
                    "id"=> 1084,
                    "profession_name"=> "Veterinary Assistants and Laboratory Animal Caretakers"
                ],
                [
                    "id"=> 1085,
                    "profession_name"=> "Veterinary Technologists and Technicians"
                ],
                [
                    "id"=> 1086,
                    "profession_name"=> "Video Game Designers"
                ],
                [
                    "id"=> 1087,
                    "profession_name"=> "Vocational Education Teachers, Postsecondary"
                ],
                [
                    "id"=> 1088,
                    "profession_name"=> "Waiters and Waitresses"
                ],
                [
                    "id"=> 1089,
                    "profession_name"=> "Watch Repairers"
                ],
                [
                    "id"=> 1090,
                    "profession_name"=> "Water and Wastewater Treatment Plant and System Operators"
                ],
                [
                    "id"=> 1091,
                    "profession_name"=> "Water Resource Specialists"
                ],
                [
                    "id"=> 1092,
                    "profession_name"=> "Water/Wastewater Engineers"
                ],
                [
                    "id"=> 1093,
                    "profession_name"=> "Weatherization Installers and Technicians"
                ],
                [
                    "id"=> 1094,
                    "profession_name"=> "Web Administrators"
                ],
                [
                    "id"=> 1095,
                    "profession_name"=> "Web Developers"
                ],
                [
                    "id"=> 1096,
                    "profession_name"=> "Weighers, Measurers, Checkers, and Samplers, Recordkeeping"
                ],
                [
                    "id"=> 1097,
                    "profession_name"=> "Welders, Cutters, and Welder Fitters"
                ],
                [
                    "id"=> 1098,
                    "profession_name"=> "Welders, Cutters, Solderers, and Brazers"
                ],
                [
                    "id"=> 1099,
                    "profession_name"=> "Welding, Soldering, and Brazing Machine Setters, Operators, and Tenders"
                ],
                [
                    "id"=> 1100,
                    "profession_name"=> "Wellhead Pumpers"
                ],
                [
                    "id"=> 1101,
                    "profession_name"=> "Wholesale and Retail Buyers, Except Farm Products"
                ],
                [
                    "id"=> 1102,
                    "profession_name"=> "Wind Energy Engineers"
                ],
                [
                    "id"=> 1103,
                    "profession_name"=> "Wind Energy Operations Managers"
                ],
                [
                    "id"=> 1104,
                    "profession_name"=> "Wind Energy Project Managers"
                ],
                [
                    "id"=> 1105,
                    "profession_name"=> "Wind Turbine Service Technicians"
                ],
                [
                    "id"=> 1106,
                    "profession_name"=> "Woodworkers, All Other"
                ],
                [
                    "id"=> 1107,
                    "profession_name"=> "Woodworking Machine Setters, Operators, and Tenders, Except Sawing"
                ],
                [
                    "id"=> 1108,
                    "profession_name"=> "Word Processors and Typists"
                ],
                [
                    "id"=> 1109,
                    "profession_name"=> "Writers and Authors"
                ],
                [
                    "id"=> 1110,
                    "profession_name"=> "Zoologists and Wildlife Biologists"
                ]
            


            
           
        ];

        DB::table('professions')->insert($tags);
    }
}
