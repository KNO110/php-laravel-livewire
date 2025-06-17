<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks;
    public $name = '';

    public function mount(): void
    {
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }

    public function createTask(): void
    {
        $this->validate([
            'name' => 'required|string|min:1|max:255',
        ]);

        Task::create(['name' => $this->name, 'completed' => false]);

        $this->name = '';
        $this->loadTasks();
    }

    public function toggleComplete(int $taskId): void
    {
        $task = Task::findOrFail($taskId);
        $task->update(['completed' => ! $task->completed]);

        $this->loadTasks();
    }

    public function deleteTask(int $taskId): void
    {
        Task::findOrFail($taskId)->delete();
        $this->loadTasks();
    }

    private function loadTasks(): void
    {
        $this->tasks = Task::latest()->get();
    }
}
