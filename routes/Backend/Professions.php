<?php

/*
 * Professions Management
 */
Route::group(['namespace' => 'JobSeekers'], function () {
    Route::resource('professions', 'ProfessionsController', ['except' => ['show']]);

    //For DataTables
    Route::post('professions/get', 'ProfessionsTableController')
       ->name('professions.get');
});
