<x-app-layout>
    <x-slot name="header"><h1 class="text-2xl font-extrabold">Account Settings</h1><p class="text-sm text-slate-500 mt-1">Manage your profile and password.</p></x-slot>
    <div class="space-y-7 max-w-3xl mx-auto">
        <section class="card p-7"><h2 class="text-lg font-bold mb-1">Profile information</h2><p class="text-xs text-slate-500 mb-6">Update your name and email address.</p>
            @if (session('status') === 'profile-updated')<p class="bg-green-50 text-green-700 rounded-lg p-3 mb-4 text-sm">Profile updated.</p>@endif
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">@csrf @method('PATCH')
                <div><label class="text-sm font-semibold" for="name">Name</label><input class="field" id="name" name="name" value="{{ old('name', $user->name) }}" required><x-input-error :messages="$errors->get('name')" /></div>
                <div><label class="text-sm font-semibold" for="email">Email address</label><input class="field" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required><x-input-error :messages="$errors->get('email')" /></div>
                <button class="button-primary" type="submit">Save Profile</button>
            </form>
        </section>
        <section class="card p-7"><h2 class="text-lg font-bold mb-1">Update password</h2><p class="text-xs text-slate-500 mb-6">Choose a strong password for your account.</p>
            @if (session('status') === 'password-updated')<p class="bg-green-50 text-green-700 rounded-lg p-3 mb-4 text-sm">Password updated.</p>@endif
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">@csrf @method('PUT')
                <div><label class="text-sm font-semibold" for="current_password">Current password</label><input class="field" type="password" id="current_password" name="current_password" required><x-input-error :messages="$errors->updatePassword->get('current_password')" /></div>
                <div><label class="text-sm font-semibold" for="password">New password</label><input class="field" type="password" id="password" name="password" required><x-input-error :messages="$errors->updatePassword->get('password')" /></div>
                <div><label class="text-sm font-semibold" for="password_confirmation">Confirm new password</label><input class="field" type="password" id="password_confirmation" name="password_confirmation" required></div>
                <button class="button-primary" type="submit">Update Password</button>
            </form>
        </section>
        <section class="card p-7 border-red-100"><h2 class="font-bold text-red-700">Delete account</h2><p class="text-sm text-slate-500 mt-2 mb-5">This permanently deletes your account and all your tasks.</p>
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Permanently delete your account and all its tasks?')">@csrf @method('DELETE')
                <div class="max-w-sm"><label for="delete_password" class="text-sm font-semibold">Confirm your password</label><input class="field" id="delete_password" name="password" type="password" required><x-input-error :messages="$errors->userDeletion->get('password')" /></div>
                <button type="submit" class="mt-4 rounded-xl px-4 py-2.5 bg-red-600 text-white text-sm font-semibold hover:bg-red-700">Delete My Account</button>
            </form>
        </section>
    </div>
</x-app-layout>
