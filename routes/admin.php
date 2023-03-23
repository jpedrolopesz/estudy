<?php

use App\Http\Controllers\Admin\Account\AdminController;
use App\Http\Controllers\Admin\Account\PasswordAdminController;
use App\Http\Controllers\Admin\CreatePlanController;
use App\Http\Controllers\Admin\Stripe\StripeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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


        // Stripe Test
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

    });






