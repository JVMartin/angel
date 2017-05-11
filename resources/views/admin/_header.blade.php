<section id="header">
	<div class="top-bar">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<li class="menu-text">Admin</li>
				@if (Gate::allows('admin'))
					<li{!! Request::is('admin/offerings*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/offerings') }}">
							Offerings
						</a>
					</li>
					<li{!! Request::is('admin/users*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/users') }}">
							Users
						</a>
					</li>
					<li{!! Request::is('admin/sign-ins*') ? ' class="active"' : '' !!}>
						<a href="{{ url('/admin/sign-ins') }}">
							Sign Ins
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
