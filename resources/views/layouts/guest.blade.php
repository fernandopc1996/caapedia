<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />

    <title>{{ $title ?? 'Caapedia' }}</title>

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
                <img class="w-32 md:w-40 lg:w-48" src="{{ url('/a/images/logo.png') }}">
            </div>

            <!-- Conteúdo da Página -->
            <div class="flex flex-col items-center">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="fixed bottom-0 w-full border-t border-gray-300 shadow-lg">
        <div class="container mx-auto px-4 flex flex-row justify-between items-center py-4 space-y-4 md:space-y-0">
            <!-- Links -->
            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 text-left">
                <a target="_blank" href="https://caapedia.fernandopc.dev.br/caapedia/sobre"
                    class="text-white hover:text-gray-300">Sobre</a>
                <a target="_blank" href="https://caapedia.fernandopc.dev.br/caapedia/termos/termos-de-uso"
                    class="text-white hover:text-gray-300">Termos de Uso</a>
                <a target="_blank" href="https://caapedia.fernandopc.dev.br/caapedia/termos/pol%C3%ADticas-de-privacidade"
                    class="text-white hover:text-gray-300">Políticas de Privacidade</a>
                <a target="_blank" href="https://caapedia.fernandopc.dev.br/caapedia/cr%C3%A9ditos" 
                    class="text-white hover:text-gray-300">Créditos</a>
            </div>

            <!-- Logos -->
            <div
                class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-12">
                <img class="h-8 contrast-200" src="{{ url('/a/images/univasf.png') }}" alt="Univasf">
                <img class="h-10 contrast-200" src="{{ url('/a/images/ppgdides.png') }}" alt="PPGDiDeS">
                <img class="h-10 contrast-200" src="{{ url('/a/images/pev.png') }}" alt="PEV">
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>