@extends('admin.template')

@section('title')
	{{ $user->fullName() }}
@endsection

@section('content')
	<section id="crudUsersShow">
		<div class="row">
			<div class="columns small-12">
				<p>
					<a href="{{ $repository->getIndexURL() }}">
						<i class="fa fa-arrow-left"></i>
						Back to index
					</a>
				</p>
			</div>
		</div>
		<div class="row column">
			<h1>{{ $user->fullName() }}</h1>
			<a href="{{ url($user->editUrl()) }}" class="button">
				<i class="fa fa-edit"></i> Edit
			</a>
			<form method="POST"
						action="{{ route('admin.' . $repository->getHandle() . '.delete', $user->hash) }}"
						class="deleteForm"
						data-confirm="Delete this {{ strtolower($repository->getSingular()) }} forever? This action cannot be undone!">
				{!! csrf_field() !!}
				{!! method_field('DELETE') !!}
				<button type="submit" class="button alert">
					<i class="fa fa-trash"></i> Delete Forever
				</button>
			</form>
		</div>
		<div class="row">
			<div class="column medium-10 large-8">
				<h3>User Details</h3>
				<table>
					<tbody>
						<tr>
							<td><strong>Email</strong></td>
							<td>{{ $user->email }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="columns small-12">
				<p>
					<a href="{{ $repository->getIndexURL() }}">
						<i class="fa fa-arrow-left"></i>
						Back to index
					</a>
				</p>
			</div>
		</div>
	</section>
@endsection