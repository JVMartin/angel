<div class="row">
	<div class="medium-8 large-6 column end">
		<form action="{{ route('admin.' . $repository->getHandle() . '.index.search') }}" method="POST" autocomplete="off">
			{{ csrf_field() }}
			<div class="input-group">
				<input type="text"
				       name="search"
				       value="{{ session('admin.' . $repository->getHandle() . '.search') }}"
				       class="input-group-field" autofocus>
				<div class="input-group-button">
					<button type="submit" class="button">
						<i class="fa fa-search"></i> Search
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
