@extends('layouts.app')

@section('title', 'Pending Tasks')

@section('content')
<div class="container my-4">
    <h2 class="fw-semibold fs-4 text-center">Pending Tasks</h2>

    {{-- Task List --}}
    <div class="card shadow-sm p-4">
        <ul class="list-group">
            @forelse ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{-- Checkmark Button --}}
                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="mark_completed" class="btn btn-outline-success me-2">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                            <div class="d-flex flex-column">
                                <span class="{{ $task->status == 'Completed' ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $task->title }}
                                </span>
                                <small class="text-muted">
                                    Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y h:i A') }}
                                </small>
                            </div>
                    </div>
                    <div>
                        {{-- Delete Button --}}
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">No pending tasks.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
