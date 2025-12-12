<?php

namespace App\Http\Controllers;

use App\Models\User;



use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{


    public function storeCandidate(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8',],
            'c_password' => ['required', 'same:password'],
            'role' => ['required', 'in:company,candidate'],
            'skills' => ['required_if:role,candidate', 'JSON', 'max:500'],
            //address not required for company so set to null
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $request['address'] = null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function storeCompany(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8',],
            'c_password' => ['required', 'same:password'],
            'role' => ['required', 'in:company,candidate'],
            'address' => ['required_if:role,company', 'string', 'max:500'],
            //skills not required for company so set to null
            'skills' => ['nullable', 'JSON', 'max:500'],

        ]);

        $request['skills'] = null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }





}
