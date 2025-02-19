<x-app-layout>
    <h2 class="text-xl font-bold">Pending Tasks</h2>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->title }} - Due: {{ $task->due_date }}</li>
        @endforeach
    </ul>
</x-app-layout>
