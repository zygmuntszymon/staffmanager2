<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'StaffManager2')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

    body {
      margin: 0; padding: 0;
      background-color: #36393F;
      font-family: "Roboto", sans-serif;
      display: flex; align-items: center; justify-content: center;
      height: 100vh; color: #fff;
    }

    .guest-box {
      background: #313338;
      padding: 2rem;
      width: 100%; max-width: 380px;
      box-sizing: border-box;
      text-align: center;
    }

    .guest-box .logo {
      display: block;
      margin: 0 auto 3rem;
      width: 180px;
    }

    h1 {
      margin: 0 0 1.5rem;
      font-size: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.25rem;
      font-size: 0.9rem;
      color: #8e9297;
    }
    .form-group input,
    .form-group select {
      width: 100%;
      padding: 0.75rem;
      background: #25262B;
      border: none;
      border-radius: 0;
      font-size: 1rem;
      color: #dcddde;
      box-sizing: border-box;
    }

    .form-checkbox {
      display: flex; align-items: center;
      margin-bottom: 1.25rem;
      text-align: left;
    }
    .form-checkbox input {
      margin-right: 0.5rem;
    }
    .form-checkbox span {
      font-size: 0.9rem; color: #b9bbbe;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      background: #5865F2;
      border: none; border-radius: 0;
      font-size: 1rem; font-weight: 500;
      color: #fff; cursor: pointer;
    }

    .links {
      display: flex; justify-content: center;
      margin-top: 1.5rem; font-size: 0.9rem;
    }
    .links a {
      color: #5865F2; text-decoration: none;

    }

    .error {
      color: #f14668;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    .status {
      background: #2ecc71;
      padding: 0.5rem;
      border-radius: 4px;
      text-align: center;
      margin-bottom: 1rem;
      color: #000;
    }
  </style>
</head>
<body>
  <div class="guest-box">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="logo">
    @yield('content')
  </div>
</body>
</html>
