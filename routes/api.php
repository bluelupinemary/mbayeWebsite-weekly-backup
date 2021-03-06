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

Route::get('/search/{q}', 'Frontend\Friendship\FriendshipController@searchuser')->name('search');
Route::post('/readnotification','Frontend\Notify\NotifyController@readnotification');
Route::get('/blogpost/{blog}', 'Frontend\Comment\CommentController@blogpost');
Route::post('/notify','Frontend\Notify\NotifyController@getnotifications');
Route::post('/notification_list','Frontend\Notify\NotifyController@getpaginatednotifications');
Route::post('/blog_activities','Frontend\Notify\NotifyController@getBlogActivities');
Route::post('/countcomments','Frontend\Comment\CommentController@countcomment');
Route::post('/countemotions','Frontend\Like\LikeController@countemotions');
Route::get('/countblogshare/{id}','Frontend\Like\LikeController@countblogshare');

Route::post('/userreaction','Frontend\Like\LikeController@getUserReaction');
Route::post('/blogs/{blog}/emotions','Frontend\Like\LikeController@setemotion');
Route::get('/blogs/{blog}/comments', 'Frontend\Comment\CommentController@index');
Route::post('/blogs/{blog}/comment', 'Frontend\Comment\CommentController@store');
Route::post('/save_collage', 'Frontend\User\DashboardController@saveCollage');
Route::post('/save-careerprofile', 'Frontend\JobSeekerProfile\JobSeekerProfilesController@saveJobSeekerProfile');


//general blog emotions and comments
Route::get('/countgeneralblogshare/{id}','Frontend\Like\LikeController@countgeneralblogshare');
Route::get('/generalblogpost/{blog}', 'Frontend\Comment\GeneralCommentController@blogpost');
Route::post('/countgeneralcomments','Frontend\Comment\GeneralCommentController@countcomment');
Route::post('/countgeneralemotions','Frontend\Like\GeneralLikeController@countemotions');
Route::post('/usergeneralreaction','Frontend\Like\GeneralLikeController@getUserReaction');
Route::post('/blogs/{blog}/generalemotions','Frontend\Like\GeneralLikeController@setemotion');
Route::get('/blogs/{blog}/generalcomments', 'Frontend\Comment\GeneralCommentController@index');
Route::post('/blogs/{blog}/generalcomment', 'Frontend\Comment\GeneralCommentController@store');



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
        Route::post('users/delete-all', 'UsersController@deleteAll');
        //@todo need to change the route name and related changes
        Route::get('deactivated-users', 'DeactivatedUsersController@index');
        Route::get('deleted-users', 'DeletedUsersController@index');

        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        // Permission
        Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);

        

    });
    
    // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
    // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController', ['except' => ['create', 'edit']]);

        // Blogs
        Route::resource('blogs', 'BlogsController', ['except' => ['create', 'edit']]);
        Route::get('/blogbytag/{blogtag}','BlogsController@showbytag');
        Route::get('blogbytagoffriend','BlogsController@showbytagforfriend');
        Route::resource('bloggeneral', 'GeneralBlogsController', ['except' => ['create', 'edit']]);
        Route::get('bloggeneral_userwise','GeneralBlogsController@show_generalblog_userwise');
        
        Route::get('showallblogs','BlogsController@show_all_blogs_tagwise');

        // Route::resource('all_designed_pannels', 'BlogPannelDesignController', ['except' => ['create', 'edit']]);

        Route::get('jobseekers', 'JobSeekerProfilesController@index');
  
});

