<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// AUTH
Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


// WITH AUTHENTICATION
Route::middleware(['auth.api'])->group(function() {
    // SCHOOL
    Route::prefix('/school')->group(function() {
        Route::post('/create', [SchoolController::class, 'store']);
    });

    // MEMBER
    Route::prefix('/member')->group(function() {
        Route::post('/create', [MemberControler::class, 'store']);
    });
});