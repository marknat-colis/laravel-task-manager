<x-guest-layout>
    <h1 class="text-xl font-extrabold mb-2">Confirm password</h1>
    <p class="text-sm text-slate-500 mb-6">Please confirm your password to continue.</p>
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">@csrf
        <div><label for="password" class="text-sm font-semibold">Password</label><input class="field" id="password" name="password" type="password" required autocomplete="current-password" autofocus><x-input-error :messages="$errors->get('password')" /></div>
        <button class="button-primary w-full" type="submit">Confirm</button>
    </form>
</x-guest-layout>
