<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function pending()
    {
        $tasks = Task::where('status', 'Pending')->get();
        return view('tasks.pending', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::where('status', 'Completed')->get();
        return view('tasks.completed', compact('tasks'));
    }

    public function deleted()
    {
        $tasks = Task::onlyTrashed()->get(); // Fetch soft deleted tasks
        return view('tasks.deleted', compact('tasks'));
    }
}
