<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    
    <title>@yield('title', 'Educourse')</title>
</head>
<body class="font-sans antialiased">
    @include('layouts.sidebar')

    <div class="min-h-screen bg-gray-100">
        <div class="p-4 sm:ml-64">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/app.js') }}"></script>
</body>
</html>