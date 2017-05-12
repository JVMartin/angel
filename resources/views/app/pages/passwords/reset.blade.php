@extends('app.template')

@section('content')
	<div class="row">
		<div class="column medium-8 medium-offset-2">
			<h1>Reset Password</h1>
			<form role="form" method="POST">
				{{ csrf_field() }}

				<input type="hidden" name="token" value="{{ $token }}">

				<label class="{{ ($errors->has('email')) ? 'is-invalid-label' : '' }}">
					Email
					<input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
					@foreach ($errors->get('email') as $error)
						<span class="form-error is-visible">
							{{ $error }}
						</span>
					@endforeach
				</label>

				<label class="{{ ($errors->has('password')) ? 'is-invalid-label' : '' }}">
					Password
					<input type="password" name="password" placeholder="Password" required>
					@foreach ($errors->get('password') as $error)
						<span class="form-error is-visible">
							{{ $error }}
						</span>
					@endforeach
				</label>

				<label class="{{ ($errors->has('password_confirmation')) ? 'is-invalid-label' : '' }}">
					Confirm Password
					<input type="password" name="password_confirmation" placeholder="Confirm Password" required>
					@foreach ($errors->get('password_confirmation') as $error)
						<span class="form-error is-visible">
							{{ $error }}
						</span>
					@endforeach
				</label>

				<div class="row column">
					<button type="submit" class="button">
						Reset Password
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection
