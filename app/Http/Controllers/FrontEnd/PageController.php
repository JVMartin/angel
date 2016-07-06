<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function home()
	{
		return 'You are home.';
	}
}