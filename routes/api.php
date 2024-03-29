<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::get('/refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        // Route::resource('movies', 'MoviesController', ['except' => [ 'edit']]);
        Route::get('moviesList', 'MoviesController@Allmovies');
        Route::post('newMovie', 'MoviesController@create');
        Route::get('editMovie/{id}', 'MoviesController@show');
        Route::post('updateMovie/{id}', 'MoviesController@update');
        Route::delete('delete/{id}', 'MoviesController@destroy');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
});
