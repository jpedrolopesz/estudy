<?php

use App\Http\Controllers\Admin\Account\AdminController;
use App\Http\Controllers\Admin\Account\PasswordAdminController;
use App\Http\Controllers\Admin\CreatePlanController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\ModulesController;
use App\Http\Controllers\Admin\Stripe\StripeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CoursesController;
use App\Models\Course;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Redirect;
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
        Route::get('/stripe/create', [StripeController::class, 'create'])->name('stripe.create');



        //** Account Admin */

        Route::get('/profile', [AdminController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile', [AdminController::class, 'update'])->name('admin.profile.update');

        Route::get('/password', [PasswordAdminController::class, 'edit'])->name('admin.password.edit');
        Route::post('/password', [PasswordAdminController::class, 'update'])->name('admin.password.update');




            // Route::resource('/comments', CommentController::class);


              // ================ USERS ================= //
             Route::resource('user', UsersController::class);
             Route::controller(UsersController::class)->group(function () {

                 Route::put('user/{user}/restore', 'restore')->name('user.restore');

             });

             // ================ PLANS ================= //
             Route::resource('plan', CreatePlanController::class);
             Route::controller(CreatePlanController::class)->group(function () {

                 Route::put('plan/{plan}/restore',  'restore')->name('plan.restore');


             });

             // ================ COURSES ================= //
            Route::resource('course', CoursesController::class);
            Route::controller(CoursesController::class)->group(function () {
                //
            });

             // ================ MODULES ================= //
            Route::resource('course.module', ModulesController::class);
            Route::controller(ModulesController::class)->group(function () {

                Route::put('draggable', 'updateDraggable')->name('module.draggable');

            });

            // ================ LESSONS ================= //
            Route::resource('course.module.lesson', LessonsController::class);
            Route::controller(LessonsController::class)->group(function () {

                //
            });





    });








