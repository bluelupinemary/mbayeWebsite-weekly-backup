 @extends('frontend.layouts.app')
    <meta name="url" content="{{ url('') }}">
 @section('meta')
    <title>@yield('title', 'Mbaye - Story Of Care, Who Care Wins')</title>

    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'Participate in Mbaye World .Show your story of care and get a chance to have your design be chosen for Mbaye, the lioness stainless steel structure.')">
    <meta name="author" content="@yield('meta_author', 'Inox Arabia')">
    <meta name="keywords" content="@yield('meta_keywords', 'Design panels, Participate, Creativity, Stainless Steel, Dubai, Care, lioness, blogs, stories')">   
    <meta property="og:image" content="{{ asset('front/icons/alert-icon.png') }}">
    <meta property="og:description" content="Participate in Mbaye World .Show your story of care and get a chance to have your design be chosen for Mbaye, the lioness stainless steel structure">
    <meta property="og:url" content="{{ url('') }}">
    <meta property="og:title" content="Mbaye - Story Of Care, Who Care Wins">
    <meta name="twitter:card" content="{{ asset('front/icons/alert-icon.png') }}">
    <meta property="og:type" content="website" /> <meta property="og:image:width" content="720" />
    <meta property="og:image:height" content="720" /> 
    @endsection
@section('after-styles')
    <link rel="preload" as="font" href="{{asset('fonts/nasalization-rg.ttf')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="{{asset('fonts/Courgette.ttf')}}" type="font/woff2" crossorigin="anonymous">  
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('front/CSS/blog_style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/CSS/storyofcare.css') }}">
@endsection

@section('content')
<div id="page-content">
    <div class="app">
        <!-- For nouvela animation -->
        <div class="naff-fart-reaction">
            <img src="{{asset('front/images/naff555Votes.png')}}" alt="naff fart">
        </div>

        <story-of-care-component @if(Auth::user()) :user="{{Auth::user()}}" @endif :user_id="0"></story-of-care-component>

        <!-- For  notes --->
        <!--cdefgab-->
    
        <div class="audio-div">
            <!--fart -->
            <audio id="fart-audio" src="{{ asset('front/audio/fart/fart.mp3') }}" ></audio>
        </div>      
            <!--   <button class="zoom-btn zoom-out"><i class="fas fa-search-minus"></i></button>-->
        <musiclist-component></musiclist-component>
    </div>   
</div>
@endsection

@section('after-scripts') 
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/hammer.min.js')}}"></script>
    <script src="{{asset('front/JS/blogview.js')}}"></script>
@endsection
