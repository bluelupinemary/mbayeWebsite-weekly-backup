@php
    use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
        <link rel="stylesheet" href="{{ asset('front/CSS/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('front/CSS/navbar-component.css') }}">
        {{-- @if(!Request::is('login')) --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- @endif --}}
        <meta name="user_id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
        <title>@yield('title', app_name())</title>

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
          
            ]); ?>
        </script>
        <?php
            if (!empty($google_analytics)) {
                echo $google_analytics;
            }
        ?>
    </head>
    <body>
        <!-- Auto Landscape -->
        <div id="block_land">
            <div class="content">
                <h1 class="text-glow">Turn your device in landscape mode.</h1>
                <img src="{{asset('front/images/rotate-screen.gif')}}" alt="">
            </div>
        </div>


        @yield('content')
        <!-- Scripts -->

                
        @yield('before-scripts')
        {!! Html::script(mix('js/frontend.js')) !!}
        <script src="{{asset('front/JS/Draggable.min.js')}}"></script>
        <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
        <script src="{{asset('front/JS/jquery-ui.js')}}"></script>

        @yield('after-scripts')
        {{ Html::script('js/jquerysession.min.js') }}
        {{ Html::script('js/frontend/frontend.min.js') }}
        {!! Html::script('js/select2/select2.min.js') !!}
        
        <script src="{{asset('front/JS/modernizr.custom.js')}}"></script>
        <script src="{{asset('front/JS/jquery.dlmenu.js')}}"></script>
        
        <script type="text/javascript">
            if("{{Route::currentRouteName()}}" !== "frontend.user.account")
            {
                $.session.clear();
            }
        </script>
        
    
        @include('includes.partials.ga')

    </body>
    <script>
	    $(function() {
		$( '#navbar-dl-menu' ).dlmenu();
	    });
    </script>
</html>