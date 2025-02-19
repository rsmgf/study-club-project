<x-app-layout>
    <h2 class="text-xl font-bold">Completed Tasks</h2>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->title }} - Completed</li>
        @endforeach
    </ul>
</x-app-layout>
