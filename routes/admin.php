<?php

use App\Http\Controllers\Admin\Account\PasswordAdminController;
use App\Http\Controllers\Admin\Account\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UsersController;
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


Route::prefix('admin')->middleware(['auth'])
    ->group(function () {


        /*** Routes Admin*/
        Route::put('/admins/{id}/update-image', [UsersController::class, 'uploadFile'])->name('admins.update.image');
        Route::get('/admins/{id}/image', [UsersController::class, 'changeImage'])->name('admins.change.image');
        Route::resource('/admins', UsersController::class);

        /** Routes Users*/
        Route::put('/users/{id}/update-image', [UsersController::class, 'uploadFile'])->name('users.update.image');
        Route::get('/users/{id}/image', [UsersController::class, 'changeImage'])->name('users.change.image');
        Route::delete('/users/{id}', [UsersController::class , 'destroy'])->name('users.destroy');
        Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');

        /** Account Tenant */
        Route::group(['prefix' => 'account',  'as' => 'account.'], function () {

            Route::get('/', function () {
                return Inertia::render('Admin/Account/Show');
            });

            /** User Profile */
            Route::get('profile', [ProfileController::class, 'show'])->name('profile');
            Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

            /** Password Profile */
            Route::get('password', [PasswordAdminController::class, 'show'])->name('password');
            Route::put('password', [PasswordAdminController::class, 'update'])->name('password.update');

            /**  Company */
            Route::get('company', [CompanyController::class, 'show'])->name('company');
            Route::post('company', [CompanyController::class, 'store'])->name('company.store');

            /**  Manage Team */
            Route::delete('team/{id}', [TeamController::class, 'destroy'])->name('team.destroy');
            Route::post('team', [TeamController::class, 'store'])->name('team.store');
            Route::put('team/view/{id}', [TeamController::class, 'update'])->name('team.update');
            Route::get('team', [TeamController::class, 'show'])->name('team');
            Route::get('team/{id}/edit', [TeamController::class, 'edit'])->name('team.edit');
            Route::get('team/view/{id}', [TeamController::class, 'show'])->name('team.view');

        });

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');


    });

require __DIR__.'/auth.php';



