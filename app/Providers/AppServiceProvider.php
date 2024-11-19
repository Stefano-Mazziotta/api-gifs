<?php

namespace App\Providers;

use App\Modules\Giphy\Domain\Repositories\FavoriteGifRepositoryInterface;
use App\Modules\Giphy\Domain\Repositories\GifRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Modules\Giphy\Infrastructure\GiphyRepository;
use App\Modules\Giphy\Infrastructure\FavoriteGifRepository;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GifRepositoryInterface::class, GiphyRepository::class);
        $this->app->bind(FavoriteGifRepositoryInterface::class, FavoriteGifRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
    }
}
