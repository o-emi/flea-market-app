@extends('layouts.login_register')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
@endsection

@section('content')
<div class="profile-setting-form">
    <h2 class="profile-setting-form__heading content__heading">会員登録</h2>
    <div class="profile-setting-form__inner">
        <form class="profile-setting-form__form" action="{{ route('register') }}" method="post" novalidate>
            @csrf

            <div class="profile-setting-form__group">
                <label class="profile-setting-form__label" for="name">ユーザー名</label>
                <input class="profile-setting-form__input" type="text" name="name" id="name" value="{{ old('name') }}">
                <p class="profile-setting-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-setting-form__group">
                <label class="profile-setting-form__label" for="email">メールアドレス</label>
                <input class="profile-setting-form__input" type="email" name="email" value="{{ old('email') }}">
                <p class="profile-setting-form__error-message">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-setting-form__group">
                <label class="profile-setting-form__label" for="password">パスワード</label>
                <input class="profile-setting-form__input" type="password" name="password" id="password">
                <p class="profile-setting-form__error-message">
                    @if($errors->has('password') && $errors->first('password') !== 'パスワードと一致しません')
                        {{ $errors->first('password') }}
                    @endif
                </p>
            </div>

            <div class="profile-setting-form__group">
                <label class="profile-setting-form__label" for="password_confirmation">確認パスワード</label>
                <input class="profile-setting-form__input" type="password" name="password_confirmation" id="password_confirmation">
                <p class="profile-setting-form__error-message">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror

                    @if($errors->has('password') && $errors->first('password') === 'パスワードと一致しません')
                        {{ $errors->first('password') }}
                    @endif
                </p>
            </div>

            <input class="profile-setting-form__btn btn" type="submit" value="登録する">
        </form>

        <div class="login-link-area">
            <a href="/login" class="login-link">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection