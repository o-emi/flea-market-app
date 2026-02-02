@extends('layouts.app')

@section('title', '商品一覧画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/index.css')}}">
@endsection

@section('content')
<div class="item-index-form">

    <div class="item-index-form__tabs">
        <a href="{{ route('items.index', [
            'keyword' => request('keyword')
        ]) }}"
        class="tab {{ request('tab') !== 'mylist' ? 'tab--active' : '' }}">
            おすすめ
        </a>

        <a href="{{ route('items.index', [
            'tab' => 'mylist',
            'keyword' => request('keyword')
        ]) }}"
        class="tab {{ request('tab') === 'mylist' ? 'tab--active' : '' }}">
            マイリスト
        </a>
    </div>

    <div class="item-index-form__grid">
        @foreach ($items as $item)
            <div class="item-index-form-card">
                <div class="item-index-form-card__image">
                    <a href="{{ route('items.show', $item) }}">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                    </a>

                    @if ($item->is_sold)
                        <span class="item-index-form-card__sold">Sold</span>
                    @endif
                </div>

                <p class="item-index-form-card__name">{{ $item->name }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection