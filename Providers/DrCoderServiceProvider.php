<?php

namespace DrCoder\Providers;

use Illuminate\Support\ServiceProvider;

class DrCoderServiceProvider extends ServiceProvider
{
    /**
     * Provider register.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Provider boot.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/encoder.php' => config_path('encoder_service.php'),
        ], 'encoder-service');
    }
}
