@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
<header class="bg-white shadow">
    <div class="container py-4">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Dashboard') }}
        </h2>
    </div>
</header>
@endsection

@section('content')
<div class="container my-4">
    {{-- Tasks --}}
    <div class="row g-3 mb-4 text-center">
        <div class="col-md-4">
            <a href="{{ route('pending') }}" class="p-3 bg-warning text-dark rounded text-decoration-none d-block">
                Pending Tasks ({{ $pendingCount ?? 0 }})
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('completed') }}" class="p-3 bg-success text-white rounded text-decoration-none d-block">
                Completed Tasks ({{ $completedCount ?? 0 }})
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('deleted') }}" class="p-3 bg-danger text-white rounded text-decoration-none d-block">
                Deleted Tasks ({{ $deletedCount ?? 0 }})
            </a>
        </div>
    </div>

    {{-- Add Task --}}
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fs-5 fw-semibold mb-3">Add a New Task</h3>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="New Task" required>
                <input type="datetime-local" name="due_date" class="form-control" required>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- View Tasks --}}
    <div class="card shadow-sm p-4">
        <h3 class="fs-5 fw-semibold mb-3">Recent Tasks</h3>
        <ul class="list-group">
            @foreach ($recentTasks as $task)
            <li class="list-group-item d-flex align-items-center">
                {{-- Tasks --}}
                <span class="flex-grow-1 {{ $task->status == 'Completed' ? 'text-decoration-line-through text-muted' : '' }}">
                    {{ $task->title }}
                </span>
        
                {{-- D-Date --}}
                <span class="text-muted text-center w-25">
                    Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y h:i A') }}
                </span>
        
                <small class="fw-bold ms-3 
                    {{ $task->status == 'Overdue' ? 'text-danger' : ($task->status == 'Completed' ? 'text-success' : '') }}">
                    {{ $task->status }}
                </small>
        
                {{-- Delete Button (only overdue) --}}
                @if ($task->status == 'Overdue')
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
