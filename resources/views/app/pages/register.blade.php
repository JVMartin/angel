@extends('app.template')

@section('title', 'Register')

@section('content')
	<section id="pagesRegister">
		<div class="row">
			<div class="column small-12 medium-6">
				<h4>Sign In</h4>
				<form method="POST" autocomplete="off">
					{!! csrf_field() !!}

					<div class="row">
						<div class="column medium-6">
							<label class="{{ ($errors->has('first_name')) ? 'is-invalid-label' : '' }}">
								First Name
								<input type="text" name="first_name" placeholder="First" value="{{ old('first_name') }}" required>
								@foreach ($errors->get('first_name') as $error)
									<span class="form-error is-visible">
										{{ $error }}
									</span>
								@endforeach
							</label>
						</div>
					</div>

					<div class="row">
						<div class="column medium-6">
							<label class="{{ ($errors->has('last_name')) ? 'is-invalid-label' : '' }}">
								Last Name
								<input type="text" name="last_name" placeholder="Last" value="{{ old('last_name') }}" required>
								@foreach ($errors->get('last_name') as $error)
									<span class="form-error is-visible">
										{{ $error }}
									</span>
								@endforeach
							</label>
						</div>
					</div>

					<div class="row">
						<div class="column medium-6">
							<label class="{{ ($errors->has('email')) ? 'is-invalid-label' : '' }}">
								Email Address
								<input type="email" name="email" placeholder="email@website.com" value="{{ old('email') }}" required>
								@foreach ($errors->get('email') as $error)
									<span class="form-error is-visible">
										{{ $error }}
									</span>
								@endforeach
							</label>
						</div>
					</div>

					<div class="row">
						<div class="column medium-6">
							<label class="{{ ($errors->has('password')) ? 'is-invalid-label' : '' }}">
								Password
								<input type="password" name="password" placeholder="Password" required>
								@foreach ($errors->get('password') as $error)
									<span class="form-error is-visible">
										{{ $error }}
									</span>
								@endforeach
							</label>
						</div>
					</div>

					<div class="row">
						<div class="column small-12">
							<button type="submit" class="button">
								Register
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection
