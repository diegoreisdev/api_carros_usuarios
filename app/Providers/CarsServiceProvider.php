<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Cars\Cars;
use App\Repositories\Cars\CarsRepository;
use App\Services\Cars\CarsService;
use Illuminate\Support\ServiceProvider;

class CarsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CarsService::class, function ($app) {
            return new CarsService(new CarsRepository(new Cars()));
        });
    }
}
