<?php

/*
 * Blogs Management
 */
Route::group(['namespace' => 'Blogs'], function () {
    Route::resource('blogs', 'BlogsController');
    Route::get('designblogs', 'BlogsController@designblogs')->name('blogs.designblogs');
    Route::get('delete/{id}', 'BlogStatusController@delete')->name('blog.delete-permanently');
    Route::get('restore/{id}', 'BlogStatusController@restore')->name('blog.restore');
    Route::get('deletedblogs', 'BlogStatusController@getDeleted')->name('blogs.deleted');
    //For DataTables
    Route::post('blogs/get', 'BlogsTableController')
       ->name('blogs.get');

    //For DataTables
    Route::post('designblogs/get', 'DesignBlogsTableController')
       ->name('designblogs.get');

   //For DataTables
   Route::post('deletedblogs/get', 'DeletedBlogsTableController')
   ->name('deletedblogs.get');

    //For DataTables
    Route::get('deletecomment/{id}', 'BlogsController@deletecomment')->name('deletecomment');
});


