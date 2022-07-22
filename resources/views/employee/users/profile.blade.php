@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        {{ $employee->last_name . ' ' . $employee->first_name }}
      </h2>
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-4 text-md-end">
              <h5>{{ __('User Name') }}</h5>
            </div>

            <div class="col-md-6 border-bottom">
              <p>{{ $employee->user_name }}</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4 text-md-end">
              <h5>{{ __('Email Address') }}</h5>
            </div>

            <div class="col-md-6 border-bottom">
              <p>{{ $employee->email }}</p>
            </div>
          </div>
          @foreach($groups as $key => $group)
          <div class="row mb-3">
            @if($key == 0)
            <div class="col-md-4 text-md-end">
              <h5>グループ</h5>
            </div>
            @else
            <div class="col-md-4"></div>
            @endif

            <div class="col-md-6 border-bottom">
              <p>
                <a class="text-decoration-none" href="{{ route('employee.group.profile', $group->group_name) }}">
                  {{ $group->name }}
                </a>
              </p>
            </div>
          </div>
          @endforeach

          <div class="d-flex justify-content-end">
            <a href="{{ route('employee.user.edit-profile', $employee->user_name) }}" class="btn btn-outline-primary">
              プロフィールを編集する
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection