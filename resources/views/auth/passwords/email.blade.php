@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center mb-3">{{ __('Reset Password') }}</h2>
      <div class="card">
        <div class="card-body">
          @if (session('status'))
          <p class="text-center my-3"><strong class="mt-3">{{ session('status') }}</strong></p>
          <p class="text-center mb-3">
            <a href="{{ url('/') }}" class="link-primary">トップページに戻る</a>
          </p>
          @else

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <div class="d-flex justify-content-end">
                  <a href="{{ route('login') }}" class="btn btn-light">
                    キャンセル
                  </a>
                  <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                  </button>
                </div>
              </div>
            </div>
          </form>
          @endif
        </div>
      </div>

      <div class="mt-3 mt-md-5">
        <h1 class="text-center text-md-start">
          <a class="text-primary text-decoration-none" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </h1>
      </div>
    </div>
  </div>
</div>
@endsection