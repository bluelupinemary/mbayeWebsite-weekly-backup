@php
    use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel AdminPanel')">
        <meta name="author" content="@yield('meta_author', 'Viral Solani')">
        <meta name="keywords" content="@yield('meta_keywords', 'Laravel AdminPanel')">
        
        <style>
           @font-face {
                font-family: 'Nasalization Rg';
                src: url('fonts/NasalizationRg-Regular.woff2') format('woff2'),
                    url('fonts/NasalizationRg-Regular.woff') format('woff'),
                    url('fonts/NasalizationRg-Regular.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: 'Courgette-Regular';
                src: url('fonts/Courgette-Regular.woff2') format('woff2'),
                    url('fonts/Courgette-Regular.woff') format('woff'),
                    url('fonts/Courgette.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'GiddyupStd';
                src: url('fonts/GiddyupStd.woff2') format('woff2'),
                    url('fonts/GiddyupStd.woff') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'Cambria';
                src: url('fonts/Cambria.woff2') format('woff2'),
                    url('fonts/Cambria.woff') format('woff');
                font-weight: normal;
                font-style: normal;
            }
        </style>
        <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
        
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{-- @langrtl
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else --}}
            {{-- {{ Html::style(mix('css/frontend.css')) }} --}}
            {{-- {{ Html::style(mix('css/frontend-custom.css')) }} --}}
       {{--  @endlangrtl --}}
        @yield('after-styles')

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <?php
            if (!empty($google_analytics)) {
                echo $google_analytics;
            }
        ?>
    </head>
    <body>
        
        @yield('content')
        <!-- Scripts -->
        @yield('before-scripts')
        <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
        <script src="{{asset('front')}}/babylonjs/babylon.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylon.inspector.bundle.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylonjs.loaders.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylonjs.materials.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylonjs.postProcess.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylonjs.proceduralTextures.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylonjs.serializers.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/Oimo.js"></script>
        <script src="{{asset('front')}}/babylonjs/babylon.gui.min.js"></script> 
        <script src="{{asset('front')}}/babylonjs/jquery.min.js"></script>
        <script src="{{asset('front')}}/babylonjs/scenes/generalJS.js"></script>
        <script src="https://www.youtube.com/iframe_api"></script>
        
      

        @yield('after-scripts')
        
        
        {{ Html::script('js/jquerysession.min.js') }}
        {{ Html::script('js/frontend/frontend.min.js') }}
        {!! Html::script('js/select2/select2.min.js') !!}

        <script type="text/javascript">
            if("{{Route::currentRouteName()}}" !== "frontend.user.account")
            {
                $.session.clear();
            }
        </script>
        
       
        
        @include('includes.partials.ga')
    </body>
</html>



