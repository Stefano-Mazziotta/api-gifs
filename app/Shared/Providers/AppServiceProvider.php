<?php

namespace App\Shared\Providers;


use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

use App\Modules\Gif\Domain\GifRepositoryInterface;
use App\Modules\Gif\Infrastructure\GiphyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GifRepositoryInterface::class, GiphyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
    }
}
