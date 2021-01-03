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
        $this->mergeConfigFrom(__DIR__ . '/../config/encoder.php', 'encoder_service');
    }

    /**
     * Provider boot.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
