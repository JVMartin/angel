<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="/favicon.ico" />

	@yield('meta')

	<title>@yield('title') | Admin</title>

	<link href="{{ elixir("css/admin.css") }}" rel="stylesheet">
	@yield('css')
</head>
<body>
@include('admin.header')
@include('admin.messages')
@yield('content')
<script src="{{ elixir("js/admin.js") }}"></script>
@yield('js')
</body>
</html>
