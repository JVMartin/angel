<section id="header">
	<div class="top-bar">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<li class="menu-text">Admin</li>
				@if (Gate::allows('admin'))
					<li{!! Request::is('admin/blogs*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/blogs') }}">
							Blogs
						</a>
					</li>
					<li{!! Request::is('admin/pages*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/pages') }}">
							Pages
						</a>
					</li>
					<li{!! Request::is('admin/users*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/users') }}">
							Users
						</a>
					</li>
				@endif
			</ul>
		</div>
		@if (Auth::check())
			<div class="top-bar-right">
				<ul class="menu">
					<li>
						<a href="{{ url('/sign-out') }}">
							<i class="fa fa-sign-out"></i>
							Sign Out
						</a>
					</li>
				</ul>
			</div>
		@endif
	</div>
</section>
