<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <!-- Task Summary -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <a href="{{ route('pending') }}" class="p-4 bg-yellow-100 text-yellow-700 rounded-md text-center">
                Pending Tasks ({{ $pendingCount ?? 0 }})
            </a>
            <a href="{{ route('completed') }}" class="p-4 bg-green-100 text-green-700 rounded-md text-center">
                Completed Tasks ({{ $completedCount ?? 0 }})
            </a>
            <a href="{{ route('deleted') }}" class="p-4 bg-red-100 text-red-700 rounded-md text-center">
                Deleted Tasks ({{ $deletedCount ?? 0 }})
            </a>
        </div>
        

        <!-- Quick Add Task Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Add a New Task</h3>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="flex">
                    <input type="text" name="title" placeholder="New Task"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-blue rounded-md">+</button>
                </div>
            </form>
        </div>

        <!-- Quick View of Recent Tasks -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Tasks</h3>
            <ul>
                @foreach ($recentTasks as $task)
                    <li class="flex justify-between items-center p-2 border-b">
                        <span class="{{ $task->status == 'Completed' ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </span>
                        <small class="text-gray-600">{{ $task->status }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
