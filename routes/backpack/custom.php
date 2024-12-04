<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('/exam/send/{id}', 'ExamCrudController@sendExam');
    Route::crud('user', 'UserCrudController');
    Route::crud('course', 'CourseCrudController');
    Route::crud('student', 'StudentCrudController');
    Route::crud('classe', 'ClasseCrudController');
    Route::crud('attendance', 'AttendanceCrudController');
    Route::crud('exam', 'ExamCrudController');
    Route::crud('question', 'QuestionCrudController');
    Route::crud('answer', 'AnswerCrudController');
    Route::crud('test', 'TestCrudController');
    Route::crud('students-answer', 'StudentsAnswerCrudController');
    Route::crud('dailypoint', 'DailypointCrudController');
}); // this should be the absolute last line of this file