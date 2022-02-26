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
    Route::get('/class/setting/', [App\Http\Controllers\ClassController::class, 'getClassSetting'])->name('class.getClassSetting');
    Route::post('/class/setting/give', [App\Http\Controllers\ClassController::class, 'giveAccess'])->name('class.giveAccess');
    Route::post('/class/setting/block', [App\Http\Controllers\ClassController::class, 'blockAccess'])->name('class.blockAccess');
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
    Route::get('/student/delete/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudent'])->name('student.deleteStudent');
    Route::resources([
        'student' => \App\Http\Controllers\StudentController::class,
    ]);
    //group
    Route::get('/group/month-list', [App\Http\Controllers\GroupController::class, 'getMonthByGroup'])->name('group.getMonthByGroup');
    Route::get('/group/delete/{id}', [App\Http\Controllers\GroupController::class, 'deleteGroup'])->name('group.deleteGroup');
    Route::resources([
        'group' => \App\Http\Controllers\GroupController::class,
    ]);
    //coupon
    Route::get('/coupon/delete/{id}', [App\Http\Controllers\CouponController::class, 'deleteCoupon'])->name('coupon.deleteCoupon');
    Route::resources([
        'coupon' => \App\Http\Controllers\CouponController::class,
    ]);
    //coupon
    Route::get('/announcement/delete/{id}', [App\Http\Controllers\AnnouncementController::class, 'deleteAnnouncement'])->name('announcement.deleteAnnouncement');
    Route::resources([
        'announcement' => \App\Http\Controllers\AnnouncementController::class,
    ]);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
