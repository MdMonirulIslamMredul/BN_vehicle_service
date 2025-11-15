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
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\RoleMiddleware;

// Public
Route::get('/', function () {
    return view('index');
});

// Auth routes
Auth::routes();

// Common home route
Route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
// Appointment booking routes
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');


// -------------------- ADMIN ROUTES --------------------
Route::middleware(['auth', RoleMiddleware::class.':admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class,'index'])->name('dashboard');
        Route::get('users', [AdminController::class,'users'])->name('users');
        Route::get('vehicles', [AdminController::class,'vehicles'])->name('vehicles');


        Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
        Route::post('/appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.status');



        Route::get('service-requests', [AdminController::class,'serviceRequests'])->name('service_requests');
        Route::post('service-requests/{id}/assign', [AdminController::class,'assignDriver'])->name('assign_driver');

});



// -------------------- OWNER ROUTES --------------------
Route::middleware(['auth',RoleMiddleware::class.':owner'])
    ->prefix('owner')->name('owner.')->group(function() {
    Route::get('dashboard', [OwnerController::class,'index'])->name('dashboard');

});



// -------------------- DRIVER ROUTES --------------------
Route::middleware(['auth',RoleMiddleware::class.':driver'])
    ->prefix('driver')->name('driver.')->group(function() {
    Route::get('dashboard', [DriverController::class,'index'])->name('dashboard');

});



// -------------------- AUTHENTICATED USER ROUTES --------------------
Route::middleware(['auth'])->group(function() {
    Route::resource('vehicles', VehicleController::class);
    Route::resource('service-requests', ServiceRequestController::class);


    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    // Password change routes
    Route::get('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePasswordForm'])->name('profile.change_password');
    Route::post('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update_password');


});


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
