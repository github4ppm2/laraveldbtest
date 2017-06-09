<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

//Route::get('/', function () {
 //   return view('rm.index');
//});
Route::get('/','EventsController@latestevents');

Route::get('manage-events', 'EventsController@manageEvents');
Route::get('myevents', 'EventsController@index');


Route::post('update-events/{id}', 'EventsController@update');
Route::post('remove-events/{id}', 'EventsController@destroy');
//Route::resource('events', 'EventsController');


