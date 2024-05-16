<?php

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'API Gateway'
    ]);
});

// Login
Route::post('login', [AuthController::class, 'login'])->name('login');

// Authenticated Routes
Route::group([ 'middleware' => [ 'auth:sanctum' ] ], function() {
    Route::get('user-profile', [ AuthController::class, 'userProfile' ]);
    Route::post('logout', [ AuthController::class, 'logout' ]);

    Route::apiResource('users', UserController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
});
