@extends('frontend.layouts.app')

@section('after-styles')
	<link rel="stylesheet" href="{{asset('front/CSS/search-friends.css')}}">
	<style>
		#search-friends {
			z-index: 1;
		}

		#search-friends {
			height: 9.2vw;
		}

		.add-friend-icon {
			background: #3cb878;
			right: 0;
			top: 1%;
			left: 50%;
			transform: translate(-50%, 0);
		}
	</style>
@endsection

@section('content')
<div class="container">
	<div class="app">
		<accept-component :auth="{{ Auth::user() }}" ></accept-component>
	</div>
    {{-- <h1>Friend Requests</h1>
    <div class="app">
    </div>
    @if(isset($users))
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><accept-component :user_id="{!! json_encode($user->id) !!}"></accept-component></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No Friend requests </p>
    @endif --}}
</div>
@endsection

