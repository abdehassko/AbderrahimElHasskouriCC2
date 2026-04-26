<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Medical App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">
    <!-- Header -->
    @include ('partials.header')

    <!-- Layout wrapper -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 fixed h-screen">
            @include ('partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 min-h-screen flex flex-col">
            <main class="flex-1 p-6">
                @yield ('content')
            </main>

            <!-- Footer -->
            @include ('partials.footer')
        </div>
    </div>
</body>
</html>
