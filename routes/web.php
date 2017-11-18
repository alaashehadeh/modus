<?php
use Illuminate\Http\Request;

Route::group(['prefix' => 'vehicles'],
    function () {
        Route::get('/{year}/{manufacture}/{model}', 'NHTSAController@getYearModelManufacture');
        Route::post('/', 'NHTSAController@postYearModelManufacture');
    });
