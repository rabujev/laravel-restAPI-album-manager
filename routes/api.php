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

Route::get('/albums', 'AlbumController@index')->name('albums.all');
Route::post('/albums', 'AlbumController@store')->name('albums.store');
Route::get('/albums/{album}', 'AlbumController@show')->name('albums.show');
Route::put('/albums/{album}', 'AlbumController@update')->name('albums.update');
Route::delete('/albums/{album}', 'AlbumController@destroy')->name('albums.destroy');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
