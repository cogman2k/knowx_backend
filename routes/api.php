<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group(function () { 
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('email/verify/success', [UserController::class, 'verified']);

    Route::post('forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('reset-password', [UserController::class, 'reset']);

    // passport auth api
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/', [UserController::class, 'user']);
        Route::get('logout', [UserController::class, 'logout']);

        // Posts resource route
        Route::resource('posts', PostController::class);
        Route::resource('questions', QuestionController::class);
    });

});




// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend link to verify email
Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');