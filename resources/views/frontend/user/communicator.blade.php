@extends('frontend.layouts.profile_layout')

@section('before-styles')
    <style>
    </style>
@endsection

@section('after-styles')
    @trixassets
    <link rel="stylesheet" type="text/css" href="{{asset('front/slick/slick.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/system-google-font-picker/jquery.fontselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/CSS/communicator.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/communicator-responsive.css')}}">
@endsection

@section('content')
<div id="page-content">
    <div class="communicator">
        <div class="main-screen">
            {{-- <button type="button" class="start-btn">Click here to start</button> --}}
            <div class="astronautarm-img" style="background-image: url({{access()->user()->getCommunicator()}});">
                <div class="menu-div">
                    {{-- <button class="blog-btn">BLOG</button>
                    <button class="groups-btn">GROUPS</button>
                    <button class="yourstars-btn">YOUR STARS</button>
                    <button class="connect-btn">CONNECT</button>
                    <button class="careers-btn">CAREERS</button> --}}
                    <img src="{{asset('front/images/communicator-buttons/buttons/blogsBtn.png')}}" alt="" class="blog-btn">
                    <img src="{{asset('front/images/communicator-buttons/buttons/groupsBtn.png')}}" alt="" class="groups-btn">
                    <img src="{{asset('front/images/communicator-buttons/buttons/yourStarsBtn.png')}}" alt="" class="yourstars-btn">
                    <img src="{{asset('front/images/communicator-buttons/buttons/connectBtn.png')}}" alt="" class="connect-btn">
                    <img src="{{asset('front/images/communicator-buttons/buttons/careersBtn.png')}}" alt="" class="careers-btn">
                    <div class="submenu blog-submenu">
                        <ul>
                            <li><a href="" class="create-blog"><i class="fas fa-plus"></i> Create New Blog</a></li>
                            <li><a href="" class="view-all-blogs"><i class="fas fa-list"></i> View All Blogs</a></li>
                        </ul>
                    </div>
                    {{-- <div class="submenu groups-submenu">
                        <ul>
                            <li><a href="" class="create-blog"><i class="fas fa-plus"></i> Create New Groups</a></li>
                            <li><a href="" class="view-all-blogs"><i class="fas fa-list"></i> View All Groups</a></li>
                        </ul>
                    </div> --}}
                    <div class="submenu career-submenu">
                        <ul>
                            <li><a href="" class="create-career-blog"><i class="fas fa-plus"></i> Create Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-form">
                    <form method="POST" action="{{url('blogs')}}" id="main-form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="TITLE" autocomplete="off">
                        <button class="add-video-btn">Insert Video</button>
                        <div class="video-form">
                            <label>Attach Link</label>
                            <div class="video-input">
                                <input type="text" name="video_link">
                                <button class="video-insert-btn">Insert</button>
                            </div>
                            <div class="video-links-list">
                                <table>
                                </table>
                            </div>
                        </div>
                        <input type="file" name="featured_image" accept="image/x-png,image/jpeg" id="featured_image">
                        <input type="hidden" name="edited_featured_image">
                        <input type="checkbox" name="films_tag" id="films_tag" value="0" data-id="1">
                        <input type="checkbox" name="sports_tag" id="sports_tag" value="0" data-id="2">
                        <input type="checkbox" name="mountains_tag" id="mountains_tag" value="0" data-id="3">
                        <input type="checkbox" name="music_tag" id="music_tag" value="0" data-id="4">
                        <input type="checkbox" name="politics_tag" id="politics_tag" value="0" data-id="5">
                        <input type="checkbox" name="family_tag" id="family_tag" value="0" data-id="6">
                        <input type="checkbox" name="travel_tag" id="travel_tag" value="0" data-id="7">
                        <input type="checkbox" name="career_tag" id="career_tag" value="0" data-id="9">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="blog_id">
                        <input type="hidden" name="save_status" value="Draft">
                    </form>
                    <div class="trix-editor">
                        <div class="font-picker">
                            <input id="font-picker" type="text">
                        </div>
                        <div class="color-picker">
                        </div>
                        {{-- <input type="hidden" name="edit_content" id="edit_content"> --}}
                        @trix(\App\Blogs\Blog::class, 'content', ['id' => 'edit_content'])
                        <button type="button" class="fullscreen"><i class="fas fa-expand"></i> <span>Fullscreen</span></button>
                    </div>
                    <div class="custom-privacy" data-toggle="modal" data-target="#customPrivacyModal">
                        <button>Set Privacy</button>
                    </div>
                </div>
                <div class="email-form">
                    <form action="{{url('/send_contact_email')}}" method="post" id="email-form">
                        @csrf
                        <select name="subject" id="" class="form-control">
                            <option value="" disabled selected>Subject</option>
                            <option value="Report Page Issues">Report Page Issues</option>
                            <option value="Report Game Bugs">Report Game Bugs</option>
                            <option value="Report a Member">Report a Member</option>
                            <option value="Help and Support">Help and Support</option>
                            <option value="Suggestions and Improvements - Pages">Suggestions and Improvements - Pages</option>
                            <option value="Suggestions and Improvements - Game">Suggestions and Improvements - Game</option>
                        </select>
                        <div class="trix-editor trix-editor-email">
                            <div class="font-picker">
                                <input id="font-picker" type="text">
                            </div>
                            <div class="color-picker email-color-picker">
                            </div>
                            @trix(\App\Blogs\Blog::class, 'email_content')
                            <button type="button" class="fullscreen email_fullscreen"><i class="fas fa-expand"></i> <span>Fullscreen</span></button>
                        </div>
                    </form>
                </div>
                <div class="general-blog-form">
                    <form method="POST" action="{{url('publish_general_blog')}}" id="general-blog-form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="TITLE" autocomplete="off">
                        <input type="hidden" name="blog_id">
                        <button class="add-video-btn">Insert Video</button>
                        <div class="video-form">
                            <label>Attach Link</label>
                            <div class="video-input">
                                <input type="text" name="video_link">
                                <button class="video-insert-btn">Insert</button>
                            </div>
                            <div class="video-links-list">
                                <table>
                                </table>
                            </div>
                        </div>
                        <input type="file" name="featured_image" accept="image/x-png,image/jpeg" id="general_blog_featured_image">
                        <input type="hidden" name="edited_featured_image">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="blog_id">
                        {{-- <input type="hidden" name="save_status" value="Draft"> --}}
                    </form>
                    <div class="trix-editor trix-editor-general-blog">
                        <div class="font-picker">
                            <input id="font-picker" type="text">
                        </div>
                        <div class="color-picker general-blogs-color-picker">
                        </div>
                        {{-- <input type="hidden" name="edit_content" id="edit_content"> --}}
                        @trix(\App\Blogs\Blog::class, 'general_blog_content')
                        <button type="button" class="fullscreen"><i class="fas fa-expand"></i> <span>Fullscreen</span></button>
                    </div>
                    <div class="custom-privacy" data-toggle="modal" data-target="#customPrivacyModal">
                        <button>Set Privacy</button>
                    </div>
                </div>
                <div class="designs-blog-form">
                    <form method="POST" action="{{url('publish_designs_blog')}}" id="designs-blog-form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="TITLE" autocomplete="off">
                        <select name="panel_id" class="form-control" id="panel_list">
                            <option value="" disabled selected>Panel Number</option>
                            @foreach (Auth::user()->getPanels() as $panel)
                                <option value="{{$panel->id}}" data-flowers="{{$panel->flowers_used}}" data-screenshot="{{$panel->screenshot}}">{{$panel->panel_number}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="file" name="featured_image" accept="image/x-png,image/jpeg" id="designs_blog_featured_image"> --}}
                        <input type="hidden" name="featured_image" id="designs_blog_featured_image">
                        <input type="hidden" name="edited_featured_image">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="blog_id">
                        <input type="hidden" name="save_status" value="Draft">
                    </form>
                    <div class="trix-editor trix-editor-designs-blog">
                        <div class="font-picker">
                            <input id="font-picker" type="text">
                        </div>
                        <div class="color-picker designs-blogs-color-picker">
                        </div>
                        {{-- <input type="hidden" name="edit_content" id="edit_content"> --}}
                        @trix(\App\Blogs\Blog::class, 'designs_blog_content')
                        <button type="button" class="fullscreen"><i class="fas fa-expand"></i> <span>Fullscreen</span></button>
                    </div>
                    <div class="custom-privacy" data-toggle="modal" data-target="#customPrivacyModal">
                        <button>Set Privacy</button>
                    </div>
                    <div class="custom-privacy flower-list" data-toggle="modal" data-target="#flowerListModal">
                        <button disabled>List Flowers</button>
                    </div>
                </div>
                <div class="home-div">
                    <img src="{{asset('front/images/communicator-buttons/home.png')}}" class="communicator-button home-button" alt="">
                </div>
                <div class="communicator-buttons">
                    {{-- <button type="submit" class="save-button" form="main-form"></button>
                    <button class="publish-button"></button> --}}
                    <img src="{{asset('front/images/communicator-buttons/buttons/saveBtn.png')}}" class="communicator-button save-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/saveTxt.png')}}" class="save-text" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchBtn.png')}}" class="communicator-button publish-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchTxt.png')}}" class="publish-text" alt="">
                        
                    {{-- <div class="save-div">
                        <img src="{{asset('front/images/communicator-buttons/buttons/saveBtn.png')}}" class="communicator-button save-button" alt="">
                        <p class="save-text">SAVE</p>
                    </div>
                    <div class="launch-div">
                        <img src="{{asset('front/images/communicator-buttons/buttons/launchBtn.png')}}" class="communicator-button publish-button" alt="">
                        <p class="launch-text">LAUNCH</p>
                    </div> --}}
                </div>
                <div class="email-buttons">
                    <img src="{{asset('front/images/communicator-buttons/buttons/email-button-1.png')}}" class="communicator-button email-send" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/email-button-2.png')}}" class="email-text" alt="">
                </div>
                <div class="general-blog-buttons">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchBtn.png')}}" class="communicator-button publish-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchTxt.png')}}" class="publish-text" alt="">
                </div>
                <div class="designs-blog-buttons">
                    <img src="{{asset('front/images/communicator-buttons/buttons/saveBtn.png')}}" class="communicator-button save-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/saveTxt.png')}}" class="save-text" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchBtn.png')}}" class="communicator-button publish-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/launchTxt.png')}}" class="publish-text" alt="">
                </div>
                <div class="email-div">
                    <img src="{{asset('front/images/communicator-buttons/buttons/emailBtn.png')}}" class="communicator-button email-button" alt="">
                </div>
                <div class="chat-div">
                    <img src="{{asset('front/images/communicator-buttons/buttons/chatBtn.png')}}" class="communicator-button chat-button" alt="">
                </div>
                <div class="menu-div-2">
                    <img src="{{asset('front/images/communicator-buttons/buttons/storyCareBtn.png')}}" class="communicator-button chat-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/yourProfileBtn.png')}}" class="communicator-button chat-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/buttons/designsBtn.png')}}" class="communicator-button designs-button" alt="">
                </div>
                <div class="featured-image-div all-blog">
                    <div class="featured-image-preview">
                        <p class="featured-image-text">Upload your featured image here</p>
                        <p class="featured-image-remove">Remove Image</p>
                        <img src="" id="featured-image-previewimg" class="preview-image">
                    </div>
                    <label for="featured_image" class="custom-file-upload">
                        Upload
                    </label>
                    <button class="edit_image" data-toggle="modal" data-target="#photoEditorModal" disabled="">
                        Edit
                    </button>
                </div>
                <div class="featured-image-div general-blog">
                    <div class="featured-image-preview">
                        <p class="featured-image-text">Upload your featured image here</p>
                        <p class="featured-image-remove">Remove Image</p>
                        <img src="" id="featured-image-previewimg" class="preview-image">
                    </div>
                    <label for="general_blog_featured_image" class="custom-file-upload">
                        Upload
                    </label>
                    <button class="edit_image" data-toggle="modal" data-target="#generalBlogPhotoEditorModal" disabled="">
                        Edit
                    </button>
                </div>
                <div class="featured-image-div designs-blog">
                    <div class="featured-image-preview">
                        <p class="featured-image-text">Featured Image</p>
                        {{-- <p class="featured-image-remove">Remove Image</p> --}}
                        <img src="" id="featured-image-previewimg" class="preview-image">
                    </div>
                    {{-- <label for="designs_blog_featured_image" class="custom-file-upload">
                        Upload
                    </label> --}}
                    <button class="edit_image" data-toggle="modal" data-target="#designsBlogPhotoEditorModal" disabled="">
                        Edit
                    </button>
                </div>
                <div class="show-instruction">
                    <a class="">Show Instructions</a>
                </div>
                <div class="tos-div">
                    <img src="{{asset('front/images/communicator-buttons/buttons/termsBtn.png')}}" class="communicator-button tos-button" alt="">
                </div>
                <div class="music-player">
                    <canvas id="canvas"></canvas>
                    <div id="bars">
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                        <div class="bar bar-animated"></div>
                    </div>

                    <span class="close-btn"><i class="far fa-times-circle"></i></span>
                    <div class="music-desc">
                        <p class="music-title">Music title</p>
                        <p class="music-singer">Singer here</p>
                    </div>

                    <button class="music-button play-button"><i class="fas fa-play"></i></button>
                    <button class="music-button pause-button"><i class="fas fa-pause"></i></button>

                    <div class="volume-progress">
                        <div class="progress progress-vertical">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="mute-music"><i class="fas fa-volume-up"></i></span>
                    </div>
                    
                    <audio id="music_player" preload="auto"></audio>

                    <ul class="playlist">
                        <li data-src="{{asset('front/images/audio/BlueMoonNatKingCole.mp3')}}" data-songtitle="Blue Moon" data-artist="Nat King Cole"></li>
                        <li data-src="{{asset('front/images/audio/Bruce Springsteen - I\'m on Fire.mp3')}}" data-songtitle="I'm on Fire" data-artist="Bruce Springsteen"></li>
                        <li data-src="{{asset('front/images/audio/Don McLean - Vincent ( Starry, Starry Night).mp3')}}" data-songtitle="Vincent ( Starry, Starry Night)" data-artist="Don McLean"></li>
                    </ul>
                </div>
                <div class="music-knobs-colors next-colors">
                    <div class="slick-carousel colors-slider next-colors-slider">
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                    </div>
                </div>
                <div class="music-knobs music-knobs-1">
                    <div class="slick-carousel slick-carousel-1">
                        
                        <div><img src="{{asset('front/images/music-knobs/letter-n.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-e.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-x.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-t.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/blank.png')}}" class="img-responsive">
                            
                        </div>
                     </div>
                </div>
                <div class="music-knobs-colors volume-colors">
                    <div class="slick-carousel colors-slider volume-colors-slider">
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                        <div class="red"></div>
                        <div class="white"></div>
                    </div>
                </div>
                <div class="music-knobs music-knobs-2">
                    <div class="slick-carousel slick-carousel-2">
                        
                        <div><img src="{{asset('front/images/music-knobs/letter-v.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-o.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-l.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-u.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-m.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/letter-e.png')}}" class="img-responsive">
                        </div>
                        <div><img src="{{asset('front/images/music-knobs/blank.png')}}" class="img-responsive">
                            
                        </div>
                     </div>
                </div>
                <div class="blog-tags">
                    <img src="{{asset('front/images/communicator-buttons/filmsBtn.png')}}" alt="" class="tag-btn films-btn" data-tag="films">
                    <img src="{{asset('front/images/communicator-buttons/sportsBtn.png')}}" alt="" class="tag-btn sports-btn" data-tag="sports">
                    <img src="{{asset('front/images/communicator-buttons/mountainsBtn.png')}}" alt="" class="tag-btn mountains-btn" data-tag="mountains">
                    <img src="{{asset('front/images/communicator-buttons/musicBtn.png')}}" alt="" class="tag-btn music-btn" data-tag="music">
                    <img src="{{asset('front/images/communicator-buttons/politicsBtn.png')}}" alt="" class="tag-btn politics-btn" data-tag="politics">
                    <img src="{{asset('front/images/communicator-buttons/familyBtn.png')}}" alt="" class="tag-btn family-btn" data-tag="family">
                    <img src="{{asset('front/images/communicator-buttons/travelBtn.png')}}" alt="" class="tag-btn travel-btn" data-tag="travel">
                </div>
                <div class="top-buttons">
                    <img src="{{asset('front/images/communicator-buttons/Back.png')}}" class="communicator-button back-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/ExtraButtonA.png')}}" class="communicator-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/ExtraButtonB.png')}}" class="communicator-button" alt="">
                    <img src="{{asset('front/images/communicator-buttons/General.png')}}" class="communicator-button general-button" alt="">
                    <div class="submenu general-submenu">
                        <ul>
                            <li><a href="" class="create-general-blog"><i class="fas fa-plus"></i> Create New Story</a></li>
                            <li><a href="" class="view-all-general-blogs"><i class="fas fa-list"></i> View All Stories of the day</a></li>
                        </ul>
                    </div>
                </div>
                <div class="camera-div">
                    <img src="{{asset('front/images/communicator-buttons/Camera.png')}}" class="communicator-button" alt="">
                </div>
                <div class="voice-recorder-div">
                    <img src="{{asset('front/images/communicator-buttons/VoiceRecord.png')}}" class="communicator-button" alt="">
                </div>
                <div class="instructions">
                    <span class="instruction-close-btn"><i class="far fa-times-circle"></i></span>
                    <div class="instruction instruction-1" data-text-div="instruction-text-1"></div>
                    <div class="instruction instruction-2" data-text-div="instruction-text-2"></div>
                    <div class="instruction instruction-3" data-text-div="instruction-text-3"></div>
                    <div class="instruction instruction-4" data-text-div="instruction-text-4"></div>
                    <div class="instruction instruction-5" data-text-div="instruction-text-5"></div>
                    <div class="instruction instruction-6" data-text-div="instruction-text-6"></div>
                    <div class="instruction instruction-7" data-text-div="instruction-text-7"></div>
                    <div class="instruction instruction-8" data-text-div="instruction-text-8"></div>
                    <div class="instruction instruction-9" data-text-div="instruction-text-9"></div>
    
                    <div class="instruction-text instruction-text-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-7">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-8">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="instruction-text instruction-text-9">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                </div>
            </div>
            <div class="start-div">
                <p>Click here to start</p>
            </div>
        </div>
        {{-- <div>
            <div class="trix-content">{!! nl2br($user->blogcontent) !!}</div>
        </div> --}}
        <div class="text-editor-fullview blog-content">
            <div class="font-picker">
                <input id="font-picker" type="text">
            </div>
            <div class="color-picker fullscreen-blog-color-picker">
            </div>
            @trix(\App\Blogs\Blog::class, 'content')
            <button type="button" class="exit-fullscreen"><i class="fas fa-compress"></i> <span>Exit Fullscreen</span></button>
        </div>
        <div class="text-editor-fullview general-blog-content">
            <div class="font-picker">
                <input id="font-picker" type="text">
            </div>
            <div class="color-picker fullscreen-genblog-color-picker">
            </div>
            @trix(\App\Blogs\Blog::class, 'general_blog_content')
            <button type="button" class="exit-general-blog-fullscreen"><i class="fas fa-compress"></i> <span>Exit Fullscreen</span></button>
        </div>
        <div class="text-editor-fullview designs-blog-content">
            <div class="font-picker">
                <input id="font-picker" type="text">
            </div>
            <div class="color-picker fullscreen-designs-blog-color-picker">
            </div>
            @trix(\App\Blogs\Blog::class, 'designs_blog_content')
            <button type="button" class="exit-designs-blog-fullscreen"><i class="fas fa-compress"></i> <span>Exit Fullscreen</span></button>
        </div>
        <div class="text-editor-fullview email-content">
            <div class="font-picker">
                <input id="font-picker" type="text">
            </div>
            <div class="color-picker fullscreen-email-color-picker">
            </div>
            @trix(\App\Blogs\Blog::class, 'email_content')
            <button type="button" class="exit-email-fullscreen"><i class="fas fa-compress"></i> <span>Exit Fullscreen</span></button>
        </div>
        <!-- Modal -->
    
    </div>
    <div id="app"></div>
