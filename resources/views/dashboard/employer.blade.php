@extends('layouts.app')

@section('title','Dashboard Pracodawca')

@section('content')
  <h1>Witaj {{ auth()->user()->name }} (Pracodawca)</h1>

  <div class="section">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
      <h2>Ostatnie zadania</h2>
      <button id="openAddTaskModal" title="Dodaj nowe zadanie">
        <i class="fas fa-plus"></i> Dodaj
      </button>
    </div>

    @if($tasks->isEmpty())
      <p>Brak zadań.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Pracownik</th>
            <th>Status</th>
            <th>Punkty</th>
            <th>Data utworzenia</th>
            <th>Akcje</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks->take(5) as $t)
            <tr>
              <td>{{ $t->title }}</td>
              <td>{{ $t->user->name }}</td>
              <td>{{ ucfirst($t->status) }}</td>
              <td>{{ $t->points }}</td>
              <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
              <td style="white-space: nowrap;">
                <button onclick="openDetailsModal({{ $t->id }})" title="Szczegóły">
                  <i class="fa-solid fa-circle-info"></i>
                </button>
                <form method="POST" action="{{ route('tasks.destroy', $t) }}" style="display:inline">
                  @csrf @method('DELETE')
                  <button type="submit" title="Usuń">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
                <button onclick="openEditModal({{ $t->id }})" title="Edytuj">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  {{-- Modal dodawania zadania --}}
  <div id="addTaskModal" class="modal">
    <div class="modal-content">
      <button id="closeAddTask" class="modal-close" title="Zamknij">
        <i class="fas fa-times"></i>
      </button>
      <h2>Nowe zadanie</h2>
      <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group"><input name="title" placeholder="Tytuł zadania" required></div>
        <div class="form-group"><textarea name="description" placeholder="Opis zadania"></textarea></div>
        <div class="form-group"><input name="points" type="number" placeholder="Punkty" min="1" required></div>
        <div class="form-group">
          <select name="assigned_to" required>
            <option value="" disabled selected>Wybierz pracownika</option>
            @foreach(\App\Models\User::where('role','employee')->get() as $u)
              <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><button type="submit"><i class="fas fa-save"></i> Zapisz</button></div>
      </form>
    </div>
  </div>

  {{-- MODALE EDYCJI --}}
  @foreach($tasks->take(5) as $t)
  <div id="editTaskModal-{{ $t->id }}" class="modal">
    <div class="modal-content">
      <button onclick="closeEditModal({{ $t->id }})" class="modal-close" title="Zamknij">
        <i class="fas fa-times"></i>
      </button>
      <h2>Edytuj zadanie</h2>
      <form method="POST" action="{{ route('tasks.update', $t) }}">
        @csrf @method('PUT')
        <div class="form-group"><input name="title" value="{{ $t->title }}" required></div>
        <div class="form-group"><textarea name="description">{{ $t->description }}</textarea></div>
        <div class="form-group"><input name="points" type="number" value="{{ $t->points }}" min="1" required></div>
        <div class="form-group">
          <select name="assigned_to" required>
            @foreach(\App\Models\User::where('role','employee')->get() as $u)
              <option value="{{ $u->id }}" {{ $t->assigned_to == $u->id ? 'selected' : '' }}>
                {{ $u->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><button type="submit"><i class="fas fa-save"></i> Zapisz zmiany</button></div>
      </form>
    </div>
  </div>
  @endforeach

  {{-- MODALE SZCZEGÓŁÓW --}}
  @foreach($tasks->take(5) as $t)
  <div id="detailsTaskModal-{{ $t->id }}" class="modal">
    <div class="modal-content">
      <button onclick="closeDetailsModal({{ $t->id }})" class="modal-close" title="Zamknij">
        <i class="fas fa-times"></i>
      </button>
      <h2>Szczegóły zadania: {{ $t->title }}</h2>
      <p><strong>Status:</strong> {{ ucfirst($t->status) }}</p>
      <p><strong>Przypisane do:</strong> {{ $t->user->name }}</p>
      <p><strong>Punkty:</strong> {{ $t->points }}</p>
      <p><strong>Opis:</strong></p>
      <p>{{ $t->description ?: 'Brak opisu' }}</p>
      <p><strong>Utworzono:</strong> {{ $t->created_at->format('Y-m-d H:i') }}</p>
      <p><strong>Ostatnia aktualizacja:</strong> {{ $t->updated_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
  @endforeach

  <div class="section">
    <h2>Ostatnie wnioski urlopowe</h2>
    @if($leaves->isEmpty())
      <p>Brak wniosków.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>Pracownik</th>
            <th>Od</th>
            <th>Do</th>
            <th>Status</th>
            <th>Data złożenia</th>
          </tr>
        </thead>
        <tbody>
          @foreach($leaves->take(5) as $l)
            <tr>
              <td>{{ $l->user->name }}</td>
              <td>{{ $l->start_date }}</td>
              <td>{{ $l->end_date }}</td>
              <td>{{ ucfirst($l->status) }}</td>
              <td>{{ $l->created_at->format('Y-m-d H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <script>
    document.getElementById('openAddTaskModal').onclick = () => document.getElementById('addTaskModal').classList.add('open');
    document.getElementById('closeAddTask').onclick = () => document.getElementById('addTaskModal').classList.remove('open');
    
    function openEditModal(id) { 
        document.getElementById('editTaskModal-' + id).classList.add('open'); 
    }
    
    function closeEditModal(id) { 
        document.getElementById('editTaskModal-' + id).classList.remove('open'); 
    }

    function openDetailsModal(id) { 
        document.getElementById('detailsTaskModal-' + id).classList.add('open'); 
    }
    
    function closeDetailsModal(id) { 
        document.getElementById('detailsTaskModal-' + id).classList.remove('open'); 
    }
  </script>
@endsection