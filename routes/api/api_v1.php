<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
//use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\ClasseController;
use App\Http\Controllers\api\TestController;
use App\Http\Controllers\api\StudentsAnswerController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\api\QuestionController;
use App\Http\Controllers\api\AnswerController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\DailypointController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->get('profile', [AuthController::class, 'profile']); 
Route::middleware('auth:sanctum')->delete('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->put('updatepassword', [AuthController::class, 'updatePassword']);



Route::middleware('auth:sanctum')->group(function () {

    // API Resources
    Route::apiResource('testes', TestController::class);
    Route::apiResource('studentsanswers', StudentsAnswerController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('exams', ExamController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('classes', ClasseController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('answers', AnswerController::class);

    // API Custom Routes
    Route::get('attendances/student/{id}', [AttendanceController::class, 'student']);
    Route::get('attendances/student/{id}/all', [AttendanceController::class, 'studentAll']);

    Route::get('dailypoints/student/{id}', [DailypointController::class, 'student']);
    Route::get('dailypoints/student/{id}/all', [DailypointController::class, 'studentAll']);

    Route::get('testes/student/{id}', [TestController::class, 'student']);
    Route::get('testes/student/{id}/limit/{limit}', [TestController::class, 'studentLimit']);

    Route::get('students/{id}/score', [StudentController::class, 'finalScore']);

    Route::get('questions/exam/{id}', [QuestionController::class, 'questions']);
});