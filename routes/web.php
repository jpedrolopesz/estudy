<?php

use App\Http\Controllers\Admin\Courses\CoursesController;
use App\Http\Controllers\Admin\CreatePlanController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\User\Account\DeleteController;
use App\Http\Controllers\User\Account\PlanController;
use App\Http\Controllers\User\Account\PasswordController;
use App\Http\Controllers\User\Account\Subscription\SubscriptionInvoiceController;
use App\Http\Controllers\User\Account\Subscription\SubscriptionController;
use App\Http\Controllers\User\Account\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::prefix('admin')->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');

        //** Users */

        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('user.edit');
        Route::post('users/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::put('users/{user}/restore', [UsersController::class, 'restore'])->name('users.restore');


        //** Courses */

        Route::get('/courses', [CoursesController::class, 'show'])->name('courses.show');


        //** Create Plans */
        Route::group(['prefix' => 'plan'], function () {



           // Route::delete('/{id}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.destroy');
          //  Route::put('/{id}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.update');
           // Route::post('/{id}/details', [DetailPlanController::class, 'store'])->name('details.store');
          //  Route::get('/{id}/details/create', [DetailPlanController::class, 'create'])->name('pages.plans.details.create');
          //  Route::get('/{id}/details', [DetailPlanController::class, 'index'])->name('pages.plans.details.index');
           // Route::get('/{id}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('pages.plans.details.edit');


            Route::get('/create', [CreatePlanController::class, 'create'])->name('pages.plans.create');
            Route::post('/', [CreatePlanController::class, 'store'])->name('plans.store');
            Route::put('/{id}', [CreatePlanController::class, 'update'])->name('plans.update');
            Route::delete('/{id}', [CreatePlanController::class, 'destroy'])->name('plans.destroy');
            Route::get('/', [CreatePlanController::class, 'index'])->name('pages.plans.index');
            Route::get('/view/{id}', [CreatePlanController::class, 'show'])->name('pages.plans.view');
            Route::get('/{plan}/edit', [CreatePlanController::class, 'edit'])->name('pages.plans.edit');
            Route::put('/{plan}/restore', [CreatePlanController::class, 'restore'])->name('plans.restore');


        });


    });

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');




// Panel User
Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** Subscription */
Route::group(['prefix' => 'subscription', 'middleware' => ['auth','verified'],'as' => 'subscription.'], function (){
    Route::get('/{plan_id}', [SubscriptionController::class, 'subscription'])->name('subscription');
    Route::post('/', [SubscriptionController::class, 'processSubscription'])->name('process');
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
    Route::get('/invoice', [SubscriptionInvoiceController::class, 'show'])->name('invoice.show');
   // Route::get('/invoice/{id}', [SubscriptionInvoiceController::class, 'show'])->name('invoice');
});



require __DIR__.'/auth.php';



