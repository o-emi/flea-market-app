@extends('layouts.app')

@section('title', '商品の出品画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/create.css')}}">
@endsection

@section('content')
<div class="item-exhibition-form">
    <h2 class="page-title">商品の出品</h2>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品画像</h3>
            <div class="image-upload-area">
                <label class="image-upload-btn">
                    画像を選択する
                    <input type="file" name="item_image" style="display:none;">
                </label>
            </div>
        </section>

        <div class="item-exhibition-form__section-title">商品の詳細</div>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">カテゴリー</h3>
            <div class="category-group">
                @php
                    $categories = ['ファッション', '家電', 'インテリア', 'レディース', 'メンズ', 'コスメ', '本', 'ゲーム', 'スポーツ', 'キッチン', 'ハンドメイド', 'アクセサリー', 'おもちゃ', 'ベビー・キッズ'];
                @endphp
                @foreach($categories as $category)
                    <label class="category-label">
                        <input type="checkbox" name="categories[]" value="{{ $category }}">
                        <span>{{ $category }}</span>
                    </label>
                @endforeach
            </div>
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品の状態</h3>
            <div class="select-wrapper">
                <select name="condition">
                    <option value="" selected disabled>選択してください</option>
                    <option value="1">新品、未使用</option>
                    <option value="2">未使用に近い</option>
                    <option value="3">目立った傷や汚れなし</option>
                </select>
            </div>
        </section>

        <div class="item-exhibition-form__section-title">商品名と説明</div>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品名</h3>
            <input type="text" name="name" class="form-input">
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">ブランド名</h3>
            <input type="text" name="brand" class="form-input">
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品の説明</h3>
            <textarea name="description" rows="5" class="form-textarea"></textarea>
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">販売価格</h3>
            <div class="price-input-wrapper">
                <span class="currency">¥</span>
                <input type="number" name="price" class="form-input">
            </div>
        </section>

        <div class="item-exhibition-form-submit">
            <button type="submit" class="submit-btn">出品する</button>
        </div>
    </form>
</div>
@endsection