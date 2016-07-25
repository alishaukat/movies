<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', ['as' => 'home', 'uses'=>'MoviesController@index']);
Route::get('/{url}', ['as' => 'movie', 'uses'=>'MoviesController@show']);
Route::get('/listing', ['as' => 'movie.listing', 'uses'=>'MoviesController@listing']);