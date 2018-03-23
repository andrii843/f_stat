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

	Route::get('/', 'UserController@index');

//	Route::resource('/players', 'PlayerController');
	Route::resource('/games', 'GameController');
	Route::get('/games/{id}/delete', 'GameController@delete')->name('games.delete');
	Route::resource('/users', 'UserController');
//	Route::resource('/ratings', 'RatingController');

	Route::get('/ratings', 'RatingController@index')->name('ratings.index');
	Route::get('/ratings/games/{game_id}/add', 'RatingController@add')->name('ratings.add');
	Route::post('/ratings/games/{game_id}', 'RatingController@create')->name('ratings.create');
	Route::get('/ratings/games/{game_id}', 'RatingController@gameRating')->name('ratings.game');
	Route::get('/ratings/games/{game_id}/{user_id}', 'RatingController@gameRatingUser')->name('ratings.game.user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
