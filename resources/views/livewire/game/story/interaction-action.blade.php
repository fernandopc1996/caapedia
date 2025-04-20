<div>
    @if ($activeStory)
        <div wire:key="story-{{ $activeStory->id }}" class="fixed inset-0 z-50" x-data="{ exit: false }">

            {{-- Fundo escuro --}}
            <div class="absolute inset-0 bg-black/50"></div>

            {{-- Imagem do personagem --}}
            <img src="{{ $activeStory->character->front_partial }}"
                 alt="{{ $activeStory->character->name }}"
                 x-show="!exit"
                 x-transition:leave="transition ease-in-out duration-500"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-full"
                 class="absolute bottom-0 left-0 w-48 h-auto object-contain z-50 pointer-events-none animate-slide-up" />

            {{-- Card da história --}}
            <div
                x-show="!exit"
                x-transition:leave="transition ease-in-out duration-500"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-full"
                class="absolute bottom-0 left-24 md:left-30 right-0 bg-white shadow-lg z-40 pointer-events-auto animate-slide-up">

                <div class="p-6 pl-25 md:pl-18">
                    <p class="text-lg italic font-semibold text-gray-800 text-center animate-fade-in-left">
                        {{ $parsedText }} 
                        @if(isset($activeStory->link))
                        <span>
                            <a href="{{ $activeStory->link }}" target="_blank"
                                class="text-white bg-black px-3 py-1 rounded text-sm inline-block font-semibold">
                                Clique aqui para detalhes
                            </a>
                        </span>
                        @endif
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-{{ count($activeStory->choices) }} gap-4">
                        @foreach ($activeStory->choices as $i => $choice)
                            <button
                                style="animation-delay: {{ $i * 0.1 }}s"
                                class="w-full px-4 py-2 italic rounded-md border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring animate-fade-in-left"
                                @click.prevent="
                                    exit = true;
                                    setTimeout(() => { $wire.action('{{ $choice->text }}') }, 500);
                                ">
                                {{ $choice->text }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>
