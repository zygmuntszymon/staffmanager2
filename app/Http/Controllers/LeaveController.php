<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role==='employer') {
            $leaves = Leave::where('status','pending')->get();
        } else {
            $leaves = $user->leaves;
        }
        return view('leaves.index', compact('leaves'));
    }
    public function create()
    {
        return view('leaves.create');
    }
    public function store(Request $r)
    {
        $data = $r->validate([
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);
        auth()->user()->leaves()->create($data);
        return redirect()->route('leaves.index');
    }
    public function approve(Leave $leave)
    {
        $leave->update(['status'=>'approved']);
        return redirect()->back();
    }
    public function reject(Leave $leave)
    {
        $leave->update(['status'=>'rejected']);
        return redirect()->back();
    }
}
