<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        return view('tasks.index', [
            'tasks' => $request->user()->tasks()->latest()->paginate(10),
            'taskCount' => $request->user()->tasks()->count(),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        // Relationship sets user_id from the logged-in user, preventing forged ownership.
        $request->user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    public function show(Request $request, Task $task): View
    {
        $this->ensureOwner($request, $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Request $request, Task $task): View
    {
        $this->ensureOwner($request, $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->ensureOwner($request, $task);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Request $request, Task $task): RedirectResponse
    {
        $this->ensureOwner($request, $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function ensureOwner(Request $request, Task $task): void
    {
        abort_unless($task->user_id === $request->user()->id, 403);
    }
}
