@extends('layouts.app')
@section('title','Złóż wniosek urlopowy')
@section('content')
<form method="POST" action="{{ route('leaves.store') }}">@csrf
    <input type="date" name="start_date"><br>
    <input type="date" name="end_date"><br>
    <button>Złóż wniosek</button>
</form>
@endsection
