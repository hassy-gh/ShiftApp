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
          <form method="POST" action="{{ route('admin.group.edit-profile', $group->group_name) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $group->id }}">

            <div class="row mb-3">
              <label for="group_name" class="col-md-4 col-form-label text-md-end">{{ __('Group ID') }}</label>

              <div class="col-md-6">
                <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror"
                  name="group_name" value="{{ old('group_name', $group->group_name) }}" autocomplete="group_name"
                  autofocus>

                @error('group_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @else
                <span class="form-text">3〜16文字の半角英数記号（ハイフン"-"、アンダーバー"_"）</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Group Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name', $group->name) }}" autocomplete="name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="phone_number"
                class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}（グループ）</label>

              <div class="col-md-6">
                <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                  name="phone_number" value="{{ old('phone_number', $group->phone_number) }}" placeholder="01-2345-6789"
                  autocomplete="phone_number">

                @error('phone_number')
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