<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Leave;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'employer') {
            $filter = request('filter', 'last');
            $query = Task::with('user');

            if ($filter === 'completed') {
                $query->where('status', 'zakończone');
            } elseif ($filter === 'pending') {
                $query->where('status', 'oczekujące');
            }

            $tasks = $query->orderBy('created_at', 'desc')->take(5)->get();

            $leaves = Leave::with('user')
                ->latest()
                ->take(7)
                ->get();

            return view('dashboard.employer', compact('tasks', 'leaves'));
        }

        $tasks = $user->tasks()
            ->where('status', 'oczekujące')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $history = $user->tasks()
            ->where('status', 'zakończone')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.employee', compact('tasks', 'history'));
    }
}
