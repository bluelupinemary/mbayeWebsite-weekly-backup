@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/view-all-blogs.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/view-all-blogs-responsive.css')}}">
@endsection

@section('content')
<div id="page-content">
<div class="app">
    <div class="blog-search">
        <form action="{{url('/blogs')}}" method="GET">
            <fieldset>
                <legend>Hi, Major {{(Auth::user()->gender == 'male' || Auth::user()->gender == null ? 'Tom' : 'Thomasina' )}} {{Auth::user()->first_name}}!</legend>
                <legend class="sub-legend">These are your blogs:</legend>
            </fieldset>
            <div class="search-form">
                <div class="search-input-fields">
                    <input type="text" class="form-control" placeholder="Search" name="search" autocomplete="off">
                    <div class="input-group-prepend status-div">
                        <select class="custom-select" id="inputGroupSelect02" name="status">
                            <option selected value="">Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                            <option value="Unpublished">Unpublished</option>
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
            <div class="blog-col" ontouchstart="this.classList.toggle('hover');">
                <div class="container">
                    <div class="front" style="background-image: url({{asset('storage/img/blog/'.$blog->getFeaturedImage())}})">
                        <div class="inner">
                            <p class="blog-name">{{$blog->name}}</p>
                            <span class="blog-date">{{($blog->publish_datetime != '' ? Carbon\Carbon::parse($blog->publish_datetime)->format('F d, Y') : '')}}</span>
                            <span class="blog-status {{($blog->status == 'Published' ? 'published' : 'draft')}}">{{$blog->status}}</span>
                            <span>
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
                                {{-- <a href="{{url('/single_blog/'.$blog->id)}}">
                                    <button class="view" alt="View Blog">
                                        <i class="far fa-eye"></i>
                                        <p>View</p>
                                    </button>
                                </a>
                                <a href="{{url('/communicator?action=edit_blog&blog_id='.$blog->id)}}">
                                    <button class="edit" alt="Edit Blog">
                                        <i class="far fa-edit"></i>
                                        <p>Edit</p>
                                    </button>
                                </a>
                                <button class="delete" alt="Delete Blog" data-url="{{url('/blogs/'.$blog->id)}}">
                                    <i class="far fa-trash-alt"></i>
                                    <p>Delete</p>
                                </button> --}}
                                <a href="{{url('/single_blog/'.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/view-btn.png')}}" alt="" class="view-btn"></a>
                                <a class="delete" data-url="{{url('/blogs/'.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/delete-btn.png')}}" alt="" class="delete-btn"></a>
                                <a href="{{url('/communicator?action=edit_blog&blog_id='.$blog->id)}}"><img src="{{asset('front/images/blog-buttons/edit-btn.png')}}" alt="" class="edit-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</div>
</div>
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script>
        var url = $('meta[name="url"]').attr('content');
        $(document).ready(function() {
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

        $('button.navigator-zoomin').click( function() {
            if(!navigator_zoom) {
                $(this).fadeOut();
                $('.navigator-div').addClass('animate-navigator-zoomin');

                $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.navigator-div').removeClass('animate-navigator-zoomin');
                    $('.navigator-div').addClass('zoomin');
                });
            } 
            // else {
            //     // $(this).removeClass('navigator-zoomout');
            //     // $(this).addClass('navigator-zoomin');
            //     $('.navigator-div').addClass('animate-navigator-zoomout');

            //     $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
            //         $('.navigator-div').removeClass('animate-navigator-zoomout');
            //         $('.navigator-div').removeClass('zoomin');
            //     });
            // }

            navigator_zoom = !navigator_zoom;
        });

        $('.navigator-zoomout-btn').click(function() {
            $('button.navigator-zoomin').fadeIn();
            $('.navigator-div').addClass('animate-navigator-zoomout');

            $('.navigator-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.navigator-div').removeClass('animate-navigator-zoomout');
                $('.navigator-div').removeClass('zoomin');
            });

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
