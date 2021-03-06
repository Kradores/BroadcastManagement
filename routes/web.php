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

Route::get('/', "PagesController@index");
Route::get('/settings/status', "PagesController@status");


Route::get('/settings/notif', 'NotificationsController@index');
Route::put('/settings/notif/{id}', 'NotificationsController@update')->middleware('db_request_limit');

Route::get('/settings/test', "TestsController@index");
Route::post('/settings/test', "TestsController@send")->middleware('db_request_limit');
Route::put('/settings/test', "TestsController@show")->middleware('db_request_limit');
Route::get('/settings/test/{id}', "TestsController@refresh")->middleware('db_request_limit');

Route::get('/settings/list', "ListsController@index");
Route::post('/settings/list', "ListsController@update");

