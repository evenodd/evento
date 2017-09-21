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


//DEMO VIEWS
Route::get('/manager', 'ManagerController@index')->name('manager')->middleware('auth');
Route::get('/event/manager', function () { return view('event.manager'); })->middleware('auth');
Route::get('/event/list', function () { return view('event.list'); })->middleware('auth');
Route::get('/event/details', function () { return view('event.details'); })->middleware('auth');
Route::get('/event/public', function () { return view('event.public'); });
Route::get('/venue/details', function () { return view('venue.details'); })->middleware('auth');
// Route::get('/venue/create', function () { return view('venue.create'); })->middleware('auth');


Route::get('/rsvp', function () { return view('rsvp'); })->name('rsvp');
Route::get('/calendar', function () { return view('calendar.calendar'); })->middleware('auth');
Route::get('/supplier', function () { return view('suppliers.create'); })->middleware('auth');
Route::get('/supplier_view', function () { return view('suppliers.details'); })->middleware('auth');

Auth::routes();
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/', 'ManagerController@index')->name('manager')->middleware('auth');

//Event endpoints
Route::get('/event/create', 'EventoController@create')->middleware('auth');
Route::get('eventos', 		'EventoController@index')->middleware('auth');
Route::post('eventos', 		'EventoController@store')->middleware('auth', 'formatDateTimes');

//Rsvp endpoints
Route::post('rsvp/send/{id}',	'RsvpController@send')->middleware('auth');
Route::get('/rsvp/{token}', function () { return view('rsvp'); })->name('rsvp');


Route::get('/venue/create', 'VenueController@create')->middleware('auth');
Route::post('createVenue', 	'VenueController@store')->middleware('auth');
