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
      <h1 class="mypage-form__user-name">ユーザー名</h1>
      <div class="mypage-form__action">
        <a href="{{ route('mypage.profile') }}" class="mypage-form__edit-button">
        プロフィールを編集
        </a>

      </div>
    </section>

    <nav class="mypage-form__tabs">
      <ul class="mypage-form__tab-list">
        <li class="mypage-form__tab-item mypage-form__tab-item--active">出品した商品</li>
        <li class="mypage-form__tab-item">購入した商品</li>
      </ul>
    </nav>

    <section class="mypage-form__content">
      <div class="mypage-form__grid">
        @forelse ($purchasedItems as $item)
          <article class="mypage-form__product-card">
            <div class="mypage-form__product-image">
              <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}">
            </div>
            <p class="mypage-form__product-name">{{ $item->name }}</p>
          </article>
        @empty
          <p>購入した商品はありません</p>
        @endforelse
      </div>
    </section>

  </div>
</div>
@endsection