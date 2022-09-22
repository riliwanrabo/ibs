<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MiscsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as StatusCode;

Route::group(['controller' => MiscsController::class], function () {
    Route::get('health', 'siteInfo');
});

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('me', 'info');
    Route::post('logout', 'logout');
});

Route::group(['prefix' => 'authors', 'controller' => AuthorController::class], function () {
    Route::get('/', 'index');
    Route::get('{author}', 'show');
    Route::post('/', 'store');
    Route::delete('/', 'destroy');
});

Route::group(['prefix' => 'books', 'controller' => BookController::class], function () {
    Route::get('/', 'index');
    Route::get('{book}', 'show');
    Route::post('/', 'store');
    Route::delete('/', 'destroy');
});

Route::group(['prefix' => 'comments', 'controller' => CommentController::class], function () {
    Route::get('/', 'index');
    Route::get('{comment}', 'show');
    Route::post('/', 'store');
    Route::delete('/', 'destroy');
});

Route::fallback(fn () => response()->json(['message' => 'Resource not found'], StatusCode::HTTP_NOT_FOUND));
