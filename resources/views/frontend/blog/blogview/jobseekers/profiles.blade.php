<meta name="url" content="{{ url('') }}">
@extends('frontend.layouts.app')
<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/profile.css') }}">
@section('after-styles')
@endsection

@section('content')
<div class="app">
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{ asset('front') }}/images/rotate-screen.gif" alt="">
        </div>
    </div>
    <!-- For nouvela animation -->
    <section class="container-fluid">
        <div class="div_container " style=""> 
            <div id="overlay"></div>
        <img  class="img-nouvela"  style="display:none" src="{{ asset('front') }}/images/naff555Votes.png" >
        <div>
    </section>
    

    <career-profile :user_country="'{{$country}}'"></career-profile>

    {{-- <div class="astro-div navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
        @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
            <img src="{{ asset('front/images/astronut/Thomasina_blog.png') }}"  class="img_astro"  alt="">
            <div class="tos-div thomasina">
                <button class="tos-btn tooltips right">
                    <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                    <span class="tooltiptext">Terms of Services</span>
                </button>
            </div>
        @else
            <img src="{{ asset('front/images/astronut/Tom_blog.png') }}" alt=""class="img_astro" alt="">
            <div class="tos-div">
                <button class="tos-btn tooltips right">
                    <img  class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt="">
                    <span class="tooltiptext">Terms of Services</span>
                </button>
            </div>
        @endif
        <div class="user-photo {{access()->user()->getGender()}}">
            <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
        </div>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt="">
                    <span class="tooltiptext">Music on/off</span></button>
                <button class="home-btn tooltips left"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt="">
                    <span class="tooltiptext">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="tooltips right ">
                <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
                <button class="profile-btn tooltips right">
                    <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt="">
                    <span class="tooltiptext">User Profile</span>
                </button>
            </div>
        </div>
        <button class="zoom-btn zoom-in "><i class="fas fa-search-plus"></i></button>
        <!-- <button class="navigator-zoom navigator-zoomin"></button>-->
        <div class="instructions-div btn_pointer tooltips right">
            <button class="instructions-btn tooltips right">
                <img class="btn_pointer" src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt="">
                <span class="tooltiptext">Instructions</span>
            </button>
        </div>
        <button class="communicator-div tooltips top btn_pointer @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom   @else  tomasina @endif" >
        
        </button>
        <div class="comm-btn  top btn_pointer">
            <span class="communicator-span    tooltips_span tooltiptext" >Communicator</span>
        </div>
        <button class="music-volume-div tooltips top btn_pointer">
            <span>Music Volume Up/Down</span>
        </button>
        <button class="navigator-zoomout-btn">
            <i class="fas fa-undo-alt"></i>
        </button>
    </div> --}}
    <!-- For  notes --->
    <!--cdefgab-->
  
    <div class="audio-div">
        <!--fart -->
        <audio id="fart" src="{{ asset('front') }}/audio/fart/fart.mp3" ></audio>
    </div>      
         <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
</div>   
@endsection

