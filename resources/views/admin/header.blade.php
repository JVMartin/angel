<div id="adminNav" class="top-bar">
	<div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
			<li class="menu-text">
				Angel Admin
			</li>
			<li{!! Request::is('admin/pages*') ? ' class="active"' : '' !!}>
				<a href="{{ url('admin/pages') }}">
					Pages
				</a>
			</li>
			<li{!! Request::is('admin/blogs*') ? ' class="active"' : '' !!}>
				<a href="{{ url('admin/blogs') }}">
					Blogs
				</a>
			</li>
			<li{!! Request::is('admin/users*') ? ' class="active"' : '' !!}>
				<a href="{{ url('admin/users') }}">
					Users
				</a>
			</li>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="menu">
			<li>
				<a href="{{ url('admin/logout') }}">
					Sign Out
				</a>
			</li>
		</ul>
	</div>
</div>