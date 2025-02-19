<x-app-layout>
    <h2 class="text-xl font-bold">Deleted Tasks</h2>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->title }} (Deleted)</li>
        @endforeach
    </ul>
</x-app-layout>
