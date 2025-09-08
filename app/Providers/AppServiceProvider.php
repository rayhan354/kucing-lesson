<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Repositories\CourseRepository;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\PricingRepository;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Transaction::observe(TransactionObserver::class);
    }
}
