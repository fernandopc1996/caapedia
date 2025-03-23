<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="caapedia">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- REMOVER EM PRODUÇÃO --}}
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>{{isset($title) ? $title.' | ' : ''}}{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased bg-cover" style="background-image: url({{url('/a/images/texture.jpg')}})">
        <div class="">
        
        {{-- NAVBAR mobile only --}}
        <x-mary-nav sticky class="lg:hidden bg-transparent backdrop-blur-3xl">
            <x-slot:brand>
                <div class="flex items-center gap-4">
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold text-green-950">Caapedia</h1>
                        <h1 class="text-xl font-bold text-green-950">{{$title ?? ''}}</h1>
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
    
                    <div class="grid grid-cols-2 justify-between mt-3 gap-4">
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
                        <x-menu.button-row href="{{route('history.events')}}" wire:navigate 
                                    icon="fas.book-open" title="História"/>
                        <x-menu.button-row href="{{route('people.manage')}}" wire:navigate 
                                    icon="fas.user-friends" title="Pessoas"/>
                        <x-menu.button-row href="{{route('production.manage')}}" wire:navigate 
                                    icon="fas.cubes" title="Produção"/>
                        <x-menu.button-row href="{{route('inventory.manage')}}" wire:navigate 
                                    icon="fas.warehouse" title="Estoque"/>
                        <x-menu.button-row href="{{route('explore.manage')}}" wire:navigate
                                    icon="fas.leaf" title="Explorar"/>
                        <x-menu.button-row href="{{route('news.newspaper')}}" wire:navigate 
                                    icon="fas.newspaper" title="Notícias"/>
                        <x-menu.button-row href="{{route('market.manage')}}" wire:navigate 
                                    icon="fas.cash-register" title="Comércio"/>
                        <x-menu.button-row href="{{route('finance.manage')}}" wire:navigate 
                                    icon="fas.piggy-bank" title="Finanças"/>
                    </div>

                    <x-mary-menu-separator />

                    <x-mary-menu-item title="Ranking" icon="fas.ranking-star"/>
                    <x-mary-menu-item title="Sua conta" icon="fas.user" link="{{route('profile')}}" />
                    <x-mary-menu-sub title="Configurações" icon="o-cog-6-tooth">
                        <x-mary-menu-item title="Contas" icon="fas.users-gear" link="####" />
                        <x-mary-menu-sub title="Cadastros" icon="fas.square-plus">
                            <x-mary-menu-item title="Personagens" icon="fas.person" link="{{route('general.person.index')}}" />
                            <x-mary-menu-item title="Categorias" icon="fas.tags" link="####" />
                            <x-mary-menu-item title="Produtos" icon="fas.box" link="####" />
                            <x-mary-menu-item title="Flora" icon="fas.leaf" link="####" />
                            <x-mary-menu-item title="Fauna" icon="fas.kiwi-bird" link="####" />
                            <x-mary-menu-item title="Eventos" icon="fas.calendar-alt" link="####" />
                        </x-mary-menu-sub>
                    </x-mary-menu-sub>
                </x-mary-menu>
                </div>
            </x-slot:sidebar>
     
            {{-- The `$slot` goes here --}}
            <x-slot:content>
                
                {{ $slot }}  

                <div class="mt-12"></div>
                @session('player')
                    <livewire:game.player.control-timer>
                @endsession
            </x-slot:content>
            
        </x-mary-main>
    </div>
        {{-- Toast --}}
        <x-mary-toast />
    </body>
</html>
