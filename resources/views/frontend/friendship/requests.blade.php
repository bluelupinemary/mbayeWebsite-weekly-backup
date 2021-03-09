@extends('frontend.layouts.app')

@section('after-styles')
	<meta name="url" content="{{ url('') }}">
	<link rel="stylesheet" href="{{asset('front/CSS/search-friends.css')}}">
	<link rel="stylesheet" href="{{asset('front/CSS/blackhole.css')}}">
	<style>
		#search-friends {
			z-index: 1;
		}

		#search-friends {
			height: 9.2vw;
		}

		.friends.zoom-in {
			width: 29vw !important;
			height: 29vw !important;
		}

		.add-friend-icon {
			background: #3cb878;
			right: 0;
			top: 1%;
			left: 50%;
			transform: translate(-50%, 0);
		}
		
		.arrow-left {
			/* transform: scaleX(1); */
		}

		.no_of_earthlings {
			margin-bottom: 3%;
		}
	</style>
@endsection

@section('content')
<div class="container">
	<div class="app">
		<accept-component :auth="{{ Auth::user() }}" ></accept-component>
	</div>
</div>
@endsection

@section('before-scripts')
	<script src="{{asset('front/JS/blackhole.js')}}"></script>
	<script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script>
    //   blackhole('#blackhole');
    </script>
@endsection

