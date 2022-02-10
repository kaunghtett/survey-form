<?php

Route::prefix('survey')->namespace('API\V1')->group(function () {
    Route::post('/store','SurveyController@store');
});