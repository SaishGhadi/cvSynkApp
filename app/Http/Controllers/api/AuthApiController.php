<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthApiController extends Controller
{

    /**
     * Candidate Registration API
     */
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

        return response()->json([
            'message' => 'Candidate registered successfully',
            'user' => $user
        ], 201);
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

        return response()->json([
            'message' => 'Company registered successfully',
            'user' => $user
        ], 201);
    }

    /**
     * Login API
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $user = Auth::user();

        // Generate token for API authentication
        $token = $user->createToken('api_token')->plainTextToken;

        // Returning dashboard route based on user role
        $redirectTo = $user->role === 'candidate'
            ? '/candidate/dashboard'
            : '/company/dashboard';

        
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
            'redirect_to' => $redirectTo
        ], 200);
    }

    public function logout(Request $request)
    {
        // Delete the token that was used for the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully (token revoked)'
        ], 200);
    }



}
