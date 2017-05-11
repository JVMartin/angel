@extends('emails.template')

@section('content')
  <h1>New User Registration</h1>
  <p>
    <a href="{{ route('admin.users.show', $user->hash) }}">
      Click here to view the new user.
    </a>
  </p>
@endsection
