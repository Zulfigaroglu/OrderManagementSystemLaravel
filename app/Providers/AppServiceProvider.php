<?php

namespace App\Providers;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\DiscountService;
use App\Services\Infrastructure\IModelService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindServices();
    }

    public function bindServices()
    {
        $app = $this->app;

        $app->when(CategoryController::class)
            ->needs(IModelService::class)
            ->give(CategoryService::class);

        $app->when(ProductController::class)
            ->needs(IModelService::class)
            ->give(ProductService::class);

        $app->when(CustomerController::class)
            ->needs(IModelService::class)
            ->give(CustomerService::class);

        $app->when(OrderController::class)
            ->needs(IModelService::class)
            ->give(OrderService::class);

        $app->when(DiscountController::class)
            ->needs(IModelService::class)
            ->give(DiscountService::class);
    }
}
