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
///

//Route::get('/forgot-password', function () {
//    return view('auth.forgot-password');
//})->middleware('guest')->name('password.request');

Route::post('/forget-passwords', '\App\Http\Controllers\API\AuthController@forget_password');

//Route::get('/reset-password/{token}', function ($token) {
//    return response(['token' => $token]);
//})->middleware('guest:api')->name('password.reset');
//
//Route::post('/reset-password', '\App\Http\Controllers\API\AuthController@reset_password')->middleware('guest:api')->name('password.update');


//Route::middleware('','')
    Route::post('register-user/{hes}','\App\Http\Controllers\API\AuthController@register');
    Route::post('register-user','\App\Http\Controllers\API\AuthController@register');
    Route::post('login-user','\App\Http\Controllers\API\AuthController@passportLogin');
    Route::post('logout-user','\App\Http\Controllers\API\AuthController@passportlogout')->middleware(['auth:api']);


/// /////////////////////////////////
//Auth::routes();

//Route::post('test',function (){
//   return response('Привіт світ', 200);
//});


//Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'loginUser']);
//Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

/*РЕЄСТРАЦІЯ КОРИСТУВАЧА
 * */
//Route::post('register','\App\Http\Controllers\API\UserController@store');

Route::get('mail','\App\Http\Controllers\API\UserController@test_email');

Route::get('get-user','\App\Http\Controllers\API\UserController@get_user')->middleware(['auth:api']);

//користувачі
Route::get('user','\App\Http\Controllers\API\UserController@index')->middleware(['auth:api']);
Route::get('user/{id}','\App\Http\Controllers\API\UserController@show')->middleware(['auth:api']);
Route::put('user/{id}','\App\Http\Controllers\API\UserController@update')->middleware(['auth:api']);
Route::post('user-photo/{id}','\App\Http\Controllers\API\UserController@photo')->middleware(['auth:api']);
Route::delete('user/{id}','\App\Http\Controllers\API\UserController@destroy')->middleware(['auth:api']);


Route::post('user-award/{user_id}','\App\Http\Controllers\API\UserController@addAwards')->middleware(['auth:api']);
Route::get('user-award-available/{user_id}','\App\Http\Controllers\API\UserController@AwardsAll')->middleware(['auth:api']);

Route::get('user-open-question/{user_id}','\App\Http\Controllers\API\UserController@NonAuditOpenQuestions')->middleware(['auth:api']);
Route::get('audit-open-question','\App\Http\Controllers\API\UserController@NonOpenQuestions')->middleware(['auth:api']);
Route::post('user-open-question/{question_id}','\App\Http\Controllers\API\TestController@openQuestionAudit')->middleware(['auth:api']);
Route::get('user-open-question-completed/{user_id}','\App\Http\Controllers\API\UserController@AuditOpenQuestions')->middleware(['auth:api']);
Route::get('audit-open-question-completed','\App\Http\Controllers\API\UserController@OpenQuestions')->middleware(['auth:api']);

Route::post('check-email','\App\Http\Controllers\API\UserController@check')->middleware(['auth:api']);

Route::get('classroom/{user_id}','\App\Http\Controllers\API\UserController@getUserClassroom')->middleware(['auth:api']);
Route::get('awards/{user_id}','\App\Http\Controllers\API\UserController@Awards')->middleware(['auth:api']);

/*
 * Роути уроків
 * */
Route::get('topics-active','\App\Http\Controllers\API\TopicController@active')->middleware(['auth:api']);
Route::get('topics','\App\Http\Controllers\API\TopicController@all')->middleware(['auth:api']);
Route::get('topics-done','\App\Http\Controllers\API\TopicController@done')->middleware(['auth:api']);

Route::get('user-topics-active/{user_id}','\App\Http\Controllers\API\TopicController@user_active')->middleware(['auth:api']);
Route::get('user-topics/{user_id}','\App\Http\Controllers\API\TopicController@user_all')->middleware(['auth:api']);
Route::get('user-topics-done/{user_id}','\App\Http\Controllers\API\TopicController@user_done')->middleware(['auth:api']);

//Route::get('user-topics-active/{user_id}','\App\Http\Controllers\API\LessonsController@topics_active');
//Route::get('user-topics/{user_id}','\App\Http\Controllers\API\LessonsController@topics');
//Route::get('user-topics-done/{user_id}','\App\Http\Controllers\API\LessonsController@topics_done');


