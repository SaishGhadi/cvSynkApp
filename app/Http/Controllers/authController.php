<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function showCanRegisterForm()
    {
        return view('auth.candidateRegister');
    }

    public function showComRegisterForm()
    {
        return view('auth.companyRegister');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    


}
