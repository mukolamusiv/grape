<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('demo');
//});
//Route::prefix('admins')->group(function (){
//    Auth::routes();
//});

//Route::get('/reset-password/{token}', function ($token) {
//    return view('auth.passwords.confirm', ['token' => $token]);
//})->middleware('guest')->name('password.reset');
//

Route::get('/{any}', function () {
    return view('test');})->where('any', '.*');
//Route::get('/app/{vue_capture?}', function () {
//    return view('test');
//
//
//})->where('vue_capture', '[\/\w\.-]*');
//Route::get('/app/login', function () {
//    return view('test');
//})->where('vue_capture', '[\/\w\.-]*');

//Route::get('/', function () {
//    return view('demo');
//});


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
