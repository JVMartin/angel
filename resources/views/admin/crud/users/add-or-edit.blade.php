@extends('admin.template')

@section('title')
  {{ ucfirst($action) . ' ' . $repository->getSingular() }}
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
  @if ($action == 'edit')
    <div class="reveal" id="changesModal" data-reveal>
      <div id="changesModalContent"></div>
      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <section id="crudAddOrEdit">
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
    <div class="row">
      <div class="column small-12">
        <h1>{{ ucfirst($action) . ' ' . $repository->getSingular() }}</h1>
      </div>
    </div>
    <div class="row">
      <div class="column medium-6">
        @if ($action == 'edit')
          {!! Form::model($model) !!}
        @elseif ($action == 'add')
          {!! Form::open() !!}
        @endif
          @if ($action == 'edit')
            <h3>Update Details</h3>
          @endif
          @php
            $cols = $repository->getCols();

            // Don't include CRD in columns on the left side of the edit page..
            if ($action == 'edit') {
              unset($cols['crd']);
            }
          @endphp
          @include('admin.crud._cols', ['cols' => $cols])
          @if ($action == 'add')
            @include('admin.crud.users._password-info')
            <label class="{{ ($errors->has('password')) ? 'is-invalid-label' : '' }}">
              Password
              <input type="password" name="password" placeholder="Password" class="{{ ($errors->has('password')) ? 'is-invalid-input' : '' }}" required>
              @foreach ($errors->get('password') as $error)
                <span class="form-error is-visible">
                  {!! $error !!}
                </span>
              @endforeach
            </label>
            <label>
              Confirm Password
              <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </label>
          @endif
          <div class="row">
            <div class="columns small-12">
              <button type="submit" class="button small">
                Save
              </button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
      <div class="column medium-6">
        @if ($action == 'edit')
          <form action="{{ route('admin.users.edit.crd', $model->hash) }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div class="row column">
              <h3>Update CRD or Registered Agent #</h3>
              <label class="{{ ($errors->has('crd')) ? 'is-invalid-label' : '' }}">
                CRD
                <input type="text" name="crd" placeholder="CRD" value="{{ old('crd', $model->crd) }}" class="{{ ($errors->has('crd')) ? 'is-invalid-input' : '' }}">
                @foreach ($errors->get('crd') as $error)
                  <span class="form-error is-visible">
                    {!! $error !!}
                  </span>
                @endforeach
              </label>
              <button type="submit" class="button small">
                Update CRD
              </button>
            </div>
          </form>
          <form action="{{ route('admin.users.edit.password', $model->hash) }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div class="row column">
              <h3>Update Password</h3>
              @include('admin.crud.users._password-info')
              <label class="{{ ($errors->has('password')) ? 'is-invalid-label' : '' }}">
                New Password
                <input type="password" name="password" placeholder="New Password" class="{{ ($errors->has('password')) ? 'is-invalid-input' : '' }}" required>
                @foreach ($errors->get('password') as $error)
                  <span class="form-error is-visible">
                    {!! $error !!}
                  </span>
                @endforeach
              </label>
              <label>
                Confirm New Password
                <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>
              </label>
              <button type="submit" class="button small">
                Update Password
              </button>
            </div>
          </form>
        @endif
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
