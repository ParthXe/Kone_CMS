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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/events', 'EventController@index')->name('events');
Route::get('/create_event', 'EventController@create')->name('create_event');
Route::post('/save_event', 'EventController@save_event')->name('save_event');
Route::get('/show_event', 'EventController@show_event')->name('show_event');
Route::get('/edit_event/{id}', 'EventController@edit_event')->name('edit_event');
Route::post('/update_event/{id}', 'EventController@update_event')->name('update_event');
Route::get('/delete_event/{id}', 'EventController@delete_event')->name('delete_event');
