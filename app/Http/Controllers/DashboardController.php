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
            $filter = request('filter', 'last'); // domyślnie "last"
            $query = Task::with('user');

            if ($filter === 'completed') {
                $query->where('status', 'completed');
            } elseif ($filter === 'pending') {
                $query->where('status', 'pending');
            }

            $tasks = $query->orderBy('created_at', 'desc')->take(5)->get();

            $leaves = Leave::with('user')
                ->latest()
                ->take(7)
                ->get();

            return view('dashboard.employer', compact('tasks', 'leaves'));
        }

        $tasks = $user->tasks()
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $history = $user->tasks()
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.employee', compact('tasks', 'history'));
    }
}
