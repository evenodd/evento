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
Route::get('/event/create', function () { return view('event.create'); })->middleware('auth');
Route::get('/venue/create', function () { return view('venue.create'); })->middleware('auth');
Route::get('/event/manager', function () { return view('event.manager'); })->middleware('auth');
Route::get('/rsvp', function () { return view('rsvp'); })->middleware('auth');
Route::get('/event/list', function () { return view('event.list'); })->middleware('auth');
Route::get('/event/details', function () { return view('event.details'); })->middleware('auth');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('eventos', 'EventoController');
