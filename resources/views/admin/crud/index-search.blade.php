<div class="row">
	<div class="small-12 medium-6 columns">
		{!! Form::open(['url' => 'admin/' . $meta->handle . '/search']) !!}
		<div class="row collapse">
			<div class="small-10 columns">
				{!! Form::text('search', session('admin.' . $meta->handle . '.search'), ['autofocus']) !!}
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