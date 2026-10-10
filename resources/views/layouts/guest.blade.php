<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Task Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-ink">
<main class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
    <a href="/" class="inline-flex items-center gap-3 mb-8 group" aria-label="Task Manager home">
        <span class="inline-flex size-12 items-center justify-center rounded-2xl bg-brand-600 text-white shadow-lg shadow-blue-200 text-2xl font-bold">✓</span>
        <span class="text-2xl tracking-tight font-extrabold text-ink">Task<span class="text-brand-600">Manager</span></span>
    </a>
    <div class="w-full max-w-md card p-7 sm:p-9">{{ $slot }}</div>
    <p class="mt-6 text-xs text-slate-400">Web Programming Lab · Laravel Breeze Authentication</p>
</main>
</body>
</html>
