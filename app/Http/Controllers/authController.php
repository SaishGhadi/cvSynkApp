<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;


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



    public function storeCandidate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'skills' => ['required', 'array'],   // candidate needs skills
        ]);

        $user = User::create([
            'uuid' => \Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'candidate',
            'address' => null,                // candidate has no address
            'skills' => $request->skills,    // stored as JSON via cast
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Company registered successfully');

    }


    /**
     * Company Registration API
     */
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'address' => ['required', 'string', 'max:500'], // company needs address
        ]);

        $user = User::create([
            'uuid' => \Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'company',
            'address' => $request->address,
            'skills' => null,                   // company has no skills
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Candidate registered successfully');

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
        return view('welcome');
    }





}
