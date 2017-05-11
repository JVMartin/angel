@extends('admin.template')

@section('title', 'Sign In')

@section('meta')
@endsection

@section('content')
	<section id="pagesSignIn">
		<div class="row">
			<div class="small-12 medium-6 medium-offset-3 columns">
				<h1>
					Sign In
				</h1>
				<form method="POST" action="{{ url('admin/sign-in') }}" autocomplete="off">
					{!! csrf_field() !!}
					<div class="row">
						<div class="small-12 columns">
							<label for="email" class="{{ ($errors->has('email')) ? 'is-invalid-label' : '' }}">
								email address
								<input type="email" class="custom" name="email" value="{{ old('email') }}" placeholder="email address" autofocus required>
								@foreach ($errors->get('email') as $error)
									<span class="form-error is-visible">
										{!! $error !!}
									</span>
								@endforeach
							</label>
						</div>
					</div>
					<div class="row">
						<div class="small-12 columns">
							<label for="password" class="{{ ($errors->has('password')) ? 'is-invalid-label' : '' }}">
								password
								<input type="password" class="custom" name="password" id="password" placeholder="password" required>
								@foreach ($errors->get('password') as $error)
									<span class="form-error is-visible">
										{!! $error !!}
									</span>
								@endforeach
							</label>
						</div>
					</div>
					<div class="row">
						<div class="small-6 columns">
							<label>
								<input type="checkbox" name="remember">
								Remember Me
							</label>
						</div>
						<div class="small-6 columns text-right">
							<a href="{{ route('password.forgot') }}">Forgot Password?</a>
						</div>
					</div>
					<div class="row signInWrap">
						<div class="small-12 medium-6 column">
							<button type="submit" class="button">
								Sign In
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection
