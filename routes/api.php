<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WebsiteController;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'hey';
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Define the Routes to get the list of website and to search the list of website
// This route is accessbile to Unauthenticated Users, no need to use the auth middleware

Route::controller(WebsiteController::class)->group(function () {
    Route::prefix('websites')->group(function () {
        Route::get('/', 'index');
        Route::get('search', 'search');

        // Routes for Authenticated users

        // I will uncomment this when I work on Authentication

        // Route::middleware(['auth:sanctum'])->group(function () {
        //     Route::post('/add', [WebsiteController::class, 'store']);
        //     Route::post('vote/{websiteId}', [VoteController::class, 'vote']);
        // });

        // I will Comment this when I work on Authentication
        Route::post('add', 'store');
        // This should be wrapped in the (['auth:sanctum', 'admin']) middleware
        Route::delete('delete/{websiteId}', 'destroy');
    });
});

Route::controller(VoteController::class)->group(function (){
    Route::prefix('websites')->group(function () {
        Route::post('vote/{websiteId}', 'vote');
    });
});


Route::controller(CategoryController::class)->group(function (){
    Route::prefix('websites')->group(function () {
        Route::get('category', 'index');
    });
});
