@extends('layouts.app')

@section('title', '商品詳細画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/detail.css')}}">
@endsection

@section('content')
<div class="item-detail-form">
  <div class="item-detail-form__inner">

    <div class="item-detail-form__image-wrapper">
      <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="item-detail-form__image">
    </div>

    <div class="item-detail-form__content">

      <section class="item-detail-form__header">
        <h1 class="item-detail-form__name">{{ $item->name }}</h1>
        <p class="item-detail-form__brand">{{ $item->brand }}</p>

        <div class="item-detail-form__price-group">
          <span class="item-detail-form__price">¥{{ number_format($item->price) }}</span>
          <span class="item-detail-form__tax">(税込)</span>
        </div>

        <div class="item-detail-form__actions">
          <div class="item-detail-form__action-item">
            @auth
              <form action="{{ route('items.like', $item) }}" method="POST" class="item-detail-form__like-form">
                @csrf
                <button type="submit" class="item-detail-form__icon-btn">
                  <img src="{{ asset(auth()->user()->likes()->where('item_id', $item->id)->exists() ? 'images/logo/heart.logo.pink.png' : 'images/logo/heart.logo.gray.png') }}" class="item-detail-form__icon" alt="いいね">
                </button>
              </form>
            @endauth
            @guest
              <img src="{{ asset('images/logo/heart.logo.gray.png') }}" class="item-detail-form__icon" alt="いいね">
            @endguest
            <span class="item-detail-form__count">{{ $item->likes()->count() }}</span>
          </div>

          <div class="item-detail-form__action-item">
            <img src="{{ asset('images/logo/comment.png') }}" class="item-detail-form__icon" alt="コメント">
            <span class="item-detail-form__count">{{ $item->comments->count() }}</span>
          </div>
        </div>

        <a href="{{ route('purchase.index', $item) }}" class="item-detail-form__btn item-detail-form__btn--primary">
          購入手続きへ
        </a>
      </section>

      <section class="item-detail-form__section">
        <h2 class="item-detail-form__section-title">商品説明</h2>
        <div class="item-detail-form__description">
          {{ $item->description }}
        </div>
      </section>

      <section class="item-detail-form__section">
        <h2 class="item-detail-form__section-title">商品の情報</h2>
        <table class="item-detail-form__table">
          <tr>
            <th class="item-detail-form__table-header">カテゴリー</th>
            <td class="item-detail-form__table-data">
              <span class="item-detail-form__badge">洋服</span>
              <span class="item-detail-form__badge">メンズ</span>
            </td>
          </tr>
          <tr>
            <th class="item-detail-form__table-header">商品の状態</th>
            <td class="item-detail-form__table-data">{{ $item->condition }}</td>
          </tr>
        </table>
      </section>

      <section class="item-detail-form__section">
        <h2 class="item-detail-form__section-title">コメント（{{ $item->comments->count() }}）</h2>
        <div class="item-detail-form__comment-list">
          @foreach ($item->comments as $comment)
            <article class="item-detail-form__comment">
              <div class="item-detail-form__comment-user">
                <div class="item-detail-form__comment-avatar"></div>
                <span class="item-detail-form__comment-username">{{ $comment->user->name }}</span>
              </div>
              <div class="item-detail-form__comment-body">{{ $comment->comment }}</div>
            </article>
          @endforeach
        </div>

        <div class="item-detail-form__comment-post">
          <h3 class="item-detail-form__sub-title">商品へのコメント</h3>

          @auth
            <form action="{{ route('comments.store', $item) }}" method="POST">
              @csrf

              <textarea name="comment" class="item-detail-form__textarea">{{ old('comment') }}</textarea>


              @error('comment')
                <div class="error">{{ $message }}</div>
              @enderror


              <button class="item-detail-form__btn item-detail-form__btn--primary">コメントを送信する
              </button>
            </form>
          @else
            <p class="item-detail-form__login-notice">コメントを投稿するにはログインしてください</p>
          @endauth
        </div>
    </div>
  </div>
</div>
@endsection
