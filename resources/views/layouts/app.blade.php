<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <h1 class="text-primary">{{ config('app.name') }}</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
          aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="#">機能</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">使い方</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Q&A</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('admin.login') }}">管理者の方</a>
            </li>
            @else
            @auth('admin')
            <li class="nav-item">
              <a href="" class="nav-link">シフト作成</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.group.register') }}" class="nav-link">グループ作成</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">管理者追加</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">アカウント設定</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">{{ Auth::user()->last_name . Auth::user()->first_name; }}</a>
            </li>
            @else
            <li class="nav-item">
              <a href="" class="nav-link">シフト提出</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.group.join') }}" class="nav-link"></a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">アカウント設定</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">{{ Auth::user()->last_name . Auth::user()->first_name; }}</a>
            </li>
            @endauth
            @endguest
          </ul>
          @guest
          <a href="{{ route('login') }}" class="btn btn-light mx-3">ログイン</a>
          <a href="{{ route('register') }}" class="btn btn-primary">会員登録</a>
          @else
          <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
          @endguest
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>