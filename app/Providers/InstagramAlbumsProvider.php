<?php

namespace App\Providers;

use App\Services\InstagramAlbumService;
use App\Services\InstantTokensService;
use Illuminate\Support\ServiceProvider;

class InstagramAlbumsProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(InstagramAlbumService::class, function () {
            return new InstantTokensService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
