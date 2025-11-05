<?php

namespace RaoulHofmann\L1\Test;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'd1']);

        $this->withFactories(__DIR__ . '/database/factories');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            \RaoulHofmann\L1\L1ServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
        $app['config']->set('auth.providers.users.model', Models\User::class);
        $app['config']->set('database.default', 'd1');
        $app['config']->set('database.connections.d1', [
            'driver' => 'd1',
            'prefix' => '',
            'database' => env('CLOUDFLARE_D1_DATABASE_ID', ''),
            'api' => 'https://api.cloudflare.com/client/v4',
            'auth' => [
                'token' => env('CLOUDFLARE_TOKEN', getenv('CLOUDFLARE_TOKEN')),
                'account_id' => env('CLOUDFLARE_ACCOUNT_ID', getenv('CLOUDFLARE_ACCOUNT_ID')),
            ],
        ]);
    }
}
