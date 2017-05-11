<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareMessagesFromSession
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new error binder instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @return self
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Note that form validation errors are shared with the session by:
        // \Illuminate\View\Middleware\ShareErrorsFromSession

        // Let us share all other messages with the session in the same manner.
        $this->view->share(
            'successes', $request->session()->get('successes') ?: new MessageBag
        );

        return $next($request);
    }
}
