<x-guest-layout>
    <div class="mb-7"><h1 class="text-2xl font-extrabold tracking-tight">Create an account</h1><p class="text-sm text-slate-500 mt-1.5">Start keeping your tasks in one place.</p></div>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">@csrf
        <div><label class="block text-sm font-semibold" for="name">Full name</label><input class="field" id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" maxlength="255" placeholder="Your name"><x-input-error :messages="$errors->get('name')" /></div>
        <div><label class="block text-sm font-semibold" for="email">Email address</label><input class="field" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com"><x-input-error :messages="$errors->get('email')" /></div>
        <div><label class="block text-sm font-semibold" for="password">Password</label><input class="field" id="password" name="password" type="password" required autocomplete="new-password" placeholder="Create a secure password"><x-input-error :messages="$errors->get('password')" /></div>
        <div><label class="block text-sm font-semibold" for="password_confirmation">Confirm password</label><input class="field" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="Repeat your password"><x-input-error :messages="$errors->get('password_confirmation')" /></div>
        <button type="submit" class="button-primary w-full">Create Account</button>
    </form>
    <p class="mt-7 text-center text-sm text-slate-500">Already have an account? <a href="{{ route('login') }}" class="font-bold text-brand-700 hover:underline">Log in</a></p>
</x-guest-layout>
