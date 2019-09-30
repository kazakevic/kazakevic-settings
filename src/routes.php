<?php

use Illuminate\Support\Facades\Route;

const API_VERSION = 'V1';

//main routes
Route::prefix('office/')
    ->name('office')
    ->namespace('Kazakevic\\Settings\\Http\\Controllers')
    ->group(function () {
        Route::get('/settings', 'OfficeController@settingsAction');
    });

//api routes
Route::prefix('adm/api/' . API_VERSION)
    ->name('api.' . API_VERSION . '.' . 'setting.')
    ->namespace('Kazakevic\\Settings\\Http\\Controllers\\Api')
    ->group(function () {
        Route::get('/settings', 'SettingsController@index')->name('index');
        Route::get('/settings/{id}', 'SettingsController@show')->name('show');
        Route::get('/settings/types', 'SettingsController@types')->name('types');
        Route::post('/settings', 'SettingsController@store')->name('insert');
        Route::patch('/settings/{id}', 'SettingsController@update')->name('update');
        Route::delete('/settings/{id}', 'SettingsController@destroy')->name('delete');
        Route::get('/search/settings/{query?}', 'SettingsController@search')->name('search');
    });
