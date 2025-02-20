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
    <!-- Task Summary -->
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

    <!-- Quick Add Task Form -->
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

    <!-- Quick View of Recent Tasks -->
    <div class="card shadow-sm p-4">
        <h3 class="fs-5 fw-semibold mb-3">Recent Tasks</h3>
        <ul class="list-group">
            @foreach ($recentTasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="{{ $task->status == 'Completed' ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->title }}
                    </span>
                    <small class="text-secondary">{{ $task->status }}</small>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
