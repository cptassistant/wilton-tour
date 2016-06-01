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

Route::get('league/{league}/match/create', 'MatchController@leagueCreate');

// Match Routes
Route::get('/match/{match}/addscores', 'MatchController@addScores');
Route::get('/match/{match}/finalize', 'MatchController@finalize');
Route::post('match/addscores', ['as' => 'match.addscores', 'uses' => 'MatchController@postScores' ]);
Route::post('match/addachievement', ['as' => 'match.addachievement', 'uses' => 'MatchController@postAchievement' ]);
Route::post('match/assignpoints', ['as' => 'match.assignpoints', 'uses' => 'MatchController@assignPoints' ]);

	//ajax requests
	Route::get('/match/gettees/{course}', 'MatchController@getTees');
	Route::get('/match/getholes/{course}', 'MatchController@getHoles');

Route::resource('match', 'MatchController');
