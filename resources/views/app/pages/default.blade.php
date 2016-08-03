@extends('app.template')

@section('title', $page->title)

@section('meta')
	<meta name="description" content="{{ $page->og_desc }}">
	<meta property="og:description" content="{{ $page->og_desc }}">
	<meta property="og:image" content="{{ $page->image }}">
@endsection

@section('content')
<section id="pagesDefault">
	<div class="row">
		<div class="small-12 column">
			{!! $page->html !!}
		</div>
	</div>
</section>
@endsection
