<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', 'FrontendController@index')->name('index');
Route::post('/get/states', 'FrontendController@getStates')->name('get.states');
Route::post('/get/cities', 'FrontendController@getCities')->name('get.cities');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('user_dashboard/{id}', 'DashboardController@viewUserDashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::get('profile/edit', 'ProfileController@editprofile')->name('profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

        /*
         * User Profile Picture
         */
        Route::patch('profile-picture/update', 'ProfileController@updateProfilePicture')->name('profile-picture.update');

        /*
         * User Edit Photo Page
         */
        Route::get('profile/edit-photo', 'ProfileController@editPhotoPage')->name('profile.edit-photo');

        /*
         * Save User Cropped Photo
         */
        Route::post('profile/save-cropped-photo', 'ProfileController@saveCroppedPhoto')->name('profile.save-cropped-photo');

        /*
         * User's Contacts / Phone Directory Page (3D)
         */
        Route::get('userAstronaut', 'GameController@showUserAstronaut');

        /*
         * Communicator Page
         */
        Route::get('communicator', 'ProfileController@communicatorPage')->name('communicator');



        /*
         * 3D Pages requiring authentication
        */
        Route::get('userContacts', 'ContactController@showUserContacts');
        Route::post('/userContacts','ContactController@storeContacts')->name('storeContacts');
        Route::get('instructions', 'GameController@showInstructions');
        Route::get('designPanel', 'GameController@showDesignPanelScene');
        Route::post('/designPanel','GameController@storeDesignPanel')->name('storeDesignPanel');
        
    });
//routes for friendship
    Route::get('/checkfriendship/{user}','Friendship\FriendshipController@checkfriendship')->name('checkfriendship');
    Route::get('/sendrequest/{user}','Friendship\FriendshipController@sendrequest')->name('users.sendrequest');
    Route::get('/acceptrequest/{user}','Friendship\FriendshipController@acceptrequest')->name('users.acceptrequest');
    Route::get('/denyrequest/{user}','Friendship\FriendshipController@denyrequest')->name('users.denyrequest');
    
//end routes
    Route::group(['namespace' => 'Blogs'], function () {
        Route::resource('blogs', 'BlogsController');
        Route::get('/single_blog/{id}', 'BlogsController@show');
        Route::post('publish_blog', 'BlogsController@publishBlog');
    });

    Route::group(['namespace' => 'Like'], function () {
        Route::post('/like','LikeController@setemotion')->name('likepost');
    });

    Route::post('send_contact_email', 'FrontendController@sendContactAdminEmail');
});

/*
* Show pages
*/
Route::get('pages/{slug}', 'FrontendController@showPage')->name('pages.show');
Route::get('/initial-agreement', 'FrontendController@initial_agreement')->name('initial_agreement');
Route::get('/terms_and_agreement', 'FrontendController@terms_and_agreement')->name('terms_and_agreement');
Route::get('/copyright_claims', 'FrontendController@copyright_claims')->name('copyright_claims');
Route::get('/privacy_policy', 'FrontendController@privacy_policy')->name('privacy_policy');
Route::get('/special_rightholders_accounts', 'FrontendController@special_rightholders_accounts')->name('special_rightholders_accounts');
Route::get('/sra_terms_and_conditions', 'FrontendController@sra_terms_and_conditions')->name('sra_terms_and_conditions');
Route::get('/blogview', 'FrontendController@blogview')->name('blogview');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/view_blogs', 'FrontendController@view_blogs')->name('view_blogs');
Route::get('/page_under_development', 'FrontendController@page_under_development')->name('page_under_development');
Route::get('/terms', 'FrontendController@terms')->name('terms');


/*3d pages not requiring authentication*/
Route::get('/captainMbaye', 'FrontendController@captain_mbaye')->name('captainMbaye');
Route::get('/flowersMbaye', 'FrontendController@flowers_mbaye')->name('flowersMbaye');
Route::get('/visitingMbaye', 'FrontendController@visiting_mbaye')->name('visitingMbaye');
Route::get('/participateMbaye', 'FrontendController@participate_mbaye')->name('participateMbaye');



// Search Friend Route 
Route::get('/search/friends', 'FrontendController@search_friends')->name('searchFriends');

    

/* For blog tags */
Route::get('/blog_tagwise/{tag}', 'FrontendController@blog_tagwise')->name('blog_tagwise');
Route::get('/blog_of_friend_tagwise', 'FrontendController@blog_of_friend_tagwise')->name('blog_of_friend_tagwise');
Route::get('/blog_general', 'FrontendController@blog_general')->name('blog_general');
Route::get('/blog_general_userwise', 'FrontendController@blog_general_userwise')->name('blog_general_userwise');
Route::get('/single_general_blog/{id}', 'GeneralBlogs\GeneralBlogsController@show');
