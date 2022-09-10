<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', [TestController::class, "test"]);

Route::get('offers', [OfferController::class, "load"]);
Route::middleware("delete-offer")->post('offers/{id}/delete', [OfferController::class, "delete"]);

/**
 * offers/{id} обычно означает показать (вернуть) одно предложение (offer),
 * поэтому для восстановления лучше использовать offers/{id}/restore
 */
Route::post('offers/{id}/restore', [OfferController::class, "restore"]);

Route::get('products/{id}/sellers', [ProductController::class, "sellers"]);
