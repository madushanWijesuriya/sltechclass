<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\MonthController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/class/delete/{id}', [App\Http\Controllers\ClassController::class, 'deleteClass'])->name('class.deleteClass');
    Route::resources([
        'class' => ClassController::class,
    ]);


    //month
    Route::get('/month/create/{id}', [App\Http\Controllers\MonthController::class, 'createMonth'])->name('month.createMonth');
    Route::get('/month/delete/{id}', [App\Http\Controllers\MonthController::class, 'deleteMonth'])->name('month.deleteMonth');
    Route::resources([
        'month' => MonthController::class,
    ]);
    //video
    Route::get('/video/create/{id}', [App\Http\Controllers\VideoController::class, 'createVideo'])->name('video.createMonth');
    Route::get('/video/delete/{id}', [App\Http\Controllers\VideoController::class, 'deleteVideo'])->name('video.deleteVideo');
    Route::resources([
        'video' => \App\Http\Controllers\VideoController::class,
    ]);
    //quiz
    Route::get('/quiz/create/{id}', [App\Http\Controllers\QuizController::class, 'createQuiz'])->name('quiz.createQuiz');
    Route::get('/quiz/delete/{id}', [App\Http\Controllers\QuizController::class, 'deleteQuiz'])->name('quiz.deleteQuiz');
    Route::resources([
        'quiz' => \App\Http\Controllers\QuizController::class,
    ]);
    //student
    Route::resources([
        'student' => \App\Http\Controllers\StudentController::class,
    ]);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
