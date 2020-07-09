@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{asset('front/CSS/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery.mobile-1.4.5.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/dashboard-responsive.css')}}">
   
    @php
        $travel_preview = Auth::user()->getCollage('travel');
        $designs_preview = Auth::user()->getCollage('designs');
        $general_preview = Auth::user()->getCollage('general');
        $politics_preview = Auth::user()->getCollage('politics');
        $music_preview = Auth::user()->getCollage('music');
        $sports_preview = Auth::user()->getCollage('sports');
        $films_preview = Auth::user()->getCollage('films');
        $mountains_and_seas_preview = Auth::user()->getCollage('mountains_and_seas');
        $careers_preview = Auth::user()->getCollage('careers');
        $family_and_friends_preview = Auth::user()->getCollage('family_and_friends');
    @endphp

    @if($travel_preview != '')
    <style>
        .pluto_preview {
            background-image: url({{$travel_preview}});
        }
    </style>
    @endif

    @if($designs_preview != '')
    <style>
        .neptune_preview {
            background-image: url({{$designs_preview}});
        }
    </style>
    @endif

    @if($general_preview != '')
    <style>
        .jupiter_preview {
            background-image: url({{$general_preview}});
        }
    </style>
    @endif

    @if($politics_preview != '')
    <style>
        .uranus_preview .mover-1, .uranus_preview .map {
            display: none;
        }
        .uranus_preview {
            -webkit-transition: transform 200ms linear;
            -moz-transition: transform 200ms linear;
            -o-transition: transform 200ms linear;
            transition: transform 200ms linear;
            background-size: cover;
            background-image: url({{$politics_preview}});
            transform-style: preserve-3d;
            -webkit-animation: spin 4s linear infinite alternate; /* Safari 4+ */
            -moz-animation: spin 4s linear infinite alternate; /* Fx 5+ */
            -o-animation: spin 4s linear infinite alternate; /* Opera 12+ */
            animation: spin 4s linear infinite alternate;
        }
    </style>
    @endif

    @if($music_preview != '')
    <style>
        .saturn_preview .mover-1, .saturn_preview .map {
            display: none;
        }
        .saturn_preview {
            -webkit-transition: transform 200ms linear;
            -moz-transition: transform 200ms linear;
            -o-transition: transform 200ms linear;
            transition: transform 200ms linear;
            background-size: cover;
            background-image: url({{$music_preview}});
            transform-style: preserve-3d;
            -webkit-animation: spin 4s linear infinite alternate; /* Safari 4+ */
            -moz-animation: spin 4s linear infinite alternate; /* Fx 5+ */
            -o-animation: spin 4s linear infinite alternate; /* Opera 12+ */
            animation: spin 4s linear infinite alternate;
        }
    </style>
    @endif

    @if($sports_preview != '')
    <style>
        .moon_preview {
            background-image: url({{$sports_preview}});
        }
    </style>
    @endif

    @if($films_preview != '')
    <style>
        .venus_preview {
            background-image: url({{$films_preview}});
        }
    </style>
    @endif

    @if($mountains_and_seas_preview != '')
    <style>
        .mars_preview {
            background-image: url({{$mountains_and_seas_preview}});
        }
    </style>
    @endif

    @if($careers_preview != '')
    <style>
        .mercury_preview {
            background-image: url({{$careers_preview}});
        }
    </style>
    @endif

    @if($family_and_friends_preview != '')
    <style>
        .sun_preview {
            background-image: url({{$family_and_friends_preview}});
        }
    </style>
    @endif
@endsection

