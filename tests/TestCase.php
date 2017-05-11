<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
