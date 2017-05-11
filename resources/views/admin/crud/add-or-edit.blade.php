@extends('admin.template')

@section('title')
	{{ ucfirst($action) . ' ' . $repository->getSingular() }}
@endsection

@section('content')
	@if ($action == 'edit')
		<div class="reveal" id="changesModal" data-reveal>
			<div id="changesModalContent"></div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<section id="crudAddOrEdit">
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
		<div class="row">
			<div class="column small-6">
				<h1>{{ ucfirst($action) . ' ' . $repository->getSingular() }}</h1>
			</div>
			<div class="column small-6 text-right">
				@if ($action == 'edit')
					<form method="POST"
					      action="{{ route('admin.' . $repository->getHandle() . '.delete', [$model->hash]) }}"
					      class="deleteForm"
					      data-confirm="Delete this {{ strtolower($repository->getSingular()) }} forever?  This action cannot be undone!">
						{!! csrf_field() !!}
						{!! method_field('DELETE') !!}
						<button type="submit" class="button small alert">
							<i class="fa fa-trash"></i> Delete Forever
						</button>
					</form>
				@endif
			</div>
		</div>
		@if ($action == 'edit')
			{!! Form::model($model, ['autocomplete' => 'off']) !!}
		@elseif ($action == 'add')
			{!! Form::open(['autocomplete' => 'off']) !!}
		@endif
			@include('admin.crud._cols', ['cols' => $repository->getCols()])
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
