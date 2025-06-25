<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {/* zobaczone w dash */}
    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required',
            'description'=>'nullable',
            'points'=>'required|integer|min:1',
            'assigned_to'=>'required|exists:users,id'
        ]);
        Task::create($data);
        return redirect()->back();
    }
    public function update(Request $r, Task $task)
    {
        $this->authorize('manage',$task);
        $task->update($r->only(['title','description','points','assigned_to']));
        return redirect()->back();
    }
    public function destroy(Task $task)
    {
        $this->authorize('manage',$task);
        $task->delete();
        return redirect()->back();
    }
    public function complete(Task $task)
    {
        $user = auth()->user();
        if ($task->assigned_to==$user->id && $task->status=='pending') {
            $task->update(['status'=>'completed']);
            $user->increment('points',$task->points);
        }
        return redirect()->back();
    }
}
