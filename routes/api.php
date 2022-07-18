<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\MeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\Designs\UploadController;
use App\Http\Controllers\Designs\DesignController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Designs\CommentController;

// public routes
Route::get('me', [MeController::class, 'getMe']);

// designs
Route::get('designs', [DesignController::class, 'index']);
Route::get('designs/{id}', [DesignController::class, 'findDesign']);

//users
Route::get('users', [UserController::class, 'index']);

// route for users
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', [LoginController::class, 'logout']);

    Route::put('settings/profile', [SettingController::class, 'updateProfile']);
    Route::put('settings/password', [SettingController::class, 'updatePassword']);

    Route::post('designs', [UploadController::class, 'upload']);
    Route::put('designs/{id}', [DesignController::class, 'update']);
    Route::delete('designs/{id}', [DesignController::class, 'destroy']);

    // Comments
    Route::post('designs/{id}/comments', [CommentController::class, 'store']);
    Route::put('comments/{id}', [CommentController::class, 'update']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);
});


// route for guests
Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('verification/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('verification/resend', [VerificationController::class, 'resend']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('login', [LoginController::class, 'login']);

  

});
