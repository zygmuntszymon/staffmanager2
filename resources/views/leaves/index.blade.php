@extends('layouts.app')
@section('title','Urlopy')
@section('content')

    @if(auth()->user()->role === 'employer')
        <h1>Wnioski urlopowe do akceptacji</h1>

        @if($leaves->isEmpty())
            <p>Brak nowych wniosków.</p>
        @else
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>Pracownik</th>
                        <th>Od</th>
                        <th>Do</th>
                        <th>Data złożenia</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->user->name }}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form method="POST" action="{{ route('leaves.approve', $leave) }}" style="display:inline">
                                @csrf
                                <button type="submit">Akceptuj</button>
                            </form>
                            <form method="POST" action="{{ route('leaves.reject', $leave) }}" style="display:inline">
                                @csrf
                                <button type="submit">Odrzuć</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    @else
        <h1>Twoje wnioski urlopowe</h1>

        @if($leaves->isEmpty())
            <p>Nie złożyłeś jeszcze żadnego wniosku.</p>
        @else
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>Od</th>
                        <th>Do</th>
                        <th>Status</th>
                        <th>Data złożenia</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ ucfirst($leave->status) }}</td>
                        <td>{{ $leave->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <p>

            <a href="{{ route('leaves.create') }}">
                <button type="button">Złóż nowy wniosek urlopowy</button>
            </a>
        </p>
    @endif

@endsection
