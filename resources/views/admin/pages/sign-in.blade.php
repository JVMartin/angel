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
			<form method="POST" action="/admin/sign-in">
				{!! csrf_field() !!}
				<div class="row">
					<div class="small-12 columns">
						<label>
							email address
							<input type="email" class="custom" name="email" value="{{ old('email') }}" placeholder="email address" autofocus>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 columns">
						<label>
							password
							<input type="password" class="custom" name="password" id="password" placeholder="password">
						</label>
					</div>
				</div>
				<div class="row">
					<div class="small-12 columns">
						<label>
							<input type="checkbox" name="remember">
							Remember Me
						</label>
					</div>
				</div>
				<div class="row signInWrap">
					<div class="small-12 medium-6 column">
						<button type="submit" class="button">
							SIGN IN
						</button>
					</div>
					{{--
					<div class="small-12 medium-6 column">
						<a href="/password/email">
							forgot username or password?
						</a>
					</div>
					--}}
				</div>
			</form>
		</div>
	</div>
</section>
@endsection