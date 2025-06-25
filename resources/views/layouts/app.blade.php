
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style>
        body {
            background-color: #292b2f;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1f1d23;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a, header span {
            color: #dddddd;
            margin-right: 1rem;
            text-decoration: none;
        }
        header a:hover {
            text-decoration: underline;
        }
        main {
            padding: 2rem;
        }
        button, input, select, textarea {
            background-color: #3e3b44;
            border: 1px solid #555555;
            color: #ffffff;
            padding: 0.5rem;
            margin: 0.25rem 0;
            border-radius: 4px;
            font-size: 1rem;
        }
        button:hover {
            background-color: #57545d;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        th, td {
            border: 1px solid #444444;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #3e3b44;
        }
        a.button-link {
            display: inline-block;
            background-color: #3e3b44;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            color: #ffffff;
            margin-top: 1rem;
        }
        a.button-link:hover {
            background-color: #57545d;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            @if(auth()->user()->role === 'employee')
                <span>Punkty: {{ auth()->user()->points }}</span>
                <a href="{{ route('redemptions.index') }}">Benefity</a>
                <a href="{{ route('leaves.index') }}">Urlopy</a>
            @else
                <a href="{{ route('leaves.index') }}">Urlopy</a>
            @endif
        </div>
        <div>
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role === 'employee' ? 'Pracownik' : 'Pracodawca' }})</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Wyloguj</button>
            </form>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
