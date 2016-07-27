<div class="row">
	<div class="small-12 medium-6 columns">
		{!! Form::open(['url' => 'admin/' . $repository->getHandle() . '/search']) !!}
		<div class="row collapse">
			<div class="small-10 columns">
				{!! Form::text('search', session('admin.' . $repository->getHandle() . '.search'), ['autofocus']) !!}
			</div>
			<div class="small-2 columns">
				<button class="button postfix">
					Search
				</button>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>