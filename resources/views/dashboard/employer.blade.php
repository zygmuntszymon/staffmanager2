@extends('layouts.app')
@section('title','Dashboard Pracodawca')
@section('content')

<h1>Witaj {{ auth()->user()->name }} (Pracodawca)</h1>

{{-- Przycisk otwierający modal dodawania zadania --}}
<button id="openAddTaskModal">Dodaj nowe zadanie</button>

{{-- Modal dodawania zadania --}}
<div id="addTaskModal" style="display:none; position:fixed; top:0; left:0;
    width:100%; height:100%; background:rgba(0,0,0,0.6);">
    <div style="background:#3e3b44; padding:2rem; margin:5% auto; width:90%; max-width:500px; border-radius:8px; position:relative;">
        <button id="closeAddTask" style="position:absolute; top:1rem; right:1rem;">✕</button>
        <h2>Nowe zadanie</h2>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div><input name="title" placeholder="Tytuł zadania" required></div>
            <div><textarea name="description" placeholder="Opis zadania"></textarea></div>
            <div><input name="points" type="number" placeholder="Punkty" min="1" required></div>
            <div>
                <select name="assigned_to" required>
                    <option value="" disabled selected>Wybierz pracownika</option>
                    @foreach(\App\Models\User::where('role','employee')->get() as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div><button type="submit">Zapisz zadanie</button></div>
        </form>
    </div>
</div>

{{-- Ostatnie 5 zadań --}}
<h2>Ostatnie zadania</h2>
@if($tasks->isEmpty())
    <p>Brak zadań.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Pracownik</th>
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
                <td>{{ $t->points }}</td>
                <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    {{-- Usuń --}}
                    <form method="POST" action="{{ route('tasks.destroy', $t) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit">Usuń</button>
                    </form>
                    {{-- Edytuj --}}
                    <button onclick="openEditModal({{ $t->id }})">Edytuj</button>
                </td>
            </tr>

            {{-- Modal edycji dla każdego zadania --}}
            <div id="editTaskModal-{{ $t->id }}" style="display:none; position:fixed; top:0; left:0;
                width:100%; height:100%; background:rgba(0,0,0,0.6);">
                <div style="background:#3e3b44; padding:2rem; margin:5% auto; width:90%; max-width:500px; border-radius:8px; position:relative;">
                    <button onclick="closeEditModal({{ $t->id }})" style="position:absolute; top:1rem; right:1rem;">✕</button>
                    <h2>Edytuj zadanie</h2>
                    <form method="POST" action="{{ route('tasks.update', $t) }}">
                        @csrf @method('PUT')
                        <div><input name="title" value="{{ $t->title }}" required></div>
                        <div><textarea name="description">{{ $t->description }}</textarea></div>
                        <div><input name="points" type="number" value="{{ $t->points }}" min="1" required></div>
                        <div>
                            <select name="assigned_to" required>
                                @foreach(\App\Models\User::where('role','employee')->get() as $u)
                                    <option value="{{ $u->id }}" {{ $t->assigned_to==$u->id?'selected':'' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div><button type="submit">Zapisz zmiany</button></div>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
@endif

{{-- Ostatnie 5 wniosków urlopowych --}}
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

{{-- Prosty skrypt do obsługi modalów --}}
<script>
    document.getElementById('openAddTaskModal').onclick = () => {
        document.getElementById('addTaskModal').style.display = 'block';
    };
    document.getElementById('closeAddTask').onclick = () => {
        document.getElementById('addTaskModal').style.display = 'none';
    };

    function openEditModal(id) {
        document.getElementById('editTaskModal-' + id).style.display = 'block';
    }
    function closeEditModal(id) {
        document.getElementById('editTaskModal-' + id).style.display = 'none';
    }
</script>

@endsection
