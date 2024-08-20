<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\PlanController;

/** start Auth */
Route::get('/login', function () {
    return view('auth/login');
})->name('login')->middleware('guest');
Route::get('/', function () {  return redirect()->route('login'); });
Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin');
Route::get('register', function () {
    return view('auth/register');
})->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('save-register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
/** end Auth */

Route::group(['middleware' => 'auth'],function(){
    Route::resource('url', UrlController::class);
    Route::post('url/disable/{url}', [UrlController::class, 'disable'])->name('url.disable');
    Route::get('plan',[PlanController::class , 'index'])->name('plan');
});
