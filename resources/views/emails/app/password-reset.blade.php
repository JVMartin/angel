@extends('emails.template')

@section('content')
  <h1>Password Reset</h1>
  <p>
    You are receiving this email because we received a password reset request for your account.
  </p>
  <p>
    <a href="{{ $link }}">
      Reset Password
    </a>
  </p>
  <p>
    If you did not request a password reset, no further action is required.
  </p>
@endsection
