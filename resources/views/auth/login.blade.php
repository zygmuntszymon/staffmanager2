@extends('layouts.guest')

@section('title','Logowanie')

@section('content')
  @if (session('status'))
    <div class="status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email"
             value="{{ old('email') }}" required autofocus>
      @error('email') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="password">Hasło</label>
      <input id="password" type="password" name="password" required>
      @error('password') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-checkbox">
      <input id="remember_me" type="checkbox" name="remember">
      <span>Zapamiętaj mnie</span>
    </div>

    <button type="submit" class="btn">Zaloguj</button>

    <div class="links">
      <a href="{{ route('register') }}">Zarejestruj się</a>
    </div>
  </form>
@endsection
