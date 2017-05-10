@extends('admin.template')

@section('title')
	{{ ucfirst($action) . ' ' . $repository->getSingular() }}
@endsection

@section('css')
@endsection

@section('js')
	<script src="{{ asset("js/ckeditor/ckeditor.js") }}"></script>
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
			<div class="columns small-6">
				<h1>{{ ucfirst($action) . ' ' . $repository->getSingular() }}</h1>
			</div>
			<div class="columns small-6" style="text-align: right;">
				@if ($action == 'edit')
					<form action="/admin/{{$repository->getHandle()}}/delete/{{$model->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete this {{$repository->getSingular()}}?');">
						{{ csrf_field() }}
						<button type="submit" class="button alert"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
					</form>
				@endif
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
	
		@if($action == 'edit' && $repository->getSingular() == 'User')
			<div class="row">
				<div class="columns small-12">
					{!! Form::model($model, array('class' => 'callout', 'data-abide' => 'true')) !!}
						<h2>Update Password</h2>
						<div data-abide-error class="alert callout" style="display: none;">
						  <p><i class="fi-alert"></i> There are some errors in your form.</p>
						</div>
						{{ csrf_field() }}
						{!! Form::hidden('email', null) !!}
						<label>
							Password
							<input type="password" id="password" name="password" required>
						</label>
						<label>
							Confirm Password
							<input type="password" name="password_confirmation" required data-equalto="password">
						</label>
						<button type="submit" class="button"><i class="fa fa-key" aria-hidden="true"></i> Update Password</button>
					{!! Form::close() !!}
				</div>
			</div>
		@endif

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