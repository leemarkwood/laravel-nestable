<?php

namespace Nestable\Tests;

class DBTestCase extends TestCase
{
    /*
     * Bootstrap the application
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__. '/migrations');

        $this->artisan('migrate', ['--database' => 'sqlite']
        )->run();
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('nestable',  require(__DIR__.'/../config/nestable.php'));
    }
}
