<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



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



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid login credentials']);
        }

        $user = Auth::user();

        // Redirect based on role
        if ($user->role === 'candidate') {
            return redirect()->route('candidate.dashboard');
        } else {
            return redirect()->route('company.dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }





}
