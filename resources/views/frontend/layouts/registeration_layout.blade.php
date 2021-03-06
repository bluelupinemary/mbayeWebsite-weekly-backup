@php
    use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        
        <meta name="user_id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
        
        <link rel="stylesheet" href="{{ asset('front/CSS/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('front/CSS/navbar-component.css') }}">
        <title>@yield('title', app_name())</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel AdminPanel')">
        <meta name="author" content="@yield('meta_author', 'Viral Solani')">
        <meta name="keywords" content="@yield('meta_keywords', 'Laravel AdminPanel')">
        <meta name="url" content="{{ url('') }}">
        <script type="text/javascript">
           var base_url = {!! json_encode(url('/')) !!}
       </script>
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
        

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{-- @langrtl
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else --}}
            {{-- {{ Html::style(mix('css/frontend.css')) }} --}}
            {{ Html::style(mix('css/frontend-custom.css')) }}
       {{--  @endlangrtl --}}
        @yield('after-styles')
        @include('frontend.layouts.includes.navbar')
       
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                'coolcount' => '',
                'hotcount' => '',
                'naffcount' => '',
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
            {!! Html::script(mix('js/frontend.js')) !!}
            @yield('after-scripts')
            {{ Html::script('js/jquerysession.min.js') }}
            {{ Html::script('js/frontend/frontend.min.js') }}
            {!! Html::script('js/select2/select2.min.js') !!}

            <script src="{{asset('front/JS/modernizr.custom.js')}}"></script>
            <script src="{{asset('front/JS/jquery.dlmenu.js')}}"></script>

            <script>
	        $(function() {
		    $( '#navbar-dl-menu' ).dlmenu();
	        });
        </script>
            @include('includes.partials.ga')

    </body>
</html>