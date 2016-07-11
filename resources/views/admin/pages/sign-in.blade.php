@extends('admin.template')

@section('title', 'Sign In')

@section('meta')
@endsection

@section('content')
<section id="pagesSignIn">
	<div class="row">
		<div class="small-12 medium-6 medium-offset-3 columns text-center">
			<h1>
				Sign In
			</h1>
			<form method="POST" action="/auth/login">
				{!! csrf_field() !!}

				<div>
					<input type="email" class="custom" name="email" value="{{ old('email') }}" placeholder="email address" autofocus>
				</div>
				<div>
					<input type="password" class="custom" name="password" id="password" placeholder="password">
				</div>
				<div class="text-left">
					<label>
						<input type="checkbox" name="remember">
						Remember Me
					</label>
				</div>
				<div class="row signInWrap">
					<div class="small-12 medium-6 column">
						<button type="submit" class="alert radius">
							SIGN IN
						</button>
					</div>
					<div class="small-12 medium-6 column text-left">
						<a href="/password/email">
							forgot username or password?
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection