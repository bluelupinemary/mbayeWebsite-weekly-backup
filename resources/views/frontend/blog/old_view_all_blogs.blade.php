@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="preload" as="font" href="{{asset('fonts/georgia italic.ttf')}}" type="font/woff2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/view-all-blogs.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/view-all-blogs-responsive.css')}}">
@endsection

@section('content')
<div id="page-content">
<div class="app">
    <div class="blog-search">
        <form action="{{url('/blogs')}}" method="GET">
            {{-- <fieldset>
                <legend>Hi, Major {{(Auth::user()->gender == 'male' || Auth::user()->gender == null ? 'Tom' : 'Thomasina' )}} {{Auth::user()->first_name}}!</legend>
                <legend class="sub-legend">These are your blogs:</legend>
            </fieldset> --}}
            <div class="search-form">
                <div class="search-input-fields">
                    <input type="text" class="form-control" placeholder="Search" name="search" autocomplete="off">
                    <div class="input-group-prepend status-div">
                        <select class="custom-select" id="inputGroupSelect02" name="status">
                            <option selected value="">Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                            {{-- <option value="Unpublished">Unpublished</option> --}}
                        </select>
                    </div>
                    <div class="input-group-prepend sort-div">
                        <select class="custom-select" id="inputGroupSelect02" name="sort">
                            <option selected value="">Sort</option>
                            <option value="asc_name">Ascending Blog Title</option>
                            <option value="desc_name">Descending Blog Title</option>
                            <option value="asc_publisheddate">Ascending Date Published</option>
                            <option value="desc_publisheddate">Descending Date Published</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn search-btn">Search</button>
            </div>
        </form>
    </div>
    <div class="wrapper">
        <div class="blog-cols">
            @if(count($blogs))
            @foreach ($blogs as $blog)
                @if($blog->getTable() == 'blogs') 
                    <div class="blog-col" ontouchstart="this.classList.toggle('hover');">
                        <div class="container">
                            <div class="front" style="background-image: url({{asset('storage/img/blog/'.$blog->getFeaturedImage())}})">
                                <div class="inner">
                                    <span class="blog-status {{($blog->status == 'Published' ? 'published' : 'draft')}}">{{$blog->status}}</span>
                                    <span class="blog-date">{{($blog->publish_datetime != '' ? Carbon\Carbon::parse($blog->publish_datetime)->format('F d, Y') : '')}}</span>
                                    
                                    <p class="blog-name">{{$blog->name}}</p>
                                    <span  class="blog-tags">
                                        <ul class="tags">
                                            @foreach($blog->getFirstTwoTags() as $tag)
                                                <li class="tag"><i class="fas fa-tag"></i> {{$tag->name}}</li>
                                            @endforeach
                                            @if(count($blog->tags) > 2)
                                                <li class="tag"><i class="fas fa-plus"></i> {{$blog->remainingTagCount()}}</li>
                                            @endif
                                        </ul>
                                    </span>
                                    <multicount-component :blog_id="{!! json_encode($blog->id) !!}"></multicount-component>
                                </div>
                                {{-- <img src="{{asset('front/images/naff555Votes.png')}}" alt="" class="naff-reaction"> --}}
                            </div>
                            <div class="back">
                                <div class="inner">
                                    <div class="blog-action-buttons">
                                        <a href="{{url('/single_blog/'.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/view-btn.png')}}" alt="" class="view-btn"></a>
                                        <a class="delete" data-url="{{url('/blogs/'.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/delete-btn.png')}}" alt="" class="delete-btn"></a>
                                    <a href="{{$blog->getEditURL()}}"><img src="{{asset('front/images/blog-buttons/edit-btn.png')}}" alt="" class="edit-btn"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($blog->getTable() == 'blog_shares')
                    @php
                        if($blog->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
                            $blog->blog = $blog->general_blog;
                            $img_storage = 'storage/img/general_blogs/';
                        } else {
                            $img_storage = 'storage/img/blog/';
                        }
                    @endphp
                    <div class="blog-col" ontouchstart="this.classList.toggle('hover');">
                        <div class="container">
                            <div class="front shared-blog" style="background-image: url({{asset($img_storage.''.$blog->blog->getFeaturedImage())}})">
                                <div class="inner">
                                    <span class="blog-status shared">Shared</span>
                                    <span class="blog-date">{{($blog->publish_datetime != '' ? Carbon\Carbon::parse($blog->publish_datetime)->format('F d, Y') : '')}}</span>
                                    
                                    <p class="blog-name">{{$blog->blog->name}}</p>
                                    <span class="blog-tags">
                                        <ul class="tags">
                                            @foreach($blog->getFirstTwoTags() as $tag)
                                                <li class="tag"><i class="fas fa-tag"></i> {{$tag->name}}</li>
                                            @endforeach
                                            @if(count($blog->tags) > 2)
                                                <li class="tag"><i class="fas fa-plus"></i> {{$blog->remainingTagCount()}}</li>
                                            @endif
                                        </ul>
                                    </span>
                                    <multicount-component :blog_id="{!! json_encode($blog->blog->id) !!}"></multicount-component>
                                </div>
                                {{-- <img src="{{asset('front/images/naff555Votes.png')}}" alt="" class="naff-reaction"> --}}
                            </div>
                            <div class="back shared-blog">
                                <div class="inner">
                                    <div class="blog-action-buttons">
                                        <a href="{{url('/shared_blog/'.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/view-btn.png')}}" alt="" class="view-btn"></a>
                                        <a class="delete" data-url="{{url('/blogs/'.$blog->blog->id.'?type=shared&share_id='.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/delete-btn.png')}}" alt="" class="delete-btn"></a>
                                        {{-- <a href="{{$blog->blog->getEditURL()}}"><img src="{{asset('front/images/blog-buttons/edit-btn.png')}}" alt="" class="edit-btn"></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @else
            <h2 class="no-result">No results found.</h2>
            @endif
        </div>
        {{ $blogs->appends(['search' => request()->search, 'sort' => request()->sort, 'status' => request()->status])->links() }}
   </div>
   <div>
   <div class="navigator-div @if(Auth::user()->gender == null || Auth::user()->gender == 'male') tom @endif">
        @if(Auth::user()->gender != null && Auth::user()->gender == 'female')
            <img src="{{ asset('front/images/astronut/thomasina-navigator.png') }}" alt=""
            class="astronaut-body">
            <div class="tos-div thomasina">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @else
            <img src="{{ asset('front/images/astronut/tom-navigator.png') }}" alt=""
            class="astronaut-body">
            <div class="tos-div">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
        @endif
        <div class="user-photo {{access()->user()->getGender()}}">
            <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
        </div>
        <button class="navigator-zoom navigator-zoomin"><i class="fas fa-search-plus"></i></button>
        <div class="navigator-buttons">
            <div class="column column-1">
                <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
            </div>
            <div class="column column-2">
                <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
            </div>
            <div class="column column-3">
                <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
                <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
            </div>
        </div>
        <div class="instructions-div">
            <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
        </div>
        <div class="communicator-div tooltips top">
            <button class="communicator-button"></button>
            <span>Communicator</span>
        </div>
        <button class="navigator-zoomout-btn">
            <i class="fas fa-undo-alt"></i>
        </button>
    </div>
    <div class="navigator-div-zoomed-in">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        <div class="navigator-components">
            <img src="{{url('front/images/astronut/tom_blog.png')}}" alt="" class="astronaut">
            <div class="tos-div">
                <button class="tos-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/tosBtn.png') }}" alt=""><span class="">Terms of Services</span></button>
            </div>
            <div class="user-photo {{access()->user()->getGender()}}">
                <img src="{{asset('storage/profilepicture/'.access()->user()->getProfilePicture())}}"/>
            </div>
            {{-- <button class="navigator-zoom navigator-zoomin"><i class="fas fa-search-plus"></i></button> --}}
            <div class="navigator-buttons">
                <div class="column column-1">
                    <button class="music-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/musicBtn.png') }}" alt=""><span class="">Music on/off</span></button>
                    <button class="home-btn tooltips left"><img src="{{ asset('front/images/astronut/navigator-buttons/homeBtn.png') }}" alt=""><span class="">Home</span></button>
                </div>
                <div class="column column-2">
                    <button class="editphoto-btn tooltips top"><img src="{{ asset('front/images/astronut/navigator-buttons/greenButtons.png') }}" alt=""><span class="">Edit Profile Photo</span></button>
                </div>
                <div class="column column-3">
                    <button class="tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/freeBtn.png') }}" alt=""></button>
                    <button class="profile-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/profileBtn.png') }}" alt=""><span class="">User Profile</span></button>
                </div>
            </div>
            <div class="instructions-div">
                <button class="instructions-btn tooltips right"><img src="{{ asset('front/images/astronut/navigator-buttons/instructionsBtn.png') }}" alt=""><span class="">Instructions</span></button>
            </div>
            <div class="communicator-div tooltips top">
                <button class="communicator-button"></button>
                <span>Communicator</span>
            </div>
            <button class="navigator-zoomout-btn">
                <i class="fas fa-undo-alt"></i>
            </button>
        </div>
    </div>
</div>
    <div class="ally-dolphin">
        <div class="cloud-message">
            <img src="{{asset('front/images/cloudPNG.png')}}" alt="">
            <div class="message message-1">
                <p>Ooooooofa!</p>
            </div>
            <div class="message message-2 {{(Auth::user()->gender == 'female' ? 'thomasina' : '' )}}">
                <p>Hi, <span>Major {{(Auth::user()->gender == 'male' || Auth::user()->gender == null ? 'Tom' : 'Thomasina' )}}</span> <span class="user-name">{{Auth::user()->first_name}}!</span></p>
                <p class="sub-title">These are your blogs:</p>
            </div>
        </div>
        <img src="" alt="" class="dolphin">
    </div>
</div>
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script>
        var url = $('meta[name="url"]').attr('content');
        $('.ally-dolphin .dolphin').attr('src', "{{asset('front/images/Ally2.png')}}");
        
        $(document).ready(function() {
            animateDolphin();
            if($.urlParam('search') != '') {
                $('input[name="search"]').val(decodeURIComponent($.urlParam('search')));
            }
            
            if($.urlParam('sort') != '') {
                $('select[name="sort"]').val($.urlParam('sort'));
            }
            if($.urlParam('status') != '') {
                $('select[name="status"]').val($.urlParam('status'));
            }
        });
        function animateDolphin() {
            $('.cloud-message').hide();
            $('.cloud-message .message').hide();
            $('.ally-dolphin .dolphin').on('load', function() {
                console.log('loaded');
                // $(".ally-dolphin .dolphin").on('load', function() {
                // setTimeout(function() {
                    // $('.ally-dolphin .dolphin').delay(1000).addClass('animate-ally-1');
                    // $('.ally-dolphin').delay(1000).show();
                    $('.ally-dolphin .dolphin').addClass('animate-ally-1');
                    $('.ally-dolphin').show();
                
                // });
                // var has_started = 0;
                // $('.ally-dolphin').on("webkitAnimationStart animationstart", function(){
                //     if(!has_started) {
                //         $('.cloud-message .message-1').css("display", "flex");
                //         setTimeout(function() {
                //             $('.cloud-message').css("display", "flex");
                //         }, 1000);
                        
                //         console.log('start');
                //         has_started = 1;
                //     }
                // });
                var has_added_swim_ally_1 = 0;
                
                $('.ally-dolphin .dolphin.animate-ally-1').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.ally-dolphin .dolphin').removeClass('animate-ally-1');
                    $('.cloud-message .message-1').css("display", "flex");
                    $('.cloud-message').css("display", "flex").hide().fadeIn(300);
                    if(!has_added_swim_ally_1) {
                        $('.ally-dolphin .dolphin').addClass('swim-ally-1');
                        has_added_swim_ally_1 = 1;
                    }
                    
                    $('.ally-dolphin .dolphin.swim-ally-1').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.ally-dolphin .dolphin').removeClass('swim-ally-1');
                        $('.cloud-message .message-1').hide();
                        $('.cloud-message').hide();
                        
                        $('.ally-dolphin .dolphin').addClass('animate-ally-2');
                        $('.ally-dolphin .dolphin.animate-ally-2').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                            $('.ally-dolphin .dolphin').removeClass('animate-ally-2');
                            $('.cloud-message .message-2').css("display", "flex");
                            $('.cloud-message').css("display", "flex");
                            $('.ally-dolphin .dolphin').addClass('swim-ally-2');
                        });
                    });
                });
            });
        }
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if(results) {
                return results[1] || 0;
            } else {
                return '';
            }
        }
        $('.blog-action-buttons .delete').click(function() {
            var url = $(this).data('url');
            Swal.fire({
                text: "Are you sure you want to delete this blog?",
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                width: '30%',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.78)',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.78)'
                    }).then((res) => {
                        if(res.value) {
                            location.reload(true);
                        }
                    });
                },
                error: function (request, status, error) {
                        var response = JSON.parse(request.responseText);
                        var errorString = '';
                        var title = 'Error!';
                        if(response.errors) {
                            title = 'Error in processing request...';
                            $.each( response.errors, function( key, value) {
                                errorString += '<p>' + value + '</p>';
                            });
                        }
                        
                        Swal.fire({
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            title: title,
                            html: errorString,
                            width: '30%',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.78)'
                        });
                    }
                });
            }
            })
        });
        var navigator_zoom = 0;
        var img_has_loaded = 0;
        $('button.navigator-zoomin').click( function() {
            if(!navigator_zoom) {
                if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                    $('.navigator-div').hide();
                    $('.navigator-div-zoomed-in').css('display', 'flex').hide().fadeIn();
                    // if(!img_has_loaded) {
                    //     $('.navigator-div-zoomed-in .lds-ellipsis').show();
                    //     $('.navigator-div-zoomed-in .astronaut').on('load', function() {
                    //         $('.navigator-div-zoomed-in .lds-ellipsis').hide();
                    //         $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    //         img_has_loaded = !img_has_loaded;
                    //     });
                    // } else {
                        $('.navigator-div-zoomed-in .navigator-components').css('display', 'flex').hide().fadeIn();
                    // }
                } else {
                    $(this).fadeOut();
                    $('.navigator-div').addClass('animate-navigator-zoomin');
                    $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                        $('.navigator-div').removeClass('animate-navigator-zoomin');
                        $('.navigator-div').addClass('zoomin');
                    });
                }
            }
            navigator_zoom = !navigator_zoom;
        });
        $('.navigator-zoomout-btn').click(function() {
            $('button.navigator-zoomin').fadeIn();
            if((navigator.userAgent.indexOf('Safari') > -1 && navigator.userAgent.indexOf('Chrome') == -1) || (navigator.userAgent.indexOf("Mozilla") != -1 && navigator.userAgent.indexOf("Firefox") != -1)) {
                $('.navigator-div').fadeIn();
                $('.navigator-div-zoomed-in').hide();
            } else {
                $('.navigator-div').addClass('animate-navigator-zoomout');
                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomout');
                    $('.navigator-div').removeClass('zoomin');
                });
            }
            navigator_zoom = !navigator_zoom;
        });
        // navigator buttons
        $('.communicator-div').click( function() {
            window.location.href = url+'/communicator';
        });
        $('.home-btn').click( function() {
            window.location.href = url;
        });
        $('.profile-btn').click( function() {
            window.location.href = url+'/dashboard';
        });
        $('.instructions-btn, .tos-btn').click( function() {
            window.location.href = url+'/page_under_development';
        });
        $('.editphoto-btn').click( function() {
            window.location.href = url+'/profile/edit-photo';
        });
    </script>
@endsection