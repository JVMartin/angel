<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="/favicon.ico" />

	@yield('meta')

	<title>@yield('title') | Admin</title>

	<link href="{{ mix("css/admin.css") }}" rel="stylesheet">
	@yield('css')
</head>
<body>
	@include('admin._header')
	@include('admin._messages')
	@yield('content')
	<script src="{{ mix("js/admin.js") }}"></script>
	@yield('js')
	<script>
		window.config = {
			base_url: '{!! url('/') !!}'
		};
	</script>
</body>
</html>
