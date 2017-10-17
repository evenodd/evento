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
Route::get('/event/public', function () { return view('event.public'); });
// Route::get('/venue/create', function () { return view('venue.create'); })->middleware('auth');
Route::get('/rsvp', function () { return view('rsvp'); })->name('rsvp');
Route::get('/calendar', function () { return view('calendar.calendar'); })->middleware('auth');
Route::get('/supplier', function () { return view('suppliers.create'); })->middleware('auth');
Route::get('/supplier_view', function () { return view('suppliers.details'); })->middleware('auth');


Route::get('/event/list', function () { return view('event.list'); })->middleware('auth');//venue ;ist view
Route::get('/venue/venuelist', function () { return view('venue.venuelist'); })->middleware('auth');

Auth::routes();
Route::get('/verifyemail/{token}',        'Auth\RegisterController@verify');

Route::get('/',                           'ManagerController@index')->name('manager')->middleware('auth');

//Event endpoints
Route::get('/event/create',                          'EventoController@create')->middleware('auth');
Route::get('eventos',                                'EventoController@index')->middleware('auth');
Route::post('eventos',                               'EventoController@store')->middleware('auth', 'formatDateTimes');
Route::get('eventos/details/{evento}',               'EventoController@show')->middleware('auth');
Route::get('/eventos/{evento}/nbOfGuests',           'EventoController@getNumberOfGuests')->middleware('auth');
Route::get('/eventos/{evento}/rsvps',                'EventoController@getRsvps')->middleware('auth');
Route::post('/eventos/{evento}/cancel',              'EventoController@cancel')->middleware('auth');
Route::get('/eventos/details/{evento}/seats',        'EventoController@getSeats')->middleware('auth');
Route::get('/eventos/edit/{evento}',                 'EventoController@edit')->middleware('auth');
Route::post('/eventos/update/{evento}',              'EventoController@update')->middleware('auth');

//Rsvp endpoints
Route::post('rsvp/send/{rsvp}',            			 'RsvpController@send')->middleware('auth');
Route::get('/rsvp/{token}',                			 'RsvpController@receiveRsvp')->middleware('auth');
Route::get('/rsvpSuccess',                			 'RsvpController@showSuccess')->middleware('auth');
Route::post('/storeRsvpResponse/{token}', 			 'RsvpController@storeRsvpResponse')->middleware('auth');

//Venue endpoints
Route::get('/venue/{venue}',						  'VenueController@getVenue');
Route::get('/venue/create',                           'VenueController@create')->middleware('auth');
Route::post('createVenue',                            'VenueController@store')->middleware('auth');
Route::get('/venue/details/{venue}',                  'VenueController@show');//->middleware('auth');
Route::get('/venue/edit/{venue}',             		  'VenueController@edit')->middleware('auth');
Route::post('/venue/update/{venue}', 				  'VenueController@update')->middleware('auth');
Route::post('/venue/cancel/{venue}', 				  'VenueController@cancel')->middleware('auth');
Route::get('/venues/',					              'VenueController@index')->middleware('auth');
Route::get('venue/details/{venue}/events',            'VenueController@getEvents')->middleware('auth');
Route::get('/venues/{venue}/events/details/{evento}', 'VenueController@getEventDetails')->middleware('auth');
//Public
Route::get('/eventos/public', 			       		  'PublicController@index');
Route::get('public/eventos/details/{evento}', 		  'PublicController@eventDetails');
Route::post('/public/eventos/{evento}/rsvp',		  'PublicController@postRsvp');
Route::get('/public/eventos/details/{evento}/seats',  'PublicController@getSeats');