@section('after-scripts') 
    
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/hammer.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript">

    
    var url = $('meta[name="url"]').attr('content');
    var ClickCount=0;
    var arrCount = [
     {
        'id': '1', 'name': '1', 'thumb': '/storage/img/general_blogs/1591438745workshop.jpg', 'naffcount': '250' 
		
    },
    {
        'id': '16', 'name': '2', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '200' 
		
    },
    {
        'id': '2', 'name': '3', 'thumb': '/storage/img/general_blogs/1591438556a2.jpg', 'naffcount': '190' 
		
    },

    {
        'id': '4', 'name': '4', 'thumb': '/storage/img/general_blogs/1587381503a8.jpg', 'naffcount': '186' 
		
    },
  {
        'id': '5', 'name': '5', 'thumb': '/storage/img/general_blogs/1590997811a12.JPG', 'naffcount': '175' 
		
    },
    {
        'id': '6', 'name': '6', 'thumb': '/storage/img/general_blogs/1591438590a1.jpg', 'naffcount': '165' 
		
    },
     {
        'id': '7', 'name': '7', 'thumb': '/storage/img/general_blogs/1591438711a12.jpg', 'naffcount': '150' 
		
    },
    {
        'id': '8', 'name': '8', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '140' 
		
    },
    {
        'id': '9', 'name': '9', 'thumb': '/storage/img/general_blogs/1591017337a27.jpg', 'naffcount': '115' 
		
    },
    {
        'id': '10', 'name': '10', 'thumb': '/storage/img/general_blogs/1591017196a24.jpg', 'naffcount': '112' 
		
    },
    {
        'id': '11', 'name': '11', 'thumb': '/storage/img/general_blogs/1591001910a9.jpg', 'naffcount': '111' 
		
    },
    {
        'id': '12', 'name': '12', 'thumb': '/storage/img/general_blogs/1590996475a15.jpg', 'naffcount': '107' 
		
    },
    {
        'id': '13', 'name': '13', 'thumb': '/storage/img/general_blogs/1590992683a20.jpg', 'naffcount': '105' 
		
    },
    {
        'id': '14', 'name': '14', 'thumb': '/storage/img/general_blogs/1590993113a27.jpg', 'naffcount': '100' 
		
    },
    {
        'id': '15', 'name': '8', 'thumb': '/storage/img/general_blogs/1590837335hotwire.jpg', 'naffcount': '90' 
		
    },
    {
        'id': '16', 'name': '16', 'thumb': '/storage/img/general_blogs/1589437214a2.jpg', 'naffcount': '89' 
		
    },
    {
        'id': '17', 'name': '17', 'thumb': '/storage/img/general_blogs/1589280324a30.jpg', 'naffcount': '88' 
		
    },
    {
        'id': '18', 'name': '18', 'thumb': '/storage/img/general_blogs/15892020981585466954a21.jpg', 'naffcount': '87' 
		
    },
    {
        'id': '19', 'name': '19', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '86' 
		
    },
    {
        'id': '20', 'name': '20', 'thumb': '/storage/img/general_blogs/15891789751585467010a28.png', 'naffcount': '85' 
		
    },
    {
        'id': '21', 'name': '21', 'thumb': '/storage/img/general_blogs/15874496301584960852a27.jpg', 'naffcount': '84' 
		
    },
    {
        'id': '22', 'name': '22', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '83' 
		
    },
    {
        'id': '23', 'name': '23', 'thumb': '/storage/img/general_blogs/1587448536a5.jpg', 'naffcount': '82' 
		
    },
    {
        'id': '24', 'name': '24', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '81' 
		
    },
    {
        'id': '25', 'name': '25', 'thumb': '/storage/img/general_blogs/1587448329a26.jpg', 'naffcount': '80' 
		
    },
    {
        'id': '26', 'name': '26', 'thumb': '/storage/img/general_blogs/1587447873a8.jpg', 'naffcount': '79' 
		
    },
    {
        'id': '27', 'name': '27', 'thumb': '/storage/img/general_blogs/1587447896a9.jpg', 'naffcount': '78' 
		
    },
    {
        'id': '28', 'name': '28', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '77' 
		
    },
    {
        'id': '29', 'name': '29', 'thumb': '/storage/img/general_blogs/1587447820a47.jpg', 'naffcount': '76' 
		
    },
    {
        'id': '30', 'name': '30', 'thumb': '/storage/img/general_blogs/15873817156.jpg', 'naffcount': '75' 
		
    },
    {
        'id': '31', 'name': '31', 'thumb': '/storage/img/general_blogs/1587381592a25.jpg', 'naffcount': '74' 
		
    },
    {
        'id': '32', 'name': '32', 'thumb': '/storage/img/general_blogs/1587381749WGKM8334.jpg', 'naffcount': '73' 
		
    },
    {
        'id': '33', 'name': '33', 'thumb': '/storage/img/general_blogs/15873818711.jpg', 'naffcount': '72' 
		
    },
    {
        'id': '34', 'name': '34', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '70' 
		
    },
    {
        'id': '35', 'name': '35', 'thumb': '/storage/img/general_blogs/1587381672NMYK0151.jpg', 'naffcount': '68' 
		
    },
    {
        'id': '36', 'name': '36', 'thumb': '/storage/img/general_blogs/15873817372.jpg', 'naffcount': '66' 
		
    },
    {
        'id': '37', 'name': '37', 'thumb': '/storage/img/general_blogs/1587382112a33.jpg', 'naffcount': '65' 
		
    },
    {
        'id': '38', 'name': '38', 'thumb': '/storage/img/general_blogs/1587382648a5.jpg', 'naffcount': '55' 
		
    },
    {
        'id': '39', 'name': '39', 'thumb': '/storage/img/general_blogs/1587381556a9.jpg', 'naffcount': '45' 
		
    },
    {
        'id': '40', 'name': '40', 'thumb': '/storage/img/general_blogs/default.png', 'naffcount': '40' 
		
    },
    {
        'id': '41', 'name': '41', 'thumb': '/storage/img/general_blogs/1587381503a8.jpg', 'naffcount': '37' 
		
    },
    {
        'id': '42', 'name': '42', 'thumb': '/storage/img/general_blogs/1591017222a51.jpg', 'naffcount': '36' 
		
    },
    {
        'id': '43', 'name': '43', 'thumb': '/storage/img/general_blogs/1591438728a11.jpg', 'naffcount': '35' 
		
    },
    {
        'id': '44', 'name': '44', 'thumb': '/storage/img/general_blogs/1591017337a27.jpg', 'naffcount': '25' 
		
    },
    {
        'id': '45', 'name': '45', 'thumb': '/storage/img/general_blogs/1587387430a33.jpg', 'naffcount': '15' 
		
    },
    {
        'id': '46', 'name': '46', 'thumb': '/storage/img/general_blogs/15873829561.jpg', 'naffcount': '13' 
		
    },
    {
        'id': '47', 'name': '47', 'thumb': '/storage/img/general_blogs/1587386094Museum (4).jpg', 'naffcount': '9' 
		
    },
    {
        'id': '48', 'name': '48', 'thumb': '/storage/img/general_blogs/1587448424a1.jpg', 'naffcount': '8' 
		
    },
    {
        'id': '49', 'name': '49', 'thumb': '/storage/img/general_blogs/1587381592a25.jpg', 'naffcount': '7' 
		
    },
    {
        'id': '50', 'name': '50', 'thumb': '/storage/img/general_blogs/1591438590a1.jpg', 'naffcount': '5' 
		
    },
    ];
    let countries =[ 
  {"name": "Afghanistan", "code": "AF"}, 
  {"name": "Albania", "code": "AL"}, 
  {"name": "Algeria", "code": "DZ"}, 
  {"name": "American Samoa", "code": "AS"}, 
  {"name": "AndorrA", "code": "AD"}, 
  {"name": "Angola", "code": "AO"}, 
  {"name": "Anguilla", "code": "AI"}, 
  {"name": "Antigua and Barbuda", "code": "AG"}, 
  {"name": "Argentina", "code": "AR"}, 
  {"name": "Armenia", "code": "AM"}, 
  {"name": "Aruba", "code": "AW"}, 
  {"name": "Australia", "code": "AU"}, 
  {"name": "Austria", "code": "AT"}, 
  {"name": "Azerbaijan", "code": "AZ"}, 
  {"name": "Bahamas", "code": "BS"}, 
  {"name": "Bahrain", "code": "BH"}, 
  {"name": "Bangladesh", "code": "BD"}, 
  {"name": "Barbados", "code": "BB"}, 
  {"name": "Belarus", "code": "BY"}, 
  {"name": "Belgium", "code": "BE"}, 
  {"name": "Belize", "code": "BZ"}, 
  {"name": "Benin", "code": "BJ"}, 
  {"name": "Bermuda", "code": "BM"}, 
  {"name": "Bhutan", "code": "BT"}, 
  {"name": "Bolivia", "code": "BO"}, 
  {"name": "Bosnia and Herzegovina", "code": "BA"}, 
  {"name": "Botswana", "code": "BW"}, 
  {"name": "Bouvet Island", "code": "BV"}, 
  {"name": "Brazil", "code": "BR"}, 
  {"name": "British Indian Ocean Territory", "code": "IO"}, 
  {"name": "Brunei Darussalam", "code": "BN"}, 
  {"name": "Bulgaria", "code": "BG"}, 
  {"name": "Burkina Faso", "code": "BF"}, 
  {"name": "Burundi", "code": "BI"}, 
  {"name": "Cambodia", "code": "KH"}, 
  {"name": "Cameroon", "code": "CM"}, 
  {"name": "Canada", "code": "CA"}, 
  {"name": "Cape Verde", "code": "CV"}, 
  {"name": "Cayman Islands", "code": "KY"}, 
  {"name": "Central African Republic", "code": "CF"}, 
  {"name": "Chad", "code": "TD"}, 
  {"name": "Chile", "code": "CL"}, 
  {"name": "China", "code": "CN"}, 
  {"name": "Christmas Island", "code": "CX"}, 
  {"name": "Cocos (Keeling) Islands", "code": "CC"}, 
  {"name": "Colombia", "code": "CO"}, 
  {"name": "Comoros", "code": "KM"}, 
  {"name": "Congo", "code": "CG"}, 
  {"name": "Congo, The Democratic Republic of the", "code": "CD"}, 
  {"name": "Cook Islands", "code": "CK"}, 
  {"name": "Costa Rica", "code": "CR"}, 
  {"name": "Cote D\"Ivoire", "code": "CI"}, 
  {"name": "Croatia", "code": "HR"}, 
  {"name": "Cuba", "code": "CU"}, 
  {"name": "Cyprus", "code": "CY"}, 
  {"name": "Czech Republic", "code": "CZ"}, 
  {"name": "Denmark", "code": "DK"}, 
  {"name": "Djibouti", "code": "DJ"}, 
  {"name": "Dominica", "code": "DM"}, 
  {"name": "Dominican Republic", "code": "DO"}, 
  {"name": "Ecuador", "code": "EC"}, 
  {"name": "Egypt", "code": "EG"}, 
  {"name": "El Salvador", "code": "SV"}, 
  {"name": "Equatorial Guinea", "code": "GQ"}, 
  {"name": "Eritrea", "code": "ER"}, 
  {"name": "Estonia", "code": "EE"}, 
  {"name": "Ethiopia", "code": "ET"}, 
  {"name": "Falkland Islands (Malvinas)", "code": "FK"}, 
  {"name": "Faroe Islands", "code": "FO"}, 
  {"name": "Fiji", "code": "FJ"}, 
  {"name": "Finland", "code": "FI"}, 
  {"name": "France", "code": "FR"}, 
  {"name": "French Guiana", "code": "GF"}, 
  {"name": "French Polynesia", "code": "PF"}, 
  {"name": "French Southern Territories", "code": "TF"}, 
  {"name": "Gabon", "code": "GA"}, 
  {"name": "Gambia", "code": "GM"}, 
  {"name": "Georgia", "code": "GE"}, 
  {"name": "Germany", "code": "DE"}, 
  {"name": "Ghana", "code": "GH"}, 
  {"name": "Gibraltar", "code": "GI"}, 
  {"name": "Greece", "code": "GR"}, 
  {"name": "Greenland", "code": "GL"}, 
  {"name": "Grenada", "code": "GD"}, 
  {"name": "Guadeloupe", "code": "GP"}, 
  {"name": "Guam", "code": "GU"}, 
  {"name": "Guatemala", "code": "GT"}, 
  {"name": "Guernsey", "code": "GG"}, 
  {"name": "Guinea", "code": "GN"}, 
  {"name": "Guinea-Bissau", "code": "GW"}, 
  {"name": "Guyana", "code": "GY"}, 
  {"name": "Haiti", "code": "HT"}, 
  {"name": "Heard Island and Mcdonald Islands", "code": "HM"}, 
  {"name": "Holy See (Vatican City State)", "code": "VA"}, 
  {"name": "Honduras", "code": "HN"}, 
  {"name": "Hong Kong", "code": "HK"}, 
  {"name": "Hungary", "code": "HU"}, 
  {"name": "Iceland", "code": "IS"}, 
  {"name": "India", "code": "IN"}, 
  {"name": "Indonesia", "code": "ID"}, 
  {"name": "Iran, Islamic Republic Of", "code": "IR"}, 
  {"name": "Iraq", "code": "IQ"}, 
  {"name": "Ireland", "code": "IE"}, 
  {"name": "Isle of Man", "code": "IM"}, 
  {"name": "Israel", "code": "IL"}, 
  {"name": "Italy", "code": "IT"}, 
  {"name": "Jamaica", "code": "JM"}, 
  {"name": "Japan", "code": "JP"}, 
  {"name": "Jersey", "code": "JE"}, 
  {"name": "Jordan", "code": "JO"}, 
  {"name": "Kazakhstan", "code": "KZ"}, 
  {"name": "Kenya", "code": "KE"}, 
  {"name": "Kiribati", "code": "KI"}, 
  {"name": "Korea, Democratic People\"S Republic of", "code": "KP"}, 
  {"name": "Korea, Republic of", "code": "KR"}, 
  {"name": "Kuwait", "code": "KW"}, 
  {"name": "Kyrgyzstan", "code": "KG"}, 
  {"name": "Lao People\"S Democratic Republic", "code": "LA"}, 
  {"name": "Latvia", "code": "LV"}, 
  {"name": "Lebanon", "code": "LB"}, 
  {"name": "Lesotho", "code": "LS"}, 
  {"name": "Liberia", "code": "LR"}, 
  {"name": "Libyan Arab Jamahiriya", "code": "LY"}, 
  {"name": "Liechtenstein", "code": "LI"}, 
  {"name": "Lithuania", "code": "LT"}, 
  {"name": "Luxembourg", "code": "LU"}, 
  {"name": "Macao", "code": "MO"}, 
  {"name": "Macedonia, The Former Yugoslav Republic of", "code": "MK"}, 
  {"name": "Madagascar", "code": "MG"}, 
  {"name": "Malawi", "code": "MW"}, 
  {"name": "Malaysia", "code": "MY"}, 
  {"name": "Maldives", "code": "MV"}, 
  {"name": "Mali", "code": "ML"}, 
  {"name": "Malta", "code": "MT"}, 
  {"name": "Marshall Islands", "code": "MH"}, 
  {"name": "Martinique", "code": "MQ"}, 
  {"name": "Mauritania", "code": "MR"}, 
  {"name": "Mauritius", "code": "MU"}, 
  {"name": "Mayotte", "code": "YT"}, 
  {"name": "Mexico", "code": "MX"}, 
  {"name": "Micronesia, Federated States of", "code": "FM"}, 
  {"name": "Moldova, Republic of", "code": "MD"}, 
  {"name": "Monaco", "code": "MC"}, 
  {"name": "Mongolia", "code": "MN"}, 
  {"name": "Montserrat", "code": "MS"}, 
  {"name": "Morocco", "code": "MA"}, 
  {"name": "Mozambique", "code": "MZ"}, 
  {"name": "Myanmar", "code": "MM"}, 
  {"name": "Namibia", "code": "NA"}, 
  {"name": "Nauru", "code": "NR"}, 
  {"name": "Nepal", "code": "NP"}, 
  {"name": "Netherlands", "code": "NL"}, 
  {"name": "Netherlands Antilles", "code": "AN"}, 
  {"name": "New Caledonia", "code": "NC"}, 
  {"name": "New Zealand", "code": "NZ"}, 
  {"name": "Nicaragua", "code": "NI"}, 
  {"name": "Niger", "code": "NE"}, 
  {"name": "Nigeria", "code": "NG"}, 
  {"name": "Niue", "code": "NU"}, 
  {"name": "Norfolk Island", "code": "NF"}, 
  {"name": "Northern Mariana Islands", "code": "MP"}, 
  {"name": "Norway", "code": "NO"}, 
  {"name": "Oman", "code": "OM"}, 
  {"name": "Pakistan", "code": "PK"}, 
  {"name": "Palau", "code": "PW"}, 
  {"name": "Palestinian Territory, Occupied", "code": "PS"}, 
  {"name": "Panama", "code": "PA"}, 
  {"name": "Papua New Guinea", "code": "PG"}, 
  {"name": "Paraguay", "code": "PY"}, 
  {"name": "Peru", "code": "PE"}, 
  {"name": "Philippines", "code": "PH"}, 
  {"name": "Pitcairn", "code": "PN"}, 
  {"name": "Poland", "code": "PL"}, 
  {"name": "Portugal", "code": "PT"}, 
  {"name": "Puerto Rico", "code": "PR"}, 
  {"name": "Qatar", "code": "QA"}, 
  {"name": "Reunion", "code": "RE"}, 
  {"name": "Romania", "code": "RO"}, 
  {"name": "Russian Federation", "code": "RU"}, 
  {"name": "RWANDA", "code": "RW"}, 
  {"name": "Saint Helena", "code": "SH"}, 
  {"name": "Saint Kitts and Nevis", "code": "KN"}, 
  {"name": "Saint Lucia", "code": "LC"}, 
  {"name": "Saint Pierre and Miquelon", "code": "PM"}, 
  {"name": "Saint Vincent and the Grenadines", "code": "VC"}, 
  {"name": "Samoa", "code": "WS"}, 
  {"name": "San Marino", "code": "SM"}, 
  {"name": "Sao Tome and Principe", "code": "ST"}, 
  {"name": "Saudi Arabia", "code": "SA"}, 
  {"name": "Senegal", "code": "SN"}, 
  {"name": "Serbia and Montenegro", "code": "CS"}, 
  {"name": "Seychelles", "code": "SC"}, 
  {"name": "Sierra Leone", "code": "SL"}, 
  {"name": "Singapore", "code": "SG"}, 
  {"name": "Slovakia", "code": "SK"}, 
  {"name": "Slovenia", "code": "SI"}, 
  {"name": "Solomon Islands", "code": "SB"}, 
  {"name": "Somalia", "code": "SO"}, 
  {"name": "South Africa", "code": "ZA"}, 
  {"name": "South Georgia and the South Sandwich Islands", "code": "GS"}, 
  {"name": "Spain", "code": "ES"}, 
  {"name": "Sri Lanka", "code": "LK"}, 
  {"name": "Sudan", "code": "SD"}, 
  {"name": "Suri", "code": "SR"}, 
  {"name": "Svalbard and Jan Mayen", "code": "SJ"}, 
  {"name": "Swaziland", "code": "SZ"}, 
  {"name": "Sweden", "code": "SE"}, 
  {"name": "Switzerland", "code": "CH"}, 
  {"name": "Syrian Arab Republic", "code": "SY"}, 
  {"name": "Taiwan, Province of China", "code": "TW"}, 
  {"name": "Tajikistan", "code": "TJ"}, 
  {"name": "Tanzania, United Republic of", "code": "TZ"}, 
  {"name": "Thailand", "code": "TH"}, 
  {"name": "Timor-Leste", "code": "TL"}, 
  {"name": "Togo", "code": "TG"}, 
  {"name": "Tokelau", "code": "TK"}, 
  {"name": "Tonga", "code": "TO"}, 
  {"name": "Trinidad and Tobago", "code": "TT"}, 
  {"name": "Tunisia", "code": "TN"}, 
  {"name": "Turkey", "code": "TR"}, 
  {"name": "Turkmenistan", "code": "TM"}, 
  {"name": "Turks and Caicos Islands", "code": "TC"}, 
  {"name": "Tuvalu", "code": "TV"}, 
  {"name": "Uganda", "code": "UG"}, 
  {"name": "Ukraine", "code": "UA"}, 
  {"name": "United Arab Emirates", "code": "AE"}, 
  {"name": "United Kingdom", "code": "GB"}, 
  {"name": "United States", "code": "US"}, 
  {"name": "United States Minor Outlying Islands", "code": "UM"}, 
  {"name": "Uruguay", "code": "UY"}, 
  {"name": "Uzbekistan", "code": "UZ"}, 
  {"name": "Vanuatu", "code": "VU"}, 
  {"name": "Venezuela", "code": "VE"}, 
  {"name": "Viet Nam", "code": "VN"}, 
  {"name": "Virgin Islands, British", "code": "VG"}, 
  {"name": "Virgin Islands, U.S.", "code": "VI"}, 
  {"name": "Wallis and Futuna", "code": "WF"}, 
  {"name": "Western Sahara", "code": "EH"}, 
  {"name": "Yemen", "code": "YE"}, 
  {"name": "Zambia", "code": "ZM"}, 
  {"name": "Zimbabwe", "code": "ZW"} 
];

