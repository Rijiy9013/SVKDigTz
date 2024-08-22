<?php

namespace App\Providers;

use App\Helpers\BaseValidator;
use App\Helpers\Interfaces\TicketApiClientInterface;
use App\Helpers\TicketApiClient;
use App\Repositories\Interfaces\ShowRepositoryInterface;
use App\Repositories\ShowRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShowRepositoryInterface::class, ShowRepository::class);

        $this->app->bind(TicketApiClientInterface::class, TicketApiClient::class);

        $this->app->singleton(BaseValidator::class, function ($app): BaseValidator {
            return new BaseValidator();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
