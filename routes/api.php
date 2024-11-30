<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Loan\LoanController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/teste', function () {
    return 'teste';
});

Route::resource('author', AuthorController::class)->except(['edit','create']);
Route::resource('book', BookController::class)->except(['edit','create']);
Route::resource('loan', LoanController::class)->except(['edit','create']);
