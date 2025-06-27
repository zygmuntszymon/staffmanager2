@extends('layouts.app')

@section('title','Złóż wniosek urlopowy')

@section('content')
  <div class="section" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div style="max-width: 500px; width: 100%; padding: 2rem; background: #282b30; border-radius: 8px; margin: 0 auto;">
      <h1 style="text-align: center; margin-bottom: 2rem;">Złóż wniosek urlopowy</h1>
      <form method="POST" action="{{ route('leaves.store') }}">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label for="start_date">Od:</label>
          <input id="start_date" type="date" name="start_date" required style="width: 100%; padding: 0.75rem; background: #25262B; color: #dcddde; border: none; border-radius: 4px; margin-top: 0.5rem;">
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label for="end_date">Do:</label>
          <input id="end_date" type="date" name="end_date" required style="width: 100%; padding: 0.75rem; background: #25262B; color: #dcddde; border: none; border-radius: 4px; margin-top: 0.5rem;">
        </div>
        <div class="form-group" style="text-align: center;">
          <button type="submit" style="padding: 0.75rem 2rem; background: #ffffff; color: #000; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Złóż wniosek</button>
        </div>
      </form>
    </div>
  </div>
@endsection