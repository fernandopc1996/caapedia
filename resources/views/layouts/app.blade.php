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
                    <img id="menu-logo" class="h-12 hover:scale-125 active:rotate-45 duration-300" src="{{url('/a/images/logo.png')}}">
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
                    @if($player)
                    <livewire:game.player.player-resources>
                    @if($player->finished == false)
                    <x-mary-menu-separator />
                    <div class="grid grid-cols-3 gap-4">
                        <x-menu.button-row href="{{route('story.events')}}" 
                                    icon="fas.book-open" title="História"/>
                        <x-menu.button-row href="{{route('people.manage')}}" 
                                    icon="fas.user-friends" title="Pessoas"/>
                        <x-menu.button-row href="{{route('production.manage')}}" 
                                    icon="fas.cubes" title="Produção"/>
                         <x-menu.button-row href="{{route('explore.manage')}}"
                                    icon="fas.leaf" title="Explorar"/>
                        <x-menu.button-row href="{{route('inventory.manage')}}" 
                                    icon="fas.warehouse" title="Estoque" tag="Vender"/>
                        <x-menu.button-row href="{{route('market.manage')}}" 
                                    icon="fas.cash-register" title="Comércio" tag="Comprar"/>
                       
                        <x-menu.button-row href="{{route('finance.manage')}}" 
                                    icon="fas.piggy-bank" title="Finanças"/>
                        <x-menu.button-row href="{{route('news.newspaper')}}" 
                                    icon="fas.newspaper" title="Notícias" :disabled="true" tag="Em breve"/>
                        <x-menu.button-row href="#" 
                                    icon="fas.school" title="Educação" :disabled="true" tag="Em breve"/>
                                    
                        
                    </div>
                    @endif
                    @endif

                    <x-mary-menu-separator />

                    @if(isset($player) && \Illuminate\Support\Carbon::parse($player->last_datetime)->format('Y') > 1995)
                    <x-mary-menu-item title="Pesquisa" icon="fas.magnifying-glass-chart" class="glass-shine" link="https://forms.gle/bpgdnTiEBNBvarog8" external/>
                    @endif
                    
                    @if(!isset($player) || $player->finished == true)
                    <x-mary-menu-item title="Criar personagem" icon="far.plus-square" link="{{route('player.create')}}" />
                    @endif
                    

                    <x-mary-menu-item title="Ranking" icon="fas.ranking-star" link="{{route('general.score.ranking')}}"/>
                    <x-mary-menu-item icon="fas.user" link="{{route('profile')}}">
                        <div class="flex justify-between items-center w-full">
                            <span>Perfil</span>
                            @if(auth()->user()->google_email == null)
                                <x-mary-icon name="fas.exclamation-circle" class="w-5 h-5 text-yellow-300 animate-pulse-scale mr-2"/>
                            @endif
                        </div>
                    </x-mary-menu-item>

                    <x-mary-menu-item title="Suporte" icon="fas.file-circle-exclamation" link="https://forms.gle/Dh6umAMxiGixYGmb8" external/>

                    @can('access_admin_panel')
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
                    @endcan
                </x-mary-menu>
                </div>
            </x-slot:sidebar>
     
            {{-- The `$slot` goes here --}}
            <x-slot:content>
                
                {{ $slot }}  

                <livewire:game.story.interaction-action/>

                <div class="mt-32"></div>
                @if(isset($player) && $player->finished == false)
                    <livewire:game.player.control-timer>
                @endif
            </x-slot:content>
        </x-mary-main>
    </div>
        {{-- Toast --}}
        <x-mary-toast />

        <script>
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    window.location.reload();
                }
            });
        </script>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XNJ3ENMLR7"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XNJ3ENMLR7');

        setTimeout(() => {
        const logo = document.getElementById('menu-logo');
            if (logo) {
                logo.classList.add('animate-pulse-scale-small');
            }
        }, 1000);
        </script>
    </body>
</html>
