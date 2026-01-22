@extends('layouts.app')

@section('title', 'プロフィール設定画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile.css')}}">
@endsection

@section('content')
<div class="profile-setting-form">
    <h2 class="profile-setting-form__heading content__heading">プロフィール設定</h2>

    <div class="profile-setting-form__inner">
      <form class="profile-setting-form__form" action="{{ route('mypage.profile.update') }}"method="post" enctype="multipart/form-data" novalidate>
      @csrf

    <div class="profile-setting-form__image-area">
        <div class="profile-setting-form__image-placeholder">
            <img src="{{ $user->profile_image_path ? asset('storage/' . $user->profile_image_path) : '#' }}"alt="プロフィール画像"
          class="profile-image">
        </div>

        <input type="file" id="profile_image_input" name="profile_image" style="display:none;">
        <label for="profile_image_input" class="profile-setting-form__image-select-btn">画像を選択する
        </label>
    </div>

      <div class="profile-setting-form__group">
        <label class="profile-setting-form__label" for="name">ユーザー名</label>
        <input class="profile-setting-form__input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        <p class="profile-setting-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="profile-setting-form__group">
        <label class="profile-setting-form__label" for="postal_code">郵便番号</label>
        <input class="profile-setting-form__input" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
        <p class="profile-setting-form__error-message">
          @error('postal_code')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="profile-setting-form__group">
        <label class="profile-setting-form__label" for="address">住所</label>
        <input class="profile-setting-form__input" type="text" name="address" id="address" value="{{ old('address', $user->address) }}">
        <p class="profile-setting-form__error-message">
          @error('address')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="profile-setting-form__group">
        <label class="profile-setting-form__label" for="building_name">建物名</label>
        <input class="profile-setting-form__input" type="text" name="building_name" id="building_name" value="{{ old('building_name', $user->building_name) }}">
        <p class="profile-setting-form__error-message">
          @error('building_name')
          {{ $message }}
          @enderror
        </p>
      </div>

      <input class="profile-setting-form__btn btn" type="submit" value="更新する">
    </form>

  </div>
</div>

@endsection