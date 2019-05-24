<?php

namespace App\Providers;

use App\Image\Filters\CircleFilter;
use App\Image\Filters\VintageFilter;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageManager::class, function () {
            return new ImageManager(array('driver' => 'gd'));
        });

        $this->app->singleton(VintageFilter::class, function () {
            return new VintageFilter();
        });

        $this->app->singleton(CircleFilter::class, function () {
            return new CircleFilter();
        });
    }
}
