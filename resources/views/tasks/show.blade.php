<x-app-layout>
    <x-slot name="header"><p class="text-xs font-bold uppercase text-brand-600 tracking-widest">Task details</p><h1 class="text-2xl font-extrabold mt-1">View Task</h1></x-slot>
    <div class="max-w-2xl mx-auto card p-7 sm:p-9">
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-widest">Title</p><h2 class="text-2xl font-extrabold mt-2 break-words">{{ $task->title }}</h2>
        <div class="my-6 border-b border-slate-100"></div>
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-widest">Description</p><p class="text-slate-700 whitespace-pre-line break-words mt-2">{{ $task->description ?: 'No description provided.' }}</p>
        <p class="text-xs text-slate-400 mt-7">Created {{ $task->created_at->format('F j, Y') }}</p>
        <div class="flex flex-wrap items-center gap-3 mt-7"><a href="{{ route('tasks.edit', $task) }}" class="button-primary">Edit Task</a><a href="{{ route('tasks.index') }}" class="button-neutral">Back to Tasks</a><form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task permanently?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 font-semibold text-sm px-3 hover:underline">Delete</button></form></div>
    </div>
</x-app-layout>
