<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'StaffManager2')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #292b2f;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .guest-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .guest-box {
            background: #3e3b44;
            border-radius: 8px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        a {
            color: #aaa;
            text-decoration: underline;
        }
        a:hover {
            color: #ddd;
        }
        input, select, button {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.25rem;
            margin-bottom: 0.75rem;
            border: 1px solid #555;
            border-radius: 4px;
            background: #292b2f;
            color: #fff;
            font-size: 1rem;
        }
        button {
            background: #57545d;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #6a676f;
        }
        label {
            display: block;
            margin-bottom: 0.25rem;
            color: #ccc;
        }
        .error {
            color: #e74c3c;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="guest-container">
        <div class="guest-box">
            @yield('content')
        </div>
    </div>
</body>
</html>