$(document).ready(function() {
    var options = {
        // data: countries,
        url: url+'/front/json/countries.json',
        getValue: "name",
        list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function() {
                    var selectedItemValue = $("#countries").getSelectedItemData().name;
                    
                    $("#countries").val(selectedItemValue).trigger("change");
                    $('#cities').val('').trigger("change");
                    
                    setCities(selectedItemValue);
                }
            }
    };
    $("#countries").easyAutocomplete(options);

    var allcities;
    $.getJSON( "/front/json/city-countries.json", function( data ) {
        allcities = data;
    });

    function setCities(country)
    {
        var cities = allcities[country];
        var newcities = _.uniq(cities, JSON.stringify);
        
        var options = {
            data: newcities,
            list: {
                match: {
                    enabled: true
                },
                onSelectItemEvent: function() {
                    var selectedItemValue = $("#cities").getSelectedItemData();

                    $("#cities").val(selectedItemValue).trigger("change");

                    // setCities(selectedItemValue);
                },
            }
        };
        $("#cities").easyAutocomplete(options);
    }
});
    
 
$(document).ready(function() {
    $('.main-naff').css('opacity', '1');


$("#1").attr("src",arrCount[ClickCount].thumb);
$("#2").attr("src",arrCount[ClickCount+1].thumb);
$("#3").attr("src",arrCount[ClickCount+2].thumb);

$("#1").attr("blog_id",arrCount[ClickCount].id);
$("#2").attr("blog_id",arrCount[ClickCount+1].id);
$("#3").attr("blog_id",arrCount[ClickCount+2].id);



$('#1').attr('onClick','viewBlog('+arrCount[ClickCount].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[ClickCount+1].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[ClickCount+2].id+')');

// $("#blog_name_first").html("Naff Count:"+arrCount[ClickCount].naffcount);
// $("#blog_name_second").html("Naff Count:"+arrCount[ClickCount+1].naffcount);
// $("#blog_name_third").html("Naff Count:"+arrCount[ClickCount+2].naffcount);
$("#blog_name_first").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount].naffcount+'</span>');
$("#blog_name_second").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount+1].naffcount+'</span>');
$("#blog_name_third").html('<span style="color:#28e9e2 !important">'+"Naff Count:"+'</span>'+'<span style="color:gold !important">'+arrCount[ClickCount+2].naffcount+'</span>');



    var elem = document.documentElement;
