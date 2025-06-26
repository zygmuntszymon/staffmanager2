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
            $tasks = Task::latest()->get();
            $leaves = Leave::with('user')
                ->latest()
                ->take(7)
                ->get();

            return view('dashboard.employer', compact('tasks', 'leaves'));
        }

        $tasks = $user->tasks()->where('status', 'pending')->get();
        $history = $user->tasks()->where('status', 'completed')->get();

        return view('dashboard.employee', compact('tasks', 'history'));
    }
}
