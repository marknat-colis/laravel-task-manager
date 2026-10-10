<x-guest-layout>
    <div class="mb-7"><h1 class="text-2xl font-extrabold tracking-tight">Welcome back</h1><p class="text-sm text-slate-500 mt-1.5">Sign in to manage your personal tasks.</p></div>
    <x-auth-session-status :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="space-y-5">@csrf
        <div><label for="email" class="block text-sm font-semibold">Email address</label><input class="field" id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus placeholder="you@example.com"><x-input-error :messages="$errors->get('email')" /></div>
        <div><div class="flex items-center justify-between"><label for="password" class="block text-sm font-semibold">Password</label><a href="{{ route('password.request') }}" class="text-xs text-brand-700 font-semibold hover:underline">Forgot password?</a></div><input class="field" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password"><x-input-error :messages="$errors->get('password')" /></div>
        <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500"> Remember me</label>
        <button type="submit" class="button-primary w-full">Log in</button>
    </form>
    <p class="mt-7 text-center text-sm text-slate-500">New to Task Manager? <a href="{{ route('register') }}" class="font-bold text-brand-700 hover:underline">Create an account</a></p>
</x-guest-layout>
