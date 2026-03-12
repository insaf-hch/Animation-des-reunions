<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('login', [AuthenticatedSessionController::class,'create'])->name('login');
  Route::post('login', [AuthenticatedSessionController::class,'store']);
  Route::get('register', [RegisteredUserController::class,'create'])->name('register');
  Route::post('register', [RegisteredUserController::class,'store']);
});
Route::middleware('auth')->group(function () {
  Route::post('logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');
  Route::put('password', [PasswordController::class,'update'])->name('password.update');
  Route::post('email/verification-notification', [EmailVerificationNotificationController::class,'store'])->name('verification.send');
});
