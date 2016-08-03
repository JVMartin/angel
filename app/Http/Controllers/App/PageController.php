<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\App;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
	public function getPage($slug = 'home')
	{
		$page = Page::where('slug', $slug)->first();

		if ( ! $page) {
			throw new NotFoundHttpException;
		}

		$this->data['page'] = $page;

		// If a blade exists, load that blade.
		if (view()->exists('app.pages.' . $page->slug)) {
			return view('app.pages.' . $page->slug, $this->data);
		}

		// Otherwise, load the default page.
		return view('app.pages.default', $this->data);
	}
}