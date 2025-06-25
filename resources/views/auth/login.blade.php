@extends('layouts.guest')

@section('title','Logowanie')

@section('content')
    <h1 style="text-align:center; margin-bottom:1rem;">Logowanie</h1>
    @if (session('status'))
        <div style="background:#2ecc71; padding:0.5rem; border-radius:4px; margin-bottom:1rem; text-align:center;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Hasło</label>
        <input id="password" type="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label style="display:flex; align-items:center;">
            <input id="remember_me" type="checkbox" name="remember" style="width:auto; margin-right:0.5rem;">
            <span style="font-size:0.875rem; color:#ccc;">Zapamiętaj mnie</span>
        </label>

        <button type="submit">Zaloguj</button>

        <div style="display:flex; justify-content:space-between; margin-top:1rem;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Zapomniałeś hasła?</a>
            @endif
            <a href="{{ route('register') }}">Zarejestruj się</a>
        </div>
    </form>
@endsection
