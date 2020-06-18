@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <div class="app">
        <friends-component :auth="{{ Auth::user() }}"></friends-component>
    </div>
    {{-- <h1>Users</h1>
    <form action="/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                placeholder="Search users"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="fa fa-search"></span>
                </button>
            </span>
        </div>
    </form>
    <div class="app">
    </div>
    @if($users != Null)
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
                <td><friend-component :user_id="{!! json_encode($user->id) !!}"></friend-component></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No friends</p>
    @endif --}}

</div>
@endsection

