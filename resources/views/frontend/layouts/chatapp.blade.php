<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'ChatApp') }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    
  
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{asset('front/CSS/chat/perfect-scrollbar.min.css')}}" >
	<link rel="stylesheet" href="{{asset('front/CSS/chat/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('front/CSS/chat/emoji.css')}}">
	<link rel="stylesheet" href="{{asset('front/CSS/chat/style.css')}}" >
    <link rel="stylesheet" href="{{asset('front/CSS/chat/responsive.css')}}" >
    <script src="{{ asset('front/JS/chat/jquery3.3.1.js') }}"></script>
	{{-- <script src="{{ asset('js/vendor/jquery-slim.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/vendor/popper.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
	<script src="{{ asset('front/JS/chat/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('front/JS/chat/script.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- {{ Html::style(mix('css/frontend-custom.css')) }}
    {!! Html::script(mix('js/frontend.js')) !!}
            {{ Html::script('js/jquerysession.min.js') }} --}}
            {{-- {{ Html::script('js/frontend/frontend.min.js') }} --}}
            {!! Html::script('js/select2/select2.min.js') !!}
            {{-- @include('includes.partials.ga') --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.auth.login ') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('frontend.auth.logout ') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- <main class="py-4"> --}}
            @yield('content')
        {{-- </main> --}}
    </div>
</body>
</html>
