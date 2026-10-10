<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <p class="uppercase text-xs tracking-widest font-bold text-brand-600">Your workspace</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Dashboard</h1>
            <p class="text-sm text-slate-500 mt-1">Welcome back, {{ Auth::user()->name }}. Here's your task overview.</p>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl p-8 sm:p-10 bg-gradient-to-br from-slate-900 to-blue-900 text-white overflow-hidden relative">
            <div class="absolute right-[-70px] top-[-70px] size-60 bg-white/5 rounded-full"></div>
            <p class="text-blue-200 font-semibold text-sm">Stay organized</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold mt-3 max-w-md leading-tight">Small tasks.<br>Big progress.</h2>
            <p class="text-blue-100/80 text-sm mt-4 max-w-md">Keep track of what's important, manage your list, and get more done — one task at a time.</p>
            <a href="{{ route('tasks.index') }}" class="mt-7 inline-flex bg-white text-slate-900 hover:bg-blue-50 rounded-xl py-3 px-5 text-sm font-bold">Open My Tasks <span class="ml-2">→</span></a>
        </div>
        <div class="card p-7 flex flex-col justify-between">
            <div>
                <p class="text-sm text-slate-500 font-semibold">Tasks created</p>
                <p class="text-5xl font-extrabold mt-5 tracking-tight">{{ $taskCount }}</p>
                <p class="text-sm text-slate-500 mt-3">Saved to your personal list</p>
            </div>
            <div class="mt-9 h-2 w-full rounded-full bg-slate-100"><div class="h-2 rounded-full bg-brand-600" style="width: {{ $taskCount > 0 ? 100 : 0 }}%"></div></div>
        </div>
    </div>
    <div class="card mt-7 p-6 sm:p-8">
        <div class="flex justify-between items-center gap-3 mb-5">
            <div><h2 class="text-lg font-bold">Recently added</h2><p class="text-sm text-slate-500 mt-0.5">Your latest three tasks</p></div>
            <a href="{{ route('tasks.index') }}" class="text-sm text-brand-700 font-semibold hover:underline">View all →</a>
        </div>
        @forelse ($recentTasks as $task)
            <a href="{{ route('tasks.show', $task) }}" class="flex items-center gap-4 py-4 border-t border-slate-100 group">
                <span class="flex shrink-0 items-center justify-center size-10 rounded-xl bg-brand-50 text-brand-600 font-extrabold">✓</span>
                <span class="min-w-0 flex-1"><span class="block font-semibold text-sm truncate group-hover:text-brand-700">{{ $task->title }}</span><span class="block text-xs text-slate-500 mt-1">{{ $task->created_at->format('M d, Y') }}</span></span>
                <span class="text-slate-400">→</span>
            </a>
        @empty
            <div class="py-12 text-center border-t border-slate-100">
                <p class="font-semibold text-slate-700">Nothing here yet</p>
                <p class="text-sm text-slate-500 mt-1">Create your first task to get started.</p>
                <a href="{{ route('tasks.index') }}" class="inline-flex mt-5 button-primary">Add a Task</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
