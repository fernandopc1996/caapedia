<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />

    <title>{{ $title ?? 'Erro | Caapedia' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body class="font-sans antialiased">
    <div class="h-screen bg-cover bg-center flex justify-center md:items-center"
        style="background-image: url({{ url('/a/images/background.jpg') }})">

        <div class="flex flex-col items-center space-y-8 mt-12 md:mt-0">
            <!-- Logo -->
            <div>
                <img class="w-32 md:w-40 lg:w-48" src="{{ url('/a/images/logo.png') }}" alt="Caapedia">
            </div>

            <div class="flex flex-col items-center text-center">

                <div class="flex flex-row items-center gap-2">
                    <div class="text-2xl font-extrabold text-red-600 drop-shadow-md">
                        @yield('code')
                    </div>
                    <div class="text-2xl font-semibold text-gray-800">
                        @yield('title')
                    </div>
                </div>

                <div class="text-lg md:text-xl text-gray-800 max-w-xl">
                    @yield('message')
                </div>

                <div class="pt-4">
                    @yield('content')
                </div>

            </div>

        </div>
    </div>

    @stack('scripts')
</body>

</html>
