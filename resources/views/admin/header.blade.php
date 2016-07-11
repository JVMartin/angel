<nav id="adminNav" class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<li class="name">
			<h1><a href="{{ url('admin') }}">Angel Admin</a></h1>
		</li>
		<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li>
				<a href="{{ url('admin/logout') }}">
					Sign Out
				</a>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
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
	</section>
</nav>