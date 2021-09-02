<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locator
    |--------------------------------------------------------------------------
    |
    | This is the locator that will be used in the command bus
    | see http://tactician.thephpleague.com/tweaking-tactician/ for reference
    |
    */

    'locator' => Joselfonseca\LaravelTactician\Locator\LaravelLazyLocator::class,
    //'locator' => Joselfonseca\LaravelTactician\Locator\LaravelLocator::class,

    /*
    |--------------------------------------------------------------------------
    | Inflector
    |--------------------------------------------------------------------------
    |
    | Default inflector to use
    | see http://tactician.thephpleague.com/tweaking-tactician/ for reference
    |
    */

    'inflector' => League\Tactician\Handler\MethodNameInflector\HandleInflector::class,
    'inflector-undoable' => Joselfonseca\LaravelTactician\Handler\HandleInflectorUndoable::class,

    /*
    |--------------------------------------------------------------------------
    | Extractor
    |--------------------------------------------------------------------------
    |
    | Default extractor to use
    | see http://tactician.thephpleague.com/tweaking-tactician/ for reference
    |
    */

    'extractor' => League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class,
    'extractor-undoable' => Joselfonseca\LaravelTactician\Handler\ClassNameExtractorUndoable::class,

    /*
    |--------------------------------------------------------------------------
    | Command Bus
    |--------------------------------------------------------------------------
    |
    | This is the default command bus to use, is based on
    | Tactician with a few modifications.
    |
    */

    'bus' => Joselfonseca\LaravelTactician\Bus::class,
    'bus-undoable' => Joselfonseca\LaravelTactician\BusUndoable::class,

];
