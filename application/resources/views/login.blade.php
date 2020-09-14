@extends('layouts.login')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="h3 mb-3 font-weight-normal">ユーザーログイン</h1>

        <label for="email" class="sr-only">メールアドレス</label>
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password" class="sr-only">パスワード</label>
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input type="checkbox" name="keep" value="on">ログイン維持
        <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
        <br>
        <p id="button">
        <a href="http://localhost/register"> 新規登録 </a>
        </p>
        <p id="button">
        <a href="http://localhost/password/reset"> パスワードリセット </a>
        </p>
    </form>
@endsection
