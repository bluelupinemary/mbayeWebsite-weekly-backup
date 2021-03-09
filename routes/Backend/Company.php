<?php

/*
 * Company Management
 */
Route::group(['namespace' => 'Company'], function () {
    Route::resource('company', 'CompanyController',['except' => ['create','update','edit','store','show']]);

    Route::post('company/get', 'CompanyTableController')
       ->name('company.get');
});


