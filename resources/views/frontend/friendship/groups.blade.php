@extends('frontend.layouts.profile_layout')

@section('after-styles')
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/CSS/groups.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rajdhani:300">
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection

@section('content')
<div id="page-content">
<div class="app">
    <div id="wrapper">
        <div class="section left-section">
            <div id="origin" class="fbox">
                <div class="scifiUI">
                    <div class="options-div">
                        <div class="options-header">
                            <p>Options</p>
                            <button><i class="fas fa-chevron-circle-down"></i></button>
                        </div>
                        <div class="options-body">
                            <ul class="options-list">
                                <li data-toggle="modal" data-target="#createGroupModal">Create Group</li>
                                <li class="edit-group">Edit Group Name</li>
                                <li data-toggle="modal" data-target="#deleteGroupModal">Delete Group</li>
                            </ul>
                        </div>
                    </div>
                  </div>

                <button class="pagination previous-page">
                    <i class="fas fa-chevron-circle-left"></i>
                </button>
                <div class="search-form">
                    <input type="text" class="form-control" name="search" autocomplete="off">
                    <button type="submit" class="btn search-btn">Search</button>
                </div>
                <button class="pagination next-page">
                    <i class="fas fa-chevron-circle-right"></i>
                </button>
            </div>
        </div>
        <div class="section right-section">
            <div id="drop" class="fbox">
                <div class="group-list-div">
                    <label for="">Group:</label>
                    <input type="text" placeholder="Select Group" id="selected_group_name" disabled>
                    <input type="hidden" name="group_id" id="selected_group_id">
                    <ul class="group-list">
                    </ul>
                    <button class="group-list-button"><i class="fas fa-chevron-circle-down"></i></button>
                </div>
                <div class="earthlings-div">
                    <div class="earthlings-header">
                        <p>Earthlings</p>
                        <button><i class="fas fa-chevron-circle-down"></i></button>
                    </div>
                    <div class="earthlings-body">
                        <ul class="earthlings-list">
                            {{-- <li><span class="friend-name">User1</span> <button class="remove-friend"><i class="fas fa-times"></i></button></li>
                            <li><span class="friend-name">User2</span> <button class="remove-friend"><i class="fas fa-times"></i></button></li> --}}
                        </ul>
                        <button class="save-group-friends">Save</button>
                    </div>
                </div>

                <button class="help-button">
                    <i class="far fa-question-circle"></i>
                </button>
            </div>
        </div>

        {{-- Create Group Modal --}}
        <div class="modal" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">Create Group</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="" id="create-group-form">
                        @csrf
                        <div class="form-group row">
                            <label for="group_name" class="col-sm-4 col-form-label">Group Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="group_name" name="group_name" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary" id="create_group" form="create-group-form">Save</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">Edit Group</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-group-form">
                        @csrf
                        <div class="form-group row">
                            <label for="group_name" class="col-sm-4 col-form-label">Group Name</label>
                            <div class="col-sm-8">
                                <input name="_method" type="hidden" value="PUT">
                                <input type="hidden" name="group_id">
                                <input type="text" class="form-control" id="group_name" name="group_name" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary" id="edit_group" form="edit-group-form">Save</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal" id="deleteGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLongTitle">Delete Group(s)</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="" id="delete-group-form">
                        <fieldset class="delete-group-fieldset">
                            
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-danger" id="delete_group" form="delete-group-form">Delete</button>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="instruction-div">
        <div class="instruction options">
            <div class="element"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div class="instruction search-pagination">
            <div class="element"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div class="drag-and-drop">
            <img src="{{asset('front/images/drag-and-drop-friends-3.gif')}}" alt="">
            <p>Drag and drop friends to add to a Group</p>
        </div>
        <div class="instruction groups">
            <div class="element"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div class="instruction earthlings">
            <div class="element"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <button class="help-button">
            <i class="far fa-question-circle"></i>
        </button>
    </div>
</div>
</div>
@endsection

@section('after-scripts')
<script src="{{asset('front/JS/jquery-1.9.1.js')}}"></script>
    <script src="{{asset('front/JS/jquery-1.12.4.js')}}"></script>
    <script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/JS/jquery-ui.js')}}"></script>
    <script src="{{asset('front/JS/jquery.ui.touch-punch.js')}}"></script>
    <script src="{{asset('front/JS/popper.min.js')}}"></script>
    
    
    
    <script src="{{asset('front/sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    <script>
        var url = $('meta[name="url"]').attr('content');
        var selected_friends = new Array();
        var search = '';

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
            },
            6: {
                top: 70,
                left: 35.5
            },
            7: {
                top: 34,
                left: 83
            },
            8: {
                top: 23,
                left: 3.5
            },
            9: {
                top: 74,
                left: 79
            },
            10: {
                top: 20,
                left: 53.5
            },
            11: {
                top: 4.5,
                left: 4.5
            },
            12: {
                top: 53,
                left: 26.5
            },
            13: {
                top: 45.5,
                left: 5
            },
            14: {
                top: 2,
                left: 56.5
            },
            15: {
                top: 80,
                left: 60.5
            }
        };

        $(document).ready(function() {
            initializeDroppable();
            fetchFriends();
            fetchGroups();
            $('.draggable').draggable( "option", "disabled", true);
        });
        
        function initializeDroppable() {
            $("#drop").droppable({ accept: ".draggable", 
                tolerance: 'fit',
                containment: 'parent',
                drop: function(event, ui) { 
                    console.log("drop");
                    $(this).removeClass("border").removeClass("over");
                    var dropped = ui.draggable;
                    var droppedOn = $(this);

                    // var offset =  dropped.offset();
                    // var mapOffest = droppedOn.offset();
                    
                    // var x = ((offset.left - mapOffest.left)/ ($(".map").width() / 100))+"%";
                    // var y = ((offset.top - mapOffest.top)/ ($(".map").height() / 100))+"%";
                                    
                    // // We need to do something with thoses vals uh?
                    // console.log('position:', x, y);
                    // dropped.css('left', x);
                    // dropped.css('top', y);

                    // var thisNew = ui.draggable;
                    // console.log(ui.position.top, ui.position.left);
                    // console.log(thisNew.parent().width(), thisNew.parent().height());
                    // var x = (ui.position.left / thisNew.parent().width()) * 100 + '%';
                    // var y = (ui.position.top / thisNew.parent().height()) * 100 + '%';

                    // thisNew.css('left', x);
                    // thisNew.css('top', y);

                    // console.log(x, y);

                    if($.inArray(dropped.data('user-id'), selected_friends) == -1) {
                        selected_friends.push(dropped.data('user-id'));
                        $('.earthlings-list').append(
                            `<li data-user-id="`+dropped.data('user-id')+`"><span class="friend-name">`+dropped.data('user-name')+`</span> <button class="remove-friend"><i class="fas fa-times"></i></button></li>`
                        );
                        $('.earthlings-body').show();
                        removeSelectedFriends();
                    }
                    
                    console.log('selected friends: '+selected_friends);
                    $(dropped).detach().appendTo(droppedOn);  
                }, 
                // over: function(event, elem) {
                //     $(this).addClass("over");
                //     console.log("over");
                //     $( "#origin" ).droppable({
                //         disabled: true
                //     });
                // },
                // out: function(event, elem) {
                //     $(this).removeClass("over");
                //     $( "#origin" ).droppable({
                //         disabled: false
                //     });
                // },
                // move: function(event, elem) {
                //     $('#origin').droppable("disable");
                // }
            });

            $("#origin").droppable({ 
                greedy: true, 
                tolerance: 'touch',
                drop: function(event, ui) {
                    ui.draggable.draggable('option','revert',true);
                    // console.log("drop");
                    // $(this).removeClass("border").removeClass("over");
                    // var dropped = ui.draggable;
                    // var droppedOn = $(this);
                    // var top = $(dropped).data('top');
                    // var left = $(dropped).data('left');

                    // $(dropped).detach().css({top: top+'%',left: left+'%'}).appendTo(droppedOn);      
                    // $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);
                }
            });
        }

        function initializeDraggable() {
            $(".draggable").draggable({ 
                cursor: "crosshair",
                revert: 'invalid',
                stop: function(event, ui) {
                    $(this).draggable('option','revert','invalid');
                }
            });
        }
        
        var total_page;
        var current_page;

        function fetchFriends(page = 1)
        {
            $.get(url+"/fetchfriends?page="+page+"&search="+search, function(data, status){
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
                        var box_color = getRandomColor();

                        var html = `<div id="`+key+`" title="`+value.first_name+` `+value.last_name+`" class="draggable origin friend friend-`+key+`" style="box-shadow: 0px 0px 10px `+box_color+`" data-top="`+position.top+`" data-left="`+position.left+`" data-user-id="`+value.id+`" data-user-name="`+value.first_name+` `+value.last_name+`">
                                        <div class="loader">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                        <img src="`+url+`/storage/profilepicture/`+value.photo+`" class="friend-photo"/>
                                    </div>`;
                        
                        $('#origin').append(html);
                        if($('#selected_group_name').val() != '') {
                            initializeDraggable();
                        }
                        $('.friend').tooltip({
                            track: true
                        });

                        $('.friend-photo').load(function() {
                            $(this).closest('div.friend').find('.loader').fadeOut();
                        });
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

        // function getRandomColor(){
        //     return `hsla(${~~(360 * Math.random())},70%,70%,0.8)`
        // }

        function fetchGroups()
        {
            $.get(url+"/groups", function(data, status){
                console.log(data);
                $('ul.group-list').empty();
                $('.delete-group-fieldset').empty();
                if(data.length) {
                    $.each( data, function( key, value ) {
                        $('ul.group-list').append(`
                            <li data-group-id="`+value.id+`" data-group-name="`+value.name+`" class="group-option"><a>`+value.name+`</a></li>
                        `);
                        $('.delete-group-fieldset').append(`
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="`+value.id+`" name="group_id[]">
                                <label class="form-check-label" for="group_id">
                                `+value.name+`
                                </label>
                            </div>
                        `);
                    });
                    getGroupMembers();

                } else {
                    $('ul.group-list').append(`
                        <li class="disabled">No Data Available.</li>
                    `);
                }
            });
        }

        $('.group-list-button').click(function() {
            $('.group-list').toggle();
        });

        $('#create_group').click(function(e) {
            e.preventDefault();

            var form_url = url+'/groups';
            var $form = $('form#create-group-form');

            var name = $form.find("input#group_name").val();
            var slug = name.replace(/\s+/g, '-').toLowerCase();
            // alert(name);return false;
            if(name =='')
            {
                Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: 'Group Name is Empty!',
                        html: 'Enter a Valid Group Name!',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        // $('#createGroupModal').modal('show');
                    });
                    return false;
            }  
            var post_data = new FormData($form[0]);
            post_data.append('group_name_slug', slug);
            post_data.append('user_id', '{{Auth::user()->id}}');

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
                    $('#createGroupModal').modal('hide');
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: 'Group created successfully!',
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                    fetchGroups();
                    $('#drop .friend').remove();
                    selected_friends = new Array();
                    $('.earthlings-list').empty();
                    $('#selected_group_name').val(data.name);
                    $('#selected_group_id').val(data.id);
                },
                error: function (request, status, error) {
                    $('#createGroupModal').modal('hide');
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Error!';

                    if(response.errors) {
                        title = 'Enter A Unique Group Name!';
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
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#createGroupModal').modal('show');
                    });
                }
            });
        });

        $('#edit_group').click(function(e) {
            e.preventDefault();

            
            var $form = $('form#edit-group-form');
            var group_id = $form.find('input[name="group_id"]').val();

            var name = $form.find("input[name='group_name']").val();
            var slug = name.replace(/\s+/g, '-').toLowerCase();

            var form_url = url+'/groups/'+group_id;

            var post_data = new FormData($form[0]);
            post_data.append('group_name_slug', slug);

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
                    $('#editGroupModal').modal('hide');
                    Swal.fire({
                        title: '<span class="success">Success!</span>',
                        text: 'Group name updated successfully!',
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        width: '30%',
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    });
                    fetchGroups();
                    $('#selected_group_name').val(data.name);
                    $('#selected_group_id').val(data.id);
                },
                error: function (request, status, error) {
                    $('#editGroupModal').modal('hide');
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
                        $('#editGroupModal').modal('show');
                    });
                }
            });
        });

        $('#delete_group').click(function(e) {
            e.preventDefault();
            
            var $form = $('form#delete-group-form');

            var form_url = url+'/delete_groups';
            
            if (!$('#delete-group-form :checkbox:checked').length > 0)
            {
                Swal.fire({
                        imageUrl: '../../front/icons/alert-icon.png',
                        imageWidth: 80,
                        imageHeight: 80,
                        imageAlt: 'Mbaye Logo',
                        title: "Group Not Selected!",
                        html: "Please select the group that you want to delete.",
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        $('#deleteGroupModal').modal('show');
                    });
                return false; 
            }
            var post_data = new FormData($form[0]);
            
            $('#deleteGroupModal').modal('hide');
            Swal.fire({
                text: "Are you sure you want to delete this group(s)?",
                imageUrl: '../../front/icons/alert-icon.png',
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: 'Mbaye Logo',
                padding: '1rem',
                background: 'rgba(8, 64, 147, 0.62)',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
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
                            $('#deleteGroupModal').modal('hide');
                            Swal.fire({
                                title: '<span class="success">Success!</span>',
                                text: data.message,
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            });
                            fetchGroups();
                            $('#selected_group_name').val('');
                            $('#selected_group_id').val('');
                        },
                        error: function (request, status, error) {
                            $('#deleteGroupModal').modal('hide');
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
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            }).then((res) => {
                                $('#deleteGroupModal').modal('show');
                            });
                        }
                    });
                } else {
                    $('#deleteGroupModal').modal('show');
                }
            });
            
        });

        $('.save-group-friends').click(function() {
            var form_url = url+'/store_group_friends';
            var post_data = new FormData();
            
            post_data.append('group_id', $('input#selected_group_id').val());
            post_data.append('friends', selected_friends);

            $.ajax({
                url: form_url,
                method: 'post',
                data: post_data,
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if(data.status =='success')
                    {
                        Swal.fire({
                            title: '<span class="success">'+data.title+'!</span>',
                            text: data.message,
                            imageUrl: '../../front/icons/alert-icon.png',
                            imageWidth: 80,
                            imageHeight: 80,
                            imageAlt: 'Mbaye Logo',
                            padding: '1rem',
                            background: 'rgba(8, 64, 147, 0.62)'
                        }).then((res) => {
                            // window.location.href = 
                        });
                    }
                    else
                    {
                        if(data.status =='error')
                        {
                            Swal.fire({
                                imageUrl: '../../front/icons/alert-icon.png',
                                imageWidth: 80,
                                imageHeight: 80,
                                imageAlt: 'Mbaye Logo',
                                title: data.title,
                                html: data.message,
                                padding: '1rem',
                                background: 'rgba(8, 64, 147, 0.62)'
                            }).then((res) => {
                                // $('#createGroupModal').modal('show');
                            }); 
                        }
                            
                    } 
                },
                error: function (request, status, error) {
                    // $('#createGroupModal').modal('hide');
                    var response = JSON.parse(request.responseText);
                    var errorString = '';
                    var title = 'Something Went Wrong!';

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
                        padding: '1rem',
                        background: 'rgba(8, 64, 147, 0.62)'
                    }).then((res) => {
                        // $('#createGroupModal').modal('show');
                    });
                }
            });
        });

        $('.search-btn').click(function() {
            search = $('input[name="search"]').val();

            // if(search) {
                $.get(url+"/fetchfriends?search="+search+"&page=1", function(data, status){
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
                            var box_color = getRandomColor();

                            var html = `<div id="`+key+`" title="`+value.first_name+` `+value.last_name+`" class="draggable origin friend friend-`+key+`" style="box-shadow: 0px 0px 10px `+box_color+`" data-top="`+position.top+`" data-left="`+position.left+`" data-user-id="`+value.id+`" data-user-name="`+value.first_name+` `+value.last_name+`">
                                            <div class="loader">
                                                <div class="dot"></div>
                                                <div class="dot"></div>
                                                <div class="dot"></div>
                                            </div>
                                            <img src="`+url+`/storage/profilepicture/`+value.photo+`" class="friend-photo"/>
                                        </div>`;
                            
                            $('#origin').append(html);
                            if($('#selected_group_name').val() != '') {
                                initializeDraggable();
                            }
                            $('.friend').tooltip({
                                track: true
                            });

                            $('.friend-photo').load(function() {
                                $(this).closest('div.friend').find('.loader').fadeOut();
                            });
                        }
                    });
                });
            // }
        });

        function removeSelectedFriends() {
            $('.remove-friend').click(function() {
                var user_id = $(this).closest('li').data('user-id');
                var friend_element = $('#drop div[data-user-id="'+user_id+'"]');
                // console.log(friend_element);
                // // $(friend_element).css({
                // //     top: $(friend_element)
                // // })
                // $('#origin').append(friend_element.css({
                //     top: friend_element.data('top')+'%',
                //     left: friend_element.data('left')+'%'
                // }).clone());
                friend_element.remove();
                selected_friends = jQuery.grep(selected_friends, function(value) {
                    return value != user_id;
                });
                $(this).closest('li').remove();
                fetchFriends();
                // initializeDraggable();
                // $('#drop div[data-user-id="'+user_id+'"]')
            });
        }

        function getGroupMembers() {
            $('li.group-option').click(function() {
                var name = $(this).data('group-name');
                var id = $(this).data('group-id');

                $.get(url+"/groups/"+id, function(data, status){
                    $('.earthlings-list').empty();
                    $('#drop .friend').remove();
                    $.each( data.members, function( key, value ) {
                        $('.earthlings-list').append(
                            `<li data-user-id="`+value.id+`"><span class="friend-name">`+value.first_name+` `+value.last_name+`</span> <button class="remove-friend"><i class="fas fa-times"></i></button></li>`
                        );

                        key = key + 1;

                        if(value.photo) {
                            if(value.photo.includes('-cropped')) {
                                value.photo = 'crop/'+value.photo;
                            }
                        } else {
                            value.photo = 'default.png';
                        }

                        var position = friends_position[key];
                        var box_color = getRandomColor();
                        // 1 to 100
                        var position_top = Math.floor((Math.random() * 90) + 1);
                        // 50 to 100
                        var position_left = Math.floor((Math.random() * (90 - 50 + 1)) + 50);

                        var html = `<div id="`+key+`" title="`+value.first_name+` `+value.last_name+`" class="draggable origin friend friend-`+key+`" style="box-shadow: 0px 0px 10px `+box_color+`; top: `+position_top+`%; left: `+position_left+`%;" data-top="`+position.top+`" data-left="`+position.left+`" data-user-id="`+value.id+`" data-user-name="`+value.first_name+` `+value.last_name+`">
                                        <div class="loader">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                        <img src="`+url+`/storage/profilepicture/`+value.photo+`" class="friend-photo"/>
                                    </div>`;
                        
                        $('#drop').append(html);
                        // initializeDraggable();
                        $('.friend-photo').load(function() {
                            $(this).closest('div.friend').find('.loader').fadeOut();
                        });
                    });

                    fetchFriends();
                    initializeDraggable();
                    removeSelectedFriends();
                    selected_friends = data.members_id;
                    console.log(selected_friends);
                });

                $('.earthlings-body').hide();
                $('.group-list').toggle();
                $('#selected_group_name').val(name);
                $('#selected_group_id').val(id);

            });
        }

        $('.earthlings-header').click(function() {
            $('.earthlings-body').toggle('slow');
        });
        
        $('.options-header').click(function() {
            $('.options-body').toggle();
        });
        

        $('.edit-group').click(function() {
            var group_name = $('#selected_group_name').val();
            var group_id = $('#selected_group_id').val();

            if(!group_name && !group_id) {
                Swal.fire({
                    imageUrl: '../../front/icons/alert-icon.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Mbaye Logo',
                    title: 'No Group Selected',
                    html: 'Select group first.',
                    padding: '1rem',
                    background: 'rgba(8, 64, 147, 0.62)'
                });
            } else {
                $('#edit-group-form input[name="group_id"]').val(group_id);
                $('#edit-group-form input[name="group_name"]').val(group_name);
                $('#editGroupModal').modal('show');
            }
        });

        $('.help-button').click(function() {
            $('.instruction-div').fadeToggle();
        });
    </script>
@endsection
