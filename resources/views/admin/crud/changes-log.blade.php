<section id="crudChangesLog">
	<div class="row">
		<div class="small-12 column">
			<h3>Change log for `{{ $column }}`</h3>
		</div>
	</div>
	<hr />
	@foreach ($changes as $i => $change)
		@if ($i > 0)
			<hr />
		@endif
		Performed by {{ $change->user->fullName() }} ({{$change->user->email }})<br />
		{{ $change->created_at }}
		@if ($i == 0)
			{!! diff($change->content, $model->$column) !!}
		@else
			{!! diff($change->content, $changes->get($i - 1)->content) !!}
		@endif
	@endforeach
	{{--
	@foreach ($changes as $i => $change)
		<div class="row">
			<div class="small-12 column">
				<p>
					<strong>
						Before {{ $change->created_at }}
						@if ($changes->count() > $i + 1)
							(Set by {{ $changes->get($i + 1)->user->fullName() . ', ' . $changes->get($i + 1)->user->email }})
						@endif
					</strong>
				</p>
				<div>
					@if (empty($change->content))
						<i>EMPTY</i>
					@else
						@if ($changes->count() > $i + 1)
							{!! diff($change->content, $changes->get($i+1)->content) !!}
						@else
							{{ $change->content }}
						@endif
					@endif
				</div>
			</div>
		</div>
		@if ($i < $changes->count() - 1)
			<hr />
		@endif
	@endforeach
	--}}
@if ($changes->isEmpty())
		<div class="row">
			<div class="small-12 column">
				<div class="alert-box alert round">
					No changes exist yet.
				</div>
			</div>
		</div>
	@endif
</section>