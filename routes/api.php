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


Route::middleware('auth:api')->group(function () {

    Route::get('/albums', 'AlbumController@index')->name('albums.all');
    Route::post('/albums', 'AlbumController@store')->name('albums.store');
    Route::get('albums/search', 'AlbumController@search');
    Route::get('/albums/{id}', 'AlbumController@show')->name('albums.show');
    Route::put('/albums/{id}', 'AlbumController@update')->name('albums.update');
    Route::delete('/albums/{id}', 'AlbumController@destroy')->name('albums.destroy');

    Route::post('/logout', 'AuthController@logout');
});



Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
