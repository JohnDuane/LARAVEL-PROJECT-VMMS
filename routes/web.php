<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\JobOrderPartController;



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

Route::get('/addservices', [ServiceController::class, 'index']);


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

Route::get('/addmechanic', function () {
    return view('addmechanic');
})->name('addemchanic');

Route::get('/addcustomer', [CustomerController::class, 'index'])
    ->name('addcustomer');

Route::get('/usermygarage', [VehicleController::class, 'index'])
    ->name('usermygarage');

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
Route::post('/vehicles/update/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::post('/vehicles/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicles.delete');

Route::get('/addmechanic', [StaffController::class, 'index'])->name('addmechanic.index');
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::post('/staff/update', [StaffController::class, 'update'])->name('staff.update');
Route::post('/staff/delete', [StaffController::class, 'delete'])->name('staff.delete');

Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/customer/delete', [CustomerController::class, 'delete'])->name('customer.delete');

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/services/store', [ServiceController::class, 'store']);
Route::post('/services/update/{id}', [ServiceController::class, 'update']);
Route::post('/services/delete/{id}', [ServiceController::class, 'destroy']);

Route::get('/job-order/pdf/{id}', [JobOrderController::class, 'generatePDF'])
    ->name('job-order.pdf');

Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');