<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Caapedia</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen bg-cover bg-center flex justify-center items-center pb-32" style="background-image: url({{url('/a/images/background.jpg')}})">
            <div class="flex flex-col items-center space-y-8">
                <!-- Logo -->
                <div>
                    <img class="w-32 md:w-40 lg:w-48" src="{{url('/a/images/logo.png')}}">
                </div>

                <!-- Botões -->
                <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                    <!-- Botão Entrar como Convidado -->
                    <a href="{{route('dashboard')}}{{-- route('guest.login') --}}" class="flex items-center justify-center w-64 h-16 bg-gray-800 text-white font-bold rounded-lg shadow-lg hover:bg-gray-700 transition-all">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4V16m0 0v4m0-4H8m4 0h4m-4-8a4 4 0 1 0 0 8m0-8V2m0 8a4 4 0 1 1-4 4"></path>
                        </svg>
                        Entrar como Convidado
                    </a>

                    <!-- Botão Entrar com Google -->
                    <a href="{{-- route('google.login') --}}" class="flex items-center justify-center w-64 h-16 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-500 transition-all">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4v2.06m-1.65-6.14A9.945 9.945 0 0 1 22 12a9.945 9.945 0 0 1-1.65 6.08M12 16v4m-8-8v-2a9.985 9.985 0 0 1 1.65-6.08"></path>
                        </svg>
                        Entrar com Google
                    </a>
                </div>
            </div>
        </div>

        <footer class="fixed bottom-0 w-full border-t border-gray-300 shadow-lg">
            <div class="container mx-auto px-4 flex flex-row justify-between items-center py-4 space-y-4 md:space-y-0">
                <!-- Links -->
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 text-left">
                    <a href="#" class="text-white hover:text-gray-300">Sobre</a>
                    <a href="#" class="text-white hover:text-gray-300">Regras</a>
                    <a href="#" class="text-white hover:text-gray-300">Termos de Uso</a>
                    <a href="#" class="text-white hover:text-gray-300">Políticas de Privacidade</a>
                </div>
        
                <!-- Logos -->
                <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-12">
                    <img class="h-10" src="{{url('/a/images/univasf.png')}}" alt="Univasf">
                    <img class="h-16" src="{{url('/a/images/ppgdides.png')}}" alt="PPGDiDeS">
                </div>
            </div>
        </footer>        
    </body>
</html>