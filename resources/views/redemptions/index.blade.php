@extends('layouts.app')
@section('title','Wymień punkty')
@section('content')
    <h1>Twoje wymiany</h1>
    @if(session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif
    @error('points')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <ul>
        @foreach($redemptions as $r)
            <li>
                @if($r->benefit_type=='vacation_day') Dzień urlopowy 
                @else Premia pieniężna @endif
                – {{ $r->points_spent }} pkt 
                ({{ $r->created_at->format('Y-m-d H:i') }})
            </li>
        @endforeach
    </ul>

    <h2>Nowa wymiana</h2>
    <form method="POST" action="{{ route('redemptions.store') }}">
        @csrf
        <label for="benefit_type">Wybierz benefit:</label><br>
        <select id="benefit_type" name="benefit_type" required>
            <option value="vacation_day">Dzień urlopowy (2000 pkt)</option>
            <option value="cash_bonus">Premia pieniężna (4000 pkt)</option>
        </select><br><br>
        <button type="submit">Wymień punkty</button>
    </form>
@endsection
