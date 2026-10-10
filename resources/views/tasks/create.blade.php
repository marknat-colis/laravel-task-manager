<x-app-layout>
    <x-slot name="header"><h1 class="text-2xl font-extrabold">Create Task</h1></x-slot>
    <div class="max-w-2xl mx-auto card p-7">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">@csrf
            <div><label for="title" class="font-semibold text-sm">Task Title</label><input class="field" id="title" name="title" value="{{ old('title') }}" maxlength="255" required><x-input-error :messages="$errors->get('title')" /></div>
            <div><label for="description" class="font-semibold text-sm">Description</label><textarea class="field" id="description" name="description" rows="5" maxlength="2000">{{ old('description') }}</textarea><x-input-error :messages="$errors->get('description')" /></div>
            <div class="flex gap-3"><button type="submit" class="button-primary">Add Task</button><a href="{{ route('tasks.index') }}" class="button-neutral">Cancel</a></div>
        </form>
    </div>
</x-app-layout>
