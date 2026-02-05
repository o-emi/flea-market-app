@extends('layouts.app')

@section('css')
@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/result.css') }}?{{ time() }}">
@endsection

@section('content')
<div class="purchase-result">
    <h1 class="purchase-result__title">購入が完了しました</h1>
    <a href="{{ route('items.index') }}" class="purchase-result__link">商品一覧へ</a>
</div>
@endsection
