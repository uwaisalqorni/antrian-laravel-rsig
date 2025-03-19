<?php

namespace App\Providers;

use App\Services\QueueService;
use Filament\Support\Assets\Js;
use App\Services\ThermalPrinterService;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ThermalPrinterService::class, function ($app) {
            return new ThermalPrinterService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('thermal-printer', asset('js/thermal-printer.js')),
            //Js::make('epson-printer', asset('js/epson-printer.js')),
            Js::make('call-queue', asset('js/call-queue.js'))
        ]);

        $this->app->singleton(QueueService::class, function ($app) {
            return new QueueService();
        });
    }
}
