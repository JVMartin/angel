@extends('app.template')

@section('title', $page->title)

@section('meta')
	<meta name="description" content="{{ $page->og_desc }}">
	<meta property="og:description" content="{{ $page->og_desc }}">
	<meta property="og:image" content="{{ $page->image }}">
@endsection

@section('content')
	<section id="pagesHome">
		<div class="row column hero">
			<h1>Angel CMS Default Home Page</h1>
		</div>
		<div class="row">
			<div class="column medium-6">
				{!! $page->html !!}
			</div>
			<div class="column medium-6">
				<h3>Blade content.</h3>
				<p>
					The content in this column is set in a blade, specifically
					app/pages/home.blade.php.
				</p>
				<p>
					You can have all content be customizable, or choose parts the way we have
					here on the home page.
				</p>
			</div>
		</div>
	</section>
@endsection
