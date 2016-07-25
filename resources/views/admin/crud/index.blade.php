@extends('admin.template')

@section('title')
	{{ $repository->getPlural() }}
@endsection

@section('content')
	<section id="crudIndex">
		<div class="row">
			<div class="small-12 column">
				<h1>
					{{ $repository->getPlural() }}
					<a id="createNewButton" href="{{ $repository->getAddURL() }}" class="button small">
						<i class="fi-plus"></i>
						Add {{ $repository->getSingular() }}
					</a>
				</h1>
			</div>
		</div>
		@include('admin.crud.index-search')
		<div class="pagination-centered">
			{{-- {!! $models->render(Foundation::paginate($models)) !!} --}}
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
												<i class="fi-arrow-up"></i>
											@else
												<i class="fi-arrow-down"></i>
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
										<i class="fi-page-edit"></i>
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
		<div class="pagination-centered">
			{{-- {!! $models->render(Foundation::paginate($models)) !!} --}}
		</div>
	</section>
@endsection