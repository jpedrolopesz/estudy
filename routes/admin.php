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




       // Route::resource('/comments', CommentController::class);
        Route::resource('/courses', CoursesController::class);


        Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
        Route::group(['prefix' => 'course/{course}'], function () {
            // Courses boards
            Route::controller(CoursesController::class)->group(function () {
                Route::get('', function (Course $course) {
                    return Redirect::route('courses.overview', [
                        'course' => $course,
                    ]);
                })->name('courses.show');
                Route::get('edit', 'edit')->name('courses.edit');
                Route::put('', 'update')->name('course.update');




                /**
                Route::put('', 'update')->name('courses.update');
                Route::get('overview', 'overview')->name('courses.overview');
                Route::get('list', 'list')->name('courses.list');
                Route::get('board', 'board')->name('courses.board');
                Route::put('draggable', 'updateDraggable')->name('courses.draggable');
                Route::put('archive', 'toggleArchive')->name('courses.archive');
                Route::put('favorite', 'toggleFavorite')->name('courses.favorite');
                 * **/
            });


          // Modules settings
          Route::controller(ModulesController::class)->group(function () {

              Route::get('modules/', 'show')->name('module.show');
              Route::post('modules/', 'store')->name('module.store');
              Route::put('modules/', 'update')->name('module.update');
              Route::put('/draggable', 'updateDraggable')->name('module.draggable');


          });
            // Modules settings

            Route::controller(LessonsController::class)->group(function () {
                Route::get('/module/{module_id}/create', 'create')->name('lesson.create');
                Route::post('/module/{module_id}/lessons', 'store')->name('lesson.store');
                Route::get('/module/{module_id}/lesson/{lesson_id}/edit', 'edit')->name('lesson.edit');


            });
            /*


            Route::controller(TaskController::class)->group(function () {
                Route::post('tasks', 'store')->name('tasks.store');
                Route::put('tasks/{task}', 'update')->name('tasks.update');
                Route::put('tasks/{task}/resolve', 'toggleResolvedStatus')->name('tasks.resolve');
                Route::get('tasks/{task:display_key}', 'show')->name('tasks.show');
            });

            // Related tasks
            Route::controller(TaskRelationController::class)->group(function () {
                Route::get('tasks/{task}/unrelated', 'getUnrelatedTasks')->name('tasks.unrelated');
                Route::post('tasks/{task}/relate', 'relate')->name('tasks.relate');
                Route::delete('tasks/{task}/unrelate', 'unrelate')->name('tasks.unrelate');
            });

            // Comments
            Route::controller(CommentController::class)->group(function () {
                Route::post('tasks/{task}/comments', 'store')->name('comments.store');
                Route::put('tasks/{task}/comments/{comment}', 'update')->name('comments.update');
                Route::delete('tasks/{task}/comments/{comment}', 'destroy')->name('comments.destroy');
            });

            // File Attachments
            Route::controller(UploadAttachmentController::class)->group(function () {
                Route::post('tasks/{task}/upload', 'upload')->name('tasks.upload');
                Route::delete('tasks/{task}/media/{media}', 'destroy')->name('media.destroy');
                Route::get('tasks/{task}/media/{media}', 'download')->name('media.download');
            });

            */
        });




    });








