<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//routes for social networking.
Route::get('/listusers','Frontend\Friendship\FriendshipController@listusers')->name('users.list');
Route::get('/requests','Frontend\Friendship\FriendshipController@requests')->name('users.requests');
Route::get('/sendrequest/{user}','Frontend\Friendship\FriendshipController@sendrequest')->name('users.sendrequest');
Route::get('/checkfriendship/{user}','Frontend\Friendship\FriendshipController@checkfriendship')->name('users.checkfriendship');
Route::get('/acceptrequest/{user}','Frontend\Friendship\FriendshipController@acceptrequest')->name('users.acceptrequest');
Route::get('/denyrequest/{user}','Frontend\Friendship\FriendshipController@denyrequest')->name('users.denyrequest');
Route::any('/search', 'Frontend\Friendship\FriendshipController@searchuser')->name('user.search');

//end routes for social networking
Route::post('/readnotification','Frontend\Notify\NotifyController@readnotification');
Route::get('/blogpost/{blog}', 'Frontend\Comment\CommentController@blogpost');
Route::post('/notify','Frontend\Notify\NotifyController@getnotifications');
Route::post('/countcomments','Frontend\Comment\CommentController@countcomment');
Route::post('/countemotions','Frontend\Like\LikeController@countemotions');
Route::post('/userreaction','Frontend\Like\LikeController@getUserReaction');
Route::post('/blogs/{blog}/emotions','Frontend\Like\LikeController@setemotion');
Route::get('/blogs/{blog}/comments', 'Frontend\Comment\CommentController@index');
Route::post('/blogs/{blog}/comment', 'Frontend\Comment\CommentController@store');

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'AuthController@login');
        // Password Reset
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            // Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
        });
       // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
        Route::post('users/delete-all', 'UsersController@deleteAll');
        //@todo need to change the route name and related changes
        Route::get('deactivated-users', 'DeactivatedUsersController@index');
        Route::get('deleted-users', 'DeletedUsersController@index');

        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        // Permission
        Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);

        

    });
    
    // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController', ['except' => ['create', 'edit']]);

        // Blogs
        Route::resource('blogs', 'BlogsController', ['except' => ['create', 'edit']]);
        Route::get('/blogbytag/{blogtag}','BlogsController@showbytag');
        Route::get('blogbytagoffriend','BlogsController@showbytagforfriend');
  
      
});

