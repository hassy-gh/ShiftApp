@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        グループに参加しよう。
      </h2>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('employee.group.join') }}">
            @csrf

            <div class="row mb-3">
              <label for="group_name" class="col-md-4 col-form-label text-md-end">
                {{ __('Group ID') }}
              </label>

              <div class="col-md-6">
                <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror"
                  name="group_name" value="{{ old('group_name') }}" autocomplete="group_name" autofocus>

                @error('group_name')
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

                <span class="form-text">パスワードがわからない方はグループの管理者に問い合わせてください。</span>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary w-100">
                  グループに{{ __('Join') }}する
                </button>
              </div>
            </div>
          </form>
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