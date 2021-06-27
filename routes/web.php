<?php

use App\Http\Controllers\DailyLogController;
use App\Http\Middleware\BlockNameJaneDoe;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function() {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::view('/tailwind', 'tailwind')->name('tailwind');

    Route::post('daily-logs', [DailyLogController::class, 'store'])->middleware('block.access')->name('daily-logs.store');
    Route::put('daily-logs/{dailylog}', [DailyLogController::class, 'update'])->name('daily-logs.update');
    Route::post('daily-logs/{dailylog}', [DailyLogController::class, 'destroy'])->name('daily-logs.delete');
});



