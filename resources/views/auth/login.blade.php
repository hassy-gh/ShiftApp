@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        <span class="text-primary">{{ config('app.name') }}</span>にログイン
      </h2>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
              <label for="email_or_user_name" class="col-md-4 col-form-label text-md-end">
                {{ __('Email Address') }}または{{ __('User Name') }}
              </label>

              <div class="col-md-6">
                <input id="email_or_user_name" type="text"
                  class="form-control @error('email_or_user_name') is-invalid @enderror" name="email_or_user_name"
                  value="{{ old('email_or_user_name') }}" autocomplete="email_or_user_name" autofocus>

                @error('email_or_user_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label form-text" for="remember">
                    {{ __('Remember Me Front') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary w-100">
                  従業員として{{ __('Login') }}
                </button>
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <p class="text-end"><a href="{{ route('password.request') }}" class="link-secondary">パスワードを忘れた方</a></p>
              </div>
            </div>
          </form>
          <hr>
          <div class="d-flex justify-content-center mb-3">
            <a href="{{ route('register') }}" class="link-primary">会員登録はこちら</a>
          </div>
          <div class="d-flex justify-content-center">
            <a href="{{ route('admin.login') }}" class="link-secondary">管理者としてログイン</a>
          </div>
        </div>
      </div>

      <div class="mt-3 mt-md-5">
        <h1 class="text-center text-md-start">
          <a class="text-primary text-decoration-none" href="{{ url('/') }}">
            {{ config('app.name') }}
          </a>
        </h1>
      </div>
    </div>
  </div>
</div>
@endsection