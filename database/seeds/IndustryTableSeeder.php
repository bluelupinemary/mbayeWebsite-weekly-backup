<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class IndustryTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd('hhh');
        $tags = 
        [
            [
                "id"=> 1,
                "industry_name"=> "Accounting"
            ],
            [
                "id"=> 2,
                "industry_name"=> "Airlines/Aviation"
               
                
            ],
            [
                "id"=> 3,
                "industry_name"=> "Alternative Dispute Resolution"
               
                
            ],
            [
                "id"=> 4,
                "industry_name"=> "Alternative Medicine"
               
                
            ],
            [
                "id"=> 5,
                "industry_name"=> "Animation"
               
                
            ],
            [
                "id"=> 6,
                "industry_name"=> "Apparel/Fashion"
               
                
            ],
            [
                "id"=> 7,
                "industry_name"=> "Architecture/Planning"
               
                
            ],
            [
                "id"=> 8,
                "industry_name"=> "Arts/Crafts"
               
                
            ],
            [
                "id"=> 9,
                "industry_name"=> "Automotive"
               
                
            ],
            [
                "id"=> 10,
                "industry_name"=> "Aviation/Aerospace"
               
                
            ],
            [
                "id"=> 11,
                "industry_name"=> "Banking/Mortgage"
               
                
            ],
            [
                "id"=> 12,
                "industry_name"=> "Biotechnology/Greentech"
               
                
            ],
            [
                "id"=> 13,
                "industry_name"=> "Broadcast Media"
               
                
            ],
            [
                "id"=> 14,
                "industry_name"=> "Building Materials"
               
                
            ],
            [
                "id"=> 15,
                "industry_name"=> "Business Supplies/Equipment"
               
                
            ],
            [
                "id"=> 16,
                "industry_name"=> "Capital Markets/Hedge Fund/Private Equity"
               
                
            ],
            [
                "id"=> 17,
                "industry_name"=> "Chemicals"
               
                
            ],
            [
                "id"=> 18,
                "industry_name"=> "Civic/Social Organization"
               
                
            ],
            [
                "id"=> 19,
                "industry_name"=> "Civil Engineering"
               
                
            ],
            [
                "id"=> 20,
                "industry_name"=> "Commercial Real Estate"
               
                
            ],
            [
                "id"=> 21,
                "industry_name"=> "Computer Games"
               
                
            ],
            [
                "id"=> 22,
                "industry_name"=> "Computer Hardware"
               
                
            ],
            [
                "id"=> 23,
                "industry_name"=> "Computer Networking"
               
                
            ],
            [
                "id"=> 24,
                "industry_name"=> "Computer Software/Engineering"
               
                
            ],
            [
                "id"=> 25,
                "industry_name"=> "Computer/Network Security"
               
                
            ],
            [
                "id"=> 26,
                "industry_name"=> "Construction"
               
                
            ],
            [
                "id"=> 27,
                "industry_name"=> "Consumer Electronics"
               
                
            ],
            [
                "id"=> 28,
                "industry_name"=> "Consumer Goods"
               
                
            ],
            [
                "id"=> 29,
                "industry_name"=> "Consumer Services"
               
                
            ],
            [
                "id"=> 30,
                "industry_name"=> "Cosmetics"
               
                
            ],
            [
                "id"=> 31,
                "industry_name"=> "Dairy"
               
                
            ],
            [
                "id"=> 32,
                "industry_name"=> "Defense/Space"
               
                
            ],
            [
                "id"=> 33,
                "industry_name"=> "Design"
               
                
            ],
            [
                "id"=> 34,
                "industry_name"=> "E-Learning"
               
                
            ],
            [
                "id"=> 35,
                "industry_name"=> "Education Management"
               
                
            ],
            [
                "id"=> 36,
                "industry_name"=> "Electrical/Electronic Manufacturing"
               
                
            ],
            [
                "id"=> 37,
                "industry_name"=> "Entertainment/Movie Production"
               
                
            ],
            [
                "id"=> 38,
                "industry_name"=> "Environmental Services"
               
                
            ],
            [
                "id"=> 39,
                "industry_name"=> "Events Services"
               
                
            ],
            [
                "id"=> 40,
                "industry_name"=> "Executive Office"
               
                
            ],
            [
                "id"=> 41,
                "industry_name"=> "Facilities Services"
               
                
            ],
            [
                "id"=> 42,
                "industry_name"=> "Farming"
               
                
            ],
            [
                "id"=> 43,
                "industry_name"=> "Financial Services"
               
                
            ],
            [
                "id"=> 44,
                "industry_name"=> "Fine Art"
               
                
            ],
            [
                "id"=> 45,
                "industry_name"=> "Fishery"
               
                
            ],
            [
                "id"=> 46,
                "industry_name"=> "Food Production"
               
                
            ],
            [
                "id"=> 47,
                "industry_name"=> "Food/Beverages"
               
                
            ],
            [
                "id"=> 48,
                "industry_name"=> "Fundraising"
               
                
            ],
            [
                "id"=> 49,
                "industry_name"=> "Furniture"
               
                
            ],
            [
                "id"=> 50,
                "industry_name"=> "Gambling/Casinos"
               
                
            ],
            [
                "id"=> 51,
                "industry_name"=> "Glass/Ceramics/Concrete"
               
                
            ],
            [
                "id"=> 52,
                "industry_name"=> "Government Administration"
               
                
            ],
            [
                "id"=> 53,
                "industry_name"=> "Government Relations"
               
                
            ],
            [
                "id"=> 54,
                "industry_name"=> "Graphic Design/Web Design"
               
                
            ],
            [
                "id"=> 55,
                "industry_name"=> "Health/Fitness"
               
                
            ],
            [
                "id"=> 56,
                "industry_name"=> "Higher Education/Acadamia"
               
                
            ],
            [
                "id"=> 57,
                "industry_name"=> "Hospital/Health Care"
               
                
            ],
            [
                "id"=> 58,
                "industry_name"=> "Hospitality"
               
                
            ],
            [
                "id"=> 59,
                "industry_name"=> "Human Resources/HR"
               
                
            ],
            [
                "id"=> 60,
                "industry_name"=> "Import/Export"
               
                
            ],
            [
                "id"=> 61,
                "industry_name"=> "Individual/Family Services"
               
                
            ],
            [
                "id"=> 62,
                "industry_name"=> "Industrial Automation"
               
                
            ],
            [
                "id"=> 63,
                "industry_name"=> "Information Services"
               
                
            ],
            [
                "id"=> 64,
                "industry_name"=> "Information Technology/IT"
               
                
            ],
            [
                "id"=> 65,
                "industry_name"=> "Insurance"
               
                
            ],
            [
                "id"=> 66,
                "industry_name"=> "International Affairs"
               
                
            ],
            [
                "id"=> 67,
                "industry_name"=> "International Trade/Development"
               
                
            ],
            [
                "id"=> 68,
                "industry_name"=> "Internet"
               
                
            ],
            [
                "id"=> 69,
                "industry_name"=> "Investment Banking/Venture"
               
                
            ],
            [
                "id"=> 70,
                "industry_name"=> "Investment Management/Hedge Fund/Private Equity"
               
                
            ],
            [
                "id"=> 71,
                "industry_name"=> "Judiciary"
               
                
            ],
            [
                "id"=> 72,
                "industry_name"=> "Law Enforcement"
                
            ],
            [
                "id"=> 73,
                "industry_name"=> "Law Practice/Law Firms"
               
                
            ],
            [
                "id"=> 74,
                "industry_name"=> "Legal Services"
               
                
            ],
            [
                "id"=> 75,
                "industry_name"=> "Legislative Office"
               
                
            ],
            [
                "id"=> 76,
                "industry_name"=> "Leisure/Travel"
               
                
            ],
            [
                "id"=> 77,
                "industry_name"=> "Library"
               
                
            ],
            [
                "id"=> 78,
                "industry_name"=> "Logistics/Procurement"
               
                
            ],
            [
                "id"=> 79,
                "industry_name"=> "Luxury Goods/Jewelry"
               
                
            ],
            [
                "id"=> 80,
                "industry_name"=> "Machinery"
               
                
            ],
            [
                "id"=> 81,
                "industry_name"=> "Management Consulting"
               
                
            ],
            [
                "id"=> 82,
                "industry_name"=> "Maritime"
               
                
            ],
            [
                "id"=> 83,
                "industry_name"=> "Market Research"
               
                
            ],
            [
                "id"=> 84,
                "industry_name"=> "Marketing/Advertising/Sales"
               
                
            ],
            [
                "id"=> 85,
                "industry_name"=> "Mechanical or Industrial Engineering"
               
                
            ],
            [
                "id"=> 86,
                "industry_name"=> "Media Production"
               
                
            ],
            [
                "id"=> 87,
                "industry_name"=> "Medical Equipment"
               
                
            ],
            [
                "id"=> 88,
                "industry_name"=> "Medical Practice"
               
                
            ],
            [
                "id"=> 89,
                "industry_name"=> "Mental Health Care"
               
                
            ],
            [
                "id"=> 90,
                "industry_name"=> "Military Industry"
               
                
            ],
            [
                "id"=> 91,
                "industry_name"=> "Mining/Metals"
               
                
            ],
            [
                "id"=> 92,
                "industry_name"=> "Motion Pictures/Film"
               
                
            ],
            [
                "id"=> 93,
                "industry_name"=> "Museums/Institutions"
               
                
            ],
            [
                "id"=> 94,
                "industry_name"=> "Music"
               
                
            ],
            [
                "id"=> 95,
                "industry_name"=> "Nanotechnology"
               
                
            ],
            [
                "id"=> 96,
                "industry_name"=> "Newspapers/Journalism"
               
                
            ],
            [
                "id"=> 97,
                "industry_name"=> "Non-Profit/Volunteering"
               
                
            ],
            [
                "id"=> 98,
                "industry_name"=> "Oil/Energy/Solar/Greentech"
               
                
            ],
            [
                "id"=> 99,
                "industry_name"=> "Online Publishing"
               
                
            ],
            [
                "id"=> 100,
                "industry_name"=> "Other Industry"
               
                
            ],
            [
                "id"=> 101,
                "industry_name"=> "Outsourcing/Offshoring"
               
                
            ],
            [
                "id"=> 102,
                "industry_name"=> "Package/Freight Delivery"
               
                
            ],
            [
                "id"=> 103,
                "industry_name"=> "Packaging/Containers"
               
                
            ],
            [
                "id"=> 104,
                "industry_name"=> "Paper/Forest Products"
               
                
            ],
            [
                "id"=> 105,
                "industry_name"=> "Performing Arts"
               
                
            ],
            [
                "id"=> 106,
                "industry_name"=> "Pharmaceuticals"
               
                
            ],
            [
                "id"=> 107,
                "industry_name"=> "Philanthropy"
               
                
            ],
            [
                "id"=> 108,
                "industry_name"=> "Photography"
               
                
            ],
            [
                "id"=> 109,
                "industry_name"=> "Plastics"
               
                
            ],
            [
                "id"=> 110,
                "industry_name"=> "Political Organization"
               
                
            ],
            [
                "id"=> 111,
                "industry_name"=> "Primary/Secondary Education"
               
                
            ],
            [
                "id"=> 112,
                "industry_name"=> "Printing"
               
                
            ],
            [
                "id"=> 113,
                "industry_name"=> "Professional Training"
               
                
            ],
            [
                "id"=> 114,
                "industry_name"=> "Program Development"
               
                
            ],
            [
                "id"=> 115,
                "industry_name"=> "Public Relations/PR"
                
            ],
            [
                "id"=> 116,
                "industry_name"=> "Public Safety"
               
                
            ],
            [
                "id"=> 117,
                "industry_name"=> "Publishing Industry"
               
                
            ],
            [
                "id"=> 118,
                "industry_name"=> "Railroad Manufacture"
               
                
            ],
            [
                "id"=> 119,
                "industry_name"=> "Ranching"
               
                
            ],
            [
                "id"=> 120,
                "industry_name"=> "Real Estate/Mortgage"
               
                
            ],
            [
                "id"=> 121,
                "industry_name"=> "Recreational Facilities/Services"
               
                
            ],
            [
                "id"=> 122,
                "industry_name"=> "Religious Institutions"
               
                
            ],
            [
                "id"=> 123,
                "industry_name"=> "Renewables/Environment"
               
                
            ],
            [
                "id"=> 124,
                "industry_name"=> "Research Industry"
               
                
            ],
            [
                "id"=> 125,
                "industry_name"=> "Restaurants"
               
                
            ],
            [
                "id"=> 126,
                "industry_name"=> "Retail Industry"
               
                
            ],
            [
                "id"=> 127,
                "industry_name"=> "Security/Investigations"
               
                
            ],
            [
                "id"=> 128,
                "industry_name"=> "Semiconductors"
               
                
            ],
            [
                "id"=> 129,
                "industry_name"=> "Shipbuilding"
               
                
            ],
            [
                "id"=> 130,
                "industry_name"=> "Sporting Goods"
               
                
            ],
            [
                "id"=> 131,
                "industry_name"=> "Sports"
               
                
            ],
            [
                "id"=> 132,
                "industry_name"=> "Staffing/Recruiting"
               
                
            ],
            [
                "id"=> 133,
                "industry_name"=> "Supermarkets"
               
                
            ],
            [
                "id"=> 134,
                "industry_name"=> "Telecommunications"
               
                
            ],
            [
                "id"=> 135,
                "industry_name"=> "Textiles"
               
                
            ],
            [
                "id"=> 136,
                "industry_name"=> "Think Tanks"
               
                
            ],
            [
                "id"=> 137,
                "industry_name"=> "Tobacco"
               
                
            ],
            [
                "id"=> 138,
                "industry_name"=> "Translation/Localization"
               
                
            ],
            [
                "id"=> 139,
                "industry_name"=> "Transportation"
               
                
            ],
            [
                "id"=> 140,
                "industry_name"=> "Utilities"
               
                
            ],
            [
                "id"=> 141,
                "industry_name"=> "Venture Capital/VC"
               
                
            ],
            [
                "id"=> 142,
                "industry_name"=> "Veterinary"
               
                
            ],
            [
                "id"=> 143,
                "industry_name"=> "Warehousing"
               
                
            ],
            [
                "id"=> 144,
                "industry_name"=> "Wholesale"
               
                
            ],
            [
                "id"=> 145,
                "industry_name"=> "Wine/Spirits"
               
                
            ],
            [
                "id"=> 146,
                "industry_name"=> "Wireless"
               
                
            ],
            [
                "id"=> 147,
                "industry_name"=> "Writing/Editing"
               
                
            ]
        ];
            


            
           
        

        DB::table('industries')->insert($tags);
    }
}
