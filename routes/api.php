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
use App\Http\Controllers\Teams\TeamController;
use App\Http\Controllers\Teams\InvitationController;

// public routes
Route::get('me', [MeController::class, 'getMe']);

// designs
Route::get('designs', [DesignController::class, 'index']);
Route::get('designs/{id}', [DesignController::class, 'findDesign']);

//users
Route::get('users', [UserController::class, 'index']);

// Team
Route::get('teams/slug/{slug}', [TeamController::class, 'findBySlug']);

// route for users
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', [LoginController::class, 'logout']);

    Route::put('settings/profile', [SettingController::class, 'updateProfile']);
    Route::put('settings/password', [SettingController::class, 'updatePassword']);

    Route::post('designs', [UploadController::class, 'upload']);
    Route::put('designs/{id}', [DesignController::class, 'update']);
    Route::delete('designs/{id}', [DesignController::class, 'destroy']);

    // Likes and Unlikes
    Route::post('designs/{id}/like', [DesignController::class, 'like']);
    Route::get('designs/{id}/liked', [DesignController::class, 'checkIfUserHasLiked']);

    // Comments
    Route::post('designs/{id}/comments', [CommentController::class, 'store']);
    Route::put('comments/{id}', [CommentController::class, 'update']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);

    // Teams
    Route::post('teams', [TeamController::class, 'store']);
    Route::get('teams/{id}', [TeamController::class, 'findById']);
    Route::get('teams', [TeamController::class, 'index']);
    Route::get('users/teams', [TeamController::class, 'fetchUserTeams']);
    Route::put('teams/{id}', [TeamController::class, 'update']);
    Route::delete('teams/{id}', [TeamController::class, 'destroy']);
    Route::delete('teams/{team_id}/users/{user_id}', [TeamController::class, 'removeFromTeam']);


    // Invitations
    Route::post('invitations/{teamId}', [InvitationController::class, 'invite']);
    Route::post('invitations/{id}/resend', [InvitationController::class, 'resend']);
    Route::post('invitations/{id}/respond', [InvitationController::class, 'respond']);
    Route::delete('invitations/{id}', [InvitationController::class, 'destroy']);
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
