<x-guest-layout>
    <h1 class="text-xl font-extrabold mb-2">Forgot your password?</h1>
    <p class="text-sm text-slate-500 mb-6">Enter your account email and we'll send a password reset link. For this local lab, emails are written to <code>storage/logs/laravel.log</code>.</p>
    <x-auth-session-status :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">@csrf
        <div><label for="email" class="text-sm font-semibold">Email address</label><input id="email" class="field" type="email" name="email" required autofocus value="{{ old('email') }}"><x-input-error :messages="$errors->get('email')" /></div>
        <button type="submit" class="button-primary w-full">Email Reset Link</button>
    </form>
    <p class="mt-5 text-sm text-center"><a class="font-semibold text-brand-700" href="{{ route('login') }}">Back to Log in</a></p>
</x-guest-layout>
