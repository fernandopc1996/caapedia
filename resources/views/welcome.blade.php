<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{url('favicon.ico')}}" />

        <title>Caapedia</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen bg-cover bg-center flex justify-center items-center pb-72 sm:pb-32" style="background-image: url({{url('/a/images/background.jpg')}})">
            <div class="flex flex-col items-center space-y-8">
                <!-- Logo -->
                <div>
                    <img class="w-32 md:w-40 lg:w-48" src="{{url('/a/images/logo.png')}}">
                </div>

                <!-- Botões -->
                <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                    <!-- Botão Entrar como Convidado -->
                    <x-mary-button 
                        label="Entrar como Convidado" 
                        icon="fas.user-slash" 
                        link="{{route('dashboard')}}{{-- route('guest.login') --}}" 
                        no-wire-navigate 
                        class="btn-neutral btn-lg w-72" />

                    <x-mary-button 
                        label="Entrar com Google" 
                        icon="fab.google" 
                        link="{{-- route('google.login') --}}" 
                        no-wire-navigate 
                        class="btn-info  btn-lg w-72" />
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
                    <img class="h-8 contrast-200" src="{{url('/a/images/univasf.png')}}" alt="Univasf">
                    <img class="h-10 contrast-200" src="{{url('/a/images/ppgdides.png')}}" alt="PPGDiDeS">
                    <img class="h-10 contrast-200" src="{{url('/a/images/pev.png')}}" alt="PEV">
                </div>
            </div>
        </footer>        
    </body>
</html>