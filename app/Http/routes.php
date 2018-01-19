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
Route::group(['prefix' => '/', 'middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:utilisateurs']], function() {
    Route::get('utilisateurs', 'UserController@users');
    Route::delete('utilisateurs/{id}/delete', 'UserController@destroyUser');
    Route::get('utilisateurs/roles', 'UserController@roles');
    Route::get('utilisateurs/roles/create', 'UserController@createRole');
    Route::post('utilisateurs/roles', 'UserController@storeRole');
    Route::get('utilisateurs/roles/{id}/edit', 'UserController@editRole');
    Route::put('utilisateurs/roles/{id}', 'UserController@updateRole');
    Route::get('utilisateurs/permissions', 'UserController@permissions');
    Route::get('utilisateurs/permissions/create', 'UserController@createPermission');
    Route::post('utilisateurs/permissions', 'UserController@storePermission');
    Route::get('utilisateurs/permissions/{id}/edit', 'UserController@editPermission');
    Route::put('utilisateurs/permissions/{id}', 'UserController@updatePermission');
    Route::get('utilisateurs/droits-acces', 'UserController@rolePermissions');
    Route::get('utilisateurs/create', 'UserController@createUser');
    Route::post('utilisateurs', 'UserController@storeUser');
    Route::get('utilisateurs/{id}/edit', 'UserController@editUser');
    Route::put('utilisateurs/{id}', 'UserController@updateUser');

});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:cours']], function() {
    Route::get('cours', 'CourController@index');
    Route::get('cours/create', 'CourController@create');
    Route::get('cours/{id}', 'CourController@show');
    Route::post('cours', 'CourController@store');
    Route::get('cours/{id}/edit', 'CourController@edit');
    Route::put('cours/{id}', 'CourController@update');
    Route::delete('cours/{id}/delete', 'CourController@destroy');
    //Route::resource('cours', 'CourController');
    Route::get('cours/c/export', 'CourController@export');
    Route::get('cours/u/gestion', 'CourController@usersCours');
});


Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:sessions']], function() {
    Route::get('sessions', 'SessionController@index');
    Route::get('sessions/create', 'SessionController@create');
    Route::get('sessions/{id}', 'SessionController@show');
    Route::post('sessions', 'SessionController@store');
    Route::get('sessions/{id}/edit', 'SessionController@edit');
    Route::put('sessions/{id}', 'SessionController@update');
    Route::delete('sessions/{id}/delete', 'SessionController@destroy');
    Route::get('sessions/filter/search', 'SessionController@filterSessions');
    // Route::resource('sessions', 'SessionController');
    Route::get('participants', 'ParticipantController@index');
    Route::get('participants/create', 'ParticipantController@create');
    Route::post('participants', 'ParticipantController@store');
    Route::delete('participants/{id}/delete', 'ParticipantController@destroy');

    Route::get('budgets', 'BudgetController@index');
    Route::get('budgets/create', 'BudgetController@create');
    Route::post('budgets', 'BudgetController@store');
    Route::get('budgetsSession/{id}', 'BudgetController@show');
    Route::get('budgetsSession/{id}/edit', 'BudgetController@edit');
    Route::put('budgetsSession/{id}', 'BudgetController@update');
    Route::delete('budgetsSession/{id}/delete', 'BudgetController@destroy');

});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:prestataires']], function() {
    Route::get('prestataires', 'FournisseurController@index');
    Route::get('prestataires/create', 'FournisseurController@create');
    Route::post('prestataires', 'FournisseurController@store');
    Route::get('prestataires/{id}', 'FournisseurController@show');
    Route::get('prestataires/{id}/edit', 'FournisseurController@edit');
    Route::put('prestataires/{id}', 'FournisseurController@update');
    Route::delete('prestataires/{id}/delete', 'FournisseurController@destroy');
    //Route::resource('prestataires', 'FournisseurController');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:formateurs']], function() {
    Route::get('formateurs', 'FormateurController@index');
    Route::get('formateurs/create', 'FormateurController@create');
    Route::post('formateurs', 'FormateurController@store');
    Route::get('formateurs/{id}', 'FormateurController@show');
    Route::get('formateurs/{id}/edit', 'FormateurController@edit');
    Route::put('formateurs/{id}', 'FormateurController@update');
    Route::delete('formateurs/{id}/delete', 'FormateurController@destroy');
    //Route::resource('formateurs', 'FormateurController');
    Route::get('formateurs/s/gestion', 'FormateurController@gestion');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:salles']], function() {
    Route::get('salles', 'SalleController@index');
    Route::get('salles/create', 'SalleController@create');
    Route::post('salles', 'SalleController@store');
    Route::get('salles/{id}', 'SalleController@show');
    Route::get('salles/{id}/edit', 'SalleController@edit');
    Route::put('salles/{id}', 'SalleController@update');
    Route::delete('salles/{id}/delete', 'SalleController@destroy');
    //Route::resource('salles', 'SalleController');
    Route::get('salles/s/gestion', 'SalleController@gestion');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:evaluations']], function() {
    Route::get('evaluations', 'EvaluationController@index');
    Route::get('evaluations/create', 'EvaluationController@create');
    Route::post('evaluations', 'EvaluationController@store');
    Route::get('evaluations/{id}/edit', 'EvaluationController@edit');
    Route::put('evaluations/{id}', 'EvaluationController@update');
    Route::delete('evaluations/{id}/delete', 'EvaluationController@destroy');
    //Route::resource('evaluations', 'EvaluationController');
    
    Route::get('evaluations/{id}/sendMail', 'EvaluationController@sendMailParticipants');
    Route::get('evaluations/{id}/remembreMail', 'EvaluationController@remembreMailParticipants');
    Route::get('evaluations/{id}/{type}', 'EvaluationController@globalEvaluation');
    Route::get('evaluations/{id}/{type}/{nom}', 'EvaluationController@participantEvaluation');

    Route::get('questions', 'QuestionController@index');
    Route::get('questions/create', 'QuestionController@create');
    Route::post('questions', 'QuestionController@store');
    Route::get('questionnaire/{id}', 'QuestionController@show');
    Route::get('questionnaire/{id}/edit', 'QuestionController@edit');
    Route::put('questionnaire/{id}', 'QuestionController@update');
    Route::delete('questionnaire/{id}/delete', 'QuestionController@destroy');
});

Route::get('questionnaire/{id}/{token}/questions', 'QuestionController@questionnaire');
Route::put('questionnaire/{id}/{token}', 'QuestionController@storeResponses');

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:rapports']], function() {
    Route::get('rapports/standard', 'RapportController@standard');
    Route::get('rapports/personnalise', 'RapportController@personnalise');
});

