<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;


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

Route::get('/job-order/{id}/parts', [JobOrderPartController::class, 'create']);
Route::post('/job-order/parts/store', [JobOrderPartController::class, 'store']);

Route::post('/job-order/store', [JobOrderController::class, 'store'])
    ->name('job-order.store');

Route::get('/serviceshistory', function () {
    return view('serviceshistory');
})->name('serviceshistory');

Route::get('/userdash', function () {
    return view('userdash');
})->name('userdash');

Route::get('/addcustomer', function () {
    return view('addcustomer');
})->name('addcustomer');

Route::get('/usermygarage', [VehicleController::class, 'index'])
    ->name('usermygarage');

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
Route::post('/vehicles/update/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::post('/vehicles/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicles.delete');

Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');