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


//////////////////////////////////////////////
Route::post('register-user','\App\Http\Controllers\API\AuthController@register');
Route::post('login-user','\App\Http\Controllers\API\AuthController@login');
Route::post('logout-user','\App\Http\Controllers\API\AuthController@logout');//->middleware(['auth']);


/// /////////////////////////////////
Auth::routes();

//Route::post('test',function (){
//   return response('Привіт світ', 200);
//});


//Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'loginUser']);
//Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

/*РЕЄСТРАЦІЯ КОРИСТУВАЧА
 * */
//Route::post('register','\App\Http\Controllers\API\UserController@store');

Route::get('mail','\App\Http\Controllers\API\UserController@test_email');

Route::get('get-user','\App\Http\Controllers\API\UserController@get_user');//->middleware(['auth']);

//користувачі
Route::get('user','\App\Http\Controllers\API\UserController@index');//->middleware(['auth']);
Route::get('user/{id}','\App\Http\Controllers\API\UserController@show');//->middleware(['auth']);
Route::put('user/{id}','\App\Http\Controllers\API\UserController@update');//->middleware(['auth']);
Route::post('user-photo/{id}','\App\Http\Controllers\API\UserController@photo');//->middleware(['auth']);
Route::delete('user/{id}','\App\Http\Controllers\API\UserController@destroy');//->middleware(['auth']);

Route::post('check-email','\App\Http\Controllers\API\UserController@check');


/*
 * Роути уроків
 * */
Route::get('topics-active','\App\Http\Controllers\API\LessonsController@topics_active');
Route::get('topics','\App\Http\Controllers\API\LessonsController@topics');
Route::get('topics-done','\App\Http\Controllers\API\LessonsController@topics_done');
Route::get('lesson/{id}','\App\Http\Controllers\API\LessonsController@lesson');
Route::get('topic/{id}','\App\Http\Controllers\API\LessonsController@topic');


Route::get('check-topic/{id}','\App\Http\Controllers\API\LessonsController@check_topic');


Route::put('start-topic/{id}','\App\Http\Controllers\API\LessonsController@start_topic');
Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@start_lesson');
//Auth::routes();
