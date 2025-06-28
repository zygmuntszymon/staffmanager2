@extends('layouts.app')

@section('title','Dashboard Pracownik')

@section('content')
  <h1>Witaj {{ auth()->user()->name }} (Pracownik)</h1>

  <div class="section">
    <h2>Twoje zadania</h2>
    @if($tasks->isEmpty())
      <p>Brak bieżących zadań.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Status</th>
            <th>Punkty</th>
            <th>Akcje</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks as $t)
            <tr>
              <td>{{ $t->title }}</td>
              <td>{{ ucfirst($t->status) }}</td>
              <td>{{ $t->points }} pkt</td>
              <td style="white-space: nowrap;">
                <button onclick="openDetailsModal({{ $t->id }})" title="Szczegóły">
                  <i class="fa-solid fa-circle-info"></i>
                </button>
                <form method="POST" action="{{ route('tasks.complete', $t) }}">
                  @csrf
                  <button type="submit" title="Ukończ" {{ $t->status == 'completed' ? 'disabled' : '' }}>
                    <i class="fas fa-check"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  @foreach($tasks as $t)
  <div id="detailsTaskModal-{{ $t->id }}" class="modal">
    <div class="modal-content">
      <button onclick="closeDetailsModal({{ $t->id }})" class="modal-close" title="Zamknij">
        <i class="fas fa-times"></i>
      </button>
      <h2>Szczegóły zadania: {{ $t->title }}</h2>
      <p><strong>Status:</strong> {{ ucfirst($t->status) }}</p>
      <p><strong>Punkty:</strong> {{ $t->points }}</p>
      <p><strong>Opis:</strong></p>
      <p>{{ $t->description ?: 'Brak opisu' }}</p>
      <p><strong>Utworzono:</strong> {{ $t->created_at->format('Y-m-d H:i') }}</p>
      <p><strong>Ostatnia aktualizacja:</strong> {{ $t->updated_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
  @endforeach

  <div class="section">
    <h2>Historia zadań</h2>
    @if($history->isEmpty())
      <p>Brak ukończonych zadań.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Punkty</th>
            <th>Status</th>
            <th>Data ukończenia</th>
            <th>Akcje</th>
          </tr>
        </thead>
        <tbody>
          @foreach($history as $h)
            <tr>
              <td>{{ $h->title }}</td>
              <td>{{ $h->points }} pkt</td>
              <td>{{ ucfirst($h->status) }}</td>
              <td>{{ $h->updated_at->format('Y-m-d H:i') }}</td>
              <td>
                <button onclick="openDetailsModal({{ $h->id }})" title="Szczegóły">
                  <i class="fa-solid fa-circle-info"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  @foreach($history as $h)
  <div id="detailsTaskModal-{{ $h->id }}" class="modal">
    <div class="modal-content">
      <button onclick="closeDetailsModal({{ $h->id }})" class="modal-close" title="Zamknij">
        <i class="fas fa-times"></i>
      </button>
      <h2>Szczegóły zadania: {{ $h->title }}</h2>
      <p><strong>Status:</strong> {{ ucfirst($h->status) }}</p>
      <p><strong>Punkty:</strong> {{ $h->points }}</p>
      <p><strong>Opis:</strong></p>
      <p>{{ $h->description ?: 'Brak opisu' }}</p>
      <p><strong>Utworzono:</strong> {{ $h->created_at->format('Y-m-d H:i') }}</p>
      <p><strong>Ukończono:</strong> {{ $h->updated_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
  @endforeach

  <script>
    function openDetailsModal(id) {
        document.getElementById('detailsTaskModal-' + id).classList.add('open');
    }

    function closeDetailsModal(id) {
        document.getElementById('detailsTaskModal-' + id).classList.remove('open');
    }
  </script>
@endsection
