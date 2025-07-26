<?php

namespace App\Providers;

use App\Repository\Implementation\AuthRepository;
use App\Repository\Implementation\CartRepository;
use App\Repository\Implementation\CustomerRepository;
use App\Repository\Implementation\PhoneRepository;
use App\Repository\Implementation\RepairRepository;
use App\Repository\Implementation\SaleRepository;
use App\Repository\Implementation\ServiceHistoryRepository;
use App\Repository\Interface\IAuthRepository;
use App\Repository\Interface\ICartRepository;
use App\Repository\Interface\ICustomerRepository;
use App\Repository\Interface\IPhoneRepository;
use App\Repository\Interface\IRepairRepository;
use App\Repository\Interface\ISaleRepository;
use App\Repository\Interface\IServiceHistoryRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IAuthRepository::class,AuthRepository::class);
        $this->app->bind(ICartRepository::class,CartRepository::class);
        $this->app->bind(ICustomerRepository::class,CustomerRepository::class);
        $this->app->bind(IPhoneRepository::class,PhoneRepository::class);
        $this->app->bind(IRepairRepository::class,RepairRepository::class);
        $this->app->bind(ISaleRepository::class,SaleRepository::class);
        $this->app->bind(IServiceHistoryRepository::class,ServiceHistoryRepository::class);
    }
}
