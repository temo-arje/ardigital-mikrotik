<?php

namespace ArDigital\Mikrotik;

use Illuminate\Support\ServiceProvider;


class MikrotikServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/mikrotik.php' => config_path('mikrotik.php'),
        ]);
    }

}
