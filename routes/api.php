<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('product/{product:slug}', [ProductController::class, 'show']);
Route::get('products', [ProductController::class, 'index']);

Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('product/{product}/vote', [ProductController::class, 'storeVote']);
    Route::post('product/{product}/comment', [ProductController::class, 'storeComment']);
});
