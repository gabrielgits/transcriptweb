<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CourseController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('startprofile', [AuthController::class, 'updateInicial']);
Route::get('show/{id}', [AuthController::class, 'show']);


Route::apiResource('users', UserController::class)->only([
    'index', 'store',
]);
Route::apiResource('tests', TestController::class);
Route::apiResource('studentsanswers', StudentsAnswerController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('exams', ExamController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('classes', ClasseController::class);
Route::apiResource('attendandes', AttendanceController::class);
Route::apiResource('answers', AnswerController::class);
