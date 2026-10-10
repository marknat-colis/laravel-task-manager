<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div><p class="uppercase text-xs tracking-widest font-bold text-brand-600">Personal organizer</p><h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-1">My Tasks</h1><p class="text-sm text-slate-500 mt-1">Add, review, edit and delete tasks in one place.</p></div>
            <span class="rounded-full bg-brand-50 border border-brand-100 px-4 py-2 text-sm text-brand-700 font-bold">{{ $taskCount }} {{ \Illuminate\Support\Str::plural('task', $taskCount) }}</span>
        </div>
    </x-slot>

    @if (session('success'))
        <div role="status" class="mb-6 border border-green-200 bg-green-50 rounded-xl px-5 py-3 text-sm text-green-800">✓ {{ session('success') }}</div>
    @endif
    <div class="grid gap-7 lg:grid-cols-[minmax(0,380px)_minmax(0,1fr)] items-start">
        <section class="card p-6 sm:p-7 lg:sticky lg:top-6">
            <div class="flex items-center gap-3 mb-7"><span class="size-10 rounded-xl bg-brand-50 text-brand-700 font-bold text-xl flex items-center justify-center">+</span><div><h2 class="font-bold text-lg">Create a task</h2><p class="text-xs text-slate-500">What's on your to-do list?</p></div></div>
            <form method="POST" action="{{ route('tasks.store') }}" class="space-y-5">
                @csrf
                <div><label for="title" class="block text-sm font-semibold text-slate-700">Task Title <span class="text-red-600">*</span></label><input id="title" name="title" type="text" class="field" value="{{ old('title') }}" maxlength="255" placeholder="e.g. Finish Laravel activity" required autofocus><x-input-error :messages="$errors->get('title')" /></div>
                <div><label for="description" class="block text-sm font-semibold text-slate-700">Description <span class="font-normal text-slate-400">(optional)</span></label><textarea id="description" name="description" class="field" rows="5" maxlength="2000" placeholder="Write down any details here...">{{ old('description') }}</textarea><x-input-error :messages="$errors->get('description')" /></div>
                <button type="submit" class="button-primary w-full">+ Add Task</button>
            </form>
        </section>

        <section class="card p-6 sm:p-7">
            <div class="flex items-center justify-between pb-5 border-b border-slate-100"><div><h2 class="text-lg font-bold">Task List</h2><p class="text-xs text-slate-500 mt-1">Only you can see these tasks.</p></div><span class="text-xs rounded-lg bg-slate-100 text-slate-600 px-3 py-1.5 font-medium">Newest first</span></div>
            @forelse ($tasks as $task)
                <article class="py-5 border-b border-slate-100 last:border-0">
                    <div class="flex items-start gap-3">
                        <span class="shrink-0 mt-0.5 size-9 flex items-center justify-center bg-blue-50 rounded-xl text-brand-700">✓</span>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-slate-800 break-words">{{ $task->title }}</h3>
                            @if ($task->description)<p class="text-sm text-slate-600 whitespace-pre-line break-words mt-1.5">{{ $task->description }}</p>@endif
                            <div class="mt-3 flex flex-wrap items-center gap-3"><span class="text-xs text-slate-400">{{ $task->created_at->format('M d, Y') }}</span><a class="text-xs font-semibold text-brand-700 hover:underline" href="{{ route('tasks.show', $task) }}">View</a><a class="text-xs font-semibold text-brand-700 hover:underline" href="{{ route('tasks.edit', $task) }}">Edit</a><form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task permanently?')">@csrf @method('DELETE')<button type="submit" class="text-xs text-red-600 font-semibold hover:underline">Delete</button></form></div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="py-16 text-center"><span class="mx-auto size-16 rounded-2xl bg-brand-50 text-brand-700 flex items-center justify-center text-3xl">✓</span><h3 class="mt-5 text-lg font-bold">No tasks yet</h3><p class="mt-1 text-sm text-slate-500">Use the form to add your first task.</p></div>
            @endforelse
            @if ($tasks->hasPages())<div class="mt-6 border-t border-slate-100 pt-5">{{ $tasks->links() }}</div>@endif
        </section>
    </div>
</x-app-layout>
