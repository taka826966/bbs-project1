<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
        <div class="flex flex-col min-h-screen bg-black">
            @include('layouts.navigation')
            <header class="p-3 bg-indigo-900">
                header
            </header>
            <main class="flex-grow p-3 text-white">
                {{ $slot }}
            </main>
            <footer class="px-3 py-5 bg-gray-700 text-sm text-center">
                &copy; BLACK CATALK. 2024.
            </footer> 
        </div>
    </body>
</html>
