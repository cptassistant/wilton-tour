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

// "Static" Pages Routes
Route::get('/', 'PagesController@welcome');
Route::get('about', 'PagesController@about');


// Authentication Routes
Route::auth();


Route::get('profile', 'ProfileController@index');

Route::get('profile/{id}', 'ProfileController@show');


// League Routes
Route::get('league', 'LeagueController@index');
Route::get('league/{league}', 'LeagueController@show');

