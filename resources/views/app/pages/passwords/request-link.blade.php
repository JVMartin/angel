@extends('app.template')

@section('content')
	<div class="row">
		<div class="column medium-8 medium-offset-2">
			<h1>Reset Password</h1>
			<p>Enter your email below and we will send you a password reset link.</p>
			<form role="form" method="POST">
				{{ csrf_field() }}

				<label class="{{ ($errors->has('email')) ? 'is-invalid-label' : '' }}">
					Email
					<input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
					@foreach ($errors->get('email') as $error)
						<span class="form-error is-visible">
							{{ $error }}
						</span>
					@endforeach
				</label>

				<div class="row">
					<div class="column small-12">
						<button type="submit" class="button">
							Send Password Reset Link
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
