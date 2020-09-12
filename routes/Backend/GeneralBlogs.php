<?php

/*
 *General Blogs Management
 */
Route::group(['namespace' => 'GeneralBlogs'], function () {
    Route::resource('generalblogs', 'GeneralBlogsController');
    Route::get('delete/{id}', 'GeneralBlogStatusController@delete')->name('generalblog.delete-permanently');
    Route::get('restore/{id}', 'GeneralBlogStatusController@restore')->name('generalblog.restore');
    Route::get('deletedgeneralblogs', 'GeneralBlogStatusController@getDeleted')->name('generalblogs.deleted');

    //For DataTables
    Route::post('generalblogs/get', 'GeneralBlogsTableController')
       ->name('generalblogs.get');

    Route::post('deletedgeneralblogs/get', 'DeletedGeneralBlogsTableController')
       ->name('deletedgeneralblogs.get');

    //For DataTables
    Route::get('deletegeneralcomment/{id}', 'GeneralBlogsController@deletecomment')->name('deletegeneralcomment');
});


