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
        if ($user->role==='employer') {
            $tasks = Task::all();
            $leaves = Leave::where('status','pending')->get();
            return view('dashboard.employer', compact('tasks','leaves'));
        }
        // pracownik
        $tasks = $user->tasks()->where('status','pending')->get();
        $history = $user->tasks()->where('status','completed')->get();
        return view('dashboard.employee', compact('tasks','history'));
    }
}
