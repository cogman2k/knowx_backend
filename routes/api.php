<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FindBuddyController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\CommentPostController;
use App\Http\Controllers\CommentQuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ChatController;

Route::prefix('user')->group(function () { 
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('email/verify/success', [UserController::class, 'verified']);
    
    //get user by id
    Route::post('get-by-id', [UserController::class, 'getUserById']);
    
    //get newest posts    
    Route::get('posts/newest', [PostController::class, 'getNewestPost']);
    //get newest questions    
    Route::get('questions/newest', [QuestionController::class, 'getNewestQuestion']);

    // passport auth api
    Route::middleware(['auth:api'])->group(function () {
        // User resource route
        Route::get('/', [UserController::class, 'user']);
        Route::get('logout', [UserController::class, 'logout']);
        Route::post('follow', [UserController::class, 'followUser']);
        Route::post('change-password', [UserController::class, 'changePassword']);
        Route::post('search', [UserController::class, 'search']);
        Route::get('get-all', [UserController::class, 'getAllUsers']);
        Route::post('update', [UserController::class, 'updateProfile']);
        Route::get('/following', [UserController::class, 'getListFollowingUsers']);
        Route::get('/followers', [UserController::class, 'getListFollowers']);
        Route::post('/checkfollow', [UserController::class, 'checkFollow']);
        // Posts resource route
        Route::resource('posts', PostController::class);
        Route::post('posts/getbyuserid', [PostController::class, 'getPostByUserId']);
        Route::post('posts/bookmark', [PostController::class, 'bookmark']);
        Route::post('posts/getbookmark', [PostController::class, 'getBookmark']);
        Route::post('posts/checkbookmark', [PostController::class, 'checkBookmark']);
        Route::post('posts/like', [PostController::class, 'postLike']);
        Route::post('posts/checklike', [PostController::class, 'checkLike']);
        Route::post('posts/masterpost', [PostController::class, 'masterPost']);
        Route::post('posts/recomment', [PostController::class, 'getRecommentPost']);
        Route::post('posts/search', [PostController::class, 'search']);
        //questions resource route
        Route::resource('questions', QuestionController::class);
        Route::post('questions/getbyuserid', [QuestionController::class, 'getQuestionByUserId']);
        Route::post('questions/like', [QuestionController::class, 'questionLike']);
        Route::post('questions/checklike', [QuestionController::class, 'checkLike']);
        Route::post('questions/search', [QuestionController::class, 'search']);

        //Findbuddy resource route
        Route::post('buddy/create', [FindBuddyController::class, 'createFindBuddy']);
        Route::post('buddy/get', [FindBuddyController::class, 'getFindBuddy']);
        Route::get('buddy/getall', [FindBuddyController::class, 'getAllBuddy']);
        Route::get('buddy/myfindbuddy', [FindBuddyController::class, 'getMyFindBuddy']);
        Route::post('buddy/delete', [FindBuddyController::class, 'delete']);


        //Mentor resource route
        Route::post('mentor/create', [MentorController::class, 'createMentor']);
        Route::post('mentor/get', [MentorController::class, 'getMentorBySubject']);
        Route::get('mentor/getall', [MentorController::class, 'getAllMentor']);
        Route::get('mentor/mymentor', [MentorController::class, 'getListMyMentor']);
        Route::post('mentor/delete', [MentorController::class, 'delete']);

        //Create comment route
        Route::post('posts/comment/create', [CommentPostController::class, 'createComment']);
        Route::post('posts/comment/get', [CommentPostController::class, 'getListComment']);
        Route::post('posts/comment/delete', [CommentPostController::class, 'deleteComment']);
        Route::post('questions/comment/create', [CommentQuestionController::class, 'createComment']);
        Route::post('questions/comment/get', [CommentQuestionController::class, 'getListComment']);
        Route::post('questions/comment/delete', [CommentPostController::class, 'deleteComment']);

        //subject resource route
        Route::get('subject/get', [SubjectController::class, 'get']);

        //job resource routes
        Route::post('job/create', [JobController::class, 'create']);
        Route::get('job/newest', [JobController::class, 'getNewestJob']);
        Route::post('job/show', [JobController::class, 'show']);


        //messages resources routes
        Route::get('unseenmessage', [ChatController::class, 'getUnseenMessages']);
        Route::post('sendlink', [ChatController::class, 'sendLinkMeeting']);

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
