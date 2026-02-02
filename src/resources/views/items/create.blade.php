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

            @error('item_image')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </section>

        <div class="item-exhibition-form__section-title">商品の詳細</div>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">カテゴリー</h3>

            <div class="category-group">
                @foreach($categories as $category)
                    <label class="category-label">
                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                >
                        <span>{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>

            @error('categories')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品の状態</h3>
            <div class="select-wrapper">
                <select name="condition" required>
                    <option value="良好" {{ old('condition') === '良好' ? 'selected' : '' }}>良好</option>
                    <option value="目立った傷や汚れなし" {{ old('condition') === '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり" {{ old('condition') === 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                    <option value="状態が悪い" {{ old('condition') === '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
                </select>

                @error('condition')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <div class="item-exhibition-form__section-title">商品名と説明</div>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品名</h3>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}">

            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">ブランド名</h3>
            <input type="text" name="brand" class="form-input" value="{{ old('brand') }}">
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">商品の説明</h3>
            <textarea name="description" rows="5" class="form-textarea">{{ old('description') }}</textarea>


            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </section>

        <section class="item-exhibition-form-section">
            <h3 class="section-label">販売価格</h3>
            <div class="price-input-wrapper">
                <span class="currency">¥</span>
                <input type="number" name="price" class="form-input" value="{{ old('price') }}">
            </div>

            @error('price')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </section>

        <div class="item-exhibition-form-submit">
            <button type="submit" class="submit-btn">出品する</button>
        </div>
    </form>
</div>
@endsection