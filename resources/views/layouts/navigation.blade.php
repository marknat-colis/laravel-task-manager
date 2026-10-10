<nav class="bg-white border-b border-slate-200" x-data="{ mobileOpen: false }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-18 min-h-[76px] justify-between items-center gap-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2.5 font-extrabold text-lg tracking-tight">
                    <span class="inline-flex size-9 items-center justify-center bg-brand-600 text-white rounded-xl">✓</span>
                    Task<span class="text-brand-600 -ml-2.5">Manager</span>
                </a>
                <div class="hidden sm:flex gap-1.5">
                    <a href="{{ route('dashboard') }}" class="rounded-lg px-4 py-2 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                    <a href="{{ route('tasks.index') }}" class="rounded-lg px-4 py-2 text-sm font-semibold {{ request()->routeIs('tasks.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-100' }}">My Tasks</a>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-3">
                <span class="text-sm text-slate-500">{{ Auth::user()->name }}</span>
                <a href="{{ route('profile.edit') }}" class="text-sm text-brand-700 hover:underline font-medium">Profile</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="rounded-xl border border-slate-200 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-100">Log out</button>
                </form>
            </div>
            <button type="button" @click="mobileOpen = !mobileOpen" aria-label="Toggle navigation" :aria-expanded="mobileOpen" class="sm:hidden rounded-lg p-2 text-slate-700 hover:bg-slate-100">
                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
        </div>
        <div x-show="mobileOpen" x-cloak class="sm:hidden border-t border-slate-100 py-3 space-y-1">
            <a class="block rounded-lg px-3 py-2 hover:bg-slate-100" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-slate-100" href="{{ route('tasks.index') }}">My Tasks</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-slate-100" href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="px-3 py-2 text-left text-slate-700" type="submit">Log out</button></form>
        </div>
    </div>
</nav>
