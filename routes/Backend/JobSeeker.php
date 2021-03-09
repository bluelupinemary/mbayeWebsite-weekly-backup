<?php

/*
 * JobSeekers Management
 */
Route::group(['namespace' => 'JobSeekers'], function () {
    Route::resource('jobseekers', 'JobSeekersController',['except' => ['create','update','edit','store']]);

    Route::post('jobseekers/get', 'JobSeekersTableController')
       ->name('jobseekers.get');
});


