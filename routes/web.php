<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    VehicleController,
    ServiceRequestController,
    AdminController,
    OwnerController,
    DriverController
};

// Public
Route::get('/', function () {
    return view('index');
});

// Auth routes
Auth::routes();

// Common home route
Route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');

// -------------------- OWNER ROUTES --------------------
// Route::middleware(['auth','role:owner'])->prefix('owner')->name('owner.')->group(function() {
//     Route::get('dashboard', [OwnerController::class,'dashboard'])->name('dashboard');
//     Route::resource('vehicles', VehicleController::class);
//     Route::resource('service-requests', ServiceRequestController::class);
// });

// // -------------------- DRIVER ROUTES --------------------
// Route::middleware(['auth','role:driver'])->prefix('driver')->name('driver.')->group(function() {
//     Route::get('dashboard', [DriverController::class,'dashboard'])->name('dashboard');
//     Route::resource('service-requests', ServiceRequestController::class);
// });

// -------------------- ADMIN ROUTES --------------------
// Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function() {
//     Route::get('dashboard', [AdminController::class,'index'])->name('dashboard');
//     Route::get('users', [AdminController::class,'users'])->name('users');
//     Route::get('vehicles', [AdminController::class,'vehicles'])->name('vehicles');
//     Route::get('service-requests', [AdminController::class,'serviceRequests'])->name('service_requests');
//     Route::post('service-requests/{id}/assign', [AdminController::class,'assignDriver'])->name('assign_driver');
// });

use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class.':admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class,'index'])->name('dashboard');
         Route::get('users', [AdminController::class,'users'])->name('users');
        Route::get('vehicles', [AdminController::class,'vehicles'])->name('vehicles');
        Route::get('service-requests', [AdminController::class,'serviceRequests'])->name('service_requests');
        Route::post('service-requests/{id}/assign', [AdminController::class,'assignDriver'])->name('assign_driver');

});


Route::middleware(['auth',RoleMiddleware::class.':owner'])
    ->prefix('owner')->name('owner.')->group(function() {
    Route::get('dashboard', [OwnerController::class,'index'])->name('dashboard');

});

// -------------------- DRIVER ROUTES --------------------
Route::middleware(['auth',RoleMiddleware::class.':driver'])->prefix('driver')->name('driver.')->group(function() {
    Route::get('dashboard', [DriverController::class,'index'])->name('dashboard');

});


Route::middleware(['auth'])->group(function() {
    Route::resource('vehicles', VehicleController::class);
    Route::resource('service-requests', ServiceRequestController::class);
});

