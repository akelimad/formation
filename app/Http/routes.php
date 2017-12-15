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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('cours', 'CourController@index');
Route::get('cours/create', 'CourController@create');
Route::post('cours', 'CourController@store');

Route::get('sessions', 'SessionController@index');
Route::get('sessionsParticipant', 'SessionController@index_session_participant');
Route::get('sessions/create', 'SessionController@create');
Route::post('sessions', 'SessionController@store');

Route::get('fournisseurs', 'FournisseurController@index');
Route::get('fournisseurs/create', 'FournisseurController@create');
Route::post('fournisseurs', 'FournisseurController@store');

Route::get('formateurs', 'FormateurController@index');
Route::get('formateurs/create', 'FormateurController@create');
Route::post('formateurs', 'FormateurController@store');

Route::get('participants', 'ParticipantController@index');
Route::get('participantsNames', 'ParticipantController@participantsNames');
Route::get('participants/create', 'ParticipantController@create');
Route::post('participants', 'ParticipantController@store');

Route::get('salles', 'SalleController@index');
Route::get('salles/create', 'SalleController@create');
Route::post('salles', 'SalleController@store');

