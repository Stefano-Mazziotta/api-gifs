<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Auth\Infrastructure\AuthController;
use App\Modules\Giphy\Infrastructure\GiphyController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('gifs')->group(function () {
        Route::get('/search', [GiphyController::class, 'searchGifs']);
        Route::get('/{id}', [GiphyController::class, 'getGifById']);
        Route::post('/favorite', [GiphyController::class, 'saveFavoriteGif']);
    });
});
