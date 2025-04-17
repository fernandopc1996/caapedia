<div>
    @if($activeStory)
    <div class="fixed inset-0 z-50" wire:transition.out.origin.bottom> {{-- ← removido pointer-events-none --}}
        
        {{-- Fundo escuro que cobre tudo e bloqueia cliques --}}
        <div class="absolute inset-0 bg-black/50"></div>

        {{-- Personagem fixo no canto inferior esquerdo --}}
        <img src="{{ $activeStory->character->front_partial }}"
             alt="{{ $activeStory->character->name }}"
             class="absolute bottom-0 left-0 w-48 h-auto object-contain z-50 pointer-events-auto" />

        {{-- Card branco fixo na parte inferior --}}
        <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-lg shadow-lg z-40 pointer-events-auto border-t border-black">
            <div class="p-6 pl-48 md:pl-60">
                <p class="text-lg italic font-semibold text-gray-800 text-center">
                    {{ $activeStory->text }}
                </p>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-{{ count($activeStory->choices) }} gap-4">
                    @foreach($activeStory->choices as $choice)
                        <button
                            wire:click="action"
                            class="w-full px-4 py-2 italic rounded-md border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring">
                            {{ $choice->text }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    @endif
</div>