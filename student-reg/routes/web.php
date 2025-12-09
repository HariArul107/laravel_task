<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LocationController;

//student registration form route
Route::get('/', [StudentController::class, 'viewform']);
Route::post('/submit-form', [StudentController::class, 'submitform']);
//submit form route
Route::get('/form', [StudentController::class, 'form']);
Route::post('/show', [StudentController::class, 'showform']);
// ASCII Table Routes
Route::get('/ascii', [StudentController::class, 'asciiform']);
Route::post('/asciiprocess', [StudentController::class, 'asciiprocess']);

// multiplication table route
Route::get('/multi', [StudentController::class, 'multiform']);
Route::post('/multiprocess', [StudentController::class, 'multiprocess']);

// image slider route
Route::get('/image', [StudentController::class, 'slider']);

// number to word route
Route::get('/number', [StudentController::class, 'numberform']);
Route::post('/numwordprocess', [StudentController::class, 'numberprocess']);

// age calculator route
Route::get('/age', [StudentController::class, 'ageform']);
Route::post('/ageprocess', [StudentController::class, 'ageprocess']);

// word game route
Route::get('/word', [StudentController::class, 'wordform']);
Route::post('/wordprocess', [StudentController::class, 'wordprocess']);

// email with OTP route
Route::get('/email', [StudentController::class, 'emailform']);
Route::post('/send', [StudentController::class, 'sendotp']);
Route::post('/verify-otp', [StudentController::class, 'verifyOtp']);

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/get-states', [LocationController::class, 'getStates'])->name('locations.getStates');
Route::get('/get-cities', [LocationController::class, 'getCities'])->name('locations.getCities');

?>
