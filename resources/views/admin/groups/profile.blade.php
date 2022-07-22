@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center text-secondary mb-3">
        {{ $group->name }}
      </h2>
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-4 text-md-end">
              <h5>{{ __('Group ID') }}</h5>
            </div>

            <div class="col-md-6 border-bottom">
              <p>{{ $group->group_name }}</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4 text-md-end">
              <h5>{{ __('Phone Number') }}</h5>
            </div>

            <div class="col-md-6 border-bottom">
              <p>{{ $group->phone_number }}</p>
            </div>
          </div>
          @foreach($group->admins as $key => $admin)
          <div class="row mb-3">
            @if($key == 0)
            <div class="col-md-4 text-md-end">
              <h5>{{ __('Administrator') }}</h5>
            </div>
            @else
            <div class="col-md-4"></div>
            @endif

            <div class="col-md-6 border-bottom">
              <p>

                {{ $admin->last_name . ' ' . $admin->first_name }}
              </p>
            </div>
          </div>
          @endforeach

          <div class="d-flex justify-content-end">
            <a href="{{ route('admin.group.edit-profile', $group->group_name) }}" class="btn btn-outline-primary">
              プロフィールを編集する
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection