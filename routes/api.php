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
Route::post('register-user/{hes}','\App\Http\Controllers\API\AuthController@register');
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

Route::get('classroom/{user_id}','\App\Http\Controllers\API\UserController@getUserClassroom');
Route::get('awards/{user_id}','\App\Http\Controllers\API\UserController@Awards');

/*
 * Роути уроків
 * */
Route::get('topics-active','\App\Http\Controllers\API\LessonsController@topics_active');
Route::get('topics','\App\Http\Controllers\API\LessonsController@topics');
Route::get('topics-done','\App\Http\Controllers\API\LessonsController@topics_done');
//Route::get('lesson/{id}','\App\Http\Controllers\API\LessonsController@lesson');
Route::get('topic/{id}','\App\Http\Controllers\API\LessonsController@topic');


Route::get('check-topic/{id}','\App\Http\Controllers\API\LessonsController@check_topic');


Route::put('start-topic/{id}','\App\Http\Controllers\API\LessonsController@start_topic');
Route::put('stop-topic/{id}','\App\Http\Controllers\API\LessonsController@stop_topic');
//Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@start_lesson');
//Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@stop_lesson');


Route::put('update-password/{user_id}','\App\Http\Controllers\API\UserController@update_password');

//Route::put('audit_answer/{question_id}','\App\Http\Controllers\API\LessonsController@audit_answer');
//Route::put('audit_pair/{pair_id}','\App\Http\Controllers\API\LessonsController@audit_answer');
//Route::put('check_video/{lesson_id}','\App\Http\Controllers\API\LessonsController@check_video');
//Route::put('check_video_false/{lesson_id}','\App\Http\Controllers\API\LessonsController@check_video_false');




////////////////////////////////////////////////////////////////////////////////////
///

Route::get('lesson/{lesson_id}','\App\Http\Controllers\API\LessonController@lesson');
//Route::get('lesson-video/{lesson_id}','\App\Http\Controllers\API\LessonController@video');

//Route::get('lesson-tests/{lesson_id}','\App\Http\Controllers\API\LessonController@test');
Route::put('lesson-check-video/{lesson_id}','\App\Http\Controllers\API\LessonController@check_video');
//Route::get('lesson-status-video/{lesson_id}','\App\Http\Controllers\API\LessonController@status_video');
//Route::get('lesson-list-tests/{lesson_id}','\App\Http\Controllers\API\LessonController@list_tests');

//Route::get('lesson-question-result/{lesson_id}','\App\Http\Controllers\API\TestController@question_result');
Route::get('lesson-one-word/{lesson_id}','\App\Http\Controllers\API\TestController@one_word');
Route::get('lesson-pair/{lesson_id}','\App\Http\Controllers\API\LessonController@find_pair');
Route::get('lesson-question/{lesson_id}','\App\Http\Controllers\API\LessonController@question');
Route::get('lesson-crossword/{lesson_id}','\App\Http\Controllers\API\LessonController@crossword');
Route::get('lesson-open-question/{lesson_id}','\App\Http\Controllers\API\LessonController@open_question');
Route::get('lesson-coloring-page/{lesson_id}','\App\Http\Controllers\API\LessonController@coloring_page');

/////////////
Route::post('lesson-crossword/{lesson_id}','\App\Http\Controllers\API\TestController@crossword');
Route::post('lesson-one-word/{lesson_id}','\App\Http\Controllers\API\TestController@one_word_answer');
Route::post('lesson-question/{lesson_id}','\App\Http\Controllers\API\TestController@question');
Route::post('lesson-pair/{lesson_id}','\App\Http\Controllers\API\TestController@pair');
Route::post('lesson-open-question/{lesson_id}','\App\Http\Controllers\API\TestController@open_question');
Route::post('lesson-coloring-page/{lesson_id}','\App\Http\Controllers\API\TestController@coloring_page');
//Auth::routes();

//Route::get('lesson-test','\App\Http\Controllers\API\TestController@test');
