@extends('layouts.app')

@section('title', 'Completed Tasks')

@section('content')
<div class="container my-4">
    <h2 class="fw-semibold fs-4 text-center">Completed Tasks</h2>

    <!-- Task List -->
    <div class="card shadow-sm p-4">
        <ul class="list-group">
            @forelse ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Checkmark (Disabled) -->
                        <button class="btn btn-success me-2" disabled>
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <span class="text-decoration-line-through text-muted">{{ $task->title }}</span>
                    </div>
                    <div>
                        <!-- Restore Button -->
                        <form action="{{ route('tasks.restoreCompleted', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-counterclockwise"></i>
                        </form>                        
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">No completed tasks.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