function openFullscreen() {
    if (elem.mozRequestFullScreen) {  /* Firefox */
    elem.mozRequestFullScreen(); 
    contentDisplay();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
    contentDisplay();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
    contentDisplay();
  }
  else if (elem.requestFullscreen) {
    elem.requestFullscreen();
    contentDisplay();
  } 
  else{
  //alert("iphone")
    contentDisplay();
  }

}
if(window.innerWidth < 991 ){
$(document).ready(()=>{
    Swal.fire({
            imageUrl: '../../front/icons/alert-icon.png',
            imageWidth: 80,
            imageHeight: 80,
            html: "<h5 id='f-screen'>Initializing fullscreen mode . . .</h5>",
            padding: '15px',
            background: 'rgba(8, 64, 147, 0.62)',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen()
            }
        });
    });
}
else  contentDisplay();

function contentDisplay() { 
      setTimeout(function(){
        $(".astro-div").css({'display':'flex'}); 
        $(".page").css({'visibility':'visible'});
        $(".astro-div").css({'visibility':'visible'});
      // $(".most-naffed").css({'visibility':'visible'});
            
            
        $(".page").addClass('animate-zoomIn-arm');
  
        $('.page').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){ 
   $(".page").removeClass('animate-zoomIn-arm');
    $(".page").addClass('zoomIn-arm');
   });

        }, 1000
);
    }
});
function go_to_next(){
    var next = document.getElementById( "next_no" ).value;
    var prev = document.getElementById( "prev_no" ).value;
    var middle = document.getElementById( "middle_no" ).value;
    var first=parseInt(prev)+parseInt(3);
    var second=parseInt(middle)+parseInt(3);
    var third=parseInt(next)+parseInt(3);
    if(first >= arrCount.length)
        {
            first = 0;
            second = first+1;
            third =second+1;
        }
        if(second >= arrCount.length)
        {
            second = 0;
            third =second+1;
        }
        if(third >= arrCount.length)
        {
            third = 0;
        }

$("#1").attr("src",arrCount[first].thumb);
$("#2").attr("src",arrCount[second].thumb);
$("#3").attr("src",arrCount[third].thumb);

$("#1").attr("blog_id",arrCount[first].id);
$("#2").attr("blog_id",arrCount[second].id);
$("#3").attr("blog_id",arrCount[third].id);

$('#1').attr('onClick','viewBlog('+arrCount[first].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[second].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[third].id+')');


document.getElementById("next_no").value = third;
document.getElementById("prev_no").value = first;
document.getElementById("middle_no").value = second;
$("#blog_name_first").text("Naff Count:"+arrCount[first].naffcount);
$("#blog_name_second").text("Naff Count:"+arrCount[second].naffcount);
$("#blog_name_third").text("Naff Count:"+arrCount[third].naffcount);

$("#blog_name_h1").text((parseInt(first)+parseInt(1))+"th Most naffed!");
$("#blog_name_h2").text((parseInt(second)+parseInt(1))+"th Most naffed!");
$("#blog_name_h3").text((parseInt(third)+parseInt(1))+"th Most naffed!");


}
function go_to_previous(){
    var next = document.getElementById( "next_no" ).value;
    var prev = document.getElementById( "prev_no" ).value;
    var middle = document.getElementById( "middle_no" ).value;


   var first=parseInt(prev)-parseInt(3);
   var second=parseInt(middle)-parseInt(3);
   var third=parseInt(next)-parseInt(3);

   if(first <= -1)
        {
            first = parseInt(arrCount.length)-parseInt(3);
            second =parseInt(arrCount.length)-parseInt(2);
            third =parseInt(arrCount.length)-parseInt(1);
        }
        if(second <= -1)
        {
            second = parseInt(arrCount.length)-parseInt(3);
            third =parseInt(arrCount.length)-parseInt(2);
        }
        if(third <= -1)
        {
            third =parseInt(arrCount.length)-parseInt(3);
        }

$("#1").attr("src",arrCount[first].thumb);
$("#2").attr("src",arrCount[second].thumb);
$("#3").attr("src",arrCount[third].thumb);


$("#1").attr("blog_id",arrCount[first].id);
$("#2").attr("blog_id",arrCount[second].id);
$("#3").attr("blog_id",arrCount[third].id);

$('#1').attr('onClick','viewBlog('+arrCount[first].id+')');
$('#2').attr('onClick','viewBlog('+arrCount[second].id+')');
$('#3').attr('onClick','viewBlog('+arrCount[third].id+')');

document.getElementById("next_no").value = third;
document.getElementById("prev_no").value = first;
document.getElementById("middle_no").value = second;

$("#blog_name_first").html("Naff Count:"+arrCount[first].naffcount);
$("#blog_name_second").html("Naff Count:"+arrCount[second].naffcount);
$("#blog_name_third").html("Naff Count:"+arrCount[third].naffcount);

}

    (function () {
    
        $(".img-nouvela").removeClass("ani-rollout_naff");
          // for showing message to turn to landscape 
          testOrientation();
          window.addEventListener("orientationchange", function(event) {
          testOrientation();
        }, false);

        window.addEventListener("resize", function(event) {
        testOrientation();
        }, false);

        function testOrientation() 
        {
            document.getElementById('block_land').style.display = (screen.width>screen.height) ? 'none' : 'block';
            //above condition is not working sometimes then this condition will work
            if(window.innerHeight< window.innerWidth)
                {
                    document.getElementById('block_land').style.display = 'none' ;
                }
                else{
                    document.getElementById('block_land').style.display =  'block';
                }
        }

        // You might need this, usually it's autoloaded   
            jQuery.noConflict();
            /**
            Click function for the div to show the tittle and content and 
            */
           $(document).on("click",".div_img", function () { 
          
            $(".div_count_icon").css({'display':'none'});
            $(".div_count_bg").css({'display':'none'});
            $("#clicked_img .overlay").css({'display':'none'});   
            $("#clicked_img .div_title").css({'display':'none'});   
            $("#clicked_img .div_btn").css({'display':'none'});
            $(".div_overlay").removeClass("div_overlay_p");
            $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'unset','left':'0'});
            $(".blog-buttons_overlay .button-div").css({'flex-direction':'unset'});
            $('div.cell').removeAttr('id');
            $(this).attr('id','clicked_img');
            var clicked_img_id = $(this).attr('id');
            var img = $("#clicked_img> a>img");
            var pos = $("#clicked_img> a>img").position();
            var  top=$("#clicked_img> a>img").css("top");
            var  left=$("#clicked_img> a>img").css("left");
            var  width=$("#clicked_img> a>img").css("width");
            var  height=$("#clicked_img> a>img" ).css("height");
         
            $("#clicked_img .overlay").css({'display':'flex'});
            $("#clicked_img .div_title").css({'display':'block'});
            $("#clicked_img .div_btn").css({'display':'block'});

           /* for checking orientation of an image*/

            if (img.width() > img.height()){
                var differernce=img.width() -img.height();
            }

         if (img.width() > img.height()){
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'column-reverse'});
              $(".blog-buttons_overlay").css({'top':'50%','left':'50%','width':'82%','transform':'translate(-49%, -67%)'});
           
            } 
            else {
              $(".div_overlay").addClass("div_overlay_p");
              $(".blog-buttons_overlay").css({'display':'flex','flex-direction':'column','top':'50%','left':'50%','width':'82%','transform':'translate(-29%, -67%)'});
              $(".blog-buttons_overlay .button-div").css({'flex-direction':'row'});
            } 
   
});

    })();
