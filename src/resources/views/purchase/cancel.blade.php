@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/result.css') }}">
@endsection

@section('content')
<div class="purchase-result">
    <h1 class="purchase-result__title">購入をキャンセルしました</h1>
    <a href="{{ route('items.index') }}" class="purchase-result__link">商品一覧へ戻る</a>
</div>
@endsection