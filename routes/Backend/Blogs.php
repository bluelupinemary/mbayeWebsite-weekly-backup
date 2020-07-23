<?php

/*
 * Blogs Management
 */
Route::group(['namespace' => 'Blogs'], function () {
    Route::resource('blogs', 'BlogsController');

    //For DataTables
    Route::post('blogs/get', 'BlogsTableController')
       ->name('blogs.get');

    //For DataTables
    Route::get('deletecomment/{id}', 'BlogsController@deletecomment')->name('deletecomment');
});


