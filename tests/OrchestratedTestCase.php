<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class OrchestratedTestCase extends Orchestra
{

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider'];
    }

    /*public function test_assert_true()
    {
        $this->assertTrue(true);
    */
}
