<?php

use App\Http\Controllers\CompanyApplicationApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\JobApiController;
use App\Http\Controllers\api\candidateApiController;

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
    Route::get('/company/jobs/all', [JobApiController::class, 'index']);

    // GET jobs/{uuid} – job details
    Route::get('/company/jobs/{uuid}', [JobApiController::class, 'show']);

    //update job 
    Route::put('/company/jobs/{uuid}', [JobApiController::class, ' update']);

    // delete job 
    Route::delete('/company/jobs/{uuid}', [JobApiController::class, 'destroy']);




    /// Company Application APIs (Module 3)
    Route::get('/jobs', [CompanyApplicationApiController::class, 'jobs']);
    Route::get('/jobs/{uuid}/applications', [CompanyApplicationApiController::class, 'applications']);

    Route::post('/applications/{uuid}/accept', [CompanyApplicationApiController::class, 'accept']);
    Route::post('/applications/{uuid}/reject', [CompanyApplicationApiController::class, 'reject']);
});

Route::middleware(['auth:sanctum', 'candidate'])->group(function () {

    // Apply for a job
    Route::post('/jobs/{uuid}/apply', [candidateApiController::class, 'apply']);

    // Get my applications
    Route::get('/my-applications', [candidateApiController::class, 'index']);

    // Revoke application
    Route::delete('/my-applications/{uuid}', [candidateApiController::class, 'destroy']);

});
