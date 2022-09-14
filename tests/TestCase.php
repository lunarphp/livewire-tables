<?php

namespace Lunar\LivewireTables\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
