<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register/candidate', [authController::class, 'showCanRegisterForm'])->name('candidateRegister');
Route::get('/register/company', [authController::class, 'showComRegisterForm'])->name('companyRegister');



Route::get('/login', [authController::class, 'showLoginForm'])->name('login');
