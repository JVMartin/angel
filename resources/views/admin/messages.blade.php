<section id="messages">
	@if (isset($errors))
		@foreach ($errors->get('messages') as $error)
			<div class="row">
				<div class="columns small-12">
					<div class="callout alert">
						{{ $error }}
					</div>
				</div>
			</div>
		@endforeach
	@endif
	@if (isset($successes))
		@foreach ($successes->get('messages') as $success)
			<div class="row">
				<div class="columns small-12">
					<div class="callout success">
						{{ $success }}
					</div>
				</div>
			</div>
		@endforeach
	@endif
</section>