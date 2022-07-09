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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('test',function (){
   return response('Привіт світ', 200);
});

/*РЕЄСТРАЦІЯ КОРИСТУВАЧА
 * */
Route::post('register','\App\Http\Controllers\API\UserController@store');

//користувачі
Route::get('user','\App\Http\Controllers\API\UserController@index');
Route::get('user/{id}','\App\Http\Controllers\API\UserController@show');
Route::put('user/{id}','\App\Http\Controllers\API\UserController@update');
Route::delete('user/{id}','\App\Http\Controllers\API\UserController@destroy');



