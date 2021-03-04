<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccountController;

// Authentication
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refreshToken', [AuthController::class, 'refreshToken']);

// Application
Route::get('/application/ping', [ApplicationController::class, 'ping']);

Route::middleware('auth:api')->group(function ()
{
    // Users
    Route::get('/users', [UsersController::class, 'getManyUsers']);
    Route::get('/users/last-joined', [UsersController::class, 'getLastJoinedUsers']);
    Route::get('/users/{id}', [UsersController::class, 'getOneUser']);

    // Accounts
    Route::get('/accounts', [AccountController::class, 'getManyInvestments']);
    Route::get('/accounts/pending', [AccountController::class, 'getPendingInvestments']);
    Route::patch('/accounts/{id}/approve', [AccountController::class, 'approve']);
    Route::patch('/accounts/{id}/decline', [AccountController::class, 'decline']);
    Route::patch('/accounts/{id}/add-statement', [AccountController::class, 'addStatement']);
    Route::delete('/accounts/delete-statement/{id}', [AccountController::class, 'deleteStatement']);
});
