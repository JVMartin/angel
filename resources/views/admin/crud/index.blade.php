@extends('admin.template')

@section('title')
	{{ $repository->getPlural() }}
@endsection

@section('content')
<section id="crudIndex">
	<div class="row">
		<div class="small-6 column">
			<h1>
				{{ $repository->getPlural() }}
			</h1>
		</div>
		<div class="small-6 column">
			<p class="text-right">
				<a href="{{ $repository->getAddURL() }}" class="button large">
					<i class="fa fa-plus"></i>
					Add {{ $repository->getSingular() }}
				</a>
			</p>
		</div>
	</div>
	@include('admin.crud.index-search')
	<div class="pagination text-center">
		{!! $models->render(Foundation::paginate($models)) !!}
	</div>
	<div class="row">
		<div class="small-12 column">
			<table>
				<thead>
					<tr>
						<th></th>
						@foreach ($repository->getIndexCols() as $col)
							<th>
								<a href="{{ url('admin/' . $repository->getHandle() . '/order-by/' . $col) }}">
									{!! $repository->getCols()[$col]['pretty'] !!}
									@if (session('admin.' . $repository->getHandle() . '.order.column') == $col)
										@if (session('admin.' . $repository->getHandle() . '.order.direction') == 'ASC')
											<i class="fa fa-chevron-up"></i>
										@else
											<i class="fa fa-chevron-down"></i>
										@endif
									@endif
								</a>
							</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach ($models as $model)
						<tr>
							<td>
								<a href="{{ url($model->editURL()) }}" class="button tiny editButton">
									<i class="fa fa-edit"></i>
								</a>
							</td>
							@foreach ($repository->getIndexCols() as $col)
								<td>
									{{ $model->$col }}
								</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="pagination text-center">
		{!! $models->render(Foundation::paginate($models)) !!}
	</div>
</section>
@endsection