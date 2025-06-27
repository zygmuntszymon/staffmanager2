@extends('layouts.guest')

@section('title','Rejestracja')

@section('content')
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
      <label for="name">Imię i nazwisko</label>
      <input id="name" type="text" name="name"
             value="{{ old('name') }}" required autofocus>
      @error('name') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email"
             value="{{ old('email') }}" required>
      @error('email') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="password">Hasło</label>
      <input id="password" type="password" name="password" required>
      @error('password') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="password_confirmation">Potwierdź hasło</label>
      <input id="password_confirmation" type="password"
             name="password_confirmation" required>
      @error('password_confirmation') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="role">Rola</label>
      <select id="role" name="role" required>
        <option value="employee" selected>Pracownik</option>
        <option value="employer">Pracodawca</option>
      </select>
      @error('role') <p class="error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn">Zarejestruj</button>

    <div class="links">
      <a href="{{ route('login') }}">Masz już konto? Zaloguj się</a>
    </div>
  </form>
@endsection
