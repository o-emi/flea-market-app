@extends('layouts.app')

@section('title', '送付先住所変更画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/address-change.css')}}">
@endsection

@section('content')
<div class="address-change-form">
  <h2 class="address-change-form__heading content__heading">プロフィール設定</h2>

  <div class="address-change-form__inner">
    <form class="address-change-form__form" action="{{ route('purchase.address.update', $item->id) }}"method="post" novalidate>
      @csrf

      <div class="address-change-form__group">
        <label class="address-change-form__label" for="postal_code">郵便番号</label>
        <input class="address-change-form__input" type="text" name="postal_code" id="postal_code">
        <p class="address-change-form__error-message">
          @error('postal_code')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="address-change-form__group">
        <label class="address-change-form__label" for="address">住所</label>
        <input class="address-change-form__input" type="text" name="address" id="address">
        <p class="address-change-form__error-message">
          @error('address')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="address-change-form__group">
        <label class="address-change-form__label" for="building_name">建物名</label>
        <input class="address-change-form__input" type="text" name="building_name" id="building_name">
        <p class="address-change-form__error-message">
          @error('building_name')
          {{ $message }}
          @enderror
        </p>
      </div>

      <input class="address-change-form__btn btn" type="submit" value="更新する">
    </form>

  </div>
</div>
@endsection