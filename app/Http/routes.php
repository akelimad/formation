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
Route::group(['prefix' => '/', 'middleware' => ['auth', 'role:admin|user']], function() {
    Route::get('/', 'HomeController@index');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:utilisateurs']], function() {
    Route::get('utilisateurs', 'UserController@users')->name('list utilisateurs');
    Route::delete('utilisateurs/{id}/delete', 'UserController@destroyUser');
    Route::get('utilisateurs/roles', 'UserController@roles');
    Route::get('utilisateurs/roles/create', 'UserController@createRole');
    Route::post('utilisateurs/roles', 'UserController@storeRole');
    Route::get('utilisateurs/roles/{id}/edit', 'UserController@editRole');
    Route::delete('utilisateurs/roles/{id}/delete', 'UserController@deleteRole');
    Route::get('utilisateurs/permissions', 'UserController@permissions');
    Route::get('utilisateurs/permissions/create', 'UserController@createPermission');
    Route::post('utilisateurs/permissions/store', 'UserController@storePermission');
    Route::get('utilisateurs/permissions/{id}/edit', 'UserController@editPermission');
    Route::get('utilisateurs/droits-acces', 'UserController@rolePermissions');
    Route::get('utilisateurs/create', 'UserController@createUser');
    Route::get('utilisateurs/{id}/edit', 'UserController@editUser');
    Route::post('utilisateurs/store', 'UserController@storeUser');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:cours']], function() {
    Route::get('cours/list', 'CourController@index');
    Route::get('cours/create', 'CourController@create');
    Route::get('cours/{id}', 'CourController@show');
    Route::post('cours/store', 'CourController@store');
    Route::get('cours/{id}/edit', 'CourController@edit');
    Route::get('cours/c/export', 'CourController@export');
    Route::get('cours/u/gestion', 'CourController@usersCours');
    Route::delete('cours/{id}/delete',['middleware' => ['auth', 'permission:delete-cours'], 'uses' =>'CourController@destroy']);
});



Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:sessions']], function() {
    Route::get('sessions/list', 'SessionController@index');
    Route::get('sessions/create', 'SessionController@create');
    Route::get('sessions/{id}', 'SessionController@show');
    Route::post('sessions/store', 'SessionController@store');
    Route::get('sessions/{id}/edit', 'SessionController@edit');
    Route::delete('sessions/{id}/delete', ['middleware' => ['auth', 'permission:delete-sessions'], 'uses' =>'SessionController@destroy']);
    Route::get('sessions/filter/search', 'SessionController@filterSessions');

    Route::get('sessions/participants/list', 'ParticipantController@index');
    Route::get('participants/create', 'ParticipantController@create');
    Route::get('participants/create', 'ParticipantController@create');
    Route::post('participants/store', 'ParticipantController@store');
    Route::get('participants/{id}/edit', 'ParticipantController@edit');
    Route::delete('participants/{id}/delete', ['middleware' => ['auth', 'permission:delete-participants'], 'uses' =>'ParticipantController@destroy']);

    Route::get('sessions/budgets/list', 'BudgetController@index');
    Route::get('budgetsSession/{sid}/create', 'BudgetController@create');
    Route::post('budgets/store', 'BudgetController@store');
    Route::get('budgetsSession/{id}', 'BudgetController@show');
    Route::get('budgetsSession/{id}/edit', 'BudgetController@edit');
    Route::delete('budgetsSession/{id}/delete', ['middleware' => ['auth', 'permission:delete-budgets'], 'uses' =>'BudgetController@destroy']);

});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'role:collaborateur']], function() {
    Route::get('espace-collaborateurs', 'ParticipantController@espaceCollaborateurs');
    Route::get('espace-collaborateurs/search', 'ParticipantController@searchCours');
    Route::get('espace-collaborateurs/formation/{id}', 'ParticipantController@detailsSession');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:prestataires']], function() {
    Route::get('prestataires', 'PrestataireController@index');
    Route::get('prestataires/create', 'PrestataireController@create');
    Route::post('prestataires/store', 'PrestataireController@store');
    Route::get('prestataires/{id}', 'PrestataireController@show');
    Route::get('prestataires/{id}/edit', 'PrestataireController@edit');
    Route::delete('prestataires/{id}/delete', ['middleware' => ['auth', 'permission:delete-prestataires'], 'uses' =>'PrestataireController@delete']);
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:formateurs']], function() {
    Route::get('sessions/formateurs/list', 'FormateurController@index');
    Route::get('formateurs/create', 'FormateurController@create');
    Route::post('formateurs/store', 'FormateurController@store');
    Route::get('formateurs/{id}', 'FormateurController@show');
    Route::get('formateurs/{id}/edit', 'FormateurController@edit');
    Route::delete('formateurs/{id}/delete', ['middleware' => ['auth', 'permission:delete-formateurs'], 'uses' =>'FormateurController@destroy']);
    Route::get('sessions/formateurs/gestion', 'FormateurController@gestion');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:salles']], function() {
    Route::get('salles/list', 'SalleController@index');
    Route::get('salles/create', 'SalleController@create');
    Route::post('salles/store', 'SalleController@store');
    Route::get('salles/{id}', 'SalleController@show');
    Route::get('salles/{id}/edit', 'SalleController@edit');
    Route::delete('salles/{id}/delete', ['middleware' => ['auth', 'permission:delete-salles'], 'uses' =>'SalleController@destroy']);
    Route::get('salles/s/gestion', 'SalleController@gestion');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:evaluations']], function() {
    Route::get('evaluations', 'EvaluationController@index');
    Route::get('evaluations/create', 'EvaluationController@create');
    Route::post('evaluations/store', 'EvaluationController@store');
    Route::get('evaluations/{id}/edit', 'EvaluationController@edit');
    Route::delete('evaluations/{id}/delete', ['middleware' => ['auth', 'permission:delete-evaluations'], 'uses' =>'EvaluationController@destroy']);
    
    Route::get('evaluations/{id}/sendMail', 'EvaluationController@sendMailParticipants');
    Route::get('evaluations/{id}/remembreMail', 'EvaluationController@remembreMailParticipants');
    Route::get('evaluations/{id}/{type}', 'EvaluationController@globalEvaluation');
    Route::get('evaluations/{id}/{type}/{nom}', 'EvaluationController@participantEvaluation');

    Route::get('questions', 'QuestionController@index');
    Route::get('questionnaires/{eid}/create', 'QuestionController@create');
    Route::post('questionnaires/store', 'QuestionController@store');
    Route::get('questionnaires/{id}', 'QuestionController@show');
    Route::get('questionnaires/{id}/edit', 'QuestionController@edit');
    Route::delete('questionnaire/{id}/delete', 'QuestionController@destroy');
});

Route::get('questionnaire/{id}/{token}/questions', 'QuestionController@questionnaire');
Route::put('questionnaire/{id}/{token}', 'QuestionController@storeResponses');

Route::group(['prefix' => '/', 'middleware' => ['auth', 'permission:rapports']], function() {
    Route::get('rapports/standard', 'RapportController@standard');
    Route::get('rapports/personnalise', 'RapportController@personnalise');
});

