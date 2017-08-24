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

/*
Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/create_event', function () {
    return view('create_event');
});

Route::get('/create_venue', function () {
    return view('create_venue');
});

Route::get('/event_manager_view', function () {
    return view('event_manager_view');
});

Route::get('/view_all_events', function () {
    return view('view_all_events');
});

Route::get('/rsvp', function () {
    return view('rsvp');
});

Route::get('/view_an_event', function () {
    return view('view_an_event');
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('eventos', 'EventoController');
