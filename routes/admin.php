<?php


use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\CreatePlanController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\ModulesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/{comment}/reply',[CommentsController::class, 'storeReply'])->name('storeReply');
Route::post('/comment',[CommentsController::class, 'storeComment'])->name('storeComment');


// ================ Primary Access ================= //
Route::get('admin/config', [RegisteredAdminController::class, 'create'])
    ->middleware('admin.registered')
    ->name('admin.config');
Route::post('admin/config', [RegisteredAdminController::class, 'store'])->name('config.store');

Route::prefix('admin')->middleware(['auth','isAdmin', 'verified'])
    ->group(function () {


        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');


        Route::middleware('demo')->group(function () {

            // ================ COMMENTS ================= //

            Route::resource('/comments', CommentsController::class);
            Route::controller(CommentsController::class)->group(function () {

            });

            // ================ USERS ================= //
            Route::resource('user', UsersController::class);
            Route::controller(UsersController::class)->group(function () {

                Route::put('user/{user}/restore', 'restore')->name('user.restore');
                Route::put('user/{user}/password', 'updatePassword')->name('user.password');

            });

            // ================ PLANS ================= //
            Route::resource('plan', CreatePlanController::class);
            Route::controller(CreatePlanController::class)->group(function () {

                Route::put('plan/{plan}/restore',  'restore')->name('plan.restore');


            });
            // ================ COURSES ================= //
            Route::resource('course', CoursesController::class);
            Route::controller(CoursesController::class)->group(function () {

                Route::put('course/{course}/restore',  'restore')->name('course.restore');

            });


            // ================ LESSONS ================= //
            Route::resource('course.module.lesson', LessonsController::class);
            Route::controller(LessonsController::class)->group(function () {

                //
            });


        });




             // ================ MODULES ================= //
            Route::resource('course.module', ModulesController::class);
            Route::controller(ModulesController::class)->group(function () {

                Route::put('draggable', 'updateDraggable')->name('module.draggable');

            });


        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });








