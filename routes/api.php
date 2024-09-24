<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\user\MessageController;
use App\Http\Controllers\user\ProfileController;

Route::group([

    "controller" => AuthController::class,

], function() {

    Route::post("login", "login");
    Route::post("register", "register");
    Route::post("logout", "logout") -> middleware("auth");
    Route::post("refresh", "refresh") -> middleware("auth");

});

Route::group([
    
    "prefix" => "user"
    
], function() {

    Route::get('', [ProfileController::class, 'getUserProfile']);
    Route::get('profile', [ProfileController::class, 'getMyProfile']);
    Route::post('profile', [ProfileController::class, "updateProfile"]);
    Route::patch('profile', [ProfileController::class, "updateProfileSwitcher"]);

    Route::controller(MessageController::class) -> group(function() {
        Route::get('{user_id}/send-message', 'getUserProfile');
        Route::get('{user_id}/public-messages', 'publicMessages');
        Route::get('all-messages', 'allMessages');
        Route::get('fav-messages', 'favMessages');
        Route::post('messages', 'store');
        Route::patch('messages/{message_id}', 'update');
        Route::delete('messages/{message_id}', 'destroy');
    });

});

