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
use App\Http\Controllers\FileController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\RoadmapController;

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
        Route::get('following', [UserController::class, 'getListFollowingUsers']);
        Route::get('followers', [UserController::class, 'getListFollowers']);
        Route::post('checkfollow', [UserController::class, 'checkFollow']);
        Route::get('education/{id}', [UserController::class, 'getEducation']);
        Route::post('education', [UserController::class, 'addEducation']);
        Route::delete('education/{id}', [UserController::class, 'removeEducation']);
        Route::get('experience/{id}', [UserController::class, 'getExperience']);
        Route::post('experience', [UserController::class, 'addExperience']);
        Route::delete('experience/{id}', [UserController::class, 'removeExperience']);
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
        Route::post('posts/report', [PostController::class, 'report']);
        Route::delete('posts/report/{id}', [PostController::class, 'deleteReport']);
        Route::get('posts/reports/get', [PostController::class, 'getReports']);
        Route::get('posts/report/count', [PostController::class, 'countReports']);
        //questions resource route
        Route::resource('questions', QuestionController::class);
        Route::post('questions/getbyuserid', [QuestionController::class, 'getQuestionByUserId']);
        Route::post('questions/getbysubject', [QuestionController::class, 'getQuestionBySubject']);
        Route::post('questions/like', [QuestionController::class, 'questionLike']);
        Route::post('questions/checklike', [QuestionController::class, 'checkLike']);
        Route::post('questions/search', [QuestionController::class, 'search']);
        Route::post('questions/getbyclass', [QuestionController::class, 'getQuestionByClass']);

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
        Route::post('posts/comment/delete', [CommentPostController::class, 'removeComment']);
        Route::post('questions/comment/create', [CommentQuestionController::class, 'createComment']);
        Route::post('questions/comment/get', [CommentQuestionController::class, 'getListComment']);
        Route::post('questions/comment/delete', [CommentQuestionController::class, 'removeComment']);

        //subject resource route
        Route::get('subject/get', [SubjectController::class, 'get']);

        //job resource routes
        Route::post('job/create', [JobController::class, 'create']);
        Route::get('job/newest', [JobController::class, 'getNewestJob']);
        Route::post('job/show', [JobController::class, 'show']);


        //messages resources routes
        Route::get('unseenmessage', [ChatController::class, 'getUnseenMessages']);
        Route::post('sendlink', [ChatController::class, 'sendLinkMeeting']);

        //Upload file resources routes
        Route::post('file/upload', [FileController::class, 'create']);
        Route::post('file/get', [FileController::class, 'getFile']);
        Route::post('file/getbyclass', [FileController::class, 'getFileByClass']);
        Route::post('file/remove', [FileController::class, 'removeFile']);

        //Class resources routes
        Route::post('class/addmember', [ClassController::class, 'addMember']);
        Route::post('class/removemember', [ClassController::class, 'removeMember']);
        Route::get('class/getclass', [ClassController::class, 'getClass']);
        Route::post('class/getmembers', [ClassController::class, 'getMembers']);
        Route::post('class/ismentor', [ClassController::class, 'isMentor']);
        Route::post('class/get', [ClassController::class, 'getClassInfo']);

        //Upload file resources routes
        Route::post('roadmap/addroadmap', [RoadmapController::class, 'addRoadmap']);
        Route::post('roadmap/getroadmap', [RoadmapController::class, 'getRoadmap']);
    });
});

//admin routes
Route::prefix('admin')->group(function () { 
    Route::middleware(['auth:api'])->group(function () {
        Route::get('count', [UserController::class, 'count']);
        Route::get('users', [UserController::class, 'getUsers']);
        Route::get('companies', [UserController::class, 'getCompanies']);
        Route::post('add-user', [UserController::class, 'addUser']);
        Route::delete('delete-user/{id}', [UserController::class, 'deleteUser']);
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
