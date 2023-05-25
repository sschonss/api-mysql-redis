<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//User Routes
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');

//User Filter Routes
Route::get('/users/filter/{name}', 'App\Http\Controllers\UserController@filterByName');
Route::get('/users/filter/{email}', 'App\Http\Controllers\UserController@filterByEmail');
Route::get('/users/filter/{name}/{email}', 'App\Http\Controllers\UserController@filterByNameAndEmail');

//User Sort Routes

