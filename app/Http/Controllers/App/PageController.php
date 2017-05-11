<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Crud\PageRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
	/**
	 * @var PageRepository
	 */
	protected $pageRepository;

	public function __construct(PageRepository $pageRepository)
	{
		$this->pageRepository = $pageRepository;
	}

	/**
	 * Display a page from the CMS to the user.
	 *
	 * @param string $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getPage($slug = 'home')
	{
		$page = $this->pageRepository->getBySlug($slug);

		if ( ! $page) {
			throw new NotFoundHttpException;
		}

		view()->share('page', $page);

		// If a blade exists, load that blade.
		if (view()->exists('app.pages.' . $page->slug)) {
			return view('app.pages.' . $page->slug);
		}

		// Otherwise, load the default page.
		return view('app.pages.default');
	}
}
