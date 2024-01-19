<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserLessonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  [LessonController::class, 'index']);

Route::get('/users/{user}/leasson-watched/{lesson}',  [UserLessonController::class, 'store'])->name('watched.lesson');


Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
