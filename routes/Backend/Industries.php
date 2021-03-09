<?php

/*
 * Industries Management
 */
Route::group(['namespace' => 'Company'], function () {
    Route::resource('industries', 'IndustriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('industries/get', 'IndustriesTableController')
       ->name('industries.get');
});
