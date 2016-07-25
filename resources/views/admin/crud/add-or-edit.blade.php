@extends('admin.template')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
	<section id="crudAddOrEdit">
		<div class="row">
			<div class="columns small-12">
				<p>
					<a href="{{ $meta->indexURL() }}">
						<i class="fi-arrow-left"></i>
						Back to index
					</a>
				</p>
				<h1>{{ ucfirst($action) . ' ' . $meta->singular }}</h1>
			</div>
		</div>
		@if ($action == 'edit')
			{!! Form::model($model) !!}
		@elseif ($action == 'add')
			{!! Form::open() !!}
		@endif
			@include('admin.crud.cols', ['cols' => $meta->cols()])
			<div class="row">
				<div class="columns small-12">
					<button type="submit">
						Save
					</button>
				</div>
			</div>
		{!! Form::close() !!}
		<div class="row">
			<div class="columns small-12">
				<p>
					<a href="{{ $meta->indexURL() }}">
						<i class="fi-arrow-left"></i>
						Back to index
					</a>
				</p>
			</div>
		</div>
	</section>
@endsection