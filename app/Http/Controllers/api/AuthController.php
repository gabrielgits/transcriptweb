<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

use Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request) {  
        try { 
            $validatedData = $request->validate([ 
                'name' => 'required|string', 
                'photo' => 'required|string', 
                'phone' => 'required|string|unique:students,phone', 
                'course_id' => 'required|integer', 
                'password' => 'required|string', 
            ]); 
        } catch (\Illuminate\Validation\ValidationException $e) { 
            \Log::error('Validation Error: ', $e->errors()); 
            return response()->json([ 
                'status' => false, 
                'message' => 'Validation error', 
                'errors' => $e->errors(), 
            ], 422); 
        }
        
    
        $student = Student::create($validatedData);
        $token = $student->createToken(env('TOKEN_APP'))->plainTextToken;
    
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

            // Check if the student exists in the 'students' table
    $student = Student::where('phone', $loginData['phone'])->first();

        // Validate the password
        //if (!$student || !Hash::check($loginData['password'], $student->password)) {
        if (!$student || $loginData['password'] != $student->password) {
            return response([
                'status' => false,
                'data' => null,
                'message' => 'Invalid credentials',
            ], 401);
        }
    
        $token = $student->createToken(env('TOKEN_APP'))->plainTextToken;
    
        return response([
            'status' => true,
            'message' => 'Logged in successfully!',
            'data' => [
                'student' => new StudentResource($student),
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
        return response([
            'status' => true,
            'message' => 'Logged out successfully',
            'data' => [],
        ]);
    }

    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'studentId' => 'required|integer',
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null,
            ]);
        }
    
        $student = Student::find($request->input('studentId'));
        if (!$student || $request->input('oldPassword') != $student->password) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid old password',
                'data' => null,
            ]);
        }
        $student->password = $request->input('newPassword');
        $student->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
            'data' => null,
        ]);
    }
    
}
