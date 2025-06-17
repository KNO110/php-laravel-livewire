<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Список задач</h1>

    <div class="flex mb-6 space-x-2">
        <input type="text"
               class="flex-1 border rounded px-2 py-1"
               placeholder="Новая задача..."
               wire:model.defer="name"
               wire:keydown.enter="createTask">
        <button class="px-4 py-1 bg-blue-600 text-white rounded"
                wire:click="createTask">
            +
        </button>
    </div>

    <ul>
        @foreach ($tasks as $task)
            <li class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-2">
                    <input type="checkbox"
                           wire:click="toggleComplete({{ $task->id }})"
                           @checked($task->completed)
                           class="w-4 h-4">
                    <span class="{{ $task->completed ? 'line-through text-gray-500' : '' }}">
                        {{ $task->name }}
                    </span>
                </div>
                <button class="text-red-600"
                        wire:click="deleteTask({{ $task->id }})">
                    ✕
                </button>
            </li>
        @endforeach
    </ul>
</div>
