<?php
use Illuminate\Support\Facades\Route;
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
         * Collage editor page
         */
        Route::get('editor_collage', 'DashboardController@collageEditor');

        /*
         * 3D Pages requiring authentication
        */
        Route::get('userContacts', 'ContactController@showUserContacts');
        Route::post('/userContacts','ContactController@storeContacts')->name('storeContacts');
        Route::get('instructions', 'GameController@showInstructions');
        Route::get('designPanel', 'GameController@showDesignPanelScene');
        Route::post('/designPanel','GameController@storeDesignPanel')->name('storeDesignPanel');
        Route::get('buildMbaye', 'GameController@showBuildMbayeScene')->name('buildMbaye');
        
    });
//routes for friendship
Route::group(['namespace' => 'Friendship'], function () {
    Route::resource('groups', 'GroupController');
    Route::post('/store_group_friends', 'GroupController@storeGroupFriends');
    Route::post('/delete_groups', 'GroupController@deleteGroups');
    Route::get('/listusers','FriendshipController@listusers');
    Route::get('/fetchrequests','FriendshipController@fetchrequests');
    Route::get('/fetchfriends','FriendshipController@fetchfriends');
    Route::get('/requests','FriendshipController@requests');
    Route::get('/getuser/{user}','FriendshipController@getuser');
    Route::get('/checkfriendship/{user}','FriendshipController@checkfriendship')->name('checkfriendship');
    Route::get('/sendrequest/{user}','FriendshipController@sendrequest')->name('users.sendrequest');
    Route::get('/acceptrequest/{user}','FriendshipController@acceptrequest')->name('users.acceptrequest');
    Route::get('/denyrequest/{user}','FriendshipController@denyrequest')->name('users.denyrequest');
    Route::get('/friends','FriendshipController@listfriends')->name('users.index');
    Route::get('/unfriend/{user}','FriendshipController@unfriend')->name('users.unfriend');
    Route::get('/block/{user}','FriendshipController@block')->name('users.block');
    Route::get('/block/{user}','FriendshipController@block')->name('users.block');
    Route::post('/groupfriend','FriendshipController@groupfriends')->name('friends.group');
    Route::post('/ungroupfriend','FriendshipController@ungroupfriends')->name('friends.ungroup');
});

    
//end friendshiproutes
    Route::group(['namespace' => 'Blogs'], function () {
        Route::resource('blogs', 'BlogsController');
        Route::get('/single_blog/{id}', 'BlogsController@show');
        Route::post('publish_blog', 'BlogsController@publishBlog');
        Route::post('publish_general_blog', 'BlogsController@saveGeneralBlog');

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
Route::get('/feetMbaye', 'FrontendController@feet_mbaye')->name('feetMbaye');

//dummy page for testing
Route::get('/dummy_page/{id}', 'FrontendController@dummy_page');




// Search Friend Route 
Route::get('/search/friends', 'FrontendController@search_friends')->name('searchFriends');


/* blogs tagwise */
Route::get('/blogview/tagwise/all', 'FrontendController@blog_tagwise_all')->name('blog_tagwise_all');
Route::get('/blogview/tagwise/my', 'FrontendController@blog_tagwise_my');
Route::post('/blogview/tagwise/my', 'FrontendController@blog_tagwise_my_post')->name('blog_tagwise_my');
Route::get('/blogview/tagwise/friend', 'FrontendController@blog_tagwise_friend');
Route::post('/blogview/tagwise/friend', 'FrontendController@blog_tagwise_friend_post')->name('blog_tagwise_friend');
Route::get('/single_general_blog/{id}', 'GeneralBlogs\GeneralBlogsController@show');


/* blogs for the general blogs */
Route::get('/blogview/general/all', 'FrontendController@blog_general_all')->name('blog_general');
Route::get('/blogview/general/my', 'FrontendController@blog_general_my');
Route::post('/blogview/general/my', 'FrontendController@blog_general_my_post')->name('blog_general_my');
Route::get('/blogview/general/friend', 'FrontendController@blog_general_friend');
Route::post('/blogview/general/friend', 'FrontendController@blog_general_friend_post')->name('blog_general_friend');
Route::get('/single_general_blog/{id}', 'GeneralBlogs\GeneralBlogsController@show');


/* blogs for the designed panels */
Route::get('/blogview/designed-panel/all', 'FrontendController@designed_panels_all')->name('designed_panels_all');
Route::get('/blogview/designed-panel/my', 'FrontendController@designed_panels_my');
Route::post('/blogview/designed-panel/my', 'FrontendController@designed_panels_my_post')->name('designed_panels_my');
Route::get('/blogview/designed-panel/friend', 'FrontendController@designed_panels_friend')->name('designed_panels_friend');
Route::get('/blogview/designed-panel/home', 'FrontendController@designed_panels_home')->name('blog_general_home');
Route::get('/single_panel_design/{id}', 'BlogPanelDesign\BlogPanelDesignController@show');


/* blogs for the Jobseekers */
Route::get('/blogview/jobseekers/profiles', 'FrontendController@jobseeker_profiles')->name('jobseeker_profiles');


//testing routes for Jobseekers profile
Route::get('/jobseekers/setup-profile','JobSeekerProfile\JobSeekerProfilesController@index');

