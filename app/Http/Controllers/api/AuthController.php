<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:student,phone',
            'course_id' => 'required|integer',
            'password' => 'required|confirmed',
        ]);
    
        $student = Student::create($validatedData);
        $token = $student->createToken(env('luziadaToken'))->plainTextToken;
    
        return response([
            'status' => true,
            'message' => 'Registered successfully!',
            'data' => [
                'student' => $student,
                'token' => $token,
            ]
        ], 201);
    }
    
    public function login(Request $request) {
        $loginData = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($loginData)) {
            return response([
                'status' => false,
                'data' => null,
                'message' => 'Invalid credentials',
            ], 401);
        }
    
        $student = $request->user();
        $token = $student->createToken('myapptoken')->plainTextToken;
    
        return response([
            'status' => true,
            'message' => 'Logged in successfully!',
            'data' => [
                'student' => $student,
                'token' => $token,
            ]
        ], 200);
    }
    
    public function profile() {
        return response([
            'status' => true,
            'message' => 'Successfully!',
            'data' => Auth::user(),
        ]);
    }
    
    public function logout() {
        Auth::user()->tokens()->delete();
        return response(['message' => 'Logged out successfully']);
    }
    
}
