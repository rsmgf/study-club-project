<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'pendingCount' => Task::where('status', 'Pending')->count(),
            'completedCount' => Task::where('status', 'Completed')->count(),
            'deletedCount' => Task::onlyTrashed()->count(),
            'recentTasks' => Task::latest()->take(5)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'status' => 'Completed',
        ]);

        return redirect()->route('tasks.completed')->with('success', 'Task marked as completed!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.deleted')->with('success', 'Task deleted!');
    }

    public function pending()
    {
        $tasks = Task::where('status', 'Pending')->get();
        return view('pending', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::where('status', 'Completed')->get();
        return view('completed', compact('tasks'));
    }

    public function deleted()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('deleted', compact('tasks'));
    }
}
