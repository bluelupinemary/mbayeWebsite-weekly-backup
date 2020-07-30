@extends('frontend.layouts.app')

@section('after-styles')
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
			width: 25vw !important;
			height: 25vw !important;
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
    <script>
    //   blackhole('#blackhole');
    </script>
@endsection