// Show title on hover
$('.main-naff').mouseover(function() { 

//alert("mouseover")
	$(this).find('.blog_name').addClass('animated zoomIn');
	$(this).find('.blog_name').css('opacity', '1');
}).mouseout(function() { 
    //alert("mouseout")
	$(this).find('.blog_name').removeClass('animated zoomIn');
	$(this).find(' .blog_name').css('opacity', '0');
});
    $('.img-button').hover(
            function () {
                $(this).parent().find('span').show();
            },
            function () {
                $(this).parent().find('span').hide();
            }
        );
        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });

        $('.home-btn').click( function() {
           
            window.location.href = url;
        });

        $('.profile-btn').click( function() {
            window.location.href = url+'/dashboard';
        });

        $('.instructions-btn').click( function() {
            window.location.href = url+'/page_under_development';
        });

        $('.editphoto-btn').click( function() {
            window.location.href = url+'/profile/edit-photo';
        });
        $('.music-btn').click( function() {
         //   window.location.href = url+'/profile/edit-photo';
         var audio =  document.getElementById('1');
          audio.play();
        });
    
    
    
   
    var zoomTimer = null;
    
    function refreshImage(elem, cell)
    {
        if (cell.iszoomed)
        {
            return;
        }
    
        if (zoomTimer)
        {
            clearTimeout(zoomTimer);
        }
        
        var zoomImage = jQuery('<img class="zoom"></img>');
    
        zoomTimer = setTimeout(function ()
        {
            zoomImage.load(function ()
            {
                layoutImageInCell(zoomImage[0], cell.div[0]);
                jQuery(elem).replaceWith(zoomImage);
                cell.iszoomed = true;
            });
    
            zoomImage.attr("src", cell.info.zoom);
    
            zoomTimer = null;
        }, 2000);
    }
    //this is for sizing images through cell height, cell weidth, image height, image weidth
    function layoutImageInCell(image, cell)
    {

        var iwidth = image.width;
        var iheight = image.height;
        var cwidth = jQuery(cell).width();
        var cheight = jQuery(cell).height();
        var ratio = Math.min(cheight / iheight, cwidth / iwidth);
        
        iwidth *= ratio;
        iheight *= ratio;
        //for putting image in center
    
        image.style.width = Math.round(iwidth) + "px";
        image.style.height = Math.round(iheight) + "px";
    
        image.style.left = Math.round((cwidth - iwidth) / 2) + "px";
        image.style.top = Math.round((cheight - iheight) / 2) + "px";

        var width_for_count=Math.round(iwidth) + "px";
        var height_for_count= Math.round((iheight) /5)+ "px";
        var top_for_count= Math.round((cwidth - iwidth) / 2) + "px";
        var left_for_count= Math.round((cheight - iheight) / 2) + "px";
  
       $(".div_count").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                            left:left_for_count+"px",top:"80%",'opacity':'35%'});


     
       $(".div_img .div_count_text").css({width:width_for_count, height:height_for_count,
                                                "position":"absolute",
                                                 left:left_for_count+"px",top:"80%"});

                                                
    }

   

