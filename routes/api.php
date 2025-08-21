<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\ProjectController;
// routes/api.php

use App\Http\Controllers\Api\CustomerCareController;




Route::post('signin', [AuthController::class, 'signin']);
Route::post('signup', [AuthController::class, 'signup']);
//
Route::post('signup/professional', [AuthController::class, 'signupAsProfessional']);
Route::post('signup/company', [AuthController::class, 'signupAsCompany']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('contact-us', [ContactUsController::class, 'store']);
// Customer Care
Route::get('projects', [ProjectController::class, 'getallProjects']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('profile', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);



});

