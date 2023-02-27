<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
// Verify email using the link sent after registration
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('verification.verify');









Route::group(['middleware' => ['auth:sanctum']], function () {
    // Resend link to verify email
    Route::post('/email/verify/resend', [VerifyEmailController::class, 'resendVerificationEmail'])
        ->name('verification.send');

    Route::get('/has_verified_email', [VerifyEmailController::class, 'hasVerifiedEmail']);
});


