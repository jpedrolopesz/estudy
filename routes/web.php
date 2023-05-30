<?php

use App\Http\Controllers\User\Account\Subscription\SubscriptionInvoiceController;
use App\Http\Controllers\User\Account\Subscription\SubscriptionController;
use App\Http\Controllers\User\Account\PasswordController;
use App\Http\Controllers\User\Account\DeleteController;
use App\Http\Controllers\User\Account\UserController;
use App\Http\Controllers\User\Account\PlanController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\User\CourseUserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [WebsiteController::class, 'index'])->name('website.index');


Route::get('/courses', [CourseUserController::class, 'index'])->name('course.user.index');
Route::get('/v/course/{course}', [CourseUserController::class, 'showCourse'])->name('showCourse');





// Panel User
Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** Subscription */
Route::group(['prefix' => 'subscription', 'middleware' => ['auth','verified'],'as' => 'subscription.'], function (){
    Route::get('/{plan_id}', [SubscriptionController::class, 'subscription'])->name('subscription');
    Route::post('/', [SubscriptionController::class, 'processSubscription'])->name('process');
    Route::post('/plans', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::post('/cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
    Route::post('/resume', [SubscriptionController::class, 'resume'])->name('resume');


    //Route::post('/cancel', [SubscriptionCancelController::class, 'cancel'])->name('cancel');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [PasswordController::class, 'update'])->name('update.password');

    Route::get('/delete', [DeleteController::class, 'show'])->name('delete.show');
    Route::delete('/delete', [DeleteController::class, 'destroy'])->name('profile.destroy');


    Route::get('/plans', [PlanController::class, 'show'])->name('plans.show');

    /** Invoice */
    Route::get('/invoice', [SubscriptionInvoiceController::class, 'show'])
        ->name('invoice.show')
        ->middleware('EnsureUserIsSubscribed');
    // Route::get('/invoice/{id}', [SubscriptionInvoiceController::class, 'show'])->name('invoice');




});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';



