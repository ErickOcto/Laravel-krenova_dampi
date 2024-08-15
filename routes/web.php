<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FacilityCategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\PovertyController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
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

Route::get('/search', [LandingController::class, 'search'])->name('landing-search');

Route::get('/facility', [LandingController::class, 'facilities'])->name('landing-facility');

Route::get('/tps', [LandingController::class, 'tps'])->name('landing-tps');

Route::get('/rank', [LandingController::class, 'rank'])->name('landing-rank');

Route::get('/project', [LandingController::class, 'projects'])->name('landing-projects');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Authenticated - User After Login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/redirect', [RedirectController::class, 'redirectAfterLogin']);

    // Admin Dashboard
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin-dashboard');

    // CRUD Admin Facility Category
    Route::resource('admin/category-facility', FacilityCategoryController::class);
    // CRUD Admin Facility
    Route::resource('admin/facility', FacilityController::class);
    // CRUD Project
    Route::resource('admin/project', ProjectController::class);
    Route::put('admin/project/updateStatus/{id}', [ProjectController::class, 'updateStatus'])->name('updateStatusProject');
    // CRUD User
    Route::resource('admin/user', UserController::class);
    //CRUD Company
    Route::resource('admin/company', CompanyController::class);
    //CRUD Reward
    Route::get('admin/rewardCategory', [RewardController::class, 'rewardCategory'])->name('rewardCategory.index');
    Route::post('admin/rewardCategory/add', [RewardController::class, 'addRewardCategory'])->name('rewardCategory.create');
    Route::delete('admin/rewardCategory/delete/{id}', [RewardController::class, 'deleteRewardCategory'])->name('rewardCategory.delete');

    //CRUD Reward Category
    Route::get('admin/award', [RewardController::class, 'reward'])->name('reward.index');
    Route::get('admin/award/detail/{id}', [RewardController::class, 'rewardDetail'])->name('reward.show');
    Route::post('admin/award/add', [RewardController::class, 'addReward'])->name('reward.create');
    Route::delete('admin/award/delete/{id}', [RewardController::class, 'deletereward'])->name('reward.delete');



    Route::middleware(['auth', 'admin'])->group(function () {
        // Dashboard Poverty(kemiskinan)
        Route::get('admin/poverty', [AdminDashboardController::class, 'povertyDashboard'])->name('poverty-dashboard');

        //CRUD Poverty
        Route::resource('admin/management/poverty', PovertyController::class);
    });

    // Officer Dashboard
});

// Route Admin Poverty


require __DIR__ . '/auth.php';
