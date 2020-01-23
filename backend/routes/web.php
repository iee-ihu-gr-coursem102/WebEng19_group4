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
//FRONT
Route::get('/home', 'ViewerController@index');
Route::get('/theme', 'ViewerController@theme');
Route::get('/multiple', 'ViewerController@multiple');
Route::get('/single', 'ViewerController@single');
Route::get('/setSkin','ViewerController@setSkin');
Route::get('/setLocation','ViewerController@setLocation');

//API
Route::get('/cities', 'ApiController@cities');
Route::get('/weather/{id}', 'ApiController@weather');
Route::get('/forecast/{id}', 'ApiController@forecast');
Route::get('/forecast/{id}/{count}', 'ApiController@forecast');
