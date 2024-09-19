<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="caapedia">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased">
        <div class="h-full w-full bg-cover" style="background-image: url({{url('/a/images/background.jpg')}})">
        <div class="">
        
        {{-- NAVBAR mobile only --}}
        <x-mary-nav sticky class="lg:hidden bg-transparent backdrop-blur-3xl">
            <x-slot:brand>
                <div class="flex items-center gap-4">
                    
                    <div class="flex flex-col">
                    <h1 class="text-xl font-bold text-green-950">Caapedia</h1>
                    <h1 class="text-lg font-bold text-green-950">
                        <x-timers.timer startTime="{{Session::get('player')['last_datetime']}}" mode="{{Session::get('player')['mode_time']}}"/>
                    </h1>
                    <div class="flex gap-4">
                        <a href="{{route('timer.mode', 0)}}" class="hover:text-green-100 ">
                            <x-mary-icon name="fas.pause" label="Pausar"/>
                        </a>
                        <a href="{{route('timer.mode', 1)}}" class="hover:text-green-100">
                            <x-mary-icon name="fas.angle-right" label="Vel. 1" />
                        </a>
                        <a href="{{route('timer.mode', 2)}}" class="hover:text-green-100 ">
                            <x-mary-icon name="fas.angle-double-right" label="Vel. 2" />
                        </a>
                    </div>   
                    </div>
                </div>
            </x-slot:brand>
            <x-slot:actions>
                <label for="main-drawer" class="lg:hidden mr-3">
                    <img class="h-12 hover:scale-125 active:rotate-45 duration-300" src="{{url('/a/images/logo.png')}}">
                </label>
            </x-slot:actions>
        </x-mary-nav>
     
        {{-- MAIN --}}
        <x-mary-main full-width>
            {{-- SIDEBAR --}}
            <x-slot:sidebar drawer="main-drawer" class="">
                <div class="h-full w-full bg-cover" style="background-image: url({{url('/a/images/texture.jpg')}})">
                {{-- BRAND --}}
                <div class="ml-5 pt-5">
                    <div class="flex items-center gap-4">
                        <img class="h-12" src="{{url('/a/images/logo.png')}}">
                        <h1 class="text-xl font-bold text-green-950">Caapedia</h1>
                    </div>
                </div>
     
                {{-- MENU --}}
                <x-mary-menu activate-by-route>
                    {{-- User --}}
    
                    <div class="w-full grid grid-cols-2 justify-between mt-3 gap-4">
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-xs font-semibold">Área produtiva (Ha):</span>
                            <x-mary-icon name="fas.layer-group" label="0,100" class="text-2xl text-green-900"/>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-xs font-semibold">Degradação (%):</span> 
                            <x-mary-icon name="fas.frown" label="01" class="text-2xl text-red-900"/>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-xs font-semibold">Água útil (m³):</span> 
                            <x-mary-icon name="fas.tint" label="0,390" class="text-2xl text-blue-900"/>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-xs font-semibold">Montante (R$):</span> 
                            <x-mary-icon name="fas.dollar-sign" label="312,39" class="text-2xl text-teal-900"/>
                        </div>
                    </div>
    
                    <x-mary-menu-separator />

                    <div class="grid grid-cols-3 gap-4">
                        <x-menu.button-row icon="fas.user-friends" title="Pessoas"/>
                        <x-menu.button-row icon="fas.cubes" title="Produção"/>
                        <x-menu.button-row icon="fas.warehouse" title="Estoque"/>
                        <x-menu.button-row icon="fas.leaf" title="Explorar"/>
                        <x-menu.button-row icon="fas.newspaper" title="Notícias"/>
                        <x-menu.button-row icon="fas.cash-register" title="Comércio"/>
                        <x-menu.button-row icon="fas.piggy-bank" title="Finanças"/>
                    </div>

                    <x-mary-menu-separator />

                    <x-mary-menu-item title="Sua conta" icon="o-sparkles" link="/" />
                    <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                        <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />
                        <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
                    </x-mary-menu-sub>
                </x-mary-menu>
                </div>
            </x-slot:sidebar>
     
            {{-- The `$slot` goes here --}}
            <x-slot:content>
                {{ $slot }}  

                <div class="hidden lg:flex group fixed w-100 hover:w-auto bottom-5 right-5 backdrop-blur-3xl border-t border-gray-800 shadow-lg">
                    <div class="flex flex-row container justify-between items-center gap-12 p-4">

                        <div class="hidden group-hover:flex gap-4">
                            <a href="{{route('timer.mode', 0)}}" class="hover:text-green-100">
                                <x-mary-icon name="fas.pause" label="Pausar"/>
                            </a>
                            <a href="{{route('timer.mode', 1)}}" class="hover:text-green-100">
                                <x-mary-icon name="fas.angle-right" label="Velocidade 1" />
                            </a>
                            <a href="{{route('timer.mode', 2)}}" class="hover:text-green-100">
                                <x-mary-icon name="fas.angle-double-right" label="Velocidade 2" />
                            </a>
                        </div>                      
                           
                        <div>
                            
                            <x-timers.timer startTime="{{Session::get('player')['last_datetime']}}" mode="{{Session::get('player')['mode_time']}}"/>
                        </div>
                    </div>
                </div> 
            </x-slot:content>
            
        </x-mary-main>
    </div>
    </div>
        {{-- Toast --}}
        <x-mary-toast />
    </body>
</html>
