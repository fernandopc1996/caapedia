<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{auth()->user()->theme ?? 'light'}}">
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
                <div class="ml-5 pt-5">App</div>
            </x-slot:brand>
            <x-slot:actions>
                <label for="main-drawer" class="lg:hidden mr-3">
                    <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                </label>
            </x-slot:actions>
        </x-mary-nav>
     
        {{-- MAIN --}}
        <x-mary-main full-width>
            {{-- SIDEBAR --}}
            <x-slot:sidebar drawer="main-drawer" class="bg-base-100">
                <div class="h-full w-full bg-cover" style="background-image: url({{url('/a/images/background.jpg')}})">
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
                    @if($user = auth()->user())
                        <x-mary-menu-separator />
     
                        <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                            <x-slot:actions>
                                <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                            </x-slot:actions>
                        </x-mary-list-item>
     
                        <x-mary-menu-separator />
                    @endif
     
                    <x-mary-menu-item title="Hello" icon="o-sparkles" link="/" />
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
            </x-slot:content>
            <x-slot:footer class="hidden lg:block">
                <div class="fixed bottom-0 w-full backdrop-blur-3xl border-t border-gray-300 shadow-lg">
                    <div class="container mx-auto px-4 flex flex-row justify-between items-center py-4 space-y-4 md:space-y-0">
                        <x-mary-icon name="o-check" class="w-9 h-9 text-green-500 text-2xl" label="Messages" />
                    </div>
                </div> 
            </x-slot:footer>
        </x-mary-main>
    </div>
    </div>
        {{-- Toast --}}
        <x-mary-toast />
    </body>
</html>
