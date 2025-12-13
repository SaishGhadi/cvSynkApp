<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\JobApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register/company/user', [AuthApiController::class, 'storeCompany'])->name('company.Register');
Route::post('/register/candidate/user', [AuthApiController::class, 'storeCandidate'])->name('candidate.Register');

// Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');

Route::post('/login', [AuthApiController::class, 'login']);


Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);


Route::middleware(['auth:sanctum', 'company'])->group(function () {
    // Company job APIs (Module 2)
    //to craete New job
    Route::post('/company/jobs', [JobApiController::class, 'store']);
    //to get jobs list
    Route::get('/company/jobs/all', [JobApiController::class, 'retreveJobs']);

    // GET jobs/{uuid} – job details
    Route::get('/company/jobs/{uuid}', [JobApiController::class, 'retreveJobInfo']);

    //update job 
    Route::put('/company/jobs/{uuid}', [JobApiController::class, 'updateJobs']);

    // delete job 
    Route::delete('/company/jobs/{uuid}', [JobApiController::class, 'deleteJob']);

});

Route::middleware(['auth:sanctum', 'candidate'])->group(function () {
    // Candidate APIs (Module 3)
});