@section('content')
<div id="page-content">
    <div id="container" onmouseover="hidePreview()">
        <img class='img_bg' src="{{asset('front/images/skybox_bg.png')}}" />
    </div>
    <input class='userphotosrc' id='userphotosrc' type='hidden' value='{{Auth::user()->photo}}' />
    <div class="dialog">
        <div class="dialog-header">
            <p class="dialog-title"></p>
            <div class="dialog-buttons">
                <a href="#" class="dialog-fullscreen-btn" title="Fullscreen">
                    <img class="fullscreen" src="{{asset('front/images/fullscreen-btn.png')}}">
                    <img class="minimize hide" src="{{asset('front/images/minimize-btn.png')}}">
                </a>
                <a href="#" class="dialog-close-btn" title="Close"><img src="{{asset('front/images/close-btn.png')}}"></a>	
            </div>
        </div>
        <div class="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <iframe src="" class="iframe" style="border: 0px;" frameborder="0" width="100%" height="100%"></iframe>
    </div>
    
    <!-- div of planets with shadow like 3d -->
    <div class="planets ">
        <!-- Pluto -->
        <div class="pluto-img slide_9 main-planet">
            {{-- <div class="pluto-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_pluto">Pluto</h2>
        </div>
        <div class="zoom-in-planet img_pluto">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('travel',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="travel"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/Pluto.png')}}">
            {{-- <button class="planet-back-button travel-back btn">Back</button> --}}
        </div>

        <!-- Neptune -->
        <div class="neptune-img slide_8 main-planet">
            {{-- <div class="neptune-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_neptune">Neptune</h2>
        </div>
        <div class="zoom-in-planet img_neptune">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                <button class="view"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="designs"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/neptune.png')}}">
            {{-- <button class="planet-back-button neptune-back btn">Back</button> --}}
        </div>

        <!-- Jupiter -->
        <div class="jupiter-img slide_7 main-planet">
            {{-- <div class="jupiter-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_jupiter">Jupiter</h2>
        </div>
        <div class="zoom-in-planet img_jupiter">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button id="viewBlogs" class="view" onclick="view_general_blogs('general',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="general"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/jupiter.png')}}">
            {{-- <button class="planet-back-button jupiter-back btn">Back</button> --}}
        </div>

        <div class="earth-img slide_6 main-planet">
            <h2 class="planet_name" id="planet_name_earth">Earth</h2>
        </div>

        <!-- Moon -->
        <div class="moon-img slide_5 main-planet">
            {{-- <div class="moon-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_moon">Moon</h2>
        </div>
        <div class="zoom-in-planet img_moon">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                <button class="view" onclick="view_my_blogs_tagwise('sports',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="sports"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/moon-w.png')}}">
            {{-- <button class="planet-back-button moon-back btn">Back</button> --}}
        </div>

        <!-- Mars -->
        <div class="mars-img slide_4 main-planet">
            {{-- <div class="mars-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_mars">Mars</h2>
        </div>
        <div class="zoom-in-planet img_mars">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('Mountains and Seas',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="mountains_and_seas"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/mars.png')}}">
            {{-- <button class="planet-back-button mars-back btn">Back</button> --}}
        </div>

        <!-- Venus -->
        <div class="venus-img slide_3 main-planet">
            {{-- <div class="venus-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_venus">Venus</h2>
        </div>
        <div class="zoom-in-planet img_venus">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('films',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="films"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/venus.png')}}">
            {{-- <button class="planet-back-button venus-back btn">Back</button> --}}
        </div>
    
        <!-- Sun -->
        <div class="sun-img slide_2 main-planet">
            {{-- <div class="sun-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_sun">Sun</h2>
        </div>
        <div class="zoom-in-planet img_sun">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('Family and Friends',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="family_and_friends"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/sun.png')}}">
            {{-- <button class="planet-back-button sun-back btn">Back</button> --}}
        </div>

        <!-- Mercury -->
        <div class="mercury-img slide_1 main-planet">
            {{-- <div class="mercury-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_mercury">Mercury</h2>
        </div>
        <div class="zoom-in-planet img_mercury">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                <button class="view" onclick="view_my_career_posts({{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="careers"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img class="planet" src="{{asset('front/images/planets/Mercury.png')}}">
            {{-- <button class="planet-back-button mercury-back btn">Back</button> --}}
        </div>

        <!-- Uranus -->
        <div class="uranus-img slide12 main-planet">
            {{-- <div class="uranus-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_uranus">Uranus</h2>
        </div>
        <div class="zoom-in-planet img_uranus">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('politics',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="politics"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img src="{{asset('front/images/planets/uranus.png')}}" class="planet-img">
            {{-- <button class="planet-back-button uranus-back btn">Back</button> --}}
            <div class="preview uranus_preview">
                <div class="mover-1">
                    <img src="{{asset('front/images/politics-preview-2.png')}}">
                    
                </div>
                <div class="map">
                    <div class="row uranus-row-1">
                        <a href="https://en.wikipedia.org/wiki/Joseph_Stalin" title="Joseph Stalin" data-title="Joseph Stalin" class="joseph_stalin"></a>
                        <a href="https://en.wikipedia.org/wiki/Vladimir_Lenin" title="Vladimir Lenin" data-title="Vladimir Lenin" class="vladimir_lenin"></a>
                        <a href="https://en.wikipedia.org/wiki/Shinzo_Abe" title="Shinzo Abe" data-title="Shinzo Abe" class="shinzo_abe"></a>
                        <a href="https://en.wikipedia.org/wiki/Fidel_Castro" title="Fidel Castro" data-title="Fidel Castro" class="fidel_castro"></a>
                        <a href="https://en.wikipedia.org/wiki/Bernie_Sanders" title="Bernie Sanders" data-title="Bernie Sanders" class="bernie_sanders"></a>
                        <a href="https://en.wikipedia.org/wiki/Mikhail_Gorbachev" title="Mikhail Gorbachev" data-title="Mikhail Gorbachev" class="mikhail_gorbachev"></a>
                        <a href="https://en.wikipedia.org/wiki/Emmanuel_Macron" title="Emmanuel Macron" data-title="Emmanuel Macron" class="emmanuel_macron"></a>
                        <a href="https://en.wikipedia.org/wiki/Barack_Obama" title="Barack Obama" data-title="Barack Obama" class="barack_obama"></a>
                        <a href="https://en.wikipedia.org/wiki/Charles_de_Gaulle" title="Charles De Gaulle" data-title="Charles De Gaulle" class="charles_de_gaulle"></a>
                        <a href="https://en.wikipedia.org/wiki/Winston_Churchill" title="Winston Churchill" data-title="Winston Churchill" class="winston_churchill"></a>
                        <a href="https://en.wikipedia.org/wiki/Benjamin_Disraeli" title="Benjamin Disraeli" data-title="Benjamin Disraeli" class="benjamin_disraeli"></a>
                    </div>
                    <div class="row uranus-row-2">
                        <a href="https://en.wikipedia.org/wiki/Kim_Jong-il" title="Kim Jong Il" data-title="Kim Jong Il" class="kim_jong_il"></a>
                        <a href="https://en.wikipedia.org/wiki/Angela_Merkel" title="Angela Merkel" data-title="Angela Merkel" class="angela_merkel"></a>
                        <a href="https://en.wikipedia.org/wiki/Vladimir_Putin" title="Vladimir Putin" data-title="Vladimir Putin" class="vladimir_putin"></a>
                        <a href="https://en.wikipedia.org/wiki/Hugo_Chávez" title="Hugo Chávez" data-title="Hugo Chávez" class="hugo_rafael"></a>
                        <a href="https://en.wikipedia.org/wiki/Nelson_Mandela" title="Nelson Mandela" data-title="Nelson Mandela" class="nelson_mandela"></a>
                        <a href="https://en.wikipedia.org/wiki/Donald_Trump" title="Donald Trump" data-title="Donald Trump" class="donald_trump"></a>
                        <a href="https://en.wikipedia.org/wiki/Otto_von_Bismarck" title="Otto von Bismarck" data-title="Otto von Bismarck" class="otto_von"></a>
                        <a href="https://en.wikipedia.org/wiki/Rodrigo_Duterte" title="Rodrigo Duterte" data-title="Rodrigo Duterte" class="rodrigo_duterte"></a>
                        <a href="https://en.wikipedia.org/wiki/Boris_Johnson" title="Boris Johnson" data-title="Boris Johnson" class="boris_johnson"></a>
                        <a href="https://en.wikipedia.org/wiki/Theodore_Roosevelt" title="Theodore Roosevelt" data-title="Theodore Roosevelt" class="theodore_roosevelt"></a>
                        <a href="https://en.wikipedia.org/wiki/Mao_Zedong" title="Mao Zedong" data-title="Mao Zedong" class="chairman_mao"></a>
                        <a href="https://en.wikipedia.org/wiki/Kim_Jong-un" title="Kim Jong-un" data-title="Kim Jong-un" class="kim_jong_un"></a>
                    </div>
                    <div class="row uranus-row-3">
                        <a href="https://en.wikipedia.org/wiki/Kim_Jong-il" title="Kim Jong Il" data-title="Kim Jong Il" class="kim_jong_il"></a>
                        <a href="https://en.wikipedia.org/wiki/Justin_Trudeau" title="Justin Trudeau" data-title="Justin Trudeau" class="justin_trudeau"></a>
                        <a href="https://en.wikipedia.org/wiki/Abraham_Lincoln" title="Abraham Lincoln" data-title="Abraham Lincoln" class="abraham_lincoln"></a>
                        <a href="https://en.wikipedia.org/wiki/Adolf_Hitler" title="Adolf Hitler" data-title="Adolf Hitler" class="adolf_hitler"></a>
                        <a href="https://en.wikipedia.org/wiki/Nelson_Mandela" title="Nelson Mandela" data-title="Nelson Mandela" class="nelson_mandela"></a>
                        <a href="https://en.wikipedia.org/wiki/Donald_Trump" title="Donald Trump" data-title="Donald Trump"class="donald_trump"></a>
                        <a href="https://en.wikipedia.org/wiki/George_Washington" title="George Washington" data-title="George Washington" class="george_washington"></a>
                        <a href="https://en.wikipedia.org/wiki/Indira_Gandhi" title="Indira Gandhi" data-title="Indira Gandhi" class="indira_gandhi"></a>
                        <a href="https://en.wikipedia.org/wiki/Xi_Jinping" title="Xi Jinping" data-title="Xi Jinping" class="xi_jinping"></a>
                        <a href="https://en.wikipedia.org/wiki/David_Cameron" title="Davin Cameron" data-title="Davin Cameron" class="davin_cameron"></a>
                    </div>
                    <div class="row uranus-row-4">
                        <a href="https://en.wikipedia.org/wiki/Leon_Trotsky" title="Leon Trotsky" data-title="Leon Trotsky" class="leon_trotsky"></a>
                        <a href="https://en.wikipedia.org/wiki/Lyndon_B._Johnson" title="Lyndon Johnson" data-title="Lyndon Johnson" class="lyndon_johnson"></a>
                        <a href="https://en.wikipedia.org/wiki/Margaret_Thatcher" title="Margaret Thatcher" data-title="Margaret Thatcher" class="margaret_thatcher"></a>
                        <a href="https://en.wikipedia.org/wiki/John_F._Kennedy" title="John Kennedy" data-title="John Kennedy" class="john_kennedy"></a>
                        <a href="https://en.wikipedia.org/wiki/Benito_Mussolini" title="Benito Mussolini" data-title="Benito Mussolini" class="benito_mussolini"></a>
                        <a href="https://en.wikipedia.org/wiki/Nicolás_Maduro" title="Nicolás Maduro" data-title="Nicolás Maduro" class="nicolas_maduro"></a>
                        <a href="https://en.wikipedia.org/wiki/John_McCain" title="John McCain" data-title="John McCain" class="john_mccain"></a>
                        <a href="https://en.wikipedia.org/wiki/Dwight_D._Eisenhower" title="Dwight Eisenhower" data-title="Dwight Eisenhower" class="dwight_eisenhower"></a>
                        <a href="https://en.wikipedia.org/wiki/Saddam_Hussein" title="Saddam Hussein" data-title="Saddam Hussein" class="saddam_hussein"></a>
                    </div>
                    <div class="row uranus-row-5">
                        <a href="https://en.wikipedia.org/wiki/Park_Geun-hye" title="Park Geun-Hye" data-title="Park Geun-Hye" class="park_geun-hye"></a>
                        <a href="https://en.wikipedia.org/wiki/Enrique_Peña_Nieto" title="Enrique Peña Nieto" data-title="Enrique Peña Nieto" class="enrique_peña_nieto"></a>
                        <a href="https://en.wikipedia.org/wiki/Lyndon_B._Johnson" title="Lyndon Johnson" data-title="Lyndon Johnson" class="lyndon_johnson_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Margaret_Thatcher" title="Margaret Thatcher" data-title="Margaret Thatcher" class="margaret_thatcher"></a>
                        <a href="https://en.wikipedia.org/wiki/John_F._Kennedy" title="John Kennedy" data-title="John Kennedy" class="john_kennedy"></a>
                        <a href="https://en.wikipedia.org/wiki/Benito_Mussolini" title="Benito Mussolini" data-title="Benito Mussolini" class="benito_mussolini"></a>
                        <a href="https://en.wikipedia.org/wiki/Nicolás_Maduro" title="Nicolás Maduro" data-title="Nicolás Maduro" class="nicolas_maduro"></a>
                        <a href="https://en.wikipedia.org/wiki/John_McCain" title="John McCain" data-title="John McCain" class="john_mccain"></a>
                        <a href="https://en.wikipedia.org/wiki/Thomas_Jefferson" title="Thomas Jefferson" data-title="Thomas Jefferson" class="thomas_jefferson"></a>
                        <a href="https://en.wikipedia.org/wiki/Saddam_Hussein" title="Saddam Hussein" data-title="Saddam Hussein" class="saddam_hussein"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saturn -->
        <div class="saturn-img slide_13 main-planet">
            {{-- <div class="saturn-shadow "></div> --}}
            <h2 class="planet_name" id="planet_name_saturn">Saturn</h2>
        </div>
    
        <div class="zoom-in-planet img_saturn">
            <div class="planet-buttons">
                <span class="pop-up view-pop-up">View Blogs</span>
                <span class="pop-up back-pop-up">Back</span>
                <span class="pop-up collage-pop-up">Modify Collage</span>
                    <button class="view" onclick="view_my_blogs_tagwise('music',{{Auth::user()->id}})"><img src="{{asset('front/icons/view.png')}}" alt=""></button>
                <button class="back"><img src="{{asset('front/icons/arrow-back.png')}}" alt=""></button>
                <button class="collage" data-tag="music"><img src="{{asset('front/icons/collage-icon-2.png')}}" alt=""></button>
            </div>
            <img src="{{asset('front/images/planets/saturn.png')}}" class="planet-img">
            {{-- <button class="planet-back-button saturn-back btn">Back</button> --}}
            <div class="preview saturn_preview">
                <div class="mover-1">
                    <img src="{{asset('front/images/music_preview.png')}}">
                </div>
                <div class="map">
                    <div class="row saturn-row-1">
                        <a href="https://en.wikipedia.org/wiki/Julio_Iglesias" title="Julio Iglesias" data-title="Julio Iglesias" class="julio_iglesias"></a>
                        <a href="https://en.wikipedia.org/wiki/Domenico_Modugno" title="Domenico Modgno" data-title="Domenico Modgno" class="domenico_modgno"></a>
                        <a href="https://en.wikipedia.org/wiki/Norah_Jones" title="Nora Jones" data-title="Nora Jones" class="nora_jones"></a>
                        <a href="https://en.wikipedia.org/wiki/Nino_Rota" title="Nino Rota" data-title="Nino Rota" class="nino_rota"></a>
                        <a href="https://en.wikipedia.org/wiki/Luciano_Pavarotti" title="Luciano Pavarotti" data-title="Luciano Pavarotti" class="pavarotti"></a>
                        <a href="https://en.wikipedia.org/wiki/Bárbara_Padilla" title="Bárbara Padilla" data-title="Bárbara Padilla" class="barbara_padilla"></a>
                        <a href="https://en.wikipedia.org/wiki/Il_Volo" title="Piero Barone" data-title="Piero Barone" class="tosca_peiro_barone"></a>
                        <a href="https://en.wikipedia.org/wiki/Maurice_Ravel" title="Maurice Ravel" data-title="Maurice Ravel" class="maurice_ravel"></a>
                        <a href="https://en.wikipedia.org/wiki/Montserrat_Caballé" title="Montserrat Caballé" data-title="Montserrat Caballé" class="montserrat_caballe"></a>
                        <a href="https://en.wikipedia.org/wiki/Leonard_Cohen" title="Leonard Cohen" data-title="Leonard Cohen" class="leonard_cogen"></a>
                        <a href="https://en.wikipedia.org/wiki/Neil_Diamond" title="Neil Diamond" data-title="Neil Diamond" class="neil_diamond"></a>
                        <a href="https://en.wikipedia.org/wiki/Adele" title="Adele" data-title="Adele" class="adele"></a>
                        <a href="https://en.wikipedia.org/wiki/Nat_King_Cole" title="Nat King Cole" data-title="Nat King Cole" class="nat_king_cole"></a>
                        <a href="https://en.wikipedia.org/wiki/Lynn_Anderson" title="Lynn Anderson" data-title="Lynn Anderson" class="lynn_anderson"></a>
                        <a href="https://en.wikipedia.org/wiki/Frank_Sinatra" title="Frank Sinantra" data-title="Frank Sinantra" class="frank_sinantra"></a>
                        <a href="https://en.wikipedia.org/wiki/Dionne_Warwick" title="Dionne Warwick" data-title="Dionne Warwick" class="dione_warwick"></a>
                        <a href="https://en.wikipedia.org/wiki/Liam_Clancy" title="Liam Clancy" data-title="Liam Clancy" class="liam_clanzy"></a>
                        <a href="https://en.wikipedia.org/wiki/Claude_Joseph_Rouget_de_Lisle" title="Claude Joseph Rouget de Lisle" data-title="Claude Joseph Rouget de Lisle" class="rouget_de_lisle"></a>
                        <a href="https://en.wikipedia.org/wiki/Peter,_Paul_and_Mary" title="Peter, Paul and Mary" data-title="Peter, Paul and Mary" class="peter_paul_and_mary"></a>
                        <a href="https://en.wikipedia.org/wiki/Roberta_Flack" title="Roberta Flack" data-title="Roberta Flack" class="roberta_flack"></a>
                        <a href="https://en.wikipedia.org/wiki/Shirley_Bassey" title="Shirley Bassey" data-title="Shirley Bassey" class="shirley_bassey"></a>
                        <a href="https://en.wikipedia.org/wiki/Pietro_Mascagni" title="Pietro Mascagni" data-title="Pietro Mascagni" class="pietro_mascagni"></a>
                    </div>
                    <div class="row saturn-row-2">
                        <a href="https://en.wikipedia.org/wiki/Al_Bano_and_Romina_Power" title="Al Bano and Romina Power" data-title="Al Bano and Romina Power" class="al_bano_and_romina_power"></a>
                        <a href="https://en.wikipedia.org/wiki/Ella_Fitzgerald" title="Ella Fitzgerald" data-title="Ella Fitzgerald" class="ella_fitzgerald"></a>
                        <a href="https://en.wikipedia.org/wiki/Giacomo_Puccini" title="Giacomo Puccini" data-title="Giacomo Puccini" class="giacomo_puccini"></a>
                        <a href="https://en.wikipedia.org/wiki/Aretha_Franklin" title="Aretha Franklin" data-title="Aretha Franklin" class="aretha_frabklin"></a>
                        <a href="https://en.wikipedia.org/wiki/Enrico_Caruso" title="Enrico Caruso" data-title="Enrico Caruso" class="enrico_caruso"></a>
                        <a href="https://en.wikipedia.org/wiki/Pablo_Sáinz_Villegas" title="Pablo Sáinz Villegas" data-title="Pablo Sáinz Villegas" class="pablo_sainz_villegas"></a>
                        <a href="https://en.wikipedia.org/wiki/Brenda_Lee" title="Brenda Lee" data-title="Brenda Lee" class="brenda_lee"></a>
                        <a href="https://en.wikipedia.org/wiki/Sharon_Isbin" title="Sharon Isbin" data-title="Sharon Isbin" class="sharon_isbis"></a>
                        <a href="https://en.wikipedia.org/wiki/Noel_Harrison" title="Noel Harrison" data-title="Noel Harrison" class="noel_harrison"></a>
                        <a href="https://en.wikipedia.org/wiki/Don_McLean" title="Don McLean" data-title="Don McLean" class="don_mclean"></a>
                        <a href="https://en.wikipedia.org/wiki/Whitney_Houston" title="Whitney Houston" data-title="Whitney Houston" class="whitney_houston"></a>
                        <a href="https://en.wikipedia.org/wiki/Lucio_Dalla" title="Lucio Dalla" data-title="Lucio Dalla" class="lucio_dalla"></a>
                        <a href="https://en.wikipedia.org/wiki/Laura_Pausini" title="Laura Pausini" data-title="Laura Pausini" class="laura_pausini"></a>
                        <a href="https://en.wikipedia.org/wiki/Amy_Winehouse" title="Amy Winehouse" data-title="Amy Winehouse" class="amy_winehouse"></a>
                        <a href="https://en.wikipedia.org/wiki/Adriano_Celentano" title="Adriano Celentano" data-title="Adriano Celentano" class="adriano_clentano"></a>
                        <a href="https://en.wikipedia.org/wiki/Dionne_Warwick" title="Dionne Warwick" data-title="Dionne Warwick" class="dione_warwick_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Peter_Sarstedt" title="Peter Sarstedt" data-title="Peter Sarstedt" class="peter_sarstedt"></a>
                        <a href="https://en.wikipedia.org/wiki/Charles_Aznavour" title="Charles Aznavour" data-title="Charles Aznavour" class="charles_aznavour"></a>
                        <a href="https://en.wikipedia.org/wiki/Buddy_Holly" title="Buddy Holly" data-title="Buddy Holly" class="buddy_holly"></a>
                        <a href="https://en.wikipedia.org/wiki/Dean_Martin" title="Dean Martin" data-title="Dean Martin" class="dean_martin"></a>
                        <a href="#" title="Marija Agic" data-title="Marija Agic" class="marija_ajic"></a>
                        <a href="https://en.wikipedia.org/wiki/Xuefei_Yang" title="Xuefei Yang" data-title="Xuefei Yang" class="xufei_yang"></a>
                    </div>
                    <div class="row saturn-row-3">
                        <a href="https://en.wikipedia.org/wiki/Vasco_Rossi" title="Vasco Rossi" data-title="Vasco Rossi" class="vasco_rossi"></a>
                        <a href="https://en.wikipedia.org/wiki/Ella_Fitzgerald" title="Ella Fitzgerald" data-title="Ella Fitzgerald" class="ella_fitzgerald_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Aretha_Franklin" title="Aretha Franklin" data-title="Aretha Franklin" class="aretha_frabklin_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Enrico_Caruso" title="Enrico Caruso" data-title="Enrico Caruso" class="enrico_caruso"></a>
                        <a href="https://en.wikipedia.org/wiki/Pablo_Sáinz_Villegas" title="Pablo Sáinz Villegas" data-title="Pablo Sáinz Villegas" class="pablo_sainz_villegas_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Nancy_Sinatra" title="Nancy Sinatra" data-title="Nancy Sinatra" class="nancy_sinatra"></a>
                        <a href="https://en.wikipedia.org/wiki/Frank_Sinatra" title="Frank Nancy" data-title="Frank Sinatra" class="frank_sinatra_2"></a>
                        <a href="https://en.wikipedia.org/wiki/The_Everly_Brothers" title="The Everly Brothers" data-title="The Everly Brothers" class="everly_brothers"></a>
                        <a href="https://en.wikipedia.org/wiki/The_Seekers" title="The Seekers" data-title="The Seekers" class="the_seekers"></a>
                        <a href="https://en.wikipedia.org/wiki/Johnny_Nash" title="Johnny Nash" data-title="Johnny Nash" class="johnny_nash"></a>
                        <a href="https://en.wikipedia.org/wiki/Lucio_Dalla" title="Lucio Dalla" data-title="Lucio Dalla" class="lucio_dalla_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Édith_Piaf" title="Édith Piaf" data-title="Édith Piaf" class="edith_piaf"></a>
                        <a href="https://en.wikipedia.org/wiki/Amy_Winehouse" title="Amy Winehouse" data-title="Amy Winehouse" class="amy_winehouse_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Albert_Hammond" title="Albert Hammond" data-title="Albert Hammond" class="albert_hammond"></a>
                        <a href="https://en.wikipedia.org/wiki/Rod_Stewart" title="Rod Stewart" data-title="Rod Stewart" class="rod_stewart"></a>
                        <a href="https://en.wikipedia.org/wiki/Cilla_Black" title="Cilla Black" data-title="Cilla Black" class="cilla_black"></a>
                        <a href="https://en.wikipedia.org/wiki/Buddy_Holly" title="Buddy Holly" data-title="Buddy Holly" class="buddy_holly_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Dean_Martin" title="Dean Martin" data-title="Dean Martin" class="dean_martin_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Mick_Hucknall" title="Mick Hucknall" data-title="Mick Hucknall" class="simply_red"></a>
                        <a href="https://en.wikipedia.org/wiki/Petula_Clark" title="Petula Clark" data-title="Petula Clark" class="petula_clark"></a>
                    </div>
                    <div class="row saturn-row-4">
                        <a href="https://en.wikipedia.org/wiki/Wolfgang_Amadeus_Mozart" title="Wolfgang Amadeus Mozart" data-title="Wolfgang Amadeus Mozart" class="wolfgang_amadeus"></a>
                        <a href="https://en.wikipedia.org/wiki/Elvis_Presley" title="Elvis Presley" data-title="Elvis Presley" class="elvis_prisley"></a>
                        <a href="https://en.wikipedia.org/wiki/Dalla/Morandi" title="Gianii Morandi and Lucio Dalla" data-title="Gianii Morandi and Lucio Dalla" class="giovanii_lucio"></a>
                        <a href="https://en.wikipedia.org/wiki/Willie_Nelson" title="Willie Nelson" data-title="Willie Nelson" class="willie_nelson"></a>
                        <a href="https://en.wikipedia.org/wiki/Louis_Armstrong" title="Louis Armstrong" data-title="Louis Armstrong" class="louis_armstrong"></a>
                        <a href="https://en.wikipedia.org/wiki/Bob_Marley" title="Bob Marley" data-title="Bob Marley" class="bob_marley"></a>
                        <a href="https://en.wikipedia.org/wiki/Nancy_Sinatra" title="Nancy Sinatra" data-title="Nancy Sinatra" class="nancy_sinatra_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Frank_Sinatra" title="Frank Nancy" data-title="Frank Sinatra" class="frank_sinatra_3"></a>
                        <a href="https://en.wikipedia.org/wiki/The_Everly_Brothers" title="The Everly Brothers" data-title="The Everly Brothers" class="everly_brothers"></a>
                        <a href="https://en.wikipedia.org/wiki/The_Seekers" title="The Seekers" data-title="The Seekers" class="the_seekers"></a>
                        <a href="https://en.wikipedia.org/wiki/Johnny_Nash" title="Johnny Nash" data-title="Johnny Nash" class="johnny_nash"></a>
                        <a href="https://en.wikipedia.org/wiki/Stevie_Wonder" title="Stevie Wonder" data-title="Stevie Wonder" class="stevie_wonder"></a>
                        <a href="https://en.wikipedia.org/wiki/Bobby_Goldsboro" title="Bobby Goldsboro" data-title="Bobby Goldsboro" class="bobby_goldsboro"></a>
                        <a href="https://en.wikipedia.org/wiki/Gipsy_Kings" title="Gipsy Kings" data-title="Gipsy Kings" class="gipsy_king"></a>
                        <a href="https://en.wikipedia.org/wiki/Mina_(Italian_singer)" title="Mina" data-title="Mina" class="mina_italy"></a>
                        <a href="https://en.wikipedia.org/wiki/Rod_Stewart" title="Rod Stewart" data-title="Rod Stewart" class="rod_stewart_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Judy_Collins" title="Judy Collins" data-title="Judy Collins" class="judy_collins"></a>
                        <a href="https://en.wikipedia.org/wiki/Paco_de_Lucía" title="Paco de Lucía" data-title="Paco de Lucía" class="paco_de_lucia"></a>
                        <a href="https://en.wikipedia.org/wiki/Tazenda" title="Tazenda" data-title="Tazenda" class="tazenda"></a>
                        <a href="https://en.wikipedia.org/wiki/David_Bowie" title="David Bowie" data-title="David Bowie" class="david_bowie"></a>
                    </div>
                    <div class="row saturn-row-5">
                        <a href="https://en.wikipedia.org/wiki/Wolfgang_Amadeus_Mozart" title="Wolfgang Amadeus Mozart" data-title="Wolfgang Amadeus Mozart" class="wolfgang_amadeus"></a>
                        <a href="https://en.wikipedia.org/wiki/Elvis_Presley" title="Elvis Presley" data-title="Elvis Presley" class="elvis_prisley"></a>
                        <a href="https://en.wikipedia.org/wiki/Dalla/Morandi" title="Gianii Morandi and Lucio Dalla" data-title="Gianii Morandi and Lucio Dalla" class="giovanii_lucio"></a>
                        <a href="https://en.wikipedia.org/wiki/Willie_Nelson" title="Willie Nelson" data-title="Willie Nelson" class="willie_nelson"></a>
                        <a href="https://en.wikipedia.org/wiki/Louis_Armstrong" title="Louis Armstrong" data-title="Louis Armstrong" class="louis_armstrong"></a>
                        <a href="https://en.wikipedia.org/wiki/Bob_Marley" title="Bob Marley" data-title="Bob Marley" class="bob_marley"></a>
                        <a href="https://en.wikipedia.org/wiki/Dusty_Springfield" title="Dusty Springfiled" data-title="Dusty Springfiled" class="dusty_springfiled"></a>
                        <a href="https://en.wikipedia.org/wiki/Johnny_Cash" title="Johnny Cash" data-title="Johnny Cash" class="johnny_cash"></a>
                        <a href="https://en.wikipedia.org/wiki/Luz_Casal" title="Luz Casal" data-title="Luz Casal" class="luz_casal"></a>
                        <a href="https://en.wikipedia.org/wiki/Robin_Gibb" title="Robin Gibb" data-title="Robin Gibb" class="robin_gibb"></a>
                        <a href="https://en.wikipedia.org/wiki/B._J._Thomas" title="BJ Thomas" data-title="BJ Thomas" class="bj_thomas"></a>
                        <a href="https://en.wikipedia.org/wiki/Simon_%26_Garfunkel" title="Simon & Garfunkel" data-title="Simon & Garfunkel" class="simon_and_garfunkel"></a>
                        <a href="https://en.wikipedia.org/wiki/Pet_Shop_Boys" title="Pet Shop Boys" data-title="Pet Shop Boys" class="pet_shop_boys"></a>
                        <a href="https://en.wikipedia.org/wiki/Gipsy_Kings" title="Gipsy Kings" data-title="Gipsy Kings" class="gipsy_king_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Sonny_%26_Cher" title="Sonny & Cher" data-title="Sonny & Cher" class="sonny_and_cher"></a>
                        <a href="https://en.wikipedia.org/wiki/Mina_(Italian_singer)" title="Mina" data-title="Mina" class="mina_italy"></a>
                        <a href="https://en.wikipedia.org/wiki/The_Mamas_and_the_Papas" title="The Mamas and the Papas" data-title="The Mamas and the Papas" class="mamas_and_papas"></a>
                        <a href="https://en.wikipedia.org/wiki/Judy_Collins" title="Judy Collins" data-title="Judy Collins" class="judy_collins_2"></a>
                        <a href="https://en.wikipedia.org/wiki/Paco_de_Lucía" title="Paco de Lucía" data-title="Paco de Lucía" class="paco_de_lucia"></a>
                        <a href="https://en.wikipedia.org/wiki/Tazenda" title="Tazenda" data-title="Tazenda" class="tazenda"></a>
                        <a href="https://en.wikipedia.org/wiki/David_Bowie" title="David Bowie" data-title="David Bowie" class="david_bowie"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Rocket -->
        <div class="logout-area">
            <a href="{{ url('/logout') }}">
            <div class="rocket">
                <div class="rocket-body">
                    <h2 class="animated">LOGOUT</h2>
                <div class="fin-top"></div>
                <div class="fin-bottom"></div>
                <div class="faya"></div>
                <div class="wastes">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Animated Black Hole -->
        {{-- <a href="{{url('/')}}" class="back-to-homepage">
            <div class="dashboard-exit">
                <img src="{{asset('front/images/whirlpool-5.png')}}" alt="">
            </div>
            <h2 class="planet_name" id="back-to-homepage">Back to Homepage</h2>
        </a> --}}
    </div>

    <!--astronaut img div-->
    <div  class="astronaut-img-div navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif" id="draggable" class="ui-widget-content slide_10"> 
        <h2 class="planet_name" id="edit-photo">Edit Photo</h2>

        @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
            <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/thomasina-navigator.png') }}" alt=""
            class="astronaut-body">
            <div class="tos-div thomasina">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @else
            <img class="astronaut-img {{access()->user()->getGender()}}" src="{{ asset('front/images/astronut/tom-navigator.png') }}" alt=""
            class="astronaut-body">
            <div class="tos-div">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @endif

        <a href="{{url('profile/edit-photo')}}" class="profilepicture">
            <img  id="user-photo" class="{{access()->user()->getGender()}}" src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
        </a> 

        <button class="navigator-zoom navigator-zoomin tooltips zoom-in-out">
            <span>Zoom In</span>
            <i class="fas fa-search-plus"></i>
        </button>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
                <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
            </div>
        </div>
        <div class="instructions-div">
            <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
        </div>
        <div class="communicator-div tooltips right">
            <span>Communicator</span>
            <button class="communicator-button"></button>
        </div>
        <div class="notifications-div">
            <div class="notifications-list">
                <ul>
                    <li><a href="#">Grace <img src="{{asset('front/icons/naffPicked.png')}}" alt="" class="naff"> your blog Lorem Ipsum is simply dummy text .</a></li>
                    <li><a href="#">Ali <img src="{{asset('front/icons/cool300.png')}}" alt=""> your blog.</a></li>
                    <li><a href="#">Abdul <img src="{{asset('front/icons/hotNew.png')}}" alt=""> your blog.</a></li>
                    <li><a href="#">Vishnu <img src="{{asset('front/icons/commentsNew.png')}}" alt="" class="comment"> your blog Lorem Ipsum is simply dummy text .</a></li>
                    <li><a href="#">Juliet <img src="{{asset('front/icons/hotNew.png')}}" alt=""> your blog.</a></li>
                </ul>
            </div>
            <button class="earth-holo tooltips top">
                <span>View Notifications</span>
                <p class="notifications-count">23</p>
                <img src="{{asset('front/images/notification-hologram/earthHolo.png')}}" alt="">
            </button>
            <img src="{{asset('front/images/notification-hologram/hologram.png')}}" alt="" class="hologram">
        </div>
        <button class="navigator-zoomout-btn tooltips zoom-in-out">
            <span>Zoom Out</span>
            <i class="fas fa-undo-alt"></i>
        </button>
    </div>
    <div class="app" style="display: none;">
        <commentnotification-component :user="{{ Auth::user() }}"></commentnotification-component>
    </div>
    <!--end of astronaut img div-->
</div>
@endsection

@section('before-scripts')
    <script src="{{asset('front/JS/jquery-1.11.1.min.js')}}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var url_view_general_blog = '{{ route('frontend.blog_general_my') }}';
        var url_view_tag_wise_blog = '{{ route('frontend.blog_tagwise_my') }}';
        var url_view_my_career_blog = '{{ route('frontend.blog_career_my') }}';
    </script>
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('front/JS/TweenMax.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/JS/jquery.ui.touch-punch.min.js')}}"></script>
    {{-- <script src="{{asset('front/JS/draggabilly.min.js')}}"></script> --}}
    <script src="{{asset('front/JS/cropper.min.js')}}"></script>
    <script src="{{asset('front/JS/circletype.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-migrate-1.2.1.min.js')}}"></script>
    
    <script src="{{asset('front/JS/jquery.mobile-1.4.5.min.js')}}"></script>
    <script src="{{asset('front/JS/dashboard.js')}}"></script>
@endsection
