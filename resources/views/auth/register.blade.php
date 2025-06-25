@extends('layouts.guest')

@section('title','Rejestracja')

@section('content')
    <h1 style="text-align:center; margin-bottom:1rem;">Rejestracja</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Imię</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Hasło</label>
        <input id="password" type="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label for="password_confirmation">Potwierdź hasło</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation') <p class="error">{{ $message }}</p> @enderror

        <label for="role">Rola</label>
        <select id="role" name="role" required>
            <option value="employee">Pracownik</option>
            <option value="employer">Pracodawca</option>
        </select>
        @error('role') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">Zarejestruj</button>

        <p style="text-align:center; margin-top:1rem;">
            <a href="{{ route('login') }}">Masz już konto? Zaloguj się</a>
        </p>
    </form>
@endsection
