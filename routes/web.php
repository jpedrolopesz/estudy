<?php

use App\Http\Controllers\Admin\Account\AdminController;
use App\Http\Controllers\Admin\Account\PasswordAdminController;
use App\Http\Controllers\Admin\CreatePlanController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Stripe\StripeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\Account\DeleteController;
use App\Http\Controllers\User\Account\PlanController;
use App\Http\Controllers\User\Account\PasswordController;
use App\Http\Controllers\User\Account\Subscription\SubscriptionInvoiceController;
use App\Http\Controllers\User\Account\Subscription\SubscriptionController;
use App\Http\Controllers\User\Account\UserController;
use App\Http\Controllers\User\CoursesController;
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




Route::prefix('admin')->middleware(['auth','isAdmin', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');

        Route::get('/checkout', function () {
            return Inertia::render('Subscription/Show', [
                'intent' => auth()->user()->createSetupIntent(),

            ]);
        })->name('checkout.index');




        //Stripe Test


        Route::get('/stripe', [StripeController::class, 'show'])->name('stripe.show');


        //** Users */

        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('user.edit');
        Route::post('users/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::put('users/{user}/restore', [UsersController::class, 'restore'])->name('users.restore');


        //** Account Admin */

        Route::get('/profile', [AdminController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile', [AdminController::class, 'update'])->name('admin.profile.update');

        Route::get('/password', [PasswordAdminController::class, 'edit'])->name('admin.password.edit');
        Route::post('/password', [PasswordAdminController::class, 'update'])->name('admin.password.update');


        //** Create Plans */
        Route::group(['prefix' => 'plan'], function () {

            Route::get('/create', [CreatePlanController::class, 'create'])->name('pages.plans.create');
            Route::post('/', [CreatePlanController::class, 'store'])->name('plans.store');
            Route::put('/{id}', [CreatePlanController::class, 'update'])->name('plans.update');
            Route::delete('/{id}', [CreatePlanController::class, 'destroy'])->name('plans.destroy');
            Route::get('/', [CreatePlanController::class, 'show'])->name('pages.plans.show');
            Route::get('/{plan}/edit', [CreatePlanController::class, 'edit'])->name('pages.plans.edit');
            Route::put('/{plan}/restore', [CreatePlanController::class, 'restore'])->name('plans.restore');

        });

        // Order
        Route::get('/orders', [OrderController::class, 'show'])->name('orders.show');
       Route::get('/orders/{order}', [OrderController::class, 'orderDetails'])->name('orders.details');
       // Route::get('/orders/pdf/download/{order}', [OrderController::class, 'orderPdfDownload'])->name('orders.pdf.download')->withoutMiddleware('check.admin.role');


    });



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
        ->name('invoice.show')->middleware('EnsureUserIsSubscribed');
   // Route::get('/invoice/{id}', [SubscriptionInvoiceController::class, 'show'])->name('invoice');
});


Route::resource('/courses', CoursesController::class);
Route::resource('/comments', CommentController::class);



require __DIR__.'/auth.php';



