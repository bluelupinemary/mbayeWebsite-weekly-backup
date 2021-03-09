@extends('frontend.layouts.app')

@section('after-styles')
    <meta name="url" content="{{ url('') }}">
    <link rel="stylesheet" href="{{asset('front/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/search-friends.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/friends.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/blackhole.css')}}">
@endsection

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

@section('before-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/toastr.min.js')}}"></script>
    <script src="{{asset('front/JS/blackhole.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    
    @if($friend != null)
        <script>
            $(document).ready(function() {
                var url = $('meta[name="url"]').attr('content');
                var friend = {!! json_encode($friend->toArray()) !!};
                
                console.log(friend);
                toastr.options = {
                    "closeButton": true,
                    "timeOut": 10000,
                    "extendedTimeOut": 1000,
                };

                if(friend.photo.includes('cropped')) {
                    friend.photo = 'crop/'+friend.photo;
                }

                toastr.info('<div class="toastr-custom-image" style="background-image: url('+url+'/storage/profilepicture/'+friend.photo+');"></div><p><strong>'+friend.first_name+' '+friend.last_name+'</strong> become your friend.</p>');
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.sort-header').click(function() {
                $('.sort-body').toggle('slow');
            });
        });
    </script>
@endsection

