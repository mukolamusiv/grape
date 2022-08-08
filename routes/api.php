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

//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Auth::routes();

Route::post('test',function (){
   return response('Привіт світ', 200);
});


//Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'loginUser']);
//Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

/*РЕЄСТРАЦІЯ КОРИСТУВАЧА
 * */
Route::post('register','\App\Http\Controllers\API\UserController@store');

//користувачі
Route::get('user','\App\Http\Controllers\API\UserController@index');
Route::get('user/{id}','\App\Http\Controllers\API\UserController@show');//->middleware(['auth']);
Route::put('user/{id}','\App\Http\Controllers\API\UserController@update');//->middleware(['auth']);
Route::delete('user/{id}','\App\Http\Controllers\API\UserController@destroy');//->middleware(['auth']);



/*
 * Роути уроків
 * */
Route::get('topics','\App\Http\Controllers\API\LessonsController@topics');
Route::get('lesson/{id}','\App\Http\Controllers\API\LessonsController@lesson');
Route::get('topic/{id}','\App\Http\Controllers\API\LessonsController@topic');


Route::get('check-topic/{id}','\App\Http\Controllers\API\LessonsController@check_topic');


Route::put('start-topic/{id}','\App\Http\Controllers\API\LessonsController@start_topic');
Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@start_lesson');
//Auth::routes();
