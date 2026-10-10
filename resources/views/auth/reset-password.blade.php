<x-guest-layout>
    <h1 class="text-xl font-extrabold mb-6">Reset password</h1>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">@csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div><label for="email" class="text-sm font-semibold">Email</label><input class="field" id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required><x-input-error :messages="$errors->get('email')" /></div>
        <div><label for="password" class="text-sm font-semibold">New password</label><input class="field" id="password" name="password" type="password" required autocomplete="new-password"><x-input-error :messages="$errors->get('password')" /></div>
        <div><label for="password_confirmation" class="text-sm font-semibold">Confirm password</label><input class="field" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"><x-input-error :messages="$errors->get('password_confirmation')" /></div>
        <button class="button-primary w-full" type="submit">Reset Password</button>
    </form>
</x-guest-layout>
