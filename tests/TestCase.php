<?php

namespace Tests;

require __DIR__.'/helpers.php';

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\PassportServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /** @var \Spatie\Permission\Tests\User */
    protected $testUser;

    /** @var \Spatie\Permission\Tests\Admin */
    protected $testAdmin;

    /** @var bool */
    protected $useCustomModels = false;

    protected static $migration;

    protected static $customMigration;

    /** @var bool */
    protected $usePassport = false;

    protected function setUp(): void
    {
        parent::setUp();
        if (!self::$migration) {
            $this->prepareMigration();
        }
        $this->setUpDatabase($this->app);
        if ($this->hasTeams) {
            setPermissionsTeamId(1);
        }
        if ($this->usePassport) {
            $this->setUpPassport($this->app);
        }
        $this->setUpRoutes();
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \FourPlayingChess\CoreLib\FourPlayingChessServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]); // use sqlite for testing.
    }

    /**
     * Set up the database.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();
        
        // nothing yet.
    }

    protected function setUpPassport($app): void
    {
        if ($this->getLaravelVersion() < 9) {
            return;
        }
        
        // nothing yet.
    }

    private function prepareMigration()
    {
        // nothing yet.
    }

    /**
     * Create routes to test authentication with guards.
     */
    public function setUpRoutes(): void
    {
        // nothing yet.
    }

    protected function getLaravelVersion()
    {
        return (float) app()->version();
    }
}