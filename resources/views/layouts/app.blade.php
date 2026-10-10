<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Task Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-ink bg-slate-50">
<div class="min-h-screen">
    @include('layouts.navigation')
    @isset($header)
        <header class="border-b border-slate-200 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-7">{{ $header }}</div>
        </header>
    @endisset
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-9">{{ $slot }}</main>
    <footer class="mt-8 py-8 text-center text-xs text-slate-400">Laravel Authentication &amp; CRUD · Web Programming Lab</footer>
</div>
</body>
</html>
