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

Route::redirect('/', '/entries');
Route::get('/login', 'HomeController@index')->name('home.index')->middleware('auth');
Route::get('/entries', 'EntryController@index')->name('entry.index');
Route::get('/myentries', 'EntryController@myentries')->name('entry.myentries')->middleware('auth');
Route::get('/entry/create', 'EntryController@create')->name('entry.create')->middleware('auth');
Route::post('/myentries', 'EntryController@store')->name('entry.store')->middleware('auth');
Route::get('/entry/{id}', 'EntryController@edit')->name('entry.edit')->middleware('auth');
Route::put('/myentries', 'EntryController@update')->name('entry.update')->middleware('auth');
Route::get('entry/show/{id}', 'EntryController@show')->name('entry.show');
Route::post('/ajaxRequest', 'EntryController@ajaxRequestPost');

Auth::routes();

