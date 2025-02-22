<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        Task::updateOverdueTasks($userId); 

        return view('dashboard', [
            'pendingCount' => Task::ownedByUser($userId)->where('status', 'Pending')->count(),
            'completedCount' => Task::ownedByUser($userId)->where('status', 'Completed')->count(),
            'deletedCount' => Task::onlyTrashed()->where('user_id', $userId)->count(),
            'recentTasks' => Task::ownedByUser($userId)->latest()->take(5)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        if ($request->has('mark_completed')) { 
            $task->update(['status' => 'Completed']);
            return redirect()->route('completed')->with('success', 'Task marked as completed!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'status' => $request->status ?? $task->status, 
        ]);

        return redirect()->route('pending')->with('success', 'Task updated successfully!');
    }


    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('deleted')->with('success', 'Task deleted!');
    }

    public function pending()
    {
        $userId = Auth::id();
        Task::updateOverdueTasks($userId);

        $tasks = Task::ownedByUser($userId)->where('status', 'Pending')->get();
        return view('pending', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::ownedByUser(Auth::id())->where('status', 'Completed')->get();
        return view('completed', compact('tasks'));
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('edit', compact('task')); 
    }


    public function deleted()
    {
        $tasks = Task::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('deleted', compact('tasks'));
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);

        $this->authorizeTask($task);

        $task->restore();

        if (!$task->status || $task->status === 'Deleted') {
            $task->update(['status' => 'Pending']);
        }

        return redirect()->route('pending')->with('success', 'Task restored!');
    }


    public function restoreFromCompleted($id)
    {
        $task = Task::where('status', 'Completed')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        $this->authorizeTask($task);

        $task->update(['status' => 'Pending']);

        return redirect()->route('pending')->with('success', 'Task moved back to Pending!');
    }


    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $this->authorizeTask($task);

        $task->forceDelete();

        return redirect()->route('deleted')->with('success', 'Task permanently deleted!');
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
