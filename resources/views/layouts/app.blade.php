<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

    :root {
      --primary-bg: #1e2124;
      --secondary-bg: #282b30;
      --tertiary-bg: #25262B;
      --header-bg: #1e2124;
      --modal-bg: #313338;
      --text-color: #fff;
      --accent-color: #ffffff;
      --border-color: #36393e;
      --button-bg: #ffffff;
      --button-color: #000;
      --button-hover: #ddd;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: var(--primary-bg);
      font-family: "Roboto", sans-serif;
      color: var(--text-color);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: var(--header-bg);
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--border-color);
      flex-shrink: 0;
    }

    header .logo {
      height: 52px;
      margin-right: 1rem;
    }

    header a,
    header span {
      color: var(--text-color);
      margin-right: 2rem;
      text-decoration: none;
      font-size: 1.2rem;
      transition: all 0.2s;
    }

    header span:nth-child(2) {
      color: gold;
    }

    header a:hover {
      color: #aaa;
    }

    main {
      padding: 2rem;
      flex-grow: 1;
    }

    .section {
      background: var(--secondary-bg);
      padding: 1.5rem;
      margin-bottom: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    button,
    input,
    select,
    textarea {
      background: var(--tertiary-bg);
      border: 1px solid var(--border-color);
      border-radius: 4px;
      color: var(--text-color);
      padding: 0.75rem;
      font-size: 1rem;
      transition: all 0.2s;
    }

    button {
      background: var(--button-bg);
      color: var(--button-color);
      cursor: pointer;
      border-radius: 4px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    button:hover {
      background: var(--button-hover);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1rem;
      border-radius: 4px;
      overflow: hidden;
    }

    th,
    td {
      border: 1px solid var(--border-color);
      padding: 0.75rem;
      background: var(--tertiary-bg);
      text-align: left;
    }

    th {
      background: var(--modal-bg);
      font-weight: 500;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .modal.open {
      display: flex;
    }

    .modal-content {
      background: var(--modal-bg);
      padding: 2rem;
      width: 90%;
      max-width: 600px;
      border-radius: 8px;
      position: relative;
    }

    .modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      color: var(--text-color);
      font-size: 1.5rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      transition: background 0.2s;
    }

    .modal-close:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .modal-content h2 {
      margin-top: 0;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.75rem;
      background: var(--tertiary-bg);
      color: var(--text-color);
      border: 1px solid var(--border-color);
      border-radius: 4px;
    }

    .button-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--tertiary-bg);
      padding: 0.75rem 1.5rem;
      text-decoration: none;
      color: var(--text-color);
      border-radius: 4px;
      font-weight: 500;
      transition: background 0.2s;
    }

    .button-link:hover {
      background: var(--modal-bg);
    }

    .form-button {
      text-align: center;
      margin-top: 1.5rem;
    }

    .form-button button {
      padding: 0.75rem 2rem;
      font-size: 1rem;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem 0.5rem;
      }

      header > div {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
      }

      header a,
      header span {
        margin: 0.5rem;
      }

      main {
        padding: 1rem;
      }

      .section {
        padding: 1rem;
      }

      table {
        font-size: 0.9rem;
      }

      th,
      td {
        padding: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div style="display:flex; align-items:center; flex-wrap: wrap;">
      <a href="{{ route('dashboard') }}">
        <img src="{{ asset('logo.png') }}" class="logo" alt="Logo">
      </a>
      @if(auth()->user()->role === 'employee')
        <span><i class="fa-solid fa-coins"></i> {{ auth()->user()->points }}</span>
        <a href="{{ route('redemptions.index') }}"><i class="fa-solid fa-gift"></i> Benefity</a>
        <a href="{{ route('leaves.index') }}"><i class="fa-solid fa-umbrella-beach"></i> Urlopy</a>
      @else
        <a href="{{ route('leaves.index') }}"><i class="fa-solid fa-umbrella-beach"></i> Urlopy</a>
      @endif
    </div>
    <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
      <span>{{ auth()->user()->name }} ({{ auth()->user()->role === 'employee' ? 'Pracownik' : 'Pracodawca' }})</span>
      <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Wyloguj</button>
      </form>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>
