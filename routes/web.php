<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Home*/
Route::get('/', 'ServiceRequestsController@index')->name('home');

/*View Call*/
Route::get('/service', 'ServiceRequestsController@create');
// Route::get('/service/{id}', 'ServiceRequestsController@edit');

/*Action Call*/
Route::post('/service', 'ServiceRequestsController@store')->name('service');
Route::put('/service/{serviceRequest}', 'ServiceRequestsController@update')->name('service');
Route::delete('/service/{serviceRequest}/delete', 'ServiceRequestsController@destroy');

/*ajax Call*/
Route::post('/getModel', 'ServiceRequestsController@getModel')->name('getModel');


Route::get('/service/{serviceRequest}', 'ServiceRequestsController@edit')->name('edit');