<?php


Route::post('register','API\V1\Auth\AuthController@register');
Route::post('login','API\V1\Auth\AuthController@login');

Route::prefix('survey')->middleware('auth:sanctum')->namespace('API\V1')->group(function () {
    Route::post('store','SurveyController@submitForm');
    Route::get('all','SurveyController@getAllSurveys');
    Route::get('detail/{id}','SurveyController@getSurvey');
});