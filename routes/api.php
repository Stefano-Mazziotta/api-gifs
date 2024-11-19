<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Auth\Infrastructure\AuthController;
use App\Modules\Gif\Infrastructure\GifController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('gifs')->group(function () {
        Route::get('/search', [GifController::class, 'searchGifs']);
        Route::get('/{id}', [GifController::class, 'getGifById']);
        Route::post('/{id}/favorite', [GifController::class, 'saveFavoriteGif']);
    });
});
