<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Set up our testing environment
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Reset the sqlite testing database
        // http://www.chrisduell.com/blog/development/speeding-up-unit-tests-in-php/
        copy(database_path('prepared.sqlite'), database_path('database.sqlite'));
    }
}
