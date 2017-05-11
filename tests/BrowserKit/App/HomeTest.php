<?php

namespace Tests\BrowserKit\App;

use Tests\BrowserKitTestCase;

class HomeTest extends BrowserKitTestCase
{
	/**
	 * Ensure the home page displays.
	 */
	public function testHome()
	{
		$this->visit('/')
			->see('Angel CMS Default Home Page');
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
