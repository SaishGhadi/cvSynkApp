<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register/company/user', [AuthApiController::class, 'storeCompany'])->name('company.Register');
Route::post('/register/candidate/user', [AuthApiController::class, 'storeCandidate'])->name('candidate.Register');

Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);
