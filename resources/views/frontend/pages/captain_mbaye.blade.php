@extends('frontend.layouts.game_layout')
@section('before-styles')
    <link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
    <link rel="preload" as="font" href="{{asset('fonts/Courgette-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="{{asset('fonts/NasalizationRg-Regular.woff')}}" type="font/woff2" crossorigin="anonymous">
    
@endsection

@section('content')
    <div>
        <canvas id="canvas"></canvas>
    </div>
   
    <div id="loadingScreenDiv" style="">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>

    <div id="wikipediaDiv">
        <div class="iframe-loading" id="iframe-loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <div id="wikiHeader" style="">
            <div id="page-url" style=""></div> 
            <div id="wikiButtons" style="">
                <img id="fullscreen-btn" src="front/images3D/fullscreen-btn.png" data-toggle="tooltip" title="Fullscreen" align="right" onclick="fullscreenDescDiv()" style=""/> 
                <img id="close-btn" src="front/images3D/close-btn.png"  data-toggle="tooltip" title="Close" align="right" onclick="hidePage()" style=""/>
            </div> 
        </div>
        <div id="inOurEyesDiv" style="position:relative;width:100%;height:95%;overflow-y:scroll;display:none;">
            <span style="font-size:4.5vw;">MBAYE</span><br/>
            <span style="font-size:3.5vw;">Captain Mbaye Diagne</span>
            <br/><br/><br/>
            For us, he was and will always remain a beautiful example
            <br/>
            of  how humans should be.<br/><br/>
            He gave his life caring for others different to himself.<br/><br/>
            We may ask, “why were they different to himself”.<br/><br/>
            Here exists the issue - members of planet earth need to confront.<br/><br/>
            If we look at our galaxy where we have left Mbaye the lioness <br/>
            for you to place, <br/>
            we may refer to this galaxy as heaven or paradise. <br/><br/>
            Yet if rather than looking up to it from planet earth, <br/>
            we look at it from outside of our own atmosphere <br/>
            away from our own planet,<br/>
            from high up in the everlasting wilderness, <br/>
            or from the orbits outside of our galaxy, down into our galaxy. <br/>
            Then we may see that the most beautiful, <br/>
            heavenly place in all the galaxies, <br/>
            is actually where you are living, <br/>
            on planet earth.<br/><br/>
            Nowhere up there is more beautiful than your planet earth, <br/>
            with all its diversity of <br/>
            mountains, rivers, oceans, species of flora, animals, fish <br/>
            or humans.<br/><br/>
            It is the diversity that is beautiful.<br/><br/>
            <span style="font-size:3vw;">So may we ask why are you looking up at Heaven.</span><br/><br/>
            Heaven is where you are unless yourselves are turning it into Hell, <br/>
            which many do.<br/><br/>
            During the Rwanda massacre of 800,000 people <br/>
            in 100 days of tribal conflict.<br/>
            Millions were turning Heaven into Hell, <br/>
            as is happening all over that planet earth. <br/><br/>
            People fighting each other because they see <br/>
            each other as different.<br/>
            Politicians and ordinary ignorant men and sometimes women <br/>
            seeking and scheming to gain from a power of <br/>
            dividing one from another. <br/><br/>

            Amongst this Hell created by a perceived diversity of <br/>
            one man or tribe against the other, <br/>
            moved a man diverse from both sides of the <br/>
            Hutu-people who farmed crops,<br/>
            Tutsis- people who tended livestock <br/>
            divide. <br/><br/>

            A man there to administer the peace in name of the United Nations. <br/><br/>

            Can we read this name again “United Nations”. <br/>
            Nations United.<br/><br/>
            
            Yet <br/>
            they are not united and those directing these nations are not uniting <br/>
            but again dividing into categories of superiority.<br/>
            We all can see who wish to be regarded as the Superior Race<br/>
            of these nations <br/>
            within that very organization of United Nations.<br/><br/>

            Yet that very same race or nation <br/>
            is divided and separated into their classifications of <br/>
            religion, political allegiances, origin of the forefathers.<br/>
            Color or skin tone.<br/><br/>

            They are all divided to a point that they proclaim that, <br/>
            they as a nation or a gang or a race <br/>
            should be first in front of all others who inhabit <br/>
            that planet earth. <br/><br/>

            Should these people of this thought go <br/>
            and populate one of the other planets <br/>
            and leave this planet to all the diverse - loving inhabitants <br/>
            of planet earth<span style="font-size:3.5vw">?</span> <br/><br/>
            There in the luscious fields of Africa was a man <br/>
            not of that self-regarded superior race. <br/><br/>

            He never saw any superiority in himself <br/>
            or his colour or nation. <br/><br/>

            Under the United Nations, <br/>
            he was representing all races, <br/>
            with allegedly no discrimination.<br/><br/>

            Although he may be of the same or similar colour or continent <br/>
            as those in Rwanda.<br/><br/>

            He was from far away, <br/>
            from the coastal country of Senegal <br/>
            in West Africa, <br/>
            thousands of miles from Rwanda.<br/><br/>

            He was a muslim and they christian. <br/>
            He could have behaved as wrongly as <br/>
            many others who permitted or assisted such a massacre.<br/>
            Those people in Rwanda were hating each other <br/>
            from the same country because <br/>
            one gang or tribe farmed crops and the others reared livestock. <br/><br/>

            As ridiculous as Republicans hating Democrats<br/>
            or vice versa <br/>
            or Shia hating Sunni again vice versa <br/>
            or Protestants hating Catholics <br/>
            or vice versa.<br/><br/>

            Yet here was a man risking his life for those living <br/>
            in the ignorance of hate.<br/><br/>

            We see the same all over the world <br/>
            of people hating someone from <br/>
            one city or village not far from their own village.<br/><br/>
            We see clans or gangs of one type hating another <br/>
            because of a difference of colour or religion <br/>
            or political or other allegiance.<br/><br/>

            But here’s a man, just a good man <br/>
            and not a member of any elitist nation or race. <br/><br/>

            A man with the same coloured blood <br/>
            as that of all the Royal Families of Europe, and the world; <br/>
            behaving as just a good man should. <br/><br/>

            No matter who this man went to save, <br/>
            any man of any elitist nation <br/>
            or gang or clan would have accepted his help when they needed it. <br/><br/>
            So why not accept him as your equally rightful inhabitant <br/>
            of any piece of land <br/>
            on that planet of yours, <br/>
            Earth.<br/><br/>

            Only in your own soul, if full of garbage,<br/>
            can you refuse any man to stand as your equal inhabitant <br/>
            if you are prepared to accept his help <br/>
            in times of difficulty. <br/><br/>

            In such times of massacres or other difficulties, <br/>
            what Sunni would deny the help offered by a Shia? <br/>
            or Republican refuse help from a Democrat?<br/>
            or Catholic from a Protestant<br/>
            or vice versa in all examples?<br/><br/>

            It is these souls full of garbage, <br/>
            that are hating all diversity of your planet.<br/><br/>
            
            They are so full of this garbage <br/>
            they have no space for love and care <br/>
            of any diversity.<br/><br/>

            Hunting and killing other species <br/>
            and even your own species for the sport, <br/>
            trophy or fashion of it.<br/><br/>

            Discarding your trash so it flows in torrents of rivers <br/>
            into your oceans, <br/>
            for it to be consumed by other wildlife <br/>
            and inhabitants of your planet.<br/><br/>

            Your lack of care and consideration <br/>
            shows no boundaries in the search of <br/>
            instant satisfaction and gratification.<br/>
            
            The care given by Mbaye Diagne <br/>
            is the unquestionable care <br/>
            we all need to give to each other and to all our environment.<br/><br/>

            You may need motor transport <br/>
            but do you need it before others can eat food?<br/><br/>

            You may need the luxuries of homes <br/>
            but do you need them while others <br/>
            suffer the consequences of your vices?<br/><br/>

            You may need peace, sleep and relaxation <br/>
            but should that come before others<br/>
            drink the water that falls from the skies for all?<br/><br/>
            Each drop does not have a name or nationality engraved upon it.<br/><br/>

            You are all different, everyone. <br/><br/>

            Some are black, some are brown, <br/>
            and some are yellowish. <br/><br/>

            Some are born pink turn white, <br/>
            go blue when cold, green when sick, <br/>
            red in the sun, grey when they die <br/>
            and refer to others as coloured <br/>
            in discrimination. <br/><br/>

            Though who has more colours.<br/><br/>

            Do you accept to be discriminated against <br/>
            when you change from <br/>
            white to pink or white to blue <br/>
            or white to green or even yellow to <br/>
            any other colour? <br/><br/>

            The discrimination of one man to another is <br/>
            only pure ignorance and stupidity.  <br/><br/>

            We state it clear for all our young ones to <br/>
            rebel against the elders who promote such discrimination. <br/>
            And for all those elders to be educated <br/>
            before they vacate that beautiful planet earth.<br/><br/>

            Every time your termed “far right nationalism”, <br/>
            or any other extremist nationalism or villageism, <br/>
            raises its voice, <br/>
            it is just a simple cry of, <br/><br/>

            “I’m ignorant and stupid <br/>
            and so I will hate all others who are not <br/>
            ignorant and stupid as I am. <br/><br/>

            I have no space in my soul full of garbage to accept any diversity. <br/><br/>

            I cannot see how beautiful the diversity of planet earth is”.<br/><br/>
            The happenings in Rwanda <br/>
            and our choosing to name this monument <br/>
            of a loving mother after a man from Africa <br/>
            is an example that the hate of certain <br/>
            ignorant, stupid, self-proclaimed, superior pinky - white, <br/>
            blue - green class of ignorance <br/>
            is not confined only to that colour or race of humans <br/>
            and their inhumanity.<br/><br/>

            It is testimony that it exists amongst all of mankind <br/>
            and not of any <br/>
            other species on planet earth!<br/><br/>

            Hence, all of mankind from the whites of one sector <br/>
            or continent to <br/>
            those of different colours of skin <br/>
            the very same lesson applies.<br/>
            Hate or discrimination because of diversity is a cry of <br/>
            “I’m ignorant and stupid <br/>
            and cannot understand how lucky I am<br/>
            of all this planet’s diversity!”<br/><br/>

            Maybe they should occupy one of the other planets full of rocks, <br/>
            not this beautiful planet earth.<br/><br/>

            Remember the day you ever need any assistance or help in life, <br/>
            the person who will give it will be diverse.<br/><br/>
            He will be taller, shorter, fatter, thinner, <br/>
            bigger ears or bigger nose, <br/>
            in some way he will be different. <br/><br/>

            So get over all the differences and accept that all are different. <br/><br/>

            Then your days will be so much happier and peaceful <br/>
            because you can benefit from the care that all those <br/>
            different from you can give, <br/>
            rather than their hate just because <br/>
            you are different.<br/><br/>

            Now this maybe hard to accept but if your human minds are only looking into a box <br/>
            then all you will see is grey to black.<br/><br/>

            If you look out of your box to all of your planet earth, <br/>
            you will see the <br/>
            beautiful diversity of it.<br/>
            Young people,please travel from your box of your home, <br/>
            village, city or country borders to other lands. <br/><br/>

            Meet diverse people. <br/>
            Love them. Marry them. <br/>
            Have children with them; <br/>
            and have your families embrace <br/>
            the diversity of your new family. <br/><br/>

            Be like Mbaye and care for all those others different to you<br/>
            and <br/>
            then they may care also for you.<br/><br/>

            L. Loraine. <br/>
            From up here, where someone’s like me.<br/><br/><br/>
 

        </div>
        <iframe id="wikiPage" src="" frameBorder="0"></iframe>
       
    </div>
    
    

    <div id="loadingScreenOverlay" >
        <div id="overlayText">Please click anywhere to play the game</div>
    </div>
   
    <div id="loadingScreenPercent" style="padding-top: 2%;">
        Loading: 0 %
    </div>
    <div id="block_land">
        <div class="content">
            <h1 class="text-glow">Turn your device in landscape mode.</h1>
            <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
        </div>
    </div>

    <div id="fullscreenIcon">
        <img id="fullscreenImg" src="{{asset('front')}}/images3D/fullscreen-btn.png" alt="fullscreen-img" >
    </div>

   
@endsection

@section('after-scripts')
    

    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front')}}/babylonjs/scenes/captMbaye/captMbayeScene.js"></script>
   

@endsection
