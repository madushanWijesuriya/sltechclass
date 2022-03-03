<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\MonthController;
use Illuminate\Support\Facades\Auth;
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
    //payment
    Route::get('/payment/delayed', [App\Http\Controllers\PaymentController::class, 'delayedIndex'])->name('payment.delayedIndex');
    Route::get('/payment/received', [App\Http\Controllers\PaymentController::class, 'receivedIndex'])->name('payment.receivedIndex');
    Route::get('/payment/approve/{id}', [App\Http\Controllers\PaymentController::class, 'approve'])->name('payment.approve');
    Route::get('/payment/send-warning/{user_id}/{month_id}', [App\Http\Controllers\PaymentController::class, 'sendWarning'])->name('payment.sendWarning');
    Route::resources([
        'payment' => \App\Http\Controllers\PaymentController::class,
    ]);

});
Route::middleware(['auth'])->prefix('student')->group(function (){
    Route::post('/user/my-class/direct-pay', [\App\Http\Controllers\Student\SubscriptionController::class, 'directPay'])->name('directPay');
    Route::get('/user/my-class/{id}/payment', [\App\Http\Controllers\Student\StudentUserController::class, 'payNow'])->name('class.payNow');
    Route::get('/user/my-class/payment/confirm/{month_id}', [\App\Http\Controllers\Student\StudentUserController::class, 'quickPay'])->name('class.quickPay');
    Route::post('/user/my-class/payment/confirm', [\App\Http\Controllers\Student\StudentUserController::class, 'checkout'])->name('class.checkout');
    Route::get('/user/my-class/payment/get-total', [\App\Http\Controllers\Student\StudentUserController::class, 'getTotal'])->name('class.getTotal');



    Route::get('/user/payments/delay', [\App\Http\Controllers\Student\StudentUserController::class, 'delayPayment'])->name('class.delayPayment');
    Route::get('/user/payments/history', [\App\Http\Controllers\Student\StudentUserController::class, 'paymentHistory'])->name('class.paymentHistory');
    Route::get('/announcement/{id}/read/', [\App\Http\Controllers\Student\StudentAnnoucementController::class, 'read'])->name('announcementStudent.read');

    Route::resources([
        'user' => \App\Http\Controllers\Student\StudentUserController::class,
        'announcementStudent' => \App\Http\Controllers\Student\StudentAnnoucementController::class,
    ]);

    //subscription for class months
    Route::get('/notify', [\App\Http\Controllers\Student\SubscriptionController::class, 'notify'])->name('notify');
    Route::get('/return', [\App\Http\Controllers\Student\SubscriptionController::class, 'return'])->name('return');
    Route::get('/cancel', [\App\Http\Controllers\Student\SubscriptionController::class, 'cancel'])->name('cancel');



});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
