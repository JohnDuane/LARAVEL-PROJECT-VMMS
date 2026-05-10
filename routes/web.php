<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\JobOrderPartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerVehicleController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/', function () {
    return view('index');
});


Route::get('/addservices', [ServiceController::class, 'index']);

Route::post('/parts/stockin/{id}', [PartsController::class, 'stockIn']);

Route::get('/joborderform', [JobOrderController::class, 'create']);

Route::post('/stock-adjust/{id}', [PartsController::class, 'adjustStock']);

Route::get('/job-order/{id}/parts', [JobOrderPartController::class, 'create']);
Route::post('/job-order/parts/store', [JobOrderPartController::class, 'store']);

Route::post('/job-order/store', [JobOrderController::class, 'store'])
    ->name('job-order.store');

Route::get('/userdash', [DashboardController::class, 'index'])->name('userdash');

Route::post('/vehicles/store', [VehicleController::class, 'store']);

Route::get('/job-orders', [JobOrderController::class, 'index']);

Route::get('/customer-vehicles', [CustomerVehicleController::class, 'index']);

Route::get('/serviceshistory', [JobOrderController::class, 'servicesHistory'])
    ->name('serviceshistory');

Route::get('/addmechanic', function () {
    return view('addmechanic');
})->name('addemchanic');

Route::get('/reminders/by-job/{id}', function ($id) {
    return \App\Models\Reminder::where('job_order_id', $id)->get();
});

Route::get('/stockin', [PartsController::class, 'index'])
    ->name('stockin');

Route::get('/viewcustomervehicles', [CustomerVehicleController::class, 'index']);

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

Route::get('/reminders', [ReminderController::class, 'index']);
Route::post('/reminders/store', [ReminderController::class, 'store']);
Route::get('/reminders/complete/{id}', [ReminderController::class, 'complete']);

Route::get('/stockin', [PartsController::class, 'index'])->name('stockin');
Route::post('/stockin/store', [PartsController::class, 'store']);
Route::post('/stockin/update/{id}', [PartsController::class, 'update']);
Route::post('/stockin/delete/{id}', [PartsController::class, 'delete']);

Route::get('/addsupplier', [SupplierController::class, 'index']);
Route::post('/suppliers/store', [SupplierController::class, 'store']);
Route::post('/suppliers/update/{id}', [SupplierController::class, 'update']);
Route::post('/suppliers/delete/{id}', [SupplierController::class, 'delete']);

Route::get('/job-order/pdf/{id}', [JobOrderController::class, 'generatePDF'])
    ->name('job-order.pdf');

Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

require __DIR__.'/auth.php';


