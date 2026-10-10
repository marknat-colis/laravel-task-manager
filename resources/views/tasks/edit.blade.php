<x-app-layout>
    <x-slot name="header"><p class="text-xs font-bold uppercase text-brand-600 tracking-widest">Update your task</p><h1 class="text-2xl font-extrabold mt-1">Edit Task</h1></x-slot>
    <div class="max-w-2xl mx-auto card p-7 sm:p-9">
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">@csrf @method('PUT')
            <div><label for="title" class="block text-sm font-semibold">Task Title <span class="text-red-600">*</span></label><input id="title" name="title" type="text" class="field" value="{{ old('title', $task->title) }}" maxlength="255" required><x-input-error :messages="$errors->get('title')" /></div>
            <div><label for="description" class="block text-sm font-semibold">Description</label><textarea id="description" name="description" rows="6" maxlength="2000" class="field">{{ old('description', $task->description) }}</textarea><x-input-error :messages="$errors->get('description')" /></div>
            <div class="flex flex-wrap gap-3 pt-2"><button type="submit" class="button-primary">Save Changes</button><a href="{{ route('tasks.index') }}" class="button-neutral">Cancel</a></div>
        </form>
    </div>
</x-app-layout>
