<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH App')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">

    @yield('css')
</head>
<body>
  <div class="app">
    <header class="header">
      <img src="{{ asset('images/COACHTECH.png') }}" alt="COACHTECH ロゴ">

      <nav class="navigation">
        <div class="search-form">
          <input type="text" placeholder="なにをお探しですか?">
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="nav-link-btn">ログアウト</button>
        </form>
        <a href="{{ route('mypage_profile') }}" class="nav-link">マイページ</a>
        <button class="primary-btn">出品</button>
      </nav>
    </header>

  <div class="content">
  @yield('content')
    </div>
  </div>
</body>
</html>