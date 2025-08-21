<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/jobs', [JobApplicationController::class, 'index']);
    Route::post('/jobs', [JobApplicationController::class, 'store']);
    Route::get('/jobs/{id}', [JobApplicationController::class, 'show']);
    Route::put('/jobs/{id}', [JobApplicationController::class, 'update']);
    Route::delete('/jobs/{id}', [JobApplicationController::class, 'destroy']);
});
