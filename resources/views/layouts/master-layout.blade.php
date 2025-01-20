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
    <title>@yield('title', 'Educourse')</title>
</head>
<body>
    @include('layouts.sidebar')

    <div class="p-4 sm:ml-64">
        @yield('content')
    </div>

    <script src="{{ asset('/app.js') }}"></script>
</body>
</html>