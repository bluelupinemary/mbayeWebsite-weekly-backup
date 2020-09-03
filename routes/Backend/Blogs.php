<?php

/*
 * Blogs Management
 */
Route::group(['namespace' => 'Blogs'], function () {
    Route::resource('blogs', 'BlogsController');
    Route::get('designblogs', 'BlogsController@designblogs')->name('blogs.designblogs');
    Route::get('delete', 'BlogStatusController@delete')->name('blogs.delete-permanently');
    Route::get('restore', 'BlogStatusController@restore')->name('blogs.restore');
    //For DataTables
    Route::post('blogs/get', 'BlogsTableController')
       ->name('blogs.get');

    //For DataTables
    Route::post('designblogs/get', 'DesignBlogsTableController')
       ->name('designblogs.get');

    //For DataTables
    Route::get('deletecomment/{id}', 'BlogsController@deletecomment')->name('deletecomment');
});


