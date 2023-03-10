<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/book/get', [BookController::class, 'getbooks']);
    Route::get('/book', [BookController::class, 'index']);
    Route::get('/book/show/{book}', [BookController::class, 'show']);
    Route::post('/book/store/', [BookController::class, 'store']);
    Route::put('/book/update/{book}', [BookController::class, 'update']);
    Route::delete('/book/destroy/{book}', [BookController::class, 'destroy']);
    // Route::get('/book/search/', [BookController::class, 'search']);
    Route::get('/author/get', [AuthorController::class, 'getauthors']);
    Route::get('/author', [AuthorController::class, 'index']);
    Route::get('/author/show/{author}', [AuthorController::class, 'show']);
    Route::post('/author/store/', [AuthorController::class, 'store']);
    Route::put('/author/update/{author}', [AuthorController::class, 'update']);
    Route::delete('/author/destroy/{author}', [AuthorController::class, 'destroy']);
    // Route::get('/book/search/', [BookController::class, 'search']);
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order/add', [OrderController::class, 'add']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Route::POST('/login', 'API\LoginController@login');
// Route::POST('/register', 'API\RegisterController@register');
