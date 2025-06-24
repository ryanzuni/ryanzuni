<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return Task::all();
        }

        return Task::where('assigned_to', $user->id)
            ->orWhere('created_by', $user->id)
            ->get();
    }

    public function store(Request $request)
    {
        $assignee = User::find($request->assigned_to);

        if (!$assignee || $assignee->status === false) {
            return response()->json(['message' => 'Invalid or inactive assignee'], 422);
        }

        if (auth()->user()->role === 'manager' && $assignee->role !== 'staff') {
            return response()->json(['message' => 'Managers can only assign to staff'], 403);
        }

        $task = Task::create([
            'id' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
            'created_by' => auth()->id()
        ]);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Optional: Check role for edit
        $task->update($request->only('title', 'description', 'status', 'due_date'));

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if (auth()->user()->role !== 'admin' && auth()->id() !== $task->created_by) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
