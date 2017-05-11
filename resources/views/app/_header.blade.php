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
					<li>
						<a href="/admin">
							Admin
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>