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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () { return view('welcome'); });

    Route::get('/login', 'Auth\AuthController@getLogin');# Show login form
    Route::post('/login', 'Auth\AuthController@postLogin');# Process login form
    Route::get('/logout', 'Auth\AuthController@getLogout');# Process logout
    Route::get('/register', 'Auth\AuthController@getRegister');# Show registration form
    Route::post('/register', 'Auth\AuthController@postRegister');# Process registration form

    Route::get('/chat/{id}', 'ChatController@getChat');
    Route::post('/chat/create', 'ChatController@create');
    Route::post('/chat/{id}', 'MessageController@create');
    Route::get('/chat/transcript/{id}', 'ChatController@downloadTranscript');

    Route::group(['middleware' => 'auth'], function () {
        #Routes for representatives
        Route::get('/chat/unassigned', 'ChatController@unassigned');
        Route::get('/chat/myinbox', 'ChatController@inbox');
    });
});
