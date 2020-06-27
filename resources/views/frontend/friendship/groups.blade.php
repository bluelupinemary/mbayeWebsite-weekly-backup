@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/groups.css')}}">
@endsection

@section('content')
<div id="page-content">
<div class="app">
    <div id="wrapper">
        <div class="section left-section">
            <div id="origin" class="fbox">
                {{-- <div id="one" title="Friend 1" class="draggable friend friend-1" data-top="39" data-left="47">
                    <img src="{{asset('front/images/user-image/image-1.jpg')}}"/>
                </div>

                <div id="two" title="Friend 2" class="draggable friend friend-2" data-top="69" data-left="7.5">
                    <img src="{{asset('front/images/user-image/image-2.jpg')}}"/>
                </div>

                <div id="three" title="Friend 3" class="draggable friend friend-3" data-top="8" data-left="82">
                    <img src="{{asset('front/images/user-image/image-3.jpg')}}"/>
                </div>

                <div id="four" title="Friend 4" class="draggable friend friend-4" data-top="6.5" data-left="31.3">
                    <img src="{{asset('front/images/user-image/image-4.jfif')}}"/>
                </div>

                <div id="five" title="Friend 5" class="draggable friend friend-5" data-top="52" data-left="69.5">
                    <img src="{{asset('front/images/user-image/image-5.png')}}"/>
                </div> --}}

                {{-- <div id="six" title="Friend 6" class="draggable friend friend-6" data-top="70" data-left="35.5">
                    <img src="{{asset('front/images/user-image/image-6.jpg')}}"/>
                </div> --}}

                {{-- <div id="seven" title="Friend 7" class="draggable friend friend-7" data-top="34" data-left="83">
                    <img src="{{asset('front/images/user-image/image-7.jpg')}}"/>
                </div>

                <div id="eight" title="Friend 8" class="draggable friend friend-8" data-top="23" data-left="3.5">
                    <img src="{{asset('front/images/user-image/image-8.jpg')}}"/>
                </div>

                <div id="nine" title="Friend 9" class="draggable friend friend-9" data-top="74" data-left="79">
                    <img src="{{asset('front/images/user-image/image-9.jfif')}}"/>
                </div>

                <div id="ten" title="Friend 10" class="draggable friend friend-10" data-top="20" data-left="53.5">
                    <img src="{{asset('front/images/user-image/image-10.jpg')}}"/>
                </div>

                <div id="eleven" title="Friend 11" class="draggable friend friend-11" data-top="31" data-left="23">
                    <img src="{{asset('front/images/user-image/image-11.jpg')}}"/>
                </div>

                <div id="twelve" title="Friend 12" class="draggable friend friend-12" data-top="53" data-left="26.5">
                    <img src="{{asset('front/images/user-image/image-12.jpg')}}"/>
                </div>

                <div id="thirteen" title="Friend 13" class="draggable friend friend-13" data-top="45.5" data-left="5">
                    <img src="{{asset('front/images/user-image/image-13.jpg')}}"/>
                </div>

                <div id="fourteen" title="Friend 14" class="draggable friend friend-14" data-top="2" data-left="56.5">
                    <img src="{{asset('front/images/user-image/image-14.jpg')}}"/>
                </div>

                <div id="fifteen" title="Friend 15" class="draggable friend friend-15" data-top="80" data-left="60.5">
                    <img src="{{asset('front/images/user-image/image-15.jpg')}}"/>
                </div> --}}
                <button class="pagination previous-page">
                    <i class="fas fa-chevron-circle-left"></i>
                </button>
                <button class="pagination next-page">
                    <i class="fas fa-chevron-circle-right"></i>
                </button>
            </div>
        </div>
        <div class="section right-section">
            <div id="drop" class="fbox">
        
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('after-scripts')
    <script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/JS/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
   <!-- Entire bundle -->
{{-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script> --}}
    <script>
        var url = $('meta[name="url"]').attr('content');
        var selected_friends = new Array();
        var friends_position = {
            1: {
                top: 39,
                left: 47
            }, 
            2: {
                top: 69,
                left: 7.5
            },
            3: {
                top: 8,
                left: 82
            },
            4: {
                top: 6.5,
                left: 31.3
            },
            5: {
                top: 52,
                left: 69.5
            }
        };

        $(document).ready(function() {
            fetchFriends();
        });
        
        function initializeDraggable() {
            $(".draggable").draggable({ cursor: "crosshair"});
            $("#drop").droppable({ accept: ".draggable", 
                drop: function(event, ui) {
                    console.log("drop");
                    $(this).removeClass("border").removeClass("over");
                    var dropped = ui.draggable;
                    var droppedOn = $(this);
                    selected_friends.push(dropped.data('user-id'));
                    console.log('selected friends: '+selected_friends);
                    $(dropped).detach().appendTo(droppedOn);  
                }, 
                over: function(event, elem) {
                        $(this).addClass("over");
                        console.log("over");
                },
                out: function(event, elem) {
                    $(this).removeClass("over");
                }
            });

            $("#origin").droppable({ accept: ".draggable", drop: function(event, ui) {
                console.log("drop");
                $(this).removeClass("border").removeClass("over");
                var dropped = ui.draggable;
                var droppedOn = $(this);
                var top = $(dropped).data('top');
                var left = $(dropped).data('left');

                $(dropped).detach().css({top: top+'%',left: left+'%'}).appendTo(droppedOn);      
                // $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);
            }});
        }
        
        var total_page;
        var current_page;

        function fetchFriends(page = 1)
        {
            $.get(url+"/fetchfriends?page="+page, function(data, status){
                console.log(data);
                current_page = data.current_page;
                total_page = data.last_page;
                paginationButton();
                $('#origin .friend').remove();
                
                $.each( data.data, function( key, value ) {
                    if($.inArray(value.id, selected_friends) == -1) {
                        key = key + 1;

                        if(value.photo) {
                            if(value.photo.includes('-cropped')) {
                                value.photo = 'crop/'+value.photo;
                            }
                        } else {
                            value.photo = 'default.png';
                        }

                        var position = friends_position[key];

                        var html = `<div id="`+key+`" title="`+value.username+`" class="draggable friend friend-`+key+`" data-top="`+position.top+`" data-left="`+position.left+`" data-user-id="`+value.id+`">
                                        <img src="`+url+`/storage/profilepicture/`+value.photo+`"/>
                                    </div>`;
                        // $('.friend-'+key).css('filter', 'drop-shadow(0px 0px 10px '+getRandomColor()+')');
                        $('#origin').append(html);
                        initializeDraggable();
                    }
                });
            });
        }

        function paginationButton()
        {
            console.log("current_page: "+current_page);
            if(current_page == 1) {
                $('.previous-page').prop('disabled', true);
            } else {
                $('.previous-page').prop('disabled', false);
            }

            if(current_page < total_page)
            {
                $('.next-page').prop('disabled', false);
            } else {
                $('.next-page').prop('disabled', true);
            }
        }

        $('.previous-page').click(function() {
            if(current_page > 1) {
                fetchFriends(current_page-1);
            }
        });

        $('.next-page').click(function() {
            if(current_page < total_page) {
                fetchFriends(current_page+1);
            }
        });

        function getRandomColor()
        {
            var colorR = Math.floor((Math.random() * 256));
            var colorG = Math.floor((Math.random() * 256));
            var colorB = Math.floor((Math.random() * 256));

            return 'rgb('+colorR+', '+colorG+', '+colorB+')';
        }
    </script>
@endsection
