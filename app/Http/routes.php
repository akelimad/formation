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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('utilisateurs', 'UserController@users');

Route::get('cours', 'CourController@index');
Route::get('cours/create', 'CourController@create');
Route::post('cours', 'CourController@store');
Route::get('cours/{id}/edit', 'CourController@edit');
Route::put('cours/{id}', 'CourController@update');

Route::get('sessions', 'SessionController@index');
Route::get('sessions/create', 'SessionController@create');
Route::get('sessions/{id}/show', 'SessionController@show');
Route::post('sessions', 'SessionController@store');
Route::get('sessions/{id}/edit', 'SessionController@edit');
Route::put('sessions/{id}', 'SessionController@update');
Route::get('evaluations/{id}/sendMail', 'EvaluationController@sendMailParticipants');

Route::get('prestataires', 'FournisseurController@index');
Route::get('prestataires/create', 'FournisseurController@create');
Route::post('prestataires', 'FournisseurController@store');
Route::get('prestataires/{id}/edit', 'FournisseurController@edit');
Route::put('prestataires/{id}', 'FournisseurController@update');

Route::get('formateurs', 'FormateurController@index');
Route::get('formateurs/create', 'FormateurController@create');
Route::post('formateurs', 'FormateurController@store');

Route::get('participants', 'ParticipantController@index');
Route::get('participants/create', 'ParticipantController@create');
Route::post('participants', 'ParticipantController@store');

Route::get('salles', 'SalleController@index');
Route::get('salles/create', 'SalleController@create');
Route::post('salles', 'SalleController@store');
Route::get('salles/{id}/edit', 'SalleController@edit');
Route::put('salles/{id}', 'SalleController@update');

Route::get('evaluations', 'EvaluationController@index');
Route::get('evaluations/create', 'EvaluationController@create');
Route::post('evaluations', 'EvaluationController@store');
Route::get('evaluations/{id}/a-chaud', 'EvaluationController@chaudEvaluation');

Route::get('questions', 'QuestionController@index');
Route::get('questions/create', 'QuestionController@create');
Route::post('questions', 'QuestionController@store');
Route::get('questionnaire/{id}', 'QuestionController@show');
Route::get('questionnaire/{id}/{token}/questions', 'QuestionController@questionnaire');
Route::put('questionnaire/{id}/{token}', 'QuestionController@storeResponses');

Route::get('budgets', 'BudgetController@index');
Route::get('budgets/create', 'BudgetController@create');
Route::post('budgets', 'BudgetController@store');

Route::get('rapports/budgetsFormation', 'RapportController@index');
Route::get('rapports/formationUtilisateur', 'RapportController@index1');

