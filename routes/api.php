<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('links')->group(function() {
    Route::get('/', 'LinkController@findAllByUser');
    Route::get('/{id}', 'LinkController@show');
    Route::post('/', 'LinkController@store');
    Route::put('/{id}', 'LinkController@update');
    Route::delete('/{id}', 'LinkController@destroy');
});

Route::prefix('categorias')->group(function() {
    Route::get('/', 'CategoriaController@findAllByUser');
    Route::get('/{id}', 'CategoriaController@show');
    Route::post('/', 'CategoriaController@store');
    Route::put('/{id}', 'CategoriaController@update');
    Route::delete('/{id}', 'CategoriaController@destroy');
});
