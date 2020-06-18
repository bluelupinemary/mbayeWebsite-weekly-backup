@extends('frontend.layouts.game_layout')
@section('before-styles')
<link href="{{asset('front')}}/CSS/game/GeneralSceneStyle.css" rel="stylesheet"/>
<style>
   

</style>
@endsection

@section('content')
    <div>
        HELLO DUMMY PAGE HERE
       
    </div>
    <br/>
    USER: {{$user_id}}
    <br/>
    <br/>

    {{-- PANELS: {{$user_panels}} --}}
    PANELS:
    <br/>
    <br/>
    <br/>
    <?php
   
        $obj = json_decode($user_panels);
        foreach($obj as $a){
            echo "panel: ". ($a->panel_number)." <span style='margin-left:5%'>"; // 12345
            echo $a->flowers_used." <br/>";
        }   
  ?>
   
   
@endsection

@section('after-scripts')
            


@endsection
