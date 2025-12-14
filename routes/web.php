<?php

use App\Http\Controllers\JobWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\candidateWebController;
use App\Http\Controllers\CompanyApplicationController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication (Web)
|--------------------------------------------------------------------------
*/

// Registration pages
Route::get('/', function () {
    return view('welcome');
});
Route::get('/register/candidate', [authController::class, 'showCanRegisterForm'])->name('candidateRegister');
Route::get('/register/company', [authController::class, 'showComRegisterForm'])->name('companyRegister'); // Handle web registration 
Route::post('/register/company', [authController::class, 'storeCompany'])->name('web.register.company');
Route::post('/register/candidate', [authController::class, 'storeCandidate'])->name('web.register.candidate');
Route::get('/login', [authController::class, 'showLoginForm'])->name('login'); // route which redirects to a view after login after api call 
Route::post('/login', [authController::class, 'login'])->name('login.web');
Route::post('/logout', [authController::class, 'logout'])->name('logout.web');

/*
|--------------------------------------------------------------------------
| Company Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'company'])->prefix('company')->group(function () {

    Route::get('/dashboard', fn() => view('company.dashboard'))
        ->name('company.dashboard');

    Route::get('/jobs', [JobWebController::class, 'index'])
        ->name('company.jobs.list');
    // redirect to job creation form
    Route::get('/company/jobs/', [JobWebController::class, 'showCreateJobForm'])
        ->name('company.jobs.showForm');

    // to store new job store func()
    Route::post('/jobs', [JobWebController::class, 'store'])
        ->name('company.jobs.store');

    Route::get('/jobs/{uuid}', [JobWebController::class, 'show'])
        ->name('company.jobs.show');

    Route::delete('/jobs/{uuid}', [JobWebController::class, 'destroy'])
        ->name('company.jobs.delete');

    Route::put('/jobs/{uuid}', [JobWebController::class, 'update'])
        ->name('company.jobs.update');


    // Application Secxtion

    // List company jobs with application count
    Route::get('/applications', [CompanyApplicationController::class, 'jobs'])
        ->name('company.applications.jobs');

    // List applications for a specific job
    Route::get('/applications/{jobUuid}', [CompanyApplicationController::class, 'applications'])
        ->name('company.applications.list');

    // Accept / Reject
    Route::post('/applications/{applicationUuid}/accept', [CompanyApplicationController::class, 'accept'])
        ->name('company.application.accept');

    Route::post('/applications/{applicationUuid}/reject', [CompanyApplicationController::class, 'reject'])
        ->name('company.application.reject');

    
});

/*
|--------------------------------------------------------------------------
| Candidate Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'candidate'])->prefix('candidate')->group(function () {

    Route::get('/dashboard', [candidateWebController::class, 'load'])->name('candidate.dashboard');




    Route::post('/jobs/{uuid}/apply', [candidateWebController::class, 'apply'])
        ->name('candidate.jobs.apply');

    Route::get('/my-applications', [candidateWebController::class, 'index'])
        ->name('candidate.applied.jobs');

    Route::delete('/my-applications/{uuid}', [candidateWebController::class, 'destroy'])
        ->name('candidate.application.revoke');

});
