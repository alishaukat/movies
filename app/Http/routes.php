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


Route::get('/',function(){
    return Illuminate\Support\Facades\Redirect::route('movies');
})->name('home');

Route::group(['prefix'=>'movies'],  function(){
    Route::get('/', ['as' => 'movies', 'uses'=>'MoviesController@index']);
    Route::get('/listing', ['as' => 'movies.listing', 'uses'=>'MoviesController@listing']);
    Route::get('/{url}', ['as' => 'movies.show', 'uses'=>'MoviesController@show']);
});

Route::group(['prefix'=>'series'],  function(){
    Route::get('/', ['as' => 'series', 'uses'=>'SeriesController@index']);
    Route::get('/listing', ['as' => 'series.listing', 'uses'=>'SeriesController@listing']);
    Route::get('/{url}', ['as' => 'series.show', 'uses'=>'SeriesController@show']);
});