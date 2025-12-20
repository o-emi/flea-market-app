<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">

    @yield('css')
</head>
<body>
  <div class="app">
    <header class="header">
      <img src="{{ asset('images/logo/coachtech.png') }}" alt="COACHTECH ロゴ">

        <div class="search-form">
          <input type="text" placeholder="なにをお探しですか?">
        </div>

        <nav class="navigation">
          <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link-btn">ログアウト</button>
          </form>
          <a href="{{ route('mypage.profile') }}" class="nav-link">マイページ</a>
          <button class="primary-btn">出品</button>
        </nav>
    </header>

  <div class="content">
  @yield('content')
    </div>
  </div>
</body>
</html>