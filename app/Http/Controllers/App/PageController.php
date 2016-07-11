<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function home()
	{
		return 'You are home.';
	}
}