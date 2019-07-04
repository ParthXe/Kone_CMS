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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['middleware' => 'auth'], function () {
  /*Route::get('/', function () {
        return view('show_event');
   });*/
   Route::get('/','EventController@show_event');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');

// Event Routes
Route::get('/events', 'EventController@index')->name('events');
Route::get('/create_event', 'EventController@create_event')->name('create_event');
Route::post('/save_event', 'EventController@save_event')->name('save_event');
Route::get('/show_event', 'EventController@show_event')->name('show_event');
Route::get('/edit_event/{id}', 'EventController@edit_event')->name('edit_event');
Route::post('/update_event/{id}', 'EventController@update_event')->name('update_event');
Route::get('/delete_event/{id}', 'EventController@delete_event')->name('delete_event');
Route::get('/events_report',array('as'=>'events_report','uses'=>'EventController@events_report'));

// Live_Polling Routes
Route::get('/events', 'Live_Polling_Controller@index')->name('events');
Route::get('/create_live_polling', 'Live_Polling_Controller@create_live_polling')->name('create_live_polling');
Route::post('/store_live_polling', 'Live_Polling_Controller@store_live_polling')->name('store_live_polling');
Route::get('/show_live_polling', 'Live_Polling_Controller@show_live_polling')->name('show_live_polling');
Route::get('/edit_live_polling/{id}', 'Live_Polling_Controller@edit_live_polling')->name('edit_live_polling');
Route::post('/update_live_polling/{id}', 'Live_Polling_Controller@update_live_polling')->name('update_live_polling');
Route::get('/delete_live_polling/{id}', 'Live_Polling_Controller@delete_live_polling')->name('delete_live_polling');
Route::get('/live_pollings_report',array('as'=>'live_pollings_report','uses'=>'Live_Polling_Controller@live_pollings_report'));
