@extends('layouts.app')

@section('css')
@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/result.css') }}?{{ time() }}">
@endsection

@section('content')
<div class="purchase-result">
    <h1 class="purchase-result__title">購入が完了しました</h1>
    <a href="{{ route('mypage.index') }}" class="purchase-result__link">マイページへ</a>
</div>
@endsection
