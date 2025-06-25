@extends('layouts.app')
@section('title','Dashboard Pracownik')
@section('content')

    <h1>Witaj {{ auth()->user()->name }} (Pracownik)</h1>

    <h2>Twoje zadania</h2>
    @if($tasks->isEmpty())
        <p>Brak bieżących zadań.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Punkty</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $t)
                <tr>
                    <td>{{ $t->title }}</td>
                    <td>{{ $t->points }} pkt</td>
                    <td>
                        <form method="POST" action="{{ route('tasks.complete', $t) }}">
                            @csrf
                            <button type="submit">Ukończ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <h2>Historia zadań</h2>
    @if($history->isEmpty())
        <p>Brak ukończonych zadań.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Data ukończenia</th>
                </tr>
            </thead>
            <tbody>
            @foreach($history as $h)
                <tr>
                    <td>{{ $h->title }}</td>
                    <td>{{ $h->updated_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
