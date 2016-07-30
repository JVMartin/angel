<div class="row">
	<div class="small-12 medium-6 columns">
		{!! Form::open(['url' => '/admin/' . $repository->getHandle() . '/search']) !!}
			<div class="input-group">
				{!! Form::text('search', session('admin.' . $repository->getHandle() . '.search'), ['autofocus', 'class' => 'input-group-field']) !!}
				<div class="input-group-button">
					<input type="submit" class="button" value="Search" />
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>