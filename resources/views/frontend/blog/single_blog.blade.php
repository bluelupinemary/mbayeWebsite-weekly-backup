@extends('frontend.layouts.profile_layout')

@section('before-styles')
@trixassets
<meta property="og:image" content="{{ asset('storage/img/blog/'.$blog->featured_image) }}">
<meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($blog->summary), 20, '...') }}">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:title" content="{{ $blog->name }}">
<meta name="twitter:card" content="{{ asset('storage/img/blog/'.$blog->featured_image) }}">
<meta property="og:type" content="website" /> <meta property="og:image:width" content="720" />
<meta property="og:image:height" content="720" />

<link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('front/owl-carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog.css') }}">
<link rel="stylesheet" href="{{ asset('front/CSS/single_blog-responsive.css') }}">
@endsection

@section('after-styles')
{{-- @trixassets --}}
@endsection

@section('content')
<div id="page-content">
    <div class="app">
        <div class="single-blog">
            <div class="blog-heading">
                <div class="blog" data-blogid="{{ $blog->id }}"></div>
                <div class="blog-details-1">
                    <div class="blog-featured-img"
                        style='background-image: url("{{ asset('storage/img/blog/'.$blog->featured_image) }}")'>
                        {{-- <img src="{{asset('storage/img/blog/'.$blog->featured_image) }}"
                        alt="" class="featured_image"> --}}
                    </div>
                    <div class="blog-dates-reactions">
                        <div class="blog-dates">
                            <p class="day">
                                {{ Carbon\Carbon::parse($blog->publish_datetime)->format('d') }}
                            </p>
                            <p class="month">
                                {{ Carbon\Carbon::parse($blog->publish_datetime)->format('F').', '.Carbon\Carbon::parse($blog->publish_datetime)->format('Y') }}
                            </p>
                            <p>
                                {{ Carbon\Carbon::parse($blog->publish_datetime)->format('h:i A') }}
                            </p>
                        </div>
                        <div class="blog-buttons blog-button-1">
                            <div class="button-div hotIcon">
                                <img src="{{ asset('front/icons/hotNew.png') }}" />
                                <div class="button-details">
                                    <p class="button-title">Hot</p>
                                    <hotcount-component></hotcount-component>
                                </div>
                            </div>
                            <div class="button-div coolIcon">
                                <img src="{{ asset('front/icons/coolIcon.png') }}" />
                                <div class="button-details">
                                    <p class="button-title">Cool</p>
                                    <coolcount-component></coolcount-component>
                                </div>
                            </div>
                            <div class="button-div shareIcon">
                                <img src="{{ asset('front/icons/share.png') }}" alt="" width="40">
                                <div class="button-details">
                                    <p class="button-title">Share</p>
                                    <p class="button-number">300k</p>
                                </div>
                            </div>
                            @if(!$blog->isDesignsBlog())
                            <div class="button-div naffIcon">
                                <img src="{{ asset('front/icons/naffPicked.png') }}" />
                                <div class="button-details">
                                    <p class="button-title">Naff</p>
                                    <naffcount-component></naffcount-component>
                                </div>
                            </div>
                            @endif
                            <div class="button-div commentIcon">
                                <img src="{{ asset('front/icons/commentsNew.png') }}" alt="" width="40">
                                <div class="button-details">
                                    <p class="button-title">Declarations</p>
                                    <commentcount-component></commentcount-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-details">
                    <h4 class="blog-title">{{ $blog->name }}</h4>

                    <div class="blog-tags">
                        <ul class="tags">
                            @foreach($blog->tags as $tag)
                                <li class="tag"><i class="fas fa-tag"></i> {{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <span
                        class="blog-owner">{{ $blog->owner->first_name.' '.$blog->owner->last_name }}</span>
                    <hr>
                    <div class="blog-summary">
                        <div class="content"></div>
                        <div class="blog-buttons blog-button-2">
                            <div class="left">
                                <div class="button-div hotIcon">
                                    <img src="{{ asset('front/icons/hotNew.png') }}" />
                                    <div class="button-details">
                                        <p class="button-title"><span class="full">Hot</span><span class="abbr">Hot</span></p>
                                        <hotcount-component></hotcount-component>
                                    </div>
                                </div>
                                <div class="button-div coolIcon">
                                    <img src="{{ asset('front/icons/coolIcon.png') }}" />
                                    <div class="button-details">
                                        <p class="button-title"><span class="full">Cool</span><span class="abbr">Cool</span></p>
                                        <coolcount-component></coolcount-component>
                                    </div>
                                </div>
                                @if(!$blog->isDesignsBlog())
                                <div class="button-div naffIcon">
                                    <img src="{{ asset('front/icons/naffPicked.png') }}" />
                                    <div class="button-details">
                                        <p class="button-title"><span class="full">Naff</span><span class="abbr">Naff</span></p>
                                        <naffcount-component></naffcount-component>
                                    </div>
                                </div>
                                @endif
                            </div>
        
                            <div class="right">
                                <div class="button-div commentIcon">
                                    <img src="{{ asset('front/icons/commentsNew.png') }}" alt="" width="40">
                                    <div class="button-details">
                                        <p class="button-title"><span class="full">Declarations</span><span class="abbr">Declar.</span></p>
                                        <commentcount-component></commentcount-component>
                                    </div>
                                </div>
                                <div class="button-div shareIcon">
                                    <img src="{{ asset('front/icons/share.png') }}" alt="" width="40">
                                    <div class="button-details">
                                        <p class="button-title"><span class="full">Share</span><span class="abbr">Share</span></p>
                                        <p class="button-number">300k</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="blog-btn blog-fullview" title="See full blog"><i class="fas fa-arrow-down"></i></button>
            </div>
            <div class="blog-body">
                <div class="blog-content">
                    <div class="trix-content">
                        {!! nl2br($blog->content) !!}
                    </div>
                    @if(!$blog->isDesignsBlog())
                        @if(count($blog->videos))
                            <div class="blog-videos">
                                <h5>Videos</h5>
                                @if(count($blog->valid_videos))
                                <div class="owl-carousel owl-theme">
                                    @for($i = 0; $i < count($blog->valid_videos); $i++)
                                        <div class="item-video" data-merge="2"><a class="owl-video"
                                                href="{{ $blog->valid_videos[$i] }}"></a></div>
                                    @endfor
                                </div>
                                @endif

                                @if(count($blog->invalid_videos))
                                @if(count($blog->valid_videos))<h6>Other Videos</h6>@endif  
                                <ul>
                                    @for($i = 0; $i < count($blog->invalid_videos); $i++)
                                        <li><a href="{{ $blog->invalid_videos[$i] }}">{{ $blog->invalid_videos[$i] }}</a></li>
                                    @endfor
                                </ul>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="blog-panel">
                            <h5>Panel Number: {{$blog->blog_panel_design->panel->panel_number}}</h5>
                            <div class="flower-list-div">
                                @php
                                    $flowers = $blog->blog_panel_design->getFlowers();
                                @endphp
                                @for($i = 0; $i < count($flowers); $i++)
                                    <div class="flower">
                                        <img src="{{asset('front/images3D/flowers2D/'.$flowers[$i]->flower_code.'.png')}}" alt="">
                                        <p class="flower-name">{{$flowers[$i]->flower_name}}</p>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif
                </div>
                <div id="app">
                    <comment-component :blog_id="{!! json_encode($blog->id) !!}" :user="{{ Auth::user() }}">
                    </comment-component>
                    <button class="blog-btn blog-minimize"><i class="fas fa-arrow-up"></i></button>
                </div>
            </div>
        </div>
        
    <like-component :blog_id="{!! json_encode($blog->id) !!}" :user="{{ Auth::user() }}" :is_design="{{($blog->isDesignsBlog() ? 'true' : 'false')}}"></like-component>
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
            @php
                $share_links = Share::currentPage(null, [], '', '')
                    ->facebook()
                    ->twitter()
                    ->linkedin('Extra linkedin summary can be passed here')
                    ->whatsapp();
            @endphp
            
            <div class="menu-button">
                <img src="{{asset('front/icons/share.png')}}" alt="">
                {{-- <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                <a href="#"><i class="zmdi zmdi-google-plus"></i></a>
                <a href="#"><i class="zmdi zmdi-codepen"></i>   </a>
                <a href="#"><i class="zmdi zmdi-codepen"></i>   </a> --}}
                {!! $share_links !!}
                <a href="#" class="internal-share tooltips top" data-toggle="modal" data-target="#shareBlogModal"><span class="">Repost this blog</span><img src="{{asset('front/icons/alert-icon.png')}}" alt=""></a>
            </div>
        </div>
        <div class="naff-fart-reaction">
            <audio id="fart-audio" src="{{asset('front/sound-effects/fart.mp3')}}" preload="auto"></audio>
            <img src="{{asset('front/images/naff555Votes.png')}}" alt="">
        </div>
    </div>

    <div class="modal" id="shareBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="exampleModalLongTitle">Share Blog</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="share-blog-form">
                    @csrf
                    <textarea name="share_caption" id="" cols="30" rows="3" placeholder="Enter caption here..."></textarea>
                    <input type="hidden" name="blog_id" value="{{$blog->id}}">
                    <div class="blog-share-preview">
                        <div class="card">
                            <div class="card-header">
                                <div class="owner-profile-picture">
                                    <img src="{{asset('storage/profilepicture/'.$blog->owner->getProfilePicture())}}" alt="">
                                </div>
                                <div class="owner-name">{{$blog->owner->first_name.' '.$blog->owner->last_name}}</div>
                            </div>
                             {{-- <img class="card-img-top" src="" alt="Card image cap"> --}}
                            <div class="card-body" style="background-image: url({{ asset('storage/img/blog/'.$blog->featured_image) }});">
                            </div>
                            <div class="card-footer">
                                <div class="blog-share-title">{{$blog->name}}</div>
                                <div class="blog-description"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="share-blog-btn" form="share-blog-form">Share Now</button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

    @section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{ asset('front/JS/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/owl-carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/JS/mo.min.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    
    <script>
        var url = $('meta[name="url"]').attr('content');
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('frontend.likepost') }}';
        var naff_fart_status = '{{$blog->naff_fart_status}}';
        var naff_fart_animation = true;
        var blog = {!! json_encode($blog->toArray()) !!};

        $(document).ready(function() {
            if (typeof Trix == 'undefined') {
                $('head').prepend('<script src="'+url+'/trix/trix.js">');
                $('head').prepend('<link rel="stylesheet" type="text/css" href="'+url+'/trix/trix.css">');
            }

            scaleAstronaut();
            // init();
            // console.log(blog);
            $('.blog-summary .content').html(trimHtml(blog.summary, { limit: 200 }).html);
            $('.trix-content div').children().each( (index, element) => {
                console.log(index);     // children's index
                console.log(element);   // children's element

                if(element.style.fontFamily) {
                    // remove quotes on string
                    var font = element.style.fontFamily.replace(/['"]+/g, '');
                    // console.log(font);
                    if(font != null || font != '') {
                        // console.log(document.fonts.check('1em '+font));
                        // check if font exist
                        var check_font = document.fonts.check('1em '+font);
                        if(!check_font) {
                            // append link stylesheet
                            $('head').append('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family='+font+'">');
                        }

                        // return element.style.fontFamily;
                    }
                }
            });

            // $('.internal-share').tooltip({
            //     track: true
            // });
        });
        
        $(window).on('load', function() {
            $('.navigator-div').css("display", "flex").hide().fadeIn(1000);
            $('.single-blog, .reaction-div').fadeIn(1000, function() {
                if(naff_fart_status) {
                    $('body').on('click', function(){
                        if(naff_fart_animation) {
                            animateNaffFart();
                            naff_fart_animation = !naff_fart_animation;
                        }
                    });
                }
            });
        });

        $('.internal-share').click(function() {
            $('.blog-share-preview .blog-description').html(trimHtml(blog.summary, { limit: 130 }).html);
        });

        function trimHtml(html, options) {
            console.log(html);
            options = options || {};

            var limit = options.limit || 100,
                preserveTags = (typeof options.preserveTags !== 'undefined') ? options.preserveTags : true,
                wordBreak = (typeof options.wordBreak !== 'undefined') ? options.wordBreak : false,
                suffix = options.suffix || '...',
                moreLink = options.moreLink || '';

            var arr = html.replace(/</g, "\n<")
                .replace(/>/g, ">\n")
                .replace(/\n\n/g, "\n")
                .replace(/^\n/g, "")
                .replace(/\n$/g, "")
                .split("\n");

            var sum = 0,
                row, cut, add,
                tagMatch,
                tagName,
                tagStack = [],
                more = false;

            for (var i = 0; i < arr.length; i++) {

                row = arr[i];
                // count multiple spaces as one character
                rowCut = row.replace(/[ ]+/g, ' ');

                if (!row.length) {
                    continue;
                }

                if (row[0] !== "<") {

                    if (sum >= limit) {
                        row = "";
                    } else if ((sum + rowCut.length) >= limit) {

                        cut = limit - sum;

                        if (row[cut - 1] === ' ') {
                            while(cut){
                                cut -= 1;
                                if(row[cut - 1] !== ' '){
                                    break;
                                }
                            }
                        } else {

                            add = row.substring(cut).split('').indexOf(' ');

                            // break on halh of word
                            if(!wordBreak) {
                                if (add !== -1) {
                                    cut += add;
                                } else {
                                    cut = row.length;
                                }
                            }
                        }

                        row = row.substring(0, cut) + suffix;

                        if (moreLink) {
                            row += '<a href="' + moreLink + '" style="display:inline">»</a>';
                        }

                        sum = limit;
                        more = true;
                    } else {
                        sum += rowCut.length;
                    }
                } else if (!preserveTags) {
                    row = '';
                } else if (sum >= limit) {

                    tagMatch = row.match(/[a-zA-Z]+/);
                    tagName = tagMatch ? tagMatch[0] : '';

                    if (tagName) {
                        if (row.substring(0, 2) !== '</') {

                            tagStack.push(tagName);
                            row = '';
                        } else {

                            while (tagStack[tagStack.length - 1] !== tagName && tagStack.length) {
                                tagStack.pop();
                            }

                            if (tagStack.length) {
                                row = '';
                            }

                            tagStack.pop();
                        }
                    } else {
                        row = '';
                    }
                }

                arr[i] = row;
            }

            return {
                html: arr.join("\n").replace(/\n/g, ""),
                more: more
            };
        }

        var fart_audio = document.getElementById("fart-audio"); 
        function animateNaffFart()
        {
            // var fart_url = url+'/front/sound-effects/fart.mp3';
            // fart_audio.play();
            // fart_audio.pause();
            // fart_audio.load(function() {
                fart_audio.currentTime = 0;
                fart_audio.play();

                $('.naff-fart-reaction').show();
                $('.naff-fart-reaction').addClass('animate-naff-fart-reaction');
            // });
            
            $('.naff-fart-reaction').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.naff-fart-reaction').removeClass('animate-naff-fart-reaction');
                $('.naff-fart-reaction').css('width', '70%');
                
                fart_audio.onended = function() {
                    $('.naff-fart-reaction').fadeOut(500);
                    $('.naff-fart-reaction').css('width', '0');
                };
            });
        }

        function animateNaffFartReaction()
        {
            // var fart_url = url+'/front/sound-effects/fart.mp3';
            // fart_audio.play();
            // fart_audio.pause();
            // fart_audio.load(function() {
                fart_audio.currentTime = 0;
                fart_audio.play();

                $('.naff-fart-reaction').show();
                $('.naff-fart-reaction').addClass('animate-naff-fart-reaction');
            // });
            
            $('.naff-fart-reaction').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                $('.naff-fart-reaction').removeClass('animate-naff-fart-reaction');
                $('.naff-fart-reaction').css('width', '70%');

                fart_audio.onended = function() {
                    $('.naff-fart-reaction').fadeOut(500);
                    $('.naff-fart-reaction').css('width', '0');
                    
                    $('.reaction-popup').fadeIn('slow', function() {
                        $('.reaction-popup button').click();
                        $('.reaction-popup').delay(1000).fadeOut('slow');
                        $('.reaction-popup button').click();
                    });
                };
            });
        }

        function getEmotion(emotion_id) {
            var array;
            var naff_img = "{{ asset('front/icons/naffPicked.png') }}";
            var cool_img = "{{ asset('front/icons/cool300.png') }}";0000
            var hot_img = "{{ asset('front/icons/hotNew.png') }}";

            if (emotion_id == '0') {
                array = {
                    emotion: 'hot',
                    img: hot_img
                };
            } else if (emotion_id == '1') {
                array = {
                    emotion: 'cool',
                    img: cool_img
                };
            } else if (emotion_id == '2') {
                array = {
                    emotion: 'naff',
                    img: naff_img
                };
            }

            return array;
        }

        // function emotion(blogid, emotion, event) {
        //     // alert("change likable to "+emotion);
        //     event.preventDefault();

        //     $.ajax({
        //         method: 'POST',
        //         url: urlLike,
        //         data: {
        //             emotion: emotion,
        //             blog_id: blogid,
        //             _token: token
        //         },
        //         success: function (data) {
        //             if (data.status == 'like') {
        //                 var emotion = getEmotion(data.data.emotion);

        //                 $('.reaction-button button').removeClass('selected-reaction');
        //                 $('.reaction-button button.' + emotion.emotion).addClass('selected-reaction');
        //                 $('.reaction-popup img').removeClass();
        //                 $('.reaction-popup img').attr('src', emotion.img);

        //                 if (emotion.emotion == 'cool') {
        //                     $('.reaction-popup img').addClass('coolIcon');
        //                 } else if (emotion.emotion == 'hot') {
        //                     $('.reaction-popup img').addClass('hotIcon');
        //                 }

        //                 $('.reaction-popup').fadeIn('slow', function() {
        //                     $('.reaction-popup button').click();
        //                     $('.reaction-popup').delay(5000).fadeOut('slow');
        //                     $('.reaction-popup button').click();
        //                 });
                        
        //                 // $('.blog-buttons .button-div.naffIcon button').click();
                        
        //             } else if (data.status == 'unlike') {
        //                 $('.reaction-button button').removeClass('selected-reaction');
        //             }
        //         }
        //     });
        // };

        function goToComments() {
            blogFullview();

            setTimeout(function () {
                $("html").animate({
                    scrollTop: $('#app').offset().top
                }, 800);
            }, 1000);
        }

        function blogFullview() {
            $('.blog-fullview').fadeOut( function() {
                $('.blog-buttons.blog-button-1').css('opacity', 0);
            
                $('.blog-summary .content').fadeOut(1000, 'linear', function() {
                    $('.blog-buttons.blog-button-2').addClass('fullview');
                });
                $('.single-blog').addClass('fullview');
                $('.blog-body').addClass('show-blogcontent');
            });
        }

        function blogMinimize() {
            $('.blog-fullview').fadeIn();

            $('.blog-buttons.blog-button-1').css('opacity', 1);
            $('.blog-summary .content').show();

            $('.single-blog').removeClass('fullview');
            $('.blog-body').removeClass('show-blogcontent');
            $('.blog-buttons').removeClass('fullview');
        }

        $('[data-toggle="tooltip"]').tooltip();

        $('.blog-fullview').click(function () {
            blogFullview();
        });

        $('.blog-minimize').click(function () {
            blogMinimize();
        });

        $(".owl-carousel").owlCarousel({
            items: 1,
            merge: true,
            // loop:true,
            margin: 10,
            video: true,
            // center:true,
            // lazyLoad: true,
            dots: true,
            dotsEach: true,
            responsive: {
                480: {
                    items: 2,
                    dots: true,
                },
                600: {
                    items: 3,
                    dots: true
                }
            }
        });

        var thatDiv, rightDiv, animation_interval, scale, window_width, scale_astronaut;

        window.addEventListener("orientationchange", function(event) {
            // Generate a resize event if the device doesn't do it
            // window.dispatchEvent(new Event("resize"));
            
            // clearInterval(animation_interval);
            scaleAstronaut();
            // init();
        }, false);

        window.addEventListener("resize", function(event) {
            // Generate a resize event if the device doesn't do it
            // window.dispatchEvent(new Event("resize"));
            // clearInterval(animation_interval);
            scaleAstronaut();
            // init();
        }, false);

        function scaleAstronaut()
        {
            window_width = $(window).width();

            // if(window_width <= 1024) {
            //     clearInterval(animation_interval);
            // }

            if(window_width <= 1024 && window_width >= 991) {
                clearInterval(animation_interval);
                scale = ' scale(1.5)';
                // $('.reaction-div').addClass('zoomin');
            } else if(window_width < 991) {
                clearInterval(animation_interval);
                scale = ' scale(2)';
                // $('.reaction-div').addClass('zoomin');
            } else {
                scale = ' scale(1)';
                // $('.reaction-div').removeClass('zoomin');
            }

            // document.getElementById('thatDiv').style.transform = scale;

        }

        function init() {
            thatDiv = document.getElementById('thatDiv');
            threeDJitter();
            animation_interval = setInterval(threeDJitter, 3000);
        }

        function threeDJitter() {
            let randomX = Math.random() * 5; //0-5
            let randomY = Math.random() * 5 + 20; //30-35
            let randomZ = Math.random() * 5;
            let randomTime = Math.random() * 2000 + 2000;
            // thatDiv.style.transform = 'rotateX('+randomX+'deg) rotateY('+randomY+'deg) rotateZ('+randomZ+'deg)';
            thatDiv.style.transform = 'translate(0, -50%) rotateY(' + randomY + 'deg)';

            randomX = Math.random() * 8; //0-5
            randomZ = Math.random() * 8;
            randomY = Math.random() * -5 - 40; //-45 to -40
            randomTime = Math.random() * 2000 + 2000;
            // rightDiv.style.transform = 'rotateX('+randomX+'deg) rotateY('+randomY+'deg) rotateZ('+randomZ+'deg)';
            let allText = document.getElementsByClassName('textGlow');
        }
        
        $('.reaction-div').mouseenter( function() {
            // alert('mouseenter')
            clearInterval(animation_interval);
        }).mouseleave(function() {
            // alert('mouseleave')
            if($(window).width() > 1024) {
                // console.log(window_width);
                // init();
            }
        });

        var astronaut_zoom = 0;

        $('.zoom-btn').click(function() {
            if(!astronaut_zoom) {
                // removeAstronautAnimation();
                // $('.reaction-div').css('transition', 'none');
                $('.zoom-in').hide();
                $('.zoom-out').show();
                $('.reaction-div').addClass('animate-zoomIn');

                $('.reaction-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.reaction-div').addClass('zoomin-astronaut');
                    $('.reaction-div').removeClass('animate-zoomIn');
                });
            } else {
                $('.zoom-out').hide();
                $('.zoom-in').show();
                
                $('.reaction-div').addClass('animate-zoomOut');


                $('.reaction-div').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", function(){
                    $('.reaction-div').removeClass('zoomin-astronaut');
                    $('.reaction-div').removeClass('animate-zoomOut');
                    // $('.reaction-div').addClass('zoomin-astronaut');
                    // returnAstronautAnimation();
                    // $('.reaction-div').css('transition', 'transform 3s ease 0s');
                });
            }
            
            astronaut_zoom = !astronaut_zoom;
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

        // $('.navigator-zoomout').click();

        function removeAstronautAnimation()
        {
            clearInterval(animation_interval);
            // $('.reaction-div').css('transition', 'none');
        }

        function returnAstronautAnimation()
        {
            // init();
            // $('.reaction-div').css('transition', 'transform 3s ease 0s');
        }

        $('.img-button').hover(
            function () {
                $(this).parent().find('span').show();
            },
            function () {
                $(this).parent().find('span').hide();
            }
        );

        $('.astronaut-butt').click(function () {
            var sound_effect = document.getElementById("stop_it_se");
            sound_effect.play();

            sound_effect.onended = function () {
                sound_effect.pause();
                sound_effect.currentTime = 0;
            };
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

        // open comments section
        $('.reaction-button .comments img').click( function() {
            goToComments();
        });
    </script>
    <script>
        // taken from mo.js demos
        function isIOSSafari() {
            var userAgent;
            userAgent = window.navigator.userAgent;
            return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
        };

        // taken from mo.js demos
        function isTouch() {
            var isIETouch;
            isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
            return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
        };

        // taken from mo.js demos
        var isIOS = isIOSSafari(),
            clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

        function extend(a, b) {
            for (var key in b) {
                if (b.hasOwnProperty(key)) {
                    a[key] = b[key];
                }
            }
            return a;
        }

        function Animocon(el, options) {
            this.el = el;
            this.options = extend({}, this.options);
            extend(this.options, options);

            this.checked = false;

            this.timeline = new mojs.Timeline();

            for (var i = 0, len = this.options.tweens.length; i < len; ++i) {
                this.timeline.add(this.options.tweens[i]);
            }

            var self = this;
            this.el.addEventListener('click', function () {
                if (self.checked) {
                    self.options.onUnCheck();
                } else {
                    self.options.onCheck();
                    self.timeline.replay();
                }
                self.checked = !self.checked;
            });
        }

        Animocon.prototype.options = {
            tweens: [
                new mojs.Burst({})
            ],
            onCheck: function () {
                return false;
            },
            onUnCheck: function () {
                return false;
            }
        };

        /* Icon 3 */
        var el8 = document.querySelector('.reaction-popup button'),
            el8span = el8.querySelector('img');
        var scaleCurve8 = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');
        new Animocon(el8, {
            tweens: [
                // burst animation
                new mojs.Burst({
                    parent: el8,
                    count: 28,
                    radius: {
                        50: 110
                    },
                    children: {
                        fill: '#988ADE',
                        opacity: 0.6,
                        radius: {
                            'rand(5,20)': 0
                        },
                        scale: 1,
                        swirlSize: 15,
                        duration: 1600,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1),
                        isSwirl: true
                    }
                }),
                // burst animation
                new mojs.Burst({
                    parent: el8,
                    count: 18,
                    angle: {
                        0: 10
                    },
                    radius: {
                        140: 200
                    },
                    children: {
                        fill: '#988ADE',
                        shape: 'line',
                        opacity: 0.6,
                        radius: {
                            'rand(5,20)': 0
                        },
                        scale: 1,
                        stroke: '#988ADE',
                        strokeWidth: 2,
                        duration: 1800,
                        delay: 300,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }
                }),
                // burst animation
                new mojs.Burst({
                    parent: el8,
                    radius: {
                        40: 80
                    },
                    count: 18,
                    children: {
                        fill: '#988ADE',
                        opacity: 0.6,
                        radius: {
                            'rand(5,20)': 0
                        },
                        scale: 1,
                        swirlSize: 15,
                        duration: 2000,
                        delay: 500,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1),
                        isSwirl: true
                    }
                }),
                // burst animation
                new mojs.Burst({
                    parent: el8,
                    count: 20,
                    angle: {
                        0: -10
                    },
                    radius: {
                        90: 130
                    },
                    children: {
                        fill: '#988ADE',
                        opacity: 0.6,
                        radius: {
                            'rand(10,20)': 0
                        },
                        scale: 1,
                        duration: 3000,
                        delay: 750,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }
                }),
                // icon scale animation
                new mojs.Tween({
                    duration: 400,
                    easing: mojs.easing.back.out,
                    onUpdate: function (progress) {
                        var scaleProgress = scaleCurve8(progress);
                        el8span.style.WebkitTransform = el8span.style.transform = 'scale3d(' +
                            progress + ',' + progress + ',1)';
                    }
                })
            ],
            onCheck: function () {
                el8.style.color = '#988ADE';
            },
            onUnCheck: function () {
                el8.style.color = '#C0C1C3';
            }
        });
        /* Icon 3 */

        $('#share-blog-btn').click(function(e) {
            e.preventDefault();

            var form_url = url+'/share_blog';
            var $form = $('form#share-blog-form');

            var post_data = new FormData($form[0]);

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#shareBlogModal').modal('hide');
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: data.message,
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                },
                error: function (request, status, error) {
                    $('#shareBlogModal').modal('hide');
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
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#shareBlogModal').modal('show');
                    });
                }
            });
        });
    </script>
    @endsection