<?php

use App\Http\Controllers\JobWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

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

    Route::get('/dashboard', function () {
        return view('company.dashboard');
    })->name('company.dashboard');

    Route::get('/jobs', [JobWebController::class, 'showJobsList'])
        ->name('company.jobs.list');

    Route::get('/jobs/create', [JobWebController::class, 'showCreateJobForm'])
        ->name('company.job.create');

    Route::post('/company/jobs', [JobWebController::class, 'store'])->name('company.jobs.store');

});

/*
|--------------------------------------------------------------------------
| Candidate Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'candidate'])->prefix('candidate')->group(function () {

    Route::get('/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    // Future:
    // Route::get('/jobs', ...)
    // Route::get('/applications', ...)
});
