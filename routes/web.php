<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
})->name('home');
Route::get('/privacy-policy', function () {
    return view('landing.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-conditions', function () {
    return view('landing.terms-conditions');
})->name('terms-conditions');

Route::get('/delete', function () {
    return view('landing.delete');
})->name('delete');

Route::get('/attendance/change-status/{id}/{status}', [AttendanceController::class, 'changeStatus'])->name('attendance.changeStatus');


