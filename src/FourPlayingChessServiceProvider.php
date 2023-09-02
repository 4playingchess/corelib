<?php

namespace FourPlayingChess\CoreLib;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class FourPlayingChessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void Returns nothing.
     */
    public function boot()
    {
        $this->registerMigrations();
    }

    /**
     * Register CoreLib's migration files.
     *
     * @return void Returns nothing.
     */
    protected function registerMigrations()
    {
        $config = $this->app['config']['corelib'];
        $runMigrations = is_null($config['migrations'] ?? null) 
            ? count(\File::glob(database_path('migrations/*corelib*.php'))) === 0
            : $config['migrations'];
        if ($runMigrations) {
            $this->loadMigrationsFrom(__DIR__.'/../migrations');
        }
    }

    /**
     * Register any application services.
     *
     * @return void Returns nothing.
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();
    }

    /**
     * Setup the configuration for CoreLib.
     *
     * @return void Returns nothing.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/corelib.php', 'corelib'
        );
    }

    /**
     * Setup the resource publishing groups for Acquaintances.
     *
     * @return void Returns nothing.
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/corelib.php' => config_path('corelib.php'),
            ], 'corelib-config');
            $this->publishes($this->updateMigrationDate(), 'corelib-migrations');
        }
    }


    /**
     * Udpate the old migration date with a new one.
     *
     * @return array Returns existing migration file if found, else uses the current timestamp.
     */
    protected function updateMigrationDate(): array
    {
        $tempArray = [];
        $path = __DIR__.'/../database/migrations';
        foreach (\File::allFiles($path) as $file) {
            $tempArray[$path.'/'.\File::basename($file)] = app()->databasePath()."/migrations/".date('Y_m_d_His').'_'.\File::basename($file);
        }
        return $tempArray;
    }
}
