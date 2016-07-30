@extends('admin.template')

@section('css')
@endsection

@section('js')
<script>
	$(function() {
		var $changesModal = $('#changesModal');
		$('.openChangesButton').click(function() {
			var url = $(this).data('url');
			$changesModal.html('<p>Loading...</p>');
			$.get(url, function(data) {
				$changesModal.html(data);
			}).fail(function(xhr, status, error) {
				console.log(error);
				$changesModal.html('<p>There was an error contacting the server.</p>');
			});
		});
		$changesModal.on('open.zf.reveal');
	});
</script>
@endsection

@section('content')
<div class="reveal" id="changesModal" data-reveal>
</div>
<section id="crudAddOrEdit">
	<div class="row">
		<div class="columns small-12">
			<p>
				<a href="{{ $repository->getIndexURL() }}">
					<i class="fa fa-arrow-left"></i>
					Back to index
				</a>
			</p>
			<h1>{{ ucfirst($action) . ' ' . $repository->getSingular() }}</h1>
		</div>
	</div>
	@if ($action == 'edit')
		{!! Form::model($model) !!}
	@elseif ($action == 'add')
		{!! Form::open() !!}
	@endif
		@include('admin.crud.cols', ['cols' => $repository->getCols()])
		<div class="row">
			<div class="columns small-12">
				<button type="submit" class="button small">
					Save
				</button>
			</div>
		</div>
	{!! Form::close() !!}
	<div class="row">
		<div class="columns small-12">
			<p>
				<a href="{{ $repository->getIndexURL() }}">
					<i class="fa fa-arrow-left"></i>
					Back to index
				</a>
			</p>
		</div>
	</div>
</section>
@endsection