@extends('layouts.app')
@section('content')
<div class="container">
  <div class="app">
    <friendrequests-component></friendrequests-component>
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

