@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>
        .sample-btn {
            position: absolute;
            left: 35.5%;
            top: 38%;
            /* transform: translate(-198%, -94%); */
            /* -webkit-filter: drop-shadow(5px 5px 5px #222); */
            /* filter: drop-shadow(1px 1px 7px #17a2b8); */
            color: #17a2b8;
            /* -webkit-transition: all 0.06s ease-out;
            transition: all 0.06s ease-out; */
            transition: all 0.06s ease-out;
            /* transform: translate3d(0px, 2px, 10px); */
        }

        .sample-btn:active {
            /* transform: translate3d(0px, 2px, 10px);
            -webkit-filter: drop-shadow(5px 5px 5px #222); 
            filter: drop-shadow(1px 1px 7px #17a2b8); */
            /* &:before {
            top:0;
            box-shadow: 0 3px 3px rgba(0,0,0,.7),0 3px 9px rgba(0,0,0,.2);
        
            } */
        }

        .shadow {
            transform: translate3d(0px, 5px, 10px);
            -webkit-filter: drop-shadow(1px 0px 5px #17a2b8);
            filter: drop-shadow(1px 0px 5px #17a2b8);
        }
        
        .sample-btn:before {
            display: inline-block;
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            z-index: -1;
            top: 6px;
            border-radius: 5px;
            height: 49px;
            background: linear-gradient(to top, #183b0d 0%, #183b0d 6px);
            -webkit-transition: all 0.078s ease-out;
            transition: all 0.078s ease-out;
            box-shadow: 0 1px 0 2px rgba(0, 0, 0, 0.3), 0 5px 2.4px rgba(0, 0, 0, 0.5), 0 10.8px 9px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('after-styles')
@endsection

@section('content')
    <img src="{{asset('front/images/sample button/filmsBtn.png')}}" alt="" class="sample-btn">
    <img src="{{asset('front/images/sample button/sampleBG.png')}}" alt="">
@endsection

@section('after-scripts')
    <script>
        $('.sample-btn').click(function() {
            $(this).toggleClass('shadow');
        });
    </script>
@endsection
