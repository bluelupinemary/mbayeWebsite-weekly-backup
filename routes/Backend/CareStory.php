<?php

/*
 * CareStories Management
 */
Route::group(['namespace' => 'CareStory'], function () {
    Route::resource('carestory', 'CareStoryController',['except' => ['create','update','edit','store']]);

    Route::post('carestory/get', 'CareStoryTableController')
       ->name('carestory.get');
});


