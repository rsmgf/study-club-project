<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('To-Do List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                {{-- Task Form --}}
                <form method="POST" action="{{ route('tasks.store') }}" class="flex mb-4">
                    @csrf
                    <input type="text" name="title" placeholder="Add a new task" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Add
                    </button>
                </form>

                {{-- Task List --}}
                <div>
                    <h3 class="text-lg font-semibold mb-2">Tasks to Do</h3>
                    <ul class="space-y-2">
                        @foreach ($tasks as $task)
                            <li class="flex items-center justify-between p-2 bg-gray-100 rounded-md">
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <input type="checkbox" class="mr-2">
                                    </button>
                                </form>
                                <span>{{ $task->title }}</span>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        ❌
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Task History --}}
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Completed Tasks</h3>
                    <ul class="space-y-2">
                        @foreach ($history as $task)
                            <li class="p-2 bg-gray-300 rounded-md text-gray-600 line-through">
                                {{ $task->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
