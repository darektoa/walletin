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
        
        Route::middleware(['school.api'])->group(function() {
            Route::get('/members', [SchoolMemberController::class, 'index']);
            Route::get('/merchants', [SchoolMerchantController::class, 'index']);
            Route::get('/transactions', [SchoolTransactionController::class, 'index']); 
        });
    });

    // MEMBER
    Route::prefix('/member')->group(function() {
        Route::post('/join', [MemberControler::class, 'store']);

        Route::middleware(['member.api'])->group(function() {
            Route::post('/topup', [TransactionController::class, 'topup']);
        });
    });

    // MERCHANT
    Route::prefix('/merchant')->group(function() {
        Route::post('/create', [MerchantController::class, 'store']);
    });

    // PROFILE
    Route::prefix('/profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index']);
    });
});