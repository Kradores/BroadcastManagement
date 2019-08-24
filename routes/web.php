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
Route::get('/settings/notif', "PagesController@notif");
Route::get('/settings/test', "PagesController@test");
Route::get('/settings/list', "PagesController@list");
Route::get('/settings/status', "PagesController@status");
