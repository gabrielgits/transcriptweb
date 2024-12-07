<?php

use Illuminate\Support\Facades\Route;

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
});
Route::get('/privacy-policy', function () {
    return view('landing.privacy-policy');
});

Route::get('/terms-conditions', function () {
    return view('landing.terms-conditions');
});


