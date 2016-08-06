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
			{!! $page->html !!}
		</div>
	</section>
@endsection
