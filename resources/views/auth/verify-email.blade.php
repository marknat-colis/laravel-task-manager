<x-guest-layout>
    <h1 class="text-xl font-extrabold mb-2">Verify your email</h1>
    <p class="text-sm text-slate-500 mb-6">Check your email for the verification link. You can request another link below.</p>
    @if (session('status') == 'verification-link-sent')<p class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-3 text-sm mb-5">A new verification link has been sent.</p>@endif
    <form method="POST" action="{{ route('verification.send') }}">@csrf<button type="submit" class="button-primary w-full">Resend Verification Email</button></form>
    <form method="POST" action="{{ route('logout') }}" class="text-center mt-5">@csrf<button type="submit" class="text-sm text-brand-700 font-semibold hover:underline">Log out</button></form>
</x-guest-layout>
