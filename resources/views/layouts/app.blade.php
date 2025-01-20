<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>{{ config('app.name', 'Laravel') }}</title>

       

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.sidebar')

            <!-- Page Content -->
            {{-- <main class="p-4 sm:ml-64">
                {{ $slot }}
            </main> --}}
        </div>
    </body>
</html>
