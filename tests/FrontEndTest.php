<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontEndTest extends TestCase
{
	/**
	 * Ensure the home page displays.
	 */
	public function testHome()
	{
		$this->visit('/')
			->see('You are home');
	}

	/**
	 * The debug bar should not be visible unless we are in debug mode.
	 */
	public function testDebugBarDoesNotShow()
	{
		$this->visit('/')
			->dontSee('debugbar');
	}
}
