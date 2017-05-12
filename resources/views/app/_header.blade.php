<section id="header">
	<div class="top-bar">
		<div class="row column inner">
			<div class="top-bar-left">
				<ul class="dropdown menu" data-dropdown-menu>
					<li class="menu-text">Your Company</li>
					@foreach (App\Models\Page::all() as $page)
						<li>
							<a href="/{{ $page->slug }}">
								{{ $page->title }}
							</a>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="top-bar-right">
				<ul class="dropdown menu" data-dropdown-menu>
					@if (Auth::guest() || Auth::user()->isAdmin())
						<li>
							<a href="/admin">
								Admin
							</a>
						</li>
					@endif
					@if (Auth::check())
						<li>
							<a href="{{ url('/sign-out') }}">
								<i class="fa fa-sign-out"></i>
								Sign Out
							</a>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</section>