<section id="messages">
	@if (isset($errors))
		@foreach ($errors->all() as $error)
			<div class="row">
				<div class="columns small-12">
					<div data-alert class="alert-box alert">
						{{ $error }}
						<button tabindex="0" class="close" aria-label="Close Alert">&times;</button>
					</div>
				</div>
			</div>
		@endforeach
	@endif
	@if (isset($successes))
		@foreach ($successes as $success)
			<div class="row">
				<div class="columns small-12">
					<div data-alert class="alert-box success">
						{{ $success }}
						<button tabindex="0" class="close" aria-label="Close Alert">&times;</button>
					</div>
				</div>
			</div>
		@endforeach
	@endif
</section>