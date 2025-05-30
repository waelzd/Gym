<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');  

Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
Route::post('/add-subscriber', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::post('/update-subscriber/{id}', [SubscriberController::class, 'update'])->name('subscribers.update');
Route::delete('/delete-subscriber/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

Route::get('/reports', [ReportsController::class, 'showChart'])->name('subscribers.chart');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::post('/update-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('password.change');



