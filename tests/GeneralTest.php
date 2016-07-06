<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneralTest extends TestCase
{
	/**
	 * The debug bar should not be visible unless we are in debug mode.
	 */
	public function testDebugBarDoesNotShow()
	{
		$this->visit('/')
			->dontSee('debugbar');
	}
}
