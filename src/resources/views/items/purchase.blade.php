@extends('layouts.app')

@section('title', '商品購入画面')

@section('content')
  <h1>商品購入画面</h1>

  <p>商品名：{{ $item->name }}</p>
  <p>価格：¥{{ number_format($item->price) }}</p>
@endsection
