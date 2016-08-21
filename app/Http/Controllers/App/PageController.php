<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\App;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * PageController displays CMS pages to front-end users.
 *
 * @package App\Http\Controllers\App
 */
class PageController extends Controller
{
	/**
	 * Display a page from the CMS to the user.
	 *
	 * @param string $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
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