//Route::get('lesson/{id}','\App\Http\Controllers\API\LessonsController@lesson');
Route::get('topic/{id}','\App\Http\Controllers\API\TopicController@getTopic')->middleware(['auth']);


Route::get('check-topic/{id}','\App\Http\Controllers\API\LessonsController@check_topic')->middleware(['auth:api']);


Route::put('start-topic/{id}','\App\Http\Controllers\API\LessonsController@start_topic')->middleware(['auth:api']);
Route::put('stop-topic/{id}','\App\Http\Controllers\API\LessonsController@stop_topic')->middleware(['auth:api']);
//Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@start_lesson');
//Route::put('start-lesson/{id}','\App\Http\Controllers\API\LessonsController@stop_lesson');


Route::put('update-password/{user_id}','\App\Http\Controllers\API\UserController@update_password')->middleware(['auth:api']);

//Route::put('audit_answer/{question_id}','\App\Http\Controllers\API\LessonsController@audit_answer');
//Route::put('audit_pair/{pair_id}','\App\Http\Controllers\API\LessonsController@audit_answer');
//Route::put('check_video/{lesson_id}','\App\Http\Controllers\API\LessonsController@check_video');
//Route::put('check_video_false/{lesson_id}','\App\Http\Controllers\API\LessonsController@check_video_false');




////////////////////////////////////////////////////////////////////////////////////
///

Route::get('lesson/{lesson_id}','\App\Http\Controllers\API\LessonController@lesson')->middleware(['auth:api']);
//Route::get('lesson-video/{lesson_id}','\App\Http\Controllers\API\LessonController@video');

//Route::get('lesson-tests/{lesson_id}','\App\Http\Controllers\API\LessonController@test');
Route::put('lesson-check-video/{lesson_id}','\App\Http\Controllers\API\LessonController@check_video')->middleware(['auth:api']);
//Route::get('lesson-status-video/{lesson_id}','\App\Http\Controllers\API\LessonController@status_video');
//Route::get('lesson-list-tests/{lesson_id}','\App\Http\Controllers\API\LessonController@list_tests');

//Route::get('lesson-question-result/{lesson_id}','\App\Http\Controllers\API\TestController@question_result');
Route::get('lesson-one-word/{lesson_id}','\App\Http\Controllers\API\TestController@one_word')->middleware(['auth:api']);
Route::get('lesson-pair/{lesson_id}','\App\Http\Controllers\API\LessonController@find_pair')->middleware(['auth:api']);
Route::get('lesson-question/{lesson_id}','\App\Http\Controllers\API\LessonController@question')->middleware(['auth:api']);
Route::get('lesson-crossword/{lesson_id}','\App\Http\Controllers\API\LessonController@crossword')->middleware(['auth:api']);
Route::get('lesson-open-question/{lesson_id}','\App\Http\Controllers\API\LessonController@open_question')->middleware(['auth:api']);
Route::get('lesson-coloring-page/{lesson_id}','\App\Http\Controllers\API\LessonController@coloring_page')->middleware(['auth:api']);


Route::get('test','\App\Http\Controllers\API\LessonsController@DTO')->middleware(['auth:api']);

/////////////
Route::post('lesson-crossword/{lesson_id}','\App\Http\Controllers\API\TestController@crossword')->middleware(['auth:api']);
Route::post('lesson-one-word/{lesson_id}','\App\Http\Controllers\API\TestController@one_word_answer')->middleware(['auth:api']);
Route::post('lesson-question/{lesson_id}','\App\Http\Controllers\API\TestController@question')->middleware(['auth:api']);
Route::post('lesson-pair/{lesson_id}','\App\Http\Controllers\API\TestController@pair')->middleware(['auth:api']);
Route::post('lesson-open-question/{lesson_id}','\App\Http\Controllers\API\TestController@open_question')->middleware(['auth:api']);
Route::post('lesson-coloring-page/{lesson_id}','\App\Http\Controllers\API\TestController@coloring_page')->middleware(['auth:api']);
//Auth::routes();

//Route::get('lesson-test','\App\Http\Controllers\API\TestController@test');




Route::get('topics-teacher','\App\Http\Controllers\API\TeacherController@getTopics');//->middleware(['auth:api']);
Route::get('lessons-teacher/{topic_id}','\App\Http\Controllers\API\TeacherController@getLessons');//->middleware(['auth:api']);
Route::get('lesson-teacher/{lesson_id}','\App\Http\Controllers\API\TeacherController@getLesson');//->middleware(['auth:api']);
