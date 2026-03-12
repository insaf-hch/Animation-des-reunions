<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ParticipantController;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
  Route::get('/calendar', [MeetingController::class,'calendar'])->name('calendar');
  Route::resource('meetings', MeetingController::class);
  Route::get('/meetings/{meeting}/room', [MeetingController::class,'room'])->name('meetings.room');
  Route::patch('/meetings/{meeting}/end', [MeetingController::class,'end'])->name('meetings.end');
  Route::resource('tasks', TaskController::class)->only(['index','update']);
  Route::get('/report', [ReportController::class,'index'])->name('report.index');
  Route::get('/report/{meeting}', [ReportController::class,'show'])->name('report.show');
  Route::get('/report/{meeting}/pdf', [ReportController::class,'pdf'])->name('report.pdf');
  Route::get('/stats', [StatsController::class,'index'])->name('stats.index');
  Route::get('/participants', [ParticipantController::class,'index'])->name('participants.index');

  // Profile/settings routes (added to make the Settings dropdown work)
  Route::get('/profile', [\App\Http\Controllers\ProfileController::class,'edit'])->name('profile.edit');
  Route::patch('/profile', [\App\Http\Controllers\ProfileController::class,'update'])->name('profile.update');
  Route::delete('/profile', [\App\Http\Controllers\ProfileController::class,'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
