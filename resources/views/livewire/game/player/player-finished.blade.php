@php
    use App\Services\Game\Story\StoryActionExecutor;

    $executor = new StoryActionExecutor($player);
    $parsedText = $story ? $executor->parseText($story->text) : '';

    $imageField = $story->character_image ?? null;
    $imageUrl = $imageField ? data_get($story->character, $imageField) : null;
@endphp

<div>
    <x-mary-header title="História Finalizada"
        subtitle="A história de {{ $player->nickname }} foi encerrada em {{ \Carbon\Carbon::parse($player->last_datetime)->format('d/m/Y H:i') }} do Caapedia"
        separator />

    <div class="max-w-4xl mx-auto shadow-md rounded-lg p-6 mt-6">
        {{-- Personagem --}}
        <div class="flex items-center gap-4">
            @if ($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $story->character->name ?? 'Personagem' }}"
                    class="w-32 h-auto rounded-lg object-contain">
            @endif
            <div>
                {{-- Texto final da história --}}
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">Último trecho da história</h3>
                    <p class="text-gray-700 italic mt-2">{{ $parsedText }}</p>
                </div>

                {{-- Escolha final do jogador --}}
                @if ($choice)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800">Escolha do Jogador</h3>
                        <p class="text-gray-700 mt-1"><span class="font-semibold">Texto da escolha:</span>
                            {{ $choice->text }}
                        </p>
                        @if (!empty($choice->description))
                            <p class="text-gray-700 mt-1"><span class="font-semibold">Resultado:</span>
                                {{ $choice->description }}</p>
                        @endif
                    </div>
                @endif

                {{-- Botão para reiniciar --}}
                <div class="mt-8 text-center">
                    <a href="{{ route('player.create') }}"
                        class="inline-block text-white font-semibold py-2 px-4 rounded transition">
                        Iniciar Nova Jornada
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>
