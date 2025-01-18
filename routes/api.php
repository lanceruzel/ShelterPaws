<?php

use App\Http\Controllers\AdoptionApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



// Route::apiResource('pet', PetController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('pet', [PetController::class, 'index']);
    Route::post('pet', [PetController::class, 'store']); 
    Route::put('pet/{pet}', [PetController::class, 'update']); 
    Route::delete('pet/{pet}', [PetController::class, 'destroy']); 
});

Route::get('/pet/all', [PetController::class, 'all']);
Route::get('pet/{pet}', [PetController::class, 'show']);

Route::apiResource('application', AdoptionApplicationController::class)->middleware('auth:sanctum');

Route::put('/user/profile', [UserProfileController::class, 'update'])->middleware('auth:sanctum');

//Shelter
Route::get('shelter', [ShelterController::class, 'index']);