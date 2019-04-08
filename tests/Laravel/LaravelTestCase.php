<?php

namespace Spatie\Enum\Tests\Laravel;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase;

abstract class LaravelTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');

        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
