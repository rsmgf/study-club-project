@auth
    <!-- Show tasks only when logged in -->
@endauth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">To-Do List</h3>

            <!-- Task Form -->
            <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="flex">
                    <input type="text" name="title" placeholder="New Task"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-black rounded-md">
                        +
                    </button>
                </div>
            </form>

            <!-- Task List -->
            <div>
                @foreach ($tasks as $task)
                    <div class="flex justify-between items-center p-3 border-b">
                        <span class="{{ $task->status == 'Completed' ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </span>
                        <div>
                            @if ($task->status !== 'Completed')
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded-md">
                                        ✔
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-md">
                                    ✖
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