/* Function to redirect to view Blog */

function viewBlog(id){  
    var url="/single_general_blog/"+id;
    window.open(
        url,
  '_blank' // <- This is what makes it open in a new window.
);
var audio = document.getElementById("one");
audio.pause();
  
}
/**
 * Function to play music
 * */

function play_note(id){
    $(".img-nouvela").removeClass("ani-rollout_naff");
    var clsOverlay=id +" .blog-buttons_overlay  .button-div .button-details .naff-number";
    var naffCount=$("."+clsOverlay).html();
   
    if(naffCount==555){
        var audio = document.getElementById("fart");
            audio.play();
            $("#overlay").css({'display':'none'});
            $(".img-nouvela").removeClass("ani-rollout_naff");
            $(".img-nouvela").css({'display':'block','z-index':'1000'});
            $(".img-nouvela").addClass("ani-rollout_naff");
            setTimeout(function(){
                  $(".img-nouvela").removeClass("ani-rollout_naff");
                  $(".img-nouvela").css({'display':'none'});
                  $("#overlay").css({'display':'none'});
                }, 3000);
    }
else{

    var playist=id%28;
    if(playist==0)
    {
        var audio = document.getElementById("1");
        audio.play();
    }
   else
    {
        myVar = id+1;
        var audio =  document.getElementById(myVar);
        audio.play();
    }
}
}
function largest(hot_count,cool_count,naff_count,i)
	{
        hot_count=parseInt(hot_count);
        cool_count=parseInt(cool_count);
        naff_count=parseInt(naff_count);
		
     
		if(hot_count>cool_count && hot_count>naff_count)
		{
        
           $(".div_count_bg"+i).css({'background-color':'rgba(216, 7, 7, 0.5)'});
        }
		else if(cool_count>hot_count && cool_count>naff_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(0, 118, 163, 0.5)'});
		}
		else if(naff_count>hot_count && naff_count>hot_count)
		{
            $(".div_count_bg"+i).css({'background-color':'rgba(199, 189, 0, 0.5)'});
        }
        else if(hot_count==0 && naff_count==0 && cool_count==0)
		{
            $(".div_count_bg"+i).css({'background-color':'#00800052'});
		}

	}

    var astronaut_zoom = 0;


        var navigator_zoom = 0;
        $('button.zoom-btn').click( function() { 
        
            if(!navigator_zoom) {
                $('.zoom-btn').hide();
                $('.navigator-buttons').css('pointer-events', 'auto');
                $('.communicator-div').css('pointer-events', 'auto');
                $('.instruction-div').css('pointer-events', 'auto');
                $('.tos-div').css('pointer-events', 'auto');
                $('.btn_pointer').css('pointer-events', 'auto');
                $('.navigator-div').addClass('animate-navigator-zoomin');
                

               $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomin');
                    $('.navigator-div').addClass('zoomin');
                    $('.zoom-btn').hide();
                });
            } else {
            
            }

            navigator_zoom = !navigator_zoom;
        });
        //Zoom out animation
        $('.navigator-zoomout-btn').click(function() {
            $('.navigator-div').addClass('animate-navigator-zoomout');

            $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.navigator-div').removeClass('animate-navigator-zoomout');
                $('.navigator-div').removeClass('zoomin');
                $('.zoom-btn').show();
                
            });

            navigator_zoom = !navigator_zoom;
        });


        function removeAstronautAnimation()
        {
            clearInterval(animation_interval);
            // $('.reaction-div').css('transition', 'none');
        }
        $(".tos-div").click(function(){
                  window.location.href = "{{URL::to('/terms')}}"
                    
                });


                $(".communicator-div").on({
    mouseenter: function () {
        $('.communicator-span').css('display', 'block');
    },
    mouseleave: function () {
        $('.communicator-span').css('display', 'none');
    }
});
 
           
    </script>
    
@endsection
