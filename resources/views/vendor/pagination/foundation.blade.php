<ul class="pagination" aria-label="Pagination">
	<!-- Previous Page Link -->
	@if ($paginator->onFirstPage())
		<li class="pagination-previous disabled"></li>
	@else
		<li class="pagination-previous">
			<a href="{{ $paginator->previousPageUrl() }}" rel="prev"></a>
		</li>
	@endif

	<!-- Pagination Elements -->
	@foreach ($elements as $element)
		<!-- "Three Dots" Separator -->
		@if (is_string($element))
			<li class="ellipsis"></li>
		@endif

		<!-- Array Of Links -->
		@if (is_array($element))
			@foreach ($element as $page => $url)
				@if ($page == $paginator->currentPage())
					<li class="current">{{ $page }}</li>
				@else
					<li><a href="{{ $url }}">{{ $page }}</a></li>
				@endif
			@endforeach
		@endif
	@endforeach

	<!-- Next Page Link -->
	@if ($paginator->hasMorePages())
		<li class="pagination-next">
			<a href="{{ $paginator->nextPageUrl() }}" rel="next"></a>
		</li>
	@else
		<li class="pagination-next disabled"></li>
	@endif
</ul>
