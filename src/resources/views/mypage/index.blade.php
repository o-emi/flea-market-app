@extends('layouts.app')

@section('title', 'プロフィール画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/index.css')}}">
@endsection

@section('content')
<div class="mypage-form">
  <div class="mypage-form__container">

    <section class="mypage-form__user-info">
      <div class="mypage-form__avatar-wrapper">
        <div class="mypage-form__avatar"></div>
      </div>
      <h1 class="mypage-form__user-name">{{ $user->name }}</h1>
      <div class="mypage-form__action">
        <a href="{{ route('mypage.profile') }}" class="mypage-form__edit-button">
        プロフィールを編集
        </a>

      </div>
    </section>

    <nav class="mypage-form__tabs">
      <ul class="mypage-form__tab-list">
        <li class="mypage-form__tab-item {{ $page === 'sell' ? 'mypage-form__tab-item--active' : '' }}">
          <a href="{{ route('mypage.index', ['page' => 'sell']) }}">出品した商品</a>
        </li>
        <li class="mypage-form__tab-item {{ $page === 'buy' ? 'mypage-form__tab-item--active' : '' }}">
          <a href="{{ route('mypage.index', ['page' => 'buy']) }}">購入した商品</a>
        </li>
      </ul>
    </nav>

    <section class="mypage-form__content">

      @if ($page === 'sell')
        <div class="mypage-form__grid">
          @forelse ($sellItems as $item)
            <article class="mypage-form__product-card">
              <div class="mypage-form__product-image">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
              </div>
              <p class="mypage-form__product-name">{{ $item->name }}</p>
            </article>
          @empty
            <p>出品した商品はありません</p>
          @endforelse
        </div>

      @elseif ($page === 'buy')
        <div class="mypage-form__grid">
          @forelse ($purchasedItems as $item)
            <article class="mypage-form__product-card">
              <div class="mypage-form__product-image">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
              </div>
              <p class="mypage-form__product-name">{{ $item->name }}</p>
            </article>
          @empty
            <p>購入した商品はありません</p>
          @endforelse
        </div>
      @endif

    </section>

  </div>
</div>
@endsection