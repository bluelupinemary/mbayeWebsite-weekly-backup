@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
  <style>
     .trevor-popup-class{
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: auto 100% !important;
        height:25vh !important;
    }
     
  </style>
@endsection

@section('content')
{{-- @foreach ($contact_list as $contact)
    <p>This is user {{ $contact->planet }}</p>
@endforeach --}}

    <input type="hidden" id="userGender" value="{{$gender}}"/>
    <input type="hidden" id="userId" value="{{$userId}}"/>
    <canvas id="canvas"></canvas>
    <div id="loadingScreenDiv"></div>
    <div id="loadingScreenPercent"> Loading: 0 % </div>
    <img src="{{asset('storage/profilepicture').'/'.$photo}}" id="userPhoto" alt="Img goes here" style="visibility:hidden;"/>
    <div id="block_land">
      <div class="content">
          <h1 class="text-glow">Turn your device in landscape mode.</h1>
          <img src="{{asset('front')}}/images/rotate-screen.gif" alt="">
      </div>
  </div>
  <script>
    var token = '{{ Session::token() }}';
    var urlStoreContacts = '{{ route('frontend.user.storeContacts') }}';
    var has_contacts = '{{ $has_contacts ?? '' }}';
    var load_filename = '{{$filename ?? ''}}';
    var contact_list = '{{$contact_list ?? ''}}';
    
    if(contact_list !=  "") contact_list = JSON.parse(contact_list.replace(/&quot;/g,'"'));
    

   
</script>
    
@endsection

@section('after-scripts')
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
<script src="{{asset('front')}}/babylonjs/scenes/ContactsPage/contactsMap.js"></script>
<script src="{{asset('front')}}/babylonjs/scenes/ContactsPage/contacts.js"></script>
  <script>
   
  </script>
@endsection
