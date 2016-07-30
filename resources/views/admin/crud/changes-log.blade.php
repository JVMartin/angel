<section id="crudChangesLog">
	<div class="row">
		<div class="small-12 column">
			<h3>Change log for "{{ $repository->getCols()[$column]['pretty'] }}"</h3>
		</div>
	</div>
	<hr />
	@foreach ($changes as $i => $change)
		@if ($i > 0)
			<hr />
		@endif
		<div class="row">
			<div class="small-6 column">
				<p>
					Performed by {{ $change->user->fullName() }} ({{$change->user->email }})
				</p>
			</div>
			<div class="small-6 column text-right">
				<p>
					{{ $change->created_at }}
				</p>
			</div>
		</div>
		@if ($i == 0)
			{!! diff($change->content, $model->$column) !!}
		@else
			{!! diff($change->content, $changes->get($i - 1)->content) !!}
		@endif
	@endforeach
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