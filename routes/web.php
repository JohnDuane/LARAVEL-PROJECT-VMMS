<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::post('/login', [AuthController::class, 'login']);

Route::get('/userdash', function () {
    return view('userdash');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');