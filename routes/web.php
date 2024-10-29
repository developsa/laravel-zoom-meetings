<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ZoomController;
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

Route::get("/", [LoginController::class, "index"])->name("login.index");
Route::post("login", [LoginController::class, "login"])->name("login.store");
Route::get("register", [RegisterController::class, "index"])->name("register.index");
Route::post("register", [RegisterController::class, "store"])->name("register.store");
Route::get("logout", [LoginController::class, "logout"])->name("logout");
Route::get("forgot-password", [ForgotPasswordController::class, "forgotPassword"])->name("forgot.password");
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotStore'])->name('forgot.store');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset.store');
Route::group(['middleware' => 'auth', 'prefix' => 'account'], function () {
    Route::get("dashboard", [DashController::class, "index"])->name("dashboard");
    Route::resource('zooms', ZoomController::class);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('all-notifications', [NotificationController::class, 'all'])->name('notifications.all');
    Route::post('zooms/{id}', [NotificationController::class, 'markRead'])->name('notifications.markAsRead');
});
