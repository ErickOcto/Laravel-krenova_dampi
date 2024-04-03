<?php

use App\Http\Controllers\Admin\FacilityCategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);
Route::get('/facility', [LandingController::class, 'facilities'])->name('landing-facility');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Authenticated - User After Login
Route::middleware(['auth','verified'])->group(function (){

    // Admin Dashboard

    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin-dashboard');

    // CRUD Admin Facility Category
    Route::resource('admin/category-facility', FacilityCategoryController::class);
    // CRUD Admin Facility
    Route::resource('admin/facility', FacilityController::class);
    // CRUD Project
    Route::resource('admin/project', ProjectController::class);
    // CRUD User
    Route::resource('admin/user', UserController::class);

    // Officer Dashboard
});


require __DIR__.'/auth.php';
