@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        管理者を追加
      </h2>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.group.add-admin-email') }}">
            @csrf

            <div class="row mb-3">
              <label for="email_or_admin_name" class="col-md-4 col-form-label text-md-end">
                新規管理者の{{ __('Email Address') }}
              </label>

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

            <div class="row mb-3">
              <label for="group" class="col-md-4 col-form-label text-md-end">{{ __('Group') }}</label>

              <div class="col-md-6">
                <select id="group" class="form-select @error('group_id') is-invalid @enderror" name="group_id">
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
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary w-100">
                  メールを送信する
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