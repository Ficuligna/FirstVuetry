<?php

use Illuminate\Support\Facades\Route;


Route::get('/', "UserController@home")->name("start");

// ******************************
Route::post('/destroy/{id}', 'UserController@delete')->name('destroy');
Route::post('/update/{id}', 'UserController@update')->name('update');
Route::post('/archive/{id}', 'UserController@archive')->name('archive');
Route::post('/store', 'UserController@store')->name('create');
Route::get('/archived', 'UserController@get_archived')->name('getArchived');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
