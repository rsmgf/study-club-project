@extends('layouts.app')

@section('title', 'Deleted Tasks')

@section('content')
<div class="container my-4">
    <h2 class="fw-semibold fs-4 text-center">Deleted Tasks</h2>

    <!-- Task List -->
    <div class="card shadow-sm p-4">
        <ul class="list-group">
            @forelse ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">{{ $task->title }}</span>
                    </div>
                    <div>
                        <!-- Restore Button -->
                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                        </form>
                        
                        <!-- Permanent Delete Button -->
                        <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">No deleted tasks.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
