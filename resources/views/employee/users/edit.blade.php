@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        プロフィール編集
      </h2>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('employee.user.edit-profile', $employee->user_name) }}">
            @csrf

            <div class="row mb-3">
              <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

              <div class="col-md-6">
                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror"
                  name="user_name" value="{{ old('user_name', $employee->user_name) }}" autocomplete="user_name"
                  autofocus>

                @error('user_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @else
                <span class="form-text">3〜16文字の半角英数記号（ハイフン"-"、アンダーバー"_"）</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
              <div class="col-md-6">
                <div class="input-group">
                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                    name="last_name" value="{{ old('last_name', $employee->last_name) }}" placeholder="姓"
                    autocomplete="last_name">
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name', $employee->first_name) }}" placeholder="名"
                    autocomplete="first_name">
                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email', $employee->email) }}" placeholder="mail@example.com" autocomplete="email">

                @error('email')
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
                  name="password" autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @else
                <span class="form-text">8文字以上の半角英数字</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="password-confirm"
                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password"
                  class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                  autocomplete="new-password">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary w-100">
                  保存する
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection