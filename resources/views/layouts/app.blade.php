<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ __('messages.app_name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    @vite (['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="font-sans antialiased bg-slate-100">
    <!-- Header -->
    @include ('partials.header')

    <!-- Layout wrapper -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-48 fixed h-screen">
            @include ('partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-48 min-h-screen flex flex-col">
            <main class="flex-1 p-6">
                @yield ('content')
            </main>

            <!-- Footer -->
            @include ('partials.footer')
        </div>
    </div>
</body>
</html>
