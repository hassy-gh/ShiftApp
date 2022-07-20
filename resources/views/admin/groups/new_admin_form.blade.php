@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        管理者を新規作成
      </h2>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.group.new-admin') }}">
            @csrf

            <div class="row mb-3">
              <label for="group" class="col-md-4 col-form-label text-md-end">{{ __('Group') }}</label>

              <div class="col-md-6">
                <select id="group" class="form-select @error('group_id') is-invalid @enderror" name="group_id"
                  autofocus>
                  <option value="" hidden>--グループを選択してください--</option>
                  @foreach($groups as $group)
                  <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}
                  </option>
                  @endforeach
                </select>

                @error('group_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="admin_name" class="col-md-4 col-form-label text-md-end">{{ __('Admin Name') }}</label>

              <div class="col-md-6">
                <input id="admin_name" type="text" class="form-control @error('admin_name') is-invalid @enderror"
                  name="admin_name" value="{{ old('admin_name') }}" autocomplete="admin_name">

                @error('admin_name')
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
                    name="last_name" value="{{ old('last_name') }}" placeholder="姓" autocomplete="last_name">
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name') }}" placeholder="名" autocomplete="first_name">
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
                  value="{{ old('email') }}" placeholder="mail@example.com" autocomplete="email">

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
                <p class="form-text">※パスワードは自動生成されます</p>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary w-100">
                  管理者を登録する
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