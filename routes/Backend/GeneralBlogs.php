<?php

/*
 *General Blogs Management
 */
Route::group(['namespace' => 'GeneralBlogs'], function () {
    Route::resource('generalblogs', 'GeneralBlogsController');

    //For DataTables
    Route::post('generalblogs/get', 'GeneralBlogsTableController')
       ->name('generalblogs.get');

    //For DataTables
    Route::get('deletegeneralcomment/{id}', 'GeneralBlogsController@deletecomment')->name('deletegeneralcomment');
});


