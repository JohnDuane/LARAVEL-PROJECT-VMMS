<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOrderController;


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

Route::get('/joborderform', [JobOrderController::class, 'create']);

Route::post('/job-order/store', [JobOrderController::class, 'store'])
    ->name('job-order.store');

Route::get('/serviceshistory', function () {
    return view('serviceshistory');
})->name('serviceshistory');

Route::get('/userdash', function () {
    return view('userdash');
})->name('userdash');

Route::get('/usermygarage', function () {
    return view('usermygarage');
})->name('usermygarage');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');