<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register/candidate', [authController::class, 'showCanRegisterForm'])->name('candidateRegister');
Route::get('/register/company', [authController::class, 'showComRegisterForm'])->name('companyRegister');



Route::get('/login', [authController::class, 'showLoginForm'])->name('login');

// route which redirects to a view after login after api call 
Route::post('/login', [authController::class, 'login'])->name('login.web');

Route::post('/logout', [authController::class, 'logout'])->name('logout.web');


Route::middleware('auth')->group(function () {
    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    Route::get('/company/dashboard', function () {
        return view('company.dashboard');
    })->name('company.dashboard');
});