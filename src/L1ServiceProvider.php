<?php

namespace RaoulHofmann\L1;

use Illuminate\Support\ServiceProvider;
use RaoulHofmann\L1\D1\D1Connection;

class L1ServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('db', function ($db) {
            $db->extend('d1', function ($config, $name) {
                $config['name'] = $name;

                return new D1Connection(
                    new CloudflareD1Connector(
                        $config['database'],
                        $config['auth']['token'],
                        $config['auth']['account_id'],
                        $config['api'] ?? 'https://api.cloudflare.com/client/v4',
                    ),
                    $config,
                );
            });
        });
    }
}