</div>
<div class="app">
<div class="modal photo-editor-modal" id="photoEditorModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <photoeditor-component :edit_blog="{{($blog != '' ? 1 : 0)}}"></photoeditor-component>
        </div>
        </div>
    </div>
</div>
<div class="modal photo-editor-modal" id="generalBlogPhotoEditorModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <general-photoeditor-component></general-photoeditor-component>
        </div>
        </div>
    </div>
</div>
<div class="modal photo-editor-modal" id="designsBlogPhotoEditorModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <designsphotoeditor-component></designsphotoeditor-component>
        </div>
        </div>
    </div>
</div>
</div>
<div class="modal" id="customPrivacyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLongTitle">Set Blog Privacy</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="custom-privacy-body">
                <div class="search-box">
                    <input type="text" class="form-control search-groups" placeholder="Search group">
                </div>

                <fieldset>
                    <form action="" id="custom-privacy-form">
                        @foreach (Auth::user()->getGroups() as $group)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$group->id}}" name="group_ids[]" id="{{strtolower($group->name)}}">
                                <label class="form-check-label" for="defaultCheck1">
                                {{$group->name}}
                                </label>
                            </div>
                        @endforeach
                        <p>No matching group found.</p>
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-primary custom-privacy-done">Done</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="flowerListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLongTitle">List of Flowers</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="flower-list-div">
                <div class="flower">
                    <img src="{{asset('front/images3D/flowers2D/1A.png')}}" alt="">
                    <p class="flower-name">Protea</p>
                </div>
                <div class="flower">
                    <img src="{{asset('front/images3D/flowers2D/1A.png')}}" alt="">
                    <p class="flower-name">Protea</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Done</button> --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/JS/musicplay.js')}}" type="text/jscript"></script>
    <script src="{{asset('front/JS/music-wave.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('front/slick/slick.min.js')}}"></script>
    <script src="{{asset('front/JS/piklor.min.js')}}"></script>
    <script src="{{asset('front/system-google-font-picker/jquery.fontselect.js')}}"></script>
    @if($blog != '')
    <script>
        var blog = {!! json_encode($blog->toArray()) !!};

        document.addEventListener('DOMContentLoaded', ()=> {
            if(window_url.includes('?') && ($.urlParam('action') == 'edit_blog' || $.urlParam('action') == 'edit_career_blog')) {
                $('.main-form .trix-editor trix-editor').html(blog.content);
            } else if (window_url.includes('?') && $.urlParam('action') == 'edit_design_blog') {
                $('.designs-blog-form .trix-editor trix-editor').html(blog.content);
            } else if (window_url.includes('?') && $.urlParam('action') == 'edit_general_blog') {
                $('.general-blog-form .trix-editor trix-editor').html(blog.content);
            }
        });
    </script>
    @endif

    <script src="{{asset('front/JS/communicator.js')}}"></script>
@endsection
