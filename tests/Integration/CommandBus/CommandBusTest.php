<?php

namespace Tests\Integration\CommandBus;

use Tests\OrchestratedTestCase as TestCase;

class CommandBusTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        app()->bind('Joselfonseca\LaravelTactician\CommandBusInterface', 'Joselfonseca\LaravelTactician\Bus');
    }

    public function test_it_loads_service_provider()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider',
            app()->getProvider('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider'));
    }

    public function test_it_registers_locator()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Locator\LocatorInterface',
            app('Joselfonseca\LaravelTactician\Locator\LocatorInterface'));
    }

    /**
     * It registers the inflector
     */
    public function test_it_registers_inflector()
    {
        $this->assertInstanceOf('League\Tactician\Handler\MethodNameInflector\MethodNameInflector',
            app('League\Tactician\Handler\MethodNameInflector\MethodNameInflector'));
    }

    /**
     * It registers the inflector
     */
    public function test_it_registers_inflector_undoable()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Handler\MethodNameInflectorUndoable',
            app('Joselfonseca\LaravelTactician\Handler\MethodNameInflectorUndoable'));
    }

    /**
     * it registers the extractor
     */
    public function test_it_registers_extractor()
    {
        $this->assertInstanceOf('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor',
            app('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor'));
    }

    /**
     * it registers the extractor
     */
    public function test_it_registers_extractor_undoable()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Handler\CommandNameExtractorUndoable',
            app('Joselfonseca\LaravelTactician\Handler\CommandNameExtractorUndoable'));
    }

    public function testItCanInstantiateCommandBus()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
                         'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', [], []));

    }
}
