@extends('layouts.app')

@section('title', '商品購入画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/purchase.css')}}">
@endsection

@section('content')
<div class="purchase-form">
    <div class="purchase-form__container">
        <div class="purchase-form__main">
            <section class="purchase-form__product">
                <div class="purchase-form__product-img">
                    <img src="{{ asset($item->image_url) }}"alt="{{ $item->name }}">
                </div>
                <div class="purchase-form__product-info">
                    <h2>{{ $item->name }}</h2>
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </section>

            <hr class="purchase-form__divider">

            <section class="purchase-form__section">
                <h3 class="purchase-form__section-title">支払い方法</h3>
                <div class="purchase-form__input-group">
                    <select name="payment_method" id="payment-select" class="purchase-form__select">
                        <option value="" disabled selected>選択してください</option>
                        <option value="konbini">コンビニ払い</option>
                        <option value="card">クレジットカード</option>
                    </select>
                </div>
            </section>

            <hr class="purchase-form__divider">

            <section class="purchase-form__section">
                <div class="purchase-form__section-header">
                    <h3 class="purchase-form__section-title">配送先</h3>
                    <a href="#" class="purchase-form__link">変更する</a>
                </div>
                <div class="purchase-form__section-content">
                  <div class="purchase-form__address">
                      <p class="purchase-form__address-zip">〒 {{ $user->postal_code ?? '---' }}
                      </p>
                      <p class="purchase-form__address-text">{{ $user->address ?? '住所未登録' }} {{ $user->building_name ?? '' }}
                      </p>
                    </div>
                </div>
            </section>

            <hr class="purchase-form__divider">
        </div>

        <aside class="purchase-form__sidebar">
            <div class="purchase-form__summary">
                <table class="purchase-form__summary-table">
                    <tr>
                        <th>商品代金</th>
                        <td>¥ {{ number_format($item->price) }}</td>
                    </tr>
                    <tr>
                        <th>支払い方法</th>
                        <td id="payment-summary">未選択</td>
                    </tr>
                </table>
            </div>
            <form action="{{ route('purchase.store') }}" method="POST">
              @csrf
              <input type="hidden" name="item_id" value="{{ $item->id }}">

              <input type="hidden" name="payment_method" id="payment_method_hidden">
              <input type="hidden" name="address_id" value="{{ auth()->user()->id }}">
              <button type="submit" class="purchase-form__btn">購入する</button>
            </form>
        </aside>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('payment-select');
    const summary = document.getElementById('payment-summary');
    const hidden = document.getElementById('payment_method_hidden');

    select.addEventListener('change', function () {
        if (this.value === 'konbini') {
            summary.textContent = 'コンビニ払い';
            hidden.value = 'konbini';
        }

        if (this.value === 'card') {
            summary.textContent = 'クレジットカード';
            hidden.value = 'card';
        }
    });
});
</script>

@endsection