<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Loan\LoanController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\CheckPermissionMiddleware;
use App\Http\Controllers\Documentation\TestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::middleware([CheckPermissionMiddleware::class. ':user|admin'])->prefix('user')->group(function () {
        Route::get('me', [JWTAuthController::class, 'getUser']);
        Route::post('logout', [JWTAuthController::class, 'logout']);
        Route::resource('book', BookController::class)->only(['index','show']);
        Route::resource('loan', LoanController::class)->only(['index','show','store']);
    });

    Route::middleware([CheckPermissionMiddleware::class. ':admin'])->prefix('admin')->group(function () {
        Route::get('me', [JWTAuthController::class, 'getUser']);
        Route::post('logout', [JWTAuthController::class, 'logout']);
        Route::resource('author', AuthorController::class)->except(['show','create']);
        Route::resource('book', BookController::class)->except(['edit','create']);
        Route::resource('loan', LoanController::class)->except(['edit','create']);
    });
});

Route::post('/test', [TestController::class, 'test']);
