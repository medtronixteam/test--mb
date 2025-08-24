<?php

use App\Http\Controllers\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Livewire\Admin\Projects;

Route::get('/', [UserController::class, 'auth_login'])->name('auth-login');
Route::get('/login', [UserController::class, 'auth_login'])->name('auth-login');
Route::post('/login', [LoginController::class, 'auth'])->name('login');

Route::get('/auth-register', [UserController::class, 'auth_register'])->name('auth-register');
Route::get('/auth-reset-password', [UserController::class, 'reset_password'])->name('auth-reset-password');
Route::get('/blank', [UserController::class, 'blank'])->name('blank');
Route::get('/auth-forgot-password', [UserController::class, 'forgetpassword'])->name('auth-forgot-password');


Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::post('/models/file', [FileUploadController::class, 'upload']);
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('reset-pass', [UserController::class, 'resetPass'])->name('reset.password');

    //projects
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/list', Projects::class)->name('projects');
    Route::post('projects/upload-chunk', [ProjectController::class, 'uploadChunk'])->name('projects.upload-chunk');
    Route::post('projects/store', [ProjectController::class, 'store'])->name('projects.store');


    //blogs
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/list', \App\Livewire\Admin\Blogs::class)->name('blogs');
    Route::post('blogs/upload-chunk', [BlogController::class, 'uploadChunk'])->name('blogs.upload-chunk');
    Route::post('blogs/store', [BlogController::class, 'store'])->name('blogs.store');

    //jobs

    Route::get('/jobs', App\Livewire\Company\Jobs\JobList::class)->name('jobs.list');
    Route::get('/jobs/create', App\Livewire\Company\Jobs\JobForm::class)->name('jobs.create');
    Route::get('/jobs/{id}/edit', App\Livewire\Company\Jobs\JobForm::class)->name('jobs.edit');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'warehouse', 'as' => 'warehouse.'], function () {});


// routes/web.phps

// routes/web.php
use App\Livewire\JobListing;

Route::get('/jobs/list', JobListing::class)->name('jobs.index');
